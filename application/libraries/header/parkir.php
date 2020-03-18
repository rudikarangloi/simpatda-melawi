<?php 
//require_once('application/libraries/pdf.php');
require_once('application/plugins/tcpdf/tcpdf.php');
class parkir extends TCPDF {
	
	public function Header() {
		$this->SetFont('times', '',10);
		
		$html = '<table width="572" height="115" border="1" cellpadding="0" cellspacing="0">
 <tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
    <td width="50" align="center" valign="middle"><img src="./images/sptpd.png" width="53" height="54" /></td>
    <td width="220" align="center">
		PEMERINTAH KABUPATEN MELAWI<br />
		BADAN PENDAPATAN DAERAH<br />
		Jl. Garuda No.1 Nanga Pinoh<br />
		Telp. (0568) 2020545<br />
	</td>
	<td width="210" align="center">
		SURAT PEMBERITAHUAN PAJAK DAERAH<br />
		PAJAK PENERANGAN JALAN<br />
		Masa Pajak : ....................... s/d ....................... <br />
		Tahun : .......................
	</td>
	<td width="92" align="center">
	<br /><br />
		No. SPTPD<br />
		.......................
	</td>  
  </tr>
</table>';
		$this->writeHTML($html, true, 0, true, 0);
	}
}
?>