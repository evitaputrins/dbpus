<div id="content">
	<div id="beranda-judul-data">
		<h1>Data Buku Perpustakaan</h1>
	</div>
	<form class="form-inline" method="POST">
	<div align="right">
		<form method=post><input type="text" name="pencarian"><input type="submit" name="search" value="search" class="tombol"></form>
	</form>
	<br>
	<table id="tabel-tampil"> <br><br>
		<tr>
			<th id="label-tampil-no">No</td>
			<th>ID Buku</th>
			<th>Judul Buku</th>
			<th>Foto</th>
			<th>Kategori</th>
			<th>Pengarang</th>
            <th>Penerbit</th>
			<th>Status</th>
			<th id="label-opsi">Opsi</th>
		</tr>
		
		<?php
		$batas = 3;
		extract($_GET);
		if(empty($hal)){
			$posisi = 0;
			$hal = 1;
			$nomor = 1;
		}
		else {
			$posisi = ($hal - 1) * $batas;
			$nomor = $posisi+1;
		}	
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$pencarian = trim(mysqli_real_escape_string($db, $_POST['pencarian']));
			if($pencarian != ""){
				$sql = "SELECT * FROM tbbuku WHERE judulbuku LIKE '%$pencarian%'
						OR idbuku LIKE '%$pencarian%'
						OR kategori LIKE '%$pencarian%'
						OR pengarang LIKE '%$pencarian%'";
				$query = $sql;
				$queryJml = $sql;	
						
			}
			else {
				$query = "SELECT * FROM tbbuku LIMIT $posisi, $batas";
				$queryJml = "SELECT * FROM tbbuku";
				$no = $posisi * 1;
			}			
		}
		else {
			$query = "SELECT * FROM tbbuku LIMIT $posisi, $batas";
			$queryJml = "SELECT * FROM tbbuku";
			$no = $posisi * 1;
		}
		
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
			<td><?php echo $nomor++; ?></td>
			<td><?php echo $r_tampil_buku['idbuku']; ?></td>
			<td><?php echo $r_tampil_buku['judulbuku']; ?></td>
			<td><img src="images/<?php echo $foto; ?>" width=70px height=70px></td>
			<td><?php echo $r_tampil_buku['kategori']; ?></td>
			<td><?php echo $r_tampil_buku['pengarang']; ?></td>
            <td><?php echo $r_tampil_buku['penerbit']; ?></td>
			<td><?php echo $r_tampil_buku['status']; ?></td>
			<td>
				<div class="tombol-opsi-container"><a href="index.php?p=buku-edit&id=<?php echo $r_tampil_buku['idbuku'];?>" class="tombol">Edit</a>&emsp;&emsp;</div>
				<div class="tombol-opsi-container"><a href="proses/buku-hapus.php?id=<?php echo $r_tampil_buku['idbuku']; ?>" onclick = "return confirm ('Apakah Anda Yakin Akan Menghapus Data Ini?')" class="tombol">Hapus</a></div>
			</td>
		</tr>
		<?php $nomor++; } 
		}
		else {
			echo "<tr><td colspan=6>Data Tidak Ditemukan</td></tr>";
		}?>		
	</table>
	<?php
	if(isset($_POST['pencarian'])){
	if($_POST['pencarian']!=''){
		echo "<div style=\"float:left;\">";
		$jml = mysqli_num_rows(mysqli_query($db, $queryJml));
		echo "Data Hasil Pencarian: <b>$jml</b>";
		echo "</div>";
	}
	}
	else{ ?>
		<br><div style="float: left;">		
		&emsp; <?php
			$jml = mysqli_num_rows(mysqli_query($db, $queryJml));
			echo "Jumlah Data : <b>$jml</b>";
		?>			
		</div>	
		<style>
			.pagination {
 				 display: flex;
 				 float: right;
			}

			.pagination a {
  				color: black;
  				float: left;
  				padding: 8px 16px;
  				text-decoration: none;
			}

			.pagination a.active {
  				 background-color: #4caf50;
  				 color: white;
 				 border-radius: 5px;
			}

			.pagination a:hover:not(.active) {
  				 background-color: #ddd;
  				 border-radius: 5px;
			}	
		</style>
		<div class="pagination">		
			<?php
				$jml_hal = ceil($jml/$batas);
				for($i=1; $i<=$jml_hal; $i++){
					if($i != $hal){
						echo "<a href=\"?p=buku&hal=$i\">$i</a>";
					}
					else {
						echo "<a class=\"active\">$i</a>";
					}
				}
			?>
		</div>
		
		&emsp;<p id="tombol-tambah-container2"><a href="index.php?p=buku-input" class="tombol">Tambah Data Buku</a>
		&emsp;<p id="tombol-tambah-container"><a href="pages/cetak2.php" class="tombol">Cetak Data</a>
	<?php } ?>
</div>