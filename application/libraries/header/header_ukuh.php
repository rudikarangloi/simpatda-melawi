<?php 
//require_once('application/libraries/pdf.php');
require_once('application/plugins/tcpdf/tcpdf.php');
class header_ukuh extends TCPDF {
	
	public function Header() {
		
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