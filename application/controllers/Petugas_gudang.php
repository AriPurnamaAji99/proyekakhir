<?php
defined('BASEPATH') or exit('No direct script access allowed');

class petugas_gudang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Portal');
        $this->load->model('M_Barang');
        $this->load->model('M_Supplier');
        $this->load->model('M_Kategori');
        $this->load->library('form_validation');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard - Petugas Gudang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['rows'] = $this->db->query("SELECT SUM(IF(kategori = 'sembako',1,0)) as jml_sembako, SUM(IF(kategori = 'minuman',1,0)) as jml_minuman FROM barang");
        // $data['barang_kosong'] = $this->db->query("SELECT COUNT(nama_barang) AS jml FROM barang WHERE deleted_at = NULL" )->result();
        $data['barang'] = $this->M_Barang->getJumlahBarang()->num_rows();
        $data['supplier'] = $this->M_Supplier->getJumlahSupplier()->num_rows();
        $data['kategori'] = $this->M_Kategori->getJumlahKategori()->num_rows();
        $data['satuan'] = $this->M_Kategori->getJumlahSatuan()->num_rows();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas_gudang', $data);
        $this->load->view('petugas_gudang/index', $data);
        $this->load->view('templates/footer');
    }

    public function profile()
    {
        $data['title'] = 'Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas_gudang', $data);
        $this->load->view('petugas_gudang/profile', $data);
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
            $this->load->view('templates/sidebar_petugas_gudang', $data);
            $this->load->view('petugas_gudang/edit', $data);
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
                    redirect('petugas_gudang/editProfile');
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
            redirect('petugas_gudang/profile');
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
            'required' => 'Konfirmasi password wajib diisi!',
            'matches' => 'Konfirmasi password salah'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_petugas_gudang', $data);
            $this->load->view('petugas_gudang/ubah_password', $data);
            $this->load->view('templates/footer');
        } else {
            $currentPassword = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (!password_verify($currentPassword, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-info-circle"></i> Password lama yang anda masukkan <strong>salah</strong>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('petugas_gudang/ubahPassword');
            } else {
                if ($currentPassword == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle"></i> Password baru <strong>tidak boleh sama</strong> dengan password lama!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('petugas_gudang/ubahPassword');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> Password <strong>berhasil </strong>diubah.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('petugas_gudang/ubahPassword');
                }
            }
        }
    }
}
