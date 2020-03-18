<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
	$jenis = $nama_sptpd->row();
?>
<h2>Laporan Pajak <?php echo $jenis->nama_sptpd; ?>&nbsp;<?php echo $per; ?><hr /></h2>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
		  <td width="3%" rowspan="3"><div align="center"><strong>NO.</strong></div></td>
		  <td width="13%" rowspan="3"><div align="center"><strong>NAMA WAJIB PAJAK</strong></div></td>
		  <td width="13%" rowspan="3"><div align="center"><strong>ALAMAT</strong></div></td>
			<td colspan="3"><div align="center"><strong>REALISASI (Rp)</strong></div></td>
		  <td width="12%" rowspan="3"><div align="center"><strong>TOTAL (Rp)</strong></div></td>
		  <td width="8%" rowspan="3"><div align="center"><strong>TANGGAL</strong></div></td>
		  <td width="14%" rowspan="3"><div align="center"><strong>NO. KWT</strong></div></td>
			<td width="11%" rowspan="3"><div align="center"><strong>KET</strong></div></td>
		</tr>
		<tr>
	  	  <td width="9%"><div align="center"><strong>Karaoke</strong></div></td>
		  <td width="10%"><div align="center"><strong>Bilyard</strong></div></td>
			<td width="7%"><div align="center"><strong>Permainan Anak</strong></div></td>
		</tr>
		<tr>
			<td><div align="center"><strong>&nbsp;</strong></div></td>
			<td><div align="center"><strong>&nbsp;</strong></div></td>
			<td><div align="center"><strong>&nbsp;</strong></div></td>
		</tr>
		<tr>
			<td bgcolor="#CCCCCC"><strong>A.</strong></td>
			<td bgcolor="#CCCCCC"><strong>Karaoke</strong></td>
			<td bgcolor="#CCCCCC"></td>
			<td bgcolor="#CCCCCC"></td>
			<td bgcolor="#CCCCCC"></td>
			<td bgcolor="#CCCCCC"></td>
			<td bgcolor="#CCCCCC"></td>
			<td bgcolor="#CCCCCC"></td>
			<td bgcolor="#CCCCCC"></td>
			<td bgcolor="#CCCCCC"></td>
		</tr>
	<?php foreach($sql->result() as $data){?>
		<tr>
			<td><?php echo $data->id; ?></td>
			<td><?php echo $data->nama_perusahaan; ?></td>
			<td><?php echo $data->alamat_perusahaan; ?></td>
			<td><div align="right"><?php echo $data->setoran; ?></div></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><div align="right"><?php echo $data->setoran; ?></div></td>
			<td><?php echo $data->tanggal; ?></td>
			<td><?php echo $data->no_sspd; ?></td>
			<td><?php echo $data->keterangan ?></td>			
		</tr>
	<?php } ?>
		<tr>
			<td bgcolor="#CCCCCC"><strong>B.</strong></td>
			<td bgcolor="#CCCCCC"><strong>Bilyard</strong></td>
			<td bgcolor="#CCCCCC"></td>
			<td bgcolor="#CCCCCC"></td>
			<td bgcolor="#CCCCCC"></td>
			<td bgcolor="#CCCCCC"></td>
			<td bgcolor="#CCCCCC"></td>
			<td bgcolor="#CCCCCC"></td>
			<td bgcolor="#CCCCCC"></td>
			<td bgcolor="#CCCCCC"></td>
		</tr>
		<?php foreach($sql2->result() as $data2){?>
		<tr>
			<td><?php echo $data2->id; ?></td>
			<td><?php echo $data2->nama_perusahaan; ?></td>
			<td><?php echo $data2->alamat_perusahaan; ?></td>
			<td></td>
			<td><div align="right"><?php echo $data2->setoran; ?></div></td>
			<td>&nbsp;</td>
			<td><div align="right"><?php echo $data2->setoran; ?></div></td>
			<td><?php echo $data2->tanggal; ?></td>
			<td><?php echo $data2->no_sspd; ?></td>
			<td>&nbsp;</td>		
		</tr>
	<?php } ?>
		<tr>
		  <td colspan="3" bgcolor="#00FF99"><div align="center">Jumlah</div></td>
			<td bgcolor="#00FF99"><div align="right">
				<?php 
					$hasil = 0;
					foreach($sql->result() as $data){
						$hasil=$hasil + $data->setoran;
					}
					echo "Rp. $hasil";
				?>
				</div>
		  </td>
			<td bgcolor="#00FF99">
			<div align="right">
			<?php 
					$hasil = 0;
					foreach($sql2->result() as $data2){
						$hasil=$hasil + $data2->setoran;
					}
					echo "Rp. $hasil";
				?>
			</div>
		  </td>
			<td bgcolor="#00FF99">&nbsp;</td>
			<td bgcolor="#00FF99"><div align="right">
			<?php 
					$tot = 0;
					foreach($total->result() as $datot){
						$tot=$tot + $datot->setoran;
					}
					echo "Rp. $tot";
			?>
		  </div></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
		  <td colspan="3" bgcolor="#CCFF33"><div align="center">Jumlah <?php echo $sblm ?></div></td>
			<td bgcolor="#CCFF33"><div align="right">
				<?php 
					$tot_sblm = 0;
					foreach($tot_sebelum->result() as $datot_sebelum){
						$tot_sblm=$tot_sblm + $datot_sebelum->setoran;
					}
					echo "Rp. $tot_sblm";
				?>
		  </div></td>
			<td bgcolor="#CCFF33">
			<div align="right">
			<?php 
					$tot_sblm2 = 0;
					foreach($tot_sebelum2->result() as $datot_sebelum2){
						$tot_sblm2=$tot_sblm2 + $datot_sebelum2->setoran;
					}
					echo "Rp. $tot_sblm2";
				?>
			
			</div>
			</td>
			<td bgcolor="#CCFF33">&nbsp;</td>
			<td bgcolor="#CCFF33">
				<div align="right">
				<?php 
					$tot_sblm_all = 0;
					foreach($tot_sebelum_all->result() as $datot_sebelum_all){
						$tot_sblm_all=$tot_sblm_all + $datot_sebelum_all->setoran;
					}
					echo "Rp. $tot_sblm_all";
				?>
				</div>
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>	
		<tr>
		  <td colspan="3" bgcolor="#66FFFF"><div align="center">Jumlah Sampai <?php echo $ini ?></div></td>
			<td bgcolor="#66FFFF">
			<div align="right">
			<?php 
					$tot_2 = 0;
					foreach($tot2->result() as $datot_2){
						$tot_2=$tot_2 + $datot_2->setoran;
					}
					echo "Rp. $tot_2";
			?>
			</div>
			</td>
			<td bgcolor="#66FFFF">
			<div align="right">
			<?php 
					$tot_3 = 0;
					foreach($tot3->result() as $datot_3){
						$tot_3=$tot_3 + $datot_3->setoran;
					}
					echo "Rp. $tot_3";
			?>
			</div>
			</td>
			<td bgcolor="#66FFFF">&nbsp;</td>
			<td bgcolor="#66FFFF"><div align="right">
			<?php 
					$totbgt = 0;
					foreach($total_bgt->result() as $datot_bgt){
						$totbgt=$totbgt + $datot_bgt->setoran;
					}
					echo "Rp. $totbgt";
			?>
		  </div></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>		
</table>
<br />
</body>
</html>