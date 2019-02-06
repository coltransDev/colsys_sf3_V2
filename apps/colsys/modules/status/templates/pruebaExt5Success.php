<div></div>

<script>


Ext.onReady(function() {
    Ext.override(Ext.data.request.Ajax, {
    openRequest: function (options) {
        var xhr = this.callParent(arguments);
        if (options.progress) {
            xhr.upload.onprogress = options.progress;
        }
        return xhr;
    }
});
        var grid = Ext.widget({
        xtype: 'grid',
        height: 400,
        store: {
            fields: ['name', 'size', 'progress', 'status']
        },
        tbar: [{
            xtype: 'filefield',
            buttonOnly: true,
            width: 100,
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
        renderTo: 'companies_grid'
    });
});

</script>