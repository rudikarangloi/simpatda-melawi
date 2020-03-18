<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class restoran extends MY_Controller {
	var $ctl_blnmasapajak1;
	var $ctl_blnmasapajak2;
	var $ctl_tahunpajak;
	
	function __construct() {
            parent::__construct();
            $this->load->model('msistem');
    }
	
	public function index() {
		$ctl_param01="'txtthnmasapajak','txtblnmasapajak1','txtblnmasapajak2','txttglmasapajak1', 'txttglmasapajak2'";
		$ctl_masapajak1 = $this->zieGenCombo("BULAN", "txtblnmasapajak1", $this->input->post("txtblnmasapajak1"), " onchange=\"getLastDate($ctl_param01);\" ");
		$ctl_masapajak2 = $this->zieGenCombo("BULAN", "txtblnmasapajak2", $this->input->post("txtblnmasapajak2"), " onchange=\"getLastDate($ctl_param01);\" ");
		$ctl_tahunpajak = $this->zieGenCombo("TAHUN", "txtthnmasapajak", $this->input->post("txtthnmasapajak"), " onchange=\"getLastDate($ctl_param01);\" ");
		$data['ctl_masapajak1']=$ctl_masapajak1;
		$data['ctl_masapajak2']=$ctl_masapajak2;
		$data['ctl_tahunpajak']=$ctl_tahunpajak;
                $data['tanggal']=date("d/m/Y");
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$data['gresto'] = $this->db->query("select kd_rek,concat(kd_rek, ' | ',nm_rek) as nm_rek from master_rekening where jns_pajak='02' and status_aktif ='1'");
		$data['tgl'] = date('Y-m-d');
		$data['userPetugas'] = $this->session->userdata('username');
		$s = $this->db->query("select nama from admin where username='".$this->session->userdata('username')."'")->row();
		$data['namaPetugas'] = $s->nama;
		$data['tahun'] = $this->msistem->tahun();
		$this->load->view('data/restoran',$data);
	}
	
	function bank(){
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
		$data['gresto'] = $this->db->query("select kd_rek,concat(kd_rek, ' | ',nm_rek) as nm_rek from master_rekening where jns_pajak='02' and status_aktif ='1'");
		$data['tgl'] = date('Y-m-d');
		$data['userPetugas'] = $this->session->userdata('username');
		$s = $this->db->query("select nama from admin where username='".$this->session->userdata('username')."'")->row();
		$data['namaPetugas'] = $s->nama;
		$data['tahun'] = $this->msistem->tahun();
		$this->load->view('data/restoran_bank',$data);
	}
	
	function tarif(){
		$kd_rek = $this->input->post('gol');
		$query = $this->db->query("select tarif_pajak from master_rekening where kd_rek = '".$kd_rek."'")->row();
		$tarif = $query->tarif_pajak;
		echo $tarif;
	}
	
	public function zieGenCombo($ctlType, $ctlId, $iSelValue, $iEvent=""){
		if($ctlType=="BULAN"){
			$arr_data=array("00"=>"","01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"Nopember", "12"=>"Desember");
		}elseif($ctlType=="TAHUN"){
			
                    $arr_data=array("00"=>"","2016"=>"2016", "2017"=>"2017", "2018"=>"2018", "2019"=>"2019", "2020"=>"2020", "2021"=>"2021");
		}
		
		$ret="<select name=\"$ctlId\" id=\"$ctlId\" $iEvent disabled>";
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
	
	/* public function cariDataWP($kata_kunci="",$parameter="") {
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if(!empty($kata_kunci)){
			if($parameter == 'no_npwpd'){
				$qr = "a.npwpd_perusahaan like '%".$kata_kunci."%'";
			} else if ($parameter == 'nama_perusahaan'){
				$qr = "a.nama_perusahaan like '%".$kata_kunci."%'";
			}
		} else {
			$qr = "";	
		}
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("select a.npwpd_perusahaan, a.nama_pemilik, a.nama_perusahaan, a.alamat_perusahaan from view_perusahaan a left join identitas_perusahaan b on a.npwpd_perusahaan=b.npwpd_perusahaan where b.status_aktip='Y' AND LEFT(b.npwpd_perusahaan,2)!='61' AND $qr","npwpd_perusahaan","npwpd_perusahaan,nama_perusahaan,alamat_perusahaan,nama_pemilik");
		
	} */
	public function cariDataWP($op="",$nilai="") {
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($op=='1'){
			$cu = "a.npwpd_perusahaan like '%".$nilai."%'";
		}else{
			$cu = "a.nama_perusahaan like '%".$nilai."%'";
		} 
		
		$qr = $this->db->query("SELECT a.id, a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan, 
c.nm_rek , a.telp, b.npwpd_pemilik, b.nama_pemilik, b.alamat_pemilik, 
b.hp FROM identitas_perusahaan a 
LEFT JOIN identitas_pemilik b ON a.npwpd_pemilik = b.npwpd_pemilik
LEFT JOIN master_rekening c ON c.pajak = LEFT(a.npwpd_perusahaan,1) AND c.pajak_det = SUBSTRING(a.npwpd_perusahaan,9,2) WHERE a.status_aktip='Y' AND LEFT(a.npwpd_perusahaan,2)='02' AND $cu");
		
		$i=1;
		foreach($qr->result() as $rs) {
			// cair
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$rs->id."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");				
					echo("<cell><![CDATA[".$rs->nama_pemilik."]]></cell>");
							
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	function ricek(){
		$npwpd = $this->input->post('npwpd');
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');
		$tahun = $this->input->post('tahun');
		$spt = $this->input->post('jnsSPT');
		
        $spt = $this->input->post('jnsSPT');
        if($spt == 'REGULAR'){
		      $query = $this->db->query("select npwpd from sptpd where npwpd = '".$npwpd."' and masa_pajak1 = '".$awal."' and masa_pajak2 = '".$akhir."' and tahun='".$tahun."'")->row();
		      if($query!=NULL){
			     $text = "Maaf pendataan SPTPD sudah dilakukan";
		      } else {
			$text = 0;
		      }
        } else {
			$text = 0;
		}
		echo $text;
	}
	
	public function simpan() {
		$jml = $this->input->post('jumlah');
		if(strpos($jml, '.')){
			$jml = str_replace('.', '', $jml);
		} else {
			$jml;
		}
		
		$setoran = $this->input->post('setoran');
		if(strpos($setoran, '.')){
			$setoran = str_replace('.', '', $setoran);
		} else {
			$setoran;
		}
	
		$data = array(			
			'masa_pajak_tgl1' => $_POST['awal'],
            'masa_pajak_tgl2' => $_POST['akhir'],
            'thn_pajak' => $_POST['tahun'],
            'npwpd' => $_POST['npwpd'],
            /*'nama' => strtoupper($_POST['nama']),
            'alamat' =>  strtoupper($_POST['alamat']),
            */'cara_hitung' => $_POST['cara'],
            'tgl_diterima' => $_POST['tgl_terima'],
            'petugas' => $_POST['petugas'],
            'gol_restoran' => $_POST['gol'],
            'masa_pajak1' => $_POST['tgl1'],
            'masa_pajak2' => $_POST['tgl2'],                        
            'omset' => $jml,
			'jml_bayar' => $setoran,
            'jns_spt' => $_POST['jnsSPT'],
			'ket_pajak' => $_POST['ket_pajak'],
            'meja' => $_POST['meja'],
            'kursi' => $_POST['kursi'],
            'jml_pengunjung' => $_POST['jml_pengunjung'],
            'register' => $_POST['kas_register'],
            'pembukuan_pencatatan' => $_POST['pembukuan'],
            'ket_insidental' =>  strtoupper($_POST['ket_insidentil']),
            'author' => strtoupper($this->session->userdata('username'))
        );
		
		$data_sptpd = array (
			'npwpd' 		=> strtoupper($_POST['npwpd']),
			'tanggal'		=> $_POST['tgl_terima'],
			'masa_pajak1' 	=> $_POST['awal'],
			'masa_pajak2'	=> $_POST['akhir'],
			'masa_pajak_1' 	=> $_POST['tgl1'],
			'masa_pajak_2'	=> $_POST['tgl2'],
			'tahun' 			=> $_POST['tahun'],
			'jumlah' 	=> $setoran,
			'author' 		=> strtoupper($this->session->userdata('username'))
		);
		
		//kode_rekening
		$rekening = $this->db->query("select nm_rek, tarif_pajak from master_rekening where kd_rek = '".$_POST['gol']."'")->row();
		
		$data_child = array (
			'kd_rek' => strtoupper($_POST['gol']),
			'nm_rek' => strtoupper($rekening->nm_rek),
			'dp' => $jml,
			'tarif' => $rekening->tarif_pajak,
			'jumlah' => $setoran
		);
		
		if($this->input->post('sptpd_1')=="") {
			$thn = date('Y');
			$no_sptpd = $this->generateNo(date("Y",strtotime($_POST['tgl_terima'])));
			$dataIns = array_merge($data,array('no_sptpd' => $no_sptpd,'created' => date('Y-m-d H:i:s')));
			$result = $this->db->insert('sptpd_restoran', $dataIns);
			
			//table sptpd
			$dataIns2 = array_merge($data_sptpd,array('no_sptpd' => $no_sptpd,'created' => date('Y-m-d H:i:s')));
			$this->db->insert('sptpd',$dataIns2);
			
			//table sptpd child
			$dataIns3 = array_merge($data_child,array('no_sptpd' => $no_sptpd));
			$this->db->insert('sptpd_child',$dataIns3);
			
		} else {
			$no_sptpd = $this->input->post('sptpd_1')."/".$this->input->post('sptpd_2');
			$dataUpdate = array_merge($data,array('author' => $this->session->userdata('username'),'modified' => date('Y-m-d H:i:s')));
			$result = $this->db->update('sptpd_restoran',$dataUpdate,array('no_sptpd' => $no_sptpd));
			
			//table sptpd
			$dataUpd2 = array_merge($data_sptpd,array('no_sptpd' => $no_sptpd,'modified' => date('Y-m-d H:i:s')));
			$this->db->update('sptpd',$dataUpd2, array('no_sptpd' => $no_sptpd));
			
			//table sptpd child
			$dataUpd3 = array_merge($data_child,array('no_sptpd' => $no_sptpd));
			$this->db->update('sptpd_child',$dataUpd3, array('no_sptpd' => $no_sptpd));
		}	
			
		echo $no_sptpd;
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
		
		return $jml.'/RES/'.substr($thn,2,2);
	}
	
	function mainData() {
		$grid = new GridConnector($this->db->conn_id);
		//$grid->dynamic_loading(100); 
		$grid->render_sql("select a.*, b.nama_perusahaan, b.alamat_perusahaan, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl_diterima,DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa_pajak1,DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa_pajak2, c.tarif from sptpd_restoran a left join identitas_perusahaan b on a.npwpd=b.npwpd_perusahaan left join sptpd_child c on a.no_sptpd = c.no_sptpd ORDER BY no_sptpd DESC","id","no_sptpd,masa_pajak1,masa_pajak2,thn_pajak,npwpd,nama_perusahaan,alamat_perusahaan,tgl_diterima,petugas,jml_bayar,cara_hitung,masa_pajak_tgl1,masa_pajak_tgl2,jns_spt,ket_insidental,gol_restoran,meja,kursi,jml_pengunjung,register,pembukuan_pencatatan,omset,tarif,ket_pajak");
	}
	
	function mainData_bank() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("select a.*, b.nama_perusahaan, b.alamat_perusahaan, DATE_FORMAT(a.tgl_diterima,'%d/%m/%Y') as tgl_diterima,DATE_FORMAT(a.masa_pajak1,'%d/%m/%Y') as masa_pajak1,DATE_FORMAT(a.masa_pajak2,'%d/%m/%Y') as masa_pajak2, c.tarif from sptpd_restoran a left join identitas_perusahaan b on a.npwpd=b.npwpd_perusahaan left join sptpd_child c on a.no_sptpd = c.no_sptpd where a.author = '".$this->session->userdata('username')."'","id","no_sptpd,masa_pajak1,masa_pajak2,thn_pajak,npwpd,nama_perusahaan,alamat_perusahaan,tgl_diterima,petugas,jml_bayar,cara_hitung,masa_pajak_tgl1,masa_pajak_tgl2,jns_spt,ket_insidental,gol_restoran,omset,tarif,ket_pajak");
	}
	
	public function hapus() {
		$sq = $this->input->post('sptpd_1')."/".$this->input->post('sptpd_2');
		$r = $this->db->query("SELECT COUNT(no_sptpd) AS jml FROM skpd where no_sptpd = '".$sq."'")->row();
		$sa = $r->jml;
		if($sa==0){
			$this->db->delete('sptpd_restoran',array('no_sptpd' => $this->input->post('sptpd_1')."/".$this->input->post('sptpd_2')));
			$this->db->delete('sptpd', array('no_sptpd' => $this->input->post('sptpd_1')."/".$this->input->post('sptpd_2')));
			$this->db->delete('sptpd_child', array('no_sptpd' => $this->input->post('sptpd_1')."/".$this->input->post('sptpd_2')));
			$result = "Data SPTPD berhasil dihapus.";
		} else {
			$result = "Data tidak bisa dihapus No.SPTPD ini sudah ditransaksikan di SSPD, Silakan Menghapus Data SSPD Terlebih Dahulu";
		}
		echo $result;
	}
	
	public function cetak(){
		$sql = $this->db->query("SELECT sptpd_restoran.id, sptpd_restoran.npwpd, view_perusahaan.npwpd_lama, sptpd_restoran.no_sptpd, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, 
view_perusahaan.nama_pemilik, sptpd_restoran.jns, sptpd_restoran.ket_insidental, sptpd_restoran.cara_hitung,
DATE_FORMAT(sptpd_restoran.tgl_diterima,'%d/%m/%Y') AS tgl_diterima, sptpd_restoran.petugas, sptpd_restoran.gol_restoran, 
DATE_FORMAT(sptpd_restoran.masa_pajak1,'%d/%m/%Y') AS masa_pajak1, 
DATE_FORMAT(sptpd_restoran.masa_pajak2,'%d/%m/%Y') AS masa_pajak2, 
sptpd_restoran.omset, sptpd_restoran.jml_bayar, sptpd_child.tarif 
FROM sptpd_restoran LEFT JOIN view_perusahaan ON sptpd_restoran.npwpd=view_perusahaan.npwpd_perusahaan LEFT JOIN 
sptpd_child ON sptpd_restoran.no_sptpd=sptpd_child.no_sptpd	where sptpd_restoran.no_sptpd='".$_GET['sptpd']."'")->row();

		
		$a = explode("/",$sql->masa_pajak1);
		$a1 = $a[1];
		$awal				= $this->msistem->v_bln($a1);
		$b = explode("/",$sql->masa_pajak2);
		$b1 = $b[1];
		$akhir 				= $this->msistem->v_bln($b1);
		$tahun				= $b[2];
		$jml				  = $sql->omset;
		$total				= number_format($jml,2,",",".");
		$tarif				= $sql->tarif;
		$npwpd_lama			= $sql->npwpd_lama;
		$pajak				= number_format($sql->jml_bayar,2,",",".");	
		
		$bulan = date('m');
		$m	= $this->msistem->v_bln($bulan);
		$days = date('d');
		$tanggal			= $days.' '.$m.' '.date('Y');
				
		$nm = $this->db->query("select nm_rek from master_rekening where kd_rek='".$sql->gol_restoran."'")->row();
		
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
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="50" height="54" align="center" valign="middle">&nbsp;</td>
					<td width="220" align="center">
						PEMERINTAH KABUPATEN MELAWI<br />
						<b>BADAN PENDAPATAN DAERAH</b><br />
						
					</td>
					<td width="210" align="center">
						SURAT PEMBERITAHUAN PAJAK DAERAH<br />
						PAJAK RESTORAN<br /><br/>
						Masa Pajak&nbsp;&nbsp; : &nbsp;&nbsp;'.$sql->masa_pajak1.' - '.$sql->masa_pajak2.'						
					</td>
					<td width="92" align="center">
						<br /><br />
						No. SPTPD<br />
						'.$sql->no_sptpd.'
					</td>
				</tr>
			</table>';
			
			$get="";
			if($npwpd_lama==null){
				$get="";
			}else{
				$get=" ".$npwpd_lama." ";
			}
			
		$report .=
			'<table border=1>
				<tr>
					<td width="572">
						<table border="0">
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;1. Nama Usaha</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->nama_perusahaan.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;2. NPWPD LAMA</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$get.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;3. NPWPD</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->npwpd.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;4. Nama Pemilik</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->nama_pemilik.'</td>
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
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;1. Kode Rekening</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->gol_restoran.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;2. Nama Rekening</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$nm->nm_rek.'</td>
							</tr>
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>	
						</table>
					</td>
				</tr>
			</table>';		
		
		/*$jns = $sql->cara_hitung;
		if($jns!='1'){*/
		
		$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>DATA PAJAK RESTORAN</strong>
					</td>
				</tr>
			</table>';
		
		if($a1=='01'){
			$a1 = 12;
			$tahun = $tahun-1;
		} else {
			$a1 = $a1-1;
		}
		
		if(strlen($a1)==1) {
			$a1 = '0'.$a1;
		}
		
//		$set = $this->db->query("select a.ketetapan, a.setoran, b.masa_pajak1,
//         b.masa_pajak2, c.tarif from sspd a left join sptpd_restoran b on a.nomor=b.no_sptpd left join sptpd_child c
//         on a.nomor=c.no_sptpd where a.npwpd = '".$sql->npwpd."' and a.masa_pajak1 = '".$a1."' and a.tahun_pajak = '".$tahun."'")->row();
         
         $set = $this->db->query("SELECT a.ketetapan, a.setoran, f.masa_pajak1, f.masa_pajak2,
         e.tarif FROM sspd a LEFT JOIN skpd b ON a.nomor=b.no_skpd 
          LEFT JOIN sptpd_restoran f ON b.no_sptpd=f.no_sptpd 
          LEFT JOIN sptpd_child e ON f.no_sptpd=e.no_sptpd
          WHERE a.npwpd = '".$sql->npwpd."' AND a.masa_pajak1 = '".$a1."' AND a.tahun_pajak = '".$tahun."'")->row();
         
         
          
		if($set==NULL){
			$tgl = "- s/d -";
			$dp = "Rp. 0,00";
			$t = "0%";
			$h = "Rp. 0,00";
		} else {
			$l = explode('-',$set->masa_pajak1);
			$l1 =  $l[2].'/'.$l[1].'/'.$l[0];
		
			$lo = explode('-',$set->masa_pajak2);
			$l2 = $lo[2].'/'.$lo[1].'/'.$lo[0];
			$tgl = $l1.' s/d '.$l2;
			$dp = 'Rp. '.number_format($set->ketetapan,2,",",".");
			$t = $set->tarif.'%';
			$h = 'Rp. '.number_format($set->setoran,2,",",".");
		}
		
		$report .=
			'<table border=1>
				<tr>
					<td width="572">
						<table>
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20">&nbsp;&nbsp;1.</td>
								<td colspan="4" width="550">Jumlah pembayaran dan pajak terhutang untuk masa pajak sebelumnya (akumulasi dari awal masa pajak dalam tahun pajak tertentu):</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">a.</td>
								<td width="232">Masa Pajak</td>
								<td width="8">:</td>
								<td width="282">'.$tgl.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">b.</td>
								<td width="232">Dasar Pengenaan (Jumlah pembayaran yang diterima)</td>
								<td width="8">:</td>
								<td width="282">'.$dp.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">c.</td>
								<td width="232">Tarif Pajak (sesuai perda)</td>
								<td width="8">:</td>
								<td width="282">'.$t.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">d.</td>
								<td width="232">Pajak Terhutang (b x c)</td>
								<td width="8">:</td>
								<td width="282">'.$h.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20">&nbsp;&nbsp;2.</td>
								<td colspan="4">Jumlah pembayaran dan pajak terhutang untuk masa pajak sekarang (lampirkan foto copy dokumen):</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">a.</td>
								<td width="232">Masa Pajak</td>
								<td width="8">:</td>
								<td width="282">'.$sql->masa_pajak1.' s/d '.$sql->masa_pajak2.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">b.</td>
								<td width="232">Dasar Pengenaan (Jumlah pembayaran yang diterima)</td>
								<td width="8">:</td>
								<td width="282">Rp. '.$total.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">c.</td>
								<td width="232">Tarif Pajak (sesuai perda)</td>
								<td width="8">:</td>
								<td width="282">'.$tarif.'%</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">d.</td>
								<td width="232">Pajak Terhutang (b x c)</td>
								<td width="8">:</td>
								<td width="282">Rp. '.$pajak.'</td>
							</tr>
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>
						</table>	
					</td>
				</tr>
			</table>';
			
		/*} else if($jns=='2'){
			
			$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>DATA PAJAK RESTORAN</strong>
					</td>
				</tr>
			</table>';
			
			$report .=
			'<table width="572" border=1>
				<tr>
				<td>
				<table>
				<tr>
					<td width="12">&nbsp;&nbsp;a.</td>
					<td width="200">Masa Pajak</td>
					<td width="10">:</td>
					<td width="340">'.$sql->masa_pajak1.' s/d '.$sql->masa_pajak2.'</td>
				</tr>
				<tr>
					<td width="12">&nbsp;&nbsp;b.</td>
					<td width="200">Dasar Pengenaan (Jumlah pembayaran yang diterima)</td>
					<td width="10">:</td>
					<td width="340">Rp.'.$total.'</td>
				</tr>
				</table>
				</td>
				</tr>
			</table>';
		}*/
					
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
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="5">&nbsp;</td>
					<td width="562">
						<div align="justify">Dengan menyadari sepenuhnya akan segala akibat termasuk sanksi-sanksi sesuai dengan ketentuan perundang-undangan yang berlaku. Saya atau yang saya beri kuasa menyatakan bahwa apa yang telah kami beritahukan diatas beserta lampiran-lampirannya adalah benar, lengkap dan jelas.					    				
					  </div>
					  </td>
					 <td width="5">&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="572" colspan="3">
						<table border="0">
							<tr>
							<td>
							<table border="0">
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center">Nanga Pinoh, '.$tanggal.'</td>
								</tr>
								<tr>
									<td width="572" height="50">&nbsp;</td>
								</tr>
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center">'.$sql->nama_perusahaan.'</td>
								</tr>
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center">&nbsp;&nbsp;&nbsp;</td>
								</tr>
						</table>
						</td>
						</tr>
					</table>
					</td>
				</tr>
			</table>
			</td></tr>
			</table>';
			
			$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>PETUGAS PENERIMA</strong>
					</td>
				</tr>
			</table>';
	
	$op = $this->db->query("select * from admin where username = '".$sql->petugas."'")->row();
	if($op==NULL){
		$petugas = "";
		$nip = "";
	} else {
		$petugas = strtoupper($op->nama);
		$nip = $op->nip;
	}
			
		$report .=
			'<table border="1">
				<tr>
				<td width="572">
				<table border="0">
<tr>
	<td height="10">&nbsp;</td>
</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;Diterima tanggal </td>
                            <td width="3%">:</td>
                            <td width="61%">'.$sql->tgl_diterima.'</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">Nanga Pinoh, '.$tanggal.'</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;Nama Petugas </td>
                            <td width="3%">:</td>
                            <td width="61%">'.$petugas.'</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">&nbsp;</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;NIP</td>
                            <td width="3%">:</td>
                            <td width="61%">'.$nip.'</td>
                          </tr>
                        </table></td>
						<td width="200" height="50" align="center">&nbsp;</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
						<td width="372">&nbsp;</td>
						<td width="200" align="center">'.$petugas.'</td>
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
	public function cetak2(){
		$sql = $this->db->query("SELECT sptpd_restoran.id, sptpd_restoran.npwpd, view_perusahaan.npwpd_lama, sptpd_restoran.no_sptpd, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, 
view_perusahaan.nama_pemilik,view_perusahaan.alamat_pemilik, sptpd_restoran.thn_pajak, sptpd_restoran.jns, sptpd_restoran.ket_insidental, sptpd_restoran.cara_hitung,
DATE_FORMAT(sptpd_restoran.tgl_diterima,'%d/%m/%Y') AS tgl_diterima, sptpd_restoran.petugas,sptpd_restoran.author, sptpd_restoran.gol_restoran, 
DATE_FORMAT(sptpd_restoran.masa_pajak1,'%d/%m/%Y') AS masa_pajak1, 
DATE_FORMAT(sptpd_restoran.masa_pajak2,'%d/%m/%Y') AS masa_pajak2, 
sptpd_restoran.omset, sptpd_restoran.jml_bayar, sptpd_child.tarif 
FROM sptpd_restoran LEFT JOIN view_perusahaan ON sptpd_restoran.npwpd=view_perusahaan.npwpd_perusahaan LEFT JOIN 
sptpd_child ON sptpd_restoran.no_sptpd=sptpd_child.no_sptpd	where sptpd_restoran.no_sptpd='".$_GET['sptpd']."'")->row();

		$a = explode("/",$sql->masa_pajak1);
		$a1 = $a[1];
		$awal				= $this->msistem->v_bln($a1);
		$b = explode("/",$sql->masa_pajak2);
		$b1 = $b[1];
		$akhir 				= $this->msistem->v_bln($b1);
		$tahun				= $b[2];
		$jml				= $sql->omset;
		$total				= number_format($jml,2,",",".");
		$tarif				= $sql->tarif;
		$npwpd_lama			= $sql->npwpd_lama;
		$petugas			= $sql->petugas;
		$author			= $sql->author;
		$pajak				= number_format($sql->jml_bayar,2,",",".");	
		
		$bulan = date('m');
		$m	= $this->msistem->v_bln($bulan);
		$days = date('d');
		$tanggal			= $days.' '.$m.' '.date('Y');
				
		$nm = $this->db->query("select nm_rek from master_rekening where kd_rek='".$sql->gol_restoran."'")->row();
		
		$c			= $sql->tgl_diterima;
		$arr = explode("/",$c);
		$s = $arr[1];
		$bln = $this->msistem->v_bln($s);
		$created = $arr[0].' '.$bln.' '.$arr[2];
		$thn_pjk = $sql->thn_pajak;
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('P', 'pt', 'A4', true, 'UTF-8', false);  
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD');
		$pdf->SetKeywords('SOPD');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
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
					<td width="572">
						<table border="0">
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="50" height="" align="center" valign="middle"><img src="./images/Logo melawi2.png" width="50" height="60" /></td>
								<td width="482" align="center">&nbsp;<br/>
									PEMERINTAH KABUPATEN MELAWI<br />
									<b>BADAN PENDAPATAN DAERAH</b>
									<br />Jl. Garuda No 1 Nanga Pinoh Telepon (0568) 2020545
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>';
			
			$get="";
			if($npwpd_lama==null){
				$get="";
			}else{
				$get=" ".$npwpd_lama." ";
			}
			
		$report .=
			'<table border=1>
				<tr>
					<td width="572">
						<table border="0">

						
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="155" align="center"></td>
								<td width="260" align="center">&nbsp;&nbsp;SURAT PEMBERITAHUAN PAJAK DAERAH (SPTPD)</td>
								<td width="10" align="center"></td>
								<td width="340"></td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="228" align="center"></td>
								<td width="120">&nbsp;&nbsp;PAJAK RESTORAN</td>
								<td width="10" align="center"></td>
								<td width="340"></td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="180" align="center"></td>
								<td width="215" align="center">&nbsp;&nbsp;( Perda Kabupaten Melawi Nomor 3 Tahun 2012 )</td>
								<td width="10" align="center"></td>
								<td width="340"></td>
							</tr>
							<tr>
								<td>
								</td>
							</tr>
							<tr style="line-height:80%;">
								<td width="110">&nbsp;</td>
								<td width="94">&nbsp;</td>
								<td width="258">&nbsp;</td>
								<td width="200" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif, line-height: 1em"><div align="left"><font size="9"><b>Kepada</b></font></div></td>
							</tr>
							<tr style="line-height:80%;">
								<td width="110">&nbsp;</td>
								<td width="94">&nbsp;</td>
								<td width="180">&nbsp;</td>
								<td width="200" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif, line-height: 1em"><div align="left"><font size="9"><b>Yth. Kepala BAPENDA Kabupaten Melawi</b></font></div></td>
							</tr>
							<tr style="line-height:80%;">
								<td width="110">&nbsp;</td>
								<td width="94">&nbsp;</td>
								<td width="269">&nbsp;</td>
								<td width="200" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif, line-height: 1em"><div align="left"><font size="9"><b>di. </b></font></div></td>
							</tr>
							<tr style="line-height:80%;">
								<td width="110">&nbsp;</td>
								<td width="94">&nbsp;</td>
								<td width="249">&nbsp;</td>
								<td width="200" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif, line-height: 1em"><div align="left"><font size="9"><b>Nanga Pinoh</b></font></div></td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;Tahun Pajak</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$thn_pjk.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;N.P.W.P.D</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->npwpd.'</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>';
		
		$report .=
			'<table border=1>
				<tr>
					<td width="572">
						<table border="0">
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;Perhatian    :</td>
								<td width="10" align="center"></td>
								<td width="340"></td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="290">&nbsp;&nbsp;1. Harap diisi dalam rangkap 2 (dua) dengan huruf cetak.</td>
								<td width="10" align="center"></td>
								<td width="340"></td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="510">&nbsp;&nbsp;2. Setelah diisi dan ditandan tangani, harap diserahkan ke Badan Pendapatan Daerah Kabupaten Melawi.</td>
								<td width="10" align="center"></td>
								<td width="340"></td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="250">&nbsp;&nbsp;3. Beri tanda ( X ) pada jawaban yang diberikan.</td>
								<td width="10" align="center"></td>
								<td width="340"></td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="250">&nbsp;&nbsp;4. Lampirkan foto copy KTP / SIUP.</td>
								<td width="10" align="center"></td>
								<td width="340"></td>
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
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="572" align="center">
						<strong>A. IDENTITAS WAJIB PAJAK</strong>
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
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="150">&nbsp;&nbsp;1. Nama Lengkap Pemilik</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->nama_pemilik.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="150">&nbsp;&nbsp;2. Alamat Pemilik</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->alamat_pemilik.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="150">&nbsp;&nbsp;3. Merk Usaha</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->nama_perusahaan.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="150">&nbsp;&nbsp;4. Alamat Usaha</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->alamat_perusahaan.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="150">&nbsp;&nbsp;5. Surat Izin Usaha SITU</td>
								<td width="10" align="center">:</td>
								<td width="340"></td>
							</tr>
							
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>	
						</table>
					</td>
				</tr>
			</table>';		
		
		/*$jns = $sql->cara_hitung;
		if($jns!='1'){*/
		
		$report .=
			'<table border=1>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="572" align="center">
						<strong>B. IDENTITAS OBJEK PAJAK</strong>
					</td>
				</tr>
			</table>';
		
		if($a1=='01'){
			$a1 = 12;
			$tahun = $tahun-1;
		} else {
			$a1 = $a1-1;
		}
		
		if(strlen($a1)==1) {
			$a1 = '0'.$a1;
		}
		
//		$set = $this->db->query("select a.ketetapan, a.setoran, b.masa_pajak1,
//         b.masa_pajak2, c.tarif from sspd a left join sptpd_restoran b on a.nomor=b.no_sptpd left join sptpd_child c
//         on a.nomor=c.no_sptpd where a.npwpd = '".$sql->npwpd."' and a.masa_pajak1 = '".$a1."' and a.tahun_pajak = '".$tahun."'")->row();
         
         $set = $this->db->query("SELECT a.ketetapan, a.setoran, f.masa_pajak1, f.masa_pajak2,
         e.tarif FROM sspd a LEFT JOIN skpd b ON a.nomor=b.no_skpd 
          LEFT JOIN sptpd_restoran f ON b.no_sptpd=f.no_sptpd 
          LEFT JOIN sptpd_child e ON f.no_sptpd=e.no_sptpd
          WHERE a.npwpd = '".$sql->npwpd."' AND a.masa_pajak1 = '".$a1."' AND a.tahun_pajak = '".$tahun."'")->row();
         
         
          
	/* 	if($set==NULL){
			$tgl = "- s/d -";
			$dp = "Rp. 0,00";
			$t = "0%";
			$h = "Rp. 0,00";
		} else {
			$l = explode('-',$set->masa_pajak1);
			$l1 =  $l[2].'/'.$l[1].'/'.$l[0];
		
			$lo = explode('-',$set->masa_pajak2);
			$l2 = $lo[2].'/'.$lo[1].'/'.$lo[0];
			$tgl = $l1.' s/d '.$l2;
			$dp = 'Rp. '.number_format($set->ketetapan,2,",",".");
			$t = $set->tarif.'%';
			$h = 'Rp. '.number_format($set->setoran,2,",",".");
		} */
		
		$report .=
			'<table border=1>
				<tr>
					<td width="572">
						<table>
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="150">&nbsp;&nbsp;1. Jenis Usaha</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$nm->nm_rek.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="150">&nbsp;&nbsp;2. Luas Tempat Usaha</td>
								<td width="10" align="center">:</td>
								<td width="340"></td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="150">&nbsp;&nbsp;3. Fasilitas</td>
								<td width="10" align="center">:</td>
								<td width="340"></td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="150">&nbsp;&nbsp;4. Jumlah Pegawai</td>
								<td width="10" align="center">:</td>
								<td width="340"></td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="150">&nbsp;&nbsp;5. Menggunkan Kas Register</td>
								<td width="10" align="center">:</td>
								<td width="80">&nbsp;&nbsp;a. Ya</td>
								<td width="340">b. Tidak</td>
							
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="150">&nbsp;&nbsp;6. Kepemilikan Tempat Usaha</td>
								<td width="10" align="center">:</td>
								<td width="100">&nbsp;&nbsp;a. Milik Sendiri</td>
								<td width="80">b. Sewa</td>
								<td width="80">c. Bagi Hasil</td>
							</tr>
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>
						</table>	
					</td>
				</tr>
			</table>';
			
		/*} else if($jns=='2'){
			
			$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>DATA PAJAK RESTORAN</strong>
					</td>
				</tr>
			</table>';
			
			$report .=
			'<table width="572" border=1>
				<tr>
				<td>
				<table>
				<tr>
					<td width="12">&nbsp;&nbsp;a.</td>
					<td width="200">Masa Pajak</td>
					<td width="10">:</td>
					<td width="340">'.$sql->masa_pajak1.' s/d '.$sql->masa_pajak2.'</td>
				</tr>
				<tr>
					<td width="12">&nbsp;&nbsp;b.</td>
					<td width="200">Dasar Pengenaan (Jumlah pembayaran yang diterima)</td>
					<td width="10">:</td>
					<td width="340">Rp.'.$total.'</td>
				</tr>
				</table>
				</td>
				</tr>
			</table>';
		}*/
			$report .=
			'<table border=1>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="572" align="center">
						<strong>C. JUMLAH PAJAK YANG HARUS DIBAYAR</strong>
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
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="150">&nbsp;&nbsp;1. Masa Pajak</td>
								<td width="10" align="center">:</td>
								<td width="340"></td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="150">&nbsp;&nbsp;2. Jumlah Omset Perbulan</td>
								<td width="10" align="center">:</td>
								<td width="340">Rp.   '.$total.'</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="150">&nbsp;&nbsp;3. Tarif Pajak</td>
								<td width="10" align="center">:</td>
								<td width="340">'.$sql->tarif.' %</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="150">&nbsp;&nbsp;4. Jumlah Pajak yang harus &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dibayar</td>
								<td width="10" align="center">:</td>
								<td width="340">Rp.   '.$pajak.'</td>
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
						<strong></strong>
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
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="5">&nbsp;</td>
					<td width="562">
						<div align="justify">Dengan menyadari sepenuhnya akan segala akibat termasuk sanksi-sanksi sesuai dengan ketentuan perundang-undangan yang berlaku. Saya atau yang saya beri kuasa menyatakan bahwa apa yang telah kami beritahukan diatas beserta lampiran-lampirannya adalah benar.					    				
					  </div>
					  </td>
					 <td width="5">&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="572" colspan="3">
						<table border="0">
							<tr>
							<td>
							<table border="0">
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center">Nanga Pinoh,  ................................. </td>
								</tr>
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center">&nbsp;&nbsp;&nbsp;</td>
								</tr>
								<tr>
									<td width="372">&nbsp;&nbsp;Nama Petugas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : '.$author.'</td>
									<td width="200" align="center">Wajib Pajak</td>
								</tr>
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center">&nbsp;&nbsp;&nbsp;</td>
								</tr>
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center">&nbsp;&nbsp;&nbsp;</td>
								</tr>
								<tr>
									<td width="372">&nbsp;&nbsp;Tanda Tangan Petugas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</td>
									<td width="200" align="center">&nbsp;&nbsp;&nbsp;</td>
								</tr>
								<tr>
									<td width="372"></td>
									<td width="200" align="center">'.$sql->nama_pemilik.'</td>
								</tr>
						</table>
						</td>
						</tr>
					</table>
					</td>
				</tr>
			</table>
			</td></tr>
			</table>';
			
			
			/* $report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>PETUGAS PENERIMA</strong>
					</td>
				</tr>
			</table>';
	
	$op = $this->db->query("select * from admin where username = '".$sql->petugas."'")->row();
	if($op==NULL){
		$petugas = "";
		$nip = "";
	} else {
		$petugas = strtoupper($op->nama);
		$nip = $op->nip;
	}
			
		$report .=
			'<table border="1">
				<tr>
				<td width="572">
				<table border="0">
<tr>
	<td height="10">&nbsp;</td>
</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;Diterima tanggal </td>
                            <td width="3%">:</td>
                            <td width="61%">'.$sql->tgl_diterima.'</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">Nanga Pinoh, '.$tanggal.'</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;Nama Petugas </td>
                            <td width="3%">:</td>
                            <td width="61%">'.$petugas.'</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">&nbsp;</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;NIP</td>
                            <td width="3%">:</td>
                            <td width="61%">'.$nip.'</td>
                          </tr>
                        </table></td>
						<td width="200" height="50" align="center">&nbsp;</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
						<td width="372">&nbsp;</td>
						<td width="200" align="center">'.$petugas.'</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">&nbsp;</td>
					</tr>
				</table>
				</td>
				</tr>
			</table>'; */
		
		//$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_SPTPD'.'.pdf', 'I');
	}
}
?>