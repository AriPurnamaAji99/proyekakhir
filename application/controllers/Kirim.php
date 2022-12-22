<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kirim extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Kirim');
    }

    public function index()
    {
        $data['title'] = 'Data Laporan Penjualan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['rows'] = $this->db->get('data_laporan')->result();
        // $data['rows'] = $this->db->query("SELECT * FROM data_laporan ORDER BY tgl_awal ASC")->result();
        $data['rows'] = $this->M_Kirim->getLaporanPenjualan()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('data_laporan/laporan', $data);
        $this->load->view('templates/footer');
    }

    public function penjualan()
    {
        $data['title'] = 'Data Laporan Penjualan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('data_laporan/laporan_penjualan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');

        $tgl_awal = $this->input->post('tgl_awal', true);
        $tgl_akhir = $this->input->post('tgl_akhir', true);
        $laporan_penjualan = $_FILES['laporan_penjualan'];
        $status = 'proses';
        $feedback = $this->input->post('feedback', true) == '' ? NULL : $this->input->post('feedback', true);
        $created_at = $waktu;
        $updated_at = $this->input->post('updated_at', true) == '' ? NULL : $this->input->post('updated_at', true);

        $config['upload_path'] = './assets/laporan';
        $config['allowed_types'] = 'pdf';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('laporan_penjualan')) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle"></i> Data laporan <strong>gagal </strong>ditambahkan. (pastikan format file pdf)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('kirim');
        } else {
            $laporan_penjualan = $this->upload->data('file_name');
        }

        $data = array(
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'laporan_penjualan' => $laporan_penjualan,
            'status' => $status,
            'feedback' => $feedback,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        );

        $this->db->insert('data_laporan', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data laporan <strong>berhasil </strong>ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('kirim');
    }

    public function edit($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');
        $data['row'] = $this->db->get_where('data_laporan', ['id_laporan' => $id])->row();

        $tgl_awal = $this->input->post('tgl_awal', true);
        $tgl_akhir = $this->input->post('tgl_akhir', true);
        $laporan_penjualan = $_FILES['laporan_penjualan']['name'];
        $created_at = $this->input->post('created_at', true);
        $updated_at = $waktu;

        $config['upload_path'] = './assets/laporan';
        $config['allowed_types'] = 'pdf';

        if (!empty($laporan_penjualan)) {
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('laporan_penjualan')) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle"></i> Data laporan <strong>gagal </strong>ditambahkan. (pastikan format file pdf)
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                redirect('kirim');
            } else {
                $laporan_penjualan = $this->upload->data('file_name');
            }
            $dataUpdate = array(
                'tgl_awal' => $tgl_awal,
                'tgl_akhir' => $tgl_akhir,
                'laporan_penjualan' => $laporan_penjualan,
                'created_at' => $created_at,
                'updated_at' => $waktu
            );
        } else {
            $dataUpdate = array(
                'tgl_awal' => $tgl_awal,
                'tgl_akhir' => $tgl_akhir,
                // 'laporan_penjualan' => $laporan_penjualan,
                'created_at' => $created_at,
                'updated_at' => $waktu
            );
        }
        $this->db->where('id_laporan', $id);
        $this->db->update('data_laporan', $dataUpdate);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data laporan <strong>berhasil </strong>diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('kirim');
    }

    public function hapus($id)
    {
        $this->db->where('id_laporan', $id);
        $this->db->delete('data_laporan');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil <strong>dihapus!</strong>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('kirim');
    }

    public function barang_masuk()
    {
        $data['title'] = 'Data Laporan Barang Masuk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['rows'] = $this->db->get('data_laporan_barang_masuk')->result();
        // $data['rows'] = $this->db->get('data_laporan')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas_gudang', $data);
        $this->load->view('data_laporan/laporan_barang_masuk', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_laporan_barang_masuk()
    {
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');

        $tgl_awal = $this->input->post('tgl_awal', true);
        $tgl_akhir = $this->input->post('tgl_akhir', true);
        $nama_laporan = $_FILES['nama_laporan'];
        $status = 'proses';
        $feedback = $this->input->post('feedback', true) == '' ? NULL : $this->input->post('feedback', true);
        $created_at = $waktu;
        $updated_at = $this->input->post('updated_at', true) == '' ? NULL : $this->input->post('updated_at', true);

        $config['upload_path'] = './assets/laporan';
        $config['allowed_types'] = 'pdf';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('nama_laporan')) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle"></i> Data laporan <strong>gagal </strong>ditambahkan. (pastikan format file pdf)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('kirim/barang_masuk');
        } else {
            $nama_laporan = $this->upload->data('file_name');
        }

        $data = array(
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'nama_laporan' => $nama_laporan,
            'status' => $status,
            'feedback' => $feedback,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        );

        $this->db->insert('data_laporan_barang_masuk', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data laporan <strong>berhasil </strong>ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('kirim/barang_masuk');
    }

    public function edit_laporan_barang_masuk($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');
        $data['row'] = $this->db->get_where('data_laporan_barang_masuk', ['id_laporan' => $id])->row();

        $tgl_awal = $this->input->post('tgl_awal', true);
        $tgl_akhir = $this->input->post('tgl_akhir', true);
        $nama_laporan = $_FILES['nama_laporan']['name'];
        $created_at = $this->input->post('created_at', true);
        $updated_at = $waktu;

        $config['upload_path'] = './assets/laporan';
        $config['allowed_types'] = 'pdf';

        if (!empty($nama_laporan)) {
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('nama_laporan')) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle"></i> Data laporan <strong>gagal </strong>ditambahkan. (pastikan format file pdf)
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                redirect('kirim/barang_masuk');
            } else {
                $nama_laporan = $this->upload->data('file_name');
            }
            $dataUpdate = array(
                'tgl_awal' => $tgl_awal,
                'tgl_akhir' => $tgl_akhir,
                'nama_laporan' => $nama_laporan,
                'created_at' => $created_at,
                'updated_at' => $waktu
            );
        } else {
            $dataUpdate = array(
                'tgl_awal' => $tgl_awal,
                'tgl_akhir' => $tgl_akhir,
                // 'laporan_penjualan' => $laporan_penjualan,
                'created_at' => $created_at,
                'updated_at' => $waktu
            );
        }
        $this->db->where('id_laporan', $id);
        $this->db->update('data_laporan_barang_masuk', $dataUpdate);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data laporan <strong>berhasil </strong>diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('kirim/barang_masuk');
    }

    public function barang_Keluar()
    {
        $data['title'] = 'Data Laporan Barang Keluar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['rows'] = $this->db->get('data_laporan_barang_keluar')->result();
        // $data['rows'] = $this->db->get('data_laporan')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas_gudang', $data);
        $this->load->view('data_laporan/laporan_barang_keluar', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_laporan_barang_keluar()
    {
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');

        $tgl_awal = $this->input->post('tgl_awal', true);
        $tgl_akhir = $this->input->post('tgl_akhir', true);
        $nama_laporan = $_FILES['nama_laporan'];
        $status = 'proses';
        $feedback = $this->input->post('feedback', true) == '' ? NULL : $this->input->post('feedback', true);
        $created_at = $waktu;
        $updated_at = $this->input->post('updated_at', true) == '' ? NULL : $this->input->post('updated_at', true);


        $config['upload_path'] = './assets/laporan';
        $config['allowed_types'] = 'pdf';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('nama_laporan')) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle"></i> Data laporan <strong>gagal </strong>ditambahkan. (pastikan format file pdf)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('kirim/barang_keluar');
        } else {
            $nama_laporan = $this->upload->data('file_name');
        }

        $data = array(
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'nama_laporan' => $nama_laporan,
            'status' => $status,
            'feedback' => $feedback,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        );

        $this->db->insert('data_laporan_barang_keluar', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data laporan <strong>berhasil </strong>ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('kirim/barang_keluar');
    }

    public function edit_laporan_barang_keluar($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');
        $data['row'] = $this->db->get_where('data_laporan_barang_keluar', ['id_laporan' => $id])->row();

        $tgl_awal = $this->input->post('tgl_awal', true);
        $tgl_akhir = $this->input->post('tgl_akhir', true);
        $nama_laporan = $_FILES['nama_laporan']['name'];
        $created_at = $this->input->post('created_at', true);
        $updated_at = $waktu;

        $config['upload_path'] = './assets/laporan';
        $config['allowed_types'] = 'pdf';

        if (!empty($nama_laporan)) {
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('nama_laporan')) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle"></i> Data laporan <strong>gagal </strong>ditambahkan. (pastikan format file pdf)
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                redirect('kirim/barang_Keluar');
            } else {
                $nama_laporan = $this->upload->data('file_name');
            }
            $dataUpdate = array(
                'tgl_awal' => $tgl_awal,
                'tgl_akhir' => $tgl_akhir,
                'nama_laporan' => $nama_laporan,
                'created_at' => $created_at,
                'updated_at' => $waktu
            );
        } else {
            $dataUpdate = array(
                'tgl_awal' => $tgl_awal,
                'tgl_akhir' => $tgl_akhir,
                // 'laporan_penjualan' => $laporan_penjualan,
                'created_at' => $created_at,
                'updated_at' => $waktu
            );
        }
        $this->db->where('id_laporan', $id);
        $this->db->update('data_laporan_barang_keluar', $dataUpdate);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data laporan <strong>berhasil </strong>diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('kirim/barang_Keluar');
    }

    public function laba_rugi()
    {
        $data['title'] = 'Data Laporan Laba Rugi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['rows'] = $this->db->get('data_laporan_laba_rugi')->result();
        // $data['rows'] = $this->M_Kirim->getLaporanLabaRugi()->result();
        $data['last_id'] = $this->db->query("SELECT MAX(id_laporan) as last_id FROM data_laporan_laba_rugi")->row();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('data_laporan/laporan_laba_rugi', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_laporan_laba_rugi()
    {
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');

        $tgl_awal = $this->input->post('tgl_awal', true);
        $tgl_akhir = $this->input->post('tgl_akhir', true);
        $nama_laporan = $_FILES['nama_laporan'];
        $status = 'proses';
        $feedback = $this->input->post('feedback', true) == '' ? NULL : $this->input->post('feedback', true);
        $created_at = $waktu;
        $updated_at = $this->input->post('updated_at', true) == '' ? NULL : $this->input->post('updated_at', true);

        $config['upload_path'] = './assets/laporan';
        $config['allowed_types'] = 'pdf';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('nama_laporan')) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle"></i> Data laporan <strong>gagal </strong>ditambahkan. (pastikan format file pdf)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('kirim/laba_rugi');
        } else {
            $nama_laporan = $this->upload->data('file_name');
        }

        $data = array(
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'nama_laporan' => $nama_laporan,
            'status' => $status,
            'feedback' => $feedback,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        );

        $this->db->insert('data_laporan_laba_rugi', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data laporan <strong>berhasil </strong>ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('kirim/laba_rugi');
    }

    public function edit_laporan_laba_rugi($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');
        $data['row'] = $this->db->get_where('data_laporan', ['id_laporan' => $id])->row();

        $tgl_awal = $this->input->post('tgl_awal', true);
        $tgl_akhir = $this->input->post('tgl_akhir', true);
        $nama_laporan = $_FILES['nama_laporan']['name'];
        $created_at = $this->input->post('created_at', true);
        $updated_at = $waktu;

        $config['upload_path'] = './assets/laporan';
        $config['allowed_types'] = 'pdf';

        if (!empty($nama_laporan)) {
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('nama_laporan')) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-info-circle"></i> Data laporan <strong>gagal </strong>ditambahkan. (pastikan format file pdf)
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('kirim/laba_rugi');
            } else {
                $nama_laporan = $this->upload->data('file_name');
            }
            $dataUpdate = array(
                'tgl_awal' => $tgl_awal,
                'tgl_akhir' => $tgl_akhir,
                'nama_laporan' => $nama_laporan,
                'created_at' => $created_at,
                'updated_at' => $waktu
            );
        } else {
            $dataUpdate = array(
                'tgl_awal' => $tgl_awal,
                'tgl_akhir' => $tgl_akhir,
                // 'nama_laporan' => $nama_laporan,
                'created_at' => $created_at,
                'updated_at' => $waktu
            );
        }

        $this->db->where('id_laporan', $id);
        $this->db->update('data_laporan_laba_rugi', $dataUpdate);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data laporan <strong>berhasil </strong>diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('kirim/laba_rugi');
    }

    public function neraca()
    {
        $data['title'] = 'Data Laporan Neraca';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['rows'] = $this->db->get('data_laporan_neraca')->result();
        // $data['rows'] = $this->M_Kirim->getLaporanLabaRugi()->result();
        // $data['last_id'] = $this->db->query("SELECT MAX(id_laporan) as last_id FROM data_laporan_laba_rugi")->row();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('data_laporan/laporan_neraca', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_laporan_neraca()
    {
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');

        $tgl_awal = $this->input->post('tgl_awal', true);
        $tgl_akhir = $this->input->post('tgl_akhir', true);
        $nama_laporan = $_FILES['nama_laporan'];
        $status = 'proses';
        $feedback = $this->input->post('feedback', true) == '' ? NULL : $this->input->post('feedback', true);
        $created_at = $waktu;
        $updated_at = $this->input->post('updated_at', true) == '' ? NULL : $this->input->post('updated_at', true);

        $config['upload_path'] = './assets/laporan';
        $config['allowed_types'] = 'pdf';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('nama_laporan')) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle"></i> Data laporan <strong>gagal </strong>ditambahkan. (pastikan format file pdf)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('kirim/neraca');
        } else {
            $nama_laporan = $this->upload->data('file_name');
        }

        $data = array(
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'nama_laporan' => $nama_laporan,
            'status' => $status,
            'feedback' => $feedback,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        );

        $this->db->insert('data_laporan_neraca', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data laporan <strong>berhasil </strong>ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('kirim/neraca');
    }

    public function edit_laporan_neraca($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');
        // $data['row'] = $this->db->get_where('data_laporan', ['id_laporan' => $id])->row();

        $tgl_awal = $this->input->post('tgl_awal', true);
        $tgl_akhir = $this->input->post('tgl_akhir', true);
        $nama_laporan = $_FILES['nama_laporan']['name'];
        $created_at = $this->input->post('created_at', true);
        $updated_at = $waktu;

        $config['upload_path'] = './assets/laporan';
        $config['allowed_types'] = 'pdf';

        if (!empty($nama_laporan)) {
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('nama_laporan')) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-info-circle"></i> Data laporan <strong>gagal </strong>ditambahkan. (pastikan format file pdf)
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('kirim/neraca');
            } else {
                $nama_laporan = $this->upload->data('file_name');
            }
            $dataUpdate = array(
                'tgl_awal' => $tgl_awal,
                'tgl_akhir' => $tgl_akhir,
                'nama_laporan' => $nama_laporan,
                'created_at' => $created_at,
                'updated_at' => $waktu
            );
        } else {
            $dataUpdate = array(
                'tgl_awal' => $tgl_awal,
                'tgl_akhir' => $tgl_akhir,
                // 'nama_laporan' => $nama_laporan,
                'created_at' => $created_at,
                'updated_at' => $waktu
            );
        }

        $this->db->where('id_laporan', $id);
        $this->db->update('data_laporan_neraca', $dataUpdate);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data laporan <strong>berhasil </strong>diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('kirim/neraca');
    }
}
