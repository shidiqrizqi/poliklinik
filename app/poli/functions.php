<?php
function getLatestNoAntrian($id_jadwal, $koneksi) {
    $query = mysqli_query($koneksi, "SELECT MAX(no_antrian) AS max_no_antrian FROM daftar_poli WHERE id_jadwal = '$id_jadwal'");
    $row = mysqli_fetch_assoc($query);
    return $row['max_no_antrian'] ? $row['max_no_antrian'] : 0;
}
?>