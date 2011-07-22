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
        id: 'root_<?=$impoexpo."_".$transporte."_".$modalidad?>',
		children:[
            <?
            if( $transporte!=Constantes::OTMDTA ){
            ?>
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
            }            
			if( $transporte==Constantes::MARITIMO && $impoexpo=="impo"  ){                
					if($modalidad=="LCL"){
						$linea = "coloaders";
                    }else{
						$linea = "Naviera";
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
            if( $transporte==Constantes::AEREO && $impoexpo=="impo"  ){
                if( $transporte==Constantes::MARITIMO ){
					if($modalidad=="LCL"){
						$linea = "coloaders";
                    }else{
						$linea = "Naviera";
                    }
                    $accion = "recnav";
                }elseif( $transporte==Constantes::AEREO ){
                    $linea = "Aérolinea";
                    $accion = "recloclin";
                    
                }else{
                    $linea =  "linea";
                    $accion = "recloclin";
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
                            opcion: '<?=$accion?>',
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
					