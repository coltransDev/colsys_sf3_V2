Ext.define('Colsys.Users.FormConvivencia', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Users.FormConvivencia',
    bodyPadding: 5,
    url: '/intranet/convivencia/guardarFormulario',
    defaults:{
        columnWidth:0.5,
        bodyStyle:'padding:4px',
        labelWidth:100,
    },    
    items:[{
            xtype: 'Colsys.Widgets.wgUsuario',
            width:350,
            fieldLabel: "Denunciado",
            name: "login",
            id: "login_usuario"
        },{
            xtype:'htmleditor',
            id:'detalle',
            name: "detalle",
            height: 150,
            fieldLabel:'Relaci\u00F3n Detallada de los motivos de la queja'

        },{
            xtype:'htmleditor',
            id:'detalle_add',
            name: "detalle_add",
            height: 150,
            fieldLabel:'Pruebas que demuestran los hechos narrados anteriormente'

        },{
            xtype: 'fileuploadfield',
            id: 'archivo',
            name: 'archivo',
            width: 350,
            fieldLabel: 'Adjuntar Pruebas espec\u00EDficas',
            emptyText: 'Seleccione un archivo',
            buttonCfg: {
                text: '',
                iconCls: 'upload-icon'
            }
        },
        {
            xtype: 'label',
            forId: 'myFieldId',
            text: 'Declaro que los hechos narrados anteriormente son verdaderos, que mi voluntad no ha sido manipulada para realizar el presente reclamo, que estoy dispuesto(a) a sostener estas declaraciones delante del Comit\u00E9 en la fecha que ustedes dispongan para esto, que asistir\u00E9 las reuniones a las que sea citado y que estoy dispuesto(a) adem\u00E1s a escuchar las recomendaciones que el Comit\u00E9 llegare a manifestar respecto al caso comentado.',
            margins: '0 0 0 10'
        }
    ],
    buttons: [{
        text: 'Enviar',
        handler: function() {
            // The getForm() method returns the Ext.form.Basic instance:
            var form = this.up('form').getForm();
            if (form.isValid()) {
                // Submit the Ajax request and handle the response
                form.submit({
                    success: function(form, action) {
                        Ext.MessageBox.alert('Formulario:', '\u00A1El formulario se ha enviado correctamente al Comit\u00E9 de Convivencia\u0021');                            
                        location.href='/intranet/convivencia/verFormulario/login/'+action.result.login+'/id/'+action.result.idform;
                    },
                    failure: function(form, action) {
                        Ext.Msg.alert('Failed', action.result.msg);
                    }
                });
            }else{
                Ext.MessageBox.alert('Formulario:', '¡Por favor complete los campos subrayados!');
            }
        }
    },{
        text: 'Borrar',
        handler: function() {
            var form = formPanel.getForm();
            form.reset();
        }
    }]
   ,    
    listeners: {
        render: function (me, eOpts) {
            var login = this.login;        
        }                
    }
})/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


