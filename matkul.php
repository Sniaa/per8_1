<?php include('navbar.php') ?>
<?php
require_once('conf/koneksi.php');
if (isset($_POST['submit'])) {
  $matkul = $_POST['matkul'];
  $sks = $_POST['sks'];
  $query = "INSERT INTO makul
 VALUES
 ('','$matkul','$sks')";
  mysqli_query($koneksi, $query)or die(mysqli_error($koneksi));
  echo "<div align='center'><h5> Silahkan Tunnggu Dta Sedang Di Simpan.... </h5></div>";
  echo "<meta http-equiv='refresh' content='1;url=http://localhost/layout/matkul.php'>";
}


// query update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
  $kdmk = $_POST['kdmk'];
  $matkul = $_POST['matkul'];
  $sks = $_POST['sks'];

  // Query untuk melakukan update data matkul
  $update_query = "UPDATE makul SET matkul = '$matkul', sks = '$sks' WHERE kdmk = '$kdmk'";
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
          <h6>Table Matkul</h6>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Matkul</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="" method="POST">
                      <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">Matkul</label>
                        <input type="text" class="form-control" placeholder="Matkul" name="matkul">
                      </div>
                      <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">SKS</label>
                        <input type="int" class="form-control" placeholder="jumlah sks" name="sks">
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
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">SKS</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Aksi</th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                <?php
                require_once "conf/koneksi.php";
                $no = 1;
                $tampil = mysqli_query($koneksi, "SELECT * FROM makul");


                ?>
                <?php while ($data = mysqli_fetch_array($tampil)) : ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['matkul']; ?></td>
                    <td><?php echo $data['sks']; ?></td>
                    <td>
                      <!-- <a href="../Adminmakul/edit.php?id=<?= $data['kdmk']; ?>" class="btn btn-sm btn-warning">Edit</a> -->
                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editMakul<?= $data['kdmk'] ?>">
                        edit
                      </button>
                     <a class="btn btn-danger" href="aksi/hapusmatkul.php?kdmk=<?=$data['kdmk'];?>" onclick="return confirm('Apakah Anda yakin')";>hapus</a>
                    </td>
                  </tr>
                  <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- modal Edit -->
   
        <?php foreach ($tampil as $dsn) : ?>
          <div class="modal fade" id="editMakul<?= $dsn['kdmk']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Data Matkul</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="" method="POST">
                    <div class="mb-3">
                      <input type="hidden" name="kdmk"  value="<?=$dsn['kdmk'];?>">
                      <label for="disabledTextInput" class="form-label">Matkul</label>
                      <input type="text" class="form-control" placeholder="Matkul" name="matkul" value="<?= $dsn['matkul']; ?>">
                    </div>
                    <div class="mb-3">
                      <label for="disabledTextInput" class="form-label">sks</label>
                      <input type="int" class="form-control" placeholder="sks" name="sks" value="<?= $dsn['sks']; ?>">
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