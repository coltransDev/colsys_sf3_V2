<?
/*
* cuadro de seleccion de las ciudades
*/
use_helper("Object");

if( !$selected && count($ciudades)>0 ){
	$selected = $ciudades[0]->getId();
}

echo select_tag($fieldName , objects_for_select( $ciudades, "getId", "getCaCiudad" , $selected), "onChange=seleccionAgente()" );

?>