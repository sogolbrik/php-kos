<?php include "../templates/header.php"; ?>

<h1 class="text-center">DATA PEMBAYARAN</h1>
<div class="container">
    <div class="row">
        <div class="card shadow">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>ID Kamar</th>
                        <th>Tanggal Bayar</th>
                        <th>Periode Bayar</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                        <th>Bukti Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../../koneksi.php';

                    $query = "SELECT *, pembayaran.status AS status_pembayaran, pembayaran.id AS id_pembayaran FROM pembayaran INNER JOIN user ON pembayaran.id_pelanggan = user.id INNER JOIN kamar ON pembayaran.id_kamar = kamar.id ORDER BY status_pembayaran ASC";
                    $execute = $conn->query($query);
                    $no = 1;
                    while ($see = mysqli_fetch_assoc($execute)) {

                    ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $see['username'] ?></td>
                            <td><?php echo $see['nama'] ?></td>
                            <td><?php echo $see['tanggal_bayar'] ?></td>
                            <td><?php echo $see['periode_bayar'] ?></td>
                            <td>
                                <?php
                                $jatuh_tempo = date("Y-m-d", strtotime($see['tanggal_bayar'] . ' +1 month'));
                                echo "$jatuh_tempo";
                                ?>
                            </td>
                            <td>
                                <?php if ($see['status_pembayaran'] == "baru") : ?>
                                    <span class="badge text-bg-info">Baru</span>
                                <?php elseif ($see['status_pembayaran'] == "diterima") : ?>
                                    <span class="badge text-bg-primary">Diterima</span>
                                <?php elseif ($see['status_pembayaran'] == "selesai") : ?>
                                    <span class="badge text-bg-success">Selesai</span>
                                <?php endif ?>
                            </td>
                            <td><button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#bukti<?= $see['id_pembayaran'] ?>">
                                    Gambar
                                </button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$query = "SELECT *, pembayaran.status AS status_pembayaran, pembayaran.id AS id_pembayaran FROM pembayaran INNER JOIN user ON pembayaran.id_pelanggan = user.id INNER JOIN kamar ON pembayaran.id_kamar = kamar.id";
$execute = $conn->query($query);
while ($lihat = mysqli_fetch_assoc($execute)) :
?>
    <div class="modal fade" id="bukti<?= $lihat['id_pembayaran'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Pembayaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="../../assets/uploads/pembayaran/<?= $lihat['bukti_pembayaran'] ?>" width="100%" height="100%">
                    <h5>Nama: <?= $lihat['username'] ?></h5>
                    <h5>Kamar: <?= $lihat['nama'] ?></h5>
                    <h5>Tanggal Bayar: <?= $lihat['tanggal_bayar'] ?></h5>
                    <h5>Periode Bayar: <?= $lihat['periode_bayar'] ?></h5>
                    <div class="modal-footer">
                        <?php if ($lihat['status_pembayaran'] == "baru") : ?>
                            <a href="../../controllers/pembayaran.php?status=<?= $lihat['id_pembayaran'] ?>&type=diterima" type="button" class="btn btn-primary">Diterima</a>
                            <a href="../../controllers/pembayaran.php?status=<?= $lihat['id_pembayaran'] ?>&type=ditolak" type="button" class="btn btn-danger">Ditolak</a>
                        <?php elseif ($lihat['status_pembayaran'] == "diterima") : ?>
                            <a href="../../controllers/pembayaran.php?status=<?= $lihat['id_pembayaran'] ?>&type=selesai" class="btn btn-success">Selesai</a>
                        <?php endif ?>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endwhile ?>
<?php include "../templates/footer.php"; ?>