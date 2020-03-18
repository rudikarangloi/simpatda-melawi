<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class hotel_pdf extends MY_Controller {
	
	function __construct() {
            parent::__construct();
            $this->load->model('msistem');
    }
	
	public function index(){
	
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/sptpd1');
		$pdf = new sptpd1('P', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_JAMBI');
		$pdf->SetKeywords('SOPD_JAMBI');
	
		//set no header & footer
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(60);
		$pdf->SetMargins(10,114,10,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 10);
	
		$pdf->AddPage('P','A4',false);
		//set data
		$report = '';		
		$report .=
			'<br/><table border=1>
				<tr>
					<td width="572">
						<table border="0">
<tr>
	<td colspan="3" height="10">&nbsp;</td>
<br/></tr>
							<tr height="10" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;1. Nama Usaha</td>
								<td width="10" align="center">:</td>
								<td width="340">..............................................</td>
							</tr>
							<tr height="10" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;2. N.P.W.P.D</td>
								<td width="10" align="center">:</td>
								<td width="340">..............................................</td>
							</tr>
							<tr height="10" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;3. Nama Pemilik</td>
								<td width="10" align="center">:</td>
								<td width="340">..............................................</td>
							</tr>
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>	
						</table>
					</td>
				</tr>
			</table>';
			
		$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>DATA OBJEK PAJAK</strong>
					</td>
				</tr>
			</table>';
			
		$report .=
			'<table border=1>
				<tr>
					<td width="572">
						<table border="0">
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>
							<tr height="10" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;1. Kode Rekening</td>
								<td width="10" align="center">:</td>
								<td width="340">..............................................</td>
							</tr>
							<tr height="10" style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="120">&nbsp;&nbsp;2. Nama Rekening</td>
								<td width="10" align="center">:</td>
								<td width="340">..............................................</td>
							</tr>
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>	
						</table>
					</td>
				</tr>
			</table>';	
		
		$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>DATA PAJAK HOTEL</strong>
					</td>
				</tr>
			</table>';
		
		$report .=
			'<table border=1>
				<tr>
					<td width="572">
						<table>
<tr>
	<td colspan="5" height="10">&nbsp;</td>
</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20">&nbsp;&nbsp;1.</td>
								<td colspan="4" width="550">Jumlah pembayaran dan pajak terhutang untuk masa pajak sebelumnya (akumulasi dari awal masa pajak dalam tahun pajak tertentu):</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">a.</td>
								<td width="232">Masa Pajak</td>
								<td width="8">:</td>
								<td width="282"> .............................................. s/d .............................................. </td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">b.</td>
								<td width="232">Dasar Pengenaan (Jumlah pembayaran yang diterima)</td>
								<td width="8">:</td>
								<td width="282">Rp. ..............................................</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">c.</td>
								<td width="232">Tarif Pajak (sesuai perda)</td>
								<td width="8">:</td>
								<td width="282">..............................................</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">d.</td>
								<td width="232">Pajak Terhutang (b x c)</td>
								<td width="8">:</td>
								<td width="282">Rp. ..............................................</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20">&nbsp;&nbsp;2.</td>
								<td colspan="4">Jumlah pembayaran dan pajak terhutang untuk masa pajak sekarang (lampirkan foto copy dokumen):</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">a.</td>
								<td width="232">Masa Pajak</td>
								<td width="8">:</td>
								<td width="282">.............................................. s/d ..............................................</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">b.</td>
								<td width="232">Keterangan Jumlah Hunian/Bulanan</td>
								<td width="8">:</td>
								<td width="282">Rp. ..............................................</td>
							</tr>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">c.</td>
								<td width="232">Dasar Pengenaan (Jumlah pembayaran yang diterima)</td>
								<td width="8">:</td>
								<td width="282">Rp. ..............................................</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">d.</td>
								<td width="232">Tarif Pajak (sesuai perda)</td>
								<td width="8">:</td>
								<td width="282">..............................................</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
								<td width="20"></td>
								<td width="11">e.</td>
								<td width="232">Pajak Terhutang (b x c)</td>
								<td width="8">:</td>
								<td width="282">Rp. ..............................................</td>
							</tr>
<tr>
	<td colspan="5" height="10">&nbsp;</td>
</tr>

						</table>	
					</td>
				</tr>
			</table>';
			
		$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>PERNYATAAN</strong>
					</td>
				</tr>
			</table>';
			
			$report .=
			'
			<table border="1">
			<tr><td width="572">
			<table border=0>
<tr>
	<td height="10">&nbsp;</td>
</tr>
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
					<td width="5">&nbsp;</td>
					<td width="562">
						<div align="justify">Dengan menyadari sepenuhnya akan segala akibat termasuk sanksi-sanksi sesuai dengan ketentuan perundang-undangan yang berlaku. Saya atau yang saya beri kuasa menyatakan bahwa apa yang telah kami beritahukan diatas beserta lampiran-lampirannya adalah benar, lengkap dan jelas.					    				
					  </div>
					  </td>
					 <td width="5">&nbsp;</td>
				</tr>
				<tr>
					<td width="572" colspan="3">
						<table border="0">
<tr>
	<td height="10">&nbsp;</td>
</tr>
							<tr>
							<td>
							<table border="0">
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
									<td width="372">&nbsp;</td>
									<td width="200" align="center">Jambi, ..............................................<br/>Nama Pemilik / Wajib Pajak</td>
								</tr>
								<tr>
									<td width="572" height="50">&nbsp;</td>
								</tr>
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center">(                                                    )</td>
								</tr>
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center">&nbsp;&nbsp;&nbsp;</td>
								</tr>
						</table>
						</td>
						</tr>
					</table>
					</td>
				</tr>
			</table>
			</td></tr>
			</table>';						
			
			$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>PETUGAS PENERIMA</strong>
					</td>
				</tr>
			</table>';
			
		$report .=
			'<table border="1">
				<tr>
				<td width="572">
				<table border="0">
<tr>
	<td height="10">&nbsp;</td>
</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;Diterima tanggal </td>
                            <td width="3%">:</td>
                            <td width="61%">..............................................</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">Petugas</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;Nama Petugas </td>
                            <td width="3%">: </td>
                            <td width="61%">..............................................</td>
                          </tr>
                        </table></td>

						<td width="200" align="center">&nbsp;</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:10px">
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;NIP</td>
                            <td width="3%">:</td>
                            <td width="61%">..............................................</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">&nbsp;</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center"></td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">(                                                      )</td>
					</tr>
					<tr>
						<td width="372">&nbsp;</td>
						<td width="200" align="center">&nbsp;</td>
					</tr>
				</table>
				</td>
				</tr>
			</table>';
		
		//$pdf->writeHTML($report, true, 0, true, 0);
		$pdf->writeHTML($report, true, false, true, false);
		$pdf->lastPage();
		$pdf->Output('Report_SPTPD'.'.pdf', 'I');
	
	}
}
?>