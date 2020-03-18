<?php
class msistem extends CI_Model
{
    function loginCheck($username,$pass)
    {
        $sql = "SELECT a.username,a.id_modul
                FROM admin a
                 ";
                    $sql .="WHERE a.username = ? and a.password = ? and a.app = 1 LIMIT 1";
                    $q = $this->db->query($sql,array($username,$pass));
		// periode kerja
		if($q->num_rows()==1)
        {
            $r = $q->row();
            $sessiondata = array(
                'id_modul' => $r->id_modul,
                'username' => $r->username,
				);
//            print_r($sessiondata);
            $this->session->set_userdata($sessiondata);
            return true;
        } else {
            return false;
        }
    }
	
	function tanggal() {
		$tgl = "";
		for($i=1;$i<=31;$i++) {
			if(strlen($i)=='1') { 
				$n = '0'.$i;
			} else {
				$n = $i;
			}
			if($n==date('d')) { $select = "selected=\"selected\""; } else { $select = ''; }
			$tgl .= '<option value="'.$n.'" '.$select.'>'.$i.'</option>';
		}
		return $tgl;
	}
    
     function  getBulan($bln){
        switch  ($bln){
        case  1:
        return  "Januari";
        break;
        case  2:
        return  "Februari";
        break;
        case  3:
        return  "Maret";
        break;
        case  4:
        return  "April";
        break;
        case  5:
        return  "Mei";
        break;
        case  6:
        return  "Juni";
        break;
        case  7:
        return  "Juli";
        break;
        case  8:
        return  "Agustus";
        break;
        case  9:
        return  "September";
        break;
        case  10:
        return  "Oktober";
        break;
        case  11:
        return  "November";
        break;
        case  12:
        return  "Desember";
        break;
    }
    }
    
     function  tanggal_format_indonesia($tgl){
            
        $tanggal  = explode('-',$tgl); 
        $bulan  = $this-> getBulan($tanggal[1]);
        $tahun  =  $tanggal[0];
        return  $tanggal[2].' '.$bulan.' '.$tahun;

    }
	
	function format_bulan_tahun($tgl){
		$tanggal  = explode('-',$tgl); 
        $bulan  = $this-> getBulan($tanggal[1]);
        $tahun  =  $tanggal[0];
        return  $bulan.' '.$tahun;
	}
	
	function bulan() {
		$bln = "";
		for($i=1;$i<=12;$i++) {
			if(strlen($i)=='1') { 
				$n = '0'.$i;
			} else {
				$n = $i;
			}
			$arrBln = array ("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
			if($n==date('m')) { $select = "selected=\"selected\""; } else { $select = ''; }
			$bln .= '<option value="'.$n.'" '.$select.'>'.$arrBln[$i-1].'</option>';
		}
		return $bln;
	}
	
	function tahun() {
		$thn = "";
		for($i=date("Y")-6;$i<=date("Y");$i++) {
			if($i==date('Y')) { $select = "selected=\"selected\""; } else { $select = ''; }
			$thn .= '<option value="'.$i.'" '.$select.'>'.$i.'</option>';
		}
		return $thn;
	}
	
	function view_tanggal() {
		$tgl = date('d');
		$bln = date('n') - 1;
		$thn = date('Y');
		return $tgl." ".$this->view_bln($bln)." ".$thn;
			
	}
	
	function view_bln($id) {
		$arrBln = array ("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		return $arrBln[$id];	
	}
	
	function v_bln($id){
		$bln = "";
		if($id=='01'){
			$bln = 'Januari';
		} else if($id=='02'){
			$bln = 'Februari';
		} else if($id=='03'){
			$bln = 'Maret';
		} else if($id=='04'){
			$bln = 'April';
		} else if($id=='05'){
			$bln = 'Mei';
		} else if($id=='06'){
			$bln = 'Juni';
		} else if($id=='07'){
			$bln = 'Juli';
		} else if($id=='08'){
			$bln = 'Agustus';
		} else if($id=='09'){
			$bln = 'September';
		} else if($id=='10'){
			$bln = 'Oktober';
		} else if($id=='11'){
			$bln = 'November';
		} else if($id=='12'){
			$bln = 'Desember';
		}else if($id=='00'){
			$bln = '00';
		}
		return $bln;
	}
	
	function c_bln($id){
		$bln = "";
		if($id=='01'){
			$bln = 'Jan';
		} else if($id=='02'){
			$bln = 'Feb';
		} else if($id=='03'){
			$bln = 'Mar';
		} else if($id=='04'){
			$bln = 'Apr';
		} else if($id=='05'){
			$bln = 'Mei';
		} else if($id=='06'){
			$bln = 'Jun';
		} else if($id=='07'){
			$bln = 'Jul';
		} else if($id=='08'){
			$bln = 'Agust';
		} else if($id=='09'){
			$bln = 'Sep';
		} else if($id=='10'){
			$bln = 'Okt';
		} else if($id=='11'){
			$bln = 'Nov';
		} else if($id=='12'){
			$bln = 'Des';
		}
		return $bln;
	}
	
	function conversiTgl($tgl) {
		$arr = preg_split('[/]',$tgl);
		return $arr[2].'-'.$arr[1].'-'.$arr[0];	
	}
	
	function format_angka($nilai) {
		if($nilai==0) {
			$angka = "";
		} else {
			$angka = number_format($nilai,0,',','.');
		}
		return $angka;
	}
	
	
	function rp_minus($nilai){
        if($nilai<0){
            $nilai = $nilai * (-1);
            $nilai = '('.number_format($nilai,2,",",".").')';    
        }else{
            $nilai = number_format($nilai,2,",","."); 
        }
        
        return $nilai;
    }
	
	function baca($n) {
	    $this->dasar = array(1 => 'SATU', 'DUA', 'TIGA', 'EMPAT', 'LIMA', 'ENAM','TUJUH', 'DELAPAN', 'SEMBILAN');
	    $this->angka = array(1000000000, 1000000, 1000, 100, 10, 1);
	    $this->satuan = array('MILYAR', 'JUTA', 'RIBU', 'RATUS', 'PULUH', '');
	 
	    $i = 0;
	    if($n==0){
	    	$str = "NOL";
	    }else{
			$str = "";
	       	while ($n != 0) {
	        	$count = (int)($n/$this->angka[$i]);
	      		if($count >= 10) {
	          		$str .= $this->baca($count). " ".$this->satuan[$i]." ";
	      		}else if($count > 0 && $count < 10){
	          		$str .= $this->dasar[$count] . " ".$this->satuan[$i]." ";
	      		}
			  	$n -= $this->angka[$i] * $count;
			  	$i++;
		   }
		   $str = preg_replace("/SATU PULUH (\w+)/i", "\\1 BELAS", $str);
		   $str = preg_replace("/SATU (RIBU|RATUS|PULUH|BELAS)/i", "SE\\1", $str);
		}
		$list = $str.'';
    	return $list;
  	}
        
          function get_total_SPTPD($tanggal){
              $tahun = date("y",strtotime($tanggal));
              $sql = "select count(id) as jml_sptpd from sptpd where no_sptpd like '%/$tahun'";
              $jumlah_no_sptpd = $this->db->query($sql)->row();
              if($jumlah_no_sptpd==NULL){
                  return 0;
              }else{
                  $no_sptpd = $jumlah_no_sptpd->jml_sptpd;
                  return $no_sptpd;
              }
          }
	
	
}
?>
