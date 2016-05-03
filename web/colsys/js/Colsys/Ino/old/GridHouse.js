/*
 * @autor Nataly Puentes
 * Gestor de Houses
 * @params: 
 *       idimpoexpo  : texto con informacion de impoexpo 
 *       idtransporte: texto con modo de transporte
 * @date:  2016-03-31
 */
var constrainedWin2H = null;
var comboCliente = null;
var comboVendedor = null;
var comboReporte = null;
var comboReferencia = null;
var comboBoxRenderer = null;
var fileButton = null;
var tipo = "Proveedor";

Ext.define('Colsys.Ino.GridHouse', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Ino.GridHouse',
    id: "gridhouse",
    height: 400,
    autoScroll: true,
    viewConfig: {
        getRowClass: function (record, rowIndex, rowParams, store) {
            return "row_" + record.get("color");
        }
    },
    selModel: {
        selType: 'cellmodel'
    },
    frame: true,
    /*
     * 
     * tbar: [
     {
     text    : 'Agregar',
     iconCls : 'add',
     width   : 80,
     handler : function(){    
     var store =this.up("grid").getStore();
     var r = Ext.create(store.getModel());
     idmaster=this.up("grid").idmaster;
     cidmaster="idmaster"+idmaster;
     r.set(cidmaster,idmaster);
     store.insert(0, r);
     }
     },
     {
     text    : 'Guardar',
     iconCls : 'add',
     width   : 80,
     //id: 'btn-guardarHouse',
     handler : function(){
     var store = this.up('grid').getStore();
     
     var model = Ext.create(store.getModel());
     var columnsName = [];
     var fieldsName = [];
     var rows =[];
     var filtrerfields= function(field,index, array){
     
     columnsName.push(field.mapping);
     fieldsName.push(field.name);
     };
     var filtrerRows = function(rowModel, index, array){
     
     var row = new Object();
     var lenght1 = fieldsName.length;
     for(var i=0 ;i< lenght1; i++){
     row[columnsName[i]]= rowModel.data[fieldsName[i]];
     }
     rows.push(row);
     };
     model.fields.forEach(filtrerfields);
     store.getModifiedRecords().forEach(filtrerRows);
     //console.log(rows.doctransporte);
     
     var rowJson = JSON.stringify(rows);
     if(rowJson.length>5)
     {
     Ext.Ajax.request({
     url: '/inoF2/guardarGridHouse',
     params: {                            
     datos:rowJson
     },
     success: function(response, opts)
     {                                    
     var res = Ext.decode(response.responseText);                                  
     if( res.id && res.success)
     {
     id=res.id.split(",");                                        
     for(i=0;i<id.length;i++)
     {
     var rec = store.getById(id[i]);                                            
     rec.commit();                                    
     }
     
     Ext.Msg.alert('Mensaje',"Se guardo Correctamente los datos del House");
     store.reload();
     }
     if(res.errorInfo!="" && res.errorInfo!="null")
     {
     
     Ext.MessageBox.alert("Mensaje",'No fue posible el guardar los datos del House <br>'+res.errorInfo);
     //Ext.getCmp('btn-guardarHouse').enable();
     
     //rec.commit();
     store.reload();
     }
     //Ext.getCmp('btn-guardarHouse').enable();
     },
     failure: function(response, opts)
     {
     Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
     box.hide();
     //Ext.getCmp('btn-guardarHouse').enable();
     }
     });
     }
     }
     }
     ],*/
    plugins: {
        ptype: 'cellediting',
        clicksToEdit: 1
    },
    onRender: function (ct, position)
    {



        comboVendedor = Ext.create('Colsys.Widgets.wgUsuario', {
        });
        comboCliente = Ext.create('Colsys.Widgets.WgClientes', {
            displayField: 'compania',
            valueField: 'idcliente',
            listeners:
                    {
                        select: function (a, record, idx)
                        {
                            var selected = this.up('grid').getSelectionModel().getSelection()[0];
                            var row = this.up('grid').store.indexOf(selected);
                            var store = this.up('grid').getStore();
                            //console.log(record[0].data);
                            store.data.items[row].set('idcliente' + this.up('grid').idmaster, record[0].data.ca_idcliente);
                            store.data.items[row].set('vendedor' + this.up('grid').idmaster, record[0].data.ca_vendedor);

                        }
                    }

        });
        idtransporte = this.idtransporte
        idimpoexpo = this.idimpoexpo;
        comboReporte = Ext.create('Colsys.Widgets.WgReporte', {
            displayField: 'consecutivo',
            valueField: 'idreporte',
            idimpoexpo: idimpoexpo,
            idtransporte: idtransporte,
            listeners:
                    {
                        select: function (a, record, idx)
                        {

                            var selected = this.up('grid').getSelectionModel().getSelection()[0];
                            var row = this.up('grid').store.indexOf(selected);
                            var store = this.up('grid').getStore();
                            console.log(record[0].data);
                            store.data.items[row].set('doctransporte' + this.up('grid').idmaster, record[0].data.h_ca_doctransporte);
                            store.data.items[row].set('idreporte' + this.up('grid').idmaster, record[0].data.idreporte);
                            store.data.items[row].set('tercero' + this.up('grid').idmaster, record[0].data.ca_tercero);
                            store.data.items[row].set('idtercero' + this.up('grid').idmaster, record[0].data.r_ca_idproveedor);
                            store.data.items[row].set('vendedor' + this.up('grid').idmaster, record[0].data.usu_ca_login);
                            store.data.items[row].set('cliente' + this.up('grid').idmaster, record[0].data.compania);
                            store.data.items[row].set('idcliente' + this.up('grid').idmaster, record[0].data.cl_ca_idcliente);
                            store.data.items[row].set('numpiezas' + this.up('grid').idmaster, record[0].data.ca_piezas);
                            store.data.items[row].set('peso' + this.up('grid').idmaster, record[0].data.ca_peso);
                            store.data.items[row].set('volumen' + this.up('grid').idmaster, record[0].data.ca_volumen);
                            store.data.items[row].set('numorden' + this.up('grid').idmaster, record[0].data.h_ca_numorden);
                        }
                    }
        });
        comboReferencia = Ext.create('Colsys.Widgets.wgReferencia', {
            listeners:
                    {
                        select: function (a, record, idx)
                        {
                            var selected = this.up('grid').getSelectionModel().getSelection()[0];
                            var row = this.up('grid').store.indexOf(selected);
                            var store = this.up('grid').getStore();
                            store.data.items[row].set('vendedor' + this.up('grid').idmaster, record[0].data.ca_vendedor);
                            store.data.items[row].set('cliente' + this.up('grid').idmaster, record[0].data.ca_compania);
                            store.data.items[row].set('idcliente' + this.up('grid').idmaster, record[0].data.ca_idcliente);
                            store.data.items[row].set('numpiezas' + this.up('grid').idmaster, record[0].data.ca_piezas);
                            store.data.items[row].set('peso' + this.up('grid').idmaster, record[0].data.ca_peso);
                            store.data.items[row].set('volumen' + this.up('grid').idmaster, record[0].data.ca_volumen);
                            store.data.items[row].set('numorden' + this.up('grid').idmaster, record[0].data.ca_pedido);
                        }
                    }
        });
        comboTercero = Ext.create('Colsys.Widgets.wgTercero', {
            displayField: 'nombre',
            valueField: 'idtercero',
            listeners:
                    {
                        select: function (a, record, idx)
                        {
                            var selected = this.up('grid').getSelectionModel().getSelection()[0];
                            var row = this.up('grid').store.indexOf(selected);
                            var store = this.up('grid').getStore();
                            store.data.items[row].set('idtercero' + this.up('grid').idmaster, record[0].data.t_ca_idtercero);

                        }
                    }
        });

        comboBoxRenderer = function (combo) {
            return function (value) {
                var idx = combo.store.find(combo.valueField, value);
                var rec = combo.store.getAt(idx);
                return (rec === null ? value : rec.get(combo.displayField));
            };
        };
        this.reconfigure(
                Ext.create('Ext.data.Store', {
                    id: "storeGridHouse",
                    fields:
                            [
                                {name: 'idmaster' + this.idmaster, type: 'integer', mapping: 'idmaster'},
                                {name: 'idhouse' + this.idmaster, type: 'integer', mapping: 'idhouse'},
                                {name: 'doctransporte' + this.idmaster, type: 'string', mapping: 'doctransporte'},
                                {name: 'fchdoctransporte' + this.idmaster, type: 'date', mapping: 'fchdoctransporte', dateFormat: 'Y-m-d'},
                                {name: 'idcliente' + this.idmaster, type: 'integer', mapping: 'idcliente'},
                                {name: 'cliente' + this.idmaster, type: 'string', mapping: 'cliente'},
                                {name: 'tercero' + this.idmaster, type: 'string', mapping: 'tercero'},
                                {name: 'vendedor' + this.idmaster, type: 'string', mapping: 'vendedor'},
                                {name: 'idtercero' + this.idmaster, type: 'integer', mapping: 'idtercero'},
                                {name: 'idreporte' + this.idmaster, type: 'integer', mapping: 'idreporte'},
                                {name: 'reporte' + this.idmaster, type: 'string', mapping: 'reporte'},
                                {name: 'numpiezas' + this.idmaster, type: 'integer', mapping: 'numpiezas'},
                                {name: 'peso' + this.idmaster, type: 'float', mapping: 'peso'},
                                {name: 'volumen' + this.idmaster, type: 'float', mapping: 'volumen'},
                                {name: 'numorden' + this.idmaster, type: 'string', mapping: 'numorden'},
                                {name: 'color' + this.idmaster, type: 'string', mapping: 'color'}
                            ],
                    proxy: {
                        type: 'ajax',
                        url: '/inoF2/datosGridHouse',
                        baseParams: {
                            impoexpo: 'impoexpo'
                        },
                        reader: {
                            type: 'json',
                            root: 'root',
                            totalProperty: 'total',
                            modo: 'modo'
                        }
                    },
                    sorters: [{
                            property: 'doctransporte',
                            direction: 'ASC'
                        }],
                    autoLoad: false,
                }),
                columns =
                [
                    {
                        header: "master" + this.idmaster,
                        hidden: true,
                        dataIndex: "idmaster" + this.idmaster
                    },
                    {
                        header: "Cliente" + this.idmaster,
                        dataIndex: 'cliente' + this.idmaster,
                        hideable: false,
                        sortable: true,
                        width: 280,
                        editor: {xtype: comboCliente},
                        renderer: comboBoxRenderer(comboCliente)
                    },
                    {
                        header: "Idcliente",
                        hidden: true,
                        dataIndex: 'idcliente' + this.idmaster,
                        sortable: true,
                        width: 100
                    },
                    {
                        header: "idreporte",
                        hidden: true,
                        dataIndex: 'idreporte' + this.idmaster,
                        sortable: true,
                        width: 100
                    },
                    {
                        header: "Vendedor",
                        dataIndex: 'vendedor' + this.idmaster,
                        hideable: false,
                        sortable: true,
                        width: 160,
                        editor: {xtype: comboVendedor},
                        renderer: comboBoxRenderer(comboVendedor)

                    },
                    {
                        header: "Piezas",
                        dataIndex: 'numpiezas' + this.idmaster,
                        hideable: false,
                        sortable: true,
                        width: 80,
                        editor: {xtype: "numberfield"}
                    },
                    {
                        header: "Peso",
                        dataIndex: 'peso' + this.idmaster,
                        hideable: false,
                        sortable: true,
                        width: 80,
                        align: 'right',
                        editor: {
                            xtype: "numberfield",
                            decimalPrecision: 2
                        }
                    },
                    {
                        header: "Volumen",
                        dataIndex: 'volumen' + this.idmaster,
                        hideable: false,
                        width: 80,
                        align: 'right',
                        sortable: true,
                        editor: {
                            xtype: "numberfield",
                            decimalPrecision: 2
                        }
                    },
                    {
                        header: "Orden",
                        dataIndex: "numorden" + this.idmaster,
                        editor: {xtype: "textfield"}
                    }
                ]
                );
        var orden = [];
        var house =
                {
                    header: "House" + this.idmaster,
                    id: "doctransporte" + this.idmaster,
                    dataIndex: 'doctransporte' + this.idmaster,
                    width: 125,
                    sortable: true,
                    editor: {xtype: comboReferencia}
                };
        var reporte =
                {
                    header: "Reporte",
                    dataIndex: 'reporte' + this.idmaster,
                    sortable: true,
                    width: 100,
                    renderer: comboBoxRenderer(comboReporte),
                    editor:
                            {
                                xtype: comboReporte,
                                impoExpo: this.idimpoexpo,
                                transporte: this.idtransporte
                            }
                };
        var proveedor =
                {
                    header: "Proveedor",
                    dataIndex: 'tercero' + this.idmaster,
                    hideable: false,
                    width: 100,
                    sortable: true,
                    editor:
                            {
                                xtype: comboTercero
                            },
                    renderer: comboBoxRenderer(comboTercero)
                };
        var idproveedor =
                {
                    header: "IdProveedor",
                    dataIndex: 'idtercero' + this.idmaster,
                    hidden: true,
                    width: 50

                }
        //console.log(this.idimpoexpo+"--"+this.idtransporte);
        var guardar = {
                text: 'Guardar',
                iconCls: 'add',
                width: 80,
                handler: function () {
                    var store = this.up('grid').getStore();

                    var model = Ext.create(store.getModel());
                    var columnsName = [];
                    var fieldsName = [];
                    var rows = [];
                    var filtrerfields = function (field, index, array) {

                        columnsName.push(field.mapping);
                        fieldsName.push(field.name);
                    };
                    var filtrerRows = function (rowModel, index, array) {

                        var row = new Object();
                        var lenght1 = fieldsName.length;
                        for (var i = 0; i < lenght1; i++) {
                            row[columnsName[i]] = rowModel.data[fieldsName[i]];
                        }
                        rows.push(row);
                    };
                    model.fields.forEach(filtrerfields);
                    store.getModifiedRecords().forEach(filtrerRows);

                    var rowJson = JSON.stringify(rows);
                    if (rowJson.length > 5)
                    {
                        Ext.Ajax.request({
                            url: '/inoF2/guardarGridHouse',
                            params: {
                                datos: rowJson
                            },
                            success: function (response, opts)
                            {
                                var res = Ext.decode(response.responseText);
                                if (res.id && res.success)
                                {
                                    id = res.id.split(",");
                                    for (i = 0; i < id.length; i++)
                                    {
                                        var rec = store.getById(id[i]);
                                        rec.commit();
                                    }

                                    Ext.Msg.alert('Mensaje', "Se guardo Correctamente los datos del House");
                                    store.reload();
                                }
                                if (res.errorInfo != "" && res.errorInfo != "null")
                                {

                                    Ext.MessageBox.alert("Mensaje", 'No fue posible el guardar los datos del House <br>' + res.errorInfo);
                                    store.reload();
                                }
                            },
                            failure: function (response, opts)
                            {
                                Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                box.hide();
                            }
                        });
                    }
                }
            };
            
        tb = new Ext.toolbar.Toolbar({dock: 'top'});
        if (this.permisos.Crear == true) {
            tb.add(
                    {
                        text: 'Agregar',
                        iconCls: 'add',
                        width: 80,
                        handler: function () {
                            var store = this.up("grid").getStore();
                            var r = Ext.create(store.getModel());
                            idmaster = this.up("grid").idmaster;
                            cidmaster = "idmaster" + idmaster;
                            r.set(cidmaster, idmaster);
                            store.insert(0, r);
                        }
                    },
                    guardar
            );

        }
        if (this.permisos.Editar == true) {
            tb.add(guardar);
        }
        this.addDocked(tb, 'top');

        if (this.idimpoexpo == "INTERNO" && this.idtransporte == "Terrestre") {
            orden.push(house);
        } else
        {
            orden.push(reporte, {
                header: "House" + this.idmaster,
                id: "doctransporte" + this.idmaster,
                dataIndex: 'doctransporte' + this.idmaster,
                width: 125,
                sortable: true,
                editor: {xtype: "textfield"}
            }, proveedor, idproveedor);
        }
        ;
        this.reconfigure(orden.concat(columns));
        this.superclass.onRender.call(this, ct, position);
    },
    listeners:
            {
                activate: function (ct, position)
                {
                    var store = this.store;


                    if (this.load == false || this.load == "undefined" || !this.load)
                    {
                        store.proxy.extraParams = {
                            idmaster: this.idmaster,
                            idimpoexpo: this.idimpoexpo
                        },
                        this.store.reload();
                        this.load = true;
                    }
                },
                beforeitemcontextmenu: function (view, record, item, index, e)
                {
                    e.stopEvent();
                    eliminar = null;
                    
                    if(this.permisos.Anular){
                    eliminar = {
                                text: 'Eliminar',
                                iconCls: 'delete',
                                scope: this,
                                handler: function (idg) {
                                    var store = this.store;
                                    var row = store.indexOf(record);
                                    data = record.data.idhouse;
                                    if (data == null || data == "") {
                                        store.removeAt(row);
                                    } else
                                    {
                                        Ext.MessageBox.confirm('Confirmacion', 'esta seguro de Eliminar el registro',
                                                function (e) {
                                                    if (e == 'yes') {
                                                        var box = Ext.MessageBox.wait('Procesando', 'Eliminando');
                                                        Ext.Ajax.request({
                                                            waitMsg: 'Eliminando...',
                                                            url: '/inoF2/eliminarGridHouse',
                                                            params: {
                                                                idhouse: record.data.idhouse
                                                            },
                                                            success: function (response, opts) {
                                                                var obj = Ext.decode(response.responseText);
                                                                if (obj.errorInfo != "" && obj.errorInfo != "undefined")
                                                                {
                                                                    alert("Se presento un error: " + obj.errorInfo);
                                                                } else
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
                                                });
                                    }
                                }
                            };
                    }
                    var items = new Array();
                    var menu = new Ext.menu.Menu({
                        items: [
                            {
                                text: 'Status',
                                iconCls: 'search',
                                scope: this,
                                handler: function () {
                                    reporte = record.data.reporte;
                                    if (reporte == null) {
                                        reporte = "No asignado";
                                    }
                                    Ext.create('Ext.window.Window', {
                                        title: 'Status de reporte: ' + reporte,
                                        id: 'status' + record.data.idreporte,
                                        width: 820,
                                        height: 400,
                                        layout: 'fit',
                                        autoScroll: true,
                                        items:
                                                {
                                                    xtype: Ext.create('Colsys.Widgets.wgStatus', {
                                                        reporte: reporte,
                                                        idreporte: record.data.idreporte,
                                                        idhouse: record.data.idhouse
                                                    })
                                                }
                                    }).show();
                                }
                            },
                            eliminar
                        ]
                    }).showAt(e.getXY());
                }
            }
});
