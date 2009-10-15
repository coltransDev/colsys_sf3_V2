[{
	text:'Lineas',	
	leaf:false,
	children:[
		<?
		$k=0;
		foreach( $lineas as $linea ){           
			if( $k++!=0 ){
				echo ",";
			}
		?>
		{
			text:'<?=($linea['p_ca_sigla']?$linea['p_ca_sigla']." - ":"").$linea['id_ca_nombre']?>',
			id:'fleteslinea_<?=$impoexpo?>_<?=$transporte?>_<?=$modalidad?>_<?=$idtrafico?>_<?=$linea['p_ca_idproveedor']?>',
			leaf:true
		}
		<?
		}
		?>
	]
},
<?

?>
{
	text:'Ciudades',	
	leaf:false,
	children:[
		<?
		$k=0;
		foreach( $ciudades as $ciudad ){            
			if( $k++!=0 ){
				echo ",";
			}
		?>
		{
			text:'<?=$ciudad['c_ca_ciudad']?>',
			id:'fletesciudad_<?=$impoexpo?>_<?=$transporte?>_<?=$modalidad?>_<?=$idtrafico?>_<?=$ciudad['c_ca_idciudad']?>',
			leaf:true
		}
		<?
		}
		?>
	]
}
<?
if( count($ciudades)*count($lineas)<=16){ //Si se muestran muchos registros el browser se bloquea y se pone lento, especialmente IE
?>
,
{
	text:'Todas las Ciudades',
	id:'fletes_<?=$impoexpo."_".$transporte."_".$modalidad."_".$idtrafico?>',		
	leaf:true
}
<?
}
?>
,
{
	text:'Recargos por Ciudad',
	id:'recgen_<?=$impoexpo."_".$transporte."_".$modalidad."_".$idtrafico?>',		
	leaf:true
}

<?
if( $transporte==Constantes::MARITIMO ){ 
	$linea = "Naviera";
}elseif( $transporte==Constantes::AEREO ){
	$linea = "Aerolínea";
}else{
	$linea =  "linea";
}
?>

,
{
	text:'Recargos por <?=$linea?>',
	id:'reclin_<?=$impoexpo."_".$transporte."_".$modalidad."_".$idtrafico?>',		
	leaf:true
}
,
{
	text:'Trayectos (T.T., Freq.)',
	id:'admtraf_<?=$impoexpo."_".$transporte."_".$modalidad."_".$idtrafico?>',		
	leaf:true
},
{
	text:'Itinerarios',
	id:'itiner_<?=$impoexpo."_".$transporte."_".$modalidad."_".$idtrafico?>',
	leaf:true
},
{
	text:'Archivos del pais',
	id:'files_<?=$impoexpo."_".$transporte."_".$modalidad."_".$idtrafico?>',		
	leaf:true
}	
]
<?
exit;
?>
					