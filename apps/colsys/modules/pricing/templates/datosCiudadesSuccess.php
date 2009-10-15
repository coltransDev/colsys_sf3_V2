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
		children:[			
			{
				text:'Recargos locales',
				id:'recgen_<?=$impoexpo?>_<?=$transporte?>_<?=$modalidad?>',		
				leaf:true
			},
			
			<?
			if( $transporte==Constantes::MARITIMO ){ 
				$linea = "Naviera";
			}elseif( $transporte==Constantes::AEREO ){
				$linea = "Aérolinea";
			}else{
				$linea =  "linea";
			}
			?>
			
			<?
			
			?>
			{
				text:'Recargos locales x <?=$linea?>',
				id:'reclin_<?=$impoexpo?>_<?=$transporte?>_<?=$modalidad?>',		
				leaf:false,
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
                            id:'reclin_<?=$impoexpo?>_<?=$transporte?>_<?=$modalidad?>_99-999_<?=$linea["p_ca_idproveedor"]?>',
                            leaf:true
                        }
                        <?
                        }
					}				
					?>					
				]
			},			
			<?
		
			
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
						id: '<?=$impoexpo."_".$transporte."_".$modalidad."_".$pais['idtrafico']?>',
						leaf:false
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
					