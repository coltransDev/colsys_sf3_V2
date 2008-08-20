<?

function select_anidado( $name, $name2, $options1 , $options2 ){
	?>
	<script language="javascript" type="text/javascript">
		
		function seleccionar_<?=$name?>(){
			var selOptions = array();
			<?
			foreach( $options2 as $key=>$option2){
				foreach( $option2 as $key2=>$value ){
				?>
				selOptions[<?=$key?>][<?=$key2?>] = '<?=$value?>';
				<?
				}
			}
			?>	
			var element2 = document.getElementById('<?=$name2?>');
			
			
			element
			
			
			
		}				
	</script>	
	<?
	echo select_tag($name , $options1, "onchange=seleccionar_".$name  );	
}
?>