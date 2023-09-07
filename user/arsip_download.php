<?php 
include '../koneksi.php';
session_start();
date_default_timezone_set('Asia/Jakarta');

$waktu = date('Y-m-d H:i:s'); 
$user = $_SESSION['id'];
$arsip = $_GET['id'];

mysqli_query($koneksi, "INSERT INTO riwayat VALUES (NULL, '$waktu', '$user', '$arsip')") or die(mysqli_error($koneksi));

$data = mysqli_query($koneksi, "SELECT * FROM arsip WHERE arsip_id='$arsip'");
$d = mysqli_fetch_assoc($data);
$target_dir = "../arsip/" . date('Y') . "/";
$target_file = $target_dir . $d['arsip_file'];

header("location: " . $target_file);
