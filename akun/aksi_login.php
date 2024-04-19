<?php
include ("../config.php");

// Mulai sesi
session_start();

// Ambil nilai username dan password dari formulir login
$username = $_POST['username'];
$password = $_POST['password'];

// Kueri SQL untuk memeriksa keberadaan username dan password dalam tabel users
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $sql);

// Periksa apakah ada baris yang cocok
if (mysqli_num_rows($result) > 0) {
    // Izinkan akses
    echo "<script>alert('Login berhasil!');</script>";

    // Simpan username ke dalam sesi
    $_SESSION['username'] = $username;

    // Redirect ke halaman setelah login
    header("Location: ../index.php");
} else {
    // Tampilkan pesan kesalahan menggunakan alert box
    echo "<script>alert('Username atau password salah.');</script>";

    // Redirect ke halaman login dengan pesan kesalahan
    header("Location: login.php?error=1");
}
?>
