<?php
class model_user extends CI_Model {
	
	function menu(){
		$no = 1;
		$textOutlet = "<ul style=list-style:none;>";
		$sql = $this->db->query("select kode, menu from menu_by_modul where display=1 order by kode asc");
		foreach($sql->result() as $rs) {
			$textOutlet .= "<li><input type=checkbox name=O".$no." id=T".$no." value=\"".$rs->kode."\" \><b>".$rs->menu."</b></li>";	
			$no++;
		}
		$textOutlet .= "</ul>";
		$jml = count($sql->result());
		return $textOutlet."|".$jml;	
		//return $textOutlet;
	}
	
	function ukuh(){
		$no = 1;
		$textOutlet2 = "<ul style=list-style:none;>";
		$sql2 = $this->db->query("select kode_sptpd, nama_sptpd from master_sptpd order by id asc");
		foreach($sql2->result() as $rs2) {
			$textOutlet2 .= "<li><input type=checkbox name=O".$no." id=T".$no." value=\"".$rs2->kode_sptpd."\" \><b>".$rs2->nama_sptpd."</b></li>";	
			$no++;
		}
		$textOutlet2 .= "</ul>";
		$jml2 = count($sql2->result());
		return $textOutlet2."|".$jml2;	
		//return $textOutlet;
	}
	
	function ttd(){
		$no = 1;
		$textOutlet2 = "<ul style=list-style:none;>";
		$sql2 = $this->db->query("select id, nama_ttd from master_tanda_tangan order by id asc");
		foreach($sql2->result() as $rs2) {
			$textOutlet2 .= "<li><input type=checkbox name=O".$no." id=T".$no." value=\"".$rs2->id."\" \><b>".$rs2->nama_ttd."</b></li>";	
			$no++;
		}
		$textOutlet2 .= "</ul>";
		$jml2 = count($sql2->result());
		return $textOutlet2."|".$jml2;	
		//return $textOutlet;
	}
}
?>