<script type="text/javascript">
<!--
Ext.onReady(function(){
    
	var impoexpo = [
		<?
		while (list ($clave, $val) = each ($impoexpo)) {
		?>
        ['<?=$val?>', '<?=$val?>' ],
        <?
		}
        ?>       
     ];
    
    var index = <?=isset($id)?"'_".$id."'":"''"; ?>;
   	
  	var comboImpoexpo = new Ext.form.ComboBox({
	    store: impoexpo,
	    typeAhead: true,
        forceSelection: true,
	    triggerAction: 'all',
	    emptyText:'Seleccione',
	    selectOnFocus: true,
	    applyTo: 'combo_impoexpo'+index,
	    hiddenName: 'impoexpo'+index,
	  	name: 'impoexpo'+index
	});
	
	<?	
	foreach( $events as $key=>$value ){		
	?>	
	comboImpoexpo.on("<?=$key?>", <?=$value?> );
	<?
	}
	?>
	
    }
  );
//-->
</script>
