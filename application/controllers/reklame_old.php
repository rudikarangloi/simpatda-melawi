<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class reklame extends MY_Controller {
	var $ctl_blnmasapajak1;
	var $ctl_blnmasapajak2;
	var $ctl_tahunpajak;
	
	function __Construct() {
		parent::__Construct();
	}
	
	public function index() {
		$ctl_param01="'txtthnmasapajak','txtblnmasapajak1','txtblnmasapajak2','txttglmasapajak1', 'txttglmasapajak2'";
		$ctl_masapajak1 = $this->zieGenCombo("BULAN", "txtblnmasapajak1", $this->input->post("txtblnmasapajak1"), " onchange=\"getLastDate($ctl_param01);\" ");
		$ctl_masapajak2 = $this->zieGenCombo("BULAN", "txtblnmasapajak2", $this->input->post("txtblnmasapajak2"), " onchange=\"getLastDate($ctl_param01);\" ");
		$ctl_tahunpajak = $this->zieGenCombo("TAHUN", "txtthnmasapajak", $this->input->post("txtthnmasapajak"), " onchange=\"getLastDate($ctl_param01);\" ");
		$data['ctl_masapajak1']=$ctl_masapajak1;
		$data['ctl_masapajak2']=$ctl_masapajak2;
		$data['ctl_tahunpajak']=$ctl_tahunpajak;
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$data['dReklame'] = $this->db->query("select kd_rek,concat(kd_rek, ' | ',nm_rek) as nm_rek from master_rekening where jns_pajak='04'");
		$data['tgl'] = date('Y-m-d');
        $data['tahun'] = $this->msistem->tahun();
		$this->load->view('data/reklame',$data);
	}
	
	public function zieGenCombo($ctlType, $ctlId, $iSelValue, $iEvent=""){
		if($ctlType=="BULAN"){
			$arr_data=array("01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"Nopember", "12"=>"Desember");
		}elseif($ctlType=="TAHUN"){
			$arr_data=array("2010"=>"2010", "2011"=>"2011", "2012"=>"2012", "2013"=>"2013", "2014"=>"2014", "2015"=>"2015");
		}
		
		$ret="<select name=\"$ctlId\" id=\"$ctlId\" $iEvent >";
		foreach($arr_data as $key=>$value){
			if($key==$iSelValue){
				$ret.="<option selected value=\"$key\">$value</option>";
			}else{
				$ret.="<option value=\"$key\">$value</option>";
			}
		}
		$ret.="</select>";
		return $ret;
	}
	
	public function hitung(){
		$jenis = $this->input->post('jenis');
		$posisi = $this->input->post('posisi');
		$kawasan = $this->input->post('kawasan');
		$waktu = $this->input->post('waktu');
		$panjang = $this->input->post('panjang');
		$lebar = $this->input->post('lebar');
		$jari = $this->input->post('jari');
		$muka = $this->input->post('muka');
		$jumlah = $this->input->post('jumlah');
				
		if($waktu>0 && $waktu<7){
			$time = 'Sehari';
		} else if($waktu>6 || $waktu<90){
			$time = 'Sebulan';
		} else if($waktu>89){
			$time = 'Setahun';
		}
		
		if($kawasan=='1'){
			$daerah = 'Sangat Strategis (A)';
		} else if($kawasan=='2'){
			$daerah = 'Strategis (B)';
		} else if($kawasan=='3'){
			$daerah = 'Kurang Strategis (C)';
		}
		$sql = $this->db->query("select tarif from tarif_reklame where kd_rek_reklame='".$jenis."' and waktu='".$time."' and lokasi='".$daerah."'")->row();
		$tarif = $sql->tarif;
		
		if($jari==NULL){
			$luas = $panjang*$lebar*$muka*$jumlah;
			$hitung = $tarif*$luas;
		} else {
			$luas_jari = $jari*3.14;
			$luas = $luas_jari*$jumlah;
			$hitung = $tarif*$luas;
		}
		
		$data = $tarif.'|'.$hitung.'|'.$luas;
		echo $data;
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
        
public function cariDataWP($kata_kunci="",$parameter=""	) {	
		if(!empty($kata_kunci)){
			if($parameter == '1'){
				$qr = "where npwpd_perusahaan like '%".$kata_kunci."%'";
			} else if ($parameter == '2'){
				$qr = "where nama_perusahaan like '%".$kata_kunci."%'";
			}
		} else {
			$qr = "";	
		}
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("select npwpd_perusahaan, nama_pemilik, nama_perusahaan, alamat_perusahaan from view_perusahaan $qr","npwpd_perusahaan","npwpd_perusahaan, nama_perusahaan, alamat_perusahaan, nama_pemilik");
	}
     
        function simpan(){            
            date_default_timezone_set('Asia/Jakarta'); 
			$tarif = $_POST['tarif'];
		if(strpos($tarif, '.')){
			$tarif = str_replace('.', '', $tarif);
		} else {
			$tarif;
		}
		
		$jml = $_POST['dasar_pengenaan'];
		if(strpos($jml, '.')){
			$jml = str_replace('.', '', $jml);
		} else {
			$jml;
		}                                                         
            $data = array(			
				'tahun_pajak'          => $_POST['tahun'],
                        'masa_pajak1'         => $_POST['tgl1'],
                        'masa_pajak2'         => $_POST['tgl2'],
                        'bulan1' => $_POST['awal'],
                        'bulan2' => $_POST['akhir'],
                        'npwpd'         => $_POST['npwpd'],
                        'author'        => $_POST['petugas'],
                        'tgl_diterima'       => strftime("%Y-%m-%d", strtotime($_POST['tgl_terima'])),
                        'cara_hitung'         => $_POST['cara'],
                
                        'rek_reklame'        => $_POST['jenis'],                       
                        'posisi_pasang'         => $_POST['posisi'],
                        'kawasan_pasang'         => $_POST['kawasan'],
                        'panjang' => $_POST['panjang'],
                        'lebar'         => $_POST['lebar'],
                        'jari2'         => $_POST['jari'],
						'muka'         => $_POST['muka'],
						'luas'         => $_POST['luas'],
                        'jumlah'         => $_POST['jumlah'],
                        'waktu_pasang'  => $_POST['waktu'],
                        'jml_bayar'         => $jml,
                        'tarif_kawasan'         => $tarif
            );
                
                $user = strtoupper($this->session->userdata('username'));                
                
                $this->db->trans_begin();
		if(empty($_POST['edit'])){
                        $no_sptpd = $this->generateNo($_POST['tahun']);
			$dataIns = array_merge($data,array('no_sptpd' =>  $no_sptpd, 'created' => date('Y-m-d H:i:s')));
			$result = $this->db->insert('sptpd_reklame', $dataIns);
		} else {
                        $no_sptpd = $this->input->post('sptpd_1')."/".$this->input->post('sptpd_2');
			$dataUpdate = array_merge($data,array('author_updated' => strtoupper($user),'modified' => date('Y-m-d H:i:s')));
			$result = $this->db->update('sptpd_reklame',$dataUpdate,array('no_sptpd' => $no_sptpd));
		}
               
        if ($this->db->trans_status() === FALSE) {
        	$this->db->trans_rollback();
        } else {
        	$this->db->trans_commit();
            echo $no_sptpd;
        }
      }
        
        public function generateNo($thn) {
		$sql = $this->db->query("select max_sptpd from no_max where id='1'");
		$r = $sql->row();
		$jml = $r->max_sptpd + 1;
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
		
		$dtUpd = array('max_sptpd' => $jml);
		$this->db->update('no_max', $dtUpd, array('id' => 1));
		
		return $jml.'/REK/'.substr($thn,2,2);
	}
        
        function load_data() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
$grid->render_sql("SELECT
sptpd_reklame.id,
sptpd_reklame.npwpd,
sptpd_reklame.no_sptpd,
sptpd_reklame.tgl_diterima,
sptpd_reklame.cara_hitung,
sptpd_reklame.rek_reklame,
sptpd_reklame.posisi_pasang,
sptpd_reklame.kawasan_pasang,
sptpd_reklame.panjang,
sptpd_reklame.lebar,
sptpd_reklame.jari2,
sptpd_reklame.muka,
sptpd_reklame.jumlah,
sptpd_reklame.luas,
sptpd_reklame.waktu_pasang,
sptpd_reklame.tarif_kawasan,
sptpd_reklame.jml_bayar,
sptpd_reklame.masa_pajak1,
sptpd_reklame.masa_pajak2,
sptpd_reklame.tahun_pajak,
sptpd_reklame.bulan1,
sptpd_reklame.bulan2,
sptpd_reklame.author,
view_perusahaan.nama_perusahaan,
view_perusahaan.alamat_perusahaan
FROM
sptpd_reklame
INNER JOIN view_perusahaan ON view_perusahaan.npwpd_perusahaan = sptpd_reklame.npwpd"
                        ,"id"
,"no_sptpd,npwpd,nama_perusahaan,alamat_perusahaan,tgl_diterima,cara_hitung,rek_reklame,posisi_pasang,kawasan_pasang,panjang,lebar,jari2,muka,jumlah,luas,waktu_pasang,tarif_kawasan,jml_bayar,masa_pajak1,masa_pajak2,tahun_pajak,bulan1,bulan2,author");
	}
	
	public function hapus() {
		$sq = $this->input->post('sptpd_1')."/".$this->input->post('sptpd_2');
		$r = $this->db->query("select count(sptpd) as jml from nota_hitung where sptpd = '".$sq."'")->row();
		$sa = $r->jml;
		if($sa==0){
			$this->db->delete('sptpd_reklame',array('no_sptpd' => $this->input->post('sptpd_1')."/".$this->input->post('sptpd_2')));
			$result = "Data SPTPD berhasil dihapus.";
		} else {
			$result = "Silakan Menghapus Data Nota Hitung Terlebih Dahulu";
		}
		echo $result;
	}
	
	function stiker(){
		$sql = $this->db->query("select sptpd_reklame.no_sptpd, sptpd_reklame.author, DATE_FORMAT(sptpd_reklame.masa_pajak1,'%d/%m/%Y') as masa_pajak1, DATE_FORMAT(sptpd_reklame.masa_pajak2,'%d/%m/%Y') as masa_pajak2, sptpd_reklame.tahun_pajak from sptpd_reklame where sptpd_reklame.no_sptpd='".$_GET['sptpd']."'")->row();
		
		$no = substr($sql->no_sptpd,0,9);
		$tahun = $sql->tahun_pajak;
		$awal = $sql->masa_pajak1;
		$akhir = $sql->masa_pajak2;
		$nomor = $sql->no_sptpd;
		
		$arr = "REKLAME";
		//setting pdf
		$query = $this->db->query("select isi from master_template where code_izin='".$arr."'");
		$rs = $query->row();	
		$html = $rs->isi;
		
		$searchArray = array("[no]","[nomor]","[tahun]","[awal]","[akhir]");
		$replaceArray = array($no,$nomor,$tahun,$awal,$akhir);
		$intoString = $html;
		//now let's replace
		$report = str_replace($searchArray, $replaceArray, $intoString);
		
		//setting pdf
		$this->load->library('header/rek');
		$pdf = new rek('P', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_PADANG');
		$pdf->SetKeywords('SOPD_PADANG');
	
		//set no header & footer
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(10);
		$pdf->SetMargins(10,64,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 10);
	
		$pdf->AddPage('P','A4',false);
		//set data
		$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->lastPage();
		$pdf->Output('Report_'.$arr.'.pdf', 'I');

	}
	
	function cetak(){
		$sql = $this->db->query("select sptpd_reklame.id, sptpd_reklame.npwpd, sptpd_reklame.no_sptpd, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, view_perusahaan.nama_pemilik, sptpd_reklame.cara_hitung, DATE_FORMAT(sptpd_reklame.tgl_diterima,'%d/%m/%Y') as tgl_diterima, sptpd_reklame.author, sptpd_reklame.rek_reklame, DATE_FORMAT(sptpd_reklame.masa_pajak1,'%d/%m/%Y') as masa_pajak1, DATE_FORMAT(sptpd_reklame.masa_pajak2,'%d/%m/%Y') as masa_pajak2, sptpd_reklame.tarif_kawasan, sptpd_reklame.waktu_pasang, sptpd_reklame.kawasan_pasang, sptpd_reklame.panjang, sptpd_reklame.lebar, sptpd_reklame.jari2,sptpd_reklame.jml_bayar from sptpd_reklame left join view_perusahaan on sptpd_reklame.npwpd=view_perusahaan.npwpd_perusahaan where sptpd_reklame.no_sptpd='".$_GET['sptpd']."'")->row();
		$a = explode("/",$sql->masa_pajak1);
		$a1 = $a[1];
		$awal				= $this->msistem->v_bln($a1);
		$b = explode("/",$sql->masa_pajak2);
		$b1 = $b[1];
		$akhir 				= $this->msistem->v_bln($b1);
		$tahun				= $b[2];
		$jml				  = $sql->jml_bayar;
		$total				= number_format($jml,2,",",".");	
		
		$bulan = date('m');
		$m	= $this->msistem->v_bln($bulan);
		$days = date('d');
		$tanggal			= $days.' '.$m.' '.date('Y');
		
		$nxa = $this->db->query("select nm_rek from master_rekening where kd_rek='".$sql->rek_reklame."'")->row();
		$tarif = $sql->tarif_kawasan;
		$jari2 = $sql->jari2;
		$panjang = $sql->panjang;
		$lebar = $sql->lebar;
		$jumlah = $sql->jml_bayar;
		
		$pajaks				= ($jml*$tarif);
		$tarif				= number_format($tarif,2,",",".");
		$c			= $sql->tgl_diterima;
		$arr = explode("/",$c);
		$s = $arr[1];
		$bln = $this->msistem->v_bln($s);
		$created = $arr[0].' '.$bln.' '.$arr[2];
		
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
						PEMERINTAH KABUPATEN SIGI<br />
						DINAS PENDAPATAN PENGELOLAAN KEUANGAN DAN ASET DAERAH<br />
						Jalan Poros PALU - Telp (0655) 7006013<br />
						Fax (0655)7551162,7551165<br />
						PALOLO
					</td>
					<td width="210" align="center">
						SURAT PEMBERITAHUAN PAJAK DAERAH<br />
						PAJAK REKLAME<br />
						Masa Pajak&nbsp;&nbsp;:&nbsp;&nbsp;'.$awal.' - '.$akhir.'<br />
						Tahun&nbsp;&nbsp;:'.$tahun.'
					</td>
					<td width="92" align="center">
						<br /><br />
						No. SPTPD<br />
						'.$sql->no_sptpd.'
					</td>
				</tr>
			</table>';
			
		$report .=
			'<table border=1>
				<tr>
					<td width="572">
						<table border="0">
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>
							<tr>
								<td width="120">&nbsp;&nbsp;1. Nama Perusahaan</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->nama_perusahaan.'</td>
							</tr>
							<tr>
								<td width="120">&nbsp;&nbsp;2. N.P.W.P.D</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->npwpd.'</td>
							</tr>
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>	
						</table>
					</td>
				</tr>
			</table>';
			
		$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>DATA OBJEK PAJAK</strong>
					</td>
				</tr>
			</table>';
			
		$report .=
			'<table border=1>
				<tr>
					<td width="572">
						<table border="0">
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>
							<tr>
								<td width="120">&nbsp;&nbsp;1. Kode Rekening</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->rek_reklame.'</td>
							</tr>
							<tr>
								<td width="120">&nbsp;&nbsp;2. Nama Rekening</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$nxa->nm_rek.'</td>
							</tr>
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>	
						</table>
					</td>
				</tr>
			</table>';	
		
		$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>DATA PAJAK REKLAME</strong>
					</td>
				</tr>
			</table>';
			
			$report .=
			'<table width="572" border=1>
				<tr>
				<td>
				<table>
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>
				<tr>
					<td width="12">&nbsp;&nbsp;a.</td>
					<td width="232">Masa Pajak</td>
					<td width="10">:</td>
					<td width="282">'.$sql->masa_pajak1.' s/d '.$sql->masa_pajak2.'</td>
				</tr>
				<tr>
					<td width="12">&nbsp;&nbsp;b.</td>
					<td width="232">Dasar Pengenaan (Jumlah pembayaran yang diterima)</td>
					<td width="10">:</td>
					<td width="282">Rp. '.$total.'</td>
				</tr>
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>
				</table>
				</td>
				</tr>
			</table>';
			
			$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>PERNYATAAN</strong>
					</td>
				</tr>
			</table>';
			
			$report .=
			'
			<table border="1">
			<tr><td width="572">
			<table border=0>
<tr>
	<td height="10">&nbsp;</td>
</tr>
				<tr>
					<td width="5">&nbsp;</td>
					<td width="562">
						<div align="justify">Dengan menyadari sepenuhnya akan segala akibat termasuk sanksi-sanksi sesuai dengan ketentuan perundang-undangan yang berlaku. Saya atau yang saya beri kuasa menyatakan bahwa apa yang telah kami beritahukan diatas beserta lampiran-lampirannya adalah benar, lengkap dan jelas.					    				
					  </div>
					  </td>
					 <td width="5">&nbsp;</td>
				</tr>
				<tr>
					<td width="572" colspan="3">
						<table border="0">
							<tr>
							<td>
							<table border="0">
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center">Meulaboh, '.$tanggal.'</td>
								</tr>
								<tr>
									<td width="572" height="50">&nbsp;</td>
								</tr>
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center">'.$sql->nama_pemilik.'</td>
								</tr>
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center"></td>
								</tr>
						</table>
						</td>
						</tr>
					</table>
					</td>
				</tr>
			</table>
			</td></tr>
			</table>
			---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
			<br>';
			
			$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>PETUGAS PENERIMA</strong>
					</td>
				</tr>
			</table>';
			
		$report .=
			'<table border="1">
				<tr>
				<td width="572">
				<table border="0">
<tr>
	<td height="10">&nbsp;</td>
</tr>
					<tr>
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;Diterima tanggal </td>
                            <td width="3%">:</td>
                            <td width="61%">'.$sql->tgl_diterima.'</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">Meulaboh, '.$tanggal.'</td>
					</tr>
					<tr>
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;Nama Petugas </td>
                            <td width="3%">:</td>
                            <td width="61%">'.$sql->author.'</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">'.$sql->author.'</td>
					</tr>
					<tr>
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;NIP</td>
                            <td width="3%">:</td>
                            <td width="61%">&nbsp;</td>
                          </tr>
                        </table></td>
						<td width="200" height="50" align="center">&nbsp;</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">'.$sql->author.'</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">&nbsp;</td>
					</tr>
				</table>
				</td>
				</tr>
			</table>';
		
		//$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_SPTPD'.'.pdf', 'I');
	}
}
?>