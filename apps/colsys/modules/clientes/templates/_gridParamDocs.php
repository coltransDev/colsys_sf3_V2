<?php ?>
<script type="text/javascript">

    Ext.onReady(function () {

        modelEmpresa = Ext.define('ModelParamDocs', {
            extend: 'Ext.data.Model',
            fields: [
                {name: 'id', type: 'string'},
                {name: 'name', type: 'string'}
            ]
        });

        storeEmpresa = Ext.create('Ext.data.Store', {
            id: 'storeEmpresas',
            model: modelEmpresa,
            autoLoad: true,
            proxy: {
                type: 'ajax',
                url: '<?= url_for('clientes/datosEmpresas') ?>',
                reader: {
                    type: 'json',
                    root: 'root'
                },
                filterParam: 'query'
            }
        });

        Ext.define('ComboEmpresa', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-empresa',
            queryMode: 'local',
            valueField: 'id',
            displayField: 'name',
            store: storeEmpresa
        });

        model = Ext.define('ModelParamDocs', {
            extend: 'Ext.data.Model',
            fields: [
                {name: 'ca_id', type: 'string'},
                {name: 'ca_idtipo', type: 'string'},
                {name: 'ca_tipo', type: 'string'},
                {name: 'ca_idempresa', type: 'string'},
                {name: 'ca_perjuridica', type: 'boolean'},
                {name: 'ca_perjuridica_reciente', type: 'boolean'},
                {name: 'ca_perjuridica_activos', type: 'boolean'},
                {name: 'ca_perjuridica_5000', type: 'boolean'},
                {name: 'ca_gran_contribuyente', type: 'boolean'},
                {name: 'ca_persona_natural', type: 'boolean'},
                {name: 'ca_persona_natural_comerciante', type: 'boolean'},
                {name: 'ca_documento', type: 'string'}
            ]
        });
        var store = Ext.create('Ext.data.Store', {
            id: 'storeParamDocs',
            autoLoad: false,
            model: model,
            proxy: {
                type: 'ajax',
                url: '<?= url_for('clientes/datosParamDocs') ?>',
                reader: {
                    type: 'json',
                    root: 'root'
                },
                filterParam: 'query'
            },
        });
        Ext.create('Ext.grid.Panel', {
            title: 'Parametrización de Documentos',
            store: store,
            columns: [
                {
                    text: 'ca_id',
                    dataIndex: 'ca_id',
                    hidden: true

                },
                {
                    text: 'ca_idtipo',
                    dataIndex: 'ca_idtipo',
                    hidden: true
                },
                {
                    text: 'Documento',
                    dataIndex: 'ca_documento',
                    width: 200
                },
                {
                    text: 'ca_tipo',
                    dataIndex: 'ca_tipo',
                    hidden: true
                },
                {
                    text: 'ca_idempresa',
                    dataIndex: 'ca_idempresa',
                    hidden: true
                },
                {
                    text: 'ca_perjuridica',
                    dataIndex: 'ca_perjuridica',
                    width: 180,
                    xtype: 'checkcolumn'
                },
                {
                    text: 'ca_perjuridica_reciente',
                    dataIndex: 'ca_perjuridica_reciente',
                    width: 180,
                    xtype: 'checkcolumn'
                },
                {
                    text: 'ca_perjuridica_activos',
                    dataIndex: 'ca_perjuridica_activos',
                    width: 180,
                    xtype: 'checkcolumn'
                },
                {
                    text: 'ca_perjuridica_5000',
                    dataIndex: 'ca_perjuridica_5000',
                    width: 180,
                    xtype: 'checkcolumn'
                },
                {
                    text: 'ca_gran_contribuyente',
                    dataIndex: 'ca_gran_contribuyente',
                    width: 180,
                    xtype: 'checkcolumn'
                },
                {
                    text: 'ca_persona_natural',
                    dataIndex: 'ca_persona_natural',
                    width: 180,
                    xtype: 'checkcolumn'
                },
                {
                    text: 'ca_persona_natural_comerciante',
                    dataIndex: 'ca_persona_natural_comerciante',
                    width: 180,
                    xtype: 'checkcolumn'
                }
            ],
            buttons: [{
                    text: 'Guardar',
                    handler: function () {
                        changes = [];
                        x = 0;

                        var records = store.getModifiedRecords();
                        for (var i = 0; i < records.length; i++) {
                            r = records[i];
                            records[i].data.id = r.id
                            changes[x] = records[i].data;
                            x++;

                        }
                        var strGrid = JSON.stringify(changes);

                        Ext.Ajax.request({
                            waitMsg: 'Guardando cambios...',
                            url: '<?= url_for('clientes/actualizarParamDocs') ?>',
                            params: {
                                datosGrid: strGrid,
                            },
                            failure: function (response, options) {
                                var res = Ext.util.JSON.decode(response.responseText);
                                if (res.errorInfo)
                                    Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.errorInfo);
                                else
                                    Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                            },
                            success: function (response, options) {
                                var res = Ext.decode(response.responseText);
                                ids = res.ids;
                                if (res.ids) {
                                    for (i = 0; i < ids.length; i++) {
                                        var rec = store.getById(ids[i]);
                                        rec.commit();
                                    }
                                }
                                Ext.MessageBox.alert("Mensaje", 'Información almacenada correctamente<br>');
                            }
                        });

                    }
                }],
            tbar: [{
                    xtype: 'combo-empresa',
                    fieldLabel: 'Empresa',
                    id: 'idempresa'
                }, {
                    xtype: 'button',
                    text: 'Buscar',
                    handler: function () {
                        var idempresa = Ext.getCmp('idempresa').value;
                        store.load({
                            params: {
                                idempresa: idempresa
                            }
                        });
                    }

                }],
            height: 600,
            width: 1210,
            renderTo: Ext.get('se-form')
        });

    });

</script>

