<?php
session_start();
include "../koneksi.php";

//ADD
if (isset($_POST['update'])) {
    $keterangan = $_POST['keterangan'];

    $query = "UPDATE rekening SET keterangan = '$keterangan'";
    $execute = $conn->query($query);

    header("location:../views/rekening/form.php");
}

//ADD Pembayaran POV pelanggan
if (isset($_POST['bayar'])) {
    $id_pelanggan  = $_SESSION['auth']['id'];
    $id_kamar      = $_POST['id_kamar'];
    $tanggal_bayar = date("Y-m-d");
    $periode_bayar = date("Y-m");
    // $kode_random   = uniqid();

    $foto_bukti = $_FILES['bukti_pembayaran']['name'];
    $file_bukti = $_FILES['bukti_pembayaran']['tmp_name'];
    move_uploaded_file($file_bukti, "../assets/uploads/pembayaran/$foto_bukti");
    // $kode_foto = date("Ymd") . $kode_random . $foto_bukti;

    $query = "INSERT INTO pembayaran VALUES(NULL, '$id_pelanggan', '$id_kamar', '$tanggal_bayar', '$periode_bayar', '$foto_bukti', 'baru')";
    $execute = $conn->query($query);
    if ($execute) {
        header("location:../views/page/dashboard.php");
    } else {
        header("location:../views/pemesanan/transaksi.php");
    }
}

//GANTI STATUS POV ADMIN
if (isset($_GET['status'])) {
    $id_pembayaran = $_GET['status'];
    $type          = $_GET['type'];

    $query = "UPDATE pembayaran SET status = '$type' WHERE id = '$id_pembayaran'";
    $execute = $conn->query($query);

    if ($type == "diterima") {
        $pembayaran_select = "SELECT * FROM pembayaran WHERE id = '$id_pembayaran'";
        $execute = $conn->query($pembayaran_select);
        $see = mysqli_fetch_assoc($execute);

        $id_user  = $see['id_pelanggan'];
        $id_kamar = $see['id_kamar'];
        $tanggal_masuk = date("Y-m-d");

        $query2 = "UPDATE user SET
        id_kamar_user = '$id_kamar',
        tanggal_masuk = '$tanggal_masuk',
        status_user   = 'aktif'
        WHERE id = '$id_user'";
        $execute2 = $conn->query($query2);

        $query3 = "UPDATE kamar SET status = 'Terisi' WHERE id = '$id_kamar'";
        $execute3 = $conn->query($query3);

        header("location:../views/pembayaran/data.php");
    } else {
        $query = "UPDATE pembayaran SET status = '$type' WHERE id = '$id_pembayaran'";
        $execute = $conn->query($query);
        header("location:../views/pembayaran/data.php");
    }
}

//AJUKAN PERPANJANGAN
if (isset($_POST['ajukan'])) {
    $id_pelanggan  = $_POST['id_pelanggan'];
    $id_kamar      = $_POST['id_kamar'];
    $tanggal_bayar = date("Y-m-d");
    $periode_bayar = date("Y-m");

    $foto_bukti = $_FILES['bukti_pembayaran']['name'];
    $file_bukti = $_FILES['bukti_pembayaran']['tmp_name'];
    move_uploaded_file($file_bukti, "../assets/uploads/pembayaran/$foto_bukti");

    $query = "INSERT INTO pembayaran VALUES(NULL, '$id_pelanggan', '$id_kamar', '$tanggal_bayar', '$periode_bayar', '$foto_bukti', 'baru')";
    $execute = $conn->query($query);
    if ($execute) {
        header("location:../views/page/dashboard.php");
    } else {
        header("location:../views/pemesanan/transaksi.php");
    }
}
