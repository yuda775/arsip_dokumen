<?php 
include '../koneksi.php';
$id = $_GET['id'];

$lama = mysqli_query($koneksi, "SELECT * FROM arsip WHERE arsip_id='$id'");
$l = mysqli_fetch_assoc($lama);
$nama_file_lama = $l['arsip_file'];

$target_dir = "../arsip/" . date('Y') . "/";
$target_path = $target_dir . $nama_file_lama;

unlink($target_path);

mysqli_query($koneksi, "DELETE FROM arsip WHERE arsip_id='$id'");
header("location: arsip.php");
?>
