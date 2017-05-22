<script>
    Ext.require([
//    'Ext.form.field.File',
    'Ext.form.Panel',
    'Ext.window.MessageBox'
]);
</script>
<?
include_component("widgets4", "wgEmpresas");
include_component("widgets4", "wgCcostos");
include_component("widgets4", "wgCliente");
include_component("inocomprobantes", "gridMovimientos");
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
    //layout: 'column',
    anchor: '100%',
    width:'100%',
    constructor: function(config) {
        this.callParent(arguments);        
        //Ext.getCmp("idsserie").setValue(this.idsserie);
    },

        frame: true,        
        bodyPadding: '10 10 0',
        
        defaults: {            
            msgTarget: 'side',
            labelWidth: 100,
            bodyStyle:'padding:10'
        },
        items: [
            Ext.create('Ext.form.Panel', {
            /*title: 'Subir Archivos',    */
            bodyPadding: 5,
            //width: 350,
            //anchor: '100%',
            width:'100%',
            layout: 'column',
            defaults:{
                columnWidth: 1/4,
                bodyStyle:'padding:5,marging:5',
                style:"text-align: right",
                 labelWidth: 100
            },
            items: [
            {
                xtype: 'hidden',
                id:'movimientos',
                name:'movimientos'
            },
            {
                xtype: 'hidden',
                id:'total',
                name:'total'
            },
            {
                    //columnWidth: 0.9,
                    //columnWidth: 1/4,
                    //bodyStyle:'padding:0,marging:0',
                    xtype: 'wEmpresas',
                    id:'idempresa',
                    name:'idempresa',
                    width : 300,
                    fieldLabel: 'Empresa',
                    listeners:{
                        'change': function ( obj, newValue, oldValue, eOpts )
                        {
                            var storeTmp=Ext.getCmp("ccosto").getStore();
                            storeTmp.load({
                                params : {
                                    "idempresa" : newValue
                                }
                            });
                            
                            var storeTmp=Ext.getCmp('cuentas-siigo-grid').getStore();
                            storeTmp.load({
                                params : {
                                    "idempresa" : newValue
                                }
                            });
                        }
                   }
                },
                {
                    //columnWidth: 1/2,
                    //bodyStyle:'padding:0,marging:0',
                    xtype: 'wCcostos',
                    id:'ccosto',
                    name:'idccosto',
                    width : 300,
                    fieldLabel: 'Centro Costo',
                    listeners:{
                        /*'change': function ( obj, newValue, oldValue, eOpts )
                        {
                            if(Ext.getCmp("idempresa").getValue()=="")
                            {
                                alert("Por favor seleccione la empresa primero");
                                return;
                            }
                            var storeTmp=Ext.getCmp("concepto").getStore();
                            storeTmp.load({
                                params : {
                                    "idccosto" : newValue                                    
                                }
                            });
                            var storeTmp=Ext.getCmp("seleccion-conceptos").getStore();
                            storeTmp.load({
                                params : {
                                    "idccosto" : newValue,
                                    "idconcepto" : Ext.getCmp("concepto").getValue(),
                                    "idempresa" : Ext.getCmp("idempresa").getValue()
                                },
                                callback: function(records, operation, success) {
                                    var t=Ext.JSON.decode(operation.response.responseText);                                    
                                    Ext.getCmp("seleccion-conceptos").setValue(t.seleccionados);                                    
                                }
                            });
                            
                            
                        }*/
                   }
                },            
            {
                xtype: 'datefield',
                fieldLabel: 'Fecha',
                id:'fecha',
                name:'fecha',
                value:'',
                format :'Y-m-d'
            },
            {
                xtype: 'textfield',
                fieldLabel: 'Tipo Comp',
                id:'idtipocomprobante',
                name:'idtipocomprobante',
                value:''
            },
            {
                xtype: 'wCliente',
                fieldLabel: 'Tercero',
                id:'idtercero',
                name:'idtercero'
            }
            ],

            bbar: [{
                    text: 'Guardar',
                    handler: function(){
                        
                        var store = Ext.getCmp("grid-movimientos").getStore();
                        var records = store.getModifiedRecords();
                        var lenght = records.length;

                        changes=[];
                        var total=0;
                        for( var i=0; i< lenght; i++){
                            r = records[i];

                             if( r.data.cuenta!="")
                             {                
                                records[i].data.id=r.id                    
                                changes[i]=records[i].data;
                                total=records[i].data.valor;
                             }
                        }

                        var str= JSON.stringify(changes);
                        var form = this.up('form').getForm();                        
                        form.findField("movimientos").setValue(str); 
                        form.findField("total").setValue(total);
                        
                        if(form.isValid()){
                            form.submit({
                                url: '/inocomprobantes/guardarComprobante',
                                waitMsg: 'Guardando',
                                success: function(fp, o) {
                                     var obj = Ext.decode(o.result);
                                       Ext.getCmp("grid-facturacion").getStore().reload();
                                       //box.hide();
                                       Ext.MessageBox.alert("Colsys", "Se genero el comprobante No. " + obj.consecutivo);
                                    //msg('Mensaje', 'Archivo Procesado "' + o.result.file + '" en el servidor');
                                    //Ext.getCmp("tree-grid-file").getStore().load({params : {'ref1' : Ext.getCmp("ref1").getValue()}});
                                    //location.href=location.href;
                                }
                            });
                        }
                    }
                },
                {
                    text: 'Buscar',
                    handler: function(){


                    }
                },
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
            
                xtype: 'gMovimientos',
                id:'grid-movimientos',
                name:'grid-movimientos',
                title:'Movimientos',
                 width:'100%'
            }
    ]
}); 
    
    
    /*var store = Ext.create('Ext.data.TreeStore', {
        root: {
            expanded: true
        },
        proxy: {
            type: 'ajax',
            url: '<?=url_for("gestDocumental/datosSeries")?>'
        }
    });
    */

Ext.create('ReportsPanel', {renderTo:'panel',title:"Generación de Comprobantes",id:'tab1'})

                            
   
});


</script>