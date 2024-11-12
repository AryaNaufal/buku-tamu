<?php include "header.php"; ?>

<div class="row">
  <div class="col-md-12">
    <!-- awal card -->
    <div class="card shadow mb-4 mt-3">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Pengunjung</h6>
      </div>
      <div class="card-body">
        <form class="text-center" method="POST">
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">Dari tanggal</label>
                <input class="form-control" type="date" name="tanggal1" value="<?= isset($_POST['tanggal1']) ? $_POST['tanggal1'] : date('Y-m-d') ?>" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">Dari tanggal</label>
                <input class="form-control" type="date" name="tanggal2" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-2">
              <button class="btn btn-primary form-control" name="tampilkan">
                <i class="fa fa-search"></i> Tampilkan
              </button>
            </div>
            <div class="col-md-2">
              <a href="admin.php" class="btn btn-danger form-control" name="tampilkan">
                <i class="fa fa-backward"></i> Kembali
              </a>
            </div>
          </div>
        </form>
        <?php if (isset($_POST['tampilkan'])) : ?>
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
                $tgl1 = $_POST['tanggal1'];
                $tgl2 = $_POST['tanggal2'];
                $tampil = mysqli_query($koneksi, "SELECT * FROM tamu WHERE tanggal BETWEEN '$tgl1' AND '$tgl2' order by id desc");
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
            <center>
              <form method="POST" action="exportexcel.php">
                <div class="col-md-4">
                  <input type="hidden" name="tanggala" value="<?= $_POST['tanggal1'] ?>">
                  <input type="hidden" name="tanggalb" value="<?= $_POST['tanggal2'] ?>">
                </div>

                <button class="btn btn-success form-control" name="export">
                  <i class="fa fa-file-excel"></i> Export Data Excel
                </button>
              </form>
            </center>
          </div>
        <?php endif; ?>
      </div>
    </div>

  </div>
</div>

<?php include "footer.php"; ?>