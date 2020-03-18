<?php 
//require_once('application/libraries/pdf.php');
require_once('application/plugins/tcpdf/tcpdf.php');
class header_report extends TCPDF {
	
	public function Header() {
		$this->SetFont('times', '',12);
		
		$html = '<table width="450" height="105" border="1" cellpadding="0" cellspacing="0">
<tr>
<td><table width="500" border="0" bgcolor="#CCCCCC">
  <tr>
    <td width="90" align="center"><img src="./images/LOGO_KOTA_PADANG.png" width="73" height="74" /></td>
    <td width="360"><br /><p align="center">PEMERINTAH KOTA JAMBI<br />
      <strong>DINAS PENDAPATAN KOTA JAMBI</strong></p></td>
  </tr>
</table>
</td></tr>
</table>';
		$this->writeHTML($html, true, 0, true, 0);
	}
	
	// Page footer
	public function Footer() {
		// Position at 1.5 cm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'C');
	}
}
?>