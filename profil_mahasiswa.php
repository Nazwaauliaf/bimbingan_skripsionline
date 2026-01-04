<?php
session_start();
require 'function.php';

// 1. CEK SESSION
if (!isset($_SESSION['id'])) {
    header("Location: login_mahasiswa.php");
    exit;
}

$id_user = $_SESSION['id'];

// 2. LOGIKA UPDATE (Jika tombol simpan ditekan)
if (isset($_POST["update_profil"])) {
    if (update_profil($_POST) > 0) {
        echo "<script>
                alert('Profil berhasil diperbarui!');
                document.location.href = 'dashboard_mahasiswa.php';
              </script>";
    } else {
        // Jika tidak ada baris yang berubah (misal user klik simpan tanpa ganti apapun)
        echo "<script>alert('Tidak ada perubahan data.');</script>";
    }
}

// 3. AMBIL DATA TERBARU (Untuk ditampilkan di form)
$result = query("SELECT * FROM users WHERE id = '$id_user'");
$user = $result[0];
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
                            $path_foto = (!empty($user['foto'])) ? 'dist/img/' . $user['foto'] : 'dist/img/default.jpg';
                        ?>
                        <img src="<?= $path_foto; ?>" class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="mt-2">
                            <input type="file" name="foto" class="form-control form-control-sm">
                            <small class="text-muted">Pilih foto jika ingin mengganti</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Nama Username</label>
                        <input type="text" name="username" class="form-control" value="<?= $user['username']; ?>">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $user['email']; ?>">
                    </div>
                    <div class="mb-3">
                        <label>NIP/NIM</label>
                        <input type="text" class="form-control" value="<?= $user['nim']; ?>" readonly>
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