<?php
include '../templates/header.php';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="d-flex justify-content-between align-items-center">
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title text-center">Profile User</h3>
                    <hr>
                    <form action="../../controllers/Auth.php" method="POST">
                        <label for="">Username</label>
                        <input type="text" class="form-control form-control-lg mb-2" name="username" value="<?= $_SESSION['auth']['username'] ?>">
                        <label for="">Email</label>
                        <input type="email" class="form-control form-control-lg mb-2" name="email" value="<?= $_SESSION['auth']['email'] ?>">
                        <label for="">Password Baru</label>
                        <input type="password" class="form-control form-control-lg mb-2" name="password">
                        <label for="">Ulang Password</label>
                        <input type="password" class="form-control form-control-lg mb-2" name="ulang_password">
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-success btn-sm" name="change_profile">Simpan</button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>