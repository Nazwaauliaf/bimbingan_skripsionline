<?php
session_start();
require 'function.php';

$error = false; 

// JIKA SUDAH LOGIN → LANGSUNG KE DASHBOARD DOSEN
if (isset($_SESSION['login_dosen'])) {
    header("Location: dashboard_dosen.php");
    exit;
}

if (isset($_POST["tombol_login_dosen"])) {
    $login = login_dosen($_POST);

    if ($login === "success") {
        header("Location: dashboard_dosen.php"); 
        exit;
    } else {
        $error = $login;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #e9ecef; }
        .login-card { margin-top: 10%; padding: 30px; border-radius: 10px; background: white; box-shadow: 0 4px 18px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="login-card">
                <h3 class="text-center mb-4">Login Dosen</h3>

                <?php if($error) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $error ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">NIP</label>
                        <input type="text" name="nip" class="form-control" placeholder="Masukkan nomor induk..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password..." required>
                    </div>

                    <button type="submit" name="tombol_login_dosen" class="btn btn-dark w-100">Login Dosen</button>
                    
                    <div class="mt-3 text-center">
                        <p class="mb-1">Belum punya akun? <a href="registrasi_dosen.php">Registrasi Dosen</a></p>
                        <p><small>Bukan Dosen? <a href="login_mahasiswa.php">Login Mahasiswa</a></small></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>