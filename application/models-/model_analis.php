<?php
class model_analis extends CI_Model {
	
	function kode_restoran() {
		$query = $this->db->query("select max(*) as max from mp_restoran");
		$rs = $query->row();
		$intNomor = $rs->max;
		
		return $query;	
	}
	
	function kode_hiburan() {
		$query = $this->db->query("select id, nilai from ref_setting where id = 5");
		return $query;	
	}
	
	
}
?>