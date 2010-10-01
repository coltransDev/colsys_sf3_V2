<?php
/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">  
    EditarTiposComprobantePropiedadesPanel = function( config ) {
        Ext.apply(this, config);

        

        
    
        EditarTiposComprobantePropiedadesPanel.superclass.constructor.call(this, {
            title: 'Propiedades',
            id: 'form-TipoComprobante-panel',
            autoHeight: true,            
            bodyStyle:'padding:5px 5px 0',
            url: '<?=url_for('pm/formTipoComprobanteGuardar')?>',
            fileUpload : true,

            items: [
               
                {
                    xtype:'fieldset',
                    title: 'Detalles',
                    autoHeight:true,                    
                    defaults:{
                        columnWidth:0.5,
                        layout:'form',
                        border:false,
                        bodyStyle:'padding:4px'
                    },
                    items:[

                        {
                            xtype:'textfield',
                            fieldLabel: 'Titulo',
                            name: 'title',
                            anchor:'95%',
                            allowBlank: false
                        },

                        {
                            xtype:'htmleditor',
                            id:'text_id',
                            name:'text',
                            fieldLabel:'Descripción',
                            height:200,
                            anchor:'98%',
                            enableFont: false,
                            enableFontSize: false,
                            enableLinks:  false,
                            enableSourceEdit : false,
                            enableColors : false,
                            enableLists: false,
                            allowBlank: false

                        },
                        
                        {
                            xtype:'hidden',
                            name: 'idTipoComprobante',
                            value: this.idTipoComprobante,
                            anchor:'95%'
                        }
                    ]
                }
            ]
        });

        this.addEvents({add:true});
    }

    Ext.extend(EditarTiposComprobantePropiedadesPanel, Ext.FormPanel, {

       
        

        onRender: function(){
            // call parent
            EditarTiposComprobantePropiedadesPanel.superclass.onRender.apply(this, arguments);

            // set wait message target
            this.getForm().waitMsgTarget = this.getEl();
           
            var actionTipoComprobante =  this.actionTipoComprobante;
            if(this.idTipoComprobante!="undefined" && this.idTipoComprobante!="" )
            {
                this.load({
                    url:'<?=url_for("pm/datosTipoComprobante")?>',
                    waitMsg:'Cargando...',
                    params:{idTipoComprobante:this.idTipoComprobante},

                    success:function(response,options){
                        this.res = Ext.util.JSON.decode( options.response.responseText );

                        /*Ext.getCmp("departamento_id").setRawValue(this.res.data.departamento);
                        Ext.getCmp("departamento_id").hiddenField.value = this.res.data.iddepartament;*/
                        
                    }

                });


            }
        },

        guardar: function(){
            var gridId = this.gridId;
            var panel = Ext.getCmp("form-TipoComprobante-panel");
            var form = panel.getForm();

            var idTipoComprobante = this.idTipoComprobante;

            if( form.isValid() ){
                if( (!Ext.getCmp('proyecto_id').getValue() || !Ext.getCmp('type_id').getValue()) && Ext.getCmp('actionTipoComprobante_id').getValue()=="Cerrado" ){
                    Ext.MessageBox.alert('Error Message', "Es necesario clasificar el TipoComprobante antes de cerrarlo");
                }else{
                    form.submit({
                        success:function(form,action){

                            //Ext.Msg.alert( "Información" );
                            Ext.getCmp("editar-TipoComprobante-win").close();
                            if( !idTipoComprobante ){
                                Ext.MessageBox.alert('Mensaje', 'El TipoComprobante se ha enviado al área correspondiente, el numero de TipoComprobante es: '+action.result.idTipoComprobante);
                            }
                            if( gridId ){
                                Ext.getCmp(gridId).store.reload();
                            }
                        },
                        // standardSubmit: false,
                        failure:function(form,action){
                            Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                        }//end failure block
                    });
                }
            }else{
                Ext.MessageBox.alert('Sistema de TipoComprobantes:', '¡Por favor complete los campos subrayados!');
            }

        }

    
    });

</script>