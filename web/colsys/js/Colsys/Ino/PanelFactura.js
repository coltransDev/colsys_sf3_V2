winDeducciones = null;
winComprobante = null;
winasignacion = null;
winIdg = null;
winColmas = null;
myWindowConceptos = null;
Ext.define('Colsys.Ino.PanelFactura', {
    extend: 'Ext.view.View',
    //extend: 'Ext.panel.Table',
    alias: 'widget.Colsys.Ino.PanelFactura',
    //store: Ext.data.StoreManager.lookup('imagesStore'),    
    itemSelector: 'div.thumb-wrap',
    tpl: '',
    onRender: function (ct, position) {
        me = this;
        //console.log(me.ino);

        this.tpl = new Ext.XTemplate(
                '<html>',
                '<tpl  class="tpls" for=".">',
                '<div style="width:28%;height:250px;padding:10px;margin: 30px;float:left;position:relative;{estilo}" title="{tooltip}" class="{class} thumb thumb-wrap"  >',
                '<div style="position:absolute;top:20px;right:0px;display:block"  ><input name="seleccion[]" value="{idcomprobante}" class="checked_' + this.idmaster + '" type="checkbox" ></div>',
                '<div class="statement-type">{empresa}</div>',
                '<div class="statement-type">{comprobante}</div>',
                '<table cellspacing=0 cellpading=0>',
                '<tr><td class="thumb-title"></td><td colspan=3 hidden=true class="thumb-title-small">&nbsp;{idcliente}&nbsp;</td></tr>',
                '<tr><td class="thumb-title">Cliente</td><td colspan=3 class="thumb-title-small">&nbsp;{cliente}&nbsp;</td></tr>',
                '<tr><td class="thumb-title">{titulohouse}</td><td colspan=3 class="thumb-title-small">&nbsp;{house}&nbsp;</td></tr>',
                '<tr><td class="thumb-title">Valor {idmoneda}</td><td class="thumb-title-small">&nbsp;{valor:currency("$", 0)}&nbsp;</td></tr>',
                '<tr><td class="thumb-title">{titulotaza}</td><td class="thumb-title-small">&nbsp;{valortcambio:currency("$", 0)}&nbsp;</td><td class="thumb-title" style="width:90px;"> {titulocambio} </td><td class="thumb-title-small" style="margin-left:0px;"> {tcambio} </td> </tr>',
                '<tr><td class="thumb-title">Valor Deducciones</td><td colspan=1 class="thumb-title-small">&nbsp;{valordeducciones:currency("$", 0)}&nbsp;</td> <td colspan=2 class="thumb-title-small">&nbsp;{do}&nbsp;</td></tr>',
                '<tr>',
                '<tpl if="this.existFile(file)">',
                '<td colspan=2 ><a href="javascript:verComprobante(\'{idmoneda}\',\'{file}\',\'' + this.idmaster + '\')"><img src="/images/toolbar/acrobatreader.png" title="Ver Comprobante" /></a>',
                '<a href="javascript:viewGridFac(\'{idcomprobante}\',\'{comprobante}\',\'' + this.idmaster + '\',\'' + this.idtransporte + '\',\'' + this.idimpoexpo + '\',\'{idhouse}\',{estado})"><img src="/images/32x32/spreadsheet.gif" title="Ver Conceptos" /></a>',
                '<a href="javascript:viewGridDed(\'{idcomprobante}\',\'' + this.idimpoexpo + '\',\'' + this.idtransporte + '\',\'' + this.idmaster + '\',{estado})" title="Ver Deducciones"><img src="/images/32x32/spreadsheet_dw.gif" /></a>',
                '</td>',
                '</tpl>',
                '{footer}',
                '</table>',
                '<table width="100%"><tr><td id="detalle{idcomprobante}"><div class="font8 gris">[{idcomprobante} - {docentry}]</div></td>',
                '<tpl if="this.factGenerada(estado)">',
                '<tpl if="idgestado == 1">',
                '<td><p align="right"><img src="/images/16x16/button_ok.gif" title="Oportunidad en la Facturacion: {idgvalor}"/></p></td>',
                '<tpl elseif="idgestado == 0">',
                '<tpl if="this.obsIdg(idexclusion)">',
                '<td><p align="right"><img src="/images/16x16/alert_disabled.png" title="Oportunidad en la Facturacion: {idgvalor}\nObservacion: {exclusion}" /></p></td>',
                '<tpl else>',
                '<td><p align="right"><a href="javascript:winIdgFact(\'{idcomprobante}\',\'' + this.idimpoexpo + '\',\'' + this.idtransporte + '\',\'' + this.idmaster + '\')"  id="alert_nocumple"><img src="/images/16x16/alert.png" title="Oportunidad en la Facturacion: {idgvalor}" /></a></p></td>',
                '</tpl>',
                '<tpl elseif="idgestado == -1">',
                '<td><p align="right"></p></td>',
                '</tpl>',
                '</tpl>',
                '</tr></table>',
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
                    cumpleIdg: function (val) {
                        if (val == 1)
                            return true;
                        else if (val == -1)
                            return false;
                        else if (val == 0)
                            return false;
                    },
                    obsIdg: function (val) {
                        if (val > 0)
                            return true;
                        else
                            return false;
                    },
                    factGenerada(val) {
                        if (val == 5)
                            return true;
                        else
                            return false;
                    }
                }
        );
        //console.log(this.ino);

        if (me.ino || me.ino == "undefined")
            url = '/inoF2/datosFacturas2';
        else
            url = '/inoF2/datosFacturas2/ino/false';
        this.setStore(
                Ext.create('Ext.data.Store', {
                    fields: [
                        {name: 'iddetalle', mapping: 'iddetalle', type: 'int'},
                        {name: 'idhouse', mapping: 'idhouse', type: 'int'},
                        {name: 'idempresa', mapping: 'idempresa'},
                        {name: 'empresa', mapping: 'empresa', type: 'string'},
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
                        {name: 'valordeducciones', mapping: 'valordeducciones', type: 'string'},
                        {name: 'docentry'}
                    ],
                    proxy: {
                        type: 'ajax',
                        url: url,
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
            if (record.data.tipocomprobante != "R") {

                if (record.data.estado <= 1)
                {

                    itemCm.push(
                            {
                                text: 'Editar',
                                handler: function () {
                                    var inotmp = me.ino;
                                    me.ventanaFac(record, me);
                                    me.ino = inotmp;


                                }
                            },
                            {
                                text: 'Eliminar Comprobante',
                                iconCls: 'delete',
                                handler: function () {
                                    Ext.MessageBox.confirm('Confirmacion', 'esta seguro de eliminar el Comprobante',
                                            function (e) {
                                                if (e == 'yes') {
                                                    var box = Ext.MessageBox.wait('Procesando', 'Eliminando Comprobante')
                                                    Ext.Ajax.request({
                                                        url: '/inoF2/EliminarGridFacturacionPanel',
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
                                //disabled: (record.data.cuentapago != "" ? false : true),
                                //tooltip: (record.data.cuentapago != "" ? '' : 'Debe asignar la forma de pago del cliente'),
                                handler: function () {
                                    ncompro = "";
                                    //alert(record.data.toSource());
                                    /*if(record.get('tipocomprobante')=="C")
                                     {
                                     ncompro=prompt("Ingrese el numero de comprobante");
                                     }
                                     else*/ if (record.get('valortcambio') < 1)
                                    {
                                        Ext.MessageBox.alert("Colsys", "El valor de la factura no puede ser menor o igual a 0");
                                        return;
                                    }
                                    Ext.Ajax.setTimeout(120000);

                                    Ext.MessageBox.confirm('Confirmacion', 'esta seguro de Generar el Comprobante y contabilizarla?',
                                            function (e) {
                                                if (e == 'yes') {
                                                    var box = Ext.MessageBox.wait('Procesando', 'Generacion de Comprobante')
                                                    Ext.Ajax.request({
                                                        url: '/inoF2/generarComprobante',
                                                        params: {
                                                            idcomprobante: record.get('idcomprobante'),
                                                            ncomprobante: ncompro
                                                        },
                                                        success: function (response, opts) {
                                                            var obj = Ext.decode(response.responseText);
                                                            //console.log(obj);
                                                            file = obj.file;
                                                            idmoneda = obj.idmoneda;
                                                            obj = obj.resul;
                                                            //console.log(obj);
                                                            box.hide();
                                                            //if (obj.info != "")
                                                            //    alert(obj.info);
                                                            if (obj.Status != "0")
                                                                Ext.MessageBox.alert("Colsys", "Se presento un problema al crearlo: " + obj.Message);
                                                            else
                                                            {
                                                                Ext.MessageBox.alert("Colsys", "Se genero el Comprobante No. " + obj.Consecutivo);
                                                                verComprobante(idmoneda, file, me.idmaster);
                                                            }

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
                } else if (record.data.estado == 5)
                {

                    if (record.data.tipocomprobante == "F" && (me.permisos.NotasCredito || me.ino == false))
                    {
                        itemCm.push(
                                {
                                    text: 'Crear Nota Credito',
                                    handler: function () {
                                        me.ventanaFac(record, me, record.data.docentry);
                                    }
                                });
                    }

                }

                if (record.data.cliente == 'AGENCIA DE ADUANAS COLMAS SAS NIVEL 1')
                {

                    if (record.data.tipocomprobante == "F" && me.ino)
                    {
                        itemCm.push(
                                {
                                    text: 'Agregar D.O.',
                                    handler: function () {
                                        winDO(record.data.idcomprobante, record.data.do);
                                    }
                                });
                    }

                }
                //console.log(record.data);
                //console.log(me);


                itemCm.push(
                        {
                            text: 'Duplicar Comprobante',
                            iconCls: 'page_copy',
                            handler: function () {
                                Ext.MessageBox.confirm('Confirmacion', 'esta seguro de duplicar el Comprobante',
                                        function (e) {
                                            if (e == 'yes') {
                                                var box = Ext.MessageBox.wait('Procesando', 'Duplicando Comprobante')
                                                Ext.Ajax.request({
                                                    url: '/inoF2/duplicarComprobante',
                                                    params: {
                                                        idcomprobante: record.get('idcomprobante')
                                                    },
                                                    success: function (response, opts) {
                                                        var obj = Ext.decode(response.responseText);

                                                        /*if (obj.errorInfo != "")
                                                         Ext.MessageBox.alert("Colsys", "Se presento un error: " + obj.errorInfo);
                                                         else
                                                         Ext.getCmp('panel-factura-' + me.idmaster).getStore().reload();*/
                                                        //this.up().getStore().reload();

                                                        Ext.getCmp('panel-factura-' + me.idmaster).getStore().reload();
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

            } /*else if (record.data.tipocomprobante == "R") {
             
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
             });
             
             }*/

            /*console.log(itemCm.length);
             console.log(me.permisos);
             console.log(me.ino);*/
            if (itemCm.length > 0 && (me.permisos.Editar == true || !me.ino))
            {
                var menu = new Ext.menu.Menu({
                    items: itemCm
                }).showAt(e.getXY());
            }
        }
    }
})

function viewGridFac(idcomprobante, comprobante, idmaster, transporte, impoexpo, idhouse, estado)
{
    if (myWindowConceptos == null)
    {
        myWindowConceptos = Ext.create('Ext.window.Window', {
            title: 'Conceptos de ' + comprobante,
            width: 435,
            height: 440,
            autoScroll: true,
            id: 'venfac' + idmaster,
            closeAction: 'destroy',
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
                    estado: estado,
                    id: 'conceptosfac' + idmaster,
                    name: 'conceptosfac' + idmaster,
                    permisos: Ext.getCmp("panel-facturacion-" + idmaster).permisos
                            //id:'id-grid-comprobante',
                            //name:'id-grid-comprobante'
                }
            ],
            listeners: {
                close: function (win, eOpts) {
                    myWindowConceptos = null;
                }
            }
        });
        myWindowConceptos.show();
    } else
    {
        alert("Tiene una ventana activa de conceptos, por favor cierrela primero para continuar");
    }
}

function verComprobante(idmoneda, file, idmaster) {
    //if (idtransporte == "A\u00E9reo") 
    {

        /*if (idmoneda == "COP") {
         var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
         sorc: file + '/tipo/P/idmoneda/COP/idioma/esp/orden/1/'
         });
         windowpdf.show();
         } else */{
            if (winComprobante == null) {
                winComprobante = Ext.create('Ext.Window', {
                    title: 'Comprobante',
                    width: 400,
                    id: 'compr' + idmaster,
                    //closeAction: 'destroy',
                    height: 180,
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
                });
            }
            winComprobante.show();
        }
    } /*else {
     openFile(file);
     }*/
}

/*function obteneridcliente(idcli,idmas,cli,idcomr){
 idcliente = idcli;
 idmaster = idmas;
 cliente = cli;
 idcomp = idcomr;
 }*/
function viewGridDed(idcomprobante, impoexpo, transporte, idmaster, estado) {
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
                estado: estado,
                idmaster: idmaster,
                permisos: Ext.getCmp("panel-facturacion-" + idmaster).permisos
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

function winIdgFact(idcomprobante, impoexpo, transporte, idmaster) {
    if (winIdg == null) {
        winIdg = new Ext.Window({
            title: 'Idg Facturaci\u00F3n',
            width: 450,
            id: 'winidg' + idcomprobante,
            height: 110,
            dockedItems: [{
                    xtype: 'toolbar',
                    dock: 'top',
                    items: [
                        {
                            xtype: 'button',
                            text: 'Guardar Observaci\u00F3n',
                            handler: function () {

                                var idexclusion = Ext.getCmp("exclusion" + idcomprobante).getValue();

                                Ext.Ajax.request({
                                    url: '/inoF2/registrarObservacionIdg',
                                    params: {
                                        idcomprobante: idcomprobante,
                                        id: idexclusion,
                                        idg: 'OFC'
                                    },
                                    success: function (response, opts) {
                                        var obj = Ext.decode(response.responseText);

                                        if (obj.errorInfo != "")
                                            Ext.MessageBox.alert("Colsys", "Se presento un error: " + obj.errorInfo);
                                        else {
                                            Ext.getCmp('panel-factura-' + idmaster).getStore().reload();
                                            Ext.MessageBox.alert("Colsys", "Factura #" + obj.consecutivo + " ha registrado correctamente la observaci\u00F3n para el indicador");
                                            Ext.getCmp("winidg" + idcomprobante).close();
                                        }
                                    },
                                    failure: function (response, opts) {
                                        Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                        box.hide();
                                    }
                                });
                            }
                        }
                    ]
                }],
            items: [{
                    xtype: 'fieldset',
                    layout: 'vbox',
                    items: [{
                            xtype: 'Colsys.Widgets.WgExclusionesIdg',
                            fieldLabel: 'Exclusiones Idg',
                            id: 'exclusion' + idcomprobante,
                            width: 400,
                            impoexpo: impoexpo,
                            transporte: transporte
                        }]
                }],
            listeners: {
                close: function (win, eOpts) {
                    winIdg = null;
                }
            }
        })
    }
    winIdg.show();
}


function winDO(idcomprobante, ca_do) {
    if (winColmas == null) {
        winColmas = new Ext.Window({
            //title: 'Idg Facturaci\u00F3n',
            width: 400,
            id: 'windo' + idcomprobante,
            height: 70,
            /*dockedItems: [{
             xtype: 'toolbar',
             dock: 'top',
             items: [
             
             ]
             }],*/
            items: [{
                    xtype: 'fieldset',
                    layout: 'hbox',
                    items: [{
                            xtype: 'textfield',
                            fieldLabel: 'D.O.',
                            id: 'do' + idcomprobante,
                            width: 300,
                            value: ca_do
                        },
                        {
                            xtype: 'button',
                            text: 'Guardar ',
                            handler: function () {

                                var fdo = Ext.getCmp("do" + idcomprobante).getValue();

                                Ext.Ajax.request({
                                    url: '/inoF2/guardarDo',
                                    params: {
                                        "idcomprobante": idcomprobante,
                                        "do": fdo
                                    },
                                    success: function (response, opts) {
                                        var obj = Ext.decode(response.responseText);

                                        if (obj.errorInfo != "")
                                            Ext.MessageBox.alert("Colsys", "Se presento un error: " + obj.errorInfo);
                                        else {
//                                        Ext.getCmp('panel-factura-' + idmaster).getStore().reload();
                                            Ext.MessageBox.alert("Colsys", "Factura #" + obj.consecutivo + " ha registrado correctamente el D.O.");
                                            Ext.getCmp("windo" + idcomprobante).close();
                                        }
                                    },
                                    failure: function (response, opts) {
                                        Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                        box.hide();
                                    }
                                });
                            }
                        }
                    ]
                },
            ],
            listeners: {
                close: function (win, eOpts) {
                    winColmas = null;
                }
            }
        })
    }
    winColmas.show();
}