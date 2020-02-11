/**
 * @autor Felipe Nariño 
 * @return Formulario para Cerrar y Liquidar en INOF2
 * @date:  2016-04-21
 */
winEscala = null;
winHallazgo = null;
winEvento = null;
var html = 
        '<table class="tabla_escala">'+
        '<tr><th colspan="1">STATUS</th></tr>'+        
        '<tr><td class="row_yellow">En Desarrollo</td></tr>'+
        '<tr><td class="row_orange">En Pruebas</td></tr>'+
        '<tr><td class="row_apricot">En espera de respuesta</td></tr>'+
        '<tr><td class="row_purple">Finalizado</td></tr>'+
        '<tr><td class="">En Cola</td></tr>'+
        '<tr><td class="">Levantamiento de informaci\u00F3n</td></tr>'+
        '<tr><td class="">En ajustes</td></tr>'+        
        '<tr><td class="">En seguimiento</td></tr>'+
        '<tr><td class="">En proceso</td></tr>'+
        '<tr><td class="">Sin Status</td></tr>'+
        '</table>';

Ext.define('Colsys.Ino.PanelAuditoria', {    
    extend: 'Ext.panel.Panel',
    alias: 'widget.wPanelAuditoria',    
    layout: 'border',
    bodyBorder: false,
    defaults: {
        collapsible: true,
        split: true,
        bodyPadding: 5
    },
    listeners: {
        beforerender: function (ct, position) {
            this.setHeight(this.up('tabpanel').up('tabpanel').getHeight() - 150);
            this.setWidth(this.up('tabpanel').up('tabpanel').getWidth() - 50);            
            
            var me = this;
            var disabled = !this.permisos.Auditoria;
            var widthPanelWest = (this.width*40)/100;
            
            var formHallazgo = Ext.create('Ext.ux.form.MultiSelect',{
                    id: 'form-hallazgo-'+me.idmaster,                    
                    msgTarget: 'side',    
                    alignOnScroll: true,
                    name: 'multiselect',                    
                    allowBlank: false,
                    maxSelections: 1,
                    minSelections: 1,
                    scrollable: true,
                    store: new Ext.data.Store({                    
                        fields: [                        
                            {name: 'h_ca_idticket'},
                            {name: 'h_ca_title'},
                            {name: 'h_ca_text'},
                            {name: 'h_ca_hallazgo'},
                            {name: 'status_color'},
                            {name: 'usuauditoria'}
                        ],
                        proxy: {
                           url: '/widgets/listaTicketsJSON',    
                           type: 'ajax',
                           reader: 
                           {
                              rootProperty: 'root',
                              totalProperty: 'total',                          
                              type: 'json'
                           }
                        },
                        autoLoad: false                    
                    }),
                    valueField: 'h_ca_idticket',
                    displayField: 'h_ca_hallazgo',                    
                    ddReorder: true,                    
                    listeners:{     
                        afterrender: function (ct,position){
                            this.store.load({
                                params : {  
                                    idmaster: me.idmaster,
                                    iddepartamento: 4,
                                    tipo: "ino"
                                }                                
                            });                            
                        },
                        change: function ( combo, newValue, oldValue, eOpts ){
                            
                            var idticket = newValue[0];
                            
                            panelVistaPrevia = Ext.getCmp("form-vista-ticket"+me.idmaster);
                            var f = panelVistaPrevia.getForm();
                            f.load({
                                url: '/inoF2/datosVistapreviaTicket',
                                params: {
                                    idticket : idticket
                                },
                                success: function () {
                                }
                            });

                            var gridArchivos = Ext.getCmp("panel-archivos-"+me.idmaster);                                                        
                            var dataViewArchivos = gridArchivos.down("dataview");
                            dataViewArchivos.folder = btoa('Projects/' + idticket);                            
                            dataViewArchivos.getStore().load({
                                params: {
                                    folder: btoa('Projects/' + idticket)
                                }
                            });

                            var GridRespuestas = Ext.getCmp("gridrespuestas"+me.idmaster);
                            GridRespuestas.getStore().load({
                                params: {
                                    idticket: idticket
                                }
                            });
                            GridRespuestas.idticket = idticket;
                            
                            var usersPanel = Ext.getCmp('panel-users-'+me.idmaster);
                            usersPanel.idticket = idticket;
                            
                            var dataViewUsers = Ext.getCmp("panel-users-"+me.idmaster).child('dataview[itemId=viewusers]');
                            dataViewUsers.setDataUrl('/pm/datosUsuarioTicket');                                                        
                            dataViewUsers.getStore().load({
                                params: {
                                    idticket: idticket
                                }
                            }); 
                            
                            /*Habilita o deshabilita el botón de respuesta*/
                            var record = combo.getStore().findRecord("h_ca_idticket", idticket);
                            var usuauditoria = record.data.usuauditoria;                            
                            Ext.getCmp('button-nvarespuesta'+me.idmaster).setDisabled(!usuauditoria);
                        }
                    },
                    listConfig: {
                        tpl: Ext.create('Ext.XTemplate',
                               '<tpl for=".">',
                                   '<li class="x-boundlist-item row_{status_color}">{h_ca_hallazgo}</li>',
                               '</tpl>'
                        ),
                        listeners: {                            
                            beforeitemcontextmenu: function(list, record, item, index, e, eOpts) {
                                
                                e.preventDefault();
                                e.stopEvent();
                                var menu = new Ext.menu.Menu({
                                    id: 'menuContextual'+me.idmaster,
                                    items: [
                                        {
                                            text: 'Editar',
                                            iconCls: 'page_white_edit',
                                            id: 'button-editar-'+me.idmaster, 
                                            disabled: disabled,
                                            handler: function() {
                                                Ext.getCmp("panel-hallazgos-"+me.idmaster).ventanaHallazgo(record);
                                            }
                                        },
                                        {
                                            text: 'Tomar Asignaci\u00F3n',
                                            iconCls: 'tux',
                                            id: 'button-asignacion-'+me.idmaster, 
                                            disabled: disabled,
                                            handler: function() {
                                                Ext.Ajax.request({
                                                    url: "/pm/tomarAsignacion",
                                                    params: {
                                                        idticket: record.data.h_ca_idticket
                                                    },
                                                    callback: function (options, success, response) {
                                                        var res = Ext.util.JSON.decode(response.responseText);
                                                        var store = Ext.getCmp('form-hallazgo-'+me.idmaster).store;
                                                        store.each(function (r) {
                                                            if (r.data.h_ca_idticket == res.idticket) {                                                                
                                                                r.set("assignedto", res.assignedto);
                                                                r.commit();
                                                                Ext.Msg.alert("Success", "Se le ha asignado el ticket a usted");
                                                            }
                                                        });
                                                    }
                                                });                                 
                                            }
                                        },
                                        {
                                            text: 'Cerrar caso',
                                            iconCls: 'tick',
                                            id: 'button-cerrar-'+me.idmaster,                                            
                                            handler: function() {
                                                Ext.Ajax.request({
                                                    url: "/pm/cerrarTicket",
                                                    params: {
                                                        idticket: record.data.h_ca_idticket
                                                    },
                                                    callback: function (options, success, response) {
                                                        var res = Ext.util.JSON.decode(response.responseText);
                                                        var store = Ext.getCmp('form-hallazgo-'+me.idmaster).store;
                                                        store.each(function (r) {
                                                            if (record.data.h_ca_idticket == res.idticket) {                                                                
                                                                r.set("action", "Cerrado");
                                                                r.set("percentage", 100);
                                                                r.commit();
                                                                Ext.Msg.alert("Success", "Se ha cerrado el ticket");
                                                            }
                                                        });
                                                    }
                                                });                                 
                                            }
                                        }
                                    ]
                                }).showAt(e.getXY());
                            }
                        }
                    }
                });
                
            this.add(
                {
                    title: 'Resumen',
                    id: 'resumen-'+me.idmaster,
                    region:'west',
                    floatable: false,
                    margin: '5 0 0 0',                    
                    width: widthPanelWest,
                    minWidth: 100,
                    layout: {
                        type: 'vbox',
                        pack: 'start',
                        align: 'stretch'
                    },
                    items: [
                        Ext.create('Ext.form.Panel', {
                            id: 'panel-hallazgos-'+me.idmaster,
                            title: 'Hallazgos',
                            idmaster: me.idmaster,
                            scrollable: true,                            
                            flex: 1,
                            dockedItems: [{
                                xtype: 'toolbar',
                                dock: 'top',                    
                                items: [
                                    {
                                        text: 'Nuevo Hallazgo',
                                        tooltip: 'Crear nuevo hallazgo',
                                        iconCls: 'add', // reference to our css
                                        handler: function(){
                                            Ext.getCmp("panel-hallazgos-"+me.idmaster).ventanaHallazgo(null);
                                        }
                                    },
                                    {
                                        text: 'Nuevo Evento',
                                        tooltip: 'Crear nuevo evento',
                                        iconCls: 'add', // reference to our css                                        
                                        handler: function(){
                                            Ext.getCmp("panel-hallazgos-"+me.idmaster).ventanaEvento(null);
                                        }
                                    },
                                    {
                                        text: 'Escala Status',
                                        tooltip: 'Crear nuevo hallazgo',
                                        iconCls: 'table', // reference to our css
                                        handler: function () {
                                            if(winEscala == null){
                                                winEscala = Ext.create('Ext.window.Window',{
                                                    width: 200,
                                                    height: 300,
                                                    id:'winEscala',                    
                                                    name:'winEscala',                        
                                                    title: 'Escala de Status',
                                                    layout: 'anchor',
                                                    html: html,
                                                    closeAction: 'hide'
                                               });
                                            }
                                            winEscala.show(); 
                                        }
                                    }
                                ]
                            }],
                            items:[                                
                                formHallazgo
                            ],
                            ventanaHallazgo(record){
                                var idticket = record?record.data.h_ca_idticket:'';
                                var title = record?"Editar Hallazgo":"Nuevo Hallazgo";
                                var idmaster = this.idmaster;
                                
                                if (winHallazgo == null) {
                                    winHallazgo = new Ext.Window({
                                        title: title,
                                        width: 500,
                                        id: 'winhallazgo' + idmaster,                                        
                                        autoHeight: true,
                                        closeAction: 'hide',
                                        items: {
                                            xtype: 'Colsys.Ino.FormAuditoria',
                                            id:'form-auditoria-' + idmaster,
                                            idmaster: idmaster,
                                            idreferencia: me.idreferencia,
                                            border: false,
                                            layout: 'anchor',
                                            anchor: '100% 100%',
                                            idticket: idticket
                                        },
                                        listeners: {
                                            close: function (win, eOpts) {
                                                winHallazgo = null;
                                                this.destroy();                                                
                                            }
                                        }
                                    });
                                    if (record != null) {
                                        winHallazgo.down("form").cargar(this.idmaster, idticket);
                                    } else {
                                        winHallazgo.down("form").getForm().reset();
                                    }
                                }
                                winHallazgo.show();
                            },
                            ventanaEvento(record){
                                var idticket = record?record.data.h_ca_idticket:'';
                                var title = record?"Editar Evento":"Nuevo Evento";
                                var idmaster = this.idmaster;
                                
                                if (winEvento == null) {
                                    winEvento = new Ext.Window({
                                        title: title,
                                        width: 500,
                                        id: 'winEvento' + idmaster,                                        
                                        autoHeight: true,
                                        closeAction: 'hide',
                                        items: [
                                            Ext.create('Colsys.Ino.FormAuditoria', {
                                                id:'form-evento-auditoria-'+idmaster,
                                                idmaster: idmaster,
                                                idreferencia: me.idreferencia,
                                                tipo: 'apertura',
                                                listeners:{
                                                    beforerender: function(ct, position){
                                                        this.getForm().findField("type").setValue("Evento");
                                                        this.getForm().findField("type").hidden = true;
                                                        this.getForm().findField("status").setValue(4);//Finalizado
                                                        this.getForm().findField("status").hidden = true;                                                        
                                                        this.getForm().findField("assignedto").hidden = true;                                                        
                                                        this.getForm().findField("reportedby").hidden = true;                                                        
                                                    }
                                                }
                                            })
                                        ],
                                        listeners: {
                                            close: function (win, eOpts) {
                                                winEvento = null;
                                                this.destroy();                                                
                                            }
                                        }
                                    });
                                    if (record != null) {
                                        winEvento.down("form").cargarEvento(this.idmaster, idticket);
                                    } else {
                                        winEvento.down("form").getForm().reset();
                                    }
                                }
                                winEvento.show();
                            }
                        }), 
                        Ext.create('Ext.tab.Panel', {
                            id: 'tab-auditoria-'+me.idmaster,
                            flex:2,                            
                            items:[
                                Ext.create('Colsys.Ino.FormVistaTicket', {
                                    id: 'form-vista-ticket'+me.idmaster,
                                    name: 'form-vista-ticket'+me.idmaster,
                                    title: 'Vista Previa',
                                    scrollable: true,
                                    collapsible: true,
                                    collapsed: false,
                                    idmaster: me.idmaster,
                                    flex: 3
                                }),
                                Ext.create('Colsys.Users.PanelUsers', {
                                    id: 'panel-users-'+me.idmaster,
                                    name: 'panel-users-'+me.idmaster,
                                    idmaster: me.idmaster,                            
                                    title: 'Usuarios',
                                    collapsible: true,
                                    collapsed: false, 
                                    flex: 2,
                                    listeners:{
                                        afterrender: function(ct, position){                                    
                                            var btnDelete = this.down("toolbar").items.items[1];
                                            if(btnDelete){
                                                btnDelete.handler = this.up("panel").up("panel").up("panel").onDeleteUser;
                                            }  
                                        }
                                    }
                                }),
                                Ext.create('Colsys.GestDocumental.PanelArchivos',{
                                    id: 'panel-archivos-'+me.idmaster,
                                    name: 'panel-archivos-'+me.idmaster,
                                    title: 'Archivos',
                                    idmaster: me.idmaster,                            
                                    collapsible: true,
                                    collapsed: false,
                                    flex: 2
                                })
                            ]
                        })
                    ]                    
                },
                {
                    title: 'Seguimientos',
                    id: 'seguimientos-'+me.idmaster,
                    collapsible: false,
                    region: 'center',
                    margin: '5 0 0 0',
                    scrollable: true,
                    layout: {
                        type: 'vbox',
                        pack: 'start',
                        align: 'stretch'
                    },
                    items:[
                        Ext.create('Colsys.Ino.GridRespuestas', {
                            id: 'gridrespuestas' + me.idmaster,                            
                            idmaster: me.idmaster
                        })
                    ]                    
                }
            );
        },
        afterrender: function (ct,position){            
            var me = this;
            var combo = Ext.getCmp("form-hallazgo-"+this.idmaster);
            var usersPanel = Ext.getCmp('panel-users-'+this.idmaster);
            var gridDocumentos = Ext.getCmp('panel-archivos-'+this.idmaster);
            
            combo.getStore().on(
                "load",function() {                    
                    var recordSelected = combo.getStore().getAt(0);   
                    if(recordSelected){
                        combo.setValue(recordSelected.get('h_ca_idticket'));                    
                        usersPanel.idticket = recordSelected.get('h_ca_idticket');
                        gridDocumentos.idticket = recordSelected.get('h_ca_idticket');
                    }else{                        
                        var f = Ext.getCmp("form-vista-ticket"+me.idmaster).getForm();
                        f.reset();
                    }
                        
                },
                this,
                {
                    single: true
                }
            );        
            combo.getStore().sort('h_ca_idticket', 'ASC');
            
            usersPanel.wgUsuario1 = usersPanel.down("toolbar").items.items[0];
            usersPanel.wgUsuario1.on("select", this.onSelectUser );            
        }
    },
    onSelectUser:  function( combo, record, index){
        var idmaster = combo.up("panel").idmaster;
        var usersPanel = Ext.getCmp("panel-users-"+idmaster);
        var idticket = combo.up("panel").idticket;
        
        Ext.Ajax.request({
            url: '/pm/agregarUsuario',
            method: 'POST',
            //Solamente se envian los cambios
            params :	{
                login:record.data.login,
                idticket: idticket
            },

            callback :function(options, success, response){                   
                usersPanel.items.items[0].store.reload();
                combo.setValue("");
            }
         });
    },
    onDeleteUser: function(){ 
        
        var dataView = this.up("panel").down("dataview");
        var records =  dataView.getSelectionModel().getSelected(); 
        var storeView = dataView.store;
        for( var i=0;i< records.length; i++){            
            if( confirm( 'Esta seguro que desea borrar el archivo seleccionado?') ){
                Ext.Ajax.request({
                    url: '/pm/eliminarUsuario',
                    params: {
                        login: records.items[i].data.login,
                        idticket: this.up("panel").idticket,
                        id: records.items[i].id
                    },

                    callback :function(options, success, response){
                        var res = Ext.util.JSON.decode( response.responseText );
                        storeView.each(function(r){
                            if(r.id==res.id){
                                storeView.remove(r);
                                Ext.Msg.alert("Success", "Se ha eliminado el usuario");
                            }
                        });
                    }
                });
            }
        }
    }
});