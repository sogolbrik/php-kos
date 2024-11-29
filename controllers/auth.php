<?php
session_start();
include '../koneksi.php';


// REGISTER
if (isset($_POST['register'])) {
    $username       = $_POST['username'];
    $email          = $_POST['email'];
    $password       = $_POST['password'];
    $ulang_password = $_POST['ulang_password'];

    if ($password == $ulang_password) {

        // CEK EMAIL
        $query = "SELECT * FROM user WHERE email= '$email'";
        $execute = $conn->query($query);

        if ($execute->num_rows > 0) {
            echo "EMAIL SUDAH TERDAFTAR";
            header('location:../views/auth/register.php');
        } else {

            // ENKRIPSI PASSWORD
            $password_enkripsi = password_hash($password, PASSWORD_BCRYPT);

            // proses memasukkan user baru
            $query = "INSERT INTO user VALUES(NULL, NULL, '$username', '$email', '$password_enkripsi', NULL, '', 'pelanggan')";
            $execute = $conn->query($query);

            $_SESSION['auth'] = [
                'id'          => $conn->insert_id,
                'username'    => $username,
                'email'       => $email,
                'password'    => $password,
                'level'       => "pelanggan",
                'status_user' => "",
                'id_kamar'    => "",
            ];

            header('location:../views/page/dashboard.php');
        }
    } else {
        echo "PASSWORD SALAH";
        header('location:../views/auth/register.php');
    }
}

//LOGIN
if (isset($_POST['login'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $query = $conn->query("SELECT * FROM user WHERE email = '$email' OR username = '$email'");
    if (mysqli_num_rows($query) === 1) {

        // cek password
        $panah = mysqli_fetch_assoc($query);
        if (password_verify($password, $panah['password'])) {

            $_SESSION['auth'] = [
                'id'            => $panah['id'],
                'username'      => $panah['username'],
                'email'         => $panah['email'],
                'password'      => $panah['password'],
                'level'         => $panah['level'],
                'id_kamar_user' => $panah['id_kamar_user'],
                'status_user'   => $panah['status_user']
            ];

            header('location:../views/page/dashboard.php');
            // echo "berhasil";
        } else {
            // echo "tidak berhasil";
            header('location:../views/auth/login.php');
        }
    } else {
        header('location:../views/auth/login.php');
        // echo "email tidak ditemukan";
    }
}

// LOG OUT
if (isset($_GET['logout'])) {
    session_destroy();

    header('location:../views/auth/login.php');
}

// SETTING USER
if (isset($_POST['change_profile'])) {
    $id             = $_SESSION['auth']['id'];
    $username       = $_POST['username'];
    $email          = $_POST['email'];
    $password       = $_POST['password'];
    $ulang_password = $_POST['ulang_password'];

    $password       = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $query = "UPDATE user SET
    username       = '$username',
    email          = '$email',
    password       = '$password'
    WHERE id       = '$id'
    ";
    $execute = $conn->query($query);


    $_SESSION['auth'] = [
        'id'       => $id,
        'username' => $username,
        'email'    => $email,
        'password' => $password,
        'level'    => $_SESSION['auth']['level'],
    ];

    header("location:../views/auth/profile.php");
}

// HAPUS AKUN & KAMAR
