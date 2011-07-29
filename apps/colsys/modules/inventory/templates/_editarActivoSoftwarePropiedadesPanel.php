<?php
/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


?>
<script type="text/javascript">
    EditarActivoSoftwarePropiedadesPanel = function( config ) {
        Ext.apply(this, config);

        this.buttons = [
            {
                text: 'Guardar',
                handler: this.guardar,
                scope: this
            },
            {
                text: 'Cancelar',
                handler: function(){
                    Ext.getCmp("editar-activo-win").close();
                }
            }
        ];
    
        EditarActivoSoftwarePropiedadesPanel.superclass.constructor.call(this, {
            title: 'Propiedades',
            id: 'form-activo-panel',
            autoHeight: true,
            autoWidth: true,
            
            bodyStyle:'padding:5px 5px 0',
            url: '<?= url_for('inventory/formActivoGuardar') ?>',
            buttons: this.buttons,
            items: [
                {
                    xtype:'hidden',
                    name: 'idactivo',
                    anchor:'95%'
                },
                {
                    xtype:'hidden',
                    name: 'idcategory',
                    value: this.idcategory,
                    anchor:'95%'
                },
                {
                    xtype:'hidden',
                    name: 'idsucursal',
                    value: this.idsucursal,
                    anchor:'95%'
                },
                {
                    xtype:'hidden',
                    name: 'copy',
                    value: this.copy,
                    anchor:'95%'
                },
                {
                    xtype:'tabpanel',
                    title: 'Principal',
                    autoHeight:true,
                    activeTab: 0,
                    deferredRender: false, 
                    items: [
                    {
                        xtype:'fieldset',
                        title: 'Componentes Basicos',
                        autoHeight:true,
                        border:true,
                        layout:'column',
                        columns: 2,
                        width: 890,
                        defaults:{
                            columnWidth:0.5,
                            layout:'form',
                            border:false,
                            bodyStyle:'padding:4px'
                        },
                        items:[{
                                columnWidth:.5,
                                layout: 'form',
                                xtype:'fieldset',
                                defaults:{
                                    width: 130
                                },
                                items: [
                                    {
                                        xtype:'datefield',
                                        fieldLabel: 'Fch. Compra',
                                        name: 'fchcompra',
                                        format: 'Y-m-d',
                                        allowBlank: false
                                    },
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'Factura',
                                        name: 'factura',
                                        allowBlank: false
                                    },
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'Proveedor',
                                        name: 'proveedor',
                                        allowBlank: false
                                    },
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'Marca',
                                        name: 'marca',
                                        allowBlank: false
                                    },
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'Modelo',
                                        name: 'modelo',
                                        allowBlank: false
                                    },
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'Version',
                                        name: 'version',
                                        allowBlank: true
                                    }
                                ]
                            },{
                                columnWidth:.5,
                                layout: 'form',
                                xtype:'fieldset',
                                items: [
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'No Inventario',
                                        name: 'noinventario',
                                        allowBlank: true
                                    },
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'Identificador',
                                        name: 'identificador',
                                        allowBlank: true
                                    },
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'Serial',
                                        name: 'serial',
                                        allowBlank: false
                                    },                                                                        
                                    
                                    {
                                        xtype:'numberfield',
                                        fieldLabel: 'Cantidad',
                                        name: 'cantidad',
                                        allowBlank: false,
                                        value: '1',
                                        allowNegative: false,
                                        allowDecimals: false
                                    },
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'Valor',
                                        name: 'reposicion',
                                        allowBlank: false
                                    }
                                ]
                            }
                            
                        ]
                    },
                
                    //---------------Panel 2-----------                    
                    
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
                                xtype:'htmleditor',
                                name:'contrato',
                                fieldLabel:'Contrato',
                                height:100,
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
                                xtype:'htmleditor',
                                name:'observaciones',
                                fieldLabel:'Observaciones',
                                height:100,
                                anchor:'98%',
                                enableFont: false,
                                enableFontSize: false,
                                enableLinks:  false,
                                enableSourceEdit : false,
                                enableColors : false,
                                enableLists: false,
                                allowBlank: false

                            }
                            
                        ]
                    }
                ]}
            ]
        });

        this.addEvents({add:true});
    }

    Ext.extend(EditarActivoSoftwarePropiedadesPanel, Ext.FormPanel, {

        validarVigencia:function(){
            //alert( this.nivel );
            if( this.nivel==0 || !this.nivel  ){
                this.bloquearCampos();
            }
        },

        

        onRender: function(){
            // call parent
            EditarActivoSoftwarePropiedadesPanel.superclass.onRender.apply(this, arguments);

            // set wait message target
            this.getForm().waitMsgTarget = this.getEl();
            var form = this.getForm();
            if(this.idactivo!="undefined" && this.idactivo )
            {
                this.load({
                    url:'<?= url_for("inventory/datosActivo") ?>',
                    waitMsg:'Cargando...',
                    params:{
                        idactivo:this.idactivo,
                        copy:this.copy
                    },

                    success:function(response,options){
                        this.res = Ext.util.JSON.decode( options.response.responseText );                        
                    }

                });                
            }
        },

        guardar: function( ){
            var panel = Ext.getCmp("form-activo-panel");
            var form = panel.getForm();
            var gridopener = this.gridopener;
            if( form.isValid() ){
                
                form.submit({
                    success:function(form,action){
                        
                        //Ext.Msg.alert( "Informaci�n" );
                        Ext.getCmp("editar-activo-win").close();
                        if( gridopener ){
                            var grid  = Ext.getCmp( gridopener );
                            if( grid ){
                                grid.store.reload();
                            }
                        }

                        
                    },
                    // standardSubmit: false,
                    failure:function(form,action){
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                    }//end failure block
                });
            }else{
                Ext.MessageBox.alert('Sistema de Tickets:', '�Por favor complete los campos subrayados!');
            }

        }

    
    });

</script>