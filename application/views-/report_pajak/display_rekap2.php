<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<script type="text/javascript" src="<?php echo base_url();?>assets/numberFormat.js"></script>
</head>

<body bgcolor="#FFFFFF">
<?php
$t = explode('-',$tgl);
$time = $t[2].'-'.$t[1].'-'.$t[0];

if($bank=='200'){
	$nm = 'BANK NAGARI';
} else if($bank=='300'){
	$nm = 'BANK BTN';
} else if($bank=='0009'){
	$nm = 'BANK BNI';
}
?>
<table width="1200">
	<tr>
    	<td align="center"><h2 align="center">REKAPITULASI PENERIMAAN HARIAN<br />
TANGGAL <?php echo $time; ?><br />
<?php echo $nm; ?></h2></td>
	</tr>
    <tr>
    	<td height="20">&nbsp;</td>
    </tr>
</table>

<table border="1" cellspacing="3" cellpadding="3" class="style_border">
  <tr>
    <th width="50">NO.</th>
    <th width="300">JENIS PAJAK</th>
    <th width="250">GOLONGAN JENIS PAJAK</th>
    <th width="150">PAJAK TAHUN <br/> BERJALAN</th>
    <th width="150">PIUTANG PAJAK</th>
    <th width="150">DENDA</th>
    <th width="150">TOTAL BAYAR</th>
  </tr>
  
  <?php
  	$qr = "";
	$tjumlah = 0;
	$ttetap = 0;
	$tdenda = 0;
	$tsetoran = 0;
	
	$pajak = $this->db->query("select kode_sptpd, nama_sptpd from master_sptpd order by id asc");
	$ro = 1;
	foreach($pajak->result() as $p){
		$kode = $p->kode_sptpd;
		$nama = $p->nama_sptpd;
	?>
    
    	<tr>
    		<td align="center"><strong><?php echo $ro; ?></strong></td>
            <td colspan="6"><strong>&nbsp;<?php echo strtoupper('Pajak '.$nama); ?></strong></td>
        </tr>
    
    <?php		
		$que = $this->db->query("SELECT sspd.nomor, sspd.npwpd, sspd.ketetapan, sspd.denda, sspd.setoran FROM sspd INNER JOIN view_perusahaan ON sspd.npwpd = view_perusahaan.npwpd_perusahaan where sspd.pembayaran = '".$bank."' and sspd.tanggal = '".$tgl."' and sspd.kode_pajak = '".$kode."'");
		
		$no = 1;
		$jumlah = 0;
		$tetap = 0;
		$denda = 0;
		$setoran = 0;
		foreach($que->result() as $q){
			$nop = $q->nomor;
			
			if($kode=='REK'){
				$spt = $this->db->query("select a.rek_reklame as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_reklame a left join master_rekening b on a.rek_reklame=b.kd_rek left join view_no c on a.no_sptpd=c.sptpd where c.no_skpd = '".$nop."'")->row();
				$pajak = 'Reklame';
				
			} else if($kode=='AIR'){
				$spt = $this->db->query("select a.rek_air as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_air_bawah_tanah a left join master_rekening b on a.rek_air=b.kd_rek left join view_no c on a.no_sptpd=c.sptpd where c.no_skpd = '".$nop."'")->row();
				$pajak = 'Air Tanah';
				
			} else if($kode=='HTL'){
				$spt = $this->db->query("select a.gol_hotel as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_hotel a left join master_rekening b on a.gol_hotel=b.kd_rek where a.no_sptpd = '".$nop."'")->row();
				$pajak = 'Hotel';
				
			} else if($kode=='RES'){
				$spt = $this->db->query("select a.gol_restoran as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_restoran a left join master_rekening b on a.gol_restoran=b.kd_rek where a.no_sptpd = '".$nop."'")->row();
				$pajak = 'Restoran';
				
			} else if($kode=='HIB'){
				$spt = $this->db->query("select a.jenis_hiburan as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_hiburan a left join master_rekening b on a.jenis_hiburan=b.kd_rek where a.no_sptpd = '".$nop."'")->row();
				$pajak = 'Hiburan';
				
			} else if($kode=='LIS'){
				$spt = $this->db->query("select a.gol_tarif as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_listrik a left join master_rekening b on a.gol_tarif=b.kd_rek where a.no_sptpd = '".$nop."'")->row();
				$pajak = 'Penerangan Jalan';
				
			} else if($kode=='GAL'){
				$spt = $this->db->query("select a.rekening as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_galianc a left join master_rekening b on a.rekening=b.kd_rek where a.no_sptpd = '".$nop."'")->row();
				$pajak = 'Mineral Bukan Logam dan Batuan';
				
			} else if($kode=='WLT'){
				$spt = $this->db->query("select a.golongan as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_burung_walet a left join master_rekening b on a.golongan=b.kd_rek where a.no_sptpd = '".$nop."'")->row();
				$pajak = 'Sarang Burung Walet';
				
			} else if($kode=='PKR'){
				$spt = $this->db->query("select a.golongan as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_parkir a left join master_rekening b on a.golongan=b.kd_rek where a.no_sptpd = '".$nop."'")->row();
				$pajak = 'Parkir';		
			}
			
			$thn = date('Y');
			//pajak tahun berjalan
			/*$setor = $this->db->query("select sum(setoran) as jumlah from sspd where nomor = '".$sptpd."' and tahun_pajak = '".$thn."'")->row();
			$ptb = $setor->jumlah;
			if($ptb==NULL){*/
				$ptb = 0;
			//}
			
			$piutang = $this->db->query("select sum(ketetapan) as tetap, sum(denda) as denda, sum(setoran) as jumlah from sspd where nomor = '".$nop."'")->row();
			$j = $piutang->jumlah;
			$t = $piutang->tetap;
			$d = $piutang->denda;
			$piu = $j-($t+$d);
  			if($piu==NULL){
				$piu = 0;
			}
	?>    
    
    	<tr>
        	<td></td>
            <td></td>
            <td>&nbsp;<?php echo $spt->kd_rek.' - '.$spt->nm_rek; ?></td>
            <td align="right"><?php echo number_format($q->ketetapan,2,",","."); ?>&nbsp;</td>
        	<td align="right"><?php echo number_format($piu,2,",","."); ?>&nbsp;</td>
        	<td align="right"><?php echo number_format($q->denda,2,",","."); ?>&nbsp;</td>
        	<td align="right"><?php echo number_format($q->setoran,2,",","."); ?>&nbsp;</td>
        </tr>
    
    <?php
			$jumlah = $jumlah + $q->ketetapan;
			$tetap = $tetap + $piu;
			$denda = $denda + $q->denda;
			$setoran = $setoran + $q->setoran;
			
			$no++;
		}
	?>
    <tr>
    	<td colspan="3" align="center"><strong>JUMLAH</strong></td>
        <td align="right"><strong><?php echo number_format($jumlah,2,",","."); ?>&nbsp;</strong></td>
        <td align="right"><strong><?php echo number_format($tetap,2,",","."); ?>&nbsp;</strong></td>
        <td align="right"><strong><?php echo number_format($denda,2,",","."); ?>&nbsp;</strong></td>
        <td align="right"><strong><?php echo number_format($setoran,2,",","."); ?>&nbsp;</strong></td>
    </tr>    
    <?php
		$tjumlah = $tjumlah + $jumlah;
		$ttetap = $ttetap + $tetap;
		$tdenda = $tdenda + $denda;
		$tsetoran = $tsetoran + $setoran;
			
		$ro++;
	}
  ?>
  	<tr>
    	<td colspan="3" align="center"><strong>TOTAL</strong></td>
        <td align="right"><strong><?php echo number_format($tjumlah,2,",","."); ?>&nbsp;</strong></td>
        <td align="right"><strong><?php echo number_format($ttetap,2,",","."); ?>&nbsp;</strong></td>
        <td align="right"><strong><?php echo number_format($tdenda,2,",","."); ?>&nbsp;</strong></td>
        <td align="right"><strong><?php echo number_format($tsetoran,2,",","."); ?>&nbsp;</strong></td>
    </tr>
</table>
</body>
</html>