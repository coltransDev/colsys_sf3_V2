/**
 * @autor Felipe Nariño 
 * @return Combobox cargado con las ciudades de cada país registrados en el sistema
 * @param  query : texto digitado para filtrar ciudades
 * @date:  2016-03-28
 */
Ext.define('Colsys.Widgets.WgCiudades2', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgCiudades2',
    triggerTip: 'Click para limpiar',
    queryMode: 'local',
    valueField: 'idciudad',
    displayField: 'ciudad',
    store: Ext.create('Ext.data.Store', {
        fields: ['idciudad', 'ciudad', 'idtrafico', 'trafico', 'ciudad_trafico'],
        proxy: {
            type: 'ajax',
            url: '/widgets5/datosCiudades',
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
        emptyText: 'No existen registros',
        getInnerTpl: function () {
            return '<tpl for="."><div class="search-item"><b>{ciudad} <br> {trafico} </div></tpl>';
        }
    },
    onFocus: function (field, newVal, oldVal) {

        if (this.idimpoexpo == "Importaci\u00F3n" && this.tipo == "destino") {
            this.store.filter([
                {property: 'idtrafico', value: "CO-057"}
            ]);
        }else{
            this.store.clearFilter();
        }
    }

});


