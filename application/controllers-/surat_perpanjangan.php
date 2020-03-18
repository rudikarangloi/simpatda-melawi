<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class surat_perpanjangan extends MY_Controller {
	
	function __construct() {
            parent::__construct();
    }
	
	public function index() {
		$data['pajak'] = $this->model_user->ukuh();
		$this->load->view('izin/perpanjangan',$data);
	}
	
	public function load_perusahaan($op="",$nilai="") {
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($op==1){
			$cu = "where a.npwpd_perusahaan like '%".$nilai."%'and left(a.npwpd_perusahaan,1)='4'";
		} else if($op==2){
			$cu = "where a.nama_perusahaan like '%".$nilai."%'and left(a.npwpd_perusahaan,1)='4'";
		} else if($op==3){
			$cu = "where b.nama_pemilik like '%".$nilai."%'and left(a.npwpd_perusahaan,1)='4'";
		}
		
		$qr = $this->db->query("SELECT a.id,a.npwpd_perusahaan, a.npwpd_lama, a.nama_perusahaan, a.alamat_perusahaan, a.rt, a.rw, a.email, a.kelurahan, c.nama_kelurahan, 
a.kecamatan, c.nama_kecamatan, a.kabupaten, a.telp, a.kodepos, b.npwpd_pemilik, b.nama_pemilik, b.alamat_pemilik, b.jalan AS jalan_p,
 b.rt AS rt_p, b.rw AS rw_p, b.email AS email_p, b.lokasi, b.desa_kel2, b.kecamatan AS kecamatan_p, b.kabupaten AS kabupaten_p, b.hp,
  b.kodepos, a.jenis_usaha, a.status_usaha, a.kategori, a.jml_karyawan, a.ukuran_tempat, a.surat_izin, a.no_surat, 
  DATE_FORMAT(a.tgl_surat,'%d/%m/%Y') AS tgl_surat, a.jenis_pajak, a.gol_pajak, DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') AS tgl_daftar,
  IFNULL(c.id,'00') AS idx, e.auto AS idauto
  FROM identitas_perusahaan a 
  LEFT JOIN identitas_pemilik b ON a.npwpd_pemilik = b.npwpd_pemilik 
  LEFT JOIN view_kelurahan c ON c.kode_kelurahan = RIGHT(a.npwpd_perusahaan,2) AND SUBSTRING(a.npwpd_perusahaan,16,2)=c.kode_kecamatan 
  LEFT JOIN master_rinci e ON e.id = LEFT(a.npwpd_perusahaan,1) AND SUBSTRING(a.npwpd_perusahaan,9,2) = e.kode_rek 
   $cu GROUP BY a.id");
		
		$i=1;
		foreach($qr->result() as $rs) {
			// cair
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$rs->id."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_lama."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->rt."]]></cell>");
					echo("<cell><![CDATA[".$rs->rw."]]></cell>");
					echo("<cell><![CDATA[".$rs->email."]]></cell>");
					echo("<cell><![CDATA[".$rs->kelurahan."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_kelurahan."]]></cell>");
					echo("<cell><![CDATA[".$rs->kecamatan."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_kecamatan."]]></cell>");
					echo("<cell><![CDATA[".$rs->kabupaten."]]></cell>");
					echo("<cell><![CDATA[".$rs->telp."]]></cell>");
					echo("<cell><![CDATA[".$rs->kodepos."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->jalan_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->rt_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->rw_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->email_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->lokasi."]]></cell>");
					echo("<cell><![CDATA[".$rs->desa_kel2."]]></cell>");
					echo("<cell><![CDATA[".$rs->kecamatan_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->kabupaten_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->hp."]]></cell>");
					echo("<cell><![CDATA[".$rs->kodepos."]]></cell>");
					echo("<cell><![CDATA[".$rs->jenis_usaha."]]></cell>");
					echo("<cell><![CDATA[".$rs->status_usaha."]]></cell>");
					echo("<cell><![CDATA[".$rs->kategori."]]></cell>");
					echo("<cell><![CDATA[".$rs->jml_karyawan."]]></cell>");
					echo("<cell><![CDATA[".$rs->ukuran_tempat."]]></cell>");
					echo("<cell><![CDATA[".$rs->surat_izin."]]></cell>");
					echo("<cell><![CDATA[".$rs->no_surat."]]></cell>");
					echo("<cell><![CDATA[".$rs->tgl_surat."]]></cell>");
					echo("<cell><![CDATA[".$rs->jenis_pajak."]]></cell>");
					echo("<cell><![CDATA[".$rs->gol_pajak."]]></cell>");
					echo("<cell><![CDATA[".$rs->tgl_daftar."]]></cell>");
					echo("<cell><![CDATA[".$rs->idx."]]></cell>");
					echo("<cell><![CDATA[".$rs->idauto."]]></cell>");					
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function cariData($ds="",$kata_kunci="",$parameter="") {
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		
		if($ds == '1'){
			$qr = "";
			if($kata_kunci != "0"):
				$qr = " where skpd.".$parameter." like '%".$kata_kunci."%'";
			endif;
		
			$grid->render_sql("select skpd.no_skpd, skpd.nota_hitung, skpd.npwpd, identitas_perusahaan.nama_perusahaan, identitas_perusahaan.alamat_perusahaan, skpd.tgl_jth_tempo, jumlah from skpd left join identitas_perusahaan on skpd.npwpd=identitas_perusahaan.npwpd_perusahaan $qr","id","no_skpd, nota_hitung, npwpd, nama_perusahaan, alamat_perusahaan, tgl_jth_tempo, jml");
		
		} else if($ds == '3'){
			$qr = "";
			if($kata_kunci != '0'):
				$qr = " where skpdkbt.".$parameter." like '%".$kata_kunci."%'";
			endif;
		
			$grid->render_sql("SELECT
skpdkbt.no_skpdkbt,
skpdkbt.nota,
skpdkbt.npwpd,
identitas_perusahaan.nama_perusahaan,
identitas_perusahaan.alamat_perusahaan,
skpdkbt.jatuh_tempo, total
FROM
identitas_perusahaan
INNER JOIN skpdkbt ON identitas_perusahaan.npwpd_perusahaan = skpdkbt.npwpd $qr","id","no_skpdkbt, nota, npwpd, nama_perusahaan, alamat_perusahaan, jatuh_tempo,total");
		
		} else if($ds == '4'){
			$qr = "";
			if($kata_kunci != '0'):
				$qr = " where skpdkb.".$parameter." like '%".$kata_kunci."%'";
			endif;
		
			$grid->render_sql("SELECT
skpdkb.no_skpdkb,
skpdkb.nota_hitung,
skpdkb.npwpd,
identitas_perusahaan.nama_perusahaan,
identitas_perusahaan.alamat_perusahaan,
skpdkb.tgl_tempo, jumlah
FROM
identitas_perusahaan
INNER JOIN skpdkb ON skpdkb.npwpd = identitas_perusahaan.npwpd_perusahaan $qr","id","no_skpdkb, nota_hitung, npwpd, nama_perusahaan, alamat_perusahaan, tgl_tempo,jumlah");
		
		} else if($ds == '2'){
			$qr = "";
			if($kata_kunci != '0'):
				$qr = " where stpd.".$parameter." like '%".$kata_kunci."%'";
			endif;
		
			$grid->render_sql("SELECT
stpd.no_stpd,
stpd.no_nota,
stpd.npwpd,
identitas_perusahaan.nama_perusahaan,
identitas_perusahaan.alamat_perusahaan,
stpd.tanggal_tempo, jumlah
FROM
identitas_perusahaan
INNER JOIN stpd ON stpd.npwpd = identitas_perusahaan.npwpd_perusahaan $qr","id","no_stpd, no_nota, npwpd, nama_perusahaan, alamat_perusahaan, tanggal_tempo,jumlah");
		
		}
	}
	
	function dataItemPajak1() {
		$s = $this->input->post('nota');
		
		$d = date('d/m/Y');
			
		//bulan+1
		$s = mktime(0,0,0,date("m")+1,date("d"),date("Y"));
		$t = date('d/m/Y',$s);
		
		$q = $d.";".$t;

		echo $q;
	}
	
	//---fadil
	public function simpan(){
		$data = array (
			'tgl_surat' 			=> strtoupper($this->input->post('tgl')),
			//'no_skpd' 			=> strtoupper($this->input->post('nomor')),
			//'tgl_sk' 			=> strtoupper($this->input->post('tgl_sk')),
			//'dasar_setoran' 			=> strtoupper($this->input->post('ds')),
			'npwpd' 			=> strtoupper($this->input->post('npwpd')),
			'tahun' 			=> date('Y'),
			'pemilik_pimpinan' 			=> $this->input->post('pemilik'),
			'tunggakan' 			=> $this->input->post('tunggakan'),
			'kewajiban'		=> $this->input->post('pajak'),
			//'tgl_jatuh_tempo' => strtoupper($this->input->post('tempo')),
			//'jumlah' => strtoupper($this->input->post('jumlah')),
			//'denda' => strtoupper($this->input->post('denda')),
			//'total' => strtoupper($this->input->post('total')),
			'author' 			=> strtoupper($this->session->userdata('username'))
		);
		if($this->input->post('id')==0){
			$tegur = $this->generateNo(date('Y'));
			$dataIns = array_merge($data,array('no_teguran' => $tegur, 'created' => date('Y-m-d H:i:s')));
			$this->db->insert('perpanjangan',$dataIns);
			
		} else {
			$tegur = $this->input->post('id');
			$dataUpd = array_merge($data,array('no_teguran' => $tegur, 'modified' => date('Y-m-d H:i:s')));
			$this->db->update('perpanjangan', $dataUpd, array('id_surat_tegur' => $this->input->post('id')));
		}
		echo $tegur;
	}
	
	public function generateNo($thn=""){
		$sql = $this->db->query("select MAX(no_teguran) as max from surat_tegur2 where tahun = '".$thn."'")->row();
		$r = $sql->max;
		if($r==NULL){
			$no = '000000001';
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
			$no = $jml;
		}
		return $no;
	}
	
	//-----fadil
	function cetak(){
		//$data = $this->db->query("")
		$data = $this->db->query("SELECT a.id,a.npwpd_perusahaan, a.npwpd_lama, a.nama_perusahaan, a.alamat_perusahaan, a.rt, a.rw, a.email, a.kelurahan, c.nama_kelurahan, 
a.kecamatan, c.nama_kecamatan, a.kabupaten, a.telp, a.kodepos, b.npwpd_pemilik, b.nama_pemilik, b.alamat_pemilik, b.jalan AS jalan_p,
 b.rt AS rt_p, b.rw AS rw_p, b.email AS email_p, b.lokasi, b.desa_kel2, b.kecamatan AS kecamatan_p, b.kabupaten AS kabupaten_p, b.hp,
  b.kodepos AS kod_p, a.jenis_usaha, a.status_usaha, a.kategori, a.jml_karyawan, a.ukuran_tempat, a.surat_izin, a.no_surat, 
  DATE_FORMAT(a.tgl_surat,'%d/%m/%Y') AS tgl_surat, a.jenis_pajak, a.gol_pajak, DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') AS tgl_daftar,
  IFNULL(c.id,'00') AS idx, e.auto AS idauto,SUBSTRING(a.npwpd_perusahaan,9,2) AS rek,d.pemilik_pimpinan,d.tunggakan,f.masa_pajak2,g.tema
  FROM identitas_perusahaan a 
  LEFT JOIN identitas_pemilik b ON a.npwpd_pemilik = b.npwpd_pemilik 
  LEFT JOIN view_kelurahan c ON c.kode_kelurahan = RIGHT(a.npwpd_perusahaan,2) AND SUBSTRING(a.npwpd_perusahaan,16,2)=c.kode_kecamatan
  LEFT JOIN perpanjangan d ON d.npwpd = a.npwpd_perusahaan 
  LEFT JOIN sptpd_reklame f ON a.npwpd_perusahaan=f.npwpd 
  LEFT JOIN sptpd_reklame_detail g ON f.no_sptpd=g.no_sptpd
  LEFT JOIN master_rinci e ON e.id = LEFT(a.npwpd_perusahaan,1) AND SUBSTRING(a.npwpd_perusahaan,9,2) = e.kode_rek where a.npwpd_perusahaan='".$_GET['npwpd']."'
  GROUP BY a.id")->row();
  
  $lokasi_reklame2 = "";
  $no_sptpd = $this->db->query("select no_sptpd from sptpd_reklame where npwpd = '".$_GET['npwpd']."' order by masa_pajak2 desc limit 0,1")->row();
  $lokasi_reklame = $this->db->query("select lokasi from sptpd_reklame_detail where no_sptpd = '".$no_sptpd->no_sptpd."'");
  $jumlah_lokasi = $lokasi_reklame->num_rows();
  $lokasi_reklame = $this->db->query("select lokasi from sptpd_reklame_detail where no_sptpd = '".$no_sptpd->no_sptpd."'");
  if($jumlah_lokasi ==1){
	  $lokasi_reklame = $this->db->query("select lokasi from sptpd_reklame_detail where no_sptpd = '".$no_sptpd->no_sptpd."'")->row();
	  $lokasi_reklame2 = $lokasi_reklame->lokasi;
  }else{
	  $hitung_reklame=0;
	  foreach($lokasi_reklame->result() as $ch) {
		  $hitung_reklame++;
		  if($hitung_reklame<$jumlah_lokasi){
			  $lokasi_reklame2 .= ", ".ucwords(strtolower($ch->lokasi));
		  }else{
			  $lokasi_reklame2 .= " dan ".ucwords(strtolower($ch->lokasi));
		  }
	  }
	  $lokasi_reklame2 = substr($lokasi_reklame2,2);
  }
  $lokasi_reklame = $lokasi_reklame2;
		
		$npwpd = $data->npwpd_perusahaan;
		$npwpd_lama = $data->npwpd_lama;
		$namus = $data->nama_perusahaan;
		$alus = strtolower($data->alamat_perusahaan);
		$rt = $data->rt;
		$rw = $data->rw;
		$kel = strtolower($data->nama_kelurahan);
		$kec = strtolower($data->nama_kecamatan);
		$kot = $data->kabupaten;
		$telus = $data->telp;
		$kodpos = $data->kodepos;
		$nampel = $data->nama_pemilik;
		$alpel = $data->alamat_pemilik;
		$rt_p = $data->rt_p;
		$rw_p = $data->rw_p;
		$kel_p = $data->desa_kel2;
		$kec_p = $data->kecamatan_p;
		$kot_p = $data->kabupaten_p;
		$tel_p = $data->hp;
		$kode = $data->kod_p;
		$jenis = $data->jenis_usaha;
		$status = $data->status_usaha;
		$jml_kar = $data->jml_karyawan;
		$tgl_daftar = $data->tgl_daftar;
		$izin = $data->surat_izin;
		$no_surat = $data->no_surat;
		$tgl_su = $data->tgl_surat;
		$gol = $data->gol_pajak;
		$mounth = $this->msistem->v_bln(date('m'));
		$year = date('Y');
		$rek = $data->rek;
		$pemilik = $data->pemilik_pimpinan;
		$pemilik = $data->pemilik_pimpinan;
		$tema = $data->tema;
		$masa = $data->masa_pajak2;
		$idd_tgl			= explode("-",$masa);
		$dd1				= $idd_tgl[0];
		$dd2				= $this->msistem->v_bln($idd_tgl[1]);
		$dd3				= $idd_tgl[2];
		
		$tgl_masa			= $dd3." ".$dd2." ".$dd1;
		
		if($pemilik=='1'){
			$pemilik= 'Pemilik'	;
			$pt = '';
		}else{
			$pemilik =  'Pimpinan';
			$pt = 'Perusahaan';
		}
		
		
		$tunggakan = $data->tunggakan;
		
		
		if($jenis=='1'){
			$nama = 'Hotel';
		} else if($jenis=='2'){
			$nama = 'Restoran';
		} else if($jenis=='3'){
			$nama = 'Hiburan';
		} else if($jenis=='4'){
			$nama = 'Reklame';
		} else if($jenis=='6'){
			$nama = 'Mineral Bukan Logam dan Batuan';
		} else if($jenis=='8'){
			$nama = 'Air Tanah';
		} else if($jenis=='7'){
			$nama = 'Parkir';
		} else if($jenis=='5'){
			$nama = 'Penerangan Jalan';
		}
		
		$query4 = $this->db->query("SELECT kd_rek,nm_rek,pajak,tarif_pajak FROM master_rekening WHERE pajak='".$jenis."' AND pajak_det='".$rek."'");
		$rsd = $query4->row();
		$namrek =strtolower($rsd->nm_rek);
		if($rsd->kd_rek=='4.1.1.01.12'){
			$namrek='<del>Losmen/Rmh.Penginapan /Pesangh/Motel/</del>Rmh.Kos';
		}
		$tarif = $rsd->tarif_pajak;
		
		$s1 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '1' ")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = strtoupper($s1->nama_ttd);
			$nip1 = $s1->nip_ttd;
			$jab1 = $s1->jabatan_ttd;
		}
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('P', 'pt', 'FOLIO', true, 'UTF-8', false); 
		
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_JAMBI');
		$pdf->SetKeywords('SOPD_JAMBI');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(10);
		$pdf->SetMargins(35,30,35);
		// set font yang digunakan
		$pdf->SetFont('times', '', 11);
	
		$pdf->AddPage('P','FOLIO',false);
		//set data
		//kop pemerintah
$pdf->SetXY(100, 40.5);
$pdf->SetFont('times', 'B', 15);
$pdf->Cell(0,0,'PEMERINTAH KOTA JAMBI',0,1,'C');

$pdf->Ln(0,0);
$pdf->SetX(100);
$pdf->SetFont('times', 'B',18);
$pdf->Cell(0,0,'BADAN PENGELOLA PAJAK DAN RETRIBUSI DAERAH',0,1,'C');
 
$pdf->Ln(0,0);
$pdf->SetX(100);
$pdf->SetFont('times','',11);
$pdf->Cell(0,0,'Jl. Jend. Basuki Rachmat Kota Baru Telepon. (0741) 40284 Fax. 40284',0,1,'C');

$pdf->Ln(0,0);
$pdf->SetFont('times','B',12);
$pdf->SetX(100);
$pdf->Cell(0,0,'J A M B I',0,1,'C');
$pdf->setFont('times','',12);
	
		//garis
$pdf->SetLineWidth(0);
$pdf->Line(10.5*2.834645669291,44*2.834645669291,205*2.834645669291,44*2.834645669291);
$pdf->SetLineWidth(2);
$pdf->Line(10.5*2.834645669291,43*2.834645669291,205*2.834645669291,43*2.834645669291);
		
		//gambar
		$pdf->Image('./images/Logo Daerah Jambi2.png', 9.5 *2.834645669291, 11*2.834645669291, 24*2.834645669291);
		
		
		$report = '';
		$report .=
			'<table border="0">
				<tr>
					<td>
						
					</td>
				</tr>
			</table>';
			
		$report .= '<table width="567" border="0">	
		
	<tr>
		  <td width="332" colspan="3"></td>
		  <td width="190" colspan="1" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><div align="left"><font size="11">Jambi,        '.$mounth.' '.$year.'.</font></div></td>	
  		</tr>
	<tr>
		  <td colspan="4"><br/></td>
  		</tr>
	<tr>
		<td width="20"></td>  
		<td colspan="3">
			<table width="385" border="0" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif">
				<tr style="line-height:100%;">
					<td width="55"><font size="11"></font>Nomor</td>
					<td width="190"><div align="left"><font size="11">: 	973/												/BPPRD.</font></div></td>
					<td width="67"></td>
					<td width="235"><div align="left"><font size="11">Kepada </font></div></td>
				</tr>
				<tr style="line-height:100%;">
					<td width="55"><font size="11"></font>Sifat</td>
					<td width="230"><div align="left"><font size="11"></font>: 	Penting.</div></td>	
					<td width="26"><div align="left"><font size="11">Yth.</font></div></td>
					<td width="235"><div align="left"><font size="11">'.$pemilik.' '.$namus.'</font></div></td>
				</tr>
				<tr style="line-height:100%;">
					<td width="55"><font size="11"></font>Lampiran</td>
					<td width="190"><div align="left"><font size="11">: 	-</font></div></td>	
					<td width="67"></td>
					<td width="235"><div align="left"><font size="11">'.ucwords($alus).' <br>Kel. '.ucwords($kel).' Kec. '.ucwords($kec).'</br></font></div></td>
				</tr>
				<tr style="line-height:100%;">
					<td width="55"><font size="11"></font>Hal</td>
					<td width="190"><div align="left"><font size="11">: 	<b><u>Perpanjangan Pajak Reklame.</u></b></font></div></td>	
					<td width="67"></td>
					<td width="235"><div align="left"><font size="11"><font size="11">di - <br/><font color="white">===</font><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;J A M B I</b></font></font></div></td>
					
				</tr>
				<tr>
					<td width="311" cosplan="3"></td>
					<td width="235"><div align="left"></div></td>
				</tr>
			</table>	
		</td>
  		</tr>
		
		<tr style="line-height:10%;">
					<td width="187" cosplan="3"></td>
					<td width="235"><div align="left"><font size="16" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"></font><br><font size="11"></br></font></div></td>
		</tr>
		
		
        <tr style="line-height:180%;">
			<td width="85"></td>
			<td width="433" colspan="3" align="justify" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="11"><font color="white">====</font>Sehubungan dengan telah berakhirnya masa pajak '.ucwords($namrek).' milik '.$pt.' Saudara dengan tema "'.$tema.'" yang berlokasi di '.$lokasi_reklame.' dengan <b>NPWPD '.$npwpd.'</b> pada tanggal <b>'.$tgl_masa.'.</b></font></td>
		</tr>
		
		<tr style="line-height:25%;">
			<td>
			</td>
		</tr>
		
		 <tr style="line-height:180%;">
			<td width="85"></td>
			<td width="433" colspan="3" align="justify" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="11"><font color="white">====</font>Berkaitan dengan hal tersebut diatas, untuk itu diminta kepada Saudara agar segera memperpanjang Pajak '.ucwords($namrek).' tersebut serta menyetorkan ke Bendahara Penerima Badan Pengelola Pajak dan Retribusi Daerah Kota Jambi <b>paling lambat 7 ( tujuh ) hari setelah surat ini diterima</b>, terlebih dahulu mengambil Surat Ketetapan Pajak Daerah (SKPD) melalui Bidang Pendaftaran, Pendataan dan Penetapan dan melampirkan <u>Foto Copy Mendirikan Bangunan Reklame (IMBR), Foto Copy KTP serta foto produk reklame '.$pt.' Saudara.</u> Apabila sampai batas waktu yang telah ditetapkan belum dilakukan perpanjangan atas pajak reklame tersebut, maka akan dikenakan sanksi administrasi sesuai perundangan-undangan yang berlaku.</font></td>
		</tr>
		
		<tr style="line-height:25%;">
			<td>
			</td>
		</tr>
				
		 <tr style="line-height:180%;">
			<td width="85"></td>
			<td width="433" colspan="3" align="justify" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="11"><font color="white">====</font>Demikian disampaikan untuk dapat dimaklumi, atas perhatian dan kerjasamanya diucapkan terima kasih.</font></td>
		</tr>
				<tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">&nbsp;</td>
  </tr>
		<tr>
			<td>
			</td>
		</tr>
      
		
        <tr>
			<td width="159">&nbsp;</td>
            <td width="83">&nbsp;</td>
           
            <td width="320" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><div align="center"><font size="11"><b>KEPALA BADAN</b></font></div></td>
		</tr>
        <tr>
			<td height="40" colspan="4">&nbsp;</td>
  </tr>
        <tr style="line-height:80%;">
			<td width="140">&nbsp;</td>
            <td width="94">&nbsp;</td>
            <td width="120">&nbsp;</td>
            <td width="200" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif, line-height: 1em"><div align="left"><font size="11"><b><u>SUBHI, S.Sos, MM</u></b></font></div></td>
		</tr>
		<tr style="line-height:80%;">
			<td width="140">&nbsp;</td>
            <td width="94">&nbsp;</td>
            <td width="120">&nbsp;</td>
            <td width="200" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif, line-height: 1em"><div align="left"><font size="11">Pembina Utama Muda</font></div></td>
		</tr>
        <tr style="line-height:80%;">
			<td width="140">&nbsp;</td>
			<td width="94">&nbsp;</td>
            <td width="120">&nbsp;</td>
            <td width="200" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif, line-height: 1em"><div align="left"><font size="11">NIP. '.$nip1.'</font></div></td>
		</tr>
		
	<tr style="line-height:80%;">
	<td></td>
	</tr>
	
	<tr>
			<td width="40"></td>
			<td colspan="3" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="11"><u>Tembusan, Yth :</u></font></td>
		</tr>
	<tr>
			<td width="40"></td>
			<td colspan="3" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="11">1.  Bapak Walikota Jambi (sebagai laporan).</font></td>
	</tr>
	<tr>
			<td width="40"></td>
			<td colspan="3" width="450" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="11">2.  Sdr. Kepala Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Kota Jambi.</font></td>
	</tr>
	<tr>
			<td width="40"></td>
			<td colspan="3" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="11">3.  Sdr. Kepala Satuan Polisi Pamong Praja Kota Jambi.</font></td>
	</tr>
		</table>';
			
		//$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Surat_Teguran_1'.'.pdf', 'I');
	}
	
	public function delete() {
		 $id = $this->input->post('no_teguran');
		 $npwpd = $this->input->post('npwpd');
		
		
		//$this->db->delete('surat_tegur2',array('no_teguran' => $this->input->post('npwpd')));
		/* if ($id=="" || $npwpd==""){
			
		}else{  */
			$sql = $this->db->query("DELETE FROM surat_tegur2 where npwpd='".$npwpd."' and no_teguran='".$id."'");
			/* if($sql){
				$result = 0;
			}else{
				$result = 1;
			}
		}  */
		$result = "Data Terhapus.";
		echo $result;
	}
	
	
	public function data() {
		$grid = new GridConnector($this->db->conn_id);
		//$grid->dynamic_loading(100); 
		$grid->render_sql("SELECT a.id_surat_tegur, a.no_teguran, a.npwpd, DATE_FORMAT(a.tgl_surat,'%d/%m/%Y') AS tgl_surat, b.nama_perusahaan, b.alamat_perusahaan, a.kewajiban,a.pemilik_pimpinan,a.tunggakan ,c.nama_sptpd AS jenis_usaha FROM perpanjangan a 
LEFT JOIN identitas_perusahaan b ON a.npwpd = b.npwpd_perusahaan
LEFT JOIN master_sptpd c ON c.id = b.jenis_usaha GROUP BY a.id_surat_tegur","id","id_surat_tegur, no_teguran, npwpd,tgl_surat, nama_perusahaan, alamat_perusahaan,pemilik_pimpinan");	
	}
	//-----fadil
	
	/* function loadData(){
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("SELECT
surat_tegur.id_surat_tegur,
surat_tegur.no_teguran,
DATE_FORMAT(surat_tegur.tgl_surat,'%d/%m/%Y') as tgl_surat,
surat_tegur.no_skpd,
DATE_FORMAT(surat_tegur.tgl_sk,'%d/%m/%Y') as tgl_sk,
surat_tegur.dasar_setoran,
surat_tegur.npwpd,
surat_tegur.tahun,
DATE_FORMAT(surat_tegur.tgl_jatuh_tempo,'%d/%m/%Y') as tgl_jatuh_tempo,
identitas_perusahaan.nama_perusahaan,
identitas_perusahaan.alamat_perusahaan,
surat_tegur.jumlah,
surat_tegur.denda,
surat_tegur.total
FROM
identitas_perusahaan
INNER JOIN surat_tegur ON surat_tegur.npwpd = identitas_perusahaan.npwpd_perusahaan","id_surat_tegur","id_surat_tegur, no_teguran, tgl_surat, no_skpd, npwpd, nama_perusahaan, alamat_perusahaan, dasar_setoran, tgl_sk, tahun, tgl_jatuh_tempo,jumlah,denda,total");
	} */
}
?>