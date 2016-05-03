Ext.define('Colsys.Widgets.wgHouse', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.wgHouse',
    triggerTip: 'Click para limpiar',
    spObj:'',
    spForm:'',  
    spExtraParam:'',
    store: Ext.create('Ext.data.Store', {
        fields: ['id','name','idcliente','cliente','ciudad','idsucursal','class'],
        proxy: {
            type: 'ajax',
            url: '/widgets5/datosHouse',
            reader: {
                type: 'json',
                root: 'root'
            }
        },
        autoLoad: false
    }),
    qtip:'Listado House de la referencia',
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No matching posts found.',
        getInnerTpl: function() {
            return '<tpl for="."><div class="{class}"><strong>{name}</strong><br /></div></tpl>';
        }
    },
    onRender: function(ct, position){  
        this.store.load({
            params : {
                idmaster : this.idmaster
            }
        });

        Colsys.Widgets.wgHouse.superclass.onRender.call(this, ct, position);            
    }
});
