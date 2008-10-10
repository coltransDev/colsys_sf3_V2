 Ext.onReady(function(){

    var ds = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '/colsys_sf/index.php/clientes/listaContactosClientesJSON'
        }),
        reader: new Ext.data.JsonReader({
            root: 'clientes',
            totalProperty: 'totalCount',
            id: 'id'
        }, [
            {name: 'id', mapping: 'ca_idcontacto'},
            {name: 'compania', mapping: 'ca_compania'},
			{name: 'cargo', mapping: 'ca_cargo'},
			{name: 'nombre', mapping: 'ca_nombres'},
			{name: 'papellido', mapping: 'ca_papellido'},
			{name: 'sapellido', mapping: 'ca_sapellido'},
			{name: 'preferencias', mapping: 'ca_preferencias'},
			{name: 'confirmar', mapping: 'ca_confirmar'},
           
        ])
    });
	
	var resultTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><strong>{compania}</strong><br /><span>{nombre} {papellido} {sapellido} <br />{cargo}</span> </div></tpl>' 
			
    );
    
    var search = new Ext.form.ComboBox({
        store: ds,
        displayField:'compania',
        typeAhead: false,
        loadingText: 'Buscando...',
        width: 320,
        valueNotFoundText: 'No encontrado' ,
		minChars: 1,
        hideTrigger:true,
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
			
			document.getElementById("con_cliente").value=record.data.nombre+" "+record.data.papellido+" "+record.data.sapellido;
			document.getElementById("cliente").value=record.data.compania;		
			document.getElementById("idconcliente").value=record.data.id;				
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
			}				
				
           
        }
    });
});
