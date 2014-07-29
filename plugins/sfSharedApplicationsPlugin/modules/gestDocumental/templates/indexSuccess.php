<script>
    Ext.require([
    'Ext.form.field.File',
    'Ext.form.Panel',
    'Ext.window.MessageBox'
]);
</script>
<?
include_component("widgets4", "wgDocumentos");

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
    

    var required = '<span style="color:red;font-weight:bold" data-qtip="Required">*</span>';
  
    Ext.define('ReportsPanel', {
    extend: 'Ext.panel.Panel',
    layout: 'anchor',
    constructor: function(config) {
        this.callParent(arguments);        
        Ext.getCmp("idsserie").setValue(this.idsserie);
    },

        frame: true,
        title: 'Archivos',
        bodyPadding: '10 10 0',

        defaults: {
            anchor: '100%',
            msgTarget: 'side',
            labelWidth: 50
        },
        items: [
            Ext.create('Ext.form.Panel', {
            title: 'Subir Archivos',    
            bodyPadding: 5,
            width: 350,
            items: [
            {
                xtype: 'hidden',
                id:'idsserie',
                name:'idsserie'
            },
            {
                xtype: 'hidden',
                id:'idarchivo',
                name:'idarchivo'
            },
            {
                xtype: 'textfield',
                fieldLabel: 'Nombre',
                id:'nombre',
                name:'nombre',
                allowBlank:true
            },{
                xtype: 'filefield',
                id: 'form-file',
                emptyText: 'Seleccione un archivo',
                fieldLabel: 'Archivo',
                name: 'archivo',                
                buttonText: '',                
                buttonConfig: {
                    style : 'position:relative',
                    iconCls: 'upload-icon'
                },
                allowBlank:false
            },
            {
                xtype: 'wDocumentos',
                id:'documento',
                name:'documento',
                fieldLabel: 'Documento',                
                queryMode: 'local',
                displayField: 'name',
                valueField: 'id',
                linkSerie:'idsserie',
                allowBlank:false,
                width: 400
                
            },
            {
                xtype: 'textfield',
                fieldLabel: 'Referencia 1',
                id:'ref1',
                name:'ref1',
                value:'<?=$ref1?>',
                allowBlank:false
            },
            {
                xtype: 'textfield',
                fieldLabel: 'Referencia 2',
                id:'ref2',
                name:'ref2',
                value:'<?=$ref2?>'
            },
            {
                xtype: 'textfield',      
                fieldLabel: 'Referencia 3',
                id:'ref3',
                name:'ref3',
                value:'<?=$ref3?>'
            }/*,
            {
                xtype: 'textfield',
                fieldLabel: 'asunto',
                id:'asunto',
                name:'asunto',
                value:'prueba-prueba'
            }
            ,
            {
                xtype: 'textfield',
                fieldLabel: 'from',
                id:'from',
                name:'from',
                value:'maquinche@coltrans.com.co'
            }*/
            ],

            bbar: [{
                    text: 'Guardar',
                    handler: function(){
                        var form = this.up('form').getForm();
                        if(form.isValid()){
                            form.submit({
                                url: '/gestDocumental/subirArchivoTRD',
                                waitMsg: 'Guardando',
                                success: function(fp, o) {
                                    msg('Mensaje', 'Archivo Procesado "' + o.result.file + '" en el servidor');
                                    Ext.getCmp("tree-grid-file").getStore().load({params : {'ref1' : Ext.getCmp("ref1").getValue()}});
                                    //location.href=location.href;
                                }
                            });
                        }
                    }
                },
                {
                    text: 'Buscar',
                    handler: function(){
                    
                        var nombre=Ext.getCmp("nombre").getValue();
                        var documento=Ext.getCmp("documento").getValue();
                        var ref1=Ext.getCmp("ref1").getValue();
                        var ref2=Ext.getCmp("ref2").getValue();
                        var ref3=Ext.getCmp("ref3").getValue();
                        var idsserie=Ext.getCmp("idsserie").getValue();

                        var storeTree=Ext.getCmp("tree-grid-file").getStore();
                        storeTree.load({
                            params : {
                                nombre : nombre,
                                ref1 : ref1,
                                ref2 : ref2,
                                ref3 : ref3,
                                documento : documento,
                                idsserie: idsserie
                            }
                        });

                        
                    }
                }
                
                ,
                {
                    text: 'Limpiar',
                    handler: function() {
                        this.up('form').getForm().reset();
                    }
                }]
            })
            /*new Ext.colsys.formArchivo(
            {             
                id:'form-panel-file',
                name:'form-panel-file'
            }
            )*/
            
            ,
            {
                xtype: 'wTreeGridFile',
                id:'tree-grid-file',
                name:'tree-grid-file'
                
            }
    ]
}); 
    
    
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
                    }
                ]
    }],
                listeners:{
                    itemclick: function(t,record,item,index){                    
                        if(record.data.depth==2)
                        {

                            var vport = t.up('viewport'),
                                tabpanel = vport.down('tabpanel');

                            if(!tabpanel.getChildByElement('tab'+index)){
                                tabpanel.add(

                                    Ext.create('ReportsPanel', {closable: true,title:record.data.text,id:'tab'+index,idsserie:record.data.id})

                                );
                            }
                            tabpanel.setActiveTab('tab'+index);
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