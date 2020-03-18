<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class buku2 extends MY_Controller {
	
	function __construct() {
            parent::__construct();
            $this->load->model('msistem');
    }
	
	public function index() {
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select nama from admin where username='".$username."'")->row();
		$data['namaPetugas'] = $s->nama;
		$data['gresto'] = $this->db->query("select kd_rek from master_rekening");
		$this->load->view('buku2/kas',$data);
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
		
	function bayar2(){
		$this->load->view('bayar2');
	}
	
	public function data_pembayaran() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("SELECT
pembayaran_ret.id,
pembayaran_ret.no_tbp,
pembayaran_ret.no_ssrd,
pembayaran_ret.npwpd,
pembayaran_ret.no_skrd,
identitas_perusahaan.nama_perusahaan,
identitas_perusahaan.alamat_perusahaan,
pembayaran_ret.jumlah,
pembayaran_ret.setoran_wp,
pembayaran_ret.kurang,
pembayaran_ret.lebih
FROM
identitas_perusahaan
INNER JOIN pembayaran_ret ON identitas_perusahaan.npwpd_perusahaan = pembayaran_ret.npwpd","id","id, no_tbp, no_ssrd, npwpd, no_skrd, nama_perusahaan, alamat_perusahaan, jumlah, setoran_wp, kurang, lebih");	
	}
	
	function simpan_bayar(){
		$js = $this->input->post('jenis_usaha');
		$tgl = date('Y-m-d');
		
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
            'status' => '1'
        );
        
		$data = array (
			'npwpd' 		=> $this->input->post('npwpd'),
			'no_ssrd'		=> $this->input->post('ssrd'),
			'no_skrd'		=> $this->input->post('skrd'),
			'jumlah'		=> $jml,
            'setoran_wp'	=> $setor,
            'kurang'		=> $kurang,
            'lebih'		=> $lebih,
			'tgl_bayar'	    => $tgl,
			'author' 		=> strtoupper($this->session->userdata('username'))
		);
		if($this->input->post('id')==0){
			$no_tbp = $this->generateNos($this->input->post('skrd'));
			$dataIns = array_merge($data,array('no_tbp' => $no_tbp, 'created' => date('Y-m-d H:i:s')));
			$this->db->insert('pembayaran_ret',$dataIns);
            
            $dataUpd1 = array_merge($datasptpd,array('modified' => date('Y-m-d H:i:s')));            
            $this->db->update('sptrd', $dataUpd1, array('no_sptrd' => $this->input->post('sptrd')));                        
		} else {
			$dataUpd = array_merge($data,array('modified' => date('Y-m-d H:i:s')));
			$no_tbp = $this->input->post('tbp');
			$this->db->update('pembayaran_ret', $dataUpd, array('no_tbp' => $no_tbp, 'id' => $this->input->post('id')));
		}
		echo $no_tbp;
	}
	
	public function generateNos($js="") {
		$gabung = explode("/",$js);
		$kd = $gabung[1];
		//$kode = $this->db->query('select kode_tbp from master_sptpd where kode_sptpd="'.$kd.'"')->row();
		$sql = $this->db->query("select MAX(no_tbp) as max from pembayaran_ret where no_tbp like '%".$kode->kode_tbp."%'")->row();
		$r = $sql->max;
		if($r==NULL){
			$no = "TBP-RET/NO. 000000001";
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
			$no = "TBP-RET/NO. ".$jml;
		}
		return $no;
	}
	
	function deleteBayar(){
		$this->db->delete('pembayaran',array('no_tbp' => $this->input->post('bayar')));
		$result = "Data TBP berhasil dihapus.";
		echo $result;
	}
	
	public function load_ssrd($op="",$nilai="") {
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($op=='1'){
			$bro = "where a.no_ssrd like '%".$nilai."%'";
		} else if($op=='2'){
			$bro = "where a.npwpd like '%".$nilai."%'";
		} else if($op=='3'){
			$bro = "where b.nama_perusahaan like '%".$nilai."%'";
		}
		
		$qr = $this->db->query("SELECT a.id, a.no_ssrd, a.tanggal, a.nomor, a.npwpd, b.nama_perusahaan, b.alamat_perusahaan, a.ketetapan, a.setoran, c.no_sptrd FROM ssrd a 
LEFT JOIN identitas_perusahaan b ON a.npwpd=b.npwpd_perusahaan
INNER JOIN skrd c ON c.no_skrd = a.nomor $bro");
		
		$i=1;
		foreach($qr->result() as $rs) {
			// cair
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$rs->id."]]></cell>");
					echo("<cell><![CDATA[".$rs->no_ssrd."]]></cell>");
					echo("<cell><![CDATA[".$rs->tanggal."]]></cell>");
					echo("<cell><![CDATA[".$rs->nomor."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->ketetapan."]]></cell>");
					echo("<cell><![CDATA[".$rs->setoran."]]></cell>");
					echo("<cell><![CDATA[".$rs->no_sptrd."]]></cell>");                                        
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	function cetak_bayar(){
		
        $sql = $this->db->query("SELECT
pembayaran_ret.id,
pembayaran_ret.no_tbp,
pembayaran_ret.no_ssrd,
pembayaran_ret.npwpd,
pembayaran_ret.no_skrd,
view_perusahaan.nama_perusahaan,
view_perusahaan.alamat_perusahaan,
view_perusahaan.nama_pemilik,
pembayaran_ret.jumlah,
pembayaran_ret.setoran_wp,
pembayaran_ret.kurang,
pembayaran_ret.lebih,
DATE_FORMAT(pembayaran_ret.tgl_bayar,'%d/%m/%Y') as tgl_bayar
FROM
view_perusahaan
INNER JOIN pembayaran_ret ON view_perusahaan.npwpd_perusahaan = pembayaran_ret.npwpd
 where pembayaran_ret.no_tbp ='".$_GET['bayar']."'")->row();
		
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
		$petugas = 'Riswan A. Randalembah, SE';
		$nip = '19620817 199118 2 801';
		
		$kd = explode('/',$sql->no_skrd);
		//$s = $this->db->query('select nama_sptpd from master_sptpd where kode_sptpd="'.$kd[1].'"')->row();
		
		$res = $this->db->query('select lokasi_pasar, indeks_kawasan, indeks_gangguan from ssrd where no_ssrd ="'.$sql->no_ssrd.'"')->row();
		
        $r = $this->db->query('select nm_lokasi from lokasi_pasar where kode ="'.$res->lokasi_pasar.'"')->row();
        
        
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
			'<table border=1>
				<tr>
					<td width="520" align="center">
						<b>PEMERINTAH KABUPATEN SIGI<br />
						DINAS PENDAPATAN PENGELOLAAN KEUANGAN DAN ASET DAERAH</b><br />
						Jalan Poros PALU - Telp (0655) 7006013, Fax (0655)7551162,7551165<br />
						PALOLO
                    </td>
                </tr>    
				<tr>
                    <td width="520" align="center" ><br/><br/>        
                        <b>TANDA BUKTI PEMBAYARAN RETRIBUSI DAERAH<br />
						NOMOR : '.$sql->no_tbp.'</b><br />						
                    </td>
                </tr>
			</table>';
			
		$report .=
			'<table border="1">
				<tr>
					<td width="520"><br /><br />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Jumlah Setoran Wajib Pajak Rp. '.$jumlah.'<br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					(&nbsp;&nbsp;dengan huruf : &nbsp;&nbsp;'.$description2.' RUPIAH&nbsp;&nbsp;)<br/><br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Bendaraha Penerimaan : DINAS PENDAPATAN PENGELOLAAN KEUANGAN DAN ASET DAERAH (DPPKAD)<br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Telah menerima uang sebesar Rp. '.$setoran.'<br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					(&nbsp;&nbsp;dengan huruf : &nbsp;&nbsp;'.$description.' RUPIAH&nbsp;&nbsp;)
					<br /><br /><br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					NPWPD Perusahaan &nbsp;&nbsp;&nbsp;: '.$sql->npwpd.'<br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Nama Perusahaan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$sql->nama_perusahaan.'<br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Alamat Perusahaan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$sql->alamat_perusahaan.'<br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Sebagai pembayaran &nbsp;&nbsp;&nbsp;: Retribusi Izin Gangguan<br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Indeks Izin Usaha &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$r->nm_lokasi.'<br />										                    				                        
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Kode Rekening&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama Rekening<br/>';
					
						$report .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						4.1.2.03.03&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Retribusi Izin gangguan<br/><br/><br/><br/>';
					
		$report .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Tanggal diterima uang : '.$tgl.'<br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br /><br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mengetahui, <br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bendahara Penerimaan&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pembayar/Penyetor<br />
					<br /><br /><br /><br/><br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					'.$petugas.'
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;									
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$sql->nama_pemilik.'<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;'.$nip.'<br />
					
					</td>
				</tr>
			</table>
			<font size="-3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Lembar Asli : Untuk Pembayaran/Pihak Ketiga/Penyetor
			Salinan 1 : Untuk Bendahara Penerima/Pembantu 
			Salinan 2 : Arsip</font>';
		
		//$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_SPTPD'.'.pdf', 'I');
	}
}