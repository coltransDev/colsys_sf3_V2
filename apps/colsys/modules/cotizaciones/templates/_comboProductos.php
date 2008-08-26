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
   	
  	var comboProductos = new Ext.form.ComboBox({
	    store: productos,
	    typeAhead: true,
        forceSelection: false,
	    triggerAction: 'all',
	    emptyText:'Seleccione',
	    selectOnFocus: true,
	    applyTo: 'combo_productos',
	    hiddenName: 'productos',
	    
	});
	
	
	
	
	
    }
  );
//-->
</script>
