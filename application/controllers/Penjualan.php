<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Penjualan');
		$this->load->library('form_validation');
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Transaksi Penjualan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['penjualan'] = $this->M_Penjualan->getPenjualan()->result();
		$data['barang'] = $this->M_Penjualan->getDataBarang()->result();
		// $data['barang'] = $this->db->get('barang')->result();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar_petugas', $data);
		$this->load->view('penjualan/penjualan', $data);
		$this->load->view('templates/footer');
	}

	public function simpanBarang()
	{
		$kode_barang = $this->input->post('kode_barang', true);

		$cekBarang = $this->db->get_where('barang', ['kode_barang' => $this->input->post('kode_barang', true)])->row();
		if ($this->db->affected_rows() > 0) {
			if ($cekBarang->stok == 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            Stok barang habis.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
				echo "<script>
			window.location.href = '" . base_url('penjualan/index/' . $this->input->post('kode_penjualan', true)) . "';
			</script>";
				die;
			} else {
				$jumlah = 1;
				$total = $jumlah * $cekBarang->harga_jual;
				date_default_timezone_set('Asia/Jakarta');
				$tanggalHariIni = date('Y-m-d');
				$jamHariIni = date('H:i:s');
				$data = [
					'kode_penjualan' => $this->input->post('kode_penjualan', true),
					'kode_barang' => $this->input->post('kode_barang', true),
					'jumlah' => 1,
					'total' => $total,
					'tanggal' => $tanggalHariIni,
					'jam' => $jamHariIni,
					'id_user' => $this->input->post('id_user', true)
				];
				$this->M_Penjualan->updateStokBarang0($kode_barang);
				$this->db->insert('penjualan', $data);
				redirect('penjualan/index/' . $this->input->post('kode_penjualan', true));
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            Kode barang tidak di temukan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
			echo "<script>
			window.location.href = '" . base_url('penjualan/index/' . $this->input->post('kode_penjualan', true)) . "';
			</script>";
		}
	}

	public function tambahJumlah($id_penjualan)
	{
		$penjualan = $this->db->get_where('penjualan', ['id' => $id_penjualan])->row();
		$barang = $this->db->get_where('barang', ['kode_barang' => $penjualan->kode_barang])->row();

		if ($barang->stok == 0) {
			echo "<script>
			alert('Stok tidak cukup')
			window.location.href = '" . base_url('penjualan/index/' . $penjualan->kode_penjualan) . "';
			</script>";
		} else {
			$this->M_Penjualan->updateJumlahPenjualan($barang->harga_jual, $id_penjualan);
			$this->M_Penjualan->updateStokBarang($penjualan->kode_barang);
			redirect('penjualan/index/' . $penjualan->kode_penjualan);
		}
	}

	public function kurangiJumlah($id_penjualan)
	{
		$penjualan = $this->db->get_where('penjualan', ['id' => $id_penjualan])->row();
		$barang = $this->db->get_where('barang', ['kode_barang' => $penjualan->kode_barang])->row();

		if ($penjualan->jumlah == 1) {
			echo "<script>
			alert('Jumlah barang sudah 1')
			window.location.href = '" . base_url('penjualan/index/' . $penjualan->kode_penjualan) . "';
			</script>";
		} else {
			$this->M_Penjualan->updateJumlahPenjualan1($barang->harga_jual, $id_penjualan);
			$this->M_Penjualan->updateStokBarang1($penjualan->kode_barang);
			redirect('penjualan/index/' . $penjualan->kode_penjualan);
		}
	}

	public function hapus($id_penjualan)
	{
		$penjualan = $this->db->get_where('penjualan', ['id' => $id_penjualan])->row();
		$this->M_Penjualan->updateStokBarang2($penjualan->jumlah, $penjualan->kode_barang);

		$this->db->delete('penjualan', ['id' => $id_penjualan]);
		redirect('penjualan/index/' . $penjualan->kode_penjualan);
	}

	public function simpanDetailPenjualan()
	{
		$this->M_Penjualan->simpanDetailPenjualan();
		if ($this->db->affected_rows() > 0) {
			$result = ['success' => true];
		} else {
			$result = ['success' => false];
		}
		echo json_encode($result);
	}

	public function struk()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['kode_penjualan'] = $this->uri->segment(3);
		$data['penjualan'] = $this->M_Penjualan->getPenjualan()->result();
		$data['tanggal_beli'] = $this->db->get_where('penjualan', ['kode_penjualan' => $this->uri->segment(3)])->row();
		$data['detail_penjualan'] = $this->db->get_where('detail_penjualan', ['kode_penjualan' => $this->uri->segment(3)])->row();

		$this->load->view('penjualan/struk', $data);
	}

	public function data_penjualan()
	{
		$data['title'] = 'Data Penjualan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		// $data['rows'] = $this->M_Penjualan->dataPenjualan()->result();
		$data['rows'] = $this->M_Penjualan->dataPenjualan()->result();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar_petugas', $data);
		$this->load->view('penjualan/data_penjualan', $data);
		$this->load->view('templates/footer');
	}

	public function data_penjualan_by_tanggal()
	{

		$data['title'] = 'Data Penjualan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['rows'] = $this->M_Penjualan->getBerdasarkanTanggal()->result();

		$this->form_validation->set_rules('tgl_awal', 'Tanggal Awal', 'trim|required', [
			'required' => 'Tanggal awal harus diisi'
		]);
		$this->form_validation->set_rules('tgl_akhir', 'Tanggal akhir', 'trim|required', [
			'required' => 'Tanggal akhir harus diisi'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar_petugas', $data);
			$this->load->view('penjualan/data_penjualan', $data);
			$this->load->view('templates/footer');
		} else {
			$data['tgl_awal'] = $this->input->post('tgl_awal');
			$data['tgl_akhir'] = $this->input->post('tgl_akhir');
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar_petugas', $data);
			$this->load->view('penjualan/data_penjualan', $data);
			$this->load->view('templates/footer');
		}
	}

	public function detail_penjualan($kode_penjualan)
	{
		$data['title'] = 'Detail Penjualan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		// $data['rows'] = $this->M_Penjualan->dataPenjualan()->result();
		$data['rows'] = $this->M_Penjualan->dataDetailPenjualan($kode_penjualan)->row();

		$data['kode_penjualan'] = $kode_penjualan;
		$data['penjualan'] = $this->M_Penjualan->getPenjualan()->result();
		$data['tanggal_beli'] = $this->db->get_where('penjualan', ['kode_penjualan' => $kode_penjualan])->row();
		$data['detail_penjualan'] = $this->db->get_where('detail_penjualan', ['kode_penjualan' => $kode_penjualan])->row();
		// $data['nama_petugas']  = $this->db->query("SELECT * FROM detail_penjualan JOIN user ON detail_penjualan.id_user = user.id WHERE detail_penjualan.kode_penjualan = $kode_penjualan")->row();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar_petugas', $data);
		$this->load->view('penjualan/detail_penjualan', $data);
		$this->load->view('templates/footer');
	}
}
