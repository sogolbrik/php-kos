<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
</head>

<body style="background-color: #ecf0f1">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="text-center">Register</h5>
                        <hr>
                        <form action="../../controllers/Auth.php" method="POST">
                            <input type="hidden" id="id" name="id">
                            <label>Username</label><br>
                            <input type="text" class="form-control mb-3" name="username" required>
                            <label>Email</label><br>
                            <input type="text" class="form-control mb-3" name="email" required>
                            <label>Password</label><br>
                            <input type="password" class="form-control mb-3" name="password" required>
                            <label>Ulang Password</label><br>
                            <input type="password" class="form-control mb-3" name="ulang_password" required>
                            <button class="btn btn-outline-success btn-sm w-100 kirim" name="register">Register</button>
                        </form>
                        Sudah punya akun? <a href="login.php">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>