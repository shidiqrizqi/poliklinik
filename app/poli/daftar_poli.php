<?php
session_start();

include('../../conf/config_poliklinik.php');
include('functions.php');

$id_pasien = $_POST['id_pasien'];
$no_rm = $_POST['no_rm'];
$queryFetchIdPasien = mysqli_query($koneksi, "SELECT id FROM pasien WHERE no_rm = '$no_rm'");

$id_jadwal = $_POST['id_jadwal'];
$keluhan = $_POST['keluhan'];
$no_antrian = getLatestNoAntrian($id_jadwal, $koneksi) + 1;

if ($row = mysqli_fetch_assoc($queryFetchIdPasien)) {
    $id_pasien = $row['id'];

    $queryInsertDaftarPoli = mysqli_query($koneksi, "INSERT INTO daftar_poli (id_pasien, id_jadwal, keluhan, no_antrian) VALUES ('$id_pasien', '$id_jadwal', '$keluhan', '$no_antrian')");

    if (!$queryInsertDaftarPoli) {
        die('Error: ' . mysqli_error($koneksi));
    }

    $_SESSION['success_message'] = 'Berhasil mendaftar poli';
    
    header('Location: ../pasien.php?page=data-poli');
} else {
    echo 'No_rm not found in the pasien table.';
}
?>