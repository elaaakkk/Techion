<?php
$judul_konten      = "";
$bidang_konten    = "";
$isi_konten       = "";
$error      = "";
$sukses     = "";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = "";
}

if($id != ""){
    $sql1   = "select * from halaman where id = '$id'";
    $q1     = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $judul_konten  = $r1['judul_artikel'];
    $bidang_konten    = $r1['bidang_artikel'];
    $isi_konten        = $r1['isi_artikel'];

    if($isi_konten == ''){
        $error  = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $judul_konten      = $_POST['judul_konten'];
    $bidang_konten   = $_POST['bidang_konten'];
    $isi_konten       = $_POST['isi_konten'];

    if ($judul_konten == '' or $isi_konten == '') {
        $error     = "Silakan masukkan semua data yakni adalah data isi dan judul.";
    }

    if (empty($error)) {
        if($id != ""){
            $sql1   = "update halaman set judul_konten = '$judul_konten',bidang_konten='$biang_konten',isi_konten='$isi_konten',tgl_isi=now() where id = '$id'";
        }else{
            $sql1       = "insert into halaman(judul_konten,bidang_konten,isi_konten) values ('$judul_konten','$bidang_konten','$isi_konten')";
        }
        
        $q1         = mysqli_query($koneksi, $sql1);
        if ($q1) {
            $sukses     = "Sukses memasukkan data";
        } else {
            $error      = "Gagal memasukkan data";
        }
    }
}


?>
<?php include ("inc_header.php") ?>
<h1>Halaman Input Konten </h1>
<div class="mb-3 row">
    <a href="halaman_konten.php">
        << Kembali</a>
</div>
<form action="" method="post">
    <div class="mb-3 row">
        <label for="judul_konten" class="col-sm-2 col-form-label">Judul</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="judul_konten" value="<?php echo $judul_konten ?>" name="judul_konten">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="bidang_konten" class="col-sm-2 col-form-label">Bidang Konten</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="bidang_konten" value="<?php echo $bidang_konten ?>" name="bidang_konten">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="isi_konten" class="col-sm-2 col-form-label">Isi</label>
        <div class="col-sm-10">
            <textarea name="isi_konten" class="form-control" id="summernote"><?php echo $isi_konten ?></textarea>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
        </div>
    </div>
</form>
<?php include ("inc_footer.php") ?>