<?php 
//require_once('application/libraries/pdf.php');
require_once('application/plugins/tcpdf/tcpdf.php');
class skpd extends TCPDF {
	
	public function Header() {
		$this->SetFont('times', '',10);
		
		$html = '<table width="572" height="115" border="1" cellpadding="0" cellspacing="0">
 <tr>
    <td width="50" align="center" valign="middle"><img src="./images/sptpd.png" width="53" height="54" /></td>
    <td width="220" align="center">
		PEMERINTAH KABUPATEN ACEH BARAT<br />
		DINAS PENGELOLAAN KEUANGAN DAN KEKAYAAN DAERAH<br />
		Jl. Gajah Mada Telp (0655) 7551163. Fax. 7551167<br />
		MEULABOH
	</td>
	<td width="210" align="center">
		SURAT PEMBERITAHUAN PAJAK DAERAH<br />
		PAJAK PARKIR<br />
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