<?php
include '../templates/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Data Kamar</h3>
                <a href="form.php" class="btn btn-primary btn-sm">Tambah Data</a>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kamar</th>
                                <th>Harga Kamar</th>
                                <th>Status</th>
                                <th>Gambar Kamar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../../koneksi.php';
                            $query   = "SELECT * FROM kamar";
                            $execute = $conn->query($query);
                            $no = 1;
                            while ($see = mysqli_fetch_assoc($execute)) {
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $see['nama'] ?></td>
                                    <td><?php echo $see['harga'] ?></td>
                                    <td><?php echo $see['status'] ?></td>
                                    <td><img src="../../assets/uploads/kamar/<?php echo $see['gambar'] ?>" width="200"></td>
                                    <td>
                                        <a href="form-edit.php?id=<?php echo $see['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="../../controllers/kamar.php?delete=<?php echo $see['id'] ?>&sampul=<?php echo $see['gambar'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../templates/footer.php'; ?>