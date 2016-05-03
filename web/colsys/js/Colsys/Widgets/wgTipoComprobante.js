Ext.define('Colsys.Widgets.wgTipoComprobante', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.wgTipoComprobante',
    triggerTip: 'Click para limpiar',
    spObj:'',
    spForm:'',
    spExtraParam:'',
    queryMode:'local',
    store: Ext.create('Ext.data.Store', {
        fields: ['id','name','idempresa'],
        proxy: {
            type: 'ajax',
            url: '/widgets5/datosTipoComprobante',
            reader: {
                type: 'json',
                root: 'root'
            }
        },
        autoLoad: false
    }),
    qtip:'Listado ',
    queryMode: 'local',
    displayField: 'name',
    valueField: 'id',
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function() {
            return '<tpl for="."><div class="search-item">{name}</div></tpl>';
        }
    },
    onRender: function(ct, position){

        if(this.load1==false || this.load1=="undefined" || !this.load1)
        {
             this.store.load();
             this.load1=true;
        }        
        this.superclass.onRender.call(this, ct, position);
    }
});