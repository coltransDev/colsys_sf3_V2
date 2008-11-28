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
		,{
			text:'Recargos locales',
			id:'recgen_<?=$impoexpo?>_<?=$transporte?>_<?=$modalidad?>',		
			leaf:true
		}	
			
		]
	}
<?
}
?>

]
<?
exit;
?>
					