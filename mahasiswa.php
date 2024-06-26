<?php include('navbar.php') ?>
<?php
require_once('conf/koneksi.php');

if (isset($_POST['submit'])) {
    // Ambil data dari form
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $jurusan = $_POST['jurusan'];
    $foto = $_POST['foto'];
    $query = "INSERT INTO mahasiswa
    VALUES
    ('','$nim','$nama','$email','$jurusan','$foto')";
     mysqli_query($koneksi, $query)or die(mysqli_error($koneksi));
     echo "<div align='center'><h5> Silahkan Tunnggu Dta Sedang Di Simpan.... </h5></div>";
     echo "<meta http-equiv='refresh' content='1;url=http://localhost/layout/mahasiswa.php'>";
   }


// query update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
  $id = $_POST['id'];
  $nim = $_POST['nim'];
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $jurusan = $_POST['jurusan'];
  $foto = $_POST['foto'];

  // Query untuk melakukan update data mahasiswa
  $update_query = "UPDATE mahasiswa SET nim='$nim', nama = '$nama', email = '$email', jurusan = '$jurusan', foto = '$foto'  WHERE id = '$id'";
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
          <h6>table Mahasiswa</h6>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="" method="POST">
                      <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">Nim</label>
                        <input type="text" class="form-control" placeholder="nim" name="nim">
                      </div>
                      <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">Nama</label>
                        <input type="text" class="form-control" placeholder="nama" name="nama">
                      </div>
                      <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="email" name="email">
                      </div>
                      <div class="mb-3">
                            <label for="jurusan">jurusan</label>
                            <select type="text" name="jurusan" class="form-control col-md-9">
                                <option selected>jurusan</option>
                                <option value="Sistem Informasi">Sistem Informasi</option>
                                <option value="Teknik Informatika" >Teknik Informatika</option>
                            </select>
                        </div>
                      <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">foto</label>
                        <input type="file" class="form-control" placeholder="foto" name="foto">
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
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nim</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">email</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">jurusan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">foto</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Aksi</th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                <?php
                require_once "conf/koneksi.php";
                $no = 1;
                $tampil = mysqli_query($koneksi, "SELECT * FROM mahasiswa");


                ?>
                <?php while ($data = mysqli_fetch_array($tampil)) : ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['nim']; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo $data['email']; ?></td>
                    <td><?php echo $data['jurusan']; ?></td>
                    <td><img src="file/<?= $data['foto'];?>"width="50px" height="50px"></td>
                     <td>
                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editMhs<?= $data['id'] ?>">
                        edit
                      </button>
                     <a class="btn btn-danger" href="aksi/hapusMhs.php?id=<?=$data['id'];?>" onclick="return confirm('Apakah Anda yakin')";>hapus</a>
                    </td>
                  </tr>
                  <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- modal Edit -->
   
        <?php foreach ($tampil as $dsn) : ?>
          <div class="modal fade" id="editMhs<?= $dsn['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mahasiswa</h5>
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
                        <label for="disabledTextInput" class="form-label">Nama</label>
                        <input type="text" class="form-control" placeholder="Masukan nama" name="nama" value="<?= $dsn['nama']; ?>">
                      </div>
                      <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">email</label>
                        <input type="email" class="form-control" name="email" value="<?= $dsn['email']; ?>">
                      </div>
                      <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">Jurusan</label>
                        <select type="text" class="form-control" name="jurusan" value="<?= $dsn['jurusan']; ?>">
                            <option selected>jurusan</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                            <option value="Teknik Informatika" >Teknik Informatika</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">foto</label>
                        <input type="file" name="foto"  class="form-control col-md-9">
                          <img src="file/<?=$data['foto']?>" alt="current foto" width="100"><br>
                      </div>  
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