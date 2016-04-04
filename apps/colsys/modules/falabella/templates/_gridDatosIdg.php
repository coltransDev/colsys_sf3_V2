Ext.define('Listado', {
    extend: 'Ext.data.Model',
    idProperty: 'id',
    fields: [ 
        {name: 'month', type: 'int'},
        {name: 'mes', type: 'string'},
        {name: 'origen', type: 'string'},
        {name: 'destino', type: 'string'},                
        {name: 'modalidad', type: 'string'},
        {name: 'rn', type: 'string'},
        {name: 'peso', type: 'float'},
        {name: 'piezas', type: 'float'},
        {name: 'volumen', type: 'float'},
        {name: 'fchsalida', type: 'date', dateFormat:'Y-m-d'},
        {name: 'fchllegada', type: 'date', dateFormat:'Y-m-d'},
        {name: 'fchdocorig', type: 'date', dateFormat:'Y-m-d'},
        {name: 'fchingresoasn', type: 'date', dateFormat:'Y-m-d'},
        {name: 'beginw', type: 'date', dateFormat:'Y-m-d'},
        {name: 'endw', type: 'date', dateFormat:'Y-m-d'}
    ]
});

var store = Ext.create('Ext.data.Store', {
    model: 'Listado',
    data: [],
    sorters: {property: 'month', direction: 'ASC'},
    groupers: ['month']
});

var grid = Ext.create('Ext.grid.Panel', {
    iconCls: 'falabella',
    store: store,            
    frame: true,                        
    renderTo: 'grid-datos',      
    features: [Ext.create('Ext.ux.grid.feature.MultiGroupingSummary', {
        id: 'group',
        groupsHeaderTpl: {
            sucursal: 'Sucursal: {name}',
            comercial: '{name}'
        },
        hideGroupedHeader: true,
        enableGroupingMenu: true//,   
        //startCollapsed: true
    }), {
        ftype: 'summary',
        dock: 'bottom'
    }],
    columns: [
        {
            header: 'Mes',                    
            sortable: true,
            dataIndex: 'month',
            renderer: function(value){
                var monthNames = ["Ene", "Feb", "Mar", "Abr", "May", "Jun","Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
                var d = value-1;
                return monthNames[d];
            }
        },
        {
            text: 'Origen',
            sortable: true,
            dataIndex: 'origen',
            hideable: true
        },
        {
            text: 'Destino',                    
            sortable: true,
            dataIndex: 'destino',
            hideable: true
        },                
        {
            text: 'Mod.',                    
            sortable: true,
            dataIndex: 'modalidad',
            hideable: true
        },
        {
            text: 'RN',                    
            sortable: true,
            dataIndex: 'rn',
            hideable: true
        },
        {
            text: 'Fch. Salida',                    
            sortable: true,
            dataIndex: 'fchsalida',
            hideable: true,
            format: 'Y-m-d',
            renderer: function(value){
                return Ext.util.Format.date(value, 'Y-m-d');
            }
        },
        {
            text: 'Fch. Llegada',                    
            sortable: true,
            dataIndex: 'fchllegada',
            hideable: true,
            format: 'Y-m-d',
            renderer: function(value){
                return Ext.util.Format.date(value, 'Y-m-d');
            }

        },
        {
            text: 'Fch. IngAsn',                    
            sortable: true,
            dataIndex: 'fchingresoasn',
            hideable: true,
            format: 'Y-m-d',
            renderer: function(value){
                return Ext.util.Format.date(value, 'Y-m-d');
            }
        },
        {
            text: 'Fch. EnvDoc.',                    
            sortable: true,
            dataIndex: 'fchdocorig',
            hideable: true,
            format: 'Y-m-d',
            renderer: function(value){
                return Ext.util.Format.date(value, 'Y-m-d');
            }
        },
        {
            text: 'Fch. IniVen',                    
            sortable: true,
            dataIndex: 'beginw',
            hideable: true,
            format: 'Y-m-d',
            renderer: function(value){
                return Ext.util.Format.date(value, 'Y-m-d');
            }
        },
        {
            text: 'Fch. FinVen.',                    
            sortable: true,
            dataIndex: 'endw',
            hideable: true,
            format: 'Y-m-d',
            renderer: function(value){
                return Ext.util.Format.date(value, 'Y-m-d');
            }
        },
        {
            text: 'Fch. FinVen.',                    
            sortable: true,
            dataIndex: 'endw',
            hideable: false,
            format: 'Y-m-d',
            renderer: function(value){
                return Ext.util.Format.date(value, 'Y-m-d');
            }
        },
        {
            text: 'Peso',                    
            sortable: true,
            dataIndex: 'peso',
            hideable: true,
            hidden: true
        },
        {
            text: 'Piezas',                    
            sortable: true,
            dataIndex: 'piezas',
            hideable: true,
            hidden: true
        },
        {
            text: 'Volumen',                    
            sortable: true,
            dataIndex: 'volumen',
            hideable: true,
            hidden: true
        }
    ]
});