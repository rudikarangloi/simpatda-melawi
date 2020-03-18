<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class ssrd extends MY_Controller {
	
	public function pangkat(){
		$c = exp(2*log(1));
		echo $c;
	}
	
	public function index() {
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$data['tgl'] = date('d/m/Y');
        $data['dop'] = $this->db->query("SELECT id_izin,nm_izin FROM master_izin");
        $data['lok_kawa'] = $this->db->query('SELECT id_kawasan,nm_kawasan FROM lokasi_kawasan');
       	$data['lokasi_pasar'] =$this->db->query("SELECT kode,concat(kode, ' | ',nm_lokasi) as nm_lokasi FROM lokasi_pasar  ORDER BY kode ");        
        $data['tahun'] = $this->msistem->tahun();
		$data['jenis'] = $this->db->get('master_sptpd')->result();
        
        
		$this->load->view('data/ssrd',$data);
	}
	
	public function lihat() {
		$s = $this->input->post('npwpd');
		
		$w = $this->db->query("select nama_perusahaan,alamat_perusahaan from view_perusahaan where npwpd_perusahaan='".$s."'")->row();
		if($w==NULL){
			$q = 0;
		} else {	
			$nama = $w->nama_perusahaan;
			$alamat = $w->alamat_perusahaan;
				
			$q = $nama."|".$alamat;
		}
		echo $q;
	}
        
public function cariData($dasar="",$parameter="",$kata_kunci="") {	
	
	if($dasar=='1'){	
		if($parameter=='1'){
			$qr = " and a.npwpd like '%".$kata_kunci."%'";
		} else if($parameter=='2'){
			$qr = " and b.nama_pemilik like '%".$kata_kunci."%'";
		} else if($parameter=='3'){
			$qr = " and b.nama_perusahaan like '%".$kata_kunci."%'";
		} 
        else if($parameter=='4'){
			$qr = " and a.no_skrd like '%".$kata_kunci."%'";
		}
			$grid = new GridConnector($this->db->conn_id);
			$grid->dynamic_loading(100); 
			$grid->render_sql("SELECT a.no_skrd, a.npwpd, a.masa_pajak1, a.masa_pajak2, a.tahun, a.tahun2,
             a.jumlah, b.nama_pemilik, b.alamat_pemilik, b.nama_perusahaan, b.alamat_perusahaan,
              a.no_sptrd, c.no_nota AS nota_hitung, DATE_FORMAT(a.tgl_jth_tempo,'%d/%m/%Y') AS tgl,
               a.lokasi_pasar,a.indeks_kawasan,a.indeks_gangguan,a.volume FROM skrd a
                LEFT JOIN view_perusahaan b ON a.npwpd=b.npwpd_perusahaan 
		         LEFT JOIN nota_hitung_ret c ON c.sptrd = a.no_sptrd
                  WHERE a.status ='0' $qr",
                   "no_sptrd","no_skrd, npwpd, nama_perusahaan, alamat_perusahaan,nama_pemilik, 
                     alamat_pemilik, masa_pajak1, masa_pajak2, tahun, tahun2, jumlah, no_sptrd, nota_hitung, tgl, lokasi_pasar,
                      indeks_kawasan, indeks_gangguan, volume");			
	} else if($dasar=='2'){
		if($parameter=='1'){
			$qr = " and a.npwpd like '%".$kata_kunci."%'";
		} else if($parameter=='2'){
			$qr = " and b.nama_pemilik like '%".$kata_kunci."%'";
		} else if($parameter=='3'){
			$qr = " and b.nama_perusahaan like '%".$kata_kunci."%'";
		}
			$grid = new GridConnector($this->db->conn_id);
			$grid->dynamic_loading(100); 
			$grid->render_sql("select a.no_sptrd, a.npwpd, a.masa_pajak1, a.masa_pajak2,
             a.tahun, a.jumlah, b.nama_pemilik, b.alamat_pemilik, b.nama_perusahaan, b.alamat_perusahaan,
              a.no_sptrd, a.no_sptrd, DATE_FORMAT(a.tanggal,'%d/%m/%Y') as tgl from sptrd a left join 
              view_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.status ='0' $qr","no_sptrd",
              "no_sptrd, npwpd, masa_pajak1, masa_pajak2, tahun, jumlah, nama_pemilik, alamat_pemilik,
               nama_perusahaan, alamat_perusahaan, no_sptrd, no_sptrd,tgl");
		
	} else if($dasar=='3'){
		if($parameter=='1'){
			$qr = " and a.npwpd like '%".$kata_kunci."%'";
		} else if($parameter=='2'){
			$qr = " and b.nama_pemilik like '%".$kata_kunci."%'";
		} else if($parameter=='3'){
			$qr = " and b.nama_perusahaan like '%".$kata_kunci."%'";
		}
			$grid = new GridConnector($this->db->conn_id);
			$grid->dynamic_loading(100); 
			$grid->render_sql("select a.no_stpd, a.npwpd, a.masa_pajak1, a.masa_pajak2, a.tahun, a.jumlah,
             b.nama_pemilik, b.alamat_pemilik, b.nama_perusahaan, b.alamat_perusahaan, a.no_sptpd, 
             DATE_FORMAT(a.tanggal_tempo,'%d/%m/%Y') as tgl from stpd a left join view_perusahaan b
             on a.npwpd=b.npwpd_perusahaan where a.status ='0' $qr","no_sptpd","no_stpd, npwpd, masa_pajak1, masa_pajak2, tahun, jumlah, nama_pemilik, alamat_pemilik, nama_perusahaan, alamat_perusahaan, no_sptpd, tgl");
		
	} else if($dasar=='4'){
		if($parameter=='1'){
			$qr = " and a.npwpd like '%".$kata_kunci."%'";
		} else if($parameter=='2'){
			$qr = " and b.nama_pemilik like '%".$kata_kunci."%'";
		} else if($parameter=='3'){
			$qr = " and b.nama_perusahaan like '%".$kata_kunci."%'";
		}
			$grid = new GridConnector($this->db->conn_id);
			$grid->dynamic_loading(100); 
			$grid->render_sql("select a.no_skpdkbt, a.npwpd, a.masa_pajak1, a.masa_pajak2, a.tahun, a.jumlah, b.nama_pemilik, b.alamat_pemilik, b.nama_perusahaan, b.alamat_perusahaan, a.no_sptpd, a.nota, DATE_FORMAT(a.jatuh_tempo,'%d/%m/%Y') as tgl from skpdkbt a left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.status ='0' $qr","no_sptpd","no_skpdkbt, npwpd, masa_pajak1, masa_pajak2, tahun, jumlah, nama_pemilik, alamat_pemilik, nama_perusahaan, alamat_perusahaan, no_sptpd, nota, tgl");
		
	} else if($dasar=='5'){
		if($parameter=='1'){
			$qr = " and a.npwpd like '%".$kata_kunci."%'";
		} else if($parameter=='2'){
			$qr = " and b.nama_pemilik like '%".$kata_kunci."%'";
		} else if($parameter=='3'){
			$qr = " and b.nama_perusahaan like '%".$kata_kunci."%'";
		}
			$grid = new GridConnector($this->db->conn_id);
			$grid->dynamic_loading(100); 
			$grid->render_sql("select a.no_skpdkb, a.npwpd, a.masa_pajak1, a.masa_pajak2,
             a.tahun, a.jumlah, b.nama_pemilik, b.alamat_pemilik, b.nama_perusahaan, b.alamat_perusahaan,
              a.no_sptpd, a.nota_hitung, DATE_FORMAT(a.tgl_tempo,'%d/%m/%Y') as tgl from skpdkb a 
              left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.status ='0'
               $qr","no_sptpd","no_skpdkb, npwpd, masa_pajak1, masa_pajak2, tahun, jumlah,
                nama_pemilik, alamat_pemilik, nama_perusahaan, alamat_perusahaan, no_sptpd, nota_hitung, tgl");
	
	}
}
        
        function simpan(){            
            date_default_timezone_set('Asia/Jakarta');
			$ctetap = $_POST['ketetapan'];
			if(strpos($ctetap, '.')){
				$ctetap = str_replace('.', '', $ctetap);
			} else {
				$ctetap;
			}
			
			$csetor = $_POST['setoran'];
			if(strpos($csetor, '.')){
				$csetor = str_replace('.', '', $csetor);
			} else {
				$csetor;
			}
			
			$ckurang = $_POST['kurang'];
			if(strpos($ckurang, '.')){
				$ckurang = str_replace('.', '', $ckurang);
			} else {
				$ckurang;
			}
			
			$denda = $_POST['denda'];
			if(strpos($denda, '.')){
				$denda = str_replace('.', '', $denda);
			} else {
				$denda;
			}
			
			if(strpos($ckurang, '-')){
				$ckurang = str_replace('-', '', $ckurang);
			} else {
				$ckurang;
			}
			
			$t = explode('/',$_POST['no_skrd']);
			if($t[1]=='REK' || $t[1]=='AIR'){
				$type = 1;
			} else {
				$type = 2;
			}
			
			$kode = $t[1];
			
			if($_POST['dasar_setoran']==1){
				$upd = array(
					'status' => 1
				);
				$this->db->update('skrd',$upd,array('no_skrd' => $_POST['no_skrd']));
			
			} else if($_POST['dasar_setoran']==2){
				$upd = array(
					'status' => 1
				);                                
                $data = $this->db->query("SELECT no_sptrd AS kode FROM skrd where no_skrd='".$_POST['no_skrd']."'")->row();
                    $no	= $data->no_sptrd;                                
				        $this->db->update('sptrd',$upd,array('no_sptrd' => $no));				
			} 
						                                               
            $data = array(			
                        'dasar_setoran' => $_POST['dasar_setoran'],
                        'pembayaran'    => $_POST['pembayaran'],
						'kode_bank'     => $_POST['pembayaran'],
                        'tanggal'   	=> strftime("%Y-%m-%d", strtotime($_POST['tanggal'])),
                        'nomor' 	    => $_POST['no_skrd'],
                        'npwpd'         => $_POST['npwpd'],
                        'nota_hitung'   => $_POST['nota'],
                        'masa_pajak1'   => $_POST['awal'],               
                        'masa_pajak2'   => $_POST['akhir'],                       
                        'tahun_pajak' 	=> $_POST['tahun'],
                        'tahun_pajak2' 	=> $_POST['tahun2'],
                        'keterangan'    => $_POST['keterangan'],
                        'ketetapan' 	=> $ctetap,
                        'setoran'       => $csetor,
                        'persen'        => $ckurang,
						'denda'	    	=> 0,
						'kode_pajak'	=> $kode,
						'tahun_transaksi' => date('Y'),
                        'lokasi_pasar'  => $_POST['lokasi'],
                        'indeks_kawasan'  => $_POST['kawasan'],
                        'indeks_gangguan' => $_POST['gangguan'],
                        'volume'        => $_POST['volume'],
                        'kurang'        => $ckurang
            );
            
            $data2 = array(
                    'kode_rekening'     => '4.1.2.03.03',
                    'nama_rekening'     => 'Retribusi Izin Gangguan',
                    'tarif'             => $ctetap,
                    'jumlah'            => $ctetap                     
            );			
                
         $user = $this->session->userdata('username');                
                
        $this->db->trans_begin();
		$thn = date('Y');
		if(empty($_POST['edit'])){
			$t_tahun = date('Y');
            $no_ssrd = $this->generateNo($t_tahun);
			
			$dataIns = array_merge($data,array('no_ssrd' =>  $no_ssrd, 'created' => date('Y-m-d H:i:s'), 'user_created'=>$user));
			$result = $this->db->insert('ssrd', $dataIns);
			
            $dataIns2 = array_merge($data2,array('no_ssrd' =>  $no_ssrd));
			$result = $this->db->insert('ssrd_detail', $dataIns2);			
			//$sql = $this->db->query("select ")->row();
		} else {
			$no_ssrd = $this->input->post('ssrd_1')."/".$this->input->post('ssrd_2');
			$this->db->delete('ssrd_detail',array('no_ssrd' => $no_ssrd));
			$dataUpdate = array_merge($data,array('user_modified' => $user,'modified' => date('Y-m-d H:i:s')));
			$result = $this->db->update('ssrd',$dataUpdate,array('no_ssrd' => $no_ssrd));
		}
                
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
					//$sms = $skpd.';'.$masa1.';'.$masa2.';'.$tahun.';'.$setoran;
                    //$data = $no_sspd.'|'.$sms;
					echo $no_ssrd;
                }
        }
        
	public function generateNo($thn="") {
		$sql = $this->db->query("select MAX(SUBSTRING_INDEX(no_ssrd,'/',1)) as max from ssrd where tahun_transaksi = '".$thn."'");
		$r = $sql->row();
		if($r==NULL){
			$no = '000000001/SSRD/'.substr($thn,2,2);
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
			$no = $jml.'/SSRD/'.substr($thn,2,2);
		}
		return $no;
	}
    
    
       	function getHitung(){
    		//$ketetapan = $_POST['ketetapan'];
            
           	$ketetapan = $_POST['ketetapan'];
			if(strpos($ketetapan, '.')){
				$ketetapan = str_replace('.', '', $ketetapan);
			} else {
				$ketetapan;
			}
    		$setoran = $_POST['setoran'];        
            
            $result =  $ketetapan - $setoran;
                      
            echo $result;
 
	}
	
	public function smsgateway(){
		$npwpd = $this->input->post('npwpd');
		$pajak = $this->input->post('jp');
		$awal = $this->msistem->v_bln($this->input->post('awal'));
		$akhir = $this->msistem->v_bln($this->input->post('akhir'));
		$tahun = $this->input->post('tahun');
		$c_setor = $_POST['setor'];
			if(strpos($c_setor, '.')){
				$c_setor = str_replace('.', '', $c_setor);
			} else {
				$c_setor;
			}
		//koneksi db sopd
		$this->db = $this->load->database('default',true);
		$sq = $this->db->query('select hp from view_perusahaan where npwpd_perusahaan="'.$npwpd.'"')->row();
		$sw = $sq->hp;
		if($sw==NULL){
			//$ss = '083893121648';
			$ss = '087895970969';
		} else {
			$ss = $sq->hp;
		}
		//$ss = '083893121648';
			
		$this->ds = $this->load->database('alternate',true);
		
		$sms = 'Terima kasih anda telah melakukan pembayaran '.$pajak.' masa pajak '.$awal.' - '.$akhir.' tahun '.$tahun.' sebesar Rp.'.number_format($c_setor,2,',','.');
		
		$data = array(
			'DestinationNumber' => $ss,
			'TextDecoded' => $sms 
		);
		$result = $this->ds->insert('outbox', $data);
		//echo $result;
		//echo $sms;
	}
        
        function load_data() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("SELECT
ssrd.id,
ssrd.no_ssrd,
ssrd.dasar_setoran,
ssrd.pembayaran,
DATE_FORMAT(ssrd.tanggal,'%d/%m/%Y') as tanggal,
ssrd.nomor,
ssrd.npwpd,
ssrd.masa_pajak1,
ssrd.masa_pajak2,
ssrd.tahun_pajak,
ssrd.keterangan,
ssrd.ketetapan,
ssrd.setoran,
ssrd.total_setoran,
ssrd.persen,
ssrd.denda,
ssrd.kurang,
ssrd.created,
ssrd.modified,
ssrd.user_created,
ssrd.user_modified,
ssrd.nota_hitung,
view_perusahaan.nama_pemilik,
view_perusahaan.alamat_pemilik,
view_perusahaan.nama_perusahaan,
view_perusahaan.alamat_perusahaan
FROM
view_perusahaan
INNER JOIN ssrd ON ssrd.npwpd = view_perusahaan.npwpd_perusahaan"
,"id"
                        ,"id, no_ssrd, dasar_setoran, pembayaran, tanggal, nomor, npwpd, nama_perusahaan, alamat_perusahaan, nama_pemilik, alamat_pemilik, masa_pajak1, masa_pajak2, tahun_pajak, keterangan, ketetapan, setoran, persen, created, modified, user_created, user_modified, nota_hitung, denda, kurang");
	}
	
	function data_setoran(){
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("SELECT
ssrd.id,
DATE_FORMAT(ssrd.tanggal,'%d/%m/%Y') as tanggal,
ssrd.no_ssrd,
type_pembayaran.nama_type,
ssrd.npwpd,
bulan.nama_bulan AS awal,
s.nama_bulan AS akhir,
ssrd.tahun_pajak,
ssrd.keterangan,
ssrd.ketetapan,
ssrd.setoran,
ssrd.total_setoran,
ssrd.persen,
ssrd.denda,
view_perusahaan.nama_pemilik,
view_perusahaan.nama_perusahaan,
view_perusahaan.alamat_perusahaan
FROM
ssrd
INNER JOIN bulan ON bulan.kode_bulan = ssrd.masa_pajak1
INNER JOIN bulan AS s ON s.kode_bulan = ssrd.masa_pajak2
INNER JOIN view_perusahaan ON view_perusahaan.npwpd_perusahaan = ssrd.npwpd
INNER JOIN type_pembayaran ON type_pembayaran.kode_type = ssrd.pembayaran ORDER BY ssrd.id DESC"
,"id","id, tanggal, no_ssrd, npwpd, nama_perusahaan, alamat_perusahaan, nama_pemilik, awal, akhir, tahun_pajak, ketetapan, setoran, persen, denda, nama_type");
	}
	
function load_rekening($gabung="") {
//$grid = new GridConnector($this->db->conn_id);
	$data = explode('-',$gabung);
	$dasar = $data[0];
	$nomor = $data[1].'/'.$data[2].'/'.$data[3];
	$kode = $data[2];
	
	if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
	
	if($dasar==1){
		$sq = $this->db->query("SELECT kd_rek, nm_rek, dp, tarif, jumlah FROM skrd_child WHERE skrd ='".$nomor."'");
	
	} else if($dasar==2){
	    $sq = $this->db->query("SELECT kd_rek, nm_rek, dp, tarif, jumlah FROM sptrd_d1 WHERE sptrd ='".$nomor."'");
	
	} 
//else if($dasar==3){
//		$sq = $this->db->query("SELECT kd_rek, nm_rek, dp, tarif, jumlah FROM stpd_child WHERE stpd ='".$nomor."'");
//	
//	} else if($dasar==4){
//		$sq = $this->db->query("SELECT kd_rek, nm_rek, dp, tarif, jumlah FROM skpdkbt_detail WHERE no_skpdkbt ='".$nomor."'");
//	
//	} else if($dasar==5){
//		$sq = $this->db->query("SELECT kd_rek, nm_rek, dp, tarif, jumlah FROM skpdkb_child WHERE skpdkb ='".$nomor."'");
//	}
	
	$i=1;
	foreach($sq->result() as $qr) {
		// cair
		$kenaikan = 0;
		$denda = '0';
		$kompensasi = 0;
		$bunga = '0';
		$null = '';
			
		echo ("<row id='".$i."'>");
			echo("<cell><![CDATA[".$qr->kd_rek."]]></cell>");
			echo("<cell><![CDATA[".$qr->nm_rek."]]></cell>");
			echo("<cell><![CDATA[".$qr->dp."]]></cell>");
			echo("<cell><![CDATA[".$qr->tarif."]]></cell>");
			echo("<cell><![CDATA[".$kenaikan."]]></cell>");
			echo("<cell><![CDATA[".$denda."]]></cell>");
			echo("<cell><![CDATA[".$kompensasi."]]></cell>");
			echo("<cell><![CDATA[".$bunga."]]></cell>");
			echo("<cell><![CDATA[".$qr->jumlah."]]></cell>");
			echo("<cell><![CDATA[".$null."]]></cell>");
		echo("</row>");
		$i++;
	}
	echo "</rows>";
}


function load_GRIDssrd($ssrd=""){
    if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 		header("Content-type: application/xhtml+xml"); } else {
 		header("Content-type: text/xml");
	}
	echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
	echo "<rows>";
	
	$sq = $this->db->query("SELECT kd_rek, nm_rek, dp, tarif, kenaikan, denda,
     kompensasi, bunga, jumlah, skrd FROM skrd_child WHERE skrd ='".$ssrd."'");$i=1;
	foreach($sq->result() as $qr) {
			
		echo ("<row id='".$i."'>");
			echo("<cell><![CDATA[".$qr->kd_rek."]]></cell>");
			echo("<cell><![CDATA[".$qr->nm_rek."]]></cell>");
			echo("<cell><![CDATA[".$qr->dp."]]></cell>");
			echo("<cell><![CDATA[".$qr->tarif."]]></cell>");
			echo("<cell><![CDATA[".$qr->kenaikan."]]></cell>");
			echo("<cell><![CDATA[".$qr->denda."]]></cell>");
			echo("<cell><![CDATA[".$qr->kompensasi."]]></cell>");
			echo("<cell><![CDATA[".$qr->bunga."]]></cell>");
			echo("<cell><![CDATA[".$qr->jumlah."]]></cell>");
			echo("<cell><![CDATA[".$qr->skrd."]]></cell>");
		echo("</row>");
		$i++;
	}
	echo "</rows>";
}

function load_childssrd($ssrd="") {
	$data = explode('-',$ssrd);
	$dasar = $data[0].'/'.$data[1].'/'.$data[2];
	
	if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 		header("Content-type: application/xhtml+xml"); } else {
 		header("Content-type: text/xml");
	}
	echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
	echo "<rows>";
	
	$sq = $this->db->query("SELECT kode_rekening, nama_rekening, dp, tarif, kenaikan, denda,
     kompensasi, bunga, jumlah,no_ssrd FROM ssrd_detail WHERE no_ssrd ='".$dasar."'");$i=1;
	foreach($sq->result() as $qr) {
			
		echo ("<row id='".$i."'>");
			echo("<cell><![CDATA[".$qr->kode_rekening."]]></cell>");
			echo("<cell><![CDATA[".$qr->nama_rekening."]]></cell>");
			echo("<cell><![CDATA[".$qr->dp."]]></cell>");
			echo("<cell><![CDATA[".$qr->tarif."]]></cell>");
			echo("<cell><![CDATA[".$qr->kenaikan."]]></cell>");
			echo("<cell><![CDATA[".$qr->denda."]]></cell>");
			echo("<cell><![CDATA[".$qr->kompensasi."]]></cell>");
			echo("<cell><![CDATA[".$qr->bunga."]]></cell>");
			echo("<cell><![CDATA[".$qr->jumlah."]]></cell>");
			echo("<cell><![CDATA[".$qr->no_ssrd."]]></cell>");
		echo("</row>");
		$i++;
	}
	echo "</rows>";

}

	function item_ssrd() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_table("ssrd_detail","id","kode_rekening, nama_rekening, dp, tarif, kenaikan, denda, kompensasi, bunga, jumlah, no_ssrd");
	}
	
	public function delete(){
		$this->db->delete('ssrd',array('no_ssrd' => $this->input->post('ssrd')));
		$this->db->delete('ssrd_detail',array('no_ssrd' => $this->input->post('ssrd')));

            if($_POST['dasar_setoran']==1){
				$upd = array(
					'status' => 0
				);
				$this->db->update('skrd',$upd,array('no_skrd' => $_POST['no_skrd']));
			
			} else if($_POST['dasar_setoran']==2){
				$upd = array(
					'status' => 0
				);
				$this->db->update('sptrd',$upd,array('no_sptrd' => $_POST['no_skrd']));
				
			} 
		$result = "Data SSRD berhasil dihapus.";
		echo $result;
	}
	
	public function cetak(){
		
		$data = $this->db->query("select a.dasar_setoran, a.nomor, a.no_ssrd, b.nama_pemilik,
         b.alamat_pemilik, b.nama_perusahaan, b.alamat_perusahaan, a.masa_pajak1, a.masa_pajak2,
          a.tahun_pajak, a.tahun_pajak2, DATE_FORMAT(a.tanggal,'%d/%m/%Y') as tgl, a.npwpd, a.ketetapan, a.setoran,
           a.persen, a.denda, a.kode_pajak from ssrd a left join view_perusahaan b
            on a.npwpd=b.npwpd_perusahaan where a.no_ssrd='".$_GET['ssrd']."'")->row();
		$no 				= $data->no_ssrd;
        $no_ssrd            = $no;
		$sptpd 			= $data->nomor;
		$npwpd 				= $data->npwpd;
		$nama 				= $data->nama_perusahaan;
		$alamat 			= $data->alamat_perusahaan;
		$namper				= $data->nama_pemilik;
		$awal				= $this->msistem->v_bln($data->masa_pajak1);
		$akhir 				= $this->msistem->v_bln($data->masa_pajak2);
		$tahun 				= $data->tahun_pajak;
        $tahun2             = $data->tahun_pajak2;
		$m	= $this->msistem->v_bln(date('m'));
		$tanggal			= date('d').' '.$m.' '.date('Y');
		$c			= $data->tgl;
		$arr = explode("/",$c);
		$bln = $this->msistem->v_bln($arr[1]);
		$created = $arr[0].' '.$bln.' '.$arr[2];
		
		$terbilang = $this->msistem->baca($data->setoran);
		
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
						SURAT SETORAN RETRIBUSI DAERAH<br />
						Masa Retribusi&nbsp;&nbsp;:&nbsp;&nbsp;'.$awal.' - '.$akhir.'<br />
						Tahun&nbsp;&nbsp;:&nbsp;&nbsp;'.$tahun.' - '.$tahun2.'
					</td>
					<td width="92" align="center">
						<br /><br />
						No. SSRD<br />
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
					<td width="100%" colspan="100%">&nbsp;&nbsp;'.$nama.'</td>
				</tr>
				
				<tr>
					<td width="140">&nbsp;&nbsp;ALAMAT PERUSAHAAN</td>
					<td width="10" align="center">:</td>
					<td width=100%>&nbsp;&nbsp;'.$alamat.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;NAMA PEMILIK</td>
					<td width="10" align="center">:</td>
					<td width="140">&nbsp;&nbsp;'.$namper.'</td>
				</tr>
				<tr>
					<td width="140">&nbsp;&nbsp;NPWPD</td>
					<td width="10" align="center">:</td>
					<td width="140">&nbsp;&nbsp;'.$npwpd.'</td>
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
					<td width="25" height="20" align="center">No</td>
					<td width="110" height="20" align="center">Kode Rekening</td>
					<td width="317" height="20" align="center">Nama Rekening</td>					
					<td width="120" height="20" align="center">Jumlah</td>
				</tr>';
		
		
			$child = $this->db->query("select * from ssrd_detail where no_ssrd ='".$no."'");
			$no = $this->db->query("select sptrd from view_no_ret where no_ssrd ='".$no."'")->row();
			$kode = $data->kode_pajak;
			$i = 1;
			if($kode=='REK'){
				$child = $child->row();
				$f = $this->db->query("select luas, unit, tarif, ketetapan from sptpd_reklame_detail where no_sptpd ='".$no->sptpd."'");
				foreach($f->result() as $ch) {
					$report .= '<tr id='.$i.'>
					  <td width="25" height="20" align="center">'.$i.'</td>
					  <td width="110" height="20" align="center">'.$child->kode_rekening.'</td>
					  <td width="317" height="20" align="left">'.$child->nama_rekening.'</td>
					  <td width="120" height="20" align="right">'.number_format($ch->ketetapan,2,',','.').'&nbsp;&nbsp;</td>
					</tr>';
				$i++;
				}
			} else {
				foreach($child->result() as $ch) {
					$report .= '<tr id='.$i.'>
					  <td width="25" height="20" align="center">'.$i.'</td>
					  <td width="110" height="20" align="center">'.$ch->kode_rekening.'</td>
					  <td width="317" height="20" align="left">'.$ch->nama_rekening.'</td>
					  <td width="120" height="20" align="right">'.number_format($ch->jumlah,2,',','.').'&nbsp;&nbsp;</td>
					</tr>';
				$i++;
				}
			}
		            
            $fsql = $this->db->query("SELECT * FROM ssrd
LEFT JOIN lokasi_pasar ON lokasi_pasar.kode = ssrd.lokasi_pasar
LEFT JOIN lokasi_kawasan ON lokasi_kawasan.id_kawasan = ssrd.indeks_kawasan
LEFT JOIN master_izin ON master_izin.id_izin = ssrd.indeks_gangguan where ssrd.no_ssrd ='".$no_ssrd."'");
				foreach($fsql->result() as $fq) {
				    $report .= '<tr>										
					<td colspan="4" width="572" height="15" align="left">&nbsp;RINCIAN RETRIBUSI : <br/><br/> 
                    <table width="50%" border="0">
                        <tr>
                            <td width="30"></td>
                            <td width="104">a. Indeks Izin Usaha</td>
                            <td width="10">:</td>
                            <td width="300">'.$fq->nm_lokasi.'</td>
                        </tr>
                        <tr>
                            <td width="30"></td>
                            <td width="104">b. Indeks Kawasan</td>
                            <td width="10">:</td>
                            <td width="300">'.$fq->nm_kawasan.'</td>
                        </tr>
                        <tr>
                            <td width="30"></td>
                            <td width="104">c. Indeks Gangguan</td>
                            <td width="10">:</td>
                            <td width="300">'.$fq->nm_izin.'</td>
                        </tr>
                        <tr>
                            <td width="30"></td>
                            <td width="104">d. Luas Tempat Usaha</td>
                            <td width="10">:</td>
                            <td width="300">'.$fq->volume.'&nbsp;m<sup>2</sup></td>
                        </tr>
                    </table>    
                    </td>
				</tr>';                    
                }
        
		$report .=
				'<tr>
					  <td colspan="3" height="20" width="452" align="right">Jumlah  Retribusi Terhutang&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td width="120" height="20" align="right">'.number_format($data->ketetapan,2,',','.').'&nbsp;&nbsp;</td>
				</tr>
				<tr>
					  <td colspan="3" height="20" width="452" align="right">Denda Retribusi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td width="120" height="20" align="right">'.number_format($data->denda,2,',','.').'&nbsp;&nbsp;</td>
				</tr>
				<tr>
					  <td colspan="3" height="20" width="452" align="right">Jumlah Setoran Retribusi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td width="120" height="20" align="right">'.number_format($data->setoran,2,',','.').'&nbsp;&nbsp;</td>
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
							<td colspan="3">&nbsp;</td>
						</tr>
						<tr>
							<td width="572" height="15" colspan="3">&nbsp;&nbsp;<u>P E R H A T I A N</u></td>
						</tr>
						<tr>
							<td width="20" align="center">1</td>
							<td width="10" align="center">:</td>
							<td width="490" align="justify">Harap penyetoran ke Bank dilakukan oleh Wajib Pajak dengan menggunakan Surat Setoran Retribusi Daerah (SSRD)</td>
						</tr>
						<tr>
							<td width="20" align="center">2</td>
							<td width="10" align="center">:</td>
							<td width="490" align="justify">Apabila SSRD ini tidak atau kurang dibayar setelah lewat waktu paling lama 30 hari setelah SSRD ini diterima akan dikenakan sanksi administrasi berupa bunga sebesar 2% per bulan</td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
					</table>
					</td>
				</tr>
			</table>';
				
				$s3 = $this->db->query("select nama, nip, bagian from admin where id_modul = '".$this->session->userdata('id_modul')."'")->row();
				if($s3==NULL){
					$nama3 = '';
					$nip3 = '';
					$bagian3= '';
				} else {
					$nama3 = $s3->nama;
					$nip3 = $s3->nip;
					$bagian3 = $s3->bagian;
				}	
		
		$admin = $this->session->userdata('username');
		
		$report .=
			'<table border="1">
				<tr>
				<td width="572">
				<table border="0">
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td width="382" align="center">&nbsp;</td>
						<td width="190" align="center">Palolo, '.$tanggal.'</td>
					</tr>
					<tr>
						<td width="382"><div align="center">&nbsp;</div></td>
						<td width="190" align="center">'.$bagian3.'</td>
					</tr>
					<tr>
						<td width="382">&nbsp;</td>
						<td width="190" align="center"></td>
					</tr>
					<tr>
						<td width="382" height="50">&nbsp;</td>
						<td width="190" align="center">&nbsp;</td>
					</tr>
					<tr>
						<td width="382" align="center">&nbsp;</td>
						<td width="190" align="center">'.$nama3.'</td>
					</tr>
					<tr>
						<td width="382" align="center">&nbsp;</td>
						<td width="190" align="center">NIP. '.$nip3.'</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
				</table>
				</td>
				</tr>
			</table>';
			
		//$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_NHP'.'.pdf', 'I');
	}
	
	public function atm($kode="", $sptpd="", $thn="") {
		if (stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		$no = $sptpd.'/'.$kode.'/'.substr($thn,2,2);
		$nos = $sptpd.'/'.$kode;
		
			if($kode=='REK'){
				$data = $this->db->query("SELECT view_perusahaan.npwpd_perusahaan, view_perusahaan.nama_perusahaan, view_perusahaan.nama_pemilik,
	view_perusahaan.alamat_perusahaan, skpd.masa_pajak1, skpd.masa_pajak2, skpd.tahun, skpd.jumlah, DATE_FORMAT(skpd.tgl_jth_tempo,'%d/%m/%Y') as tgl FROM view_perusahaan INNER JOIN skpd ON view_perusahaan.npwpd_perusahaan = skpd.npwpd WHERE skpd.no_skpd like '".$nos."%' and skpd.tahun_transaksi ='".$thn."' and skpd.status = '0'");
				$spt = $this->db->query("select a.rek_reklame as kd_rek, b.nm_rek, a.masa_pajak1, a.masa_pajak2 from sptpd_reklame a left join master_rekening b on a.rek_reklame=b.kd_rek join view_no2 c on a.no_sptpd=c.sptpd where c.no_skpd like '".$nos."%'")->row();
				$pajak = 'Pajak Reklame';
	
			} else if($kode=='AIR'){
				$data = $this->db->query("SELECT view_perusahaan.npwpd_perusahaan, view_perusahaan.nama_perusahaan, view_perusahaan.nama_pemilik,
	view_perusahaan.alamat_perusahaan, skpd.masa_pajak1, skpd.masa_pajak2, skpd.tahun, skpd.jumlah, DATE_FORMAT(skpd.tgl_jth_tempo,'%d/%m/%Y') as tgl FROM view_perusahaan INNER JOIN skpd ON view_perusahaan.npwpd_perusahaan = skpd.npwpd WHERE skpd.no_skpd like '".$nos."%' and skpd.tahun_transaksi ='".$thn."' and skpd.status = '0'");
				$spt = $this->db->query("select a.rek_air as kd_rek, b.nm_rek, d.keterangan as jns, a.masa_pajak1, a.masa_pajak2 from sptpd_air_bawah_tanah a left join master_rekening b on a.rek_air=b.kd_rek left join view_no2 c on a.no_sptpd=c.sptpd left join tb_golongan_air d on a.gol_air=d.id where c.no_skpd like '".$no."%'")->row();
				$pajak = 'Pajak Air Tanah';
	
			} else if($kode=='HTL'){
				$data = $this->db->query("SELECT view_perusahaan.npwpd_perusahaan, view_perusahaan.nama_perusahaan, view_perusahaan.nama_pemilik,
	view_perusahaan.alamat_perusahaan, sptpd.masa_pajak1, sptpd.masa_pajak2, sptpd.tahun, sptpd.jumlah, DATE_FORMAT(sptpd.tanggal,'%d/%m/%Y') as tgl FROM view_perusahaan INNER JOIN sptpd ON view_perusahaan.npwpd_perusahaan = sptpd.npwpd WHERE sptpd.no_sptpd = '".$no."' and sptpd.tahun ='".$thn."' and sptpd.status = '0'");
				$spt = $this->db->query("select a.gol_hotel as kd_rek, b.nm_rek, a.masa_pajak1, a.masa_pajak2 from sptpd_hotel a left join master_rekening b on a.gol_hotel=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Pajak Hotel';
	
			} else if($kode=='RES'){
				$data = $this->db->query("SELECT view_perusahaan.npwpd_perusahaan, view_perusahaan.nama_perusahaan, view_perusahaan.nama_pemilik,
	view_perusahaan.alamat_perusahaan, sptpd.masa_pajak1, sptpd.masa_pajak2, sptpd.tahun, sptpd.jumlah, DATE_FORMAT(sptpd.tanggal,'%d/%m/%Y') as tgl FROM view_perusahaan INNER JOIN sptpd ON view_perusahaan.npwpd_perusahaan = sptpd.npwpd WHERE sptpd.no_sptpd = '".$no."' and sptpd.tahun ='".$thn."' and sptpd.status = '0'");
				$spt = $this->db->query("select a.gol_restoran as kd_rek, b.nm_rek, a.masa_pajak1, a.masa_pajak2 from sptpd_restoran a left join master_rekening b on a.gol_restoran=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Pajak Restoran';
	
			} else if($kode=='LIS'){
				$data = $this->db->query("SELECT view_perusahaan.npwpd_perusahaan, view_perusahaan.nama_perusahaan, view_perusahaan.nama_pemilik,
	view_perusahaan.alamat_perusahaan, sptpd.masa_pajak1, sptpd.masa_pajak2, sptpd.tahun, sptpd.jumlah, DATE_FORMAT(sptpd.tanggal,'%d/%m/%Y') as tgl FROM view_perusahaan INNER JOIN sptpd ON view_perusahaan.npwpd_perusahaan = sptpd.npwpd WHERE sptpd.no_sptpd = '".$no."' and sptpd.tahun ='".$thn."' and sptpd.status = '0'");
				$spt = $this->db->query("select a.asal_listrik as kd_rek, b.nm_rek, a.masa_pajak1, a.masa_pajak2 from sptpd_listrik a left join master_rekening b on a.asal_listrik=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Pajak Penerangan Jalan';
	
			} else if($kode=='WLT'){
				$data = $this->db->query("SELECT view_perusahaan.npwpd_perusahaan, view_perusahaan.nama_perusahaan, view_perusahaan.nama_pemilik,
	view_perusahaan.alamat_perusahaan, sptpd.masa_pajak1, sptpd.masa_pajak2, sptpd.tahun, sptpd.jumlah, DATE_FORMAT(sptpd.tanggal,'%d/%m/%Y') as tgl FROM view_perusahaan INNER JOIN sptpd ON view_perusahaan.npwpd_perusahaan = sptpd.npwpd WHERE sptpd.no_sptpd = '".$no."' and sptpd.tahun ='".$thn."' and sptpd.status = '0'");
				$spt = $this->db->query("select a.golongan as kd_rek, b.nm_rek, a.masa_pajak1, a.masa_pajak2 from sptpd_burung_walet a left join master_rekening b on a.golongan=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Pajak Sarang Burung Walet';
	
			} else if($kode=='GAL'){
				$data = $this->db->query("SELECT view_perusahaan.npwpd_perusahaan, view_perusahaan.nama_perusahaan, view_perusahaan.nama_pemilik,
	view_perusahaan.alamat_perusahaan, sptpd.masa_pajak1, sptpd.masa_pajak2, sptpd.tahun, sptpd.jumlah, DATE_FORMAT(sptpd.tanggal,'%d/%m/%Y') as tgl FROM view_perusahaan INNER JOIN sptpd ON view_perusahaan.npwpd_perusahaan = sptpd.npwpd WHERE sptpd.no_sptpd = '".$no."' and sptpd.tahun ='".$thn."' and sptpd.status = '0'");
				$spt = $this->db->query("select a.rekening as kd_rek, b.nm_rek, a.jenis_galian as jns, a.masa_pajak1, a.masa_pajak2 from sptpd_galianc a left join master_rekening b on a.rekening=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Pajak Mineral Bukan Logam dan Batuan';
	
			} else if($kode=='HIB'){
				$data = $this->db->query("SELECT view_perusahaan.npwpd_perusahaan, view_perusahaan.nama_perusahaan, view_perusahaan.nama_pemilik,
	view_perusahaan.alamat_perusahaan, sptpd.masa_pajak1, sptpd.masa_pajak2, sptpd.tahun, sptpd.jumlah, DATE_FORMAT(sptpd.tanggal,'%d/%m/%Y') as tgl FROM view_perusahaan INNER JOIN sptpd ON view_perusahaan.npwpd_perusahaan = sptpd.npwpd WHERE sptpd.no_sptpd = '".$no."' and sptpd.tahun ='".$thn."' and sptpd.status = '0'");
				$spt = $this->db->query("select a.jenis_hiburan as kd_rek, b.nm_rek, a.masa_pajak1, a.masa_pajak2 from sptpd_hiburan a left join master_rekening b on a.jenis_hiburan=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Pajak Hiburan';
	
			} else if($kode=='PKR'){
				$data = $this->db->query("SELECT view_perusahaan.npwpd_perusahaan, view_perusahaan.nama_perusahaan, view_perusahaan.nama_pemilik,
	view_perusahaan.alamat_perusahaan, sptpd.masa_pajak1, sptpd.masa_pajak2, sptpd.tahun, sptpd.jumlah, DATE_FORMAT(sptpd.tanggal,'%d/%m/%Y') as tgl FROM view_perusahaan INNER JOIN sptpd ON view_perusahaan.npwpd_perusahaan = sptpd.npwpd WHERE sptpd.no_sptpd = '".$no."' and sptpd.tahun ='".$thn."' and sptpd.status = '0'");
				$spt = $this->db->query("select a.golongan as kd_rek, b.nm_rek, a.masa_pajak1, a.masa_pajak2 from sptpd_parkir a left join master_rekening b on a.golongan=b.kd_rek where a.no_sptpd = '".$no."'")->row();
				$pajak = 'Pajak Parkir';
	
			} else {
				$data = $this->db->query("select kode_sptpd from master_sptpd where kode_sptpd = '".$kode."'");
			}
		
		$d = $data->result();
				
		if($d==NULL){
			$i = 1;
			$text = "Maaf transaksi sudah dilakukan / ada kesalahan pada inputan";
			echo ("<row id='".$i."'>");
        			echo("<cell><![CDATA[".$text."]]></cell>");
       		echo("</row>");
		} else {
			$i = 1;
			foreach($data->result() as $rs){
				$tgl = $rs->tgl;
				
				$t = explode('/',$tgl);
				$bln1 = $rs->masa_pajak2;
				$thn1 = $rs->tahun;
				
				$bln2 = date('m');
				$thn2 = date('Y');
				
				$denda = 2;
				$utang = $rs->jumlah;
				$persen = 100;
				
				if($thn1==$thn2){
					$tbln = $bln2-$bln1;
					if($tbln<=1){				
						$kurang = 0;
						$den = 0;
						$setoran = $utang;
					} else if($tbln>1){
						$tbln = $tbln - 1;
						$kurang = $denda*$tbln;
						$den = ($utang*$kurang)/$persen;
						$setoran = $utang+$den;
					}
				} else if($thn1<$thn2){
					$tthn = $thn2-$thn1;
					if($tthn==1){
						$awal_thn = 12-$bln1;
						$akhir_thn = $bln2-0;
						$t_thn = $awal_thn+$akhir_thn;
						//alert(t_thn);
						$t_thn = $t_thn - 1;
						$kurang = $denda*$t_thn;
						$den = ($utang*$kurang)/$persen;
						//alert(den);
						$setoran = $utang+$den;
					} else if($tthn>1){
						$awal_thn = 12-$bln1;
						$akhir_thn = $bln2-0;
						$t_thn = $awal_thn+$akhir_thn;
						//alert(t_thn);
						$t_hit = $t_thn+12;
						$t_hit = $t_hit - 1;
						if($t_hit>24){
							$t_hit = 24;
						}
						$kurang = $denda*$t_hit;
						//var selisih = $denda*$kurang;
						$den = ($utang*$kurang)/$persen;
						$setoran = $utang+$den;
					}
				}
				
				$thn = date('Y');
				$sq = $this->db->query("select sum(setoran) as setor from sspd where nomor = '".$no."' and tahun_pajak = '".$thn."'")->row();
				
				if($sq==""){
					$ptb = 0;
				} else {
					$ptb = $sq->setor; //pajak tahun berjalan
				}
				
				$sq2 = $this->db->query("select sum(setoran) as setor from sspd where nomor = '".$no."' and tahun_pajak != '".$thn."'")->row();
				
				if($sq2==""){
					$piutang = 0;
				} else {
					$piutang = $sq2->setor; //pajak tahun berjalan
				}
				
				$masa12 = $this->msistem->v_bln($rs->masa_pajak1);
				$masa22 = $this->msistem->v_bln($rs->masa_pajak2);
				
				if($kode=='GAL'){
					$jns = $spt->jns;
					if($jns=='1'){
						$nm_rek = 'Rutin';
					} else if($jns=='2'){
						$nm_rek = 'Proyek';
					}
					$kd_rek = $spt->kd_rek;
				} else if($kode=='AIR'){
					$kd_rek = $spt->kd_rek;
					$nm_rek = $spt->jns;
				} else {
					$kd_rek = $spt->kd_rek;
					$nm_rek = $spt->nm_rek;
				}
								
				$td1 = $spt->masa_pajak1;
				$m1 = explode('-',$td1);
				$masa1 = $m1[2].'/'.$m1[1].'/'.$m1[0];
				
				$td2 = $spt->masa_pajak2;
				$m2 = explode('-',$td2);
				$masa2 = $m2[2].'/'.$m2[1].'/'.$m2[0];
				
				echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$rs->npwpd_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$masa12.' s/d '.$masa22."]]></cell>");
					echo("<cell><![CDATA[".$rs->tahun."]]></cell>");
					echo("<cell><![CDATA[".$rs->jumlah."]]></cell>");
					echo("<cell><![CDATA[".round($den)."]]></cell>");
					echo("<cell><![CDATA[".round($setoran)."]]></cell>");
					
					echo("<cell><![CDATA[".$no."]]></cell>");
					echo("<cell><![CDATA[".$pajak."]]></cell>");
					echo("<cell><![CDATA[".$kd_rek." - ".$nm_rek."]]></cell>");
					echo("<cell><![CDATA[".$masa1.' s/d '.$masa2."]]></cell>");
					echo("<cell><![CDATA[".$ptb."]]></cell>");
					echo("<cell><![CDATA[".$piutang."]]></cell>");
					
				echo("</row>");
			}
		}
       	echo "</rows>";
	}
	
	function batal_atm($kode="", $sptpd="",$thn=""){
		if (stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($kode=='HTL' || $kode=='RES' || $kode=='LIS' || $kode=='WLT' || $kode=='GAL' || $kode=='HIB' || $kode=='PKR' || $kode=='REK' || $kode=='AIR'){
			$no = $sptpd.'/'.$kode.'/'.substr($thn,2,2);
			$data = $this->db->query("select no_sspd from sspd where nomor = '".$no."'")->row();
		} else {
			$data = $this->db->query("select kode_sptpd from master_sptpd where kode_sptpd = '".$kode."'")->row();
		}

		if($data==NULL){
			$text = 'Maaf data yang anda cari tidak ada / ada kesalahan pada inputan';
		} else {
			if($kode=='REK' || $kode=='AIR'){
				$ds = 1;
				$upd = array(
					'status' => 0
				);
				$this->db->update('skpd',$upd,array('no_skpd' => $no));
			} else if($kode=='HTL' || $kode=='RES' || $kode=='LIS' || $kode=='WLT' || $kode=='GAL' || $kode=='HIB' || $kode=='PKR'){
				$ds = 2;
				$upd = array(
					'status' => 0
				);
				$this->db->update('sptpd',$upd,array('no_sptpd' => $no));
			}
				
			
			$no_sspd = $data->no_sspd;
			$this->db->delete('sspd',array('no_sspd' => $no_sspd));
			$this->db->delete('sspd_detail',array('no_sspd' => $no_sspd));
			
			$text = "Proses Pembatalan Berhasil.";
		}
		
		$i = 1;
		echo ("<row id='".$i."'>");
        		echo("<cell><![CDATA[".$text."]]></cell>");
       	echo("</row>");
		
       	echo "</rows>";
	}
	
	function bayar_atm($no_transaksi="",$kode="", $sptpd="", $jml_bayar="", $tgl="", $kode_bank="", $kode_atm_teller="", $kode_cabang="", $thn=""){
		if (stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		$tahun = substr($thn,2,2);
		$no = $sptpd.'/'.$kode.'/'.$tahun;
		
		if($kode=='REK' || $kode=='AIR'){
			$sq = $this->db->query("SELECT npwpd, masa_pajak1, masa_pajak2, tahun, no_skpd as no_sptpd, jumlah, DATE_FORMAT(tgl_jth_tempo,'%d/%m/%Y') as tgl FROM skpd WHERE no_skpd = '".$no."' AND status = '0'")->row();
		} else if($kode=='HTL' || $kode=='RES' || $kode=='LIS' || $kode=='WLT' || $kode=='GAL' || $kode=='HIB' || $kode=='PKR'){
			$sq = $this->db->query("select npwpd, masa_pajak1, masa_pajak2, tahun, no_sptpd, jumlah, DATE_FORMAT(tanggal,'%d/%m/%Y') as tgl from sptpd where no_sptpd = '".$no."' and status ='0'")->row();
		} else {
			$sq = $this->db->query("select kode_sptpd from master_sptpd where kode_sptpd = '".$kode."'")->row();
		}
		
		if($sq==NULL){
			$text = 'Maaf transaksi sudah dilakukan / ada kesalahan pada inputan';
		
		} else {
			$tgl = $sq->tgl;
			$t = explode('/',$tgl);
			$bln1 = $sq->masa_pajak1;
			$thn1 = $sq->tahun;
				
			$bln2 = date('m');
			$thn2 = date('Y');
				
			$denda = 2;
			$utang = $sq->jumlah;
			$persen = 100;
				
			if($thn1==$thn2){
				$tbln = $bln2-$bln1;
				if($tbln<=1){				
					$kurang = 0;
					$den = 0;
					$setoran = $utang;
				} else if($tbln>1){
					$tbln = $tbln - 1;
					$kurang = $denda*$tbln;
					$den = ($utang*$kurang)/$persen;
					$setoran = $utang+$den;
				}
			} else if($thn1<$thn2){
				$tthn = $thn2-$thn1;
				if($tthn==1){
					$awal_thn = 12-$bln1;
					$akhir_thn = $bln2-0;
					$t_thn = $awal_thn+$akhir_thn;
					//alert(t_thn);
					$t_thn = $t_thn - 1;
					$kurang = $denda*$t_thn;
					$den = ($utang*$kurang)/$persen;
					//alert(den);
					$setoran = $utang+$den;
				} else if($tthn>1){
					$awal_thn = 12-$bln1;
					$akhir_thn = $bln2-0;
					$t_thn = $awal_thn+$akhir_thn;
					//alert(t_thn);
					$t_hit = $t_thn+12;
					$t_hit = $t_hit - 1;
					if($t_hit>24){
						$t_hit = 24;
					}
					$kurang = $denda*$t_hit;
					//var selisih = $denda*$kurang;
					$den = ($utang*$kurang)/$persen;
					$setoran = $utang+$den;
				}
			}			
			if($kode=='REK' || $kode=='AIR'){
				$ds = 1;
				$upd = array(
					'status' => 1
				);
				$this->db->update('skpd',$upd,array('no_skpd' => $no));
			} else {
				$ds = 2;
				$upd = array(
					'status' => 1
				);
				$this->db->update('sptpd',$upd,array('no_sptpd' => $no));
			}
			
			//$ckurang = $sq->jumlah - $jml_bayar;
			
			$data = array(			
				'dasar_setoran' => $ds,
				'pembayaran'	=> $kode_bank,
				'tanggal' 	   => date('Y-m-d'),
				'nomor' 		 => $no,
				'npwpd'         => $sq->npwpd,
				'nota_hitung'   => $sq->no_sptpd,
				'masa_pajak1'   => $sq->masa_pajak1,               
				'masa_pajak2'   => $sq->masa_pajak2,                       
				'tahun_pajak' 	=> $thn,
				'keterangan'    => 'pembayaran bank',
				'ketetapan' 	=> $sq->jumlah,
				'setoran'       => $jml_bayar,
				'persen'        => $kurang,
				'denda'        => $den,
				'kode_pajak'	=> $kode,
				'no_transaksi' => $no_transaksi,
				'kode_bank' => $kode_bank,
				'kode_atm_teller' => $kode_atm_teller,
				'kode_cabang' => $kode_cabang,
				'tahun_transaksi' => date('Y')
				);
					
			 $user = $this->session->userdata('username');                
					
				$t_tahun = date('Y');
				$no_sspd = $this->generateNo($t_tahun);
				$dataIns = array_merge($data,array('no_sspd' =>  $no_sspd, 'created' => date('Y-m-d H:i:s'), 'user_created'=>$user));
				$result = $this->db->insert('sspd', $dataIns);
			
			if($kode=='AIR' || $kode=='REK'){
				$sq2 = $this->db->query("SELECT kd_rek, nm_rek, dp, tarif, jumlah FROM skpd_child WHERE skpd ='".$no."'");
			
			} else if($kode == 'GAL'){
				$sq2 = $this->db->query("select kd_rek, nm_rek, dp, tarif, jumlah from sptpd_galianc_d1 where sptpd = '".$no."'");
			
			} else {
				$sq2 = $this->db->query("select kd_rek, nm_rek, dp, tarif, jumlah from sptpd_child where no_sptpd = '".$no."'");
			}
			
			foreach($sq2->result() as $q){		
				$data1 = array(
					'no_sspd' => $no_sspd,
					'kode_rekening' => $q->kd_rek,
					'nama_rekening' => $q->nm_rek,
					'dp' => $q->dp,
					'tarif' => $q->tarif,
					'kenaikan' => 0,
					'denda' => 0,
					'kompensasi' => 0,
					'bunga' => 0,
					'jumlah' => $q->jumlah
				);
				$result1 = $this->db->insert('sspd_detail', $data1);
			}
			
			//sms gateway
			$awal = $this->msistem->v_bln($sq->masa_pajak1);
			$akhir = $this->msistem->v_bln($sq->masa_pajak2);
			
			if($kode=='HTL'){
				$pajak = 'Pajak Hotel';
			} else if($kode=='RES'){
				$pajak = 'Pajak Restoran';
			} else if($kode=='REK'){
				$pajak = 'Pajak Reklame';
			} else if($kode=='HIB'){
				$pajak = 'Pajak Hiburan';
			} else if($kode=='LIS'){
				$pajak = 'Pajak Penerangan Jalan';
			} else if($kode=='GAL'){
				$pajak = 'Pajak Mineral Bukan Logam dan Batuan';
			} else if($kode=='PKR'){
				$pajak = 'Pajak Parkir';
			} else if($kode=='AIR'){
				$pajak = 'Pajak Air Bawah Tanah';
			} else if($kode=='WLT'){
				$pajak = 'Pajak Burung Walet';
			}
			//koneksi db sopd
			$this->db = $this->load->database('default',true);
			$sqe = $this->db->query('select hp from view_perusahaan where npwpd_perusahaan="'.$sq->npwpd.'"')->row();
			$soq = $sqe->hp;
			if($soq==NULL){
				//$ss = '083893121648';
				$ss = '087895970969';
			} else {
				$ss = $sqe->hp;
			}
			//$ss = '083893121648';
			
			$this->ds = $this->load->database('alternate',true);
			
			$sms = 'Terima kasih anda telah melakukan pembayaran '.$pajak.' masa pajak '.$awal.' - '.$akhir.' tahun '.$thn.' sebesar Rp.'.number_format($jml_bayar,2,',','.');
			
			$data2 = array(
				'DestinationNumber' => $ss,
				'TextDecoded' => $sms 
			);
			$result = $this->ds->insert('outbox', $data2);
			
			$text = 'Transaksi Berhasil';
		}
		
		$i = 1;
			
		echo ("<row id='".$i."'>");
        	echo("<cell><![CDATA[".$text."]]></cell>");
       	echo("</row>");
		
       	echo "</rows>";
	}
}
?>