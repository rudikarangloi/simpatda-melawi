<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript">
	function setLaporan(jenis){
		
		if(jenis == "harian"){
			document.getElementById("tanggal").disabled = false;
			document.getElementById("bulan").disabled = false;
			document.getElementById("tahun").disabled = false;
			document.getElementById("tanggal").value = "";
			document.getElementById("bulan").value = "";
			document.getElementById("tahun").value = "";
		}
		else if(jenis == "bulanan"){
			document.getElementById("tanggal").disabled = true;
			document.getElementById("bulan").disabled = false;
			document.getElementById("tahun").disabled = false;
			document.getElementById("tanggal").value = "";
			document.getElementById("bulan").value = "";
			document.getElementById("tahun").value = "";
			
		}else{
			document.getElementById("tanggal").disabled = true;
			document.getElementById("bulan").disabled = true;
			document.getElementById("tahun").disabled = false;
			document.getElementById("tanggal").value = "";
			document.getElementById("bulan").value = "";
			document.getElementById("tahun").value = "";
		}
	}
	function validasiForm(ekoForm){
			  var reason = "";
			  
			  reason += validasiJenis(ekoForm.jenis);
			  if(reason != ""){
				  alert("Kesalahan Input data pada : \n\n" + reason);
				  return false;
			  }
			  
			  if(document.getElementById("tanggal").disabled == false){
			  	reason += validasiTanggal(ekoForm.tanggal);
				reason += validasiBulan(ekoForm.bulan);
				reason += validasiTahun(ekoForm.tahun);

			  	if(reason != ""){
					alert("Kesalahan Input data pada : \n\n" + reason);
					return false;
			  	}
			  } 
			  else if(document.getElementById("bulan").disabled == false){
					reason += validasiBulan(ekoForm.bulan);
					reason += validasiTahun(ekoForm.tahun);

			  	if(reason != ""){
					alert("Kesalahan Input data pada : \n\n" + reason);
					return false;
			  	}
			  } 
			  else if(document.getElementById("tahun").disabled == false){
					reason += validasiTahun(ekoForm.tahun);

			  	if(reason != ""){
					alert("Kesalahan Input data pada : \n\n" + reason);
					return false;
			  	}	
			  }else{
			  		alert("Anda belum memilih bentuk laporan");
					return false;
			  }
			  return true;
	}
	function validasiTanggal(eko){
			  var error = "";
			  var panjangJudul = eko.value;
				  if(eko.value==""){
					eko.style.background = '#FFFFFF';
					error = "Tanggal belum Anda masukan ! \n";
				  }else{
					eko.style.background = 'white';
				  }
			  return error;
	}
	function validasiBulan(eko){
			  var error = "";
			  var panjangJudul = eko.value;
				  if(eko.value==""){
					eko.style.background = '#FFFFFF';
					error = "Bulan belum Anda masukan ! \n";
				  }else{
					eko.style.background = 'white';
				  }
			  return error;
	}
	function validasiTahun(eko){
			  var error = "";
			  var panjangJudul = eko.value;
				  if(eko.value==""){
					eko.style.background = '#FFFFFF';
					error = "Tahun belum Anda masukan ! \n";
				  }else{
					eko.style.background = 'white';
				  }
			  return error;
	}
	function validasiJenis(eko){
			  var error = "";
			  var panjangJudul = eko.value;
				  if(eko.value==""){
					eko.style.background = '#FFFFFF';
					error = "Jenis Pajak belum Anda masukan ! \n";
				  }else{
					eko.style.background = 'white';
				  }
			  return error;
	}
</script>
</head>

<body>
	<h3>Laporan Pajak<hr /></h3>
	<form id="frm_laporan" action="cek_report" method="post" onSubmit="return validasiForm(this)">
	<table>
		<tr>
			<td>Jenis Pajak</td>
			<td>:</td>
			<td>
			<select name="jenis" id="jenis">
				<option value=""></option>
				<option value="HTL">Hotel</option>
				<option value="RES">Restoran</option>
				<option value="REK">Reklame</option>
				<option value="HIB">Hiburan</option>
				<option value="LIS">Penerangan Jalan</option>
				<option value="GAL">Mineral Bukan Logam</option>
				<option value="WLT">Burung Walet</option>
				<option value="PKR">Parkir</option>
				<option value="AIR">Air Bawah Tanah</option>
			</select>
			</td>
		</tr>
		<tr>
			<td>Laporan</td>
			<td>:</td>
			<td>		
			    <p>
			      <label>
			        <input type="radio" name="RadioGroup1" value="harian" id="RadioGroup1" onclick="setLaporan(this.value)"/>
			        Harian</label>
			      <br />
			      <label>
			        <input type="radio" name="RadioGroup1" value="bulanan" id="RadioGroup1" onclick="setLaporan(this.value)"/>
			        Bulanan</label>
			      <br />
			      <label>
			        <input type="radio" name="RadioGroup1" value="tahunan" id="RadioGroup1" onclick="setLaporan(this.value)"/>
			        Tahunan</label>
			      <br />
	        </p></td>
		</tr>
		<tr>
			<td><td>
			<td>
				<select name="tanggal" disabled="disabled" id="tanggal">
					<option value=""></option>
					<option value="01">1</option>
					<option value="02">2</option>
					<option value="03">3</option>
					<option value="04">4</option>
					<option value="05">5</option>
					<option value="06">6</option>
					<option value="08">8</option>
					<option value="09">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
				</select>
				<select name="bulan" disabled="disabled" id="bulan">
					<option value=""></option>
					<option value="01">Januari</option>
					<option value="02">Februari</option>
					<option value="03">Maret</option>
					<option value="04">April</option>
					<option value="05">Mei</option>
					<option value="06">Juni</option>
					<option value="07">Juli</option>
					<option value="08">Agustus</option>
					<option value="09">September</option>
					<option value="10">Oktober</option>
					<option value="11">November</option>
					<option value="12">Desember</option>
				</select>
				<select name="tahun" disabled="disabled" id="tahun">
					<option value=""></option>
					<option value="2010">2010</option>
					<option value="2011">2011</option>
					<option value="2012">2012</option>
					<option value="2013">2013</option>
					<option value="2014">2014</option>
					<option value="2015">2015</option>
					<option value="2016">2016</option>
				</select>
				<input type="submit" value="submit">
			</td>
		</tr>
	</table>
	</form>
</body>
</html>