winDeducciones = null;
winComprobante = null;
winasignacion = null;
Ext.define('Colsys.Ino.PanelFactura', {
    extend: 'Ext.view.View',
    //extend: 'Ext.panel.Table',
    alias: 'widget.Colsys.Ino.PanelFactura',
    //store: Ext.data.StoreManager.lookup('imagesStore'),    
    itemSelector: 'div.thumb-wrap',
    tpl: '',
    onRender: function (ct, position) {


        this.tpl = new Ext.XTemplate(
                '<html>',
                '<tpl  class="tpls" for=".">',
                '<div  oncontextmenu="javascript:obteneridcliente(\'{idcliente}\',\'' + this.idmaster + '\',\'{cliente}\',\'{idcomprobante}\')" style="width:40%;height:250px;padding:10px;margin: 30px;float:left;{estilo}" title="{tooltip}" class="{class} thumb thumb-wrap"  >',
                '<div class="statement-type">{comprobante}</div>',
                '<table>',
                '<tr><td  class="thumb-title"></td><td colspan=3 hidden=true class="thumb-title-small">{idcliente}</td></tr>',
                '<tr><td  class="thumb-title">Cliente</td><td colspan=3 class="thumb-title-small">{cliente}</td></tr>',
                '<tr><td   class="thumb-title">{titulohouse}</td><td colspan=3 class="thumb-title-small">{house}</td></tr>',
                '<tr><td class="thumb-title">Valor {idmoneda}</td><td class="thumb-title-small">{valor}</td></tr>',
                '<tr><td class="thumb-title">{titulotaza}</td><td class="thumb-title-small">{valortcambio}</td><td class="thumb-title" style="width:90px;">{titulocambio}</td><td class="thumb-title-small" style="margin-left:0px;">{tcambio}</td> </tr>',
                '<tr>',
                '<tpl if="this.existFile(file)">',
                '<td colspan=2 ><a href="javascript:verComprobante(\'{idmoneda}\',\'{file}\',\'' + this.idtransporte + '\',\'' + this.idmaster + '\')"><img src="/images/toolbar/acrobatreader.png" title="Ver Comprobante" /></a>',
                '<a href="javascript:viewGridFac(\'{idcomprobante}\',\'{comprobante}\',\'' + this.idmaster + '\',\'' + this.idtransporte + '\',\'' + this.idimpoexpo + '\',\'{idhouse}\')"><img src="/images/32x32/spreadsheet.gif" title="Ver Conceptos" /></a>',
                '<a href="javascript:viewGridDed(\'{idcomprobante}\',\'' + this.idimpoexpo + '\',\'' + this.idtransporte + '\',\'' + this.idmaster + '\')" title="Ver Deducciones"><img src="/images/32x32/spreadsheet_dw.gif" /></a>',
                '</td>',
                '</tpl>',
                '{footer}',
                '</table>',
                '<table><tr><td id="detalle{idcomprobante}"></td></tr></table>',
                '</div>',
                '</tpl>',
                '</html>',
                {
                    class: 'tpls',
                    id: 'tpls',
                    existFile: function (file)
                    {
                        //return (file!="");
                        return file;
                    },
                    formatMoney: function (val)
                    {
                        return Ext.util.Format.usMoney(val);
                    }

                }
        );

        this.setStore(
                Ext.create('Ext.data.Store', {
                    fields: [
                        {name: 'iddetalle', mapping: 'iddetalle', type: 'int'},
                        {name: 'idhouse', mapping: 'idhouse', type: 'int'},
                        {name: 'idcomprobante', mapping: 'idcomprobante', type: 'int'},
                        {name: 'comprobante', mapping: 'comprobante', type: 'string'},
                        {name: 'house', mapping: 'house', type: 'string'},
                        {name: 'cliente', mapping: 'cliente', type: 'string'},
                        {name: 'fchcomprobante', mapping: 'fchcomprobante', type: 'date', dateFormat: 'Y-m-d'},
                        {name: 'cliente', mapping: 'cliente', type: 'string'},
                        {name: 'doctransporte', mapping: 'doctransporte', type: 'string'},
                        {name: 'idmoneda', mapping: 'idmoneda', type: 'string'},
                        {name: 'tcambio', mapping: 'tcambio', type: 'string'},
                        /*{name: 'moneda'           ,mapping: 'moneda'           , type: 'string'},*/
                        {name: 'valor', mapping: 'valor', type: 'string'},
                        {name: 'idconcepto', mapping: 'idconcepto', type: 'int'},
                        {name: 'concepto', mapping: 'concepto', type: 'string'},
                        {name: 'cuentapago', mapping: 'cuentapago', type: 'string'},
                        {name: 'estado', mapping: 'estado', type: 'int'},
                        {name: 'idccosto', mapping: 'idccosto', type: 'int'},
                        {name: 'valortcambio', mapping: 'valortcambio', type: 'string'},
                    ],
                    proxy: {
                        type: 'ajax',
                        url: '/inoF2/datosFacturas2',
                        extraParams: {
                            idmaster: this.idmaster
                        },
                        reader: {
                            type: 'json',
                            rootProperty: 'root'
                        }
                    },
                    //groupField: 'comprobante'+this.idmaster,
                    sorters: [{
                            property: 'comprobante',
                            direction: 'ASC'
                        }],
                    autoLoad: true
                })
                );




        this.superclass.onRender.call(this, ct, position);
    },
    listeners: {
        beforeitemcontextmenu: function (obj, record, item, index, e, eOpts)
        {

            var me = this.up();
            e.stopEvent();
            var store = this.getStore();
            itemCm = new Array();

            if (record.data.idhouse != "") {

                if (record.data.estado <= 1)
                {
                    itemCm.push(
                            {
                                text: 'Editar',
                                handler: function () {
                                    me.ventanaFac(record);
                                }
                            },
                            {
                                text: 'Eliminar Comprobante',
                                iconCls: 'delete',
                                handler: function () {
                                    Ext.MessageBox.confirm('Confirmacion', 'esta seguro de eliminar la Comprobante',
                                            function (e) {
                                                if (e == 'yes') {
                                                    var box = Ext.MessageBox.wait('Procesando', 'Eliminando Comprobante')
                                                    Ext.Ajax.request({
                                                        url: '/inoF/EliminarGridFacturacionPanel"',
                                                        params: {
                                                            idcomprobante: record.get('idcomprobante')
                                                        },
                                                        success: function (response, opts) {
                                                            var obj = Ext.decode(response.responseText);

                                                            if (obj.errorInfo != "")
                                                                Ext.MessageBox.alert("Colsys", "Se presento un error: " + obj.errorInfo);
                                                            else
                                                                Ext.getCmp('panel-factura-' + me.idmaster).getStore().reload();
                                                            //this.up().getStore().reload();

                                                            box.hide();

                                                        },
                                                        failure: function (response, opts) {
                                                            Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                                            box.hide();
                                                        }
                                                    });
                                                }
                                            })
                                }
                            },
                            {
                                text: 'Generar Comprobante',
                                iconCls: 'import',
                                disabled: (record.data.cuentapago != "" ? false : true),
                                tooltip: (record.data.cuentapago != "" ? '' : 'Debe asignar la forma de pago del cliente'),
                                handler: function () {
                                    ncompro="";
                                    //alert(record.data.toSource());
                                    if(record.get('tipocomprobante')=="C")
                                    {
                                        ncompro=prompt("Ingrese el numero de comprobante");
                                    }
                                    else if (record.get('valortcambio') < 1)
                                    {
                                        Ext.MessageBox.alert("Colsys", "El valor de la factura no puede ser menor o igual a 0");
                                        return;
                                    }

                                    Ext.MessageBox.confirm('Confirmacion', 'esta seguro de Generar el Comprobante y contabilizarla?',
                                            function (e) {
                                                if (e == 'yes') {
                                                    var box = Ext.MessageBox.wait('Procesando', 'Generacion de Comprobante')
                                                    Ext.Ajax.request({
                                                        url: '/inoF2/generarFactura',
                                                        params: {
                                                            idcomprobante: record.get('idcomprobante'),
                                                            ncomprobante:ncompro
                                                        },
                                                        success: function (response, opts) {
                                                            var obj = Ext.decode(response.responseText);
                                                            box.hide();
                                                            if (obj.info != "")
                                                                Ext.MessageBox.alert("Colsys", obj.info);
                                                            if (obj.errorInfo != "")
                                                                Ext.MessageBox.alert("Colsys", "Se presento un problema al crearlo: " + obj.errorInfo);
                                                            else
                                                                Ext.MessageBox.alert("Colsys", "Se genero el Comprobante No. " + obj.consecutivo);

                                                            Ext.getCmp('panel-factura-' + me.idmaster).getStore().reload();
                                                        },
                                                        failure: function (response, opts) {
                                                            Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                                            Ext.getCmp('panel-factura-' + me.idmaster).getStore().reload();
                                                            box.hide();
                                                        }
                                                    });
                                                }                                                
                                            })
                                }
                            }
                    );
                }

                if (record.data.estado == 5 || record.data.estado == 6 || record.data.estado == 8)
                {
                    itemCm.push(
                            {
                                text: 'Anular Comprobante',
                                iconCls: 'delete',
                                handler: function () {

                                    Ext.MessageBox.confirm('Confirmacion', 'esta seguro de Anular el Comprobante',
                                            function (e) {
                                                if (e == 'yes') {
                                                    var box = Ext.MessageBox.wait('Procesando', 'Anulando Comprobante')
                                                    Ext.Ajax.request({
                                                        url: '/inoF2/AnularComprobante',
                                                        params: {
                                                            idcomprobante: record.get('idcomprobante')
                                                        },
                                                        success: function (response, opts) {
                                                            var obj = Ext.decode(response.responseText);

                                                            if (obj.errorInfo != "")
                                                                Ext.MessageBox.alert("Colsys", "Se presento un error: " + obj.errorInfo);
                                                            else
                                                            {
                                                                store.reload();
                                                            }
                                                            box.hide();
                                                        },
                                                        failure: function (response, opts) {
                                                            Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                                            box.hide();
                                                        }
                                                    });
                                                }
                                            })
                                }
                            });
                }

                if (record.data.estado == 6)
                {
                    itemCm.push(
                        {
                            text: 'Enviar a Siigo',
                            iconCls: 'page_white_magnify',
                            handler: function () {

                                Ext.MessageBox.confirm('Confirmacion', 'esta seguro de generar de nuevo el Comprobante',
                                        function (e) {
                                            if (e == 'yes') {
                                                var box = Ext.MessageBox.wait('Procesando', 'Enviando Comprobantes')
                                                Ext.Ajax.request({
                                                    url: '/inoF/EnviarSiigoConect',
                                                    params: {
                                                        idcomprobante: record.get('idcomprobante')
                                                    },
                                                    success: function (response, opts) {

                                                        var obj = Ext.decode(response.responseText);                                                            
                                                        if (obj.indincor == "+5" || obj.indincor == "5")
                                                        {
                                                            Ext.MessageBox.alert("Colsys", "Se registro correctamente la informacion");
                                                            this.up('grid').getStore().reload();
                                                        }
                                                        box.hide();
                                                    },
                                                    failure: function (response, opts) {
                                                        Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                                        box.hide();
                                                    }
                                                });
                                            }
                                        })
                            }
                        }
                    );
                }
            } else {
                itemCm.push(
                        {
                            text: 'Asignar a Facturas',
                            iconCls: 'import',
                            handler: function () {
                                
                                if (winasignacion == null)
                                {
                                    winasignacion = Ext.create('Ext.window.Window', {
                                        title: 'Asignaci&oacute;n de Facturas',
                                        height: 500,
                                        width: 500,
                                        closeAction: 'destroy',
                                        items: [
                                            {
                                                xtype: "Colsys.Ino.GridAsignacionFacturas",
                                                idmaster: idmaster,
                                                idcliente: idcliente,
                                                cliente: cliente,
                                                idcomprobante: idcomp
                                            }
                                        ],
                                        listeners: {
                                            destroy: function(){
                                                winasignacion = null;
                                            }
                                        }
                                    });
                                }
                                winasignacion.show();
                            }
                        }
                );
            }
            var menu = new Ext.menu.Menu({
                items: itemCm
            }).showAt(e.getXY());
        }
    }
})

function viewGridFac(idcomprobante, comprobante, idmaster, transporte, impoexpo, idhouse)
{
    myWindow = Ext.create('Ext.window.Window', {
        title: 'Conceptos de ' + comprobante,
        width: 435,
        height: 440,
        autoScroll: true,
        id: 'venfac',
        layout: {
            type: 'hbox',
            align: 'stretch'
        },
        items: [
            {
                xtype: 'Colsys.Ino.GridConceptosFact',
                width: 425,
                idcomprobante: idcomprobante,
                idmaster: idmaster,
                idtransporte: transporte,
                idimpoexpo: impoexpo,
                idhouse: idhouse,
                //id: 'conceptosfac'
                //id:'id-grid-comprobante',
                //name:'id-grid-comprobante'
            }
        ]
    });
    myWindow.show();
}
function verComprobante(idmoneda, file, idtransporte, idmaster) {
    if (idtransporte == "A\u00E9reo") {

        if (idmoneda == "COP") {
            var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                sorc: file + '/tipo/P'
            });
            windowpdf.show();
        } else {
            if (winComprobante == null) {
                winComprobante = new Ext.Window({
                    title: 'Comprobante',
                    width: 300,
                    id: 'compr' + idmaster,
                    closeAction: 'destroy',
                    height: 99,
                    items: {
                        xtype: 'Colsys.Ino.FormComprobanteAereo',
                        idmaster: idmaster,
                        file: file,
                        idmoneda: idmoneda
                    },
                    listeners: {
                        close: function (win, eOpts) {
                            winComprobante = null;
                        }
                    }
                })
            }
            winComprobante.show();
        }
    } else {
        openFile(file);
    }
}

function obteneridcliente(idcli,idmas,cli,idcomr){
    idcliente = idcli;
    idmaster = idmas;
    cliente = cli;
    idcomp = idcomr;
}
function viewGridDed(idcomprobante, impoexpo, transporte, idmaster) {
    if (winDeducciones == null) {
        winDeducciones = new Ext.Window({
            title: 'Deducciones',
            width: 650,
            id: 'deduccioones' + idmaster,
            height: 400,
            items: {
                xtype: 'Colsys.Ino.GridDeducciones',
                idtransporte: transporte,
                idimpoexpo: impoexpo,
                idcomprobante: idcomprobante,
                idmaster: idmaster
            },
            listeners: {
                close: function (win, eOpts) {
                    winDeducciones = null;
                }
            }
        })
    }
    winDeducciones.show();
}