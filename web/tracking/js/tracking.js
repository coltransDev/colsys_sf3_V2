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