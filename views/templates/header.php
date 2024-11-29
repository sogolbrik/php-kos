<?php
session_start();

if (empty($_SESSION['auth'])) {
    header("location:../auth/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/bootstrap//css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../../assets/fontawesome/css/all.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../page/dashboard.php">18th-kos</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php if ($_SESSION['auth']['level'] == "admin") { ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../kamar/data.php">Kamar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../pembayaran/data.php">Pembayaran</a>
                        </li>
                    <?php } ?>

                    <?php if ($_SESSION['auth']['level'] == "pelanggan") { ?>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="../page/informasi_pelanggan.php">Informasi Kamar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="../pemesanan/data.php">Pesan Kamar</a>
                            </li>
                    <?php } ?>

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../auth/profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active position-absolute top-0 end-0 mt-1" href="../../controllers/auth.php?logout=true"><i class="bi bi-box-arrow-right fs-4"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>