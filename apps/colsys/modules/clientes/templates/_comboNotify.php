<div style="display:none">
						<?=input_tag( "idnotify", isset($tercero)?$tercero->getCaIdtercero():"" , "size=60 readonly=readOnly" )?>
						</div>
						<?php echo form_error('idnotify') ?>
						<?=input_tag( "nombre_not", isset($tercero)?$tercero->getCaNombre():"" , "size=60 autocomplete=off" )?>

<script language="javascript">
//Notify
Ext.onReady(function(){

    var ds = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("clientes/listaNotifyJSON")?>'
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
    
    var searchNot = new Ext.form.ComboBox({
        store: ds,
        displayField:'nombre',
		id:'nombre_notify',
        typeAhead: false,
        loadingText: 'Buscando...',
        width: 320,
        valueNotFoundText: 'No encontrado' ,
		minChars: 1,
        hideTrigger:false,
        tpl: resultTpl,
        applyTo: 'nombre_not',
        itemSelector: 'div.search-item',		
	    emptyText:'Escriba el nombre del notify...',		
	    forceSelection:true,		
		selectOnFocus:true,
		
		onSelect: function(record, index){ // override default onSelect to do redirect			
			if(this.fireEvent('beforeselect', this, record, index) !== false){
				this.setValue(record.data[this.valueField || this.displayField]);
				this.collapse();
				this.fireEvent('select', this, record, index);
			}
						
			document.getElementById("nombre_not").value=record.data.nombre;		
			document.getElementById("idnotify").value=record.data.id;	
			document.getElementById("editarNotify").style.display="inline";							
           
        }
    });
});

</script>