<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
include_component("widgets", "widgetImpoexpo");
include_component("widgets", "widgetTransporte");
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetLinea");
include_component("widgets", "widgetPais");
include_component("widgets", "widgetAgente");


include_component("widgets", "widgetComerciales");
include_component("widgets", "widgetCliente");
?>

<script type="text/javascript">
    
   
    
    FormConsultaPanel = function( config ){
        Ext.apply(this, config);       
        
        
        
        FormConsultaPanel.superclass.constructor.call(this, {
            deferredRender:false,
            autoHeight:true,
            bodyStyle:"padding: 5px",
            buttonAlign: 'center',   
            standardSubmit: true,
            items: [
                {
                    xtype:'fieldset',
                    title: 'Filtros por trayecto',
                    autoHeight:true,
                    layout:'column',
                    columns: 2,
                    defaults:{
                        columnWidth:0.5,
                        layout:'form',
                        border:false,
                        bodyStyle:'padding:4px'
                    },
                    items :
                        [
                        /*
                         * =========================Column 1 =========================
                         **/
                        {
                            xtype:'fieldset',
                            columnWidth:.5,
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            items: [
                                new WidgetImpoexpo({
                                        fieldLabel:     'Tipo',
                                        id:             'impoexpo_fld',
                                        name:           'impoexpo',
                                        hiddenName:     'impoexpo',
                                        allowBlank:     false,
                                        tabIndex:1
                                    }
                                ),                                
                                new WidgetLinea({fieldLabel: 'Linea',
                                    linkTransporte: "transporte",
                                    name: 'linea',
                                    id: 'linea',
                                    hiddenName: 'idlinea',
                                    hiddenId: "idlinea",
                                    allowBlank: true,
                                    tabIndex:3
                                }),
                                new WidgetPais({fieldLabel: 'Trafico',
                                    name: 'trafico',
                                    id: 'trafico',
                                    hiddenName: 'idtrafico',
                                    allowBlank: true,                                                                                                                    
                                    tabIndex:5,
                                    pais:"todos"
                                }),
                                
                            ]
                        },
                        /*
                         * =========================Column 2 =========================
                         **/
                        {
                            xtype:'fieldset',
                            columnWidth:.5,
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            items: [                                                                
                                new WidgetTransporte({
                                    id: 'transporte',
                                    name: 'transporte',
                                    fieldLabel: 'Transporte',
                                    tabIndex:2
                                }),
                                new WidgetModalidad({fieldLabel: 'Modalidad',
                                    id: 'modalidad',
                                    name: 'modalidad',
                                    linkTransporte: "transporte",
                                    linkImpoexpo:"impoexpo_fld",     
                                    allowBlank: true,
                                    tabIndex:4
                                }),
                                
                                
                                new WidgetAgente({fieldLabel: 'Agente',
                                    linkImpoExpo: "impoexpo_fld",
                                    linkTrafico: "trafico",                                    
                                    linkListarTodos: "listar_todos",
                                    name:"agente",
                                    hiddenName: 'idagente',
                                    allowBlank: true,
                                    tabIndex:8
                                }),
                                {
                                    xtype: "checkbox",
                                    fieldLabel: "Listar todos",
                                    id: "listar_todos",
                                    tabIndex:10
                                }
                                
                            ]
                        }
                    ]
                },
                {
                    xtype:'fieldset',
                    title: 'Otros filtros',
                    autoHeight:true,
                    layout:'column',
                    columns: 2,
                    defaults:{
                        columnWidth:0.5,
                        layout:'form',
                        border:false,
                        bodyStyle:'padding:4px'
                    },
                    items :
                        [
                        /*
                         * =========================Column 1 =========================
                         **/
                        {
                            xtype:'fieldset',
                            columnWidth:.5,
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            items: [
                                new WidgetCliente({
                                    fieldLabel:'Cliente ',
                                    width:500,
                                    id:"cliente",
                                    hiddenName:"idcliente"                                                  
                                }),
                                
                                {
                                    xtype:          'combo',
                                    mode:           'local',
                                    value:          '<?=date("Y")?>',
                                    triggerAction:  'all',
                                    forceSelection: true,
                                    editable:       true,
                                    fieldLabel:     'Año',
                                    name:           'aa',
                                    hiddenName:     'aa',
                                    displayField:   'name',
                                    valueField:     'value',
                                    allowBlank:     false,
                                    store:          new Ext.data.JsonStore({
                                        fields : ['name', 'value'],
                                        data   : [
                                            <?

                                            for( $i=2006; $i<=date("Y"); $i++ ){
                                                echo ($i>2006)?",":"";
                                                echo "{name : '".$i."',   value: '".$i."'}";
                                            }
                                            ?>
                                        ]
                                    })
                                }
                            ]
                        },
                        /*
                         * =========================Column 2 =========================
                         **/
                        {
                            xtype:'fieldset',
                            columnWidth:.5,
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            items: [   
                                
                                new WidgetComerciales({
                                    fieldLabel:'Comercial',
                                    name: 'vendedor',
                                    hiddenName: 'login'
                                }),
                                {
                                    xtype:          'combo',
                                    mode:           'local',
                                    value:          '',
                                    triggerAction:  'all',
                                    forceSelection: true,
                                    editable:       true,
                                    fieldLabel:     'Mes',
                                    name:           'mm',
                                    hiddenName:     'mm',
                                    displayField:   'name',
                                    valueField:     'value',
                                    allowBlank:     true,
                                    store:          new Ext.data.JsonStore({
                                        fields : ['name', 'value'],
                                        data   : [
                                            <?

                                            for( $i=1; $i<=12; $i++ ){
                                                echo ($i>1)?",":"";
                                                echo "{name : '".Utils::mesLargo($i)."',   value: '".$i."'}";
                                            }
                                            ?>
                                        ]
                                    })
                                }
                            ]
                            
                            
                        }
                       
                    ]
                }
            ],
            buttons:[
                {
                    text: 'Consultar',
                    handler: this.consultar,
                    scope: this
                },
                {
                    text: 'Cancelar',
                    handler: this.onCancel,
                    scope: this
                }
            ]
        });
    };
    Ext.extend(FormConsultaPanel, Ext.form.FormPanel, {
        consultar: function(){        
            var form  = this.getForm();
            
			if( this.url){                
				form.getEl().dom.action= this.url;
            }				
			
            if( form.isValid() ){
                form.submit();
            }else{
                Ext.MessageBox.alert('Error Message', "Por favor complete todos los datos");
            }
        },
        onCancel: function(){            
            document.location = "<?=url_for("inoReportes/index")?>";            
        },
        onRender:function() {
            FormConsultaPanel.superclass.onRender.apply(this, arguments);
            this.getForm().waitMsgTarget = this.getEl();
        }
        
    });
</script>