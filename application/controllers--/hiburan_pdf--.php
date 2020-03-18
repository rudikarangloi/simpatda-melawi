<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class hiburan_pdf extends MY_Controller {
	
	function __Construct() {
		parent::__Construct();
	}
	
	public function index() {
		
		$arr = "cetak";
		//setting pdf
		$this->load->library('header/hiburan');
		$pdf = new hiburan('P', 'pt', 'A4', true, 'UTF-8', false); 
			
		//set info
		$pdf->SetTitle('Report_'.$arr);
	
		// set informasi dokumen
		$pdf->SetSubject('SOPD_PADANG');
		$pdf->SetKeywords('SOPD_PADANG');
	
		//set no header & footer
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(false);
		$pdf->SetHeaderMargin(50);
		$pdf->SetMargins(10,104,10,10);
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
						PAJAK HIBURAN<br />
						Masa Pajak&nbsp;&nbsp;: ....................... s/d .......................<br />
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
							<tr>
								<td width="120">&nbsp;&nbsp;1. Nama Perusahaan</td>
								<td width="10" align="center">:</td>
								<td width="340">..............................................</td>
							</tr>
							<tr>
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
						<strong>DATA OBYEK PAJAK</strong>
					</td>
				</tr>
			</table>';
			
		$report .=
			'<table border="1">
				<tr>
				<td width="572">
				<table border="0">
<tr>
	<td colspan="3" height="10" width="572">&nbsp;</td>
</tr>
				<tr>
					<td width="150">&nbsp;&nbsp;1. Hiburan yang Diselenggarakan</td>
					<td width="10" align="center">:</td>
					<td width="100">.......................</td>
					<td width="170">&nbsp;&nbsp;3. Jumlah Pertunjukan Pada Hari Biasa</td>
					<td width="10" align="center">:</td>
					<td width="170">....................... Kali</td>
				</tr>
				<tr>
					<td width="150">&nbsp;&nbsp;2. Harga Tiket yang Berlaku</td>
					<td width="10" align="center"></td>
					<td width="100"></td>
					<td width="170">&nbsp;&nbsp;4. Jumlah Pertunjukan Pada Hari Libur</td>
					<td width="10" align="center">:</td>
					<td width="170">....................... Kali</td>
				</tr>
				<tr>
					<td width="150">&nbsp;&nbsp;&nbsp;&nbsp; - Kelas &nbsp;&nbsp;.......................</td>
					<td width="10" align="center">:</td>
					<td width="100">Rp. .......................</td>
					<td width="170">&nbsp;&nbsp;5. Jumlah Pengunjung pada Hari Biasa</td>
					<td width="10" align="center">:</td>
					<td width="170">....................... Orang</td>
				</tr>
				<tr>
					<td width="150">&nbsp;&nbsp;&nbsp;&nbsp; - Kelas &nbsp;&nbsp;.......................</td>
					<td width="10" align="center">:</td>
					<td width="100">Rp. .......................</td>
					<td width="170">&nbsp;&nbsp;6. Jumlah Pengunjung pada Hari Libur</td>
					<td width="10" align="center">:</td>
					<td width="170">....................... Orang</td>
				</tr>
				<tr>
					<td width="150">&nbsp;&nbsp;&nbsp;&nbsp; - Kelas &nbsp;&nbsp;.......................</td>
					<td width="10" align="center">:</td>
					<td width="100">Rp. .......................</td>
					<td width="170">&nbsp;&nbsp;7. Jumlah Meja/Mesin</td>
					<td width="10" align="center">:</td>
					<td width="170">....................... Meja/Mesin</td>
				</tr>
				<tr>
					<td width="150">&nbsp;&nbsp;&nbsp;&nbsp; - Kelas &nbsp;&nbsp;.......................</td>
					<td width="10" align="center">:</td>
					<td width="100">Rp. .......................</td>
					<td width="170">&nbsp;&nbsp;8. Jumlah Kamar/Ruangan</td>
					<td width="10" align="center">:</td>
					<td width="170">....................... Kamar/Ruangan</td>
				</tr>
				<tr>
					<td width="150">&nbsp;&nbsp;&nbsp;&nbsp; - Kelas &nbsp;&nbsp;.......................</td>
					<td width="10" align="center">:</td>
					<td width="100">Rp. .......................</td>
					<td width="170">&nbsp;&nbsp;</td>
					<td width="10" align="center">&nbsp;&nbsp;</td>
					<td width="170">&nbsp;&nbsp;</td>
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
						<strong>DATA PAJAK HIBURAN</strong>
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
							<tr>
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
							<tr>
								<td width="20"></td>
								<td width="11">b.</td>
								<td width="232">Dasar Pengenaan (Jumlah pembayaran yang diterima)</td>
								<td width="8">:</td>
								<td width="282">Rp. ..............................................</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">c.</td>
								<td width="232">Tarif Pajak (sesuai perda)</td>
								<td width="8">:</td>
								<td width="282">..............................................</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">d.</td>
								<td width="232">Pajak Terhutang (b x c)</td>
								<td width="8">:</td>
								<td width="282">Rp. ..............................................</td>
							</tr>
							<tr>
								<td width="20">&nbsp;&nbsp;2.</td>
								<td colspan="4">Jumlah pembayaran dan pajak terhutang untuk masa pajak sekarang (lampirkan foto copy dokumen):</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">a.</td>
								<td width="232">Masa Pajak</td>
								<td width="8">:</td>
								<td width="282">.............................................. s/d ..............................................</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">b.</td>
								<td width="232">Dasar Pengenaan (Jumlah pembayaran yang diterima)</td>
								<td width="8">:</td>
								<td width="282">Rp. ..............................................</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">c.</td>
								<td width="232">Tarif Pajak (sesuai perda)</td>
								<td width="8">:</td>
								<td width="282">..............................................</td>
							</tr>
							<tr>
								<td width="20"></td>
								<td width="11">d.</td>
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
				<tr>
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
							<td>
							<table border="0">
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center">Meulaboh, ..............................................</td>
								</tr>
								<tr>
									<td width="572" height="50">&nbsp;</td>
								</tr>
								<tr>
									<td width="372">&nbsp;</td>
									<td width="200" align="center"></td>
								</tr>
								<tr>
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
					<tr>
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;Diterima tanggal </td>
                            <td width="3%">:</td>
                            <td width="61%">..............................................</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">Meulaboh, ..............................................</td>
					</tr>
					<tr>
						<td width="372"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="30%">&nbsp;&nbsp;Nama Petugas </td>
                            <td width="3%">:</td>
                            <td width="61%">..............................................</td>
                          </tr>
                        </table></td>
						<td width="200" align="center">&nbsp;</td>
					</tr>
					<tr>
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