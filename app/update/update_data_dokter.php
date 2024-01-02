<?php
include('../../conf/config_poliklinik.php');
$id = $_GET['id'];
$nama = $_GET['nama'];
$alamat = $_GET['alamat'];
$no_hp = $_GET['no_hp'];
$nama_poli = $_GET['nama_poli'];

$query = mysqli_query($koneksi,"UPDATE dokter SET nama='$nama', alamat='$alamat', no_hp='$no_hp', id_poli='$nama_poli' WHERE dokter.id='$id'");
if (!$query) {
    die('Error: ' . mysqli_error($koneksi));
}
header('Location: ../index.php?page=data-dokter')
?>