<script type="text/javascript">
<!--
Ext.onReady(function(){
    
	var transportes = [
		<?
		foreach($transportes as $transporte){
		?>
        ['<?=$transporte->getCaValor()?>', '<?=$transporte->getCaValor()?>' ],
        <?
        }
        ?>       
     ];    
   	
  	var comboTransporte = new Ext.form.ComboBox({
	    store: transportes,
	    typeAhead: true,
        forceSelection: true,
	    triggerAction: 'all',
	    emptyText:'Seleccione',
	    selectOnFocus: true,
	    applyTo: 'combo_transporte',
	    hiddenName: 'transporte'
	});
	
	var modalidadAerea = [
		<?
		foreach($modalidadAerea as $modalidad){
		?>
        ['<?=$modalidad->getCaValor()?>', '<?=$modalidad->getCaValor()?>' ],
        <?
        }
        ?>       
     ];    
     
     var modalidadMaritima = [
		<?
		foreach($modalidadMaritima as $modalidad){
		?>
        ['<?=$modalidad->getCaValor()?>','<?=$modalidad->getCaValor()?>' ],
        <?
        }
        ?>       
     ];   	
   	
   	 var store = new Ext.data.SimpleStore({
        fields: [ 'valor'],
        data : []
    });
   	
   	
  	var comboModalidad = new Ext.form.ComboBox({
	    store: store,
	    typeAhead: true,
        forceSelection: true,
	    triggerAction: 'all',
	    emptyText:'Seleccione',
	    selectOnFocus: true,
	    applyTo: 'combo_modalidad',
	    mode: 'local',
	    displayField:'valor',
	    hiddenName: 'modalidad'
	    
	});
	
	
	/**
	* Cambia el contenido del Combo Modalidad según sea seleccionado el transporte
	**/
	comboTransporte.on('change', function(comboTransporte, newValue, oldValue ) {	
		if(newValue=="Marítimo"){
			store.loadData(modalidadMaritima);
		}else if(newValue=="Aéreo"){
			store.loadData(modalidadAerea);
		}else{		
			store.loadData([]);
		}
    }); 
	
    }
  );
//-->
</script>
