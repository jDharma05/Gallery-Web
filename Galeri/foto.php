<?php
  session_start();
  if(!isset($_SESSION['userid'])) {
    header("location:login.php");
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/foto.css">
  <title>Halaman Foto</title>
</head>
<body>
  

  <ul>
    <b>
      <li><a href="index.php">Home</a></li>
      <li><a href="album.php">Album</a></li>
      <li><a href="foto.php">Foto</a></li>
      <li><a href="logout.php">Logout</a></li>
    </b>
    </ul>
    <form action="tambah_foto.php" method="post" enctype="multipart/form-data" class="album-form">
  <div class="form-group">
    <label for="judulfoto">Judul Foto:</label>
    <input type="text" id="judulfoto" name="judulfoto" required>
  </div>
  <div class="form-group">
    <label for="deskripsifoto">Deskripsi:</label>
    <input type="text" id="deskripsifoto" name="deskripsifoto" required>
  </div>
  <div class="form-group">
    <label for="lokasifile">Lokasi File:</label>
    <input type="file" id="lokasifile" name="lokasifile" required>
  </div>
  <div class="form-group">
    <label for="albumid">Album:</label>
    <select id="albumid" name="albumid" required>
      <?php
        include "koneksi.php";
        $userid=$_SESSION['userid'];
        $sql=mysqli_query($conn,"select * from album where userid='$userid'");
        while($data=mysqli_fetch_array($sql)){
      ?>
      <option value="<?=$data['albumid']?>"><?=$data['namaalbum']?></option>
      <?php
      }
      ?>
    </select>
  </div>
  <div class="form-group text-center">
    <button type="submit">Tambah</button>
  </div>
</form>


  <table border="1" cellpadding=5 cellspacing=0>
    <tr>
      <th>ID</th>
      <th>Judul Foto</th>
      <th>Deskripsi Foto</th>
      <th>Tanggal Unggah</th>
      <th>Lokasi File</th>
      <th>Album</th>
      <th>Disukai</th>
      <th>Aksi</th>
    </tr>
    <?php
      include "koneksi.php";
      $userid=$_SESSION['userid'];
      $sql=mysqli_query($conn,"select * from foto,album where foto.userid='$userid' and foto.albumid=album.albumid");
      while($data=mysqli_fetch_array($sql)){
    ?>   
      <tr>
        <td><?=$data['fotoid']?></td>
        <td><?=$data['judulfoto']?></td>
        <td><?=$data['deskripsifoto']?></td>
        <td><?=$data['tanggalunggah']?></td>
        <td>
          <img src="gambar/<?=$data['lokasifile']?>" width="200px">
        </td>
        <td><?=$data['namaalbum']?></td>
        <td>
          <?php
            $fotoid=$data['fotoid'];
            $sql2=mysqli_query($conn,"select * from likefoto where fotoid='$fotoid'");
            echo mysqli_num_rows($sql2);
          ?>
        </td>
        <td>
          <a href="hapus_foto.php?fotoid=<?=$data['fotoid']?>">Hapus</a>
          <a href="edit_foto.php?fotoid=<?=$data['fotoid']?>">Edit</a>
        </td>
      </tr>
    <?php
    }
    ?>
  </table>
</body>
</html>