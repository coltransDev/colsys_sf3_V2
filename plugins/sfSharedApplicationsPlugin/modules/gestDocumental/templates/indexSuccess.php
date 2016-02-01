<script>
    Ext.require([
    'Ext.form.field.File',
    'Ext.form.Panel',
    'Ext.window.MessageBox'
]);

var msg = function(title, msg) {
        Ext.Msg.show({
            title: title,
            msg: msg,
            minWidth: 200,
            modal: true,
            icon: Ext.Msg.INFO,
            buttons: Ext.Msg.OK
        });
    };
</script>
<?

include_component("gestDocumental", "formConsultaArchivos");
include_component("widgets5", "wgDocumentos");

include_component("gestDocumental", "formArchivos");

include_component("gestDocumental", "treeGridFiles");
?>
<table align="center" width="98%" cellspacing="0" border="0" cellpading="0"><tr><td>
<div id="panel"></div>
<div id="sub-panel"></div>
</td></tr></table>
<script>

Ext.onReady(function() {
    Ext.tip.QuickTipManager.init();
    

    var required = '<span style="color:red;font-weight:bold" data-qtip="Required">*</span>';
    
            
    
    var store = Ext.create('Ext.data.TreeStore', {
        root: {
            expanded: true
        },
        proxy: {
            type: 'ajax',
            url: '<?=url_for("gestDocumental/datosSeries")?>'
        }
    });
    
    
    Ext.create("Ext.container.Viewport",{
        renderTo: 'panel',
        layout:'border',
        scope:this,
        items:[{
            region: 'west',
            title: 'Gestion Documental',
            width: 180,
            items:[{
                xtype:'treepanel',
                rootVisible: false,
                border:false,
                store: store,
                dockedItems: [{
                    xtype: 'toolbar',
                    dock: 'top',
                    items: [{
                        text: 'Agregar Serie',
                        handler: function() {
                            var a=Ext.MessageBox.prompt('Serie', 'Nombre (Serie-subserie-documento):',
                            function(btn, text){
                                if(text!="")
                                    alert(text);
                                else
                                    Ext.MessageBox.alert("Sin dato", "por favor ingrese un nombre de Serie")
                            });
                        }
                    }]
                }],
                listeners:{
                    itemclick: function(t,record,item,index){                    
                        if(record.data.depth==2)
                        {

                            var vport = t.up('viewport'),
                            tabpanel = vport.down('tabpanel');

                            if(!tabpanel.getChildByElement('tab'+record.data.id)  && record.data.id!=""){

                                obj=[
                                    new FormConsultaArchivos({id:'form-consulta-archivos'+record.data.id,name:'form-consulta-archivos'+record.data.id,idreg:record.data.id,
                                        items:[{
                                            xtype: 'hidden',
                                            id:'idsserie'+record.data.id,
                                            name:'idsserie',
                                            value:record.data.id
                                            
                                        },
                                        {
                                            xtype: 'hidden',
                                            id:'idarchivo'+record.data.id,
                                            name:'idarchivo'
                                        },
                                        {
                                            xtype: 'textfield',
                                            fieldLabel: 'Nombre',
                                            id:'nombre'+record.data.id,
                                            name:'nombre',
                                            allowBlank:true
                                            
                                        },{
                                            xtype: 'filefield',
                                            id: 'form-file'+record.data.id,
                                            emptyText: 'Seleccione un archivo',
                                            fieldLabel: 'Archivo',
                                            name: 'archivo',
                                            buttonText: '',
                                            buttonConfig: {
                                                style : 'position:relative',
                                                iconCls: 'upload-icon'
                                            },
                                            allowBlank:false,
                                            width: '170px'
                                        },
                                        {
                                            xtype: 'wDocumentos',
                                            id:'documento'+record.data.id,
                                            name:'documento',
                                            fieldLabel: 'Documento',
                                            idsserie:record.data.id,
                                            queryMode: 'local',
                                            displayField: 'name',
                                            valueField: 'id',
                                            linkSerie:'idsserie'+record.data.id,
                                            allowBlank:false,
                                            width: 400

                                        },
                                        {
                                            xtype: 'textfield',
                                            fieldLabel: 'Referencia 1',
                                            id:'ref1'+record.data.id,
                                            name:'ref1',
                                            value:'<?=$ref1?>',
                                            allowBlank:false
                                        },
                                        {
                                            xtype: 'textfield',
                                            fieldLabel: 'Referencia 2',
                                            id:'ref2'+record.data.id,
                                            name:'ref2',
                                            value:'<?=$ref2?>'
                                        },
                                        {
                                            xtype: 'textfield',      
                                            fieldLabel: 'Referencia 3',
                                            id:'ref3'+record.data.id,
                                            name:'ref3',
                                            value:'<?=$ref3?>'
                                        }
                                    ]
                                    }),
                                    new Ext.colsys.treeGridFiles({id:'grid-archivos'+record.data.id,name:'grid-archivos'+record.data.id})
                                ];
                                
                                tabpanel.add(                                
                                {
                                    title: record.data.text,
                                    id:'tab'+record.data.id,
                                    itemId:'tab'+record.data.id,
                                    autoScroll:true,
                                    items: [
                                    {
                                        autoScroll:true,
                                        items:[
                                            Ext.create('Ext.panel.Panel', {
                                            //title: 'Registro de Incidente',    
                                                bodyPadding: 10,
                                                //width: 350,
                                                autoScroll:true,
                                                id:'tab-form'+record.data.id,
                                                items: obj
                                            })
                                        ]
                                    }
                                    ]
                                });
                            }
                            tabpanel.setActiveTab('tab'+record.data.id);
                        }
                    }
                }
            }]
        },{
            region: 'center',
            xtype: 'tabpanel',
            activeTab: 0,
            items: [/*{
                title: 'Default Tab',
                html:'Selecciona una opcion del menu'
            },*/
            

            //Ext.create('ReportsPanel', {closable: true,title:"Maritimo",id:'tab1',idsserie:"2"}),
            //Ext.create('ReportsPanel', {closable: true,title:"Aereo",id:'tab2',idsserie:"4"})

                            
            ]
        },
        {
            region: 'north',
            html: '',
            border: false,
            height: 30,
            style: {
                display: 'none'
            }            
        }
        ]
    });
});


</script>