Ext.define('Colsys.Widgets.WgReferencias', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgReferencias',
    triggerTip: 'Click para limpiar',
    spObj:'',
    queryMode: 'remote',
    triggerAction: 'all',
    spForm:'',  
    spExtraParam:'',
    displayField: 'referencia',
    valueField: 'idmaster',
    minChars:3,
    typeAhead: true,
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function() {
            return '<tpl for="."><div class="search-item"><strong>{referencia}</strong><br/><span>{origen} - {destino}</span></div></tpl>';
        }
    },
    store: {
        fields: [
            { name: 'idmaster',     mapping: 'm_ca_idmaster'},
            { name: 'referencia',   mapping: 'm_ca_referencia'},            
            { name: 'origen',       mapping: 'o_ca_ciudad'},
            { name: 'destino',      mapping: 'd_ca_ciudad'}
        ],    
        proxy: {
            type: 'ajax',
            url: '/widgets5/datosComboListaReferencias',
            reader: {
                type: 'json',
                rootProperty: 'root'
            }
        },
        autoLoad: false
    },
    qtip:'Listado de Referencias',
    onRender: function(ct, position){
       Colsys.Widgets.WgReferencias.superclass.onRender.call(this, ct, position);
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
        store.proxy.extraParams = {            
            impoexpo:this.idimpoexpo,
            transporte:this.idtransporte,
            idmaster:this.idmaster,
            todas: this.todas
        }
    }
});