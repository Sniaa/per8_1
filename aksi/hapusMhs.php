<?php 
    include "../conf/koneksi.php";
    $id = $_GET['id'];
    $ambilData = mysqli_query($koneksi, "DELETE FROM  mahasiswa WHERE id='$id'");
    echo "<meta http-equiv='refresh' content='1;url=http://localhost/layout/mahasiswa.php'>";

    if (hapus($id) > 0) {
        echo "
        <script>
        alert('data Berhasil Dihapus !');
        document.location.href='../mahasiswa.php';
        </script>
        ";
    }
?>
