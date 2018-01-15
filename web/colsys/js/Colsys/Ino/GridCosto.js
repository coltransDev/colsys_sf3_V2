var comboReporte = null;


Ext.define('Colsys.Ino.GridCosto', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Ino.GridCosto',
    id: "gridcosto",
    height: 400,
    sortableColumns: true,
    enableColumnMove: false,
    autoScroll: true,
    bodegas:null,
    viewConfig: {
        getRowClass: function (record, rowIndex, rowParams, store) {

            if ((record.get('valor') - record.get('inoventa')) != 0) {
                return "row_purple";
            }
        }
    },
    features: [{
            ftype: 'summary',
            dock: 'bottom'
        }],
    selModel: {
        selType: 'cellmodel'
    },
    frame: true,
    /*plugins: {
        ptype: 'cellediting',
        clicksToEdit: 1
    },*/
    plugins: [
        {
        ptype: 'cellediting',
        clicksToEdit: 1
    }
        ,{
        ptype: 'rowwidget',
        widget:  {
            xtype: 'grid',
            //autoLoad: true,
            features: [{
                ftype: 'summary',
                dock: 'bottom'
            }],
            bind: {
                store: '{record.sobreventas}',
                //title: 'Orders for {record.id}'
            },
             plugins: 
                    {
                    ptype: 'cellediting',
                    clicksToEdit: 1
                },
            columns: [
                {
                text: 'Sel',
                xtype: 'checkcolumn',
                dataIndex: 'sel',
                width: 1
                },
                {
                    xtype:'hidden',
                    text: 'Sobreventa',
                    dataIndex: 'sobreventa',
                    width: 75
                },
                {
                    //xtype:'hidden',
                    text: 'Doc Transporte',
                    dataIndex: 'doctransporte',
                    width: 150,
                    summaryRenderer: function (value, summaryData, dataIndex) {
                        return "<span style='font-weight: bold;'> TOTALES POR DISTRIBUIR</span>";
                    }
                },
                {
                    xtype:'hidden',
                    text: 'House',
                    dataIndex: 'idhouse',
                    width: 120
                }, 
                {
                    xtype:'hidden',
                    text: 'Id utilidad',
                    dataIndex: 'idutilidad',                
                    width: 75                
                }, 
                {
                    xtype:'hidden',
                    text: 'util',
                    dataIndex: 'util',
                    width: 75
                },
                {
                    xtype:'hidden',
                    dataIndex: 'idinocosto',
                    width: 120,
                    text: 'Id inocosto'
                }, 
                {
                    text: 'Valor',
                    dataIndex: 'valor',
                    width: 100,
                    align: 'right',
                    //summaryType: 'sum',
                    editor: {
                            xtype: 'numberfield'
                        },
                    summaryType: function (records, values) {
                          //console.log(records);
                          //console.log(values);
                          //var store = this.up('grid').store;
                          //records=store.getRange();
                          //console.log(this.up('grid'));
                          //console.log(this.up());
                          
                        var i = 0,
                        length = records.length,
                        util=total = 0,
                        record;
                        //console.log(parseFloat(records[0].get('util')));
                        for (; i < length; ++i) {
                            record = records[i];
                            if(util==0)
                            {
                                if(!isNaN(parseFloat(record.get('util'))))
                                {
                                    util=parseFloat(record.get('util'));
                                    //console.log(util);
                                }
                            }
                            
                            if(!isNaN(parseFloat(record.get('valor'))))
                            {
                              //  console.log(record.data);
                                total += parseFloat(record.get('valor'));
                            }
                        }
                        
                        return util-total;
                    },
                    summaryRenderer: function (value, summaryData, dataIndex) {
                        /*console.log(this);
                        console.log(this.up());
                        console.log(this.up('grid'));*/
                        /*console.log(value)
                        console.log(summaryData)
                        console.log(dataIndex)*/
                        var store = this.up('grid').store
                        records=store.getRange();
                        //console.log(records)
                        
                        var i = 0,
                        length = records.length,
                        util=total = 0,
                        record;
                        //console.log(parseFloat(records[0].get('util')));
                        for (; i < length; ++i) {
                            record = records[i];
                            if(util==0)
                            {
                                if(!isNaN(parseFloat(record.get('util'))))
                                {
                                    util=parseFloat(record.get('util'));
                                    //console.log(util);
                                }
                            }
                            
                            if(!isNaN(parseFloat(record.get('valor'))))
                            {
                              //  console.log(record.data);
                                total += parseFloat(record.get('valor'));
                            }
                        }
                        v=util-total;
                        return "<span style='font-weight: bold;'> " + v + "</span>";
                    }
                }
            ]
        },
        getHeaderConfig: function () {
            var defaultIconColumnCfg = this.superclass.getHeaderConfig.apply(this, arguments);

            defaultIconColumnCfg.renderer = function (value, gridcell, record) {
                //console.log(this.up('grid').idmaster);
                //if ((record.get('valor' + this.up('grid').idmaster) - record.get('inoventa' + this.up('grid').idmaster)) != 0) {
                //console.log((record.get('valor') - record.get('inoventa')));
                    if (  (record.get('valor_pesos') != record.get('venta')) != 0   ) {
                            return '<div class="' + Ext.baseCSSPrefix + 'grid-row-expander" role="presentation" tabIndex="0"></div>';
                    }
            }
            return defaultIconColumnCfg;
        }
    }],
    onRender: function (ct, position)
    {
        me = this;
        
        columnas=new Array();
        
        columnas.push(
        {
            header: "idmaster",
            dataIndex: 'idmaster' + this.idmaster,
            hidden: true
        },
        {
            header: "idinocosto",
            dataIndex: 'idinocosto' + this.idmaster,
            hidden: true
        },
        {
            header: "idcomprobantec",
            dataIndex: 'idcomprobantec' + this.idmaster,
            hidden: true
        },
        {
            header: "Costo",
            dataIndex: 'nombrecosto' + this.idmaster, 
            sortable: true,
            width: 170,
            //tpl: '<span class="x-form-item-label-default">{name}</span>',
            /*editor: Ext.create('Colsys.Widgets.wgConceptos', {
                /*Ext.create('Colsys.Widgets.wgConceptosMaestra',{
                ///costo: 'true',
                idtransporte: this.idtransporte,
                idimpoexpo: this.idimpoexpo,
                id: 'costo' + this.idmaster
            }),
            renderer: comboBoxRenderer(Ext.getCmp('costo' + this.idmaster)),*/
            summaryRenderer: function (value, summaryData, dataIndex) {
                return "<span style='font-weight: bold;'> TOTALES</span>";
            }
        },
        {
            header: "Factura",
            dataIndex: 'factura' + this.idmaster,
            hideable: false,
            sortable: true,
            width: 90,
            /*editor: {
                xtype: 'textfield',
                maxLength: 30
            }*/
        },
        {
            header: "Fecha<br>Factura",
            dataIndex: 'fchfactura' + this.idmaster,
            hideable: false,
            sortable: true,
            width: 90,
            renderer: function (a, b, c, d) {
                if (a) {
                    var formattedDate = new Date(a);
                    var formattedDate = new Date(formattedDate.valueOf() + formattedDate.getTimezoneOffset() * 60000);
                    var d = formattedDate.getDate();
                    if (d < 10) {
                        d = "0" + d
                    }
                    var m = formattedDate.getMonth();
                    m += 1; // JavaScript months are 0-11
                    if (m < 10) {
                        m = "0" + m;
                    }
                    var y = formattedDate.getFullYear();
                    return y + "-" + m + "-" + d;
                }
            }/*,
            editor: new Ext.form.DateField({
                width: 90,
                format: 'Y-m-d',
                useStrict: undefined
            })*/
        },
        {
            header: "Moneda",
            dataIndex: 'idmoneda' + this.idmaster,
            hideable: false,
            sortable: true,
            width: 70,
            align: 'left',
            /*editor: {
                xtype: 'Colsys.Widgets.wgMoneda'
            }*/
        },
        {
            header: "Neta",
            dataIndex: 'neto' + this.idmaster,
            hideable: false,
            sortable: true,
            width: 100,
            align: 'right',
            renderer: Ext.util.Format.numberRenderer('0,0.00'),
            summaryType: 'sum',
            /*editor: {
                xtype: 'numberfield'
            },*/
            summaryRenderer: function (value, summaryData, dataIndex) {
                return "<span style='font-weight: bold;'> " + Ext.util.Format.usMoney(value) + "</span>";
            }
        },
        {
            header: "Cambio<br>USD",
            dataIndex: 'tcambio_usd' + this.idmaster,
            hideable: false,
            sortable: true,
            width: 80,
            align: 'right',
            readOnly: true,
            renderer: Ext.util.Format.numberRenderer('0.0000'),
            /*editor: {
                xtype: 'numberfield',
                decimalPrecision: 4
            },*/
            hidden: true
        },
        {
            header: "Neta<br>USD",
            dataIndex: 'neto_usd' + this.idmaster,
            hideable: false,
            sortable: true,
            width: 70,
            align: 'right',
            renderer: Ext.util.Format.numberRenderer('0,0.00'),
            summaryType: 'sum',
            summaryRenderer: function (value, summaryData, dataIndex) {
                return "<span style='font-weight: bold;'> " + Ext.util.Format.usMoney(value) + "</span>";
            },
            /*editor: {
                xtype: 'numberfield',
                readOnly: true
            },*/
            hidden: true
        },
        {
            header: "Cambio<br>",
            dataIndex: 'tcambio' + this.idmaster,
            hideable: false,
            sortable: true,
            width: 100,
            align: 'right',
            renderer: Ext.util.Format.numberRenderer('0,0.00'),
            /*editor: {
                xtype: 'numberfield'
            },*/
        },
        {
            header: "Neto COP",
            dataIndex: 'valor_pesos' + this.idmaster,
            hideable: false,
            sortable: false,
            width: 100,
            align: 'right',
            summaryType: 'sum',
            renderer: Ext.util.Format.numberRenderer('0,0.00'),
            summaryRenderer: function (value, summaryData, dataIndex) {
                return "<span style='font-weight: bold;'> " + Ext.util.Format.usMoney(value) + "</span>";
            },
            /*editor: {
                xtype: 'numberfield',
                readOnly: true
            }*/
        },
        {
            header: "Venta COP",
            dataIndex: 'venta' + this.idmaster,
            hideable: false,
            sortable: false,
            width: 100,
            align: 'right',
            renderer: Ext.util.Format.numberRenderer('0,0.00'),
            summaryType: 'sum',
            summaryRenderer: function (value, summaryData, dataIndex) {
                return "<span style='font-weight: bold;'> " + Ext.util.Format.usMoney(value) + "</span>";
            },
            editor: {
                xtype: 'numberfield'
            }
        },
        {
            header: "Ino en<br>Venta",
            dataIndex: 'inoventa' + this.idmaster,
            hideable: false,
            sortable: false,
            width: 100,
            align: 'right',
            renderer: Ext.util.Format.numberRenderer('0,0.00'),
            summaryType: 'sum',
            summaryRenderer: function (value, summaryData, dataIndex) {
                return "<span style='font-weight: bold;'> " + Ext.util.Format.usMoney(value) + "</span>";
            }
        },
        {
            header: "Proveedor",
            dataIndex: 'nombreproveedor' + this.idmaster,
            sortable: true,
            width: 320,
            //tpl: '<span class="x-form-item-label-default">{nombre}</span>',
            /*editor:
                    Ext.create('Colsys.Widgets.WgIdsCostos', {
                        idmaster: this.idmaster,
                        idtransporte: this.idtransporte,
                        id: 'proveedor' + this.idmaster,
                        displayField: 'nombre',
                        valueField: 'id',
                        store: Ext.create('Ext.data.Store', {
                            fields: [
                                {name: 'idalterno'},
                                {name: 'nombre'},
                                {name: 'id'}
                            ],
                            proxy: {
                                type: 'ajax',
                                url: '/widgets5/datosIdsCostos',
                                reader: {
                                    type: 'json',
                                    rootProperty: 'root'
                                },
                                extraParams: {
                                    //tipo: this.tipo
                                }
                            }
                        }),
                        listeners: {
                            beforerender: function (ct, position) {
                                this.getStore().load({
                                    params: {
                                        tipo: ''

                                    }
                                });
                            }
                        }
                    }),*/
            renderer: comboBoxRenderer(Ext.getCmp('proveedor' + this.idmaster))
        }
        );
            
        this.reconfigure(
            Ext.create('Ext.data.Store', {                
                fields:
                [
                    {name: 'idmaster' + this.idmaster, type: 'integer', mapping: 'idmaster'},
                    {name: 'idinocosto' + this.idmaster, type: 'integer', mapping: 'idinocosto'},
                    {name: 'idcomprobantec' + this.idmaster, type: 'integer', mapping: 'idcomprobantec'},
                    {name: 'idcosto' + this.idmaster, type: 'string', mapping: 'idcosto'},
                    {name: 'nombrecosto' + this.idmaster, type: 'string', mapping: 'nombrecosto'},
                    {name: 'idproveedor' + this.idmaster, type: 'integer', mapping: 'idproveedor'},
                    {name: 'nombreproveedor' + this.idmaster, type: 'string', mapping: 'proveedor'},
                    {name: 'factura' + this.idmaster, type: 'string', mapping: 'factura'},
                    {name: 'fchfactura' + this.idmaster, type: 'string', mapping: 'fchfactura'},
                    {name: 'idmoneda' + this.idmaster, type: 'string', mapping: 'idmoneda'},
                    {name: 'neto' + this.idmaster, type: 'string', mapping: 'neto'},
                    {name: 'venta' + this.idmaster, type: 'float', mapping: 'venta'},
                    {name: 'tcambio' + this.idmaster, type: 'string', mapping: 'tcambio'},
                    {name: 'valor_pesos' + this.idmaster, type: 'float', mapping: 'valor_pesos'},
                    {name: 'utilidad' + this.idmaster, type: 'float', mapping: 'utilidad'},
                    {name: 'inoventa' + this.idmaster, type: 'float', mapping: 'inoventa'},
                    {name: 'ventacop' + this.idmaster, type: 'string', mapping: 'ventacop'},
                    {name: 'color' + this.idmaster, type: 'string', mapping: 'color'},
                    {name: 'orden' + this.idmaster, type: 'string', mapping: 'orden'}
                ],
                proxy: {
                            type: 'ajax',
                            url: '/inoF2/datosGridCostos',
                            reader: {
                                type: 'json',
                                rootProperty: 'root',
                                totalProperty: 'total'
                            }
                        },                        
                        autoLoad: false,
                        sorters: [{
                    property: 'orden',
                    direction: 'ASC'
                }],
            }),
            columnas
        );

tb = new Ext.toolbar.Toolbar();

            if (this.permisos.Crear == true) {


                /*tb.add({
                    text: 'Agregar',
                    iconCls: 'add',
                    handler: function () {


                        var store = this.up('grid').store;
                        var r = Ext.create(store.model);
                        r.set('idmaster' + this.up('grid').idmaster, this.up('grid').idmaster);
                        store.insert(0, r);
                    }
                });*/   
            }
                
            if (this.permisos.Editar == true)
            {
                tb.add(
                {
                    text: 'Guardar',
                    iconCls: 'add',
                    width: 80,
                    handler: function () {
                        idmaster = this.up('grid').idmaster;
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
                            utilidad=put=false;
                            var sobreventas = new Array();
                            var rowSobreventas = new Object();
                            for(s=0;s<rowModel.get("sobreventas").length;s++)
                            {                                
                                if(!isNaN(rowModel.get("sobreventas")[s].valor))
                                {
                                    //console.log(rowModel.get("sobreventas")[s].valor);
                                    if(rowModel.get("sobreventas")[s].valor!= null)
                                    {
                                        sobreventas.push(rowModel.get("sobreventas")[s]);
                                        utilidad=true;
                                    }
                                }
                            }
                            var row = new Object();
                            row["id"]=rowModel.data.id;
                            row["idinocosto"]=rowModel.get("idinocosto");
                            if(rowModel.get("venta") != rowModel.get("venta"+idmaster))
                            {
                                row["venta"]=rowModel.get("venta"+idmaster);
                                put=true;
                                
                            }console.log(sobreventas);
                            if(utilidad )
                            {   
                                //row["sobreventas"]=rowModel.data.sobreventas;
                                row["sobreventas"]=sobreventas;
                                put=true;
                            }
                            if(put)
                                rows.push(row);
                            //console.log(rowModel.data);
                        };
                        
                        model.fields.forEach(filtrerfields);
                        /*console.log(columnsName);
                        console.log(fieldsName);
                        console.log(filtrerfields)*/
        //                store.getModifiedRecords().forEach(filtrerRows);
                        store.getRange().forEach(filtrerRows);
                        //console.log(rows);

                        var rowJson = JSON.stringify(rows);
                        if (rowJson.length > 5)
                        {
                            Ext.Ajax.request({
                                url: '/inoF2/guardarGridCosto',
                                params: {
                                    datos: rowJson
                                },
                                success: function (response, opts)
                                {
                                    var res = Ext.decode(response.responseText);
                                    /*if (res.id && res.success)
                                    {
                                        id = res.id.split(",");
                                        idhou = res.idhouse.split(",");
                                        for (i = 0; i < id.length; i++)
                                        {
                                            var rec = store.getById(id[i]);
                                            //rec.data.idhouse = idhou[i];
                                            rec.set(("idhouse" + idmaster), idhou[i]);
                                            rec.commit();
                                        }
                                        Ext.Msg.alert('Mensaje', "Se guardo Correctamente los datos del House");
                                    }*/
                                    if (res.success)
                                    {
                                        store.reload();
                                    }
                                    else if (res.errorInfo != "" && res.errorInfo != "null")
                                    {
                                        Ext.MessageBox.alert("Mensaje", 'No fue posible el guardar los datos de los Costos <br>' + res.errorInfo);
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
                });
            }

            tb.add({
                text: 'Eventos',
                iconCls: 'user',
                handler: function () {

                
                openFile("/ids/formEventos?idmaster="+this.up('grid').idmaster)
               
                }
            });
            

            tb.add(
            {
                text: 'Recargar',
                iconCls: 'refresh',
                handler: function () {
                    this.up('grid').getStore().reload();
                    //me.getStore().reload();
                }
            });
                    

            this.addDocked(tb);
        
        
        this.superclass.onRender.call(this, ct, position);
    },
    listeners:
    {
        beforerender: function (ct, position) {
            this.setHeight(this.up('tabpanel').up('tabpanel').getHeight() - 150);
            this.setWidth(this.up('tabpanel').up('tabpanel').getWidth() - 50);
        },
                activate: function (ct, position)
                {
                    idmaster = this.idmaster;
                    var store = this.store;
                    if (this.load == false || this.load == "undefined" || !this.load)
                    {
                        store.proxy.extraParams = {
                            idmaster: this.idmaster,
                            idimpoexpo: this.idimpoexpo
                        },
                        this.store.reload({
                            callback: function (records, operation, success) {
                                //console.log(records.length);
                                for (i = 0; i < records.length; i++) {
                                    rec = records[i];
                                    //console.log(rec.data)
                                    //console.log(Ext.ComponentQuery.query("#bodega" + idmaster));
                                    //console.log(Ext.getCmp("costo" + idmaster))
                                    //if( Ext.ComponentManager.get("costo" + idmaster))
                                    /*Ext.getCmp("costo" + idmaster)
                                    {
                                        Ext.getCmp("costo" + idmaster).store.add(
                                                {"id": rec.data.idcosto, "name": rec.data.nombrecosto}
                                        );
                                        rec.set(("nombrecosto" + idmaster), rec.data.nombrecosto);
                                        rec.set(("idcosto" + idmaster), rec.data.idcosto);
                                    }
                                    //if( Ext.ComponentManager.get("proveedor" + idmaster))
                                    Ext.getCmp("proveedor" + idmaster)
                                    {
                                        Ext.getCmp("proveedor" + idmaster).store.add(
                                                {"id": rec.data.idproveedor, "name": rec.data.nombreproveedor}
                                        );
                                        rec.set(("nombreproveedor" + idmaster), rec.data.nombreproveedor);
                                        rec.set(("idproveedor" + idmaster), rec.data.idproveedor);
                                    }*/

                                    //rec.commit();
                                }
                            }
                        });
                        this.load = true;
                    }
                },
                beforeitemcontextmenu: function (view, record, item, index, e)
                {
                }
            }
});


