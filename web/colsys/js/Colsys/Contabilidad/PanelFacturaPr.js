winDeducciones = null;
winComprobante = null;
winasignacion = null;
myWindowFacturaPr=null;
Ext.define('Colsys.Contabilidad.PanelFacturaPr', {
    extend: 'Ext.view.View',
    //extend: 'Ext.panel.Table',
    alias: 'widget.Colsys.Contabilidad.PanelFacturaPr',
    //store: Ext.data.StoreManager.lookup('imagesStore'),    
    itemSelector: 'div.thumb-wrap',
    tpl: '',
    onRender: function (ct, position) {
        me=this;
        console.log(me.idpanel);
        
        this.tpl = new Ext.XTemplate(
                '<html>',
                    '<tpl  class="tpls" for=".">',
                        '<div style="width:28%;height:230px;padding:10px;margin: 30px;float:left;position:relative;{estilo}" title="{tooltip}" class="{class} thumb thumb-wrap"  >',
                        '<div style="position:absolute;top:20px;right:0px;display:block"  ><input name="seleccion[]" value="{idcomprobante}" class="checked_'+this.idmaster+'" type="checkbox" ></div>',
                        '<div class="statement-type">{empresa}</div>',
                        '<div class="statement-type">{comprobante}</div>',                
                        '<table>',                
                            '<tr><td  class="thumb-title"></td><td colspan=3 hidden=true class="thumb-title-small">{idcliente}</td></tr>',
                            '<tr><td  class="thumb-title">Proveedor</td><td colspan=3 class="thumb-title-small">{cliente}</td></tr>',
                            /*'<tr><td   class="thumb-title">{titulohouse}</td><td colspan=3 class="thumb-title-small">{house}</td></tr>',*/
                            '<tr><td class="thumb-title">Valor {idmoneda}</td><td class="thumb-title-small">{valor}</td></tr>',
                            '<tr><td class="thumb-title">{titulotaza}</td><td class="thumb-title-small">{valortcambio}</td><td class="thumb-title" style="width:90px;">{titulocambio}</td><td class="thumb-title-small" style="margin-left:0px;">{tcambio}</td> </tr>',
                            '<tr>',
                            '<tpl if="this.existFile(file)">',
                                '<td colspan=2 ><a href="javascript:verComprobante(\'{idmoneda}\',\'{file}\',\'' + this.idtransporte + '\',\'' + this.idmaster + '\')"><img src="/images/toolbar/acrobatreader.png" title="Ver Comprobante" /></a>',
                                '<a href="javascript:viewGridFacPr(\'{idcomprobante}\',\'{comprobante}\',\'{transporte}\',\'{impoexpo}\',{estado},{idempresa},\''+this.idpanel+'\',\'{collect}\')"><img src="/images/32x32/spreadsheet.gif" title="Ver Conceptos" /></a>',
                                /*'<a href="javascript:viewGridDed(\'{idcomprobante}\',\'' + this.idimpoexpo + '\',\'' + this.idtransporte + '\',\'' + this.idmaster + '\')" title="Ver Deducciones"><img src="/images/32x32/spreadsheet_dw.gif" /></a>',*/
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
                ],
                proxy: {
                    type: 'ajax',
                    url: '/contabilidad/datosFacturasPr',
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
        beforeitemcontextmenu: function (obj, record, item, index, e, eOpts){

            var me = this.up();
            e.stopEvent();
            var store = this.getStore();
            itemCm = new Array();
            //console.log(record.data)
            if (record.data.tipocomprobante == "P" || record.data.tipocomprobante == "D") {
                if (record.data.estado <= 1){
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
                                    Ext.MessageBox.confirm('Confirmacion', '?Está seguro de eliminar el Comprobante?',
                                    function (e) {
                                        if (e == 'yes') {
                                            var box = Ext.MessageBox.wait('Procesando', 'Eliminando Comprobante')
                                            Ext.Ajax.request({
                                                url: '/inoF2/EliminarGridFacturacionPanel"',
                                                params: {
                                                    idcomprobante: record.get('idcomprobante')
                                                },
                                                success: function (response, opts) {
                                                    var obj = Ext.decode(response.responseText);

                                                    if (obj.errorInfo != "")
                                                        Ext.MessageBox.alert("Colsys", "Se presento un error: " + obj.errorInfo);
                                                    else                                                        
                                                        Ext.getCmp('panel-factura-pr' + me.idpanel).getStore().reload();
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
                                tooltip: (record.data.cuentapago != "" ? '' : 'Debe asignar la forma de pago del cliente'),
                                handler: function () {
                                    ncompro="";
                                    if (record.get('valortcambio') < 1){
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
                                                        ncomprobante:ncompro
                                                    },
                                                    success: function (response, opts) {
                                                        
                                                        var obj = Ext.decode(response.responseText);                                                        
                                                        obj=obj.resul;                                                        
                                                        box.hide();
                                                        
                                                        if(obj !== null){
                                                            if (obj.Status != "0")
                                                                Ext.MessageBox.alert("Colsys", "Se presento un problema al crearlo: " + obj.Message);
                                                            else
                                                                Ext.MessageBox.alert("Colsys", "La Factura de venta o Nota Cr\u00E9dito se ha creado correctamente y los costos han sido asociados a la Referencia. No Doc Interno: " + obj.DocEntry);
                                                                Ext.getCmp('panel-factura-pr' + me.idpanel).getStore().reload();
                                                        }else{
                                                            Ext.MessageBox.alert("Colsys", "Se presento un problema al crearlo: Resultado Nulo. No existe transacción");
                                                        }
                                                    },
                                                    failure: function (response, opts) {
                                                        Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                                        Ext.getCmp('panel-factura-pr' + me.idpanel).getStore().reload();
                                                        box.hide();
                                                    }
                                                });
                                            }                                                
                                        })
                                }
                            }
                    );
                }

                if (record.data.estado == 5 || record.data.estado == 6 )
                {
                    itemCm.push(
                            {
                                text: 'Anular Comprobante..',
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

                                                            /*if (obj.errorInfo != "")
                                                                Ext.MessageBox.alert("Colsys", "Se presento un error: " + obj.errorInfo);
                                                            else
                                                            {
                                                                store.reload();
                                                            }*/
                                                            obj=obj.resul;
                                                            
                                                            if (obj.Status != "0")
                                                            {
                                                                alert("Se presento un problema al anular: " + obj.Message)
                                                                //Ext.MessageBox.alert("Colsys", "Se presento un problema al anular: " + obj.Message);
                                                            }
                                                            else
                                                                store.reload();
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
            } else if (record.data.tipocomprobante == "R") {                
                
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
                
            }
            itemCm.push({
                text: 'Duplicar Comprobante',
                iconCls: 'page_copy',
                handler: function () {
                    Ext.MessageBox.confirm('Confirmacion', 'Esta seguro que desea duplicar el comprobante?',
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
                                            
                                            Ext.MessageBox.alert("Colsys", "Comprobante duplicado satisfactoriamente!!!");
                                            
                                            Ext.getCmp('panel-factura-pr' + me.idpanel).getStore().reload();
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
            if(itemCm.length>0)
            {
                var menu = new Ext.menu.Menu({
                    items: itemCm
                }).showAt(e.getXY());
            }
        }
    }
});

function viewGridFacPr(idcomprobante, comprobante, transporte, impoexpo, estado, idempresa,idpanel,collect){
    
    console.log(idpanel);
    //console.log("idempresa"+idempresa);    
    //console.log("transporte"+transporte);
    //console.log("impoexpo"+impoexpo);
    if (myWindowFacturaPr === null){
        myWindowFacturaPr = Ext.create('Ext.window.Window', {
            title: 'Conceptos de ' + comprobante,
            width: 800,
            height: 440,
            autoScroll: true,
            id: 'windowFacPr'+idcomprobante,
            closeAction:'destroy',
            layout: {
                type: 'hbox',
                align: 'stretch'
            },
            items: [
                Ext.create('Colsys.Contabilidad.GridFacturaPr',{
                    width: 800,
                    autoWidth: true,
                    idcomprobante: idcomprobante,
                    idgrid: idpanel,                    
                    idempresa: idempresa,
                    idtransporte: transporte,
                    idimpoexpo: impoexpo,
                    //idhouse: idhouse,
                    estado:estado,
                    id: 'gridFacPr'+idcomprobante,
                    name: 'gridFacPr'+idcomprobante,
                    collect:collect
                })
            ],
            listeners: {
                close: function (win, eOpts) {
                    myWindowFacturaPr = null;
                }
            }
        });
        myWindowFacturaPr.show();
    }else{
        alert("Tiene una ventana activa de conceptos, por favor cierrela primero para continuar");
    }
}
function verComprobante(idmoneda, file, idtransporte, idmaster) {
    //if (idtransporte == "A\u00E9reo") 
    {

        if (idmoneda == "COP") {
            var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                sorc: file + '/tipo/P'
            });
            windowpdf.show();
        } else {
            if (winComprobante == null) {
                winComprobante = Ext.create('Ext.Window',{
                    title: 'Comprobante',
                    width: 400,
                    id: 'compr' + idmaster,
                    //closeAction: 'destroy',
                    height: 150,
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