<?

?>
<script language="javascript" type="text/javascript">
	function habilitar( field, checked ){
	
		//alert(field.getRawValue()+" "+checked);
		
		if( field.getRawValue()=="activos" && checked ){
			Ext.getCmp("reporte").disable();
			Ext.getCmp("cliente").enable();			
		}
		
		if( field.getRawValue()=="reporte" && checked ){	
			Ext.getCmp("reporte").enable();
			Ext.getCmp("cliente").disable();			
		}
	}
	
</script>

<div class="content" align="center" >
	
	
	<div id="panel"></div>
</div>
<script language="javascript" type="text/javascript">
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
    
    var comboClientes = new Ext.form.ComboBox({
        store: ds,
		id:'cliente',
        displayField:'compania',
        typeAhead: false,
        loadingText: 'Buscando...',
        width: 320,
        valueNotFoundText: 'No encontrado' ,
		minChars: 1,
        hideTrigger:false,
		hideLabel: true,
        tpl: resultTpl,
		allowBlank : false, 
        //applyTo: 'cliente',
		//renderTo:"comboClientes",
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
			

			Ext.getCmp("idcliente").setValue(record.data.id);          
        }
    });

	
	<?
	
	
	
	$params = "";
	if( isset($impoexpo)){
		if( $params=="" ){
			$params.="?";
		}else{
			$params.="&";
		}
		$params .= "impoexpo=".utf8_encode($impoexpo);
	}
	
	
	if( isset($transporte)){
		if( $params=="" ){
			$params.="?";
		}else{
			$params.="&";
		}
		$params .= "transporte=".utf8_encode($transporte);
	}
	?>
		
		
	var ds = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("widgets/datosComboReportes".$params)?>'
			
        }),
        reader: new Ext.data.JsonReader({
            root: 'reportes',
            totalProperty: 'totalCount'            
        }, [
            {name: 'idreporte', mapping: 'ca_idreporte'},
            {name: 'consecutivo', mapping: 'ca_consecutivo'}
			
        ])
    });
	
	
    var comboReporte = new Ext.form.ComboBox({
        store: ds,
		 id: 'reporte',
        displayField:'consecutivo',
		valueField:'consecutivo',
        typeAhead: false,
        loadingText: 'Buscando...',
        width: 160,
        valueNotFoundText: 'No encontrado' ,
		minChars: 1,
        hideTrigger:false,
		hideLabel: true	,
		disabled : true ,
		allowBlank : false, 		
        //tpl: resultTpl,
        //applyTo: 'reporte',
        //itemSelector: 'div.search-item',		
	    emptyText:'',		
	    forceSelection:true,		
		selectOnFocus:true
				
    });

		
		
		
	var mainPanel = new Ext.FormPanel({
      
        frame:true,
        title: 'Modulo de status de tráficos',
        bodyStyle:'padding:5px 5px 0',
        width: 450,
        defaults: {width: 330},
        defaultType: 'textfield',
		standardSubmit: true, 
		/*url: '<?=url_for("traficos/listaStatus?modo=".$modo)?>',*/

        items: [
			{
				xtype:'hidden',
				id: 'idcliente',
				name: 'idcliente'
				
			},
			new  Ext.form.Radio({
				name : 'tipo',
				boxLabel : 'Ver reportes activos',
				hideLabel: true,
				checked : true,
				inputValue  : 'activos', 
				handler : habilitar		
			})
			,
			
			comboClientes,
			new  Ext.form.Radio({
				name : 'tipo',
				boxLabel :'Por n&uacute;mero de reporte',
				hideLabel: true,
				inputValue  : 'reporte', 				
				handler : habilitar
								
			})
			,
			comboReporte
			
        ],

       buttons: [{
	            text: 'Continuar',
	            handler: function(){
					
	            	if( mainPanel.getForm().isValid() ){
						
						var queryStr = "";
						//alert(  mainPanel.getForm().findField("tipo").getValue() + " "+mainPanel.getForm().findField("tipo").getRawValue() );
						if( mainPanel.getForm().findField("tipo").getRawValue()=="activos" && mainPanel.getForm().findField("tipo").getValue() ){
							queryStr = "?idcliente="+mainPanel.getForm().findField("idcliente").getValue();
						}else{	
							queryStr = "?reporte="+mainPanel.getForm().findField("reporte").getValue();		
						}
												
						document.location = '<?=url_for("traficos/listaStatus?modo=".$modo)?>'+queryStr
	            		
					}else{
						Ext.MessageBox.alert('Error:', '¡Atención: La información está incompleta!');
					}	            	
	            }
	        }
			]
    });

    mainPanel.render("panel");

		/*	
		var ver = document.form1.ver
		var value='';	
		for (i=0;i<ver.length;i++){
			  if ( ver[i].checked ){
					 value = ver[i].value;
			  }
		} 
	
		habilitar(value);*/
	});
</script>
