<?php 

session_start();

unset($_SESSION['data_siswa']);
echo "data berhasil di hapus";
header("Location: index.php");
exit;


?>