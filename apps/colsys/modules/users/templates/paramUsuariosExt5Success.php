
<table align="center" width="98%" cellspacing="0" border="0" cellpading="0"><tr><td>
<div id="panel"></div>
<div id="sub-panel"></div>
</td></tr></table>


<script>  
    
    
    
    Ext.Loader.setConfig({
    enabled: true,
    paths: {
        
        //'Ext.ux.exporter':'../js/ext5/examples/ux/exporter/',
        'Colsys':'/js/Colsys',
        'Ext.ux':'/js/ext5/examples/ux'
    }
});

comboBoxRenderer = function (combo) {
    return function (value) {

        rec=null;        
        for(i=0;i<combo.store.data.items.length;i++)
        {
            if(combo.store.data.items[i].get(combo.valueField)==value)
            {
                rec=combo.store.data.items[i];                
                break;
            }
        }
        return (rec === null ? value : rec.get(combo.displayField));
    };
};


Ext.onReady(function() {
    Ext.tip.QuickTipManager.init();

    
    //var filterPanel = Ext.create('Ext.panel.Panel', {
    Ext.create("Ext.panel.Panel",{
        bodyPadding: 5,        
        renderTo: 'panel',
        items: [
            {
                xtype:'Colsys.Users.GridParamUsuarios',
                title: "Parametros de Usuarios"
            }
         ]
    });
});
</script>