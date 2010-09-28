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
            bodyStyle:'padding:5px 5px 0',
            url: '<?=url_for('inventory/formActivoGuardar')?>',            
            buttons: this.buttons,
            items: [
                {
                    xtype:'fieldset',
                    title: 'Componentes Basicos',
                    autoHeight:true,

                    layout:'column',
                    columns: 2,
                    defaults:{
                        columnWidth:0.5,
                        layout:'form',
                        border:false,
                        bodyStyle:'padding:4px'
                    },
                    items:[{
                            columnWidth:.5,
                            layout: 'form',
                            items: [
                                {
                                    xtype:'textfield',
                                    fieldLabel: 'No Inventario',
                                    name: 'noinventario',
                                    allowBlank: true
                                },
                                {
                                    xtype:'textfield',
                                    fieldLabel: 'Marca',
                                    name: 'marca',
                                    allowBlank: true
                                },
                                {
                                    xtype:'textfield',
                                    fieldLabel: 'Version',
                                    name: 'version',
                                    allowBlank: true
                                },
                                {
                                    xtype:'textfield',
                                    fieldLabel: 'Procesador',
                                    name: 'procesador',
                                    allowBlank: true
                                },
                                {
                                    xtype:'textfield',
                                    fieldLabel: 'Disco',
                                    name: 'disco',
                                    allowBlank: true
                                },
                                {
                                    xtype:'textfield',
                                    fieldLabel: 'Ubicación',
                                    name: 'ubicacion',
                                    allowBlank: true
                                },

                                {
                                    xtype:'textfield',
                                    fieldLabel: 'Empresa',
                                    name: 'empresa',
                                    allowBlank: true
                                },
                                {
                                    xtype:'textfield',
                                    fieldLabel: 'Factura',
                                    name: 'factura',
                                    allowBlank: true
                                },
                                {
                                    xtype:'datefield',
                                    fieldLabel: 'Fch. Compra',
                                    name: 'fchcompra',
                                    format: 'Y-m-d',
                                    allowBlank: true
                                },
                                new WidgetUsuario({fieldLabel: 'Asignado a',
                                                   name: 'asignadoa',
                                                   hiddenName: 'asignadoa'
                                                  })
                                

                            ]
                        },{
                            columnWidth:.5,
                            layout: 'form',
                            items: [
                                {
                                    xtype:'textfield',
                                    fieldLabel: 'Identificador',
                                    name: 'identificador',
                                    allowBlank: true
                                },
                                {
                                    xtype:'textfield',
                                    fieldLabel: 'Modelo',
                                    name: 'modelo',                                    
                                    allowBlank: true
                                },
                                {
                                    xtype:'textfield',
                                    fieldLabel: 'Dirección IP',
                                    name: 'ipaddress',
                                    allowBlank: true
                                },
                                {
                                    xtype:'textfield',
                                    fieldLabel: 'Memoria',
                                    name: 'memoria',
                                    allowBlank: true
                                },
                                {
                                    xtype:'textfield',
                                    fieldLabel: 'Un. Optica',
                                    name: 'optica',
                                    allowBlank: true
                                },
                                {
                                    xtype:'textfield',
                                    fieldLabel: 'S.O.',
                                    name: 'so',
                                    allowBlank: true
                                },
                                {
                                    xtype:'textfield',
                                    fieldLabel: 'Proveedor',
                                    name: 'proveedor',
                                    allowBlank: true
                                },
                                {
                                    xtype:'textfield',
                                    fieldLabel: 'Vlr. Reposición',
                                    name: 'reposicion',
                                    allowBlank: true
                                },
                                {
                                    xtype:'textfield',
                                    fieldLabel: 'Serial',
                                    name: 'serial',
                                    allowBlank: true
                                }

                            ]
                        }]
                },
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

                        },                       
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
                        }
                    ]
                }
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
                    url:'<?=url_for("inventory/datosActivo")?>',
                    waitMsg:'Cargando...',
                    params:{idactivo:this.idactivo},

                    success:function(response,options){
                        this.res = Ext.util.JSON.decode( options.response.responseText );
                        var fld = form.findField("asignadoa");
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
                        
                        //Ext.Msg.alert( "Información" );
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
                Ext.MessageBox.alert('Sistema de Tickets:', '¡Por favor complete los campos subrayados!');
            }

        }

    
    });

</script>