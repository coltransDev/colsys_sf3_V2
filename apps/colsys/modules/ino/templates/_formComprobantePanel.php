<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
if( !$comprobante->getCaConsecutivo() ){
    $tipos = $sf_data->getRaw("tipos");
}


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



var resultTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><b>{nombre}</b></div></tpl>'
);
/*
var storeTipos = new Ext.data.Store({
    autoload: true,
    proxy: new Ext.data.MemoryProxy(<?=json_encode($tipos)?>),
    reader: new Ext.data.JsonReader({
                        root: 'root',
                        totalProperty: 'total'
                    },
                    new Ext.data.Record.create([
                            {name: 'idtipo', type: 'string'},
                            {name: 'tipo', type: 'string'}
                    ])
                )
});*/

var storeTiposTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><b>{tipo}</b></div></tpl>'
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
            }
            <?
            if( $comprobante->getCaIdcomprobante() ){
            ?>
            
            ,{
                text: 'Previsualizar',
                iconCls: 'page_white_magnify',
                handler : this.previsualizar,
                scope: this
            }
            ,{
                text: 'Generar',
                iconCls: 'page_white_acrobat',
                handler : this.generar,
                scope: this
            }
            <?
            }
            ?>
            ],
            items:[{
                title:'Información General',
                layout:'form',
               

                items: [{
				    layout:'table',
				    border: false,
				    defaults: {
				        // applied to each contained panel
				        bodyStyle:'padding-right:20px',
				        border: false
				    },
				    
				    items: [{
                                layout: 'form',
                                items: [
                                    <?
                                    if( $comprobante->getCaConsecutivo() ){
                                    ?>
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'Consecutivo',
                                        name: 'consecutivo',
                                        value: '<?=$comprobante->getCaConsecutivo()?>',
                                        allowBlank:true,
                                        readOnly: true,
                                        width: 120
                                    },
                                    <?
                                    }else{
                                    ?>
                                    new Ext.form.ComboBox({                                        
                                        fieldLabel: 'Tipo',
                                        valueField:'idtipo',
                                        displayField:'tipo',
                                        typeAhead: true,
                                        width: 200,
                                        emptyText:'',
                                        value: '',
                                        forceSelection:true,
                                        selectOnFocus:true,
                                        allowBlank:false,
                                        name:'tipo',
                                        mode:'local',
                                        triggerAction: 'all',
                                        store: new Ext.data.Store({
                                            autoLoad : true,
                                            reader: new Ext.data.JsonReader(
                                                {
                                                    root: 'root',
                                                    totalProperty: 'total'
                                                },
                                                Ext.data.Record.create([
                                                    {name: 'idtipo', type: 'string'},
                                                    {name: 'tipo', type: 'string'}
                                                ])
                                            ),
                                            proxy: new Ext.data.MemoryProxy(<?=json_encode($tipos)?>)
                                        }),
                                       
                                        onSelect: function(record, index){ // override default onSelect to do redirect
                                            if(this.fireEvent('beforeselect', this, record, index) !== false){
                                                this.setValue(record.data[this.valueField || this.displayField]);
                                                this.collapse();
                                                this.fireEvent('select', this, record, index);
                                            }                                                                                       
                                            Ext.getCmp("idtipo").setValue(record.get("idtipo"));                                            
                                        }
                                    }),
                                    <?
                                    }                                    
                                    ?>
                                    {
                                        xtype:'hidden',
                                        id: 'id',
                                        value: '<?=$comprobante->getCaId()?>'

                                    },
                                    {
                                        xtype:'hidden',
                                        id: 'idtipo',
                                        value: '<?=$comprobante->getCaIdtipo()?>'

                                    },
                                    {
                                        xtype:'hidden',
                                        id: 'idcomprobante',
                                        value: '<?=$comprobante->getCaIdcomprobante()?>'

                                    }
                                ]

                            },
                            {
                                layout: 'form',
                                items: [
                                {
                                    xtype:'datefield',
                                    fieldLabel: 'Fecha',
                                    format: 'Y-m-d',
                                    name: 'fechacomprobante',
                                    value: '<?=Utils::parseDate($comprobante->getCaFchcomprobante(), "Y-m-d")?>',
                                    allowBlank:false,
                                    width: 120
                                }]
                            },
                            {
                                layout: 'form',
                                items: [
                                {
                                    xtype:'numberfield',
                                    fieldLabel: 'Plazo',
                                    name: 'plazo',
                                    value: '<?=$comprobante->getCaPlazo()?>',
                                    allowBlank:false,
                                    allowNegative:false,
                                    decimalPrecision : 0,
                                    width: 80
                                }
                                ]
                            },
                            {
                                layout: 'form',
                                items: [
                                {
                                    xtype:'numberfield',
                                    fieldLabel: 'Tasa de Cambio',
                                    name: 'tasacambio',
                                    value: '<?=$comprobante->getCaTasacambio()?>',
                                    allowBlank:false,
                                    allowNegative:false,
                                    decimalPrecision : 2,                                    
                                    width: 80
                                }
                                ]
                            }
                        ]
                },
					new Ext.form.ComboBox({
				        store: ds,
				        fieldLabel: 'Tercero',
				        displayField:'nombre',
				        typeAhead: false,
                        width: 420,
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
                        readOnly:true,
						onSelect: function(record, index){ // override default onSelect to do redirect
							if(this.fireEvent('beforeselect', this, record, index) !== false){
								this.setValue(record.data[this.valueField || this.displayField]);
								this.collapse();
								this.fireEvent('select', this, record, index);
							}
							
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

            this.getForm().submit({url:'<?=url_for('ino/observeFormComprobantePanel?idinocliente='.$inocliente->getCaIdinocliente())?>',
                                    waitMsg:'Salvando Datos básicos...',
                                    success:function(response,options){
                                        <?
                                        if( !$comprobante->getCaIdcomprobante()  ){
                                        ?>
                                            document.location='<?=url_for("ino/formComprobante?modo=".$modo."&id=".$inocliente->getCaIdinocliente()."&idcomprobante=")?>'+options.result.idcomprobante;
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
    ,
    previsualizar: function(){
        window.open("<?=url_for("ino/generarComprobantePDF?id=".$comprobante->getCaIdcomprobante())?>");

    },

    generar: function(){
        if( confirm("Se generara la factura y se transferira a SIIGO, sera necesario anularla para hacer modificaciones, ¿desea continuar?") ){
            document.location = "<?=url_for("ino/generarComprobante?id=".$comprobante->getCaIdcomprobante())?>";
        }

    }


});

</script>