<?php
require 'function.php';

if (isset($_POST['tombol_submit'])) {

    // generate ID Produk otomatis: J001, J002, dst.
    $last = query("SELECT id_mahasiswa FROM mahasiswa ORDER BY id_mahasiswa DESC LIMIT 1");
    if ($last) {
        $num = (int) substr($last[0]['id_mahasiswa'], 1) + 1;
        $id_produk = "J" . str_pad($num, 3, "0", STR_PAD_LEFT);
    } else {
        $id_produk = "J001";
    }

    // siapkan data untuk dikirim ke function
    $_POST['id_produk'] = $id_produk;
    $_POST['tanggal_input'] = date("Y-m-d H:i:s");

    if (tambah_bimbingan_mahasiswa($_POST) > 0) {
        echo "<script>
                alert('Data berhasil ditambahkan!');
                document.location.href='dashboard_mahasiswa.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan data!');
              </script>";
    }
}
?>

<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Bimbingan Skripsi Online</title>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />

    <link rel="stylesheet" href="dist/css/adminlte.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" />
  </head>
  <!--end::Head-->

  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">

      <!-- HEADER -->
      <nav class="app-header navbar navbar-expand bg-body">
        <div class="container-fluid">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#"><i class="bi bi-list"></i></a>
            </li>
          </ul>

          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img src="dist/assets/img/user2-160x160.jpg" class="user-image rounded-circle shadow" />
                <span class="d-none d-md-inline">Nazwa Aulia</span>
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <!-- END HEADER -->

      <!-- SIDEBAR -->
      <!-- <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <div class="sidebar-brand">
          <a href="index.php" class="brand-link">
            <img src="dist/assets/img/AdminLTELogo.png" class="brand-image opacity-75 shadow" />
            <span class="brand-text fw-light">Bimbingan Skripsi</span>
          </a>
        </div>

        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation">
              <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>Data Master<i class="nav-arrow bi bi-chevron-right"></i></p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="index.php" class="nav-link active">
                      <i class="nav-icon bi bi-circle"></i><p>Data Mahasiswa</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="kategori.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i><p>Data Mahasiswa</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-header">AUTENTIKASI</li>
              <li class="nav-item">
                <a href="./generate/theme.html" class="nav-link">
                  <i class="nav-icon bi bi-palette"></i><p>Sign Out</p>
                </a>
              </li>

            </ul>
          </nav>
        </div>
      </aside> -->
      <!-- END SIDEBAR -->

      <!-- MAIN SECTION -->
      <main class="app-main">

        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Tambah Data Mahasiswa</h3>
              </div>

              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="kategori.php">Home</a></li>
                  <li class="breadcrumb-item"><a href="kategori.php">Data Mahasiswa</a></li>
                  <li class="breadcrumb-item active">Tambah Data</li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <div class="app-content">
          <div class="container-fluid">

            <div class="row">
              <div class="col-md-6">

                <!-- FORM — Bagian ini yang diperbaiki -->
                <form action="" method="post">

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">NIM</label>
                        <input type="text" class="form-control" name="nim" placeholder="NIM" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jurusan</label>
                        <input type="text" class="form-control" name="jurusan" placeholder="Jurusan" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Angkatan</label>
                        <input type="number" class="form-control" name="angkatan" placeholder="Angkatan" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Topik</label>
                        <input type="text" class="form-control" name="topik" placeholder="Topik" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="menunggu">Menunggu</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <button class="btn-sm btn btn-primary" name="tombol_submit">Submit</button>
                    </div>

                </form>
                <!-- END FORM -->

              </div>
            </div>

          </div>
        </div>

      </main>
      <!-- END MAIN -->

      <footer class="app-footer">
        <div class="float-end d-none d-sm-inline">Bismillah Tugas Promnet</div>
        <strong>Copyright © 2025</strong>
      </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
    <script src="dist/js/adminlte.js"></script>

  </body>
</html>
