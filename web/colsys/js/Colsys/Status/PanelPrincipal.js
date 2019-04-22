Ext.define('Colsys.Status.PanelPrincipal', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.Colsys.Status.PanelPrincipal',
    autoScroll: true,
    layout: {
        type: 'table',
        columns: 1,
        tdAttrs: {style: 'padding: 10px; vertical-align: top;'},
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
            this.add(
                Ext.create('Colsys.Status.PanelHeaderMaster', {
                    id: 'panel-header-master-' + this.idmaster,
                    title: 'Informaci\u00F3n General',
                    idmaster: this.idmaster
                })
            );

            tabs = new Array();

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
                        bodyPadding: 10,
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
//                                        Ext.Ajax.request({
//                                            url: '/status/datosContenedores',
//                                            params: {
//                                                idmaster: me.idmaster
//                                            },
//                                            method: 'POST',
//                                            waitTitle: 'Connecting',
//                                            waitMsg: 'Cargando Datos contenedores...',
//                                            scope: me,
//                                            success: function (response, options) {
//
//                                                var res = Ext.decode(response.responseText);
//                                                var equipos = res.root;
//                                                var html = "";
//                                                html += "\n\n";
//                                                $.each(equipos, function (index, data) {
//                                                    html += "# " + (index + 1) + "\n";
//                                                    html += "Equipo: " + data["concepto"] + "\n";
//                                                    html += "Id. Equipo: " + data["serial"] + "\n";
//                                                    html += "Entrega Comodado: " + data["entregacomodato"] + "\n";
//                                                    html += "Patio de entrega: " + data["idpatio"] + "\n";
//                                                    html += "Observaciones: " + data["observaciones"] + "\n";
//                                                    html += "/*********************/\n";
//                                                    html += "\n";
//                                                });
//                                                var mensajeCont = Ext.getCmp('form-principal-' + modulo + idmaster).texto;
//                                                Ext.getCmp('status_mensaje-' + modulo + me.idmaster).setValue(mensajeCont + html);
//
//                                            },
//                                            failure: function () {
//                                                console.log('failure');
//                                            }
//                                        });
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
                        title: 'Cuadro de Clientes de la Referencia',
                        id: 'panel-hijos-' + me.idmaster,
                        name: 'panel-hijos-' + me.idmaster,
                        idmaster: me.idmaster,
                        layout: {
                            type: 'vbox',
                            pack: 'start',
                            align: 'stretch'
                        },
                        defaults: {
                            margin: '0 0 5 0',
                            //height: 820,
                            bodyPadding: 10,
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