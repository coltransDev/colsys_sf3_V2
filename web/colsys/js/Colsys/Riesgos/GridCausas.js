/**
 * @autor Andrea Ramírez
 Administración de Causas de los Riesgos
 
 @comment Muestra una Grilla con las causas de cada Riesgo definidas independientemente ya que se deben asociar con los eventos que
surgen en cada riesgo
 */
var winCausa = null;
Ext.define('Colsys.Riesgos.GridCausas', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Riesgos.GridCausas',    
    autoHeight: true,
    autoScroll: true,
    frame: true,
    controller: 'cell-editing',
    selModel: {
        selType: 'cellmodel'
    },
    viewConfig: {
        getRowClass: function (record, rowIndex, rowParams, store) {
            if (record.data.nueva)
                return "row_pink";                            
        }
    },
    listeners:{        
        beforerender: function(ct, position){
            this.reconfigure(
                store = Ext.create('Ext.data.Store', {
                    fields: [
                        {name: 'id',     type: 'integer'},
                        {name: 'color',  type: 'string'},
                        {name: 'causa',  type: 'string'},
                        {name: 'nueva',  type: 'boolean'},
                        {name: 'orden',  type: 'integer'},
                    ],
                    proxy: {
                        type: 'ajax',
                        url: '/riesgos/datosCausas',
                        extraParams:{
                            idriesgo: this.idriesgo
                        },
                        reader: {
                            type: 'json',
                            rootProperty: 'root',
                            totalProperty: 'total'
                        }
                    },        
                    sorters: [{
                        property: 'valor',
                        direction: 'ASC'
                    }],
                    autoLoad: true
                }),
                [
                    {dataIndex: 'id', hidden: true},        
                    {header: "Orden", dataIndex: 'orden', flex:2 },
                    {header: "Causa", dataIndex: 'causa', flex:10 },
                    {xtype: 'actioncolumn',
                        width: 30,
                        sortable: false,
                        menuDisabled: true,
                        items: [{
                            iconCls: 'page_white_edit',
                            tooltip: 'Editar Causa',
                            handler: 'onEditClick'
                        }]
                    },
                    {xtype: 'actioncolumn',
                        width: 30,
                        sortable: false,
                        menuDisabled: true,
                        items: [{
                            iconCls: 'delete',
                            tooltip: 'Eliminar Causa',
                            handler: 'onRemoveClick'
                        }]
                    }
                ]
            );
    
            tbar = [{
                    xtype: 'toolbar',
                    dock: 'top',
                    id: 'bar-cau-'+this.idriesgo,                                    
                    items: [{
                        text: 'Agregar',
                        iconCls: 'add',
                        handler : 'onAddClick'
                    },{
                        text: 'Refrescar',
                        iconCls: 'refresh',
                        handler : function(){
                            this.up("grid").getStore().reload();
                        }
                    }
                ]
            }]
            this.addDocked(tbar);                                
        }       
    }
});

Ext.define('Colsys.view.grid.CellEditingController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.cell-editing',
    onAddClick: function () {
        var idriesgo = this.getView().idriesgo;
        if(idriesgo)
            this.ventanaCausa(idriesgo);
        else
            Ext.MessageBox.alert("Mensaje", "Por favor crear el riesgo antes de agregar las causass");
    },
    onEditClick: function (view, recIndex, cellIndex, item, e, record) {        
        this.ventanaCausa(this.getView().idriesgo, record);        
    },
    onRemoveClick: function (view, recIndex, cellIndex, item, e, record) {
        //record.drop();
        Ext.Ajax.request({
            waitMsg: 'Guardando cambios...',
            url: '/riesgos/eliminarCausa',
            params: {
                idcausa: record.data.id
            },
            failure: function (response, options) {
                var res = Ext.util.JSON.decode(response.responseText);
                if (res.errorInfo)
                    Ext.MessageBox.alert("Mensaje", 'Se presento un error eliminando<br>' + res.errorInfo);                
            },
            success: function (response, options) {
                var res = Ext.util.JSON.decode(response.responseText);
                window.close();
                if(res.success){
                    Ext.MessageBox.alert("Mensaje", res.mensaje);
                }else{
                    Ext.MessageBox.alert("Mensaje", 'Se presento un error eliminando<br>' + res.errorInfo);   
                }
                Ext.getCmp("ca_causas").getStore().reload();                
            }       
        });   
    },
    ventanaCausa: function(idriesgo, record){
        
        var titulo = record?'Editar Causa # '+record.data.orden:"Crear Causa";
        var idcausa = record?record.data.id:null;
        
        if (winCausa == null) {
            winCausa = Ext.create('Ext.window.Window', {
                title: titulo,
                width: 400,
                height: 260,
                id: 'winCausa',                
                bodyPadding: 10,
                maximizable: true,
                layout: 'anchor',
                closeAction: 'destroy',
                items: [
                    Ext.create('Ext.form.Panel', {                        
                        bodyPadding: 5,
                        url: '/riesgos/guardarCausa',
                        layout: 'anchor',
                        defaults: {
                            anchor: '100%'
                        },                        
                        items: [{
                            xtype: 'hidden',
                            name: 'id'
                        },
                        {
                            xtype:'checkboxfield',
                            fieldLabel: 'Nueva',
                            //width: 300,
                            id:'nueva',
                            name:'nueva'
                        },
                        {
                            xtype: 'numberfield',
                            anchor: '50%',
                            id: 'orden',
                            name: 'orden',
                            fieldLabel: 'Orden',                            
                            maxValue: 99,
                            minValue: 1,
                            allowBlank: false                            
                        },
                        {
                            xtype: 'textareafield',
                            id: 'causa',
                            name: 'causa',
                            fieldLabel: 'Causa',
                            height: 120/*,
                            enableFont: false,                              
                            enableFontSize: false,
                            enableFormat: false,
                            enableAlignments : false,
                            enableLinks: false,
                            enableLists: false,
                            enableSourceEdit: false,
                            allowBlank: false*/
                        }],
                        // Reset and Submit buttons
                        buttons: [{
                            text: 'Guardar',
                            formBind: true, //only enabled once the form is valid
                            disabled: true,
                            handler: function() {
                                var form = this.up('form').getForm();
                                if (form.isValid()) {
                                    if(form.findField('causa').getValue() == null || form.findField('causa').getValue()==''){
                                         Ext.Msg.alert('Error', "La causa no puede estar vac\u00EDa!");
                                    }else{                                        
                                        form.submit({
                                            params: {
                                                idriesgo: idriesgo
                                            },
                                            success: function(form, action) {
                                               Ext.Msg.alert('Mensaje', action.result.msg);                                               
                                               winCausa.close();
                                               Ext.getCmp("ca_causas").getStore().reload();
                                               me = Ext.getCmp("subpanel-general"+idriesgo);                                
                                               Ext.getCmp('general'+idriesgo).cargar(me, idriesgo);
                                            },
                                            failure: function(form, action) {                                                
                                                Ext.Msg.alert('Error', action.result.erroInfo);
                                            }
                                        });
                                    }
                                }
                            }
                        }],
                        listeners: {
                            afterrender: function(me, eOpts){
                                if(idcausa){
                                    var f = this.getForm();
                                    f.load({
                                        url: '/riesgos/datosCausas',
                                        params: {
                                            idriesgo : idriesgo,
                                            idcausa: idcausa
                                        },
                                        success: function () {
                                            //alert("si");
                                        },
                                        failure: function(){
                                            //alert("mo");
                                        }
                                    });
                                }
                            }
                        }
                    })
                ],
                listeners: {
                    close: function (win, eOpts) {
                        winCausa = null;
                    },
                    show: function () {
                        winCausa.superclass.show.apply(this, arguments);
                    }
                },
                onGuardarCausa: function(idcausa, window){
                    Ext.Ajax.request({
                        waitMsg: 'Guardando cambios...',
                        url: '/riesgos/guardarCausa',
                        params: {
                            idcausa: idcausa,
                            orden: Ext.getCmp("orden-causa").getValue(),
                            causa: Ext.getCmp("html-causa").getValue()
                        },
                        failure: function (response, options) {
                            var res = Ext.util.JSON.decode(response.responseText);
                            if (res.errorInfo)
                                Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.errorInfo);
                            else
                                Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                        },
                        success: function (response, options) {
                            var res = Ext.util.JSON.decode(response.responseText);
                            window.close();
                            if(res.success){
                                Ext.MessageBox.alert("Mensaje", 'Se guardó el texto correctamente!');
                            }
                            Ext.getCmp("ca_causas").getStore().reload();                            
                        }       
                    });   
                }
            });
            winCausa.show();           

        } else {
            alert("Ya existe una ventana de edici\u00F3n de Causa abierta")
        }
    }
})