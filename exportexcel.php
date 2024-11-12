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
      <th>data tamu gedung grha bp jamsostek</th>
    </tr>
    <tr>
      <th>No</th>
      <th>Tanggal</th>
      <th>Nama Tamu</th>
      <th>Nama Perusahaan</th>
      <th>Kegiatan</th>
      <th>Tujuan</th>
      <th>No Visitor</th>
      <th>Waktu Datang</th>
      <th>Waktu Keluar</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $tgl1 = $_POST['tanggala'];
    $tgl2 = $_POST['tanggalb'];
    $tampil = mysqli_query($koneksi, "SELECT * FROM tamu WHERE tanggal BETWEEN '$tgl1' AND '$tgl2' ORDER BY tanggal DESC");
    $no = 1;
    while ($data = mysqli_fetch_array($tampil)) {
    ?>
      <tr>
        <th><?= $no++ ?></th>
        <th><?= $data['tanggal'] ?></th>
        <th><?= $data['nama_tamu'] ?></th>
        <th><?= $data['nama_perusahaan'] ?></th>
        <th><?= $data['kegiatan'] ?></th>
        <th><?= $data['tujuan'] ?></th>
        <th><?= $data['no_visitor'] ?></th>
        <th><?= $data['waktu_datang'] ?></th>
        <th><?= $data['waktu_keluar'] ?></th>
      </tr>
    <?php } ?>
  </tbody>

</table>