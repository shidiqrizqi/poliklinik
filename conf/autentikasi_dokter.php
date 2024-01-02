<?php
session_start();
include('config_poliklinik.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $password = $_POST['password'];

    // Validate input
    if (empty($nama) || empty($password)) {
        header('Location:../index.php?page=login-dokter&error=2'); // Empty input error
        exit();
    }

    if (!$password) {
        header('Location:../index.php?page=login-dokter&error=1'); // Password mismatch error
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $query = mysqli_query($koneksi, "SELECT * FROM dokter WHERE nama='$nama' AND password='$hashedPassword'");
    if (!$query) {
        die('Error: ' . mysqli_error($koneksi));
    }
    if ($query) {
        $_SESSION['nama'] = $nama;
        header("Location:../app/dokter.php"); // Successful login, redirect to dashboard
        exit();
    } else {
        header('Location:../index.php?page=login-dokter&error=1'); // Database error
        exit();
    }
} else {
    // Handle non-POST requests (optional)
    header('Location:../index.php?page=login-dokter');
    exit();
}
?>