<?php
session_start();
include '../koneksi.php';

//ADD DATA
if (isset($_POST['create'])) {
    $nama   = $_POST['nama'];
    $harga  = $_POST['harga'];

    $file_name = $_FILES['gambar']['name'];
    $file      = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($file, "../assets/uploads/kamar/$file_name");

    $query = "INSERT INTO kamar VALUES(NULL, '$nama', '$harga',  '$file_name', 'Tersedia')";

    $execute = $conn->query($query);

    $_SESSION['bedroom'] = [
        'id'       => $conn->insert_id
    ];

    if ($execute) {
        header('location:../views/kamar/data.php');
    } else {
        header('location:../views/kamar/form.php');
    }
}

//DELETE DATA
if (isset($_GET['delete'])) {
    $id     = $_GET['delete'];
    $gambar = $_GET['gambar'];

    unlink("../assets/uploads/kamar/$gambar");

    $query = "DELETE FROM kamar WHERE id = '$id'";
    $execute = $conn->query($query);
    header('location:../views/kamar/data.php');
}

//EDIT DATA
if (isset($_POST['update'])) {
    $id     = $_POST['id'];
    $nama   = $_POST['nama'];
    $harga  = $_POST['harga'];
    $status = $_POST['status'];

    if (empty($_FILES['gambar']['name'])) {
        $query = "UPDATE kamar SET
        nama     = '$nama',
        harga    = '$harga',
        status   = '$status'
        WHERE id = '$id'
        ";
    } else {
        $file_name = $_FILES['gambar']['name'];
        $file      = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($file, "../assets/uploads/kamar/$file_name");

        $query = "UPDATE kamar SET
        nama     = '$nama',
        harga    = '$harga',
        status   = '$status',
        gambar   = '$file_name'
        WHERE id = '$id'
        ";
    }
    // var_dump($query);
    // echo "<pre>";
    // var_dump($_FILES);
    $execute = $conn->query($query);

    if ($execute) {
        header('location:../views/kamar/data.php');
    } else {
        header('location:../views/kamar/form.php');
    }
}


//STATUS KAMAR
$query = "SELECT * FROM pembayaran WHERE status = 'Terisi'";