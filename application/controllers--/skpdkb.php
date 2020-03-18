<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class skpdkb extends MY_Controller {
	
	function __construct() {
            parent::__construct();
            $this->load->model('msistem');
    }
	
	public function index() {
	}
	
	public function hitung($kode=""){
		$kd = $this->db->query("select nama_sptpd from master_sptpd where kode_sptpd = '".$kode."'")->row();
		$cek = $kd->nama_sptpd;
		$data['title'] = $cek;
		$data['kode'] = $kode;
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$data['gresto'] = $this->db->query("select kd_rek from master_rekening where jns_pajak='01'");
		$data['tgl'] = date('d/m/Y');
		$data['tahun'] = $this->msistem->tahun();
		$data['jenis'] = $this->db->get('master_sptpd')->result();
		$this->load->view('penetapan/skpdkb',$data);
	}
	
	public function lihat() {
		$s = $this->input->post('sptpd');
		$n = $this->input->post('nota');
		
		$w = $this->db->query("select setoran from sspd where nomor='".$s."'")->row();
		if($w==NULL){
			$total_setoran = 0;
		} else {
			$total_setoran = $w->setoran;	
		}
		
		$q = $this->db->query("select sum(dp) as dp, sum(jumlah) as jumlah from nhp_child where no_nota='".$n."'")->row();
		$ketetapan = $q->dp;
		$jumlah = $q->jumlah;
			//now
			$d = date('d/m/Y');
			
			//bulan+1
			$s = mktime(0,0,0,date("m")+1,date("d"),date("Y"));
			$t = date('d/m/Y',$s);
			
			$q = $ketetapan."|".$total_setoran."|".$d."|".$t."|".$jumlah;
		echo $q;
	}
	
	function dataItemPajak1($s=""){
		$so = explode("-",$s);
		$spt = $so[0]."/".$so[1]."/".$so[2];
		
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		$wo = $this->db->query("select kd_rek,nm_rek,dp,tarif,kenaikan,denda,bunga,kompensasi,jumlah from nhp_child where no_nota='".$spt."'");
		
		$i=1;
		foreach($wo->result() as $w) {
			// cair
			$sp = '';
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$w->kd_rek."]]></cell>");
					echo("<cell><![CDATA[".$w->nm_rek."]]></cell>");
					echo("<cell><![CDATA[".$w->dp."]]></cell>");
					echo("<cell><![CDATA[".$w->tarif."]]></cell>");
					echo("<cell><![CDATA[".$w->kenaikan."]]></cell>");
					echo("<cell><![CDATA[".$w->denda."]]></cell>");
					echo("<cell><![CDATA[".$w->bunga."]]></cell>");
					echo("<cell><![CDATA[".$w->kompensasi."]]></cell>");
					echo("<cell><![CDATA[".$w->jumlah."]]></cell>");
					echo("<cell><![CDATA[".$sp."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function simpan() {
		$upd = array(
				'status' => 1
		);
		$this->db->update('nota_hitung',$upd,array('no_nota' => $_POST['nota']));
			
		$dp = $_POST['dp'];
		if(strpos($dp, '.')){
			$dp = str_replace('.', '', $dp);
		} else {
			$dp;
		}
		
		$setoran = $_POST['setoran'];
		if(strpos($setoran, '.')){
			$setoran = str_replace('.', '', $setoran);
		} else {
			$setoran;
		}
		
		$jml = $_POST['jumlah'];
		if(strpos($jml, '.')){
			$jml = str_replace('.', '', $jml);
		} else {
			$jml;
		}
		
		if(strpos($jml, '-')){
				$jml = str_replace('-', '', $jml);
			} else {
				$jml;
			}
		
		$data = array(
            'nota_hitung' => $_POST['nota'],
            'npwpd' => $_POST['npwpd'],
            'masa_pajak1' => $_POST['awal'],
            'masa_pajak2' => $_POST['akhir'],
            'tahun' => $_POST['tahun'],
            'tgl_tempo' => $_POST['tempo'],
            'tgl' => $_POST['tgl'],                        
            'no_sptpd' => $_POST['sptpd'],
			'dasar_pengenaan' => $dp,
			'setoran' => $setoran,
            'jumlah' =>  $jml,
			'kode_sptpd' =>  $_POST['kode'],
            'author' => $this->session->userdata('username')
        );
		if($this->input->post('id')=="") {
			$thn = date('Y');
			$no_skpdkb = $this->generateNo($_POST['tahun']).'/'.$_POST['kode'].'/'.substr($_POST['tahun'],2,2);
			$dataIns = array_merge($data,array('no_skpdkb' => $no_skpdkb,'created' => date('Y-m-d H:i:s')));
			$result = $this->db->insert('skpdkb', $dataIns);
		} else {
			$no_skpdkb = $this->input->post('skpdkb');
			$this->db->delete('skpdkb_child',array('skpdkb' => $no_skpdkb));
			$dataUpdate = array_merge($data,array('author' => $this->session->userdata('username'),'modified' => date('Y-m-d H:i:s')));
			$result = $this->db->update('skpdkb',$dataUpdate,array('no_skpdkb' => $no_skpdkb));
		}
		echo $no_skpdkb;
	}
	
	public function cariData($kata_kunci="",$parameter="",$kode_sptpd="") {
		$qr = "";
		if($kata_kunci != '0'):
			$qr = " and nota_hitung.$parameter like '%$kata_kunci%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("select nota_hitung.no_nota, nota_hitung.sptpd, nota_hitung.npwpd, identitas_perusahaan.nama_perusahaan, identitas_perusahaan.alamat_perusahaan, nota_hitung.masa_pajak1, nota_hitung.masa_pajak2, nota_hitung.tahun, nota_hitung.jumlah from nota_hitung left join identitas_perusahaan on nota_hitung.npwpd=identitas_perusahaan.npwpd_perusahaan where nota_hitung.sk='5' and nota_hitung.nama_sptpd = '".$kode_sptpd."' $qr","id","no_nota, sptpd, npwpd, nama_perusahaan, alamat_perusahaan, masa_pajak1, masa_pajak2, tahun, jumlah");
	}
	
	public function generateNo($thn) {
		$sql = $this->db->query("select MAX(SUBSTRING_INDEX(no_skpdkb,'/',1)) as max from skpdkb where tahun = '".$thn."'")->row();
		$r = $sql->max;
		if($r==NULL){
			$jml = '000000001';
		} else {
			$jml = $r + 1;
			if(strlen($jml)==1) {
				$jml = '00000000'.$jml;
			} else if(strlen($jml)==2) {
				$jml = '0000000'.$jml;
			} else if(strlen($jml)==3) {
				$jml = '000000'.$jml;
			} else if(strlen($jml)==4) {
				$jml = '00000'.$jml;
			} else if(strlen($jml)==5) {
				$jml = '0000'.$jml;
			} else if(strlen($jml)==6) {
				$jml = '000'.$jml;
			} else if(strlen($jml)==7) {
				$jml = '00'.$jml;
			} else if(strlen($jml)==8) {
				$jml = '0'.$jml;
			}
		}
		return $jml;
	}
	
	function data() {
		$grid = new GridConnector($this->db->conn_id);
		if(isset($_GET['kode'])) {
			$grid->render_sql("select skpdkb.id, skpdkb.no_skpdkb, skpdkb.nota_hitung, skpdkb.npwpd, identitas_perusahaan.nama_perusahaan, identitas_perusahaan.alamat_perusahaan, skpdkb.masa_pajak1, skpdkb.masa_pajak2, tahun, DATE_FORMAT(skpdkb.tgl,'%d/%m/%Y') as tgl, skpdkb.no_sptpd, DATE_FORMAT(skpdkb.tgl_tempo,'%d/%m/%Y') as tgl_tempo, skpdkb.dasar_pengenaan as dp, skpdkb.setoran as setoran, skpdkb.jumlah as jumlah from skpdkb left join identitas_perusahaan on skpdkb.npwpd=identitas_perusahaan.npwpd_perusahaan where skpdkb.kode_sptpd = '".$_GET['kode']."'","id","id, no_skpdkb, nota_hitung, npwpd, nama_perusahaan, alamat_perusahaan, masa_pajak1, masa_pajak2, tahun, tgl, no_sptpd, tgl_tempo, dp, setoran, jumlah");
		} else {
			$grid->render_sql("select skpdkb.id, skpdkb.no_skpdkb, skpdkb.nota_hitung, skpdkb.npwpd, identitas_perusahaan.nama_perusahaan, identitas_perusahaan.alamat_perusahaan, skpdkb.masa_pajak1, skpdkb.masa_pajak2, tahun, DATE_FORMAT(skpdkb.tgl,'%d/%m/%Y') as tgl, skpdkb.no_sptpd, DATE_FORMAT(skpdkb.tgl_tempo,'%d/%m/%Y') as tgl_tempo, skpdkb.dasar_pengenaan as dp, skpdkb.setoran as setoran, skpdkb.jumlah as jumlah from skpdkb left join identitas_perusahaan on skpdkb.npwpd=identitas_perusahaan.npwpd_perusahaan","id","id, no_skpdkb, nota_hitung, npwpd, nama_perusahaan, alamat_perusahaan, masa_pajak1, masa_pajak2, tahun, tgl, no_sptpd, tgl_tempo, dp, setoran, jumlah");
		}
	}
	
	function child_skpdkb() {
		$grid = new GridConnector($this->db->conn_id);
		if(isset($_GET['skpdkb'])) {
			$grid->render_sql("select kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah, skpdkb from skpdkb_child where skpdkb = '".$_GET['skpdkb']."'","id","kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah, skpdkb");
		} else {
			$grid->render_table("skpdkb_child","id","kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah, skpdkb");
		}
	}
	
	function delete() {
		$no_skpdkb = $this->input->post('no');
		$s = $this->db->query("select count(id) as jml from sspd where nomor='".$no_skpdkb."'")->row();
		$we = $s->jml; 
		if($we==0){
			$this->db->delete('skpdkb',array('no_skpdkb' => $no_skpdkb));
			$result = "Data SKPDKB berhasil dihapus.";
		} else {
			$result = "Silakan Menghapus Data SSPD Terlebih Dahulu";
		}
		echo $result;
	}
	
	public function cetak1() {
		$list = $this->db->query("SELECT
skpdkb.nota_hitung,
skpdkb.no_skpdkb,
skpdkb.npwpd,
skpdkb.masa_pajak1,
skpdkb.masa_pajak2,
skpdkb.tahun,
skpdkb.tgl,
skpdkb.no_sptpd,
DATE_FORMAT(skpdkb.tgl_tempo,'%d/%m/%Y') AS tgl_tempo,
skpdkb.dasar_pengenaan,
skpdkb.setoran,
pembayaran.kurang AS jumlah,
skpdkb.modified,
skpdkb.kode_sptpd,
skpdkb.id,
view_perusahaan.nama_perusahaan,
view_perusahaan.alamat_perusahaan,
view_perusahaan.nama_pemilik,
view_perusahaan.alamat_pemilik
FROM
skpdkb
INNER JOIN view_perusahaan ON skpdkb.npwpd = view_perusahaan.npwpd_perusahaan 
INNER JOIN sspd ON skpdkb.no_skpdkb = sspd.nomor 
INNER JOIN pembayaran ON pembayaran.no_sspd = sspd.no_sspd
WHERE skpdkb.no_skpdkb='".$_GET['no_skpdkb']."' GROUP BY skpdkb.no_skpdkb")->row();
		$no 				= $list->no_skpdkb;
		$npwpd 				= $list->npwpd;
		$nama 				= $list->nama_perusahaan;
		$alamat 			= $list->alamat_perusahaan;
		$namper				= $list->nama_pemilik;
		$awal				= $this->msistem->v_bln($list->masa_pajak1);
		$akhir 				= $this->msistem->v_bln($list->masa_pajak2);
		$tahun 				= $list->tahun;
		$t 				= explode('/',$list->tgl_tempo);
		$b = $this->msistem->v_bln($t[1]);
		$tempo = $t[0].' '.$b.' '.$t[2];
		$ket				= '';
		//$total				= number_format($list->jumlah,2,",",".");
		$huruf				= '';
		$s1 = $this->db->query("select nama, nip from admin where id_modul = '2'")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = $s1->nama;
			$nip1 = $s1->nip;
		}
		$m	= $this->msistem->v_bln(date('m'));
		$tanggal			= date('d').' '.$m.' '.date('Y');
		
		if($list->jumlah==0){
			$title = 'NIHIL';
			$kode = 'SKPN';
		} else if($list->jumlah!=0){
			$title = 'KURANG BAYAR';
			$kode = 'SKPKB';
		}
			
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('P', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SIMPATDA_SIGI');
		$pdf->SetKeywords('SIMPATDA_SIGI');
	
		//set no header & footer
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(10);
		$pdf->SetMargins(10,10,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 10);
	
		$pdf->AddPage('P','A4',false);
		//set data
		$report = '';
		$report .=
			'<table border=1>
				<tr>
					<td width="50" height="54" align="center" valign="middle">&nbsp;</td>
					<td width="220" align="center">
						PEMERINTAH KABUPATEN SIGI<br />
						DINAS PENDAPATAN PENGELOLAAN KEUANGAN DAN ASET DAERAH<br />
						Jalan Poros PALU - Telp (0655) 7006013<br />
						Fax (0655)7551162,7551165<br />
						PALOLO
					</td>
					<td width="210" align="center">
						SURAT KETETAPAN PAJAK DAERAH<br />
						'.$title.'<br />
						Masa Pajak&nbsp;&nbsp;:&nbsp;&nbsp;'.$awal.' - '.$akhir.'<br />
						Tahun&nbsp;&nbsp;:&nbsp;&nbsp;'.$tahun.'
					</td>
					<td width="92" align="center">
						<br /><br />
						No. '.$kode.'<br />
						'.$no.'
					</td>
				</tr>
			</table>';
		
		$report .=
			'<table border="1">
				<tr>
				<td width="572">
				<table>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;NAMA PERUSAHAAN</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$nama.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;ALAMAT PERUSAHAAN</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$alamat.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;NAMA PEMILIK</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$namper.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;NPWPD</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$npwpd.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;TANGGAL JATUH TEMPO</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$tempo.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;KETERANGAN</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$ket.'</td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				</table>
				</td>
				</tr>
			</table>';
		
		$child2 = $this->db->query("select kd_rek, nm_rek, sum(denda) as denda, sum(jumlah) as jumlah from skpdkb_child where skpdkb ='".$no."'")->row();
		$dp = number_format($list->dasar_pengenaan,2,",",".");
		$hut = ($list->dasar_pengenaan * 10)/100;
		$hutang = number_format($hut,2,",",".");
		
		$kompensasi = number_format(0,2,",",".");
		$kompensasi1 = 0;
		$nom_tetap = 0;
        
		$sptpd = $list->no_skpdkb;
		//$tetap = $this->db->query("SELECT ketetapan FROM sspd WHERE nomor ='".$sptpd."' ORDER BY sspd.no_sspd DESC LIMIT 1")->row();		        
        $tetap = $this->db->query("SELECT pembayaran.setoran_wp as ketetapan
FROM
skpdkb
INNER JOIN view_perusahaan ON skpdkb.npwpd = view_perusahaan.npwpd_perusahaan 
INNER JOIN sspd ON skpdkb.no_skpdkb = sspd.nomor 
INNER JOIN pembayaran ON pembayaran.no_sspd = sspd.no_sspd
WHERE nomor ='".$sptpd."' GROUP BY skpdkb.no_skpdkb
")->row();
        
        //if ($tetap->num_rows()==0){
            $nom_tetap = $tetap->ketetapan;
        //}else{
        //    $nom_tetap = 0;
        //} 
                            
		$setoran = number_format($nom_tetap,2,",",".");
		$setoran1 = $nom_tetap;
		          
		$pajak1 = $setoran1;
		$pajak = number_format($pajak1,2,",",".");
		
		$kekurangan1 = $hut-$setoran1;
		//$kurang1 = 0;
		$kekurangan = number_format($kekurangan1,2,",",".");
		
		$bunga1 = 0;
		$bunga = number_format($bunga1,2,",",".");
		
		$denda1 = $child2->denda;
		if($denda1=='0'){
			$denda1 = 0;
		}
		$denda = number_format($denda1,2,",",".");
		
		$jumlah1 = $bunga1 + $denda1;
		$jumlah = number_format($jumlah1,2,",",".");
		
		$total1 = $kekurangan1+$jumlah1;        
        $jum_total = str_replace('-','',$total1);    	
		$total = number_format($total1,2,",",".");	
		$terbilang = $this->msistem->baca($jum_total);
		
		$report .=
			'<table border="1">
				<tr>
					<td width="572">
					<table border="0">
	<tr>
		<td colspan="7">&nbsp;</td>
	</tr>
    <tr>
    	<td width="20" valign="top">&nbsp;&nbsp;1.</td>
        <td colspan="6" width="550">Berdasarkan Pasal 9 undang-undang No. 18 Tahun 1997 telah dilakukan penelitian dan/atau pemeriksaan atau keterangan lain atas pelaksanaan kewajiban</td>
    </tr>
    <tr>
    	<td width="20">&nbsp;</td>
        <td colspan="3">Nomor Rekening</td>
        <td width="24" align="center">:</td>
        <td colspan="2">&nbsp;&nbsp;'.$child2->kd_rek.'</td>
    </tr>
    <tr>
    	<td width="20">&nbsp;</td>
        <td colspan="3">Nama Rekening</td>
         <td width="24" align="center">:</td>
        <td colspan="2">&nbsp;&nbsp;'.$child2->nm_rek.'</td>
    </tr>
	<tr>
		<td colspan="7">&nbsp;</td>
	</tr>
	<tr>
    	<td width="20" valign="top">&nbsp;&nbsp;2.</td>
        <td colspan="6" width="550">Dari penelitian dan/atau pemeriksaan tersebut diatas, perhitungan jumlah yang masih harus dibayar adalah sebagai berikut :</td>
    </tr>
    <tr>
    	<td width="20">&nbsp;</td>
        <td width="24">1.</td>
        <td colspan="2" width="250">Dasar Pengenaan</td>
        <td width="24">&nbsp;</td>
        <td align="right" width="100">Rp.</td>
        <td align="right" width="100">'.$dp.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td width="20">&nbsp;</td>
      <td width="24">2.</td>
      <td colspan="2" width="250">Pajak yang terhutang</td>
      <td width="24">&nbsp;</td>
      <td align="right" width="100">Rp.</td>
      <td align="right" width="100">'.$hutang.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
    	<td width="20">&nbsp;</td>
        <td width="24">3.</td>
        <td colspan="5">Kredit Pajak :</td>
    </tr>
    <tr>
    	<td colspan="2" width="44">&nbsp;</td>
        <td width="20">a.</td>
        <td width="230">Kompensasi tahun sebelumnya</td>
        <td width="24">Rp.</td>
        <td align="right" width="100">'.$kompensasi.'&nbsp;&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="2" width="44">&nbsp;</td>
        <td width="20">b.</td>
        <td width="230">Setoran Masa yang dilakukan</td>
        <td width="24">Rp.</td>
        <td align="right" width="100">'.$setoran.'&nbsp;&nbsp;</td>
        <td width="109">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" width="44">&nbsp;</td>
      <td width="20">c.</td>
      <td width="230">Jumlah pajak yang dikurangkan</td>
      <td width="24">Rp.</td>
      <td align="right" width="100">'.$pajak.'&nbsp;&nbsp;</td>
      <td>+&nbsp;</td>
    </tr>
   	<tr>
      <td width="20">&nbsp;</td>
      <td width="24">4.</td>
      <td colspan="2" width="250">Jumlah kekurangan pembayaran Pokok Pajak</td>
      <td width="24">&nbsp;</td>
      <td align="right" width="100">Rp.</td>
      <td align="right" width="100">'.$kekurangan.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td width="20">&nbsp;</td>
      <td width="24">5.</td>
      <td colspan="5" width="250">Sanksi administrasi :</td>
    </tr>
    <tr>
      <td colspan="2" width="44">&nbsp;</td>
      <td width="20">a.</td>
      <td width="230">Bunga</td>
      <td width="24">Rp.</td>
      <td align="right" width="100">'.$bunga.'&nbsp;&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" width="44">&nbsp;</td>
      <td width="20">b.</td>
      <td width="230">Denda</td>
      <td width="24">Rp.</td>
      <td align="right" width="100">'.$denda.'&nbsp;&nbsp;</td>
      <td>+&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" width="44">&nbsp;</td>
      <td width="20">c.</td>
      <td width="230">Jumlah sanksi dan denda</td>
      <td width="24">Rp.</td>
      <td align="right" width="100">'.$jumlah.'&nbsp;&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="20">&nbsp;</td>
      <td width="24">6.</td>
      <td colspan="2" width="250">Jumlah Pajak yang masih harus dibayar</td>
      <td width="24">&nbsp;</td>
      <td align="right" width="100">Rp.</td>
      <td align="right" width="100">'.$total.'&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="7">&nbsp;</td>
	</tr>
				</table>
				</td>
				</tr>
				</table>';
			
			$report .=
				'<table border="1">
					<tr>
						<td width="572">
						<table border="0">
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td width="90" height="20">&nbsp;&nbsp;Dengan huruf</td>
								<td width="10" align="center">:</td>
								<td width="420">'.$terbilang.'RUPIAH</td>
							</tr>
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
						</table>
						</td>
					</tr>
				</table>';
				
		$report .=
				'<table border="1">
					<tr>
						<td width="572">
						<table border="0">
	<tr>
		<td colspan="9">&nbsp;</td>
	</tr>
    <tr>
    	<td colspan="9">&nbsp;&nbsp;<u>P E R H A T I A N</u></td>
    </tr>
    <tr>
    	<td width="20" valign="top">&nbsp;&nbsp;</td>
        <td width="550">Pengembalian Kelebihan Pajak dilakukan pada Kas Daerah dengan menggunakan Surat Perintah Membayar Kelebihan Pajak (SPMKP) dan Surat Perintah Mengeluarkan Uang (SPMU).</td>
    </tr>
	<tr>
		<td colspan="9">&nbsp;</td>
	</tr>
    </table>
						</td>
					</tr>
				</table>';
				
			$report .=
			'<table border="1">
				<tr>
				<td width="572">
				<table border="0">
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">Palolo, '.$tanggal.'</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">KABID PENDAPATAN</td>
					</tr>
					<tr>
						<td width="572" height="50">&nbsp;</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">'.$nama1.'</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">NIP. '.$nip1.'</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
				</table>
				</td>
				</tr>
			</table>';
		
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_SKPD'.'.pdf', 'I');
	}
	
	public function cetak() {
		$list = $this->db->query("SELECT
skpdkb.nota_hitung,
skpdkb.no_skpdkb,
skpdkb.npwpd,
skpdkb.masa_pajak1,
skpdkb.masa_pajak2,
skpdkb.tahun,
skpdkb.tgl,
skpdkb.no_sptpd,
DATE_FORMAT(skpdkb.tgl_tempo,'%d/%m/%Y') as tgl_tempo,
skpdkb.dasar_pengenaan,
skpdkb.setoran,
skpdkb.jumlah,
skpdkb.modified,
skpdkb.kode_sptpd,
skpdkb.id,
view_perusahaan.nama_perusahaan,
view_perusahaan.alamat_perusahaan,
view_perusahaan.nama_pemilik,
view_perusahaan.alamat_pemilik
FROM
skpdkb
INNER JOIN view_perusahaan ON skpdkb.npwpd = view_perusahaan.npwpd_perusahaan WHERE skpdkb.no_skpdkb='".$_GET['no_skpdkb']."'")->row();
		$no 				= $list->no_skpdkb;
		$npwpd 				= $list->npwpd;
		$nama 				= $list->nama_perusahaan;
		$alamat 			= $list->alamat_perusahaan;
		$namper				= $list->nama_pemilik;
		$awal				= $this->msistem->v_bln($list->masa_pajak1);
		$akhir 				= $this->msistem->v_bln($list->masa_pajak2);
		$tahun 				= $list->tahun;
		$t 				= explode('/',$list->tgl_tempo);
		$b = $this->msistem->v_bln($t[1]);
		$tempo = $t[0].' '.$b.' '.$t[2];
		$ket				= '';
		//$total				= number_format($list->jumlah,2,",",".");
		$huruf				= '';
		$s1 = $this->db->query("select nama, nip from admin where id_modul = '2'")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = $s1->nama;
			$nip1 = $s1->nip;
		}
		$m	= $this->msistem->v_bln(date('m'));
		$tanggal			= date('d').' '.$m.' '.date('Y');
		
		if($list->jumlah==0){
			$title = 'NIHIL';
			$kode = 'SKPN';
		} else if($list->jumlah!=0){
			$title = 'KURANG BAYAR';
			$kode = 'SKPKB';
		}
			
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('P', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_PADANG');
		$pdf->SetKeywords('SOPD_PADANG');
	
		//set no header & footer
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(10);
		$pdf->SetMargins(10,10,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 10);
	
		$pdf->AddPage('P','A4',false);
		//set data
		$report = '';
		$report .=
			'<table border=1>
				<tr>
					<td width="50" height="54" align="center" valign="middle">&nbsp;</td>
					<td width="220" align="center">
						PEMERINTAH KABUPATEN ACEH BARAT<br />
						DINAS PENGELOLAAN KEUANGAN DAN KEKAYAAN DAERAH<br />
						Jalan Gajah Mada Telp (0655) 7006013<br />
						Fax (0655)7551162,7551165<br />
						MEULABOH
					</td>
					<td width="210" align="center">
						SURAT KETETAPAN PAJAK DAERAH<br />
						'.$title.'<br />
						Masa Pajak&nbsp;&nbsp;:&nbsp;&nbsp;'.$awal.' - '.$akhir.'<br />
						Tahun&nbsp;&nbsp;:&nbsp;&nbsp;'.$tahun.'
					</td>
					<td width="92" align="center">
						<br /><br />
						No. '.$kode.'<br />
						'.$no.'
					</td>
				</tr>
			</table>';
		
		$report .=
			'<table border="1">
				<tr>
				<td width="572">
				<table>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;NAMA PERUSAHAAN</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$nama.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;ALAMAT PERUSAHAAN</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$alamat.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;NAMA PEMILIK</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$namper.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;NPWPD</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$npwpd.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;TANGGAL JATUH TEMPO</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$tempo.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;KETERANGAN</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$ket.'</td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				</table>
				</td>
				</tr>
			</table>';
		
		$child2 = $this->db->query("select kd_rek, nm_rek, sum(jumlah) as jumlah from skpdkb_child where skpdkb ='".$no."'")->row();
		$dp = number_format($list->dasar_pengenaan,2,",",".");
		$hutang = number_format($child2->jumlah,2,",",".");
		$hut = $child2->jumlah;
		
		$kompensasi = number_format(0,2,",",".");
		$kompensasi1 = 0;
		
		$setoran = number_format($list->setoran,2,",",".");
		$setoran1 = $list->setoran;
		
		$pajak1 = $setoran1;
		$pajak = number_format($pajak1,2,",",".");
		
		$kekurangan1 = $hut-$pajak1;
		$kurang1 = 0;
		$kekurangan = number_format($kekurangan1,2,",",".");
		
		$bunga1 = 0;
		$bunga = number_format($bunga1,2,",",".");
		
		$denda1 = 0;
		$denda = number_format($denda1,2,",",".");
		
		$jumlah1 = 0;
		$jumlah = number_format($jumlah1,2,",",".");
		
		$total1 = $jumlah1+$kekurangan1;	
		$total = number_format($total1,2,",",".");	
		$terbilang = $this->msistem->baca($total1);
		
		$report .=
			'<table border="1">
				<tr>
					<td width="572">
					<table border="0">
	<tr>
		<td colspan="7">&nbsp;</td>
	</tr>
    <tr>
    	<td width="20" valign="top">&nbsp;&nbsp;1.</td>
        <td colspan="6" width="550">Berdasarkan Pasal 9 undang-undang No. 18 Tahun 1997 telah dilakukan penelitian dan/atau pemeriksaan atau keterangan lain atas pelaksanaan kewajiban</td>
    </tr>
    <tr>
    	<td width="20">&nbsp;</td>
        <td colspan="3">Nomor Rekening</td>
        <td width="24" align="center">:</td>
        <td colspan="2">&nbsp;&nbsp;'.$child2->kd_rek.'</td>
    </tr>
    <tr>
    	<td width="20">&nbsp;</td>
        <td colspan="3">Nama Rekening</td>
         <td width="24" align="center">:</td>
        <td colspan="2">&nbsp;&nbsp;'.$child2->nm_rek.'</td>
    </tr>
	<tr>
		<td colspan="7">&nbsp;</td>
	</tr>
	<tr>
    	<td width="20" valign="top">&nbsp;&nbsp;2.</td>
        <td colspan="6" width="550">Dari penelitian dan/atau pemeriksaan tersebut diatas, perhitungan jumlah yang masih harus dibayar adalah sebagai berikut :</td>
    </tr>
    <tr>
    	<td width="20">&nbsp;</td>
        <td width="24">1.</td>
        <td colspan="2" width="250">Dasar Pengenaan</td>
        <td width="24">&nbsp;</td>
        <td align="right" width="100">Rp.</td>
        <td align="right" width="100">'.$dp.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td width="20">&nbsp;</td>
      <td width="24">2.</td>
      <td colspan="2" width="250">Pajak yang terhutang</td>
      <td width="24">&nbsp;</td>
      <td align="right" width="100">Rp.</td>
      <td align="right" width="100">'.$hutang.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
    	<td width="20">&nbsp;</td>
        <td width="24">3.</td>
        <td colspan="5">Kredit Pajak :</td>
    </tr>
    <tr>
    	<td colspan="2" width="44">&nbsp;</td>
        <td width="20">a.</td>
        <td width="230">Kompensasi tahun sebelumnya</td>
        <td width="24">Rp.</td>
        <td align="right" width="100">'.$kompensasi.'&nbsp;&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="2" width="44">&nbsp;</td>
        <td width="20">b.</td>
        <td width="230">Setoran Masa yang dilakukan</td>
        <td width="24">Rp.</td>
        <td align="right" width="100">'.$setoran.'&nbsp;&nbsp;</td>
        <td width="109">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" width="44">&nbsp;</td>
      <td width="20">c.</td>
      <td width="230">Jumlah pajak yang dikurangkan</td>
      <td width="24">Rp.</td>
      <td align="right" width="100">'.$pajak.'&nbsp;&nbsp;</td>
      <td>+&nbsp;</td>
    </tr>
   	<tr>
      <td width="20">&nbsp;</td>
      <td width="24">4.</td>
      <td colspan="2" width="250">Jumlah kekurangan pembayaran Pokok Pajak</td>
      <td width="24">&nbsp;</td>
      <td align="right" width="100">Rp.</td>
      <td align="right" width="100">'.$kekurangan.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td width="20">&nbsp;</td>
      <td width="24">5.</td>
      <td colspan="5" width="250">Sanksi administrasi :</td>
    </tr>
    <tr>
      <td colspan="2" width="44">&nbsp;</td>
      <td width="20">a.</td>
      <td width="230">Bunga</td>
      <td width="24">Rp.</td>
      <td align="right" width="100">'.$bunga.'&nbsp;&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" width="44">&nbsp;</td>
      <td width="20">b.</td>
      <td width="230">Denda</td>
      <td width="24">Rp.</td>
      <td align="right" width="100">'.$denda.'&nbsp;&nbsp;</td>
      <td>+&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" width="44">&nbsp;</td>
      <td width="20">c.</td>
      <td width="230">Jumlah sanksi dan denda</td>
      <td width="24">Rp.</td>
      <td align="right" width="100">'.$jumlah.'&nbsp;&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="20">&nbsp;</td>
      <td width="24">6.</td>
      <td colspan="2" width="250">Jumlah Pajak yang masih harus dibayar</td>
      <td width="24">&nbsp;</td>
      <td align="right" width="100">Rp.</td>
      <td align="right" width="100">'.$total.'&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="7">&nbsp;</td>
	</tr>
				</table>
				</td>
				</tr>
				</table>';
			
			$report .=
				'<table border="1">
					<tr>
						<td width="572">
						<table border="0">
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td width="90" height="20">&nbsp;&nbsp;Dengan huruf</td>
								<td width="10" align="center">:</td>
								<td width="420">'.$terbilang.'RUPIAH</td>
							</tr>
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
						</table>
						</td>
					</tr>
				</table>';
				
		$report .=
				'<table border="1">
					<tr>
						<td width="572">
						<table border="0">
	<tr>
		<td colspan="9">&nbsp;</td>
	</tr>
    <tr>
    	<td colspan="9">&nbsp;&nbsp;<u>P E R H A T I A N</u></td>
    </tr>
    <tr>
    	<td width="20" valign="top">&nbsp;&nbsp;</td>
        <td width="550">Pengembalian Kelebihan Pajak dilakukan pada Kas Daerah dengan menggunakan Surat Perintah Membayar Kelebihan Pajak (SPMKP) dan Surat Perintah Mengeluarkan Uang (SPMU).</td>
    </tr>
	<tr>
		<td colspan="9">&nbsp;</td>
	</tr>
    </table>
						</td>
					</tr>
				</table>';
				
			$report .=
			'<table border="1">
				<tr>
				<td width="572">
				<table border="0">
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">Meulaboh, '.$tanggal.'</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">KABID PENDAPATAN</td>
					</tr>
					<tr>
						<td width="572" height="50">&nbsp;</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">'.$nama1.'</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">NIP. '.$nip1.'</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
				</table>
				</td>
				</tr>
			</table>';
		
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_SKPD'.'.pdf', 'I');
	}
}
?>