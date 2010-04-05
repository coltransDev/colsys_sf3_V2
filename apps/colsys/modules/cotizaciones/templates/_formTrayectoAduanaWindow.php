<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<script type="text/javascript">
    FormTrayectoAduanaWindow = function() {
        FormTrayectoAduanaWindow.superclass.constructor.call(this, {
            width       : 500,            
            closeAction :'close',
            plain       : true,
            modal: true,
            id: 'form-trayecto-window',
            items       : new Ext.FormPanel({
                id: 'producto-form',
                layout: 'form',
                frame: true,
                title: 'Ingrese los datos del trayecto',
                autoHeight: true,
                bodyStyle: 'padding: 5px 5px 0 5px;',
                labelWidth: 100,

                items: [{
                            id: 'idcotizacion',
                            xtype:'hidden',
                            name: 'cotizacionId',
                            value: '<?=$cotizacion->getCaIdcotizacion()?>',
                            allowBlank:false
                        },
                        {
                            id: 'impoexpo',
                            xtype:'hidden',
                            name: 'impoexpo',
                            value: '<?=Constantes::IMPO?>',
                            allowBlank:false
                        },
                        {
                            id: 'transporte',
                            xtype:'hidden',
                            name: 'transporte',
                            value: '<?=Constantes::TERRESTRE?>',
                            allowBlank:false
                        },
                        {
                            id: 'modalidad',
                            xtype:'hidden',
                            name: 'modalidad',
                            value: '<?=Constantes::ADUANAFCL?>',
                            allowBlank:false
                        },
                        {
                            id: 'idproducto',
                            xtype:'hidden',
                            name: 'idproducto',
                            value: '',
                            allowBlank:false
                        },
                        {
                            id: 'incoterms',
                            xtype:'hidden',
                            name: 'incoterms',
                            value: 'FOB - Free On Board',
                            allowBlank:false
                        },
                        {
                            id: 'imprimir',
                            xtype:'hidden',
                            name: 'imprimir',
                            value: 'Por Item',
                            allowBlank:false
                        },
                        {
                            xtype:'textfield',
                            fieldLabel: 'Producto',
                            id: 'producto',
                            name: 'producto',
                            value: '',
                            allowBlank:false,
                            width: 300
                        }
                        ,<?=include_component("widgets", "ciudades" ,array("id"=>"ciu_origen", "label"=>"Ciudad Origen", "idpais"=>"CO-057", "allowBlank"=>"false"))?>
                        ,<?=include_component("widgets", "ciudades" ,array("id"=>"ciu_destino", "label"=>"Ciudad Destino", "idpais"=>"CO-057", "allowBlank"=>"false"))?>
                       ,<?=include_component("widgets", "lineas" ,array("id"=>"idlinea", "label"=>"Linea", "allowBlank"=>"true", "link"=>"transporte" ))?>
                        ,{
                            xtype: 'textarea',
                            width: 310,
                            height: 40,
                            fieldLabel: 'Observaciones',
                            name: 'observaciones',
                            value: '',
                            allowBlank:true
                        },
                        {
                            xtype: 'datefield',
                            width: 100,
                            fieldLabel: 'Vigencia',
                            name: 'vigencia',
                            format: 'Y-m-d',
                            value: '',
                            allowBlank:false
                        }
                    ]



            }),

            buttons: [{
                text     : 'Guardar',
                handler: function(){
                    Ext.getCmp('form-trayecto-window').guardar();
                }
            },{
                text     : 'Cancelar',
                handler: this.close.createDelegate(this, [])
            }]
            

        });

        this.addEvents({add:true});
    }

    Ext.extend(FormTrayectoAduanaWindow, Ext.Window, {


        show : function(){
            if(this.rendered){
                
            }

            FormTrayectoAduanaWindow.superclass.show.apply(this, arguments);
        },



        guardar: function() {
            


            var fp = Ext.getCmp("producto-form");
            if( fp.getForm().isValid() ){

                var win = this;

                fp.getForm().submit({url:'<?=url_for('cotizaciones/formProductoGuardar')?>',
                                        waitMsg:'Salvando Datos de Productos...',
                                        // standardSubmit: false,

                                        success:function(response,options){
                                            //Ext.Msg.alert( "Success "+response.responseText );
                                            storeProductos.reload();
                                            win.close();
                                        },
                                        failure:function(response,options){
                                            Ext.Msg.alert( "Error "+response.responseText );
                                            //win.close();
                                        }//end failure block
                                    });
                
                
                
            }else{
                Ext.MessageBox.alert('Sistema de Cotizaciones - Error:', '¡Atención: La información del Producto no es válida o está incompleta!');
            }

            
        }


    });

</script>