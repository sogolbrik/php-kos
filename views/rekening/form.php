<?php include "../templates/header.php"; ?>
<br>
<div class="container">
    <div class="row gx-5">
        <div class="card shadow">
            <div class="card-body">
                <?php
                include "../../koneksi.php";

                $query = "SELECT * FROM rekening";
                $execute = $conn->query($query);
                $lihat = mysqli_fetch_assoc($execute);
                ?>
                <form action="../../controllers/pembayaran.php" method="POST">
                    <label>Keterangan:</label>
                    <textarea name="keterangan" class="form-control col p-4"><?= $lihat['keterangan'] ?></textarea><br>
                    <button name=" update" class="btn btn-success btn-sm">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "../templates/footer.php"; ?>