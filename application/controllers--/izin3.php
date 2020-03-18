<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class izin extends MY_Controller {
	
	public function registrasi() {
		$this->load->view('izin/registrasi');
	}
	
	public function data_registrasi() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id, no_daftar, nama_perusahaan, alamat_perusahaan, kelurahan, kecamatan, kabupaten, telp, npwpd_pemilik, nama_pemilik, alamat_pemilik, kelurahan_pemilik, kecamatan_pemilik, kabupaten_pemilik, telp_pemilik, jenis_usaha, jenis_pajak, jenis_pajak_detail, DATE_FORMAT(tgl_daftar,'%d/%m/%Y') as tgl_daftar, status_laporan from register where status_laporan='PENDING'","id","id, no_daftar, nama_perusahaan, alamat_perusahaan, kelurahan, kecamatan, kabupaten, telp, npwpd_pemilik, nama_pemilik, alamat_pemilik, kelurahan_pemilik, kecamatan_pemilik, kabupaten_pemilik, telp_pemilik, jenis_usaha, jenis_pajak, jenis_pajak_detail, tgl_daftar, status_laporan");
	}
	
	public function load_registrasi($op="",$nilai="") {
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($op=='1'){
			$sqr = "and no_daftar like '%".$nilai."%'";
		} else if($op=='2'){
			$sqr = "and nama_perusahaan like '%".$nilai."%'";
		} else if($op=='3'){
			$sqr = "and npwpd_pemilik like '%".$nilai."%'";
		} else if($op=='4'){
			$sqr = "and nama_pemilik like '%".$nilai."%'";
		} else if($op=='5'){
			$sqr = "and jenis_usaha like '%".$nilai."%'";
		} else if($op=='6'){
			$sqr = "and jenis_pajak like '%".$nilai."%'";
		}
		$qr = $this->db->query("select id, no_daftar, nama_perusahaan, alamat_perusahaan, jalan, rt, rw, email, kelurahan, kecamatan, kabupaten, telp, kodepos, npwpd_pemilik, nama_pemilik, alamat_pemilik, jalan_pemilik, rt_pemilik, rw_pemilik, email_pemilik, lokasi_pemilik, kelurahan_pemilik, kecamatan_pemilik, kabupaten_pemilik, telp_pemilik, kodepos_pemilik, jenis_usaha, status_usaha, kategori, jml_karyawan, ukuran_tempat, surat_izin, no_surat, DATE_FORMAT(tgl_surat,'%d/%m/%Y') as tgl_surat, jenis_pajak, jenis_pajak_detail, DATE_FORMAT(tgl_daftar,'%d/%m/%Y') as tgl_daftar from register where status_laporan = 'PENDING' $sqr");
		
		$i=1;
		foreach($qr->result() as $rs) {
			// cair
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$rs->id."]]></cell>");
					echo("<cell><![CDATA[".$rs->no_daftar."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->jalan."]]></cell>");
					echo("<cell><![CDATA[".$rs->rt."]]></cell>");
					echo("<cell><![CDATA[".$rs->rw."]]></cell>");
					echo("<cell><![CDATA[".$rs->email."]]></cell>");
					echo("<cell><![CDATA[".$rs->kelurahan."]]></cell>");
					echo("<cell><![CDATA[".$rs->kecamatan."]]></cell>");
					echo("<cell><![CDATA[".$rs->kabupaten."]]></cell>");
					echo("<cell><![CDATA[".$rs->telp."]]></cell>");
					echo("<cell><![CDATA[".$rs->kodepos."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->jalan_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->rt_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->rw_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->email_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->lokasi_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->kelurahan_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->kecamatan_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->kabupaten_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->telp_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->kodepos_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->jenis_usaha."]]></cell>");
					echo("<cell><![CDATA[".$rs->status_usaha."]]></cell>");
					echo("<cell><![CDATA[".$rs->kategori."]]></cell>");
					echo("<cell><![CDATA[".$rs->jml_karyawan."]]></cell>");
					echo("<cell><![CDATA[".$rs->ukuran_tempat."]]></cell>");
					echo("<cell><![CDATA[".$rs->surat_izin."]]></cell>");
					echo("<cell><![CDATA[".$rs->no_surat."]]></cell>");
					echo("<cell><![CDATA[".$rs->tgl_surat."]]></cell>");
					echo("<cell><![CDATA[".$rs->jenis_pajak."]]></cell>");
					echo("<cell><![CDATA[".$rs->jenis_pajak_detail."]]></cell>");
					echo("<cell><![CDATA[".$rs->tgl_daftar."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	//Identitas Pemilik
	public function pemilik() {
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select nm_modul from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['kelurahan']=$this->db->query("select id, nama_kelurahan from kelurahan");
		$data['nm_modul'] = $s->nm_modul;
		$this->load->view('izin/pemilik',$data);
	}
	
	public function ckel() {
		$id = $this->input->post('kelurahan');
		$e = $this->db->query("select kode_kecamatan from kelurahan where kode_kelurahan='".$id."'")->row();
		$g = $e->kode_kecamatan;
		
		$qlo = $this->db->query("select nama_kecamatan from view_kelurahan where kode_kecamatan='".$g."'")->row();
		$result = $qlo->nama_kecamatan;
		echo $result;
	}
	
	public function load_pemilik($op="",$nilai="") {
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($op=='1'){
			$sqr = "and npwpd_pemilik like '%".$nilai."%'";
		} else if($op=='2'){
			$sqr = "and nama_pemilik like '%".$nilai."%'";
		} else if($op=='3'){
			$sqr = "and alamat_pemilik like '%".$nilai."%'";
		} else if($op=='4'){
			$sqr = "and no_identitas like '%".$nilai."%'";
		} else if($op=='5'){
			$sqr = "and email like '%".$nilai."%'";
		} else if($op=='6'){
			$sqr = "and kewarganegaraan like '%".$nilai."%'";
		}
		$qr = $this->db->query("select id, npwpd_pemilik, jns_identitas, kewarganegaraan, no_identitas, nama_pemilik, alamat_pemilik, jalan, rt, rw, email, desa_kel2, kecamatan, kabupaten, tempat_lahir, tanggal_lahir, jenis_kelamin,lokasi,hp from identitas_pemilik where status='0' $sqr");
		
		$i=1;
		foreach($qr->result() as $rs) {
			// cair
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$rs->id."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->jns_identitas."]]></cell>");
					echo("<cell><![CDATA[".$rs->kewarganegaraan."]]></cell>");
					echo("<cell><![CDATA[".$rs->no_identitas."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->jalan."]]></cell>");
					echo("<cell><![CDATA[".$rs->rt."]]></cell>");
					echo("<cell><![CDATA[".$rs->rw."]]></cell>");
					//echo("<cell><![CDATA[".$rs->dusun."]]></cell>");
					echo("<cell><![CDATA[".$rs->email."]]></cell>");
					echo("<cell><![CDATA[".$rs->desa_kel2."]]></cell>");
					echo("<cell><![CDATA[".$rs->kecamatan."]]></cell>");
					echo("<cell><![CDATA[".$rs->kabupaten."]]></cell>");
					echo("<cell><![CDATA[".$rs->tempat_lahir."]]></cell>");
					echo("<cell><![CDATA[".$rs->tanggal_lahir."]]></cell>");
					echo("<cell><![CDATA[".$rs->jenis_kelamin."]]></cell>");
					echo("<cell><![CDATA[".$rs->lokasi."]]></cell>");
					echo("<cell><![CDATA[".$rs->hp."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function data_pemilik() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,npwpd_pemilik,jns_identitas,kewarganegaraan,no_identitas,nama_pemilik,alamat_pemilik,jalan,rt,rw,email,desa_kel2,kecamatan,kabupaten,tempat_lahir,DATE_FORMAT(tanggal_lahir,'%d/%m/%Y') as tanggal_lahir,jenis_kelamin,lokasi,hp from identitas_pemilik","id","id,npwpd_pemilik,jns_identitas,kewarganegaraan,no_identitas,nama_pemilik,alamat_pemilik,jalan,rt,rw,email,desa_kel2,kecamatan,kabupaten,tempat_lahir,tanggal_lahir,jenis_kelamin,lokasi,hp");	
	}
	
	public function simpan_pemilik() {
		$npwpd = $this->input->post('npwpd');
		if($npwpd==NULL){
			//max npwpd
			$q = $this->db->query("select max(npwpd_pemilik) as nos from identitas_pemilik")->row();
			$nos = $q->nos;
			
			$lokasi = $this->input->post('lokasi');
			if($lokasi==1){
				//kode kelurahan
				$idkel = $this->input->post('kelurahan');
				$skel = $this->db->query("select kode_kelurahan,kode_kecamatan from view_kelurahan where id='".$idkel."'")->row();
				$kdkel = $skel->kode_kelurahan;
				if(strlen($kdkel)==1){
					$ckel = '0'.$kdkel;
				} else if(strlen($kdkel)==2){
					$ckel = $kdkel;
				}
				
				//kode kecamatan
				$kdkec = $skel->kode_kecamatan;
				if(strlen($kdkec)==1){
					$ckec = '0'.$kdkec;
				} else if(strlen($kdkec)==2){
					$ckec = $kdkec;
				}
				
				//no npwpd	
				if($nos==NULL) {
					$npwpd = "P.1.000001.".$ckec.".".$ckel;
				} else {
					$cek = explode(".",$nos);
					$no = $cek[2] + 1;
					
					if(strlen($no)==1) {
						$no_urut = '00000'.$no;	
					} else if(strlen($no)==2) {
						$no_urut = '0000'.$no;
					} else if(strlen($no)==3) {
						$no_urut = '000'.$no;	
					} else if(strlen($no)==4) {
						$no_urut = '00'.$no;
					} else if(strlen($no)==5) {
						$no_urut = '0'.$no;
					} else if(strlen($no)==6) {
						$no_urut = $no;	
					}
					$npwpd = "P.1.".$no_urut.".".$ckec.".".$ckel;		
				}
			} else {
				if($nos==NULL) {
					$npwpd = "P.1.000001.00.00";
				} else {
					$cek = explode(".",$nos);
					$no = $cek[2] + 1;
					
					if(strlen($no)==1) {
						$no_urut = '00000'.$no;	
					} else if(strlen($no)==2) {
						$no_urut = '0000'.$no;
					} else if(strlen($no)==3) {
						$no_urut = '000'.$no;	
					} else if(strlen($no)==4) {
						$no_urut = '00'.$no;
					} else if(strlen($no)==5) {
						$no_urut = '0'.$no;
					} else if(strlen($no)==6) {
						$no_urut = $no;	
					}
					$npwpd = "P.1.".$no_urut.".00.00";		
				}
			}
		}
		
		$data = array (
			'npwpd_pemilik'			=> strtoupper($npwpd),
			'jns_identitas' 	=> strtoupper($this->input->post('jns')),
			'kewarganegaraan' 	=> strtoupper($this->input->post('negara')),
			'no_identitas' 		=> strtoupper($this->input->post('identitas')),
			'nama_pemilik' 			=> strtoupper($this->input->post('nama')),
			'alamat_pemilik' 		=> strtoupper($this->input->post('alamat')),
			'jalan' 		=> strtoupper($this->input->post('jalan')),
			'rt' 			=> strtoupper($this->input->post('rt')),
			'rw' 			=> strtoupper($this->input->post('rw')),
			'lokasi' 		=> $this->input->post('lokasi'),
			'hp' 		=> $this->input->post('hp'),
			'desa_kel2' 	=> strtoupper($this->input->post('kelurahan')),
			'email' 		=> $this->input->post('email'),
			'kecamatan' 	=> strtoupper($this->input->post('kecamatan')),
			'kabupaten' 	=> strtoupper($this->input->post('kabupaten')),
			'tempat_lahir' 	=> strtoupper($this->input->post('tempat_lahir')),
			'tanggal_lahir' => strtoupper($this->input->post('tanggal_lahir')),
			'jenis_kelamin' => strtoupper($this->input->post('jk')),
			//'photo' 		=> $photos['file_name'],
			'author' 		=> strtoupper($this->session->userdata('username'))
		);
		
		if($this->input->post('id')==0){
			$dataIns = array_merge($data,array('created' => date('Y-m-d H:i:s')));
			$this->db->insert('identitas_pemilik',$dataIns);
			$dataUpd = array('status' => 'TERDAFTAR');
			//$this->db->update('register', $dataUpd, array('no_daftar' => $this->input->post('reg')));
			$result = "ID Pemilik ".$npwpd." berhasil disimpan.";
		} else {
			$dataUpd = array_merge($data,array('modified' => date('Y-m-d H:i:s')));
			$result = $this->db->update('identitas_pemilik', $dataUpd, array('id' => $this->input->post('id')));
			$result = "ID Pemilik ".$npwpd." berhasil diubah.";
		}
		echo $result;
	}
	
	public function delete_pemilik() {
		$id = $this->input->post('id');
		$npwpd = $this->input->post('npwpd');
		
		$sql = $this->db->query("select npwpd_pemilik from view_perusahaan where npwpd_pemilik='".$npwpd."'")->result();
		if($sql==NULL){
			$this->db->delete('identitas_pemilik',array('id' => $this->input->post('id')));
			//$result = "Data pemilik berhasil dihapus.";
			$result = 1;
		} else {
			//$result = "Silakan Menghapus Data Perusahaan Terlebih Dahulu";
			$result = 0;
		}
		echo $result;
	}
	
	//Identitas Perusahaan
	public function perusahaan() {
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$data['usaha']=$this->db->query("select id_usaha, nm_usaha from jenis_usaha order by id_usaha asc");
		$data['kelurahan']=$this->db->query("select kode_kelurahan, nama_kelurahan from kelurahan");
		$data['status'] = $this->db->query("select * from status order by id_status asc");
		$this->load->view('izin/perusahaan',$data);
	}
	
	public function lihat_pemilik() {
		$s = $this->input->post('id_pemilik');
		$w = $this->db->query("select nama_pemilik,alamat_pemilik from identitas_pemilik where npwpd_pemilik='".$s."'")->row();
		
		if($w==NULL){
			$q = 0;
		} else {
			$nama = $w->nama_pemilik;
			$alamat = $w->alamat_pemilik;
			$q = $nama.",".$alamat;
		}
		echo $q;
	}
	
	public function cek_pemilik(){
		$s = $this->input->post('id_pemilik');
		$cek = $this->db->query('select id from identitas_pemilik where npwpd_pemilik = "'.$s.'"')->row();
		if($cek==NULL){
			$dark = 0;
		} else {
			$dark = 1;
		}
		echo $dark; 
	}
	
	public function load_perusahaan($op="",$nilai="") {
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($op==1){
			$cu = "where a.npwpd_perusahaan like '%".$nilai."%'";
		} else if($op==2){
			$cu = "where a.nama_perusahaan like '%".$nilai."%'";
		} else if($op==3){
			$cu = "where b.nama_pemilik like '%".$nilai."%'";
		}
		
		$qr = $this->db->query("select a.id, a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan, a.telp, a.kodepos, b.npwpd_pemilik, b.nama_pemilik, b.alamat_pemilik, b.hp, b.email, a.jenis_usaha, a.status_usaha, a.jenis_pajak, a.jenis_pajak_detail, DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') as tgl_daftar from identitas_perusahaan a left join identitas_pemilik b on a.npwpd_pemilik=b.npwpd_pemilik $cu");
		
		$i=1;
		foreach($qr->result() as $rs) {
			// cair
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$rs->id."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->telp."]]></cell>");
					echo("<cell><![CDATA[".$rs->kodepos."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->hp."]]></cell>");
					echo("<cell><![CDATA[".$rs->email."]]></cell>");
					echo("<cell><![CDATA[".$rs->jenis_usaha."]]></cell>");
					echo("<cell><![CDATA[".$rs->status_usaha."]]></cell>");
					echo("<cell><![CDATA[".$rs->jenis_pajak."]]></cell>");
					echo("<cell><![CDATA[".$rs->jenis_pajak_detail."]]></cell>");
					echo("<cell><![CDATA[".$rs->tgl_daftar."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function data_perusahaan() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id, a.npwpd_perusahaan, a.nama_perusahaan, a.alamat_perusahaan, a.jalan, a.rt, a.rw, a.email, a.kelurahan, c.nama_kecamatan, a.kabupaten, a.telp, a.kodepos, b.npwpd_pemilik, b.nama_pemilik, b.alamat_pemilik, b.jalan as jalan_p, b.rt as rt_p, b.rw as rw_p, b.email as email_p, b.lokasi, b.desa_kel2, b.kecamatan as kecamatan_p, b.kabupaten as kabupaten_p, b.hp, b.kodepos, a.jenis_usaha, a.status_usaha, a.kategori, a.jml_karyawan, a.ukuran_tempat, a.surat_izin, a.no_surat, DATE_FORMAT(a.tgl_surat,'%d/%m/%Y') as tgl_surat, a.jenis_pajak, a.jenis_pajak_detail, DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') as tgl_daftar, a.kecamatan from identitas_perusahaan a inner join identitas_pemilik b on a.npwpd_pemilik = b.npwpd_pemilik inner join kecamatan c on a.kecamatan = c.kode_kecamatan","id","id, npwpd_perusahaan, nama_perusahaan, alamat_perusahaan, jalan, rt, rw, email, kelurahan, nama_kecamatan, kabupaten, telp, kodepos, npwpd_pemilik, nama_pemilik, alamat_pemilik, jalan_p, rt_p, rw_p, email_p, lokasi, desa_kel2, kecamatan_p, kabupaten_p, hp, kodepos, jenis_usaha, status_usaha, kategori, jml_karyawan, ukuran_tempat, surat_izin, no_surat, tgl_surat, jenis_pajak, jenis_pajak_detail, tgl_daftar, kecamatan");	
	}
	
	public function simpan_perusahaan() {
		$upd = array(
			'status' => 1
		);
		$this->db->update('identitas_pemilik', $upd, array('npwpd_pemilik' => $this->input->post('id_pemilik')));
		
		$id_perusahaan = $this->input->post('id_perusahaan');
		if($id_perusahaan==NULL){
			//kode kelurahan
			$idkel = $this->input->post('kelurahan');
			$skel = $this->db->query("select kode_kelurahan,kode_kecamatan from view_kelurahan where id='".$idkel."'")->row();
			$kdkel = $skel->kode_kelurahan;
			if(strlen($kdkel)==1){
				$ckel = '0'.$kdkel;
			} else if(strlen($kdkel)==2){
				$ckel = $kdkel;
			}
			
			//kode kecamatan
			$kdkec = $skel->kode_kecamatan;
			if(strlen($kdkec)==1){
				$ckec = '0'.$kdkec;
			} else if(strlen($kdkec)==2){
				$ckec = $kdkec;
			}
			
			//kode npwpd			
			$q = $this->db->query("select max(npwpd_perusahaan) as nos from identitas_perusahaan")->row();
			$nos = $q->nos;
			
			if($nos==NULL) {
				$id_perusahaan = "P.2.000001.".$ckec.".".$ckel;
			} else {
				$cek = explode(".",$nos);
				$no = $cek[2] + 1;
				
				if(strlen($no)==1) {
					$no_urut = '00000'.$no;	
				} else if(strlen($no)==2) {
					$no_urut = '0000'.$no;
				} else if(strlen($no)==3) {
					$no_urut = '000'.$no;	
				} else if(strlen($no)==4) {
					$no_urut = '00'.$no;
				} else if(strlen($no)==5) {
					$no_urut = '0'.$no;
				} else if(strlen($no)==6) {
					$no_urut = $no;	
				}		
				$id_perusahaan = "P.2.".$no_urut.".".$ckec.".".$ckel;
			}
		}
		
		$data = array (
			'npwpd_perusahaan' => $id_perusahaan,
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
			
			/*
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
			*/
			
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
			'terdaftar' => date('Y-m-d'),
			'author' 		=> strtoupper($this->session->userdata('username'))
		);
		if($this->input->post('id')==0){
			$dataIns = array_merge($data,array('created' => date('Y-m-d H:i:s')));
			$this->db->insert('identitas_perusahaan',$dataIns);
			$dataUpd = array('status_laporan' => "TERDAFTAR", 'author' => strtoupper($this->session->userdata('username')), 'modified' => date('Y-m-d H:i:s'));
			$this->db->update('register', $dataUpd, array('no_daftar' => $this->input->post('no_daftar')));
			$result = $id_perusahaan;
		} else {
			$dataUpd = array_merge($data,array('modified' => date('Y-m-d H:i:s')));
			$this->db->update('identitas_perusahaan', $dataUpd, array('id' => $this->input->post('id')));
			$result = $id_perusahaan;
		}
		echo $result;
	}
	
	public function cetak_perusahaan() {
		
		$arr = 'NPWPD';

		$data = $this->db->query("select a.npwpd_perusahaan as npwpd_perusahaan, a.nama_perusahaan as nama_perusahaan, a.alamat_perusahaan as alamat_perusahaan, DATE_FORMAT(a.terdaftar,'%d/%m/%Y') as tgl, b.nm_usaha as nm_usaha from identitas_perusahaan a inner join jenis_usaha b on a.jenis_usaha=b.id_usaha where a.npwpd_perusahaan='".$_GET['npwpd']."'")->row();
		$no 			= $data->npwpd_perusahaan;
		$nama 		  = $data->nama_perusahaan;
		$jenis_usaha		= $data->nm_usaha;
		$alamat 			= $data->alamat_perusahaan;
		$tgl 				= $data->tgl;
		
		$query = $this->db->query("select isi from master_template where code_izin='".$arr."'");
		$rs = $query->row();	
		$html = $rs->isi;
		
		$searchArray = array("[no]","[nama]","[alamat]","[tgl]","[jenis]");
		$replaceArray = array($no,$nama,$alamat,$tgl,$jenis_usaha);
		$intoString = $html;
		//now let's replace
		$report = str_replace($searchArray, $replaceArray, $intoString);
		
		//setting pdf
		$this->load->library('header/header_output');
		$pdf = new header_output('P', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SIMTAP');
		$pdf->SetKeywords('SIMTAP');
	
		//set no header & footer
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(32);
		$pdf->SetMargins(50,110,50);
		// set font yang digunakan
		$pdf->SetFont('times', '', 12);
	
		$pdf->AddPage('P','LEGAL',false);
		//set data
		$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->lastPage();
		$pdf->Output('Report_'.$arr.'.pdf', 'I');
	}
	
	public function delete_perusahaan() {
		$id_perusahaan = $this->input->post('id_perusahaan');
		$sq = $this->db->query("select count(npwpd_perusahaan) as jml from view_npwpd where npwpd_perusahaan='".$id_perusahaan."'")->row();
		$a = $sq->jml;
		if($a==0){
			$this->db->delete('identitas_perusahaan',array('npwpd_perusahaan' => $this->input->post('id_perusahaan')));
			$result = "Data Perusahaan berhasil dihapus.";
		} else {
			$result = "Silakan Menghapus Data SPTPD Terlebih Dahulu";
		}
		echo $result;
	}
	
	public function report_daftar(){
		$this->load->view('izin/report_pendaftaran');
	}
	
	public function data_report(){
		$grid = new GridConnector($this->db->conn_id);
		$qr = "";
	
		if($_GET['awal']!=""):
			$qr = " where created >= '".$_GET['awal']."'";	
		endif;
		
		if($_GET['akhir']!=""):
			$qr .= " and created <= '".$_GET['akhir']."'";	
		endif;
		
		if($_GET['opt']!="register"){
			$grid->render_sql("select id, npwpd_pemilik, jns_identitas, kewarganegaraan, no_identitas, nama_pemilik, alamat_pemilik, jalan, rt, rw, email, desa_kel2, kecamatan, kabupaten, tempat_lahir, DATE_FORMAT(tanggal_lahir,'%d/%m/%Y') as tanggal_lahir, jenis_kelamin, lokasi, hp from identitas_pemilik $qr","id","id,npwpd_pemilik,jns_identitas,kewarganegaraan,no_identitas,nama_pemilik,alamat_pemilik,jalan,rt,rw,email,desa_kel2,kecamatan,kabupaten,tempat_lahir,tanggal_lahir,jenis_kelamin,lokasi,hp");
		} else {
			$grid->render_sql("select id, no_daftar, jns_identitas, kewarganegaraan, no_identitas, nama, alamat, jalan, rt, rw, email, desa_kel2, kecamatan, kabupaten, tempat_lahir, DATE_FORMAT(tanggal_lahir,'%d/%m/%Y') as tanggal_lahir, jenis_kelamin, lokasi, hp from register $qr","id","id,no_daftar,jns_identitas,kewarganegaraan,no_identitas,nama,alamat,jalan,rt,rw,email,desa_kel2,kecamatan,kabupaten,tempat_lahir,tanggal_lahir,jenis_kelamin,lokasi,hp");
		}
	}
	
	public function test(){
		$this->load->view('gridexcel');
	}
	
	public function pengukuhan(){
		$data['usaha']=$this->db->query("select id_usaha, nm_usaha from jenis_usaha order by id_usaha asc");
		$data['pajak'] = $this->model_user->ukuh();
		$this->load->view('izin/pengukuhan',$data);
	}
	
	public function data_pengukuhan() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,no_ukuh,npwpd,nama,alamat,jenis_usaha,kewajiban from pengukuhan","id","id, no_ukuh, npwpd, nama, alamat, jenis_usaha, kewajiban");	
	}
	
	public function simpan_ukuh(){
		$data = array (
			'npwpd' 		  => $this->input->post('npwpd'),
			'nama' 		  => $this->input->post('nama'),
			'alamat'		=> $this->input->post('alamat'),
			'jenis_usaha'		=> $this->input->post('jenis_usaha'),
			'kewajiban'		=> $this->input->post('pajak'),
			'author' 		=> strtoupper($this->session->userdata('username'))
		);
		if($this->input->post('id')==0){
			$no_ukuh = $this->generateNo();
			$dataIns = array_merge($data,array('no_ukuh' => $no_ukuh, 'created' => date('Y-m-d H:i:s')));
			$this->db->insert('pengukuhan',$dataIns);
			$result = $no_ukuh;
		} else {
			$dataUpd = array_merge($data,array('modified' => date('Y-m-d H:i:s')));
			$no_ukuh = $this->input->post('ukuh');
			$this->db->update('pengukuhan', $dataUpd, array('no_ukuh' => $no_ukuh, 'id' => $this->input->post('id')));
			$result = $no_ukuh;
		}
		echo $result;
	}
	
	function generateNo(){
		$sql = $this->db->query("select max(no_ukuh) as max from pengukuhan");
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
	
	function cetak_ukuh(){
		$arr = 'PENGUKUHAN';

		$data = $this->db->query("SELECT jenis_usaha.nm_usaha, pengukuhan.npwpd, pengukuhan.no_ukuh, pengukuhan.id, identitas_perusahaan.nama_perusahaan,
identitas_perusahaan.alamat_perusahaan, pengukuhan.kewajiban FROM identitas_perusahaan INNER JOIN pengukuhan ON pengukuhan.npwpd = identitas_perusahaan.npwpd_perusahaan INNER JOIN jenis_usaha ON pengukuhan.jenis_usaha = jenis_usaha.id_usaha where pengukuhan.npwpd ='".$_GET['npwpd']."'")->row();
		$npwpd       = $data->npwpd;
		$no_ukuh     = $data->no_ukuh;
		$nama 		= $data->nama_perusahaan;
		$jenis_usaha = $data->nm_usaha;
		$alamat 	  = $data->alamat_perusahaan;
		$kewajiban   = $data->kewajiban;
		$day = date('d');
		$mounth = $this->msistem->v_bln(date('m'));
		$year = date('Y');
		$full = $day." ".$mounth." ".$year;
		$kepala = "Syahrul, SE, M.Si";
		$nip = "19660103 198601 1 001";
		
		$potong = explode("|",$kewajiban);
		$count = count($potong);
		//echo $count;
		$isi = "";
		$no = 1;
		for($i=0;$i<$count-1;$i++){
			$sql2 = $this->db->query("select nama_sptpd from master_sptpd where kode_sptpd ='".$potong[$i]."'")->row();
			$pajak = $sql2->nama_sptpd;
				$isi .= $pajak;
			
			if($i != $count):
				$isi .= ", ";
			endif;
			$no++;
		}

		$query = $this->db->query("select isi from master_template where code_izin='".$arr."'");
		$rs = $query->row();	
		$html = $rs->isi;
		
		$searchArray = array("[nomor]","[npwpd]","[nama_perusahaan]","[alamat]","[jenis_usaha]","[kewajiban]","[tanggal]","[kepala]","[nip]");
		$replaceArray = array($no_ukuh,$npwpd,$nama,$alamat,$jenis_usaha,$isi,$full,$kepala,$nip);
		$intoString = $html;
		//now let's replace
		$report = str_replace($searchArray, $replaceArray, $intoString);
		
		//setting pdf
		$this->load->library('header/header_ukuh');
		$pdf = new header_ukuh('P', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SIMTAP');
		$pdf->SetKeywords('SIMTAP');
	
		//set no header & footer
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(20);
		$pdf->SetMargins(20,110,20);
		// set font yang digunakan
		$pdf->SetFont('times', '', 12);
	
		$pdf->AddPage('P','LETTER',false);
		//set data
		$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->lastPage();
		$pdf->Output('Report_'.$arr.'.pdf', 'I');
	}
}
?>