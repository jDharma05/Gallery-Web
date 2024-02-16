<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/album.css">
  <title>Halaman Album</title>
</head>
<body>
    <ul>
      <li><b><a href="index.php">Home</a></b></li>
      <li><b><a href="album.php">Album</a></b></li>
      <li><b><a href="foto.php">Foto</a></b></li>
      <li><b><a href="logout.php">Logout</a></b></li>
    </ul>

    <form action="tambah_album.php" method="post" class="album-form">
  <div class="form-group">
    <label for="namaalbum">Nama Album:</label>
    <input type="text" id="namaalbum" name="namaalbum" required>
  </div>
  <div class="form-group">
    <label for="deskripsi">Deskripsi:</label>
    <input type="text" name="deskripsi"></input>
  </div>
  <div class="form-group text-center">
    <button type="submit">Tambah</button>
  </div>
</form>

  <table border="1" cellpadding=5 cellspacing=0 class="center-table"> 
    <tr class="center">
      <b>
      <th>ID</th>
      <th>Nama Album</th>
      <th>Deskripsi</th>
      <th>Tanggal Dibuat</th>
      <th>Aksi</th>
    </b>
      <?php
      include "koneksi.php";
      $userid = $_SESSION["userid"];
      $sql = mysqli_query($conn, "select * from album where userid='$userid'");
      while ($data = mysqli_fetch_array($sql)) { ?>
        <tr>
          <td><?= $data["albumid"] ?></td>
          <td><?= $data["namaalbum"] ?></td>
          <td><?= $data["deskripsi"] ?></td>
          <td><?= $data["tanggaldibuat"] ?></td>
          <td>
            <a href="hapus_album.php?albumid=<?= $data["albumid"] ?>">Hapus</a>
            <a href="edit_album.php?albumid=<?= $data["albumid"] ?>">Edit</a>
          </td>
        </tr>   
      <?php }
      ?>
    </tr>
  </table>
</body>
</html>