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
<div id="panel1" align="left"></div>
<div id="panel2" align="left"></div>
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
	if( $cotizacion->getCaIdcotizacion() ){
	
		include_component("gestDocumental", "panelArchivos", 
						array("dataUrl"=>"cotizaciones/dataArchivosCotizacion?idcotizacion=".$cotizacion->getCaIdcotizacion(),
							"viewUrl"=>"cotizaciones/verArchivo?idcotizacion=".$cotizacion->getCaIdcotizacion(),
							"deleteUrl"=>"cotizaciones/eliminarArchivo?idcotizacion=".$cotizacion->getCaIdcotizacion(),
							"object"=>"panelArchivos", 
							"closable"=>false, 
							"uploadURL"=>"cotizaciones/adjuntarArchivo?idcotizacion=".$cotizacion->getCaIdcotizacion() 
						));
	}
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
			{name: 'listaclinton', mapping: 'ca_listaclinton'},
			{name: 'fchcircular', mapping: 'ca_fchcircular', type:'int'},
			{name: 'status', mapping: 'ca_status'}
        ])
    });

	//var data_productos = <?//json_encode();?>
	
	var resultTpl = new Ext.XTemplate( 
        '<tpl for="."><div class="search-item"><b>{compania}</b><br /><span>{nombre} {papellido} {sapellido} <br />{cargo}</span> </div></tpl>' 
    );



    Ext.QuickTips.init();

    // turn on validation errors beside the field globally
    Ext.form.Field.prototype.msgTarget = 'side';
    /*
     * ================  Main Form  =======================
     */
	 
	 var despedida = '<?=str_replace("'", "\'", str_replace("\r", "", str_replace("\n", "<br />",$cotizacion->getCaDespedida())))?>';
	 despedida = despedida.split("<br />").join("\n");
	 
	 var entrada = '<?=str_replace("'", "\'",str_replace("\r", "", str_replace("\n", "<br />",$cotizacion->getCaEntrada())))?>';
	 entrada = entrada.split("<br />").join("\n");
	 
	 var anexos = '<?=str_replace("'", "\'",str_replace("\r", "", str_replace("\n", "<br />",$cotizacion->getCaAnexos())))?>';
	 anexos = anexos.split("<br />").join("\n");
	 
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
                title:'Información General',
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
		                },
						{
							xtype:'hidden',
							id: 'listaclinton'
							
		                },
						{
							xtype:'hidden',
							id: 'status'
							
		                }
						]
				    },
					{
		                layout: 'form',
		                items: [{
							xtype:'datefield',
							fieldLabel: 'Fecha de Solicitud',
							name: 'fchSolicitud',
							value: '<?=$tarea?$tarea->getCaFchcreado("Y-m-d"):""?>',
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
							value: '<?=$tarea?$tarea->getCaFchcreado("H:i:s"):""?>',
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
							var mensaje = "";
							Ext.getCmp("idconcliente").setValue(record.get("idcontacto"));
							Ext.getCmp("contacto").setValue(record.get("nombre")+' '+record.get("papellido")+' '+record.get("sapellido") );
							
							/*Ext.getCmp("usuario").setValue(record.get("vendedor"));
							Ext.getCmp("vendedor_id").setValue(record.get("nombre_ven"));*/
							<?
							if( $user->getIddepartamento()!=5 ){
							?>							
								Ext.getCmp("vendedor_id").setRawValue(record.get("nombre_ven"));
								Ext.getCmp("vendedor_id").hiddenField.value = record.get("vendedor");	
							<?
							}
							?>
							
							Ext.getCmp("listaclinton").setValue(record.get("listaclinton"));
							Ext.getCmp("status").setValue(record.get("status"));							
							
							if( record.get("status")=="Vetado" ){	
								if( mensaje!=""){
									mensaje+="<br />";
								}
								mensaje += "Este cliente se encuentra vetado";															
							}
							
							if( record.get("listaclinton")=="Sí" ){								
								//Ext.MessageBox.alert("Alerta","Este cliente se encuentra en lista clinton");
								if( mensaje!=""){
									mensaje+="<br />";
								}
								mensaje += "Este cliente se encuentra en lista clinton";	
							}
							
							var fchcircular = record.get("fchcircular");
							//alert( fchcircular);
							if( !fchcircular ){
								//Ext.MessageBox.alert("Alerta","El cliente no tiene circular 170");
								if( mensaje!=""){
									mensaje+="<br />";
								}
								mensaje += "El cliente no tiene circular 170";	
								
							}else{
								if( fchcircular+(86400*365)<=<?=time()?> ){
									if( mensaje!=""){
										mensaje+="<br />";
									}
									mensaje += "La circular 170 se encuentra vencida";	
									//Ext.MessageBox.alert("Alerta","La circular 170 se encuentra vencida");
								}else{
									if( fchcircular+(86400*335)<=<?=time()?> ){
										//Ext.MessageBox.alert("Alerta","La circular 170 se vencera en menos de 30 dias");
										if( mensaje!=""){
											mensaje+="<br />";
										}
										mensaje += "La circular 170 se vencera en menos de 30 dias";	
									}
								}
							}
							
							if( mensaje!=""){
								Ext.MessageBox.alert("Alerta", mensaje);
							}
														
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
				},
				<?				
				include_component("widgets", "comerciales" ,array("id"=>"vendedor", "label"=>"Representante Comercial", "allowBlank"=>"true", "value"=>$usuario->getCaLogin(), "nivel"=>$nivel ));
				?>
				
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
					value: entrada,
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
					value: anexos,
                    allowBlank:false
                }

				]
            },
			{
                title:'IDG',
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
				        columns: 2
				    },
				    items: [
					{
		                layout: 'form',
		                items: [{
							xtype:'datefield',
							fieldLabel: 'Fecha de Presentación',
							name: 'fchPresentacion',
							value: '<?=$cotizacion->getFchpresentacion("Y-m-d")?>',
							format: "Y-m-d", 
							allowBlank:true,
							<?=$cotizacion->getFchpresentacion()?" disabled  : true, ":""?>
							width: 120		                
						},
						
						{
							xtype:'timefield',
							fieldLabel: 'Hora de Presentación',
							name: 'horaPresentacion',
							value: '<?=$cotizacion->getFchpresentacion("H:i:s")?>',
							format: "H:i:s", 
							allowBlank:true,
							<?=$cotizacion->getFchpresentacion()?"disabled : true, ":""?>
							width: 100
		                }
						,{
							xtype:'textfield',
							width: 400,
							fieldLabel: 'Observaciones',
							name: 'observaciones_idg',
							value: '<?=$tarea?$tarea->getCaObservaciones():""?>',
							allowBlank:true
						}
						
						]
				    }
					
					
					
					
					
					
					
					
					]
                }
				
				
				]
            },
			
			{
                title:'Formato',
                layout:'form',
                defaults: {width: 230},
                defaultType: 'textfield',

                items: [	
					new Ext.form.ComboBox({		
						fieldLabel: 'Fuente',			
						typeAhead: true,
						forceSelection: true,
						triggerAction: 'all',				
						selectOnFocus: true,				
						name: 'fuente',
						id: 'fuente_id',	
						lazyRender:true,
						allowBlank: false,
						value: '<?=$cotizacion->getCaFuente()?$cotizacion->getCaFuente():"Tahoma"?>',
						listClass: 'x-combo-list-small',	
						store : [						
									['Arial', 'Arial'],
									['Calibri', 'Calibri'],
									['Tahoma', 'Tahoma']						
							]
					})				
				]
            }
			
			],

	        buttons: [{
	            text: 'Salvar',
	            handler: function(){
					if( Ext.getCmp("listaclinton").getValue()=="Sí" ){
						Ext.MessageBox.alert("Alerta","Este cliente se encuentra en lista clinton");
						return 0;
					}
					
					if( Ext.getCmp("status").getValue()=="Vetado" ){
						Ext.MessageBox.alert("Alerta","Este cliente se encuentra vetado");
						return 0;
					}
	            	if( mainPanel.getForm().isValid() ){
						
	            		mainPanel.getForm().submit({url:'<?=url_for('cotizaciones/formCotizacionGuardar')?>', 
	            							 	waitMsg:'Salvando Datos básicos de la Cotizaci&oacute;n...',
												success:function(response,options){														
													<?
													if( !$cotizacion->getCaIdcotizacion() || !$tarea ){
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
						Ext.MessageBox.alert('Sistema de Cotizaciones - Error:', '¡Atención: La información básica de la cotización no es válida o está incompleta!');
					}	            	
	            }
	        }
			]
        }]
    });
	mainPanel.render("panel1");
     <?
	 if( $cotizacion->getCaIdcotizacion() && $tarea && $cotizacion->getCaEmpresa() == Constantes::COLTRANS ){
	 	
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
				id: 'tpanel', 
				plain:true,
				activeTab: 0,
				height:250,	
				autoWidth : true, 			
				defaults:{bodyStyle:'padding:10px'},				
				items:[			
					<?
					if( $cotizacion->getCaEmpresa() == Constantes::COLTRANS ){	
					?>							
					   grid_productos,
					   grid_contviajes,			
					   grid_recargos,					  		
					   grid_seguros,
					   grid_agentes
					   
					   
					 <?
					}
					?>   					
					,panelArchivos
			
					
					   
				]
			}]
		});
		
		

		subPanel.render("panel2");
		
		
		var tWidth = Ext.get('tpanel').getWidth();
		<?
		if( $cotizacion->getCaEmpresa() == Constantes::COLTRANS ){	
			//Para que funcione en IE6 se deben ajustar el tamaño de los grids
		?>		
			grid_recargos.setWidth(tWidth - 2); //fudged it until the horizontal scrollbar went away 
			grid_contviajes.setWidth(tWidth - 2); 
			grid_seguros.setWidth(tWidth - 2); 
			grid_agentes.setWidth(tWidth - 2); 			
		 <?
		}
		?>

	<?	
	}
	?>
    
    
});
</script>

