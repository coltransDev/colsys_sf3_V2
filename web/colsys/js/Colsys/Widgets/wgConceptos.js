Ext.define('Colsys.Widgets.wgConceptos', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.wgConceptos',    
    queryMode:'local',
    valueField:'id',
    displayField:'name',
    store: Ext.create('Ext.data.Store', {
        fields: ['id','name'],
        proxy: {
            type: 'ajax',
            url: '/widgets5/datosConceptos',
            reader: {
                type: 'json',
                rootProperty: 'root'
            }
        },
        autoLoad: false
    })
    


});

/*fieldLabel: 'Choose State',
    store: states,
    queryMode: 'local',
    displayField: 'name',
    valueField: 'abbr',
    renderTo: Ext.getBody()*/