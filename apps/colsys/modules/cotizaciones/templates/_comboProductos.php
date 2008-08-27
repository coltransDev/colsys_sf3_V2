<script type="text/javascript">
<!--
Ext.onReady(function(){
    
	var productos = [
		<?
		while (list ($clave, $val) = each ($productos)) {
		?>
        ['<?=$val?>', '<?=$val?>' ],
        <?
        }
        ?>       
     ];    
   	
    var index = <?=isset($id)?"'_".$id."'":"''"; ?>;

  	var comboProductos = new Ext.form.ComboBox({
	    store: productos,
	    typeAhead: true,
        forceSelection: false,
	    triggerAction: 'all',
	    emptyText:'Seleccione',
	    selectOnFocus: true,
	    applyTo: 'combo_productos'+index,
	    hiddenName: 'productos'+index
	});
	
    }
  );
//-->
</script>
