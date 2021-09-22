Ext.define('Colsys.Status.PanelHeaderMaster', {
extend: 'Ext.panel.Panel',
        alias: 'widget.Colsys.Status.PanelHeaderMaster',
        autoScroll: true,
        //bodyPadding: 10,
        //layout: 'column',
        //frame: true,
        //collapsible: true,
        //colspan: 1,
        tpl: new Ext.XTemplate(
                '<div class="text-wrapper">' +
                '<div class="news-data">' +
                '<table><tr>' +
                '<td><div class="news-content">' +
                '<div class="">{traorigen:ellipsis(130, true)}</div><div class="news-small"><span class="news-author">TRA. ORIGEN</span></div>' +
                '<div class="">{tradestino:ellipsis(130, true)}</div><div class="news-small"><span class="news-author">TRA. DESTINO</span></div>' +
                '</div></td>' +
                '<td><div class="news-content">' +
                '<div class="">{origen:ellipsis(130, true)}</div><div class="news-small"><span class="news-author">ORIGEN</span></div>' +
                '<div class="">{destino:ellipsis(130, true)}</div><div class="news-small"><span class="news-author">DESTINO</span></div>' +
                '</div></td>' +
                '<td><div class="news-content">' +
                '<div class="">{modalidad:ellipsis(130, true)}</div><div class="news-small"><span class="news-author">MODALIDAD</span></div>' +
                '<div class="">{fchreferencia:ellipsis(130, true)}</div><div class="news-small"><span class="news-author">FCH. REGISTRO</span></div>' +
                '</div></td>' +
                '<td><div class="news-content">' +
                '<div class="">{fchembarque:ellipsis(130, true)}</div><div class="news-small"><span class="news-author">FCH. EMBARQUE</span></div>' +
                '<div class="">{fcharribo:ellipsis(130, true)}</div><div class="news-small"><span class="news-author">FCH. ARRIBO </span></div>' +
                '</div></td>' +
                '</tr></table>' +
                '</div>' +
                '</div>'
                ),
        listeners: {
        collapse: function () {
            this.up().doLayout();
        },
                expand: function () {
                    this.up().doLayout();
                },
                beforerender: function (me, eOpts) {

                    var me = this;

                    Ext.Ajax.request({
                        url: '/status/htmlCabecera',
                        params: {
                            idmaster: this.idmaster
                        },
                        method: 'POST',
                        waitTitle: 'Connecting',
                        waitMsg: 'Cargando Información General...',
                        scope: me,
                        success: function (response, options) {

                            var res = Ext.decode(response.responseText);

                            me.setData(res.root);
                        }
                    });

//                    var obj = {
//                    xtype: 'toolbar',
//                            dock: 'bottom',
//                            id: 'bar-header-not-' + me.idmaster,
//                            items: [
//                            {
//                            xtype: 'button',
//                                    text: 'Notificaciones Puerto',
//                                    id: 'not-pto' + me.idmaster,
//                                    iconCls: 'email',
//                                    handler: function () {
//                                        var myMsg = Ext.create('Ext.window.MessageBox', {
//                                            closeAction: 'destroy',
//                                            id: 'message',
//                                            closable: false
//                                        }).show({
//                                            title: 'Mensaje',
//                                            message: 'Consultando status de la referencia...!'
//                                        });
//
//                                        Ext.Ajax.request({
//                                            waiting: 'Cargando información de Status',
//                                            url: '/status/confirmaciones',
//                                            params: {
//                                                idmaster: me.idmaster
//                                            },
//                                            method: 'POST',
//                                            waitTitle: 'Connecting',
//                                            waitMsg: 'Cargando Información General...',
//                                            //scope: me,
//                                            success: function (response, options) {
//
//                                                var res = Ext.decode(response.responseText);
//                                                myMsg.close();
//                                                if (res.root !== null) {
//                                                    console.log(res.root.confirmaciones);
//
//
//                                                    winNotPuerto = new Ext.Window({
//                                                        title: 'Notificaciones Puerto',
//                                                        id: 'win-not-' + me.idmaster,
//                                                        width: 800,
//                                                        //height: 250,
//                                                        closeAction: 'destroy',
//                                                        autoScroll: true,
//                                                        bodyPadding: 5,
//                                                        items: [
//                                                            Ext.create('Ext.grid.Panel', {
//                                                                store: Ext.create('Ext.data.Store', {
//                                                                    data: res.root.confirmaciones
//                                                                }),
//                                                                columns: [{
//                                                                        text: 'Fch. Env\u00EDo',
//                                                                        dataIndex: 'fchenvio',
//                                                                        flex: 1
//                                                                    }, {
//                                                                        text: 'Asunto',
//                                                                        dataIndex: 'subject',
//                                                                        flex: 3
//                                                                    }, {
//                                                                        text: ' Ver Email',
//                                                                        dataIndex: 'idemail',
//                                                                        flex: 0.6,
//                                                                        renderer: function (value) {
//                                                                            return "<a href='/email/verEmail?id=" + value + "' target='_blank'><img src='/images/22x22/email.gif'/></a>";
//                                                                        }
//                                                                        //width: 120
//                                                                    }],
//                                                                height: 400,
//                                                                //width: 500,
//                                                                renderTo: Ext.getBody()
//                                                            })
//                                                        ],
//                                                        listeners: {
//                                                            close: function (win, eOpts) {
//                                                                winNotPuerto = null;
//                                                            }
//                                                        }
//                                                    }).show();
//                                                } else {
//                                                    Ext.MessageBox.alert("Mensaje", 'Esta referencia no tiene confirmaciones asociadas');
//                                                }
//
//
//                                            }
//                                        });
//
//
//                                    }
//                            }, {
//                                xtype: 'button',
//                                text: 'Tickets Asociados',
//                                id: 'ticket-' + me.idmaster,
//                                iconCls: 'application_form',
//                                handler: function () {
//                                    
//                                    var myMsg = Ext.create('Ext.window.MessageBox', {
//                                        closeAction: 'destroy',
//                                        id: 'message',
//                                        closable: false
//                                    }).show({
//                                        title: 'Mensaje',
//                                        message: 'Consultando tickets asociados de la referencia...!'
//                                    });
//
//                                    Ext.Ajax.request({
//                                        waiting: 'Cargando información de Status',
//                                        url: '/status/tickets',
//                                        params: {
//                                            idmaster: me.idmaster
//                                        },
//                                        method: 'POST',
//                                        waitTitle: 'Connecting',
//                                        waitMsg: 'Cargando Información General...',
//                                        //scope: me,
//                                        success: function (response, options) {
//
//                                            var res = Ext.decode(response.responseText);
//                                            myMsg.close();
//                                            if (res.root !== null) {
//                                                console.log(res.root.tickets);
//                                                
//                                                winTicket = new Ext.Window({
//                                                    title: 'Tickets Asociados',
//                                                    id: 'win-tk-' + me.idmaster,
//                                                    width: 700,
//                                                    height: 250,
//                                                    closeAction: 'destroy',
//                                                    autoScroll: true,
//                                                    bodyPadding: 5,
//                                                    items: [
//                                                        Ext.create('Ext.grid.Panel', {
//                                                            store: Ext.create('Ext.data.Store', {
//                                                                data: res.root.tickets
//                                                            }),
//                                                            columns: [{
//                                                                    text: 'Ticket No.',
//                                                                    dataIndex: 'idticket',
//                                                                    flex: 1
//                                                                }, {
//                                                                    text: 'Asunto',
//                                                                    dataIndex: 'title',
//                                                                    flex: 3
//                                                                }, {
//                                                                    text: 'Ver Ticket',
//                                                                    dataIndex: 'idemail',
//                                                                    flex: 0.6,
//                                                                    renderer: function (value) {
//                                                                        return "<a href='/email/verEmail?id=" + value + "' target='_blank'><img src='/images/22x22/email.gif'/></a>";
//                                                                    }                                                                    
//                                                                }],
//                                                            height: 400,
//                                                            //width: 500,
//                                                            renderTo: Ext.getBody()
//                                                        })
//                                                    ],
//                                                    listeners: {
//                                                        close: function (win, eOpts) {
//                                                            winTicket = null;
//                                                        }
//                                                    }
//                                                }).show();
//                                            
//                                            } else {
//                                                Ext.MessageBox.alert("Mensaje", 'Esta referencia no tiene tickets asociados');
//                                            }
//
//
//                                        }
//                                    });
//
//                                    
//                                    }
//                            }]
//                        }
//
//                        this.addDocked(obj);
                        }
            }
});