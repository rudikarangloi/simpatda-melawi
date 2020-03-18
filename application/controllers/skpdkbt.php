<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class skpdkbt extends MY_Controller {
	
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
		$data['tgl'] = date('d/m/Y');
		$data['tahun'] = $this->msistem->tahun();
		$data['jenis'] = $this->db->get('master_sptpd')->result();
		$this->load->view('penetapan/skpdkbt',$data);
	}
	
	function item_skpdkbt(){
		$grid = new GridConnector($this->db->conn_id);
		if(isset($_GET['skpdkbt'])) {
			$grid->render_sql("select kd_rek,nm_rek,dp,tarif,kenaikan,denda,kompensasi,bunga,jumlah,no_skpdkbt from skpdkbt_detail where no_skpdkbt = '".$_GET['skpdkbt']."'","id","kd_rek,nm_rek,dp,tarif,kenaikan,denda,kompensasi,bunga,jumlah,no_skpdkbt");
		} else {
			$grid->render_table("skpdkbt_detail","id","kd_rek,nm_rek,dp,tarif,kenaikan,denda,kompensasi,bunga,jumlah,no_skpdkbt");
		}
	}
	
	function child2(){
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_table("skpdkbt_detail","id","kd_rek, nm_rek, dp, tarif, kenaikan, denda, kompensasi, bunga, jumlah, no_skpdkbt");
	}
	
	function child_skpdkbt(){
		$grid = new GridConnector($this->db->conn_id);
		if(isset($_GET['skpdkbt'])) {
			$grid->render_sql("select kd_rek,nm_rek,dp,tarif,kenaikan,denda,kompensasi,bunga,jumlah,no_skpdkbt from skpdkbt_detail where no_skpdkbt = '".$_GET['skpdkbt']."'","id","kd_rek,nm_rek,dp,tarif,kenaikan,denda,kompensasi,bunga,jumlah,no_skpdkbt");
		}
	}
	
	function getDataItem() {
		$so = $this->input->post('nota');
		
		$we = $this->db->query("select setoran from sspd where nota_hitung='".$so."'")->row();
		if($we==NULL){
			$total_setoran = 0;
		} else {
			$total_setoran = $we->setoran;	
		}
			
			//now
			$d = date('d/m/Y');
			
			//bulan+1
			$s = mktime(0,0,0,date("m")+1,date("d"),date("Y"));
			$t = date('d/m/Y',$s);
		
			$w = $this->db->query("select sum(dp) as dp, sum(jumlah) as jumlah from nhp_child where no_nota='".$so."'")->row();
			
			$ketetapan = $w->dp;
			$jumlah = $w->jumlah;
			
			$super = $ketetapan."|".$total_setoran."|".$d."|".$t."|".$jumlah;

		echo $super;
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
			$sp = '';
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
					echo("<cell><![CDATA[".$sp."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	        function simpan(){            
            date_default_timezone_set('Asia/Jakarta');
			
			$upd = array(
				'status' => 1
			);
			
			$this->db->update('nota_hitung',$upd,array('no_nota' => $_POST['nota']));
			                                                          
            $data = array(			
                        'nota'         => $_POST['nota'],
                        'npwpd'         => $_POST['npwpd'],
                        'masa_pajak1' => $_POST['awal'],
                        'masa_pajak2' => $_POST['akhir'],
                        'tahun'         => $_POST['tahun'],
                        'jatuh_tempo'          => strftime("%Y-%m-%d", strtotime($_POST['tempo'])),
                        'setoran'        => $_POST['setoran'],
                        'dasar_pajak'         => $_POST['dasar_pajak'],
                        'no_sptpd'       => $_POST['no_sptpd'],
                        'tanggal'         => strftime("%Y-%m-%d", strtotime($_POST['tgl'])),
                        'jumlah'        => $_POST['jumlah'],                       
                        'kenaikan' => $_POST['kenaikan'],
                        'denda'         => $_POST['denda'],
                        'kompensasi'  => $_POST['kompensasi'],
                        'total'         => $_POST['total'],
                        'kode_sptpd'         => $_POST['kode']
            );
                
                $user = $this->session->userdata('username');                
                
                $this->db->trans_begin();
		
		if($_POST['edit']!=1){
			$thn = date('Y');
            $no_skpdkbt = $this->generateNo($_POST['tahun'],$_POST['kode']);
			$dataIns = array_merge($data,array('no_skpdkbt' =>  $no_skpdkbt, 'created' => date('Y-m-d H:i:s'), 'user_created'=>$user));
			$result = $this->db->insert('skpdkbt', $dataIns);
		} else {
			$no_skpdkbt = $this->input->post('skpdkbt_1')."/".$this->input->post('skpdkbt_2');
			$this->db->delete('skpdkbt_detail',array('no_skpdkbt' => $no_skpdkbt));
			$dataUpdate = array_merge($data,array('user_modified' => $user,'modified' => date('Y-m-d H:i:s')));
			$result = $this->db->update('skpdkbt',$dataUpdate,array('no_skpdkbt' => $no_skpdkbt));
		}
                
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                    echo $no_skpdkbt;
                }
        }
        
        public function generateNo($thn,$kode) {
		$sql = $this->db->query("select MAX(SUBSTRING_INDEX(no_skpdkbt,'/',1)) as max from skpdkbt where tahun = '".$thn."'");
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
		return $jml.'/'.$kode.'/'.substr($thn,2,2);
	}
	
	function delete() {
		$no_skpdkbt = $this->input->post('id');
		$s = $this->db->query("select count(id) as jml from sspd where no_skpd='".$no_skpdkbt."'")->row();
		$we = $s->jml; 
		if($we==0){
			$this->db->delete('no_skpdkb',array('no_skpdkbt' => $no_skpdkbt));
			$result = "Data SKPDKBT berhasil dihapus.";
		} else {
			$result = "Silakan Menghapus Data SSPD Terlebih Dahulu";
		}
		echo $result;
	}
	
	public function cariData($kata_kunci="",$parameter="",$kode_sptpd="") {	
		$qr = "";
		if($kata_kunci != '0'):
			$qr = " and nota_hitung.$parameter like '%$kata_kunci%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("select nota_hitung.no_nota, nota_hitung.sptpd, nota_hitung.npwpd, identitas_perusahaan.nama_perusahaan, identitas_perusahaan.alamat_perusahaan, nota_hitung.masa_pajak1, nota_hitung.masa_pajak2, nota_hitung.tahun, nota_hitung.jumlah from nota_hitung left join identitas_perusahaan on nota_hitung.npwpd=identitas_perusahaan.npwpd_perusahaan where nota_hitung.sk='4' and nota_hitung.nama_sptpd = '".$kode_sptpd."' $qr","id","no_nota, sptpd, npwpd, nama_perusahaan, alamat_perusahaan, masa_pajak1, masa_pajak2, tahun, jumlah");
//NO NOTA,TGL,NPWPD,NO SPTPD,NAMA WP,ALAMAT WP,NAMA BU,ALAMAT BU,MASA PAJAK1,MASA PAJAK2,TAHUN
}

function LoadData($kode=""){
			$grid = new GridConnector($this->db->conn_id);
			$grid->render_sql("SELECT a.*, b.nama_perusahaan, b.alamat_perusahaan FROM skpdkbt a left join identitas_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.kode_sptpd='".$kode."'","id","id
,no_skpdkbt
,nota
,npwpd
,masa_pajak1
,masa_pajak2
,tahun
,jatuh_tempo
,setoran
,dasar_pajak
,no_sptpd
,tanggal
,jumlah
,kenaikan
,denda
,kompensasi
,total
,nama_perusahaan
,alamat_perusahaan
			");	
}

	public function cetak(){
		$list = $this->db->query("SELECT
skpdkbt.id,
skpdkbt.no_skpdkbt,
skpdkbt.nota,
skpdkbt.npwpd,
skpdkbt.masa_pajak1,
skpdkbt.masa_pajak2,
skpdkbt.tahun,
skpdkbt.jatuh_tempo,
skpdkbt.setoran,
skpdkbt.dasar_pajak,
skpdkbt.no_sptpd,
skpdkbt.tanggal,
skpdkbt.jumlah,
skpdkbt.kenaikan,
skpdkbt.denda,
skpdkbt.kompensasi,
skpdkbt.total,
skpdkbt.kode_sptpd,
view_perusahaan.nama_pemilik,
view_perusahaan.alamat_pemilik,
view_perusahaan.nama_perusahaan,
view_perusahaan.alamat_perusahaan
FROM
skpdkbt
INNER JOIN view_perusahaan ON skpdkbt.npwpd = view_perusahaan.npwpd_perusahaan WHERE skpdkbt.no_skpdkbt='".$_GET['no_skpdkbt']."'")->row();
		$no 				= $list->no_skpdkbt;
		$npwpd 				= $list->npwpd;
		$nama 				= $list->nama_perusahaan;
		$alamat 			= $list->alamat_perusahaan;
		$namper				= $list->nama_pemilik;
		$awal				= $this->msistem->v_bln($list->masa_pajak1);
		$akhir 				= $this->msistem->v_bln($list->masa_pajak2);
		$tahun 				= $list->tahun;
		$ket				= '';
		$total				= number_format($list->jumlah,2,",",".");
		$huruf				= '';
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
		
		if($list->total==0){
			$title = 'NIHIL';
			$kode = 'SKPDN';
		} else {
			$title = 'KURANG BAYAR TAMBAHAN';
			$kode = 'SKPDKBT';
		}
		
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
						SURAT KETERANGAN PAJAK DAERAH<br />
						'.$title.'<br />
						Masa Pajak&nbsp;&nbsp;:&nbsp;&nbsp;'.$awal.' - '.$akhir.'<br />
						Tahun&nbsp;&nbsp;:&nbsp;&nbsp;'.$tahun.'
					</td>
					<td width="92" align="center">
						<br /><br />
						No. '.$kode.'<br />
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
					<td width="170">&nbsp;&nbsp;30 hari setelah SPTPD ini diterima</td>
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
			
		$child = $this->db->query('select kd_rek, nm_rek,dp,jumlah from skpdkbt_detail where no_skpdkbt ="'.$no.'"')->row();
		$dp = number_format($child->dp,2,",",".");
		$hutang1 = $child->jumlah;
		$hutang = number_format($hutang1,2,",",".");
		
		$kompensasi1 = $list->kompensasi;
		$kompensasi = number_format($kompensasi1,2,",",".");
		
		$setoran1 = $list->setoran;
		$setoran = number_format($setoran1,2,",",".");
		
		$lain1 = 0;
		$lain = number_format($lain1,2,",",".");
		
		$pajak1 = $setoran1+$kompensasi1+$lain1;
		$pajak = number_format($pajak1,2,",",".");
		
		$kekurangan1 = $hutang1-$pajak1;
		$kekurangan = number_format($kekurangan1,2,",",".");
		
		$sanksi = number_format(0,2,",",".");
		
		$total = number_format($list->total,2,",",".");		
		$terbilang = $this->msistem->baca($list->total);
		$report .=
			'<table border="1">
				<tr>
					<td width="572">
					<table border="0">
	<tr>
		<td colspan="7">&nbsp;</td>
	</tr>
    <tr>
    	<td width="20" valign="top">&nbsp;&nbsp;1.</td>
        <td colspan="6" width="550">Berdasarkan Pasal 9 undang-undang No. 18 Tahun 1997 telah dilakukan penelitian dan/atau pemeriksaan atau keterangan lain atas pelaksanaan kewajiban</td>
    </tr>
    <tr>
    	<td width="20">&nbsp;</td>
        <td colspan="3">Nomor Rekening</td>
        <td width="24" align="center">:</td>
        <td colspan="2">&nbsp;&nbsp;'.$child->kd_rek.'</td>
    </tr>
    <tr>
    	<td width="20">&nbsp;</td>
        <td colspan="3">Nama Rekening</td>
         <td width="24" align="center">:</td>
        <td colspan="2">&nbsp;&nbsp;'.$child->nm_rek.'</td>
    </tr>
	<tr>
		<td colspan="7">&nbsp;</td>
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
        <td align="right" width="100">'.$dp.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td width="20">&nbsp;</td>
      <td width="24">2.</td>
      <td colspan="2" width="250">Pajak yang terhutang</td>
      <td width="24">&nbsp;</td>
      <td align="right" width="100">Rp.</td>
      <td align="right" width="100">'.$hutang.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
    	<td width="20">&nbsp;</td>
        <td width="24">3.</td>
        <td colspan="5">Kredit Pajak :</td>
    </tr>
    <tr>
    	<td colspan="2" width="44">&nbsp;</td>
        <td width="20">a.</td>
        <td width="230">Kompensasi tahun sebelumnya</td>
        <td width="24">Rp.</td>
        <td align="right" width="100">'.$kompensasi.'&nbsp;&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="2" width="44">&nbsp;</td>
        <td width="20">b.</td>
        <td width="230">Setoran Masa yang dilakukan</td>
        <td width="24">Rp.</td>
        <td align="right" width="100">'.$setoran.'&nbsp;&nbsp;</td>
        <td width="109">&nbsp;</td>
    </tr>
	<tr>
    	<td colspan="2" width="44">&nbsp;</td>
        <td width="20">c.</td>
        <td width="230">Lain-lain</td>
        <td width="24">Rp.</td>
        <td align="right" width="100">'.$lain.'&nbsp;&nbsp;</td>
        <td width="109">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" width="44">&nbsp;</td>
      <td width="20">d.</td>
      <td width="230">Jumlah pajak yang dikreditkan</td>
      <td width="24">Rp.</td>
      <td align="right" width="100">'.$pajak.'&nbsp;&nbsp;</td>
      <td>+&nbsp;</td>
    </tr>
   	<tr>
      <td width="20">&nbsp;</td>
      <td width="24">4.</td>
      <td colspan="2" width="250">Jumlah kekurangan pembayaran Pokok Pajak</td>
      <td width="24">&nbsp;</td>
      <td align="right" width="100">Rp.</td>
      <td align="right" width="100">'.$kekurangan.'&nbsp;&nbsp;</td>
    </tr>
	<tr>
      <td width="20">&nbsp;</td>
      <td width="24">4.</td>
      <td colspan="2" width="250">Sanksi administrasi</td>
      <td width="24">&nbsp;</td>
      <td align="right" width="100">Rp.</td>
      <td align="right" width="100">'.$sanksi.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td width="20">&nbsp;</td>
      <td width="24">6.</td>
      <td colspan="2" width="250">Jumlah Pajak yang masih harus dibayar</td>
      <td width="24">&nbsp;</td>
      <td align="right" width="100">Rp.</td>
      <td align="right" width="100">'.$total.'&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="7">&nbsp;</td>
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
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td width="90" height="20">&nbsp;&nbsp;Dengan huruf</td>
								<td width="10" align="center">:</td>
								<td width="420">'.$terbilang.'</td>
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
		<td colspan="9">&nbsp;</td>
	</tr>
    <tr>
    	<td colspan="9">&nbsp;&nbsp;<u>P E R H A T I A N</u></td>
    </tr>
    <tr>
    	<td width="20" valign="top">&nbsp;&nbsp;</td>
        <td width="550">Pengembalian Kelebihan Pajak dilakukan pada Kas Daerah dengan menggunakan Surat Perintah Membayar Kelebihan Pajak (SPMKP) dan Surat Perintah Mengeluarkan Uang (SPMU).</td>
    </tr>
	<tr>
		<td colspan="9">&nbsp;</td>
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
						<td width="200" align="center">Meulaboh, '.$tanggal.'</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">KABID PENDAPATAN</td>
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
						<td width="200" align="center">'.$nip1.'</td>
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