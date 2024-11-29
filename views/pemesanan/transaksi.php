<?php include "../templates/header.php" ?>

<h1 class="text-center mt-2">Transaksi</h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <a href="data.php" class="btn btn-outline-dark btn-sm m-2"> back</i></a>
            <div class="card shadow">
                <div class="card-body">
                    <?php
                    include "../../koneksi.php";
                    $id_kamar = $_GET['pay'];
                    $query = "SELECT * FROM rekening";
                    $execute = $conn->query($query);
                    $see = mysqli_fetch_assoc($execute);
                    ?>
                    <form action="../../controllers/pembayaran.php" method="POST" enctype="multipart/form-data">
                        <pre><?= $see['keterangan'] ?></pre>
                        <input type="hidden" name="id_kamar" value="<?= $id_kamar ?>">
                        <label>Bukti Pembayaran:</label>
                        <input type="file" class="form-control" name="bukti_pembayaran">
                        <button name="bayar" class="btn btn-secondary mt-2">Bayar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>