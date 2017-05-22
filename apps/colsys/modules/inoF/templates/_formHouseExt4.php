<?

if($modo!=6)
    include_component("widgets4", "wgReporte");
else
    include_component("widgets4", "wgReferencia");

include_component("widgets4", "wgCliente");
include_component("widgets4", "wgTercero");
include_component("widgets4", "wgUsuario");
include_component("widgets4", "wgParametros",array("caso_uso"=>"CU047"));
?>
<script>
Ext.define('Ext.colsys.formHouse', {
        extend: 'Ext.form.Panel',
        alias: 'widget.wFormHouse',
            //title: 'general',
            bodyPadding: 5,
            anchor: '100%',
            layout:'column',
            defaults:{
                columnWidth: 1,
                bodyStyle:'padding:3,marging:2',
                labelAlign:'right'
            },
            items: [
                {
                    xtype: "hidden",
                    name: "idmaster",
                    value: '<?=$idmaster?>'
                },
                {
                    xtype: "hidden",
                    name: "modo",
                    value: '<?=$modo?>'
                },
                {
                    xtype: "hidden",
                    name: "idhouse"
                },
                {
                    bodyPadding: 5,
                    anchor: '100%',
                    layout:'column',
                    title:"General",
                    defaults:{
                        columnWidth: 1/2,
                        bodyStyle:'padding:3,marging:2',
                        labelAlign:'right'                                                
                    },            
                    items: [                                                
                        <?
                        if($modo!=6)
                        {
                        ?>
                        {
                            //columnWidth: 1,
                            xtype: 'wReporte',
                            fieldLabel: "Reporte",
                            name: "idreporte",
                            id: "idreporte",                            
                            allowBlank:false,
                            tipo:1,
                            impoexpo: 'OTM-DTA',
                            transporte: 'Terrestre',
                            listeners:{
                                select : function( combo, records, idx ){
                                    var form = this.up('form').getForm();
                                    
                                    record=records[0];
                                    data=records[0].data;                                    
                                    Ext.getCmp("idcliente").store.add(
                                        {"compania":data.compania, "idcliente":data.idcliente}
                                    );
                                    Ext.getCmp("vendedor").store.add(
                                        {"login":data.vendedor, "nombre":data.nombreVendedor}
                                    );
                                    
                                    form.setValues({
                                        "vendedor":data.vendedor,                                        
                                        "idcliente":data.idcliente,
                                        "numorden":data.orden_clie                                        
                                    });
                                    
                                    form.load({
                                        url: '<?= url_for("inoF/datosReporteCarga") ?>',
                                        params :{
                                            idreporte:record.data.idreporte,
                                            modo: '<?=$modo?>'
                                        },
                                        failure:function(response,options){
                                            var res = Ext.JSON.decode( response.responseText );
                                            if(res.err)
                                                Ext.MessageBox.alert("Mensaje",'Se presento un error cargando por favor informe al Depto. de Sistemas<br>'+res.err);
                                        },
                                        success:function(response,options){
                                            var res = Ext.JSON.decode( options.response.responseText );
                                            //alert(res.toSource());
                                            Ext.getCmp("tercero").store.add(
                                                {"idtercero":res.data.idtercero, "nombre":res.data.tercero}
                                            );
                                            Ext.getCmp("tercero").setValue(res.data.idtercero);
                                        }
                                    });
                                }
                            }
                        }
                         <?
                        }
                        else
                        {
                        ?>                                            
                        {                            
                            xtype: 'wReferencia',
                            fieldLabel: "Referencia",
                            name: "consecutivo",
                            id: "consecutivo",
                            allowBlank: true,
                            impoexpo: 'OTM-DTA',
                            transporte: 'Terrestre',
                            listeners:{
                                select : function( combo, records, idx ){
                                    var form = this.up('form').getForm();
                                    
                                    record=records[0];
                                    data=records[0].data;                                    
                                    Ext.getCmp("idcliente").store.add(
                                        {"compania":data.compania, "idcliente":data.idcliente}
                                    );
                                    Ext.getCmp("vendedor").store.add(
                                        {"login":data.ca_vendedor, "nombre":data.ca_vendedor}
                                    );                                    
                                    form.setValues({
                                        "vendedor":data.ca_vendedor,                                        
                                        "idcliente":data.idcliente,
                                        "numorden":data.orden_clie,
                                        "numpiezas":data.ca_piezas,
                                        "peso":data.ca_peso,
                                        "volumen":data.ca_volumen
                                    });
                                }
                            }
                        }
                        <?
                        }
                        ?>                        
                        ,
                        {
                            xtype: 'wCliente',
                            fieldLabel: "Cliente",
                            name: "idcliente",
                            id: "idcliente",                            
                            allowBlank: false                
                        },
                        {
                            xtype: 'wUsuario',
                            fieldLabel: "Vendedor",
                            name: "vendedor",
                            id: "vendedor",                            
                            allowBlank: false
                        },                        
                        {
                            xtype: "textfield",
                            fieldLabel: "Orden",
                            name: "numorden",
                            allowBlank: false
                        }
                        <?
                        if($modo!=6)
                        {
                        ?>
                        ,
                        {
                            xtype: 'wTercero',
                            fieldLabel: "Proveedor",
                            id: "tercero",
                            name: "tercero",
                            hiddenName: "idtercero",
                            hiddenId: "idtercero",
                            allowBlank:false
                        }
                        <?
                        }
                        ?>
                    ]
                },
                {
                    bodyPadding: 5,
                    anchor: '100%',
                    layout:'column',
                    title:"Información de la carga",
                    defaults:{
                        columnWidth: 1/2,
                        bodyStyle:'padding:3,marging:2',
                        labelAlign:'right'
                    },            
                    items: [
                    <?
                    if($modo!=6)
                    {
                    ?>
                    
                       {
                            xtype: "textfield",
                            fieldLabel: "Doc. Transporte",
                            name:  "doctransporte",
                            allowBlank: false
                        },
                    
                        {
                            xtype: "datefield",
                            fieldLabel: "Fch Doc. Transporte",
                            name:  "fchdoctransporte",
                            format: "Y-m-d",
                            allowBlank: false
                        },
                    <?
                    }
                    ?>
                        {
                            columnWidth: 3/8,
                            xtype: "numberfield",
                            fieldLabel: "Piezas",
                            name:  "numpiezas",
                            id:  "numpiezas",
                            allowNegative: false,
                            allowDecimals: false,
                            allowBlank: false
                            //width:72
                        },
                        {
                            columnWidth: 1/8,
                            xtype: "wParametro",
                            id:'mpiezas',
                            name:'mpiezas',
                            caso_uso:"CU047",
                            width:80,
                            idvalor:"valor",
                            allowBlank: false
                        }
                        /*{
                            columnWidth: 1/8,
                            xtype: "numberfield",
                            //fieldLabel: "Piezas1",
                            name:  "numpiezas1"//,
                            //allowNegative: false,
                            //allowDecimals: false,
                            //allowBlank: false,
                            //width:72
                        }*/,
                        {
                            xtype: "numberfield",
                            fieldLabel: "Peso",
                            name:  "peso",
                            id: "peso",
                            allowNegative: false,
                            decimalPrecision: 3,
                            allowBlank: false
                        },
                        {
                            xtype: 'numberfield',
                            fieldLabel: 'Volumen',
                            id:'volumen',
                            name:'volumen'
                        }
                        
                    ]
                }
            
            ],

            bbar: [{
                    text: 'Guardar',
                    handler: function(){
                        var form = this.up('form').getForm();
                        if(form.isValid()){
                            form.submit({
                                url: '/inoF/formHouseGuardar',
                                waitMsg: 'Guardando',
                                success: function(fp, o) {
                                    //msg('Mensaje', 'Archivo Procesado "' + o.result.file + '" en el servidor');
                                    //Ext.getCmp("tree-grid-file").getStore().reload();
                                    var box = Ext.MessageBox.wait('Procesando', 'Generacion de House')
                                    Ext.getCmp("grid-house").getStore().reload();
                                    box.hide();
                                    //var r = Ext.create('recfac', {
                                    //    comprobante: 'Sin Facturar'//record.get('comprobante')
                                    //});
                                    //store.insert(0, r);
                                    //store.sort();
                                    
                                    Ext.getCmp("winFormEditH").hide();
                                    //location.href=location.href;
                                }
                            });
                        }
                    }
                }],
            cargar: function(idcomprobante)
            {
                
                this.form.load({
                    url:'<?=url_for("inoF/datosFormHousePanel")?>',
                    //waitMsg:'cargando...',
                    params:{
                        idhouse:idcomprobante,
                        modo:'<?=$modo?>'
                    },
                    success: function(fp, o) {
                        //var box = Ext.MessageBox.wait('Cargando', 'Carganado datos de Factura')
                        //Ext.getCmp("grid-facturacion").getStore().reload();
                        //box.hide();
                        //var r = Ext.create('recfac', {
                        //    comprobante: 'Sin Facturar'//record.get('comprobante')
                        //});
                        //store.insert(0, r);
                        //store.sort();

                        //Ext.getCmp("winFormEdit").hide();
                        //location.href=location.href;
                    }                    
                });
            }//,
            /*beforeRender:function()
            {
                //alert("dd")
                //var form = this.up('form').getForm();
                //Ext.getStore("tercero").baseParams={tipo:"Proveedor"};
                
                //alert(Ext.getCmp("tercero").getValue());
                //document.write(Ext.getCmp("tercero").store.toSource());
                //this.store.baseParams={tipo:"Proveedor"};
            }*/
            
                           
})




</script>