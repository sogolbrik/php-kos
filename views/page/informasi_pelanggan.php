<?php include "../templates/header.php"; ?>

<?php
include "../../koneksi.php";

$query = "SELECT * FROM user";
$execute = $conn->query($query);
$see = mysqli_fetch_assoc($execute);

$id_kamar_user = $_SESSION['auth']['id_kamar_user'];

if (isset($id_kamar_user) == "") {
    echo "
    <script src='../../assets/javascript/jquery.js'></script>
    <script>
        $(document).ready(function() {
            alert('Maaf Anda Belum Mempunyai Kamar Di Kos Ini!!');
        });
    </script>
    ";
} else {
?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <?php

                        $id_pelanggan = $_SESSION['auth']['id'];
                        $query = "SELECT * FROM kamar WHERE id = '$id_kamar_user'";
                        $execute = $conn->query($query);
                        $see = mysqli_fetch_assoc($execute)
                        ?>
                        <img src="../../assets/uploads/kamar/<?= $see['gambar'] ?>" width="100%" height="100%">
                    </div>
                    <h5 class="text-center"><?= $see['nama'] ?></h5>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <?php

                        $id = $_SESSION['auth']['id'];
                        $query = "SELECT * FROM user INNER JOIN kamar ON user.id_kamar_user = kamar.id WHERE user.id = '$id'";
                        $execute = $conn->query($query);
                        while ($see = mysqli_fetch_assoc($execute)) :
                        ?>
                            <div class="row g-6">
                                <div class="col-6">
                                    <h5>Nama: </h5><?= $see['username'] ?>
                                </div>
                                <div class="col-6">
                                    <h5>Kamar: </h5><?= $see['nama'] ?>
                                </div>
                                <div class="col-6">
                                    <h5>Tanggal Masuk: </h5><?= $see['tanggal_masuk'] ?>
                                </div>
                                <div class="col-6 mb-4">
                                    <h5>Status User: </h5><?= $see['status_user'] ?>
                                </div>
                                <div>
                                    <hr>
                                </div>
                                <div class="col-6 mt-3">
                                    <?php
                                    $id = $_SESSION['auth']['id'];
                                    $query = "SELECT * FROM pembayaran WHERE id_pelanggan = '$id'";
                                    $execute = $conn->query($query);
                                    $see = mysqli_fetch_assoc($execute);

                                    $tanggal_sekarang = date("Y-m-d");
                                    $jatuh_tempo = date("Y-m-d", strtotime($see['tanggal_bayar'] . ' +1 month'));

                                    if ($tanggal_sekarang >= $jatuh_tempo) : ?>
                                        <h5>Perpanjangan: </h5> <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ajukan">
                                            Ajukan
                                        </button>
                                    <?php endif ?>
                                </div>
                            </div>
                        <?php endwhile ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4 mb-3">
                <div class="card shadow">
                    <h4 class="card-title text-center">Data Transaksi</h4>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Periode Pembayaran</th>
                                    <th>Status Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id = $_SESSION['auth']['id'];
                                $query = "SELECT * FROM pembayaran WHERE id_pelanggan = '$id' ";
                                $execute = $conn->query($query);
                                $no = 1;
                                while ($see = mysqli_fetch_assoc($execute)) :
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#bukti<?= $see['id'] ?>">
                                                Gambar
                                            </button>
                                        </td>
                                        <td><?= $see['tanggal_bayar'] ?></td>
                                        <td><?= $see['periode_bayar'] ?></td>
                                        <td><?= $see['status'] ?></td>
                                    </tr>
                                <?php endwhile ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ajukan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajukan Perpanjangan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    $id = $_SESSION['auth']['id'];
                    $query = "SELECT * FROM rekening";
                    $execute = $conn->query($query);
                    $see = mysqli_fetch_assoc($execute);

                    $lihat = tampil_satu("user", "WHERE id = '$id'")
                    ?>
                    <div class="card shadow">
                        <div class="card-body">
                            <form action="../../controllers/pembayaran.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id_pelanggan" value="<?= $lihat['id'] ?>">
                                <input type="hidden" name="id_kamar" value="<?= $lihat['id_kamar_user'] ?>">
                                <pre><?= $see['keterangan'] ?></pre>
                                <label>Bukti Pembayaran:</label>
                                <input type="file" class="form-control" name="bukti_pembayaran">
                                <button name="ajukan" class="btn btn-secondary mt-2">Bayar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    $query = "SELECT * FROM pembayaran";
    $execute = $conn->query($query);
    while ($lihat = mysqli_fetch_assoc($execute)) :
    ?>
        <div class="modal fade" id="bukti<?= $lihat['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Pembayaran</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <img src="../../assets/uploads/pembayaran/<?= $lihat['bukti_pembayaran'] ?>" width="100%" height="100%">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile ?>

<?php } ?>

<?php include "../templates/footer.php"; ?>