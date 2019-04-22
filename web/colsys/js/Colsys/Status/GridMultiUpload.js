/*Ext.override(Ext.data.request.Ajax, {
    openRequest: function (options) {
        var xhr = this.callParent(arguments);
        if (options.progress) {
            xhr.upload.onprogress = options.progress;
        }
        return xhr;
    }
});*/

Ext.define('Colsys.Status.GridMultiUpload', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Status.GridMultiUpload',
    height: 400,
    store: {
        fields: ['name', 'size', 'progress', 'status']
    },
    dockedItems: [
//        {
//        xtype: 'toolbar',
//        dock: 'top',
//        //ui: 'footer',
//        /*defaults: {
//            minWidth: 200
//        },*/
//        items: [{ 
//            xtype: 'filefield', 
//            buttonOnly: true,
//            listeners: {
//                render: function (s) {
//                    s.fileInputEl.set({ multiple: 'multiple' });
//                },
//                change: function (s) {                    
//                    var me = this.up("grid");                    
//                    Ext.each(s.fileInputEl.dom.files, function (f) {
//                        var data = new FormData(),
//                            rec = me.store.add({ name: f.name, size: f.size, status: 'queued' })[0];
//                        data.append('file', f);
//                        Ext.Ajax.request({
//                            url: '/upload/files',
//                            rawData: data,
//                            headers: { 'Content-Type': null }, //to use content type of FormData
//                            progress: function (e) {
//                                rec.set('progress', e.loaded / e.total);
//                                rec.set('status', 'uploading...');
//                                rec.commit();
//                            },
//                            success: function () {
//                                rec.set('status', 'done');
//                                rec.commit();
//                            },
//                            failure: function () {
//                                rec.set('progress', 0);
//                                rec.set('status', 'failed');
//                                rec.commit();
//                            }
//                        });
//                    });
//                }
//            }
//        },
//        { xtype: 'button', text: 'button'}
//    ]
//    }
    Ext.create('Ext.toolbar.Toolbar', {
        //renderTo: document.body,
        width   : 500,
        dock: 'bottom',
        items: [
            { 
                xtype: 'filefield', 
                buttonOnly: true,
                style: {
                    left: '0px',
                    marginTop: '-12px',
                    top: '0px'
                }/*,
                listeners: {
                    render: function (s) {
                        s.fileInputEl.set({ multiple: 'multiple' });
                    },
                    change: function (s) {                    
                        var me = this.up("grid");                    
                        Ext.each(s.fileInputEl.dom.files, function (f) {
                            var data = new FormData(),
                                rec = me.store.add({ name: f.name, size: f.size, status: 'queued' })[0];
                            data.append('file', f);
                            Ext.Ajax.request({
                                url: '/upload/files',
                                rawData: data,
                                headers: { 'Content-Type': null }, //to use content type of FormData
                                progress: function (e) {
                                    rec.set('progress', e.loaded / e.total);
                                    rec.set('status', 'uploading...');
                                    rec.commit();
                                },
                                success: function () {
                                    rec.set('status', 'done');
                                    rec.commit();
                                },
                                failure: function () {
                                    rec.set('progress', 0);
                                    rec.set('status', 'failed');
                                    rec.commit();
                                }
                            });
                        });
                    }
                }*/
            },
            {
                xtype: 'splitbutton',
                text : 'Split Button'
            },
            // begin using the right-justified button container
            '->', // same as { xtype: 'tbfill' }
            {
                xtype    : 'textfield',
                name     : 'field1',
                emptyText: 'enter search term'
            },
            // add a vertical separator bar between toolbar items
            '-', // same as {xtype: 'tbseparator'} to create Ext.toolbar.Separator
            'text 1', // same as {xtype: 'tbtext', text: 'text1'} to create Ext.toolbar.TextItem
            { xtype: 'tbspacer' },// same as ' ' to create Ext.toolbar.Spacer
            'text 2',
            { xtype: 'tbspacer', width: 50 }, // add a 50px space
            'text 3'
        ]
    })
],
//        tbar: [{
//            xtype: 'filefield',
//            buttonOnly: true,
//            width: 10,
//            listeners: {
//                render: function (s) {
//                    s.fileInputEl.set({ multiple: 'multiple' });
//                },
//                change: function (s) {
//                    Ext.each(s.fileInputEl.dom.files, function (f) {
//                        var data = new FormData(),
//                            rec = grid.store.add({ name: f.name, size: f.size, status: 'queued' })[0];
//                        data.append('file', f);
//                        Ext.Ajax.request({
//                            url: '/upload/files',
//                            rawData: data,
//                            headers: { 'Content-Type': null }, //to use content type of FormData
//                            progress: function (e) {
//                                rec.set('progress', e.loaded / e.total);
//                                rec.set('status', 'uploading...');
//                                rec.commit();
//                            },
//                            success: function () {
//                                rec.set('status', 'done');
//                                rec.commit();
//                            },
//                            failure: function () {
//                                rec.set('progress', 0);
//                                rec.set('status', 'failed');
//                                rec.commit();
//                            }
//                        });
//                    });
//                }
//            }
//        }],
        columns: [
            { text: 'Name', dataIndex: 'name', flex: 1 },
            { text: 'Status', dataIndex: 'status', width: 100 },
            {
                text: 'Progress', xtype: 'widgetcolumn', widget: {
                    xtype: 'progressbarwidget',
                    textTpl: [
                        '{percent:number("0")}%'
                    ]
                }, dataIndex: 'progress', width: 100
            },
            { text: 'Size', dataIndex: 'size', width: 100, renderer: Ext.util.Format.fileSize }
        ]
});


/*Ext.onReady(function() {
    var grid = Ext.widget({
        xtype: 'grid',
        height: 400,
        store: {
            fields: ['name', 'size', 'progress', 'status']
        },
        tbar: [{
            xtype: 'filefield',
            buttonOnly: true,
            width: 10,
            listeners: {
                render: function (s) {
                    s.fileInputEl.set({ multiple: 'multiple' });
                },
                change: function (s) {
                    Ext.each(s.fileInputEl.dom.files, function (f) {
                        var data = new FormData(),
                            rec = grid.store.add({ name: f.name, size: f.size, status: 'queued' })[0];
                        data.append('file', f);
                        Ext.Ajax.request({
                            url: '/upload/files',
                            rawData: data,
                            headers: { 'Content-Type': null }, //to use content type of FormData
                            progress: function (e) {
                                rec.set('progress', e.loaded / e.total);
                                rec.set('status', 'uploading...');
                                rec.commit();
                            },
                            success: function () {
                                rec.set('status', 'done');
                                rec.commit();
                            },
                            failure: function () {
                                rec.set('progress', 0);
                                rec.set('status', 'failed');
                                rec.commit();
                            }
                        });
                    });
                }
            }
        }],
        columns: [
            { text: 'Name', dataIndex: 'name', flex: 1 },
            { text: 'Status', dataIndex: 'status', width: 100 },
            {
                text: 'Progress', xtype: 'widgetcolumn', widget: {
                    xtype: 'progressbarwidget',
                    textTpl: [
                        '{percent:number("0")}%'
                    ]
                }, dataIndex: 'progress', width: 100
            },
            { text: 'Size', dataIndex: 'size', width: 100, renderer: Ext.util.Format.fileSize }
        ],
        renderTo: Ext.getBody()
    });
});*/