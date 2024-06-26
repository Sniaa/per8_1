<?php include('navbar.php') ?>
<?php
require_once('conf/koneksi.php');
if (isset($_POST['submit'])) {
  $nim = $_POST['nim'];
  $kdmk = $_POST['kdmk'];
  $nidn = $_POST['nidn'];
  $uts = $_POST['uts'];
  $uas = $_POST['uas'];
  $ruangan = $_POST['ruangan'];
  $tahunAjar = $_POST['tahunajaran'];
  $query = "INSERT INTO krs
 VALUES
 ('',$nim','$kdmk','$nidn','$uts','$uas','$ruangan','$tahunAjar')";
  mysqli_query($koneksi, $query)or die(mysqli_error($koneksi));
  echo "<div align='center'><h5> Silahkan Tunnggu Dta Sedang Di Simpan.... </h5></div>";
  echo "<meta http-equiv='refresh' content='1;url=http://localhost/layout/krs.php'>";
}


// query update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
  $id = $_POST['id'];
  $nim = $_POST['nim'];
  $kdmk = $_POST['kdmk'];
  $nidn = $_POST['nidn'];
  $uts = $_POST['uts'];
  $uas = $_POST['uas'];
  $ruangan = $_POST['ruangan'];
  $tahunAjar = $_POST['tahunajaran'];

  // Query untuk melakukan update data krs
  $update_query = "UPDATE krs SET nama = '$nama' WHERE id = '$id'";
  if ($koneksi->query($update_query) === TRUE) {
      // Refresh halaman setelah update berhasil
      echo "<meta http-equiv='refresh' content='0'>";
  } else {
      echo "Gagal melakukan update data.";
  }
}

?>
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Table KRS</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Tambah Data
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data krs</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="" method="POST">
                      <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">Nim</label>
                        <input type="text" class="form-control" placeholder="Nim Mahasiswa" name="nim">
                      </div>
                      <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">Kdmk</label>
                        <input type="text" class="form-control" placeholder="Kode MataKuliah" name="kdmk">
                      </div>
                      <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">Nidn</label>
                        <input type="text" class="form-control" placeholder="Nidn Dosen" name="nidn">
                      </div>
                      <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">UTS</label>
                        <input type="text" class="form-control" placeholder="Nilai UTS" name="uts">
                      </div>
                      <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">UAS</label>
                        <input type="text" class="form-control" placeholder="Nilai UAS" name="uas">
                      </div>
                      <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">Ruang</label>
                        <input type="text" class="form-control" placeholder="Ruang Berapa" name="ruangan">
                      </div>
                      <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">Tahun Ajaran</label>
                        <input type="text" class="form-control" placeholder="Tahun Ajaran" name="tahunajaran">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mahasiswa</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">MATKUL</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DOSEN</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">UTS</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">UAS</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ruang</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tahun Ajaran</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Aksi</th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                <?php
                require_once "conf/koneksi.php";
                $no = 1;
                $tampil = mysqli_query($koneksi, "SELECT * FROM krs");


                ?>
                <?php while ($data = mysqli_fetch_array($tampil)) : ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['nim']; ?></td>
                    <td><?php echo $data['kdmk']; ?></td>
                    <td><?php echo $data['nidn']; ?></td>
                    <td><?php echo $data['uts']; ?></td>
                    <td><?php echo $data['uas']; ?></td>
                    <td><?php echo $data['ruangan']; ?></td>
                    <td><?php echo $data['tahunajaran']; ?></td>
                    <td>
                      <!-- <a href="../Adminkrs/edit.php?id=<?= $data['id']; ?>" class="btn btn-sm btn-warning">Edit</a> -->
                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editKrs<?= $data['id'] ?>">
                        edit
                      </button>
                     <a class="btn btn-danger" href="aksi/hapuskrs.php?id=<?=$data['id'];?>" onclick="return confirm('Apakah Anda yakin')";>hapus</a>
                    </td>
                  </tr>
                  <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- modal Edit -->
   
        <?php foreach ($tampil as $dsn) : ?>
          <div class="modal fade" id="editKrs<?= $dsn['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Data Krs</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="" method="POST">
                    <div class="mb-3">
                      <input type="hidden" name="id"  value="<?=$dsn['id'];?>">
                      <label for="disabledTextInput" class="form-label">Nim</label>
                      <input type="text" class="form-control" placeholder="Masukan nama" name="nim" value="<?= $dsn['nim']; ?>">
                    </div>
                    <div class="mb-3">
                      <label for="disabledTextInput" class="form-label">Matkul</label>
                      <input type="text" class="form-control" placeholder="Masukan nama" name="makul" value="<?= $dsn['kdmk']; ?>">
                    </div>
                    <div class="mb-3">
                      <label for="disabledTextInput" class="form-label">Dosen</label>
                      <input type="text" class="form-control" placeholder="Masukan nama" name="nidn" value="<?= $dsn['nidn']; ?>">
                    </div>
                    <div class="mb-3">
                      <label for="disabledTextInput" class="form-label">UTS</label>
                      <input type="text" class="form-control" placeholder="Masukan nama" name="uts" value="<?= $dsn['uts']; ?>">
                    </div>
                    <div class="mb-3">
                      <label for="disabledTextInput" class="form-label">UAS</label>
                      <input type="text" class="form-control" placeholder="Masukan nama" name="uas" value="<?= $dsn['uas']; ?>">
                    </div>
                    <div class="mb-3">
                      <label for="disabledTextInput" class="form-label">Ruang</label>
                      <input type="text" class="form-control" placeholder="Masukan nama" name="ruangan" value="<?= $dsn['ruangan']; ?>">
                    </div>
                    <div class="mb-3">
                      <label for="disabledTextInput" class="form-label">Tahun Ajaran</label>
                      <input type="text" class="form-control" placeholder="Masukan nama" name="tahunAjar" value="<?= $dsn['tahunajaran']; ?>">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" name="update" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
    </div>
  </div>
</div>

<?php include('footer.php') ?>