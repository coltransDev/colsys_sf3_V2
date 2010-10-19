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
            url: '<?=url_for('inoparametros/formTipoComprobanteGuardar')?>',
            items: [               
                {
                    xtype:'fieldset',
                    title: 'General',
                    autoHeight:true,                    
                    defaults:{
                        columnWidth:0.5,
                        layout:'form',
                        border:false,
                        bodyStyle:'padding:4px'
                    },
                    items:[
                        {
                            xtype:'hidden',
                            name:'idtipo'
                        },
                        new Ext.form.ComboBox({		
                            fieldLabel: 'Tipo',
                            forceSelection: true,
                            triggerAction: 'all',
                            emptyText:'',
                            name: "tipo",
                            selectOnFocus: true,
                            listClass: 'x-combo-list-small',
                            store:[
                                ["F","F"],
                                ["P","P"]
                            ]
                        })
                        ,
                        {
                            xtype:'numberfield',
                            name:'comprobante',
                            fieldLabel:'Comprobante',
                            allowBlank: false,
                            minValue: 1,
                            maxValue: 25,
                            allowDecimals: false,
                            allowNegative: false
                        },
                        {
                            xtype:'numberfield',                           
                            name:'numeracion_inicial',
                            fieldLabel:'Numeración inicial',                            
                            allowDecimals: false,
                            allowNegative: false
                        },
                        {
                            xtype:'checkbox',
                            name:'text',
                            fieldLabel:'Autonumeración',
                            name: 'autonumeracion'                            
                        },
                        {
                            xtype:'textfield',
                            fieldLabel: 'Titulo',
                            name: 'titulo',
                            anchor:'95%',
                            allowBlank: false
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
            if(this.idtipo!="undefined" && this.idtipo )
            {
                this.load({
                    url:'<?=url_for("inoparametros/datosTipoComprobante")?>',
                    waitMsg:'Cargando...',
                    params:{idtipo:this.idtipo},

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


            if( form.isValid() ){
                
                form.submit({
                    success:function(form,action){
                        //Ext.Msg.alert( "Información" );
                        Ext.getCmp("editar-TipoComprobante-win").close();                        
                        if( gridId ){
                            Ext.getCmp(gridId).store.reload();
                        }
                    },
                    // standardSubmit: false,
                    failure:function(form,action){
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                    }//end failure block
                });
                
            }else{
                Ext.MessageBox.alert('Sistema de TipoComprobantes:', '¡Por favor complete los campos subrayados!');
            }

        }

    
    });

</script>