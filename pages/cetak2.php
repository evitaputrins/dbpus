<?php
include "../koneksi.php";

?>
<link rel="stylesheet" type="text/css" href="../style.css">
<div id="content">
    <div id="beranda-judul-cetak">
		<h1>Data Buku Perpustakaan</h1>
	</div>
<table border="1" id="tabel-tampil">
		<tr>
        <th id="label-tampil-no">No</td>
			<th>ID Buku</th>
			<th>Judul Buku</th>
			<th>Kategori</th>
			<th>Pengarang</th>
            <th>Penerbit</th>
			<th>Foto</th>
		</tr>
		
		<?php		
		$nomor=1;
		$query="SELECT * FROM tbbuku ORDER BY idbuku ASC";
		$q_tampil_buku = mysqli_query($db, $query);
		if(mysqli_num_rows($q_tampil_buku)>0)
		{
		while($r_tampil_buku=mysqli_fetch_array($q_tampil_buku)){
			if(empty($r_tampil_buku['foto'])or($r_tampil_buku['foto']=='-'))
				$foto = "buku.jpg";
			else
				$foto = $r_tampil_buku['foto'];
		?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $r_tampil_buku['idbuku']; ?></td>
			<td><?php echo $r_tampil_buku['judulbuku']; ?></td>
			<td><?php echo $r_tampil_buku['kategori']; ?></td>
			<td><?php echo $r_tampil_buku['pengarang']; ?></td>
            <td><?php echo $r_tampil_buku['penerbit']; ?></td>
            <td><img src="../images/<?php echo $foto; ?>" width=70px height=70px></td>		
		</tr>		
		<?php $nomor++; } 
		}?>		
	</table>
	<script>
		window.print();
	</script>
</div>
