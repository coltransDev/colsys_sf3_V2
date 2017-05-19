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
                            console.log(record.data);
                            var vport = t.up('viewport'),
                            tabpanel = vport.down('tabpanel');

                            if(!tabpanel.getChildByElement('tab'+record.data.id)  && record.data.id!=""){
                                console.log(record.data);
                                obj=[
                                    new FormConsultaArchivos({id:'form-consulta-archivos'+record.data.id,name:'form-consulta-archivos'+record.data.id,idreg:record.data.id,
                                        "Consultar":record.data.Consultar,"Crear":record.data.Crear,"Editar":record.data.Editar,"Anular":record.data.Anular,
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
                                            allowBlank:true,
                                            listeners: {
                                                specialkey: function(field, e){
                                                    if (e.getKey() == e.ENTER)                                                     
                                                        this.up("form").SpecialKey(field, e);                                                    
                                                }
                                            }
                                            
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
                                            allowBlank:false,
                                            listeners: {
                                                specialkey: function(field, e){
                                                    if (e.getKey() == e.ENTER)                                                     
                                                        this.up("form").SpecialKey(field, e);                                                    
                                                }
                                            }
                                        },
                                        {
                                            xtype: 'textfield',
                                            fieldLabel: 'Referencia 2',
                                            id:'ref2'+record.data.id,
                                            name:'ref2',
                                            value:'<?=$ref2?>',
                                            listeners: {
                                                specialkey: function(field, e){
                                                    if (e.getKey() == e.ENTER)                                                     
                                                        this.up("form").SpecialKey(field, e);                                                    
                                                }
                                            }
                                        },
                                        {
                                            xtype: 'textfield',      
                                            fieldLabel: 'Referencia 3',
                                            id:'ref3'+record.data.id,
                                            name:'ref3',
                                            value:'<?=$ref3?>',
                                            listeners: {
                                                specialkey: function(field, e){
                                                    if (e.getKey() == e.ENTER)                                                     
                                                        this.up("form").SpecialKey(field, e);                                                    
                                                }
                                            }
                                        }
                                    ],
                                    SpecialKey : function(field, e)
                                    {
                                        console.log(this);
                                        
                                            form=this.getForm();
                                            var nombre=form.findField("nombre").getValue();
                                            var documento=form.findField("documento").getValue();
                                            var ref1=form.findField("ref1").getValue();
                                            var ref2=form.findField("ref2").getValue();
                                            var ref3=form.findField("ref3").getValue();
                                            var idsserie=form.findField("idsserie").getValue();
                                            //var idreg=this.up('form').idreg;

                                            //var storeTree=Ext.getCmp("tree-grid-file"+idreg).getStore();
                                            //alert(this.up('form').id + "--"+this.up('form').idreg)
                                            var storeTree=Ext.getCmp("grid-archivos"+this.idreg).getStore();

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
                                        
                                
                                    },   
                                    }),
                                    new Ext.colsys.treeGridFiles({id:'grid-archivos'+record.data.id,name:'grid-archivos'+record.data.id,"Consultar":record.data.Consultar,"Crear":record.data.Crear,"Editar":record.data.Editar,"Anular":record.data.Anular})
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