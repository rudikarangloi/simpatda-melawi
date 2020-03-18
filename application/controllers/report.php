<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class report extends MY_Controller {
	
	function __construct() {
            parent::__construct();
            $this->load->model('msistem');
    }
	
/*	public function index() {
		$this->load->view('report/hiburan');
	}

	//Tes buat menulis di git
*/
	public function form(){
		$this->load->view('report/form');
	}
	
	public function cek_report(){
		$row['jenis'] = $this->input->post('jenis', true);
		$row['tanggal']=$this->input->post('tanggal', true);
		$row['bulan']=$this->input->post('bulan', true);
		$row['tahun']=$this->input->post('tahun', true);
		switch($row['bulan']){
			case 01:
				$row['bln']="Januari";
			break;
			case 02:
				$row['bln']="Februari";
			break;
			case 03:
				$row['bln']="Maret";
			break;
			case 04:
				$row['bln']="April";
			break;
			case 05:
				$row['bln']="Mei";
			break;
			case 06:
				$row['bln']="Juni";
			break;
			case 07:
				$row['bln']="Juli";
			break;
			case 08:
				$row['bln']="Agustus";
			break;
			case 09:
				$row['bln']="September";
			break;
			case 10:
				$row['bln']="Oktober";
			break;
			case 11:
				$row['bln']="November";
			break;
			case 12:
				$row['bln']="Desember";
			break;
		}
		$jenis = $row['jenis'];
		if($row['jenis'] == 'HIB'){
			if($row['tanggal']){
				$tanggal = "$row[tahun]-$row[bulan]-$row[tanggal]";
				
				$row['sql'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 7 and (sspd.no_skpd like '%$jenis%') and (sspd.tanggal like '%$tanggal%')");
				
				$row['sql2'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 5 and (sspd.no_skpd like '%$jenis%') and (sspd.tanggal like '$tanggal')");
				
				
				$row['total'] = $this->db->query("select * from sspd where (no_skpd like '%$jenis%') and (tanggal like '$tanggal%')");
				$row['total_bgt'] = $this->db->query("select * from sspd where (no_skpd like '%$jenis%')");
				$row['nama_sptpd'] = $this->db->query("select * from master_sptpd where (kode_sptpd like '$row[jenis]')");
				
				$row['tot2'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 7 and (sspd.no_skpd like '%$jenis%')");
				
				$row['tot3'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 5 and (sspd.no_skpd like '%$jenis%')");
				
				//tgl sebelum	
				$tgl_sebelum = $row['tanggal']-1;
				$tanggal2 = "$row[tahun]-$row[bulan]-$tgl_sebelum";
				$row['tot_sebelum'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 7 and (sspd.no_skpd like '%$jenis%') and (tanggal like '$tanggal2')");
				
				//tgl sebelum	
				$tgl_sebelum2 = $row['tanggal']-1;
				$tanggal3 = "$row[tahun]-$row[bulan]-$tgl_sebelum2";
				$row['tot_sebelum2'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 5 and (sspd.no_skpd like '%$jenis%') and (tanggal like '$tanggal3')");
				
				//tahun sebelum total banget booo	
				$tahun_sebelum_tot = $row['tanggal']-1;
				$tanggal4 = "$row[tahun]-$row[bulan]-$tahun_sebelum_tot";
				$row['tot_sebelum_all'] = $this->db->query("select * from sspd where (no_skpd like '%$jenis%') and (tanggal like '$tanggal4')");
				$row['sblm'] = "Hari Sebelum";
				$row['per'] = "Per Tanggal $row[tanggal]-$row[bulan]-$row[tahun]";
				$row['ini'] = "Hari Ini";
				$this->load->view('report/hiburan',$row);
				
			}else if($row['bulan'] and $row['tahun']){
				$tanggal = "$row[tahun]-$row[bulan]";
				
				$row['sql'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 7 and (sspd.no_skpd like '%$jenis%') and (sspd.tanggal like '$tanggal%')");
				
				$row['sql2'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 5 and (sspd.no_skpd like '%$jenis%') and (sspd.tanggal like '$tanggal%')");
				
				$row['total'] = $this->db->query("select * from sspd where (no_skpd like '%$jenis%') and (tanggal like '$tanggal%')");
				$row['total_bgt'] = $this->db->query("select * from sspd where (no_skpd like '%$jenis%')");
				$row['nama_sptpd'] = $this->db->query("select * from master_sptpd where (kode_sptpd like '$row[jenis]')");
				
				$row['tot2'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 7 and (sspd.no_skpd like '%$jenis%')");
				
				$row['tot3'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 5 and (sspd.no_skpd like '%$jenis%')");
				
				//bln sebelum	
				$bln_sebelum = $row['bulan']-1;
				$tanggal2 = "$row[tahun]-$bln_sebelum";
				$row['tot_sebelum'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 7 and (sspd.no_skpd like '%$jenis%') and (tanggal like '$tanggal2%')");
				
				//bln sebelum2	
				$bln_sebelum2 = $row['bulan']-1;
				$tanggal3 = "$row[tahun]-$bln_sebelum2";
				$row['tot_sebelum2'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 5 and (sspd.no_skpd like '%$jenis%') and (tanggal like '$tanggal3%')");
				
				//tahun sebelum total banget booo	
				$tahun_sebelum_tot = $row['bulan']-1;
				$tanggal4 = "$row[tahun]-$tahun_sebelum_tot";
				$row['tot_sebelum_all'] = $this->db->query("select * from sspd where (no_skpd like '%$jenis%') and (tanggal like '$tanggal4%')");
				
				$row['sblm'] = "Bulan Sebelum";
				$row['per'] = "Per Bulan $row[bln] $row[tahun]";
				$row['ini'] = "Bulan Ini";
				$this->load->view('report/hiburan',$row);
				
			}else{
				$tanggal = "$row[tahun]";
				$row['sql'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 7 and (sspd.no_skpd like '%$jenis%') and (sspd.tanggal like '$tanggal%')");
				
				$row['sql2'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 5 and (sspd.no_skpd like '%$jenis%') and (sspd.tanggal like '$tanggal%')");
				
				$row['total'] = $this->db->query("select * from sspd where (no_skpd like '%$jenis%') and (tanggal like '$tanggal%')");
				$row['total_bgt'] = $this->db->query("select * from sspd where (no_skpd like '%$jenis%')");
				$row['nama_sptpd'] = $this->db->query("select * from master_sptpd where (kode_sptpd like '$row[jenis]')");
				
				$row['tot2'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 7 and (sspd.no_skpd like '%$jenis%')");
				
				$row['tot3'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 5 and (sspd.no_skpd like '%$jenis%')");
				//tahun sebelum	
				$tahun_sebelum = $row['tahun']-1;
				$row['tot_sebelum'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 7 and (sspd.no_skpd like '%$jenis%') and (tanggal like '$tahun_sebelum%')");
				
				//tahun sebelum	
				$tahun_sebelum2 = $row['tahun']-1;
				$row['tot_sebelum2'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 5 and (sspd.no_skpd like '%$jenis%') and (tanggal like '$tahun_sebelum2%')");
				
				//tahun sebelum total banget booo	
				$tahun_sebelum_tot = $row['tahun']-1;
				$row['tot_sebelum_all'] = $this->db->query("select * from sspd where (no_skpd like '%$jenis%') and (tanggal like '$tahun_sebelum_tot%')");
				
				$row['sblm'] = "Tahun Sebelum";
				$row['per'] = "Per Tahun $row[tahun]";
				$row['ini'] = "Tahun Ini";
				$this->load->view('report/hiburan',$row);
			}
		}
		// Report Untuk Hotel
		else if($row['jenis'] == 'HTL'){
			if($row['tahun']){
				$tanggal = "$row[tahun]";
				$row['sql'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hotel where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hotel.no_sptpd and sptpd_hotel.gol_hotel = '4.1.1.01.06.00' and (sspd.no_skpd like '%$jenis%') and (sspd.tanggal like '$tanggal%')");
				
				$this->load->view('paksa/report_hotel',$row);
			}
		}
		else if($row['jenis'] == 'RES'){
				$this->load->view('paksa/report_restoran');
		}
		else if($row['jenis'] == 'REK'){
				$this->load->view('paksa/report_reklame');
		}
		else if($row['jenis'] == 'LIS'){
				$this->load->view('paksa/report_listrik');
		}
		else if($row['jenis'] == 'GAL'){
			$this->load->view('paksa/report_gal');
		}
		else if($row['jenis'] == 'WLT'){
			if($row['tanggal']){
				$tanggal = "$row[tahun]-$row[bulan]-$row[tanggal]";
				
				$row['walet'] = $this->db->query("select * from sspd where (no_skpd like '%$jenis%') and (tanggal like '$tanggal%')");
				$row['total_bgt'] = $this->db->query("select * from sspd where (no_skpd like '%$jenis%')");
				$row['nama_sptpd'] = $this->db->query("select * from master_sptpd where (kode_sptpd like '$row[jenis]')");
				
				//tgl sebelum	
				$tgl_sebelum = $row['tanggal']-1;
				$tanggal2 = "$row[tahun]-$row[bulan]-$tgl_sebelum";
				$row['tot_sebelum'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 7 and (sspd.no_skpd like '%$jenis%') and (tanggal like '$tanggal2')");
				
				//tanggal sebelum total banget booo	
				$tahun_sebelum_tot = $row['tanggal']-1;
				$tanggal4 = "$row[tahun]-$row[bulan]-$tahun_sebelum_tot";
				$row['tot_sebelum_all'] = $this->db->query("select * from sspd where (no_skpd like '%$jenis%') and (tanggal like '$tanggal4')");
				$row['sblm'] = "Hari Sebelum";
				$row['per'] = "Per Tanggal $row[tanggal]-$row[bulan]-$row[tahun]";
				$row['ini'] = "Hari Ini";
				$this->load->view('paksa/report_walet',$row);
			}else if($row['bulan'] and $row['tahun']){
				$tanggal = "$row[tahun]-$row[bulan]";
				
				$row['sql'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 7 and (sspd.no_skpd like '%$jenis%') and (sspd.tanggal like '$tanggal%')");
				
				$row['sql2'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 5 and (sspd.no_skpd like '%$jenis%') and (sspd.tanggal like '$tanggal%')");
				
				$row['total'] = $this->db->query("select * from sspd where (no_skpd like '%$jenis%') and (tanggal like '$tanggal%')");
				$row['total_bgt'] = $this->db->query("select * from sspd where (no_skpd like '%$jenis%')");
				$row['nama_sptpd'] = $this->db->query("select * from master_sptpd where (kode_sptpd like '$row[jenis]')");
				
				$row['tot2'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 7 and (sspd.no_skpd like '%$jenis%')");
				
				$row['tot3'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 5 and (sspd.no_skpd like '%$jenis%')");
				
				//bln sebelum	
				$bln_sebelum = $row['bulan']-1;
				$tanggal2 = "$row[tahun]-$bln_sebelum";
				$row['tot_sebelum'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 7 and (sspd.no_skpd like '%$jenis%') and (tanggal like '$tanggal2%')");
				
				//bln sebelum2	
				$bln_sebelum2 = $row['bulan']-1;
				$tanggal3 = "$row[tahun]-$bln_sebelum2";
				$row['tot_sebelum2'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 5 and (sspd.no_skpd like '%$jenis%') and (tanggal like '$tanggal3%')");
				
				//tahun sebelum total banget booo	
				$tahun_sebelum_tot = $row['bulan']-1;
				$tanggal4 = "$row[tahun]-$tahun_sebelum_tot";
				$row['tot_sebelum_all'] = $this->db->query("select * from sspd where (no_skpd like '%$jenis%') and (tanggal like '$tanggal4')");
				$row['sblm'] = "Bulan Sebelum";
				$row['per'] = "Per Bulan $row[bln]";
				$row['ini'] = "Bulan Ini";
				$this->load->view('paksa/report',$row);
			}else{
				$tanggal = "$row[tahun]";
				$row['sql'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 7 and (sspd.no_skpd like '%$jenis%') and (sspd.tanggal like '$tanggal%')");
				
				$row['sql2'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 5 and (sspd.no_skpd like '%$jenis%') and (sspd.tanggal like '$tanggal%')");
				
				$row['total'] = $this->db->query("select * from sspd where (no_skpd like '%$jenis%') and (tanggal like '$tanggal%')");
				$row['total_bgt'] = $this->db->query("select * from sspd where (no_skpd like '%$jenis%')");
				$row['nama_sptpd'] = $this->db->query("select * from master_sptpd where (kode_sptpd like '$row[jenis]')");
				
				$row['tot2'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 7 and (sspd.no_skpd like '%$jenis%')");
				
				$row['tot3'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 5 and (sspd.no_skpd like '%$jenis%')");
				//tahun sebelum	
				$tahun_sebelum = $row['tahun']-1;
				$row['tot_sebelum'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 7 and (sspd.no_skpd like '%$jenis%') and (tanggal like '$tahun_sebelum%')");
				
				//tahun sebelum	
				$tahun_sebelum2 = $row['tahun']-1;
				$row['tot_sebelum2'] = $this->db->query("select sspd.* from sspd, skpd, sptpd_hiburan where sspd.no_skpd = skpd.no_skpd and skpd.no_sptpd = sptpd_hiburan.no_sptpd and sptpd_hiburan.jenis_hiburan = 5 and (sspd.no_skpd like '%$jenis%') and (tanggal like '$tahun_sebelum2%')");
				
				//tahun sebelum total banget booo	
				$tahun_sebelum_tot = $row['tahun']-1;
				$row['tot_sebelum_all'] = $this->db->query("select * from sspd where (no_skpd like '%$jenis%') and (tanggal like '$tahun_sebelum_tot%')");
				
				$row['sblm'] = "Tahun Sebelum";
				$row['per'] = "Per Tahun $row[tahun]";
				$row['ini'] = "Tahun Ini";
				$this->load->view('paksa/report',$row);

			}
		}
		else if($row['jenis'] == 'PKR'){
			$this->load->view('paksa/report_parkir');
		}
		else if($row['jenis'] == 'AIR'){
			$this->load->view('paksa/report_air');
		}
	}
}
?>