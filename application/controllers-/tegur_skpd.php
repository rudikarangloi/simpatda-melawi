<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class tegur_skpd extends MY_Controller {
	
	function __construct() {
            parent::__construct();
    }
	
	public function index() {
		$data['pajak'] = $this->model_user->ukuh();
		$this->load->view('peneguran/tegur_skpd2',$data);
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
			//'tgl_surat' 			=> strtoupper($this->input->post('tgl')),
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
			$this->db->insert('surat_tegur',$dataIns);
			
		} else {
			$tegur = $this->input->post('id');
			$dataUpd = array_merge($data,array('no_teguran' => $tegur, 'modified' => date('Y-m-d H:i:s')));
			$this->db->update('surat_tegur', $dataUpd, array('id_surat_tegur' => $this->input->post('id')));
		}
		echo $tegur;
	}
	
	public function generateNo($thn=""){
		$sql = $this->db->query("select MAX(no_teguran) as max from surat_tegur where tahun = '".$thn."'")->row();
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
  IFNULL(c.id,'00') AS idx, e.auto AS idauto,SUBSTRING(a.npwpd_perusahaan,9,2) AS rek,d.pemilik_pimpinan,d.tunggakan
  FROM identitas_perusahaan a 
  LEFT JOIN identitas_pemilik b ON a.npwpd_pemilik = b.npwpd_pemilik 
  LEFT JOIN view_kelurahan c ON c.kode_kelurahan = RIGHT(a.npwpd_perusahaan,2) AND SUBSTRING(a.npwpd_perusahaan,16,2)=c.kode_kecamatan
  LEFT JOIN surat_tegur d ON d.npwpd = a.npwpd_perusahaan 
  LEFT JOIN master_rinci e ON e.id = LEFT(a.npwpd_perusahaan,1) AND SUBSTRING(a.npwpd_perusahaan,9,2) = e.kode_rek where a.npwpd_perusahaan='".$_GET['npwpd']."'
  GROUP BY a.id")->row();
		
		$npwpd = $data->npwpd_perusahaan;
		$npwpd_lama = $data->npwpd_lama;
		$namus = $data->nama_perusahaan;
		$alus = $data->alamat_perusahaan;
		$rt = $data->rt;
		$rw = $data->rw;
		$kel = $data->nama_kelurahan;
		$kec = $data->nama_kecamatan;
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
		$namrek = $rsd->nm_rek;
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('P', 'pt', 'LEGAL', true, 'UTF-8', false); 
		
			
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
	
		$pdf->AddPage('P','LEGAL',false);
		//set data
		
		//kop pemerintah
		$pdf->SetXY(100, 20.5);
		$pdf->SetFont('times', 'B', 16);
		$pdf->Cell(0,0,'PEMERINTAH KOTA JAMBI',0,1,'C');

		$pdf->Ln(0,0);
		$pdf->SetX(100);
		$pdf->SetFont('times', 'B',25);
		$pdf->Cell(0,0,'DINAS PENDAPATAN',0,1,'C');
 
		$pdf->Ln(0,0);
		$pdf->SetX(100);
		$pdf->SetFont('times','',11);
		$pdf->Cell(0,0,'Jl. Jend. Basuki Rachmat Kota Baru Telepon. (0741) 40284 Fax. 40284 email : dipenda@jambikota.go.id',0,1,'C');

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
			<td>
			</td>
		</tr>
	<tr>
		  <td width="312" colspan="3"></td>
		  <td width="190" colspan="1" style="font-family: arial"><div align="left"><font size="12">Jambi,        '.$mounth.' '.$year.'.</font></div></td>	
  		</tr>
	<tr>
		  <td colspan="4"><br/></td>
  		</tr>
	<tr>
		<td width="20"></td>  
		<td colspan="3">
			<table width="385" border="0" style="font-family: arial">
				<tr>
					<td width="50"><font size="12">Nomor</font></td>
					<td width="190"><div align="left"><font size="12"> : 973 /         / Dipenda.</font></div></td>
					<td width="52"></td>
					<td width="235"><div align="left"><font size="12">Kepada :</font></div></td>
				</tr>
				<tr>
					<td width="50"><font size="12">Sifat</font></td>
					<td width="190"><div align="left"><font size="12"> : Penting.</font></div></td>	
					<td width="30"></td>
					<td width="235"><div align="left"><font size="12">Yth. Sdr/i. '.$nampel.'.</font></div></td>
				</tr>
				<tr>
					<td width="50"><font size="12">Lampiran</font></td>
					<td width="190"><div align="left"><font size="12"> : -</font></div></td>	
					<td width="52"></td>
					<td width="235"><div align="left"><font size="12">'.$pemilik.' '.$namus.'.</font></div></td>
				</tr>
				<tr>
					<td width="50"><font size="12">Hal</font></td>
					<td width="190"><div align="left"><font size="12"> : <b>Pemberitahuan Tunggakan</b><br>&nbsp;&nbsp;<u><b>Pajak '.$nama.' / '.$namrek.'</b></u></br></font></div></td>	
					<td width="52"></td>
					<td width="235"><div align="left"><font size="12">'.$alus.' RT. '.$rt.' Kel. '.$kel.' <br>Kec. '.$kec.'</br></font></div></td>
					
				</tr>
				<tr>
					<td width="292" cosplan="3"></td>
					<td width="235"><div align="left"><font size="12">di - <br/><font color="white">===</font><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;J A M B I</b></font></div></td>
				</tr>
			</table>	
		</td>
  		</tr>
		
				<tr>
			<td width="65"></td>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td>
			</td>
		</tr>
		
		
        <tr >
			<td width="82"></td>
			<td width="400" colspan="3" align="justify" style="font-family: arial"><font size="12"><font color="white">======</font>Dengan ini kami sampaikan, bahwa objek pajak atas usaha Saudara/i antara lain sebagai berikut :</font></td>
		</tr>
		<tr style="line-height:30%;">
			<td>
			</td>
		</tr>
		
		 <tr >
			<td width="44"></td>
			<td width="400" colspan="3" align="justify" style="font-family: arial"><font size="12"><font color="white">======</font>Jenis Pajak											:	 Pajak '.$nama.'</font></td>
		</tr>
				
		<tr>
			<td width="44"></td>
			<td width="400" colspan="3" align="justify" style="font-family: arial"><font size="12"><font color="white">======</font>Objek Pajak									:		'.$namus.' <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$alus.' RT.'.$rt.'</br></font></td>
		</tr>
		
		<tr>
			<td width="44"></td>
			<td width="400" colspan="3" align="justify" style="font-family: arial"><font size="12"><font color="white">======</font>Tunggakan								&nbsp;		:		'.$tunggakan.'</font></td>
		</tr>
		
		<tr>
			<td width="44"></td>
			<td width="400" colspan="3" align="justify" style="font-family: arial"><font size="12"><font color="white">======</font>NPWPD															:		'.$npwpd.'</font></td>
		</tr>
		<tr style="line-height:50%;">
			<td>
			</td>
		</tr>
		 <tr>
			<td width="82"></td>
			<td width="400" colspan="3" align="justify" style="font-family: arial"><font size="12"><font color="white">======</font>Telah memasuki masa jatuh tempo, oleh karena itu kami sampaikan agar Saudara/i segera melakukan perlunasan terhadap objek pajak tersebut di atas selambat lambatnya 7 (tujuh) hari sejak surat ini diterima.</font></td>
		</tr>
		<tr style="line-height:50%;">
			<td>
			</td>
		</tr>
		 <tr>
			<td width="82"></td>
			<td width="400" colspan="3" align="justify" style="font-family: arial"><font size="12"><font color="white">======</font>Demikian pemberitahuan ini disampaikan, diucapkan terima kasih untuk menjadi perhatian Saudara/i dan kerjasamanya.</font></td>
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
			<td>
			</td>
		</tr>
        <tr>
			<td width="159">&nbsp;</td>
            <td width="69">&nbsp;</td>
           
            <td width="320" align="center" style="font-family: arial"><div align="center"><font size="12"><b>KEPALA DINAS</b></font></div></td>
		</tr>
        <tr>
			<td height="40" colspan="4">&nbsp;</td>
  </tr>
        <tr>
			<td width="159">&nbsp;</td>
            <td width="94">&nbsp;</td>
            <td width="90">&nbsp;</td>
            <td width="200" align="center" style="font-family: arial, line-height: 1em"><div align="left"><font size="12"><b><u>SUBHI, S.Sos, MM</u></b></font></div></td>
		</tr>
	<tr>
			<td width="159">&nbsp;</td>
            <td width="94">&nbsp;</td>
            <td width="90">&nbsp;</td>
            <td width="200" align="center" style="font-family: arial, line-height: 1em"><div align="left"><font size="12"><b>Pembina Utama Muda</b></font></div></td>
		</tr>
        <tr>
			<td width="159">&nbsp;</td>
	    <td width="94">&nbsp;</td>
            <td width="90">&nbsp;</td>
            <td width="200" align="center" style="font-family: arial, line-height: 1em"><div align="left"><font size="12"><b>NIP. 19630820 198603 1 009</b></font></div></td>
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
			<td>
			</td>
		</tr>
	<tr>
			<td width="20"></td>
			<td colspan="3" style="font-family: arial"><font size="12"><u>Tembusan, Yth :</u></font></td>
		</tr>
	<tr>
			<td width="20"></td>
			<td colspan="3" style="font-family: arial"><font size="12">Bapak Walikota Jambi (sebagai laporan).</font></td>
		</tr>
		</table>';
			
		//$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Surat_Pemberitahuan'.'.pdf', 'I');
	}
	
	public function delete() {
		$id = $this->input->post('id_surat_tegur');
		$npwpd = $this->input->post('npwpd');
		
		/* if ($id=="" || $npwpd==""){
			$result = 0;
		}else{ */
			$sql = $this->db->query("DELETE FROM surat_tegur where npwpd='".$npwpd."' and id_surat_tegur='".$id."'");
			/* if($sql){
				$result = 1;
			}else{
				$result = 0;
			}
		}

		echo $result; */
	}
	
	
	public function data() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("SELECT a.id_surat_tegur, a.no_teguran, a.npwpd, b.nama_perusahaan, b.alamat_perusahaan, a.kewajiban,a.pemilik_pimpinan,a.tunggakan ,c.nama_sptpd AS jenis_usaha FROM surat_tegur a 
LEFT JOIN identitas_perusahaan b ON a.npwpd = b.npwpd_perusahaan
LEFT JOIN master_sptpd c ON c.id = b.jenis_usaha GROUP BY a.id_surat_tegur","id","id_surat_tegur, no_teguran, npwpd, nama_perusahaan, alamat_perusahaan, kewajiban,pemilik_pimpinan,tunggakan, jenis_usaha");	
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