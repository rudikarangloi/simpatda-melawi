<?php 
if($type=='excel'):
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename=dph_bank.xls');	
endif;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
<h2 align="center">DAFTAR PENERIMAAN HARIAN<br />
TANGGAL <?php echo $time; ?><br />
<?php echo $nm; ?></h2>
<font size="2">

<table border="1">
	<tr>
    	<th>No.</th>
        <th>No. SPTPD</th>
        <th>Tgl SPTPD</th>
        <th>No. SSPD</th>
        <th>Tgl. SSPD</th>
        <th>Nama WP</th>
        <th>Alamat WP</th>
        <th>NPWPD</th>
        <th>Jenis Pajak</th>
        <th>Golongan Jenis Pajak</th>
        <th>Masa Pajak</th>
        <th>Tahun Pajak</th>
        <th>Tahun Pajak Berjalan</th>
        <th>Piutang Pajak</th>
        <th>Denda</th>
        <th>Total Bayar</th>
    </tr>
    <?php
		if($pajak==NULL){
			$qr="";
		} else {
			$qr="and sspd.kode_pajak='".$pajak."'";
		}
		
		$query = $this->db->query("SELECT
sspd.nomor,
sspd.no_sspd,
DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') as tgl2,
view_perusahaan.nama_perusahaan,
view_perusahaan.alamat_perusahaan,
sspd.npwpd,
sspd.tahun_pajak,
sspd.ketetapan,
sspd.denda,
sspd.setoran,
sspd.kode_pajak
FROM
sspd
INNER JOIN view_perusahaan ON sspd.npwpd = view_perusahaan.npwpd_perusahaan where sspd.pembayaran = '".$bank."' and sspd.tanggal = '".$tgl."' $qr");

		$i = 1;
		$jumlah = 0;
		$tetap = 0;
		$denda = 0;
		$setoran = 0;
		foreach($query->result() as $rs){
			$no = $rs->nomor;
			$kode = $rs->kode_pajak;
			
			if($kode=='REK'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.rek_reklame as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_reklame a left join master_rekening b on a.rek_reklame=b.kd_rek left join view_no c on a.no_sptpd=c.sptpd where c.no_skpd = '".$no."'")->row();
				$pajak = 'Reklame';
				
			} else if($kode=='AIR'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.rek_air as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_air_bawah_tanah a left join master_rekening b on a.rek_air=b.kd_rek left join view_no c on a.no_sptpd=c.sptpd where c.no_skpd = '".$no."'")->row();
				$pajak = 'Air Tanah';
				
			} else if($kode=='HTL'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.gol_hotel as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_hotel a left join master_rekening b on a.gol_hotel=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Hotel';
				
			} else if($kode=='RES'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.gol_restoran as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_restoran a left join master_rekening b on a.gol_restoran=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Restoran';
				
			} else if($kode=='HIB'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.jenis_hiburan as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_hiburan a left join master_rekening b on a.jenis_hiburan=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Hiburan';
				
			} else if($kode=='LIS'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.gol_tarif as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_listrik a left join master_rekening b on a.gol_tarif=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Penerangan Jalan';
				
			} else if($kode=='GAL'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.rekening as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_galianc a left join master_rekening b on a.rekening=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Mineral Bukan Logam dan Batuan';
				
			} else if($kode=='WLT'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.golongan as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_burung_walet a left join master_rekening b on a.golongan=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Sarang Burung Walet';
				
			} else if($kode=='PKR'){
				$spt = $this->db->query("select a.no_sptpd, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl, a.golongan as kd_rek, b.nm_rek, DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa1, DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa2 from sptpd_parkir a left join master_rekening b on a.golongan=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Parkir';		
			}
			
			$thn = date('Y');
			/*$setor = $this->db->query("select sum(setoran) as jumlah from sspd where nomor = '".$sptpd."' and tahun_pajak = '".$thn."'")->row();
			$ptb = $setor->jumlah;
			if($ptb==NULL){*/
				$ptb = 0;
			//}
			
			$piutang = $this->db->query("select sum(ketetapan) as tetap, sum(denda) as denda, sum(setoran) as jumlah from sspd where nomor = '".$no."'")->row();
			$j = $piutang->jumlah;
			$t = $piutang->tetap;
			$d = $piutang->denda;
			$piu = $j-($t+$d);
  			if($piu==NULL){
				$piu = 0;
			}
	?>
    <tr>
    	<td align="center"><?php echo $i; ?></td>
        <td align="center"><?php echo $spt->no_sptpd; ?></td>
        <td align="center"><?php echo $spt->tgl; ?></td>
        <td align="center"><?php echo $rs->no_sspd; ?></td>
        <td align="center"><?php echo $rs->tgl2; ?></td>
        <td align="left"><?php echo $rs->nama_perusahaan; ?></td>
        <td align="left"><?php echo $rs->alamat_perusahaan; ?></td>
        <td align="left"><?php echo $rs->npwpd; ?></td>
        <td align="left"><?php echo $pajak; ?></td>
        <td align="left"><?php echo $spt->kd_rek.' - '.$spt->nm_rek; ?></td>
        <td align="center"><?php echo $spt->masa1." - ".$spt->masa2; ?></td>
        <td align="center"><?php echo $rs->tahun_pajak; ?></td>
        <td align="right"><?php echo number_format($rs->ketetapan,2,",","."); ?></td>
        <td align="right"><?php echo number_format($piu,2,",","."); ?></td>
        <td align="right"><?php echo number_format($rs->denda,2,",","."); ?></td>
        <td align="right"><?php echo number_format($rs->setoran,2,",","."); ?></td>
	</tr>
    <?php
			$jumlah = $jumlah + $rs->ketetapan;
			$tetap = $tetap + $piu;
			$denda = $denda + $rs->denda;
			$setoran = $setoran + $rs->setoran;
			
			$i++;
		}
	?>
    <tr>
    	<td colspan="12" align="center"><strong>Jumlah</strong></td>
        <td align="right"><strong><?php echo number_format($jumlah,2,",","."); ?></strong></td>
        <td align="right"><strong><?php echo number_format($tetap,2,",","."); ?></strong></td>
        <td align="right"><strong><?php echo number_format($denda,2,",","."); ?></strong></td>
        <td align="right"><strong><?php echo number_format($setoran,2,",","."); ?></strong></td>
    </tr>
</table>

</font>
</body>
</html>