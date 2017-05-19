
Ext.define('Colsys.Widgets.wgEmpresas', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.wgEmpresas',
    triggerTip: 'Click para limpiar',
    queryMode: 'local',
    valueField: 'id',
    displayField: 'name',
    store: new Ext.data.Store({
        fields: ['id','name'],
        proxy: {
            type: 'ajax',
            url: '/widgets5/datosEmpresas',
            reader: {
                type: 'json',
                rootProperty: 'root',
                totalProperty: 'total'
            }
        }        
    }),    
    qtip:'Listado de Empresas',
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function() {
            return '<tpl for="."><div class="search-item1">{name}</div></tpl>';
        }
    },
    listeners: {
        focus: function(ct, position){         
            if(this.load==false || this.load=="undefined" || !this.load)
            {
                this.store.reload();
                this.load=true;
            }         
        }
    }    
});