<?
/*
*cuadro de seleccion de los paises
*/

echo select_tag( $fieldName , objects_for_select( $traficos, "getId", "getCaNombre"  , $selected) );

echo observe_field( $fieldName, array("url"=>"general/seleccionCiudad", 
										 "update"=>"ciudad".$fieldName,
										 'with'     => "'trafico_id=' + value",
										'loading'  => visual_effect('appear', 'indicator'),
										'complete' => visual_effect('fade', 'indicator')."onChange=seleccionAgente();",
										) );

?>