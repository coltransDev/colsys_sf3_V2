<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<script type="text/javascript">
    PanelTrayectoWindow = function() {

        

        PanelTrayectoWindow.superclass.constructor.call(this, {
            title: 'Ingrese los datos del trayecto',
            //id: 'costos-aduana-win',
            autoHeight: true,
            width: 800,
            //height: 600,
            resizable: true,
            plain:true,
            modal: true,
            y: 100,
            autoScroll: true,
            closeAction: 'close',

            buttons:[            
                 {
                    text: 'Guardar',
                    handler: this.guardar,
                    scope: this
                 },
                 {
                    text: 'Cancel',
                    handler: this.close.createDelegate(this, [])
                 }
            ],
            items: new Ext.FormPanel({
                id: 'trayecto-form',
                layout: 'form',
                frame: true,                
                autoHeight: true,
                bodyStyle: 'padding: 5px 5px 0 5px;',
                labelWidth: 100,

                items: [{
                            id: 'idtrayecto',
                            xtype:'hidden',
                            name: 'idtrayecto',
                            value: '',
                            allowBlank:false
                        }
                        ,<?=include_component("widgets", "impoexpo" ,array("id"=>"impoexpo", "label"=>"Impo/Expo"))?>                        
                        ,<?=include_component("widgets", "transportes" ,array("id"=>"transporte", "allowBlank"=>"false"))?>
                        ,<?=include_component("widgets", "modalidades" ,array("id"=>"modalidad", "label"=>"Modalidad", "allowBlank"=>"false", "transporte"=>"transporte", "impoexpo"=>"impoexpo"))?>
                        ,<?=include_component("widgets", "lineas" ,array("id"=>"idlinea", "label"=>"Linea", "allowBlank"=>"false", "link"=>"transporte" ))?>                        
                        ,<?=include_component("widgets", "paises" ,array("id"=>"tra_origen", "label"=>"Pais Origen", "allowBlank"=>"false"))?>
                        ,<?=include_component("widgets", "ciudades" ,array("id"=>"ciu_origen", "label"=>"Ciudad Origen", "link"=>"tra_origen", "allowBlank"=>"false"))?>
                        ,<?=include_component("widgets", "paises" ,array("id"=>"tra_destino", "label"=>" Pais Destino", "value"=>"C0-057", "allowBlank"=>"false"))?>
                        ,<?=include_component("widgets", "ciudades" ,array("id"=>"ciu_destino", "label"=>"Ciudad Destino", "link"=>"tra_destino", "allowBlank"=>"false"))?>                        
                        ,{
                            xtype: 'textarea',
                            width: 310,
                            height: 40,
                            fieldLabel: 'Observaciones',
                            name: 'observaciones',
                            value: '',
                            allowBlank:true
                        }
                        ,{
                            xtype: 'textfield',
                            width: 100,
                            fieldLabel: 'Frecuencia',
                            name: 'frecuencia',
                            value: '',
                            allowBlank:true
                        }
                        ,{
                            xtype: 'textfield',
                            width: 100,
                            fieldLabel: 'T/Transito',
                            name: 'ttransito',
                            value: '',
                            allowBlank:true
                        },
                        {
                            xtype: 'checkbox',
                            width: 100,
                            fieldLabel: 'Activo',
                            name: 'activo',
                            value: '',
                            allowBlank:false
                        }
                    ]
            })
            
        });

        this.addEvents({add:true});
    }

    Ext.extend(PanelTrayectoWindow, Ext.Window, {


        show : function(){
            if(this.rendered){
                
            }

            PanelTrayectoWindow.superclass.show.apply(this, arguments);
        },

        guardar: function() {
           

            var fp = Ext.getCmp("trayecto-form");
            if( fp.getForm().isValid() ){
                
                ttransito = fp.getForm().findField("ttransito").getValue();
                frecuencia = fp.getForm().findField("frecuencia").getValue();
                impoexpo = fp.getForm().findField("impoexpo").getValue();
                transporte = fp.getForm().findField("transporte").getValue();

                if( ttransito=="" && frecuencia=="" && ((impoexpo=="<?=Constantes::IMPO?>" && transporte!="<?=Constantes::AEREO?>") || impoexpo=="<?=Constantes::EXPO?>" ) ){ // Solamente cuando es importación aérea se permite en blanco
                    Ext.MessageBox.alert('Trayectos - Error:', 'Por favor indique el tiempo de transito y la frecuencia');
                }else{
                    var win = this;
                    fp.getForm().submit({url:'<?=url_for('pricing/panelTrayectoGuardar')?>',
                        waitMsg:'Salvando Datos de Productos...',
                        // standardSubmit: false,

                        success:function(form,action){
                            Ext.Msg.alert( "","Se ha guardado correctamente, es necesario actualizar la pagina para ver los cambios." );
                            win.close();
                        },
                        failure:function(form,action){
                            Ext.MessageBox.alert('Error Message', "Se ha presentado un error: "+action.result.errorInfo+" \n Codigo HTTP "+action.response.status);
                        }//end failure block
                   });                                           
                }
                
            }else{
                Ext.MessageBox.alert('Trayectos - Error:', '¡Atención: La información no es válida o está incompleta!');
            }
            

            
        }

       
    });

    </script>