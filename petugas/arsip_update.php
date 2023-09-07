<?php 
    include '../koneksi.php';
    session_start();
    date_default_timezone_set('Asia/Jakarta');

    $id = $_POST['id'];
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $keterangan = $_POST['keterangan'];

    $tahun = date('Y');
    $bulan = date('m');
    $tanggal = date('m');
    $rand = rand();
    $filename = $_FILES['file']['name'];
    $jenis = pathinfo($filename, PATHINFO_EXTENSION);

    if ($filename == "") {
        $query = "UPDATE arsip SET arsip_kode='$kode', arsip_nama='$nama', arsip_kategori='$kategori', arsip_keterangan='$keterangan' WHERE arsip_id='$id'";
        mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
        header("location: arsip.php");
    } else {
        if ($jenis == "php") {
            header("location: arsip.php?alert=gagal");
        } else {
            $lama = mysqli_query($koneksi, "SELECT * FROM arsip WHERE arsip_id='$id'");
            $l = mysqli_fetch_assoc($lama);
            $nama_file_lama = $l['arsip_file'];
            unlink("../arsip/" . $tahun . "/" . $nama_file_lama);

            $target_dir = "../arsip/" . $tahun . "/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $nama_file = $tahun.'_'.$bulan.'_'.$tanggal.'_'.$rand . '_' . $filename;
            $target_path = $target_dir . $nama_file;
            move_uploaded_file($_FILES['file']['tmp_name'], $target_path);

            $query = "UPDATE arsip SET arsip_kode='$kode', arsip_nama='$nama', arsip_jenis='$jenis', arsip_kategori='$kategori', arsip_keterangan='$keterangan', arsip_file='$nama_file' WHERE arsip_id='$id'";
            mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
            header("location: arsip.php?alert=sukses");
        }
    }
?>
