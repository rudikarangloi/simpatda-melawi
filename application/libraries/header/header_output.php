<?php 
//require_once('application/libraries/pdf.php');
require_once('application/plugins/tcpdf/tcpdf.php');
class header_output extends TCPDF {
	
	public function Header() {
		$this->SetFont('times', '',12);
		
		$html = '<table width="240" border="1" cellpadding="0" cellspacing="0" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">		
<tr>
<td>
	<table width="240" border="0" bgcolor="#F8F8F9">
	<tr style="font-size:10px;">
    <td height="49" width="50" align="center" ><img src="./images/Logo melawi.png" width="38" height="38" /></td>
    <td width="190" ><p align="center">PEMERINTAH KABUPATEN MELAWI<br />
      <strong><font color="FF0">BADAN PENDAPATAN DAERAH</font></strong><br/><font size="8">Jl. Propinsi Nanga Pinoh Kota Baru<br/> Telepon - </font></p></td>
	</tr>
	</table>
</td>
</tr>
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