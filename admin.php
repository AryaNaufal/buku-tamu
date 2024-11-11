<!-- Panggil file header -->
<?php include "header.php"; ?>

<?php

// Uji Jika tombol simpan diklik
if (isset($_POST['bsimpan'])) {
	$tgl = date('Y-m-d');

	// htmlspecialchars agar inputan lebih aman dari injection
	$nama_tamu = htmlspecialchars($_POST['nama_tamu'], ENT_QUOTES);
	$nama_perusahaan = htmlspecialchars($_POST['nama_perusahaan'], ENT_QUOTES);
	$jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin'], ENT_QUOTES);
	$no_visitor = htmlspecialchars($_POST['no_visitor'], ENT_QUOTES);
	$nik_ktp = htmlspecialchars($_POST['nik_ktp'], ENT_QUOTES);
	$no_telp = htmlspecialchars($_POST['no_telp'], ENT_QUOTES);
	$alamat = htmlspecialchars($_POST['alamat'], ENT_QUOTES);

	//persiapan  query simpan  data
	$simpan = mysqli_query($koneksi, "INSERT INTO tamu VALUES ('', '$tgl', '$nama_tamu', '$nama_perusahaan', '$jenis_kelamin', '$no_visitor', '$nik_ktp', '$no_telp', '$alamat')");

	//Uji Jika simpan data sukses
	if ($simpan) {
		echo "<script>alert('Simpan data sukses, Terima kasih..!');</script>";
	} else {
		echo "<script>alert('Simpan data gagal, Terima kasih..!');</script>";
	}
}
?>


<!-- Head -->
<div class="head text-center">

	<img src="assets/img/logo.jpg" width="400">
	<hr class="text-white">Graha BPJamsostek Buku Tamu <br> Bijak</h2>
</div>
<!-- end Head -->

<!-- Awal Row -->
<div class="row mt-2">
	<!-- col-lg-7 -->
	<div class="col-lg-7 mb-3">
		<div class="card shadow bg-gradient-light">
			<!-- card body -->
			<div class="card-body">

				<div class="text-center">
					<h1 class="h4 text-gray-900 mb-4">Identitas Pengunjung</h1>
				</div>

				<form class="user" method="POST">
					<div class="form-group">
						<input type="text" class="form-control form-control-user" name="nama_tamu" placeholder="Nama Tamu" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control form-control-user" name="nama_perusahaan" placeholder="Nama Perusahaan" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control form-control-user" name="alamat" placeholder="Alamat" required>
					</div>
					<div class="form-group">
						<select class="form-select form-control-user w-100 p-3" name="jenis_kelamin" style="border: 1px solid #d1d3e2; color: #6e707e;" required>
							<option selected>-- Pilih Jenis Kelamin --</option>
							<option value="Laki-Laki">Laki-Laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
					<div class="form-group">
						<input type="number" class="form-control form-control-user" name="no_visitor" placeholder="No Visitor" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control form-control-user" name="nik_ktp" placeholder="Nik KTP" required>
					</div>
					<div class="form-group">
						<input type="number" class="form-control form-control-user" name="no_telp" placeholder="No Telp" required>
					</div>

					<button type="submit" name="bsimpan" class="btn btn-primary btn-user btn-block">Simpan Data</button>
				</form>

				<hr>
				<div class="text-center">
					<a class="small" href="#">By. Nastavnic | <?= date('Y') ?></a>
				</div>
			</div>
			<!-- end card-body -->
		</div>
	</div>
	<!-- end col-lg-5 -->

	<!-- col-lg-7 -->
	<div class="col-lg-5 mb-3">
		<!-- card -->
		<div class="card shadow ">
			<!-- card body -->
			<div class="card-body">
				<div class="text-center">
					<h1 class="h4 text-gray-900 mb-4">Statistik Pengunjung</h1>
				</div>
				<?php
				//deklarasi tangal

				//menampilkan tanggal sekarang
				$tgl_sekarang = date('Y-m-d');

				//menampilkan tgl kemaren
				$kemarin = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));

				//mendapatkan 6 hari sebelum tgl sekarang
				$seminggu = date('Y-m-d h:i:s', strtotime('-1 week +1 day', strtotime($tgl_sekarang)));

				$sekarang = date('Y-m-d h:i:s');


				//persiapan query tampilkan jumlah data pengunjung

				$tgl_sekarang = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM tamu WHERE tanggal like '%$tgl_sekarang%'"));

				$kemarin = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM tamu WHERE tanggal like '%$kemarin%'"));

				$seminggu = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM tamu WHERE tanggal BETWEEN '$seminggu' AND '$sekarang'"));

				$bulan_ini = date('m');

				$sebulan = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) FROM tamu WHERE month(tanggal) = '$bulan_ini'"));

				$keseluruhan = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) FROM tamu"));

				?>
				<table class="table table-bordered">
					<tr>
						<td>Hari Ini</td>
						<td>: <?= $tgl_sekarang[0] ?></td>
					</tr>
					<tr>
						<td>Kemaren</td>
						<td>: <?= $kemarin[0] ?></td>
					</tr>
					<tr>
						<td>Minggu Ini</td>
						<td>: <?= $seminggu[0] ?></td>
					</tr>
					<tr>
						<td>Bulan ini</td>
						<td>: <?= $sebulan[0] ?></td>
					</tr>
					<tr>
						<td>keseluruhan</td>
						<td>: <?= $keseluruhan[0] ?></td>
					</tr>
				</table>
			</div>
			<!-- card body -->
		</div>
		<!-- end body -->
	</div>
	<!-- end col-lg-5 -->


</div>
<!-- End Row -->


<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Data Tamu Hari Ini [<?= date('d-m-Y') ?>]</h6>
	</div>
	<div class="card-body">
		<a href="rekapitulasi.php" class="btn btn-success mb-3">
			<i class="fa fa-table"></i> Rekapitulasi Pengunjung
		</a>
		<a href="logout.php" class="btn btn-danger mb-3">
			<i class="fa fa-sign-out"></i>Logout
		</a>
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
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
				<tfoot>
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
				</tfoot>
				<tbody>
					<?php
					$tgl = date('Y-m-d');
					$tampil = mysqli_query($koneksi, "SELECT * FROM tamu where tanggal like '%$tgl%' order by id desc");
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
		</div>
	</div>
</div>

<!-- Panggil file footer -->
<?php include "footer.php"; ?>