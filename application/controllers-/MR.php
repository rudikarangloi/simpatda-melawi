<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class MR extends MY_Controller {
	
	function __construct() {
            parent::__construct();
            $this->load->model('msistem');
    }
    
    function realisasi_tahunan(){
        
		$x = date('Y');
		$n = date('Y');
		
		$thn = "";
		$hotel = "";
		$restoran = "";
		$reklame = "";
		$hiburan = "";
		$listrik = "";
		$parkir = "";
		$galian = "";
		$air = "";
		$walet = "";
		
		for($i=$x;$i<=$n;$i++) {
			if(strlen($i)==1){
				$i = '0'.$i;
			} else {
				$i;
			}
			$thn .= "'".$i."'";
			if($i != $n):
				$thn .= ", ";
			endif;
			$tahun = $i;
			
			// Data Jumlah sptpd_hotel
			$sql = $this->db->query("select sum(setoran) as jml from sspd where tahun_pajak = '".$tahun."' and nomor like '%HTL%'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$hotel .= $rs;
			if($i != $n):
				$hotel .= ", ";
			endif;
			
			$sql = $this->db->query("select sum(setoran) as jml from sspd where tahun_pajak = '".$tahun."' and nomor like '%RES%'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$restoran .= $rs;
			if($i != $n):
				$restoran .= ", ";
			endif;
			
			// Data setoran sptpd_hotel
			$sql = $this->db->query("select sum(setoran) as jml from sspd where tahun_pajak = '".$tahun."' and nomor like '%REK%'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$reklame .= $rs;
			if($i != $n):
				$reklame .= ", ";
			endif;
			
			// Data setoran sptpd_hotel
			$sql = $this->db->query("select sum(setoran) as jml from sspd where tahun_pajak = '".$tahun."' and nomor like '%HIB%'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$hiburan .= $rs;
			if($i != $n):
				$hiburan .= ", ";
			endif;
			
			// Data setoran sptpd_hotel
			$sql = $this->db->query("select sum(setoran) as jml from sspd where tahun_pajak = '".$tahun."' and nomor like '%LIS%'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$listrik .= $rs;
			if($i != $n):
				$listrik .= ", ";
			endif;
			
			// Data setoran sptpd_hotel
			$sql = $this->db->query("select sum(setoran) as jml from sspd where tahun_pajak = '".$tahun."' and nomor like '%PKR%'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$parkir .= $rs;
			if($i != $n):
				$parkir .= ", ";
			endif;
			
			// Data setoran sptpd_hotel
			$sql = $this->db->query("select sum(setoran) as jml from sspd where tahun_pajak = '".$tahun."' and nomor like '%GAL%'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$galian .= $rs;
			if($i != $n):
				$galian .= ", ";
			endif;
			
			// Data setoran sptpd_hotel
			$sql = $this->db->query("select sum(setoran) as jml from sspd where tahun_pajak = '".$tahun."' and nomor like '%WLT%'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$walet .= $rs;
			if($i != $n):
				$walet .= ", ";
			endif;
			
			// Data setoran sptpd_hotel
			$sql = $this->db->query("select sum(setoran) as jml from sspd where tahun_pajak = '".$tahun."' and nomor like '%AIR%'")->row();
			$rs = $sql->jml;
			if($rs==NULL){
				$rs = 0;
			}
			$air .= $rs;
			if($i != $n):
				$air .= ", ";
			endif;

		}
		//$data['tahun'] = date('Y');
//		$data['thn'] = $thn;
//		$data['hotel'] = $hotel;
//		$data['restoran'] = $restoran;
//		$data['reklame'] = $reklame;
//		$data['hiburan'] = $hiburan;
//		$data['parkir'] = $parkir;
//		$data['listrik'] = $listrik;
//		$data['galian'] = $galian;
//		$data['air'] = $air;
//		$data['walet'] = $walet;
//		
        
        echo "Realisasi Pajak Daerah Tahun : $thn";
		echo "Pajak Hotel : $hotel ";
        echo $restoran;
        

	}

    
    
}
?>