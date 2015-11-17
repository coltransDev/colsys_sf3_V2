<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */




?>
<script type="text/javascript">

Ext.define('NuevoSeguimientoWindow', {

    extend : 'Ext.window.Window',

    config: {

    },

    constructor: function(config) {
        this.initConfig(config);
        this.callParent(arguments);
    },

    
    initComponent : function() {

        Ext.apply(this, {
            title: 'Nuevo Seguimiento',
            autoHeight: true,
            width: 600,
            id: "nuevo-seguimiento",
            //height: 400,
            resizable: false,
            plain:true,
            modal: true,        
            y: 100,
            autoScroll: true,
            closeAction: 'destroy',            
            items: [
                {
                    xtype: 'form',
                    id: "seguimiento-activo-panel", 
                    border: false,
                    bodyPadding: '10px',
                    items: [{
                            xtype:'hidden',
                            name: 'idcliente',
                            value: this.idcliente
                        },
                        {
                            xtype:'hidden',
                            name: 'idform',
                            value: this.idform
                        },
                        {
                            xtype:'hidden',
                            name: 'idencuesta',
                            value: this.idencuesta
                        },
                        new Ext.create('Ext.form.ComboBox', {
                            fieldLabel: 'Tipo',
                            allowBlank: false,
                            name: 'tipo',
                            store: ['Llamada','Visita','Correo Electrónico','Correspondencia'],                                
                            displayField: 'name'
                        }),
                        {
                            xtype:'htmleditor',
                            fieldLabel: '<span><b>Detalle</b></span>',
                            name:'detalle',
                            height: '100px',
                            enableLists: false,                            
                            enableFont: false,
                            enableFontSize: false,
                            enableLinks:  false,
                            enableSourceEdit : false,
                            enableColors : false,
                            allowBlank: false,                            
                            anchor:'98%'
                            
                        },
                        {
                            xtype:'htmleditor',
                            fieldLabel: '<span><b>Compromiso</b></span>',
                            name:'compromiso',                            
                            enableLists: false,
                            enableFont: false,
                            enableFontSize: false,
                            enableLinks:  false,
                            enableSourceEdit : false,
                            enableColors : false,
                            allowBlank: false,                            
                            anchor:'98%'                            
                        },{
                            xtype:'datefield',
                            fieldLabel: 'Próximo Seguimiento',
                            name : 'fchcompromiso',
                            allowBlank: false,
                            format: 'Y-m-d'
                        }],                 // One header just for show. There's no data,
                    buttons: [{
                        text: 'Save',
                        handler: function(){
                            var panel = Ext.getCmp("seguimiento-activo-panel");
                            var form = panel.getForm();
                            var win = Ext.getCmp("nuevo-seguimiento");
                            
                            if(form.isValid()){
                                form.submit({
                                    url: '<?=url_for("formulario/guardarSeguimiento")?>',
                                    waitMsg: 'Guardando Seguimiento...',                                    
                                    success:function(form,action){

                                       win.close();
                                       var cmp = Ext.getCmp('panel-seguimientos');
                                        if( cmp ){
                                            cmp.body.update(action.result.info);                                                                    
                                        }
                                        Ext.MessageBox.alert('Sistema de Seguimientos','El seguimiento se ha guardado correctamente');
                                   },
                                failure:function(form,action){
                                    Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                                }//end fail
                                });
                            }
                        }
                    },{
                        text: 'Reset',
                        handler: function(){
                            var panel = Ext.getCmp("seguimiento-activo-panel");
                            var form = panel.getForm();
                            form.reset();
                        }
                    }]
                }]
                
        });


        this.callParent(arguments);
    }// initComponent
});

</script>