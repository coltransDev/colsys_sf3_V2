Ext.define('Colsys.Riesgos.GridUsuarios', {    
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Riesgos.GridUsuarios',    
    //autoHeight: true,
    //autoScroll: true,
    frame: true,
    //controller: 'cell-editing',
    selModel: {
        selType: 'cellmodel'
    },    
    listeners:{        
        beforerender: function(ct, position){
            this.reconfigure(
                store = Ext.create('Ext.data.Store', {
                    fields: [
                        {name: 'ca_idempresa',  type: 'string'},                        
                        {name: 'ca_idsucursal', type: 'string'},
                        {name: 'ca_login',      type: 'string'},
                        {name: 'ca_empresa',    type: 'string'},
                        {name: 'ca_sucursal',   type: 'string'},
                        {name: 'ca_nombre',     type: 'string'},                        
                        {name: 'ca_perfil',     type: 'string'},                        
                    ],
                    proxy: {
                        type: 'ajax',
                        url: '/riesgos/datosGridUsuarios',
                        extraParams:{
                            idproceso: this.idproceso
                        },
                        reader: {
                            type: 'json',
                            rootProperty: 'root',
                            totalProperty: 'total'
                        }
                    },        
                    sorters: [
                        {property: 'ca_empresa', direction: 'ASC'},
                        {property: 'ca_sucursal', direction: 'ASC'},
                        {property: 'ca_nombre', direction: 'ASC'}
                    ],
                    autoLoad: true
                }),
                [
                    {dataIndex: 'ca_login', hidden: true},        
                    {header: "Empresa", dataIndex: 'ca_empresa', flex:1 },
                    {header: "Sucursal", dataIndex: 'ca_sucursal', flex:1 },
                    {header: "Nombre", dataIndex: 'ca_nombre', flex:1 },                    
                    {header: "Perfil", dataIndex: 'ca_perfil', flex:1 },                    
                    {xtype: 'actioncolumn',
                        width: 30,
                        sortable: false,
                        menuDisabled: true,
                        items: [{
                            iconCls: 'delete',
                            tooltip: 'Eliminar Causa',
                            handler: 'onRemoveClick'
                        }]
                    }
                ]
            );
        }
    }
});