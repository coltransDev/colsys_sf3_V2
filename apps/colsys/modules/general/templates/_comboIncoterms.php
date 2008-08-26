<script type="text/javascript">
<!--
Ext.onReady(function(){
    
	var incoterms = [
		<?
		foreach($incoterms as $incoterm){
		?>
        ['<?=$incoterm->getCaValor()?>', '<?=$incoterm->getCaValor()?>' ],
        <?
        }
        ?>       
     ];    
   	
  	var comboIncoterms = new Ext.form.ComboBox({
	    store: incoterms,
	    typeAhead: true,
        forceSelection: true,
	    triggerAction: 'all',
	    emptyText:'Seleccione',
	    selectOnFocus: true,
	    applyTo: 'combo_incoterms',
	    hiddenName: 'incoterms'
	});
	
    }
  );
//-->
</script>
