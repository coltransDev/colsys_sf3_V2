[
<?
$i=0;
foreach( $results as $modalidad=>$grupos ){
	if( $i++!=0){
		echo ",";
	}
?>
	{
		text:'<?=$modalidad?>',	
		leaf:false,
        impoexpo: '<?=$impoexpo?>',
        transporte: '<?=$transporte?>',
        modalidad: '<?=$modalidad?>',

		children:[			
			{
				text:'Recargos locales',                
				leaf:true,
                opcion: 'recgen',
                impoexpo: '<?=$impoexpo?>',
                transporte: '<?=$transporte?>',
                modalidad: '<?=$modalidad?>',
                idtrafico: '99-999'

			},
			<?
			if( $transporte==Constantes::MARITIMO ){
                if( $transporte==Constantes::MARITIMO ){ 
                    $linea = "Naviera";
                }elseif( $transporte==Constantes::AEREO ){
                    $linea = "Aérolinea";
                }else{
                    $linea =  "linea";
                }
			?>
			{
				text:'Recargos locales x <?=$linea?>',                
				leaf:false,                
                impoexpo: '<?=$impoexpo?>',
                transporte: '<?=$transporte?>',
                modalidad: '<?=$modalidad?>',
				children:[
					<?
					$k=0;
					foreach( $lineas as $linea ){                       
                        if( $linea['t_ca_modalidad'] == $modalidad ){

						if( $k++!=0){
							echo ",";
						}	
                        ?>
                        {
                            text:'<?=$linea['p_ca_sigla']?$linea['p_ca_sigla']:$linea["id_ca_nombre"]?>',                            
                            leaf:true,
                            opcion: 'recnav',
                            impoexpo: '<?=$impoexpo?>',
                            transporte: '<?=$transporte?>',
                            modalidad: '<?=$modalidad?>',
                            idtrafico: '99-999',                            
                            idlinea: '<?=$linea["p_ca_idproveedor"]?>'

                        }
                        <?
                        }
					}				
					?>					
				]
			},			
			<?
            }
			
			$j=0;
			foreach( $grupos as $grupo=>$paises){
				if( $j++!=0){
					echo ",";
				}			
			?>
			{
				text:'<?=$grupo?>',	
				leaf:false,
				children:[
					<?
					$k=0;
					foreach( $paises as $pais ){
						if( $k++!=0){
							echo ",";
						}					
					?>
					{
						text:'<?=$pais['pais']?>',
                        id: 'traf_<?=$impoexpo."_".$transporte."_".$modalidad."_".$pais['idtrafico']?>',
						leaf:false,                        
                        impoexpo: '<?=$impoexpo?>',
                        transporte: '<?=$transporte?>',
                        modalidad: '<?=$modalidad?>',
                        idtrafico: '<?=$pais['idtrafico']?>',
                        trafico: '<?=$pais['pais']?>'

					}
					<?
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
}
?>

]
<?
exit;
?>
					