

function statusLoading() {  
	
   ModalPopups.Indicator("idIndicator2",  
	"Please wait",  
	"<div style=''>" +   
	"<div style='float:left;'><img src='"+iBaseUrl+"/assets/modal/spinner.gif'></div>" +   
	"<div style='float:left; padding-left:10px;'>" +   
	"Permintaan Anda Sedang Diproses... <br/>" +   
	"Tunggu Beberapa Saat." +  
		"<p><a href='javascript:void(0)' onClick='statusEnding()'>Close</a></p>" + 
	"</div>",   
	{  
	    width: 300,  
	    height: 100  
	}  
    );
	      
    //setTimeout('ModalPopups.Close(\"idIndicator2\");', 3000);  
}

function statusEnding() {
	ModalPopups.Close("idIndicator2");
}
 
function refreshData() {
	grid.clearAll();
	grid.loadXML(iViewClass);
}

function simpanData() {
	//alert('....');
	//return;
	var ctlreq = document.frmData.ctl_req;
	for(var i=0;i<ctlreq.options.length;++i){
		if(document.getElementById(ctlreq.options[i].value).value==""){
			alert(ctlreq.options[i].innerHTML + ' Tidak Boleh Kosong!!!');
			return;
		}
	}
	
	var postStr = "id=" + document.frmData.id.value;
	
	for (var i = 0; i < document.forms[0].elements.length; i++){
		element = document.forms[0].elements[i];
		if(element.name.substr(0,3)=="txt"){
			postStr = postStr + "&" + element.name + "=" + element.value;
		}
	}
	
	statusLoading();
	
	dhtmlxAjax.post(iSaveClass, postStr, responePOST);
	
}

function deleteData(iID) {
		if(document.frmData.id.value!=""){
			confrm = confirm("Apakah Anda Yakin");
			if(confrm) {
				var postStr = "id=" + iID;
				statusLoading(iBaseUrl);
				dhtmlxAjax.post(iDelClass, postStr, responePOST);	
			}
		}
		
	}

function responePOST(loader) {
	if (loader.xmlDoc.readyState == 4) {
		if (loader.xmlDoc.status == 200) {
			result = loader.xmlDoc.responseText;
			if(result) {			
				kosongfrmData();
				refreshData();
				statusEnding();
				toggleButton('btndel');
				alert("Done");
				return true;	
			}
		} else {
			alert(loader.xmlDoc.responseText);
			//alert('There was a problem with the request.');
		}
	}
}

function getDataNPWPD(iNPWPD){
	var postStr='id='+iNPWPD;
	statusLoading();
	dhtmlxAjax.post(iGetNPWPDClass, postStr, responePOST2);
}

function getKelas(iNPWPD){
	
	var postStr='id='+iNPWPD;
	statusLoading();
	dhtmlxAjax.post(iGetKelasClass, postStr, responePOST2);
}


function responePOST2(loader) {
	if (loader.xmlDoc.readyState == 4) {
		if (loader.xmlDoc.status == 200) {
			result = loader.xmlDoc.responseText;
			alert(result);
			if(result!="") {			
				eval(result);	
			}
			statusEnding();
			return true;
		} else {
			alert(loader.xmlDoc.status);
			//alert('There was a problem with the request.');
		}
	}
}

function kosongfrmData() {
	document.frmData.id.value='';
	for (var i = 0; i < document.forms[0].elements.length; i++){
		element = document.forms[0].elements[i];
		if(element.name.substr(0,3)=="txt" && element.name!="txtnosptpd_b"){
			element.value='';
		}
	}
}	
	
function toggleButton(iBtn) {
	if(!document.getElementById(iBtn).disabled){
		document.getElementById(iBtn).disabled = true;
	}else{
		document.getElementById(iBtn).disabled = false;
	}
}

function disableButton() {
	document.frmData.btndel.disabled = true;
}

function AddLeadingZero(currentField)
{
	
	//Check if the value length hasn't reach its max length yet
	if (currentField.value.length != currentField.maxLength)
	{
		//Add leading zero(s) in front of the value
		var numToAdd = currentField.maxLength - currentField.value.length;
		var value ="";
		for (var i = 0; i < numToAdd;i++)
		{
		value += "0";
		}
		currentField.value = value + currentField.value;
	}
}


function konversiTgl(iTgl){
	var thn = iTgl.substr(0,4);
	var bln = iTgl.substr(5,2);
	var tgl = iTgl.substr(8,2);
	return tgl + "/" + bln + "/" + thn;
}

function getTgl(iTgl, retType){
	var thn = iTgl.substr(0,4);
	var bln = iTgl.substr(5,2);
	var tgl = iTgl.substr(8,2);
	
	if(retType=="THN"){
		return thn;
	}
	if(retType=="BLN"){
		return bln;
	}
	if(retType=="TGL"){
		return tgl;
	}
}

function getLastDate(iThn, iBln1, iBln2, iTgl1, iTgl2){		
	
	var iThnVal		= document.getElementById(iThn).value;
	var iBln1Val	= document.getElementById(iBln1).value;		
	var iBln2Val	= document.getElementById(iBln2).value;
	
	if(iBln2Val<iBln1Val){
		iBln2Val = iBln1Val;
		document.getElementById(iBln2).value=iBln2Val;
	}
	
	var lastDate = new Date(iThnVal, iBln2Val, 0);
	var lastDateDay = lastDate.getDate();
	
	document.getElementById(iTgl1).value = '01/' + iBln1Val + '/' + iThnVal;
	document.getElementById(iTgl2).value = lastDateDay + '/' + iBln2Val + '/' + iThnVal;	
}

function setRadioChecked(iCtlID, iVal, iDescending){

	if(iDescending=="1"){
		var objlength=iCtlID.length-1;
		for(var i=objlength;i>-1;i--){	
			if(i==iVal){
				iCtlID[i].checked=true;	
			}else{
				iCtlID[i].checked=false;		
			}
		}
	}else{
		for(var i=0;i<iCtlID.length;i++){	
			if(i==iVal){
				iCtlID[i].checked=true;	
			}else{
				iCtlID[i].checked=false;		
			}
		}
	}
}


