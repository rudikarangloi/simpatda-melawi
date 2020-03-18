<?php 
//require_once('application/libraries/pdf.php');
require_once('application/plugins/tcpdf/tcpdf.php');
class sptpd extends TCPDF {
	
	public function Header() {
		$this->SetFont('times', '',10);
		
		$html = '<table width="572" border="1" cellpadding="0" cellspacing="0">
 <tr>
    <td width="50" align="center" valign="middle"><img src="./images/Logo melawi2.png" width="46" height="52,8" /></td> 
  </tr>
</table>';
		$this->writeHTML($html, true, 0, true, 0);
	}
	
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'B', 10);
		// Page number)
		
		$this->Cell(0, 10, 'HALAMAN '.$this->getAliasNumPage().' DARI '.$this->getAliasNbPages().' HALAMAN', 0, false, 'C', 0, '', 0, false, 'T', 'M');		
		
	}
}
?>