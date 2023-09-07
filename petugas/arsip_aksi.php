<?php 
include '../koneksi.php';
session_start();
date_default_timezone_set('Asia/Jakarta');

$waktu = date('Y-m-d H:i:s'); 
$petugas = $_SESSION['id'];
$kode  = $_POST['kode'];
$nama  = $_POST['nama'];

$rand = rand();

$filename = $_FILES['file']['name'];
$jenis = pathinfo($filename, PATHINFO_EXTENSION);

$kategori = $_POST['kategori'];
$keterangan = $_POST['keterangan'];

$tahun = date('Y');
$bulan = date('m');
$tanggal = date('d');
$direktori = '../arsip/'.$tahun.'/'.$tahun.'_'.$bulan.'_'.$tanggal.'_'.$rand.'_'.$filename;

if($jenis == "php") {
	header("location:arsip.php?alert=gagal");
}else{
	move_uploaded_file($_FILES['file']['tmp_name'], $direktori);
	$nama_file = $tahun.'_'.$bulan.'_'.$tanggal.'_'.$rand.'_'.$filename;
	mysqli_query($koneksi, "insert into arsip values (NULL,'$waktu','$petugas','$kode','$nama','$jenis','$kategori','$keterangan','$nama_file')")or die(mysqli_error($koneksi));
	header("location:arsip.php?alert=sukses");
}
