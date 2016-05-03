/*
    * @autor Nataly Puentes
    * @return ComboBox Usuarios según filtro ingresado
    * @param
    *        query : texto digitado para filtrar 
    * @date:  2016-03-31
*/
Ext.define('Colsys.Widgets.wgUsuario', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.wgCliente',
    store: new Ext.data.Store(
    {
        fields: [
            {name: 'login'},
            {name: 'nombre'},
            {name: 'cargo'},
            {name: 'sucursal'},
            {name: 'icon'}
         ],
        proxy: {
            url: '/widgets5/datosComboUsuario',    
            type: 'ajax',        
            reader: 
            {
                root: 'root',
                totalProperty: 'total'
            }
        }
    }),
     valueField:'login',
     displayField:'nombre',
     typeAhead: false,
     loadingText: 'buscando...',
     triggerAction: 'all',     
     selectOnFocus: true,
     allowBlank: false,
     //anchor: '98%',
     //width: 500,
     enableKeyEvents: true,
     //pageSize: true,
     //minListWidth: 220,
     minChars: 3,
     submitValue: true,
     //labelWidth: 60,
     listConfig: {
                loadingText: 'buscando...',
                emptyText: 'No matching posts found.',

                // Custom rendering template for each item
                getInnerTpl: function() {
                    return '<tpl for="."><div class="search-item"><div style="float:left; clear:left" class="userthumb" align="left"><img src="{icon}" height="80" /></div>\n\<div style="margin-left: 80px; height: 90px"  ><b>{nombre}</b><br /><span>{cargo}</span><br /><span>{sucursal}</span></div></div></tpl>';
                }
            }
});