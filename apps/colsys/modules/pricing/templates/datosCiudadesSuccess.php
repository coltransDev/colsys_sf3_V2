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
			if( $nivel>0 ){
			?>
			{
				text:'Recargos locales x <?=$linea?>',
				id:'reclin_<?=$impoexpo?>_<?=$transporte?>_<?=$modalidad?>',		
				leaf:false,
				children:[
					<?
					$k=0;
					foreach( $lineas[$modalidad] as $linea ){						
						if( $k++!=0){
							echo ",";
						}					
					?>
					{
						text:'<?=$linea->getCaSigla()?$linea->getCaSigla():$linea->getCaNombre()?>',	
						id:'reclin_<?=$impoexpo?>_<?=$transporte?>_<?=$modalidad?>_99-999_<?=$linea->getCaIdlinea()?>',
						leaf:true
					}
					<?
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
					