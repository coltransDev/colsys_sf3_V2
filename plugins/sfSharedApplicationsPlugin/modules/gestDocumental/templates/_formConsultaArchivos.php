<?
//include_component("widgets5", "wgTipoComprobante");
?>
<script>
 
Ext.define('FormConsultaArchivos', {
    extend: 'Ext.form.Panel',
    title: 'Subir Archivos',
    bodyPadding: 5,
    //standardSubmit: true,
    width: 900,
    url: '<?= url_for("contabilidad/busquedaComprobantes") ?>',

    layout:'column',
    defaults: {
        //anchor: '100%'
        columnWidth: 1/2.5,
        labelAlign:'right',
        width: '170px'
    },

    // The fields
    defaultType: 'textfield',
    onRender: function(ct, position){
     
     tb = new Ext.toolbar.Toolbar({dock: 'bottom'});
     
     if(this.Crear)
     {
        tb.add({
           text: 'Guardar',
           handler: function(){
               var form = this.up('form').getForm();

               var idreg=this.up('form').idreg;
               if(form.isValid()){
                   form.submit({
                       url: '/gestDocumental/subirArchivoTRD',
                       waitMsg: 'Guardando',
                       success: function(fp, o) {
                           msg('Mensaje', 'Archivo Procesado "' + o.result.file + '" en el servidor');
                           Ext.getCmp("grid-archivos"+idreg).getStore().load(
                               {
                                   params : 
                                   {
                                       'ref1' : Ext.getCmp("ref1"+idreg).getValue(),
                                       'idsserie' : Ext.getCmp("idsserie"+idreg).getValue()
                                   }
                               }
                           );                    }
                   });
               }
           }
       });
    }
    
    if(this.Consultar)
    {
        tb.add({
            text: 'Buscar',
            handler: function(){
                form=this.up('form').getForm();
                var nombre=form.findField("nombre").getValue();
                var documento=form.findField("documento").getValue();
                var ref1=form.findField("ref1").getValue();
                var ref2=form.findField("ref2").getValue();
                var ref3=form.findField("ref3").getValue();
                var idsserie=form.findField("idsserie").getValue();
                var storeTree=Ext.getCmp("grid-archivos"+this.up('form').idreg).getStore();
                Ext.Ajax.setTimeout(120000);
                storeTree.load({
                    params : {
                        nombre : nombre,
                        ref1 : ref1,
                        ref2 : ref2,
                        ref3 : ref3,
                        documento : documento,
                        idsserie: idsserie
                    }
                });
            }
        });
    }
    tb.add({    
        text: 'Limpiar',
        handler: function() {
            this.up('form').getForm().reset();
        }
    });
     
     this.addDocked(tb, 'bottom');
     
       this.superclass.onRender.call(this, ct, position);
   }

  /*  bbar: [{
        text: 'Guardar',
        handler: function(){
            var form = this.up('form').getForm();
            
            var idreg=this.up('form').idreg;
            if(form.isValid()){
                form.submit({
                    url: '/gestDocumental/subirArchivoTRD',
                    waitMsg: 'Guardando',
                    success: function(fp, o) {
                        msg('Mensaje', 'Archivo Procesado "' + o.result.file + '" en el servidor');
                        Ext.getCmp("grid-archivos"+idreg).getStore().load(
                            {
                                params : 
                                {
                                    'ref1' : Ext.getCmp("ref1"+idreg).getValue(),
                                    'idsserie' : Ext.getCmp("idsserie"+idreg).getValue()
                                }
                            }
                        );
                        //form.getStore().load({params : {'ref1' : Ext.getCmp("ref1").getValue(),'idsserie' : Ext.getCmp("idsserie").getValue()}});
                        //location.href=location.href;
                    }
                });
            }
        }
    },
    {
        text: 'Buscar',
        handler: function(){
            form=this.up('form').getForm();
            var nombre=form.findField("nombre").getValue();
            var documento=form.findField("documento").getValue();
            var ref1=form.findField("ref1").getValue();
            var ref2=form.findField("ref2").getValue();
            var ref3=form.findField("ref3").getValue();
            var idsserie=form.findField("idsserie").getValue();
            //var idreg=this.up('form').idreg;

            //var storeTree=Ext.getCmp("tree-grid-file"+idreg).getStore();
            //alert(this.up('form').id + "--"+this.up('form').idreg)
            var storeTree=Ext.getCmp("grid-archivos"+this.up('form').idreg).getStore();
            
            storeTree.load({
                params : {
                    nombre : nombre,
                    ref1 : ref1,
                    ref2 : ref2,
                    ref3 : ref3,
                    documento : documento,
                    idsserie: idsserie
                }
            });


        }
    }
    ,
    {
        text: 'Limpiar',
        handler: function() {
            this.up('form').getForm().reset();
        }
    }]  */  
});
 
</script>