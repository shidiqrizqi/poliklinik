<?php
session_start();
include('config_poliklinik.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $nama_poli = $_POST['nama_poli'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate input
    if (empty($nama) || empty($alamat) || empty($no_hp) || empty($nama_poli) || empty($password) || empty($confirmPassword)) {
        header('Location:../index.php?page=register-dokter&error=3'); // Empty input error
        exit();
    }

    if ($password !== $confirmPassword) {
        header('Location:../index.php?page=register-dokter&error=4'); // Password mismatch error
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $query = mysqli_query($koneksi, "INSERT INTO dokter (nama, alamat, no_hp, id_poli, password) VALUES ('$nama', '$alamat', '$no_hp', '$nama_poli', '$hashedPassword')");
    if (!$query) {
        die('Error: ' . mysqli_error($koneksi));
    }
    if ($query) {
        header('Location:../index.php?page=login-dokter&success=1'); // Successful registration, redirect to login
        exit();
    } else {
        header('Location:../index.php?page=register-dokter&error=5'); // Database error
        exit();
    }
} else {
    // Handle non-POST requests (optional)
    header('Location:../index.php?page=register-dokter');
    exit();
}
?>