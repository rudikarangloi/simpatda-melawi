<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class buku extends MY_Controller {
	
	function __construct() {
            parent::__construct();
            $this->load->model('msistem');
    }
	
	public function index() {
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select nama from admin where username='".$username."'")->row();
		$data['namaPetugas'] = $s->nama;
		$data['gresto'] = $this->db->query("select kd_rek from master_rekening");
		$this->load->view('buku/kas',$data);
	}
	
	public function cgol() {
		$p = $this->input->post('gol');
		$sq = $this->db->query("select nm_rek from master_rekening where kd_rek='".$p."'")->row();
		$q = $sq->nm_rek;
		echo $q;
	}
	
	public function mainData(){
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id, no_kas, DATE_FORMAT(tgl,'%d/%m/%Y') as tgl, petugas, jumlah, ket from kas","id","id, no_kas, tgl, petugas, jumlah, ket");
	}
	
	public function simpan(){
		$jml = $this->input->post('jumlah');
		if(strpos($jml, '.')){
			$jml = str_replace('.', '', $jml);
		} else {
			$jml;
		}
		
		$data = array (
			'tgl' 	   => $this->input->post('tgl'),
			'petugas'   => strtoupper($this->input->post('petugas')),
			'jumlah' 	=> $jml,
			'ket' 	   => strtoupper($this->input->post('ket')),
			'author' 	=> strtoupper($this->session->userdata('username'))
		);
		if($this->input->post('id')==0){
			$no_kas = $this->generateNo();
			$dataIns = array_merge($data,array('no_kas' => $no_kas,'created' => date('Y-m-d H:i:s')));
			$this->db->insert('kas',$dataIns);
		} else {
			$no_kas = $this->input->post('no_kas');
			$this->db->delete('kas_child',array('no_kas' => $no_kas));
			$dataUpd = array_merge($data,array('no_kas' => $no_kas,'modified' => date('Y-m-d H:i:s')));
			$this->db->update('kas', $dataUpd, array('id' => $this->input->post('id')));
		}
		echo $no_kas;
	}
	
	public function generateNo() {
		$sql = $this->db->query("select MAX(no_kas) as max from kas")->row();
		$r = $sql->max;
		if($r==NULL){
			$daftar = "KAS.000000001";
		} else {
			$c = explode(".",$r);
			$jml = $c[1] + 1;
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
			} else if(strlen($jml)==9) {
				$jml;
			}
			$daftar = "KAS.".$jml;
		}
		return $daftar;
	}
	
	function buku_child(){
		$grid = new GridConnector($this->db->conn_id);
		if(isset($_GET['kas'])) {
			$grid->render_sql("select no_rekening, nm_rekening, jumlah, ket, no_kas from kas_child where no_kas = '".$_GET['kas']."'","id","no_rekening, nm_rekening, jumlah, ket, no_kas");
		} else {
			$grid->render_table("kas_child","id","no_rekening, nm_rekening, jumlah, ket, no_kas");
		}
	}
	
	function lapor(){
		$this->load->view('pelaporan');
	}
	
	function bayar(){
		$data['tgl'] = date('d/m/Y');
		$this->load->view('bayar',$data);
	}
	
	public function data_pembayaran() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("SELECT
pembayaran.id,
pembayaran.no_tbp,
pembayaran.no_sspd,
pembayaran.npwpd,
pembayaran.no_skpd,
identitas_perusahaan.nama_perusahaan,
identitas_perusahaan.alamat_perusahaan,
pembayaran.jumlah,
pembayaran.setoran_wp,
pembayaran.kurang,
pembayaran.lebih
FROM
identitas_perusahaan
INNER JOIN pembayaran ON identitas_perusahaan.npwpd_perusahaan = pembayaran.npwpd","id","id, no_tbp, no_sspd, npwpd, no_skpd, nama_perusahaan, alamat_perusahaan, jumlah, setoran_wp, kurang, lebih");	
	}
	
	function simpan_bayar(){
		$js = $this->input->post('jenis_usaha');
		$tgl = $this->input->post('tanggal');
		
		$jml = $this->input->post('jml');
		if(strpos($jml, '.')){
			$jml = str_replace('.', '', $jml);
		} else {
			$jml;
		}
        
        $setor = $this->input->post('setor');
		if(strpos($setor, '.')){
			$setor = str_replace('.', '', $setor);
		} else {
			$setor;
		}
        
        $kurang = $this->input->post('kurang');
		if(strpos($kurang, '.')){
			$kurang = str_replace('.', '', $kurang);
		} else {
			$kurang;
		}
        
        $lebih = $this->input->post('lebih');
		if(strpos($lebih, '.')){
			$lebih = str_replace('.', '', $lebih);
		} else {
			$lebih;
		}		        
        
        $datasptpd = array (
            'status' => 1
        );
        
		$data = array (
			'npwpd' 		=> $this->input->post('npwpd'),
			'no_sspd'		=> $this->input->post('sspd'),
			'no_skpd'		=> $this->input->post('skpd'),
			'jumlah'		=> $jml,
            'setoran_wp'	=> $setor,
            'kurang'		=> $kurang,
            'lebih'		=> $lebih,
			'tgl_bayar'	    => $tgl,
			'author' 		=> strtoupper($this->session->userdata('username'))
		);
		if($this->input->post('id')==0){
			$no_tbp = $this->generateNos($this->input->post('skpd'));
			$dataIns = array_merge($data,array('no_tbp' => $no_tbp, 'created' => date('Y-m-d H:i:s')));
			$this->db->insert('pembayaran',$dataIns);
            
            $dataUpd1 = array_merge($datasptpd,array('modified' => date('Y-m-d H:i:s')));            
            $this->db->update('sspd', $dataUpd1, array('nomor' => $this->input->post('skpd')));                        
		} else {
			$dataUpd = array_merge($data,array('modified' => date('Y-m-d H:i:s')));
			$no_tbp = $this->input->post('tbp');
			$this->db->update('pembayaran', $dataUpd, array('no_tbp' => $no_tbp, 'id' => $this->input->post('id')));
		}
		echo $no_tbp;
	}
	
	public function generateNos($js="") {
		$gabung = explode("/",$js);
		$kd = $gabung[1];
		$kode = $this->db->query('select kode_tbp from master_sptpd where kode_sptpd="'.$kd.'"')->row();
		$sql = $this->db->query("select MAX(no_tbp) as max from pembayaran where no_tbp like '%".$kode->kode_tbp."%'")->row();
		$r = $sql->max;
		if($r==NULL){
			$no = "TBP-".$kode->kode_tbp."/NO. 000000001";
		} else {
			$cek = explode(". ",$r);
			$dt = $cek[1];
			$jml = $dt + 1;
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
			$no = "TBP-".$kode->kode_tbp."/NO. ".$jml;
		}
		return $no;
	}
	
	function deleteBayar(){
		$datasptpd = array (
            'status' => 0
        );
		 $this->db->update('sspd', $datasptpd, array('no_sspd' => $this->input->post('sspd')));
		$this->db->delete('pembayaran',array('no_tbp' => $this->input->post('bayar')));
		$result = "Data TBP berhasil dihapus.";
		echo $result;
	}
	
	public function load_sspd($op="",$nilai="") {
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($op=='1'){
			$bro = "where a.no_sspd like '%".$nilai."%'";
		} else if($op=='2'){
			$bro = "where a.npwpd like '%".$nilai."%'";
		} else if($op=='3'){
			$bro = "where b.nama_perusahaan like '%".$nilai."%'";
		}
		
		$qr = $this->db->query("SELECT a.id, a.no_sspd, a.tanggal, a.nomor, a.npwpd, b.nama_perusahaan, b.alamat_perusahaan, a.ketetapan, a.setoran, c.no_sptpd FROM sspd a 
LEFT JOIN identitas_perusahaan b ON a.npwpd=b.npwpd_perusahaan
INNER JOIN skpd c ON c.no_skpd = a.nomor $bro AND a.status='0'");
		
		$i=1;
		foreach($qr->result() as $rs) {
			// cair
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$rs->id."]]></cell>");
					echo("<cell><![CDATA[".$rs->no_sspd."]]></cell>");
					echo("<cell><![CDATA[".$rs->tanggal."]]></cell>");
					echo("<cell><![CDATA[".$rs->nomor."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->ketetapan."]]></cell>");
					echo("<cell><![CDATA[".$rs->setoran."]]></cell>");
					echo("<cell><![CDATA[".$rs->no_sptpd."]]></cell>");                                        
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	function cetak_bayar(){
		
        $sql = $this->db->query("SELECT
pembayaran.id,
pembayaran.no_tbp,
pembayaran.no_sspd,
pembayaran.npwpd,
pembayaran.no_skpd,
view_perusahaan.nama_perusahaan,
view_perusahaan.alamat_perusahaan,
view_perusahaan.nama_pemilik,
pembayaran.jumlah,
pembayaran.setoran_wp,
pembayaran.kurang,
pembayaran.lebih,
DATE_FORMAT(pembayaran.tgl_bayar,'%d/%m/%Y') as tgl_bayar
FROM
view_perusahaan
INNER JOIN pembayaran ON view_perusahaan.npwpd_perusahaan = pembayaran.npwpd
 where pembayaran.no_tbp ='".$_GET['bayar']."'")->row();
		
		$jumlah = number_format($sql->jumlah,2,",",".");
        $setoran = number_format($sql->setoran_wp,2,",",".");
        $kurang = number_format($sql->kurang,2,",",".");
        $lebih = number_format($sql->lebih,2,",",".");        
		$description = $this->msistem->baca($sql->jumlah);
        $description2 = $this->msistem->baca($sql->setoran_wp);
		$a = explode("/",$sql->tgl_bayar);
		$a1 = $a[1];
		$awal				= $this->msistem->v_bln($a1);
		$tahun				= $a[2];
		$tgl = $a[0].' '.$awal.' '.$tahun;
		$petugas = 'DINA HERMINA, SE';
		$nip = '19694225 199303 2 006';
		
		$kd = explode('/',$sql->no_skpd);
		$s = $this->db->query('select nama_sptpd from master_sptpd where kode_sptpd="'.$kd[1].'"')->row();
		
		$res = $this->db->query('select kode_rekening, nama_rekening, jumlah as jum_detail from sspd_detail where no_sspd ="'.$sql->no_sspd.'"');
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/header_output');
		$pdf = new header_output('P', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('BUKTI');
		$pdf->SetKeywords('BUKTI');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(32);
		$pdf->SetMargins(50,30,50);
		// set font yang digunakan
		$pdf->SetFont('times', '', 10);
	
		$pdf->AddPage('P','LEGAL',false);
		//set data
		$report = '';
		$report .=
			'<table border=1 style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
					<td width="520" align="center">
						<b>PEMERINTAH KOTA JAMBI<br />
						DINAS PENDAPATAN</b><br />
						Jl. Jend. Basuki Rachmat Kota Baru Telepon (0741) 40284 Fax 40284<br />
						J A M B I						
                    </td>
                </tr>    
				<tr>
                    <td width="520" align="center" ><br/><br/>        
                        <b>TANDA BUKTI PEMBAYARAN PAJAK DAERAH<br />
						NOMOR : '.$sql->no_tbp.'</b><br />						
                    </td>
                </tr>
			</table>';
			
		$report .=
			'<table border="1" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px">
				<tr>
					<td width="520"><br /><br />
					<table width="500" align="left" border="0">	
						<tr>
							<td width="37"></td>
							<td width="110">Nama Usaha</td>
							<td width="13">:</td>
							<td width="340">'.$sql->nama_perusahaan.'</td>
						</tr>
						<tr>
							<td width="37"></td>
							<td width="110">Alamat Usaha</td>
							<td width="13">:</td>
							<td width="340">'.$sql->alamat_perusahaan.'</td>
						</tr>
						<tr>
							<td width="37"></td>
							<td width="110">Nama Pemilik Usaha</td>
							<td width="13">:</td>
							<td width="340">'.$sql->nama_pemilik.'</td>
						</tr>
					</table>
					<br/>
					<table width="500" align="left" border="0">												
						<tr>
							<td width="37"></td>
							<td width="463">Jumlah Setoran Wajib Pajak Rp. '.$jumlah.'</td>
						</tr>						
						<tr>
							<td width="37"></td>
							<td width="463">(&nbsp;&nbsp;dengan huruf : &nbsp;&nbsp;<i>'.$description2.' RUPIAH</i>&nbsp;&nbsp;)</td>
						</tr>
						<tr>
							<td width="500"><br/></td>							
						</tr>						
						<tr>
							<td width="37"></td>
							<td width="463">Bendaraha Penerima Dinas Pendapatan Kota jambi</td>
						</tr>
						<tr>
							<td width="37"></td>
							<td width="463">Telah menerima uang sebesar Rp. '.$setoran.'</td>
						</tr>
						<tr>
							<td width="37"></td>
							<td width="463">(&nbsp;&nbsp; dengan huruf : &nbsp;&nbsp;<i>'.$description.' RUPIAH</i>&nbsp;&nbsp;)</td>
						</tr>
						<tr>
							<td width="37"></td>
							<td width="463">Untuk Nomor SSPD : '.$sql->no_sspd.'</td>
						</tr>
					</table>
                    <br />					
					';
					/*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Kode Rekening&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama Rekening<br/>';*/
					$report .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<table border="1" width="90%">
										<tr>
											<td width="18%" height="20" align="center">Kode Rekening</td>
											<td width="62%" height="20" align="center">Nama Rekening</td>
											<td width="20%" height="20" align="center">Sub Jumlah (Rp.)</td>
										</tr>';
						$cnjum=0;				
					foreach($res->result() as $de){
						/*$report .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						'.$de->kode_rekening.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$de->nama_rekening.'<br/>';*/
						$report .= '
										<tr>
											<td width="18%" align="center">'.$de->kode_rekening.'</td>
											<td width="62%" align="left">&nbsp;'.$de->nama_rekening.'</td>
											<td width="20%" align="right">'.number_format($de->jum_detail,2).' &nbsp;</td>
										</tr>';			
						$cnjum = $cnjum + $de->jum_detail; 								
					}
		$report .= '</table>
					<table border="1" width="90%">
										<tr>
											<td width="80%" align="center">Jumlah</td>
											<td width="20%" align="right">'.number_format($cnjum,2).' &nbsp;</td>
										</tr></table><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Tanggal diterima uang : '.$tgl.'<br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br /><br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mengetahui, <br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp; Bendahara Penerima&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 Pembayar/Penyetor<br />
					<br /><br /><br /><br/><br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					'.$petugas.'
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;									
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$sql->nama_pemilik.'<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;'.$nip.'<br />
					
					</td>
				</tr>
			</table>
			<font size="-3"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Lembar Asli : Untuk Pembayaran/Pihak Ketiga/Penyetor
			Salinan 1 : Untuk Bendahara Penerima/Pembantu 
			Salinan 2 : Arsip</b></font>';
		
		//$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_SPTPD'.'.pdf', 'I');
	}
}