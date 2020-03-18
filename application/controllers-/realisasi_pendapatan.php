<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class realisasi_pendapatan extends MY_Controller {
	
	function __construct() {
            parent::__construct();
            $this->load->model('mrealisasi');
    }

    public function lap_realisasi(){
		$data['tahun'] = $this->mrealisasi->tahun();
		$data['bulan'] = $this->mrealisasi->bulan();
		$this->load->view('realisasi_pendapatan/lap_realisasi_1',$data);
	}
    
    public function lap_realisasi_rekap(){
		$data['tahun'] = $this->mrealisasi->tahun();
		$data['bulan'] = $this->mrealisasi->bulan();
		$this->load->view('realisasi_pendapatan/lap_realisasi_rekap',$data);
	}
	
    
    function penerima_rekap($kdrek,$bulann,$tahunn)
    {   
        $q1 = "SELECT SUM(trdkasin_pkd.rupiah) AS penerima_rekap FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
							  WHERE LEFT(trdkasin_pkd.kd_rek5,3) = '$kdrek' AND MONTH(trhkasin_pkd.tgl_sts) = '$bulann' AND YEAR(trhkasin_pkd.tgl_sts) = '$tahunn'";                              
		$p=$this->db->query($q1)->row();
        
        if ($this->db->query($q1)->num_rows() <0 ){
            $terima_rekap = 0;    
        }else{
		$terima_rekap =$p->penerima_rekap;
        }

		return $terima_rekap;
	}	
    
    function penerima_rekap_41($bulann,$tahunn)
    {   
        $q1 = "SELECT SUM(trdkasin_pkd.rupiah) AS penerima_rekap FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
							  WHERE LEFT(trdkasin_pkd.kd_rek5,2) = '41' AND MONTH(trhkasin_pkd.tgl_sts) = '$bulann' AND YEAR(trhkasin_pkd.tgl_sts) = '$tahunn'";                              
		$p=$this->db->query($q1)->row();
        
        if ($this->db->query($q1)->num_rows() <0 ){
            $terima_rekap_41 = 0;    
        }else{
		$terima_rekap_41 =$p->penerima_rekap;
        }

		return $terima_rekap_41;
	}		

    function penerima_rekap_42($bulann,$tahunn)
    {   
        $q1 = "SELECT SUM(trdkasin_pkd.rupiah) AS penerima_rekap FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
							  WHERE LEFT(trdkasin_pkd.kd_rek5,2) = '42' AND MONTH(trhkasin_pkd.tgl_sts) = '$bulann' AND YEAR(trhkasin_pkd.tgl_sts) = '$tahunn'";                              
		$p=$this->db->query($q1)->row();
        
        if ($this->db->query($q1)->num_rows() <0 ){
            $terima_rekap_42 = 0;    
        }else{
		$terima_rekap_42 =$p->penerima_rekap;
        }

		return $terima_rekap_42;
	}		
    
    function penerima_rekap_43($bulann,$tahunn)
    {   
        $q1 = "SELECT SUM(trdkasin_pkd.rupiah) AS penerima_rekap FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
							  WHERE LEFT(trdkasin_pkd.kd_rek5,2) = '43' AND MONTH(trhkasin_pkd.tgl_sts) = '$bulann' AND YEAR(trhkasin_pkd.tgl_sts) = '$tahunn'";                              
		$p=$this->db->query($q1)->row();
        
        if ($this->db->query($q1)->num_rows() <0 ){
            $terima_rekap_43 = 0;    
        }else{
		$terima_rekap_43 =$p->penerima_rekap;
        }

		return $terima_rekap_43;
	}		
    
	function penerima2_rekap($kdrek,$bulann,$tahunn)
	{
		$bulanlalu = floatval($bulann) - 1;
        $q1 = "SELECT SUM(trdkasin_pkd.rupiah) AS penerima_lalu FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
        WHERE LEFT(trdkasin_pkd.kd_rek5,3) = '$kdrek'  AND MONTH(trhkasin_pkd.tgl_sts) BETWEEN '01' AND '$bulanlalu' AND YEAR(trhkasin_pkd.tgl_sts) = '$tahunn'";
        $p2=$this->db->query($q1)->row();
	   
         if ($this->db->query($q1)->num_rows() <0 ){            
            $terima_lalu_rekap = 0;    
        }else{
	
		$terima_lalu_rekap = $p2->penerima_lalu;
        }
		return $terima_lalu_rekap;
        
	}
    
    function penerima2_totalrekap($kdrek,$bulann,$tahunn){
        //$bulanlalu = floatval($bulann) - 1;
        $q1 = "SELECT SUM(trdkasin_pkd.rupiah) AS penerima_bln_lalu,(SELECT SUM(trdkasin_pkd.rupiah) AS penerima_lalu FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
        WHERE LEFT(trdkasin_pkd.kd_rek5,3) = '$kdrek' AND MONTH(trhkasin_pkd.tgl_sts) = '$bulann' AND YEAR(trhkasin_pkd.tgl_sts) = '$tahunn') 
        AS penerima_bln FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
        WHERE LEFT(trdkasin_pkd.kd_rek5,3) = '$kdrek' AND YEAR(trhkasin_pkd.tgl_sts) = '$tahunn'";
        $p2=$this->db->query($q1)->row();
	   
         if ($this->db->query($q1)->num_rows() <0 ){
            $terima_bln_lalu_rekap = 0; 
            $terima_bln_rekap = 0;   
        }else{
	
		$terima_bln_lalu_rekap = $p2->penerima_bln_lalu;
        $terima_bln_rekap = $p2->penerima_bln;
        }
        
        
        $penerima2_totalrekap = floatval($terima_bln_lalu_rekap) - floatval($terima_bln_rekap);                
        
		//return $penerima2_totalrekap;
        return $terima_bln_lalu_rekap;
        
    }
    
    function penerima2_rekap_41($bulann,$tahunn)
	{
		$bulanlalu = floatval($bulann) - 1;
        $q1 = "SELECT SUM(trdkasin_pkd.rupiah) AS penerima_lalu FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
        WHERE LEFT(trdkasin_pkd.kd_rek5,2) = '41'  AND MONTH(trhkasin_pkd.tgl_sts) BETWEEN '01' AND '$bulanlalu' AND YEAR(trhkasin_pkd.tgl_sts) = '$tahunn'";
        $p2=$this->db->query($q1)->row();
	   
         if ($this->db->query($q1)->num_rows() <0 ){
            $terima_lalu_rekap_41 = 0;    
        }else{
	
		$terima_lalu_rekap_41 = $p2->penerima_lalu;
        }
		return $terima_lalu_rekap_41;

	}
    
    function penerima2_rekap_42($bulann,$tahunn)
	{
		$bulanlalu = floatval($bulann) - 1;
        $q1 = "SELECT SUM(trdkasin_pkd.rupiah) AS penerima_lalu FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
        WHERE LEFT(trdkasin_pkd.kd_rek5,2) = '42'  AND MONTH(trhkasin_pkd.tgl_sts) BETWEEN '01' AND '$bulanlalu' AND YEAR(trhkasin_pkd.tgl_sts) = '$tahunn'";
        $p2=$this->db->query($q1)->row();
	   
         if ($this->db->query($q1)->num_rows() <0 ){
            $terima_lalu_rekap_42 = 0;    
        }else{
	
		$terima_lalu_rekap_42 = $p2->penerima_lalu;
        }
		return $terima_lalu_rekap_42;

	}
    
    function penerima2_rekap_43($bulann,$tahunn)
	{
		$bulanlalu = floatval($bulann) - 1;
        $q1 = "SELECT SUM(trdkasin_pkd.rupiah) AS penerima_lalu FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
        WHERE LEFT(trdkasin_pkd.kd_rek5,2) = '43'  AND MONTH(trhkasin_pkd.tgl_sts) BETWEEN '01' AND '$bulanlalu' AND YEAR(trhkasin_pkd.tgl_sts) = '$tahunn'";
        $p2=$this->db->query($q1)->row();
	   
         if ($this->db->query($q1)->num_rows() <0 ){
            $terima_lalu_rekap_43 = 0;    
        }else{
	
		$terima_lalu_rekap_43 = $p2->penerima_lalu;
        }
		return $terima_lalu_rekap_43;

	}
    
    function anggaran_rekap($kdrek){        
        /*$q1 = "SELECT SUM(trdrka.nilai) AS anggaran FROM trdrka INNER JOIN trdkasin_pkd ON trdkasin_pkd.kd_rek5 = trdrka.kd_rek5 
INNER JOIN trhkasin_pkd ON trhkasin_pkd.kd_skpd = trdkasin_pkd.kd_skpd
WHERE LEFT(trdrka.kd_rek5,3) = '$kdrek' AND MONTH(trhkasin_pkd.tgl_sts) = '$bulann' AND YEAR(trhkasin_pkd.tgl_sts) = '$tahunn'";*/
        $q1 = "SELECT SUM(trdrka.nilai) AS anggaran FROM trdrka 
        WHERE LEFT(trdrka.kd_rek5,3) = '$kdrek' ";
        $p2=$this->db->query($q1)->row();
	   
        
         if ($this->db->query($q1)->num_rows() <0 ){
            $anggaran_rekap = 0;    
        }else{
		$anggaran_rekap = $p2->anggaran;
        }
		return $anggaran_rekap;
    }        
    
    function anggaran_rekap_41($bulann,$tahunn){        
        /*$q1 = "SELECT SUM(trdrka.nilai) AS anggaran FROM trdrka INNER JOIN trdkasin_pkd ON trdkasin_pkd.kd_rek5 = trdrka.kd_rek5 
INNER JOIN trhkasin_pkd ON trhkasin_pkd.kd_skpd = trdkasin_pkd.kd_skpd
WHERE LEFT(trdrka.kd_rek5,2) = '41' AND MONTH(trhkasin_pkd.tgl_sts) = '$bulann' AND YEAR(trhkasin_pkd.tgl_sts) = '$tahunn'";*/
        $q1 = "SELECT SUM(trdrka.nilai) AS anggaran FROM trdrka 
        WHERE LEFT(trdrka.kd_rek5,2) = '41'";
        $p2=$this->db->query($q1)->row();
	           
         if ($this->db->query($q1)->num_rows() <0 ){
            $anggaran_rekap = 0;    
        }else{
		$anggaran_rekap_41 = $p2->anggaran;
        }
		return $anggaran_rekap_41;
    }
    
    function anggaran_rekap_42($bulann,$tahunn){        
        /*$q1 = "SELECT SUM(trdrka.nilai) AS anggaran FROM trdrka INNER JOIN trdkasin_pkd ON trdkasin_pkd.kd_rek5 = trdrka.kd_rek5 
INNER JOIN trhkasin_pkd ON trhkasin_pkd.kd_skpd = trdkasin_pkd.kd_skpd
WHERE LEFT(trdrka.kd_rek5,2) = '42' AND MONTH(trhkasin_pkd.tgl_sts) = '$bulann' AND YEAR(trhkasin_pkd.tgl_sts) = '$tahunn'";*/
        $q1 = "SELECT SUM(trdrka.nilai) AS anggaran FROM trdrka 
        WHERE LEFT(trdrka.kd_rek5,2) = '42'";
        $p2=$this->db->query($q1)->row();
	   
        
         if ($this->db->query($q1)->num_rows() <0 ){
            $anggaran_rekap = 0;    
        }else{
		$anggaran_rekap_42 = $p2->anggaran;
        }
		return $anggaran_rekap_42;
    }
    
    function anggaran_rekap_43($bulann,$tahunn){        
        /*$q1 = "SELECT SUM(trdrka.nilai) AS anggaran FROM trdrka INNER JOIN trdkasin_pkd ON trdkasin_pkd.kd_rek5 = trdrka.kd_rek5 
INNER JOIN trhkasin_pkd ON trhkasin_pkd.kd_skpd = trdkasin_pkd.kd_skpd
WHERE LEFT(trdrka.kd_rek5,2) = '43' AND MONTH(trhkasin_pkd.tgl_sts) = '$bulann' AND YEAR(trhkasin_pkd.tgl_sts) = '$tahunn'";*/
        $q1 = "SELECT SUM(trdrka.nilai) AS anggaran FROM trdrka 
        WHERE LEFT(trdrka.kd_rek5,2) = '43'";
        $p2=$this->db->query($q1)->row();
	   
        
         if ($this->db->query($q1)->num_rows() <0 ){
            $anggaran_rekap = 0;    
        }else{
		$anggaran_rekap_43 = $p2->anggaran;
        }
		return $anggaran_rekap_43;
    }
    
	public function data_periode_lap_rekapitulasi($periode=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		$p = explode('-',$periode);
		
			//2015-04			
			$bulann = substr($periode,6,2);
			$tahunn = substr($periode,0,4);
			
    $sqll = "SELECT * FROM (SELECT kelompok,nm_rek3,kd_rek3 FROM ms_rek3)a 
    WHERE kelompok IS NOT NULL AND LEFT(kelompok,1)='4' ORDER BY kelompok";                
        $hasil = $this->db->query($sqll);
        foreach ($hasil->result() as $sql)
        {                                   
            $no=$no+1;            
            $kdrek = $sql->kd_rek3;                        
					//$jumlah_anggaran=$this->anggaran_rekap($kdrek,$bulann,$tahunn);
                    $jumlah_anggaran=$this->anggaran_rekap($kdrek);
					$terima_rekap=$this->penerima_rekap($kdrek,$bulann,$tahunn);					
					$terima_lalu_rekap=$this->penerima2_rekap($kdrek,$bulann,$tahunn);					
					//$jumlah_anggaran_reals_rekap=$terima_rekap+$terima_lalu_rekap;
                    $jumlah_anggaran_reals_rekap=$this->penerima2_totalrekap($kdrek,$bulann,$tahunn);					
					$sisa_anggaran_blm_setor_rekap=$jumlah_anggaran-$jumlah_anggaran_reals_rekap;                    
					
                    if ($jumlah_anggaran==0){
                        $jumlah_anggaran = 0;
                        $persen = 0;                                                
                    }else{
                        $jumlah_anggaran=$this->anggaran_rekap($kdrek,$bulann,$tahunn);
                        $persen=$jumlah_anggaran_reals_rekap/$jumlah_anggaran*100;                    					                        
                    }
                    
                    if ($terima_rekap==0){
                        $terima_rekap = 0;
                    }else{
                        $terima_rekap=$this->penerima_rekap($kdrek,$bulann,$tahunn);    
                    }
                    
                    if($terima_lalu_rekap==0){
                        $terima_lalu_rekap = 0;
                    }else{
                        $terima_lalu_rekap=$this->penerima2_rekap($kdrek,$bulann,$tahunn);
                    }
                    
					$persen=$jumlah_anggaran_reals_rekap/$jumlah_anggaran*100;
					$persen=number_format($persen,2,",",".");            			
            
			echo ("<row>");
				echo("<cell><![CDATA[".$no."]]></cell>");
				echo("<cell><![CDATA[".$sql->kelompok."]]></cell>");
				echo("<cell><![CDATA[".$sql->nm_rek3."]]></cell>");
				echo("<cell><![CDATA[".$jumlah_anggaran."]]></cell>");
				echo("<cell><![CDATA[".$terima_rekap."]]></cell>");
				echo("<cell><![CDATA[".$terima_lalu_rekap."]]></cell>");
				echo("<cell><![CDATA[".$jumlah_anggaran_reals_rekap."]]></cell>");
				echo("<cell><![CDATA[".$persen."]]></cell>");
				echo("<cell><![CDATA[".$sisa_anggaran_blm_setor_rekap."]]></cell>");
			echo("</row>");			
			}
		echo "</rows>";
	}
		
	
	function cetak_lap_rekapitulasi(){
		$p = $_GET['full'];
		$o = explode('|',$p);
		$periode = $o[0];		
		$ttd = $o[1];
		
		$t = explode('-',$periode);
		$bln = $t[1];
		$thn = $t[0];
		$bulan = $this->mrealisasi->v_bln($bln);
        $tahun = $thn - 1;
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_SIGI');
		$pdf->SetKeywords('SOPD_SIGI');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(10);
		$pdf->SetMargins(50,50,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 6);
	
		$pdf->AddPage('L','A3',false);
		//set data
		$report = '';
		$report .=
			'<h2>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			LAPORAN REKAPITULASI<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;            			
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;
			BULAN '.strtoupper($bulan).'&nbsp;'.$thn.'</h2>';
			
		$report .=
			'<table border="1" cellspacing="1" cellpadding="2">
				<tr bgcolor=#EEE>
					<td width="5%" height="10" align="center"><strong>NO.</strong></td>
					<td width="8%" height="10" align="center"><strong>Kode Rekening</strong></td>
					<td width="25%" height="12" align="center"><strong>Uraian</strong></td>
					<td width="10%" height="12" align="center"><strong>Jumlah Anggaran</strong></td>
					<td width="10%" height="12" align="center"><strong>Penerimaan Bulan Ini</strong></td>
					<td width="10%" height="12" align="center"><strong>Penerimaan Bulan Lalu</strong></td>
					<td width="10%" height="12" align="center"><strong>Penerimaan Sampai Bulan Ini</strong></td>
					<td width="8%" height="12" align="center"><strong>Presentase Penerimaan</strong></td>
					<td width="10%" height="12" align="center"><strong>Sisa Target <br/>TA. '.$tahun.'</strong></td>
				</tr>
				<tr bgcolor=#DDD>
					<td width="5%" height="10" align="center"><strong><i>1</i></strong></td>
					<td width="8%" height="10" align="center"><strong><i>2</i></strong></td>
					<td width="25%" height="12" align="center"><strong><i>3</i></strong></td>
					<td width="10%" height="12" align="center"><strong><i>4</i></strong></td>
					<td width="10%" height="12" align="center"><strong><i>5</i></strong></td>
					<td width="10%" height="12" align="center"><strong><i>6</i></strong></td>
					<td width="10%" height="12" align="center"><strong><i>7</i></strong></td>
					<td width="8%" height="12" align="center"><strong><i>8</i></strong></td>
					<td width="10%" height="12" align="center"><strong><i>9</i></strong></td>
				</tr>';
		$no = 0;
		$a = '';
		$b = '';
		$c = 0;
		$d = 0;
		$e = 0;
		$f = 0;
		$g = 0;
		$h = 0;
		$x = 0;	
        			
			$bulann = substr($periode,6,2);
			$tahunn = substr($periode,0,4);			
			
/*$sqll = "SELECT * FROM (SELECT kelompok,nm_rek2,kd_rek2 FROM ms_rek2 UNION SELECT kelompok,nm_rek3,kd_rek3 FROM ms_rek3)a 
WHERE kelompok IS NOT NULL AND LEFT(kelompok,1)='4' ORDER BY kelompok";*/                
$sqll = "SELECT * FROM (SELECT kelompok,nm_rek3,kd_rek3 FROM ms_rek3)a 
WHERE kelompok IS NOT NULL AND LEFT(kelompok,1)='4' ORDER BY kelompok";
        $hasil = $this->db->query($sqll);
        foreach ($hasil->result() as $sql)
        {                                   
            $no=$no+1;            
            $kdrek = $sql->kd_rek3;                        
					                    
                    $jumlah_anggaran=$this->anggaran_rekap($kdrek);
					$terima_rekap=$this->penerima_rekap($kdrek,$bulann,$tahunn);					
					$terima_lalu_rekap=$this->penerima2_rekap($kdrek,$bulann,$tahunn);					
                    $jumlah_anggaran_reals_rekap=$this->penerima2_totalrekap($kdrek,$bulann,$tahunn);					
					$sisa_anggaran_blm_setor_rekap=$jumlah_anggaran-$jumlah_anggaran_reals_rekap;										
                    
                    if ($jumlah_anggaran==0){
                        $jumlah_anggaran = 0;
                        $persen = 0;                                                
                    }else{
                        $jumlah_anggaran=$this->anggaran_rekap($kdrek,$bulann,$tahunn);
                        $persen=$jumlah_anggaran_reals_rekap/$jumlah_anggaran*100;                    					                        
                    }
                    
                    if ($terima_rekap==0){
                        $terima_rekap = 0;
                    }else{
                        $terima_rekap=$this->penerima_rekap($kdrek,$bulann,$tahunn);    
                    }
                    
                    if($terima_lalu_rekap==0){
                        $terima_lalu_rekap = 0;
                    }else{
                        $terima_lalu_rekap=$this->penerima2_rekap($kdrek,$bulann,$tahunn);
                    }                                        
                    
                    $persen=number_format($persen,2,",",".");
                                                	
			$report .=
				'<tr>
					<td width="5%" height="10" align="center">'.$no.'</td>
					<td width="8%" height="12" align="center">'.$sql->kelompok.'</td>
					<td width="25%" height="12" align="left">'.$sql->nm_rek3.'</td>
					<td width="10%" height="12" align="right">'.number_format($jumlah_anggaran,0).'&nbsp;</td>
					<td width="10%" height="12" align="right">'.number_format($terima_rekap,0).'&nbsp;</td>
					<td width="10%" height="12" align="right">'.number_format($terima_lalu_rekap,0).'&nbsp;</td>
					<td width="10%" height="12" align="right">'.number_format($jumlah_anggaran_reals_rekap,0).'&nbsp;</td>
					<td width="8%" height="12" align="right">'.number_format($persen,0).'% &nbsp;</td>
					<td width="10%" height="12" align="right">'.number_format($sisa_anggaran_blm_setor_rekap,0).'&nbsp;</td>
				</tr>';
				
/*$sqll = "SELECT count(*) as total_persen FROM (SELECT kelompok,nm_rek2,kd_rek2 FROM ms_rek2 UNION SELECT kelompok,nm_rek3,kd_rek3 FROM ms_rek3)a 
WHERE kelompok IS NOT NULL AND LEFT(kelompok,1)='4' ORDER BY kelompok";                
        $hasil = $this->db->query($sqll);
        foreach ($hasil->result() as $sql1)
        {
			$tot_persen = $sql1->total_persen;			
		}
		
				/*$c = $c + $jumlah_anggaran;
				$d = $d + $terima_rekap;
				$e = $e + $terima_lalu_rekap;
				$f = $f + $jumlah_anggaran_reals_rekap;
				$g = $g + $persen;
				$x = $g/$tot_persen;
				$h = $h + $sisa_anggaran_blm_setor_rekap;*/
		}
		        
        $jumlah_anggaran_41=$this->anggaran_rekap_41($bulann,$tahunn);
        $terima_rekap_41=$this->penerima_rekap_41($bulann,$tahunn);
        $terima_lalu_rekap_41=$this->penerima2_rekap_41($bulann,$tahunn);
        $jumlah_anggaran_reals_rekap_41 = $terima_rekap_41 + $terima_lalu_rekap_41;
        if ($jumlah_anggaran_41==0){
                        $jumlah_anggaran_41 = 0;
                        $persen_41 = 0;                                                
                    }else{
                        $jumlah_anggaran_41=$this->anggaran_rekap_41($bulann,$tahunn);
                        $persen_41=$jumlah_anggaran_reals_rekap_41/$jumlah_anggaran_41*100;                                            					                        
                    }
                            
        if ($terima_rekap_41==0){
                        $terima_rekap_41 = 0;
                    }else{
                        $terima_rekap_41=$this->penerima_rekap_41($bulann,$tahunn);    
                    }
                                                        
        if($terima_lalu_rekap_41==0){
                        $terima_lalu_rekap_41 = 0;
                    }else{
                        $terima_lalu_rekap_41=$this->penerima2_rekap_41($bulann,$tahunn);
                    }        
        $target_41 = $jumlah_anggaran_41 - $jumlah_anggaran_reals_rekap_41;                              
        //$persen_41=number_format($persen_41,2,",",".");                    
		$report .=
				'<tr bgcolor=#EEE >
					<td colspan="3" width="38.2%" align="center"><strong>I. 4.1 TOTAL PAD</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($jumlah_anggaran_41,0).'&nbsp;</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($terima_rekap_41,0).'&nbsp;</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($terima_lalu_rekap_41,0).'&nbsp;</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($jumlah_anggaran_reals_rekap_41,0).'&nbsp;</strong></td>
					<td width="8%" height="12" align="right"><strong>'.number_format($persen_41,0).'% &nbsp;</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($target_41,0).'&nbsp;</strong></td>
				</tr>';                  
        //}
        $jumlah_anggaran_42=$this->anggaran_rekap_42($bulann,$tahunn);
        $terima_rekap_42=$this->penerima_rekap_42($bulann,$tahunn);
        $terima_lalu_rekap_42=$this->penerima2_rekap_42($bulann,$tahunn);
        $jumlah_anggaran_reals_rekap_42 = $terima_rekap_42 + $terima_lalu_rekap_42;
        if ($jumlah_anggaran_42==0){
                        $jumlah_anggaran_42 = 0;
                        $persen_42 = 0;                                                
                    }else{
                        $jumlah_anggaran_42=$this->anggaran_rekap_42($bulann,$tahunn);
                        $persen_42=$jumlah_anggaran_reals_rekap_42/$jumlah_anggaran_42*100;                                            					                        
                    }                
                
        if ($terima_rekap_42==0){
                        $terima_rekap_42=0;
                    }else{
                        $terima_rekap_42=$this->penerima_rekap_42($bulann,$tahunn);    
                    }
                                    
        if($terima_lalu_rekap_42==0){
                        $terima_lalu_rekap_42 = 0;
                    }else{
                        $terima_lalu_rekap_42=$this->penerima2_rekap_42($bulann,$tahunn);
                    }                          
        $target_42 = $jumlah_anggaran_42 - $jumlah_anggaran_reals_rekap_42;                
        //$persen_42=number_format($persen_42,2,",",".");                                  
        $report .='<tr bgcolor=#EEE>
					<td colspan="3" width="38.2%" align="center"><strong>II. 4.2 TOTAL DANA PERIMBANGAN</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($jumlah_anggaran_42,0).'&nbsp;</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($terima_rekap_42,0).'&nbsp;</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($terima_lalu_rekap_42,0).'&nbsp;</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($jumlah_anggaran_reals_rekap_42,0).'&nbsp;</strong></td>
					<td width="8%" height="12" align="right"><strong>'.number_format($persen_42,0).'% &nbsp;</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($target_42,0).'&nbsp;</strong></td>
				</tr>';
        
        $jumlah_anggaran_43=$this->anggaran_rekap_43($bulann,$tahunn);
        $terima_rekap_43=$this->penerima_rekap_43($bulann,$tahunn);
        $terima_lalu_rekap_43=$this->penerima2_rekap_43($bulann,$tahunn);
        $jumlah_anggaran_reals_rekap_43 = $terima_rekap_43+$terima_lalu_rekap_43;
        if ($jumlah_anggaran_43==0){
                        $jumlah_anggaran_43 = 0;
                        $persen_43 = 0;                                                
                    }else{
                        $jumlah_anggaran_43=$this->anggaran_rekap_43($bulann,$tahunn);
                        $persen_43=$jumlah_anggaran_reals_rekap_43/$jumlah_anggaran_43*100;                    					                        
                    }
                
        if ($terima_rekap_43==0){
                        $terima_rekap_43=0;
                    }else{
                        $terima_rekap_43=$this->penerima_rekap_43($bulann,$tahunn);    
                    }
                
                            
        if($terima_lalu_rekap_43==0){
                        $terima_lalu_rekap_43 = 0;
                    }else{
                        $terima_lalu_rekap_43=$this->penerima2_rekap_43($bulann,$tahunn);
                    }                       
        $target_43 = $jumlah_anggaran_43 - $jumlah_anggaran_reals_rekap_43;                         
        //$persen_43=number_format($persen_43,2,",",".");
                                            
        $report     .='<tr bgcolor=#EEE>
					<td colspan="3" width="38.2%" align="center"><strong>III. 4.3 TOTAL PENDAPATAN LAIN-LAIN</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($jumlah_anggaran_43,0).'&nbsp;</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($d,0).'&nbsp;</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($terima_lalu_rekap_43,0).'&nbsp;</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($jumlah_anggaran_reals_rekap_43,0).'&nbsp;</strong></td>
					<td width="8%" height="12" align="right"><strong>'.number_format($persen_43,0).'% &nbsp;</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($target_43,0).'&nbsp;</strong></td>
				</tr>';
        
        $jumlah_total = $jumlah_anggaran_41 + $jumlah_anggaran_42 + $jumlah_anggaran_43;        
        $jumlah_terima_rekap = $terima_rekap_41 + $terima_rekap_42 + $terima_rekap_43;
        $jumlah_terima_lalu_rekap = $terima_lalu_rekap_41 + $terima_lalu_rekap_42 + $terima_lalu_rekap_43;
        $jumlah_bulan_ini = $jumlah_anggaran_reals_rekap_41 + $jumlah_anggaran_reals_rekap_42 + $jumlah_anggaran_reals_rekap_43;
        $target = $jumlah_total - $jumlah_bulan_ini;
        $persen=$jumlah_bulan_ini/$jumlah_total*100;                  
        $report .=' <tr bgcolor=#EEE>
					<td colspan="3" width="38.2%" align="center"><strong>TOTAL I + II + III</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($jumlah_total,0).'&nbsp;</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($jumlah_terima_rekap,0).'&nbsp;</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($jumlah_terima_lalu_rekap,0).'&nbsp;</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($jumlah_bulan_ini,0).'&nbsp;</strong></td>
					<td width="8%" height="12" align="right"><strong>'.number_format($persen,0).'% &nbsp;</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($target,0).'&nbsp;</strong></td>
				</tr>
			</table>
			<table>
				<tr>
			
            		<td height="20">&nbsp;</td>
				</tr>
			</table>';
			
		$penerimaan_bulan_ini = explode(",",$ttd);
		$countttd = count($penerimaan_bulan_ini);
		$jmlh = $countttd;
		$kura = $countttd-1;
		
		$wid = 1100/$jmlh;
		$cols = $kura*$wid;
		
		$report .=
			'<table width="785">
				<tr>';
		if($ttd == ""){
		
			$report .= '<td>&nbsp;</td>';
		
		} else {
			$day = date("d");
			$mon = $this->mrealisasi->v_bln(date("m"));
			$year = date("Y");
			$report .= 
					'<td colspan="'.$kura.'" width="'.$cols.'">&nbsp;</td>					 
				    </tr><tr>';
			$report .= 
					'<td colspan="'.$kura.'" width="'.$cols.'">&nbsp;</td>
                    </tr><tr>';
			$report .=
					'<td width="'.$wid.'" height="10" align="center">Mengetahui :</td>
                    <td width="'.$wid.'" align="center">Sigi Biromaru, '.$day.' '.$mon.' '.$year.'</td>
					</tr><tr>';
			$report .=
					'<td width="'.$wid.'" height="10" align="center">KEPALA DINAS PENDAPATAN <br/>PENGELOLAAN KEUANGAN DAN ASET DAERAH<br/>KABUPATEN SIGI</td>
                    <td width="'.$wid.'" height="10" align="center">BENDAHARA PENERIMA</td>                    
					</tr><tr>
						<td colspan="'.$countttd.'" height="60">&nbsp;</td>
					</tr><tr>';
			
			$t = explode(",",$ttd);
			$countttd = count($t);
			
			for($i=$countttd-1;$i>=0;$i--){
				$k = $t[$i];
				$que = $this->db->query("select nama_ttd from master_tanda_tangan where id ='".$k."'");
				foreach($que->result() as $rs) {
				
				//	if($q==NULL) {
						$report .= 
							'<td width="'.$wid.'" height="10" align="center">'.$rs->nama_ttd.'</td>';
				//	}
				}
			}
			
			$us = $this->db->query("select jabatan_ttd from master_tanda_tangan where id ='".$k."'")->row();
			$report .=
					'<td width="'.$wid.'" height="10" align="center">I R F A N</td>
					</tr><tr>';
			
			for($i=$countttd-1;$i>=0;$i--){
				$k = $t[$i];
				$que = $this->db->query("select nip_ttd from master_tanda_tangan where id ='".$k."'");
				foreach($que->result() as $rs) {
				
						$report .= 
							'<td width="'.$wid.'" height="10" align="center">NIP. '.$rs->nip_ttd.'</td>';
				}
			}
			$report .=
				'<td width="'.$wid.'" height="10" align="center">NIP. 19640111 200504 1 008</td>';
		}
					
		$report .=
				'</tr>
			</table>';
			
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Rekapitulasi'.'.pdf', 'I');
	//}
	}
	
    public function anggaran(){
		$this->load->view('realisasi_pendapatan/anggaran');
	}
	    
    public function sts(){
		$this->load->view('realisasi_pendapatan/sts');
	}
	
		//buat kombo box skpd
	function ambil_skpd(){
		$query= $this->db->query("SELECT kd_skpd, nm_skpd FROM ms_skpdn");	
		foreach ($query->result_array() as $result){
			
			$row[]=array(
			'kd_skpd' => $result['kd_skpd'],
			'nama_skpd' => $result['nm_skpd']
			);
			
		}
		$result["rows"] = $row;
		echo json_encode($result);
	}
	
	
	
		//buat kombo box Kegiatan
	function ambil_kegiatan(){
		$query= $this->db->query("SELECT kd_kegiatan, nm_kegiatan FROM m_giat WHERE jns_kegiatan='4'");	
		foreach ($query->result_array() as $result){
			
			$row[]=array(
			'kd_kegiatan' => $result['kd_kegiatan'],
			'nm_kegiatan' => $result['nm_kegiatan']
			);
			
		}
		$result["rows"] = $row;
		echo json_encode($result);
	}
		
	
		//buat kombo box ambil_rek4
	
			//buat kombo box sumber dana
	function ambil_dana(){
		$query= $this->db->query("SELECT sdana FROM sumber_dana");	
		foreach ($query->result_array() as $result){
			
			$row[]=array(
			//'kd_dana' => $result['kd_dana'],
			'sdana' => $result['sdana']
			);
			
		}
		$result["rows"] = $row;
		echo json_encode($result);
	}
	
	
	//ini controller save tambah data
	function save(){
		$tabel = $this->input->post('tabel');
		$kolom = $this->input->post('kolom');
		$isi   = $this->input->post('isi'); 
	
		$csql  = "insert into $tabel ($kolom)values($isi)";
		$asg   = $this->db->query($csql);
		if($asg){
			echo '1';
		}else{
			echo '0';
		}
	}     
	
    function save_sts(){        
		$wnokas = $this->input->post('no_kas');
		$wtgl_kas = $this->input->post('tgl_kas');
		$wcmb_skpd = $this->input->post('cmb_skpd'); 
        $wno_bukti = $this->input->post('no_bukti');
		$wtgl_bukti = $this->input->post('tgl_bukti'); 
        $wuraian = $this->input->post('uraian');
        $wjns_transaksi = "4";
        $wgiat = $this->input->post('cmb_giat');
        $wrek = $this->input->post('cmb_rekening');
        $wrupiah = $this->input->post('rupiah');
        $wbank = "bank";
        $wkosong = "";    
        $sts = "1";    
    
		$csql  = "insert into trdkasin_pkd (kd_skpd,
  no_sts,
  kd_rek5,
  rupiah,
  kd_kegiatan) values('$wcmb_skpd','$wnokas','$wrek','$wrupiah','$wgiat')";
		$asg   = $this->db->query($csql);
		if($asg){			
            $csql  = "insert into trhkasin_pkd (no_sts,
  no_bukti,
  kd_skpd,
  tgl_sts,
  keterangan,
  total,
  kd_bank,
  kd_kegiatan,
  jns_trans,
  rek_bank,
  no_kas,
  tgl_kas,
  no_cek,
  status,
  sumber) values('$wnokas',
  '$wno_bukti',
  '$wcmb_skpd',
  '$wtgl_kas',
  '$wuraian',
  '$wrupiah',
  '$wbank',
  '$wgiat',
  '$wjns_transaksi',
  '$wkosong',
  '$wnokas',
  '$wtgl_bukti',
  '$wkosong',
  '$wkosong',
  '$wkosong')";
            $this->db->query($csql);
               echo json_encode(array('nilai'=>$sts));
		}else{
			echo '0';
		}
	}
	
	//ini controller untuk data  grid
	function load_realisasi()
    {

        $page = isset($_POST['page'])? intval($_POST['page']):1;
        $rows = isset($_POST['rows'])? intval($_POST['rows']):10;
        $offset=($page-1)*$rows;
        $query1 = $this->db->query("select count(*) as tot from trdrka");
        $total=$query1->row();
        $query = $this->db->query("SELECT a.no_trdrka,a.kd_skpd,a.nm_skpd,a.kd_kegiatan,a.nm_kegiatan,b.kd_rek4,b.nm_rek4,a.kd_rek5,a.nm_rek5,a.nilai,a.sumber FROM trdrka a
JOIN ms_rek4 b ON b.kd_rek4 = LEFT(a.kd_rek5,5)
limit $offset,$rows");
        foreach ($query->result_array() as $result){

            $row[]=array(
                'no_trdrka'=>$result['no_trdrka'],
                'kd_skpd'=>$result['kd_skpd'],
                'nm_skpd'=>$result['nm_skpd'],
                'kd_kegiatan'=>$result['kd_kegiatan'],
                'nm_kegiatan'=>$result['nm_kegiatan'],
                'kd_rek4'=>$result['kd_rek4'],
                'nm_rek4'=>$result['nm_rek4'],                
				'kd_rek5'=>$result['kd_rek5'],
                'nm_rek5'=>$result['nm_rek5'],
                'nilai'=>$result['nilai'],
                'sumber'=>$result['sumber'],
                );
        }
        $result["total"]=$total->tot;
        $result["rows"]=$row;
        echo json_encode($result);
    }
	
	//load sts
	function load_sts()
    {

        $page = isset($_POST['page'])? intval($_POST['page']):1;
        $rows = isset($_POST['rows'])? intval($_POST['rows']):10;
        $offset=($page-1)*$rows;
        $query1 = $this->db->query("SELECT count(*) as tot FROM trdkasin_pkd 
JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
JOIN ms_skpdn ON trhkasin_pkd.kd_skpd = ms_skpdn.kd_skpd
JOIN ms_rek4 ON ms_rek4.kd_rek4 = LEFT(trdkasin_pkd.kd_rek5,5)
GROUP BY trdkasin_pkd.no_sts");

        $total=$query1->row();
        $query = $this->db->query("SELECT trdkasin_pkd.no_sts,trhkasin_pkd.kd_skpd,ms_skpdn.nm_skpd,trhkasin_pkd.kd_kegiatan,trdkasin_pkd.kd_rek5,trhkasin_pkd.tgl_sts,trhkasin_pkd.no_bukti,trhkasin_pkd.no_kas,trhkasin_pkd.tgl_kas,ms_rek4.nm_rek4,trhkasin_pkd.keterangan,trdkasin_pkd.rupiah,trhkasin_pkd.jns_trans FROM trdkasin_pkd 
JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
JOIN ms_skpdn ON trhkasin_pkd.kd_skpd = ms_skpdn.kd_skpd
JOIN ms_rek4 ON ms_rek4.kd_rek4 = LEFT(trdkasin_pkd.kd_rek5,5)
GROUP BY trdkasin_pkd.no_sts limit $offset,$rows");
        foreach ($query->result_array() as $result){

            $row[]=array(
                'no_sts'=>$result['no_sts'],
                'kd_skpd'=>$result['kd_skpd'],
                'nama_skpd'=>$result['nm_skpd'],						
                'tgl_sts'=>$result['tgl_sts'],                
                'tgl_kas'=>$result['tgl_kas'],                
                'no_bukti'=>$result['no_bukti'],
                'kd_kegiatan'=>$result['kd_kegiatan'],
                'kd_rek5'=>$result['kd_rek5'],
               	'nama_rek'=>$result['nm_rek4'],	
				'rupiah'=>$result['rupiah'],
                'rupiah2'=>number_format($result['rupiah'],0),					
                'jns_trans'=>$result['jns_trans'],
                'keterangan'=>$result['keterangan']                
                );
        }
        $result["total"]=$total->tot;
        $result["rows"]=$row;
        echo json_encode($result);
	
	}	
	
	//ini controller edit
	function update_anggaran(){
        $query = $this->input->post('st_query');
        $query1 = $this->input->post('st_query1');
        $asg = $this->db->query($query);
        if($asg){
            echo '1';
        }else{
            echo '0';
        }
        $asg1 = $this->db->query($query1);
    }
	
	
	//ini untuk controller hapus
	function hapus_anggaran(){
	$cnid = $this->input->post('cnid');
	$csql = "delete from trdrka where no_trdrka = '$cnid'";
        $asg = $this->db->query($csql);
        if ($asg){
            echo '1';
        } else{
            echo '0';
        }

    }
	
	
		//STS
			//ini untuk controller hapus
	function hapus_sts(){
	$cnid = $this->input->post('cnid');
	$csql = "delete from trdkasin_pkd where no_sts = '$cnid'";
        $asg = $this->db->query($csql);
        if ($asg){
            echo '1';
            
            $csql = "delete from trhkasin_pkd where no_sts = '$cnid'";
            $this->db->query($csql); 
        } else{
            echo '0';
        }

    }
	
	
	//ini untuk controller cari
    function load_cari() {
        $kriteria = '';
        $kriteria = $this->input->post('cari');
        $where ='';
        if ($kriteria <> ''){
            $where="WHERE (UPPER(no_trdrka) LIKE UPPER('%$kriteria%')OR nm_kegiatan LIKE '%$kriteria%' OR kd_rek5 LIKE '%$kriteria%' OR nm_rek5 LIKE '%$kriteria%')";
        }
        $sql = "SELECT * from trdrka $where order by no_trdrka";
        $query1 = $this->db->query($sql);
        $r = array();
        $ii = 0;
        foreach($query1->result_array() as $r)
        {
            $result[] = array(
                'id' => $ii,
                'no_trdrka' => $r['no_trdrka'],
                'kd_skpd' => $r['kd_skpd'],
                'nm_skpd' =>$r['nm_skpd'],
                'kd_kegiatan' =>$r['kd_kegiatan'],
                'nm_kegiatan' =>$r['nm_kegiatan'],
                'kd_rek5' =>$r['kd_rek5'],
                'nm_rek5' =>$r['nm_rek5'],
                'sumber' =>$r['sumber'],
                'nilai' =>$r['nilai'],

                );
            $ii++;
        }

        echo json_encode($result);
    }	

    
     public function lap_realisasi_skpd(){
        $data['tahun'] = $this->mrealisasi->tahun();
		$data['bulan'] = $this->mrealisasi->bulan();
		$this->load->view('realisasi_pendapatan/lap_realisasi_skpd',$data);
	}       
		
	function ambil_giat(){
		$query= $this->db->query("SELECT kd_kegiatan,nm_kegiatan FROM m_giat");
		foreach($query->result_array() as $rs ){
			$row[]=array(
			'kd_kegiatan' => $rs['kd_kegiatan'],
			'nm_kegiatan' => $rs['nm_kegiatan']	
			);
		}
		
		$rs["rows"] = $row;
		echo json_encode($rs);
	}
	
	/*function ambil_rek4(){
		$query= $this->db->query("SELECT kd_rek5,nm_rek5 FROM ms_rek5 WHERE LEFT(kd_rek5,1)='4'");
		foreach($query->result_array() as $rs ){
			$row[]=array(
			'kd_rek5' => $rs['kd_rek5'],
			'nm_rek5' => $rs['nm_rek5']	
			);
		}
		
		$rs["rows"] = $row;
		echo json_encode($rs);
	}*/
	
	function ambil_rek5(){
		$query= $this->db->query("SELECT kd_rek5,nm_rek5 FROM ms_rek5 WHERE LEFT(kd_rek5,1)='4' order by kd_rek5");
		foreach($query->result_array() as $rs ){
			$row[]=array(
			'kd_rek5' => $rs['kd_rek5'],
			'nm_rek5' => $rs['nm_rek5']	
			);
		}
		
		$rs["rows"] = $row;
		echo json_encode($rs);
	}
	
	function ambil_sdana(){
		$query= $this->db->query("SELECT sdana FROM sumber_dana");
		foreach($query->result_array() as $rs ){
			$row[]=array(
			//'kd_dana' => $rs['kd_dana'],
			'sdana' => $rs['sdana']	
			);
		}
		
		$rs["rows"] = $row;
		echo json_encode($rs);
	}
	
	
	function listing_anggaran_skpd()
    {

        $page = isset($_POST['page'])? intval($_POST['page']):1;
        $rows = isset($_POST['rows'])? intval($_POST['rows']):10;
        $offset=($page-1)*$rows;
        $query1 = $this->db->query("select count(*) as tot from trdrka");
        $total=$query1->row();
        $query = $this->db->query("select no_trdrka,kd_skpd,nm_skpd,kd_kegiatan,nm_kegiatan,kd_rek4,nm_rek4,nilai,sumber FROM trdrka limit $offset,$rows");
        foreach ($query->result_array() as $result){

            $row[]=array(
                'no_trdrka'=>$result['no_trdrka'],
                'kd_skpd'=>$result['kd_skpd'],
                'nm_skpd'=>$result['nm_skpd'],
                'kd_kegiatan'=>$result['kd_kegiatan'],
                'nm_kegiatan'=>$result['nm_kegiatan'],
                'kd_rek4'=>$result['kd_rek4'],
                'nm_rek4'=>$result['nm_rek4'],
                'nilai'=>$result['nilai'],
                'sumber'=>$result['sumber'],
                );
        }
        $result["total"]=$total->tot;
        $result["rows"]=$row;
        echo json_encode($result);


    }
	
	function simpan_anggaran_skpd(){
		$no_trdrka = $this->input->post('no_trdrka');
		$kd_skpd = $this->input->post('kdskpd');
		$nm_skpd = $this->input->post('skpd');
		$kd_kegiatan = $this->input->post('kdgiat');
		$nm_kegiatan = $this->input->post('giat');
		$kd_rek4 = $this->input->post('kdrek4');
		$nm_rek4 = $this->input->post('rek4');
		$kd_rek5 = $this->input->post('kdrek5');
		$nm_rek5 = $this->input->post('rek5');
		$sdana = $this->input->post('sdana');
		$nilai = $this->input->post('nilai');
		
		$simpan = "insert into trdrka(no_trdrka,kd_skpd,nm_skpd,kd_kegiatan,nm_kegiatan,kd_rek4,nm_rek4,kd_rek5,nm_rek5,sumber,nilai)values('$no_trdrka','$kd_skpd','$nm_skpd','$kd_kegiatan','$nm_kegiatan','$kd_rek4','$nm_rek4','$kd_rek5','$nm_rek5','$sdana','$nilai')";
		$cek_simpan = $this->db->query($simpan);
		if($cek_simpan){
			echo '1';
		}else{
			echo '0';
		}
	}
	
    function anggaran_skpd($skpd,$bulann,$tahunn){        
    /*$q1 = "SELECT SUM(trdrka.nilai) AS anggaran FROM trdrka INNER JOIN trdkasin_pkd ON trdkasin_pkd.kd_rek5 = trdrka.kd_rek5 
    INNER JOIN trhkasin_pkd ON trhkasin_pkd.kd_skpd = trdkasin_pkd.kd_skpd
    WHERE trdrka.kd_skpd='$skpd' AND LEFT(trdrka.kd_rek5,1) = '4' AND MONTH(trhkasin_pkd.tgl_sts) = '$bulann' AND YEAR(trhkasin_pkd.tgl_sts) = '$tahunn'";*/
    $q1="SELECT SUM(trdrka.nilai) AS anggaran FROM trdrka WHERE trdrka.kd_skpd='$skpd' AND LEFT(trdrka.kd_rek5,1) = '4'";
        $p2=$this->db->query($q1)->row();
	   
        
        if ($this->db->query($q1)->num_rows() <0 ){
          $anggaran_skpd1 = 0;    
        }else{
		  $anggaran_skpd1 = $p2->anggaran;
        }
		return $anggaran_skpd1;
    }
    
    function penerima_skpd($skpd,$bulann,$tahunn)
    {   
        $q1 = "SELECT SUM(trdkasin_pkd.rupiah) AS penerima FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
		WHERE trdkasin_pkd.kd_skpd='$skpd' AND LEFT(trdkasin_pkd.kd_rek5,1) = '4' AND MONTH(trhkasin_pkd.tgl_sts)='$bulann' AND YEAR(trhkasin_pkd.tgl_sts)='$tahunn'";                              
		$p=$this->db->query($q1)->row();
        
        if ($this->db->query($q1)->num_rows() <0 ){
          $terima_skpd1 = 0;    
        }else{
		  $terima_skpd1 =$p->penerima;
        }

		return $terima_skpd1;
	}	
    
    
    function penerima_lalu_skpd($skpd,$bulann,$tahunn)
    {   
        $bln = $bulann - 1;
        /*$q1 = "SELECT SUM(trdkasin_pkd.rupiah) AS penerima_lalu FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
		WHERE trdkasin_pkd.kd_skpd='$skpd' AND LEFT(trdkasin_pkd.kd_rek5,1) = '4' AND MONTH(trhkasin_pkd.tgl_sts)='$bln' AND YEAR(trhkasin_pkd.tgl_sts)='$tahunn'";*/
        $q1="SELECT SUM(trdkasin_pkd.rupiah) AS penerima_lalu FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
        WHERE trdkasin_pkd.kd_skpd='$skpd' AND LEFT(trdkasin_pkd.kd_rek5,1) = '4'  AND MONTH(trhkasin_pkd.tgl_sts) BETWEEN '01' AND '$bln' AND YEAR(trhkasin_pkd.tgl_sts) = '$tahunn'";                              
		$p=$this->db->query($q1)->row();
        
        if ($this->db->query($q1)->num_rows() <0 ){
          $terima_lalu_skpd1 = 0;    
        }else{
		  $terima_lalu_skpd1 =$p->penerima_lalu;
        }

		return $terima_lalu_skpd1;
	}	
    
    
    public function data_periode_lap_skpd($periode=""){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";				
			
			$bulann = substr($periode,6,2);
            $tahunn = substr($periode,0,4);
		  
//for($baris=1;$baris<=1;$baris++){

$baris=0;    

/*$sqldns="SELECT 
a.kd_skpd as kd,
b.nm_skpd as nm,
SUM(d.nilai) AS target,
SUM(a.rupiah) AS nilai,
IF(MONTH(c.tgl_sts)='".$bulann."',SUM(a.rupiah),0)AS nilai_lalu,
IF(MONTH(c.tgl_sts)='".$bulann."',SUM(a.rupiah)+SUM(a.rupiah),0) AS bulan_ini,
IF(MONTH(c.tgl_sts)='".$bulann."',LEFT(SUM(a.rupiah)/SUM(a.rupiah)*100,3),0) AS persen
FROM trdkasin_pkd a
JOIN ms_skpdn b ON b.kd_skpd = a.kd_skpd
JOIN trhkasin_pkd c ON c.kd_skpd = a.kd_skpd
JOIN trdrka d ON d.kd_rek5 = a.kd_rek5
WHERE LEFT(a.kd_rek5,1)='4' AND MONTH(c.tgl_sts)='".$bulann."' AND a.kd_skpd=d.kd_skpd
GROUP BY d.kd_skpd
            ";*/
            
$sqldns="SELECT * FROM (SELECT kd_skpd,nm_skpd FROM ms_skpdn)a 
    WHERE kd_skpd IS NOT NULL ORDER BY kd_skpd";            
            $sqlskpd=$this->db->query($sqldns);				                    
            foreach ($sqlskpd->result() as $sql)
            {
                    
            $baris=$baris+1;
            $skpd = $sql->kd_skpd;
            $nama_skpd = $sql->nm_skpd;
            $target_skpd = $this->anggaran_skpd($skpd,$bulann,$tahunn);            			           
            $penerimaan_skpd = $this->penerima_skpd($skpd,$bulann,$tahunn);
            $penerimaan_lalu_skpd = $this->penerima_lalu_skpd($skpd,$bulann,$tahunn);            
            $bulan_ini_real = $penerimaan_skpd + $penerimaan_lalu_skpd; 
            $sisa = $target_skpd - $bulan_ini_real;
            
            if ($target_skpd == 0){
                $target_skpd = 0;
                $persen1 = 0;
            }else{
                $target_skpd = $this->anggaran_skpd($skpd,$bulann,$tahunn);            			           
                $persen1 = $bulan_ini_real/$target_skpd*100;     
            }
            
            if ($penerimaan_skpd ==0){
                $penerimaan_skpd=0;
            }else{
                $penerimaan_skpd = $this->penerima_skpd($skpd,$bulann,$tahunn);                
            }
            
            if ($penerimaan_lalu_skpd ==0){
                $penerimaan_lalu_skpd=0;
            }else{
                $penerimaan_skpd = $this->penerima_skpd($skpd,$bulann,$tahunn);
            }
            
            $persen1=number_format($persen1,2,",",".");            
			//$sisa_target = $sql->bulan_ini-$sql->target;
			//$presentase_penerimaan = $sql->s_4/10000000*31;
			//$sisa_target = $sql->s_4-$sql->s_3;            
			echo ("<row>");
				echo("<cell><![CDATA[".$baris."]]></cell>");
                echo("<cell><![CDATA[".$nama_skpd."]]></cell>");
				echo("<cell><![CDATA[".$target_skpd."]]></cell>");
				echo("<cell><![CDATA[".$penerimaan_skpd."]]></cell>");
				echo("<cell><![CDATA[".$penerimaan_lalu_skpd."]]></cell>");
				echo("<cell><![CDATA[".$bulan_ini_real."]]></cell>");
				echo("<cell><![CDATA[".$persen1."]]></cell>");
				echo("<cell><![CDATA[".$sisa."]]></cell>");				
			echo("</row>");		
		}
		echo "</rows>";
	}    
    
	function tanda_tangan(){
		$data['data'] = $_GET['full'];
		$data['ttd'] = $this->model_user->ttd();
		$this->load->view('realisasi_pendapatan/pdf_lap_rekapitulasi',$data);
	}
	
    function tanda_tangan_skpd(){
		$data['data'] = $_GET['full'];
		$data['ttd'] = $this->model_user->ttd();
		$this->load->view('realisasi_pendapatan/pdf_lap_rekapitulasi_skpd',$data);
	}
        
    function cetak_lap_rekapitulasi_skpd(){
		$p = $_GET['full'];
		$o = explode('|',$p);
		$periode = $o[0];
		$ttd = $o[1];
		//$ttd = $o[2];
		
		$t = explode('-',$periode);
		$bln = $t[1];
		$thn = $t[0];
		$bulan = $this->mrealisasi->v_bln($bln);
        $tahun = $thn - 1;
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_SIGI');
		$pdf->SetKeywords('SOPD_SIGI');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(10);
		$pdf->SetMargins(50,50,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 6);
	
		$pdf->AddPage('L','A3',false);
		//set data
		$report = '';
		$report .=
			'
            <h1>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;            
			LAPORAN REKAPITULASI PENCAPAIAN TARGET PENDAPATAN DAERAH<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;
			BULAN '.strtoupper($bulan).'&nbsp;'.$thn.'</h1><br/>';
			
		$report .=
			'<table border="1" width="95%">
				<tr bgcolor=#EEE>
					<td width="5%" height="10" align="center"><strong>NO.</strong></td>					
					<td width="30%" height="12" align="center"><strong>Uraian</strong></td>
					<td width="10%" height="12" align="center"><strong>Target TA. '.$tahun.'</strong></td>
					<td width="10%" height="12" align="center"><strong>Penerimaan Bulan Ini</strong></td>
					<td width="10%" height="12" align="center"><strong>Penerimaan Bulan Lalu</strong></td>
					<td width="10%" height="12" align="center"><strong>Penerimaan Sampai Bulan Ini</strong></td>
					<td width="10%" height="12" align="center"><strong>Presentase Penerimaan</strong></td>
					<td width="10%" height="12" align="center"><strong>Sisa Target</strong></td>
				</tr>
				<tr bgcolor=#EEE>
					<td width="5%" height="10" align="center"><strong><i>1</i></strong></td>					
					<td width="30%" height="12" align="center"><strong><i>2</i></strong></td>
					<td width="10%" height="12" align="center"><strong><i>3</i></strong></td>
					<td width="10%" height="12" align="center"><strong><i>4</i></strong></td>
					<td width="10%" height="12" align="center"><strong><i>5</i></strong></td>
					<td width="10%" height="12" align="center"><strong><i>6</i></strong></td>
					<td width="10%" height="12" align="center"><strong><i>7</i></strong></td>
					<td width="10%" height="12" align="center"><strong><i>8</i></strong></td>
				</tr>';
		
		$a = '';
		$b = '';
		$c = 0;
		$d = 0;
		$e = 0;
		$f = 0;
		$g = 0;
		$h = 0;
		        
            $bulann = substr($periode,6,2);            
            $tahunn = substr($periode,0,4);
            
$baris=0;    

$sqldns="SELECT * FROM (SELECT kd_skpd,nm_skpd FROM ms_skpdn)a 
    WHERE kd_skpd IS NOT NULL ORDER BY kd_skpd";            
            $sqlskpd=$this->db->query($sqldns);				                    
            foreach ($sqlskpd->result() as $sql)
            {
                    
            $baris=$baris+1;
            $skpd = $sql->kd_skpd;
            $nama_skpd = $sql->nm_skpd;
            $target_skpd = $this->anggaran_skpd($skpd,$bulann,$tahunn);            			           
            $penerimaan_skpd = $this->penerima_skpd($skpd,$bulann,$tahunn);
            $penerimaan_lalu_skpd = $this->penerima_lalu_skpd($skpd,$bulann,$tahunn);            
            $bulan_ini_real = $penerimaan_skpd + $penerimaan_lalu_skpd; 
            $sisa = $target_skpd - $bulan_ini_real;
            
            if ($target_skpd == 0){
                $target_skpd = 0;
                $persen1 = 0;
            }else{
                $target_skpd = $this->anggaran_skpd($skpd,$bulann,$tahunn);            			           
                $persen1 = $bulan_ini_real/$target_skpd*100;     
            }
            
            if ($penerimaan_skpd ==0){
                $penerimaan_skpd=0;
            }else{
                $penerimaan_skpd = $this->penerima_skpd($skpd,$bulann,$tahunn);                
            }
            
            if ($penerimaan_lalu_skpd ==0){
                $penerimaan_lalu_skpd=0;
            }else{
                $penerimaan_skpd = $this->penerima_skpd($skpd,$bulann,$tahunn);
            }
            
            $persen1=number_format($persen1,2,",",".");            
			
            
			$report .=
				'<tr>
					<td width="5%" height="10" align="center">'.$baris.'</td>
					<td width="30%" height="12" align="left">&nbsp;'.$nama_skpd.'</td>
					<td width="10%" height="12" align="right">'.number_format($target_skpd,0).'&nbsp;</td>
					<td width="10%" height="12" align="right">'.number_format($penerimaan_skpd,0).'&nbsp;</td>
					<td width="10%" height="12" align="right">'.number_format($penerimaan_lalu_skpd,0).'&nbsp;</td>
					<td width="10%" height="12" align="right">'.number_format($bulan_ini_real,0).'&nbsp;</td>
					<td width="10%" height="12" align="right">'.number_format($persen1,0).'%&nbsp;</td>
					<td width="10%" height="12" align="right">'.number_format($sisa,0).'&nbsp;</td>					
				</tr>';                
				$c = $c + $target_skpd;
				$d = $d + $penerimaan_skpd;
				$e = $e + $penerimaan_lalu_skpd;
				$f = $f + $bulan_ini_real;
				$g = $g + $persen1;
                $x = $g/10;
				$h = $h + $sisa;                
		}
		
		$report .=
				'<tr bgcolor=#EEE>
					<td colspan="2%" width="35%" align="center"><strong>J U M L A H</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($c,0).'&nbsp;</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($d,0).'&nbsp;</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($e,0).'&nbsp;</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($f,0).'&nbsp;</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($x,1).'%&nbsp;</strong></td>
					<td width="10%" height="12" align="right"><strong>'.number_format($h,0).'&nbsp;</strong></td>
				</tr>
			</table>
			<table>
				<tr>
					<td height="20">&nbsp;</td>
				</tr>
			</table>';
			
		$penerimaan_bulan_ini = explode(",",$ttd);
		$countttd = count($penerimaan_bulan_ini);
		$jmlh = $countttd;
		$kura = $countttd-1;
		
		$wid = 1100/$jmlh;
		$cols = $kura*$wid;
		
		$report .=
			'<table width="785" border="0">
				<tr>';
		if($ttd == ""){
		
			$report .= '<td>&nbsp;</td>';
		
		} else {
			$day = date("d");
			$mon = $this->mrealisasi->v_bln(date("m"));
			$year = date("Y");
			$report .=
					'<td width="'.$wid.'" height="10" align="center">Mengetahui :</td>
					</tr><tr>';			            
			$report .=
					'<td width="'.$wid.'" height="10" align="center">KEPALA DINAS KABUPATEN SIGI <br/>PENGELOLAAN KEUANGAN DAN ASET DAERAH</td>
                    <td width="'.$wid.'" align="center">Sigi Biromaru, '.$day.' '.$mon.' '.$year.' <br/> BENDAHARA PENERIMA</td>
					</tr><tr>
						<td colspan="'.$countttd.'" height="80">&nbsp;</td>
					</tr><tr>';
                    
			
			$t = explode(",",$ttd);
			$countttd = count($t);
			
			for($i=$countttd-1;$i>=0;$i--){
				$k = $t[$i];
				$que = $this->db->query("select nama_ttd from master_tanda_tangan where id ='".$k."'");
				foreach($que->result() as $rs) {
				
				//	if($q==NULL) {
						$report .= 
							'<td width="'.$wid.'" height="10" align="center">'.$rs->nama_ttd.'</td>';
				//	}
				}
			}
			
			$us = $this->db->query("select jabatan_ttd from master_tanda_tangan where id ='".$k."'")->row();
			$report .=
					'<td width="'.$wid.'" height="10" align="center">I R F A N</td>
					</tr><tr>';
			
			for($i=$countttd-1;$i>=0;$i--){
				$k = $t[$i];
				$que = $this->db->query("select nip_ttd from master_tanda_tangan where id ='".$k."'");
				foreach($que->result() as $rs) {
				
				//	if($q==NULL) {
						$report .= 
							'<td width="'.$wid.'" height="10" align="center">NIP. '.$rs->nip_ttd.'</td>';
				//	}
				}
			}
			$report .=
				'<td width="'.$wid.'" height="10" align="center">NIP. 19640111 200504 1 008</td>';
		}
					
		$report .=
				'</tr>
			</table>';
			
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Rekapitulasi'.'.pdf', 'I');
	}
    
    //
    
    public function lap_realisasi_bln(){
		$data['bulan'] = $this->msistem->bulan();
		$data['tahun'] = $this->msistem->tahun();
		$this->load->view('realisasi_pendapatan/lap_realisasi_bln', $data);
	}
    
    function penerima($kdrek,$bln){

		$p=$this->db->query("SELECT SUM(trdrka.nilai) AS penerima FROM trdrka  INNER JOIN trhkasin_pkd ON trdrka.kd_skpd = trhkasin_pkd.kd_skpd 
							 WHERE LEFT(trdrka.kd_rek5,5) = '$kdrek' AND MONTH(trhkasin_pkd.tgl_sts) = '01'")->row();

		$terima =$p->penerima;

		return $terima;
	}
	
	function penyetoran($kdrek,$bln)
	{
		$pt=$this->db->query("SELECT SUM(trdrka.nilai_ubah) AS penyetoran FROM trdrka  INNER JOIN trhkasin_pkd ON trdrka.kd_skpd = trhkasin_pkd.kd_skpd 
							  WHERE LEFT(trdrka.kd_rek5,5) = '$kdrek' AND MONTH(trhkasin_pkd.tgl_sts) = '01'")->row();
	
		$setorn = $pt->penyetoran;

		return $setorn;

	} 	

	function penerima2($kdrek,$bln)
	{
		$p2=$this->db->query("SELECT SUM(trdrka.nilai) AS penerima_lalu FROM trdrka  INNER JOIN trhkasin_pkd ON trdrka.kd_skpd = trhkasin_pkd.kd_skpd 
							  WHERE LEFT(trdrka.kd_rek5,5) = '$kdrek' AND MONTH(trhkasin_pkd.tgl_sts) = '02'")->row();
	
		$terima_lalu = $p2->penerima_lalu;

		return $terima_lalu;

	}

	function penyetoran2($kdrek,$bln)
	{
		$pt2=$this->db->query("SELECT SUM(trdrka.nilai) AS penyetoran_lalu FROM trdrka  INNER JOIN trhkasin_pkd ON trdrka.kd_skpd = trhkasin_pkd.kd_skpd 
							  WHERE LEFT(trdrka.kd_rek5,5) = '$kdrek' AND MONTH(trhkasin_pkd.tgl_sts) = '02'")->row();
	
		$setorn_lalu = $pt2->penyetoran_lalu;

		return $setorn_lalu;

	}

	public function data_realisasi($periode="")
	{
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";

		$p = explode('-',$periode);

			//$bulan = $thn.'-'.$bln;
			
            $bulann = substr($periode,6,2);
            $tahunn = substr($periode,0,4);
            $bulann_min = floatval($bulann) - 1; 
			
            $sql = $this->db->query("SELECT trdrka.kd_skpd AS kode,
ms_skpdn.nm_skpd AS nama,
SUM(IF(LEFT(trdrka.kd_rek5,1)='4',trdrka.nilai,0))AS anggaran,
IF(LEFT(trdkasin_pkd.kd_rek5,1)='4' AND trdkasin_pkd.kd_skpd = trdrka.kd_skpd AND MONTH(trhkasin_pkd.tgl_sts)='$bulann' AND YEAR(trhkasin_pkd.tgl_sts)='$tahunn',trdkasin_pkd.rupiah,0)AS penerimaan,
IF(LEFT(trdkasin_pkd.kd_rek5,1)='4' AND trdkasin_pkd.kd_skpd = trdrka.kd_skpd AND MONTH(trhkasin_pkd.tgl_sts)='$bulann_min' AND YEAR(trhkasin_pkd.tgl_sts)='$tahunn',trdkasin_pkd.rupiah,0)AS penerimaan_lalu 
FROM trdrka 
JOIN trdkasin_pkd ON trdkasin_pkd.kd_skpd = trdrka.kd_skpd
JOIN trhkasin_pkd ON trhkasin_pkd.kd_skpd = trdkasin_pkd.kd_skpd
JOIN ms_skpdn ON trhkasin_pkd.kd_skpd = ms_skpdn.kd_skpd
WHERE LEFT(trdrka.kd_rek5,1)='4'
GROUP BY trdkasin_pkd.kd_skpd
UNION
SELECT SUBSTR(trdrka.no_trdrka,34,3) AS kode,ms_rek3.nm_rek3 AS nama, SUM(trdrka.nilai) AS anggaran,  
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,3) = ms_rek3.kd_rek3 AND MONTH(trhkasin_pkd.tgl_sts)='$bulann' AND YEAR(trhkasin_pkd.tgl_sts)='$tahunn') AS penerimaan,
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,3) = ms_rek3.kd_rek3 AND MONTH(trhkasin_pkd.tgl_sts)='$bulann_min' AND YEAR(trhkasin_pkd.tgl_sts)='$tahunn') AS penerimaan_lalu
FROM ms_rek3
JOIN trdrka ON LEFT(trdrka.kd_rek5,3)=ms_rek3.kd_rek3
JOIN ms_skpdn ON trdrka.kd_skpd = ms_skpdn.kd_skpd
WHERE LEFT(trdrka.kd_rek5,1)='4' GROUP BY ms_rek3.kd_rek3
UNION
SELECT SUBSTR(trdrka.no_trdrka,34,5) AS kode,ms_rek4.nm_rek4 AS nama, SUM(trdrka.nilai) AS anggaran,  
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,5) = ms_rek4.kd_rek4 AND MONTH(trhkasin_pkd.tgl_sts)='$bulann' AND YEAR(trhkasin_pkd.tgl_sts)='$tahunn') AS penerimaan,
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,5) = ms_rek4.kd_rek4 AND MONTH(trhkasin_pkd.tgl_sts)='$bulann_min' AND YEAR(trhkasin_pkd.tgl_sts)='$tahunn') AS penerimaan_lalu
FROM ms_rek4
JOIN trdrka ON LEFT(trdrka.kd_rek5,5)=ms_rek4.kd_rek4
JOIN ms_skpdn ON trdrka.kd_skpd = ms_skpdn.kd_skpd
WHERE LEFT(trdrka.kd_rek5,1)='4' GROUP BY ms_rek4.kd_rek4
UNION
SELECT SUBSTR(trdrka.no_trdrka,34,7) AS kode,ms_rek5.nm_rek5 AS nama, SUM(trdrka.nilai) AS anggaran,  
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,7) = ms_rek5.kd_rek5 AND MONTH(trhkasin_pkd.tgl_sts)='$bulann' AND YEAR(trhkasin_pkd.tgl_sts)='$tahunn') AS penerimaan,
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,7) = ms_rek5.kd_rek5 AND MONTH(trhkasin_pkd.tgl_sts)='$bulann_min' AND YEAR(trhkasin_pkd.tgl_sts)='$tahunn') AS penerimaan_lalu
FROM ms_rek5
JOIN trdrka ON LEFT(trdrka.kd_rek5,7)=ms_rek5.kd_rek5
JOIN ms_skpdn ON trdrka.kd_skpd = ms_skpdn.kd_skpd
WHERE LEFT(trdrka.kd_rek5,1)='4' GROUP BY ms_rek5.kd_rek5
ORDER BY kode,nama
");				
				foreach($sql->result() as $rs) {
				    $kode_rek = $rs->kode;
                    $nama_rek = $rs->nama;
                    $anggaran_rek = $rs->anggaran;                                        
					$terima=$rs->penerimaan;
					$setorn=$rs->penerimaan;
					$terima_lalu=$rs->penerimaan_lalu;
					$setorn_lalu=$rs->penerimaan_lalu;
					$jumlah_anggaran_reals=$terima+$terima_lalu;
					$jumlah_anggaran_setor=$setorn+$setorn_lalu;
					$sisa_anggaran_blm_setor=$anggaran_rek-$jumlah_anggaran_setor;
					
                    if ($anggaran_rek==0) {
                        $anggaran_rek=0;
                        $persen=0;
                    }else{
                        $anggaran_rek = $rs->anggaran;
                        $persen=$jumlah_anggaran_setor/$anggaran_rek*100;
                    }
                    
                    if ($terima==0){
                        $terima=0;
                    }else{
                        $terima=$rs->penerimaan;
                    }
					
                    if ($terima_lalu==0){
                        $terima_lalu=0;
                    }else{
                        $terima_lalu=$rs->penerimaan_lalu;
                    }
                    
                    if ($setorn==0){
                        $setorn=0;
                    }else{
                        $setorn=$rs->penerimaan;
                    }
                    
                    if ($setorn_lalu==0){
                        $setorn_lalu=0;
                    }else{
                        $setorn_lalu=$rs->penerimaan_lalu;
                    }
                    
					$persen=number_format($persen,2,",",".");
			        //$i = 0; 
			echo ("<row>");
				echo("<cell><![CDATA[".$kode_rek."]]></cell>");
				echo("<cell><![CDATA[".$nama_rek."]]></cell>");
				echo("<cell><![CDATA[".$anggaran_rek."]]></cell>");
				echo("<cell><![CDATA[".$terima."]]></cell>");
				echo("<cell><![CDATA[".$setorn."]]></cell>");
				echo("<cell><![CDATA[".$terima_lalu."]]></cell>");
				echo("<cell><![CDATA[".$setorn_lalu."]]></cell>");
				echo("<cell><![CDATA[".$jumlah_anggaran_reals."]]></cell>");
				echo("<cell><![CDATA[".$jumlah_anggaran_setor."]]></cell>");
				echo("<cell><![CDATA[".$persen."]]></cell>");
				echo("<cell><![CDATA[".$sisa_anggaran_blm_setor."]]></cell>");
			echo("</row>");			
		}
		echo "</rows>";
	}
    
    function ttd_lpr_pendapatan()
	{
		$data['data'] = $_GET['full'];
		$data['ttd'] = $this->model_user->ttd();
		$this->load->view('realisasi_pendapatan/ttd_lpr_pendapatan',$data);
	}

	public function cetak_lap_realisasi()
	{
		$p = $_GET['full'];
		$o = explode('|',$p);
		$periode = $o[0];		
		$ttd = $o[1];
		
		$t = explode('-',$periode);
		$bln = $t[1];
		$thn = $t[0];
		$bulan = $this->mrealisasi->v_bln($bln);		
        $bln2 = floatval($bln) - 1;
        
				$f = 0;
				$h = 0;  
                $g = 0;                                                
                $i = 0;

		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false);

		//set info
		$pdf->setTitle('Report_'.$arr);

		//set informasi
		$pdf->SetSubject('LPR');
		$pdf->SetKeywords('LPR');

		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->setHeaderMargin(10);
		$pdf->setMargins(30,30,30);

		//set font yang digunakan
		$pdf->SetFont('times', '', 6);

		$pdf->AddPage('L', 'A4', false);
		//set data
		$report = '';
		$report .=
			'<table width="100%">
				<tr>
					<td><h2 align="center">PEMERINTAH KABUPATEN SIGI <br/> LAPORAN REALISASI PENERIMAAN PENDAPATAN DAERAH <br/>BULAN '.strtoupper($bulan).' TAHUN '.$thn.'</h2></td>
				</tr>
				<tr>
					<td height="3"></td>
				</tr>			
                <tr>
                    <td align="left" width="13%">SKPD</td>
                    <td align="left" width="40%">: DINAS PENDAPATAN PENGELOLAAN KEUANGAN DAN ASET DAERAH KABUPATEN SIGI</td>
                </tr>
                <tr>
                    <td align="left" width="13%">PENGGUNA ANGGARAN / KPA</td>
                    <td align="left" width="40%">: Drs. H. ENDRO SETIAWAN</td>
                </tr>
                <tr>
                    <td align="left" width="13%">Bendahara Penerimaan</td>
                    <td align="left" width="40%">: IRFAN</td>
                </tr>
                <tr>
					<td height="3"></td>
				</tr>			                
			</table>';
	

		$report .=
			'<table border="1" cellpadding="2">
				<tr bgcolor="#EEE"> 
					<td width="5%" rowspan="2" colspan="1"><div align="center" class="huruf2"><strong>Kode Rekening</strong></div></td>
					<td width="29%" rowspan="2" colspan="1"><div align="center" class="huruf2"><strong>Uraian</strong></div></td>
					<td width="7%" rowspan="2"><div align="center" class="huruf2"><strong>Jumlah Anggaran</strong></div></td>
					<td width="14%" rowspan="1" colspan="2"><div align="center" class="huruf2"><strong>Bulan ini</strong></div></td>
					<td width="14%" rowspan="1" colspan="2"><div align="center" class="huruf2"><strong>Sampai dengan Bulan Lalu</strong></div></td>
					<td width="27%" rowspan="1" colspan="3"><div align="center" class="huruf2"><strong>Sampai dengan Bulan ini</strong></div></td>
					<td width="5%" rowspan="2"><div align="center" class="huruf"><strong>Persentase (%)</strong></div></td>
				</tr>
				<tr bgcolor="#EEE">
				  	<td width="7%"><div align="center" class="huruf"><strong>Penerimaan</strong></div></td>
					<td width="7%"><div align="center" class="huruf"><strong>Penyetoran</strong></div></td>
					<td width="7%"><div align="center" class="huruf"><strong>Penerimaan</strong></div></td>
					<td width="7%"><div align="center" class="huruf"><strong>Penyetoran</strong></div></td>
					<td width="9%"><div align="center" class="huruf"><strong>Jumlah Anggaran yang Terealisasi</strong></div></td>
					<td width="9%"><div align="center" class="huruf"><strong>Jumlah Anggaran yang Telah Disetor</strong></div></td>
					<td width="9%"><div align="center" class="huruf"><strong>Sisa Anggaran yang Belum Terealisasi / Pelampauan Anggaran</strong></div></td>
					
				</tr>
				<tr bgcolor="#EEE">
					<td bgcolor="#DDD" width="5%"><div align="center" class="huruf2"><strong><i>1</i></strong></div></td>
					<td bgcolor="#DDD" width="29%"><div align="center" class="huruf2"><strong><i>2</i></strong></div></td>
					<td bgcolor="#DDD" width="7%"><div align="center" class="huruf2"><strong><i>3</i></strong></div></td>
					<td bgcolor="#DDD" width="7%"><div align="center" class="huruf2"><strong><i>4</i></strong></div></td>
					<td bgcolor="#DDD" width="7%"><div align="center" class="huruf2"><strong><i>5</i></strong></div></td>
					<td bgcolor="#DDD" width="7%"><div align="center" class="huruf2"><strong><i>6</i></strong></div></td>
					<td bgcolor="#DDD" width="7%"><div align="center" class="huruf2"><strong><i>7</i></strong></div></td>
					<td bgcolor="#DDD" width="9%"><div align="center" class="huruf2"><strong><i>8</i></strong></div></td>
					<td bgcolor="#DDD" width="9%"><div align="center" class="huruf2"><strong><i>9</i></strong></div></td>
					<td bgcolor="#DDD" width="9%"><div align="center" class="huruf2"><strong><i>10</i></strong></div></td>
					<td bgcolor="#DDD" width="5%"><div align="center" class="huruf2"><strong><i>11</i></strong></div></td>
				</tr>';
            
                     $sql = $this->db->query("SELECT trdrka.kd_skpd AS kode,a.nm_skpd AS nama,
SUM(IF(LEFT(trdrka.kd_rek5,1)='4',trdrka.nilai,0))AS anggaran,
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE trdkasin_pkd.kd_skpd = trdrka.kd_skpd AND LEFT(trdkasin_pkd.kd_rek5,1)='4' AND MONTH(trhkasin_pkd.tgl_sts)='$bln' AND YEAR(trhkasin_pkd.tgl_sts)='$thn') AS penerimaan,
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE trdkasin_pkd.kd_skpd = trdrka.kd_skpd AND LEFT(trdkasin_pkd.kd_rek5,1)='4' AND MONTH(trhkasin_pkd.tgl_sts) BETWEEN '01' AND '$bln2' AND YEAR(trhkasin_pkd.tgl_sts)='$thn') AS penerimaan_lalu
FROM (SELECT kd_skpd,nm_skpd FROM ms_skpdn)a 
JOIN trdrka ON trdrka.kd_skpd = a.kd_skpd
WHERE a.kd_skpd IS NOT NULL AND LEFT(trdrka.kd_rek5,1)='4' 
GROUP BY a.kd_skpd ORDER BY anggaran DESC");                                 
                
                foreach($sql->result() as $rf) {                
                    $kode_skpd = $rf->kode;
                    $nama_skpd = $rf->nama;
                    $anggaran_skpd = $rf->anggaran;
                    $penerimaan_skpd = $rf->penerimaan;
                    $penerimaan_lalu_skpd = $rf->penerimaan_lalu;
                    $jumlah_anggaran_setor_skpd = $penerimaan_skpd + $penerimaan_lalu_skpd;
                    $sisa_anggaran_blm_setor_skpd = $anggaran_skpd - $jumlah_anggaran_setor_skpd;
                    $r = $anggaran_skpd - $sisa_anggaran_blm_setor_skpd;
                    $persen_skpd = ($r/$anggaran_skpd)*100;
                
                $report .=
							'<tr>
								<td bgcolor="#FFCCFF" width="5%" height="12" align="left">'.$kode_skpd.'</td>
								<td bgcolor="#FFCCFF" width="29%" height="12" align="left">'.$nama_skpd.'</td>
								<td bgcolor="#FFCCFF" width="7%" height="12" align="right">'.number_format($anggaran_skpd,2,",",".").'</td>
								<td bgcolor="#FFCCFF" width="7%" height="12" align="right">'.number_format($penerimaan_skpd,2,",",".").'</td>
								<td bgcolor="#FFCCFF" width="7%" height="12" align="right">'.number_format($penerimaan_skpd,2,",",".").'</td>
								<td bgcolor="#FFCCFF" width="7%" height="12" align="right">'.number_format($penerimaan_lalu_skpd,2,",",".").'</td>
								<td bgcolor="#FFCCFF" width="7%" height="12" align="right">'.number_format($penerimaan_lalu_skpd,2,",",".").'</td>
								<td bgcolor="#FFCCFF" width="9%" height="12" align="right">'.number_format($jumlah_anggaran_setor_skpd,2,",",".").'</td>
								<td bgcolor="#FFCCFF" width="9%" height="12" align="right">'.number_format($jumlah_anggaran_setor_skpd,2,",",".").'</td>
								<td bgcolor="#FFCCFF" width="9%" height="12" align="right">'.number_format($sisa_anggaran_blm_setor_skpd,2,",",".").'</td>
								<td bgcolor="#FFCCFF" width="5%" height="12" align="right">'.number_format($persen_skpd,1,",",".").' %</td>
							</tr>';                                   
                
				$sql = $this->db->query("
SELECT SUBSTR(trdrka.no_trdrka,34,3) AS kode,ms_rek3.nm_rek3 AS nama, SUM(trdrka.nilai) AS anggaran,  
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,3) = ms_rek3.kd_rek3 AND MONTH(trhkasin_pkd.tgl_sts)='$bln' AND YEAR(trhkasin_pkd.tgl_sts)='$thn') AS penerimaan,
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,3) = ms_rek3.kd_rek3 AND MONTH(trhkasin_pkd.tgl_sts) BETWEEN '01' AND '$bln2' AND YEAR(trhkasin_pkd.tgl_sts)='$thn') AS penerimaan_lalu
FROM ms_rek3
JOIN trdrka ON LEFT(trdrka.kd_rek5,3)=ms_rek3.kd_rek3
JOIN ms_skpdn ON trdrka.kd_skpd = ms_skpdn.kd_skpd
WHERE LEFT(trdrka.kd_rek5,1)='4' AND trdrka.kd_skpd='$kode_skpd' 
GROUP BY ms_rek3.kd_rek3
UNION
SELECT SUBSTR(trdrka.no_trdrka,34,5) AS kode,ms_rek4.nm_rek4 AS nama, SUM(trdrka.nilai) AS anggaran,  
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,5) = ms_rek4.kd_rek4 AND MONTH(trhkasin_pkd.tgl_sts)='$bln' AND YEAR(trhkasin_pkd.tgl_sts)='$thn') AS penerimaan,
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,5) = ms_rek4.kd_rek4 AND MONTH(trhkasin_pkd.tgl_sts) BETWEEN '01' AND '$bln2' AND YEAR(trhkasin_pkd.tgl_sts)='$thn') AS penerimaan_lalu
FROM ms_rek4
JOIN trdrka ON LEFT(trdrka.kd_rek5,5)=ms_rek4.kd_rek4
JOIN ms_skpdn ON trdrka.kd_skpd = ms_skpdn.kd_skpd
WHERE LEFT(trdrka.kd_rek5,1)='4' AND trdrka.kd_skpd='$kode_skpd'
GROUP BY ms_rek4.kd_rek4
UNION
SELECT SUBSTR(trdrka.no_trdrka,34,7) AS kode,ms_rek5.nm_rek5 AS nama, SUM(trdrka.nilai) AS anggaran,  
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,7) = ms_rek5.kd_rek5 AND MONTH(trhkasin_pkd.tgl_sts)='$bln' AND YEAR(trhkasin_pkd.tgl_sts)='$thn') AS penerimaan,
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,7) = ms_rek5.kd_rek5 AND MONTH(trhkasin_pkd.tgl_sts) BETWEEN '01' AND '$bln2' AND YEAR(trhkasin_pkd.tgl_sts)='$thn') AS penerimaan_lalu
FROM ms_rek5
JOIN trdrka ON LEFT(trdrka.kd_rek5,7)=ms_rek5.kd_rek5
JOIN ms_skpdn ON trdrka.kd_skpd = ms_skpdn.kd_skpd
WHERE LEFT(trdrka.kd_rek5,1)='4' AND trdrka.kd_skpd='$kode_skpd'
GROUP BY ms_rek5.kd_rek5
ORDER BY kode,nama");
				$z=1;
					foreach($sql->result() as $rs) {
					   $z=$z+1;
				    $kode_rek = $rs->kode;
                    $nama_rek = $rs->nama;
                    $anggaran_rek = $rs->anggaran;                                        
					$terima=$rs->penerimaan;
					$setorn=$rs->penerimaan;
					$terima_lalu=$rs->penerimaan_lalu;
					$setorn_lalu=$rs->penerimaan_lalu;
					$jumlah_anggaran_reals=$terima+$terima_lalu;
					$jumlah_anggaran_setor=$setorn+$setorn_lalu;
					$sisa_anggaran_blm_setor=$anggaran_rek-$jumlah_anggaran_setor;
					
                    if ($anggaran_rek==0) {
                        $anggaran_rek=0;
                        $persen=0;
                    }else{
                        $anggaran_rek = $rs->anggaran;
                        $persen=$jumlah_anggaran_setor/$anggaran_rek*100;
                    }
                    
                    if ($terima==0){
                        $terima=0;
                    }else{
                        $terima=$rs->penerimaan;
                    }
					
                    if ($terima_lalu==0){
                        $terima_lalu=0;
                    }else{
                        $terima_lalu=$rs->penerimaan_lalu;
                    }
                    
                    if ($setorn==0){
                        $setorn=0;
                    }else{
                        $setorn=$rs->penerimaan;
                    }
                    
                    if ($setorn_lalu==0){
                        $setorn_lalu=0;
                    }else{
                        $setorn_lalu=$rs->penerimaan_lalu;
                    }
                    
					$persen=number_format($persen,2,",",".");

				$report .=
							'<tr>
								<td width="5%" height="12" align="left">'.$kode_rek.'</td>
								<td width="29%" height="12" align="left">'.$nama_rek.'</td>
								<td width="7%" height="12" align="right">'.number_format($anggaran_rek,2,",",".").'</td>
								<td width="7%" height="12" align="right">'.number_format($terima,2,",",".").'</td>
								<td width="7%" height="12" align="right">'.number_format($setorn,2,",",".").'</td>
								<td width="7%" height="12" align="right">'.number_format($terima_lalu,2,",",".").'</td>
								<td width="7%" height="12" align="right">'.number_format($setorn_lalu,2,",",".").'</td>
								<td width="9%" height="12" align="right">'.number_format($jumlah_anggaran_reals,2,",",".").'</td>
								<td width="9%" height="12" align="right">'.number_format($jumlah_anggaran_setor,2,",",".").'</td>
								<td width="9%" height="12" align="right">'.number_format($sisa_anggaran_blm_setor,2,",",".").'</td>
								<td width="5%" height="12" align="right">'.number_format($persen,1,",",".").' %</td>
							</tr>';
                } 
                }
                     $sql = $this->db->query("SELECT SUM(trdrka.nilai) AS anggaran,  
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,1) = '4' AND MONTH(trhkasin_pkd.tgl_sts)='$bln' AND YEAR(trhkasin_pkd.tgl_sts)='$thn') AS penerimaan,
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,1) = '4' AND MONTH(trhkasin_pkd.tgl_sts) BETWEEN '01' and '$bln2' AND YEAR(trhkasin_pkd.tgl_sts)='$thn') AS penerimaan_lalu
FROM ms_rek5
JOIN trdrka ON LEFT(trdrka.kd_rek5,7)=ms_rek5.kd_rek5
JOIN ms_skpdn ON trdrka.kd_skpd = ms_skpdn.kd_skpd
WHERE LEFT(trdrka.kd_rek5,1)='4' 
GROUP BY LEFT(trdrka.kd_rek5,1)='4'");                                 
                
                foreach($sql->result() as $rx) {                				        
                    
                    $f = $rx->penerimaan + $rx->penerimaan_lalu;
                    $h = $rx->anggaran - $f;
                    $i = $rx->anggaran - $h;
                    $persen_z = ($i/$rx->anggaran)*100;
                				        
                $report .=
							'<tr bgcolor="#EEE">								
								<td colspan="2" width="34%" height="12" align="center">J U M L A H</td>
								<td width="7%" height="12" align="right">'.number_format($rx->anggaran,2,",",".").'</td>
								<td width="7%" height="12" align="right">'.number_format($rx->penerimaan,2,",",".").'</td>
								<td width="7%" height="12" align="right">'.number_format($rx->penerimaan,2,",",".").'</td>
								<td width="7%" height="12" align="right">'.number_format($rx->penerimaan_lalu,2,",",".").'</td>
								<td width="7%" height="12" align="right">'.number_format($rx->penerimaan_lalu,2,",",".").'</td>
								<td width="9%" height="12" align="right">'.number_format($f,2,",",".").'</td>
								<td width="9%" height="12" align="right">'.number_format($f,2,",",".").'</td>
								<td width="9%" height="12" align="right">'.number_format($h,2,",",".").'</td>
								<td width="5%" height="12" align="right">'.number_format($persen_z,1,",",".").' %</td>
							</tr>';
            }
                                           
				$report .='</table>
						<table>
							<tr>
								<td height="10"></td>
							</tr>
						</table>';
		
        $penerimaan_bulan_ini = explode(",",$ttd);
		$countttd = count($penerimaan_bulan_ini);
		$jmlh = $countttd;
		$kura = $countttd-1;
		
		$wid = 800/$jmlh;
		$cols = $kura*$wid;
		
		$report .=
			'<table width="785" border="0">
				<tr>';
		if($ttd == ""){
		
			$report .= '<td>&nbsp;</td>';
		
		} else {
			$day = date("d");
			$mon = $this->mrealisasi->v_bln(date("m"));
			$year = date("Y");
			$report .=
					'<td width="'.$wid.'" height="10" align="center">Mengetahui :</td>
					</tr><tr>';			            
			$report .=
					'<td width="'.$wid.'" height="10" align="center">KEPALA DINAS KABUPATEN SIGI <br/>PENGELOLAAN KEUANGAN DAN ASET DAERAH</td>
                    <td width="'.$wid.'" align="center">Sigi Biromaru, '.$day.' '.$mon.' '.$year.' <br/> BENDAHARA PENERIMA</td>
					</tr><tr>
						<td colspan="'.$countttd.'" height="80">&nbsp;</td>
					</tr><tr>';
                    
			
			$t = explode(",",$ttd);
			$countttd = count($t);
			
			for($i=$countttd-1;$i>=0;$i--){
				$k = $t[$i];
				$que = $this->db->query("select nama_ttd from master_tanda_tangan where id ='".$k."'");
				foreach($que->result() as $rs) {
				
				//	if($q==NULL) {
						$report .= 
							'<td width="'.$wid.'" height="10" align="center">'.$rs->nama_ttd.'</td>';
				//	}
				}
			}
			
			$us = $this->db->query("select jabatan_ttd from master_tanda_tangan where id ='".$k."'")->row();
			$report .=
					'<td width="'.$wid.'" height="10" align="center">I R F A N</td>
					</tr><tr>';
			
			for($i=$countttd-1;$i>=0;$i--){
				$k = $t[$i];
				$que = $this->db->query("select nip_ttd from master_tanda_tangan where id ='".$k."'");
				foreach($que->result() as $rs) {
				
				//	if($q==NULL) {
						$report .= 
							'<td width="'.$wid.'" height="10" align="center">NIP. '.$rs->nip_ttd.'</td>';
				//	}
				}
			}
			$report .=
				'<td width="'.$wid.'" height="10" align="center">NIP. 19640111 200504 1 008</td>';
		}
					
		$report .=
				'</tr>
			</table>';
			
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Target'.'.pdf', 'I');
		
		}
	
    
    public function data_realisasi_bln($periode="")
	{
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";

		$p = explode('-',$periode);

			//$bulan = $thn.'-'.$bln;
			
            $bulann = substr($periode,6,2);
            $tahunn = substr($periode,0,4);
            $bulann_min = floatval($bulann) - 1; 
			
            //$sql = $this->db->query("SELECT * FROM (SELECT kelompok,nm_rek2,kd_rek2 
            //FROM ms_rek2 UNION SELECT kelompok,nm_rek3,kd_rek3 FROM ms_rek3 UNION SELECT kelompok,nm_rek4,kd_rek4 FROM ms_rek4)a WHERE kelompok IS NOT NULL AND LEFT(kd_rek2,1)='4' ORDER BY kelompok");
            $sql = $this->db->query("SELECT ms_rek2.kd_rek2 AS kode,ms_rek2.nm_rek2 AS nama, SUM(trdrka.nilai) AS anggaran,
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,2) = ms_rek2.kd_rek2 AND MONTH(trhkasin_pkd.tgl_sts)='$bulann' AND YEAR(trhkasin_pkd.tgl_sts)='$tahunn') AS penerimaan,
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,2) = ms_rek2.kd_rek2 AND MONTH(trhkasin_pkd.tgl_sts) BETWEEN '01' AND '$bulann_min' AND YEAR(trhkasin_pkd.tgl_sts)='$tahunn') AS penerimaan_lalu
FROM ms_rek2
JOIN trdrka ON LEFT(trdrka.kd_rek5,2)=ms_rek2.kd_rek2
JOIN ms_skpdn ON trdrka.kd_skpd = ms_skpdn.kd_skpd
WHERE LEFT(trdrka.kd_rek5,1)='4' GROUP BY ms_rek2.kd_rek2
UNION
SELECT ms_rek3.kd_rek3 AS kode,ms_rek3.nm_rek3 AS nama, SUM(trdrka.nilai) AS anggaran,  
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,3) = ms_rek3.kd_rek3 AND MONTH(trhkasin_pkd.tgl_sts)='$bulann' AND YEAR(trhkasin_pkd.tgl_sts)='$tahunn') AS penerimaan,
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,3) = ms_rek3.kd_rek3 AND MONTH(trhkasin_pkd.tgl_sts) BETWEEN '01' AND '$bulann_min' AND YEAR(trhkasin_pkd.tgl_sts)='$tahunn') AS penerimaan_lalu
FROM ms_rek3
JOIN trdrka ON LEFT(trdrka.kd_rek5,3)=ms_rek3.kd_rek3
JOIN ms_skpdn ON trdrka.kd_skpd = ms_skpdn.kd_skpd
WHERE LEFT(trdrka.kd_rek5,1)='4' GROUP BY ms_rek3.kd_rek3
UNION
SELECT ms_rek4.kd_rek4 AS kode,ms_rek4.nm_rek4 AS nama, SUM(trdrka.nilai) AS anggaran,  
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,5) = ms_rek4.kd_rek4 AND MONTH(trhkasin_pkd.tgl_sts)='$bulann' AND YEAR(trhkasin_pkd.tgl_sts)='$tahunn') AS penerimaan,
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,5) = ms_rek4.kd_rek4 AND MONTH(trhkasin_pkd.tgl_sts) BETWEEN '01' AND '$bulann_min' AND YEAR(trhkasin_pkd.tgl_sts)='$tahunn') AS penerimaan_lalu
FROM ms_rek4
JOIN trdrka ON LEFT(trdrka.kd_rek5,5)=ms_rek4.kd_rek4
JOIN ms_skpdn ON trdrka.kd_skpd = ms_skpdn.kd_skpd
WHERE LEFT(trdrka.kd_rek5,1)='4' GROUP BY ms_rek4.kd_rek4
UNION
SELECT ms_rek5.kd_rek5 AS kode,ms_rek5.nm_rek5 AS nama, SUM(trdrka.nilai) AS anggaran,  
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,7) = ms_rek5.kd_rek5 AND MONTH(trhkasin_pkd.tgl_sts)='$bulann' AND YEAR(trhkasin_pkd.tgl_sts)='$tahunn') AS penerimaan,
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,7) = ms_rek5.kd_rek5 AND MONTH(trhkasin_pkd.tgl_sts) BETWEEN '01' AND '$bulann_min' AND YEAR(trhkasin_pkd.tgl_sts)='$tahunn') AS penerimaan_lalu
FROM ms_rek5
JOIN trdrka ON LEFT(trdrka.kd_rek5,7)=ms_rek5.kd_rek5
JOIN ms_skpdn ON trdrka.kd_skpd = ms_skpdn.kd_skpd
WHERE LEFT(trdrka.kd_rek5,1)='4' GROUP BY ms_rek5.kd_rek5
ORDER BY kode,nama
");				
				foreach($sql->result() as $rs) {
				    $kode_rek = $rs->kode;
                    $nama_rek = $rs->nama;
                    $anggaran_rek = $rs->anggaran;                                        
					$terima=$rs->penerimaan;
					$setorn=$rs->penerimaan;
					$terima_lalu=$rs->penerimaan_lalu;
					$setorn_lalu=$rs->penerimaan_lalu;
					$jumlah_anggaran_reals=$terima+$terima_lalu;
					$jumlah_anggaran_setor=$setorn+$setorn_lalu;
					$sisa_anggaran_blm_setor=$anggaran_rek-$jumlah_anggaran_setor;
					
                    if ($anggaran_rek==0) {
                        $anggaran_rek=0;
                        $persen=0;
                    }else{
                        $anggaran_rek = $rs->anggaran;
                        $persen=$jumlah_anggaran_setor/$anggaran_rek*100;
                    }
                    
                    if ($terima==0){
                        $terima=0;
                    }else{
                        $terima=$rs->penerimaan;
                    }
					
                    if ($terima_lalu==0){
                        $terima_lalu=0;
                    }else{
                        $terima_lalu=$rs->penerimaan_lalu;
                    }
                    
                    if ($setorn==0){
                        $setorn=0;
                    }else{
                        $setorn=$rs->penerimaan;
                    }
                    
                    if ($setorn_lalu==0){
                        $setorn_lalu=0;
                    }else{
                        $setorn_lalu=$rs->penerimaan_lalu;
                    }
                    
					$persen=number_format($persen,2,",",".");
			        //$i = 0; 
			echo ("<row>");
				echo("<cell><![CDATA[".$kode_rek."]]></cell>");
				echo("<cell><![CDATA[".$nama_rek."]]></cell>");
				echo("<cell><![CDATA[".$anggaran_rek."]]></cell>");
				echo("<cell><![CDATA[".$terima."]]></cell>");
				echo("<cell><![CDATA[".$setorn."]]></cell>");
				echo("<cell><![CDATA[".$terima_lalu."]]></cell>");
				echo("<cell><![CDATA[".$setorn_lalu."]]></cell>");
				echo("<cell><![CDATA[".$jumlah_anggaran_reals."]]></cell>");
				echo("<cell><![CDATA[".$jumlah_anggaran_setor."]]></cell>");
				echo("<cell><![CDATA[".$persen."]]></cell>");
				echo("<cell><![CDATA[".$sisa_anggaran_blm_setor."]]></cell>");
			echo("</row>");			
		}
		echo "</rows>";
	}
	
	function ttd_lpr_pendapatan_bln()
	{
		$data['data'] = $_GET['full'];
		$data['ttd'] = $this->model_user->ttd();
		$this->load->view('realisasi_pendapatan/ttd_lpr_pendapatan_bln',$data);
	}

	public function cetak_lap_realisasi_bln()
	{
		$p = $_GET['full'];
		$o = explode('|',$p);
		$periode = $o[0];		
		$ttd = $o[1];
		
		$t = explode('-',$periode);
		$bln = $t[1];
		$thn = $t[0];
		$bulan = $this->mrealisasi->v_bln($bln);		
        $bln2 = floatval($bln) - 1;
        
                $f = 0;
				$h = 0;  
                $g = 0;                                                
                $i = 0;

		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd');
		$pdf = new sptpd('L', 'pt', 'A4', true, 'UTF-8', false);

		//set info
		$pdf->setTitle('Report_'.$arr);

		//set informasi
		$pdf->SetSubject('LPR');
		$pdf->SetKeywords('LPR');

		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->setHeaderMargin(10);
		$pdf->setMargins(30,30,30);

		//set font yang digunakan
		$pdf->SetFont('times', '', 6);

		$pdf->AddPage('L', 'A4', false);
		//set data
		$report = '';
		$report .=
			'<table width="100%">
				<tr>
					<td><h2 align="center">PEMERINTAH KABUPATEN SIGI <br/> LAPORAN REALISASI PENERIMAAN PENDAPATAN DAERAH <br/>BULAN '.strtoupper($bulan).' TAHUN '.$thn.'</h2></td>
				</tr>
				<tr>
					<td height="3"></td>
				</tr>			
                <tr>
                    <td align="left" width="13%">SKPD</td>
                    <td align="left" width="40%">: DINAS PENDAPATAN PENGELOLAAN KEUANGAN DAN ASET DAERAH KABUPATEN SIGI</td>
                </tr>
                <tr>
                    <td align="left" width="13%">PENGGUNA ANGGARAN / KPA</td>
                    <td align="left" width="40%">: Drs. H. ENDRO SETIAWAN</td>
                </tr>
                <tr>
                    <td align="left" width="13%">Bendahara Penerimaan</td>
                    <td align="left" width="40%">: IRFAN</td>
                </tr>
                <tr>
					<td height="3"></td>
				</tr>			                
			</table>';
	

		$report .=
			'<table border="1" cellpadding="2">
				<tr bgcolor="#EEE"> 
					<td width="4%" rowspan="2" colspan="1"><div align="center" class="huruf2"><strong>Kode Rekening</strong></div></td>
					<td width="30%" rowspan="2" colspan="1"><div align="center" class="huruf2"><strong>Uraian</strong></div></td>
					<td width="7%" rowspan="2"><div align="center" class="huruf2"><strong>Jumlah Anggaran</strong></div></td>
					<td width="14%" rowspan="1" colspan="2"><div align="center" class="huruf2"><strong>Bulan ini</strong></div></td>
					<td width="14%" rowspan="1" colspan="2"><div align="center" class="huruf2"><strong>Sampai dengan Bulan Lalu</strong></div></td>
					<td width="27%" rowspan="1" colspan="3"><div align="center" class="huruf2"><strong>Sampai dengan Bulan ini</strong></div></td>
					<td width="5%" rowspan="2"><div align="center" class="huruf"><strong>Persentase (%)</strong></div></td>
				</tr>
				<tr bgcolor="#EEE">
				  	<td width="7%"><div align="center" class="huruf"><strong>Penerimaan</strong></div></td>
					<td width="7%"><div align="center" class="huruf"><strong>Penyetoran</strong></div></td>
					<td width="7%"><div align="center" class="huruf"><strong>Penerimaan</strong></div></td>
					<td width="7%"><div align="center" class="huruf"><strong>Penyetoran</strong></div></td>
					<td width="9%"><div align="center" class="huruf"><strong>Jumlah Anggaran yang Terealisasi</strong></div></td>
					<td width="9%"><div align="center" class="huruf"><strong>Jumlah Anggaran yang Telah Disetor</strong></div></td>
					<td width="9%"><div align="center" class="huruf"><strong>Sisa Anggaran yang Belum Terealisasi / Pelampauan Anggaran</strong></div></td>
					
				</tr>
				<tr bgcolor="#EEE">
					<td width="4%"><div align="center" class="huruf2"><strong><i>1</i></strong></div></td>
					<td width="30%"><div align="center" class="huruf2"><strong><i>2</i></strong></div></td>
					<td width="7%"><div align="center" class="huruf2"><strong><i>3</i></strong></div></td>
					<td width="7%"><div align="center" class="huruf2"><strong><i>4</i></strong></div></td>
					<td width="7%"><div align="center" class="huruf2"><strong><i>5</i></strong></div></td>
					<td width="7%"><div align="center" class="huruf2"><strong><i>6</i></strong></div></td>
					<td width="7%"><div align="center" class="huruf2"><strong><i>7</i></strong></div></td>
					<td width="9%"><div align="center" class="huruf2"><strong><i>8</i></strong></div></td>
					<td width="9%"><div align="center" class="huruf2"><strong><i>9</i></strong></div></td>
					<td width="9%"><div align="center" class="huruf2"><strong><i>10</i></strong></div></td>
					<td width="5%"><div align="center" class="huruf2"><strong><i>11</i></strong></div></td>
				</tr>';
                
				$sql = $this->db->query("SELECT ms_rek2.kd_rek2 AS kode,ms_rek2.nm_rek2 AS nama, SUM(trdrka.nilai) AS anggaran,
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,2) = ms_rek2.kd_rek2 AND MONTH(trhkasin_pkd.tgl_sts)='$bln' AND YEAR(trhkasin_pkd.tgl_sts)='$thn') AS penerimaan,
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,2) = ms_rek2.kd_rek2 AND MONTH(trhkasin_pkd.tgl_sts) BETWEEN '01' AND '$bln2' AND YEAR(trhkasin_pkd.tgl_sts)='$thn') AS penerimaan_lalu
FROM ms_rek2
JOIN trdrka ON LEFT(trdrka.kd_rek5,2)=ms_rek2.kd_rek2
JOIN ms_skpdn ON trdrka.kd_skpd = ms_skpdn.kd_skpd
WHERE LEFT(trdrka.kd_rek5,1)='4' GROUP BY ms_rek2.kd_rek2
UNION
SELECT ms_rek3.kd_rek3 AS kode,ms_rek3.nm_rek3 AS nama, SUM(trdrka.nilai) AS anggaran,  
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,3) = ms_rek3.kd_rek3 AND MONTH(trhkasin_pkd.tgl_sts)='$bln' AND YEAR(trhkasin_pkd.tgl_sts)='$thn') AS penerimaan,
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,3) = ms_rek3.kd_rek3 AND MONTH(trhkasin_pkd.tgl_sts) BETWEEN '01' AND '$bln2' AND YEAR(trhkasin_pkd.tgl_sts)='$thn') AS penerimaan_lalu
FROM ms_rek3
JOIN trdrka ON LEFT(trdrka.kd_rek5,3)=ms_rek3.kd_rek3
JOIN ms_skpdn ON trdrka.kd_skpd = ms_skpdn.kd_skpd
WHERE LEFT(trdrka.kd_rek5,1)='4' GROUP BY ms_rek3.kd_rek3
UNION
SELECT ms_rek4.kd_rek4 AS kode,ms_rek4.nm_rek4 AS nama, SUM(trdrka.nilai) AS anggaran,  
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,5) = ms_rek4.kd_rek4 AND MONTH(trhkasin_pkd.tgl_sts)='$bln' AND YEAR(trhkasin_pkd.tgl_sts)='$thn') AS penerimaan,
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,5) = ms_rek4.kd_rek4 AND MONTH(trhkasin_pkd.tgl_sts) BETWEEN '01' AND '$bln2' AND YEAR(trhkasin_pkd.tgl_sts)='$thn') AS penerimaan_lalu
FROM ms_rek4
JOIN trdrka ON LEFT(trdrka.kd_rek5,5)=ms_rek4.kd_rek4
JOIN ms_skpdn ON trdrka.kd_skpd = ms_skpdn.kd_skpd
WHERE LEFT(trdrka.kd_rek5,1)='4' GROUP BY ms_rek4.kd_rek4
UNION
SELECT ms_rek5.kd_rek5 AS kode,ms_rek5.nm_rek5 AS nama, SUM(trdrka.nilai) AS anggaran,  
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,7) = ms_rek5.kd_rek5 AND MONTH(trhkasin_pkd.tgl_sts)='$bln' AND YEAR(trhkasin_pkd.tgl_sts)='$thn') AS penerimaan,
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,7) = ms_rek5.kd_rek5 AND MONTH(trhkasin_pkd.tgl_sts) BETWEEN '01' AND '$bln2' AND YEAR(trhkasin_pkd.tgl_sts)='$thn') AS penerimaan_lalu
FROM ms_rek5
JOIN trdrka ON LEFT(trdrka.kd_rek5,7)=ms_rek5.kd_rek5
JOIN ms_skpdn ON trdrka.kd_skpd = ms_skpdn.kd_skpd
WHERE LEFT(trdrka.kd_rek5,1)='4' GROUP BY ms_rek5.kd_rek5
ORDER BY kode,nama");
				$z=1;
					foreach($sql->result() as $rs) {
					   $z=$z+1;
				    $kode_rek = $rs->kode;
                    $nama_rek = $rs->nama;
                    $anggaran_rek = $rs->anggaran;                                        
					$terima=$rs->penerimaan;
					$setorn=$rs->penerimaan;
					$terima_lalu=$rs->penerimaan_lalu;
					$setorn_lalu=$rs->penerimaan_lalu;
					$jumlah_anggaran_reals=$terima+$terima_lalu;
					$jumlah_anggaran_setor=$setorn+$setorn_lalu;
					$sisa_anggaran_blm_setor=$anggaran_rek-$jumlah_anggaran_setor;
					
                    if ($anggaran_rek==0) {
                        $anggaran_rek=0;
                        $persen=0;
                    }else{
                        $anggaran_rek = $rs->anggaran;
                        $persen=$jumlah_anggaran_setor/$anggaran_rek*100;
                    }
                    
                    if ($terima==0){
                        $terima=0;
                    }else{
                        $terima=$rs->penerimaan;
                    }
					
                    if ($terima_lalu==0){
                        $terima_lalu=0;
                    }else{
                        $terima_lalu=$rs->penerimaan_lalu;
                    }
                    
                    if ($setorn==0){
                        $setorn=0;
                    }else{
                        $setorn=$rs->penerimaan;
                    }
                    
                    if ($setorn_lalu==0){
                        $setorn_lalu=0;
                    }else{
                        $setorn_lalu=$rs->penerimaan_lalu;
                    }
                    
					$persen=number_format($persen,2,",",".");

				$report .=
							'<tr>
								<td width="4%" height="12" align="left">'.$kode_rek.'</td>
								<td width="30%" height="12" align="left">'.$nama_rek.'</td>
								<td width="7%" height="12" align="right">'.number_format($anggaran_rek,2,",",".").'</td>
								<td width="7%" height="12" align="right">'.number_format($terima,2,",",".").'</td>
								<td width="7%" height="12" align="right">'.number_format($setorn,2,",",".").'</td>
								<td width="7%" height="12" align="right">'.number_format($terima_lalu,2,",",".").'</td>
								<td width="7%" height="12" align="right">'.number_format($setorn_lalu,2,",",".").'</td>
								<td width="9%" height="12" align="right">'.number_format($jumlah_anggaran_reals,2,",",".").'</td>
								<td width="9%" height="12" align="right">'.number_format($jumlah_anggaran_setor,2,",",".").'</td>
								<td width="9%" height="12" align="right">'.number_format($sisa_anggaran_blm_setor,2,",",".").'</td>
								<td width="5%" height="12" align="right">'.number_format($persen,1,",",".").' %</td>
							</tr>';                                                                                                                            
                } 
                
                $sql = $this->db->query("SELECT SUM(trdrka.nilai) AS anggaran,  
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,1) = '4' AND MONTH(trhkasin_pkd.tgl_sts)='$bln' AND YEAR(trhkasin_pkd.tgl_sts)='$thn') AS penerimaan,
(SELECT SUM(trdkasin_pkd.rupiah) FROM trdkasin_pkd  INNER JOIN trhkasin_pkd ON trdkasin_pkd.no_sts = trhkasin_pkd.no_sts 
WHERE LEFT(trdkasin_pkd.kd_rek5,1) = '4' AND MONTH(trhkasin_pkd.tgl_sts) BETWEEN '01' and '$bln2' AND YEAR(trhkasin_pkd.tgl_sts)='$thn') AS penerimaan_lalu
FROM ms_rek5
JOIN trdrka ON LEFT(trdrka.kd_rek5,7)=ms_rek5.kd_rek5
JOIN ms_skpdn ON trdrka.kd_skpd = ms_skpdn.kd_skpd
WHERE LEFT(trdrka.kd_rek5,1)='4' 
GROUP BY LEFT(trdrka.kd_rek5,1)='4'");                                 
                
                foreach($sql->result() as $rx) {                				        
                    
                    $f = $rx->penerimaan + $rx->penerimaan_lalu;
                    $h = $rx->anggaran - $f;
                    $i = $rx->anggaran - $h;
                    $z = ($i/$rx->anggaran)*100;
                    
                 $report .=
							'<tr bgcolor="#EEE">								
								<td colspan="2" width="34%" height="12" align="center">J U M L A H</td>
								<td width="7%" height="12" align="right">'.number_format($rx->anggaran,2,",",".").'</td>
								<td width="7%" height="12" align="right">'.number_format($rx->penerimaan,2,",",".").'</td>
								<td width="7%" height="12" align="right">'.number_format($rx->penerimaan,2,",",".").'</td>
								<td width="7%" height="12" align="right">'.number_format($rx->penerimaan_lalu,2,",",".").'</td>
								<td width="7%" height="12" align="right">'.number_format($rx->penerimaan_lalu,2,",",".").'</td>
								<td width="9%" height="12" align="right">'.number_format($f,2,",",".").'</td>
								<td width="9%" height="12" align="right">'.number_format($f,2,",",".").'</td>
								<td width="9%" height="12" align="right">'.number_format($h,2,",",".").'</td>
								<td width="5%" height="12" align="right">'.number_format($z,1,",",".").' %</td>
							</tr>';
                               }
				$report .='</table>
						<table>
							<tr>
								<td height="10"></td>
							</tr>
						</table>';
		
        $penerimaan_bulan_ini = explode(",",$ttd);
		$countttd = count($penerimaan_bulan_ini);
		$jmlh = $countttd;
		$kura = $countttd-1;
		
		$wid = 800/$jmlh;
		$cols = $kura*$wid;
		
		$report .=
			'<table width="785" border="0">
				<tr>';
		if($ttd == ""){
		
			$report .= '<td>&nbsp;</td>';
		
		} else {
			$day = date("d");
			$mon = $this->mrealisasi->v_bln(date("m"));
			$year = date("Y");
			$report .=
					'<td width="'.$wid.'" height="10" align="center">Mengetahui :</td>
					</tr><tr>';			            
			$report .=
					'<td width="'.$wid.'" height="10" align="center">KEPALA DINAS KABUPATEN SIGI <br/>PENGELOLAAN KEUANGAN DAN ASET DAERAH</td>
                    <td width="'.$wid.'" align="center">Sigi Biromaru, '.$day.' '.$mon.' '.$year.' <br/> BENDAHARA PENERIMA</td>
					</tr><tr>
						<td colspan="'.$countttd.'" height="80">&nbsp;</td>
					</tr><tr>';
                    
			
			$t = explode(",",$ttd);
			$countttd = count($t);
			
			for($i=$countttd-1;$i>=0;$i--){
				$k = $t[$i];
				$que = $this->db->query("select nama_ttd from master_tanda_tangan where id ='".$k."'");
				foreach($que->result() as $rs) {
				
				//	if($q==NULL) {
						$report .= 
							'<td width="'.$wid.'" height="10" align="center">'.$rs->nama_ttd.'</td>';
				//	}
				}
			}
			
			$us = $this->db->query("select jabatan_ttd from master_tanda_tangan where id ='".$k."'")->row();
			$report .=
					'<td width="'.$wid.'" height="10" align="center">I R F A N</td>
					</tr><tr>';
			
			for($i=$countttd-1;$i>=0;$i--){
				$k = $t[$i];
				$que = $this->db->query("select nip_ttd from master_tanda_tangan where id ='".$k."'");
				foreach($que->result() as $rs) {
				
				//	if($q==NULL) {
						$report .= 
							'<td width="'.$wid.'" height="10" align="center">NIP. '.$rs->nip_ttd.'</td>';
				//	}
				}
			}
			$report .=
				'<td width="'.$wid.'" height="10" align="center">NIP. 19640111 200504 1 008</td>';
		}
					
		$report .=
				'</tr>
			</table>';
			
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_Target'.'.pdf', 'I');
		
		}			        
}