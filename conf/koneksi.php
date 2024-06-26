<?php
$host = "localhost";
$user = "root";
$paswd ="";
$db = "belajarphp";
$koneksi = mysqli_connect($host,$user,$paswd,$db);

// function showDosen($data){
//     global $koneksi;
//     $query=mysqli_query($koneksi,$data);
//     $dosen=[];
//     while($dsn=mysqli_fetch_assoc($query)){
//         $dosen[]=$dsn;
//     }
//     return $dosen;
// }
// function tambahDosen($data){
//     global $koneksi;
//     $nama=$data['nama'];
//     $query="INSERT INTO dosen VALUES ('','$nama')";
//     mysqli_query($koneksi,$query);
// }

function hapus($id){
    global $koneksi;
    mysqli_query($koneksi,"DELETE FROM dosen WHERE nidn=$id");

    return mysqli_affected_rows($koneksi);
}

function hapusMhs($id){
    global $koneksi;
    mysqli_query($koneksi,"DELETE FROM mahasiswa WHERE id=$id");

    return mysqli_affected_rows($koneksi);
}

function hapusMatkul($kdmk){
    global $koneksi;
    mysqli_query($koneksi,"DELETE FROM makul WHERE kdmk=$kdmk");

    return mysqli_affected_rows($koneksi);
}

function hapusKrs($id){
    global $koneksi;
    mysqli_query($koneksi,"DELETE FROM krs WHERE id=$id");

    return mysqli_affected_rows($koneksi);
}