<?php
require 'function.php';

$error = "";
$success = "";

if (isset($_POST["tombol_register"])) {
    $hasil = registrasi_mahasiswa($_POST);
    if ($hasil === true) {
        $success = "Registrasi Berhasil! Silakan login.";
    } else {
        $error = $hasil;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4 shadow-sm">
                <h3 class="text-center mb-4">Daftar Mahasiswa</h3>
                
                <?php if($error) : ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                <?php if($success) : ?>
                    <div class="alert alert-success"><?= $success ?></div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NIM</label>
                        <input type="text" name="nim" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <input type="hidden" name="role" value="mahasiswa">
                    
                    <button type="submit" name="tombol_register" class="btn btn-primary w-100">Daftar</button>
                    <p class="mt-3 text-center">Sudah punya akun? <a href="login_mahasiswa.php">Login</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>