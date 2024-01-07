<?php
include('../../conf/config_poliklinik.php');
$id = $_GET['id'];
$hari = $_GET['hari'];
$jam_mulai = $_GET['jam_mulai'];
$jam_selesai = $_GET['jam_selesai'];
$status = $_GET['status'];

$query = mysqli_query($koneksi,"UPDATE jadwal_periksa SET hari='$hari', jam_mulai='$jam_mulai', jam_selesai='$jam_selesai', aktif='$status' WHERE jadwal_periksa.id='$id'");
if (!$query) {
    die('Error: ' . mysqli_error($koneksi));
}
header('Location: ../dokter.php?page=data-jadwal-periksa');
?>