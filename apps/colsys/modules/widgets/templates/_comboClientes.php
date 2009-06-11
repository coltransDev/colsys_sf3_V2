
<div style="display:none">
	<input type="text" name="idcliente" id="idcliente" value="<?=isset($cliente)?$cliente->getCaIdCliente():""?>" size="11" readonly="readonly" />
</div>	
<input type="text" name="cliente" id="cliente" value="<?=isset($cliente)?$cliente->getCaCompania():""?>" size="50" Autocomplete="off" />			

<script language="javascript">
 Ext.onReady(function(){

    var ds = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("widgets/datosComboClientes")?>'
        }),
        reader: new Ext.data.JsonReader({
            root: 'clientes',
            totalProperty: 'totalCount',
            id: 'id'
        }, [
            {name: 'id', mapping: 'ca_idcliente'},
            {name: 'compania', mapping: 'ca_compania'},
			
			{name: 'preferencias', mapping: 'ca_preferencias'},
			{name: 'confirmar', mapping: 'ca_confirmar'},
           
        ])
    });
	
	var resultTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><b>{compania}</b><br /><span>{nombre} {papellido} {sapellido} <br />{cargo}</span> </div></tpl>' 
			
    );
    
    var search = new Ext.form.ComboBox({
        store: ds,
		id:'cliente',
        displayField:'compania',
        typeAhead: false,
        loadingText: 'Buscando...',
        width: 320,
        valueNotFoundText: 'No encontrado' ,
		minChars: 1,
        hideTrigger:false,
        tpl: resultTpl,
        applyTo: 'cliente',
        itemSelector: 'div.search-item',		
	    emptyText:'Escriba el nombre del cliente...',		
	    forceSelection:true,		
		selectOnFocus:true,
		
		onSelect: function(record, index){ // override default onSelect to do redirect			
			if(this.fireEvent('beforeselect', this, record, index) !== false){
				this.setValue(record.data[this.valueField || this.displayField]);
				this.collapse();
				this.fireEvent('select', this, record, index);
			}
			
			
			document.getElementById("cliente").value=record.data.compania;		
			document.getElementById("idcliente").value=record.data.id;				
			/*
			document.getElementById("preferencias_clie").value=record.data.preferencias;		
			
			for(i=0; i<10; i++){				
				document.getElementById("contactos_"+i).value="";
				document.getElementById("confirmar_"+i).checked=false;
			}
			
			
			var confirmar =  record.data.confirmar ;						
			var brokenconfirmar=confirmar.split(",");			
			
			for(i=0; i<brokenconfirmar.length; i++){				
				document.getElementById("contactos_"+i).value=brokenconfirmar[i];
				document.getElementById("confirmar_"+i).checked=true;
			}*/				
				
           
        }
    });
});
</script>						