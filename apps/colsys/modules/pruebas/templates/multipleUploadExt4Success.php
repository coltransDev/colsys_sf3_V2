
<script type="text/javascript">
Ext.Loader.setConfig({
    enabled: true,
    paths: {
        'Ext.ux': '/js/ext4/ux'
    }
});
 
Ext.onReady(function () {
    var upload = Ext.create('Ext.ux.multiupload.Panel', {
        title: 'Upload',
        width: 600,
        height: 300,
        frame: true,
        uploadConfig: {
            uploadUrl: '/postdata/upload',
            maxFileSize: 4 * 1024 * 1024,
            maxQueueLength: 5
        },
        renderTo: 'output'
    });
    var images = Ext.create('Ext.grid.Panel', {
        title: 'Images',
        width: 600,
        height: 300,
        frame: true,
        margin: '5 0 0',
        store: {
            fields: ['id']
        },
        columns: [
            { header: 'Id', dataIndex: 'id', width: 250 },
            {
                header: 'Image',
                dataIndex: 'id',
                width: 120,
                align: 'center',
                sortable: false,
                renderer: function (v) {
                    return Ext.String.format('<img src="/postdata/thumb/{0}" />', v);
                }
            }
        ],
        renderTo: 'output'
    });
 
    upload.on('fileuploadcomplete', function (id) {
        images.store.add({
            id: id
        });
    });
});
</script>

<div id="output"></div>