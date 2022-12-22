<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petugas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Penjualan');
        $this->load->model('M_Barang');
        $this->load->library('form_validation');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard - Petugas Penjualan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $tanggalHariIni = date('Y-m-d');
        // $brilink = $this->db->query("SELECT * FROM brilink WHERE tanggal = '$tanggalHariIni'")->result();
        $brilink = $this->M_Penjualan->getProfitBrilink()->result();
        $penjualan = $this->M_Penjualan->getProfitHariIni()->result();
        $penjualanHariIni = 0;
        $profitHariIni = 0;
        $profitBrilink = 0;
        foreach ($penjualan as $penj) {
            $penjualanHariIni += $penj->total;
            $profit = $penj->profit * $penj->jumlah;
            $profitHariIni += $profit;
        }
        foreach ($brilink as $row) {
            $profitBrilink += $row->biaya_admin;
        }

        $data['barang'] = $this->M_Barang->getJumlahBarang()->num_rows();
        $data['barang_kosong'] = $this->db->query('SELECT COUNT(nama_barang) AS jml FROM barang WHERE stok <= 5')->result();
        $data['penjualan'] = $penjualanHariIni;
        $data['profit'] = $profitHariIni + $profitBrilink;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('petugas/index', $data);
        $this->load->view('templates/footer');
    }

    public function profile()
    {
        $data['title'] = 'Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('petugas/profile', $data);
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
            $this->load->view('templates/sidebar_petugas', $data);
            $this->load->view('petugas/edit_profile', $data);
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
                    redirect('petugas/editProfile');
                    // echo $this->upload->display_errors();
                }
            } else {
                $dataUpdate = array(
                    'nama_lengkap' => $nama_lengkap,
                    'alamat' => $alamat,
                    'no_hp' => $no_hp
                );
                // $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                // <i class="fas fa-info-circle"></i> Foto <strong> gagal </strong>diubah.(format gambar jpg, jpeg dan png)
                // <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                //     <span aria-hidden="true">&times;</span>
                // </button>
                // </div>');
                // redirect('petugas/editProfile');
            }

            $this->db->set($dataUpdate);
            $this->db->where('email', $email);
            $this->db->update('user');
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Profile <strong> berhasil </strong>diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('petugas/profile');
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
            'required' => 'Password baru wajib diisi!',
            'min_length' => 'Password terlalu pendek, minimal 8 karakter!'
        ]);
        $this->form_validation->set_rules('new_password2', 'Konfirmasi Password', 'required|trim|matches[new_password1]', [
            'required' => 'Konfirmasi Password wajib diisi!',
            'matches' => 'Konfirmasi password salah!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_petugas', $data);
            $this->load->view('petugas/ubah_password', $data);
            $this->load->view('templates/footer');
        } else {
            $currentPassword = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (!password_verify($currentPassword, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-info-circle"></i> Password lama yang anda masukkan <strong>salah.</strong>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('petugas/ubahPassword');
            } else {
                if ($currentPassword == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle"></i> Password baru <strong>tidak boleh sama</strong> dengan password lama!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('petugas/ubahPassword');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle"></i> Password <strong>berhasil </strong>diubah.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('petugas/ubahPassword');
                }
            }
        }
    }

    public function listUser()
    {
        $recordUser = $this->M_Portal->getDataUser();
        $DATA = array('data_user' => $recordUser);

        $judul['title'] = 'Data User';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $judul);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/list_user', $DATA);
        $this->load->view('templates/footer');
    }

    public function AksiDeleteData($id)
    {
        $this->M_Portal->DeleteDataUser($id);
        redirect(base_url('admin/listUser'));
    }

    public function brilink()
    {
        $data['title'] = 'Transaksi BRILink';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['rows'] = $this->db->query("SELECT * FROM brilink WHERE deleted_at = 'NULL' ORDER BY tanggal DESC")->result();
        // $data['rows'] = $this->db->get_where('brilink', ['deleted_at' => NULL, 'tanggal ASC'])->result();
        $data['rows'] = $this->M_Penjualan->getTransaksiBrilink()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('petugas/brilink', $data);
        $this->load->view('templates/footer');
    }

    public function brilink_by_tanggal()
    {
        $data['title'] = 'Transaksi BRILink';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['rows'] = $this->db->query("SELECT * FROM brilink WHERE deleted_at = 'NULL' ORDER BY tanggal DESC")->result();
        // $data['rows'] = $this->db->get_where('brilink', ['deleted_at' => NULL, 'tanggal ASC'])->result();
        $data['rows'] = $this->M_Penjualan->getTransaksiBrilink_by_tanggal()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('petugas/brilink', $data);
        $this->load->view('templates/footer');
    }

    public function insertTransaksiBrilink()
    {
        $hilangRp = str_replace('Rp', '', $this->input->post('nominal_transaksi'));
        $nominal_transaksi = str_replace('.', '', $hilangRp);
        $hilangRp2 = str_replace('Rp', '', $this->input->post('biaya_admin'));
        $biaya_admin = str_replace('.', '', $hilangRp2);
        $dataInsert = [
            'tanggal' => $this->input->post('tanggal'),
            'nominal_transaksi' => $nominal_transaksi,
            'biaya_admin' => $biaya_admin,
            'id_user' => $this->input->post('id_user')
        ];

        if ($biaya_admin > $nominal_transaksi) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> Data <strong>gagal </strong>disimpan. Biaya admin melebihi nominal transaksi
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('petugas/brilink');
        } else {

            $this->db->insert('brilink', $dataInsert);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> Data <strong>berhasil </strong>disimpan.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('petugas/brilink');
        }
    }

    public function editTransaksiBrilink()
    {
        $id = $this->input->post('id');
        $hilangRp = str_replace('Rp', '', $this->input->post('nominal_transaksi'));
        $nominal_transaksi = str_replace('.', '', $this->input->post('nominal_transaksi'));
        $hilangRp2 = str_replace('Rp', '', $hilangRp);
        $biaya_admin = str_replace('.', '', $hilangRp2);

        if ($nominal_transaksi >= 20000) {
            $dataEdit = array(
                'tanggal' => $this->input->post('tanggal'),
                'nominal_transaksi' => $nominal_transaksi,
                'biaya_admin' => $biaya_admin
            );

            $this->db->where('id', $id);
            $this->db->update('brilink', $dataEdit);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data <strong>berhasil </strong>diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('petugas/brilink');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data <strong>gagal </strong>diubah. Nominal transaksi minimal Rp 20.000
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('petugas/brilink');
        }
    }

    public function hapusTransaksiBrilink($id)
    {
        // date_default_timezone_set('Asia/Jakarta');
        // $waktu = date('Y-m-d H:i:s');
        // $this->db->set('deleted_at', $waktu);
        $this->db->where('id', $id);
        $this->db->delete('brilink');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data <strong>berhasil </strong>dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('petugas/brilink');
    }
}
