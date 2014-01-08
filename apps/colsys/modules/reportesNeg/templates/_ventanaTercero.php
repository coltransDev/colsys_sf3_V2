<?php
/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>

<script language="javascript">

    function nuevoTercero(tipo, fldId) {
        ventanaTercero(tipo, fldId, null);
    }

    function editarTercero(tipo, fldId) {
        var idtercero = document.getElementById(fldId).value;
        ventanaTercero(tipo, fldId, idtercero);
    }

    function eliminarTercero(fldId) {
        document.getElementById(fldId).value = "";
        Ext.getCmp(fldId + "_cmp").setValue("");
        document.getElementById("editar" + fldId).style.display = "none";
        document.getElementById("eliminar" + fldId).style.display = "none";

    }



    function ventanaTercero(tipo, fldId, idtercero) {
        if (idtercero) {
            var titulo = 'Editar ' + tipo;
        } else {
            var titulo = 'Nuevo ' + tipo;
        }
        //crea una ventana
        win = new Ext.Window({
            width: 500,
            //height      : 200,
            closeAction: 'close',
            plain: true,
            items: new Ext.FormPanel({
                id: 'tercero-form',
                //frame: true,
                title: titulo,
                //autoHeight: true,
                //bodyStyle: 'padding: 10px 10px 0 10px;',
                //labelWidth: 50,
                defaultType: 'textfield',
                items: [
                    {
                        name: 'idtercero',
                        xtype: 'hidden',
                        allowBlank: false,
                        width: 300
                    },
                    new Ext.form.TextField({
                        fieldLabel: 'Nombre',
                        name: 'nombre',
                        id: 'nombre',
                        allowBlank: false,
                        width: 300
                    })
                            ,
                    {
                        fieldLabel: 'Identificación',
                        name: 'identificacion',
                        width: 300
                    }
                    ,
                    {
                        fieldLabel: 'Dirección',
                        name: 'direccion',
                        allowBlank: false,
                        width: 300
                    },
                    {
                        fieldLabel: 'Telefono',
                        name: 'telefono',
                        allowBlank: false,
                        width: 300
                    },
                    {
                        fieldLabel: 'Fax',
                        name: 'fax',
                        allowBlank: false,
                        width: 300
                    },
                    {
                        fieldLabel: 'Email',
                        name: 'email',
                        allowBlank: false,
                        width: 300
                    },
                    {
                        fieldLabel: 'Contacto',
                        name: 'contacto',
                        allowBlank: false,
                        width: 300
                    },
<?= include_component("widgets", "paises", array("id" => "tra_ciudad", "label" => "Pais", "allowBlank" => "false")) ?>
                    ,<?= include_component("widgets", "ciudades", array("id" => "ciudad", "label" => "Ciudad", "link" => "tra_ciudad", "allowBlank" => "false")) ?>


                ]
            }),
            buttons: [{
                text: 'Guardar',
                handler: function() {

                    var fp = Ext.getCmp("tercero-form");

                    if (fp.getForm().isValid()) {
                        var idtercero = fp.getForm().findField("idtercero").getValue();
                        var nombre = fp.getForm().findField("nombre").getValue();
                        var identificacion = fp.getForm().findField("identificacion").getValue();
                        var direccion = fp.getForm().findField("direccion").getValue();
                        var telefono = fp.getForm().findField("telefono").getValue();
                        var fax = fp.getForm().findField("fax").getValue();
                        var email = fp.getForm().findField("email").getValue();
                        var contacto = fp.getForm().findField("contacto").getValue();
                        var ciudad = fp.getForm().findField("ciudad").getValue();

                        Ext.Ajax.request(
                                {
                                    waitMsg: 'Guardando cambios...',
                                    url: '<?= url_for("widgets/guardarTercero") ?>/tipo/' + tipo,
                                    //Solamente se envian los cambios
                                    params: {
                                        idtercero: idtercero,
                                        nombre: nombre,
                                        identificacion: identificacion,
                                        direccion: direccion,
                                        telefono: telefono,
                                        fax: fax,
                                        email: email,
                                        contacto: contacto,
                                        ciudad: ciudad,
                                        fldId: fldId
                                    }
                                    ,
                                    //Ejecuta esta accion cuando el resultado es exitoso
                                    callback: function(options, success, response) {
                                        var res = Ext.util.JSON.decode(response.responseText);
                                        if (res.success) {

                                            var fldId = res.fldId;
                                            document.getElementById(fldId).value = res.idtercero;
                                            Ext.getCmp(fldId + "_cmp").setValue(res.nombre);
                                            document.getElementById("editar" + fldId).style.display = "inline";
                                            document.getElementById("eliminar" + fldId).style.display = "inline";
                                        } else {
                                            alert("Ha ocurrido un error al crear el registro");
                                        }
                                        win.close();
                                        //alert( response.responseText );
                                        //r.commit();

                                        //
                                    }
                                }
                        );
                    }
                }
            }, {
                text: 'Cancelar',
                handler: function() {
                    win.close();
                }
            }]
        });

        win.show( );

        if (idtercero) {
            Ext.Ajax.request(
                    {
                        waitMsg: 'Guardando cambios...',
                        url: '<?= url_for("widgets/datosTercero") ?>',
                        //Solamente se envian los cambios
                        params: {
                            idtercero: idtercero
                        }
                        ,
                        //Ejecuta esta accion cuando el resultado es exitoso
                        callback: function(options, success, response) {
                            var res = Ext.util.JSON.decode(response.responseText);
                            var fp = Ext.getCmp("tercero-form");
                            fp.getForm().findField("idtercero").setValue(res.idtercero);
                            fp.getForm().findField("nombre").setValue(res.nombre);
                            fp.getForm().findField("identificacion").setValue(res.identificacion);
                            fp.getForm().findField("direccion").setValue(res.direccion);
                            fp.getForm().findField("telefono").setValue(res.telefonos);
                            fp.getForm().findField("email").setValue(res.email);
                            fp.getForm().findField("fax").setValue(res.fax);
                            fp.getForm().findField("contacto").setValue(res.contacto);

                            fp.getForm().findField("ciudad").setValue(res.idciudad);

                            fp.getForm().findField("tra_ciudad").setValue(res.idtrafico);


                            /*	fp.getForm().findField("tra_origen_id").hiddenField.value = record.data.tra_origen;		*/

                        }
                    });

        }
    }
</script>