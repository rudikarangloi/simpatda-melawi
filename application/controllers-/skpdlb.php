<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class skpdlb extends MY_Controller {
	
	function __construct() {
            parent::__construct();
            $this->load->model('msistem');
    }
	
	public function index() {
		$data['tahun'] = $this->msistem->tahun();
		$this->load->view('penetapan/skpdlb',$data);
	}
	
	public function frmskpd($idtype="") {
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$p = $this->db->query("select nama_sptpd from master_sptpd where kode_sptpd = '".$idtype."'")->row();
		$data['nama_sptpd'] = $p->nama_sptpd;
		$data['kode_sptpd'] = $idtype;
		$data['username'] = $username = $this->session->userdata('username');
		$data['tahun'] = $this->msistem->tahun();
		$this->load->view('penetapan/skpdlb',$data);
	}
	public function lihat() {
		$s = $this->input->post('skpd');
		
		//now
		$d = date('d/m/Y');
			
		//bulan+1
		$s = mktime(0,0,0,date("m")+1,date("d"),date("Y"));
		$t = date('d/m/Y',$s);
		
		$data = $d."|".$t;
		echo $data;
	}
	
	function lihat_child($s=""){
		$so = explode("-",$s);
		$spt = $so[0]."/".$so[1]."/".$so[2];
		
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		$wo = $this->db->query("select kd_rek,nm_rek,jumlah,kenaikan, denda, bunga, kompensasi from skpd_child where skpd='".$spt."'");
		
		$i=1;
		foreach($wo->result() as $w) {
			// cair
			$spt = '';
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$w->kd_rek."]]></cell>");
					echo("<cell><![CDATA[".$w->nm_rek."]]></cell>");
					echo("<cell><![CDATA[".$w->jumlah."]]></cell>");
					echo("<cell><![CDATA[".$w->kenaikan."]]></cell>");
					echo("<cell><![CDATA[".$w->denda."]]></cell>");
					echo("<cell><![CDATA[".$w->bunga."]]></cell>");
					echo("<cell><![CDATA[".$w->kompensasi."]]></cell>");
					echo("<cell><![CDATA[".$spt."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function detail_skpdlb() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_table("skpdlb_detail","id","kd_rek, nm_rek, jumlah, kenaikan, denda, bunga, kompensasi, skpdlb");
	}
	
	public function cariSKPDLB($kata_kunci="",$parameter="") {
		$qr = "";
		if($kata_kunci != '0'):
			$qr = "and a.$parameter like '%$kata_kunci%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("SELECT a.nomor, a.npwpd, a.no_sspd, a.masa_pajak1, a.masa_pajak2, a.tahun_pajak, a.ketetapan, a.setoran,  b.nama_pemilik, b.alamat_pemilik, b.nama_perusahaan, b.alamat_perusahaan, c.setoran_wp, c.kurang, c.lebih 
FROM sspd a 
LEFT JOIN view_perusahaan b ON a.npwpd=b.npwpd_perusahaan
JOIN pembayaran c ON a.no_sspd =c.no_sspd
WHERE a.dasar_setoran ='1' $qr","nomor","nomor, npwpd, no_sspd, masa_pajak1, masa_pajak2, tahun_pajak, ketetapan, setoran, nama_pemilik, alamat_pemilik, nama_perusahaan, alamat_perusahaan, setoran_wp, kurang, lebih");
	}
	
	public function simpan() {
		
		$utang = $_POST['utang'];
		if(strpos($utang, '.')){
			$utang = str_replace('.', '', $utang);
		} else {
			$utang;
		}
		
		$lebihbayar = $_POST['lebihbayar'];
		if(strpos($lebihbayar, '.')){
			$lebihbayar = str_replace('.', '', $lebihbayar);
		} else {
			$lebihbayar;
		}
		
		$jumlah = $_POST['jumlah'];
		if(strpos($jumlah, '.')){
			$jumlah = str_replace('.', '', $jumlah);
		} else {
			$jumlah;
		}
        
        $setoran = $_POST['jumlah_setoran'];
		if(strpos($setoran, '.')){
			$setoran = str_replace('.', '', $setoran);
		} else {
			$setoran;
		}
        
        $setoran_wp = $_POST['setoran_wp'];
		if(strpos($setoran_wp, '.')){
			$setoran_wp = str_replace('.', '', $setoran_wp);
		} else {
			$setoran_wp;
		}
        
        $kurang = $_POST['kurangbayar'];
		if(strpos($kurang, '.')){
			$kurang = str_replace('.', '', $kurang);
		} else {
			$kurang;
		}
	
		$data = array(
			'no_skpd' => $_POST['skpd'],
            'tgl' => $_POST['tgl'],
            'no_sspd' => $_POST['sspd'],
            'npwpd' => $_POST['npwpd'],
            'sk_bupati' => strtoupper($_POST['sk_bupati']),
            'bulan' =>  strtoupper($_POST['awal2']),
            'tgl_sk' => $_POST['tgl_sk'],
            'pajak_terhutang' => $utang,
            'masa_pajak1' => $_POST['awal'],
            'masa_pajak2' => $_POST['akhir'],
            'tahun' => $_POST['tahun'],
            'tgl_tempo' => $_POST['tempo'],                        
            'jumlah_lebih' => $lebihbayar,
            'jumlah_kurang' => $kurang,
            'jumlah_setoran' => $setoran,
            'setoran_wp' => $setoran_wp,
            'jumlah' => $jumlah,
            'author' => $this->session->userdata('username')
        );
		if($this->input->post('id')==0) {
			$thn = date('Y');
			$no_skpdlb = $this->generateNo($_POST['tahun']).'/SKPDLB/'.substr($_POST['tahun'],2,2);
			$dataIns = array_merge($data,array('no_skpdlb' => $no_skpdlb,'created' => date('Y-m-d H:i:s')));
			$result = $this->db->insert('skpdlb', $dataIns);
		} else {
			$no_skpdlb = $_POST['skpdlb'];
			$this->db->delete('skpdlb_detail',array('skpdlb' => $no_skpdlb));
			$dataUpdate = array_merge($data,array('no_skpdlb' => $no_skpdlb, 'modified' => date('Y-m-d H:i:s')));
			$result = $this->db->update('skpdlb',$dataUpdate,array('id' => $this->input->post('id')));
		}
		echo $no_skpdlb;
	}
	
	public function generateNo($thn) {
		$sql = $this->db->query("select MAX(SUBSTRING_INDEX(no_skpdlb,'/',1)) as max from skpdlb where tahun = '".$thn."'")->row();
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
	
	function mainData() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("SELECT
skpdlb.id AS id,
skpdlb.no_skpdlb AS no_skpdlb,
skpdlb.no_skpd AS no_skpd,
DATE_FORMAT(skpdlb.tgl,'%d/%m/%Y') AS tgl,
skpdlb.no_sspd AS no_sspd,
skpdlb.npwpd AS npwpd,
view_perusahaan.nama_pemilik AS nama_pemilik,
view_perusahaan.alamat_pemilik AS alamat_pemilik,
view_perusahaan.nama_perusahaan AS nama_perusahaan,
view_perusahaan.alamat_perusahaan AS alamat_perusahaan,
skpdlb.sk_bupati AS sk_bupati,
skpdlb.bulan AS bulan,
DATE_FORMAT(skpdlb.tgl_sk,'%d/%m/%Y') AS tgl_sk,
skpdlb.pajak_terhutang AS pajak_terhutang,
skpdlb.masa_pajak1 AS masa_pajak1,
skpdlb.masa_pajak2 AS masa_pajak2,
skpdlb.tahun AS tahun,
DATE_FORMAT(skpdlb.tgl_tempo,'%d/%m/%Y') AS tgl_tempo,
skpdlb.jumlah_lebih AS jumlah_lebih,
skpdlb.jumlah AS jumlah,
skpdlb.jumlah_kurang,
skpdlb.jumlah_setoran,
skpdlb.setoran_wp
FROM
skpdlb
INNER JOIN view_perusahaan ON skpdlb.npwpd = view_perusahaan.npwpd_perusahaan","id","id, no_skpdlb, no_skpd, tgl, no_sspd, npwpd, nama_pemilik, alamat_pemilik, nama_perusahaan, alamat_perusahaan, sk_bupati, bulan, tgl_sk, pajak_terhutang, masa_pajak1, masa_pajak2, tahun, tgl_tempo, jumlah_lebih, jumlah, jumlah_kurang, jumlah_setoran, setoran_wp");
	}
	
	function dSKPDLB(){
		$grid = new GridConnector($this->db->conn_id);
		if(isset($_GET['skpdlb'])) {
			$grid->render_sql("select kd_rek, nm_rek, jumlah, kenaikan, denda, bunga, kompensasi,skpdlb from skpdlb_detail where skpdlb = '".$_GET['skpdlb']."'","id","kd_rek, nm_rek, jumlah, kenaikan, denda, bunga, kompensasi,skpdlb");
		} else {
			$grid->render_table("skpdlb_detail","id","kd_rek, nm_rek, jumlah, kenaikan, denda, bunga, kompensasi,skpdlb");
		}
	}
	
	function hapus() {
		$no_sptpd = $this->input->post('sptpd_1')."/".$this->input->post('sptpd_2');
		$this->db->delete('sptpd_restoran',array('no_sptpd' => $no_sptpd));
		echo $no_sptpd;
	}
	
	public function cetak() {
		$list = $this->db->query("SELECT a.no_skpdlb as no_skpdlb, a.no_skpd as no_skpd, DATE_FORMAT(a.tgl,'%d/%m/%Y') as tgl, a.no_sspd as no_sspd, a.npwpd as npwpd, b.nama_pemilik as nama_pemilik, b.alamat_pemilik as alamat_pemilik,
b.nama_perusahaan as nama_perusahaan, b.alamat_perusahaan as alamat_perusahaan, a.sk_bupati as sk_bupati, a.bulan as bulan, DATE_FORMAT(a.tgl_sk,'%d/%m/%Y') as tgl_sk, a.pajak_terhutang as pajak_terhutang, a.masa_pajak1 as masa_pajak1, a.masa_pajak2 as masa_pajak2, a.tahun as tahun, DATE_FORMAT(a.tgl_tempo,'%d/%m/%Y') as tgl_tempo, 
a.jumlah_lebih as jumlah_lebih, a.jumlah as jumlah,
a.jumlah_kurang, a.jumlah_setoran, a.setoran_wp
FROM skpdlb a INNER JOIN view_perusahaan b ON a.npwpd=b.npwpd_perusahaan WHERE a.no_skpdlb='".$_GET['no_skpdlb']."'")->row();
		$no 				= $list->no_skpdlb;
		$npwpd 				= $list->npwpd;
		$nama 				= $list->nama_perusahaan;
		$alamat 			= $list->alamat_perusahaan;
		$namper				= $list->nama_pemilik;
		$awal				= $this->msistem->v_bln($list->masa_pajak1);
		$akhir 				= $this->msistem->v_bln($list->masa_pajak2);
		$tahun 				= $list->tahun;
		$ket				= '';
		$huruf				= '';
		$ttd				= '____________';
		$jabatan			= 'Kepala';
		$nip				= '12345';
		$m	= $this->msistem->v_bln(date('m'));
		$tanggal			= date('d').' '.$m.' '.date('Y');
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('P', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_SIGI');
		$pdf->SetKeywords('SOPD_SIGI');
	
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
					<td width="200" align="center">
						SURAT KETERANGAN PAJAK DAERAH<br />
						LEBIH BAYAR<br />
						Masa Pajak&nbsp;&nbsp;:&nbsp;&nbsp;'.$awal.' - '.$akhir.'<br />
						Tahun&nbsp;&nbsp;:&nbsp;&nbsp;'.$tahun.'
					</td>
					<td width="102" align="center">
						<br /><br />
						No. SKPDLB<br />
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
					<td width="170">&nbsp;&nbsp;30 hari setelah SPTPD ini diterima</td>
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
			
		$child = $this->db->query('select kd_rek, nm_rek, dp from skpd_child where skpd ="'.$list->no_skpd.'"')->row();
		$dp = $child->dp;
		$dp1	   = number_format($dp,2,",",".");
		
		$hutang 	= $list->jumlah;
		$hutang1   = number_format($hutang,2,",",".");
		
		//$set = $this->db->query('select setoran from sspd where nomor = "'.$list->no_skpd.'"')->row();
		
		//$setoran = $set->setoran;
        $setoran = $list->setoran_wp;
		$setoran1  = number_format($setoran,2,",",".");
		
        
		$lain = 0;
		$lain1 = number_format($lain,2,",",".");
		
		$kompensasi = 0;
		$kompensasi1 = number_format($kompensasi,2,",",".");
		
		$kredit = $setoran+$lain+$kompensasi;
		$kredit1 = number_format($kredit,2,",",".");
		
		$kelebihan = $kredit-$hutang;
		$kelebihan1 = number_format($kelebihan,2,",",".");
		
		$bunga = 0;
		$bunga1 = number_format($bunga,2,",",".");
		
		$kenaikan = 0;
		$kenaikan1 = number_format($kenaikan,2,",",".");
		
		$administrasi = $bunga+$kenaikan;
		$administrasi1 = number_format($administrasi,2,",",".");
		
		$total = $kelebihan-$administrasi;		
		$total1 = number_format($total,2,",",".");
			
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
        <td colspan="2">&nbsp;&nbsp;'.$child->kd_rek.'</td>
    </tr>
    <tr>
    	<td width="20">&nbsp;</td>
        <td colspan="3">Nama Rekening</td>
         <td width="24" align="center">:</td>
        <td colspan="2">&nbsp;&nbsp;'.$child->nm_rek.'</td>
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
        <td align="right" width="100">'.$dp1.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td width="20">&nbsp;</td>
      <td width="24">2.</td>
      <td colspan="2" width="250">Pajak yang terhutang</td>
      <td width="24">&nbsp;</td>
      <td align="right" width="100">Rp.</td>
      <td align="right" width="100">'.$hutang1.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
    	<td width="20">&nbsp;</td>
        <td width="24">3.</td>
        <td colspan="5">Kredit Pajak :</td>
    </tr>
    <tr>
    	<td colspan="2" width="44">&nbsp;</td>
        <td width="20">a.</td>
        <td width="230">Setoran</td>
        <td width="24">Rp.</td>
        <td align="right" width="100">'.$setoran1.'&nbsp;&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="2" width="44">&nbsp;</td>
        <td width="20">b.</td>
        <td width="230">Lain - lain</td>
        <td width="24">Rp.</td>
        <td align="right" width="100">'.$lain1.'&nbsp;&nbsp;</td>
        <td width="109">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" width="44">&nbsp;</td>
      <td width="20">c.</td>
      <td width="230">Dikurangi kompensasi kelebihan ke tahun yang akan datang/hutang pajak</td>
      <td width="24">Rp.</td>
      <td align="right" width="100">'.$kompensasi1.'&nbsp;&nbsp;</td>
      <td>+&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" width="44">&nbsp;</td>
      <td width="20">d.</td>
      <td width="230">Jumlah pajak yang dapat dikreditkan (a + b + c)</td>
      <td width="24">Rp.</td>
      <td align="right" width="100">'.$kredit1.'&nbsp;&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
	<tr>
      <td width="20">&nbsp;</td>
      <td width="24">4.</td>
      <td colspan="2" width="250">Jumlah kelebihan pembayaran Pokok Pajak (3d - 2)</td>
      <td width="24">&nbsp;</td>
      <td align="right" width="100">Rp.</td>
      <td align="right" width="100">'.$kelebihan1.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td width="20">&nbsp;</td>
      <td width="24">5.</td>
      <td colspan="5" width="250">Sanksi administrasi :</td>
    </tr>
    <tr>
      <td colspan="2" width="44">&nbsp;</td>
      <td width="20">a.</td>
      <td width="230">Bunga (Pasal 9(1))</td>
      <td width="24">Rp.</td>
      <td align="right" width="100">'.$bunga1.'&nbsp;&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" width="44">&nbsp;</td>
      <td width="20">b.</td>
      <td width="230">Kenaikan (Pasal 9(5))</td>
      <td width="24">Rp.</td>
      <td align="right" width="100">'.$kenaikan1.'&nbsp;&nbsp;</td>
      <td>+&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" width="44">&nbsp;</td>
      <td width="20">c.</td>
      <td width="230">Jumlah sanksi administrasi</td>
      <td width="24">Rp.</td>
      <td align="right" width="100">'.$administrasi1.'&nbsp;&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="20">&nbsp;</td>
      <td width="24">6.</td>
      <td colspan="2" width="250">Jumlah lebih bayar yang seharusnya tidak terhutang (4 + 5c)</td>
      <td width="24">&nbsp;</td>
      <td align="right" width="100">Rp.</td>
      <td align="right" width="100">'.$total1.'&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="7">&nbsp;</td>
	</tr>
				</table>
				</td>
				</tr>
				</table>';
				
			$terbilang = $this->msistem->baca($total);
			
			$report .=
				'<table border="1">
					<tr>
						<td width="572">
						<table border="0">
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td width="90">&nbsp;&nbsp;Dengan huruf</td>
								<td width="10" align="center">:</td>
								<td width="420">'.$terbilang.'&nbsp;RUPIAH</td>
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
				
		$s1 = $this->db->query("select nama, nip from admin where id_modul = '2'")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = $s1->nama;
			$nip1 = $s1->nip;
		}
				
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
						<td width="200" align="center">Sigi, '.$tanggal.'</td>
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
						<td width="200" align="center">'.$nip1.'</td>
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