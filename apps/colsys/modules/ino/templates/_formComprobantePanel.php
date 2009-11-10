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
            url: '<?=url_for('widgets/listaIdsJSON')?>'
        }),
        reader: new Ext.data.JsonReader({
            root: 'root',
            totalProperty: 'totalCount'            
        }, [
            {name: 'id', mapping: 'ca_id'},
            {name: 'nombre', mapping: 'ca_nombre'}
        ])
    });

	//var data_productos = <?//json_encode();?>

	var resultTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><b>{nombre}</b></div></tpl>'
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
							value: '<?=$comprobante->getCaConsecutivo()?>',
							allowBlank:true,
							readOnly: true,
							width: 120
		                },						
						{
							xtype:'hidden',
							id: 'id',
                            value: '<?=$comprobante->getCaIdcomprobante()?>'

		                }
						]
				    }
					]
                },
					new Ext.form.ComboBox({
				        store: ds,
				        fieldLabel: 'Cliente',
				        displayField:'nombre',
				        typeAhead: false,
				        loadingText: 'Buscando...',
				        valueNotFoundText: 'No encontrado' ,
						minChars: 1,
				        tpl: resultTpl,
				        itemSelector: 'div.search-item',
					    emptyText:'Escriba el nombre del cliente...',
					    value: '<?=$comprobante->getIds()?$comprobante->getIds()->getCaNombre():""?>',
					    forceSelection:true,
						selectOnFocus:true,
						allowBlank:false,

						onSelect: function(record, index){ // override default onSelect to do redirect
							if(this.fireEvent('beforeselect', this, record, index) !== false){
								this.setValue(record.data[this.valueField || this.displayField]);
								this.collapse();
								this.fireEvent('select', this, record, index);
							}
							//var mensaje = "";
							Ext.getCmp("id").setValue(record.get("id"));
							//Ext.getCmp("contacto").setValue(record.get("nombre")+' '+record.get("papellido")+' '+record.get("sapellido") );

							

							

						}
					})
				

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
                    allowBlank:true
                }, {
					xtype: 'textarea',
					width: 500,
					fieldLabel: 'Notas',
					name: 'entrada',
					value: '',
                    allowBlank:true
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

            this.getForm().submit({url:'<?=url_for('ino/observeFormComprobantePanel?idmaestra='.$referencia->getCaIdmaestra())?>',
                                    waitMsg:'Salvando Datos básicos...',
                                    success:function(response,options){
                                        <?
                                        if( !$comprobante->getCaIdcomprobante()  ){
                                        ?>
                                            document.location='<?=url_for("ino/formComprobante?id=".$referencia->getCaIdmaestra()."&idcomprobante=")?>'+options.result.idcomprobante;
                                        <?
                                        }
                                        ?>
                                       //Ext.Msg.alert( "Msg "+response.responseText );
                                    },
                                    // standardSubmit: false,
                                    failure:function(response,options){
                                        Ext.Msg.alert( "Error "+response.responseText );
                                    }//end failure block
                                });
        }else{
            Ext.MessageBox.alert('Sistema de Comprobantes - Error:', '¡Atención: La información básica no es válida o está incompleta!');
        }
    }


});

</script>