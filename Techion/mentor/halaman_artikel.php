<?php include ("inc_header.php") ?>
<h1>Artikel Terkait</h1>
<p>
  <a href="input_artikel.php">
    <input type="button" class="btn btn-primary" value="Buat Halaman Baru" />
</p>
<table class="table table-stripped">
  <thead>
    <tr>
      <th class="col-1">#</th>
      <th>Judul</th>
      <th class="col-2">Bidang</th>
      <th>Isi Artikel</th>
      <th class="col-2">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql1 = "SELECT * FROM tbl_artikel ORDER BY id_artikel DESC";
    $q1 = mysqli_query($koneksi, $sql1);
    while ($r1 = mysqli_fetch_array($q1)) {
      ?>
          <tr>
              <td><?php echo $nomor++ ?></td>
              <td><?php echo $r1['judul_artikel'] ?></td>
              <td><?php echo $r1['bidang_artikel'] ?></td>
              <td><?php echo $r1['isi_artikel'] ?></td>
              <td>
                  <a href="input_artikel.php?id=<?php echo $r1['id_artikel']?>">
                      <span class="badge bg-warning text-dark">Edit</span>
                  </a>

                  <a href="halaman.php?op=delete&id=<?php echo $r1['id'] ?>" onclick="return confirm('Apakah yakin mau hapus data?')">
                      <span class="badge bg-danger">Delete</span>
                  </a>
              </td>
          </tr>
      <?php
      }
      ?>
  </tbody>
</table>
<?php include ("inc_footer.php") ?>