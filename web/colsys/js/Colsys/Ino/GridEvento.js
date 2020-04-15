/**
 * @autor Felipe Nariño
 Administración de eventos
 para referencias en INO
 
 @comment Muestra una Grilla con los eventos para cada referencia
 permitiendo al usuario asignar la fecha, si fue realizado o no
 y documentos para los casos SAE y DEX.
 */

var win_sae = null;
var win_dex = null;
var constrainedWin2 = null;
var win_exportar = null;
var win_resumen = null;
Ext.Loader.setConfig({
    enabled: true
});
Ext.define('ComboSiNo', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-si-no',
    store: ['SI', 'NO']
});

Ext.define('Colsys.Ino.GridEvento', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Ino.GridEvento',
    selModel: {
        selType: 'cellmodel'
    },
    frame: true,
    listeners: {
        render: function (ct, position) {
            var me = this;
            casouso = Ext.getCmp("ca_modalidad" + this.idmaster).getValue();
            
            this.getStore().load({
                params: {
                    caso_uso: casouso,
                    referencia: this.idreferencia,
                    tipo: this.tipo
                },
                callback: function(records, operation, success) {
                    console.log(records);
                    if (records.length > 0){
                        var data = records[0].data;
                        
                        Ext.getCmp("Panel-Eventos-"+me.idmaster).add(
                            Ext.create('Ext.Panel', {                                    
                                layout: {
                                    type: 'vbox',
                                    pack: 'start',
                                    align: 'stretch'
                                },
                                title: 'Mandatos y Resumen',
                                id: "subpanel-eventos-" + me.idmaster,
                                name: "subpanel-eventos-" + me.idmaster,
                                flex: 1,
                                margin: '0 10 10 0',                            
                                bodyPadding: 5,
                                collapsible: true,
                                collapseDirection : 'right',                                    
                                items:[{
                                    xtype: 'Colsys.Crm.GridControlMandatos',
                                    title: 'Mandatos '+data.cliente,
                                    idcliente: data.idclientehouse,                      
                                    id: 'grid-mandatos-'+me.idmaster,
                                    name: 'grid-mandatos-'+me.idmaster,
                                    permisos: me.permisoscrm,
                                    idmaster: me.idmaster,
                                    flex:1
                                },
                                Ext.create('Ext.Panel', {
                                    id: "subpanel-lastdoc-" + me.idmaster,
                                    name: "subpanel-lastdoc-" + me.idmaster,
                                    title: 'Resumen Eventos',
                                    idreferencia: me.idreferencia,
                                    flex:1,
                                    listeners:{
                                        afterrender: function (t, eOpts){
                                            me.actualizarPanelResumen(data, t);
                                        }
                                    }
                                })]
                            })
                        )
                    }else{
                        Ext.Msg.alert('Error', "Es necesario ingresar el House para desplegar los eventos!");
                    }
                }
            });
        },
        beforerender: function (ct, position) {
            this.setHeight(this.up('tabpanel').up('tabpanel').getHeight() - 200);
            this.setWidth(this.up('tabpanel').up('tabpanel').getWidth() - 150);  
            
            var me = this;
            
            this.reconfigure(
                store = Ext.create('Ext.data.Store', {
                    id: 'storeEventos',
                    autoLoad: false,
                    fields: [
                        {name: 'idevento', type: 'string'},
                        {name: 'evento', type: 'string'},
                        {name: 'fchevento'},
                        {name: 'seleccionado'},
                        {name: 'opcion',type: 'string'},
                        {name: 'tiposespecial', type: 'string'},
                        {name: 'documentos', type: 'string'},
                        {name: 'ultimoevento', type: 'date', dateFormat:'Y-m-d'},
                        {name: 'infoeventos', type: 'string'},
                        {name: 'idclientehouse', type: 'integer'}
                    ],
                    proxy: {
                        type: 'ajax',
                        url: '/inoF2/datosEventos',
                        reader: {
                            type: 'json',
                            rootProperty: 'root'
                        },
                        filterParam: 'query'
                    }
                }),
                [{
                        xtype: "checkcolumn",
                        dataIndex: 'seleccionado',
                        flex: 1,                        
                        listeners: {
                            checkchange: function (grid, rowIndex, colIndex) {

                            var record = this.up('grid').getStore().getAt(rowIndex);

                                if (record.get('seleccionado')) {
                                    var formattedDate = new Date();
                                    var d = formattedDate.getDate();
                                    if (d < 10) {
                                        d = "0" + d;
                                    }
                                    var m = formattedDate.getMonth();
                                    m += 1;
                                    if (m < 10) {
                                        m = "0" + m;
                                    }
                                    var y = formattedDate.getFullYear();
                                    var fch = y + "-" + m + "-" + d;
                                    record.set('fchevento', fch);
                                } else {
                                    record.set('fchevento', '');
                                }
                            }
                        }
                    }, {
                        header: "idevento",
                        dataIndex: 'idevento',
                        sortable: true,
                        hidden: true
                    }, {
                        header: 'Realizado',
                        dataIndex: 'opcion',
                        sortable: true,
                        flex: 1,                        
                        editor: {
                            xtype: 'combo-si-no',
                            allowBlank: 'true',
                            forceSelection: 'false'
                        }
                    }, {
                        header: "Evento",
                        dataIndex: 'evento',
                        sortable: true,
                        flex: 4,                        
                    }, {
                        header: "Fecha",
                        readOnly: true,
                        dataIndex: 'fchevento',
                        sortable: true,
                        flex: 2,                        
                        renderer: function (a, b, c, d) {
                            if (a) {
                                var formattedDate = new Date(a);
                                var formattedDate = new Date(formattedDate.valueOf() + formattedDate.getTimezoneOffset() * 60000);
                                var d = formattedDate.getDate();
                                if (d < 10) {
                                    d = "0" + d;
                                }
                                var m = formattedDate.getMonth();
                                m += 1;
                                if (m < 10) {
                                    m = "0" + m;
                                }
                                var y = formattedDate.getFullYear();
                                return y + "-" + m + "-" + d;
                            }
                        },
                        editor: {
                            xtype: 'datefield',readOnly: true,format:'Y-m-d'
                        }
                    }, {
                        header: "tipoespecial",
                        dataIndex: 'tipoespecial',
                        hidden: true
                    }, {
                        menuDisabled: true,
                        sortable: false,
                        xtype: 'actioncolumn',
                        flex: 1,
                        items: [{
                                getClass: function (v, meta, rec) {
                                    if (rec.get('tipoespecial')) {
                                        return 'import';
                                    }
                                },
                                handler: function (grid, rowIndex, colIndex) {
                                    var rec = grid.getStore().getAt(rowIndex);                                        
                                    if(rec.get('evento')=="SAE" || rec.get('evento')=="DEX"){ // Ticket 61050                                            
                                        rec.set('seleccionado', true);
                                        var ref = this.up('grid').idreferencia;

                                        win_dex = new Ext.Window({
                                            title: 'Documentos',
                                            width: 535,
                                            height: 450,
                                            tipoespecial: rec.get('tipoespecial'),
                                            idevento: rec.get('idevento'),
                                            closeAction: 'destroy',
                                            items: {
                                                autoScroll: true,
                                                items: [{
                                                    xtype: 'Colsys.Ino.GridDocEventos',
                                                    id: 'grid-doc-eventos' + ref,
                                                    name: 'grid-doc-eventos',
                                                    idreferencia: ref
                                                }]
                                            },
                                            listeners: {
                                                beforeshow: function (eOpts) {
                                                    Ext.getCmp('grid-doc-eventos' + ref).cargar(rec.get('idevento'), this.tipoespecial);
                                                },
                                                close: function (win, eOpts) {
                                                    win_dex = null;
                                                }
                                            }
                                        });
                                        win_dex.show();
                                    }
                                }
                            }]
                    }, {
                        header: "Documentos",
                        dataIndex: 'documentos',
                        flex: 6
                    }]
                );

            if (this.permisos.Crear == true || this.permisos.Editar == true) {
                tb = new Ext.toolbar.Toolbar();
                tb.add({
                    id: 'bntGuardar',
                    text: 'Guardar',
                    iconCls: 'add',
                    handler: function () {

                        var ref = this.up('grid').idreferencia;
                        var datosincompletos = false;
                        x = 0;
                        changes = [];
                        var storG = this.up('grid').getStore();
                        for (var i = 0; i < storG.getCount(); i++) {
                            var record = storG.getAt(i);
                            
                            if (Ext.Object.getSize(record.getChanges()) != 0) {
                                record.data.id = record.id;
                                changes[x] = record.data;
                                x++;

                                if (record.get('fchevento') == "") {
                                    datosincompletos = true;
                                }
                            }
                        }
                        var strGrid = JSON.stringify(changes);
                        if (!datosincompletos) {
                            Ext.Ajax.request({
                                waitMsg: 'Guardando cambios...',
                                url: '/inoF2/guardarEventos',
                                params: {
                                    datosGrid: strGrid,
                                    referencia: ref
                                },
                                failure: function (response, options) {
                                    var res = Ext.util.JSON.decode(response.responseText);
                                    if (res.errorInfo)
                                        Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.errorInfo);
                                    else
                                        Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                                },
                                success: function (response, options) {

                                    var res = Ext.decode(response.responseText);
                                    Ext.MessageBox.alert("Mensaje", ' Eventos almacenados correctamente<br>');
                                    storG.reload();
                                }
                            });
                        } else {
                            Ext.MessageBox.alert("Mensaje", 'La Fecha es un Campo Obligatorio<br>');
                        }
                    }
                },{
                    text: 'Recargar',
                    iconCls: 'refresh',
                    handler: function () {
                        this.up('grid').getStore().reload();
                    }
                },{
                    text: 'Resumen de Eventos',
                    iconCls: 'refresh',
                    handler: function () {
                        win_resumen = new Ext.Window({
                            title: 'Exportar Eventos',
                            id: 'winexportar-'+me.idmaster,                                    
                            margin: '10 10 10 10',
                            bodyPadding: 5,
                            closeAction: 'destroy',
                            items: [
                                Ext.create('Ext.Panel', {
                                    id: "subpanel-lastdoc-" + me.idmaster,
                                    name: "subpanel-lastdoc-" + me.idmaster,
                                    title: 'Resumen Eventos',
                                    idreferencia: me.idreferencia,
                                    flex:1,
                                    listeners:{
                                        afterrender: function (t, eOpts){
                                            me.actualizarPanelResumen(data, t);
                                        }
                                    }
                                })
                            ],
                            listeners: {                                        
                                close: function (win, eOpts) {
                                    win_exportar = null;
                                }
                            }
                        });
                        win_resumen.show();
                    }
                });
                
                if(this.tipo != "Aduana"){
                    tb.add({
                        id: 'bntexportar'+me.idmaster,
                        text: 'Exportar Eventos',
                        iconCls: 'add',
                        handler: function () {
                            win_exportar = new Ext.Window({
                                title: 'Exportar Eventos',
                                id: 'winexportar-'+me.idmaster,                                    
                                margin: '10 10 10 10',
                                bodyPadding: 5,
                                closeAction: 'destroy',
                                items: [
                                    Ext.create('Ext.form.Panel', {                                            
                                        id: 'form-exportar-'+me.idmaster,
                                        bodyPadding: 5,
                                        url: '/inoF2/guardarEventos',
                                        layout: 'anchor',
                                        defaults: {
                                            anchor: '100%'
                                        },                    
                                        items: [                                                
                                            Ext.create('Colsys.Widgets.WgReferencias', {
                                                fieldLabel: 'Referencia Exportaciones Aduana',
                                                id: 'comboReferencia-'+me.idmaster,
                                                name: 'referencia',
                                                allowBlank: false,
                                                idimpoexpo: 'expo',                    
                                                forceSelection: true,
                                                listeners:{
                                                    afterrender: function (ct, position) {
                                                        var store = this.getStore();
                                                        store.proxy.url = '/widgets5/datosComboReferenciasAduana/impoexpo/expo/';
                                                    },
                                                    select: function ( combo, record, eOpts ){

                                                        var modalidadAduana = record.data.ca_modalidad;

                                                        var storG = me.getStore();
                                                        x = 0;
                                                        changes = [];
                                                        console.log(storG);

                                                        for (var i = 0; i < storG.getCount(); i++) {                                                                
                                                            var rec = storG.getAt(i);
                                                            if(rec.data.modalidad != modalidadAduana){
                                                                Ext.Msg.alert('Error', "El r\u00e9gimen de exportaci\u00f3n no coincide en las referencias solicitadas");
                                                                win_exportar.close();
                                                                win_exportar = null;                                                                    
                                                            }
                                                            rec.data.id = rec.id;
                                                            changes[x] = rec.data;
                                                            x++;
                                                        }
                                                        var strGrid = JSON.stringify(changes);

                                                        this.up("panel").add({
                                                            xtype: 'hiddenfield',
                                                            name: 'datosGrid',
                                                            value: strGrid
                                                        })
                                                    }
                                                }
                                            })
                                        ],
                                        buttons: [{
                                            text: 'Exportar',
                                            formBind: true, //only enabled once the form is valid
                                            disabled: true,
                                            id: 'btn-save-'+me.idmaster,
                                            handler: function() {
                                                var form = this.up('form').getForm();

                                                if (form.isValid()) {
                                                    form.submit({
                                                        success: function(form, action) {                                                            
                                                            Ext.Msg.alert('Success', action.result.msg);
                                                        },
                                                        failure: function(form, action) {
                                                            Ext.Msg.alert('Failed', action.result.msg);
                                                        }
                                                    });
                                                }
                                            }
                                        }]
                                    })
                                ],
                                listeners: {                                        
                                    close: function (win, eOpts) {
                                        win_exportar = null;
                                    }
                                }

                            });
                            win_exportar.show();
                        }
                    });
                }                
                this.addDocked(tb);
            }
        }
    },
    actualizarPanelResumen: function(data, panel){
        var ultDoc = Ext.Date.format(data.ultimoevento, 'Y-m-d');
        var eventos = data.infoeventos;
        
        var info = '<table id="customers">';
        info+= "<tr><th>Ultimo documento</th></tr>";
        info+= '<tr><td style="text-align: center;"><h2>'+ultDoc+'</h2></td></tr>';          
        info+= '<tr><th>Eventos</th></tr>'
        info+= '<tr><td style="text-align: center; text-align: -moz-center;">'+eventos+'</td></tr>';
        info+= "</table>";
        panel.setHtml(info);
    }
});