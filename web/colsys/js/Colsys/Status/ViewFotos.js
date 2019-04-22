Ext.define('Image', {
    extend: 'Ext.data.Model',
    fields: [
        {name: 'name'},
        {name: 'url'},
        {name: 'size', type: 'float'},
        {name: 'lastmod', type: 'date', dateFormat: 'timestamp'}
    ]
});

Ext.create('Ext.data.Store', {
    id: 'imagesStore',
    model: 'Image',
    data: [{"name": "zack_dress.jpg", "size": 2645, "lastmod": 1500487798000, "url": "https://localhost/gestDocumental/verImagen/idarchivo/476592"}, {"name": "zack.jpg", "size": 2901, "lastmod": 1500487798000, "url": "http://examples.sencha.com/extjs/6.5.1/examples/classic/view/images\/zack.jpg"}, {"name": "zack_hat.jpg", "size": 2323, "lastmod": 1500487798000, "url": "http://examples.sencha.com/extjs/6.5.1/examples/classic/view/images\/zack_hat.jpg"}, {"name": "zacks_grill.jpg", "size": 2825, "lastmod": 1500487798000, "url": "http://examples.sencha.com/extjs/6.5.1/examples/classic/view/images\/zacks_grill.jpg"}, {"name": "zack_sink.jpg", "size": 2303, "lastmod": 1500487798000, "url": "http://examples.sencha.com/extjs/6.5.1/examples/classic/view/images\/zack_sink.jpg"}, {"name": "gangster_zack.jpg", "size": 2115, "lastmod": 1500487798000, "url": "http://examples.sencha.com/extjs/6.5.1/examples/classic/view/images\/gangster_zack.jpg"}, {"name": "dance_fever.jpg", "size": 2067, "lastmod": 1500487798000, "url": "http://examples.sencha.com/extjs/6.5.1/examples/classic/view/images\/dance_fever.jpg"}, {"name": "sara_pumpkin.jpg", "size": 2588, "lastmod": 1500487798000, "url": "http://examples.sencha.com/extjs/6.5.1/examples/classic/view/images\/sara_pumpkin.jpg"}, {"name": "kids_hug.jpg", "size": 2477, "lastmod": 1500487798000, "url": "http://examples.sencha.com/extjs/6.5.1/examples/classic/view/images\/kids_hug.jpg"}, {"name": "up_to_something.jpg", "size": 2120, "lastmod": 1500487798000, "url": "http://examples.sencha.com/extjs/6.5.1/examples/classic/view/images\/up_to_something.jpg"}, {"name": "sara_pink.jpg", "size": 2154, "lastmod": 1500487798000, "url": "http://examples.sencha.com/extjs/6.5.1/examples/classic/view/images\/sara_pink.jpg"}, {"name": "sara_smile.jpg", "size": 2410, "lastmod": 1500487798000, "url": "http://examples.sencha.com/extjs/6.5.1/examples/classic/view/images\/sara_smile.jpg"}, {"name": "kids_hug2.jpg", "size": 2476, "lastmod": 1500487798000, "url": "http://examples.sencha.com/extjs/6.5.1/examples/classic/view/images\/kids_hug2.jpg"}]
});



Ext.define('Colsys.Status.ViewFotos', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.Colsys.Status.ViewFotos',
    id: 'images-view',
    frame: true,
    collapsible: true,
    width: 535,
    //renderTo: 'dataview-example',
    title: 'Simple DataView (0 items selected)',
    items: Ext.create('Ext.view.View', {
        //store: store,
        store: Ext.data.StoreManager.lookup('imagesStore'),
        tpl: [
            '<tpl for=".">',
            '<div class="thumb-wrap" id="{name:stripTags}">',
            '<div class="thumb"><img src="{url}" title="{name:htmlEncode}"></div>',
            '<span class="x-editable">{shortName:htmlEncode}</span>',
            '</div>',
            '</tpl>',
            '<div class="x-clear"></div>'
        ],
//            selectionModel: {
//                mode   : 'MULTI'
//            },
        //height: 310,
        trackOver: true,
        overItemCls: 'x-item-over',
        itemSelector: 'div.thumb-wrap',
        emptyText: 'No images to display',
//            plugins: {
//                dataviewdragselector: true,
//                dataviewlabeleditor: {
//                    dataIndex: 'name'
//                }
//            },
        prepareData: function (data) {
            Ext.apply(data, {
                shortName: Ext.util.Format.ellipsis(data.name, 15),
                sizeString: Ext.util.Format.fileSize(data.size),
                dateString: Ext.util.Format.date(data.lastmod, "m/d/Y g:i a")
            });
            return data;
        },
        listeners: {
            selectionchange: function (dv, nodes) {
                var l = nodes.length,
                        s = l !== 1 ? 's' : '';
                this.up('panel').setTitle('Simple DataView (' + l + ' item' + s + ' selected)');
            }
        }
    })
});
//});
