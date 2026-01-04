<?php
// Koneksi ke Database
$conn = mysqli_connect("localhost", "root", "", "bimbingan_skripsi");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (!function_exists('query')) {
    function query($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
}

// fungsi registrasi mahasiswa
function registrasi_mahasiswa($data) {
    global $conn;

    $username = mysqli_real_escape_string($conn, $data["username"]);
    $nim      = mysqli_real_escape_string($conn, $data["nim"]);
    $email    = mysqli_real_escape_string($conn, $data["email"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $role     = "mahasiswa";

    // Cek apakah username atau NIM sudah ada
    $cek_user = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username' OR nim = '$nim'");
    if (mysqli_fetch_assoc($cek_user)) {
        return "Username atau NIM sudah terdaftar!";
    }

    // Hash password agar aman (tidak terbaca di database)
    $password_fix = password_hash($password, PASSWORD_DEFAULT);

    // Insert ke tabel users
    $query = "INSERT INTO users (username, nim, email, password, role) 
              VALUES ('$username', '$nim', '$email', '$password_fix', '$role')";

    if (mysqli_query($conn, $query)) {
        return true;
    } else {
        return "Gagal daftar: " . mysqli_error($conn);
    }
}

// fungsi registrasi dosen
function registrasi_dosen($data) {
    global $conn;

    $username = mysqli_real_escape_string($conn, $data["username"]);
    $nim      = mysqli_real_escape_string($conn, $data["nim"]);
    $email    = mysqli_real_escape_string($conn, $data["email"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $role     = "dosen";

    $cek_user = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username' OR nim = '$nim'");
    if (mysqli_fetch_assoc($cek_user)) {
        return "Username atau NIP sudah terdaftar!";
    }

    $password_fix = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, nim, email, password, role) 
              VALUES ('$username', '$nim', '$email', '$password_fix', '$role')";

    if (mysqli_query($conn, $query)) {
        return true;
    } else {
        return "Gagal daftar dosen: " . mysqli_error($conn);
    }
}

function login_mahasiswa($data) {
    global $conn;

    $username = mysqli_real_escape_string($conn, $data["username"]);
    $nim      = mysqli_real_escape_string($conn, $data["nim"]);
    $password = $data["password"];

    // 1. Cari user berdasarkan username
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND role = 'mahasiswa'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        
        // 2. Cek NIM (Seringkali salah karena ada spasi tersembunyi)
        if (trim($row["nim"] ?? '') !== trim($nim ?? '')) {
            return "NIM tidak cocok! Periksa kembali NIM anda.";
        }

        // 3. Cek Password
        if (password_verify($password, $row["password"])) {
            // Jika benar, buat session
            $_SESSION["login_mahasiswa"] = true;
            $_SESSION["id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            return "success";
        } else {
            return "Password salah!";
        }
    }
    
    return "Username tidak ditemukan atau Anda bukan mahasiswa!";
}

function login_dosen($data) {
    global $conn;

    $username = mysqli_real_escape_string($conn, $data["username"]);
    $nip      = mysqli_real_escape_string($conn, $data["nip"]);
    $password = $data["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND role = 'dosen'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Gunakan ?? '' untuk menghindari error 'Deprecated' jika data null
        if (password_verify($password, $row["password"])) {
            $_SESSION["login_dosen"] = true;
            $_SESSION["id"] = $row["id"];
            return "success";
        }
    }
    return "Username, NIP, atau Password salah!";
}

// fungsi untuk menambah data ke database dosen
    if (!function_exists('tambah_bimbingan_dosen')) {
    function tambah_bimbingan_dosen($data){
        global $conn;

        $id_mahasiswa = mysqli_real_escape_string($conn, $data['id_mahasiswa']);
        $nama = mysqli_real_escape_string($conn, $data['nama']);
        $nim = mysqli_real_escape_string($conn, $data['nim']);
        $jurusan = mysqli_real_escape_string($conn, $data['jurusan']);
        $angkatan = mysqli_real_escape_string($conn, $data['angkatan']);
        $topik = mysqli_real_escape_string($conn, $data['topik']);
        $catatan = mysqli_real_escape_string($conn, $data['catatan']);
        $tanggal = mysqli_real_escape_string($conn, $data['tanggal']);
        $status = mysqli_real_escape_string($conn, $data['status']);

        $query = "INSERT INTO bimbingan 
                (id_mahasiswa, nama, topik, catatan, tanggal, status)
                VALUES
                ('$id_mahasiswa', '$nama', '$topik', '$catatan', '$tanggal', '$status')";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
    }

// fungsi untuk menambah data ke database mahasiswa
if (!function_exists('tambah_bimbingan_mahasiswa')) {
    function tambah_bimbingan_mahasiswa($data) {
        global $conn;

        $nama     = mysqli_real_escape_string($conn, $data['nama'] ?? '');
        $nim      = mysqli_real_escape_string($conn, $data['nim'] ?? '');
        $jurusan  = mysqli_real_escape_string($conn, $data['jurusan'] ?? '');
        $angkatan = mysqli_real_escape_string($conn, $data['angkatan'] ?? '');
        $topik    = mysqli_real_escape_string($conn, $data['topik'] ?? '');

        $query = "INSERT INTO bimbingan 
            (nama, nim, jurusan, angkatan, topik) 
          VALUES
            ('$nama', '$nim', '$jurusan', '$angkatan', '$topik')";

        mysqli_query($conn, $query); 
        return mysqli_affected_rows($conn);
    }
}

// fungsi untuk menghapus data dari database
    if (!function_exists('hapus_data')) {
    function hapus_data($id){
        global $conn;

        $query = "DELETE FROM bimbingan WHERE id_bimbingan = $id";

        $result = mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
    }

// fungsi untuk mengubah data di database
function ubah_data($data) {
    global $conn;

    $id = $data["id"]; 
    $catatan = mysqli_real_escape_string($conn, $data["catatan"]);
    $tanggal = mysqli_real_escape_string($conn, $data["tanggal"]);
    $status = mysqli_real_escape_string($conn, $data["status"]);

    $query = "UPDATE bimbingan SET 
                catatan = '$catatan', 
                tanggal = '$tanggal',
                status = '$status'
              WHERE id_bimbingan = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
    
// fungsi untuk mencari data
    if (!function_exists('search_data')) {
    function search_data($keyword){
        global $conn;

        $query = "SELECT * FROM bimbingan
                WHERE
                id_bimbingan LIKE '%$keyword%' OR
                nama_mahasiswa LIKE '%$keyword%' OR
                topik LIKE '%$keyword%' OR
                catatan LIKE '%$keyword%' OR
                status LIKE '%$keyword%'
                ";
        return query($query);
    }
    }

// fungsi status bimbingan
    if (!function_exists('statusBimbingan')) {
    function statusBimbingan($status){
        if($status == "menunggu"){
            return '<span class="badge bg-warning">Menunggu</span>';
        } elseif($status == "disetujui"){
            return '<span class="badge bg-success">Disetujui</span>';
        } elseif($status == "revisi"){
            return '<span class="badge bg-danger">Revisi</span>';
        }
    }
    }

if (!function_exists('cekLogin')) {
// fungsi cek login
    function cekLogin(){
        if(!isset($_SESSION["login"])){
            header("Location: login.php");
            exit;
        }
    }
}

// fungsi update profile
function update_profil($data) {
    global $conn;

    $id = $data["id"];
    $username = mysqli_real_escape_string($conn, $data["username"]);
    $email = mysqli_real_escape_string($conn, $data["email"]);
    $nim = mysqli_real_escape_string($conn, $data["nim"]);
    $fotoLama = $data["fotoLama"];

    // --- LOGIKA PENCEGAHAN DUPLICATE ---
    // Cek apakah username sudah ada di database (milik ID lain)
    $cek_user = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username' AND id != $id");
    
    if (mysqli_num_rows($cek_user) > 0) {
        echo "<script>
                alert('Gagal! Username sudah digunakan orang lain. Silakan pilih nama lain.');
                document.location.href = 'profil_dosen.php';
              </script>";
        return false; // Berhenti di sini, jangan jalankan query UPDATE
    }
    // -----------------------------------

    if ($_FILES['foto']['error'] === 4) {
        $foto = $fotoLama;
    } else {
        $foto = upload_foto();
        if (!$foto) return false;
    }

    $query = "UPDATE users SET 
                username = '$username', 
                email = '$email', 
                nim = '$nim', 
                foto = '$foto' 
              WHERE id = $id";
          
    mysqli_query($conn, $query);

    // Update session supaya nama di header langsung berubah
    $_SESSION["username"] = $username;

    return mysqli_affected_rows($conn);
}

// fungsi upload foto
function upload_foto() {
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    // Cek apakah tidak ada gambar yang diupload
    if ($error === 4) { return false; }

    // Cek apakah yang diupload benar gambar
    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensi = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

    if (!in_array($ekstensi, $ekstensiValid)) {
        echo "<script>alert('Format file harus JPG, JPEG, atau PNG!');</script>";
        return false;
    }

    // Batasi ukuran (misal 2MB)
    if ($ukuranFile > 2000000) {
        echo "<script>alert('Ukuran gambar terlalu besar!');</script>";
        return false;
    }

    // Generate nama baru agar tidak duplikat
    $namaBaru = uniqid() . '.' . $ekstensi;
    move_uploaded_file($tmpName, 'dist/assets/img/' . $namaBaru);

    return $namaBaru;
}