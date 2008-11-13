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
			text:'<?=$linea->getCaNombre()?>',
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
,
{
	text:'Todas las ciudades',
	id:'fletes_<?=$impoexpo."_".$transporte."_".$modalidad."_".$idtrafico?>',		
	leaf:true
},
{
	text:'Recargos generales',
	id:'recgen_<?=$impoexpo."_".$transporte."_".$modalidad."_".$idtrafico?>',		
	leaf:true
},
{
	text:'Tiempo de transito y frecuencia',
	id:'admtraf_<?=$impoexpo."_".$transporte."_".$modalidad."_".$idtrafico?>',		
	leaf:true
},
{
	text:'Archivos del trafico',
	id:'files_<?=$impoexpo."_".$transporte."_".$modalidad."_".$idtrafico?>',		
	leaf:true
}	
]
<?
exit;
?>
					