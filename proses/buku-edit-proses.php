<?php
include'../koneksi.php';

$id_buku=$_POST['id_buku'];
$judul_buku=$_POST['judul_buku'];
$kategori=$_POST['kategori'];
$penerbit=$_POST['penerbit'];

If(isset($_POST['simpan'])){
	extract($_POST);
		$nama_file   = $_FILES['foto']['name'];
		if(!empty($nama_file)){
		// Baca lokasi file sementar dan nama file dari form (fupload)
		$lokasi_file = $_FILES['foto']['tmp_name'];
		$tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
		$file_foto = $id_buku.".".$tipe_file;
		// Tentukan folder untuk menyimpan file
		$folder = "../images/$file_foto";
		@unlink ("$folder");
		// Apabila file berhasil di upload
		move_uploaded_file($lokasi_file,"$folder");
		}
		else
			$file_foto=$foto_awal;

	mysqli_query($db,
		"UPDATE tbbuku
		SET judulbuku='$judul_buku', kategori='$kategori', penerbit='$penerbit' ,foto='$file_foto'
		WHERE idbuku='$id_buku'"
	);
	header("location:../index.php?p=buku");
}
?>