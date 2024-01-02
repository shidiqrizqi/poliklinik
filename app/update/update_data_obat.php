<?php
include('../../conf/config_poliklinik.php');
$id = $_GET['id'];
$nama_obat = $_GET['nama_obat'];
$kemasan = $_GET['kemasan'];
$harga = $_GET['harga'];

$query = mysqli_query($koneksi,"UPDATE obat SET nama_obat='$nama_obat', kemasan='$kemasan', harga='$harga' WHERE id='$id'");
if (!$query) {
    die('Error: ' . mysqli_error($koneksi));
}
header('Location: ../index.php?page=data-obat')
?>