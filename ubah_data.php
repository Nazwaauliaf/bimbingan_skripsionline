<?php
require 'function.php';

// Ambil ID dari URL agar data lama muncul di form
$id_url = $_GET["id"];
$mhs = mysqli_query($conn, "SELECT * FROM bimbingan WHERE id_bimbingan = $id_url"); 
$row = mysqli_fetch_assoc($mhs);

// CEK APAKAH TOMBOL SIMPAN DIKLIK
if (isset($_POST["submit"])) {
    
    // Jalankan fungsi ubah_data
    if (ubah_data($_POST) >= 0) { 
        // JIKA BERHASIL (atau tidak ada error SQL)
        echo "<script>
                alert('Data berhasil diperbarui!');
                document.location.href = 'dashboard_dosen.php'; 
              </script>";
        exit; // Menghentikan script agar tidak lanjut ke bawah
    } else {
        echo "<script>
                alert('Gagal memperbarui data!');
              </script>";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

   
    <div class="p-4 container">
        <div class="row">
            <h1 class="mb-2">Ubah Data Bimbingan</h1>
            <a href="index.php" class="mb-2">Kembali</a>
            <div class="col-md-6">
                <!-- <form action="" method="POST" enctype="multipart/form-data"> -->
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $row['id_bimbingan']; ?>">

                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea name="catatan" class="form-control"><?= $row['catatan']; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="<?= $row['tanggal']; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="revisi">Revisi</option>
                        </select>
                    </div>
                    
                    <button type="submit" name="submit">Simpan Perubahan</button>
                    </form>
                </form>
            </div>
        </div>
    </div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>