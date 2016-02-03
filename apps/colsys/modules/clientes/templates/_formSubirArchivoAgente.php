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

        Ext.define('DatosAgente', {
            extend: 'Ext.data.Model',
            fields: [
                {name: 'id_agente', type: 'string'},
                {name: 'idcliente', type: 'string'}
            ]
        });

        var storeDatosAgente = Ext.create('Ext.data.Store', {
            id: 'storeDatosAgente',
            model: 'DatosAgente'
        });

        Ext.define('formSubirArchivos', {
            extend: 'Ext.form.Panel',
            xtype: 'formSubirArchivos',
            store: storeDatosAgente,
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
                                url: '<?= url_for("gestDocumental/SubirArchivoTRD") ?>',
                                params: {
                                    ref1: form.owner.store.idcliente,
                                    ref2: form.owner.store.id_agente
                                },
                                success: function (response, opts) {
                                    if (opts.result.success) {
                                        Ext.Ajax.request({
                                            url: '<?= url_for("clientes/actualizarDocumentoAgaduana") ?>',
                                            params: {
                                                idcliente: form.owner.store.idcliente,
                                                id_agente: form.owner.store.id_agente,
                                                idarchivo: opts.result.idarchivo
                                            },
                                            failure: function (response, opts) {
                                                Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                                box.hide();
                                            }
                                        });
                                        msg('Mensaje', 'Archivo Procesado "' + opts.result.file + '" en el servidor');
                                        storeTree = Ext.getCmp("tree-grid-file").getStore().reload();
                                    } else {
                                        msg('Error', opts.result.error);
                                    }
                                },
                                failure: function (response, opts) {
                                    Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + opts.response.responseText);
                                    box.hide();
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