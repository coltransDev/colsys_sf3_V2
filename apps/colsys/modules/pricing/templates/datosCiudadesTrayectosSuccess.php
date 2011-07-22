<?
$ciudades = $sf_data->getRaw("ciudades");
?>
[{
	text:'Lineas',	
	leaf:false,
	children:[
		<?
		$k=0;
		foreach( $lineas as $linea=>$trayectos ){           
			if( $k++!=0 ){
				echo ",";
			}
            ?>
            {
            text:'<?=$linea?>',	
            leaf:false,
            children:[
                <?
                $w=0;
                
                
                foreach( $trayectos as $t ){
                    if( $w++==0 ){
                        ?>
                        {
                            text:'<?=count($trayectos)>1?"Todos los trayectos":$t['d_ca_ciudad']?>',
                            leaf:true,
                            opcion: 'fleteslinea',
                            trafico: '<?=$trafico->getCaNombre()?>',
                            impoexpo: '<?=$impoexpo?>',
                            transporte: '<?=$transporte?>',
                            modalidad: '<?=$modalidad?>',
                            idtrafico: '<?=$idtrafico?>',
                            idlinea: '<?=$t['p_ca_idproveedor']?>',
                            linea: '<?=$linea?>'
                        }
                        <?    
                    }
                    if( count($trayectos)>1 ){
                    ?>
                    ,
                    {
                        text:'<?=$t['d_ca_ciudad']?>',
                        leaf:true,
                        opcion: 'fleteslinea',
                        trafico: '<?=$trafico->getCaNombre()?>',
                        impoexpo: '<?=$impoexpo?>',
                        transporte: '<?=$transporte?>',
                        modalidad: '<?=$modalidad?>',
                        idtrafico: '<?=$idtrafico?>',
                        idlinea: '<?=$t['p_ca_idproveedor']?>',
                        linea: '<?=$linea?>',
                        idciudad2: '<?=$t['d_ca_idciudad']?>',
                        ciudad2: '<?=$t['d_ca_ciudad']?>'
                    }
                    <?
                    }
                }
                ?>
           ]}
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
		foreach( $ciudades as $name=>$trayectos ){               
			if( $k++!=0 ){
				echo ",";
			}
		?>
        {
            text:'<?=$name?>',	
            leaf:false,
            children:[
                <?
                $w=0;
                foreach( $trayectos as $t ){
                    if( $w++==0 ){
                        ?>
                        {
                            text:'<?=count($trayectos)==1?$t['d_ca_ciudad']:"Todos los trayectos"?>',			
                            leaf:true,
                            opcion: 'fletesciudad',
                            trafico: '<?=$trafico->getCaNombre()?>',
                            impoexpo: '<?=$impoexpo?>',
                            transporte: '<?=$transporte?>',
                            modalidad: '<?=$modalidad?>',
                            idtrafico: '<?=$idtrafico?>',
                            idciudad: '<?=$t['c_ca_idciudad']?>',                            
                            ciudad: '<?=$t['c_ca_ciudad']?>'
                            
                        }                   
                        <?
                        
                    }
                    if( count($trayectos)>1 ){    
                ?>
                ,
                {
                    text:'<?=$t['d_ca_ciudad']?>',			
                    leaf:true,
                    opcion: 'fletesciudad',
                    trafico: '<?=$trafico->getCaNombre()?>',
                    impoexpo: '<?=$impoexpo?>',
                    transporte: '<?=$transporte?>',
                    modalidad: '<?=$modalidad?>',
                    idtrafico: '<?=$idtrafico?>',
                    idciudad: '<?=$t['c_ca_idciudad']?>',                    
                    ciudad: '<?=$t['c_ca_ciudad']?>',
                    idciudad2: '<?=$t['d_ca_idciudad']?>',
                    ciudad2: '<?=$t['d_ca_ciudad']?>'
                }
                <?
                    }
                }
                ?>
            ]
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
					