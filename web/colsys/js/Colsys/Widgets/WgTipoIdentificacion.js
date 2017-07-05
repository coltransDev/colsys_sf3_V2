Ext.define('Colsys.Widgets.WgTipoIdentificacion', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgTipoIdentificacion',
    spObj: '',
    spForm: '',
    spExtraParam: '',
    queryMode: 'local',
    valueField: 'id',
    displayField: 'name',
    qtip: 'Listado ',
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function () {
            return '<tpl for="."><div class="search-item"><b>{name}</b> <br> {trafico} </div></tpl>';
        }
    }
});