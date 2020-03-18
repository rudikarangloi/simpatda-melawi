<?php 
//require_once('application/libraries/pdf.php');
require_once('application/plugins/tcpdf/tcpdf.php');
class nota extends TCPDF {
	
	public function Header() {
		$this->SetFont('times', '',10);
		
		$html = '<table width="572" height="115" border="1" cellpadding="0" cellspacing="0">
 <tr>
    <td width="50" align="center" valign="middle"><img src="./images/Logo melawi2.png" width="53" height="54" /></td>
  </tr>
</table>';
		$this->writeHTML($html, true, 0, true, 0);
	}
}
?>