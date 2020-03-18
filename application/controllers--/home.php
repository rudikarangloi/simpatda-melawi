<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
		$this->load->model('msistem');
	}    

	public function index()
	{
            $data['username'] = $username = $this->session->userdata('username');
			$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
            //$data['nm_modul'] = $s->nm_modul; 
			$group = $this->session->userdata('id_modul');
        
		    //Data Chart
			$tgl = "";
			$register = "";
			$pemilik = "";
			$perusahaan = "";
			$n = 31;
			for($i=1;$i<=$n;$i++) {
				if(strlen($i)==1){
					$i = '0'.$i;
				} else {
					$i;
				}
				$tgl .= "'".$i."'";
				if($i != $n):
					$tgl .= ",";
				endif;
				$tanggal = date("Y-m").'-'.$i;
				// Data Jumlah Register
				$sql = $this->db->query("select count(*) as jml from register where created like '".$tanggal."%'");
				$rs = $sql->row();
	
				$register .= $rs->jml;
				if($i != $n):
					$register .= ",";
				endif;
				
				// Data Jumlah Pemilik
				$sql = $this->db->query("select count(*) as jml from identitas_pemilik where created like '".$tanggal."%'");
				$rs = $sql->row();
	
				$pemilik .= $rs->jml;
				if($i != $n):
					$pemilik .= ",";
				endif;
				
				// Data Jumlah Perusahaan
				$sql = $this->db->query("select count(*) as jml from identitas_perusahaan where tgl_daftar like'".$tanggal."'");
				$rs = $sql->row();
	
				$perusahaan .= $rs->jml;
				if($i != $n):
					$perusahaan .= ",";
				endif;
			}
			$data['tgl'] = $tgl;
			$data['thn'] = date('Y');
			$data['bulan'] = $this->msistem->v_bln(date('m'));
			$data['register'] = $register;
			$data['pemilik'] = $pemilik;
			$data['perusahaan'] = $perusahaan;
				
			if (empty($username)) {
                redirect(site_url().'/home/login');
            } else {
				$list_pajak = "";
				$data_usaha = $this->db->query("select left(npwpd_perusahaan,1) as npwpd_perusahaan from identitas_perusahaan where npwpd_pemilik = '$username' order by npwpd_perusahaan");
                foreach($data_usaha->result() as $rs) {
					$list_pajak .= ",".$rs->npwpd_perusahaan;
                }
				$data['list_pajak'] = $list_pajak;
                $this->load->view('home', $data);
            }		
	}
        
        function login()
        {
            $username = $this->session->userdata('username');
            if(empty($username)):
                //$data['judul'] = 'Dasa Manunggal Sejahtera';
                $data['msg'] = NULL;
                $this->load->view('login',$data);
            endif;
        }
        
        function logout()
        {
            $this->session->sess_destroy();
			$data['site_url'] = site_url();
			$this->load->view('logout',$data);
            //redirect(site_url());
        }
        
        function processlogin()
        {
           
            $m = $this->msistem->loginCheck($this->input->post('username'),md5($this->input->post('password')));
            
            if($this->session->userdata('username'))
            {   
				redirect(site_url().'/home');
            } else {
                //$data['judul'] = 'SIMTEX 2012';
                $data['msg'] = ' Maaf, user dan password tidak sesuai !';
                $this->load->view('login',$data);
            }
        }
		
        
        function process()
        {
            if (stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml")) {
			header("Content-type: application/xhtml+xml"); } else {
			header("Content-type: text/xml");
		}
            $m = $this->msistem->loginCheck($this->input->post('username'),($this->input->post('password')));
            if($this->session->userdata('username'))
            {   
				redirect(site_url().'/home');
            } else {
                //$data['judul'] = 'SIMTEX 2012';
                $text = 'Ada kesalahan pada saat login, coba lagi!';
           	
        		echo("<cell><![CDATA[".$text."]]></cell>");
       		
                //$data['msg'] = 'Ada kesalahan pada saat login, coba lagi!';
                //$this->load->view('log',$data);
            }
            
        }

	
	function mainMenu($id_modul='') {
		if (stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml")) {
			header("Content-type: application/xhtml+xml"); } else {
			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n"); 	
		echo "<menu>";
			$this->menu(0,$id_modul);
		echo "</menu>";
	}
	
	function menu($parent,$id_modul) {
		
		$data=$this->db->query("select id from menu_by_modul order by posisi asc");
		$count=count($data->result());
		
		//if($parent==0){	
		$sql=$this->db->query("select menu from menu_modul where id_modul='".$id_modul."'");
		$s = $sql->row();
		$nos = $s->menu;
		$cek = explode("|",$nos);
		$countcek = count($cek);
		
		for($i=$countcek-1;$i>=0;$i--){
			$q=$this->db->query("select concat(kode,'|',controller) as idmenu,menu,kode from menu_by_modul where parent='".$parent."' and display='1' and kode='".$cek[$i]."' order by id asc");
			foreach($q->result() as $rs) {
			
			$qr=$this->db->query("select * from menu_by_modul where parent='".$rs->kode."' and display='1' order by id asc");
			$num=count($qr->result());
			
				if($num==0) {
					echo "<item id=\"".$rs->idmenu."\" text=\"".ucwords($rs->menu)."\" />";
				} else {
					echo "<item id=\"".$rs->idmenu."\" text=\"".ucwords($rs->menu)."\"  >";
					$this->menu($rs->kode,$id_modul);
					echo "</item>";
				}
			}
		}
	}
	
	function report() {
		$tgl = "";
		$register = "";
		$pemilik = "";
		$perusahaan = "";
		$n = 31;
		for($i=1;$i<=$n;$i++) {
			if(strlen($i)==1){
				$i = '0'.$i;
			} else {
				$i;
			}
			$tgl .= "'".$i."'";
			if($i != $n):
				$tgl .= ",";
			endif;
			$tanggal = date("Y-m").'-'.$i;
			// Data Jumlah Register
			$sql = $this->db->query("select count(*) as jml from register where created like '".$tanggal."%'");
			$rs = $sql->row();

			$register .= $rs->jml;
			if($i != $n):
				$register .= ",";
			endif;
			
			// Data Jumlah Pemilik
			$sql = $this->db->query("select count(*) as jml from identitas_pemilik where created like '".$tanggal."%'");
			$rs = $sql->row();

			$pemilik .= $rs->jml;
			if($i != $n):
				$pemilik .= ",";
			endif;
			
			// Data Jumlah Perusahaan
			$sql = $this->db->query("select count(*) as jml from identitas_perusahaan where tgl_daftar like'".$tanggal."'");
			$rs = $sql->row();

			$perusahaan .= $rs->jml;
			if($i != $n):
				$perusahaan .= ",";
			endif;
		}
		$data['username'] = $username = $this->session->userdata('username');
		$data['tgl'] = $tgl;
		$data['thn'] = date('Y');
		$data['bulan'] = $this->msistem->v_bln(date('m'));
		$data['register'] = $register;
		$data['pemilik'] = $pemilik;
		$data['perusahaan'] = $perusahaan;
		$this->load->view('chart',$data);
	}
	
	function registrasi(){
		$data['kelurahan']=$this->db->query("select kode_kelurahan, nama_kelurahan from kelurahan");
		$data['usaha']=$this->db->query("select id as id_usaha, nama_sptpd as nm_usaha from master_sptpd order by id asc");
		$data['status'] = $this->db->query("select * from status order by id_status asc");
		$this->load->view('registrasi',$data);
	}
	
	public function ckel() {
		$id = $this->input->post('kelurahan');
		$e = $this->db->query("select kode_kecamatan from kelurahan where id='".$id."'")->row();
		$g = $e->kode_kecamatan;
		
		$qlo = $this->db->query("select nama_kecamatan from view_kelurahan where kode_kecamatan='".$g."'")->row();
		$result = $qlo->nama_kecamatan;
		echo $result;
	}
	
	public function crinci() {
		$id = $this->input->post('rinci');
		$e = $this->db->query("select kode,nm_rekening from master_rinci where id='".$id."'")->row();
		$g = $e->kode;
		
		//$qlo = $this->db->query("select nama_kecamatan from view_kelurahan where kode_kecamatan='".$g."'")->row();
		//$result = $qlo->nama_kecamatan;
		echo $g;
	}
	
	public function ckel_pemilik() {
		$id = $this->input->post('kelurahan_p');
		$e = $this->db->query("select kode_kecamatan from kelurahan where kode_kelurahan='".$id."'")->row();
		$g = $e->kode_kecamatan;
		
		$qlo = $this->db->query("select nama_kecamatan from view_kelurahan where kode_kecamatan='".$g."'")->row();
		$result = $qlo->nama_kecamatan;
		echo $result;
	}
	
    public function cek_skpd() {
		$e = $this->db->query("select nama_skpd from master_skpd2")->row();
		$result = $e->nama_skpd;				
		echo $result;
	}
    
	public function simpan_register() {
		$tahun = date('Y');
		$data = array (
			'nama_perusahaan' => strtoupper($this->input->post('nama_perusahaan')),
			'alamat_perusahaan' => strtoupper($this->input->post('alamat_perusahaan')),
			'jalan' => strtoupper($this->input->post('jalan')),
			'rt' => strtoupper($this->input->post('rt')),
			'rw' => strtoupper($this->input->post('rw')),
			'email' => strtoupper($this->input->post('email')),
			'kelurahan' => strtoupper($this->input->post('kelurahan')),
			'kecamatan' => strtoupper($this->input->post('kecamatan')),
			'kabupaten' => strtoupper($this->input->post('kabupaten')),
			'telp' => strtoupper($this->input->post('telp')),
			'kodepos' => strtoupper($this->input->post('kodepos')),
			
			'npwpd_pemilik' => strtoupper($this->input->post('id_pemilik')),
			'nama_pemilik' => strtoupper($this->input->post('nama_p')),
			'alamat_pemilik' => strtoupper($this->input->post('alamat_p')),
			'jalan_pemilik' => strtoupper($this->input->post('jalan_p')),
			'rt_pemilik' => strtoupper($this->input->post('rt_p')),
			'rw_pemilik' => strtoupper($this->input->post('rw_p')),
			'email_pemilik' => strtoupper($this->input->post('email_p')),
			'lokasi_pemilik' => strtoupper($this->input->post('lokasi_p')),
			'kelurahan_pemilik' => strtoupper($this->input->post('kelurahan_p')),
			'kecamatan_pemilik' => strtoupper($this->input->post('kecamatan_p')),
			'kabupaten_pemilik' => strtoupper($this->input->post('kabupaten_p')),
			'telp_pemilik' => strtoupper($this->input->post('telp_p')),
			'kodepos_pemilik' => strtoupper($this->input->post('kodepos_p')),
			
			'jenis_usaha' => strtoupper($this->input->post('jenis_usaha')),
			'status_usaha' => strtoupper($this->input->post('status')),
			'kategori' => strtoupper($this->input->post('kategori')),
			'jml_karyawan' => strtoupper($this->input->post('jml_karyawan')),
			'ukuran_tempat' => strtoupper($this->input->post('ukuran_tempat')),
			'surat_izin' => strtoupper($this->input->post('izin')),
			'no_surat' => strtoupper($this->input->post('nomor')),
			'tgl_surat' => strtoupper($this->input->post('tanggal')),
			'jenis_pajak' => strtoupper($this->input->post('jenis_pajak')),
			'jenis_pajak_detail' => strtoupper($this->input->post('jns')),
			'tgl_daftar' => strtoupper($this->input->post('tgl_daftar')),
			'status_laporan' => "PENDING",
            'author' => $this->session->userdata('username')
		);
		
		$no_daftar = $this->generateNo();
		$dataIns = array_merge($data,array('no_daftar' => $no_daftar,'created' => date('Y-m-d H:i:s')));
		$this->db->insert('register',$dataIns);
		echo $no_daftar;
	}
	
    public function cetak_registrasi($id=''){
        
        $id2 = $id;
        
       $sql = $this->db->query("SELECT a.id, 
       a.no_daftar,
       a.tgl_daftar, 
       a.nama_perusahaan, 
       a.alamat_perusahaan, 
       b.nama_kelurahan, 
       b.nama_kecamatan, 
       a.kabupaten, 
       a.telp, 
       a.npwpd_pemilik, 
       a.nama_pemilik, 
       a.alamat_pemilik, 
       c.nama_kelurahan AS nm_kel, 
       c.nama_kecamatan AS nm_kec, 
       a.kabupaten_pemilik, 
       a.telp_pemilik, 
       d.nm_usaha, 
       a.jenis_pajak_detail, 
       DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') AS tgl_daftar, 
       a.status_laporan FROM register a LEFT JOIN view_kelurahan b ON a.kelurahan=b.kode_kelurahan LEFT JOIN view_kelurahan c ON a.kelurahan_pemilik=c.kode_kelurahan LEFT JOIN jenis_usaha d ON a.jenis_usaha=d.id_usaha LEFT JOIN master_sptpd e ON a.jenis_pajak=e.id WHERE a.status_laporan='PENDING' GROUP BY a.id DESC")->row();
		
		$jumlah = number_format($sql->jenis_pajak_detail,2,",",".");
		//$description = $this->msistem->baca($sql->jumlah);
		$a = explode("/",$sql->tgl_daftar);
		$a1 = $a[1];
		$awal				= $this->msistem->v_bln($a1);
		$tahun				= $a[2];
		$tgl = $a[0].' '.$awal.' '.$tahun;
		$petugas = 'ANIFAH';
		$nip = '19620817 199118 2 801';
		
		//$kd = explode('/',$sql->no_skpd);
		//$s = $this->db->query('select nama_sptpd from master_sptpd where kode_sptpd="'.$kd[1].'"')->row();
		
		//$res = $this->db->query('select kode_rekening, nama_rekening from sspd_detail where no_sspd ="'.$sql->no_sspd.'"');
		
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
		$pdf->SetMargins(50,30,50);
		// set font yang digunakan
		$pdf->SetFont('times', '', 10);
	
		$pdf->AddPage('P','LEGAL',false);
		//set data
		$report = '';
		$report .=
			'<table border=1>
				<tr>
					<td width="450" align="center">
						PEMERINTAH KABUPATEN ACEH BARAT<br />
						DINAS PENGELOLAAN KEUANGAN DAN KEKAYAAN DAERAH<br />
						TANDA BUKTI REGISTRASI<br />
						NOMOR : '.$sql->no_daftar.'<br />
						Jl. Gajah Mada Telp (0655) 7551163. Fax. 7551167
					</td>
				</tr>
			</table>';
			
		$report .=
			'<table border="1">
				<tr>
					<td width="450"><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Tanggal Pendaftaran : '.$tgl.'<br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br /><br /><br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					NPWPD Pemilik &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$sql->npwpd_pemilik.'<br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Nama Pemilik &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$sql->nama_pemilik.'<br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Alamat Pemilik &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$sql->alamat_pemilik.'<br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Sebagai pembayaran &nbsp;&nbsp;&nbsp;: PAJAK '.$sql->nm_usaha.'<br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
                    
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Nama Perusahaan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$sql->nama_perusahaan.'<br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Alamat Perusahaan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$sql->alamat_perusahaan.'<br />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Pemberitahuan Pajak &nbsp;&nbsp;: Rp. '.$jumlah.'<br />';
					/*foreach($res->result() as $de){
						$report .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						'.$de->kode_rekening.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$de->nama_rekening.'<br/><br/><br/><br/>';
					}*/
		$report .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br /><br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mengetahui, <br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bendahara Penerimaan&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Registrasi<br />
					<br /><br /><br /><br/><br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					'.$petugas.'
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$sql->nama_pemilik.'<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;'.$nip.'<br />
					
					</td>
				</tr>
			</table>
			<!--<font size="-3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Lembar Asli : Untuk Pembayaran/Pihak Ketiga/Penyetor
			Salinan 1 : Untuk Bendahara Penerima/Pembantu 
			Salinan 2 : Arsip</font>-->';
		
		//$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_SPTPD'.'.pdf', 'I');
    }
    
	public function generateNo() {
		$sql = $this->db->query("select MAX(no_daftar) as max from register")->row();
		$r = $sql->max;
		if($r==NULL){
			$daftar = "REG.000000001";
		} else {
			$c = explode(".",$r);
			$jml = $c[1] + 1;
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
			} else if(strlen($jml)==9) {
				$jml;
			}
			$daftar = "REG.".$jml;
		}
		return $daftar;
	}	
}
?>