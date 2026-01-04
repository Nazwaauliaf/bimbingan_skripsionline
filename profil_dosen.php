<?php
session_start();
require 'function.php';

// Cek apakah session ID ada
if (!isset($_SESSION['id'])) {
    die("Error: Anda belum login atau Session ID tidak ditemukan.");
}

$id_session = $_SESSION['id'];

// Ambil data user TERBARU dari database
$query_user = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id_session'");
$user = mysqli_fetch_assoc($query_user);

// Jika tombol simpan ditekan
if (isset($_POST["update_profil"])) {
    if (update_profil($_POST) >= 0) {
        echo "<script>
                alert('Data Profil Berhasil Diperbarui!');
                document.location.href = 'dashboard_dosen.php';
              </script>";
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya</title>
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card mx-auto shadow" style="max-width: 600px;">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Edit Profil Akun</h3>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <input type="hidden" name="id" value="<?= $user['id']; ?>">
                    <input type="hidden" name="fotoLama" value="<?= $user['foto']; ?>">

                    <div class="text-center mb-4">
                        <?php 
                            $path_foto = (!empty($user['foto'])) ? 'dist/assets/img/' . $user['foto'] : 'dist/assets/img/default.jpg';
                        ?>
                        <form action="" method="POST" enctype="multipart/form-data"></form>
                        <img src="<?= $path_foto; ?>" class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="mt-2">
                            <input type="file" name="foto" class="form-control form-control-sm">
                            <small class="text-muted">Pilih foto jika ingin mengganti</small>
                        </div>
                    </div>

                    <input type="hidden" name="id" value="<?= $user['id']; ?>">

                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="username" class="form-control" value="<?= $user['username']; ?>">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $user['email']; ?>">
                    </div>

                    <div class="mb-3">
                        <label>NIM</label>
                    <input type="text" name="nim" class="form-control" value="<?= $user['nim']; ?>">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="dashboard_dosen.php" class="btn btn-secondary">Kembali</a>
                        <button type="submit" name="update_profil" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>