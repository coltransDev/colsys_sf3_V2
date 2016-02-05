<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$idcliente = $sf_data->getRaw("idcliente");
$data = $sf_data->getRaw("data");
$documentacion = $sf_data->getRaw("documentacion");

$transporte = $sf_data->getRaw("transporte");
?>
<style> 
    .verticaltab {    
        .x-tab-wrap{
            position: absolute;
            display: block;
            padding-left: 20px;
            transform: rotate(90deg);
        }

        .x-tab-button{
            position: absolute;
            display: block;
            padding-left: 0px;
            padding-top: 2px;
        }
    }
</style>
<script type="text/javascript">
    var win_file = null;
    var win_encuesta = null;
    var win_header = null;
    Ext.define('FichaTecnica', {
        extend: 'Ext.data.Model',
        fields: [
            /////////CONDICIONES ESPECIALES/////////////////
            {name: 'tipoCE', type: 'string'},
            {name: 'codigoCE', type: 'string'},
            {name: 'nroresolucionCE', type: 'string'},
            {name: 'fchvencimientoRCE', type: 'string'},
            {name: 'nropolizaCE', type: 'string'},
            {name: 'fchvencimientoPCE', type: 'string'},
            {name: 'cierreCE', type: 'string'},
            {name: 'bancoCE', type: 'string'},
            ///////////MANDATOS Y SEGURO/////////////////////
            {name: 'ciaaseguradoraMS', type: 'string'},
            {name: 'porcentajeMS', type: 'string'},
            {name: 'vigenciaMS', type: 'string'},
            /////////DOCUMENTACION///////////////
            {name: 'registro_importacionColmas', type: 'string'},
            {name: 'registro_importacionOtro', type: 'string'},
            {name: 'registro_importacionAP', type: 'string'},
            {name: 'instrucciones', type: 'string'},
            {name: 'envio_faccomercial', type: 'string'},
            {name: 'envio_listaempaque', type: 'string'},
            {name: 'envio_certorigen', type: 'string'},
            {name: 'envio_certsanitarios', type: 'string'},
            {name: 'envio_certfitozoo', type: 'string'},
            {name: 'instrucciones_detalle', type: 'string'},
            ////////////MANEJO DE MERCANCIAS////////////
            {name: 'operacion_zonafrancaMM', type: 'string'},
            {name: 'deposito_zonafrancaMM', type: 'string'},
            {name: 'dtaMM', type: 'string'},
            {name: 'otmMM', type: 'string'},
            {name: 'descargue_directoMM', type: 'string'},
            {name: 'anticipadaMM', type: 'string'},
            {name: 'preinspeccionesMM', type: 'string'},
            {name: 'serialesMM', type: 'string'},
            {name: 'desembalajeMM', type: 'string'},
            {name: 'sanidadMM', type: 'string'},
            {name: 'productosMM', type: 'string'},
            {name: 'averiasMM', type: 'string'},
            ////////////MANEJO DE MERCANCIAS 2/////////
            {name: 'ajustadoresMM', type: 'string'},
            {name: 'funcionarioMM', type: 'string'},
            {name: 'representante_clienteMM', type: 'string'},
            {name: 'segurosMM', type: 'string'},
            {name: 'fotograficosMM', type: 'string'},
            {name: 'controladosMM', type: 'string'},
            {name: 'coord_despachoMM', type: 'string'},
            {name: 'escoltaMM', type: 'string'},
            {name: 'poliza_transporteMM', type: 'string'},
            {name: 'horario_reciboMM', type: 'string'},
            {name: 'instrucciones_especialesMM', type: 'string'},
            ///////////////SOLICITUD DE FONDOS O ANTICIPOS///////
            {name: 'portuariosSF', type: 'string'},
            {name: 'almacenajesSF', type: 'string'},
            {name: 'fleteSF', type: 'string'},
            {name: 'transporteSF', type: 'string'},
            {name: 'icainvimaSF', type: 'string'},
            {name: 'otrosgastosSF', type: 'string'},
            {name: 'tributosSF', type: 'string'},
            {name: 'ingresosSF', type: 'string'},
            {name: 'bancosSF', type: 'string'},
            /////////////FACTURACION////////////////////////
            {name: 'fechascierreF', type: 'string'},
            {name: 'soportesF', type: 'string'},
            {name: 'plazoF', type: 'string'},
            {name: 'creditoF', type: 'string'},
            {name: 'diasF', type: 'string'},
            {name: 'cupoF', type: 'string'},
            {name: 'fondoanticipoF', type: 'string'},
            {name: 'valorF', type: 'string'},
            {name: 'pagoF', type: 'string'},
            {name: 'bancoF', type: 'string'},
            {name: 'transferenciaF', type: 'string'},
            {name: 'plazotransferenciaF', type: 'string'},
            {name: 'chequeF', type: 'string'},
            {name: 'consignacionF', type: 'string'},
            {name: 'pagoelectronicoF', type: 'string'},
            {name: 'contactoareaF', type: 'string'},
            {name: 'telefonoF', type: 'string'},
            {name: 'correoF', type: 'string'},
            ////////////////OTROS CONTACTOS///////////////////
            {name: 'nombre_deposito', type: 'string'},
            {name: 'contacto_deposito', type: 'string'},
            {name: 'tel_deposito', type: 'string'},
            {name: 'convenio_deposito', type: 'string'},
            {name: 'nombre_operador', type: 'string'},
            {name: 'contacto_operador', type: 'string'},
            {name: 'tel_operador', type: 'string'},
            {name: 'convenio_operador', type: 'string'},
            {name: 'nombre_empresanu', type: 'string'},
            {name: 'contacto_empresanu', type: 'string'},
            {name: 'tel_empresanu', type: 'string'},
            {name: 'convenio_empresanu', type: 'string'},
            {name: 'nombre_empresasve', type: 'string'},
            {name: 'contacto_empresasve', type: 'string'},
            {name: 'tel_empresasve', type: 'string'},
            {name: 'convenio_empresasve', type: 'string'},
            ///////////////////REPORTES E INFORMES/////////////
            {name: 'indicadoresRE', type: 'string'},
            {name: 'estadoRE', type: 'string'},
            {name: 'reporteRE', type: 'string'},
            {name: 'informesRE', type: 'string'},
            {name: 'declaracionesRE', type: 'string'}
        ]
    });

    Ext.define('FichaTecnicaTI', {
        extend: 'Ext.data.Model',
        fields: [
            /////////TRANSPORTE INTERNACIONAL//////////
            {name: 'filaNumero', type: 'string'},
            {name: 'tipoI', type: 'string'},
            {name: 'nombre_tipotransporteI', type: 'string'},
            {name: 'convenioI', type: 'string'},
            {name: 'contactoI', type: 'string'},
            {name: 'telefonoI', type: 'string'},
            {name: 'pagofletesI', type: 'string'},
            {name: 'dropoffI', type: 'string'},
            {name: 'contenedorvacioI', type: 'string'}
        ]
    });

    var storeFichaTecnicaTI = Ext.create('Ext.data.Store', {
        id: 'storeFichaTecnica',
        autoLoad: true,
        model: 'FichaTecnicaTI',
        proxy: {
            type: 'ajax',
            url: '<?= url_for('clientes/datosTransporteFichaTecnica') ?>',
            reader: {
                type: 'json',
                root: 'root'
            },
            extraParams: {
                idcliente: <?= $idcliente ?>
            },
            filterParam: 'query',
        }
    });

    var cellEditing = Ext.create('Ext.grid.plugin.CellEditing', {
        clicksToEdit: 1
    });

    Ext.define('ComboTipoTI', {
        extend: 'Ext.form.field.ComboBox',
        alias: 'widget.combo-tipoTI',
        store: ['Agente de Carga', 'Naviera', 'Aerolinea', 'Transporte Terrestre']
    });

    Ext.define('ComboTipoCe', {
        extend: 'Ext.form.field.ComboBox',
        alias: 'widget.combo-tipo-ce',
        store: ['UAP', 'ALTEX']
    });

    var formTransporteInternacional = Ext.create('Ext.form.Panel', {
        bodyPadding: 5,
        defaults: {
            anchor: '100%',
            labelWidth: 50,
            defaultType: 'container',
            collapsible: false,
        },
        layout: 'column',
        items: [{
                xtype: 'fieldset',
                columnWidth: 1,
                title: 'Datos Agente de Carga',
                defaults: {anchor: '100%'},
                layout: 'anchor',
                items: [{
                        xtype: 'hiddenfield',
                        name: 'filaNumero'
                    }, {
                        xtype: 'combo-tipoTI',
                        fieldLabel: 'Tipo',
                        forceSelection: true,
                        name: 'tipoI'
                    }, {
                        xtype: 'textfield',
                        fieldLabel: 'Nombre',
                        name: 'nombre_tipotransporteI'
                    }, {
                        xtype: 'textfield',
                        fieldLabel: 'Convenio',
                        name: 'convenioI'
                    }, {
                        xtype: 'textfield',
                        fieldLabel: 'Contacto',
                        name: 'contactoI'
                    }, {
                        xtype: 'textfield',
                        fieldLabel: 'Telefono',
                        name: 'telefonoI'
                    }, {
                        xtype: 'checkboxgroup',
                        name: '',
                        fieldLabel: 'Pago de Fletes',
                        labelWidth: 110,
                        vertical: false,
                        listeners: {
                            change: function (newValue, oldValue, eOpts) {
                                if (newValue.lastValue.pagofletesI == 1) {
                                    Ext.getCmp("dropoffI").setVisible(false);
                                    Ext.getCmp("contenedorvacioI").setVisible(false);
                                    Ext.getCmp("dropoffI").reset();
                                    Ext.getCmp("contenedorvacioI").reset();
                                } else {
                                    Ext.getCmp("dropoffI").setVisible(true);
                                    Ext.getCmp("contenedorvacioI").setVisible(true);
                                }
                            }
                        },
                        items: [
                            {boxLabel: '', name: 'pagofletesI', inputValue: '1', width: 60},
                        ]
                    }, {
                        xtype: 'checkboxgroup',
                        name: '',
                        id: 'dropoffI',
                        fieldLabel: 'Drop Off',
                        labelWidth: 110,
                        vertical: false,
                        items: [
                            {boxLabel: '', name: 'dropoffI', inputValue: '1', width: 60}
                        ]
                    }, {
                        xtype: 'checkboxgroup',
                        name: '',
                        id: 'contenedorvacioI',
                        fieldLabel: 'Devol. contenedor vacio',
                        labelWidth: 110,
                        vertical: false,
                        items: [
                            {boxLabel: '', name: 'contenedorvacioI', inputValue: '1', width: 60}
                        ]
                    }]
            }
        ],
        buttons: [{
                text: 'Guardar',
                handler: function () {
                    var me = this;
                    var form = me.up('form').getForm();
                    var data = form.getFieldValues();
                    if (form.isValid()) {
                        if (data.filaNumero) {
                            var store = storeFichaTecnicaTI;
                            rec = store.findRecord('filaNumero', data.filaNumero);
                            rec.data.tipoI = data.tipoI;
                            rec.data.nombre_tipotransporteI = data.nombre_tipotransporteI;
                            rec.data.convenioI = data.convenioI;
                            rec.data.telefonoI = data.telefonoI;
                            rec.data.contactoI = data.contactoI;
                            rec.data.pagofletesI = data.pagofletesI;
                            rec.data.dropoffI = data.dropoffI;
                            rec.data.contenedorvacioI = data.contenedorvacioI;
                            store.commitChanges();
                        } else {
                            var store = storeFichaTecnicaTI;
                            var tam = store.getCount();
                            store.add({
                                filaNumero: tam,
                                tipoI: data.tipoI,
                                nombre_tipotransporteI: data.nombre_tipotransporteI,
                                convenioI: data.convenioI,
                                telefonoI: data.telefonoI,
                                contactoI: data.contactoI,
                                pagofletesI: data.pagofletesI,
                                dropoffI: data.dropoffI,
                                contenedorvacioI: data.contenedorvacioI
                            });
                        }
                        this.findParentByType('window').close();
                    }
                }
            }, {
                text: 'Cancelar',
                handler: function () {
                    this.findParentByType('window').close();
                }
            }]
    });

    Ext.define('ComboSiNo', {
        extend: 'Ext.form.field.ComboBox',
        alias: 'widget.combo-si-no',
        store: ['SI', 'NO']
    });
    Ext.define('ComboDeclaraciones', {
        extend: 'Ext.form.field.ComboBox',
        alias: 'widget.combo-declaraciones',
        store: ['Diario', 'Semanal', 'Pago', 'Levante']
    });

    var storeFichaTecnica = Ext.create('Ext.data.Store', {
        id: 'storeFichaTecnica',
        autoLoad: false,
        model: 'FichaTecnica',
        proxy: {
            type: 'ajax',
            url: '<?= url_for('clientes/datosFichaTecnica') ?>',
            reader: {
                type: 'json',
                root: 'root'
            },
            extraParams: {
                idcliente: '<?= $idcliente ?>'
            },
            filterParam: 'query',
        }
    });

    var tabTransporteInternacional = new Ext.define('GridTI', {
        extend: 'Ext.form.Panel',
        xtype: 'tabTransporteInternacional',
        style: 'display:inline-block;text-align:center;',
        frame: false,
        bodyPadding: 5,
        initComponent: function () {
            Ext.apply(this, {
                width: 800,
                height: 370,
                // style: 'display:inline-block;text-align:center',
                fieldDefaults: {
                    labelAlign: 'left',
                    labelWidth: 90,
                    anchor: '100%',
                    msgTarget: 'side'
                },
                items: [{
                        xtype: 'gridpanel',
                        id: 'gridTI',
                        store: storeFichaTecnicaTI,
                        height: 400,
                        columns: [{
                                text: 'Tipo',
                                sortable: true,
                                width: 150,
                                dataIndex: 'tipoI'
                            }, {
                                text: 'Nombre',
                                flex: 1,
                                sortable: true,
                                dataIndex: 'nombre_tipotransporteI'
                            }, {
                                text: 'Contacto',
                                flex: 1,
                                sortable: true,
                                dataIndex: 'contactoI'
                            }, {
                                text: 'Telefono',
                                width: 150,
                                sortable: true,
                                dataIndex: 'telefonoI'
                            }, {
                                menuDisabled: true,
                                sortable: false,
                                xtype: 'actioncolumn',
                                width: 40,
                                items: [{
                                        iconCls: 'page_white_edit',
                                        tooltip: 'Editar el Registro',
                                        handler: function (grid, rowIndex, colIndex) {
                                            var rec = grid.getStore().getAt(rowIndex);
                                            rec.data.filaNumero = rowIndex;
                                            if (win_header == null) {
                                                win_header = new Ext.Window({
                                                    id: 'winTransporteInternacional',
                                                    title: 'Datos',
                                                    width: 600,
                                                    height: 370,
                                                    closeAction: 'close',
                                                    items: {
                                                        xtype: formTransporteInternacional
                                                    }
                                                })
                                            }
                                            win_header.down('form').loadRecord(rec);
                                            win_header.show();
                                        }
                                    }, {
                                        iconCls: 'delete',
                                        tooltip: 'Eliminar el Registro',
                                        handler: function (grid, rowIndex, colIndex) {
                                            var rec = grid.getStore().getAt(rowIndex);
                                            Ext.MessageBox.confirm('Confirmación de Eliminación', 'Está seguro que desea borrar el registro?', function (choice) {
                                                if (choice == 'yes') {
                                                    var store = storeFichaTecnicaTI;
                                                    store.remove(rec);
                                                }
                                            });
                                        }
                                    }]
                            }], dockedItems: [{
                                xtype: 'toolbar',
                                items: [{
                                        text: 'Adicionar',
                                        tooltip: 'Adicionar un registro',
                                        iconCls: 'add',
                                        scope: this,
                                        handler: function () {

                                            if (win_header == null) {
                                                win_header = new Ext.Window({
                                                    id: 'winTransporteInternacional',
                                                    title: 'Datos',
                                                    width: 600,
                                                    height: 370,
                                                    closeAction: 'close',
                                                    items: {
                                                        xtype: formTransporteInternacional
                                                    }
                                                })
                                            }
                                            var form = formTransporteInternacional;
                                            form.getForm().reset();
                                            win_header.show();
                                        }
                                    }]
                            }], selType: 'cellmodel',
                        plugins: [
                            Ext.create('Ext.grid.plugin.CellEditing', {
                                clicksToEdit: 1
                            })
                        ],
                        listeners: {
                            scope: this,
                            selectionchange: this.onSelectionChange
                        }
                    }]
            });
            this.callParent();

        },
        changeRenderer: function (val) {
            if (val > 0) {
                return '<span style="color:green;">' + val + '</span>';
            } else if (val < 0) {
                return '<span style="color:red;">' + val + '</span>';
            }
            return val;
        },
        pctChangeRenderer: function (val) {
            if (val > 0) {
                return '<span style="color:green;">' + val + '%</span>';
            } else if (val < 0) {
                return '<span style="color:red;">' + val + '%</span>';
            }
            return val;
        },
        renderRating: function (val) {
            switch (val) {
                case 0:
                    return 'A';
                case 1:
                    return 'B';
                case 2:
                    return 'C';
            }
        },
        onSelectionChange: function (model, records) {
            var rec = records[0];
            if (rec) {
                this.getForm().loadRecord(rec);
            }
        }
    });

    var gridFichaTecnica = new Ext.grid.GridPanel({
        id: 'gridFichaTecnica',
        height: 400,
        width: 650,
        columns: [{
                header: 'Documento',
                width: 300,
                dataIndex: 'documento',
                hideable: false,
                summaryType: 'count',
                summaryRenderer: function (value, summaryData, dataIndex) {
                    return ((value === 0 || value > 1) ? '(' + value + ' Documentos)' : '(1 Documento)');
                }
            }, {
                header: 'Fecha Documento',
                flex: 1,
                width: 100,
                dataIndex: 'fch_documento',
                renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                editor: new Ext.form.DateField({
                    width: 90,
                    allowBlank: false,
                    format: 'Y-m-d',
                    useStrict: undefined
                })
            }, {
                header: 'Fecha de Vigencia',
                flex: 1,
                width: 100,
                dataIndex: 'fch_vigencia',
                renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                editor: new Ext.form.DateField({
                    width: 90,
                    allowBlank: false,
                    format: 'Y-m-d',
                    useStrict: undefined
                })
            }, {
                header: 'Observaciones',
                flex: 1,
                width: 120,
                dataIndex: 'observaciones',
                editor: {
                    xtype: 'textfield',
                    originalValue: '',
                    allowBlank: true
                }
            }
        ],
        selType: 'cellmodel',
        plugins: [
            Ext.create('Ext.grid.plugin.CellEditing', {
                clicksToEdit: 1
            })
        ],
        bbar: Ext.create('Ext.PagingToolbar', {
            displayInfo: true,
            displayMsg: 'Registros {0} - {1} of {2}',
            emptyMsg: "No hay registros"
        })
    });

    Ext.onReady(function () {

        var tabPanel = new Ext.tab.Panel({
            id: 'panelFichaTecnica',
            //cls:'verticaltab',
            /*tabBar: {
             defaults: {
             layout: 'column',
             style: {
             float: 'left'
             },
             height: 24,  //basic height
             margin: '0 4 8' //basic margins - all elements are floated to left without bottom margin
             },
             overflowX: 'scroll',
             width: 340,
             multirows: true,
             minTabWidth: 330,
             maxTabWidth: 330,
             height:100,                
             orientation: 'horizontal'
             },
             tabPosition: 'top',
             */
            //plain: true,
            items: [{
                    title: 'Clasificacion y Registros',
                    items: [{
                            xtype: 'fieldset',
                            hideLabel: true,
                            width: 980,
                            collapsible: false,
                            layout: 'hbox',
                            items: [{
                                    xtype: 'fieldset',
                                    hideLabel: true,
                                    width: 490,
                                    collapsible: false,
                                    defaults: {
                                        labelWidth: 89,
                                        anchor: '90%',
                                        layout: {
                                            type: 'column',
                                            defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                        }},
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            hideLabel: false,
                                            label: 'Condiciones Especiales',
                                            combineErrors: true,
                                            height: 360,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 1,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'fieldset',
                                                    title: 'Condiciones Especiales',
                                                    width: 450,
                                                    height: 300,
                                                    collapsible: false,
                                                    items: [{
                                                            xtype: 'fieldcontainer',
                                                            hideLabel: true,
                                                            combineErrors: true,
                                                            width: 420,
                                                            height: 300,
                                                            msgTarget: 'under',
                                                            layout: 'column',
                                                            defaults: {
                                                                flex: 1,
                                                                hideLabel: false
                                                            },
                                                            items: [{
                                                                    xtype: 'combo-tipo-ce',
                                                                    name: 'tipoCE',
                                                                    fieldLabel: 'Tipo',
                                                                    width: 215,
                                                                    labelWidth: 80,
                                                                    listeners: {
                                                                        change: function (field, newValue, oldValue) {
                                                                            if (newValue.toString() == "UAP") {
                                                                                Ext.getCmp("cierreCE").setVisible(true);
                                                                                Ext.getCmp("bancoCE").setVisible(true);
                                                                            }
                                                                            if (newValue.toString() == "ALTEX") {
                                                                                Ext.getCmp("cierreCE").setVisible(false);
                                                                                Ext.getCmp("bancoCE").setVisible(false);
                                                                            }
                                                                        }

                                                                    }

                                                                }, {
                                                                    style: 'display:inline-block;text-align:center',
                                                                    xtype: 'textfield',
                                                                    hideLabel: false,
                                                                    labelAlign: 'left',
                                                                    fieldLabel: 'Código',
                                                                    labelWidth: 70,
                                                                    name: 'codigoCE',
                                                                    width: 205,
                                                                }, {
                                                                    xtype: 'tbspacer',
                                                                    height: 15
                                                                }, {
                                                                    style: 'display:inline-block;text-align:left',
                                                                    xtype: 'textfield',
                                                                    hideLabel: false,
                                                                    labelAlign: 'left',
                                                                    fieldLabel: 'Número de resolución',
                                                                    labelWidth: 90,
                                                                    name: 'nroresolucionCE',
                                                                    width: 220,
                                                                }, {
                                                                    xtype: 'datefield',
                                                                    hideLabel: false,
                                                                    labelAlign: 'left',
                                                                    fieldLabel: 'Vencimiento',
                                                                    labelWidth: 90,
                                                                    format: 'Y-m-d',
                                                                    name: 'fchvencimientoRCE',
                                                                    id: 'fchvencimientoRCE',
                                                                    width: 200,
                                                                }, {
                                                                    xtype: 'tbspacer',
                                                                    height: 15
                                                                }, {
                                                                    style: 'display:inline-block;text-align:left',
                                                                    xtype: 'textfield',
                                                                    hideLabel: false,
                                                                    labelAlign: 'left',
                                                                    fieldLabel: 'Número Póliza',
                                                                    labelWidth: 90,
                                                                    name: 'nropolizaCE',
                                                                    width: 220,
                                                                }, {
                                                                    style: 'display:inline-block;text-align:center',
                                                                    xtype: 'datefield',
                                                                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                                                                    format: 'Y-m-d',
                                                                    hideLabel: false,
                                                                    labelAlign: 'left',
                                                                    fieldLabel: 'Vencimiento',
                                                                    labelWidth: 90,
                                                                    name: 'fchvencimientoPCE',
                                                                    id: 'fchvencimientoPCE',
                                                                    width: 200,
                                                                }, {
                                                                    xtype: 'tbspacer',
                                                                    height: 15
                                                                }, {
                                                                    style: 'display:inline-block;text-align:left',
                                                                    xtype: 'textfield',
                                                                    hideLabel: false,
                                                                    id: 'cierreCE',
                                                                    labelAlign: 'left',
                                                                    fieldLabel: 'Fechas de cierre',
                                                                    labelWidth: 90,
                                                                    name: 'cierreCE',
                                                                    width: 220,
                                                                }, {
                                                                    style: 'display:inline-block;text-align:center',
                                                                    xtype: 'textareafield',
                                                                    id: 'bancoCE',
                                                                    hideLabel: false,
                                                                    labelAlign: 'left',
                                                                    fieldLabel: 'Bancos',
                                                                    labelWidth: 90,
                                                                    name: 'bancoCE',
                                                                    width: 400,
                                                                }]
                                                        }]
                                                }]
                                        }]
                                }, {
                                    xtype: 'fieldset',
                                    hideLabel: true,
                                    width: 490,
                                    collapsible: false,
                                    defaults: {
                                        labelWidth: 89,
                                        anchor: '90%',
                                        layout: {
                                            type: 'column',
                                            defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                        }},
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            hideLabel: true,
                                            combineErrors: true,
                                            height: 360,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 1,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'fieldset',
                                                    title: 'Mandatos y Seguro',
                                                    width: 450,
                                                    height: 300,
                                                    collapsible: false,
                                                    items: [{
                                                            xtype: 'fieldcontainer',
                                                            hideLabel: true,
                                                            combineErrors: true,
                                                            width: 450,
                                                            height: 300,
                                                            msgTarget: 'under',
                                                            layout: 'column',
                                                            defaults: {
                                                                flex: 1,
                                                                hideLabel: false
                                                            },
                                                            items: [{
                                                                    style: 'display:inline-block;text-align:left',
                                                                    xtype: 'textfield',
                                                                    hideLabel: false,
                                                                    labelAlign: 'left',
                                                                    fieldLabel: 'Compañía Aseguradora',
                                                                    labelWidth: 150,
                                                                    name: 'ciaaseguradoraMS',
                                                                    width: 400,
                                                                }, {
                                                                    xtype: 'tbspacer',
                                                                    height: 30
                                                                }, {
                                                                    style: 'display:inline-block;text-align:left',
                                                                    xtype: 'textfield',
                                                                    hideLabel: false,
                                                                    labelAlign: 'left',
                                                                    fieldLabel: 'Porcentaje del Seguro',
                                                                    labelWidth: 150,
                                                                    name: 'porcentajeMS',
                                                                    width: 200,
                                                                }, {
                                                                    style: 'display:inline-block;text-align:center',
                                                                    xtype: 'datefield',
                                                                    hideLabel: false,
                                                                    labelAlign: 'left',
                                                                    fieldLabel: 'Vigencia',
                                                                    labelWidth: 80,
                                                                    name: 'vigenciaMS',
                                                                    id: 'vigenciaMS',
                                                                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                                                                    format: 'Y-m-d',
                                                                    width: 200,
                                                                }]
                                                        }]
                                                }

                                            ]
                                        }]
                                }]
                        }]
                }, {
                    title: 'Documentación',
                    items: [{
                            xtype: 'tbspacer',
                            width: 150
                        }, {
                            style: 'display:inline-block;text-align:center',
                            labelAlign: 'left',
                            xtype: 'fieldset',
                            hideLabel: true,
                            width: 800,
                            collapsible: false,
                            defaults: {
                                labelWidth: 89,
                                anchor: '90%',
                                layout: {
                                    type: 'column',
                                    defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                }},
                            items: [{
                                    xtype: 'fieldset',
                                    style: 'display:inline-block;text-align:center',
                                    title: 'Registro o Licencia de Importación',
                                    width: 610,
                                    collapsible: false,
                                    defaults: {
                                        labelWidth: 89,
                                        anchor: '90%',
                                        layout: {
                                            type: 'column',
                                            defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                        }},
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            hideLabel: true,
                                            combineErrors: true,
                                            height: 45,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 1,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'checkboxgroup',
                                                    name: 'registro_importacion',
                                                    vertical: false,
                                                    width: 500,
                                                    items: [
                                                        {boxLabel: 'Colmas', name: 'registro_importacionColmas', inputValue: '1', width: 60},
                                                        {boxLabel: 'Otro', name: 'registro_importacionOtro', inputValue: '2', width: 40},
                                                        {boxLabel: 'Aceptación previa de la D.I.', name: 'registro_importacionAP', inputValue: '3', width: 160}
                                                    ]

                                                }]
                                        }]
                                }, {
                                    xtype: 'fieldset',
                                    title: '',
                                    style: 'display:inline-block;text-align:center',
                                    width: 610,
                                    collapsible: false,
                                    defaults: {
                                        labelWidth: 89,
                                        anchor: '100%',
                                        layout: {
                                            type: 'column',
                                            defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                        }},
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            hideLabel: true,
                                            combineErrors: true,
                                            height: 300,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 2,
                                                hideLabel: false,
                                                labelAlign: 'left',
                                            },
                                            items: [{
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    labelAlign: 'left',
                                                    fieldLabel: 'Instrucciones para manejo de saldos, en registros globales',
                                                    labelWidth: 200,
                                                    name: 'instrucciones',
                                                    width: 650,
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Envío Factura comercial',
                                                    labelWidth: 200,
                                                    name: 'envio_faccomercial',
                                                    width: 650,
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 30
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Envío Lista de Empaque',
                                                    labelWidth: 200,
                                                    name: 'envio_listaempaque',
                                                    width: 650,
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 30
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Envío Certificados de origen',
                                                    labelWidth: 200,
                                                    name: 'envio_certorigen',
                                                    width: 650,
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 30
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Envío certificados sanitarios',
                                                    labelWidth: 200,
                                                    name: 'envio_certsanitarios',
                                                    width: 650,
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 30
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Envío certificados Fitosanitarios y Zoosanitarios',
                                                    labelWidth: 200,
                                                    name: 'envio_certfitozoo',
                                                    width: 650,
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 30
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'textareafield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Otras Instrucciones',
                                                    labelAlign: 'left',
                                                    labelWidth: 200,
                                                    name: 'instrucciones_detalle',
                                                    width: 650,
                                                }]
                                        }]
                                }]
                        }]
                }, {
                    title: 'Transporte Internacional',
                    items: [{
                            xtype: 'tabTransporteInternacional',
                            style: 'display:inline-block;text-align:center',
                        }]
                }, {
                    title: 'Manejo de Mercancias',
                    items: [{
                            xtype: 'fieldset',
                            hideLabel: false,
                            title: 'Importaciones',
                            width: 980,
                            collapsible: false,
                            layout: 'hbox',
                            items: [{
                                    xtype: 'fieldset',
                                    hideLabel: true,
                                    width: 430,
                                    collapsible: false,
                                    defaults: {
                                        labelWidth: 89,
                                        anchor: '90%',
                                        layout: {
                                            type: 'column',
                                            defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                        }},
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            hideLabel: true,
                                            combineErrors: true,
                                            height: 360,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 1,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'checkboxgroup',
                                                    name: 'operacion_zonafranca',
                                                    labelAlign: 'left',
                                                    fieldLabel: 'Operaciones zona franca',
                                                    labelWidth: 110,
                                                    vertical: false,
                                                    items: [
                                                        {boxLabel: '', name: 'operacion_zonafrancaMM', inputValue: '1', width: 60}
                                                    ]
                                                }, {
                                                    xtype: 'textfield',
                                                    fieldLabel: 'Depósito Zona Franca',
                                                    name: 'deposito_zonafrancaMM',
                                                    labelWidth: 110,
                                                    width: 170,
                                                }, {
                                                    xtype: 'checkboxgroup',
                                                    name: 'dta',
                                                    fieldLabel: 'DTA',
                                                    labelWidth: 110,
                                                    vertical: false,
                                                    items: [
                                                        {boxLabel: '', name: 'dtaMM', inputValue: '1', width: 60}
                                                    ]
                                                }, {
                                                    xtype: 'checkboxgroup',
                                                    name: 'otm',
                                                    fieldLabel: 'OTM',
                                                    labelWidth: 110,
                                                    vertical: false,
                                                    items: [
                                                        {boxLabel: '', name: 'otmMM', inputValue: '1', width: 60}
                                                    ]
                                                }, {
                                                    xtype: 'checkboxgroup',
                                                    name: 'descargue_directo',
                                                    fieldLabel: 'Descargue Directo',
                                                    labelWidth: 110,
                                                    vertical: false,
                                                    items: [
                                                        {boxLabel: '', name: 'descargue_directoMM', inputValue: '1', width: 60}
                                                    ]

                                                }, {
                                                    xtype: 'checkboxgroup',
                                                    name: 'anticipada',
                                                    fieldLabel: 'Anticipada',
                                                    labelWidth: 110,
                                                    vertical: false,
                                                    items: [
                                                        {boxLabel: '', name: 'anticipadaMM', inputValue: '1', width: 60}
                                                    ]

                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'combo-si-no',
                                                    name: 'preinspeccionesMM',
                                                    fieldLabel: 'Preinspecciones/Inventario previo de mercancias',
                                                    labelWidth: 150
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'combo-si-no',
                                                    name: 'serialesMM',
                                                    fieldLabel: 'Toma de Seriales',
                                                    labelWidth: 150
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'combo-si-no',
                                                    name: 'desembalajeMM',
                                                    fieldLabel: 'Desembalaje/ Separación de bultos',
                                                    labelWidth: 150
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'combo-si-no',
                                                    name: 'sanidadMM',
                                                    fieldLabel: 'Inspección SANIDAD e ICA',
                                                    labelWidth: 150
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'textfield',
                                                    name: 'productosMM',
                                                    fieldLabel: 'Productos',
                                                    width: 400,
                                                    labelWidth: 150
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 10
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'textareafield',
                                                    name: 'averiasMM',
                                                    fieldLabel: 'Procedimiento / inconsistencias, averías o faltantes',
                                                    width: 400,
                                                    labelWidth: 150
                                                }]
                                        }]
                                }, {
                                    xtype: 'fieldset',
                                    hideLabel: true,
                                    width: 620,
                                    collapsible: false,
                                    defaults: {
                                        labelWidth: 89,
                                        anchor: '90%',
                                        layout: {
                                            type: 'column',
                                            defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                        }},
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            hideLabel: true,
                                            combineErrors: true,
                                            height: 360,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 1,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'combo-si-no',
                                                    name: 'ajustadoresMM',
                                                    fieldLabel: 'Presencia de ajustadores de seguros',
                                                    width: 250,
                                                    labelWidth: 150
                                                }, {
                                                    xtype: 'tbspacer',
                                                    width: 20
                                                }, {
                                                    style: 'display:inline-block;text-align:center',
                                                    xtype: 'combo-si-no',
                                                    name: 'funcionarioMM',
                                                    fieldLabel: 'Presencia funcionario COLMAS',
                                                    width: 250,
                                                    labelWidth: 150
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'combo-si-no',
                                                    name: 'representante_clienteMM',
                                                    fieldLabel: 'Presencia representante del cliente',
                                                    width: 250,
                                                    labelWidth: 150
                                                }, {
                                                    style: 'display:inline-block;text-align:center',
                                                    xtype: 'combo-si-no',
                                                    name: 'segurosMM',
                                                    width: 250,
                                                    fieldLabel: 'Presencia funcionario de Cía de Seguros',
                                                    labelWidth: 150
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'combo-si-no',
                                                    name: 'fotograficosMM',
                                                    width: 250,
                                                    fieldLabel: 'Registros fotográficos y fílmicos',
                                                    labelWidth: 150
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'textfield',
                                                    name: 'controladosMM',
                                                    width: 250,
                                                    fieldLabel: 'Productos Controlados',
                                                    width: 500,
                                                            labelWidth: 150
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'checkboxgroup',
                                                    name: 'coord_despacho',
                                                    fieldLabel: 'Coordinar despacho trasnporte y entrega',
                                                    labelWidth: 250,
                                                    vertical: false,
                                                    items: [
                                                        {boxLabel: '', name: 'coord_despachoMM', inputValue: '1', width: 60}
                                                    ]
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'checkboxgroup',
                                                    name: 'escolta',
                                                    fieldLabel: 'Escolta',
                                                    labelWidth: 100,
                                                    vertical: false,
                                                    items: [
                                                        {boxLabel: '', name: 'escoltaMM', inputValue: '1', width: 60}
                                                    ]
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'textfield',
                                                    name: 'poliza_transporteMM',
                                                    width: 250,
                                                    fieldLabel: 'Condiciones contractuales de Póliza de transporte',
                                                    width: 500,
                                                            labelWidth: 150
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'textfield',
                                                    name: 'horario_reciboMM',
                                                    width: 250,
                                                    fieldLabel: 'Horario de recibo de mercancía en planta o bodega',
                                                    width: 500,
                                                            labelWidth: 150
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'textareafield',
                                                    name: 'instrucciones_especialesMM',
                                                    width: 250,
                                                    fieldLabel: 'Instrucciones especiales',
                                                    width: 500,
                                                            labelWidth: 150
                                                }]
                                        }]
                                }]
                        }]
                }, {
                    title: 'Clasificacion y Registros',
                    items: [{
                            xtype: 'fieldset',
                            hideLabel: true,
                            width: 980,
                            collapsible: false,
                            layout: 'hbox',
                            items: [{
                                    xtype: 'fieldset',
                                    hideLabel: true,
                                    width: 490,
                                    collapsible: false,
                                    defaults: {
                                        labelWidth: 89,
                                        anchor: '90%',
                                        layout: {
                                            type: 'column',
                                            defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                        }},
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            hideLabel: false,
                                            label: 'Clasificacion Arancelaria',
                                            combineErrors: true,
                                            height: 360,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 1,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'textareafield',
                                                    name: 'clasificacionCR',
                                                    fieldLabel: 'Clasificacion Arancelaria',
                                                    width: 400,
                                                    height: 350,
                                                    labelWidth: 150
                                                }]
                                        }]
                                }, {
                                    xtype: 'fieldset',
                                    hideLabel: true,
                                    width: 490,
                                    collapsible: false,
                                    defaults: {
                                        labelWidth: 89,
                                        anchor: '90%',
                                        layout: {
                                            type: 'column',
                                            defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                        }},
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            hideLabel: true,
                                            combineErrors: true,
                                            height: 360,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 1,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'textareafield',
                                                    name: 'registrosCR',
                                                    width: 250,
                                                    fieldLabel: 'Registros de importacion',
                                                    width: 400,
                                                            height: 350,
                                                    labelWidth: 150
                                                }]
                                        }]
                                }]
                        }]
                }, {
                    title: 'Solicitud de Fondos o Anticipos',
                    items: [{
                            style: 'display:inline-block;text-align:center',
                            xtype: 'fieldset',
                            hideLabel: false,
                            title: 'Solicitud de Fondos o Anticipos',
                            width: 650,
                            collapsible: false,
                            defaults: {
                                labelWidth: 89,
                                anchor: '90%',
                                layout: {
                                    type: 'column',
                                    defaultMargins: {top: 0, right: 25, bottom: 0, left: 25}
                                }},
                            items: [{
                                    xtype: 'fieldset',
                                    style: 'display:inline-block;text-align:center',
                                    hideLabel: true,
                                    width: 620,
                                    collapsible: false,
                                    defaults: {
                                        labelWidth: 89,
                                        anchor: '90%',
                                        layout: {
                                            type: 'column',
                                            defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                        }},
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            hideLabel: true,
                                            combineErrors: true,
                                            height: 360,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 1,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'tbspacer',
                                                    height: 60
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'combo-si-no',
                                                    name: 'portuariosSF',
                                                    fieldLabel: 'Gastos portuarios',
                                                    width: 250,
                                                    labelWidth: 150
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'combo-si-no',
                                                    name: 'almacenajesSF',
                                                    fieldLabel: 'Almacenajes',
                                                    width: 250,
                                                    labelWidth: 150
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 40
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'combo-si-no',
                                                    name: 'fleteSF',
                                                    fieldLabel: 'Fiete Internacional',
                                                    width: 250,
                                                    labelWidth: 150
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'combo-si-no',
                                                    name: 'transporteSF',
                                                    width: 250,
                                                    fieldLabel: 'Transporte interno, urbano',
                                                    labelWidth: 150
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 40
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'combo-si-no',
                                                    name: 'icainvimaSF',
                                                    width: 250,
                                                    fieldLabel: 'ICA,INVIMA',
                                                    labelWidth: 150
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'combo-si-no',
                                                    name: 'otrosgastosSF',
                                                    width: 250,
                                                    fieldLabel: 'Otros gastos',
                                                    labelWidth: 150
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 40
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'combo-si-no',
                                                    name: 'tributosSF',
                                                    width: 250,
                                                    fieldLabel: 'Tributos aduaneros',
                                                    labelWidth: 150
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 40
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'combo-si-no',
                                                    name: 'ingresosSF',
                                                    width: 250,
                                                    fieldLabel: 'Ingresos propios',
                                                    labelWidth: 150
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'textareafield',
                                                    name: 'bancosSF',
                                                    width: 250,
                                                    fieldLabel: 'Bancos',
                                                    width: 500,
                                                            labelWidth: 150
                                                }]
                                        }]
                                }]
                        }]
                }, {
                    title: 'Facturación',
                    items: [{
                            style: 'display:inline-block;text-align:center',
                            xtype: 'fieldset',
                            hideLabel: true,
                            title: 'Facturación',
                            width: 650,
                            collapsible: false,
                            defaults: {
                                labelWidth: 89,
                                anchor: '90%',
                                layout: {
                                    type: 'column',
                                    defaultMargins: {top: 0, right: 25, bottom: 0, left: 25}
                                }},
                            items: [{
                                    xtype: 'fieldset',
                                    style: 'display:inline-block;text-align:center',
                                    hideLabel: true,
                                    width: 620,
                                    collapsible: false,
                                    defaults: {
                                        labelWidth: 89,
                                        anchor: '90%',
                                        layout: {
                                            type: 'column',
                                            defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                        }},
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            hideLabel: false,
                                            combineErrors: true,
                                            height: 380,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 1,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'textfield',
                                                    name: 'fechascierreF',
                                                    fieldLabel: 'Fechas de Cierre',
                                                    width: 500,
                                                    labelWidth: 150
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'textfield',
                                                    name: 'soportesF',
                                                    fieldLabel: 'Soportes facturación nacionalización',
                                                    width: 500,
                                                    labelWidth: 150
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'textfield',
                                                    name: 'plazoF',
                                                    fieldLabel: 'Plazo facturación vs Despacho/Embarque',
                                                    width: 500,
                                                    labelWidth: 150
                                                }, {
                                                    xtype: 'combo-si-no',
                                                    name: 'creditoF',
                                                    fieldLabel: 'Crédito',
                                                    width: 250,
                                                    labelWidth: 150
                                                }, {
                                                    xtype: 'textfield',
                                                    name: 'diasF',
                                                    fieldLabel: 'Dias',
                                                    width: 250,
                                                    labelWidth: 150
                                                }, {
                                                    xtype: 'textfield',
                                                    name: 'cupoF',
                                                    width: 250,
                                                    fieldLabel: 'Cupo',
                                                    labelWidth: 150
                                                }, {
                                                    xtype: 'combo-si-no',
                                                    name: 'fondoanticipoF',
                                                    width: 250,
                                                    fieldLabel: 'Fondo Anticipo',
                                                    labelWidth: 150
                                                }, {
                                                    xtype: 'textfield',
                                                    name: 'valorF',
                                                    fieldLabel: 'Valor',
                                                    width: 250,
                                                    labelWidth: 150
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 40
                                                }, {
                                                    xtype: 'combo-si-no',
                                                    name: 'pagoF',
                                                    width: 250,
                                                    fieldLabel: 'Pago',
                                                    width: 250,
                                                }, {
                                                    xtype: 'tbspacer',
                                                    width: 100
                                                }, {
                                                    xtype: 'textfield',
                                                    name: 'bancoF',
                                                    width: 250,
                                                    fieldLabel: 'Banco',
                                                    width: 200,
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 40
                                                }, {
                                                    xtype: 'combo-si-no',
                                                    name: 'transferenciaF',
                                                    width: 250,
                                                    fieldLabel: 'Transferencia',
                                                    width: 250,
                                                }, {
                                                    xtype: 'textfield',
                                                    name: 'plazotransferenciaF',
                                                    width: 250,
                                                    fieldLabel: 'Plazo',
                                                    width: 200,
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 40
                                                }, {
                                                    xtype: 'combo-si-no',
                                                    name: 'chequeF',
                                                    width: 250,
                                                    fieldLabel: 'Cheque',
                                                    width: 250,
                                                            labelWidth: 150
                                                }, {
                                                    xtype: 'combo-si-no',
                                                    name: 'consignacionF',
                                                    width: 250,
                                                    fieldLabel: 'Consignación Efectivo',
                                                    width: 250,
                                                            labelWidth: 150
                                                }, {
                                                    xtype: 'combo-si-no',
                                                    name: 'pagoelectronicoF',
                                                    width: 250,
                                                    fieldLabel: 'Pago Electrónico',
                                                    width: 250,
                                                            labelWidth: 150
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'textfield',
                                                    name: 'contactoareaF',
                                                    width: 250,
                                                    fieldLabel: 'Contacto área financiera',
                                                    width: 500
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'textfield',
                                                    name: 'telefonoF',
                                                    width: 250,
                                                    fieldLabel: 'Tel.',
                                                    width: 250
                                                }, {
                                                    xtype: 'textfield',
                                                    name: 'correoF',
                                                    width: 250,
                                                    fieldLabel: 'E-mail',
                                                    width: 250
                                                }]
                                        }]
                                }]
                        }]
                }, {
                    title: 'Otros Contactos',
                    items: [{
                            xtype: 'fieldset',
                            hideLabel: true,
                            width: 970,
                            heigth: 500,
                            collapsible: false,
                            layout: 'hbox',
                            items: [{
                                    xtype: 'fieldset',
                                    title: 'Depósito',
                                    width: 470,
                                    heigth: 300,
                                    collapsible: false,
                                    defaults: {
                                        labelWidth: 89,
                                        anchor: '100%',
                                        layout: {
                                            type: 'column',
                                            defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                        }},
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            hideLabel: true,
                                            combineErrors: true,
                                            height: 130,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 2,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Depósito',
                                                    labelWidth: 200,
                                                    name: 'nombre_deposito',
                                                    width: 400,
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 30
                                                }, {
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Contacto',
                                                    labelWidth: 200,
                                                    name: 'contacto_deposito',
                                                    width: 400,
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 30
                                                }, {
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Teléfono',
                                                    labelWidth: 200,
                                                    name: 'tel_deposito',
                                                    width: 400,
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 30
                                                }, {
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Convenio',
                                                    labelWidth: 200,
                                                    name: 'convenio_deposito',
                                                    width: 400,
                                                }]
                                        }]
                                }, {
                                    xtype: 'fieldset',
                                    title: 'Operador Portuario',
                                    width: 470,
                                    heigth: 300,
                                    collapsible: false,
                                    defaults: {
                                        labelWidth: 89,
                                        anchor: '100%',
                                        layout: {
                                            type: 'column',
                                            defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                        }},
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            hideLabel: true,
                                            combineErrors: true,
                                            height: 130,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 2,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Operador portuario',
                                                    labelWidth: 200,
                                                    name: 'nombre_operador',
                                                    width: 400,
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 30
                                                }, {
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Contacto',
                                                    labelWidth: 200,
                                                    name: 'contacto_operador',
                                                    width: 400,
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 30
                                                }, {
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Teléfono',
                                                    labelWidth: 200,
                                                    name: 'tel_operador',
                                                    width: 400,
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 30
                                                }, {
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Convenio',
                                                    labelWidth: 200,
                                                    name: 'convenio_operador',
                                                    width: 400,
                                                }]
                                        }]
                                }]
                        }, {
                            xtype: 'fieldset',
                            hideLabel: true,
                            width: 970,
                            heigth: 200,
                            collapsible: false,
                            layout: 'hbox',
                            items: [{
                                    xtype: 'fieldset',
                                    title: 'Empresa de transporte nacional / urbano',
                                    width: 470,
                                    collapsible: false,
                                    defaults: {
                                        labelWidth: 89,
                                        anchor: '100%',
                                        layout: {
                                            type: 'column',
                                            defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                        }},
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            hideLabel: true,
                                            combineErrors: true,
                                            height: 130,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 2,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Empresa',
                                                    labelWidth: 200,
                                                    name: 'nombre_empresanu',
                                                    width: 400,
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 30
                                                }, {
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Contacto',
                                                    labelWidth: 200,
                                                    name: 'contacto_empresanu',
                                                    width: 400,
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 30
                                                }, {
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Teléfono',
                                                    labelWidth: 200,
                                                    name: 'tel_empresanu',
                                                    width: 400,
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 30
                                                }, {
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Convenio',
                                                    labelWidth: 200,
                                                    name: 'convenio_empresanu',
                                                    width: 400,
                                                }]
                                        }]
                                }, {
                                    xtype: 'fieldset',
                                    title: 'Empresas de vigilancia / escoltas',
                                    width: 470,
                                    collapsible: false,
                                    defaults: {
                                        labelWidth: 89,
                                        anchor: '100%',
                                        layout: {
                                            type: 'column',
                                            defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                        }},
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            hideLabel: true,
                                            combineErrors: true,
                                            height: 130,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 2,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Empresa',
                                                    labelWidth: 200,
                                                    name: 'nombre_empresasve',
                                                    width: 400,
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 30
                                                }, {
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Contacto',
                                                    labelWidth: 200,
                                                    name: 'contacto_empresasve',
                                                    width: 400,
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 30
                                                }, {
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Teléfono',
                                                    labelWidth: 200,
                                                    name: 'tel_empresasve',
                                                    width: 400,
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 30
                                                }, {
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Convenio',
                                                    labelWidth: 200,
                                                    name: 'convenio_empresasve',
                                                    width: 400,
                                                }]
                                        }]
                                }]
                        }]
                }, {
                    title: 'Reportes e Informes',
                    items: [{
                            style: 'display:inline-block;text-align:center',
                            xtype: 'fieldset',
                            hideLabel: true,
                            title: '',
                            width: 650,
                            collapsible: false,
                            defaults: {
                                labelWidth: 89,
                                anchor: '90%',
                                layout: {
                                    type: 'column',
                                    defaultMargins: {top: 0, right: 25, bottom: 0, left: 25}
                                }},
                            items: [{
                                    xtype: 'fieldset',
                                    hideLabel: false,
                                    title: 'Reportes e Informes',
                                    style: 'display:inline-block;text-align:center',
                                    width: 620,
                                    collapsible: false,
                                    defaults: {
                                        labelWidth: 89,
                                        anchor: '90%',
                                        layout: {
                                            type: 'column',
                                            defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                        }},
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            style: 'display:inline-block;text-align:center',
                                            hideLabel: true,
                                            combineErrors: true,
                                            height: 360,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 1,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'combo-si-no',
                                                    name: 'indicadoresRE',
                                                    fieldLabel: 'Presentación de indicadores',
                                                    width: 300,
                                                    labelWidth: 150
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'combo-si-no',
                                                    name: 'estadoRE',
                                                    fieldLabel: 'Estado de D.O diario',
                                                    width: 300,
                                                    labelWidth: 150
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'combo-si-no',
                                                    name: 'reporteRE',
                                                    fieldLabel: 'Reporte despacho de mercancias',
                                                    width: 300,
                                                    labelWidth: 150
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'textareafield',
                                                    name: 'informesRE',
                                                    width: 250,
                                                    fieldLabel: 'Otros informes',
                                                    width: 500,
                                                            labelWidth: 150
                                                }, {
                                                    style: 'display:inline-block;text-align:left',
                                                    xtype: 'combo-declaraciones',
                                                    name: 'declaracionesRE',
                                                    fieldLabel: 'Envío copia de declaraciones',
                                                    width: 300,
                                                    labelWidth: 150
                                                }]
                                        }]
                                }]
                        }]
                }],
            listeners: {
                tabchange: function (tabPanel, newCard, oldCard, eOpts) {

                }
            }

        });

        Ext.create('Ext.form.Panel', {
            title: 'Ficha Tecnica de Clientes',
            stripeRows: true,
            height: 535,
            width: 1000,
            style: {
                "margin-top": "20px",
                "margin-left": "auto",
                "margin-right": "auto"
            },
            layout: 'anchor',
            defaults: {
                anchor: '100%'
            },
            defaultType: 'textfield',
            items: [
                tabPanel
            ],
            listeners: {
                afterRender: function (panel, eOpts) {
                    panel.getForm().setValues(<?= $documentacion ?>);
                }
            },
            buttons: [{
                    text: 'Imprimir',
                    tooltip: 'Generar Documento de Transporte',
                    iconCls: 'page_white_acrobat',
                    handler: function () {
                        //var id = storeItemsDocs.proxy.extraParams.id;
                        if (win_file == null) {
                            win_file = new Ext.Window({
                                title: 'Vista Preliminar del Documento',
                                height: 600,
                                width: 900,
                                items: [{
                                        xtype: 'component',
                                        itemId: 'panel-document-preview',
                                        autoEl: {
                                            tag: 'iframe',
                                            width: '100%',
                                            height: '100%',
                                            frameborder: '0',
                                            scrolling: 'auto',
                                            src: '<?= url_for('clientes/fichaTecnicaPdf') ?>' + '/idcliente/' + <?= $idcliente ?>
                                        }
                                    }],
                                listeners: {
                                    close: function (panel, eOpts) {
                                        win_file = null;
                                    }
                                }
                            })
                        }
                        win_file.show();
                    }
                }, {
                    id: 'bntGuardar',
                    text: 'Guardar',
                    handler: function () {
                        var f1 = Ext.getCmp("fchvencimientoPCE");
                        var f2 = Ext.getCmp("fchvencimientoRCE");
                        var f3 = Ext.getCmp("vigenciaMS");

                        var me = this;
                        var form = me.up('form').getForm();

                        var data = form.getFieldValues();
                        data.fchvencimientoPCE = f1.rawValue;
                        data.fchvencimientoRCE = f2.rawValue;
                        data.vigenciaMS = f3.rawValue;

                        var str = JSON.stringify(data);

                        var grid = Ext.getCmp("gridTI");
                        if (form.isValid()) {
                            var store = storeFichaTecnicaTI;
                            x = 0;
                            changes = [];
                            for (var i = 0; i < store.getCount(); i++) {
                                var record = store.getAt(i);
                                if (record.isValid()) {
                                    changes[x] = record.data;
                                    x++;
                                }
                            }
                            var strGrid = JSON.stringify(changes);

                            Ext.Ajax.request({
                                waitMsg: 'Guardando cambios...',
                                url: '<?= url_for('clientes/actualizarFichaTecnica') ?>',
                                params: {
                                    datos: str,
                                    datosGrid: strGrid,
                                    idcliente: <?= $idcliente ?>
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
                                    if (res.success) {
                                        Ext.MessageBox.alert("Mensaje", 'Ficha almacenada correctamente<br>');
                                    }
                                }
                            });
                        }
                    }
                }, {
                    text: 'Cancelar',
                    handler: function () {
                        this.findParentByType('window').close();
                    }
                }
            ],
            renderTo: Ext.get('se-form')
        });

    });
</script>