<?php
include('../../conf/config_poliklinik.php');
// Check if 'id' parameter is set and is a valid number
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    //Hapus catatan terkait di tabel detail_periksa dulu
    $queryDeleteDetailPeriksa = "DELETE FROM detail_periksa WHERE id_obat = ?";
    $stmtDetailPeriksa = $koneksi->prepare($queryDeleteDetailPeriksa);
    $stmtDetailPeriksa->bind_param("i", $id);

    //Jalankan penghapusan detail_periksa
    $stmtDetailPeriksa->execute();
    $stmtDetailPeriksa->close();

    //Lanjut dengan penghapusan obat
    $queryDeleteObat = "DELETE FROM obat WHERE id = ?";
    $stmtObat = $koneksi->prepare($queryDeleteObat);
    $stmtObat->bind_param("i", $id);

    //Jalankan penghapusan obat
    if ($stmtObat->execute()) {
        // Penghapusan obat berhasil
        // Bersihkan output buffer
        ob_clean();
  
        // Redirect kembali ke halaman utama atau tampilkan pesan keberhasilan
        header("Location: ../index.php?page=data-obat");
        exit();
    } else {
        // Penghapusan obat gagal, tangani kesalahan
        die('Error: Unable to delete record');
    }
  
    // Tutup prepared statement
    $stmtObat->close();
} else {
    die('Error: Invalid or missing "id" parameter');
}
?>