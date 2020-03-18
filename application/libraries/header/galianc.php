<?php 
//require_once('application/libraries/pdf.php');
require_once('application/plugins/tcpdf/tcpdf.php');
class galianc extends TCPDF {
	
	public function Header() {
		$this->SetFont('times', '',10);
		
		$html = '<table width="572" height="115" border="0" cellpadding="0" cellspacing="0">
 <tr>
    <td width="44" align="center" valign="middle"><img src="./images/sptpd.png" width="53" height="54" /></td>
  </tr>
</table>';
		$this->writeHTML($html, true, 0, true, 0);
	}
}
?>