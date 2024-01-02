<?php 
include('../conf/config_poliklinik.php');

$poliId = isset($_GET['poli_id']) ? $_GET['poli_id'] : null;

$dataJadwal = mysqli_query($koneksi, "SELECT a.nama as nama_dokter,
                                        b.hari as hari,
                                        b.id as id_jp,
                                        b.jam_mulai as jam_mulai,
                                        b.jam_selesai as jam_selesai
                                        FROM dokter as a
                                        INNER JOIN jadwal_periksa as b
                                        ON a.id = b.id_dokter
                                        WHERE a.id_poli = '$poliId'");

if (!$dataJadwal) {
    die('Query error: ' . mysqli_error($koneksi));
}

if (mysqli_num_rows($dataJadwal) == 0) {
    echo '<option value="">Tidak ada jadwal</option>';
} else {
    while ($jd = mysqli_fetch_array($dataJadwal)) {
        echo '<option value="'.$jd['id_jp'].'"> Dokter '.$jd['nama_dokter'] . ' | ' . $jd['hari'] . ' | ' . $jd['jam_mulai'] . ' - ' . $jd['jam_selesai'] .'</option>';
    }
}
?>