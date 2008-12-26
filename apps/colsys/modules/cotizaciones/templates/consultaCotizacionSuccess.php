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
	/*$productos = $cotizacion->getProductos();
	if (!$productos) {
		$producto = new Producto();
	}*/
	
?>

<script language="javascript" type="text/javascript">

Ext.onReady(function(){
	
	function guardarItems(){		
		guardarGridProductos();
		updateRecargosModel();
		updateContViajeModel();		
		updateSeguroModel();
		guardarGridAgentes();
		
	}
	/*
	* ================  Panel de archivos adjuntos  =======================
	* Crea el objeto $object que contine el panel solicitado
	*/
	<?	
	include_component("gestDocumental", "panelArchivos", 
						array("dataUrl"=>"cotizaciones/dataArchivosCotizacion?idcotizacion=".$cotizacion->getCaIdcotizacion(),
							"viewUrl"=>"cotizaciones/verArchivo?idcotizacion=".$cotizacion->getCaIdcotizacion(),
							"deleteUrl"=>"cotizaciones/eliminarArchivo?idcotizacion=".$cotizacion->getCaIdcotizacion(),
							"object"=>"panelArchivos", 
							"closable"=>false, 
							"uploadURL"=>"cotizaciones/adjuntarArchivo?idcotizacion=".$cotizacion->getCaIdcotizacion() 
						));
	?>
	/*
	* ================  Panel de archivos adjuntos  =======================
	*/
	
    var ds = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for('clientes/listaContactosClientesJSON')?>'
        }),
        reader: new Ext.data.JsonReader({
            root: 'clientes',
            totalProperty: 'totalCount',
            id: 'id'
        }, [
            {name: 'idcontacto', mapping: 'ca_idcontacto'},
            {name: 'compania', mapping: 'ca_compania'},
			{name: 'cargo', mapping: 'ca_cargo'},
			{name: 'nombre', mapping: 'ca_nombres'},
			{name: 'papellido', mapping: 'ca_papellido'},
			{name: 'sapellido', mapping: 'ca_sapellido'},
            {name: 'vendedor', mapping: 'ca_vendedor'},
            {name: 'nombre_ven', mapping: 'ca_nombre'},
        ])
    });

	//var data_productos = <?//json_encode();?>
	
	var resultTpl = new Ext.XTemplate( 
        '<tpl for="."><div class="search-item"><strong>{compania}</strong><br /><span>{nombre} {papellido} {sapellido} <br />{cargo}</span> </div></tpl>' 
    );



    Ext.QuickTips.init();

    // turn on validation errors beside the field globally
    Ext.form.Field.prototype.msgTarget = 'side';
    /*
     * ================  Main Form  =======================
     */
	 
	 var despedida = '<?=str_replace("\r", "", str_replace("\n", "<br />",$cotizacion->getCaDespedida()))?>';
	 despedida = despedida.split("<br />").join("\n");
	 
    var mainPanel = new Ext.FormPanel({
        labelAlign: 'top',
        title: 'Sistema de cotizaciones <?=$cotizacion->getCaEmpresa()?>',
        bodyStyle:'padding:1px',	
		//fileUpload: true,			

        items: [{
            xtype:'tabpanel',
            buttonAlign: 'left',
            activeTab: 0,
            defaults:{autoHeight:true, bodyStyle:'padding:10px'},
            deferredRender:false,
	        
            items:[{
                title:'Informaci�n General',
                layout:'form',
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
							xtype:'textfield',
							fieldLabel: 'Consecutivo',
							name: 'consecutivo',
							value: 'C<?=$cotizacion->getCaConsecutivo()?>',
							allowBlank:false,
							readOnly: true, 
							width: 120
		                }]
				    },
					{
		                layout: 'form',
		                items: [{
							xtype:'datefield',
							fieldLabel: 'Fecha de Solicitud',
							name: 'fchSolicitud',
							value: '<?=$cotizacion->getCaFchsolicitud()?>',
							format: "Y-m-d", 
							allowBlank:false,
							width: 120
		                }]
				    },{
		                layout: 'form',
		                items: [{
							xtype:'timefield',
							fieldLabel: 'Hora de Solicitud',
							name: 'horaSolicitud',
							value: '<?=$cotizacion->getCaHoraSolicitud()?>',
							format: "H:i:s", 
							allowBlank:false,
							width: 140
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
							Ext.getCmp("idconcliente").setValue(record.get("idcontacto"));
							Ext.getCmp("contacto").setValue(record.get("nombre")+' '+record.get("papellido")+' '+record.get("sapellido") );
							Ext.getCmp("usuario").setValue(record.get("vendedor"));
							Ext.getCmp("vendedor").setValue(record.get("nombre_ven"));
						}
					})
				,{
					id: 'cotizacionId',
					xtype:'hidden',
					name: 'cotizacionId',
					value: '<?=$cotizacion->getCaIdcotizacion()?>',
                    allowBlank:false
				},{
					id: 'idconcliente',
					xtype:'hidden',
					name: 'idconcliente',
					value: '<?=$cotizacion->getCaIdcontacto()?>',
                    allowBlank:false
				},{
					id: 'contacto',
					xtype:'textfield',
					fieldLabel: 'Persona de Contacto',
					name: 'contacto',
					value: '<?=$contacto->getCaNombres().' '.$contacto->getCaPapellido().' '.$contacto->getCaSapellido()?>',
                    allowBlank:false,
					readOnly: true
				},{
					id: 'usuario',
					xtype:'hidden',
					name: 'usuario',
					value: '<?=$cotizacion->getCaUsuario()?>',
                    allowBlank:false
				},{
					id: 'vendedor',
					xtype:'textfield',
					fieldLabel: 'Representante Comercial',
					name: 'vendedor',
					value: '<?=$usuario->getCaNombre()?>',
                    allowBlank:false,
					readOnly: true
                }
				<?
				if( !$cotizacion->getCaIdCotizacion() ){
					echo ",";
					include_component("widgets", "empresa" ,array("id"=>"empresa", "label"=>"Empresa", "allowBlank"=>"false"));
				}
				
				?>	]
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
                    allowBlank:false
                }, {
					xtype:'textfield',
					width: 500,
					fieldLabel: 'Saludo',
					name: 'saludo',
					value: '<?=$cotizacion->getCaSaludo()?>',
                    allowBlank:false
                }, {
					xtype: 'textarea',
					width: 500,
					fieldLabel: 'Entrada',
					name: 'entrada',
					value: '<?=$cotizacion->getCaEntrada()?>',
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
					value: despedida,
                    allowBlank:false
                },
				{
					xtype: 'textarea',
					width: 500,
					fieldLabel: 'Anexos',
					name: 'anexos',
					value: '<?=$cotizacion->getCaAnexos()?>',
                    allowBlank:false
                }

				]
            }
			
			],

	        buttons: [{
	            text: 'Salvar',
	            handler: function(){
	            	if( mainPanel.getForm().isValid() ){
						
	            		mainPanel.getForm().submit({url:'<?=url_for('cotizaciones/formCotizacionGuardar')?>', 
	            							 	waitMsg:'Salvando Datos b�sicos de la Cotizaci&oacute;n...',
												success:function(response,options){														
													<?
													if( !$cotizacion->getCaIdcotizacion() ){
													?>
														document.location='<?=url_for("cotizaciones/consultaCotizacion?id=")?>'+options.result.idcotizacion;
													<?
													}
													?>
												},
	            							 	// standardSubmit: false, 												
		            							failure:function(response,options){							
													Ext.Msg.alert( "Error "+response.responseText );
												}//end failure block  
												
												
												    
											});
					}else{
						Ext.MessageBox.alert('Sistema de Cotizaciones - Error:', '�Atenci�n: La informaci�n b�sica de la cotizaci�n no es v�lida o est� incompleta!');
					}	            	
	            }
	        },{
	            text: 'Cancelar'
	        }]
        }]
    });
	mainPanel.render(document.body);
     <?
	 if( $cotizacion->getCaIdcotizacion() && $cotizacion->getCaEmpresa() == Constantes::COLTRANS ){
	 	
		 if( $cotizacion->getCaEmpresa() == Constantes::COLTRANS ){	
			 include_component("cotizaciones","grillaProductos",array("cotizacion"=>$cotizacion));
			 include_component("cotizaciones","grillaRecargos",array("cotizacion"=>$cotizacion,"tipo"=>"Recargo Local"));
			 include_component("cotizaciones","grillaContViajes",array("cotizacion"=>$cotizacion));
			  include_component("cotizaciones","grillaAgentes",array("cotizacion"=>$cotizacion));
		}
		include_component("cotizaciones","grillaSeguros",array("cotizacion"=>$cotizacion));
		 
		 ?>   	
		 var subPanel = new Ext.FormPanel({
			labelAlign: 'top',
			bodyStyle:'padding:1px',
	
			items: [{
				xtype:'tabpanel',
				plain:true,
				activeTab: 0,
				height:250,
				defaults:{bodyStyle:'padding:10px'},
				items:[			
					<?
					if( $cotizacion->getCaEmpresa() == Constantes::COLTRANS ){	
					?>							
					   grid_productos,
					   grid_recargos,
					   grid_contviajes,					
					   grid_seguros,
					   grid_agentes
					   
					   
					 <?
					}
					?>   					
					,panelArchivos
			
					
					   
				]
			}]
		});
		subPanel.render(document.body);
	<?	
	}
	?>
    
    
});
</script>
