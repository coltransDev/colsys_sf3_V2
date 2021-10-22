/*
* Aumenta el numero de filas dinamicamente en un textarea
*/

function autoGrow( field ){
	var rows = field.value.split("\n").length;
	if(rows==0){
		rows=1;
	}
	field.rows=rows;		
}

function popup(url, width, height){
	
	var mine = window.open (url, "mywindow","menubar=0,location=0,resizable=1,status=1,scrollbars=1, width="+width+",height="+height);	
	
	if(mine){
		var popUpsBlocked = false;
	}
	else{
		var popUpsBlocked = true;
	}
	
	
	if(popUpsBlocked){
		alert('Usted tiene bloqueador de popups, consulte al administrador del sistema para continuar');
	}
	return popUpsBlocked;	
}