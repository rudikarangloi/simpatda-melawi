<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class izin extends MY_Controller {
	
	public function registrasi() { 
		$this->load->view('izin/registrasi');
	}
	
	public function data_registrasi() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("SELECT a.id, a.no_daftar, a.nama_perusahaan, a.alamat_perusahaan, b.nama_kelurahan, b.nama_kecamatan, a.kabupaten, a.telp, a.npwpd_pemilik, a.nama_pemilik, a.alamat_pemilik, c.nama_kelurahan AS nm_kel, c.nama_kecamatan AS nm_kec, a.kabupaten_pemilik, a.telp_pemilik, e.nama_sptpd AS jenis_usaha, IF(a.jenis_pajak='1','Pajak Daerah','Retribusi Daerah') AS jenis_pajak,a.perkiraan_omset, 
DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') AS tgl_daftar, DATE_FORMAT(a.created,'%d/%m/%Y') AS tgl_created, a.status_laporan FROM register a 
LEFT JOIN view_kelurahan b ON a.kelurahan=b.kode_kelurahan 
LEFT JOIN view_kelurahan c ON a.kelurahan_pemilik=c.kode_kelurahan 
LEFT JOIN master_sptpd e ON a.jenis_usaha=e.id 
WHERE a.status_laporan='PENDING'
","id","tgl_created,id, no_daftar, nama_perusahaan, alamat_perusahaan, nama_kelurahan, nama_kecamatan, kabupaten, telp, npwpd_pemilik, nama_pemilik, alamat_pemilik, nm_kel, nm_kec, kabupaten_pemilik, telp_pemilik, jenis_usaha, jenis_pajak, perkiraan_omset, status_laporan");
	}
	
	public function load_registrasi($op="",$nilai="") {
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($op=='1'){
			$sqr = "and a.no_daftar like '%".$nilai."%'";
		} else if($op=='2'){
			$sqr = "and a.nama_perusahaan like '%".$nilai."%'";
		} else if($op=='3'){
			$sqr = "and a.npwpd_pemilik like '%".$nilai."%'";
		} else if($op=='4'){
			$sqr = "and a.nama_pemilik like '%".$nilai."%'";
		} else if($op=='5'){
			$sqr = "and a.jenis_usaha like '%".$nilai."%'";
		} else if($op=='6'){
			$sqr = "and a.jenis_pajak like '%".$nilai."%'";
		}
		$qr = $this->db->query("SELECT a.id, a.no_daftar, a.nama_perusahaan, a.alamat_perusahaan, a.jalan,
a.rt, a.rw, a.email,
a.kelurahan, c.nama_kelurahan, a.kecamatan, c.nama_kecamatan, a.kabupaten, a.telp, a.kodepos, a.npwpd_pemilik, 
a.nama_pemilik, a.alamat_pemilik, a.jalan_pemilik, 
a.rt_pemilik,a.rw_pemilik,a.email_pemilik,a.telp_pemilik,a.lokasi_pemilik,
a.kelurahan_pemilik, c.nama_kelurahan,
a.kecamatan_pemilik, c.nama_kecamatan, a.kabupaten_pemilik, a.telp_pemilik, a.kodepos_pemilik, a.jenis_usaha, a.status_usaha, a.kategori, a.jml_karyawan, a.ukuran_tempat, 
a.surat_izin, a.no_surat, a.tgl_surat, a.jenis_pajak, a.perkiraan_omset,  
DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') AS tgl_daftar FROM register a 
LEFT JOIN view_kelurahan b ON a.kelurahan=b.kode_kelurahan 
LEFT JOIN view_kelurahan c ON a.kelurahan_pemilik=c.kode_kelurahan 
LEFT JOIN master_sptpd e ON a.jenis_usaha=e.id 
WHERE a.status_laporan='PENDING'
$sqr GROUP BY a.id");
		
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
					echo("<cell><![CDATA[".$rs->nama_kelurahan."]]></cell>");
					echo("<cell><![CDATA[".$rs->kecamatan."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_kecamatan."]]></cell>");
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
					echo("<cell><![CDATA[".$rs->telp_pemilik."]]></cell>");
                    echo("<cell><![CDATA[".$rs->lokasi_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->kelurahan_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_kelurahan."]]></cell>");					
                    echo("<cell><![CDATA[".$rs->kecamatan_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_kecamatan."]]></cell>");
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
					echo("<cell><![CDATA[".$rs->perkiraan_omset."]]></cell>");
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
		$data['kelurahan']=$this->db->query("select id, kode_kelurahan, nama_kelurahan from view_kelurahan");        
		$data['nm_modul'] = $s->nm_modul;
		$this->load->view('izin/pemilik',$data);
	}
	
    public function ckec2(){
        $id = $this->input->post('kecamatan');
		$e = $this->db->query("select kode_kecamatan, nama_kecamatan from view_kelurahan where kode_kecamatan='".$id."'")->row();
		$result = $e->kode_kecamatan.'|'.$e->nama_kecamatan;
		echo $result;
    }
    
	public function ckel2() {
		$id = $this->input->post('kelurahan');
		$e = $this->db->query("select id,kode_kelurahan,kode_kecamatan, nama_kecamatan from view_kelurahan where kode_kelurahan='".$id."'")->row();
		$result = $e->kode_kecamatan.'|'.$e->nama_kecamatan.'|'.$e->kode_kelurahan.'|'.$e->id;
		echo $result;
	}
	
	public function ckel() {
		$id = $this->input->post('kelurahan');
		$e = $this->db->query("select nama_kecamatan from view_kelurahan where kode_kelurahan='".$id."'")->row();
		$result = $e->nama_kecamatan;
		echo $result;
	}
	
	public function ckec() {
		$id = $this->input->post('kelurahan');
		$e = $this->db->query("select id,kode_kelurahan, kode_kecamatan, nama_kecamatan from view_kelurahan where id='".$id."'")->row();
		$result = $e->kode_kecamatan.'|'.$e->nama_kecamatan.'|'.$e->kode_kelurahan.'|'.$e->id;
		
		echo $result;
	}
	
	public function ckec_2() {
		$id = $this->input->post('kelurahan');
		$i = explode("-",$id);
		$id1 = $i[0];
		$id2 = $i[1];
		$e = $this->db->query("select kode_kelurahan, kode_kecamatan, nama_kecamatan from view_kelurahan where kode_kecamatan='".$id1."' and kode_kelurahan='".$id2."'")->row();
		$result = $e->kode_kecamatan.'|'.$e->nama_kecamatan.'|'.$e->kode_kelurahan;
		
		echo $result;
	}
	
	public function crek_pajak() {
		$id = $this->input->post('crek_pajak_rin');
		$e = $this->db->query("SELECT * FROM master_sptpd WHERE kode_pajak='".$id."'")->row();
		$result = $e->kode_pajak.'|'.$e->nama_sptpd;
		
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
		$qr = $this->db->query("SELECT a.id,a.npwpd_pemilik,a.jns_identitas,a.kewarganegaraan,a.no_identitas,a.nama_pemilik,a.alamat_pemilik,a.jalan,a.rt,a.rw,a.email,a.desa_kel2,
a.kecamatan,a.kabupaten,a.tempat_lahir,DATE_FORMAT(a.tanggal_lahir,'%d/%m/%Y') AS tanggal_lahir,a.jenis_kelamin,a.lokasi,a.hp,b.nama_kecamatan 
FROM identitas_pemilik a
LEFT JOIN view_kelurahan b ON a.desa_kel2=b.kode_kelurahan AND a.kecamatan=b.kode_kecamatan 
WHERE STATUS='0' AND a.npwpd_pemilik LIKE '%P%' $sqr");
		
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
					echo("<cell><![CDATA[".$rs->nama_kecamatan."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function search_pemilik($op="",$nilai="") {
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($op=='1'){
			$sqr = "where a.npwpd_pemilik like '%".$nilai."%'";
		} else if($op=='2'){
			$sqr = "where a.nama_pemilik like '%".$nilai."%'";
		} else if($op=='3'){
			$sqr = "where a.alamat_pemilik like '%".$nilai."%'";
		} else if($op=='4'){
			$sqr = "where a.no_identitas like '%".$nilai."%'";
		} else if($op=='5'){
			$sqr = "where a.email like '%".$nilai."%'";
		} else if($op=='6'){
			$sqr = "where a.kewarganegaraan like '%".$nilai."%'";
		}
		$qr = $this->db->query("SELECT a.id,a.npwpd_pemilik,a.jns_identitas,a.kewarganegaraan,a.no_identitas,a.nama_pemilik,a.alamat_pemilik,a.jalan,a.rt,a.rw,a.email,a.desa_kel2,a.kecamatan,a.kabupaten,
a.tempat_lahir,DATE_FORMAT(a.tanggal_lahir,'%d/%m/%Y') AS tanggal_lahir,a.jenis_kelamin,a.lokasi,a.hp,b.id AS idc FROM identitas_pemilik a
LEFT JOIN view_kelurahan b ON b.kode_kecamatan = a.kecamatan AND b.kode_kelurahan = a.desa_kel2  $sqr");
		
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
					echo("<cell><![CDATA[".$rs->idc."]]></cell>");
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function data_pemilik() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("SELECT a.id,a.npwpd_pemilik,a.jns_identitas,a.kewarganegaraan,a.no_identitas,a.nama_pemilik,a.alamat_pemilik,a.jalan,a.rt,a.rw,a.email,a.desa_kel2,a.kecamatan,a.kabupaten,
a.tempat_lahir,DATE_FORMAT(a.tanggal_lahir,'%d/%m/%Y') AS tanggal_lahir,a.jenis_kelamin,a.lokasi,a.hp,b.id as idc FROM identitas_pemilik a
LEFT JOIN view_kelurahan b ON b.kode_kecamatan = a.kecamatan AND b.kode_kelurahan = a.desa_kel2 WHERE a.npwpd_pemilik LIKE '%P2%'","id","id,npwpd_pemilik,jns_identitas,kewarganegaraan,no_identitas,nama_pemilik,alamat_pemilik,rt,rw,email,desa_kel2,kecamatan,kabupaten,tempat_lahir,tanggal_lahir,jenis_kelamin,lokasi,hp,idc");	
	}
	
	public function simpan_pemilik() {
		$npwpd = $this->input->post('npwpd');
		if($npwpd==NULL){
			//max npwpd
			//$q = $this->db->query("select max(npwpd_pemilik) as nos from identitas_pemilik")->row();
			$q = $this->db->query("select max as nos from no_max_npwpd where id ='3'")->row();
			$nos = $q->nos;
			
			$lokasi = $this->input->post('lokasi');
			if($lokasi==1){
				//kode kelurahan
				$idkel = $this->input->post('kelurahan_id');
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
					$npwpd = "P2.1.00001.".$ckec.".".$ckel;
				} else {
					$cek = explode(".",$nos);
					//$no = $cek[2] + 1;
					$no = $nos + 1;
					
					if(strlen($no)==1) {
						$no_urut = '0000'.$no;	
					} else if(strlen($no)==2) {
						$no_urut = '000'.$no;
					} else if(strlen($no)==3) {
						$no_urut = '00'.$no;	
					} else if(strlen($no)==4) {
						$no_urut = '0'.$no;
					} 
					$npwpd = "P2.1.".$no_urut.".".$ckec.".".$ckel;		
				}
			} else {
				if($nos==NULL) {
					$npwpd = "P2.1.00001.00.00";
				} else {
					$cek = explode(".",$nos);
					//$no = $cek[2] + 1;
					$no = $nos + 1;
					if(strlen($no)==1) {
						$no_urut = '0000'.$no;	
					} else if(strlen($no)==2) {
						$no_urut = '000'.$no;
					} else if(strlen($no)==3) {
						$no_urut = '00'.$no;	
					} else if(strlen($no)==4) {
						$no_urut = '0'.$no;
					} 
					$npwpd = "P2.1.".$no_urut.".00.00";		
				}
			}
			$maxUpd = array (
				'max' => $no
			);
			$this->db->update('no_max_npwpd', $maxUpd, array('kd_jns' => 3));
		} else {
			$npwpd_array = explode(".", $npwpd);
			$lokasi = $this->input->post('lokasi');
			if($lokasi==1){
				//kode kelurahan
				$idkel = $this->input->post('kelurahan_id');
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
				$npwpd = $npwpd_array[0].".".$npwpd_array[1].".".$npwpd_array[2].".".$ckec.".".$ckel;
			} else {
				$npwpd = $npwpd_array[0].".".$npwpd_array[1].".".$npwpd_array[2].".00.00";
			}
			
		}
		
		$data = array (
			'npwpd_pemilik'	=> strtoupper($npwpd),
			'jns_identitas' => strtoupper($this->input->post('jns')),
			'kewarganegaraan' => strtoupper($this->input->post('negara')),
			'no_identitas' 	  => strtoupper($this->input->post('identitas')),
			'nama_pemilik' 	  => $this->input->post('nama'),
			'alamat_pemilik'  => strtoupper($this->input->post('alamat')),
			'jalan' 		=> strtoupper($this->input->post('alamat')),
			'rt' 			=> strtoupper($this->input->post('rt')),
			'rw' 			=> strtoupper($this->input->post('rw')),
			'lokasi' 		=> $this->input->post('lokasi'),
			'hp' 		    => $this->input->post('hp'),
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
			$npwpd_lama = $this->db->query("select npwpd_pemilik from identitas_pemilik where id='".$this->input->post('id')."'")->row();
			$npwpd_lama = $npwpd_lama->npwpd_pemilik;
			
			$dataUpd = array_merge($data,array('modified' => date('Y-m-d H:i:s')));
			$result = $this->db->update('identitas_pemilik', $dataUpd, array('id' => $this->input->post('id')));
			$result = $this->db->update('identitas_perusahaan', array('npwpd_pemilik' => $npwpd), array('npwpd_pemilik' => $npwpd_lama));
			
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
		$data['kelurahan']=$this->db->query("select * from view_kelurahan");
		$data['status'] = $this->db->query("select * from status order by id_status asc");
		$data['sptpd'] = $this->db->query("select id, nama_sptpd from master_sptpd order by id asc");
		//$data['reke'] = $this->db->query("select auto, kode, nm_rekening from master_rinci order by id asc");
        $data['reke'] = $this->db->query("SELECT pajak, kd_rek, nm_rek FROM master_rekening WHERE SUBSTR(kd_rek,1,6) = '4.1.1.' AND jns_pajak = '0' AND pajak !='null' ORDER BY pajak ASC");
        $data['jenis_pajak']=$this->db->query("select id, nama_pajak from jenis_pajak");
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
	
	
	public function load_perusahaan_rek($pil) {
		
		switch($pil) {       
			case '00';
				$cu = "WHERE LEFT(a.npwpd_perusahaan,2) ='00'";
			break;
			case '01';
				$cu = "WHERE LEFT(a.npwpd_perusahaan,2) ='01'";
			break;
			case '02';
				$cu = "WHERE LEFT(a.npwpd_perusahaan,2) ='02'";
			break;
			case '03';
				$cu = "WHERE LEFT(a.npwpd_perusahaan,2) ='03'";
			break;
			case '04';
				$cu = "WHERE LEFT(a.npwpd_perusahaan,2) ='04'";
			break;
			case '05';
				$cu = "WHERE LEFT(a.npwpd_perusahaan,2) ='05'";
			break;
			case '06';
				$cu = "WHERE LEFT(a.npwpd_perusahaan,2) ='06'";
			break;
			case '07';
				$cu = "WHERE LEFT(a.npwpd_perusahaan,2) ='07'";
			break;
			case '08';
				$cu = "WHERE LEFT(a.npwpd_perusahaan,2) ='08'";
			break;
			case '09';
				$cu = "WHERE LEFT(a.npwpd_perusahaan,2) ='09'";
			break;
			case '10';
				$cu = "WHERE LEFT(a.npwpd_perusahaan,2) ='10'";
			break;
			case '11';
				$cu = "WHERE LEFT(a.npwpd_perusahaan,2) ='11'";
			break;
			default;
				$cu = "";
			break;
		}
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		
		$qr = $this->db->query("SELECT a.id,a.npwpd_perusahaan, a.npwpd_lama, a.nama_perusahaan, a.alamat_perusahaan, a.rt, a.rw, a.email, a.kelurahan, c.nama_kelurahan, 
					a.kecamatan, c.nama_kecamatan, a.kabupaten, a.telp, a.kodepos, b.npwpd_pemilik, b.nama_pemilik, b.alamat_pemilik, b.jalan AS jalan_p,
					b.rt AS rt_p, b.rw AS rw_p, b.email AS email_p, b.lokasi, b.desa_kel2, b.kecamatan AS kecamatan_p, b.kabupaten AS kabupaten_p, b.hp,
					b.kodepos, a.jenis_usaha, a.status_usaha, a.kategori, a.jml_karyawan, a.ukuran_tempat, a.surat_izin, a.no_surat, 
					DATE_FORMAT(a.tgl_surat,'%d/%m/%Y') AS tgl_surat, a.jenis_pajak, a.gol_pajak, DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') AS tgl_daftar,
					IFNULL(c.id,'00') AS idx, e.auto AS idauto
					FROM identitas_perusahaan a 
					LEFT JOIN identitas_pemilik b ON a.npwpd_pemilik = b.npwpd_pemilik 
					LEFT JOIN view_kelurahan c ON c.kode_kelurahan = SUBSTRING(a.npwpd_perusahaan,15,2) AND SUBSTRING(a.npwpd_perusahaan,12,2)=c.kode_kecamatan 
					LEFT JOIN master_rinci e ON e.id = LEFT(a.npwpd_perusahaan,1) AND SUBSTRING(a.npwpd_perusahaan,9,2) = e.kode_rek 
					$cu GROUP BY a.id");
		
		$i=1;
		foreach($qr->result() as $rs) {
			// cair
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$rs->id."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_lama."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->rt."]]></cell>");
					echo("<cell><![CDATA[".$rs->rw."]]></cell>");
					echo("<cell><![CDATA[".$rs->email."]]></cell>");
					echo("<cell><![CDATA[".$rs->kelurahan."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_kelurahan."]]></cell>");
					echo("<cell><![CDATA[".$rs->kecamatan."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_kecamatan."]]></cell>");
					echo("<cell><![CDATA[".$rs->kabupaten."]]></cell>");
					echo("<cell><![CDATA[".$rs->telp."]]></cell>");
					echo("<cell><![CDATA[".$rs->kodepos."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->jalan_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->rt_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->rw_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->email_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->lokasi."]]></cell>");
					echo("<cell><![CDATA[".$rs->desa_kel2."]]></cell>");
					echo("<cell><![CDATA[".$rs->kecamatan_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->kabupaten_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->hp."]]></cell>");
					echo("<cell><![CDATA[".$rs->kodepos."]]></cell>");
					echo("<cell><![CDATA[".$rs->jenis_usaha."]]></cell>");
					echo("<cell><![CDATA[".$rs->status_usaha."]]></cell>");
					echo("<cell><![CDATA[".$rs->kategori."]]></cell>");
					echo("<cell><![CDATA[".$rs->jml_karyawan."]]></cell>");
					echo("<cell><![CDATA[".$rs->ukuran_tempat."]]></cell>");
					echo("<cell><![CDATA[".$rs->surat_izin."]]></cell>");
					echo("<cell><![CDATA[".$rs->no_surat."]]></cell>");
					echo("<cell><![CDATA[".$rs->tgl_surat."]]></cell>");
					echo("<cell><![CDATA[".$rs->jenis_pajak."]]></cell>");
					echo("<cell><![CDATA[".$rs->gol_pajak."]]></cell>");
					echo("<cell><![CDATA[".$rs->tgl_daftar."]]></cell>");
					echo("<cell><![CDATA[".$rs->idx."]]></cell>");
					echo("<cell><![CDATA[".$rs->idauto."]]></cell>");					
                                       
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function load_perusahaan($op="",$nilai="") {
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		if($op==1){
			$cu = "WHERE a.npwpd_perusahaan like '%".$nilai."%'";
		} else if($op==2){
			$cu = "WHERE a.nama_perusahaan like '%".$nilai."%'";
		} else if($op==3){
			$cu = "WHERE b.nama_pemilik like '%".$nilai."%'";
		}
		
		$qr = $this->db->query("SELECT a.id,a.npwpd_perusahaan, a.npwpd_lama, a.nama_perusahaan, a.alamat_perusahaan, a.rt, a.rw, a.email, a.kelurahan, c.nama_kelurahan, 
a.kecamatan, c.nama_kecamatan, a.kabupaten, a.telp, a.kodepos, b.npwpd_pemilik, b.nama_pemilik, b.alamat_pemilik, b.jalan AS jalan_p,
 b.rt AS rt_p, b.rw AS rw_p, b.email AS email_p, b.lokasi, b.desa_kel2, b.kecamatan AS kecamatan_p, b.kabupaten AS kabupaten_p, b.hp,
  b.kodepos, a.jenis_usaha, a.status_usaha, a.kategori, a.jml_karyawan, a.ukuran_tempat, a.surat_izin, a.no_surat, 
  DATE_FORMAT(a.tgl_surat,'%d/%m/%Y') AS tgl_surat, a.jenis_pajak, a.gol_pajak, DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') AS tgl_daftar,
  IFNULL(c.id,'00') AS idx, e.auto AS idauto
  FROM identitas_perusahaan a 
  LEFT JOIN identitas_pemilik b ON a.npwpd_pemilik = b.npwpd_pemilik 
  LEFT JOIN view_kelurahan c ON c.kode_kelurahan = SUBSTRING(a.npwpd_perusahaan,15,2) AND SUBSTRING(a.npwpd_perusahaan,12,2)=c.kode_kecamatan 
  LEFT JOIN master_rinci e ON e.id = LEFT(a.npwpd_perusahaan,1) AND SUBSTRING(a.npwpd_perusahaan,9,2) = e.kode_rek 
  $cu GROUP BY a.id");
		
		$i=1;
		foreach($qr->result() as $rs) {
			// cair
			echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$rs->id."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_lama."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_perusahaan."]]></cell>");
					echo("<cell><![CDATA[".$rs->rt."]]></cell>");
					echo("<cell><![CDATA[".$rs->rw."]]></cell>");
					echo("<cell><![CDATA[".$rs->email."]]></cell>");
					echo("<cell><![CDATA[".$rs->kelurahan."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_kelurahan."]]></cell>");
					echo("<cell><![CDATA[".$rs->kecamatan."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_kecamatan."]]></cell>");
					echo("<cell><![CDATA[".$rs->kabupaten."]]></cell>");
					echo("<cell><![CDATA[".$rs->telp."]]></cell>");
					echo("<cell><![CDATA[".$rs->kodepos."]]></cell>");
					echo("<cell><![CDATA[".$rs->npwpd_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->alamat_pemilik."]]></cell>");
					echo("<cell><![CDATA[".$rs->jalan_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->rt_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->rw_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->email_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->lokasi."]]></cell>");
					echo("<cell><![CDATA[".$rs->desa_kel2."]]></cell>");
					echo("<cell><![CDATA[".$rs->kecamatan_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->kabupaten_p."]]></cell>");
					echo("<cell><![CDATA[".$rs->hp."]]></cell>");
					echo("<cell><![CDATA[".$rs->kodepos."]]></cell>");
					echo("<cell><![CDATA[".$rs->jenis_usaha."]]></cell>");
					echo("<cell><![CDATA[".$rs->status_usaha."]]></cell>");
					echo("<cell><![CDATA[".$rs->kategori."]]></cell>");
					echo("<cell><![CDATA[".$rs->jml_karyawan."]]></cell>");
					echo("<cell><![CDATA[".$rs->ukuran_tempat."]]></cell>");
					echo("<cell><![CDATA[".$rs->surat_izin."]]></cell>");
					echo("<cell><![CDATA[".$rs->no_surat."]]></cell>");
					echo("<cell><![CDATA[".$rs->tgl_surat."]]></cell>");
					echo("<cell><![CDATA[".$rs->jenis_pajak."]]></cell>");
					echo("<cell><![CDATA[".$rs->gol_pajak."]]></cell>");
					echo("<cell><![CDATA[".$rs->tgl_daftar."]]></cell>");
					echo("<cell><![CDATA[".$rs->idx."]]></cell>");
					echo("<cell><![CDATA[".$rs->idauto."]]></cell>");					
                                       
			echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	public function data_perusahaan() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("
SELECT a.id,a.npwpd_perusahaan, a.npwpd_lama, a.nama_perusahaan, a.alamat_perusahaan, a.rt, a.rw, a.email, a.kelurahan, c.nama_kelurahan, 
a.kecamatan, c.nama_kecamatan, a.kabupaten, a.telp, a.kodepos, b.npwpd_pemilik, b.nama_pemilik, b.alamat_pemilik, b.jalan AS jalan_p,
 b.rt AS rt_p, b.rw AS rw_p, b.email AS email_p, b.lokasi, b.desa_kel2, b.kecamatan AS kecamatan_p, b.kabupaten AS kabupaten_p, b.hp,
  b.kodepos, a.jenis_usaha, a.status_usaha, a.kategori, a.jml_karyawan, a.ukuran_tempat, a.surat_izin, a.no_surat, 
  DATE_FORMAT(a.tgl_surat,'%d/%m/%Y') AS tgl_surat, a.jenis_pajak, a.gol_pajak, DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') AS tgl_daftar,
  IFNULL(c.id,'00') AS idx, e.auto AS idauto
  FROM identitas_perusahaan a 
  LEFT JOIN identitas_pemilik b ON a.npwpd_pemilik = b.npwpd_pemilik 
  LEFT JOIN view_kelurahan c ON c.kode_kelurahan = SUBSTRING(a.npwpd_perusahaan,15,2) AND SUBSTRING(a.npwpd_perusahaan,12,2)=c.kode_kecamatan 
  LEFT JOIN master_rinci e ON e.id = LEFT(a.npwpd_perusahaan,1) AND SUBSTRING(a.npwpd_perusahaan,9,2) = e.kode_rek 
  WHERE LEFT(a.npwpd_perusahaan,2)!= '61' GROUP BY a.id ORDER BY npwpd_perusahaan ASC
  ","id","id, npwpd_perusahaan, npwpd_lama, nama_perusahaan, alamat_perusahaan, rt, rw, email, kelurahan, nama_kelurahan, 
		kecamatan, nama_kecamatan, kabupaten, telp, kodepos, npwpd_pemilik, nama_pemilik, alamat_pemilik, jalan_p, rt_p, rw_p, email_p, lokasi, desa_kel2, kecamatan_p, 
		kabupaten_p, hp, kodepos, jenis_usaha, status_usaha, kategori, jml_karyawan, ukuran_tempat, surat_izin, no_surat, tgl_surat, jenis_pajak, gol_pajak, tgl_daftar,idx,idauto");	
	}
	
	public function simpan_perusahaan() {
		/*$upd = array(
			'status' => 1
		);
		$this->db->update('identitas_pemilik', $upd, array('npwpd_pemilik' => $this->input->post('id_pemilik')));
		*/
		$id_perusahaan = $this->input->post('id_perusahaan');
                $insidentil = $this->input->post('jenis_spt');
		if($id_perusahaan==NULL){
			//kode kelurahan
			$idkel = $this->input->post('kelurahan');
			$skel = $this->db->query("select kode_kelurahan,kode_kecamatan from view_kelurahan where id='".$idkel."'")->row();
			$kdkel = $skel->kode_kelurahan;
			/*if(strlen($kdkel)==1){
				$ckel = '0'.$kdkel;
			} else if(strlen($kdkel)==2){
			*/	
			$ckel = $kdkel;
			//}
			
			//kode kecamatan
			$kdkec = $skel->kode_kecamatan;
			if(strlen($kdkec)==1){
				$ckec = '0'.$kdkec;
			} else if(strlen($kdkec)==2){
				$ckec = $kdkec;
			} else if(strlen($kdkec)==3){
				$ckec = $kdkec;
			}
			
			//kode npwpd
			$pajak = $this->input->post('jenis_pajak');
			$gol_wp = $this->input->post('gol_pajak'); 
            $Gol = $this->input->post('sptpd');
			//$Gol = 'P2';
			//$reke = $this->input->post('sptpd1');
			//$q = $this->db->query("select max as nos from master_sptpd where id = '".$pajak."'")->row();
            //$q = $this->db->query("select max as nos from no_max_npwpd where kd_jns = '".$pajak."'")->row();
			if($gol_wp =='1'){
			$q = $this->db->query("select max as nos from no_max_npwpd where id ='1'")->row();
			}else{
			$q = $this->db->query("select max as nos from no_max_npwpd where id ='2'")->row();	
			}
			
			$nos = $q->nos;
                                                
			if($nos==0) {
				$nos = '1';
				$no_urut = "0000001";
			} else {
				$nos = $nos + 1;
				if(strlen($nos)==1) {
					$no_urut = '000000'.$nos;	
				} else if(strlen($nos)==2) {
					$no_urut = '00000'.$nos;
				} else if(strlen($nos)==3) {
					$no_urut = '0000'.$nos;	
				} else if(strlen($nos)==4) {
					$no_urut = '000'.$nos;
				} else if(strlen($nos)==5) {
					$no_urut = '00'.$nos;
				}else if(strlen($nos)==6) {
					$no_urut = '0'.$nos;
				}else if(strlen($nos)==7) {
					$no_urut = ''.$nos;
				}		
			}
			
			//bowo
			/* $r = $this->db->query("select max as nor, kode_rek from master_rinci where auto = '".$reke."'")->row();
			$nor = $r->nor;
			$nkode = $r->kode_rek;
			//bowo
                        
                        if($nor==NULL) {
				$nor = '1';
				$no_urut_rek = "0001";
			} else {
				$nor = $nor + 1;
				if(strlen($nor)==1) {
					$no_urut_rek = '000'.$nor;	
				} else if(strlen($nor)==2) {
					$no_urut_rek = '00'.$nor;
				} else if(strlen($nor)==3) {
					$no_urut_rek = '0'.$nor;	
				} else if(strlen($nor)==4) {
					$no_urut_rek = ''.$nor;	
				}
				
			} */
			  $id_perusahaan = $Gol.".".$no_urut.".".$ckec.".".$ckel; //fadil
			//$id_perusahaan = $Gol.".".$no_urut.".".$nkode.".".$no_urut_rek.".".$ckec.".".$ckel;
			//$id_perusahaan = $pajak.".".$Gol.".".$no_urut.".".$ckec.".".$ckel;
			$maxUpd = array (
				'max' => $nos
			);
			$this->db->update('no_max_npwpd', $maxUpd, array('kd_jns' => $gol_wp));	

			//bowo
			/* $maxUpd1 = array (
				'max' => $nor
			);
			$this->db->update('master_rinci', $maxUpd1, array('auto' => $reke));	 */
			//$this->db->update('master_sptpd', $maxUpd, array('id' => $pajak));
		}else{
			$npwpd_array = explode(".",$id_perusahaan);
			$idkel = $this->input->post('kelurahan');
			$skel = $this->db->query("select kode_kelurahan,kode_kecamatan from view_kelurahan where id='".$idkel."'")->row();
			$kdkel = $skel->kode_kelurahan;
			/*if(strlen($kdkel)==1){
				$ckel = '0'.$kdkel;
			} else if(strlen($kdkel)==2){
			*/	$ckel = $kdkel;
			//}
			
			//kode kecamatan
			$kdkec = $skel->kode_kecamatan;
			if(strlen($kdkec)==1){
				$ckec = '0'.$kdkec;
			} else if(strlen($kdkec)==2){
				$ckec = $kdkec;
			} else if(strlen($kdkec)==3){
				$ckec = $kdkec;
			}
                        
                                                
		}				
		
		$data = array (
			'npwpd_perusahaan' => $id_perusahaan,
			'npwpd_lama' => strtoupper($this->input->post('id_perusahaan_lama')),
			'nama_perusahaan' => $this->input->post('nama_perusahaan'),
			'alamat_perusahaan' => $this->input->post('alamat_perusahaan'),
			'jalan' => strtoupper($this->input->post('alamat_perusahaan')),
			'rt' => strtoupper($this->input->post('rt')),
			'rw' => strtoupper($this->input->post('rw')),
			'email' => strtoupper($this->input->post('email')),
			'kelurahan' => $ckel,
			'kecamatan' => $ckec,
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
			//'jenis_usaha' => strtoupper($this->input->post('sptpd')),
			'status_usaha' => strtoupper($this->input->post('status')),
			'kategori' => "-",
			'jml_karyawan' => strtoupper($this->input->post('jml_karyawan')),
			'ukuran_tempat' => strtoupper($this->input->post('ukuran_tempat')),
			'surat_izin' => strtoupper($this->input->post('izin')),
			'no_surat' => strtoupper($this->input->post('nomor')),
			'tgl_surat' => strtoupper($this->input->post('tanggal')),
			'jenis_pajak' => strtoupper($this->input->post('jenis_pajak')),
            'gol_pajak' => strtoupper($this->input->post('gol_pajak')),
			//'jenis_pajak_detail' => strtoupper($this->input->post('jns')),
			'tgl_daftar' => strtoupper($this->input->post('tgl_daftar')),
			'terdaftar' => date('Y-m-d'),
            'insidentil' => $insidentil,
			'author' 		=> strtoupper($this->session->userdata('username')),
			'status_aktip' => "Y"
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
	
	public function cetak_peru(){		
		
		$data = $this->db->query("SELECT a.npwpd_perusahaan AS npwpd_perusahaan, d.nama_pemilik,SUBSTRING(a.npwpd_perusahaan,12,3) AS npwpd_id, a.nama_perusahaan AS nama_perusahaan, a.alamat_perusahaan AS alamat_perusahaan, DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') AS tgl, b.nama_jns, c.nama_sptpd FROM identitas_perusahaan a 
LEFT JOIN no_max_npwpd b ON a.jenis_pajak=b.kd_jns
LEFT JOIN master_sptpd c ON a.jenis_usaha=c.id
INNER JOIN identitas_pemilik d ON a.npwpd_pemilik=d.npwpd_pemilik where a.npwpd_perusahaan='".$_GET['npwpd']."'")->row();
        $no 				= $data->npwpd_perusahaan;
		$nama 		 		= $data->nama_perusahaan;
		$nama_pemilik		= $data->nama_pemilik;
		$jenis_usaha		= $data->nama_jns;
		$alamat 			= $data->alamat_perusahaan;
		$tgl 				= $data->tgl;
        $usaha              = strtoupper($data->nama_sptpd);
		$no_e 				= $data->npwpd_id;
		$pisah				= explode("/",$data->tgl);
		$dd1				= $pisah[0];
		$dd2				= $pisah[1];
		$dd3				= $pisah[2];
		$tgl2				= $dd1."-".$dd2."-".$dd3;
		$thn 				= date('Y');
		$pisah_npwpd		= explode(".",$data->npwpd_perusahaan);
		$npwpd1				= $pisah_npwpd[0];
		$npwpd2				= $pisah_npwpd[1];
		$npwpd3				= $pisah_npwpd[2];
		$npwpd4				= $pisah_npwpd[3];
		
					
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/header_output');
		$pdf = new header_output('L', 'pt', 'CR-80', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD');
		$pdf->SetKeywords('SOPD');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		//$pdf->SetHeaderMargin(10);
		//$pdf->SetMargins(10,10,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 10);
	
		$pdf->AddPage('L','CR-80',false);
		//set data
			
		$report = '';		
		$report .=
			'<body style="margin:0; !important">
			<table width="240" border="0" style="font-size:7px;">
<tr>
	<td><img src="http://192.168.1.31/sopd_melawi/images/NPWPD.jpeg" width="100%">
	</td>
</tr>
<tr>
	<td style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
    	<table width="100%" style="border-spacing: 0px;font-size: 10px;font-size: 5.5px;position: relative;top: -136px;" border="0">        
		<tr>            
			<td colspan="5" align="center">
				<table border="0" align="center">
					<tr>
						<td></td>
						<td></td>
					</tr>
					<tr style="border-botom: black; border style: solid;">
						<td></td>
						<td></td>
					</tr>
				</table>				
			</td>
		</tr>			
		<tr>            
            <td width="5%">&nbsp;</td>            
            <td width="15%"></td>            
            <td width="1%"></td>            
            <td width="20%"></td>            
            <td width="30%"></td>            
        </tr>
		<tr>
			<td>
			</td>
		</tr>
		<tr>            
            <td colspan="5" align="center"><u><b style="font-size: 7px;">KARTU PENGENAL NPWPD</b></u></td>            
        </tr>		
		<tr>            
            <td colspan="5" align="center">No. Reg. <b>973/'.$npwpd2.'/BAPENDA/'.$thn.'</b></td>            
        </tr>
		 <tr>
            <td></td>
            <td>NAMA</td>
            <td>:</td>
            <td colspan="2" style="font-size:7px;"><b>'.$nama_pemilik.'</b></td>
        </tr> 
		 <tr>
            <td></td>
            <td>MEREK USAHA</td>
            <td>:</td>
            <td colspan="2" style="font-size:7px;"><b>'.$nama.'</b></td>
        </tr> 
		<tr>
            <td></td>
            <td>ALAMAT</td>
            <td>:</td>
            <td colspan="2" style="font-size:7px;"><b>'.$alamat.'</b></td>
        </tr>
        <tr>
            <td></td>
            <td><a>NPWPD</a></td>
            <td>:</td>
            <td colspan="2" style="font-size:7px;"><b>'.$no.'</b></td>
        </tr>

        <tr>
            <td colspan="4">&nbsp;</td>
            <td style="font-size:5px;">Nanga Pinoh, '.$tgl2 .'<br>An. BUPATI MELAWI,<br>
			<b>Kepala Badan Pendapatan Daerah<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kabupaten Melawi</b></td>
        </tr>
      
		<tr>
			<td></td>
		</tr>
        <tr>
			<td></td>
		</tr>
        <tr>
			<td></td>
		</tr>
        <tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
        <tr>
            <td colspan="4">&nbsp;</td>
            <td style="font-size:5px;">&nbsp;&nbsp;<b><u>MARGITUS BEMBAN, SH., MM</u></b><br></td>
        </tr>
		<tr>
            <td colspan="4">&nbsp;</td>
            <td style="font-size:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pembina<br>&nbsp;&nbsp;&nbsp;&nbsp;NIP. 19740815 200212 1 010</td>
        </tr>
        </table>
	</td>
</tr>
</table>
</body>';
		echo $report;
		//$pdf->writeHTML($report, true, 0, true, 0);
		/* $pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_NHP'.'.pdf', 'I'); */
	
	}
	
	public function cetak_peru2(){		
		
		/* $data = $this->db->query("SELECT a.npwpd_perusahaan AS npwpd_perusahaan, substring(a.npwpd_perusahaan,12,3) AS npwpd_id, a.nama_perusahaan AS nama_perusahaan, a.alamat_perusahaan AS alamat_perusahaan, DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') AS tgl, b.nama_jns, c.nama_sptpd FROM identitas_perusahaan a 
LEFT JOIN no_max_npwpd b ON a.jenis_pajak=b.kd_jns
LEFT JOIN master_sptpd c ON a.jenis_usaha=c.id where a.npwpd_perusahaan='".$_GET['npwpd']."'")->row(); */
		$data = $this->db->query("SELECT a.id,a.npwpd_perusahaan, a.npwpd_lama, a.nama_perusahaan, a.alamat_perusahaan, a.rt, a.rw, a.email, a.kelurahan, c.nama_kelurahan, 
a.kecamatan, c.nama_kecamatan, a.kabupaten, a.telp, a.kodepos, b.npwpd_pemilik, b.nama_pemilik, b.alamat_pemilik, b.jalan AS jalan_p,
 b.rt AS rt_p, b.rw AS rw_p, b.email AS email_p, b.lokasi, b.desa_kel2, b.kecamatan AS kecamatan_p, b.kabupaten AS kabupaten_p, b.hp,
  b.kodepos AS kod_p, a.jenis_usaha, a.status_usaha, a.kategori, a.jml_karyawan, a.ukuran_tempat, a.surat_izin, a.no_surat, 
  DATE_FORMAT(a.tgl_surat,'%d/%m/%Y') AS tgl_surat, a.jenis_pajak, a.gol_pajak, DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') AS tgl_daftar,
  IFNULL(c.id,'00') AS idx, e.auto AS idauto
  FROM identitas_perusahaan a 
  LEFT JOIN identitas_pemilik b ON a.npwpd_pemilik = b.npwpd_pemilik 
  LEFT JOIN view_kelurahan c ON c.kode_kelurahan = RIGHT(a.npwpd_perusahaan,2) AND SUBSTRING(a.npwpd_perusahaan,16,2)=c.kode_kecamatan 
  LEFT JOIN master_rinci e ON e.id = LEFT(a.npwpd_perusahaan,1) AND SUBSTRING(a.npwpd_perusahaan,9,2) = e.kode_rek where a.npwpd_perusahaan='".$_GET['npwpd']."'
  GROUP BY a.id")->row();
		
		$npwpd = $data->npwpd_perusahaan;
		$npwpd_lama = $data->npwpd_lama;
		$namus = $data->nama_perusahaan;
		$alus = $data->alamat_perusahaan;
		$rt = $data->rt;
		$rw = $data->rw;
		$kel = $data->nama_kelurahan;
		$kec = $data->nama_kecamatan;
		$kot = $data->kabupaten;
		$telus = $data->telp;
		$kodpos = $data->kodepos;
		$nampel = $data->nama_pemilik;
		$alpel = $data->alamat_pemilik;
		$rt_p = $data->rt_p;
		$rw_p = $data->rw_p;
		$kel_p = $data->desa_kel2;
		$kec_p = $data->kecamatan_p;
		$kot_p = $data->kabupaten_p;
		$tel_p = $data->hp;
		$kode = $data->kod_p;
		$jenis = $data->jenis_usaha;
		$status = $data->status_usaha;
		$jml_kar = $data->jml_karyawan;
		$tgl_daftar = $data->tgl_daftar;
		$izin = $data->surat_izin;
		$no_surat = $data->no_surat;
		$tgl_su = $data->tgl_surat;
		$gol = $data->gol_pajak;
		
		if($gol=='1'){
			$gol = 'Perorangan';
		}else{
			$gol = 'Badan Usaha';
		}
		
		if($jenis=='1'){
			$nama = 'HOTEL';
		} else if($jenis=='2'){
			$nama = 'RESTORAN';
		} else if($jenis=='3'){
			$nama = 'HIBURAN';
		} else if($jenis=='4'){
			$nama = 'REKLAME';
		} else if($jenis=='6'){
			$nama = 'MINERAL BUKAN LOGAM DAN BATUAN';
		} else if($jenis=='8'){
			$nama = 'AIR TANAH';
		} else if($jenis=='7'){
			$nama = 'PARKIR';
		} else if($jenis=='5'){
			$nama = 'PENERANGAN JALAN';
		}
		
		if($status=='1'){
			$status = 'Kantor Pusat';
		} else if($status=='2'){
			$status = 'Kantor Cabang';
		} else if($status=='3'){
			$status = 'Kantor Perwakilan';
		} else if($status=='4'){
			$status = 'Kantor Pembantu';
		}else if($status=='5'){
			$status= 'Kantor Tunggal';
		}
					
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/header_output');
		$pdf = new header_output('P', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_JAMBI');
		$pdf->SetKeywords('SOPD_JAMBI');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(10);
		$pdf->SetMargins(35,16,25);
		//$pdf->SetMargins(LEFT,TOP,RIGHT)
		// set font yang digunakan
		$pdf->SetFont('times', '', 10);
	
		$pdf->AddPage('P','A4',false);
		//set data
			
		$report = '';
		$report .=
			'<table border="0">
				<tr>
					<td width="120" height="54" align="center" valign="middle">&nbsp;</td>
					<td width="255" align="center" style="font-family:times; font-size:11px; ">
						PEMERINTAH KOTA JAMBI<br />
						<font size="18" face="times">DINAS PENDAPATAN</font><br/>
						<font size="8">Jl. Jend. Basuki Rachmat Kota Baru Telepon(0741) 40284 Fax 40284 </font><br/>
						<font size="9">JAMBI</font>
					</td>
						
				</tr>
				<tr>
					<td width="523">
						<b><hr></hr></b>
					</td>
				</tr>
			</table>';

		
		$report .=
			'<table border="0">
				<tr>
				<td width="300">
				<table>
				
				<tr style="font-family:times; font-size:14px;">
					<td></td>
					<td width="200">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FORMULIR DATA PAJAK</td>
					
				</tr>
				<tr>
				<td></td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="140" >&nbsp;&nbsp;   <b><i>IDENTITAS USAHA</i></b></td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-size:9;">
					<td width="140" >&nbsp;&nbsp;   NPWPD USAHA</td>
					<td width="10" align="center">:</td>
					<td width="250">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9px;">
					<td width="140">&nbsp;&nbsp;   NPWPD USAHA LAMA</td>
					<td width="10" align="center">:</td>
					<td width="290">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="140">&nbsp;&nbsp;   NAMA USAHA</td>
					<td width="10" align="center">:</td>
					<td width="250">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="140">&nbsp;&nbsp;   TMT OPERASIONAL</td>
					<td width="10" align="center">:</td>
					<td width="250">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="140">&nbsp;&nbsp;   ALAMAT USAHA</td>
					<td width="10" align="center">:</td>
					<td width="250">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="140">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   RT/RW</td>
					<td width="10" align="center">:</td>
					<td width="190">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="140">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Kelurahan</td>
					<td width="10" align="center">:</td>
					<td width="190">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="140">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Kecamatan</td>
					<td width="10" align="center">:</td>
					<td width="190">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="140">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Kab/Kota</td>
					<td width="10" align="center">:</td>
					<td width="190">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="140">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Telepon Usaha</td>
					<td width="10" align="center">:</td>
					<td width="190">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="140">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Kode Pos</td>
					<td width="10" align="center">:</td>
					<td width="190">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="140" >&nbsp;&nbsp;   <b><i>IDENTITAS PEMILIK</i></b></td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="140">&nbsp;&nbsp;   NAMA PEMILIK</td>
					<td width="10" align="center">:</td>
					<td width="250">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="140">&nbsp;&nbsp;   ALAMAT PEMILIK</td>
					<td width="10" align="center">:</td>
					<td width="250">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="140">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   RT/RW</td>
					<td width="10" align="center">:</td>
					<td width="190">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="140">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Kelurahan</td>
					<td width="10" align="center">:</td>
					<td width="190">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="140">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Kecamatan</td>
					<td width="10" align="center">:</td>
					<td width="190">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="140">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Kab/Kota</td>
					<td width="10" align="center">:</td>
					<td width="190">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="140">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Telepon Pemilik</td>
					<td width="10" align="center">:</td>
					<td width="190">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="140">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Kode Pos</td>
					<td width="10" align="center">:</td>
					<td width="190">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;"><br/>
					<td width="140">&nbsp;&nbsp;   JENIS PAJAK/USAHA</td>
					<td width="10" align="center">:</td>
					<td width="250">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="140">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Status Kantor</td>
					<td width="10" align="center">:</td>
					<td width="190">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="140">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Jumlah Karyawan</td>
					<td width="10" align="center">:</td>
					<td width="190">&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<td>
					</td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
				<td width="160">&nbsp; Pajak Hotel/ Rumah Kos</td>
				</tr>
				</table>
				</td>
				</tr>
			</table>';
			
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center">No</td>
					<td width="80" height="10" align="center">Kelas Kamar</td>
					<td width="100" height="10" align="center">Jumlah Kamar</td>
					<td width="100" height="10" align="center">Tarif Perhari</td>
					<td width="150" height="10" align="center">Alat Pembayaran</td>
					
				</tr>
			</table>';
			
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="20" align="center">1</td>
					<td width="80" height="20" align="center"></td>
					<td width="100" height="20" align="center"></td>
					<td width="100" height="20" align="center"></td>
					<td width="150" height="20" align="center"></td>
					
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="20" align="center">2</td>
					<td width="80" height="10" align="center"></td>
					<td width="100" height="10" align="center"></td>
					<td width="100" height="10" align="center"></td>
					<td width="150" height="10" align="center"></td>
					
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="20" align="center">3</td>
					<td width="80" height="10" align="center"></td>
					<td width="100" height="10" align="center"></td>
					<td width="100" height="10" align="center"></td>
					<td width="150" height="10" align="center"></td>
					
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="20" align="center">4</td>
					<td width="80" height="10" align="center"></td>
					<td width="100" height="10" align="center"></td>
					<td width="100" height="10" align="center"></td>
					<td width="150" height="10" align="center"></td>
					
				</tr>
			</table>';
		$report .=
			'<table border="0">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center"></td>
					<td width="80" height="10" align="center"></td>
					<td width="155" height="10" align="center"></td>
					<td width="182" height="10" align="center"></td>
					
				</tr>
				<tr>
				<td width="320">&nbsp; Pajak Restoran/ Rumah Makan/ Tempat Makan Minum</td>
				</tr>
			</table>';
		
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center">No</td>
					<td width="62" height="10" align="center">Jumlah Meja</td>
					<td width="62" height="10" align="center">Jumlah Kursi</td>
					<td width="140" height="10" valign="midle" align="center">Rata-rata Penjualan Perhari</td>
					<td width="100" height="10" align="center">Alat Pembayaran</td>
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="20" align="center">1</td>
					<td width="62" height="10" align="center"></td>
					<td width="62" height="10" align="center"></td>
					<td width="140" height="10" align="center"></td>
					<td width="100" height="10" align="center"></td>	
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="20" align="center">2</td>
					<td width="62" height="10" align="center"></td>
					<td width="62" height="10" align="center"></td>
					<td width="140" height="10" align="center"></td>
					<td width="100" height="10" align="center"></td>	
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="20" align="center">3</td>
					<td width="62" height="10" align="center"></td>
					<td width="62" height="10" align="center"></td>
					<td width="140" height="10" align="center"></td>
					<td width="100" height="10" align="center"></td>
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="20" align="center">4</td>
					<td width="62" height="10" align="center"></td>
					<td width="62" height="10" align="center"></td>
					<td width="140" height="10" align="center"></td>
					<td width="100" height="10" align="center"></td>	
				</tr>
				
			</table>';
		$report .=
			'<table border="0">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center"></td>
					<td width="62" height="10" align="center"></td>
					<td width="62" height="10" align="center"></td>
					<td width="140" height="10" align="center"></td>
					<td width="100" height="10" align="center"></td>	
				</tr>
				
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="230" colspan="3" align="center">&nbsp; Harga Menu</td>	
				</tr>
				
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="50" height="10" align="center"></td>
					<td colspan="3" width="90" height="10" align="center">Makanan</td>
					<td colspan="3" width="90" height="10" align="center">Minuman</td>
					
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="50" height="20" align="center">Termahal</td>
					<td width="90" height="10" align="center"></td>
					<td width="90" height="10" align="center"></td>
					
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="50" height="20" align="center">Termurah</td>
					<td width="90" height="10" align="center"></td>
					<td width="90" height="10" align="center"></td>
					
				</tr>
			</table>';
		$report .=
			'<table border="0">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="20" align="center"></td>
					<td width="80" height="10" align="center"></td>
					<td width="155" height="10" align="center"></td>
					<td width="182" height="10" align="center"></td>
					
				</tr>
				<tr>
				<td width="320">&nbsp; Pajak Hiburan</td>
				</tr>
				
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center">No</td>
					<td width="260" height="10" align="center">Jumlah Kamar/ Room/ Meja/ Permainan</td>
					<td width="100" height="10" align="center">Alat Pembayaran</td>
					<td width="155" height="10" align="center">Tarif</td>
					
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center">1</td>
					<td width="260" height="10" align="center"></td>
					<td width="100" height="10" align="center"></td>
					<td width="155" height="10" align="center"></td>
					
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center">2</td>
					<td width="260" height="10" align="center"></td>
					<td width="100" height="10" align="center"></td>
					<td width="155" height="10" align="center"></td>
					
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center">3</td>
					<td width="260" height="10" align="center"></td>
					<td width="100" height="10" align="center"></td>
					<td width="155" height="10" align="center"></td>
					
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center">4</td>
					<td width="260" height="10" align="center"></td>
					<td width="100" height="10" align="center"></td>
					<td width="155" height="10" align="center"></td>
					
				</tr>
			</table>';
		$report .=
			'<table border="0">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center"></td>
					<td width="260" height="10" align="center"></td>
					<td width="155" height="10" align="center"></td>
					
				</tr>
				<tr>
				<td width="320">&nbsp; Pajak Mineral Bukan Logam & Batuan</td>
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center">No</td>
					<td width="120" height="10" align="center">Nama Mineral</td>
					<td width="120" height="10" align="center">Volume (M3)</td>
					<td width="120" height="10" align="center">Harga Per M<sup>3</sup></td>
					
				</tr>
				
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center">1</td>
					<td width="120" height="10" align="center"></td>
					<td width="120" height="10" align="center"></td>
					<td width="120" height="10" align="center"></td>
					
				</tr>
				
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center">2</td>
					<td width="120" height="10" align="center"></td>
					<td width="120" height="10" align="center"></td>
					<td width="120" height="10" align="center"></td>
					
				</tr>
				
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center">3</td>
					<td width="120" height="10" align="center"></td>
					<td width="120" height="10" align="center"></td>
					<td width="120" height="10" align="center"></td>
					
				</tr>
				
			</table>';
		/* $report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center">4</td>
					<td width="120" height="10" align="center"></td>
					<td width="120" height="10" align="center"></td>
					<td width="120" height="10" align="center"></td>
					
				</tr>
				
			</table>'; */
		$report .=
			'<table border="0">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center"></td>
					<td width="260" height="10" align="center"></td>
					<td width="155" height="10" align="center"></td>
					
				</tr>
				<tr>
				<td width="320">&nbsp; Pajak Air Tanah</td>
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center">No</td>
					<td width="150" height="10" align="center">Lokasi Sumber Tanah</td>
					<td width="120" height="10" align="center">Volume (M3)</td>
					
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center">1</td>
					<td width="150" height="10" align="center"></td>
					<td width="120" height="10" align="center"></td>
					
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center">2</td>
					<td width="150" height="10" align="center"></td>
					<td width="120" height="10" align="center"></td>
					
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center">3</td>
					<td width="150" height="10" align="center"></td>
					<td width="120" height="10" align="center"></td>
					
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center">4</td>
					<td width="150" height="10" align="center"></td>
					<td width="120" height="10" align="center"></td>
					
				</tr>
			</table>';
		$report .=
			'<table border="0">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center"></td>
					<td width="150" height="10" align="center"></td>
					<td width="120" height="10" align="center"></td>
					
				</tr>
				<tr>
				<td width="320">&nbsp; Pajak Parkir</td>
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center">No</td>
					<td width="80" height="10" align="center">Luas Area Parkir</td>
					<td width="120" height="10" align="center">Type Kendaraan</td>
					<td width="90" height="10" align="center">Tarif</td>
					<td width="90" height="10" align="center">Tarif Langganan</td>
					<td width="120" height="10" align="center">Parkir Khusus Karyawan</td>
					
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center">1</td>
					<td width="80" height="10" align="center"></td>
					<td width="120" height="10" align="left">Roda 2</td>
					<td width="90" height="10" align="left"></td>
					<td width="90" height="10" align="left"></td>
					<td width="120" height="10" align="center"></td>
					
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center">2</td>
					<td width="80" height="10" align="center"></td>
					<td width="120" height="10" align="left">Roda 4</td>
					<td width="90" height="10" align="left"></td>
					<td width="90" height="10" align="left"></td>
					<td width="120" height="10" align="center"></td>
					
				</tr>
			</table>';
		$report .=
			'<table border="1">
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
					<td width="25" height="10" align="center">3</td>
					<td width="80" height="10" align="center"></td>
					<td width="120" height="10" align="left">Roda 6</td>
					<td width="90" height="10" align="left"></td>
					<td width="90" height="10" align="left"></td>
					<td width="120" height="10" align="center"></td>
					
				</tr>
			</table>';
		$report .=
			'<table border="0">
				<tr>
				<td width="572">
				<table>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="160" >&nbsp;&nbsp;   UKURAN TEMPAT USAHA</td>
					<td width="10" align="center">:</td>
					<td width="250">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="160">&nbsp;&nbsp;   SURAT IZIN YANG DIMILIKI</td>
					<td width="10" align="center">:</td>
					<td width="290">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="160">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  1.</td>
					<td width="10" align="center"></td>
					<td width="250">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="160">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Nomor</td>
					<td width="10" align="center">:</td>
					<td width="250">.................................................</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="160">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Tanggal</td>
					<td width="10" align="center">:</td>
					<td width="250">.................................................</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="160">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  2.</td>
					<td width="10" align="center"></td>
					<td width="250">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="160">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Nomor</td>
					<td width="10" align="center">:</td>
					<td width="250">.................................................</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="160">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Tanggal</td>
					<td width="10" align="center">:</td>
					<td width="250">.................................................</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="160">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  3.</td>
					<td width="10" align="center"></td>
					<td width="250">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="160">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Nomor</td>
					<td width="10" align="center">:</td>
					<td width="250">.................................................</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="160">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Tanggal</td>
					<td width="10" align="center">:</td>
					<td width="250">.................................................</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="160">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  4.</td>
					<td width="10" align="center"></td>
					<td width="250">&nbsp;&nbsp;</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="160">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Nomor</td>
					<td width="10" align="center">:</td>
					<td width="250">.................................................</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="160">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Tanggal</td>
					<td width="10" align="center">:</td>
					<td width="250">.................................................</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="160">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  5.</td>
					<td width="10" align="center"></td>
					<td width="250"></td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="160">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Nomor</td>
					<td width="10" align="center">:</td>
					<td width="250">.................................................</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="160">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Tanggal</td>
					<td width="10" align="center">:</td>
					<td width="250">.................................................</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="160">&nbsp;&nbsp;   JENIS PAJAK</td>
					<td width="10" align="center">:</td>
					<td width="190">.................................................</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="160">&nbsp;&nbsp;   GOLONGAN WAJIB PAJAK</td>
					<td width="10" align="center">:</td>
					<td width="190">.................................................</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="160">&nbsp;&nbsp;   TANGGAL PENDAFTARAN</td>
					<td width="10" align="center">:</td>
					<td width="190">.................................................</td>
				</tr>
				<tr>
					<td>
					</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="380">&nbsp;&nbsp;   Demikian data ini diberikan dengan benar untuk dapat digunakan sebagaimana perlunya.</td>
				</tr>
				
				<tr>
					<td>
					</td>
				</tr>
				<tr>
					<td>
					</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="380">&nbsp;&nbsp;   Jambi,																					'. date("Y").'</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="380">&nbsp;&nbsp;   Yang Memberi Keterangan,</td>
				</tr>
				<tr>
					<td>
					</td>
				</tr>
				<tr>
					<td>
					</td>
				</tr>
				<tr>
					<td>
					</td>
				</tr><tr>
					<td>
					</td>
				</tr>
				<tr>
					<td>
					</td>
				</tr><tr>
					<td>
					</td>
				</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif;font-size:9;">
					<td width="380">&nbsp;&nbsp;   ..............................................</td>
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
	
	public function cetak_perusahaan() {
		
		$arr = 'NPWPD';
        
		//$data = $this->db->query("select a.npwpd_perusahaan as npwpd_perusahaan, a.nama_perusahaan as nama_perusahaan, a.alamat_perusahaan as alamat_perusahaan, DATE_FORMAT(a.terdaftar,'%d/%m/%Y') as tgl, b.nama_jns from identitas_perusahaan a inner join no_max_npwpd b on a.jenis_pajak=b.kd_jns where a.npwpd_perusahaan='".$_GET['npwpd']."'")->row();
		$data = $this->db->query("SELECT a.npwpd_perusahaan AS npwpd_perusahaan, a.nama_perusahaan AS nama_perusahaan, a.alamat_perusahaan AS alamat_perusahaan, DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y') AS tgl, b.nama_jns, c.nama_sptpd FROM identitas_perusahaan a 
LEFT JOIN no_max_npwpd b ON a.jenis_pajak=b.kd_jns
LEFT JOIN master_sptpd c ON a.jenis_usaha=c.id where a.npwpd_perusahaan='".$_GET['npwpd']."'")->row();
        $no 			= $data->npwpd_perusahaan;
		$nama 		  = $data->nama_perusahaan;
		$jenis_usaha		= $data->nama_jns;
		$alamat 			= $data->alamat_perusahaan;
		$tgl 				= $data->tgl;
        $usaha              = strtoupper($data->nama_sptpd);
		
		$query = $this->db->query("select isi from master_template where code_izin='".$arr."'");
		$rs = $query->row();	
		$html = $rs->isi;
		
		$searchArray = array("[no]","[nama]","[alamat]","[tgl]","[usaha]");
		$replaceArray = array($no,$nama,$alamat,$tgl,$usaha);
        //$searchArray = array("[no]","[nama]","[alamat]","[tgl]","[usaha]");
        //$replaceArray = array($no,$nama,$alamat,$tgl,$usaha);
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
        $user = $this->session->userdata('username');
        $waktu= date('Y-m-d H:i:s');
		$sq = $this->db->query("select count(npwpd) as jml from sptpd where npwpd='".$id_perusahaan."'")->row();
		$a = $sq->jml;
		if($a==0){
            //$this->db->query("insert into h_identitas_perusahaan select *,$user,$waktu from identitas_perusahaan where npwpd_perusahaan='".$id_perusahaan."'");
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
		$data['pajak'] = $this->model_user->ukuh();
		$this->load->view('izin/pengukuhan',$data);
	}
	
	public function data_pengukuhan() {
		$grid = new GridConnector($this->db->conn_id);
		//$grid->dynamic_loading(100);
		$grid->render_sql("SELECT a.id, a.no_ukuh, a.npwpd, b.nama_perusahaan, b.alamat_perusahaan, a.kewajiban, c.nama_sptpd AS jenis_usaha FROM pengukuhan a 
LEFT JOIN identitas_perusahaan b ON a.npwpd = b.npwpd_perusahaan
LEFT JOIN master_sptpd c ON c.id = b.jenis_usaha","id","id, no_ukuh, npwpd, nama_perusahaan, alamat_perusahaan, kewajiban, jenis_usaha");	
	}
	
	public function simpan_ukuh(){
		$data = array (
			'npwpd' 		  => $this->input->post('npwpd'),
			/*'nama' 		  => $this->input->post('nama'),
			'alamat'		=> $this->input->post('alamat'),
			*/
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
	
	public function delete_ukuhh() {
		$id = $this->input->post('id');
		$npwpd = $this->input->post('npwpd');
		
		if ($id=="" || $npwpd==""){
			$result = 0;
		}else{
			$sql = $this->db->query("DELETE FROM pengukuhan where npwpd='".$npwpd."' and id='".$id."'");
			if($sql){
				$result = 1;
			}else{
				$result = 0;
			}
		}

		echo $result;
	}
	
	function cetak_ukuh(){
		$arr = 'PENGUKUHAN';
		$arr2 = 'PENGUKUHAN_AIR';
		$billing = '';
                $data_badan = $this->db->query("select * from badan where id = '1'")->row();
                $nama_badan = explode(" ",$data_badan->nama_badan);
                $kepala_badan = "KEPALA ".strtoupper($nama_badan[0]);
		$data = $this->db->query("SELECT pengukuhan.npwpd, pengukuhan.no_ukuh, pengukuhan.id, identitas_perusahaan.nama_perusahaan,
identitas_perusahaan.alamat_perusahaan, pengukuhan.kewajiban,identitas_pemilik.nama_pemilik,
view_kelurahan.nama_kecamatan,view_kelurahan.nama_kelurahan,identitas_perusahaan.rt,identitas_perusahaan.kabupaten,
DATE_FORMAT(identitas_perusahaan.tgl_daftar,'%d/%m/%Y') AS tgl,LEFT(pengukuhan.npwpd,1) AS bil,SUBSTRING(npwpd,9,2) as bildet
FROM pengukuhan 
LEFT JOIN identitas_perusahaan ON pengukuhan.npwpd = identitas_perusahaan.npwpd_perusahaan
LEFT JOIN identitas_pemilik ON identitas_pemilik.npwpd_pemilik = identitas_perusahaan.npwpd_pemilik
LEFT JOIN view_kelurahan ON view_kelurahan.kode_kecamatan=identitas_perusahaan.kecamatan AND view_kelurahan.kode_kelurahan=identitas_perusahaan.kelurahan where pengukuhan.npwpd ='".$_GET['npwpd']."'")->row();
		$npwpd       = $data->npwpd;
		$no_ukuh     = $data->no_ukuh;
		$nama 		= $data->nama_perusahaan;
		$jenis_usaha = '';
		$alamat 	  = $data->alamat_perusahaan;
		$kewajiban   = $data->kewajiban;
		$nama_pemilik   = $data->nama_pemilik;
		$nama_kecamatan   = $data->nama_kecamatan;
		$kec = strtolower($nama_kecamatan);
		$kec1 = ucwords($kec);
		$nama_kelurahan   = $data->nama_kelurahan;		
		$rt   = $data->rt;
		$tgl1   = $data->tgl;	
		$bil   = $data->bil;
		$kabupaten   = $data->kabupaten;
		$bildet = $data->bildet;
		$day = date('d');
		$mounth = $this->msistem->v_bln(date('m'));
		$year = date('Y');
		
		$tgll = explode("/",$tgl1);
		$tglla= $tgll[0];
		$tgllb= $tgll[1];
		$tgllc= $tgll[2];
		$tgllba = $this->msistem->v_bln($tgllb);
		$tgl = $tglla." ".$tgllba." ".$tgllc;
		
		$tgllbb = $tgllb+1;
		$tgllaa = $tgllc+1;
		$tgllcc = $this->msistem->v_bln($tgllbb);
		
		if($tgllb=='12'){
			$tglkedua = $tgllb='Januari'." ".$tgllaa;
		}else{
			$tglkedua = $tgllcc." ".$tgllc;
		}
		
		if($bil=='4' || $bil=='8'){
			$billing = "Official Assesment";
		}else{
			$billing = "Self Assesment";
		}
		
		$full = $day." ".$mounth." ".$year;
		$kepala = "SUBHI,S.Sos, MM";
		$nip = "19630820 198603 1 009";
		
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
		if($pajak=="Air Tanah"){
			$query = $this->db->query("select isi from master_template where code_izin='".$arr2."'");
			$rs = $query->row();	
			$html = $rs->isi;
			
		} 
		else{
		
		$query = $this->db->query("select isi from master_template where code_izin='".$arr."'");
		$rs = $query->row();	
		$html = '<table width="550" border="0">	
	<tr>
		  <td width="320" colspan="3"></td>
		  <td width="120" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><div align="left"><font size="10">Jambi, [tanggal]</font></div></td>	
  		</tr>
	<tr>
		  <td colspan="4"><br/></td>
  		</tr>
	<tr>
		<td width="30"></td>  
		<td colspan="3">
			<table width="600" border="0" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif">
				<tr>
					<td width="50"><font size="10">Nomor</font></td>
					<td width="190"><div align="left"><font size="9"> : 973 /         / '.$data_badan->singkatan.'.</font></div></td>
					<td width="50"></td>
					<td width="235"><div align="left"><font size="9">Kepada</font></div></td>
				</tr>
				<tr>
					<td width="50"><font size="10">Sifat</font></td>
					<td width="190"><div align="left"><font size="9"> : Penting</font></div></td>	
					<td width="50"></td>
					<td width="235"><div align="left"><font size="9">Yth. Sdr. [nama_pemilik]</font></div></td>
				</tr>
				<tr>
					<td width="50"><font size="10">Lampiran</font></td>
					<td width="190"><div align="left"><font size="9"> : -</font></div></td>	
					<td width="50"></td>
					<td width="235"><div align="left"><font size="9">(Pemilik "[nama_perusahaan]")</font></div></td>
				</tr>
				<tr>
					<td width="50"><font size="10">Hal</font></td>
					<td width="190"><div align="left"><font size="9"> : <b><u>Pengukuhan Sebagai Wajib Pajak Daerah</u></b></font></div></td>	
					<td width="50"></td>
					<td width="200"><div align="left"><font size="9">[alamat] RT. [rt] Kel. [nama_kelurahan] Kec. [nama_kecamatan]</font></div></td>
					
				</tr>
				<tr>
					<td width="290" cosplan="3"></td>
					<td width="235"><div align="left"><font size="9">di - <br/><b><font color="white">===</font>JAMBI</font></div></b></td>
				</tr>
			</table>	
		</td>
  		</tr>
        <tr>
			<td width="80"></td>
			<td colspan="3">&nbsp;</td>
		</tr>
        <tr>
			<td width="80"></td>
			<td width="465" colspan="3" align="justify" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="9"><font color="white">======</font>Mempedomani kembali Undang-Undang Republik Indonesia Nomor 28 Tahun 2009 tentang Pajak Daerah dan Retribusi Daerah yang telah disahkan dan diundangkan pada tanggal 15 September 2009 dan berdasarkan Peraturan Daerah Kota Jambi Nomor 05 Tahun 2011 Tentang Pajak Daerah sebagaimana telah diubah dengan Peraturan Daerah Nomor 07 Tahun 2016 tentang perubahan atas Peraturan Daerah Nomor 05 Tahun 2011 Tentang Pajak Daerah, maka bersama ini diberitahukan kepada Saudara sebagai berikut :</font></td>
		</tr>	        
	<tr>
			<td width="80"></td>
			<td width="10" align="justify" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="9">1.</font></td>
			<td width="455" colspan="2" align="justify" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="9">Bahwa berdasarkan Peraturan Daerah Kota Jambi Nomor 05 Tahun 2011 dimaksud, pada BAB III JENIS PAJAK DAERAH pasal tiga ayat (1) disebutkan : <u>salah satu Objek Pajak Daerah adalah Pajak [jenis_usaha].</u> Berkaitan dengan hal tersebut, telah diberlakukan kepada Saudara <u>selaku pengusaha "[nama_perusahaan]"</u> diwajibkan memungut pajak kepada seluruh konsumen yang melakukan transaksi dengan <u>tarif [jenis_usaha] sebesar [tariff]%</u> dari jumlah pembayaran yang diterima atau yang seharusnya diterima Saudara selaku pemilik / pengelola dengan <b>NPWPD [npwpd].</font></b></td>
		</tr>
        <tr>
			<td width="80"></td>
			<td width="10" align="justify" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="9">2.</font></td>
			<td width="455" colspan="2" align="justify" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="9">Terhadap Saudara terhitung mulai tanggal [tgl] telah didaftarkan sebagai  <u>Wajib Pajak (WP)</u> dengan menggunakan sistem penetapan sendiri melalui Billing ([billing]) sebagaimana format blangko terlampir. Dimana pembayaran pajaknya mulai dilakukan pada bulan <u>[tgl2]</u> dan secara rutin dilakukan setiap bulannya paling lambat tanggal 15.</font></td>
		</tr>
	<tr>
			<td width="80"></td>
			<td width="10" align="justify" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="9">3.</font></td>
			<td width="455" colspan="2" align="justify" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="9">Apabila pembayaran yang akan Saudara lakukan tersebut tepat pada hari libur maka pembayarannya dapat dilakukan pada hari kerja berikutnya dan disetorkan langsung ke Bendahara Penerima '.$data_badan->nama_badan.' Kota Jambi.</font></td>
		</tr>
	<tr>
			<td width="80"></td>
			<td width="10" align="justify" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="9">4.</font></td>
			<td width="455" colspan="2" align="justify" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="9">Terhadap setiap keterlambatan pembayaran pajak dikenakan sanksi administrasi berupa denda 2% (dua persen) setiap bulannya sesuai dengan Peraturan Daerah yang berlaku.</font></td>
		</tr>
	<tr>
			<td width="80"></td>
			<td width="10" align="justify" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="9">5.</font></td>
			<td width="455" colspan="2" align="justify" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="9">Kepada semua Wajib Pajak (WP) yang melakukan <u>tutup usaha</u>, wajib melaporkannya pada saat usaha tersebut tidak berjalan lagi agar tidak menjadi tunggakan pajak dan apabila Saudara tidak melaporkan maka pajaknya akan terus berjalan serta dianggap memiliki tunggakan pajak.</font></td>
		</tr>
	<tr>
			<td width="80"></td>
			<td width="10" align="justify" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"></td>
			<td width="455" colspan="2" align="justify" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="9"><font color="white">====</font>Demikian disampaikan agar dapat Saudara maklumi, atas perhatian dan kerjasamanya diucapkan terima kasih</font></td>
		</tr>	
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">&nbsp;</td>
  </tr>
       
        <tr>
			<td width="159">&nbsp;</td>
            <td width="94">&nbsp;</td>
            <td width="25">&nbsp;</td>
            <td width="263" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><div align="center"><font size="9">'.$kepala_badan.'</font></div></td>
		</tr>
        <tr>
			<td height="40" colspan="4">&nbsp;</td>
  </tr>
        <tr style="line-height:70%;">
			<td width="159">&nbsp;</td>
            <td width="94">&nbsp;</td>
            <td width="120">&nbsp;</td>
            <td width="200" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><div align="left"><font size="9"><b><u>[kepala]</u></b></font></div></td>
		</tr>
	<tr style="line-height:70%;">
			<td width="159">&nbsp;</td>
            <td width="94">&nbsp;</td>
            <td width="120">&nbsp;</td>
            <td width="200" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><div align="left"><font size="9">Pembina Utama Muda</font></div></td>
		</tr>
        <tr style="line-height:70%;">
			<td width="159">&nbsp;</td>
            <td width="94">&nbsp;</td>
            <td width="120">&nbsp;</td>
            <td width="200" align="center" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><div align="left"><font size="9">NIP.[nip]</font></div></td>
		</tr>
	<tr>
			<td width="40"></td>
			<td colspan="3" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="9"><u>Tembusan, Yth :</u></font></td>
		</tr>
	<tr>
			<td width="40"></td>
			<td colspan="3" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif"><font size="9">Bapak Walikota Jambi (sebagai laporan).</font></td>
		</tr>
    </table>';
		}
		
		//
		$QUERY = $this->db->query("select * from identitas_perusahaan WHERE nama_perusahaan like '%REFLE%' AND npwpd_perusahaan like '3.%' and npwpd_perusahaan = '$npwpd'");
		$rowcount = $QUERY->num_rows();
		//
		//$rek = $rsd->kd_rek;
		
		if($rowcount>=1){
			$tariff="15";
		}else{
			$query4 = $this->db->query("SELECT kd_rek,nm_rek,pajak,tarif_pajak FROM master_rekening WHERE pajak ='$bil' and pajak_det='$bildet'");
			$rsd = $query4->row();
			$tariff = $rsd->tarif_pajak;
		}
		
		
		$searchArray = array("[nomor]","[npwpd]","[nama_perusahaan]","[alamat]","[jenis_usaha]","[kewajiban]","[tanggal]","[kepala]","[nip]","[nama_pemilik]","[nama_kecamatan]","[nama_kelurahan]","[rt]","[kabupaten]","[tgl]","[tgl2]","[billing]","[tariff]");
		$replaceArray = array($no_ukuh,$npwpd,$nama,$alamat,$pajak,$isi,$full,$kepala,$nip,$nama_pemilik,$kec1,$nama_kelurahan,$rt,$kabupaten,$tgl,$tglkedua,$billing,$tariff);
		$intoString = $html;
		//now let's replace
		$report = str_replace($searchArray, $replaceArray, $intoString);
		
		//setting pdf
		$this->load->library('header/header_ukuh');
		$pdf = new header_ukuh('P', 'pt', 'LEGAL', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SIMTAP');
		$pdf->SetKeywords('SIMTAP');
	
		//set no header & footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		//$pdf->SetHeaderMargin(20);
		$pdf->SetMargins(20,50,20);
		// set font yang digunakan
		$pdf->SetFont('times', '', 12);
	
		$pdf->AddPage('P','A4',false);
		//set data
                $pdf->SetFont('times', '',12);
                $html = '<table width="500" border="0">
  <tr>
        <td width="20"></td>
    <td width="90"><img src="./images/LOGO KOTA PADANG.png" width="54" height="64" /></td>
    <td width="400" align="center"><font size=14px><b>PEMERINTAH KOTA JAMBI</b><br />
      <strong>'.strtoupper($data_badan->nama_badan).'</font></strong><br />Jl. Jend. Basuki Rachmat Kota Baru Telepon. (0741) 40284 Fax. 40284<br /><b>J A M B I</b></td>
  </tr>
  <tr style="line-height:10%;">
                                        <td width="565" >
                                                <hr style="height:2px"></hr>
                                        </td>
  </tr>
</table>';
		$pdf->writeHTML($html, true, 0, true, 0);
                
		$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->lastPage();
		$pdf->Output('Report_'.$arr.'.pdf', 'I');
	}
}
?>