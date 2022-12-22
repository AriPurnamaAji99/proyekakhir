<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengawas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'download'));
        is_logged_in();
        $this->load->model('M_Penjualan');
        $this->load->model('M_Barang');
        $this->load->model('M_Pengawas');
        $this->load->model('M_Laporan');
    }

    public function index()
    {
        $data['title'] = 'Dashboard - Pengawas';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $pengeluaran = $this->M_Pengawas->getPengeluaran()->result();
        $brilink = $this->M_Pengawas->getProfitBrilink()->result();
        $penjualan = $this->M_Pengawas->getProfit()->result();

        $Totpenjualan = 0;
        $TotPengeluaran = 0;
        $Totprofit = 0;
        $nominalTransaksi = 0;
        $profitBrilink = 0;
        foreach ($penjualan as $penj) {
            $Totpenjualan += $penj->total;
            $profit = $penj->profit * $penj->jumlah;
            $Totprofit += $profit;
        }
        foreach ($pengeluaran as $row) {
            $TotPengeluaran += $row->total_harga_beli;
        }
        foreach ($brilink as $row) {
            $nominalTransaksi += $row->nominal_transaksi;
            $profitBrilink += $row->biaya_admin;
        }

        $data['penjualan'] = $Totpenjualan;
        $data['profit_penjualan'] = $Totprofit;
        $data['total_pengeluaran'] = $TotPengeluaran;
        $data['transaksi_brilink'] = $nominalTransaksi;
        $data['profit_brilink'] = $profitBrilink;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_pengawas', $data);
        $this->load->view('pengawas/index', $data);
        $this->load->view('templates/footer');
    }

    public function data_by_tanggal()
    {
        $data['title'] = 'Dashboard - Pengawas';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $pengeluaran = $this->M_Pengawas->getPengeluaranByTanggal()->result();
        $brilink = $this->M_Pengawas->getProfitBrilinkByTanggal()->result();
        $penjualan = $this->M_Pengawas->getProfitByTanggal()->result();

        $Totpenjualan = 0;
        $TotPengeluaran = 0;
        $Totprofit = 0;
        $nominalTransaksi = 0;
        $profitBrilink = 0;
        foreach ($penjualan as $penj) {
            $Totpenjualan += $penj->total;
            $profit = $penj->profit * $penj->jumlah;
            $Totprofit += $profit;
        }
        foreach ($pengeluaran as $row) {
            $TotPengeluaran += $row->total_harga_beli;
        }
        foreach ($brilink as $row) {
            $nominalTransaksi += $row->nominal_transaksi;
            $profitBrilink += $row->biaya_admin;
        }

        $data['penjualan'] = $Totpenjualan;
        $data['profit_penjualan'] = $Totprofit;
        $data['total_pengeluaran'] = $TotPengeluaran;
        $data['transaksi_brilink'] = $nominalTransaksi;
        $data['profit_brilink'] = $profitBrilink;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_pengawas', $data);
        $this->load->view('pengawas/index', $data);
        $this->load->view('templates/footer');
    }

    public function profile()
    {
        $data['title'] = 'Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_pengawas', $data);
        $this->load->view('pengawas/profile', $data);
        $this->load->view('templates/footer');
    }

    public function editProfile()
    {
        $data['title'] = 'Ubah Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama tidak boleh kosong!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_pengawas', $data);
            $this->load->view('pengawas/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $nama_lengkap = $this->input->post('nama_lengkap');
            $alamat = $this->input->post('alamat');
            $no_hp = $this->input->post('no_hp');
            $email = $this->input->post('email');

            // cek jiga ada gambar yang akan di upload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                    $dataUpdate = array(
                        'nama_lengkap' => $nama_lengkap,
                        'alamat' => $alamat,
                        'no_hp' => $no_hp
                    );
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle"></i> Foto <strong> gagal </strong>diubah. Pastikan format file sudah sesuai
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('pengawas/editProfile');
                    // echo $this->upload->display_errors();
                }
            } else {
                $dataUpdate = array(
                    'nama_lengkap' => $nama_lengkap,
                    'alamat' => $alamat,
                    'no_hp' => $no_hp
                );
            }

            $this->db->set($dataUpdate);
            $this->db->where('email', $email);
            $this->db->update('user');
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Profil <strong>berhasil </strong>diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('pengawas/profile');
        }
    }

    public function ubahPassword()
    {
        $data['title'] = 'Ubah Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Password', 'required|trim', [
            'required' => 'Password lama wajib diisi!'
        ]);
        $this->form_validation->set_rules('new_password1', 'Password Baru', 'required|trim|min_length[8]', [

            'min_length' => 'Password terlalu pendek, minimal 8 karakter!',
            'required' => 'Password baru wajib diisi!'
        ]);
        $this->form_validation->set_rules('new_password2', 'Konfirmasi Password', 'required|trim|matches[new_password1]', [
            'required' => ' Konfirmasi password wajib diisi!',
            'matches' => 'Konfirmasi password salah!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_pengawas', $data);
            $this->load->view('pengawas/ubah_password', $data);
            $this->load->view('templates/footer');
        } else {
            $currentPassword = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (!password_verify($currentPassword, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-info-circle"></i> Password lama yang anda masukkan <strong>salah.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('pengawas/ubahPassword');
            } else {
                if ($currentPassword == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle"></i> Password baru <strong>tidak boleh sama</strong> dengan password lama!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('pengawas/ubahPassword');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle"></i> Password <strong>berhasil</strong> diubah.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('pengawas/ubahPassword');
                }
            }
        }
    }

    public function data_laporan()
    {
        $data['title'] = 'Data Laporan Penjualan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['rows'] = $this->db->get('data_laporan')->result();
        $data['rows'] = $this->db->query("SELECT * FROM data_laporan ORDER BY created_at DESC")->result();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_pengawas', $data);
        $this->load->view('pengawas/data_laporan', $data);
        $this->load->view('templates/footer');
    }

    public function success($id)
    {
        $this->db->set('status', 'sukses');
        $this->db->where('id_laporan', $id);
        $this->db->update('data_laporan');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> Status <strong>berhasil </strong>diubah.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('pengawas/data_laporan');
    }

    public function proses($id)
    {
        $this->db->set('status', 'proses');
        $this->db->where('id_laporan', $id);
        $this->db->update('data_laporan');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> Status <strong>berhasil </strong>diubah.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('pengawas/data_laporan');
    }


    public function feedback_penjualan($id)
    {
        $id_laporan = $this->input->post('id_laporan', true);
        $feedback = $this->input->post('feedback', true);

        $data = [
            'id_laporan' => $id_laporan,
            'feedback' => $feedback
        ];

        $this->db->where('id_laporan', $id);
        $this->db->update('data_laporan', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Komentar <strong>berhasil </strong>ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('pengawas/data_laporan');
    }

    public function download_laporan($id)
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['row'] = $this->db->get_where('data_laporan', ['id_laporan' => $id])->row();
        $laporan = $this->db->get_where('data_laporan', ['id_laporan' => $id])->row();

        force_download('assets/laporan/' . $laporan->laporan_penjualan, NULL);
        // 16_REKAP_LEMBUR_TENAN_27_DESEMBER_2021_sd_2_Januari_2022_Sheet_1.pdf
    }

    public function laporan_barang_masuk()
    {
        $data['title'] = 'Data Laporan Barang Masuk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['rows'] = $this->db->get('data_laporan_barang_masuk')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_pengawas', $data);
        $this->load->view('pengawas/data_laporan_barang_masuk', $data);
        $this->load->view('templates/footer');
    }

    public function barang_masuk_success($id)
    {
        $this->db->set('status', 'sukses');
        $this->db->where('id_laporan', $id);
        $this->db->update('data_laporan_barang_masuk');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> Status <strong>berhasil </strong>diubah.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('pengawas/laporan_barang_masuk');
    }

    public function barang_masuk_proses($id)
    {
        $this->db->set('status', 'proses');
        $this->db->where('id_laporan', $id);
        $this->db->update('data_laporan_barang_masuk');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> Status <strong>berhasil </strong>diubah.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('pengawas/laporan_barang_masuk');
    }

    public function feedback_barang_masuk($id)
    {
        $id_laporan = $this->input->post('id_laporan', true);
        $feedback = $this->input->post('feedback', true);

        $data = [
            'id_laporan' => $id_laporan,
            'feedback' => $feedback
        ];

        $this->db->where('id_laporan', $id);
        $this->db->update('data_laporan_barang_masuk', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Komentar <strong>berhasil </strong>ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('pengawas/laporan_barang_masuk');
    }

    public function download_laporan_barang_masuk($id)
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['row'] = $this->db->get_where('data_laporan', ['id_laporan' => $id])->row();
        $laporan = $this->db->get_where('data_laporan_barang_masuk', ['id_laporan' => $id])->row();

        force_download('assets/laporan/' . $laporan->nama_laporan, NULL);
        // 16_REKAP_LEMBUR_TENAN_27_DESEMBER_2021_sd_2_Januari_2022_Sheet_1.pdf
    }

    public function lihat_laporan_barang_masuk($id)
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['row'] = $this->db->get_where('data_laporan', ['id_laporan' => $id])->row();
        $laporan = $this->db->get_where('data_laporan_barang_masuk', ['id_laporan' => $id])->row();

        // header('content-type : application/pdf');
        readfile('assets/laporan/' . $laporan->nama_laporan);
        // 16_REKAP_LEMBUR_TENAN_27_DESEMBER_2021_sd_2_Januari_2022_Sheet_1.pdf
    }

    public function laporan_barang_keluar()
    {
        $data['title'] = 'Data Laporan Barang Keluar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['rows'] = $this->db->get('data_laporan_barang_keluar')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_pengawas', $data);
        $this->load->view('pengawas/data_laporan_barang_keluar', $data);
        $this->load->view('templates/footer');
    }

    public function barang_keluar_success($id)
    {
        $this->db->set('status', 'sukses');
        $this->db->where('id_laporan', $id);
        $this->db->update('data_laporan_barang_keluar');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> Status <strong>berhasil </strong>diubah.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('pengawas/laporan_barang_keluar');
    }

    public function barang_keluar_proses($id)
    {
        $this->db->set('status', 'proses');
        $this->db->where('id_laporan', $id);
        $this->db->update('data_laporan_barang_keluar');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> Status <strong>berhasil </strong>diubah.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('pengawas/laporan_barang_keluar');
    }

    public function feedback_barang_keluar($id)
    {
        $id_laporan = $this->input->post('id_laporan', true);
        $feedback = $this->input->post('feedback', true);

        $data = [
            'id_laporan' => $id_laporan,
            'feedback' => $feedback
        ];

        $this->db->where('id_laporan', $id);
        $this->db->update('data_laporan_barang_keluar', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Komentar <strong>berhasil </strong>ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('pengawas/laporan_barang_keluar');
    }

    public function download_laporan_barang_keluar($id)
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['row'] = $this->db->get_where('data_laporan', ['id_laporan' => $id])->row();
        $laporan = $this->db->get_where('data_laporan_barang_keluar', ['id_laporan' => $id])->row();

        force_download('assets/laporan/' . $laporan->nama_laporan, NULL);
        // 16_REKAP_LEMBUR_TENAN_27_DESEMBER_2021_sd_2_Januari_2022_Sheet_1.pdf
    }

    public function laporan_laba_rugi()
    {
        $data['title'] = 'Data Laporan Laba Rugi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['rows'] = $this->db->get('data_laporan_laba_rugi')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_pengawas', $data);
        $this->load->view('pengawas/data_laporan_laba_rugi', $data);
        $this->load->view('templates/footer');
    }

    public function laba_rugi_success($id)
    {
        $this->db->set('status', 'sukses');
        $this->db->where('id_laporan', $id);
        $this->db->update('data_laporan_laba_rugi');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> Status <strong>berhasil </strong>diubah.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('pengawas/laporan_laba_rugi');
    }

    public function laba_rugi_proses($id)
    {
        $this->db->set('status', 'proses');
        $this->db->where('id_laporan', $id);
        $this->db->update('data_laporan_laba_rugi');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> Status <strong>berhasil </strong>diubah.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('pengawas/laporan_laba_rugi');
    }

    public function feedback_laba_rugi($id)
    {
        $id_laporan = $this->input->post('id_laporan', true);
        $feedback = $this->input->post('feedback', true);

        $data = [
            'id_laporan' => $id_laporan,
            'feedback' => $feedback
        ];

        $this->db->where('id_laporan', $id);
        $this->db->update('data_laporan_laba_rugi', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Komentar <strong>berhasil </strong>ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('pengawas/laporan_laba_rugi');
    }

    public function download_laporan_laba_rugi($id)
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['row'] = $this->db->get_where('data_laporan', ['id_laporan' => $id])->row();
        $laporan = $this->db->get_where('data_laporan_laba_rugi', ['id_laporan' => $id])->row();

        force_download('assets/laporan/' . $laporan->nama_laporan, NULL);
        // 16_REKAP_LEMBUR_TENAN_27_DESEMBER_2021_sd_2_Januari_2022_Sheet_1.pdf
    }

    public function laporan_neraca()
    {
        $data['title'] = 'Data Laporan Neraca';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['rows'] = $this->db->get('data_laporan_neraca')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_pengawas', $data);
        $this->load->view('pengawas/data_laporan_neraca', $data);
        $this->load->view('templates/footer');
    }

    public function neraca_success($id)
    {
        $this->db->set('status', 'sukses');
        $this->db->where('id_laporan', $id);
        $this->db->update('data_laporan_neraca');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> Status <strong>berhasil </strong>diubah.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('pengawas/laporan_neraca');
    }

    public function neraca_proses($id)
    {
        $this->db->set('status', 'proses');
        $this->db->where('id_laporan', $id);
        $this->db->update('data_laporan_neraca');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> Status <strong>berhasil </strong>diubah.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('pengawas/laporan_neraca');
    }

    public function feedback_neraca($id)
    {
        $id_laporan = $this->input->post('id_laporan', true);
        $feedback = $this->input->post('feedback', true);

        $data = [
            'id_laporan' => $id_laporan,
            'feedback' => $feedback
        ];

        $this->db->where('id_laporan', $id);
        $this->db->update('data_laporan_neraca', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Komentar <strong>berhasil </strong>ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('pengawas/laporan_neraca');
    }

    public function download_laporan_neraca($id)
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['row'] = $this->db->get_where('data_laporan', ['id_laporan' => $id])->row();
        $laporan = $this->db->get_where('data_laporan_neraca', ['id_laporan' => $id])->row();

        force_download('assets/laporan/' . $laporan->nama_laporan, NULL);
        // 16_REKAP_LEMBUR_TENAN_27_DESEMBER_2021_sd_2_Januari_2022_Sheet_1.pdf
        redirect('pengawas/laporan_neraca');
    }

    public function listUser()
    {
        $data['title'] = 'Data User';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['data_user'] = $this->db->query("SELECT * FROM user WHERE is_active = 'on' ORDER BY created_at DESC")->result();
        $data['data_user'] = $this->M_Pengawas->user()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_pengawas', $data);
        $this->load->view('pengawas/list_user', $data);
        $this->load->view('templates/footer');
    }

    public function listUserNonAktif()
    {
        $data['title'] = 'Data User';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['data_user'] = $this->db->query("SELECT * FROM user WHERE is_active = 'off' ORDER BY updated_at DESC")->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_pengawas', $data);
        $this->load->view('pengawas/list_user_nonaktif', $data);
        $this->load->view('templates/footer');
    }

    public function AksiDeleteData($id)
    {
        // $this->M_Portal->DeleteDataUser($id);
        $this->db->where('id', $id);
        $this->db->delete('user');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data user <strong>berhasil </strong>dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect(base_url('pengawas/listUser'));
    }

    public function onUser($id)
    {
        $this->db->set('is_active', 'on');
        $this->db->where('id', $id);
        $this->db->update('user');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Status user <strong>berhasil </strong>diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect(base_url('pengawas/listUser'));
    }

    public function offUser($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');

        $this->db->set('is_active', 'off');
        $this->db->set('updated_at', $waktu);
        $this->db->where('id', $id);
        $this->db->update('user');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Status user <strong>berhasil </strong>diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('pengawas/listUserNonAktif');
    }

    public function ubahRole()
    {
        $id = $this->input->post('id');
        $data_update = array(
            'role_id' => $this->input->post('role_id')
        );

        $this->db->set($data_update);
        $this->db->where('id', $id);
        $this->db->update('user');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Role user <strong>berhasil </strong>diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('pengawas/listUser');
    }

    public function penjualan()
    {
        $data['title'] = 'Laporan Penjualan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['rows'] = $this->M_Penjualan->dataPenjualan()->result();
        // $data['rows'] = $this->M_Penjualan->getDataPenjualan()->result();
        $data['rows'] = $this->M_Penjualan->dataPenjualan()->result();
        $data['tgl_awal_max'] = $this->db->query("SELECT MAX(tgl_awal) as tgl_max_awal FROM data_laporan")->row();
        $data['tgl_akhir_max'] = $this->db->query("SELECT MAX(tgl_akhir) as tgl_max_akhir FROM data_laporan")->row();

        $this->form_validation->set_rules('tgl_awal', 'Tanggal Awal', 'trim|required', [
            'required' => 'Tanggal awal harus diisi'
        ]);
        $this->form_validation->set_rules('tgl_akhir', 'Tanggal akhir', 'trim|required', [
            'required' => 'Tanggal akhir harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_pengawas', $data);
            $this->load->view('pengawas/penjualan', $data);
            $this->load->view('templates/footer');
        } else {
            $data['rows'] = $this->M_Laporan->getBerdasarkanTanggal()->result();
            $data['tgl_awal'] = $this->input->post('tgl_awal');
            $data['tgl_akhir'] = $this->input->post('tgl_akhir');
            $data['kategori'] = $this->input->post('kategori');
            $this->load->view('laporan/cetak_penjualan', $data);
        }
    }

    public function data_penjualan_by_tanggal()
    {

        $data['title'] = 'Laporan Penjualan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['rows'] = $this->M_Penjualan->getBerdasarkanTanggal()->result();
        $data['tgl_awal_max'] = $this->db->query("SELECT MAX(tgl_awal) as tgl_max_awal FROM data_laporan")->row();
        $data['tgl_akhir_max'] = $this->db->query("SELECT MAX(tgl_akhir) as tgl_max_akhir FROM data_laporan")->row();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_pengawas', $data);
        $this->load->view('pengawas/penjualan', $data);
        $this->load->view('templates/footer');
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
        $this->load->view('templates/sidebar_pengawas', $data);
        $this->load->view('pengawas/detail_penjualan', $data);
        $this->load->view('templates/footer');
    }

    public function penjualan_by_tanggal()
    {
        $data['title'] = 'Laporan Penjualan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['rows'] = $this->M_Penjualan->dataPenjualan()->result();
        $data['rows'] = $this->M_Penjualan->getDataPenjualanByTanggal()->result();
        $data['tgl_awal_max'] = $this->db->query("SELECT MAX(tgl_awal) as tgl_max_awal FROM data_laporan")->row();
        $data['tgl_akhir_max'] = $this->db->query("SELECT MAX(tgl_akhir) as tgl_max_akhir FROM data_laporan")->row();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_pengawas', $data);
        $this->load->view('laporan/penjualan', $data);
        $this->load->view('templates/footer');
    }

    public function cetak()
    {
        $this->load->library('dompdf_gen');
        $data['title'] = 'Laporan Penjualan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['rows'] = $this->M_Penjualan->dataPenjualan()->result();

        $data['tgl_awal'] = $this->input->post('tgl_awal');
        $data['tgl_akhir'] = $this->input->post('tgl_akhir');
        $data['rows'] = $this->M_Laporan->getBerdasarkanTanggal()->result();
        $this->load->view('laporan/cetak_penjualan', $data);
    }

    // public function struk()
    // {
    //     $data['kode_penjualan'] = $this->uri->segment(3);
    //     $data['penjualan'] = $this->M_Penjualan->getPenjualan()->result();
    //     $data['tanggal_beli'] = $this->db->get_where('penjualan', ['kode_penjualan' => $this->uri->segment(3)])->row();
    //     $data['detail_penjualan'] = $this->db->get_where('detail_penjualan', ['kode_penjualan' => $this->uri->segment(3)])->row();
    //     $this->load->view('penjualan/struk', $data);
    // }

    public function laba_rugi()
    {
        $data['title'] = 'Laporan Laba Rugi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pengeluaran'] = $this->db->get('data_barang_masuk')->result();
        $data['rows'] = $this->db->get('penjualan')->result();
        $data['brilink'] = $this->db->get_where('brilink', ['deleted_at' => NULL])->result();
        $data['beban'] = $this->db->get('data_beban')->result();
        $data['tgl_akhir_max'] = $this->db->query("SELECT MAX(tgl_akhir) as tgl_max_akhir FROM data_laporan_laba_rugi")->row();

        $data['rows'] = $this->M_Laporan->getData()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_pengawas', $data);
        $this->load->view('pengawas/laba_rugi', $data);
        $this->load->view('templates/footer');
    }

    public function data_labarugi_by_tanggal()
    {
        $data['title'] = 'Laporan Laba Rugi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['rows'] = $this->M_Laporan->getBerdasarkanTanggal()->result();
        $data['brilink'] = $this->M_Laporan->brilinkBerdasarkanTanggal()->result();
        $data['pengeluaran'] = $this->M_Laporan->pengeluaranBerdasarkanTanggal()->result();
        $data['beban'] = $this->db->get('data_beban')->result();
        $data['tgl_akhir_max'] = $this->db->query("SELECT MAX(tgl_akhir) as tgl_max_akhir FROM data_laporan_laba_rugi")->row();

        $this->form_validation->set_rules('tgl_awal', 'Tanggal Awal', 'trim|required', [
            'required' => 'Tanggal awal harus diisi'
        ]);
        $this->form_validation->set_rules('tgl_akhir', 'Tanggal akhir', 'trim|required', [
            'required' => 'Tanggal akhir harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_pengawas', $data);
            $this->load->view('pengawas/laba_rugi', $data);
            $this->load->view('templates/footer');
        } else {
            $data['tgl_awal'] = $this->input->post('tgl_awal');
            $data['tgl_akhir'] = $this->input->post('tgl_akhir');
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_pengawas', $data);
            $this->load->view('pengawas/laba_rugi', $data);
            $this->load->view('templates/footer');
        }
    }

    public function cetak_labarugi()
    {
        $this->load->library('dompdf_gen');
        $data['title'] = 'Laporan Laba Rugi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['rows'] = $this->M_Penjualan->dataPenjualan()->result();
        $data['rows'] = $this->M_Laporan->getBerdasarkanTanggal()->result();
        $data['brilink'] = $this->M_Laporan->brilinkBerdasarkanTanggal()->result();
        $data['pengeluaran'] = $this->M_Laporan->pengeluaranBerdasarkanTanggal()->result();
        // $data['pengeluaran'] = $this->db->get('barang')->result();
        // $data['rows'] = $this->db->get('penjualan')->result();
        $data['beban'] = $this->db->get('data_beban')->result();

        $this->form_validation->set_rules('tgl_awal', 'Tanggal Awal', 'trim|required', [
            'required' => 'Tanggal awal harus diisi'
        ]);
        $this->form_validation->set_rules('tgl_akhir', 'Tanggal akhir', 'trim|required', [
            'required' => 'Tanggal akhir harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_pengawas', $data);
            $this->load->view('laporan/laba_rugi', $data);
            $this->load->view('templates/footer');
        } else {
            $data['tgl_awal'] = $this->input->post('tgl_awal');
            $data['tgl_akhir'] = $this->input->post('tgl_akhir');
            $data['rows'] = $this->M_Laporan->getBerdasarkanTanggal()->result();
            $data['pengeluaran'] = $this->M_Laporan->pengeluaranBerdasarkanTanggal()->result();
            $data['beban'] = $this->db->get('data_beban')->result();
            $this->load->view('laporan/cetak_laba_rugi', $data);

            // $paper_size = 'A4';
            // $orientation = 'landscape';
            // $html = $this->output->get_output();
            // $this->dompdf->set_paper($paper_size, $orientation);

            // $this->dompdf->load_html($html);
            // $this->dompdf->render();
            // $this->dompdf->stream("laporan_penjualan.pdf", array('Attachment' => 0));
        }
    }

    public function input_beban()
    {
        $hilangRp = str_replace('Rp', '', $this->input->post('nominal'));
        $nominal = str_replace('.', '', $hilangRp);
        $data_input = array(
            'keterangan' => $this->input->post('keterangan'),
            'nominal' => $nominal
        );

        $this->db->insert('data_beban', $data_input);
        $this->session->set_flashdata('message_beban', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data beban <strong>berhasil </strong>ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('laporan/laba_rugi');
    }

    public function ubah_beban()
    {
        $id_beban = $this->input->post('id_beban');
        $hilangRp = str_replace('Rp', '', $this->input->post('nominal'));
        $nominal = str_replace('.', '', $hilangRp);

        if ($nominal >= 20000) {
            $data_ubah = array(
                'keterangan' => $this->input->post('keterangan'),
                'nominal' => $nominal
            );

            $this->db->where('id_beban', $id_beban);
            $this->db->update('data_beban', $data_ubah);
            $this->session->set_flashdata('message_beban', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data beban <strong>berhasil </strong>diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('laporan/laba_rugi');
        } else {
            $this->session->set_flashdata('message_beban', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data beban <strong>gagal </strong>diubah. Nominal minimal RP 20.000
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('laporan/laba_rugi');
        }
    }

    public function hapus_beban($id_beban)
    {
        $this->db->where('id_beban', $id_beban);
        $this->db->delete('data_beban');
        $this->session->set_flashdata('message_beban', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data beban <strong>berhasil </strong>dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('laporan/laba_rugi');
    }

    public function neraca()
    {
        $data['title'] = 'Laporan Neraca';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['aktiva_lancar'] = $this->db->get('aktiva_lancar')->result();
        $data['aktiva_tetap'] = $this->db->get('aktiva_tetap')->result();
        $data['modal'] = $this->db->get('modal')->result();
        $data['kas'] = $this->db->get_where('aktiva_lancar', ['id_aktiva_lancar' => 1])->row();
        // $data['rows'] = $this->db->get('penjualan')->result();
        // $data['beban'] = $this->db->get('data_beban')->result();

        $data['rows'] = $this->M_Laporan->getData()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_pengawas', $data);
        $this->load->view('laporan/neraca', $data);
        $this->load->view('templates/footer');
    }

    public function input_aktiva_lancar()
    {
        $hilangRp = str_replace('Rp', '', $this->input->post('nominal'));
        $nominal = str_replace('.', '', $hilangRp);
        $data_input = array(
            'nama_aktiva' => $this->input->post('nama_aktiva'),
            'nominal' => $nominal
        );

        $this->db->insert('aktiva_lancar', $data_input);
        $this->session->set_flashdata('message_aktiva_lancar', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data aktiva lancar <strong>berhasil </strong>ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('laporan/neraca');
    }

    public function ubah_aktiva_lancar()
    {
        $id_aktiva_lancar = $this->input->post('id_aktiva_lancar');
        $hilangRp = str_replace('Rp', '', $this->input->post('nominal'));
        $nominal = str_replace('.', '', $hilangRp);

        if ($nominal >= 20000) {
            $data_ubah = array(
                'nama_aktiva' => $this->input->post('nama_aktiva'),
                'nominal' => $nominal
            );

            $this->db->where('id_aktiva_lancar', $id_aktiva_lancar);
            $this->db->update('aktiva_lancar', $data_ubah);
            $this->session->set_flashdata('message_aktiva_lancar', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data aktiva lancar <strong>berhasil </strong>diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('laporan/neraca');
        } else {
            $this->session->set_flashdata('message_aktiva_lancar', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data aktiva lancar <strong>gagal </strong>diubah. Nominal minimal Rp 20.000
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('laporan/neraca');
        }
    }

    public function hapus_aktiva_lancar($id_aktiva_lancar)
    {
        $this->db->where('id_aktiva_lancar', $id_aktiva_lancar);
        $this->db->delete('aktiva_lancar');
        $this->session->set_flashdata('message_aktiva_lancar', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data aktiva lancar <strong>berhasil </strong>dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('laporan/neraca');
    }

    public function input_aktiva_tetap()
    {
        $hilangRp = str_replace('Rp', '', $this->input->post('nominal'));
        $nominal = str_replace('.', '', $hilangRp);
        $data_input = array(
            'nama_aktiva' => $this->input->post('nama_aktiva'),
            'nominal' => $nominal
        );

        $this->db->insert('aktiva_tetap', $data_input);
        $this->session->set_flashdata('message_aktiva_tetap', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data aktiva tetap <strong>berhasil </strong>ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('laporan/neraca');
    }

    public function ubah_aktiva_tetap()
    {
        $id_aktiva_tetap = $this->input->post('id_aktiva_tetap');
        $hilangRp = str_replace('Rp', '', $this->input->post('nominal'));
        $nominal = str_replace('.', '', $hilangRp);
        // $nominal = str_replace('.', '', $this->input->post('nominal'));

        if ($nominal >= 20000) {
            $data_ubah = array(
                'nama_aktiva' => $this->input->post('nama_aktiva'),
                'nominal' => $nominal
            );

            $this->db->where('id_aktiva_tetap', $id_aktiva_tetap);
            $this->db->update('aktiva_tetap', $data_ubah);
            $this->session->set_flashdata('message_aktiva_tetap', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data aktiva tetap <strong>berhasil </strong>diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('laporan/neraca');
        } else {
            $this->session->set_flashdata('message_aktiva_tetap', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data aktiva tetap <strong>gagal </strong>diubah. Nominal minimal Rp 20.000
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('laporan/neraca');
        }
    }

    public function hapus_aktiva_tetap($id_aktiva_tetap)
    {
        $this->db->where('id_aktiva_tetap', $id_aktiva_tetap);
        $this->db->delete('aktiva_tetap');
        $this->session->set_flashdata('message_aktiva_tetap', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data aktiva tetap <strong>berhasil </strong>dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('laporan/neraca');
    }

    public function input_modal()
    {
        $hilangRp = str_replace('Rp', '', $this->input->post('nominal'));
        $nominal = str_replace('.', '', $hilangRp);
        $data_input = array(
            'keterangan' => $this->input->post('keterangan'),
            'nominal' => $nominal
        );

        $this->db->insert('modal', $data_input);
        $this->session->set_flashdata('message_modal', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data modal <strong>berhasil </strong>ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('laporan/neraca');
    }

    public function ubah_modal()
    {
        $id_modal = $this->input->post('id_modal');
        // $nominal = str_replace('.', '', $this->input->post('nominal'));
        $hilangRp = str_replace('Rp', '', $this->input->post('nominal'));
        $nominal = str_replace('.', '', $hilangRp);

        if ($nominal >= 20000) {
            $data_ubah = array(
                'keterangan' => $this->input->post('keterangan'),
                'nominal' => $nominal
            );

            $this->db->where('id_modal', $id_modal);
            $this->db->update('modal', $data_ubah);
            $this->session->set_flashdata('message_modal', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data <strong>berhasil </strong>diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('laporan/neraca');
        } else {
            $this->session->set_flashdata('message_modal', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data <strong>berhasil </strong>diubah. Nominal minimal Rp 20.000
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('laporan/neraca');
        }
    }

    public function hapus_modal($id_modal)
    {
        $this->db->where('id_modal', $id_modal);
        $this->db->delete('modal');
        $this->session->set_flashdata('message_modal', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data aktiva tetap <strong>berhasil </strong>dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('laporan/neraca');
    }

    public function cetak_neraca()
    {
        $this->load->library('dompdf_gen');
        $data['title'] = 'Laporan Neraca';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['aktiva_lancar'] = $this->db->get('aktiva_lancar')->result();
        $data['aktiva_tetap'] = $this->db->get('aktiva_tetap')->result();
        $data['modal'] = $this->db->get('modal')->result();
        $data['kas'] = $this->db->get_where('aktiva_lancar', ['id_aktiva_lancar' => 1])->row();
        $this->load->view('laporan/cetak_neraca', $data);

        // $paper_size = 'A4';
        // $orientation = 'landscape';
        // $html = $this->output->get_output();
        // $this->dompdf->set_paper($paper_size, $orientation);

        // $this->dompdf->load_html($html);
        // $this->dompdf->render();
        // $this->dompdf->stream("laporan_penjualan.pdf", array('Attachment' => 0));

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
            $this->load->view('templates/sidebar_pengawas', $data);
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
            $this->load->view('templates/sidebar_pengawas', $data);
            $this->load->view('barang/barang_keluar', $data);
            $this->load->view('templates/footer');
        } else {
            $data['rows'] = $this->M_Barang->getBerdasarkanTanggal()->result();
            $data['tgl_awal'] = $this->input->post('tgl_awal');
            $data['tgl_akhir'] = $this->input->post('tgl_akhir');
            $this->load->view('barang/cetak_barang_keluar', $data);
        }
    }
}
