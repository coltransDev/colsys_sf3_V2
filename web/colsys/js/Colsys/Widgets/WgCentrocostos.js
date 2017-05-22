/*
    * @autor Felipe Nariño
    * @return ComboBox centro costos (tb_comprobantes)
    * @param
    *        query : texto digitado para filtrar 
    * @date:  2016-06-20
*/
Ext.define('Colsys.Widgets.WgCentrocostos', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgCentrocostos',
    triggerTip: 'Click para limpiar',
    spObj: '',
    spForm: '',
    spExtraParam: '',
    queryMode: 'local',
    valueField:'id',
     //queryMode: 'local',
    displayField:'value',
    store: Ext.create('Ext.data.Store', {
        fields: ['id', 'centro', 'subcentro', 'sucursal', 'transporte','value'],
        proxy: {
            type: 'ajax',
            url: '/widgets5/datosCentrocostos',
            reader: {
                type: 'json',
                rootProperty: 'root'
            }
        },
        autoLoad: true
    }),
    qtip: 'Listado ',
    listConfig: {
                loadingText: 'buscando...',
                emptyText: 'No matching posts found.',

                getInnerTpl: function() {
                    return '<tpl for="."><div class="search-item"><b>CC : {centro} SCC : {subcentro}  <br> {sucursal}-{transporte} <br>  </div></tpl>';
                }
            },
    labelWidth: 60


});
