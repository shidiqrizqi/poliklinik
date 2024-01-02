<?php
include('../../conf/config_poliklinik.php');
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];
$nama_poli = $_POST['nama_poli'];

$query = mysqli_query($koneksi,"INSERT INTO dokter (id,nama,alamat,no_hp,id_poli) VALUES ('','$nama','$alamat','$no_hp','$nama_poli')");
if (!$query) {
    die('Error: ' . mysqli_error($koneksi));
}
header('Location: ../index.php?page=data-dokter')
?>