<?php
session_start();
include('config_poliklinik.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_ktp = $_POST['no_ktp'];
    $no_hp = $_POST['no_hp'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate input
    if (empty($nama) || empty($alamat) || empty($no_ktp) || empty($no_hp) || empty($password) || empty($confirmPassword)) {
        header('Location:../index.php?page=register-pasien&error=3'); // Empty input error
        exit();
    }

    if ($password !== $confirmPassword) {
        header('Location:../index.php?page=register-pasien&error=4'); // Password mismatch error
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //Input otomatis no_rm
    date_default_timezone_set('Asia/Jakarta');

    $auto = mysqli_query($koneksi, "SELECT max(no_rm) AS max_code FROM pasien");
    $data = mysqli_fetch_array($auto);
    $code = $data['max_code'];
    $urutan = (int)substr($code, 8, 3);
    $urutan++;

    $date = date('Ym');
    $kd_noRM = $date."-".sprintf("%03s", $urutan);

    // Insert user into the database
    $query = mysqli_query($koneksi, "INSERT INTO pasien (nama, alamat, no_ktp, no_hp, no_rm, password) VALUES ('$nama', '$alamat', '$no_ktp', '$no_hp', '$kd_noRM', '$hashedPassword')");
    if (!$query) {
        die('Error: ' . mysqli_error($koneksi));
    }
    if ($query) {
        $_SESSION['nama'] = $nama;
        header("Location:../app/pasien.php"); // Successful registration, redirect to pasien.php
        exit();
    } else {
        header('Location:../index.php?page=register-pasien&error=5'); // Database error
        exit();
    }
} else {
    // Handle non-POST requests (optional)
    header('Location:../index.php?page=register-pasien');
    exit();
}
?>