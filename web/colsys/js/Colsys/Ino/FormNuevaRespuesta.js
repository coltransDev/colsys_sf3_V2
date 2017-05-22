


Ext.define('Colsys.Ino.FormNuevaRespuesta', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.FormNuevaRespuesta',
    bodyPadding: 5,
    id: 'nuevarespuesta' + this.idmaster,
    width: 800,
    height: 600,
    listeners: {
        afterrender: function (me, eOpts) {
            this.add({xtype: 'hidden', id: 'idticket', name: 'idticket', value: this.idticket},
                    {
                        xtype: 'ckeditor',
                        id: 'editor',
                        name: 'editor',
                        editorId: 'editor',
                        width: 770,
                        height: 470,
                        CKConfig: {
                            
                            customConfig: 'config.js', // This allows you to define the path to a custom CKEditor config file.
                            //toolbar: 'Full',
                            toolbar: [
                                ['Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll'],
                                ['BidiLtr', 'BidiRtl'], ['Link', 'Unlink'],
                                ['Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript'],
                                ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote', 'CreateDiv'],
                                ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
                                ['Image', 'Flash', 'HorizontalRule', 'Smiley','PageBreak']
                            ],
                            format_tags : 'h1;h2;div'
                        }
                    });
            tb = new Ext.toolbar.Toolbar();

            tb.add(
                    {
                        xtype: 'button',
                        text: 'Guardar',
                        height: 30,
                        iconCls: 'disk',
                        handler: function () {
                            /*for (instance in CKEDITOR.instances) {
                             CKEDITOR.instances[instance].updateElement();
                             }*/
                            console.log(Ext.getCmp('editor'));
                            idmaster = this.up('form').idmaster;
                            /*idmaster = this.up('form').idmaster;
                             idticket = this.up('form').idticket;
                             console.log(Ext.getCmp('editor' + idmaster));
                             texto = Ext.getCmp('editor' + idmaster).getValue();
                             texto = texto.replace(/\&nbsp;/g, ' ');
                             texto=texto.trim();
                             store = this.up('form');*/
                            this.up('form').submit({url: '/inoF2/guardarNuevaRespuesta',
                                params: {
                                    texto: Ext.getCmp('editor').getValue()
                                },
                                success: function () {
                                    Ext.MessageBox.alert("Mensaje", 'Datos Almacenados Correctamente<br>');
                                    Ext.getCmp('winnuevarespuesta' + idmaster).close();
                                    Ext.getCmp('gridrespuestas' + idmaster).store.reload();

                                }});

                        }
                    }

            );
            this.addDocked(tb);




        }
    }


});







