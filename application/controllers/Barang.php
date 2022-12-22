<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Barang');
        $this->load->model('M_Penjualan');
        $this->load->library('form_validation');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Data Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['rows'] = $this->M_Barang->getBarang()->result();
        $data['modal_barang'] = $this->db->get('modal')->result();
        // $data['modal_barang'] = $this->db->query('SELECT SUM(nominal) FROM modal')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas_gudang', $data);
        $this->load->view('barang/barang', $data);
        $this->load->view('templates/footer');
    }

    public function stok()
    {
        $data['title'] = 'Stok Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['rows'] = $this->M_Barang->getBarang()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas_gudang', $data);
        $this->load->view('barang/stok_barang', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_stok($kode_barang)
    {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d');

        $stok = $this->input->post('stok', true);
        $harga_satuan = $this->input->post('harga_satuan', true);
        $total_harga_beli = $harga_satuan * $stok;
        $data = [
            'kode_barang' => $this->input->post('kode_barang', true),
            // 'nama_barang' => $this->input->post('nama_barang', true),
            'stok' => $stok,
            'total_harga_beli' => $total_harga_beli,
            // 'harga_satuan' => $harga_satuan,
            // 'harga_jual' => $this->input->post('harga_jual', true),
            // 'profit' => $this->input->post('profit', true),
            // 'id_satuan' => $this->input->post('id_satuan', true),
            // 'id_kategori' => $this->input->post('id_kategori', true),
            // 'id_supplier' => $this->input->post('id_supplier', true),
            'tanggal_masuk' => $tanggal
        ];

        $tambah = "stok +" . $stok;
        $this->db->set('stok', $tambah, false);
        $this->db->where('kode_barang', $kode_barang);
        $this->db->update('barang');
        $this->db->insert('data_barang_masuk', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Stok <strong>berhasil </strong>ditambahkan
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('barang/stok');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Data Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['supplier'] = $this->db->get_where('supplier', ['deleted_at' => NULL])->result();
        $data['satuan'] = $this->db->get_where('satuan_barang', ['deleted_at' => NULL])->result();
        $data['kategori'] = $this->db->get_where('kategori_barang', ['deleted_at' => NULL])->result();
        $data['modal_barang'] = $this->db->get('modal')->result();

        $this->form_validation->set_rules('nama_barang', 'Nama', 'trim|required', [
            'required' => 'Nama barang tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'trim|required', [
            'required' => 'Stok tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('total_harga_beli', 'Harga Beli', 'trim|required', [
            'required' => 'Harga beli tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('harga_jual', 'Harga jual', 'trim|required', [
            'required' => 'Harga jual tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal', 'trim|required', [
            'required' => 'Tanggal barang tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $cekKodeBarang = $this->db->get('barang')->num_rows();
            if ($cekKodeBarang == 0) {
                $kodeBarang = 'KDB0000';
                $noUrut = substr($kodeBarang, 3, 4);
                $kodeBarangBaru = $noUrut + 1;
            } else {
                $kodeBarang = $this->M_Barang->getKodeBarang()->row();
                $noUrut = substr($kodeBarang->KD, 3, 4);
                $kodeBarangBaru = $noUrut + 1;
            }
            $data['kode_barang'] = $kodeBarangBaru;

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_petugas_gudang', $data);
            $this->load->view('barang/tambah_barang', $data);
            $this->load->view('templates/footer');
        } else {
            $hilangRp = str_replace('Rp', '', $this->input->post('profit'));
            $profit = str_replace('.', '', $hilangRp);
            if ($profit < 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-info-circle"></i> Profit tidak boleh kurang dari Rp.0
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('barang/tambah');
            } else {
                $hilangRp1 = str_replace('Rp', '', $this->input->post('total_harga_beli', true));
                $hilangRp2 = str_replace('Rp', '', $this->input->post('harga_satuan'));
                $hilangRp3 = str_replace('Rp', '', $this->input->post('harga_jual'));
                // $hilangRp4 = str_replace('Rp', '', $this->input->post('profit'));
                $nama_barang = $this->input->post('nama_barang', true);
                $total_harga_beli = str_replace('.', '', $hilangRp1);
                $data = [
                    'kode_barang' => $this->input->post('kode_barang', true),
                    'nama_barang' => $nama_barang,
                    'stok' => $this->input->post('stok', true),
                    'total_harga_beli' => $total_harga_beli,
                    'harga_satuan' => str_replace('.', '', $hilangRp2),
                    'harga_jual' => str_replace('.', '', $hilangRp3),
                    'profit' => $profit,
                    'id_satuan' => $this->input->post('id_satuan', true),
                    'id_kategori' => $this->input->post('id_kategori', true),
                    'id_supplier' => $this->input->post('id_supplier', true)
                ];
                $data_barang_masuk = [
                    'kode_barang' => $this->input->post('kode_barang', true),
                    'stok' => $this->input->post('stok', true),
                    'total_harga_beli' => $total_harga_beli,
                    'tanggal_masuk' => $this->input->post('tanggal_masuk', true)
                ];
                $cek = $this->db->query("SELECT * FROM barang WHERE nama_barang = '$nama_barang'")->num_rows();
                if ($cek == 0) {
                    if ($total_harga_beli != 0) {
                        $this->db->insert('barang', $data);
                        $this->db->insert('data_barang_masuk', $data_barang_masuk);
                        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> Data <strong>berhasil </strong>ditambahkan
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');
                        redirect('barang');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> Data <strong>gagal </strong>ditambahkan. Nominal harga beli yang dimasukkan 0
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');
                        redirect('barang');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> Data <strong>gagal </strong>ditambahkan. Nama barang sudah ada
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('barang');
                }
            }
        }
    }

    public function edit($kode_barang)
    {
        $data['title'] = 'Ubah Data Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['supplier'] = $this->db->get_where('supplier', ['deleted_at' => NULL])->result();
        $data['satuan'] = $this->db->get_where('satuan_barang', ['deleted_at' => NULL])->result();
        $data['kategori'] = $this->db->get_where('kategori_barang', ['deleted_at' => NULL])->result();
        $data['row'] = $this->db->get_where('barang', ['kode_barang' => $kode_barang])->row();

        $this->form_validation->set_rules('nama_barang', 'Nama', 'trim|required', [
            'required' => 'Nama barang tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'trim|required', [
            'required' => 'Stok tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('total_harga_beli', 'Harga Beli', 'trim|required', [
            'required' => 'Harga beli tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('harga_jual', 'Harga jual', 'trim|required', [
            'required' => 'Harga jual tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $cekKodeBarang = $this->db->get('barang')->num_rows();
            if ($cekKodeBarang == 0) {
                $kodeBarang = 'KDB0000';
                $noUrut = substr($kodeBarang, 3, 4);
                $kodeBarangBaru = $noUrut + 1;
            } else {
                $kodeBarang = $this->M_Barang->getKodeBarang()->row();
                $noUrut = substr($kodeBarang->KD, 3, 4);
                $kodeBarangBaru = $noUrut + 1;
            }
            $data['kode_barang'] = $kodeBarangBaru;

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_petugas_gudang', $data);
            $this->load->view('barang/edit_barang', $data);
            $this->load->view('templates/footer');
        } else {
            $hilangRp2 = str_replace('Rp', '', $this->input->post('harga_satuan', true));
            $harga_satuan = str_replace('Rp', '', $hilangRp2);
            $hilangRp3 = str_replace('Rp', '', $this->input->post('harga_jual', true));
            $harga_jual = str_replace('Rp', '', $hilangRp3);
            $jumlah = $harga_jual - $harga_satuan;
            $hilangRp2nya = str_replace('Rp', '', $this->input->post('total_harga_beli', true));
            $total_harga_beli = str_replace('Rp', '', $hilangRp2nya);
            $stok = $this->input->post('stok', true);

            if ($jumlah > 0) {
                if ($stok > 0) {
                    if ($total_harga_beli != 0) {
                        $this->M_Barang->edit();
                        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> Data <strong>berhasil </strong>diubah
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                        redirect('barang');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> Data <strong>gagal </strong>ditambahkan. Nominal harga beli yang dimasukkan 0
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');
                        redirect('barang');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> Data <strong>gagal </strong>diubah. stok tidak boleh 0
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('barang');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> Data <strong>gagal </strong>diubah. Profit tidak boleh kurang
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('barang');
            }
        }
    }

    public function hapus($kode_barang)
    {
        // $this->db->where('kode_barang', $kode_barang);
        // $this->db->delete('barang');
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');
        $this->db->set('deleted_at', $waktu);
        $this->db->where('kode_barang', $kode_barang);
        $this->db->update('barang');
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data <strong>berhasil </strong>dihapus
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        }
        redirect('barang');
    }

    public function barang_masuk()
    {
        $data['title'] = 'Laporan Barang Masuk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['rows'] = $this->M_Barang->getBarangMasuk()->result();

        $this->form_validation->set_rules('tgl_awal', 'Tanggal Awal', 'trim|required', [
            'required' => 'Tanggal awal harus diisi'
        ]);
        $this->form_validation->set_rules('tgl_akhir', 'Tanggal akhir', 'trim|required', [
            'required' => 'Tanggal akhir harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_petugas_gudang', $data);
            $this->load->view('barang/barang_masuk', $data);
            $this->load->view('templates/footer');
        } else {
            $data['rows'] = $this->M_Barang->getBerdasarkanTanggal()->result();
            $data['tgl_awal'] = $this->input->post('tgl_awal');
            $data['tgl_akhir'] = $this->input->post('tgl_akhir');
            $this->load->view('barang/cetak_barang_masuk', $data);
        }
    }

    public function barang_keluar()
    {
        $data['title'] = 'Laporan Barang Keluar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['rows'] = $this->M_Barang->getBarangKeluar()->result();

        $this->form_validation->set_rules('tgl_awal', 'Tanggal Awal', 'trim|required', [
            'required' => 'Tanggal awal harus diisi'
        ]);
        $this->form_validation->set_rules('tgl_akhir', 'Tanggal akhir', 'trim|required', [
            'required' => 'Tanggal akhir harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            // $data['rows'] = $this->M_Barang->getBarangKeluar()->result();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_petugas_gudang', $data);
            $this->load->view('barang/barang_keluar', $data);
            $this->load->view('templates/footer');
        } else {
            $data['rows'] = $this->M_Barang->getBerdasarkanTanggal()->result();
            $data['tgl_awal'] = $this->input->post('tgl_awal');
            $data['tgl_akhir'] = $this->input->post('tgl_akhir');
            $this->load->view('barang/cetak_barang_keluar', $data);
        }
    }

    public function cetak()
    {
        $this->load->library('dompdf_gen');
        $data['title'] = 'Laporan Barang Masuk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['rows'] = $this->M_Barang->getBarang()->result();
        $data['rows'] = $this->M_Barang->getBarangMasuk()->result();

        $this->form_validation->set_rules('tgl_awal', 'Tanggal Awal', 'trim|required', [
            'required' => 'Tanggal awal harus diisi'
        ]);
        $this->form_validation->set_rules('tgl_akhir', 'Tanggal akhir', 'trim|required', [
            'required' => 'Tanggal akhir harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_petugas_gudang', $data);
            $this->load->view('barang/barang_masuk', $data);
            $this->load->view('templates/footer');
        } else {
            $data['rows'] = $this->M_Barang->getBerdasarkanTanggal()->result();
            $data['tgl_awal'] = $this->input->post('tgl_awal');
            $data['tgl_akhir'] = $this->input->post('tgl_akhir');
            $this->load->view('barang/cetak_barang_masuk', $data);

            // $paper_size = 'A4';
            // $orientation = 'landscape';
            // $html = $this->output->get_output();
            // $this->dompdf->set_paper($paper_size, $orientation);

            // $this->dompdf->load_html($html);
            // $this->dompdf->render();
            // $this->dompdf->stream("laporan_penjualan.pdf", array('Attachment' => 0));
        }
    }

    public function cetak_barang_keluar()
    {
        $this->load->library('dompdf_gen');
        $data['title'] = 'Laporan Barang Keluar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('tgl_awal', 'Tanggal Awal', 'trim|required', [
            'required' => 'Tanggal awal harus diisi'
        ]);
        $this->form_validation->set_rules('tgl_akhir', 'Tanggal akhir', 'trim|required', [
            'required' => 'Tanggal akhir harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_petugas_gudang', $data);
            $this->load->view('barang/barang_keluar', $data);
            $this->load->view('templates/footer');
        } else {
            $data['rows'] = $this->M_Barang->getBerdasarkanTanggalPenjualan()->result();
            $data['tgl_awal'] = $this->input->post('tgl_awal');
            $data['tgl_akhir'] = $this->input->post('tgl_akhir');
            $this->load->view('barang/cetak_barang_keluar', $data);

            // $paper_size = 'A4';
            // $orientation = 'landscape';
            // $html = $this->output->get_output();
            // $this->dompdf->set_paper($paper_size, $orientation);

            // $this->dompdf->load_html($html);
            // $this->dompdf->render();
            // $this->dompdf->stream("laporan_penjualan.pdf", array('Attachment' => 0));
        }
    }

    public function modal()
    {
        $data['title'] = 'Modal Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['rows'] = $this->db->get('modal')->result();
        $data['rows'] = $this->M_Barang->get_data_modal()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas_gudang', $data);
        $this->load->view('barang/modal_barang', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_data_modal()
    {
        $dataInsert = [
            'tanggal' => $this->input->post('tanggal', true),
            'nominal' => $this->input->post('nominal', true),
            'keterangan' => $this->input->post('keterangan', true) == '' ? NULL : $this->input->post('keterangan', true)
        ];

        $this->db->insert('modal', $dataInsert);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Modal <strong>berhasil </strong>ditambahkan
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('barang/modal');
    }

    public function ubah_data_modal()
    {
        $id_modal = $this->input->post('id_modal');
        $tanggal = $this->input->post('tanggal');
        $nominal = $this->input->post('nominal');
        $keterangan = $this->input->post('keterangan') == '' ? NULL : $this->input->post('keterangan');

        $dataUpdate = array(
            'tanggal' => $tanggal,
            'nominal' => $nominal,
            'keterangan' => $keterangan
        );

        $this->db->where('id_modal', $id_modal);
        $this->db->update('modal', $dataUpdate);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data <strong>berhasil </strong>diubah
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('barang/modal');
    }
}
