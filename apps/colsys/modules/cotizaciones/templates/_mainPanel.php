<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$cotizacion = $sf_data->getRaw("cotizacion");
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

$dateFormat = new sfDateFormat();

?>
<script type="text/javascript">

var ds = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for('widgets/listaContactosClientesJSON')?>'
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

var despedida = '<?=str_replace("'", "\'", str_replace("\r", "", str_replace("\n", "<br />",$cotizacion->getCaDespedida())))?>';
	 despedida = despedida.split("<br />").join("\n");
	 
var entrada = '<?=str_replace("'", "\'",str_replace("\r", "", str_replace("\n", "<br />",$cotizacion->getCaEntrada())))?>';
entrada = entrada.split("<br />").join("\n");

var anexos = '<?=str_replace("'", "\'",str_replace("\r", "", str_replace("\n", "<br />",$cotizacion->getCaAnexos())))?>';
anexos = anexos.split("<br />").join("\n");



MainPanel = function(){
    this.preview = new Ext.Panel({
        id: 'preview', 
        

        

        items: [{
            xtype:'tabpanel',
            buttonAlign: 'left',
            activeTab: 0,
            defaults:{autoHeight:true, bodyStyle:'padding:10px'},
            deferredRender:false,
            tbar: [{
                id:'guardar-encabezado-btn',
                text: 'Guardar Encabezado',
                iconCls: 'disk',
                handler : this.guardarEncabezadoForm,
                scope: this
            }],
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
							value: '<?=$tarea?$dateFormat->format($tarea->getCaFchcreado(), "yyyy-MM-dd"):""?>',
							format: "Y-m-d",
							allowBlank:false,
							width: 120,
							maxValue:'<?=date("Y-m-d")?>'

		                }]
				    },{
		                layout: 'form',
		                items: [{
							xtype:'timefield',
							fieldLabel: 'Hora de Solicitud',
							name: 'horaSolicitud',
							value: '<?=$tarea?$dateFormat->format($tarea->getCaFchcreado(),"HH:mm:ss"):""?>',
							format: "H:i:s",
							allowBlank:false,
							width: 140,
							maxValue: '<?=date("H:i")?>'

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
					    value: '<?=str_replace("'", "\\'", $cliente->getCaCompania())?>',
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
				include_component("widgets", "comerciales" ,array("id"=>"vendedor", "label"=>"Representante Comercial", "allowBlank"=>"false", "value"=>$usuario->getCaLogin(), "nivel"=>$nivel ));
				?>

				<?
				if( !$cotizacion->getCaIdcotizacion() ){
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
							value: '<?=$dateFormat->format($cotizacion->getFchpresentacion(), "yyyy-MM-dd")?>',
							format: "Y-m-d",
							allowBlank:true,
							<?=$cotizacion->getFchpresentacion()?" disabled  : true, ":""?>
							width: 120
						},

						{
							xtype:'timefield',
							fieldLabel: 'Hora de Presentación',
							name: 'horaPresentacion',
							value: '<?=$cotizacion->getFchpresentacion()?$dateFormat->format($cotizacion->getFchpresentacion(),"HH:mm:ss"):""?>',
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

			]

        }]
        
    });



    MainPanel.superclass.constructor.call(this, {
        id:'main-tabs',
        labelAlign: 'top',
        title: 'Sistema de cotizaciones <?=$cotizacion->getCaEmpresa()?>',
        bodyStyle:'padding:1px',
		//fileUpload: true,
        items: [
            this.preview
        ]
        
    });

    
};

Ext.extend(MainPanel, Ext.FormPanel, {
    guardarEncabezadoForm: function(){
        if( Ext.getCmp("listaclinton").getValue()=="Sí" ){
            Ext.MessageBox.alert("Alerta","Este cliente se encuentra en lista clinton");
            return 0;
        }

        if( Ext.getCmp("status").getValue()=="Vetado" ){
            Ext.MessageBox.alert("Alerta","Este cliente se encuentra vetado");
            return 0;
        }

        if( this.getForm().isValid() ){

            this.getForm().submit({url:'<?=url_for('cotizaciones/formCotizacionGuardar')?>',
                                    waitMsg:'Salvando Datos básicos de la Cotizaci&oacute;n...',
                                    success:function(response,options){
                                        <?
                                        if( !$cotizacion->getCaIdcotizacion() || !$tarea ){
                                        ?>
                                            document.location='<?=url_for("cotizaciones/consultaCotizacion?id=")?>'+options.result.idcotizacion;
                                        <?
                                        }
                                        ?>
                                       //Ext.Msg.alert( "Msg "+response.responseText );
                                    },
                                    // standardSubmit: false,
                                    failure:function(form,action){
                                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                                    }//end failure block
                                });
        }else{
            Ext.MessageBox.alert('Sistema de Cotizaciones - Error:', '¡Atención: La información básica de la cotización no es válida o está incompleta!');
        }
    }


});

</script>