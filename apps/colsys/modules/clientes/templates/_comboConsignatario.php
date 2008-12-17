<div style="display:none">
	<?=input_tag( "idconsignatario", isset($tercero)?$tercero->getCaIdtercero():"" , "size=60 readonly=readOnly autocomplete=off" )?>
	</div>
	<?php echo form_error('idconsignatario') ?>
	<?=input_tag( "nombre_con", isset($tercero)?$tercero->getCaNombre():"" , "size=60 " )?>
						
						
<script type="text/javascript" >
//Consignatario 
Ext.onReady(function(){

    var ds = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("clientes/listaConsignatariosJSON")?>'
        }),
        reader: new Ext.data.JsonReader({
            root: 'terceros',
            totalProperty: 'totalCount',
            id: 'id'
        }, [
            {name: 'id', mapping: 'ca_idtercero'},
            {name: 'nombre', mapping: 'ca_nombre'},
			{name: 'ciudad', mapping: 'ca_ciudad'},
			{name: 'pais', mapping: 'ca_pais'}
			
           
        ])
    });
	
	var resultTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><strong>{nombre}</strong><br /><span><br />{ciudad} - {pais}</span> </div></tpl>' 
			
    );
    
    var search = new Ext.form.ComboBox({
        store: ds,
        displayField:'nombre',
		id: 'nombre_consignee',
        typeAhead: false,
        loadingText: 'Buscando...',
        width: 320,
        valueNotFoundText: 'No encontrado' ,
		minChars: 1,
        hideTrigger:false,
        tpl: resultTpl,
        applyTo: 'nombre_con',
        itemSelector: 'div.search-item',		
	    emptyText:'Escriba el nombre del consignatario...',		
	    forceSelection:true,		
		selectOnFocus:true,
		
		onSelect: function(record, index){ // override default onSelect to do redirect			
			if(this.fireEvent('beforeselect', this, record, index) !== false){
				this.setValue(record.data[this.valueField || this.displayField]);
				this.collapse();
				this.fireEvent('select', this, record, index);
			}
						
			document.getElementById("nombre_con").value=record.data.nombre;		
			document.getElementById("idconsignatario").value=record.data.id;	
			document.getElementById("editarConsignatario").style.display="inline";						
				
           
        }
    });
});


</script>