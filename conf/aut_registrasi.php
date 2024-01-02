<?php
session_start();
include('config_admin.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate input
    if (empty($username) || empty($password) || empty($confirmPassword)) {
        header('Location:../index.php?page=register-admin&error=3'); // Empty input error
        exit();
    }

    if ($password !== $confirmPassword) {
        header('Location:../index.php?page=register-admin&error=4'); // Password mismatch error
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $query = mysqli_query($koneksi, "INSERT INTO admin_user (username, password) VALUES ('$username', '$hashedPassword')");
    if (!$query) {
        die('Error: ' . mysqli_error($koneksi));
    }
    if ($query) {
        header('Location:../index.php?page=login-admin&success=1'); // Successful registration, redirect to login
        exit();
    } else {
        header('Location:../index.php?page=register-admin&error=5'); // Database error
        exit();
    }
} else {
    // Handle non-POST requests (optional)
    header('Location:../index.php?page=register-admin');
    exit();
}
?>