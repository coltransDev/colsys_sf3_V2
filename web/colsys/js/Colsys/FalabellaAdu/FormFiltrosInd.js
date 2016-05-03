Ext.define('Colsys.FalabellaAdu.FormFiltrosInd', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.FalabellaAdu.FormFiltrosInd',
    xtype:'form',
    layout:'column',
    autoHeight:true,
    minHeight:100,
    defaults: {
        anchor: '100%',
        columnWidth: 1/2,
        labelAlign:'right',
        labelWidth:100
    },            
    items: [                
        {
            xtype:"datefield"       ,fieldLabel: 'Fecha Levante Incial'     ,id:"fecha1",
            name:"fecha1"           ,format: "Y-m-d"                        ,altFormat: "Y-m-d",
            submitFormat: 'Y-m-d'   ,value:''                               ,width:220
        },
        {

            xtype:"datefield"       ,fieldLabel: 'Fecha Levante Final'      ,id:"fecha2",
            name:"fecha2"           ,format: "Y-m-d"                        ,altFormat: "Y-m-d",
            submitFormat: 'Y-m-d'   ,value:''                               ,width:220
        },
        {
            xtype:"datefield"       ,fieldLabel: 'ETA Incial'               ,id:"eta1",
            name:"eta1"             ,format: "Y-m-d"                        ,altFormat: "Y-m-d",
            submitFormat: 'Y-m-d'   ,value:'2015-12-01'                     ,width:220
        },
        {
            xtype:"datefield"       ,fieldLabel: 'Eta Final'                ,id:"eta2",
            name:"eta2"             ,format: "Y-m-d"                        ,altFormat: "Y-m-d",
            submitFormat: 'Y-m-d'   ,value:'2016-02-05'                     ,width:220
        }
    ]
})