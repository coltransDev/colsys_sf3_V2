   <?php
/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>

<script type="text/javascript">
    PanelPreliquidaWindow = function( config ) {
        Ext.apply(this,config);

        PanelPreliquidaWindow.superclass.constructor.call(this, {
            width       : 500,
            autoHeight  : true,
            closeAction :'close',
            plain       : true,
            modal: true,
            title: 'Ingrese los datos del '+this.tipo,
            onEsc: Ext.emptyFn,
            items       : new PanelPreliquidaForm({id: 'parametros-form', tipo:this.tipo}),
            buttons: [{
                    text     : 'Guardar',
                    scope: this,
                    handler: function(){
                        this.guardar();
                    }
                },{
                    text     : 'Cancelar',
                    handler: this.close.createDelegate(this, [])
                }]            

        });
        //this.addEvents({add:true});
    }

    Ext.extend(PanelPreliquidaWindow, Ext.Window, {
        /*show : function(){
            if(this.rendered){
                
            }
            PanelPreliquidaWindow.superclass.show.apply(this, arguments);
        },*/

        /*show:function(){alert(this.tipo)},*/
        guardar: function() {
            var fp = Ext.getCmp("parametros-form");
            if( fp.getForm().isValid() ){
                this.el.mask('Guardando...', 'x-mask-loading');
                var win = this;
                fp.getForm().submit({url:'<?= url_for('cotizaciones/formPreliquidaGuardar') ?>',
                    waitMsg:'Salvando Datos de Productos...',
                    // standardSubmit: false,

                    success:function(form,action){
                        storeParametros.reload();
                        win.close();
                    },
                    failure:function(form,action){
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error: "+action.result.errorInfo+" \n Codigo HTTP "+action.response.status);
                    }//end failure block

                });
                this.el.unmask();
            }else{
                Ext.MessageBox.alert('Sistema de Cotizaciones - Error:', '¡Atención: La información del Producto no es válida o está incompleta!');
            }
        }
    });
</script>