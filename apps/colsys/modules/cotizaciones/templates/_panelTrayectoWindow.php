<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<script type="text/javascript">
    PanelTrayectoWindow = function( config ) {
        Ext.apply(this,config);
        

        PanelTrayectoWindow.superclass.constructor.call(this, {
            width       : 500,
            autoHeight  : true,
            closeAction :'close',
            plain       : true,
            modal: true,            
            items       : new PanelTrayectoForm({id: 'producto-form',tipo:this.tipo}),
            buttons: [{
                text     : 'Guardar',
                scope: this,
                handler: function(){
                    this.guardar();
                }
            },{
                text     : 'Cancelar',
                handler: this.close.createDelegate(this, [])
            }]            

        });

        //this.addEvents({add:true});
    }

    Ext.extend(PanelTrayectoWindow, Ext.Window, {


        /*show : function(){
            if(this.rendered){
                
            }
            PanelTrayectoWindow.superclass.show.apply(this, arguments);
        },*/

        /*show:function(){alert(this.tipo)},*/
        guardar: function() {
            

            var fp = Ext.getCmp("producto-form");
            if( fp.getForm().isValid() ){
                if(this.tipo=="Trayecto")
                {
                    ttransito = fp.getForm().findField("ttransito").getValue();
                    frecuencia = fp.getForm().findField("frecuencia").getValue();
                    impoexpo = fp.getForm().findField("impoexpo").getValue();
                    transporte = fp.getForm().findField("transporte").getValue();

                    if( ttransito=="" && frecuencia=="" && ((impoexpo=="<?=Constantes::IMPO?>" && transporte!="<?=Constantes::AEREO?>") || impoexpo=="<?=Constantes::EXPO?>" ) ){ // Solamente cuando es importación aérea se permite en blanco
                        Ext.MessageBox.alert('Sistema de Cotizaciones - Error:', 'Por favor indique el tiempo de transito y la frecuencia');
                    }else{
                        this.el.mask('Guardando...', 'x-mask-loading');
                        var win = this;
                        fp.getForm().submit({url:'<?=url_for('cotizaciones/formProductoGuardar')?>',
                            waitMsg:'Salvando Datos de Productos...',
                            // standardSubmit: false,

                            success:function(form,action){
                                storeProductos.reload();
                                win.close();
                            },
                            failure:function(form,action){
                                Ext.MessageBox.alert('Error Message', "Se ha presentado un error: "+action.result.errorInfo+" \n Codigo HTTP "+action.response.status);
                            }//end failure block

                        });
                        this.el.unmask();
                    }
                }
                else if(this.tipo=="OTM/DTA")
                {
                    this.el.mask('Guardando...', 'x-mask-loading');
                    var win = this;
                    fp.getForm().submit({url:'<?=url_for('cotizaciones/formProductoGuardar')?>',
                        waitMsg:'Salvando Datos de Productos...',

                        success:function(form,action){
                            storeProductos.reload();
                            win.close();
                        },
                        failure:function(form,action){
                            Ext.MessageBox.alert('Error Message', "Se ha presentado un error: "+action.result.errorInfo+" \n Codigo HTTP "+action.response.status);
                        }//end failure block

                    });
                    this.el.unmask();
                }
                
            }else{
                Ext.MessageBox.alert('Sistema de Cotizaciones - Error:', '¡Atención: La información del Producto no es válida o está incompleta!');
            }

            
        }


    });

</script>