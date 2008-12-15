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
			text:'<?=($linea->getCaSigla()?$linea->getCaSigla()." - ":"").$linea->getCaNombre()?>',
			id:'fleteslinea_<?=$impoexpo?>_<?=$transporte?>_<?=$modalidad?>_<?=$idtrafico?>_<?=$linea->getCaIdLinea()?>',		
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
			text:'<?=$ciudad->getCaCiudad()?>',
			id:'fletesciudad_<?=$impoexpo?>_<?=$transporte?>_<?=$modalidad?>_<?=$idtrafico?>_<?=$ciudad->getCaIdCiudad()?>',		
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
	text:'Todas las ciudades',
	id:'fletes_<?=$impoexpo."_".$transporte."_".$modalidad."_".$idtrafico?>',		
	leaf:true
}
<?
}
?>
,
{
	text:'Recargos generales',
	id:'recgen_<?=$impoexpo."_".$transporte."_".$modalidad."_".$idtrafico?>',		
	leaf:true
},
{
	text:'Trayectos (T.T., Freq.)',
	id:'admtraf_<?=$impoexpo."_".$transporte."_".$modalidad."_".$idtrafico?>',		
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
					