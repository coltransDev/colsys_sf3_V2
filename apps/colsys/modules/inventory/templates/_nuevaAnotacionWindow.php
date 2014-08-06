<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<script type="text/javascript">
NuevaAnotacionWindow = function( config ) {
    Ext.apply(this, config);
    this.ctxRecord = null;
    
    this.subpanel = new Ext.FormPanel({id: "anotacion-activo-panel",
                            url: '<?=url_for('inventory/guardarAnotacion')?>',
                            hideLabel: true,
                            items: [
                              {
                                xtype:'hidden',
                                name: 'idactivo',
                                value: this.idactivo
                              },
                              {
                                xtype:'hidden',
                                name: 'idmantenimiento',
                                value: this.idmantenimiento
                              },
                              {
                                xtype:'htmleditor',
                                name:'text-anotacion',
                                title:'Anotaciones Mantenimiento',
                                hideLabel: true,
                                height:200,
                                anchor:'100%',
                                enableFont: false,
                                enableFontSize: false,
                                enableLinks:  false,
                                enableSourceEdit : false,
                                enableColors : false,
                                enableLists: false,
                                allowBlank: false
                              },
                              {
                                xtype:'checkbox',
                                name: 'idfirma',
                                fieldLabel: '',
                                labelSeparator: '',
                                boxLabel: 'Autorizar firma',
                                checked: false,
                                disabled: this.autorizafirma
                              }]
                       })
                                    
    this.buttons = [
        {
            text: 'Guardar',
            handler: this.guardar,
            scope: this
        },
        {
            text: 'Cancelar',
            handler: this.close.createDelegate(this, [])
        }
     ];

     

    NuevaAnotacionWindow.superclass.constructor.call(this, {
        title: 'Nueva Anotacion # '+this.activo,
        autoHeight: true,
        width: 400,
        //height: 400,
        resizable: false,
        plain:true,
        modal: true,        
        y: 100,
        autoScroll: true,
        closeAction: 'close',
        buttons: this.buttons,
        items: this.subpanel
    });

    this.addEvents({add:true});
}

Ext.extend(NuevaAnotacionWindow, Ext.Window, {


    guardar: function(){
        var panel = Ext.getCmp("anotacion-activo-panel");

        var form = panel.getForm();
        var win = this;

        if( form.isValid() ){

            form.submit({
                success:function(form,action){

                    win.close();
                    
                    var cmp = Ext.getCmp('ext-comp-1024');
                    if( cmp ){
                        cmp.body.update(action.result.info);                        
                    }
                    Ext.MessageBox.alert('Sistema de Activos:', 'La anotación se ha guardado correctamente');
                },
                // standardSubmit: false,
                failure:function(form,action){
                    Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                }//end failure block
            });
        }else{
            Ext.MessageBox.alert('Sistema de Activos:', '¡Por favor complete los campos subrayados!');
        }
        
    }

});

</script>
