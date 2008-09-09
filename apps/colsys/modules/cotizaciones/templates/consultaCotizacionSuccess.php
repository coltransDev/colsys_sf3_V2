<link rel="stylesheet" type="text/css" 	href="/colsys_sf/css/treegrid/css/TreeGrid.css" />
<link rel="stylesheet" type="text/css"
	href="/colsys_sf/css/treegrid/css/TreeGridLevels.css" />
<script
	language="javascript" src="/colsys_sf/js/treegrid/TreeGrid.js"></script>
<script
	language="javascript" src="/colsys_sf/js/treegrid/RowExpander.js"></script>
<script
	language="javascript" src="/colsys_sf/js/treegrid/myRowExpander.js"></script>
<script
	language="javascript" src="/colsys_sf/js/treegrid/NumberFieldMin.js"></script>
<script
	language="javascript" src="/colsys_sf/js/treegrid/CheckColumn.js"></script>

<?
	$contacto = $cotizacion->getContacto();
	if (!$contacto) {
		$contacto = new Contacto();	
	}
	$cliente = $contacto->getCliente();
	if (!$cliente) {
		$cliente = new Cliente();
	}
	$usuario = $cotizacion->getUsuario();
	if (!$usuario) {
		$usuario = new Usuario();
	}
	?>
<script language="javascript">

Controller = function()
{	
	function createGrid()
	{
	Ext.QuickTips.init();
	
	Ext.apply(Ext.QuickTips.getQuickTip(), {	   
	   dismissDelay: 200000 //permite que los tips permanezcan por mas tiempo. 
	});
	
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
            {name: 'vendedor', mapping: 'ca_vendedor'},
        ])
    });

    var store = new Ext.data.SimpleStore({
    	fields: [ 'valor'],
    	data : []
    });


	var resultTpl = new Ext.XTemplate( 
        '<tpl for="."><div class="search-item"><strong>{compania}</strong><br /><span>{nombre} {papellido} {sapellido} <br />{cargo}</span> </div></tpl>' 
    );
    
  	
  	
	//------ Formulario ------
	
	var actualizarEncabezado = function ( field ){
			
		Ext.Ajax.request(  
			{   //Specify options (note success/failure below that
				//receives these same options)
				waitMsg: 'Guardando cambios...', 

				//url where to send request (url to server side script) 
				url: '<?=url_for("cotizaciones/observeEncabezadoCotizacion?cotizacionId=".$cotizacion->getCaIdCotizacion())?>/'+field.name+'/'+field.value, 
				
				//If specify params default is 'POST' instead of 'GET'
				//method: 'POST', 
				
				//params will be available server side via $_POST or $_REQUEST:
				//params :	changes,
										
				//the function to be called upon failure of the request
				//(404 error etc, ***NOT*** success=false)
				failure:function(response,options){							
					alert( response.responseText );						
					success = false;
				},
				
				//The function to be called upon success of the request                                
				success:function(response,options){							
					alert( response.responseText );
				}                                      
			 }//end request config
		); //end request*
	}

    var panel = new Ext.FormPanel({
        labelAlign: 'top',
        title: 'Sistema de cotizaciones',
        bodyStyle:'padding:1px',
        // width: '80%',
        // anchor:'95%',

        items: [{
            xtype:'tabpanel',
            activeTab: 0,
            defaults:{autoHeight:true, bodyStyle:'padding:10px'}, 
            items:[{
                title:'Información General',
                layout:'form',
                // defaultType: 'textfield',
                defaults: {width: 420},

                items: [{
				    layout:'table',
				    border: false, 
				    defaults: {
				        // applied to each contained panel
				        bodyStyle:'padding-right:20px',
				        border: false
				    },
				    layoutConfig: {
				        // The total column count must be specified here
				        columns: 3
				    },
				    items: [{
		                layout: 'form',
		                items: [{
							xtype:'datefield',
							fieldLabel: 'Fecha Cotizacion',
							name: 'fchCotizacion',
							value: '<?=$cotizacion->getCaFchcotizacion()?>',
							format: "Y-m-d", 
							listeners : { "change":actualizarEncabezado },
							allowBlank:false,
							width: 120
		                }]
				    },{
		                layout: 'form',
		                items: [{
							xtype:'timefield',
							fieldLabel: 'Hora de Solicitud',
							name: 'HoraSolicitud',
							value: '<?=$cotizacion->getCaHoraSolicitud()?>',
							format: "H:i:s", 
							listeners : { "change":actualizarEncabezado },
							allowBlank:false,
							width: 140
		                }]
				    },{
		                layout: 'form',
		                items: [{
							xtype:'datefield',
							fieldLabel: 'Fecha de Solicitud',
							name: 'fchSolicitud',
							value: '<?=$cotizacion->getCaFchsolicitud()?>',
							format: "Y-m-d", 
							listeners : { "change":actualizarEncabezado },
							allowBlank:false,
							width: 120
		                }]
				    }]
                }, 
					new Ext.form.ComboBox({
				        store: ds,
				        fieldLabel: 'Cliente',
				        displayField:'compania',
				        typeAhead: false,
				        loadingText: 'Buscando...',
				        valueNotFoundText: 'No encontrado' ,
						minChars: 1,
				        hideTrigger:true,
				        tpl: resultTpl,
				        itemSelector: 'div.search-item',		
					    emptyText:'Escriba el nombre del cliente...',
					    value: '<?=$cliente->getCaCompania()?>',		
					    forceSelection:true,		
						selectOnFocus:true,
						allowBlank:false,
						
						onSelect: function(record, index){ // override default onSelect to do redirect		
							if(this.fireEvent('beforeselect', this, record, index) !== false){
								this.setValue(record.data[this.valueField || this.displayField]);
								this.collapse();
								this.fireEvent('select', this, record, index);
							}
							Ext.getCmp("contacto").setValue(record.get("nombre")+' '+record.get("papellido")+' '+record.get("sapellido") );							
						},
					})
				,{
					id: 'contacto',
					xtype:'textfield',
					fieldLabel: 'Persona de Contacto',
					name: 'contacto',
					value: '<?=$contacto->getCaNombres().' '.$contacto->getCaPapellido().' '.$contacto->getCaSapellido()?>',
                    allowBlank:false
				},{
					id: 'usuario',
					xtype:'textfield',
					fieldLabel: 'Representante Comercial',
					name: 'usuario',
					value: '<?=$usuario->getCaNombre()?>',
                    allowBlank:false
                }]
            },{
                title:'Entrada',
                layout:'form',
                defaults: {width: 230},
                defaultType: 'textfield',

                items: [{
					xtype:'textfield',
					width: 500,
					fieldLabel: 'Asunto',
					name: 'asunto',
					value: '<?=$cotizacion->getCaAsunto()?>',
					listeners : { "change":actualizarEncabezado },
                    allowBlank:false
                }, {
					xtype: 'textarea',
					width: 500,
					fieldLabel: 'Entrada',
					name: 'entrada',
					value: '<?=$cotizacion->getCaEntrada()?>',
					listeners : { "change":actualizarEncabezado },
                    allowBlank:false
                }]
            },{
                title:'Salida',
                layout:'form',
                defaults: {width: 230},
                defaultType: 'textfield',

                items: [{
					xtype: 'textarea',
					width: 500,
					fieldLabel: 'Despedida',
					name: 'despedida',
					value: '<?=$cotizacion->getCaDespedida()?>',
					listeners : { "change":actualizarEncabezado },
                    allowBlank:false
                }]
            },{
                title:'Anexos',
                layout:'form',
                defaults: {width: 230},
                defaultType: 'textfield',

                items: [{
					xtype: 'textarea',
					width: 500,
					fieldLabel: 'Anexos',
					name: 'anexos',
					value: '<?=$cotizacion->getCaAnexos()?>',
					listeners : { "change":actualizarEncabezado },
                    allowBlank:false
                }]
            }],

	        buttons: [{
	            text: 'Save'
	        },{
	            text: 'Cancel'
	        }]
        	
        },{
            xtype:'tabpanel',
            plain:true,
            activeTab: 0,
            height:235,
            defaults:{bodyStyle:'padding:10px'},
            items:[{
                title:'Información de fletes',
                layout:'form',
                defaults: {width: 800},
                defaultType: 'textfield',

                // items: [grid]
            },{
                title:'OTM/DTA',
                layout:'form',
                defaults: {width: 230},
                defaultType: 'textfield',

                items: [{
                    fieldLabel: 'Home',
                    name: 'home',
                    value: '(888) 555-1212'
                },{
                    fieldLabel: 'Business',
                    name: 'business'
                },{
                    fieldLabel: 'Mobile',
                    name: 'mobile'
                },{
                    fieldLabel: 'Fax',
                    name: 'fax'
                }]
            },{
                cls:'x-plain',
                title:'Biography',
                layout:'fit',
                items: {
                    xtype:'htmleditor',
                    id:'bio2',
                    fieldLabel:'Biography'
                }
            }]
        }],

        buttons: [{
            text: 'Save'
        },{
            text: 'Cancel'
        }]
    });
	
	panel.render(document.body);

    var vp = new Ext.Viewport({
    	layout : 'fit',
    	items : panel
    });
	}
	return {
		init : function()
		{
			//Ext.MessageBox.alert('Warning','Por favor lea las observaciones: ');
			createGrid();
		}
	}
	
	
}();




Ext.onReady(Controller.init);
</script>