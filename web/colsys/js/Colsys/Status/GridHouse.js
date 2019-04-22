/*Queda funcionando*/

Ext.define('Colsys.Status.GridHouse', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Status.GridHouse',
    plugins: [{
            ptype: 'cellediting',
            clicksToEdit: 1
        },
        {
            ptype: 'rowwidget',
            widget: {
                xtype: 'grid',
                id: 'grid-into-grid',
                //autoLoad: true,
                bind: {
                    store: '{record.Equipos}',
                    title: 'Orders for {record.idhouse}'
                }
                ,
                //html: 'panel {record.idequipo}'
                plugins:
                        {
                            ptype: 'cellediting',
                            clicksToEdit: 1
                        },
                columns: [{
                        text: 'Sel',
                        xtype: 'checkcolumn',
                        dataIndex: 'sel',
                        width: 75
                    },
                    {
                        //xtype:'hidden',
                        text: 'Idmaster',
                        dataIndex: 'idmaster',
                        width: 75
                    },
                    {
                        //xtype:'hidden',
                        text: 'House',
                        dataIndex: 'idhouse',
                        width: 75
                    },
                    {
                        xtype: 'hidden',
                        text: 'Equipo',
                        dataIndex: 'equipo',
                        width: 75
                    }, {
                        text: 'Concepto',
                        dataIndex: 'concepto',
                        width: 120
                    }, {
                        text: 'Serial',
                        dataIndex: 'serial',
                        width: 75
                    }, {
                        dataIndex: 'numprecinto',
                        width: 120,
                        text: 'Precinto'
                    },
                    {
                        text: 'Piezas',
                        dataIndex: 'piezas',
                        width: 80,
                        align: 'right', editor: {xtype: "textfield"}
                    },
                    {
                        text: 'Kilos',
                        dataIndex: 'kilos',
                        width: 80,
                        align: 'right', editor: {xtype: "textfield"}
                    }]
            }
        }],
    listeners: {
        render: function (ct, position) {

            Ext.define('modelGridHouse', {
                extend: 'Ext.data.Model',
                id: 'model-grid-house',
                fields: [
                    {name: 'idmaster' + this.idmaster, type: 'integer', mapping: 'idmaster'},
                    {name: 'idhouse' + this.idmaster, type: 'integer', mapping: 'idhouse'},
                    {name: 'doctransporte' + this.idmaster, type: 'string', mapping: 'doctransporte'},
                    {name: 'fchdoctransporte' + this.idmaster, type: 'date', mapping: 'fchdoctransporte', dateFormat: 'Y-m-d'},
                    {name: 'idcliente' + this.idmaster, type: 'integer', mapping: 'idcliente'},
                    {name: 'nombrecliente' + this.idmaster, type: 'string', mapping: 'cliente'},
                    {name: 'global' + this.idmaster, type: 'string', mapping: 'cliglobal'},
                    {name: 'consolidar' + this.idmaster, type: 'string', mapping: 'cliccom'},
                    {name: 'bodega' + this.idmaster, type: 'string', mapping: 'idbodega'},
                    {name: 'nombrebodega' + this.idmaster, type: 'string', mapping: 'nombre'},
                    {name: 'tercero' + this.idmaster, type: 'string', mapping: 'tercero'},
                    {name: 'vendedor' + this.idmaster, type: 'string', mapping: 'vendedor'},
                    {name: 'image' + this.idmaster, type: 'string', mapping: 'imagenvendedor'},
                    {name: 'idtercero' + this.idmaster, type: 'integer', mapping: 'idtercero'},
                    {name: 'idreporte' + this.idmaster, type: 'integer', mapping: 'idreporte'},
                    {name: 'reporte' + this.idmaster, type: 'string', mapping: 'reporte'},
                    {name: 'numpiezas' + this.idmaster, type: 'integer', mapping: 'numpiezas'},
                    {name: 'peso' + this.idmaster, type: 'float', mapping: 'peso'},
                    {name: 'volumen' + this.idmaster, type: 'float', mapping: 'volumen'},
                    {name: 'numorden' + this.idmaster, type: 'string', mapping: 'numorden'},
                    {name: 'color' + this.idmaster, type: 'string', mapping: 'color'}
                ]
            });

            Ext.define('modelGridEquipos', {
                extend: 'Ext.data.Model',
                id: 'model-grid-equipos',
                fields: [
                    {name: 'idmaster', reference: 'modelGridHouse'},
                    //{name: 'idhouse'},
                    {name: 'idequipo'},
                    {name: 'equipo'},
                    {name: 'concepto', type: 'string'},
                    {name: 'serial', type: 'string'},
                    {name: 'numprecinto', type: 'string'}
                ]
            });

            this.reconfigure(
                    Ext.create('Ext.data.Store', {
                        id: "storeGridHouse" + this.idmaster,
                        model: modelGridHouse,
                        proxy: {
                            type: 'ajax',
                            url: '/inoF2/datosGridHouse',
                            extraParams: {
                                idmaster: this.idmaster
                            },
                            reader: {
                                type: 'json',
                                rootProperty: 'root',
                                totalProperty: 'total',
                                modo: 'modo'
                            }
                        },
                        sorters: [{
                                property: 'doctransporte',
                                direction: 'ASC'
                            }],
                        autoLoad: true
                    }),
                    [
                        {xtype: 'hidden', dataIndex: 'idmaster' + this.idmaster, sortable: true, flex: 3, editor: {xtype: 'textfield', maxLength: 30}},
                        {text: "Compania", dataIndex: 'doctransporte' + this.idmaster, sortable: true, flex: 3, editor: {xtype: 'textfield', maxLength: 30}},
                        {text: "Hbl", dataIndex: 'doctransporte' + this.idmaster, sortable: true, flex: 3, editor: {xtype: 'textfield', maxLength: 30}},
                        {text: "Vendedor", dataIndex: 'vendedor' + this.idmaster, sortable: true, flex: 3, editor: {xtype: 'textfield', maxLength: 30}}
                    ]
                    );


            this.superclass.onRender.call(this, ct, position);
        }        
    }
});