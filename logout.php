<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();

header("Location: login_dosen.php");
header("Location: login_mahasiswa.php");
exit;

?>