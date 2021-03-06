<?php
/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


?>
<script type="text/javascript">
    EditarActivoPropiedadesPanel = function( config ) {
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
    
        EditarActivoPropiedadesPanel.superclass.constructor.call(this, {
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
                        columns: 3,
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
                                        xtype:'datefield',
                                        fieldLabel: 'Dado de baja',
                                        name: 'fchbaja',
                                        format: 'Y-m-d',
                                        allowBlank: true
                                    }
                                    
                                ]
                            },{
                                columnWidth:.4,
                                layout: 'form',
                                xtype:'fieldset',
                                items: [   
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'Detalle',
                                        name: 'detalle',                                        
                                        maxLength: 60,        
                                        allowBlank: false
                                    },
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'Identificador',
                                        name: 'identificador',
                                        allowBlank: this.autonumeric,
                                        disabled: this.autonumeric
                                    },
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'Serial',
                                        name: 'serial',
                                        allowBlank: false
                                    },                                                                        
                                    new WidgetUsuario({fieldLabel: 'Asignado a',
                                        name: 'asignadoa_name',
                                        hiddenName: 'asignadoa',
                                        id: 'asignadoa_id'
                                    }),
                                    {
                                        xtype:'numberfield',
                                        fieldLabel: 'Vlr. Reposici?n',
                                        name: 'reposicion',
                                        allowBlank: true,
                                        allowNegative: false
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

    Ext.extend(EditarActivoPropiedadesPanel, Ext.FormPanel, {

        validarVigencia:function(){
            //alert( this.nivel );
            if( this.nivel==0 || !this.nivel  ){
                this.bloquearCampos();
            }
        },

        

        onRender: function(){
            // call parent
            EditarActivoPropiedadesPanel.superclass.onRender.apply(this, arguments);

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
                        var fld = Ext.getCmp("asignadoa_id");
                        fld.setRawValue(this.res.data.asignadoaNombre);
                        fld.hiddenField.value = this.res.data.asignadoa;
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
                        
                        //Ext.Msg.alert( "Informaci?n" );
                        Ext.getCmp("editar-activo-win").close();
                        if( gridopener ){
                            var grid  = Ext.getCmp( gridopener );
                            if( grid ){
                                grid.store.reload();
                            }
                        }
                        
                        if( action.result.identificador ){
                            Ext.MessageBox.alert('', "guardo correctamente con el ID: "+action.result.identificador); 
                        }

                        
                    },
                    // standardSubmit: false,
                    failure:function(form,action){
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                    }//end failure block
                });
            }else{
                Ext.MessageBox.alert('Sistema de Tickets:', '?Por favor complete los campos subrayados!');
            }

        }

    
    });

</script>