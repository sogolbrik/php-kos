<?php include '../templates/header.php'; ?>

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Form Edit Kamar</h3>
                <a href="data.php" class="btn btn-dark btn-sm">Kembali</a>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <?php
                    include '../../koneksi.php';

                    $id      = $_GET['id'];
                    $query   = "SELECT * FROM kamar WHERE id = '$id'";
                    $execute = $conn->query($query);
                    $see     = mysqli_fetch_assoc($execute);
                    ?>
                    <form action="../../controllers/kamar.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $see['id'] ?>" class="form-control"><br>
                        <label>Nama Kamar</label>
                        <input type="text" name="nama" value="<?php echo $see['nama'] ?>" class="form-control"><br>
                        <label>Harga Kamar</label>
                        <input type="number" name="harga" value="<?php echo $see['harga'] ?>" class="form-control"><br>
                        <label>Status</label>
                        <input type="text" name="status" value="<?php echo $see['status'] ?>" class="form-control"><br>
                        <label>Gambar Kamar Baru</label><br>
                        <input type="file" name="gambar" class="form-control"><br>
                        <label>Gambar Kamar Lama</label><br>
                        <img src="../../assets/uploads/kamar/<?php echo $see['gambar'] ?>" width="200"><br>
                        <button name="update" class="btn btn-success btn-sm">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../templates/footer.php'; ?>