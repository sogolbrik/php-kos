<?php include '../templates/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Form Tambah Kamar</h3>
                <a href="data.php" class="btn btn-dark btn-sm">Kembali</a>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <form action="../../controllers/kamar.php" method="POST" enctype="multipart/form-data">
                        <label>Nama Kamar</label>
                        <input type="text" name="nama" class="form-control"><br>
                        <label>Harga Kamar</label>
                        <input type="text" name="harga" class="form-control"><br>
                        <label>Gambar Kamar</label>
                        <input type="file" name="gambar" class="form-control"><br>
                        <button name="create" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../templates/footer.php'; ?>