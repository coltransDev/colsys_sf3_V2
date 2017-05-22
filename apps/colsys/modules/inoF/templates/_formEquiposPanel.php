<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/


$data = $sf_data->getRaw("data");
?>
<script type="text/javascript">
    Ext.form.Field.prototype.msgTarget = 'side';
    FormEquiposPanel = function( config ){
        Ext.apply(this, config);
        
        this.widgetConceptos = new Ext.form.ComboBox({
            name: "concepto",
            hiddenName: "idconcepto",
            fieldLabel: "Tipo",
            valueField: 'idconcepto',
            displayField: 'concepto',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,        
            lazyRender:true,
            mode: 'local',
            listClass: 'x-combo-list-small',
            submitValue: true,
            allowBlank: false,
            tabIndex: 1,
            store: new Ext.data.Store({
                autoLoad : true,
                reader: new Ext.data.JsonReader(
                {
                    root: 'root',
                    totalProperty: 'total',
                    successProperty: 'success'
                },
                Ext.data.Record.create([
                        {name: 'idconcepto'},
                        {name: 'concepto'},
                        {name: 'transporte'},
                        {name: 'modalidad'}
                    ])
                ),
                proxy: new Ext.data.MemoryProxy( <?= json_encode(array("root" => $data, "total" => count($data))) ?> )
            })
        });
        FormEquiposPanel.superclass.constructor.call(this, {
            deferredRender:false,
            autoHeight:true,
            bodyStyle:"padding: 5px",
            buttonAlign: 'center',
            items: [
                {
                    xtype: 'fieldset',
                    title: 'General',
                    autoHeight:true,
                    layout:'column',
                    columns: 2,
                    items :
                    [
                        /*
                         * =========================Column 1 =========================
                         **/
                        {
                            xtype: 'fieldset',
                            columnWidth:.5,
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            items: [
                                {
                                    xtype: "hidden",
                                    name: "idmaster",
                                    value: this.idmaster
                                },
                                {
                                    xtype: "hidden",
                                    name: "idequipo"                                    
                                },
                                {
                                    xtype: "hidden",
                                    name: "modo",
                                    value: this.modo
                                },
                                this.widgetConceptos,                                  
                                {
                                    xtype: "textfield",
                                    fieldLabel: "Precinto",
                                    name: "numprecinto",
                                    allowBlank: true,
                                    maxLength: 30,
                                    tabIndex: 3
                                }
                            ]
                        },
                        /*
                         * =========================Column 2 =========================
                         **/
                        {
                            xtype: 'fieldset',
                            columnWidth:.5,
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            items: [                                    
                                {
                                    xtype: "textfield",
                                    fieldLabel: "Serial",
                                    name: "serial",
                                    allowBlank: false,
                                    maxLength: 30,
                                    tabIndex: 2
                                },
                                {
                                    xtype: "textfield",
                                    fieldLabel: "Observaciones",
                                    name: "observaciones",
                                    allowBlank: true,
                                    tabIndex: 4
                                }
                            ]
                        }
                    ]
                }   
            ],
            buttons:[
                {
                    text: 'Guardar',
                    handler: this.onSave,
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

    Ext.extend(FormEquiposPanel, Ext.form.FormPanel, {
        onSave: function(){
            var form  = this.getForm();
            if( form.isValid() ){
                var gridOpener = this.gridOpener;
                form.submit({
                    url: "<?=url_for("inoF/formEquipoGuardar")?>",                    
                    waitMsg:'Guardando...',
                    waitTitle:'Por favor espere...',
                    success:function(form,action){
                        var win = Ext.getCmp("edit-equipo-win");
                        if( win ){
                            win.close();
                        }
                        if( gridOpener ){
                            var grid = Ext.getCmp( gridOpener);
                            if( grid ){
                                grid.recargar();
                            }
                        }                        
                        
                    },
                    failure:function(form,action){
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                    }
                });
            }else{
                Ext.MessageBox.alert('Error Message', "Por favor complete todos los datos");
            }
        },
        onCancel: function(){
            var win = Ext.getCmp("edit-equipo-win");
            if( win ){
                win.close();
            }
        },
        onRender:function() {
            FormEquiposPanel.superclass.onRender.apply(this, arguments);
            this.getForm().waitMsgTarget = this.getEl();
            var form  = this.getForm();
            if( this.idequipo ){
                this.load({
                    url:'<?=url_for("inoF/datosFormEquiposPanel")?>',
                    waitMsg:'Cargando...',
                    params:{
                        idequipo:this.idequipo,
                        modo:this.modo
                    },
                    success:function(response,options){                        
                        this.res = Ext.util.JSON.decode( options.response.responseText );
                        
                        if(Ext.getCmp("concepto"))
                        {
                            form.findField("concepto").setRawValue(this.res.data.concepto);
                            form.findField("concepto").hiddenField.value = this.res.data.idconcepto;
                        }
                    }
                });
            }
        }
    });
</script>