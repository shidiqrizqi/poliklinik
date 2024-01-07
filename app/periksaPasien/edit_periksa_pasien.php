<?php
require '../../conf/config_poliklinik.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idDaftarPoli = $_POST['id'];
    $tgl_Periksa = $_POST['tanggal_periksa'];
    $catatan = $_POST['catatan'];

    $queryUpdate = mysqli_query($koneksi, "UPDATE periksa SET tgl_periksa = '$tgl_Periksa', catatan = '$catatan' WHERE id_daftar_poli = '$idDaftarPoli'");
    if ($queryUpdate) {
        echo '<script>alert("Data berhasil diubah");window.location.href="../dokter.php?page=data-periksa-pasien"</script>';
    } else {
        echo '<script>alert("Data gagal diubah");window.location.href="../dokter.php?page=data-periksa-pasien"</script>';
    }
}