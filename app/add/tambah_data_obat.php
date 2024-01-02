<?php
include('../../conf/config_poliklinik.php');
$nama_obat = $_POST['nama_obat'];
$kemasan = $_POST['kemasan'];
$harga = $_POST['harga'];

$query = mysqli_query($koneksi,"INSERT INTO obat (id,nama_obat,kemasan,harga) VALUES ('','$nama_obat','$kemasan','$harga')");
if (!$query) {
    die('Error: ' . mysqli_error($koneksi));
}
header('Location: ../index.php?page=data-obat')
?>