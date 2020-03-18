<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class tegur_skpd2 extends MY_Controller {
	
	function __construct() {
            parent::__construct();
    }
	
	public function index() {
		$data['pajak'] = $this->model_user->ukuh();
		$this->load->view('peneguran/tegur_skpd3',$data);
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
			'nomor_teguran' 			=> $this->input->post('nomor'),
			'kewajiban'		=> $this->input->post('pajak'),
			//'tgl_jatuh_tempo' => strtoupper($this->input->post('tempo')),
			//'jumlah' => strtoupper($this->input->post('jumlah')),
			//'denda' => strtoupper($this->input->post('denda')),
			//'total' => strtoupper($this->input->post('total')),
			'author' 			=> strtoupper($this->session->userdata('username'))
		);
		if($this->input->post('id')==0){
			if($this->input->post('ukuh') == "") $no_tegur = $this->generateNo(date('Y'));
			else $no_tegur = $this->input->post('ukuh');
			$dataIns = array_merge($data,array('no_teguran' => $no_tegur, 'created' => date('Y-m-d H:i:s')));
			$this->db->insert('surat_tegur2',$dataIns);
			//get id
			$query = $this->db->query("SELECT id_surat_tegur FROM surat_tegur2 WHERE no_teguran = '$no_tegur' AND tahun = '".date('Y')."'");
			$row = $query->row();
			$id_surat_tegur = $row->id_surat_tegur;
		} else {
			$id_surat_tegur = $this->input->post('id');
			$dataUpd = array_merge($data,array('modified' => date('Y-m-d H:i:s'), 'no_teguran' => $this->input->post('ukuh')));
			$this->db->update('surat_tegur2', $dataUpd, array('id_surat_tegur' => $this->input->post('id')));
			$no_tegur = $this->input->post('ukuh');
		}
		echo $id_surat_tegur."|".$no_tegur;
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
  DATE_FORMAT(d.tgl_surat,'%d/%m/%Y') AS tgl_surat, a.jenis_pajak, a.gol_pajak, DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') AS tgl_daftar,
  IFNULL(c.id,'00') AS idx, e.auto AS idauto,SUBSTRING(a.npwpd_perusahaan,9,2) AS rek,d.pemilik_pimpinan,d.tunggakan,d.nomor_teguran
  FROM identitas_perusahaan a 
  LEFT JOIN identitas_pemilik b ON a.npwpd_pemilik = b.npwpd_pemilik 
  LEFT JOIN view_kelurahan c ON c.kode_kelurahan = RIGHT(a.npwpd_perusahaan,2) AND SUBSTRING(a.npwpd_perusahaan,16,2)=c.kode_kecamatan
  LEFT JOIN surat_tegur2 d ON d.npwpd = a.npwpd_perusahaan 
  LEFT JOIN master_rinci e ON e.id = LEFT(a.npwpd_perusahaan,1) AND SUBSTRING(a.npwpd_perusahaan,9,2) = e.kode_rek 
  WHERE d.id_surat_tegur='".$_GET['id_surat_tegur']."'
  GROUP BY a.id")->row();
                
                
                
		$npwpd = $data->npwpd_perusahaan;
		$npwpd_lama = $data->npwpd_lama;
		$namus = $data->nama_perusahaan;
		$alus = $data->alamat_perusahaan;
		$rt = $data->rt;
		$rw = $data->rw;
		$kel = $data->nama_kelurahan;
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
		if($pemilik=='1'){
			$pemilik= 'Pemilik'	;		
		}else{
			$pemilik =  'Pimpinan';
		}
		$tunggakan = $data->tunggakan;
		$nomor = $data->nomor_teguran;
		$dday = explode("/",$tgl_su);
		$ddthn1 = $dday[2];
		$ddbln2 = $this->msistem->v_bln($dday[1]);
		$ddtgl3 = $dday[0];
		 if($nomor==null){
			$nomor1="         ";
		}else{
			$nomor1=$nomor;
		} 
		
		if($ddtgl3 =='00'){
			$ddtgl33="   ";
		}else{
			$ddtgl33=$ddtgl3;
		}
		
		if($jenis=='1'){
			$nama = 'Hotel';
			$penetapan='Self';
		} else if($jenis=='2'){
			$nama = 'Restoran';
			$penetapan='Self';
		} else if($jenis=='3'){
			$nama = 'Hiburan';
			$penetapan='Self';
		} else if($jenis=='4'){
			$nama = 'Reklame';
			$penetapan='Office';
		} else if($jenis=='6'){
			$nama = 'Mineral Bukan Logam dan Batuan';
			$penetapan='Self';
		} else if($jenis=='8'){
			$nama = 'Air Tanah';
			$penetapan='Office';
		} else if($jenis=='7'){
			$nama = 'Parkir';
			$penetapan='Self';
		} else if($jenis=='5'){
			$nama = 'Penerangan Jalan';
			$penetapan='Self';
		}
		
		
		
		
		$query4 = $this->db->query("SELECT kd_rek,nm_rek,pajak,tarif_pajak FROM master_rekening WHERE pajak='".$jenis."' AND pajak_det='".$rek."'");
		$rsd = $query4->row();
		$namrek =strtolower($rsd->nm_rek);
		$tarif = $rsd->tarif_pajak;
		
		if($rsd->kd_rek=='4.1.1.01.12'){
			$namrek='Rmh.Kos';
		}
		if($jenis=='8'){
			$namrek1='';
		}else{
			$namrek1="(".$namrek.")";
		}
		
		$s1 = $this->db->query("SELECT nama_ttd,nip_ttd,jabatan_ttd FROM master_tanda_tangan WHERE id = '1' ")->row();
		if($s1==NULL){
			$nama1 = '';
			$nip1 = '';
		} else {
			$nama1 = strtoupper($s1->nama_ttd);
			$nip1 = $s1->nip_ttd;
			$jab1 = $s1->jabatan_ttd;
		}
		
		if($penetapan=='Self'){
			$cetak = 'Adapun hutang pajak '.strtolower($nama).' '.$namrek1.' Saudara/i untuk bulan '.$tunggakan.' berdasarkan Sistem Pemungutan Pajak secara '.$penetapan.' Assesment, Wajib Pajak menyampaikan penerimaan pendapatan usaha yang sebenar-benarnya, dalam hal wajib pajak tidak melaksanakan kewajiban dapat dikenakan sanksi sebagaimana yang telah diatur dalam Peraturan Daerah Kota Jambi Nomor 5 Tahun 2011 Tentang Pajak Daerah sebagaimana telah diubah dengan Peraturan Daerah Kota Jambi Nomor 7 Tahun 2016 yang tercantum dalam Pasal 100 ayat (2) yang berbunyi "Wajib Pajak yang dengan sengaja tidak menyampaikan SPTPD atau mengisi dengan tidak lengkap atau melampirkan keterangan yang tidak benar sebagaimana dimaksud dalam Pasal 68 sehingga merugikan keuangan Daerah dapat dipidana dengan pidana penjara paling lama 2 (dua) tahun atau pidana denda paling banyak 4 (empat) kali jumlah pajak terutang yang tidak atau kurang bayar".';
		}else{
			$cetak = 'Adapun hutang pajak '.strtolower($nama).' '.$namrek1.' Saudara/i untuk bulan '.$tunggakan.' berdasarkan Sistem Pemungutan Pajak secara jabatan ('.$penetapan.' Assesment) Badan Pengelola Pajak dan Retribusi Daerah menghitung dan menetapkan besarnya pajak terhutang yang akan dibayarkan oleh wajib pajak sebagaimana telah diatur dalam Peraturan Daerah Kota Jambi Nomor 5 Tahun 2011 Tentang Pajak Daerah sebagaimana telah diubah dengan Peraturan Daerah Kota Jambi Nomor 7 Tahun 2016 yang tercantum dalam Pasal 67 ayat (1) dan Pasal 100 ayat (2) yang berbunyi "Wajib Pajak yang dengan sengaja tidak menyampaikan SPTPD atau mengisi dengan tidak lengkap atau melampirkan keterangan yang tidak benar sebagaimana dimaksud dalam Pasal 68 sehingga merugikan keuangan Daerah dapat dipidana dengan pidana penjara paling lama 2 (dua) tahun atau pidana denda paling banyak 4 (empat) kali jumlah pajak terutang yang tidak atau kurang bayar".';
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
$pdf->SetXY(100, 20.5);
$pdf->SetFont('times', 'B', 15);
$pdf->Cell(0,0,'PEMERINTAH KOTA JAMBI',0,1,'C');

$pdf->Ln(0,0);
$pdf->SetX(100);
$pdf->SetFont('times', 'B',18);
$pdf->Cell(0,0,'BADAN PENGELOLA PAJAK DAN RETRIBUSI DAERAH',0,1,'C');
 
$pdf->Ln(0,0);
$pdf->SetX(100);
$pdf->SetFont('times','',11);
$pdf->Cell(0,0,'Jl. Jend. Basuki Rachmat Kota Baru Telepon. (0741) 40284 Fax. 40284 email : bpprd.jambikota@gmail.com',0,1,'C');

$pdf->Ln(0,0);
$pdf->SetFont('times','B',12);
$pdf->SetX(100);
$pdf->Cell(0,0,'J A M B I',0,1,'C');
$pdf->setFont('times','',12);
	
		//garis
$pdf->SetLineWidth(0);
$pdf->Line(10.5*2.834645669291,38*2.834645669291,205*2.834645669291,38*2.834645669291);
$pdf->SetLineWidth(2);
$pdf->Line(10.5*2.834645669291,37*2.834645669291,205*2.834645669291,37*2.834645669291);
		
		//gambar
		$pdf->Image('./images/Logo Daerah Jambi2.png', 9.5 *2.834645669291, 8*2.834645669291, 24*2.834645669291);
		
		
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
		  <td width="312" colspan="3"></td>
		  <td width="190" colspan="1" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><div align="left"><font size="11">Jambi,  '.$ddtgl33.' '.$mounth.' '.$year.'.</font></div></td>	
  		</tr>
	<tr>
		  <td colspan="4"><br/></td>
  		</tr>
	<tr>
		<td width="20"></td>  
		<td colspan="3">
			<table width="385" border="0" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif">
				<tr style="line-height:100%;">
					<td width="50"><font size="11"></font></td>
					<td width="190"><div align="left"><font size="11"></font></div></td>
					<td width="52"></td>
					<td width="235"><div align="left"><font size="11">Kepada :</font></div></td>
				</tr>
				<tr style="line-height:100%;">
					<td width="50"><font size="11"></font></td>
					<td width="190"><div align="left"><font size="11"></font></div></td>	
					<td width="30"></td>
					<td width="235"><div align="left"><font size="11">Yth. Sdr/i. '.$nampel.'.</font></div></td>
				</tr>
				<tr style="line-height:100%;">
					<td width="50"><font size="11"></font></td>
					<td width="190"><div align="left"><font size="11"></font></div></td>	
					<td width="52"></td>
					<td width="235"><div align="left"><font size="11">'.$pemilik.' '.$namus.'.</font></div></td>
				</tr>
				<tr style="line-height:100%;">
					<td width="50"><font size="11"></font></td>
					<td width="190"><div align="left"><font size="11"></font></div></td>	
					<td width="52"></td>
					<td width="235"><div align="left"><font size="11">'.ucwords($alus).' <br>Kel. '.$kel.' Kec. '.ucwords($kec).'</br></font></div></td>
					
				</tr>
				<tr>
					<td width="292" cosplan="3"></td>
					<td width="235"><div align="left"><font size="11">di - <br/><font color="white">===</font><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;J A M B I</b></font></div></td>
				</tr>
			</table>	
		</td>
  		</tr>
		
				<tr>
			<td width="65"></td>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
					<td width="187" cosplan="3"></td>
					<td width="235"><div align="left"><font size="16" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><u><b>SURAT TEGURAN I</b></u></font><br><font size="11" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif,Helvetica Neue,Helvetica,sans-serif">&nbsp;&nbsp;Nomor   : 973/'.$nomor1.'/BPPRD.</br></font></div></td>
				</tr>
		<tr>
			<td>
			</td>
		</tr>
		
        <tr>
			<td width="40"></td>
			<td width="489" colspan="3" align="justify" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="11"><font color="white">====</font>Diberitahukan kepada Saudara/i bahwa berdasarkan pembukuan kami usaha '.$namrek.' Saudara/i mempunyai hutang pajak terhitung dari bulan '.$tunggakan.' dengan NPWPD '.$npwpd.'.</font></td>
		</tr>
		
		<tr style="line-height:25%;">
			<td>
			</td>
		</tr>
		
		 <tr>
			<td width="40"></td>
			<td width="489" colspan="3" align="justify" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="11"><font color="white">====</font>'.$cetak.'</font></td>
		</tr>
		
		<tr style="line-height:25%;">
			<td>
			</td>
		</tr>
				
		<tr>
			<td width="40"></td>
			<td width="489" colspan="3" align="justify" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="11"><font color="white">====</font>Sehubungan dengan hal tersebut diatas, diminta kepada Saudara/i agar segera menyetorkan hutang pajak tersebut paling lambat 7 (tujuh) hari sejak surat ini diterima ke Bendahara Penerima Badan Pengelola Pajak dan Retribusi Daerah Kota Jambi dengan terlebih dahulu mengambil Surat Ketetapan Pajak Daerah (SKPD) melalui Bidang Pendaftaran, Pendataan dan Penetapan.</font></td>
		</tr>	
		
		<tr style="line-height:25%;">
			<td>
			</td>
		</tr>
		
		 <tr>
			<td width="40"></td>
			<td width="489" colspan="3" align="justify" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="11"><font color="white">====</font>Demikian Surat ini disampaikan untuk menjadi perhatian, atas kepeduliannya diucapkan terima kasih.</font></td>
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
			<td>
			</td>
		</tr>
		
        <tr>
			<td width="159">&nbsp;</td>
            <td width="57">&nbsp;</td>
           
            <td width="320" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><div align="center"><font size="11"><b>KEPALA BADAN</b></font></div></td>
		</tr>
        <tr>
			<td height="40" colspan="4">&nbsp;</td>
  </tr>
        <tr style="line-height:80%;">
			<td width="110">&nbsp;</td>
            <td width="94">&nbsp;</td>
            <td width="120">&nbsp;</td>
            <td width="200" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif, line-height: 1em"><div align="left"><font size="11"><b><u>SUBHI, S.Sos, MM</u></b></font></div></td>
		</tr>
		<tr style="line-height:80%;">
			<td width="110">&nbsp;</td>
            <td width="94">&nbsp;</td>
            <td width="120">&nbsp;</td>
            <td width="200" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif, line-height: 1em"><div align="left"><font size="11"><b>Pembina Utama Muda</b></font></div></td>
		</tr>
        <tr style="line-height:80%;">
			<td width="110">&nbsp;</td>
			<td width="94">&nbsp;</td>
            <td width="120">&nbsp;</td>
            <td width="200" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif, line-height: 1em"><div align="left"><font size="11"><b>NIP. '.$nip1.'</b></font></div></td>
		</tr>
		
		</table>';
                
                $pdf->writeHTML($report, true, false, true, false);
                

                //Tembusan
                $pdf->SetX(78);
                $pdf->SetFont('helvetica','U',11);
                $pdf->Cell(0,0,"Tembusan, Yth :",false,true,'L');
                $pdf->SetFont('helvetica','',11);
                $tembusan_wali = $_GET['tmbs_wali'];
                $tembusan_inspektorat = $_GET['tmbs_insp'];
                $tembusan_satpol_pp = $_GET['tmbs_satpp'];
                $tembusan = array();
                $isi_tembusan = "";
                if($tembusan_wali == "true") array_push($tembusan,"Bapak Walikota Jambi (sebagai laporan).");
		if($tembusan_inspektorat == "true") array_push($tembusan,"Sdr. Inspektur Kota Jambi di Jambi.");
                if($tembusan_satpol_pp == "true") array_push($tembusan,"Sdr. Kepala Satuan Polisi Pamong Praja Kota Jambi di Jambi.");
                
                if(count($tembusan) == 1){
                    $pdf->SetX(78);
                    $isi_tembusan = $tembusan[0];
                    $pdf->Cell(0,0,$isi_tembusan,false,false,'L');
                }else{
                    $isi_tembusan = "<ol>";
                    for($i=0;$i<count($tembusan);$i++){                        
                        $pdf->SetX(78);
                        $pdf->Cell(16,0,($i+1).".",false,false,"L");
                        $pdf->Cell(0,0,$tembusan[$i],false,true,"L");
                    }
                }
                
                
                //$pdf->Cell($lebar,$tinggi,$teks,false,false,'L');
			
		//$pdf->writeHTML($report, true, 0, true, 0);
		
		$pdf->lastPage();
		$pdf->Output('Surat_Teguran_1'.'.pdf', 'I');
	}
	
	public function delete() {
		$id = $this->input->post('id');
		$npwpd = $this->input->post('npwpd');
		
		if ($id=="" || $npwpd==""){
			$result = "";
		}else{ 
			$sql = $this->db->query("DELETE FROM surat_tegur2 where id_surat_tegur='".$id."'");
			if($sql){
				$result = "";
			}else{
				$result = "";
			}
		}

		echo $result;
	}
	
	
	public function data() {
		$grid = new GridConnector($this->db->conn_id);
		//$grid->dynamic_loading(100); 
		
		/* $grid->render_sql("SELECT a.id_surat_tegur, a.no_teguran,a.nomor_teguran, a.npwpd, DATE_FORMAT(a.tgl_surat,'%d/%m/%Y') AS tgl_surat, b.nama_perusahaan, b.alamat_perusahaan, a.kewajiban,a.pemilik_pimpinan,a.tunggakan ,c.nama_sptpd AS jenis_usaha FROM surat_tegur2 a 
LEFT JOIN identitas_perusahaan b ON a.npwpd = b.npwpd_perusahaan
LEFT JOIN master_sptpd c ON c.id = b.jenis_usaha GROUP BY a.id_surat_tegur","id","id_surat_tegur, no_teguran,nomor_teguran, npwpd,tgl_surat, nama_perusahaan, alamat_perusahaan, kewajiban,pemilik_pimpinan,tunggakan, jenis_usaha"); */	

		 $grid->render_sql("SELECT surat_tegur2.`id_surat_tegur`, surat_tegur2.`no_teguran`,surat_tegur2.nomor_teguran, surat_tegur2.`npwpd`, surat_tegur2.`tgl_surat`, identitas_perusahaan.`nama_perusahaan`, identitas_perusahaan.`alamat_perusahaan`, surat_tegur2.`kewajiban`,
surat_tegur2.`pemilik_pimpinan`, surat_tegur2.`tunggakan`, master_sptpd.`nama_sptpd` AS jenis_usaha 
FROM surat_tegur2, identitas_perusahaan, master_sptpd 
WHERE surat_tegur2.`npwpd` = identitas_perusahaan.`npwpd_perusahaan` AND SUBSTR(surat_tegur2.`npwpd`,1,1) = master_sptpd.`id`","id","id_surat_tegur, no_teguran,nomor_teguran, npwpd,tgl_surat, nama_perusahaan, alamat_perusahaan, kewajiban,pemilik_pimpinan,tunggakan, jenis_usaha");	 
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