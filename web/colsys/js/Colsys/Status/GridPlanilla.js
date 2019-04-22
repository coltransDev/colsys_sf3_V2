Ext.define('Colsys.Status.GridPlanilla', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Status.GridPlanilla',
    plugins: [
        Ext.create('Ext.grid.plugin.CellEditing', {
            clicksToEdit: 1,
            listeners: {
                beforeedit: function (editor, e) {                    
                    if(e.record.data.dispocarga === "21" || e.record.data.continuacion !== "N/A"){
                        if(e.record.data.continuacion !== ""){
                            Ext.Msg.alert('Alerta', "La carga tiene disposición de carga 'Entrega en Lugar de Arribo' o viene en OTM");
                            return false;
                        }
                    }
                }
            }
        })
    ],
    listeners: {
        render: function (ct, position) {

            Ext.define('modelGridPlanilla', {
                extend: 'Ext.data.Model',
                id: 'model-grid-planilla',
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
                    {name: 'color' + this.idmaster, type: 'string', mapping: 'color'},
                    {name: 'planilla' + this.idmaster, type: 'string', mapping: 'planilla'}
                ]
            });

            this.reconfigure(
                    Ext.create('Ext.data.Store', {
                        id: "storeGridPlanilla" + this.idmaster,
                        model: modelGridPlanilla,
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
                                property: 'nombrecliente',
                                direction: 'ASC'
                            }],
                        autoLoad: false
                    }),
                    [
                        {dataIndex: 'idmaster' + this.idmaster, sortable: true, xtype: 'hidden', flex: 1},
                        {dataIndex: 'reporte' + this.idmaster, text: "Reporte", sortable: true, flex: 1},
                        {dataIndex: 'doctransporte' + this.idmaster, text: "Hbl", sortable: true, flex: 1},
                        {dataIndex: 'idcliente' + this.idmaster, text: "Id. Cliente", sortable: true, flex: 1},
                        {dataIndex: 'nombrecliente' + this.idmaster, text: "Cliente", sortable: true, flex: 1},
                        {dataIndex: 'planilla' + this.idmaster, text: "Planilla #", sortable: true, flex: 1, editor: {xtype: 'textfield', maxLength: 30}}
                    ]
                    );


            this.superclass.onRender.call(this, ct, position);
        }
    },
    viewConfig: {
        stripeRows: true,
        getRowClass: function (record, rowIndex, rowParams, store) {            
            if(record.data.dispocarga === "21" || record.data.continuacion !== "N/A"){                                
                if(record.data.continuacion !== "")
                    return "row_pink";                    
            }
        }
    }
});