<?php 
    include "../conf/koneksi.php";
    $kdmk = $_GET['kdmk'];
    $ambilData = mysqli_query($koneksi, "DELETE FROM  makul WHERE kdmk='$kdmk'");
    echo "<meta http-equiv='refresh' content='1;url=http://localhost/layout/matkul.php'>";

    if (hapus($kdmk) > 0) {
        echo "
        <script>
        alert('data Berhasil Dihapus !');
        document.location.href='../matkul.php';
        </script>
        ";
    }
?>
