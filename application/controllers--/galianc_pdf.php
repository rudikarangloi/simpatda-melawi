<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class galianc_pdf extends MY_Controller {
	
	function __Construct() {
		parent::__Construct();
	}
	
	public function index() {
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/galianc1');
		$pdf = new galianc1('P', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_PADANG');
		$pdf->SetKeywords('SOPD_PADANG');
	
		//set no header & footer
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(10);
		$pdf->SetMargins(10,79,10,10);
		// set font yang digunakan
		$pdf->SetFont('times', '', 10);
	
		$pdf->AddPage('P','A4',false);
		//set data
		$report = '';
		/*$report .=
			'<table border=1>
				<tr>
					<td width="230" align="center">
						PEMERINTAH KABUPATEN ACEH BARAT<br />
						DINAS PENGELOLAAN KEUANGAN DAN KEKAYAAN DAERAH<br />
						Jalan Gajah Mada Telp (0655) 7006013<br />
						Fax (0655)7551162,7551165<br />
						MEULABOH
					</td>
					<td width="230" align="center">
						SURAT PEMBERITAHUAN PAJAK DAERAH<br />
						PAJAK MINERAL BUKAN LOGAM DAN BATUAN<br />
						Masa Pajak : ....................... s/d .......................<br />
						Tahun : .......................
					</td>
					<td width="112" align="center">
						<br /><br />
						No. SPTPD<br />
						.......................
					</td>
				</tr>
			</table>';*/
		$report .=
			'<table border=1>
				<tr>
					<td width="572">
						<table border="0">
<tr>
	<td colspan="3" height="10">&nbsp;</td>
</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="120">&nbsp;&nbsp;1. Nama Perusahaan</td>
								<td width="10" align="center">:</td>
								<td width="340">..............................................</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="120">&nbsp;&nbsp;2. N.P.W.P.D</td>
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
						<table>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="10">&nbsp;&nbsp;</td>
								<td colspan="3"><br/><br/>
								<table border="1">
									<tr>
										<th width="150" align="center"><strong>Nama Objek</strong></th>
										<th width="50" align="center"><strong>Volume</strong></th>
										<th width="100" align="center"><strong>Harga Pasar</strong></th>
										<th width="100" align="center"><strong>Dasar Pengenaan</strong></th>
										<th width="50" align="center"><strong>Tarif</strong></th>
										<th width="100" align="center"><strong>Jumlah</strong></th>
									</tr>
									<tr>
										<td width="150">&nbsp;.......................</td>
										<td width="50">&nbsp; .............</td>
										<td width="100">&nbsp;Rp. .......................</td>
										<td width="100">&nbsp;Rp. .......................</td>
										<td width="50">&nbsp; .............</td>
										<td width="100">&nbsp;Rp. .......................</td>
									</tr>
									<tr>
										<td width="150">&nbsp;.......................</td>
										<td width="50">&nbsp; .............</td>
										<td width="100">&nbsp;Rp. .......................</td>
										<td width="100">&nbsp;Rp. .......................</td>
										<td width="50">&nbsp; .............</td>
										<td width="100">&nbsp;Rp. .......................</td>
									</tr>
									<tr>
										<td width="150">&nbsp;.......................</td>
										<td width="50">&nbsp; .............</td>
										<td width="100">&nbsp;Rp. .......................</td>
										<td width="100">&nbsp;Rp. .......................</td>
										<td width="50">&nbsp; .............</td>
										<td width="100">&nbsp;Rp. .......................</td>
									</tr>
									<tr>
										<td width="150">&nbsp;.......................</td>
										<td width="50">&nbsp; .............</td>
										<td width="100">&nbsp;Rp. .......................</td>
										<td width="100">&nbsp;Rp. .......................</td>
										<td width="50">&nbsp; .............</td>
										<td width="100">&nbsp;Rp. .......................</td>
									</tr>
									<tr>
										<td width="150">&nbsp;.......................</td>
										<td width="50">&nbsp; .............</td>
										<td width="100">&nbsp;Rp. .......................</td>
										<td width="100">&nbsp;Rp. .......................</td>
										<td width="50">&nbsp; .............</td>
										<td width="100">&nbsp;Rp. .......................</td>
									</tr>
									<tr>
										<td width="150">&nbsp;.......................</td>
										<td width="50">&nbsp; .............</td>
										<td width="100">&nbsp;Rp. .......................</td>
										<td width="100">&nbsp;Rp. .......................</td>
										<td width="50">&nbsp; .............</td>
										<td width="100">&nbsp;Rp. .......................</td>
									</tr>
									<tr>
										<td width="150" align="center"><strong>Jumlah</strong></td>
										<td width="50">&nbsp; .............</td>
										<td width="100">&nbsp;Rp. .......................</td>
										<td width="100">&nbsp;Rp. .......................</td>
										<td width="50">&nbsp; .............</td>
										<td width="100">&nbsp;Rp. .......................</td>
									</tr>
								</table><br/>
								</td>
								<td width="20">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>';
		
		$report .=
			'<table border=1>
				<tr>
					<td width="572" align="center">
						<strong>DATA PAJAK MINERAL BUKAN LOGAM DAN BATUAN</strong>
					</td>
				</tr>
			</table>';
		
		$report .=
			'<table border=1>
				<tr>
					<td width="572">
						<table>
<tr>
	<td colspan="2" height="10">&nbsp;</td>
</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="20">&nbsp;&nbsp;1.</td>
								<td colspan="4" width="550">Jumlah pembayaran dan pajak terhutang untuk masa pajak sebelumnya (akumulasi dari awal masa pajak dalam tahun pajak tertentu):</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">a.</td>
								<td width="232">Masa Pajak</td>
								<td width="8">:</td>
								<td width="282">.............................................. s/d ..............................................</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="20"></td>
								<td width="11">b.</td>
								<td width="232">Dasar Pengenaan (Jumlah pembayaran yang diterima)</td>
								<td width="8">:</td>
								<td width="282">Rp. ..............................................</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="20"></td>
								<td width="11">c.</td>
								<td width="232">Tarif Pajak (sesuai perda)</td>
								<td width="8">:</td>
								<td width="282">..............................................</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="20"></td>
								<td width="11">d.</td>
								<td width="232">Pajak Terhutang (b x c)</td>
								<td width="8">:</td>
								<td width="282">Rp. ..............................................</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="20">&nbsp;&nbsp;2.</td>
								<td colspan="4">Jumlah pembayaran dan pajak terhutang untuk masa pajak sekarang (lampirkan foto copy dokumen):</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="20"></td>
								<td width="11">a.</td>
								<td width="232">Masa Pajak</td>
								<td width="8">:</td>
								<td width="282">.............................................. s/d ..............................................</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="20"></td>
								<td width="11">b.</td>
								<td width="232">Dasar Pengenaan (Jumlah pembayaran yang diterima)</td>
								<td width="8">:</td>
								<td width="282">Rp...............................................</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="20"></td>
								<td width="11">c.</td>
								<td width="232">Tarif Pajak (sesuai perda)</td>
								<td width="8">:</td>
								<td width="282">..............................................</td>
							</tr>
							<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
								<td width="20"></td>
								<td width="11">d.</td>
								<td width="232">Pajak Terhutang (b x c)</td>
								<td width="8">:</td>
								<td width="282">Rp. ..............................................</td>
							</tr>
<tr>
	<td colspan="2" height="10">&nbsp;</td>
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
				<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
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
							<td width="572">
							<table border="0">
<tr>
	<td height="10">&nbsp;</td>
</tr>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
									<td width="372">&nbsp;</td>
									<td width="200" align="center">Jambi, ..............................................</td>
								</tr>
								<tr>
									<td width="572" height="50">&nbsp;</td>
								</tr>
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center"></td>
								</tr>
								<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
									<td width="372">&nbsp;</td>
									<td width="200" align="center">( Nama Pemilik / Wajib Pajak )</td>
								</tr>
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center"></td>
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
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;Diterima tanggal </td>
                            <td width="3%">:</td>
                            <td width="61%">..............................................</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">Jambi, ..............................................</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;Nama Petugas </td>
                            <td width="3%">:</td>
                            <td width="61%">..............................................</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">&nbsp;</td>
					</tr>
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
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
					<tr style="font-family: Arial,Helvetica Neue,Helvetica,sans-serif; font-weight:bold; font-size:9px">
						<td width="372">&nbsp;</td>
						<td width="200" align="center">( Nama Petugas )</td>
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