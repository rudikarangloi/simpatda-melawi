<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class skpdt extends MY_Controller {
	
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
		$data['tahun'] = $this->msistem->tahun();
		$this->load->view('penetapan/skpdt',$data);
	}
	
	public function cariData($kata_kunci="",$parameter="",$kode_sptpd="") {
		$qr = "";
		if($kata_kunci != '0'):
			$qr = " and nota_hitung.$parameter like '%$kata_kunci%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("select nota_hitung.no_nota, nota_hitung.sptpd, nota_hitung.npwpd, identitas_perusahaan.nama_perusahaan, identitas_perusahaan.alamat_perusahaan, nota_hitung.masa_pajak1, nota_hitung.masa_pajak2, nota_hitung.tahun, nota_hitung.jumlah from nota_hitung left join identitas_perusahaan on nota_hitung.npwpd=identitas_perusahaan.npwpd_perusahaan where nota_hitung.sk='2' and nota_hitung.nama_sptpd = '".$kode_sptpd."' $qr","id","no_nota, sptpd, npwpd, nama_perusahaan, alamat_perusahaan, masa_pajak1, masa_pajak2, tahun, jumlah");
	}
	
	public function lihat() {
		$s = $this->input->post('nota');
		
		$d = date('d/m/Y');
			
		//bulan+1
		$s = mktime(0,0,0,date("m")+1,date("d"),date("Y"));
		$t = date('d/m/Y',$s);
		
		$q = $d."|".$t;

		echo $q;
	}
	
	function dataItemPajak1() {
		$so = $this->input->post('nota');
		$w = $this->db->query("select kd_rek,nm_rek,dp,tarif,kenaikan,denda,bunga,kompensasi,jumlah from nhp_child where no_nota='".$so."'")->row();
		$data = $w->kd_rek.";".$w->nm_rek.";".$w->dp.";".$w->tarif.";".$w->kenaikan.";".$w->denda.";".$w->bunga.";".$w->kompensasi.";".$w->jumlah;
		echo $data;
	}
	
	function child_skpdt() {
		$grid = new GridConnector($this->db->conn_id);
		if(isset($_GET['skpdt'])) {
			$grid->render_sql("select skpdt, kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah from skpdt_child where skpdt = '".$_GET['skpdt']."'","id","skpdt, kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah");
		} else {
			$grid->render_table("skpdt_child","id","skpdt, kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah");
		}
	}
	
	function test(){
		$d = date('d/m/Y');
		$s = mktime(0,0,0,date("m")+1,date("d"),date("Y"));
		$t = date('d/m/Y',$s);
		echo $t;
	}
	
	public function data() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id, a.no_skpdt, a.no_nota, a.no_sptpd, a.npwpd, b.nama_perusahaan, b.alamat_perusahaan, a.masa_pajak1, a.masa_pajak2, a.tahun, a.no_kohir, DATE_FORMAT(a.tgl,'%d/%m/%Y') as tgl, DATE_FORMAT(a.tgl_tempo,'%d/%m/%Y') as tgl_tempo, a.jumlah, a.nama_sptpd from skpdt a left join identitas_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.nama_sptpd = '".$_GET['kode']."'","id","id, no_skpdt, no_nota, no_sptpd, npwpd, nama_perusahaan, alamat_perusahaan, masa_pajak1, masa_pajak2, tahun, no_kohir, tgl, tgl_tempo, jumlah, nama_sptpd");
	}
	
	function simpan(){
		$data = array (
			'no_nota' 			=> strtoupper($this->input->post('nota')),
			'no_sptpd' 			=> strtoupper($this->input->post('sptpd')),
			'npwpd' 			=> strtoupper($this->input->post('npwpd')),
			'masa_pajak1' 		=> strtoupper($this->input->post('awal')),
			'masa_pajak2'		=> strtoupper($this->input->post('akhir')),
			'tahun' 			=> $this->input->post('tahun'),
			'tgl' 				=> strtoupper($this->input->post('tgl')),
			'tgl_tempo'			=> strtoupper($this->input->post('tempo')),
			'jumlah' 			=> strtoupper($this->input->post('jumlah')),
			'nama_sptpd' 		=> strtoupper($this->input->post('kode')),
			'author' 			=> strtoupper($this->session->userdata('username'))
		);
		if($this->input->post('id')==0){
			$skpdt = $this->generateNo($_POST['tahun'],$_POST['kode']);
			$kohir = $this->settingNo($_POST['tahun'],$_POST['kode']);
			$dataIns = array_merge($data,array('no_skpdt' => $skpdt, 'no_kohir' => $kohir, 'created' => date('Y-m-d H:i:s')));
			$this->db->insert('skpdt',$dataIns);
			$result = $skpdt."|".$kohir;
		} else {
			$skpdt = $this->input->post('skpdt');
			$kohir = $this->input->post('kohir');
			$this->db->delete('skpdt_child',array('skpdt' => $skpdt));
			$dataUpd = array_merge($data,array('no_skpdt' => $skpdt, 'no_kohir' => $kohir, 'modified' => date('Y-m-d H:i:s')));
			$this->db->update('skpdt', $dataUpd, array('id' => $this->input->post('id')));
			$result = $skpdt."|".$kohir;
		}
		echo $result;
	}
	
	public function settingNo($thn="",$kode=""){
		$sql = $this->db->query("select MAX(no_kohir) as max from skpdt where tahun = '".$thn."' and nama_sptpd = '".$kode."'");
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
		$sql = $this->db->query("select MAX(SUBSTRING_INDEX(no_skpdt,'/',1)) as max from skpdt where tahun = '".$thn."' and nama_sptpd = '".$kode."'")->row();
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
	
	public function cetak() {
		
		$data = $this->db->query("select a.id, a.no_skpdt, a.no_nota, a.no_sptpd, a.npwpd, b.nama_pemilik, b.alamat_pemilik, b.nama_perusahaan, b.alamat_perusahaan, a.masa_pajak1, a.masa_pajak2, a.tahun, a.no_kohir, DATE_FORMAT(a.tgl,'%d/%m/%Y') as tgl, DATE_FORMAT(a.tgl_tempo,'%d/%m/%Y') as tgl_tempo, a.jumlah, a.nama_sptpd from skpdt a left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.no_skpdt = '".$_GET['no_skpdt']."'")->row();
		
		$awal				= $this->msistem->v_bln($data->masa_pajak1);
		$akhir 				= $this->msistem->v_bln($data->masa_pajak2);
		$huruf				= '';
		$ttd				= '____________';
		$jabatan			= 'Kepala';
		$nip				= '12345';
		$m	= $this->msistem->v_bln(date('m'));
		$tanggal			= date('d').' '.$m.' '.date('Y');
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/header_output');
		$pdf = new header_output('P', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SIMTAP');
		$pdf->SetKeywords('SIMTAP');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(32);
		$pdf->SetMargins(20,30,20);
		// set font yang digunakan
		$pdf->SetFont('times', '', 10);
	
		$pdf->AddPage('P','LEGAL',false);
		//set data
		$report = '';
		
		$report = '';
		$report .=
			'<table border=1>
				<tr>
					<td width="180">
						PEMERINTAH KABUPATEN SIGI<br />
						DINAS PENDAPATAN PENGELOLAAN KEUANGAN DAN ASET DAERAH<br />
						Jalan Poros PALU - Telp (0655) 7006013<br />
						Fax (0655)7551162,7551165<br />
						PALOLO					
					</td>
					<td width="242" align="center">
						SURAT KETETAPAN PAJAK DAERAH TAMBAHAN<br />
						Masa Pajak&nbsp;&nbsp;:&nbsp;&nbsp;'.$awal.' - '.$akhir.'<br />
						Tahun&nbsp;&nbsp;:&nbsp;&nbsp;'.$data->tahun.'
					</td>
					<td width="150" align="center">
						<br /><br />
						No. KOHIR<br />
						'.$data->no_kohir.'
					</td>
				</tr>
			</table>';
			
		$report .=
			'<table border="1">
				<tr>
				<td>
				<table>
				<tr>
					<td width="140">&nbsp;&nbsp;NAMA PERUSAHAAN</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$data->nama_perusahaan.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;ALAMAT PERUSAHAAN</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$data->alamat_perusahaan.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;NAMA PEMILIK</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$data->nama_pemilik.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;NPWPD</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$data->npwpd.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;TANGGAL JATUH TEMPO</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;30 hari setelah SPTPD ini diterima</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;KETERANGAN</td>
					<td width="10" align="center">:</td>
					<td width="170">&nbsp;&nbsp;'.$huruf.'</td>
				</tr>
				</table>
				</td>
				</tr>
			</table>';
		
		$report .=
			'<table border="1">
			<tr>
			<td>
			<table border=1>
				<tr>
				  <td width="30" align="center">NO</td>
				  <td width="101" align="center">REKENING</td>
				  <td width="221" align="center" colspan="2">Nama Rekening</td>
				  <td width="220" align="center">JUMLAH</td>
				</tr>';
			$child = $this->db->query("select * from nhp_child where no_nota ='".$data->no_nota."'");
			$i = 1;
			foreach($child->result() as $ch) {
					$report .= '
				<tr id='.$i.'>
				  <td width="30" align="center">&nbsp;&nbsp;'.$i.'</td>
				  <td width="101" align="center">&nbsp;&nbsp;'.$ch->kd_rek.'</td>
				  <td width="221" align="center" colspan="2">&nbsp;&nbsp;'.$ch->nm_rek.'</td>
				  <td width="220" align=right>Rp.'.number_format($ch->jumlah,2,",",".").'&nbsp;&nbsp;</td>
				</tr>';
				$i++;
			}
			
			$ketetapan = '';
			$bunga = '';
			$kenaikan = '';
			$report .=
			'</table>
			</td>
			</tr>
			<tr>
			<td width="572" colspan="3">
			<table border="0">
				<tr>
				  <td>&nbsp;</td>
				  <td width="35">&nbsp;</td>
				  <td width="203" colspan="2" align="right">Jumlah Ketetapan Pokok Pajak</td>
				  <td width="220" align="right">'.$ketetapan.'&nbsp;&nbsp;</td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td width="35">&nbsp;</td>
				  <td width="140" align="right">Jumlah Sanksi :</td>
				  <td width="62" align="right">a. Bunga</td>
				  <td width="220" align="right">'.$bunga.'&nbsp;&nbsp;</td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td>&nbsp;</td>
				  <td width="61" align=left>&nbsp;</td>
				  <td width="62" align="right">b. Kenaikan</td>
				  <td width="220" align="right">'.$kenaikan.'&nbsp;&nbsp;</td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td>&nbsp;</td>
				  <td colspan=2 align=left>Jumlah Keseluruhan</td>
				  <td align=right>Rp. '.number_format($data->jumlah,2,",",".").'&nbsp;&nbsp;</td>
				</tr>
				</table>
			</td>
			</tr>
			<tr>
			<td colspan="3" width="572">
			<table border=0>
				<tr>
					<td width=110>&nbsp;&nbsp;Dengan huruf</td>
					<td width=10 align=center>:</td>
					<td width=460>&nbsp;&nbsp;'.$huruf.'</td>
				</tr>
			</table>
			</td>
			</tr>
			<tr>
			<td colspan="3" width="572">
			<table border=0>
				<tr>
					<td colspan=9>&nbsp;&nbsp;<u>P E R H A T I A N</u></td>
				</tr>
				<tr>
					<td width=29 valign=top>&nbsp;&nbsp;1.</td>
					<td width=530>Harap penyetoran dilakukan pada Bendaraha Penerimaan Dinas Pendapatan Daerah / Bank dengan menggunakan Surat Setoran Pajak Daerah (SSPD)</td>
				</tr>
				<tr>
					<td width=29 valign=top>&nbsp;&nbsp;2.</td>
					<td width=530>Apabila SPTPD ini tidak atau kurang dibayar setelah lewat waktu paling lama 30 hari setelah SPTPD ini diterima akan dikenakan sanksi administrasi berupa bunga sebesar 2% per bulan</td>
				</tr>
				</table>
			</td>
			</tr>
			<tr>
			<td colspan="3" width="572">
			<table border=0>
				<tr align="center">
					<td colspan=4 width=400>&nbsp;</td>
					<td colspan=5 width=400 align=center>
					Meulaboh, '.$tanggal.'
					</td>
				</tr>
				<tr align="center">
					<td colspan=4 width=400>&nbsp;</td>
					<td colspan=5 width=300 align=center>
					a.n. KEPALA DINAS PENDAPATAN DAERAH
					</td>
				</tr>
				<tr align="center">
					<td colspan=4 width=400>&nbsp;</td>
					<td colspan=5 width=300 align=center>
					KABUPATEN ACEH BARAT
					</td>
				</tr>
				<tr align="center">
					<td colspan=4 width=400>&nbsp;</td>
					<td colspan=5 width=300 align=center>
					KABID PENDAPATAN DAN PENETAPAN</td>
				</tr>
				<tr align="center">
					<td colspan=9 width=700 height=70>&nbsp;</td>
				</tr>
				<tr align="center">
					<td colspan=4 width=400>&nbsp;</td>
					<td colspan=5 width=300 align=center>
					'.$ttd.'
					</td>
				</tr>
				<tr align="center">
					<td colspan=4 width=400>&nbsp;</td>
					<td colspan=5 width=300 align=center>
					'.$jabatan.'
					</td>
				</tr>
				<tr align="center">
					<td colspan=4 width=400>&nbsp;</td>
					<td colspan=5 width=300 align=center>
					'.$nip.'</td>
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