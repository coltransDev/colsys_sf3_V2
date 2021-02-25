Ext.define('Colsys.Widgets.WgProcesos', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgProcesos',
    triggerTip: 'Click para limpiar',
    spObj:'',
    queryMode: 'remote',
    triggerAction: 'all',
    spForm:'',  
    spExtraParam:'',
    displayField: 'proceso',
    valueField: 'idproceso',
    minChars:3,
    typeAhead: true,
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function() {
            return '<tpl for="."><div class="search-item"><strong>{ca_prefijo} {proceso}</strong><br/><span style="font-size:9px; color:green;">{empresa} <br></div></tpl>';
        }
    },
    store: {
        fields: [
            { name: 'idempresa',     mapping: 'ca_idempresa'},
            { name: 'idproceso',   mapping: 'ca_idproceso'},            
            { name: 'empresa',       mapping: 'ca_empresa'},
            { name: 'orden',      mapping: 'ca_orden'},
            { name: 'prefijo',      mapping: 'ca_prefijo'},
            { name: 'proceso',      mapping: 'ca_proceso'},
            { name: 'activo',      mapping: 'ca_activo'}
        ],    
        proxy: {
            type: 'ajax',
            url: '/riesgos/datosProcesos',
            reader: {
                type: 'json',
                rootProperty: 'root'
            }
        },
        autoLoad: false
    },
    qtip:'Listado de Procesos',
    onRender: function(ct, position){
       Colsys.Widgets.WgProcesos.superclass.onRender.call(this, ct, position);
       //console.log(this.tipoT);
       
    },
    initComponent: function() {
        var me = this; 
        Ext.applyIf(me, {
            emptyText: 'Seleccione un concepto',
            loadingText: 'Loading...',
            store: {type: 'roletemplateslocal'}
        });
        me.callParent(arguments);
        me.getStore().on('beforeload', this.beforeTemplateLoad, this);
    },
 
    beforeTemplateLoad: function(store) {
        /*store.proxy.extraParams = {            
            impoexpo:this.idimpoexpo,
            transporte:this.idtransporte,
            idmaster:this.idmaster
        }*/
    }
});