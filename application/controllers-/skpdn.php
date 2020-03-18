<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class skpdn extends MY_Controller {
	
	function __construct() {
            parent::__construct();
    }
	
	public function index() {
		$this->load->view('penetapan/skpdn');
	}
	
	public function cariData($kata_kunci="",$parameter="") {	
		$qr = "";
		if($kata_kunci != '0'):
			$qr = " and nota_hitung.$parameter like '%$kata_kunci%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("select nota_hitung.no_nota, nota_hitung.sptpd, nota_hitung.npwpd, identitas_perusahaan.nama_perusahaan, identitas_perusahaan.alamat_perusahaan, nota_hitung.masa_pajak1, nota_hitung.masa_pajak2, nota_hitung.tahun, nota_hitung.jumlah from nota_hitung left join identitas_perusahaan on nota_hitung.npwpd=identitas_perusahaan.npwpd_perusahaan where nota_hitung.sk='6' $qr","id","no_nota, sptpd, npwpd, nama_perusahaan, alamat_perusahaan, masa_pajak1, masa_pajak2, tahun, jumlah");
	}
	
	public function simpan(){
		$data = array (
			'nota_hitung' 			=> strtoupper($this->input->post('nota')),
			'tgl' 			=> $this->input->post('tgl'),
			'npwpd' 			=> strtoupper($this->input->post('npwpd')),
			'kd_rek' 			=> strtoupper($this->input->post('kd_rek')),
			'nm_rek' 			=> strtoupper($this->input->post('nm_rek')),
			'dasar_pengenaan' 			=> strtoupper($this->input->post('dasar_pengenaan')),
			'pajak_terhutang' 			=> strtoupper($this->input->post('pajak_terhutang')),
			'tgl_tempo' 			=> $this->input->post('tgl_tempo'),
			'kompensasi' 			=> strtoupper($this->input->post('kompensasi')),
			'setoran' 			=> strtoupper($this->input->post('setoran')),
			'lain2' 			=> strtoupper($this->input->post('lain')),
			'pokok' 			=> strtoupper($this->input->post('pokok')),
			'bunga' 			=> strtoupper($this->input->post('bunga')),
			'kenaikan' 			=> strtoupper($this->input->post('kenaikan')),
			'tahun'		=> date('Y'),
			'author' 			=> strtoupper($this->session->userdata('username'))
		);
		
		if($this->input->post('id')==0){
			$skpdn = $this->generateNo(date('Y'));
			$dataIns = array_merge($data,array('no_skpdn' => $skpdn, 'created' => date('Y-m-d H:i:s')));
			$this->db->insert('skpdn',$dataIns);
			$result = $skpdn;
		} else {
			$skpdn = $this->input->post('skpdn');
			$dataUpd = array_merge($data,array('no_skpdn' => $skpdn, 'modified' => date('Y-m-d H:i:s')));
			$this->db->update('skpdn', $dataUpd, array('id' => $this->input->post('id')));
			$result = $skpdn;
		}
		echo $result;
	}
	
	public function generateNo($thn=""){
		$sql = $this->db->query("select MAX(no_skpdn) as max from skpdn where tahun = '".$thn."'");
		$r = $sql->row();
		if($r==NULL){
			$no = '000000001';
		} else {
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
			$no = $jml;
		}
		return $no;
	}
	
	function mainData(){
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("SELECT skpdn.id,
skpdn.nota_hitung,
skpdn.no_skpdn,
DATE_FORMAT(skpdn.tgl,'%d/%m/%Y') as tgl,
skpdn.npwpd,
skpdn.kd_rek,
skpdn.nm_rek,
skpdn.dasar_pengenaan,
skpdn.pajak_terhutang,
DATE_FORMAT(skpdn.tgl_tempo,'%d/%m/%Y') as tgl_tempo,
skpdn.kompensasi,
skpdn.setoran,
skpdn.lain2,
skpdn.pokok,
skpdn.bunga,
skpdn.kenaikan,
identitas_perusahaan.nama_perusahaan,
identitas_perusahaan.alamat_perusahaan
FROM
skpdn
INNER JOIN identitas_perusahaan ON identitas_perusahaan.npwpd_perusahaan = skpdn.npwpd","id","id, nota_hitung, no_skpdn, tgl, npwpd, nama_perusahaan, alamat_perusahaan, kd_rek, nm_rek, dasar_pengenaan,pajak_terhutang,tgl_tempo, kompensasi,setoran,lain2,pokok,bunga,kenaikan");	
}
	
	function test(){
		$this->ds = $this->load->database('alternate',true);
		$nm = 'ARI';

		$r = $this->ds->query('select * from admin where nama like "%'.$nm.'%"')->row();
		$sql = $r->id;
			
		$this->db = $this->load->database('default',true);
		$sq = $this->db->query('jenis_usaha where id_usaha="'.$sql.'"')->row();
		$ss = $sq->nm_usaha;
		
		$gabung = $sql.' dan '.$ss;
			echo $gabung;

	}
	
	public function cetak() {
		$s = $this->input->post('no_skpdn');
		
		$data = $this->db->query("SELECT skpdn.id, skpdn.nota_hitung, skpdn.no_skpdn, DATE_FORMAT(skpdn.tgl,'%d/%m/%Y') as tgl, skpdn.npwpd, skpdn.kd_rek,
skpdn.nm_rek, skpdn.dasar_pengenaan, skpdn.pajak_terhutang, DATE_FORMAT(skpdn.tgl_tempo,'%d/%m/%Y') as tgl_tempo, skpdn.kompensasi, skpdn.setoran, skpdn.lain2, skpdn.pokok, skpdn.bunga, skpdn.kenaikan, view_perusahaan.nama_perusahaan, view_perusahaan.alamat_perusahaan, view_perusahaan.nama_pemilik,
view_perusahaan.alamat_pemilik FROM skpdn INNER JOIN view_perusahaan ON view_perusahaan.npwpd_perusahaan = skpdn.npwpd WHERE skpdn.no_skpdn='".$_GET['no_skpdn']."'")->row();
		$no 				= $data->no_skpdn;
		$npwpd 				= $data->npwpd;
		$nama 				= $data->nama_perusahaan;
		$alamat 			= $data->alamat_perusahaan;
		$namper				= $data->nama_pemilik;
		$tg = explode('/',$data->tgl);
		$awal				= $this->msistem->v_bln($tg[1]);
		$akhir 				= $this->msistem->v_bln($tg[1]);
		$tahun 				= $tg[2];
		$ket				= '';
		//$total				= number_format($data->total,2,",",".");
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
		$report .=
			'<table border=1>
				<tr>
					<td width="230" align="center">
						PEMERINTAH KABUPATEN SIGI<br />
						DINAS PENDAPATAN PENGELOLAAN KEUANGAN DAN ASET DAERAH<br />
						Jalan Poros PALU - Telp (0655) 7006013<br />
						Fax (0655)7551162,7551165<br />
						PALOLO
					</td>
					<td width="230" align="center">
						SURAT KETERANGAN PAJAK DAERAH<br />
						NIHIL<br />
						Masa Pajak&nbsp;&nbsp;:&nbsp;&nbsp;'.$awal.' - '.$akhir.'<br />
						Tahun&nbsp;&nbsp;:&nbsp;&nbsp;'.$tahun.'
					</td>
					<td width="112" align="center">
						<br /><br />
						No. SKPD<br />
						'.$no.'
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
				</table>
				</td>
				</tr>
			</table>';
			
		$report .=
			'<table border="1">
				<tr>
					<td>
					<table border="0">
    <tr>
    	<td width="20" valign="top">&nbsp;&nbsp;1.</td>
        <td colspan="6" width="550">Berdasarkan Pasal 9 undang-undang No. 18 Tahun 1997 telah dilakukan penelitian dan/atau pemeriksaan atau keterangan lain atas pelaksanaan kewajiban</td>
    </tr>
    <tr>
    	<td width="20">&nbsp;</td>
        <td colspan="3">Nomor Rekening</td>
        <td width="24" align="center">:</td>
        <td colspan="2">&nbsp;&nbsp;'.$data->kd_rek.'</td>
    </tr>
    <tr>
    	<td width="20">&nbsp;</td>
        <td colspan="3">Nama Rekening</td>
         <td width="24" align="center">:</td>
        <td colspan="2">&nbsp;&nbsp;'.$data->nm_rek.'</td>
    </tr>
	<tr>
    	<td width="20" valign="top">&nbsp;&nbsp;2.</td>
        <td colspan="6" width="550">Dari penelitian dan/atau pemeriksaan tersebut diatas, perhitungan jumlah yang masih harus dibayar adalah sebagai berikut :</td>
    </tr>
    <tr>
    	<td width="20">&nbsp;</td>
        <td width="24">1.</td>
        <td colspan="2" width="250">Dasar Pengenaan</td>
        <td width="24">&nbsp;</td>
        <td align="right" width="100">Rp.</td>
        <td align="right" width="100">'.$data->dasar_pengenaan.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td width="20">&nbsp;</td>
      <td width="24">2.</td>
      <td colspan="2" width="250">Pajak yang terhutang</td>
      <td width="24">&nbsp;</td>
      <td align="right" width="100">Rp.</td>
      <td align="right" width="100">'.$data->pajak_terhutang.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
    	<td width="20">&nbsp;</td>
        <td width="24">3.</td>
        <td colspan="5">Kredit Pajak :</td>
    </tr>
    <tr>
    	<td colspan="2" width="44">&nbsp;</td>
        <td width="20">a.</td>
        <td width="230">Kompensasi kelebihan dari tahun sebelumnya</td>
        <td width="24">Rp.</td>
        <td align="right" width="100">'.$data->kompensasi.'&nbsp;&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="2" width="44">&nbsp;</td>
        <td width="20">b.</td>
        <td width="230">Setoran yang dilakukan</td>
        <td width="24">Rp.</td>
        <td align="right" width="100">'.$data->setoran.'&nbsp;&nbsp;</td>
        <td width="109">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" width="44">&nbsp;</td>
      <td width="20">c.</td>
      <td width="230">Lain - lain</td>
      <td width="24">Rp.</td>
      <td align="right" width="100">'.$data->lain2.'&nbsp;&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" width="44">&nbsp;</td>
      <td width="20">d.</td>
      <td width="230">STP (Pokok)</td>
      <td width="24">Rp.</td>
      <td align="right" width="100">'.$data->pokok.'&nbsp;&nbsp;</td>
      <td>&nbsp;</td>
    </tr>';
	
	$jumlah_kredit = $data->kompensasi+$data->setoran+$data->lain2+$data->pokok;
	
$report .=	
    '<tr>
      <td colspan="2" width="44">&nbsp;</td>
      <td width="20">e.</td>
      <td width="230">Jumlah pajak yang dapat dikreditkan (a + b + c + d)</td>
      <td width="24">&nbsp;</td>
      <td align="right" width="100">Rp.&nbsp;</td>
      <td align="right" width="100">'.$jumlah_kredit.'&nbsp;</td>
    </tr>';
	
	$jumlah_lebih = $data->pajak_terhutang-$jumlah_kredit;
	
$report .=
    '<tr>
      <td width="20">&nbsp;</td>
      <td width="24">4.</td>
      <td colspan="2" width="250">Jumlah kelebihan pembayaran Pokok Pajak (2 - 3e)</td>
      <td width="24">&nbsp;</td>
      <td align="right" width="100">Rp.</td>
      <td align="right" width="100">'.$jumlah_lebih.'&nbsp;&nbsp;</td>
    </tr>
    </table>
					</td>
				</tr>
				</table>';
				
			$report .=
				'<table border="1">
					<tr>
						<td>
						<table border="0">
							<tr>
								<td width="90" height="20">&nbsp;&nbsp;Dengan huruf</td>
								<td width="10" align="center">:</td>
								<td width="420">&nbsp;&nbsp;</td>
							</tr>
						</table>
						</td>
					</tr>
				</table>';
				
			$report .=
				'<table border="1">
					<tr>
						<td>
						<table border="0">
  <tr>
    <td colspan="2">&nbsp;&nbsp;<u>P E R H A T I A N</u></td>
  </tr>
    <tr>
      <td width="20" valign="top">&nbsp;&nbsp;1.</td>
      <td width="550">Harap penyetoran dilakukan pada Bendaraha Penerimaan Dinas Pendapatan Daerah / Bank dengan menggunakan Surat Setoran Pajak Daerah (SSPD)</td>
    	</tr>
    <tr>
      <td width="20" valign="top">&nbsp;&nbsp;2.</td>
      <td width="550">Apabila SPTPD ini tidak atau kurang dibayar setelah lewat waktu paling lama 30 hari setelah SPTPD ini diterima akan dikenakan sanksi administrasi berupa bunga sebesar 2% per bulan</td>
    	</tr>
    </table>
						</td>
					</tr>
				</table>';
				
			$report .=
			'<table border="1">
				<tr>
				<td>
				<table border="0">
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">Meulaboh, '.$tanggal.'</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">a.n. KEPALA DINAS PENDAPATAN DAERAH</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">ACEH BARAT</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">KABID PENDAPATAN DAN PENETAPAN</td>
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