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
			leaf:true,
            opcion: 'fleteslinea',
            trafico: '<?=$trafico->getCaNombre()?>',
            impoexpo: '<?=$impoexpo?>',
            transporte: '<?=$transporte?>',
            modalidad: '<?=$modalidad?>',
            idtrafico: '<?=$idtrafico?>',
            idlinea: '<?=$linea['p_ca_idproveedor']?>'
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
			leaf:true,
            opcion: 'fletesciudad',
            trafico: '<?=$trafico->getCaNombre()?>',
            impoexpo: '<?=$impoexpo?>',
            transporte: '<?=$transporte?>',
            modalidad: '<?=$modalidad?>',
            idtrafico: '<?=$idtrafico?>',
            idciudad: '<?=$ciudad['c_ca_idciudad']?>'
           
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
    leaf:true,
    opcion: 'fletes',
    trafico: '<?=$trafico->getCaNombre()?>',
    impoexpo: '<?=$impoexpo?>',
    transporte: '<?=$transporte?>',
    modalidad: '<?=$modalidad?>',
    idtrafico: '<?=$idtrafico?>'
}
<?
}
?>
,
{
	text:'Recargos por Ciudad',	
	leaf:true,
    opcion: 'recgen',
    trafico: '<?=$trafico->getCaNombre()?>',
    impoexpo: '<?=$impoexpo?>',
    transporte: '<?=$transporte?>',
    modalidad: '<?=$modalidad?>',
    idtrafico: '<?=$idtrafico?>'
    
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
	leaf:true,
    opcion: 'reclin',
    trafico: '<?=$trafico->getCaNombre()?>',
    impoexpo: '<?=$impoexpo?>',
    transporte: '<?=$transporte?>',
    modalidad: '<?=$modalidad?>',
    idtrafico: '<?=$idtrafico?>'
}
,
{
	text:'Trayectos',	
	leaf:true,
    opcion: 'admtraf',
    trafico: '<?=$trafico->getCaNombre()?>',
    impoexpo: '<?=$impoexpo?>',
    transporte: '<?=$transporte?>',
    modalidad: '<?=$modalidad?>',
    idtrafico: '<?=$idtrafico?>'
},
{
	text:'Archivos del pais',	
	leaf:true,
    opcion: 'files',
    trafico: '<?=$trafico->getCaNombre()?>',
    impoexpo: '<?=$impoexpo?>',
    transporte: '<?=$transporte?>',
    modalidad: '<?=$modalidad?>',
    idtrafico: '<?=$idtrafico?>'
    
}	
]
<?
exit;
?>
					