// JavaScript Document
// perhitungan pajak reklame
//
//var p		= document.getElementById("panjang").value;
//var l		= document.getElementById("lebar");
//var m		= document.getElementById("muka");
//var j		= document.getElementById("jari2");
//var jml		= document.getElementById("jumlah");
//var hari	= document.getElementById("jangka_waktu");
//
//var hd	= document.getElementById("harga_dasar");
//var tk	= document.getElementById("tarif_kawasan");

function hitungPajak(R,p,l,m,j,jml,hari,hd,tk){
	switch(R){
			case "R1" :
				var dasar = hd*tk*p*l*m*hari*jml;
			break;
			case "R2" :
				var dasar = hd*tk*jml;
			break;
			case "R3" :
				var dasar = p*l*m*hd*tk*hari*jml;
			break;
			case "R4" :
				var dasar = hd*tk*hari*jml;
			break;
			case "R5" :
				var dasar = hd*tk*jml*hari;
			break;
			case "R6" : // reklame tempel
				var dasar = hd*tk*jml*hari;
			break;
			case "R7" : // reklame papan dan billboard
				var dasar = hd*tk*p*l*m*hari*jml;
			break;
			case "R8" : //balon udara
				var dasar = hd*tk*j*hari*jml;
			break;
			case "R9" : //megatron dan videotron
				var dasar = hd*tk*p*l*m*hari*jml;
			break;
			case "R10" : //reklame berjalan
				var dasar = hd*tk*p*l*m*hari*jml;
			break;
			
	}
	document.frmData.dasar_pengenaan.value = dasar;	
	var nilaiPajak = (dasar*25)/100;
	document.frmData.nilai_pajak.value = nilaiPajak;
	return nilaiPajak;	
}

//function hitungR1(p,l,m,j,jml,hari,hd,tk){
//	case
//	var dasar = hd*tk*p*l*m*hari*jml;
//	document.frmData.dasar_pengenaan.value = dasar;	
//	var nilaiPajak = (dasar*25)/100;
//	document.frmData.nilai_pajak.value = nilaiPajak;
//	return nilaiPajak;
//}
//
//function hitungR2(p,l,m,j,jml,hari,hd,tk){
//	var dasar = hd*tk*jml;	
//	document.frmData.dasar_pengenaan.value = dasar;	
//	var nilaiPajak = (dasar*25)/100;
//	document.frmData.nilai_pajak.value = nilaiPajak;
//	return nilaiPajak;
//}