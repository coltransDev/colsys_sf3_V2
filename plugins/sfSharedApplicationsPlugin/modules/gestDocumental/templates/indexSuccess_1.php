<?
//$tipoDocs = $sf_data->getRaw("tipoDocs");
?>
<table align="center" width="98%" cellspacing="0" border="0" cellpading="0"><tr><td>
<div id="panel"></div>
</td></tr></table>
<script>




    
    // This is the main content center region that will contain each example layout panel.
    // It will be implemented as a CardLayout since it will contain multiple panels with
    // only one being visible at any given time.

    var contentPanel = {
         id: 'content-panel',
         region: 'center', // this is what makes this panel into a region within the containing layout
         layout: 'card',
         margins: '2 5 5 0',
         activeItem: 0,
         border: false,
         items: layoutExamples
    };



var store = Ext.create('Ext.data.TreeStore', {
        root: {
            expanded: true
        },
        proxy: {
            type: 'ajax',
            url: '<?=url_for("gestDocumental/datosSeries")?>'
            //url: '/js/ext4/examples/layout-browser/tree-data.json'
        }
    });


 var treePanel = Ext.create('Ext.tree.Panel', {
        id: 'tree-panel',
        //title: 'Sample Layouts',
        region:'north',
        split: true,
        autoHeight:true,
        //height: window.innerHeight-80,
        minSize: 150,
        rootVisible: false,
        autoScroll: true,
        store: store        
    });

treePanel.getSelectionModel().on('select', function(selModel, record) {
        if (record.get('leaf')) {
            Ext.getCmp('content-panel').layout.setActiveItem(record.getId() + '-panel');
             if (!detailEl) {
                var bd = Ext.getCmp('details-panel').body;
                bd.update('').setStyle('background','#fff');
                detailEl = bd.createChild(); //create default empty div
            }
            detailEl.hide().update(Ext.getDom(record.getId() + '-details').innerHTML).slideIn('l', {stopAnimation:true,duration: 200});
        }
    });
    
    /*var contentPanel = Ext.create('Ext.panel.Panel', {
        title: 'Archivos',
        id: 'content-panel',
        region: 'center',
        layout: 'fit',
        activeItem: 0,
        border: false,
        items: []
    });
    */


Ext.create('Ext.panel.Panel', {
    width: '100%',
    //autoHeight: true,
    height: window.innerHeight-80,
    fullscreen: true,
    title: 'Gestion Documental',
    layout: 'border',
    items: [{
        title: 'Procesos',
        region:'west',
        xtype: 'panel',
        margins: '5 0 0 5',
        width: 200,
        collapsible: true,
        id: 'west-region-container',
        layout: {
            type: 'vbox',
            align : 'stretch',
            pack  : 'start'
        },
        items: [
            {
                xtype: 'button',height:20, text: 'Agregar Serie',
                handler: function() {
                    var a=Ext.MessageBox.prompt('Serie', 'Nombre (Serie-subserie-documento):',
                    function(btn, text){
                        alert(text);
                    });
                }
            },
            treePanel]
    },contentPanel/*{
        title: 'Archivos',
        region: 'center',     // center region is required, no width/height specified
        xtype: 'panel',
        id: 'content-panel',
        name: 'content-panel',
        layout: 'fit',
        margins: '5 5 0 0'
    }*/
],
    renderTo: 'panel'
});









</script>