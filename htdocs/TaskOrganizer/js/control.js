function createAjaxObj(){
	var httprequest=false;
	if (window.XMLHttpRequest){ // if Mozilla, Safari etc
		httprequest=new XMLHttpRequest();
		if (httprequest.overrideMimeType)
		httprequest.overrideMimeType('text/xml');
	}
	else if (window.ActiveXObject){ // if IE
		try {
			httprequest=new ActiveXObject("Msxml2.XMLHTTP");
		} 
		catch (e){
			try{
				httprequest=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){}
		}
	}
	return httprequest;
}

function isChecked(elm){
	if(elm.checked){
		return true;
	} else {
		return false;
	}
}

function descOrder(desc){
	if(desc==true){window.location.assign('list.php');}
	if(desc==false){window.location.assign('list.php?descOrder=false');}
}