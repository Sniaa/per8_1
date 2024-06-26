<?php
require_once('../conf/koneksi.php');
$id = $_GET['nidn'];
if (hapus($id) > 0) {
    echo "
    <script>
    alert('data Berhasil Dihapus !');
    document.location.href='../dosen.php';
    </script>
    ";
}
