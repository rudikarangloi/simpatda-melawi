<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class stpd extends MY_Controller {
	
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
		$data['tahun'] = $this->msistem->tahun();
		$this->load->view('penetapan/stpd',$data);
	}
	
	function simpan() {
		$data = array (
			'no_skpd' => $_POST['skpd'],
			'no_sptpd' => $_POST['sptpd'],
			'npwpd' => $_POST['npwpd'],
			'masa_pajak1' => $_POST['awal'],
			'masa_pajak2' => $_POST['akhir'],
			'tahun' => $_POST['tahun'],
			'jumlah' => $_POST['jumlah'],
			'tanggal_tempo' => $_POST['tempo'],
			'tanggal' => $_POST['tgl'],
			'kd_sptpd' => $_POST['kode']
		);
		
		if($this->input->post('id')==0){
			$stpd = $this->generateNo($_POST['tahun'],$_POST['kode']);
			$kohir = $this->settingNo($_POST['tahun'],$_POST['kode']);
			$dataIns = array_merge($data,array('no_stpd' => $stpd, 'no_kohir' => $kohir, 'created' => date('Y-m-d H:i:s')));
			$this->db->insert('stpd',$dataIns);
			$result = $stpd."|".$kohir;
		} else {
			$stpd = $this->input->post('stpd');
			$kohir = $this->input->post('kohir');
			$this->db->delete('stpd_child',array('stpd' => $stpd));
			$dataUpd = array_merge($data,array('no_stpd' => $stpd, 'no_kohir' => $kohir, 'modified' => date('Y-m-d H:i:s')));
			$this->db->update('stpd', $dataUpd, array('id' => $this->input->post('id')));
			$result = $stpd."|".$kohir;
		}
		echo $result;
	}
	
	public function settingNo($thn="",$kode=""){
		$sql = $this->db->query("select MAX(no_kohir) as max from stpd where tahun = '".$thn."' and kd_sptpd = '".$kode."'");
		$r = $sql->row();
		if($r==NULL){
			$no = '00001';
		} else {
			$jml = $r->max + 1;
			if(strlen($jml)==1) {
				$jml = '0000'.$jml;
			} else if(strlen($jml)==2) {
				$jml = '000'.$jml;
			} else if(strlen($jml)==3) {
				$jml = '00'.$jml;
			} else if(strlen($jml)==4) {
				$jml = '0'.$jml;
			} else if(strlen($jml)==5) {
				$jml;
			}
			$no = $jml;
		}
		return $no;
	}
	
	public function generateNo($thn="",$kode=""){
		$sql = $this->db->query("select MAX(SUBSTRING_INDEX(no_stpd,'/',1)) as max from stpd where tahun = '".$thn."' and kd_sptpd = '".$kode."'")->row();
		$r = $sql->max;
		if($r==NULL){
			$no = '000000001/'.$kode.'/'.substr($thn,2,2);
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
			$no = $jml.'/'.$kode.'/'.substr($thn,2,2);
		}
		return $no;
	}
	
	function delete() {
		$no_stpd = $this->input->post('id');
		$s = $this->db->query("select count(id) as jml from sspd where no_skpd='".$no_stpd."'")->row();
		$we = $s->jml; 
		if($we==0){
			$this->db->delete('stpd',array('no_stpd' => $no_stpd));
			$result = "Data STPD berhasil dihapus.";
		} else {
			$result = "Silakan Menghapus Data SSPD Terlebih Dahulu";
		}
		echo $result;
	}
	
	public function cariData($kata_kunci="",$parameter="",$kode_sptpd="") {
		$qr = "";
		if($kata_kunci != '0'):
			$qr = " and skpd.$parameter like '%$kata_kunci%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("SELECT
skpd.no_skpd,
skpd.nota_hitung,
skpd.npwpd,
view_perusahaan.nama_perusahaan,
view_perusahaan.alamat_perusahaan,
view_perusahaan.nama_pemilik,
view_perusahaan.alamat_pemilik,
skpd.masa_pajak1,
skpd.masa_pajak2,
skpd.tahun,
skpd.jumlah,
skpd.no_sptpd
FROM
view_perusahaan
INNER JOIN skpd ON view_perusahaan.npwpd_perusahaan = skpd.npwpd where skpd.status=0 and skpd.kode_sptpd = '".$kode_sptpd."' $qr","id","no_skpd, nota_hitung, no_sptpd, npwpd, nama_perusahaan, alamat_perusahaan, nama_pemilik, alamat_pemilik, masa_pajak1, masa_pajak2, tahun, jumlah");
	}
	
	function child_stpd() {
		$grid = new GridConnector($this->db->conn_id);
		if(isset($_GET['stpd'])) {
			$grid->render_sql("select kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah, stpd from stpd_child where stpd = '".$_GET['stpd']."'","id","kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah, stpd");
		} else {
			$grid->render_table("stpd_child","id","kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah, stpd");
		}
	}
	
	function dataItemPajak1() {
		$so = $this->input->post('skpd');
		
		$d = date('d/m/Y');
			
			//bulan+1
		$s = mktime(0,0,0,date("m")+1,date("d"),date("Y"));
		$t = date('d/m/Y',$s);
		
		$gabung = $d.'|'.$t;
		echo $gabung;
	}
	
	function dataItemPajak12($s=""){
		$so = explode("-",$s);
		$spt = $so[0]."/".$so[1]."/".$so[2];
		
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		$wo = $this->db->query("select kd_rek,nm_rek,dp,tarif,kenaikan,denda,bunga,kompensasi,jumlah from skpd_child where skpd='".$spt."'");
		
		$i=1;
		foreach($wo->result() as $w) {
			// cair
			$spt = '';
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
					echo("<cell><![CDATA[".$spt."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function data() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("SELECT
stpd.no_stpd,
stpd.no_skpd,
stpd.npwpd,
view_perusahaan.nama_perusahaan,
view_perusahaan.alamat_perusahaan,
stpd.masa_pajak1,
stpd.masa_pajak2,
stpd.tanggal_tempo,
stpd.tanggal,
stpd.tahun,
stpd.no_kohir,
stpd.jumlah,
stpd.no_sptpd,
stpd.id,
view_perusahaan.nama_pemilik,
view_perusahaan.alamat_pemilik
FROM
view_perusahaan
INNER JOIN stpd ON view_perusahaan.npwpd_perusahaan = stpd.npwpd where stpd.kd_sptpd = '".$_GET['kode']."'","id","id, no_stpd, no_skpd, no_sptpd, npwpd, nama_perusahaan, alamat_perusahaan, nama_pemilik, alamat_pemilik, masa_pajak1, masa_pajak2, tahun, no_kohir, tanggal, tanggal_tempo, jumlah");
	
	}
	
	public function cetak_report(){
	
	$data = $this->db->query("select stpd.no_stpd, stpd.no_skpd, stpd.npwpd, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, stpd.masa_pajak1, stpd.masa_pajak2, stpd.tanggal_tempo, stpd.tanggal, stpd.tahun, stpd.no_kohir, stpd.jumlah, stpd.no_sptpd, stpd.id, view_perusahaan.nama_pemilik, view_perusahaan.alamat_pemilik from view_perusahaan left join stpd on view_perusahaan.npwpd_perusahaan=stpd.npwpd where stpd.no_stpd='".$_GET['sptpd']."'")->row();
		$no 				= $data->no_stpd;
		$npwpd 				= $data->npwpd;
		$nama 				= $data->nama_perusahaan;
		$alamat 			= $data->alamat_perusahaan;
		$namper				= $data->nama_pemilik;
		$awal				= $this->msistem->v_bln($data->masa_pajak1);
		$akhir 				= $this->msistem->v_bln($data->masa_pajak2);
		$tahun 				= $data->tahun;
		$ket				= '';
		$total				= number_format($data->jumlah,2,",",".");
		$huruf				= '';
		
		$s1 = $this->db->query("select nama, nip from admin where id_modul = '2'")->row();
		if($s1==NULL){
			$jabatan = '';
			$nip = '';
		} else {
			$jabatan = $s1->nama;
			$nip = $s1->nip;
		}
		$ttd				= '';
		$m	= $this->msistem->v_bln(date('m'));
		$tanggal			= date('d').' '.$m.' '.date('Y');
		$kurang = number_format($data->jumlah,2,",",".");
		$denda = number_format(0,2,",",".");
		$bunga = number_format(0,2,",",".");
		$sanksi = number_format(0,2,",",".");
		$bayar = number_format($data->jumlah,2,",",".");
		$terbilang = $this->msistem->baca($data->jumlah);
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('P', 'pt', 'A4', true, 'UTF-8', false);  
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SIMTAP');
		$pdf->SetKeywords('SIMTAP');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(10);
		$pdf->SetMargins(10,10,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 10);
	
		$pdf->AddPage('P','A4',false);
		//set data
		$report = '';
//		$report .= 'jauhh'.$s;
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
						SURAT TAGIHAN PAJAK DAERAH<br />
						Masa Pajak&nbsp;&nbsp;:&nbsp;&nbsp;'.$awal.' - '.$akhir.'<br />
						Tahun&nbsp;&nbsp;:&nbsp;&nbsp;'.$tahun.'
					</td>
					<td width="92" align="center">
						<br /><br />
						No. STPD<br />
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
			
		$child = $this->db->query('select kd_rek, nm_rek from stpd_child where stpd="'.$no.'"')->row();
			
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
        <td colspan="6" width="550">Berdasarkan Pasal 7 pasal 10 undang-undang No. 18 Tahun 1997 telah dilakukan penelitian dan/atau pemeriksaan atau keterangan lain atas pelaksanaan kewajiban</td>
    </tr>
    <tr>
    	<td width="20">&nbsp;</td>
        <td colspan="3" width="150">Nomor Rekening</td>
        <td width="29" align="center">:</td>
        <td colspan="2" width="250">&nbsp;&nbsp;'.$child->kd_rek.'</td>
    </tr>
    <tr>
    	<td width="20">&nbsp;</td>
        <td colspan="3" width="150">Nama Rekening</td>
         <td width="29" align="center">:</td>
        <td colspan="2" width="250">&nbsp;&nbsp;'.$child->nm_rek.'</td>
    </tr>
	<tr>
    	<td width="20" valign="top">&nbsp;&nbsp;2.</td>
        <td colspan="6" width="550">Dari penelitian dan/atau pemeriksaan tersebut diatas, perhitungan jumlah yang masih harus dibayar adalah sebagai berikut :</td>
    </tr>
    <tr>
    	<td width="20">&nbsp;</td>
        <td width="24">1.</td>
        <td colspan="2" width="220">Pajak yang Kurang dibayar</td>
        <td width="29">Rp.</td>
        <td align="right" width="140">'.$kurang.'&nbsp;&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
    	<td width="20">&nbsp;</td>
        <td width="24">2.</td>
        <td colspan="5">Sanksi administrasi</td>
    </tr>
    <tr>
    	<td colspan="2" width="120">&nbsp;</td>
        <td width="20">a.</td>
        <td width="125">Bunga ( Psl.10(3) )</td>
        <td width="29">Rp.</td>
        <td align="right" width="140">'.$bunga.'&nbsp;&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="2" width="120">&nbsp;</td>
        <td width="20">b.</td>
        <td width="125">Jumlah sanksi administrasi</td>
        <td width="29">Rp.</td>
        <td align="right" width="140">'.$sanksi.'&nbsp;&nbsp;</td>
        <td width="242">+&nbsp;</td>
    </tr>
    <tr>
    	<td width="20">&nbsp;&nbsp;3.</td>
        <td colspan="3">Jumlah yang masih harus dibayar</td>
        <td width="29">Rp.</td>
        <td align="right" width="140">'.$bayar.'&nbsp;&nbsp;</td>
        <td width="242">&nbsp;</td>
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
								<td width="420">&nbsp;'.$terbilang.'</td>
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
		<td colspan="2">&nbsp;</td>
	</tr>
    <tr>
    	<td colspan="2">&nbsp;&nbsp;<u>P E R H A T I A N</u></td>
    </tr>
    <tr>
    	<td width="29" valign="top">&nbsp;&nbsp;1.</td>
        <td width="530">Harap Wajib Pajak melakukan penyetoran ke Bendaraha Penerima DPKD Kabupaten Sigi / Bank dengan menggunakan Surat Setoran Pajak Daerah (SSPD)</td>
    </tr>
    <tr>
    	<td width="29" valign="top">&nbsp;&nbsp;2.</td>
        <td width="530">Apabila SPTPD ini tidak atau kurang dibayar setelah lewat waktu paling lama 30 hari setelah SPTPD ini diterima akan dikenakan sanksi administrasi berupa bunga sebesar 2% per bulan</td>
    </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
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
						<td width="200" align="center">'.$ttd.'</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">'.$jabatan.'</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">'.$nip.'</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
				</table>
				</td>
				</tr>
			</table>';

		//$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_SKPD'.'.pdf', 'I');
	}
}
?>