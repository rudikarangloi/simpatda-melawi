<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class sspd_situ extends MY_Controller {
	
	public function pangkat(){
		$c = exp(2*log(1));
		echo $c;
	}
	
	public function index() {
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$data['tgl'] = date('d/m/Y');
        $data['tahun'] = $this->msistem->tahun();
		$data['jenis'] = $this->db->get('master_sptpd')->result();
		$this->load->view('data/sspd_situ',$data);
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
			$grid = new GridConnector($this->db->conn_id);
			$grid->dynamic_loading(100); 
			$grid->render_sql("SELECT a.no_skpd, a.npwpd, a.masa_pajak1, a.masa_pajak2, a.tahun, a.jumlah, 
b.nama_pemilik, b.alamat_pemilik, b.nama_perusahaan, b.alamat_perusahaan, 
a.no_sptpd, a.nota_hitung, DATE_FORMAT(a.tgl_jth_tempo,'%d/%m/%Y') AS tgl,
DATE_FORMAT(c.masa_pajak_1,'%d/%m/%Y') AS ms_1,
DATE_FORMAT(c.masa_pajak_2,'%d/%m/%Y') AS ms_2,d.denda,a.ket_skpd FROM skpd a 
LEFT JOIN view_perusahaan b ON a.npwpd=b.npwpd_perusahaan 
LEFT JOIN sptpd c ON c.no_sptpd = a.no_sptpd
LEFT JOIN skpd_child d ON d.skpd = a.no_skpd
WHERE a.status='0' $qr GROUP BY a.no_skpd ","no_sptpd","no_skpd, npwpd, masa_pajak1, masa_pajak2, tahun, jumlah, nama_pemilik, alamat_pemilik, nama_perusahaan, alamat_perusahaan, no_sptpd, nota_hitung, tgl, ms_1, ms_2, denda, ket_skpd");
			
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
			$grid->render_sql("select a.no_sptpd, a.npwpd, a.masa_pajak1, a.masa_pajak2, a.tahun, a.jumlah, b.nama_pemilik, b.alamat_pemilik, b.nama_perusahaan, b.alamat_perusahaan, a.no_sptpd, a.no_sptpd, DATE_FORMAT(a.tanggal,'%d/%m/%Y') as tgl from sptpd a left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.status ='0' $qr","no_nota","no_sptpd, npwpd, masa_pajak1, masa_pajak2, tahun, jumlah, nama_pemilik, alamat_pemilik, nama_perusahaan, alamat_perusahaan, no_sptpd, no_sptpd,tgl");
		
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
			$grid->render_sql("select a.no_stpd, a.npwpd, a.masa_pajak1, a.masa_pajak2, a.tahun, a.jumlah, b.nama_pemilik, b.alamat_pemilik, b.nama_perusahaan, b.alamat_perusahaan, a.no_sptpd, DATE_FORMAT(a.tanggal_tempo,'%d/%m/%Y') as tgl from stpd a left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.status ='0' $qr","no_sptpd","no_stpd, npwpd, masa_pajak1, masa_pajak2, tahun, jumlah, nama_pemilik, alamat_pemilik, nama_perusahaan, alamat_perusahaan, no_sptpd, tgl");
		
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
			$grid->render_sql("select a.no_skpdkb, a.npwpd, a.masa_pajak1, a.masa_pajak2, a.tahun, a.jumlah, b.nama_pemilik, b.alamat_pemilik, b.nama_perusahaan, b.alamat_perusahaan, a.no_sptpd, a.nota_hitung, DATE_FORMAT(a.tgl_tempo,'%d/%m/%Y') as tgl from skpdkb a left join view_perusahaan b on a.npwpd=b.npwpd_perusahaan where a.status ='0' $qr","no_sptpd","no_skpdkb, npwpd, masa_pajak1, masa_pajak2, tahun, jumlah, nama_pemilik, alamat_pemilik, nama_perusahaan, alamat_perusahaan, no_sptpd, nota_hitung, tgl");
	
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
			
			$ckurang = $_POST['persen'];
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
			
			$t = explode('/',$_POST['no_skpd']);
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
				    $this->db->update('skpd',$upd,array('no_skpd' => $_POST['no_skpd']));	
                                 
                /*if($_POST['status_jurnal']==001){
                    $upd = array(
					'status' => 1
			     	);
				    $this->db->update('skpd',$upd,array('no_skpd' => $_POST['no_skpd']));	
                    		    
                }else if ($_POST['status_jurnal']==002){
                    //dppkad
                    $skpd = "1.20.05.00";
                    $rek = "4110104";
                    $giat = "0.00.00.00.00.01";
                    $sspd = $_POST['sspd_1'] +  $_POST['sspd_2']; 
                                        
                    $datakasin = array(			
                       'kd_skpd'      => $skpd,
                       'no_sts'  => $sspd,
                       'kd_rek5'     => $rek, 
                       'rupiah'       => $csetor,
                       'kd_kegiatan' =>$giat);
                        
                    $dataIns = array_merge($datakasin,array('no_sspd' =>  $sspd, 'created' => date('Y-m-d H:i:s'), 'user_created'=>$user));
			        $result = $this->db->insert('trdkasin_pkd', $dataIns);
                                        
                    $csql  = "insert into trdkasin_pkd (kd_skpd,no_sts,kd_rek5,rupiah,kd_kegiatan) 
                    values('$skpd','$sspd','$rek','$csetor','$giat')";
		            $this->db->query($csql);
                    */			                                                                                    
                        /*'pembayaran'  => $_POST['pembayaran'],
						'kode_bank'    	=> $_POST['pembayaran'],
                        'tanggal'		=> strftime("%Y-%m-%d", strtotime($_POST['tanggal'])),
                        'nomor' 		=> $_POST['no_skpd'],
                        'npwpd'         => $_POST['npwpd'],
                        'nota_hitung'   => $_POST['nota'],
                        'masa_pajak1'   => $_POST['awal'],               
                        'masa_pajak2'   => $_POST['akhir'],                       
                        'tahun_pajak' 	=> $_POST['tahun'],
                        'keterangan'    => $_POST['keterangan'],
                        'ketetapan' 	=> $ctetap,
                        'setoran'       => $csetor,
                        'persen'        => $ckurang,
						'denda'			=> $denda,
						'kode_pajak'	=> $kode,
						'tahun_transaksi' => date('Y')*/
                                                          
			} else if($_POST['dasar_setoran']==2){
				$upd = array(
					'status' => 1
				);
				$this->db->update('sptpd',$upd,array('no_sptpd' => $_POST['no_skpd']));
				
			} else if($_POST['dasar_setoran']==3){
				$upd = array(
					'status' => 1
				);
				$this->db->update('stpd',$upd,array('no_stpd' => $_POST['no_skpd']));
			
			} else if($_POST['dasar_setoran']==4){
				$upd = array(
					'setoran' => $csetor,
					'jumlah' => $ckurang,
					'total' => $ckurang,
					'status' => 1
				);
				$this->db->update('skpdkbt',$upd,array('no_skpdkbt' => $_POST['no_skpd']));
			
			} else if($_POST['dasar_setoran']==5){
				$upd = array(
					'setoran' => $csetor,
					'jumlah' => $ckurang,
					'status' => 1
				);
				$this->db->update('skpdkb',$upd,array('no_skpdkb' => $_POST['no_skpd']));
				
			}      
						                                               
            $data = array(			
                        'dasar_setoran' => $_POST['dasar_setoran'],
                        'pembayaran'    => $_POST['pembayaran'],
						'kode_bank'     => $_POST['pembayaran'],
                        'tanggal'	    => strftime("%Y-%m-%d", strtotime($_POST['tanggal'])),
                        'nomor' 	    => $_POST['no_skpd'],
                        'npwpd'         => $_POST['npwpd'],
                        'nota_hitung'   => $_POST['nota'],
                        'masa_pajak1'   => $_POST['awal'],               
                        'masa_pajak2'   => $_POST['akhir'],                       
                        'tahun_pajak' 	=> $_POST['tahun'],
                        'keterangan'    => $_POST['keterangan'],
                        'ketetapan' 	=> $ctetap,
                        'setoran'       => $csetor,
                        'total_setoran' => $csetor,
                        'persen'        => $_POST['persen'],
						'ttd_sspd'		=> $_POST['ttd_sspd'],
                        //'kurang'        => $ckurang,
						'denda'		    => $denda,
						'kode_pajak'	=> $kode,
						'nama_perusahaan' 	=>  $_POST['nama_perusahaan'],
						'alamat_perusahaan' 	=>  $_POST['alamat_perusahaan'],
						'nama_pemilik' 	=>  $_POST['nama_pemilik'],
						'alamat_pemilik' 	=>  $_POST['alamat_perusahaan'],
						'masa_pajak_1' 	=>  $_POST['tg_masa1'],
						'masa_pajak_2' 	=>  $_POST['tg_masa2'],
						'tahun_transaksi' => date('Y')
            );			
                
        $user = $this->session->userdata('username');                
               
        $this->db->trans_begin();
		$thn = date('Y');
		if(empty($_POST['edit'])){
			$t_tahun = date('Y');
            $no_sspd = $this->generateNo($t_tahun);
			
			$dataIns = array_merge($data,array('no_sspd' =>  $no_sspd, 'created' => date('Y-m-d H:i:s'), 'user_created'=>$user));
			$result = $this->db->insert('sspd', $dataIns);
			
			//$sql = $this->db->query("select ")->row();
		} else {
			$no_sspd = $this->input->post('sspd_1')."/".$this->input->post('sspd_2');
			$this->db->delete('sspd_detail',array('no_sspd' => $no_sspd));
			$dataUpdate = array_merge($data,array('user_modified' => $user,'modified' => date('Y-m-d H:i:s')));
			$result = $this->db->update('sspd',$dataUpdate,array('no_sspd' => $no_sspd));
		}
                
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
					//$sms = $skpd.';'.$masa1.';'.$masa2.';'.$tahun.';'.$setoran;
                    //$data = $no_sspd.'|'.$sms;
					echo $no_sspd;
                }
        }
        
	public function generateNo($thn="") {
		$sql = $this->db->query("select MAX(SUBSTRING_INDEX(no_sspd,'/',1)) as max from sspd where LEFT(tanggal,4) = '".$thn."'");
		$r = $sql->row();
		if($r==NULL){
			$no = '000000001/SSPD/'.substr($thn,2,2);
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
			$no = $jml.'/SSPD/'.substr($thn,2,2);
		}
		return $no;
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
		//$this->db = $this->load->database('default',true);
		$sq = $this->db->query('select hp from view_perusahaan where npwpd_perusahaan="'.$npwpd.'"');
		//$sw = $sq->hp;
		if($sw==NULL){
			//$ss = '083893121648';
			$ss = $sq;
		} else {
			$ss = '081539802711';
		}
		//$ss = '083893121648';
			
		//$this->ds = $this->load->database('alternate',true);
		
		$sms = 'Terima kasih anda telah melakukan pembayaran '.$pajak.' masa pajak '.$awal.' - '.$akhir.' tahun '.$tahun.' sebesar Rp.'.number_format($c_setor,2,',','.');
		
		$data = array(
			'DestinationNumber' => $ss,
			'TextDecoded' => $sms 
		);
		$result = $this->ds->insert('outbox', $data);
		//echo $result;
		//echo $sms;
	}
        
        function load_data($parameter,$kunci) {
			/* ini_set('memory_limit', '10000M'); 
			ini_set('max_execution_time', '1000'); */
            $tahun = date("y");
            switch($parameter){                
                case "pemilik":
                    $where = "sspd.no_sspd like '%$tahun' and identitas_pemilik.nama_pemilik like '%$kunci%'";
                    break;
                case "usaha":
                    $where = "sspd.no_sspd like '%$tahun' and identitas_perusahaan.nama_perusahaan like '%$kunci%'";
                    break;
                
                case "npwpd":
                    $where = "sspd.no_sspd like '%$tahun' and sspd.npwpd like '%$kunci%'";
                    break;
                
            }
		
		$grid = new GridConnector($this->db->conn_id);
		/* $grid->dynamic_loading(100); */ 
		$grid->render_sql("SELECT
sspd.id,
sspd.no_sspd,
sspd.dasar_setoran,
sspd.pembayaran,
DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') AS tanggal,
sspd.nomor,
sspd.npwpd,
sspd.masa_pajak1,
sspd.masa_pajak2,
sspd.tahun_pajak,
sspd.keterangan,
sspd.ketetapan,
sspd.setoran,
sspd.total_setoran,
sspd.persen,
sspd.denda,
sspd.created,
sspd.modified,
sspd.user_created,
sspd.user_modified,
sspd.nota_hitung,
identitas_pemilik.nama_pemilik,
identitas_pemilik.alamat_pemilik,
identitas_perusahaan.nama_perusahaan,
identitas_perusahaan.alamat_perusahaan,
sspd.masa_pajak_1,
sspd.masa_pajak_2,
sspd.ttd_sspd
FROM
identitas_perusahaan
INNER JOIN sspd ON sspd.npwpd = identitas_perusahaan.npwpd_perusahaan 
INNER JOIN identitas_pemilik ON identitas_perusahaan.npwpd_pemilik = identitas_pemilik.npwpd_pemilik
INNER JOIN sspd_detail ON sspd.no_sspd = sspd_detail.no_sspd
where $where AND substr(sspd.npwpd,9,2) = '01' AND sspd.kode_pajak = 'REK' AND sspd_detail.kode_rekening LIKE '%4.1.4.08.01%'
ORDER BY sspd.no_sspd DESC LIMIT 15"
,"id","id, no_sspd, dasar_setoran, pembayaran, tanggal, nomor, npwpd, nama_perusahaan, alamat_perusahaan, nama_pemilik, alamat_pemilik, masa_pajak1, masa_pajak2, tahun_pajak, keterangan, ketetapan, setoran, persen, created, modified, user_created, user_modified, nota_hitung, denda, masa_pajak_1,masa_pajak_2,ttd_sspd");
	}
	
	function data_setoran(){
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		$grid->render_sql("SELECT
sspd.id,
DATE_FORMAT(sspd.tanggal,'%d/%m/%Y') as tanggal,
sspd.no_sspd,
type_pembayaran.nama_type,
sspd.npwpd,
bulan.nama_bulan AS awal,
s.nama_bulan AS akhir,
sspd.tahun_pajak,
sspd.keterangan,
sspd.ketetapan,
sspd.setoran,
sspd.total_setoran,
sspd.persen,
sspd.denda,
view_perusahaan.nama_pemilik,
view_perusahaan.nama_perusahaan,
view_perusahaan.alamat_perusahaan
FROM
sspd
INNER JOIN bulan ON bulan.kode_bulan = sspd.masa_pajak1
INNER JOIN bulan AS s ON s.kode_bulan = sspd.masa_pajak2
INNER JOIN view_perusahaan ON view_perusahaan.npwpd_perusahaan = sspd.npwpd
INNER JOIN type_pembayaran ON type_pembayaran.kode_type = sspd.pembayaran ORDER BY sspd.id DESC"
,"id","id, tanggal, no_sspd, npwpd, nama_perusahaan, alamat_perusahaan, nama_pemilik, awal, akhir, tahun_pajak, ketetapan, setoran, persen, denda, nama_type");
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
		$sq = $this->db->query("SELECT kd_rek, nm_rek, dp, tarif, jumlah, denda FROM skpd_child WHERE skpd ='".$nomor."'");
		
					
	
	} else if($dasar==2){
		if($kode == 'HTL' || $kode == 'RES' || $kode == 'HIB' || $kode == 'LIS' || $kode == 'PKR' || $kode == 'WLT'){
			$sq = $this->db->query("SELECT kd_rek, nm_rek, dp, tarif, jumlah FROM sptpd_child WHERE no_sptpd ='".$nomor."'");
		} else if($kode == 'GAL'){
			$sq = $this->db->query("SELECT kd_rek, nm_rek, dp, tarif, jumlah FROM sptpd_galianc_d1 WHERE sptpd ='".$nomor."'");
		}
	
	} else if($dasar==3){
		$sq = $this->db->query("SELECT kd_rek, nm_rek, dp, tarif, jumlah FROM stpd_child WHERE stpd ='".$nomor."'");
	
	} else if($dasar==4){
		$sq = $this->db->query("SELECT kd_rek, nm_rek, dp, tarif, jumlah FROM skpdkbt_detail WHERE no_skpdkbt ='".$nomor."'");
	
	} else if($dasar==5){
		$sq = $this->db->query("SELECT kd_rek, nm_rek, dp, tarif, jumlah FROM skpdkb_child WHERE skpdkb ='".$nomor."'");
	}
	
	$i=1;
	foreach($sq->result() as $qr) {
		// cair
		$denda = $qr->denda;
		$jum = $qr->jumlah;		
		$tot = $jum - $denda;		
		$kenaikan = 0;
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
			echo("<cell><![CDATA[".$tot."]]></cell>");
			echo("<cell><![CDATA[".$jum."]]></cell>");
			echo("<cell><![CDATA[".$null."]]></cell>");
		echo("</row>");
		$i++;
	}
	echo "</rows>";
}

function load_childsspd($sspd="") {
	$data = explode('-',$sspd);
	$dasar = $data[0].'/'.$data[1].'/'.$data[2];
	
	if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 		header("Content-type: application/xhtml+xml"); } else {
 		header("Content-type: text/xml");
	}
	echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
	echo "<rows>";
	
	$sq = $this->db->query("SELECT kode_rekening, nama_rekening, dp, tarif, kenaikan, denda, kompensasi, 
    bunga, jumlah,no_sspd FROM sspd_detail WHERE no_sspd ='".$dasar."'");$i=1;
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
			echo("<cell><![CDATA[".$qr->no_sspd."]]></cell>");
		echo("</row>");
		$i++;
	}
	echo "</rows>";

}

	function item_sspd() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_table("sspd_detail","id","kode_rekening, nama_rekening, dp, tarif, kenaikan, denda, kompensasi, bunga, jumlah, no_sspd");
	}
	
	public function delete(){
		$this->db->delete('sspd',array('no_sspd' => $this->input->post('sspd')));
		$this->db->delete('sspd_detail',array('no_sspd' => $this->input->post('sspd')));
//        $No->$this->input->post('nomor');
//        $query= $this->db->query(" update sptpd set status='0' where no_sptpd='$No' ");
		$result = "Data SSPD berhasil dihapus.";
		echo $result;
	}
	
	public function cetak(){
		
		$data = $this->db->query("SELECT a.dasar_setoran, a.nomor, a.no_sspd, b.nama_pemilik, b.alamat_pemilik, b.nama_perusahaan, 
		b.alamat_perusahaan, a.masa_pajak1, a.masa_pajak2, a.tahun_pajak, DATE_FORMAT(a.tanggal,'%d/%m/%Y') AS tgl, 
		a.npwpd, b.npwpd_lama, a.ketetapan, a.setoran, a.persen, a.denda, a.kode_pajak, d.masa_pajak_1, d.masa_pajak_2, a.ttd_sspd FROM sspd a 
		LEFT JOIN view_perusahaan b ON a.npwpd=b.npwpd_perusahaan
		LEFT JOIN view_no c ON c.no_sspd = a.no_sspd
		LEFT JOIN sptpd d ON d.no_sptpd = c.sptpd where a.no_sspd='".$_GET['sspd']."'")->row();
		$no 				= $data->no_sspd;
		$sptpd 				= $data->nomor;
		$npwpd 				= $data->npwpd;
		$npwpd_lama			= $data->npwpd_lama;
		$nama 				= $data->nama_perusahaan;
		$alamat 			= $data->alamat_perusahaan;
		$namper				= $data->nama_pemilik;
		$awal				= $this->msistem->v_bln($data->masa_pajak1);
		$akhir 				= $this->msistem->v_bln($data->masa_pajak2);
		$tahun 				= $data->tahun_pajak;
		$tdd_id				= $data->ttd_sspd;
		$m	= $this->msistem->v_bln(date('m'));
		$tanggal			= date('d').' '.$m.' '.date('Y');
		$c			= $data->tgl;
		$arr = explode("/",$c);
		$bln = $this->msistem->v_bln($arr[1]);
		$created = $arr[0].' '.$bln.' '.$arr[2];
		$nama_badan = "Badan Pengelola Pajak dan Retribusi Daerah";

		
		$terbilang = $this->msistem->baca($data->setoran);
		
		$s = explode('/',$sptpd);
		$sptpd = $s[1];
		if($sptpd=='HTL'){
			$nama_sptpd = 'HOTEL';
		} else if($sptpd=='RES'){
			$nama_sptpd = 'RESTORAN';
		} else if($sptpd=='REK'){
			$nama_sptpd = 'REKLAME';
		} else if($sptpd=='HIB'){
			$nama_sptpd = 'HIBURAN';
		} else if($sptpd=='GAL'){
			$nama_sptpd = 'MINERAL BUKAN LOGAM DAN BATUAN';
		} else if($sptpd=='AIR'){
			$nama_sptpd = 'AIR TANAH';
		} else if($sptpd=='PKR'){
			$nama_sptpd = 'PARKIR';
		} else if($sptpd=='LIS'){
			$nama_sptpd = 'PENERANGAN JALAN';
		} else if($sptpd=='WLT'){
			$nama_sptpd = 'BURUNG WALET';
		}
				
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
		
		$dday = explode("-",$data->masa_pajak_1);
		$ddthn1 = $dday[0];
		$ddbln2 = $dday[1];
		$ddtgl3 = $dday[2];
		
		$dday2 = explode("-",$data->masa_pajak_2);
		$ddthn = $dday2[0];
		$ddbln = $dday2[1];
		$ddtgl = $dday2[2];
		
		$report = '';
		$report .= 
			'<table border=1>
				<tr>
					<td width="50" height="54" align="center" valign="middle">&nbsp;</td>
					<td width="200" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px;">
						PEMERINTAH KOTA JAMBI<br />
						<b>'.strtoupper($nama_badan).'</b><br />
						Jl. Jend. Basuki Rachmat Kota Baru <br/> Telepon (0741) 40284 Fax 40284
					</td>
					<td width="210" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:11px;">
						SURAT SETORAN PAJAK/RETRIBUSI DAERAH<br />
						<br/>
						Masa Pajak : &nbsp;'.$ddthn1.' - '.$ddthn.'
					</td>
					<td width="105" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px;">
						<br /><br />
						NOMOR	SETORAN<br />
						'.$no.'
					</td>
				</tr>
			</table>';
				
				$get="";
			if($npwpd_lama==null){
				$get="";
			}else{
				$get="( NPWPD LAMA : ".$npwpd_lama." )";
			}
			
		$report .=
			'<table border="1">
				<tr>
				<td width="565">
				<table>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
					<td width="110">&nbsp;&nbsp;  NAMA USAHA</td>
					<td width="10" align="center">:</td>
					<td width="345" >&nbsp;&nbsp;'.$nama.'</td>
					<td width="60" >&nbsp;&nbsp;NO BKP &nbsp; :</td>
				</tr>
				
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
					<td width="110">&nbsp;&nbsp;  ALAMAT USAHA</td>
					<td width="10" align="center">:</td>
					<td width="400">&nbsp;&nbsp;'.$alamat.'</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
					<td width="110">&nbsp;&nbsp;  NAMA PEMILIK</td>
					<td width="10" align="center">:</td>
					<td width="400">&nbsp;&nbsp;'.$namper.'</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
					<td width="110">&nbsp;&nbsp;  NPWPD</td>
					<td width="10" align="center">:</td>
					<td width="400">&nbsp;&nbsp;'.$npwpd.' &nbsp;&nbsp;'.$get.'</td>
				</tr>
				
				</table>
				</td>
				</tr>
			</table>';
			
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
					<td width="18" height="15" align="center">No</td>
					<td width="150" height="15" align="center">Kode Rekening</td>
					<td width="277" height="15" align="center">Uraian</td>
					<td width="120" height="15" align="center">Jumlah</td>
				</tr>';
		
		
			$child = $this->db->query("select * from sspd_detail where no_sspd ='".$no."'");
			$no = $this->db->query("select sptpd from view_no where no_sspd ='".$no."'")->row();
			$kode = $data->kode_pajak;
			$i = 1;
			if($kode=='REK'){
				$child = $child->row();
				$f = $this->db->query("select kd_rek, nm_rek, kawasan, trf, luas, unit, tarif, ketetapan from sptpd_reklame_detail where no_sptpd ='".$no->sptpd."'");
				foreach($f->result() as $ch) {
					
					if($ch->kd_rek=='4.1.1.03.16.'){
					$ch->kd_rek = '4.1.1.03.16';
				}
					
					$report .= '<tr id='.$i.'>
					  <td width="18" height="15" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">'.$i.'</td>
					  <td width="150" height="15" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">'.$ch->kd_rek.'</td>
					  <td width="277" height="15" align="left" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">&nbsp;&nbsp;&nbsp;'.$ch->nm_rek.'</td>
					  <td width="120" height="15" align="right" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">'.number_format($ch->ketetapan,2,',','.').'&nbsp;&nbsp;</td>
					</tr>';
				$i++;
				}
			} else {
				foreach($child->result() as $ch) {
					$report .= '<tr id='.$i.'>
					  <td width="18" height="15" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">'.$i.'</td>
					  <td width="80" height="15" align="center" style="font-family:  Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">'.$ch->kode_rekening.'</td>
					  <td width="160" height="15" align="center" style="font-family:  Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">'.$ch->nama_rekening.'</td>
					  <td width="187" height="15" align="center" style="font-family: Times new roman; font-size:12px; font-weight:bold;">'.number_format($ch->dp,2,',','.').' x '.$ch->tarif.'%</td>
					  <td width="120" height="15" align="right" style="font-family: Times new roman; font-size:12px; font-weight:bold;">'.number_format($ch->jumlah,2,',','.').'&nbsp;&nbsp;</td>
					</tr>';
				$i++;
				}
			}
		
		$report .=
				'<tr style="font-family: Times new roman; font-size:12px; font-weight:bold;">
					  <td colspan="3" height="15" width="445" align="right">Jumlah Setoran Pajak&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td width="120" height="15" align="right">'.number_format($data->setoran,2,',','.').'&nbsp;&nbsp;</td>
				</tr>
			</table>';
		
		$report .=
			'<table border="1">
				<tr>
					<td width="565">
					<table border="0">
						<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
							<td width="500" height="10" colspan="3">&nbsp;&nbsp;  - Bendahara Penerima / Bendahara Penerima Pembantu '.$nama_badan.' Kota Jambi<br/>&nbsp;    Telah menerima Uang sebesar Rp. '.number_format($data->setoran,2,',','.').'</td>							
						</tr>
						<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px;">
							<td width="90" height="10">&nbsp;&nbsp;  - Dengan huruf</td>
							<td width="10" align="center">:</td>
							<td width="420"><i>'.$terbilang.'</i>RUPIAH</td>
						</tr>						
					</table>
					</td>
				</tr>
			</table>';
					
				$nama3 = '';
				$nip3 = '';
				$bagian3= '';	
				if($tdd_id=="1"){	
				$s3 = $this->db->query("select nama, nip, bagian from admin where id = '164'")->row();
					if($s3==NULL){
						$nama3 = '';
						$nip3 = '';
						$bagian3= '';
					} else {
						$nama3 = $s3->nama;
						$nip3 = $s3->nip;
						$bagian3 = $s3->bagian;
					}	
				}else if($tdd_id=="2"){
					$s3 = $this->db->query("select nama, nip, bagian from admin where id = '175'")->row();
					if($s3==NULL){
						$nama3 = '';
						$nip3 = '';
						$bagian3= '';
					} else {
						$nama3 = $s3->nama;
						$nip3 = $s3->nip;
						$bagian3 = $s3->bagian;
					}	
				}else if($tdd_id=="3"){
					$s3 = $this->db->query("select nama, nip, bagian from admin where id = '176'")->row();
					if($s3==NULL){
						$nama3 = '';
						$nip3 = '';
						$bagian3= '';
					} else {
						$nama3 = $s3->nama;
						$nip3 = $s3->nip;
						$bagian3 = $s3->bagian;
					}	
				}
				
		$admin = $this->session->userdata('username');
		
		$report .=
			'<table border="1">
				<tr>
				<td width="565">
				<table border="0">
					
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
						<td width="240" align="center">&nbsp;</td>
						<td width="70" align="center">&nbsp;</td>
						<td width="240" align="center">Jambi, '.$created.'</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
						<td width="240" align="center">'.$bagian3.'</td>
						<td width="70" align="center"></td>
						<td width="240" align="center"></td>
					</tr>
					<tr>
						<td width="240" align="center">&nbsp;</td>
						<td width="70" align="center">&nbsp;</td>
						<td width="240" align="center">&nbsp;</td>
					</tr>
					<tr>
						<td width="240" height="20">&nbsp;</td>
						<td width="70" height="20">&nbsp;</td>
						<td width="240" height="20">&nbsp;</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
						<td width="240" align="center"><u> '.$nama3.' </u></td>
						<td width="70" align="center"></td>
						<td width="240" align="center"><u> '.$nama.' </u></td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
						<td width="240" align="center">NIP. '.$nip3.'</td>
						<td width="70" align="center"></td>
						<td width="240" align="center"></td>
					</tr>
					
				</table>
				</td>
				</tr>
			</table>
			<table border="1">
				<tr>
					<td width="565">
					<table border="0">						
						<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
							<td width="10" align="center"></td>
							<td width="60" align="left"><font size="8">Lembar Asli</font></td>
							<td width="5" align="left">:</td>
							<td width="210" align="justify"><font size="8">Untuk Pembayaran / Penyetoran / Pihak Ketiga</font></td>
							<td width="10" align="center"></td>
							<td width="60" align="left"><font size="8">Salinan 1</font></td>
							<td width="5" align="left">:</td>
							<td width="210" align="justify"><font size="8">Untuk Bendahara Penerima / Bendahara Pembantu</font></td>							
						</tr>		
						<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold;">
							<td width="10" align="center"></td>
							<td width="60" align="left"><font size="8">Salinan 2</font></td>
							<td width="5" align="left">:</td>
							<td width="210" align="justify"><font size="8">Untuk Kabid Akuntansi dan Pelaporan</font></td>
							<td width="10" align="center"></td>
							<td width="60" align="left"><font size="8">Salinan 3</font></td>
							<td width="5" align="left">:</td>
							<td width="210" align="justify"><font size="8">Untuk Kabid Pendataan, Penetapan dan Penagihan</font></td>							
						</tr>																							
					</table>
					</td>
				</tr>
			</table>';
			
		//$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_SSPD'.'.pdf', 'I');
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
