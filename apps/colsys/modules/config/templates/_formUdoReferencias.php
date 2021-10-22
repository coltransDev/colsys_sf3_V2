<script>
    Ext.Loader.setConfig({
        enabled: true,
        paths: {
            'Ext.ux': '../js/ext5/examples/ux/'
        }
    });

    Ext.require([
        'Ext.ux.exporter.Exporter',
        'Ext.ux.Explorer'
    ]);

    Ext.define('FormUdoReferencias', {
        extend: 'Ext.form.Panel',
        title: 'Calcular el UDO de Referencias',
        bodyPadding: 5,
        //standardSubmit: true,
        width: '100%',
        layout: 'column',
        defaults: {
            columnWidth: 1,
            labelAlign: 'right'
        },
        items: [{
                xtype: 'grid',
                fieldLabel: 'Udo',
                height: 500,
                name: 'udo',
                id: 'udo',
                store: Ext.create('Ext.data.Store', {
                    autoLoad: false,
                    remoteSort: false,
                    fields: [
                        {name: 'referencia', type: 'string', mapping: 'referencia'},
                        {name: 'idcliente', type: 'string', mapping: 'idcliente'},
                        {name: 'razonsocial', type: 'string', mapping: 'razonsocial'},
                        {name: 'direccion', type: 'string', mapping: 'direccion'},
                        {name: 'ciudad', type: 'string', mapping: 'ciudad'},
                        {name: 'trafico', type: 'string', mapping: 'trafico'},
                        {name: 'doctransporte', type: 'string', mapping: 'doctransporte'},
                        {name: 'peso_volumen', type: 'string', mapping: 'peso_volumen'},
                        {name: 'participa', type: 'string', mapping: 'participa'}
                    ],
                    proxy: {
                        type: 'memory',
                        reader: {
                            type: 'json',
                            root: 'root'
                        }
                    }
                }),
                columns: [
                    {text: 'Referencia', dataIndex: 'referencia', width: 100},
                    {text: 'ID', dataIndex: 'idcliente'},
                    {text: 'Razon Social', dataIndex: 'razonsocial', flex: 1},
                    {text: 'Direccion', dataIndex: 'direccion', flex: 1},
                    {text: 'Ciudad', dataIndex: 'ciudad'},
                    {text: 'Trafico', dataIndex: 'trafico'},
                    {text: 'Doc.Transporte', dataIndex: 'doctransporte'},
                    {text: 'Peso/Volumen', dataIndex: 'peso_volumen', xtype: 'numbercolumn', format: '0.00', align: 'right'},
                    {text: 'Participa', dataIndex: 'participa', xtype: 'numbercolumn', format: '0.00', align: 'right'},
                ],
                bbar: {
                    id: 'exporter-bnt',
                    xtype: 'exporterbutton',
                    text: 'Exportar a Excel ',
                    title: 'UDO de Referencias',
                    iconCls: 'csv',
                    format: 'csv'
                },
            }, {
                xtype: 'label',
                html: '<br />Seleccione el Archivo'
            }, {
                xtype: 'filefield',
                fieldLabel: 'Archivo',
                name: 'archivo',
                id: 'archivo',
                columnWidth: 1 / 3
            }
        ],

        // Reset and Submit buttons
        buttons: [{
                text: 'Enviar',
                //formBind: true, //only enabled once the form is valid
                //disabled: true,
                handler: function () {
                    /*var form = this.up('form').getForm();
                     if (form.isValid()) {
                     form.submit({
                     success: function(form, action) {
                     Ext.Msg.alert('Success', action.result.html);
                     },
                     failure: function(form, action) {
                     Ext.Msg.alert('Failed', action.result.msg);
                     }
                     });
                     }*/

                    this.up('form').getForm().submit(
                            {
                                url: '<?= url_for("config/udoReferencias") ?>',
                                scope: this,
                                waitMsg: 'Uploading...',
                                success: function (formPanel, action) {
                                    var data = Ext.decode(action.response.responseText);
                                    Ext.getCmp('udo').getStore().loadData(data.root);
                                },
                                failure: function (formPanel, action) {
                                    var data = Ext.decode(action.response.responseText);
                                    alert("Failure: " + data.msg);
                                }
                            }
                    );

                    /*var fecha_inicial=Ext.getCmp("fecha_inicial").getRawValue();
                     var fecha_final=Ext.getCmp("fecha_final").getRawValue();
                     var no_comprobante=Ext.getCmp("no_comprobante").getValue();
                     var idtipocomprobante=Ext.getCmp("idtipocomprobante").getValue();
                     var ca_referencia=Ext.getCmp("ca_referencia").getValue();
                     var no_comprobante2=Ext.getCmp("no_comprobante2").getValue();
                     var ca_estado=Ext.getCmp("ca_estado").getValue();
                     
                     var storeTree=Ext.getCmp("grid-consulta-comprobantes").getStore();
                     storeTree.load({
                     params : {
                     'fecha_inicial' : fecha_inicial,
                     'fecha_final' : fecha_final,
                     'ca_referencia' : ca_referencia,
                     'no_comprobante' : no_comprobante,
                     'no_comprobante2' : no_comprobante2,
                     'idtipocomprobante' : idtipocomprobante,
                     'ca_estado': ca_estado
                     }
                     });*/

                }
            }]//,
                //renderTo: Ext.getBody()
    });

</script>