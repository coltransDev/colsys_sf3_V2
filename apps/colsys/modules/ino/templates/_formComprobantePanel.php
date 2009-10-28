<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


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

FormComprobantePanel = function(){
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
							value: 'C',
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
				    }
					]
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
					    value: '',
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
							/*if( $user->getIddepartamento()!=5 ){
							?>
								Ext.getCmp("vendedor_id").setRawValue(record.get("nombre_ven"));
								Ext.getCmp("vendedor_id").hiddenField.value = record.get("vendedor");
							<?
							}*/
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
					value: '',
                    allowBlank:false
				},{
					id: 'idconcliente',
					xtype:'hidden',
					name: 'idconcliente',
					value: '',
                    allowBlank:false
				},{
					id: 'contacto',
					xtype:'textfield',
					fieldLabel: 'Persona de Contacto',
					name: 'contacto',
					value: '',
                    allowBlank:false,
					readOnly: true
				}

				]
            },{
                title:'Notas',
                layout:'form',
                defaults: {width: 230},
                defaultType: 'textfield',

                items: [{
					xtype:'textfield',
					width: 500,
					fieldLabel: 'Asunto',
					name: 'asunto',
					value: '',
                    allowBlank:false
                }, {
					xtype: 'textarea',
					width: 500,
					fieldLabel: 'Notas',
					name: 'entrada',
					value: '',
                    allowBlank:false
                }]
            }
			

			

			]

        }]

    });



    FormComprobantePanel.superclass.constructor.call(this, {
        id:'main-tabs',
        labelAlign: 'top',
        title: 'Generación de Comprobantes',
        bodyStyle:'padding:1px',
		//fileUpload: true,
        items: [
            this.preview
        ]

    });


};

Ext.extend(FormComprobantePanel, Ext.FormPanel, {
    guardarEncabezadoForm: function(){
        

        if( this.getForm().isValid() ){

            this.getForm().submit({url:'<?=url_for('cotizaciones/formCotizacionGuardar')?>',
                                    waitMsg:'Salvando Datos básicos de la Cotizaci&oacute;n...',
                                    success:function(response,options){
                                        <?
                                        //if( !$cotizacion->getCaIdcotizacion() || !$tarea ){
                                        ?>
                                            document.location='<?=url_for("cotizaciones/consultaCotizacion?id=")?>'+options.result.idcotizacion;
                                        <?
                                        //}
                                        ?>
                                       //Ext.Msg.alert( "Msg "+response.responseText );
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


});

</script>