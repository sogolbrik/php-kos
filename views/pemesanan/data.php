<?php
include "../templates/header.php" ?>
<style>
    .ukuran-sama {
        aspect-ratio: 3/2;
        object-fit: cover;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <h3 class="text-center mb-3">Silahkan Pesan Kamar Yang Tersedia!</h3>
        <div class="w-100"></div>
        <?php
        include "../../koneksi.php";

        $query = "SELECT * FROM kamar ORDER BY status DESC";
        $execute = $conn->query($query);

        while ($see = mysqli_fetch_assoc($execute)) :
        ?>
            <div class="col-md-4 mt-4 mb-2">
                <div class="card">
                    <img src="../../assets/uploads/kamar/<?= $see['gambar'] ?>" class="card-img-top ukuran-sama">
                    <div class="card-body">
                        <h5 class="card-title"><?= $see['nama'] ?> <?php if ($see['status'] == "Terisi") : ?>
                                <small class="text-danger"><b>Ditempati</b></small>
                            <?php endif ?>
                        </h5>
                        <p class="card-text">Harga: <?= $see['harga'] ?></p>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detail<?= $see['id'] ?>">
                            Detail
                        </button>
                    </div>
                </div>
            </div>
        <?php endwhile ?>
    </div>
</div>

<?php
$query = "SELECT * FROM kamar";
$execute = $conn->query($query);
while ($lihat = mysqli_fetch_assoc($execute)) :
?>
    <div class="modal fade" id="detail<?= $lihat['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Kamar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <b>Gambar</b>
                            <img src="../../assets/uploads/kamar/<?= $lihat['gambar'] ?>" width="200">
                        </div>
                        <div class="col-md-6">
                            <b>Fasilitas Kamar</b>
                            <p><i class="fa-solid fa-bed"></i> Kasur, Bantal, Guling</p>
                            <p><i class="bi bi-table"></i> Lemari Baju</p>
                            <p><i class="fa-solid fa-wifi"></i> Wi-Fi</p>
                            <p><i class="fa-solid fa-bolt-lightning"></i> Listrik</p>
                            <b>Fasilitas Kamar Mandi</b>
                            <p><i class="fa-solid fa-bath"></i> K. Mandi Dalam</p>
                            <p><i class="fa-solid fa-shower"></i> Shower</p>
                            <p><i class="fa-solid fa-sink"></i> Wastafel</p>
                        </div>
                        <div class="col-md-6">
                            <b>Harga</b>
                            <p><?= $lihat['harga'] ?></p>
                        </div>
                        <div class="col-md-6">
                            <b>Status</b>
                            <p><?= $lihat['status'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php if ($lihat['status'] == "Tersedia") : ?>
                        <?php
                        $status_user = $_SESSION['auth']['status_user'];
                        if ($status_user == "aktif") : ?>
                            <small class="text-danger"><b>Anda Sudah Memiliki Kamar!</b></small>
                        <?php else : ?>
                            <a href="transaksi.php?pay=<?= $lihat['id'] ?>" class="btn btn-success">Pesan</a>
                        <?php endif ?>
                    <?php endif ?>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endwhile ?>

<?php include "../templates/footer.php" ?>