<?

include_component("widgets4", "wgHouse",array("idmaster"=>$idmaster));
include_component("widgets4", "wgMoneda");
include_component("widgets4", "wgCliente");
include_component("widgets4", "wgTipoComprobante");
?>
<script>

Ext.define('Ext.colsys.formFactura', {
        extend: 'Ext.form.Panel',
        alias: 'widget.wFormFactura',
            title: 'Factura',
            bodyPadding: 5,
            anchor: '100%',
            layout:'column',
            defaults:{
                columnWidth: 1/2.1,
                bodyStyle:'padding:3,marging:3',
                style:"text-align: left",
                labelAlign:'right'
            },            
            items: [
            {
                xtype: 'hidden',
                id:'_idcomprobante',
                name:'idcomprobante'
            },
            /*{
                xtype: 'textfield',
                id:'_consecutivo',
                name:'consecutivo',                
                fieldLabel: 'Consecutivo',
                readOnly:true
            },
            {
                xtype: 'textfield',
                id:'_fecha',
                name:'fecha',
                fieldLabel: 'Fecha',
                readOnly:true
                
            },*/
            {
                columnWidth: 0.4,
                xtype: 'wTipoComprobante',
                id:'_idtipocomprobante',
                name:'idtipocomprobante',
                fieldLabel: 'Tipo',                
                allowBlank:false
            },
            {
                columnWidth: 0.6,
                xtype: 'wHouse',
                id:'_idhouse',
                name:'idhouse',
                fieldLabel: 'House',
                queryMode: 'local',
                displayField: 'name',
                valueField: 'id',                
                allowBlank:false,
                width: 400,
                listeners:{
                    select : function( combo, records, idx ){
                        var form = this.up('form').getForm();
                        data=records[0].data;
                        //alert(data.toSource());
                        //alert(Ext.getCmp("cliente").getValue())
                        Ext.getCmp("idclienteF").store.add(
                            {"compania":data.cliente, "idcliente":data.idcliente}
                        );
                        
                        Ext.getCmp("idclienteF").setValue(data.idcliente);
                    }
                }
            },
            {
                columnWidth: 1,
                xtype: 'wCliente',
                fieldLabel: "Cliente",
                name: "idclienteF",
                id: "idclienteF",                            
                allowBlank: false                
            },
            {                
                xtype: 'numberfield',
                fieldLabel: 'Tasa de Cambio',
                id:'_tcambio',
                name:'tcambio'
            },
            {
                xtype: 'wMoneda',
                id:'_idmoneda',
                name:'idmoneda',
                fieldLabel: 'Moneda',
                queryMode: 'local',
                displayField: 'name',
                valueField: 'id',
                allowBlank:false
            },
            {
                columnWidth: 1,
                xtype: 'textareafield',
                fieldLabel: 'Bienes Trans',
                id:'_bienestrans',
                name:'bienestrans'
            },
            {
                columnWidth: 1,
                xtype: 'textareafield',
                fieldLabel: 'Detalle',
                id:'_detalle',
                name:'detalle'
            },
            {
                columnWidth: 1,
                xtype: 'textareafield',
                fieldLabel: 'Anexos',
                id:'_anexos',
                name:'anexos'
            }
            ],
            bbar: [{
                    text: 'Guardar',
                    handler: function(){
                        var form = this.up('form').getForm();
                        if(form.isValid()){
                            form.submit({
                                url: '/ino/guardarFactura',
                                waitMsg: 'Guardando',
                                success: function(response,options) {
                                    var res = Ext.JSON.decode( options.response.responseText );
                                    //msg('Mensaje', 'Archivo Procesado "' + o.result.file + '" en el servidor');
                                    //Ext.getCmp("tree-grid-file").getStore().reload();
                                    var box = Ext.MessageBox.wait('Procesando', 'Generacion de Factura')
                                    Ext.getCmp("grid-facturacion").getStore().reload();
                                    box.hide();
                                    /*var r = Ext.create('recfac', {
                                        comprobante: 'Sin Facturar'//record.get('comprobante')
                                    });
                                    store.insert(0, r);
                                    store.sort();*/
                                    
                                    Ext.getCmp("winFormEdit").hide();
                                    //location.href=location.href;
                                }
                            });
                        }
                    }
                }],
            cargar: function(idcomprobante)
            {
                this.form.load({
                    url:'<?=url_for("ino/datosFormFactura")?>',
                    //waitMsg:'cargando...',
                    params:{"idcomprobante":idcomprobante},
                    success: function(response,options) {
                        var res = Ext.JSON.decode( options.response.responseText );
                        
                        data=res.data;
                        Ext.getCmp("idclienteF").store.add(
                            {"compania":data.cliente, "idcliente":data.idcliente}
                        );
                        Ext.getCmp("idclienteF").setValue(data.idcliente);                       
                    }                    
                });
            },
            cargar: function(tipo)
            {
                if(tipo=="C")
                {
                    //var form = this.up('form').getForm();
                }
            }
            
})
</script>