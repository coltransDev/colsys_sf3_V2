/**
* @autor Felipe Nariño 
* @return Combobox cargado con Incoterms                             
* @date:  2016-03-28
*/
Ext.define('Colsys.Widgets.WgIncoterms', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgIncoterms',
    triggerTip: 'Click para limpiar',    
    displayField: 'valor',
    valueField: 'valor',
    
    
    store: Ext.create('Ext.data.Store', {
           fields: ['valor'],
            proxy: {
                type: 'ajax',
                url: '/widgets5/datosIncoterms',
                reader: {
                    type: 'json',
                    root: 'root'
                }
            },
            autoLoad: true
   }),
    qtip:'Listado',
    queryMode: 'local',
    forceSelection:true,
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function() {
            return '<tpl for="."><div class="search-item1">{valor}</div></tpl>';
        }
    }
    
});



