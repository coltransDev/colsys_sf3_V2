<?
//include_component("widgets5", "wgTipoComprobante");
?>
<script>
 
Ext.define('Colsys.Ino.FormBalance', {
    extend: 'Ext.form.Panel',
    alias: 'widget.wCIFMaster',
    title: 'SISTEMA INO',
    bodyPadding: 5,
    //standardSubmit: true,
    width: 1000,    

    layout:'column',
    defaults: {
        //anchor: '100%'
        columnWidth: 1/3,
        labelAlign:'right'
    },

    // The fields
    defaultType: 'textfield',
    items: [
    {        
        xtype:'displayfield',        
        fieldLabel: 'No.Total Piezas',
        name: 'ca_piezas',
        id: 'ca_piezas'
    },
    {
        xtype:'displayfield',        
        fieldLabel: 'Peso Total en Kilos',
        name: 'ca_peso',
        id: 'ca_peso'
    },
    {
        xtype:'displayfield',        
        fieldLabel: 'Volumen Total CBM',
        name: 'ca_volumen',
        id: 'ca_volumen'
    },
    {
        xtype:'displayfield',        
        fieldLabel: 'Total Hbls Registradas',
        name: 'nhbls',
        id: 'nhbls'
    }
    
    
    //new Ext.colsys.wgTipoComprobante({fieldLabel: 'Tipo Comprobante',
    //    name: 'tipo_comprobante'})
    ],
    // Reset and Submit buttons
    buttons: [{
        text: 'Limpiar',
        handler: function() {
            this.up('form').getForm().reset();
        }    
    }],
    listeners: {
        activate: function(ct, position){
            //alert(this.load1)
           if(this.load1==false || this.load1=="undefined" || !this.load1)
           {
                this.form.load({
                    url:'<?=url_for("inoF2/datosMaster")?>',
                    //waitMsg:'cargando...',
                    params:{"idmaster":this.idmaster},
                    success: function(response,options) {
                        var res = Ext.JSON.decode( options.response.responseText );

                        data=res.data;

                       /*if(data.idsucursal!="" && data.idsucursal!="null")
                        {    
                            Ext.getCmp("idsucursal").store.add(
                                {"compania":data.cliente+"-"+data.ciudad, "idcliente":data.idcliente,"idsucursal":data.idsucursal,"cuentapago":data.cuentapago,"ciudad":data.ciudad}
                            );

                            Ext.getCmp("idsucursal").setValue(data.idsucursal);
                        }*/
                    }                    
                });
                this.load1=true;
            }
                    
                 
        }
    }
    
    //renderTo: Ext.getBody()
});
 
</script>