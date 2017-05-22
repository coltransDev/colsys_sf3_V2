Ext.define('Colsys.Users.GridUsuarios',{
    extend: 'Ext.grid.Panel',
    alias:'widget.Colsys.Users.GridUsuarios',
    bufferedRenderer: true,        
    height:500,
    selModel: {
        pruneRemoved: false
    },
    store: Ext.create('Ext.data.Store', {            
        fields: [
            { name: 'ca_login',         type: 'string',     mapping: 'u_ca_login' },
            { name: 'ca_docidentidad',  type: 'integer',    mapping: 'u_ca_docidentidad' },
            { name: 'ca_nombre',        type: 'string',     mapping: 'u_ca_nombre' },
            { name: 'ca_departamento',  type: 'string',     mapping: 'u_ca_departamento' },
            { name: 'ca_cargo',         type: 'string',     mapping: 'u_ca_cargo' },
            { name: 'ca_sucursal',      type: 'string',     mapping: 's_ca_nombre' },
            { name: 'ca_empresa',       type: 'string',     mapping: 'e_ca_nombre' },
            { name: 'ca_jefe',          type: 'string',     mapping: 'm_ca_nombre' },
            { name: 'ca_email',         type: 'string',     mapping: 'u_ca_email' },
            { name: 'ca_extension',     type: 'string',     mapping: 'u_ca_extension' },
            { name: 'ca_activo',        type: 'boolean',    mapping: 'u_ca_activo' },
            { name: 'ca_cumpleanos',    type: 'date',       mapping: 'u_ca_cumpleanos', dateFormat: 'Y-m-d' },
            { name: 'ca_fchingreso',    type: 'date',       mapping: 'u_ca_fchingreso', dateFormat: 'Y-m-d' },
            { name: 'ca_nombres',       type: 'string',     mapping: 'u_ca_nombres' },
            { name: 'ca_apellidos',     type: 'string',     mapping: 'u_ca_apellidos' },
            { name: 'ca_telparticular', type: 'string',     mapping: 'u_ca_telparticular' },
            { name: 'ca_telfamiliar',   type: 'string',     mapping: 'u_ca_telfamiliar' },
            { name: 'ca_movil',         type: 'string',     mapping: 'u_ca_movil' },
            { name: 'ca_direccion',     type: 'string',     mapping: 'u_ca_direccion' },
            { name: 'ca_tiposangre',    type: 'string',     mapping: 'u_ca_tiposangre' },
            { name: 'ca_nombrefamiliar',type: 'string',     mapping: 'u_ca_nombrefamiliar' },
            { name: 'ca_parentesco',    type: 'string',     mapping: 'u_ca_parentesco' },
            { name: 'ca_nivestudios',   type: 'string',     mapping: 'u_ca_nivestudios' },
            { name: 'ca_estrato',       type: 'string',     mapping: 'u_ca_estrato' },
            { name: 'ca_donante',       type: 'boolean',    mapping: 'u_ca_donante' },
            { name: 'ca_enfermedad',    type: 'string',     mapping: 'u_ca_enfermedad' },
            { name: 'ca_alergico',      type: 'boolean',    mapping: 'u_ca_alergico' },
            { name: 'ca_sexo',          type: 'string',     mapping: 'u_ca_sexo' },
            { name: 'ca_fcesantias',    type: 'string',     mapping: 'u_fcesantias'},
            { name: 'ca_ecivil',        type: 'string',     mapping: 'u_ecivil' }
        ],
        autoLoad: false,
        autoDestroy: true,
        remoteSort: false,
        //groupField: 'ca_sucursal',
        proxy: {
            type: 'ajax',
            url: '/adminUsers/datosUsuarios',
            reader: {
                type: 'json',
                rootProperty: 'root'
            }
        }
    }),
    columns: [
        {xtype: 'rownumberer',      width: 40,                      sortable: false,locked: true},
        {text: "Doc. Identidad",    dataIndex: 'ca_docidentidad',   sortable: true, width:100, locked: true},            
        {text: "Nombre",            dataIndex: 'ca_nombre',         sortable: true, width:220,
            renderer: function(value, metaData, record, rowIndex, colIndex, store) {
                var login = record.data.ca_login;                    
                var store = this.up("grid").getStore();
                var url = store.getProxy().url;                
                var app = (url.indexOf("intranet")< 0)?"":"/intranet";
                return '<a href="'+ app +'/adminUsers/formUsuario/login/'+login+'" target="_blank">'+value+'</a>';
            }
        },
        {text: "Login",             dataIndex: 'ca_login',          sortable: true, width:100},
        {text: "Departamento",      dataIndex: 'ca_departamento',   sortable: true, width:180, 
            filter: {
                type: 'string',
                itemDefaults: {
                    emptyText: 'Buscar por...'
                }
            }
        },
        {text: "Cargo",             dataIndex: 'ca_cargo',          sortable: true, width:300,
            filter: {
                type: 'string',
                itemDefaults: {
                    emptyText: 'Buscar por...'
                }
            }
        },
        {text: "Sucursal",          dataIndex: 'ca_sucursal',       sortable: true, width:120,
            filter: {
                type: 'string',
                itemDefaults: {
                    emptyText: 'Buscar por...'
                }
            }        
        },
        {text: "Empresa",           dataIndex: 'ca_empresa',        sortable: true, width:200,
            filter: {
                type: 'string',
                itemDefaults: {
                    emptyText: 'Buscar por...'
                }
            }
        },
        {text: "Email",             dataIndex: 'ca_email',          sortable: true, width:220, hidden: true},
        {text: "Ext.",              dataIndex: 'ca_extension',      sortable: true, width:50,  hidden: true},
        {text: "Fch. Nacimiento",   dataIndex: 'ca_cumpleanos',     sortable: true, width:100, hidden: true, renderer: Ext.util.Format.dateRenderer('Y-m-d')},
        {text: "Fch. Ingreso",      dataIndex: 'ca_fchingreso',     sortable: true, width:100, hidden: true, renderer: Ext.util.Format.dateRenderer('Y-m-d')},
        {text: "Jefe",              dataIndex: 'ca_jefe',           sortable: true, width:200, hidden: true},
        {text: "Nombres",           dataIndex: 'ca_nombres',        sortable: true, width:200, hidden: true},
        {text: "Apellidos",         dataIndex: 'ca_apellidos',      sortable: true, width:200, hidden: true},
        {text: "Tel. Particular",   dataIndex: 'ca_telparticular',  sortable: true, width:130, hidden: true},
        {text: "Tel. Familiar",     dataIndex: 'ca_telfamiliar',    sortable: true, width:130, hidden: true},
        {text: "Tel. M\u00F3vil",   dataIndex: 'ca_movil',          sortable: true, width:130, hidden: true},
        {text: "Direcci\u00F3n",    dataIndex: 'ca_direccion',      sortable: true, width:250, hidden: true},
        {text: "Tipo Sangre",       dataIndex: 'ca_tiposangre',     sortable: true, width:130, hidden: true},
        {text: "Nombre Familiar",   dataIndex: 'ca_nombrefamiliar', sortable: true, width:240, hidden: true},
        {text: "Nivel Estudios",    dataIndex: 'ca_nivestudios',    sortable: true, width:100, hidden: true},
        {text: "Estrato",           dataIndex: 'ca_estrato',        sortable: true, width:50,  hidden: true},
        {text: "Donante",           dataIndex: 'ca_donante',        sortable: true, width:50,  hidden: true, trueText: 'Si', falseText: 'No', xtype:"booleancolumn"},
        {text: "Al\u00E9rgico",     dataIndex: 'ca_alergico',       sortable: true, width:50,  hidden: true, trueText: 'Si', falseText: 'No', xtype:"booleancolumn"},
        {text: "Sexo",              dataIndex: 'ca_sexo',           sortable: true, width:50,  hidden: true},
        {text: "Fondo Cesant\u00EDas",dataIndex: 'ca_fcesantias',   sortable: true, width:240, hidden: true},
        {text: "Estado Civil",      dataIndex: 'ca_ecivil',         sortable: true, width:240, hidden: true}
    ],
    plugins: 'gridfilters',
    viewConfig: {
        stripeRows: true
    },
    features: [{ ftype: 'grouping' }],
    /*features: [{
        ftype : 'groupingsummary',
        groupHeaderTpl : '{name}',
        hideGroupedHeader : false,
        enableGroupingMenu : false
    }, {
        ftype: 'summary',
        dock: 'bottom'
    }],*/
    listeners:{
        edit : function(editor, e, eOpts)
        {
            //alert(e.field);
            /*var store = this.store;
            if(e.field=="empresa")
            {
                store.data.items[e.rowIdx].set('ca_idempresa', e.value);                    
                store.data.items[e.rowIdx].set('empresa', editor.editors.items[0].field.rawValue);
            }*/
        }
    },
    tbar: [
        {
            text: 'Recargar',
            iconCls: 'refresh',
            id:'btn-guardarrecarga',
            handler : function(){
                this.up("grid").getStore().reload();
            }
        },
        '|'
        ,
        {
            xtype: 'exporterbutton',
            text: 'XLS',
            iconCls: 'csv',
            format:'excel'
        },            
        '|'
        ,
        {
            xtype: "textfield",
            fieldLabel: 'Buscar',
            listeners:{
                change:function( obj, newValue, oldValue, eOpts ){
                    var store=this.up("grid").getStore();
                    store.clearFilter();
                    if(newValue!=""){
                        store.filterBy(function(record, id){
                            var str=record.get("ca_login");
                            var str1=(!record.get("ca_docidentidad"))?"1":record.get("ca_docidentidad");
                            var str2=record.get("ca_nombres");
                            var str3=record.get("ca_apellidos");
                            
                            var txt=new RegExp(newValue,"ig");
                            if(str.search(txt) == -1 && str1.toString().search(txt) == -1 && str2.search(txt) == -1 && str3.search(txt) == -1)
                                return false;
                            else
                                return true;
                        });
                    }
                }
            }
        },
        {
            text: 'Inactivos',
            //scope: this,
            iconCls: 'refresh',  // reference to our css            
            handler: function(btn , e){
                var store = this.up("grid").getStore();
                
                if( btn.getText()==='Inactivos'){
                    btn.setText( "Activos" );
                    store.getProxy().setExtraParam("mostrarInactivos", true );
                    //store.setBaseParam("idgroup", this.idgroup );
                }else{
                    btn.setText( "Inactivos" );                    
                    store.getProxy().setExtraParam("mostrarInactivos", false );
                    //store.setBaseParam("idgroup", this.idgroup );
                }
                store.load();
            }
        },
        {
            text: 'Borrar Filtros',
            tooltip: 'Clear all filters',
            handler: function(){
                this.up("grid").getStore().clearFilter();
            }
        }
    ],      
    initComponent: function() {
        var me = this;        
        me.callParent(arguments);
        me.getStore().on('beforeload', this.beforeTemplateLoad, this);
    },
    beforeTemplateLoad: function(store) {
        if(this.app=='intranet'){
            var url = store.proxy.url;
            if(url.indexOf("intranet")< 0)
                store.proxy.url="/intranet"+store.proxy.url;
        }
    }
});