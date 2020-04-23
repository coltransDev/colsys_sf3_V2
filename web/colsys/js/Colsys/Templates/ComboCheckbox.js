Ext.define('Colsys.Templates.ComboCheckbox', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Templates.ComboCheckbox',    
    displayField: 'name',
    valueField: 'id',
    multiSelect: true,
    tpl: new Ext.XTemplate('<tpl for=".">', '<div class="x-boundlist-item">', '<input type="checkbox" />', '{name}', '</div>', '</tpl>'),    
    queryMode: 'local',
    listeners: {
        select: function (combo, records) {
            var node;
            Ext.each(records, function (rec) {
                node = combo.getPicker().getNode(rec);                                
                Ext.get(node).down('input').dom.checked = true;
            });
        },
        beforedeselect: function (combo, rec) {
            var node = combo.getPicker().getNode(rec);
            Ext.get(node).down('input').dom.checked = false;
        }
    }
});