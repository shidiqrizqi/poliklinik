<?php
include('../../conf/config_poliklinik.php');

// Check if 'id' parameter is set and is a valid number
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Use prepared statement to avoid SQL injection
    $query = mysqli_prepare($koneksi, "DELETE FROM dokter WHERE dokter.id = ?");
    mysqli_stmt_bind_param($query, "i", $id);
    mysqli_stmt_execute($query);

    // Check if the query was successful
    if (mysqli_stmt_affected_rows($query) > 0) {
        header('Location: ../index.php?page=data-dokter');
        exit();
    } else {
        die('Error: Unable to delete record');
    }

    // Close the prepared statement
    mysqli_stmt_close($query);
} else {
    die('Error: Invalid or missing "id" parameter');
}
?>