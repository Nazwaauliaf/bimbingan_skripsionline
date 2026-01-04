<?php
require 'function.php';

$error = "";
$success = "";

if (isset($_POST["tombol_register_dosen"])) {
    // Memanggil fungsi registrasi khusus dosen
    $hasil = registrasi_dosen($_POST);
    
    if ($hasil === true) {
        $success = "Registrasi Dosen Berhasil! Silakan login.";
    } else {
        $error = $hasil;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #e9ecef; } /* Warna berbeda agar tidak tertukar dengan mahasiswa */
        .login-card { margin-top: 5%; padding: 30px; border-radius: 10px; background: white; box-shadow: 0 4px 18px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="login-card">
                <h3 class="text-center mb-4">Daftar Akun Dosen</h3>
                
                <?php if($error) : ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <?= $error ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if($success) : ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <?= $success ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Contoh: pak_budi" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">NIP / NIM</label>
                        <input type="text" name="nim" class="form-control" placeholder="Masukkan Nomor Induk..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="email@kampus.ac.id" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Buat password..." required>
                    </div>

                    <input type="hidden" name="role" value="dosen">
                    
                    <button type="submit" name="tombol_register_dosen" class="btn btn-dark w-100">Daftar Dosen</button>
                    
                    <div class="mt-3 text-center">
                        <p>Sudah punya akun? <a href="login_dosen.php">Login Dosen</a></p>
                        <p><small>Bukan Dosen? <a href="registrasi_mahasiswa.php">Daftar Mahasiswa</a></small></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>