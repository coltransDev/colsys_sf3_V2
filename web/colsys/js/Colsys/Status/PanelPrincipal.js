Ext.define('Colsys.Status.PanelPrincipal', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.Colsys.Status.PanelPrincipal',
    //height: 800,
    //scrollable: true,
    //autoScroll: true,
    layout: {
        type: 'table',
        columns: 1,
        tdAttrs: {style: 'padding: 5px 5px 0px 5px; vertical-align: top;'},
        tableAttrs: {
            style: {
                width: '98%'
            }
        }
    },
    bodyCls: 'app-dashboard',
         listeners: {
        render: function (me, eOpts) {
            var idmaster = this.idmaster;
            var referencia = this.idreferencia;
            
            tabs = new Array();
            
            tb = Ext.create('Ext.toolbar.Toolbar', {});
            tb.add({
                xtype: 'button',
                text: 'Informaci\u00F3n General',                
                iconCls: 'page_white_edit',
                handler: function () {                                        
                    Ext.create('Ext.window.Window', {
                        title: 'Informaci\u00F3n General '+ referencia,
                        width: 800,
                        closeAction: 'destroy',                                    
                        bodyPadding: 5,                        
                        layout: 'fit',
                        items: [  // Let's put an empty grid in just to illustrate fit layout
                            Ext.create('Colsys.Status.PanelHeaderMaster', {
                                id: 'panel-header-master-' + idmaster,                                
                                idmaster: idmaster
                            }) // A dummy empty data store
                        ]
                    }).show();
                }
            },{
                xtype: 'button',
                text: 'Notificaciones Puerto',
                id: 'not-pto' + me.idmaster,
                iconCls: 'email',
                handler: function () {
                    var myMsg = Ext.create('Ext.window.MessageBox', {
                        closeAction: 'destroy',
                        id: 'message',
                        closable: false
                    }).show({
                        title: 'Mensaje',
                        message: 'Consultando status de la referencia...!'
                    });

                    Ext.Ajax.request({
                        waiting: 'Cargando información de Status',
                        url: '/status/confirmaciones',
                        params: {
                            idmaster: me.idmaster
                        },
                        method: 'POST',
                        waitTitle: 'Connecting',
                        waitMsg: 'Cargando Información General...',
                        //scope: me,
                        success: function (response, options) {

                            var res = Ext.decode(response.responseText);
                            myMsg.close();
                            if (res.root !== null) {
                                console.log(res.root.confirmaciones);


                                winNotPuerto = new Ext.Window({
                                    title: 'Notificaciones Puerto',
                                    id: 'win-not-' + me.idmaster,
                                    width: 800,
                                    //height: 250,
                                    closeAction: 'destroy',
                                    autoScroll: true,
                                    bodyPadding: 5,
                                    items: [
                                        Ext.create('Ext.grid.Panel', {
                                            store: Ext.create('Ext.data.Store', {
                                                data: res.root.confirmaciones
                                            }),
                                            columns: [{
                                                    text: 'Fch. Env\u00EDo',
                                                    dataIndex: 'fchenvio',
                                                    flex: 1
                                                }, {
                                                    text: 'Asunto',
                                                    dataIndex: 'subject',
                                                    flex: 3
                                                }, {
                                                    text: ' Ver Email',
                                                    dataIndex: 'idemail',
                                                    flex: 0.6,
                                                    renderer: function (value) {
                                                        return "<a href='/email/verEmail?id=" + value + "' target='_blank'><img src='/images/22x22/email.gif'/></a>";
                                                    }
                                                    //width: 120
                                                }],
                                            height: 400,
                                            //width: 500,
                                            renderTo: Ext.getBody()
                                        })
                                    ],
                                    listeners: {
                                        close: function (win, eOpts) {
                                            winNotPuerto = null;
                                        }
                                    }
                                }).show();
                            } else {
                                Ext.MessageBox.alert("Mensaje", 'Esta referencia no tiene confirmaciones asociadas');
                            }


                        }
                    });

                }
            },{
                xtype: 'button',
                text: 'Tickets Asociados',
                id: 'ticket-' + me.idmaster,
                iconCls: 'application_form',
                handler: function () {

                    var myMsg = Ext.create('Ext.window.MessageBox', {
                        closeAction: 'destroy',
                        id: 'message',
                        closable: false
                    }).show({
                        title: 'Mensaje',
                        message: 'Consultando tickets asociados de la referencia...!'
                    });

                    Ext.Ajax.request({
                        waiting: 'Cargando información de Status',
                        url: '/status/tickets',
                        params: {
                            idmaster: me.idmaster
                        },
                        method: 'POST',
                        waitTitle: 'Connecting',
                        waitMsg: 'Cargando Información General...',
                        //scope: me,
                        success: function (response, options) {

                            var res = Ext.decode(response.responseText);
                            myMsg.close();
                            if (res.root !== null) {
                                console.log(res.root.tickets);

                                winTicket = new Ext.Window({
                                    title: 'Tickets Asociados',
                                    id: 'win-tk-' + me.idmaster,
                                    width: 700,
                                    height: 250,
                                    closeAction: 'destroy',
                                    autoScroll: true,
                                    bodyPadding: 5,
                                    items: [
                                        Ext.create('Ext.grid.Panel', {
                                            store: Ext.create('Ext.data.Store', {
                                                data: res.root.tickets
                                            }),
                                            columns: [{
                                                    text: 'Ticket No.',
                                                    dataIndex: 'idticket',
                                                    flex: 1
                                                }, {
                                                    text: 'Asunto',
                                                    dataIndex: 'title',
                                                    flex: 3
                                                }, {
                                                    text: 'Ver Ticket',
                                                    dataIndex: 'idemail',
                                                    flex: 0.6,
                                                    renderer: function (value) {
                                                        return "<a href='/email/verEmail?id=" + value + "' target='_blank'><img src='/images/22x22/email.gif'/></a>";
                                                    }                                                                    
                                                }],
                                            height: 400,
                                            //width: 500,
                                            renderTo: Ext.getBody()
                                        })
                                    ],
                                    listeners: {
                                        close: function (win, eOpts) {
                                            winTicket = null;
                                        }
                                    }
                                }).show();

                            } else {
                                Ext.MessageBox.alert("Mensaje", 'Esta referencia no tiene tickets asociados');
                            }


                        }
                    });


                    }
            });
            
            this.addDocked(tb);

            $.each(this.permisos, function (modulo, data) {
                $.each(data, function (tipo, valor) {
                    if (tipo === "valor" && valor === true) {
                        tabs.push(
                            Ext.create('Colsys.Status.FormPrincipal', {
                                id: 'form-principal-' + modulo + idmaster,
                                idmaster: idmaster,
                                modulo: modulo,
                                title: data["detalle"],
                                texto: modulo!="ffletes"?data["texto"]:data["texto"]["ffletes"],
                                tflete: modulo=="ffletes"?data["texto"]:null,
                                iconCls: modulo                                    
                            })
                        );                        
                    }
                });
            });

            this.add(
                    {
                        xtype: 'tabpanel',
                        id: 'tab-panel-modulos' + this.idmaster,
                        bodyPadding: 5,
                        items: tabs,
                        listeners: {
                            tabchange: function (tabPanel, newCard, oldCard, eOpts) {
                                var modulo = newCard.modulo;
                                newCard.validarCampos(modulo);

                                switch (modulo) {
                                    default:
                                        Ext.getCmp('panel-hijos-' + me.idmaster).show();
                                        me.clientesOtm('no');
                                        me.agregarPanelFotos("quitar");
                                        if (Ext.getCmp('grid-planilla-' + me.idmaster)) {
                                            Ext.getCmp('grid-planilla-' + me.idmaster).hide();
                                        }
                                        break;
                                    case "pto-llegada":
                                    case "pto-desconsolidacion":
                                        Ext.getCmp('panel-hijos-' + me.idmaster).show();
                                        me.clientesOtm('no');
                                        me.agregarPanelFotos("agregar");
                                        if (Ext.getCmp('grid-planilla-' + me.idmaster)) {
                                            Ext.getCmp('grid-planilla-' + me.idmaster).hide();
                                        }
                                        newCard.cargar();
                                        break;
                                    case "pto-planilla":
                                        Ext.getCmp('panel-hijos-' + me.idmaster).hide();
                                        if (Ext.getCmp('grid-planilla-' + me.idmaster)) {
                                            Ext.getCmp('grid-planilla-' + me.idmaster).show();

                                        } else {
                                            me.add(
                                                    Ext.create('Colsys.Status.GridPlanilla', {
                                                        id: 'grid-planilla-' + me.idmaster,
                                                        idmaster: idmaster,
                                                        title: "Planilla de Env\u00EDo"
                                                    })
                                                    );
                                        }
                                        Ext.getCmp('grid-planilla-' + me.idmaster).store.reload();
                                        break;
                                    case "pto-dian":
                                        Ext.getCmp('panel-hijos-' + me.idmaster).hide();
                                        if (Ext.getCmp('grid-planilla-' + me.idmaster)) {
                                            Ext.getCmp('grid-planilla-' + me.idmaster).hide();
                                        }
                                        Ext.getCmp("status_file-" + modulo + me.idmaster).allowBlank = false;
                                        break;
                                    case "contenedores":
                                        Ext.getCmp('panel-hijos-' + me.idmaster).show();
                                        me.clientesOtm('no');
                                        me.agregarPanelFotos("quitar");
                                        if (Ext.getCmp('grid-planilla-' + me.idmaster)) {
                                            Ext.getCmp('grid-planilla-' + me.idmaster).hide();
                                        }
                                        var mensajeCont = Ext.getCmp('form-principal-' + modulo + idmaster).texto;
                                        Ext.getCmp('status_mensaje-' + modulo + me.idmaster).setValue(mensajeCont);
                                        break;
                                    case "otm":
                                        me.agregarPanelFotos("quitar");
                                        me.clientesOtm('si', idmaster);
                                        break;
                                }
                                me.validarIdg(modulo);

                            },
                            afterrender: function (t, eOpts) {
                                var modulo = t.activeTab.modulo;
                                var FormPrincipal = t.down("form");
                                FormPrincipal.validarCampos(modulo);
                                FormPrincipal.cargar();
                            }
                        }
                    }
            );
    
            this.crearPanelClientes(me, this.idmaster);
        },
        beforerender: function (ct, position) {            
            this.setHeight(this.up('tabpanel').getHeight() - 50);            
        }
    },
    agregarPanelFotos: function (tipo) {

        var idhouses = this.down("tabpanel").idhouses;
        $.each(idhouses.split(","), function (key, idhouse) {
            switch (tipo) {
                case "agregar":
                    Ext.getCmp('panel-hijo-' + idhouse)?Ext.getCmp('panel-hijo-' + idhouse).hide():null;
                    Ext.getCmp('grid-archivos-' + idhouse)?Ext.getCmp('grid-archivos-' + idhouse).hide():null;
                    Ext.getCmp('grid-concliente-' + idhouse)?Ext.getCmp('grid-concliente-' + idhouse).hide():null;
                    Ext.getCmp('grid-fotos-' + idhouse)?Ext.getCmp('grid-fotos-' + idhouse).show():null;
                    break;
                case "quitar":
                    Ext.getCmp('panel-hijo-' + idhouse)?Ext.getCmp('panel-hijo-' + idhouse).show():null;
                    Ext.getCmp('grid-archivos-' + idhouse)?Ext.getCmp('grid-archivos-' + idhouse).show():null;
                    Ext.getCmp('grid-concliente-' + idhouse)?Ext.getCmp('grid-concliente-' + idhouse).show():null;
                    Ext.getCmp('grid-fotos-' + idhouse)?Ext.getCmp('grid-fotos-' + idhouse).hide():null;
                    break;
            }
        });
    },
    validarIdg: function (modulo) {
        var idhouses = this.down("tabpanel").idhouses;
        if(idhouses){
            $.each(idhouses.split(","), function (key, idhouse) {
                switch (modulo) {
                    case "llegada":
                    case "ffletes":
                    case "fotm":
                    case "fcontenedores":
                    case "desconsolidacion":
                    case "planilla":
                        Ext.getCmp("fchstatus" + idhouse)?Ext.getCmp("fchstatus" + idhouse).disable():null;
                        Ext.getCmp("horastatus" + idhouse)?Ext.getCmp("horastatus" + idhouse).disable():null;
                        Ext.getCmp("juststatus" + idhouse)?Ext.getCmp("juststatus" + idhouse).disable():null;
                        Ext.getCmp("excstatus" + idhouse)?Ext.getCmp("excstatus" + idhouse).disable():null;
                        break;
                    default:
                        Ext.getCmp("fchstatus" + idhouse)?Ext.getCmp("fchstatus" + idhouse).enable():null;
                        Ext.getCmp("horastatus" + idhouse)?Ext.getCmp("horastatus" + idhouse).enable():null;
                        Ext.getCmp("juststatus" + idhouse)?Ext.getCmp("juststatus" + idhouse).disable():null;
                        Ext.getCmp("excstatus" + idhouse)?Ext.getCmp("excstatus" + idhouse).disable():null;
                        break;
                }
            });
        }
    },
    crearPanelClientes: function (me, idmaster){
        var idhouses = [];
        
        var hijos = new Array();
            //var me = this;
            Ext.Ajax.request({
                waitMsg: 'Cargando House...',
                url: '/inoF2/datosGridHouse',
                params: {
                    idmaster: idmaster
                },
                failure: function (response, options) {
                    var res = Ext.util.JSON.decode(response.responseText);
                    if (res.errorInfo)
                        Ext.MessageBox.alert("Mensaje", 'Error al Liquidar la Referencia');
                },
                success: function (response, options) {
                    var res = Ext.decode(response.responseText);
                    var houses = res.root;

                    $.each(houses, function (index, data) {
                        idhouses.push(data["idhouse"]);   
                        idreporte = data["idreporte"];
                            hijos.push(
                                Ext.create('Colsys.Status.PanelHouse', {
                                id: 'panel-house-' + data["idhouse"],
                                manageHeight : true,
                                collapsed: true,
                                collapsible: true,
//                                scrollable: true,
                                idhouse: data["idhouse"],
                                hideCollapseTool: false,
                                idcliente: data["idcliente"],
                                comunicaciones: data["comunicaciones"],
                                header: {
                                    id: 'panel-header-house' + data["idhouse"],
                                    border: false,
                                    titlePosition: 1,
                                    items: [
                                        Ext.create('Colsys.Status.PanelHeaderHouse', {
                                            id: 'header-panel-' + data["idhouse"],
                                            data: data
                                        })
                                    ]
                                },
                                listeners: {
                                    expand: function (p, eOpts) {
                                        var gridArchivos = Ext.getCmp("grid-archivos-" + this.idhouse);
                                        var gridContactos = Ext.getCmp("grid-concliente-" + this.idhouse);

                                        gridArchivos.store.reload();
                                        gridContactos.store.reload();
                                    }
                                }
                            })
                            );
                    });

                    me.add({
                        xtype: 'panel',
                        controller: 'panel-hijos',
                        title: 'Cuadro de Clientes de la Referencia',                        
                        id: 'panel-hijos-' + me.idmaster,
                        name: 'panel-hijos-' + me.idmaster,
                        idmaster: me.idmaster,
                        idreferencia: me.idreferencia,
                        height: 300,
                        scrollable: true,
                        tbar: [
                        { 
                            xtype: 'button', 
                            text: 'Expandir',        
                            iconCls: 'switch',
                            handler: 'onToggle'
                        }],                        
                        layout: {
                            type: 'vbox',
                            pack: 'start',
                            align: 'stretch'
                        },
                        defaults: {
//                            margin: '0 0 5 0',
                            //height: 820,
                            //bodyPadding: 10,
                            frame: true,
                            border: true
                        },
                        items: hijos                        
                    });
                    
                    me.down("tabpanel").idhouses = idhouses.join();
                    me.down("tabpanel").setActiveTab(1);
                    me.down("tabpanel").setActiveTab(0);
                }
            });
    },
    clientesOtm: function(filtro, idmaster){
        var idhouses = this.down("tabpanel").idhouses;
        if(idhouses){
            $.each(idhouses.split(","), function (key, idhouse) {
                var data = Ext.getCmp('header-panel-' + idhouse).data;                    
                if(filtro === 'si'){
                    if(data.continuacion === "N/A" || data.continuacion === null){
                        Ext.getCmp('panel-house-' + idhouse).hide();
                    }else{
                        
                        var panelOtm = Ext.create('Colsys.Status.FieldSetOtm', {
                            id: 'fieldsetotm-panel-'+ idhouse,
                            idhouse:  idhouse,
                            flex: 0.8,
                            idmaster: idmaster
                        });
                        
                        Ext.getCmp('panel-hijo-' + idhouse).insert(0,panelOtm);
                    }
                }else{
                    if(data.continuacion === "N/A" || data.continuacion === null){
                        Ext.getCmp('panel-house-' + idhouse).show();
                    }
                    if(Ext.getCmp('fieldsetotm-panel-'+ idhouse)){
                        Ext.getCmp('panel-hijo-' + idhouse).remove(0);
                    }
                }                
            });
        }
    }
});

Ext.define('Colsys.view.form.PanelHijosController', {
        extend: 'Ext.app.ViewController',
        alias: 'controller.panel-hijos', 
        onToggle: function(t,eOpts){
            t.disable();
            var idmaster = t.up("panel").idmaster;
            var myMask = new Ext.LoadMask({
                msg    : 'Seleccionando todos los clientes, un momento por favor..',
                target :  Ext.getCmp('panel-principal-' + idmaster)
            });
            myMask.show(); 

            var idhouses = t.up("panel").up("panel").down("tabpanel").idhouses;
            var tipo = t.text;
            
            switch(tipo){
                case "Expandir":

                    $.each(idhouses.split(","), function (key, idhouse) {                        
                        t.up("panel").child('panel[id=panel-house-' + idhouse + ']').expand();
                    }); 
                    myMask.hide(); 
                    t.setText("Contraer");
                    t.enable();
                    break;

                case "Contraer":
                    $.each(idhouses.split(","), function (key, idhouse) {                        
                        t.up("panel").child('panel[id=panel-house-' + idhouse + ']').collapse();
                    }); 
                    myMask.hide();
                    t.setText("Expandir");
                    t.enable();
                    break;
            }
        }
    });