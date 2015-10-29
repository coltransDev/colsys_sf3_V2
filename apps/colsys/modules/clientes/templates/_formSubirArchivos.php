<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_component("widgets", "wgDocumentos");
include_component("gestDocumental", "formArchivos");
include_component("gestDocumental", "treeGridFiles");
?>
<script type="text/javascript">
    Ext.onReady(function () {
        var msg = function (title, msg) {
            Ext.Msg.show({
                title: title,
                msg: msg,
                minWidth: 200,
                modal: true,
                icon: Ext.Msg.INFO,
                buttons: Ext.Msg.OK
            });
        };

        Ext.define('formSubirArchivos', {
            extend: 'Ext.form.Panel',
            xtype: 'formSubirArchivos',
            defaults: {
                anchor: '100%',
                allowBlank: false,
                msgTarget: 'side',
                labelWidth: 70
            },
            items: [{
                    xtype: 'textfield',
                    fieldLabel: 'Name',
                    id: 'nombre',
                    name: 'nombre',
                    allowBlank: true
                }, {
                    xtype: 'filefield',
                    id: 'form-file',
                    emptyText: 'Seleccione un archivo',
                    fieldLabel: 'Archivo',
                    name: 'archivo',
                    buttonText: '',
                    buttonConfig: {
                        style: 'position:relative',
                        iconCls: 'upload-icon'
                    }
                }, {
                    xtype: 'wDocumentos',
                    id: 'documento',
                    name: 'documento',
                    fieldLabel: 'Documento',
                    queryMode: 'local',
                    displayField: 'name',
                    valueField: 'id',
                    idsserie: '<?= $idsserie ?>'
                }
            ],
            buttons: [{
                    text: 'Guardar',
                    handler: function () {
                        var form = this.up('form').getForm();
                        if (form.isValid()) {
                            form.submit({
                                waitMsg: 'Guardando',
                                url: '<?= url_for("gestDocumental/subirArchivoTRD") ?>',
                                params: {
                                    ref1: '<?= $id ?>',
                                    ref2: Ext.getCmp("documento").rawValue
                                },
                                success: function (fp, o) {
                                    if (o.result.success) {
                                        msg('Mensaje', 'Archivo Procesado "' + o.result.file + '" en el servidor');
                                        storeTree = Ext.getCmp("tree-grid-file").getStore().reload();
                                    } else {
                                        msg('Error', o.result.error);
                                    }
                                }
                            });
                        }
                    }
                }, {
                    text: 'Reset',
                    handler: function () {
                        this.up('form').getForm().reset();
                    }
                }]

        });

        Ext.define('formTreeArchivos', {
            extend: 'Ext.form.Panel',
            xtype: 'formTreeArchivos',
            frame: true,
            bodyPadding: '10 10 0',
            defaults: {
                anchor: '100%',
                msgTarget: 'side',
            },
            items: [
                {
                    xtype: 'wTreeGridFile',
                    id: 'tree-grid-file',
                    height: 380,
                    name: 'tree-grid-file',
                    title: 'Listado de Archivos'
                }
            ]
        });

    })
</script>