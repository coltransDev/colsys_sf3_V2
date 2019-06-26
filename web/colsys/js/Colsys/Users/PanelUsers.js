Ext.define('Colsys.Users.PanelUsers', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Users.PanelUsers',        
    frame: true,
    items:[
        Ext.create('Ext.view.View', {                    
            itemId: 'viewusers',
            plugins : [
                Ext.create('Ext.ux.DataView.DragSelector', {                    
                })
            ],
            store: Ext.create('Ext.data.JsonStore', {
                autoload: false,
                root: 'root',
                fields: ['login','name', 'icon'],                
                proxy: {
                    type: 'ajax',                    
                    reader: {
                        type: 'json',
                        rootProperty: 'root'
                    }
                }
            }),
            cls: 'file-view',
            itemSelector: 'div.thumb-wrap',
            overItemCls : 'x-view-over',
            selectedItemCls: 'x-view-selected',            
            scrollable  : true,
            trackOver: true,
            emptyText: 'No hay usuarios',
            selectionModel: {
                mode   : 'MULTI'
            },
            tpl  : Ext.create('Ext.XTemplate',
                '<tpl for=".">',
                    '<div class="thumb-wrap" id="{login}">',
                        '<div class="userthumb" align="center"><img height="80" src="{icon}" /></div>',
                        /*'<strong>{name}</strong>',*/
                        '<span class="x-editable">{name}</span>',
                    '</div>',
                '</tpl>',
                '<div class="x-clear"></div>'
            ),
            listeners: {
                selectionchange: {
                    fn: function(dv,nodes){
                        var l = nodes.length;
                        var s = l != 1 ? 's' : '';
                        //panel.setTitle('Simple DataView ('+l+' item'+s+' selected)');
                        console.log('Simple DataView ('+l+' item'+s+' selected)');
                    }
                },                        
                dblclick: {
                    fn: function (dv, nodes) {

                        var fv = this;
                        var folder = this.folder;
                        records = fv.getSelectedRecords();
                        console.log(records);
                        for (var i = 0; i < records.length; i++) {
                            //document.location.href = "?folder="+folder+"&idarchivo="+records[i].data.idarchivo;
                        }
                    }
                }

            },
            setDataUrl(url){
                this.store.proxy.url = url;
            }
        })
    ],
    dockedItems: [{
        xtype: 'toolbar',
        dock: 'top',                    
        items: [
            Ext.create('Colsys.Widgets.wgUsuario',{width: 300}),
            {

                text: 'Borrar',
                tooltip: 'Elimina el usuario seleccionado',
                iconCls: 'delete'//, // reference to our css
                //idcomponent: this.idcomponent,
                //scope: this
            }
        ]
    }]
});