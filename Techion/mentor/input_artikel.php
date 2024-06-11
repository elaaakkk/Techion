<?php
include ("../../koneksi.php");
$judul_artikel      = "";
$bidang_artikel     = "";
$isi_artikel        = "";
$error              = "";
$sukses             = "";

if(isset($_GET['id_artikel'])){
    $id_artikel = $_GET['id_artikel'];
} else {
    $id_artikel = "";
}

if($id_artikel != ""){
    $sql1   = "SELECT * FROM tbl_artikel WHERE id = '$id_artikel'";
    $q1     = mysqli_query($koneksi, $sql1);

    if($q1 && mysqli_num_rows($q1) > 0){
        $r1 = mysqli_fetch_array($q1);
        $judul_artikel  = $r1['judul_artikel'];
        $bidang_artikel = $r1['bidang_artikel'];
        $isi_artikel    = $r1['isi_artikel'];
    } else {
        $error  = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $judul_artikel   = $_POST['judul_artikel'];
    $bidang_artikel  = $_POST['bidang_artikel'];
    $isi_artikel     = $_POST['isi_artikel'];

    if ($judul_artikel == '' || $bidang_artikel == '' || $isi_artikel == '') {
        $error = "Silakan masukkan semua data";
    }

    if (empty($error)) {
        if($id_artikel != ""){
            $sql1 = "UPDATE tbl_artikel SET judul_artikel = '$judul_artikel', bidang_artikel = '$bidang_artikel', isi_artikel = '$isi_artikel', tgl_isi = now() WHERE id = '$id_artikel'";
        } else {
            $sql1 = "INSERT INTO tbl_artikel(judul_artikel, bidang_artikel, isi_artikel) VALUES ('$judul_artikel', '$bidang_artikel', '$isi_artikel')";
        }

        $q1 = mysqli_query($koneksi, $sql1);
        if ($q1) {
            $sukses = "Sukses memasukkan data";
        } else {
            $error  = "Gagal memasukkan data";
        }
    }
}
?>

<?php include("inc_header.php") ?>
<h1>Halaman Input Artikel</h1>
<div class="mb-3 row">
    <a href="halaman_artikel.php"><< Kembali</a>
</div>

<?php if ($error): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>
<?php if ($sukses): ?>
    <div class="alert alert-success"><?php echo $sukses; ?></div>
<?php endif; ?>

<form action="" method="post">
    <div class="mb-3 row">
        <label for="judul_artikel" class="col-sm-2 col-form-label">Judul</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="judul_artikel" value="<?php echo htmlspecialchars($judul_artikel); ?>" name="judul_artikel">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="bidang_artikel" class="col-sm-2 col-form-label">Bidang Artikel</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="bidang_artikel" value="<?php echo htmlspecialchars($bidang_artikel); ?>" name="bidang_artikel">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="isi_artikel" class="col-sm-2 col-form-label">Isi</label>
        <div class="col-sm-10">
            <textarea name="isi_artikel" class="form-control" id="summernote"><?php echo htmlspecialchars($isi_artikel); ?></textarea>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
        </div>
    </div>
</form>
<?php include("inc_footer.php") ?>
