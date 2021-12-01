<?php
include'../koneksi.php';

$id_buku=$_POST['id_buku'];
$judul_buku=$_POST['judul_buku'];
$kategori=$_POST['kategori'];
$pengarang=$_POST['pengarang'];
$penerbit=$_POST['penerbit'];
$status="Tersedia";
	
if(isset($_POST['simpan'])){
	extract($_POST);
		$nama_file   = $_FILES['foto']['name'];
		if(!empty($nama_file)){
		// Baca lokasi file sementar dan nama file dari form (fupload)
		$lokasi_file = $_FILES['foto']['tmp_name'];
		$tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
		$file_foto = $id_buku.".".$tipe_file;

		// Tentukan folder untuk menyimpan file
		$folder = "../images/$file_foto";
		// Apabila file berhasil di upload
		move_uploaded_file($lokasi_file,"$folder");
		}
		else
			$file_foto="-";

	$sql = 
	"INSERT INTO tbbuku
		VALUES('$id_buku', '$judul_buku', '$kategori', '$pengarang', '$penerbit', '$file_foto', '$status')";
	$query = mysqli_query($db, $sql);

	header("location:../index.php?p=buku");
}
?>