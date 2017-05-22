Ext.define('Colsys.Widgets.WgBodega', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgBodega',
    triggerTip: 'Click para limpiar',
    store: {
        fields: [
            {name: 'idbodega'},
            {name: 'tipo'},
            {name: 'nombre'},
            {name: 'transporte'},
            {name: 'nombre'},
            {name: 'identificacion'},
            {name: 'direccion'}
        ],
        proxy: {
            type: 'ajax',
            url: '/widgets5/listaBodegasJSON',
            reader: {
                type: 'json',
                rootProperty: 'root'
            }
        },
        autoLoad: false
    },
    qtip: 'Listado ',
    queryMode: 'remote',
    valueField: 'idbodega',
    displayField: 'nombre',
    minChars: 3,
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function () {
            return '<tpl for="."><div class="search-item"><b>{nombre}/ {tipo} - Nit:{identificacion}</b><br /><span> <br />{direccion}</span> </div></tpl>';
        }
    }


});


