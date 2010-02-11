<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<script type="text/javascript">
    FormTrayectoWindow = function() {

        

        FormTrayectoWindow.superclass.constructor.call(this, {
            width       : 500,
            height      : 650,
            closeAction :'hide',
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
                            id: 'cotizacionId',
                            xtype:'hidden',
                            name: 'cotizacionId',
                            value: '<?=$cotizacion->getCaIdcotizacion()?>',
                            allowBlank:false
                        },{
                            id: 'idproducto',
                            xtype:'hidden',
                            name: 'idproducto',
                            value: '',
                            allowBlank:false
                        },{
                            xtype:'textfield',
                            fieldLabel: 'Producto',
                            id: 'producto',
                            name: 'producto',
                            value: '',
                            allowBlank:false,
                            width: 300
                        }
                        ,<?=include_component("widgets", "impoexpo" ,array("id"=>"impoexpo", "label"=>"Impo/Expo"))?>
                        ,<?=include_component("widgets", "incoterms" ,array("id"=>"incoterms"))?>
                        ,<?=include_component("widgets", "transportes" ,array("id"=>"transporte", "allowBlank"=>"false"))?>

                        ,<?=include_component("widgets", "modalidades" ,array("id"=>"modalidad", "label"=>"Modalidad", "allowBlank"=>"false", "transporte"=>"transporte", "impoexpo"=>"impoexpo"))?>
                        ,<?=include_component("widgets", "lineas" ,array("id"=>"idlinea", "label"=>"Linea", "allowBlank"=>"true", "link"=>"transporte" ))?>
                        ,{
                            xtype:'checkbox',
                            fieldLabel: 'Postular nombre de Linea',
                            id: 'postular_linea',
                            name: 'postular_linea',
                            value: false,
                            width: 300
                        }
                        ,<?=include_component("widgets", "paises" ,array("id"=>"tra_origen", "label"=>"Pais Origen", "allowBlank"=>"false"))?>
                        ,<?=include_component("widgets", "ciudades" ,array("id"=>"ciu_origen", "label"=>"Ciudad Origen", "link"=>"tra_origen", "allowBlank"=>"false"))?>


                        ,<?=include_component("widgets", "paises" ,array("id"=>"tra_destino", "label"=>" Pais Destino", "value"=>"C0-057", "allowBlank"=>"false"))?>
                        ,<?=include_component("widgets", "ciudades" ,array("id"=>"ciu_destino", "label"=>"Ciudad Destino", "link"=>"tra_destino", "allowBlank"=>"false"))?>
                        ,<?=include_component("widgets", "paises" ,array("id"=>"tra_escala", "label"=>"Pais Escala"))?>
                        ,<?=include_component("widgets", "ciudades" ,array("id"=>"ciu_escala", "label"=>"Ciudad Escala", "link"=>"tra_escala"))?>
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
                        }
                        ,
                        new Ext.form.ComboBox({
                            fieldLabel: 'Imprimir',
                            typeAhead: true,
                            forceSelection: true,
                            triggerAction: 'all',
                            emptyText:'',
                            selectOnFocus: true,
                            name: 'imprimir',
                            id: 'imprimir',
                            value: 'Por Item',
                            lazyRender:true,
                            listClass: 'x-combo-list-small',
                            store: [['Por Item', 'Por Item'],['Puerto', 'Puerto'],['Concepto', 'Concepto'],['Trayecto', 'Trayecto']]
                        }),
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
                handler: this.hide.createDelegate(this, [])
            }]
            

        });

        this.addEvents({add:true});
    }

    Ext.extend(FormTrayectoWindow, Ext.Window, {


        show : function(){
            if(this.rendered){
                
            }

            FormTrayectoWindow.superclass.show.apply(this, arguments);
        },



        guardar: function() {
            


            var fp = Ext.getCmp("producto-form");
            if( fp.getForm().isValid() ){
                
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
                            win.hide();
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