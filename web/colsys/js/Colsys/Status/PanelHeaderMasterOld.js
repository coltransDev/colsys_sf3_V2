Ext.define('Colsys.Status.PanelHeaderMaster', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.Colsys.Status.PanelHeaderMaster',
    autoScroll: true,
    bodyPadding: 10,
    //layout: 'column',
    //frame: true,
    collapsible: true,
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
            var myMsg = Ext.create('Ext.window.MessageBox', {
                closeAction: 'destroy',
                id: 'message',
                closable: false
            }).show({
                title: 'Mensaje',
                message: 'Generando el formulario...Por favor espere un momento!'
            });

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
                    var htmlNot = "";
                    var htmlTk = "";
                    me.setData(res.root);

                    var cantNot = res.root.confirmaciones ? res.root.confirmaciones.length : 0;
                    var cantTk = res.root.tickets ? res.root.tickets.length : 0;

                    if (cantNot > 0) {
                        htmlNot = "";
                        htmlNot += "<table>";
                        htmlNot += "<th>Fecha envío</th><th>Asunto</th><th>Ver Email</th>";
                        $.each(res.root.confirmaciones, function (index, value) {
                            console.log(index + "-" + value);
                            var idemail = value["idemail"];
                            htmlNot += "<tr>";
                            htmlNot += "<td>" + value["fchenvio"] + "</td>";
                            htmlNot += "<td>" + value["subject"] + "</td>";
                            htmlNot += "<td><a href='/email/verEmail?id=" + idemail + "' target='_blank'><img src='/images/22x22/email.gif'/></a></td>";
                            htmlNot += "</tr>";
                        });
                        htmlNot += "</table>";
                    }

                    if (cantTk > 0) {
                        htmlTk = "";
                        htmlTk += "<table>";
                        htmlTk += "<th>Ticket No.</th><th>Asunto</th><th>Ver Email</th>";
                        $.each(res.root.tickets, function (index, value) {
                            console.log(index + "-" + value);
                            var idemail = value["idemail"];
                            htmlTk += "<tr>";
                            htmlTk += "<td>" + value["idticket"] + "</td>";
                            htmlTk += "<td>" + value["title"] + "</td>";
                            htmlTk += "<td><a href='/email/verEmail?id=" + idemail + "' target='_blank'><img src='/images/22x22/email.gif'/></a></td>";
                            htmlTk += "</tr>";
                        });
                        htmlTk += "</table>";
                    }

                    var obj = {
                        xtype: 'toolbar',
                        dock: 'bottom',
                        id: 'bar-header-not-' + me.idmaster,
                        items: [{
                                text: 'Notificaciones Puerto ' + '(' + cantNot + ')',
                                id: 'not-pto' + me.idmaster,
                                iconCls: 'email',
                                handler: function () {

                                    winNotPuerto = new Ext.Window({
                                        title: 'Notificaciones Puerto',
                                        id: 'win-not-' + me.idmaster,
                                        width: 700,
                                        height: 250,
                                        closeAction: 'destroy',
                                        autoScroll: true,
                                        bodyPadding: 5,
                                        items: [{
                                                xtype: 'panel',
                                                id: 'win-panel-not-' + me.idmaster,
                                                html: htmlNot
                                            }],
                                        listeners: {
                                            close: function (win, eOpts) {
                                                winNotPuerto = null;
                                            }
                                        }
                                    }).show();
                                }
                            }, {
                                text: 'Tickets Asociados ' + '(' + cantTk + ')',
                                id: 'ticket-' + me.idmaster,
                                iconCls: 'application_form',
                                handler: function () {

                                    winTicket = new Ext.Window({
                                        title: 'Tickets Asociados',
                                        id: 'win-tk-' + me.idmaster,
                                        width: 700,
                                        height: 250,
                                        closeAction: 'destroy',
                                        autoScroll: true,
                                        bodyPadding: 5,
                                        items: [{
                                                xtype: 'panel',
                                                id: 'win-panel-tk-' + me.idmaster,
                                                html: htmlTk
                                            }],
                                        listeners: {
                                            close: function (win, eOpts) {
                                                winTicket = null;
                                            }
                                        }
                                    }).show();
                                }
                            }]
                    };
                    me.addDocked(obj);
                    myMsg.close();
                },
                failure: function () {
                    console.log('failure');
                }
            });
        }
    }
});