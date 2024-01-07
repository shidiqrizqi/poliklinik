<?php
include('../../conf/config_poliklinik.php');

// Check if 'id' parameter is set and is a valid number
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Use prepared statement to avoid SQL injection
    $query = mysqli_prepare($koneksi, "DELETE FROM jadwal_periksa WHERE jadwal_periksa.id = ?");
    mysqli_stmt_bind_param($query, "i", $id);
    mysqli_stmt_execute($query);

    // Check if the query was successful
    if (mysqli_stmt_affected_rows($query) > 0) {
        header('Location: ../dokter.php?page=data-jadwal-periksa');
        exit();
    } else {
        die('Error: Jadwal tidak bisa dihapus karena sudah di input pada daftar poli');
    }

    // Close the prepared statement
    mysqli_stmt_close($query);
} else {
    die('Error: Invalid or missing "id" parameter');
}
?>