<?php
include('../../conf/config_poliklinik.php');

// Get the dokter ID based on the name
$nama_dokter = $_POST['hidden_nama'];
$queryDokter = mysqli_query($koneksi, "SELECT id FROM dokter WHERE nama = '$nama_dokter'");
$dokter = mysqli_fetch_assoc($queryDokter);
$id_dokter = $dokter['id'];

$hari = $_POST['hari'];
$jam_mulai = $_POST['jam_mulai'];
$jam_selesai = $_POST['jam_selesai'];
$status = $_POST['status'];

$query = mysqli_query($koneksi, "INSERT INTO jadwal_periksa (id_dokter, hari, jam_mulai, jam_selesai, aktif) VALUES ('$id_dokter', '$hari', '$jam_mulai', '$jam_selesai', '$status')");

if (!$query) {
    die('Error: ' . mysqli_error($koneksi));
}
header('Location: ../dokter.php?page=data-jadwal-periksa');
?>