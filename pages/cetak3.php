<?php
include "../koneksi.php";

?>
<link rel="stylesheet" type="text/css" href="../style.css">
<div id="content">
    <div id="beranda-judul-cetak">
		<h1>Data Transaksi Perpustakaan</h1>
	</div>
<table border="1" id="tabel-tampil">
		<tr>
        <th id="label-tampil-no">No</td>
			<th>ID Transaksi</th>
			<th>ID Anggota</th>
			<th>ID buku</th>
			<th>Tanggal Peminjaman</th>
            <th>Tanggal Pengembalian</th>
			<th>Foto</th>
		</tr>
		
		<?php		
		$nomor=1;
		$query="SELECT * FROM tbtransaksi ORDER BY idtransaksi ASC";
		$q_tampil_buku = mysqli_query($db, $query);
		if(mysqli_num_rows($q_tampil_transaksi)>0)
		{
		while($r_tampil_transaksi=mysqli_fetch_array($q_tampil_transaksi)){
			if(empty($r_tampil_transaksi['foto'])or($r_tampil_transaksi['foto']=='-'))
				$foto = "transaksi.jpg";
			else
				$foto = $r_tampil_transaksi['foto'];
		?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $r_tampil_transaksi['idtransaksi']; ?></td>
			<td><?php echo $r_tampil_transaksi['idanggota']; ?></td>
			<td><?php echo $r_tampil_transaksi['idbuku']; ?></td>
			<td><?php echo $r_tampil_transaksi['tglpinjam']; ?></td>
            <td><?php echo $r_tampil_transaksi['tglkembali']; ?></td>
            <td><img src="../images/<?php echo $foto; ?>" width=70px height=70px></td>		
		</tr>		
		<?php $nomor++; } 
		}?>		
	</table>
	<script>
		window.print();
	</script>
</div>
