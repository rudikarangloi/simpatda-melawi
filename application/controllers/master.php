<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class master extends MY_Controller {
	
	function __Construct() {
		parent::__Construct();
		$this->load->model('model_user');
	}
	
	public function index() {
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$this->load->view('master/master',$data);
	}
	
	//template
	public function template() {
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$this->load->view('master/master',$data);
	}
	
	public function upload_template() {
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$this->load->view('master/upload',$data);
	}
	
	public function parameter() {
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$this->load->view('master/parameter',$data);
	}
	
	//Group
	public function group() {
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$data['menu'] = $this->model_user->menu();
		$this->load->view('master/groups',$data);
	}
	
	public function data_group() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id_modul,nm_modul,menu from menu_modul where id_modul != 29","id_modul","id_modul,nm_modul,menu");	
	}
	
	public function simpan_group() {
		$data = array (
			'nm_modul' 		=> strtoupper($this->input->post('nm_modul')),
			'menu'			=> strtoupper($this->input->post('menu')),
			'author' 		=> strtoupper($this->session->userdata('username'))
		);
		if($this->input->post('id')==0){
			$dataIns = array_merge($data,array('created' => date('Y-m-d H:i:s')));
			$result = $this->db->insert('menu_modul',$dataIns);
		} else {
			$dataUpd = array_merge($data,array('modified' => date('Y-m-d H:i:s')));
			$result = $this->db->update('menu_modul', $dataUpd, array('id_modul' => $this->input->post('id')));
		}
		echo $result;
	}
	
	public function delete_group() {
		$result = $this->db->delete('menu_modul',array('id_modul' => $this->input->post('id')));
		echo $result;
	}
	
	//master wajib pajak
	public function wp(){
		$this->load->view('master/wp');
	}
	
	public function data_wp() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id, a.npwpd_perusahaan, a.username, a.password, b.nama_pemilik, b.nama_perusahaan, b.hp, b.nama_sptpd from master_wp_account a left join view_perusahaan b on a.npwpd_perusahaan=b.npwpd_perusahaan","id","id,npwpd_perusahaan,username,password,nama_pemilik,nama_perusahaan,hp,nama_sptpd");
	}
	
	function simpan_wp(){
		$data = array(
			'npwpd_perusahaan' 		=> $this->input->post('npwpd'),
			'username' 			=> $this->input->post('user'),
			'password' 			=> md5($this->input->post('pass')),
			'author' 		=> strtoupper($this->session->userdata('username'))
		);
		if($this->input->post('id')==0){
			$dataIns = array_merge($data,array('created' => date('Y-m-d H:i:s')));
			$result = $this->db->insert('master_wp_account',$dataIns);
		} else {
			$dataUpd = array_merge($data,array('modified' => date('Y-m-d H:i:s')));
			$result = $this->db->update('master_wp_account', $dataUpd, array('id' => $this->input->post('id')));
		}
		echo $result;		
	}
	
	public function delete_wp() {
		$result = $this->db->delete('master_wp_account',array('id' => $this->input->post('id')));
		echo $result;
	}
	
	//User Account
	public function user() {
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$data['modul'] = $this->db->query("select * from menu_modul");
		$data['app'] = $this->db->query("select id_modul, nama_modul from master_modul order by id_modul asc");
        $data['skpd_load'] = $this->db->query("SELECT kd_skpd,nama_skpd FROM master_skpd order by kd_skpd desc");
		$this->load->view('master/users',$data);
	}
		
	public function data_user() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->dynamic_loading(100); 
		//$grid->render_sql("select id,username,nama,telp,email,id_modul,nip,bagian,app,kd_skpd from admin where id != 46","id","id,username,nama,telp,email,id_modul,nip,bagian,app,kd_skpd");	
        $grid->render_sql("SELECT a.id,a.username,a.nama,a.telp,a.email,a.id_modul,a.nip,a.bagian,a.app FROM admin a WHERE id_modul != 43","id","id,username,nama,telp,email,id_modul,nip,bagian,app");
	}
	
	public function simpan_user() {
		
			$data = array (
				'username' 		=> $this->input->post('username'),
				'nama' 			=> $this->input->post('nama'),
				'telp' 			=> $this->input->post('telp'),
				'email' 		=> $this->input->post('email'),
				'password' 		=> md5($this->input->post('password')),
				'id_modul' 		=> $this->input->post('group'),
				'nip' 			=> $this->input->post('nip'),
				'bagian' 		=> $this->input->post('bagian'),
                'kd_skpd'       => $this->input->post('skpd_p'),
				'app' 		    => $this->input->post('app'),
				'author' 		=> strtoupper($this->session->userdata('username'))
			);
			
		if($this->input->post('id')==0){
			$dataIns = array_merge($data,array('created' => date('Y-m-d H:i:s')));
			$result = $this->db->insert('admin',$dataIns);
		} else {
			$dataUpd = array_merge($data,array('modified' => date('Y-m-d H:i:s')));
			$result = $this->db->update('admin', $dataUpd, array('id' => $this->input->post('id')));
		}
		echo $result;
	}
	
	public function delete_user() {
		$result = $this->db->delete('admin',array('id' => $this->input->post('id')));
		echo $result;
	}
	
	//Target PAD
	public function pad() {
		$data['username'] = $username = $this->session->userdata('username');
		$s = $this->db->query("select * from menu_modul where id_modul='".$this->session->userdata('id_modul')."'")->row();
		$data['nm_modul'] = $s->nm_modul;
		$this->load->view('master/pad',$data);
	}
	
	public function data_pad() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,tahun,target_pad from target_pad","id","id,tahun,target_pad");	
	}
	
	public function simpan_pad() {
		$data = array (
			'tahun' 		=> $this->input->post('tahun'),
			'target_pad' 	=> $this->input->post('pad'),
			'author' 		=> strtoupper($this->session->userdata('username'))
		);
		if($this->input->post('id')==0){
			$dataIns = array_merge($data,array('created' => date('Y-m-d H:i:s')));
			$result = $this->db->insert('target_pad',$dataIns);
		} else {
			$dataUpd = array_merge($data,array('modified' => date('Y-m-d H:i:s')));
			$result = $this->db->update('target_pad', $dataUpd, array('id' => $this->input->post('id')));
		}
		echo $result;
	}
	
	public function delete_pad() {
		$result = $this->db->delete('target_pad',array('id' => $this->input->post('id')));
		echo $result;
	}
}