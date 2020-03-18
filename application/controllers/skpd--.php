<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class skpd extends MY_Controller {
	
	function __construct() {
            parent::__construct();
            $this->load->model('msistem');
    }
	
	public function index() {
		$data['tahun'] = $this->msistem->tahun();
		$this->load->view('penetapan/skpd',$data);
	}
	
	public function frmskpd($idtype="") {
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$p = $this->db->query("select nama_sptpd from master_sptpd where kode_sptpd = '".$idtype."'")->row();
		$data['nama_sptpd'] = $p->nama_sptpd;
		$data['kode_sptpd'] = $idtype;
		$data['username'] = $username = $this->session->userdata('username');
		$data['tahun'] = $this->msistem->tahun();
		$this->load->view('penetapan/skpd',$data);
	}
    
   	public function frmskpd_reklame($idtype="") {
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$p = $this->db->query("select nama_sptpd from master_sptpd where kode_sptpd = '".$idtype."'")->row();
		$data['nama_sptpd'] = $p->nama_sptpd;
		$data['kode_sptpd'] = $idtype;
		$data['username'] = $username = $this->session->userdata('username');
		$data['tahun'] = $this->msistem->tahun();
		$this->load->view('penetapan/skpd_reklame',$data);
	}
	public function lihat() {
		$s = $this->input->post('npwpd');
		
		$w = $this->db->query("select nama_perusahaan,alamat_perusahaan from identitas_perusahaan where id_perusahaan='".$s."'")->row();
		if($w==NULL){
			$q = 0;
		} else {	
			$nama = $w->nama_perusahaan;
			$alamat = $w->alamat_perusahaan;
				
			$q = $nama."|".$alamat;
		}
		echo $q;
	}
	
	public function cariData($kata_kunci="",$parameter="",$kode_sptpd="") {
		$qr = "";
		if($kata_kunci != '0'):
			$qr = " and $parameter like '%$kata_kunci%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("select nota_hitung.no_nota, nota_hitung.sptpd, nota_hitung.npwpd, nota_hitung.tgl, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, view_perusahaan.nama_pemilik, view_perusahaan.alamat_pemilik, nota_hitung.masa_pajak1, nota_hitung.masa_pajak2, nota_hitung.tahun, nota_hitung.jumlah from nota_hitung left join view_perusahaan on nota_hitung.npwpd=view_perusahaan.npwpd_perusahaan where nota_hitung.nama_sptpd = '".$kode_sptpd."' and nota_hitung.status ='0' $qr","id","no_nota, sptpd, npwpd, tgl, nama_perusahaan ,alamat_perusahaan, nama_pemilik, alamat_pemilik, masa_pajak1, masa_pajak2, tahun, jumlah");
	}
	
	public function cData(){
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("select nota_hitung.no_nota, nota_hitung.sptpd, nota_hitung.npwpd, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, view_perusahaan.nama, view_perusahaan.alamat, nota_hitung.masa_pajak1, nota_hitung.masa_pajak2, nota_hitung.tahun, nota_hitung.jumlah from nota_hitung left join view_perusahaan on nota_hitung.npwpd=view_perusahaan.id_perusahaan where nota_hitung.nama_sptpd = '".$_GET['kode']."'","id","no_nota,sptpd,npwpd,nama_perusahaan,alamat_perusahaan,nama,alamat,masa_pajak1,masa_pajak2,tahun,jumlah");
	}
	
	public function cektempo(){
		if($_POST['tempo']==NULL){
			$d = date('d/m/Y');
			
			//bulan+1
			$s = mktime(0,0,0,date("m")+1,date("d"),date("Y"));
			$t = date('d/m/Y',$s);
			
			$result = $d.'|'.$t;
		}
		echo $result;
	}
	
	public function simpan() {
		$upd = array (
				'status' => 1
		);
		$this->db->update('nota_hitung', $upd, array('no_nota' => $_POST['nota_hitung']));
			
		$jml = $_POST['jml'];
		if(strpos($jml, '.')){
			$jml = str_replace('.', '', $jml);
		} else {
			$jml;
		}
		
		$data = array(
            'nota_hitung' => $_POST['nota_hitung'],
            'npwpd' => $_POST['npwpd'],
            /*'nama' => $_POST['nama'],
            'alamat' => strtoupper($_POST['alamat']),
            'nm_pemilik' =>  strtoupper($_POST['nm_pemilik']),
            'alamat_pemilik' => $_POST['alamat_pemilik'],*/
            'masa_pajak1' => $_POST['awal'],
            'masa_pajak2' => $_POST['akhir'],
            'tahun' => $_POST['tahun'],
            'tgl_jth_tempo' => $_POST['tgl_jth_tempo'],
            'tgl' => $_POST['tgl'],                        
            'no_sptpd' => $_POST['no_sptpd'],
            'jumlah' =>  $jml,
			'kode_sptpd' =>  $_POST['kode_sptpd'],
			'tahun_transaksi' => date('Y'),
            'author' => $this->session->userdata('username')
        );
		if($this->input->post('skpd_1')=="") {
			$thn = date('Y');
			$no_skpd = $this->generateNo($thn,$_POST['kode_sptpd']).'/'.$_POST['kode_sptpd'].'/'.substr($thn,2,2);
			$no_kohir = $this->generateNo($thn,$_POST['kode_sptpd']);
			$dataIns = array_merge($data,array('no_skpd' => $no_skpd,'no_kohir' => $no_kohir,'created' => date('Y-m-d H:i:s')));
			$result = $this->db->insert('skpd', $dataIns);
		} else {
			$no_skpd = $this->input->post('skpd_1')."/".$this->input->post('skpd_2');
			$this->db->delete('skpd_child',array('skpd' => $no_skpd));
			$dataUpdate = array_merge($data,array('author' => $this->session->userdata('username'),'modified' => date('Y-m-d H:i:s')));
			$result = $this->db->update('skpd',$dataUpdate,array('no_skpd' => $no_skpd));
		}
		echo $no_skpd;
	}
	
	public function generateNo($thn="",$kode="") {
		$sql = $this->db->query("select MAX(SUBSTRING_INDEX(no_skpd,'/',1)) as max from skpd where tahun_transaksi = '".$thn."' and kode_sptpd = '".$kode."'");
		$r = $sql->row();
		$jml = $r->max + 1;
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
		return $jml;
	}
	
	function mainData() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("select skpd.no_skpd, DATE_FORMAT(skpd.tgl,'%d/%m/%Y') as tgl,
         DATE_FORMAT(skpd.tgl_jth_tempo,'%d/%m/%Y') as tgl_jth_tempo, view_perusahaan.nama_perusahaan,
          view_perusahaan.alamat_perusahaan , view_perusahaan.nama_pemilik, view_perusahaan.alamat_pemilik, 
          npwpd, skpd.jumlah as total, skpd.masa_pajak1, skpd.masa_pajak2, skpd.tahun, skpd.no_sptpd, skpd.nota_hitung, 
          skpd.no_kohir from skpd left join view_perusahaan on skpd.npwpd=view_perusahaan.npwpd_perusahaan
           where skpd.kode_sptpd = '".$_GET['kode']."'","id","no_skpd, tgl, nama_perusahaan, alamat_perusahaan,
            nama_pemilik, alamat_pemilik, npwpd, total, masa_pajak1, masa_pajak2, tahun, tgl_jth_tempo, no_sptpd, nota_hitung, no_kohir");
	}
	
	function hapus() {
		$no_skpd = $this->input->post('skpd_1')."/".$this->input->post('skpd_2');
		$s = $this->db->query("select count(id) as jml from sspd where nomor='".$no_skpd."'")->row();
		$we = $s->jml; 
		if($we==0){
			$this->db->delete('skpd',array('no_skpd' => $no_skpd));
			$result = "Data SKPD berhasil dihapus.";
		} else {
			$result = "Data tidak Bisa dihapus No.SKPD ini sudah ditransaksikan di SSPD,Silakan Menghapus Data SSPD Terlebih Dahulu";
		}
		echo $result;
	}
	
	function dataItemPajak() {
		$grid = new GridConnector($this->db->conn_id);
		if(isset($_GET['skpd'])) {
			$grid->render_sql("select kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah, skpd from skpd_child where skpd = '".$_GET['skpd']."'","id","kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah, skpd");
		} else {
			$grid->render_sql("select kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah, skpd from skpd_child","id","kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah, skpd");
		}
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
	
	public function dt_rekening() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_table("skpd_child","id","kd_rek, nm_rek, dp, tarif, kenaikan, denda, bunga, kompensasi, jumlah, skpd");
											//No Nota, Kode Rekening, Nama Rekening, DP, Tarif, Kenaikan, Denda, Kompensasi, Bunga, Jumlah, SPTPD
	}
	
	public function cetak() {		
		$data = $this->db->query("select a.no_skpd, DATE_FORMAT(a.tgl,'%d/%m/%Y') as tgl, DATE_FORMAT(a.tgl_jth_tempo,'%d/%m/%Y') as tgl_jth_tempo, b.nama_perusahaan, b.alamat_perusahaan, b.nama_pemilik, b.alamat_pemilik, b.npwpd_perusahaan, '0' as denda, a.jumlah as total, a.masa_pajak1, a.masa_pajak2, a.tahun, a.no_sptpd, a.nota_hitung, a.no_kohir from skpd a left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.no_skpd='".$_GET['skpd']."'")->row();
		$no 				= $data->no_skpd;
		$npwpd 				= $data->npwpd_perusahaan;
		$nama 				= $data->nama_perusahaan;
		$alamat 			= $data->alamat_perusahaan;
		$namper				= $data->nama_pemilik;
		$awal				= $this->msistem->v_bln($data->masa_pajak1);
		$akhir 				= $this->msistem->v_bln($data->masa_pajak2);
		$t 				    = explode('/',$data->tgl_jth_tempo);
		$b                  = $this->msistem->v_bln($t[1]);
		$tempo              = $t[0].' '.$b.' '.$t[2];
		$tahun 				= $data->tahun;
		$ket				= '';
		$total				= number_format($data->total,2,",",".");
		
		$s = explode('/',$no);
		$sptpd = $s[1];
		if($sptpd=='HTL'){
			$nama_sptpd = 'HOTEL';
		} else if($sptpd=='RES'){
			$nama_sptpd = 'RESTORAN';
		} else if($sptpd=='REK'){
			$nama_sptpd = 'REKLAME';
		} else if($sptpd=='HIB'){
			$nama_sptpd = 'HIBURAN';
		} else if($sptpd=='GAL'){
			$nama_sptpd = 'MINERAL BUKAN LOGAM DAN BATUAN';
		} else if($sptpd=='AIR'){
			$nama_sptpd = 'AIR TANAH';
		} else if($sptpd=='PKR'){
			$nama_sptpd = 'PARKIR';
		} else if($sptpd=='LIS'){
			$nama_sptpd = 'PENERANGAN JALAN';
		} else if($sptpd=='WLT'){
			$nama_sptpd = 'BURUNG WALET';
		}
		
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
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('P', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_JAMBI');
		$pdf->SetKeywords('SOPD_JAMBI');
	
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
						PEMERINTAH KOTA JAMBI<br />
						DINAS PENDAPATAN KOTA JAMBI<br />
						Jl. Jend. Basuki Rachmat Kota Baru<br />
						Telp. (0741) 40284<br />
					</td>
					<td width="210" align="center">
						SURAT KETETAPAN PAJAK DAERAH<br />
						PAJAK '.$nama_sptpd.'<br />
						Masa Pajak&nbsp;&nbsp;:&nbsp;&nbsp;'.$awal.' - '.$akhir.'<br />
						Tahun&nbsp;&nbsp;:&nbsp;&nbsp;'.$tahun.'
					</td>
					<td width="92" align="center">
						<br /><br />
						No. SKP<br />
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
			
		$report .=
			'<table border="1">
				<tr>
					<td width="25" height="25" align="center">No</td>
					<td width="115" height="25" align="center">Kode Rekening</td>
					<td width="120" height="25" align="center">Nama Rekening</td>
					<td width="182" height="25" align="center">Uraian</td>
					<td width="130" height="25" align="center">Jumlah</td>
				</tr>';
			
			$child = $this->db->query("select * from skpd_child where skpd ='".$no."'");
			$i = 1;
			foreach($child->result() as $ch) {
					$report .= '<tr id='.$i.'>
					  <td width="25" height="25" align="center">'.$i.'</td>
					  <td width="115" height="25" align="center">'.$ch->kd_rek.'</td>
					  <td width="120" height="25" align="center">'.$ch->nm_rek.'</td>
					  <td width="182" height="25" align="center">'.number_format($ch->dp,2,',','.').' x '.$ch->tarif.'%</td>
					  <td width="130" height="25" align="right">Rp. '.number_format($ch->jumlah,2,',','.').'&nbsp;&nbsp;</td>
					</tr>';
					$i++;
			}
			
			$report .=
				'<tr>
					  <td colspan="3" height="25" width="442" align="right">Jumlah Ketetapan Pokok Pajak&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td width="130" height="25" align="right">Rp. '.$total.'&nbsp;&nbsp;</td>
				</tr>
				</table>';
			
			$terbilang = $this->msistem->baca($data->total);
			
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
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">Jambi, '.$tanggal.'</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">an. Kepala Dinas Pendapatan Kota Jambi</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
					<td width="200" align="center">Kabid. Pendataan, Penetapan dan Penagihan</td>
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
		
		//$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_SKPD'.'.pdf', 'I');
	}
    
    	public function cetak_reklame() {		
		$data = $this->db->query("select a.no_skpd, DATE_FORMAT(a.tgl,'%d/%m/%Y') as tgl, DATE_FORMAT(a.tgl_jth_tempo,'%d/%m/%Y') as tgl_jth_tempo, b.nama_perusahaan, b.alamat_perusahaan, b.nama_pemilik, b.alamat_pemilik, b.npwpd_perusahaan, '0' as denda, a.jumlah as total, a.masa_pajak1, a.masa_pajak2, a.tahun, a.no_sptpd, a.nota_hitung, a.no_kohir from skpd a left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.no_skpd='".$_GET['skpd']."'")->row();
		$no 				= $data->no_skpd;
		$npwpd 				= $data->npwpd_perusahaan;
		$nama 				= $data->nama_perusahaan;
		$alamat 			= $data->alamat_perusahaan;
		$namper				= $data->nama_pemilik;
		$awal				= $this->msistem->v_bln($data->masa_pajak1);
		$akhir 				= $this->msistem->v_bln($data->masa_pajak2);
		$t 				    = explode('/',$data->tgl_jth_tempo);
		$b                  = $this->msistem->v_bln($t[1]);
		$tempo              = $t[0].' '.$b.' '.$t[2];
		$tahun 				= $data->tahun;
		$ket				= '';
		$total				= number_format($data->total,2,",",".");
		
		$s = explode('/',$no);
		$sptpd = $s[1];
		if($sptpd=='HTL'){
			$nama_sptpd = 'HOTEL';
		} else if($sptpd=='RES'){
			$nama_sptpd = 'RESTORAN';
		} else if($sptpd=='REK'){
			$nama_sptpd = 'REKLAME';
		} else if($sptpd=='HIB'){
			$nama_sptpd = 'HIBURAN';
		} else if($sptpd=='GAL'){
			$nama_sptpd = 'MINERAL BUKAN LOGAM DAN BATUAN';
		} else if($sptpd=='AIR'){
			$nama_sptpd = 'AIR TANAH';
		} else if($sptpd=='PKR'){
			$nama_sptpd = 'PARKIR';
		} else if($sptpd=='LIS'){
			$nama_sptpd = 'PENERANGAN JALAN';
		} else if($sptpd=='WLT'){
			$nama_sptpd = 'BURUNG WALET';
		}
		
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
						PEMERINTAH KOTA JAMBI<br />
						DINAS PENDAPATAN KOTA JAMBI<br />
						Jl. Jend. Basuki Rachmat Kota Baru<br />
						Telp. (0741) 40284<br />
					</td>
					<td width="210" align="center">
						SURAT KETETAPAN PAJAK DAERAH<br />
						PAJAK '.$nama_sptpd.'<br />
						Masa Pajak&nbsp;&nbsp;:&nbsp;&nbsp;'.$awal.' - '.$akhir.'<br />
						Tahun&nbsp;&nbsp;:&nbsp;&nbsp;'.$tahun.'
					</td>
					<td width="92" align="center">
						<br /><br />
						No. SKP<br />
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
			
		$report .=
			'<table border="1">
				<tr>
					<td width="25" height="25" align="center">No</td>
					<td width="115" height="25" align="center">Ayat</td>
					<td width="302" height="25" align="center">Uraian</td>
					<td width="130" height="25" align="center">Jumlah</td>
				</tr>';
			
			///$child = $this->db->query("select * from skpd_child where skpd ='".$no."'");
            $child = $this->db->query("SELECT a.*,b.nota_hitung,c.sptpd,d.lokasi1,d.teks_reklame,e.panjang,e.lebar,e.jari,e.sisi,e.luas,e.unit,DATE_FORMAT(d.masa_pajak1,'%d/%m/%Y') as masa_pajak1,DATE_FORMAT(d.masa_pajak2,'%d/%m/%Y') as masa_pajak2 FROM skpd_child a LEFT JOIN skpd b ON a.skpd=b.no_skpd 
                    LEFT JOIN nota_hitung c ON b.nota_hitung=c.no_nota LEFT JOIN sptpd_reklame d ON c.sptpd=d.no_sptpd LEFT JOIN sptpd_reklame_detail e ON d.no_sptpd=e.no_sptpd
                    WHERE a.skpd='".$no."'");
			$i = 1;
			foreach($child->result() as $ch) {
			        
					$report .= '<tr id='.$i.'>
					  <td width="25" height="25" align="center">'.$i.'</td>
					  <td width="115" height="25" align="center">'.$ch->kd_rek.' '.$ch->nm_rek.'</td>
					  <td width="302" height="25" align="left">Judul Reklame :'.$ch->teks_reklame.', Lokasi:'.$ch->lokasi1.', Ukuran : panjang:'.$ch->panjang.', Lebar:'.$ch->lebar.', sisi:'.$ch->sisi.', luas:'.$ch->luas.', Unit:'.$ch->unit.', periode:'.$ch->masa_pajak1.' s/d '.$ch->masa_pajak2.'</td>
					  <td width="130" height="25" align="right">Rp. '.number_format($ch->jumlah,2,',','.').'&nbsp;&nbsp;</td>
					</tr>';
					$i++;
			}
			
			$report .=
				'<tr>
					  <td colspan="3" height="25" width="442" align="right">Jumlah Ketetapan Pokok Pajak&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td width="130" height="25" align="right">Rp. '.$total.'&nbsp;&nbsp;</td>
				</tr>
				</table>';
			
			$terbilang = $this->msistem->baca($data->total);
			
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
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">Jambi, '.$tanggal.'</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">an. Kepala Dinas Pendapatan Kota Jambi</td>
						<td width="200" align="center">Kabid. Pendataan, Penetapan dan Penagihan</td>
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
		
		//$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_SKPD'.'.pdf', 'I');
	}
}
?>