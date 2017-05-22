<?
//include_component("widgets5", "wgTipoComprobante");
?>
<script>
 
Ext.define('Colsys.Ino.FormMaster', {
    extend: 'Ext.form.Panel',
    alias: 'widget.wCIFMaster',
    title: 'SISTEMA INO',
    bodyPadding: 5,
    //standardSubmit: true,
    width: 1000,
    //url: '<?= url_for("inoF2/datosMaster") ?>',

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
        xtype:'datefield',
        
        fieldLabel: 'Fecha Registro',
        name: 'fchreferencia',
        //id: 'fchreferencia',        
        format: "Y-m-d",
        altFormat: "Y-m-d",        
        submitFormat: 'Y-m-d'
    },
    {
        xtype:'textfield',        
        fieldLabel: 'Reporte',
        name: 'idreporte'//,
        //id: 'idreporte'
    },    
    {
        fieldLabel: 'Tipo',
        name: 'impoexpo',
        //id: 'impoexpo'
    },
    {
        fieldLabel: 'Modalidad',
        name: 'modalidad',
        //id: 'modalidad'
    },
    {
        fieldLabel: 'Origen',
        name: 'idorigen',
        //id: 'idorigen'
    },
    {
        fieldLabel: 'Destino',
        //id:'iddestino',
        name:'iddestino'        
    },
    {
        fieldLabel: 'Proveedor',
        //id:'idlinea',
        name:'idlinea'        
    },
    {
        fieldLabel: 'Agente',
        //id:'idagente',
        name:'idagente'        
    },
    {
        fieldLabel: 'Peso',
        //id:'ca_peso',
        name:'ca_peso'        
    },
    {
        fieldLabel: 'Piezas',
        //id:'ca_piezas',
        name:'ca_piezas'        
    },
    {
        fieldLabel: 'Fecha Salida',
        //id:'ca_fchsalida',
        name:'ca_fchsalida'        
    },
    {
        fieldLabel: 'Volumen',
        //id:'ca_volumen',
        name:'ca_volumen'        
    },
    {
        
        fieldLabel: 'Observaciones',
        //id:'ca_observaciones',
        name:'ca_observaciones'        
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