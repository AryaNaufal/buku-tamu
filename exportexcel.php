<?php
include "koneksi.php";

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Pengunjung.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<table border="1">
  <thead>
    <tr>
      <th>Rekapitulasi Data Pengunjung</th>
    </tr>
    <tr>
      <th>No</th>
      <th>Tanggal</th>
      <th>Nama Tamu</th>
      <th>Nama Perusahaan</th>
      <th>Alamat</th>
      <th>Jenis Kelamin</th>
      <th>No Visitor</th>
      <th>Nik KTP</th>
      <th>No HP</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $tgl1 = $_POST['tanggala'];
    $tgl2 = $_POST['tanggalb'];
    $tampil = mysqli_query($koneksi, "SELECT * FROM tamu WHERE tanggal BETWEEN '$tgl1' AND '$tgl2' order by tanggal desc");
    $no = 1;
    while ($data = mysqli_fetch_array($tampil)) {
    ?>
      <tr>
        <th><?= $no++ ?></th>
        <th><?= $data['tanggal'] ?></th>
        <th><?= $data['nama_tamu'] ?></th>
        <th><?= $data['nama_perusahaan'] ?></th>
        <th><?= $data['alamat'] ?></th>
        <th><?= $data['jenis_kelamin'] ?></th>
        <th><?= $data['no_visitor'] ?></th>
        <th><?= $data['nik_ktp'] ?></th>
        <th><?= $data['no_telp'] ?></th>
      </tr>
    <?php } ?>
  </tbody>

</table>