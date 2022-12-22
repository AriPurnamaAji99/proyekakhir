<?php
function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    }
    // } else {
    //     $role_id = $ci->session->userdata('role_id');
    //     $menu = $ci->uri->segment(2);

    //     $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
    //     $menu_id = $queryMenu['id'];

    //     $userAccess = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);

    //     if ($userAccess->num_rows() < 1) {
    //         redirect('auth/blocked');
    //     }
    // }
}

function getKodePenjualan()
{
    $ci = &get_instance();
    date_default_timezone_set('Asia/Jakarta');
    $ambilTanggalSekarang = date('dmy');
    $cekKodePenjualan = $ci->db->get('penjualan')->num_rows();
    if ($cekKodePenjualan > 0) {
        $kodePenjualan = $ci->db->query('SELECT MAX(kode_penjualan) AS KP FROM penjualan WHERE date(tanggal) = CURDATE()')->row();
        $noUrut = substr($kodePenjualan->KP, 9, 4) + 1;
        $kodePenjualanBaru = sprintf('%04s', $noUrut);
    } else {
        $kodePenjualanBaru = '0001';
    }
    return 'KDP' . $ambilTanggalSekarang . $kodePenjualanBaru;
}
