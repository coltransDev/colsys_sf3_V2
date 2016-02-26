<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$idcliente = $sf_data->getRaw("idcliente");
$razonSocial = $sf_data->getRaw("razonSocial");
$data = $sf_data->getRaw("data");
$sectorfinanciero = $sf_data->getRaw("sectorfinanciero");
$tipopersona = $sf_data->getRaw("tipopersona");
$minimo = $sf_data->getRaw("minimo");
$hoy = $sf_data->getRaw("hoy");
?>
<script type="text/javascript">
var win_infofinanciera = null;

    Ext.define('ControlFinanciero', {
        extend: 'Ext.data.Model',
        fields: [
            {name: 'idtipo', type: 'string'},
            {name: 'iddocumento', type: 'string'},
            {name: 'empresa', type: 'string'},
            {name: 'documento', type: 'string'},
            {name: 'observaciones', type: 'string'},
            {name: 'fch_vigencia', type: 'date'},
            {name: 'fch_documento', type: 'date'},
            {name: 'seleccionado', type: 'boolean'}    
        ]
    });
    
    Ext.define('InfoFinanciera', {
        extend: 'Ext.data.Model',
        fields: [
            {name: 'ca_activostotales', type: 'string'},
            {name: 'ca_activoscorrientes', type: 'string'},
            {name: 'ca_pasivostotales', type: 'string'},
            {name: 'ca_pasivoscorrientes', type: 'string'},
            {name: 'ca_inventarios', type: 'string'},
            {name: 'ca_patrimonios', type: 'string'},
            {name: 'ca_utilidades', type: 'string'},
            {name: 'ca_ventas', type: 'string'},
            {name: 'ca_anno', type: 'string'},
            {name: 'ca_actsmmlv', type: 'string'},
            {name: 'ca_indliquidez', type: 'string'},
            {name: 'ca_indendeudamiento', type: 'string'},
            {name: 'ca_pbaacida', type: 'string'},
            {name: 'ca_ino', type: 'string'},
        ]
    });
    
    var storeInfoFinanciera = Ext.create('Ext.data.Store', {
        id: 'storeInfoFinanciera',
        autoLoad: true,
        model: 'InfoFinanciera',
        proxy: {
            type: 'ajax',
            url: '<?= url_for('clientes/datosInfoFinanciera') ?>',
            reader: {
                type: 'json',
                root: 'root'
            },
            extraParams: {
                idcliente: '<?= $idcliente ?>'
            },
            filterParam: 'query',
        },
    });

    var storeControlFinanciero = Ext.create('Ext.data.Store', {
        id: 'storeControlFinanciero',
        autoLoad: true,
        model: 'ControlFinanciero',
        proxy: {
            type: 'ajax',
            url: '<?= url_for('clientes/datosControlFinanciero') ?>',
            reader: {
                type: 'json',
                root: 'root'
            },
            extraParams: {
                idcliente: '<?= $idcliente ?>'
            },
            filterParam: 'query',
        },
    });
    
    var forminfofinanciera =  Ext.create('Ext.form.Panel', {
    id: 'forminfofinanciera',
    bodyPadding: 5,
    width: 510,
    height: 340,
    items: [{
        xtype: 'fieldset',
        title: ' ',
        width: 620,
        height: 260,
        collapsible: false,
        
        items: [{
                xtype: 'fieldcontainer',
                hideLabel: true,
                combineErrors: true,
                height: 45,
                msgTarget: 'under',
                layout: 'column',
                defaults: {
                    flex: 2,
                    hideLabel: false
                },
                items: [{
                        xtype: 'numberfield',
                        style: 'display:inline-block;text-align:left;font-weight:bold;',
                        fieldLabel: 'Año',
                        id: 'ca_anno',                        
                        width: 220
                    }, {
                        xtype: 'tbspacer',
                        height: 10,
                        width: 500,
                    }, {
                        xtype: 'numberfield',
                        //value: '0',
                        fieldLabel: 'Activos Totales',
                        name: 'ca_activostotales',
                        id: 'ca_activostotales',           
                        hideTrigger: true,
                        //decimalSeparator: '.',
                        thousandSeparator: '.',
                        decimalSeparator:',',
                        renderer: Ext.util.Format.numberRenderer('0,000'),                        
                        keyNavEnabled: false,
                        mouseWheelEnabled: false,
                        width: 220

                    }, {
                        xtype: 'numberfield',
                        value: '0',
                        fieldLabel: 'Activos Corrientes',
                        name: 'ca_activoscorrientes',
                        id: 'ca_activoscorrientes',
                        width: 260,
                        labelWidth: 150,
                        hideTrigger: true,
                        decimalPrecision: 2,
                        keyNavEnabled: false,
                        mouseWheelEnabled: false,

                    }, {
                        xtype: 'tbspacer',
                        height: 10,
                        width: 500,
                    }, {
                        xtype: 'numberfield',
                        value: '0',
                        fieldLabel: 'Pasivos Totales',
                        name: 'ca_pasivostotales',
                        id: 'ca_pasivostotales',
                        width: 220,
                        hideTrigger: true,
                        decimalPrecision: 2,
                        keyNavEnabled: false,
                        mouseWheelEnabled: false,

                    }, {
                        xtype: 'numberfield',
                        value: '0',
                        fieldLabel: 'Pasivos Corrientes',
                        name: 'ca_pasivoscorrientes',
                        id: 'ca_pasivoscorrientes',
                        width: 260,
                        labelWidth: 150,
                        hideTrigger: true,
                        decimalPrecision: 2,
                        keyNavEnabled: false,
                        mouseWheelEnabled: false,

                    }, {
                        xtype: 'tbspacer',
                        height: 10,
                        width: 500,
                    }, {
                        xtype: 'numberfield',
                        value: '0',
                        fieldLabel: 'Inventarios',
                        name: 'ca_inventarios',
                        id: 'ca_inventarios',
                        width: 220,
                        hideTrigger: true,
                        decimalPrecision: 2,
                        keyNavEnabled: false,
                        mouseWheelEnabled: false,

                    }, {
                        xtype: 'numberfield',
                        value: '0',
                        fieldLabel: 'Patrimonios',
                        name: 'ca_patrimonios',
                        id: 'ca_patrimonios',
                        width: 260,
                        labelWidth: 150,
                        hideTrigger: true,
                        decimalPrecision: 2,
                        keyNavEnabled: false,
                        mouseWheelEnabled: false,

                    }, {
                        xtype: 'tbspacer',
                        height: 10,
                        width: 500,
                    }, {
                        xtype: 'numberfield',
                        value: '0',
                        fieldLabel: 'Utilidades',
                        name: 'ca_utilidades',
                        id: 'ca_utilidades',
                        width: 220,
                        hideTrigger: true,
                        decimalPrecision: 2,
                        keyNavEnabled: false,
                        mouseWheelEnabled: false,

                    }, {
                        xtype: 'numberfield',
                        value: '0',
                        fieldLabel: 'Ventas',
                        name: 'ca_ventas',
                        id: 'ca_ventas',
                        width: 260,
                        labelWidth: 150,
                        hideTrigger: true,
                        decimalPrecision: 2,
                        keyNavEnabled: false,
                        mouseWheelEnabled: false,

                    }]   
                }]
    }],
    buttons : [{
        text: 'Guardar',
        handler: function (){
            var me = this;
            var form = me.up('form').getForm();
            if(form.isValid()){
            
                var activostotales = Ext.getCmp('ca_activostotales');
                var activoscorrientes = Ext.getCmp('ca_activoscorrientes');
                var pasivostotales = Ext.getCmp('ca_pasivostotales');
                var pasivoscorrientes = Ext.getCmp('ca_pasivoscorrientes');
                var inventarios = Ext.getCmp('ca_inventarios');
                var patrimonios = Ext.getCmp('ca_patrimonios');
                var utilidades = Ext.getCmp('ca_utilidades');
                var ventas = Ext.getCmp('ca_ventas');
                var anno = Ext.getCmp('ca_anno');
               
                
                    Ext.Ajax.request({
                    waitMsg: 'Guardando cambios...',
                    url: '<?= url_for('clientes/guardarDatosFinancieros') ?>',
                    params: {
                        activostotales: activostotales.value,
                        activoscorrientes: activoscorrientes.value,
                        pasivostotales: pasivostotales.value,
                        pasivoscorrientes: pasivoscorrientes.value,
                        inventarios: inventarios.value,
                        patrimonios: patrimonios.value,
                        utilidades: utilidades.value,
                        ventas: ventas.value,
                        idcliente: <?= $idcliente ?>,
                        anno: anno.value
                    },
                    failure: function (response, options) {
                        var res = Ext.util.JSON.decode(response.responseText);
                        if (res.errorInfo)
                            Ext.MessageBox.alert("Mensaje", 'Debe diligenciar completamente el formulario');
                        
                    },
                    success: function (response, options) {
                        var res = Ext.decode(response.responseText);
                        ids = res.ids;
                        if (res.success) {
                            Ext.MessageBox.alert("Mensaje", 'Datos Almacenados Correctamente<br>');
                            storeInfoFinanciera.reload();
                            
                        }
                        else{
                            Ext.MessageBox.alert("Mensaje", 'Datos Incompletos<br>');
                        }
                    }
                });
            }
        }
    }]
    });
    
    
    var gridInfoFinanciera = new Ext.grid.GridPanel({
        id: 'gridInfoFinanciera',
        store: storeInfoFinanciera,
        stripeRows: true,
        height: 400,
        width: 650,
        

        plugins: [{
        ptype: 'rowexpander',
        rowBodyTpl : new Ext.XTemplate(
         '<table class="bgrGREYlight" align=center width="100%" height="99%" border=0>' +
            '<tbody>' +
                '<tr>' +
                    '<th align="left" width="25%" class="tableTEXT2">Inventarios</th>' +
                    '<td  width="40%" align="left" class="tableTEXT">{ca_inventarios}</td>' + 
                '</tr>'+
                '<tr>' +
                    '<th align="left" width="25%" class="tableTEXT2">Patrimonios</th>' +
                    '<td  width="40%" align="left" class="tableTEXT">{ca_patrimonios}</td>' + 
                '</tr>'+
                '<tr>' +
                    '<th align="left" width="25%" class="tableTEXT2">Utilidades</th>' +
                    '<td  width="40%" align="left" class="tableTEXT">{ca_utilidades}</td>' + 
                '</tr>'+
                '<tr>' +
                    '<th align="left" width="25%" class="tableTEXT2">Ventas</th>' +
                    '<td  width="40%" align="left" class="tableTEXT">{ca_ventas}</td>' + 
                '</tr>'+
                '<tr>' +
                    '<th align="left" width="25%" class="tableTEXT2">Activos en SMMLV</th>' +
                    '<td  width="40%" align="left" class="tableTEXT">{ca_actsmmlv}</td>' + 
                '</tr>'+
                '<tr>' +
                    '<th align="left" width="25%" class="tableTEXT2">Indice de Liquidez</th>' +
                    '<td  width="40%" align="left" class="tableTEXT">{ca_indliquidez}</td>' + 
                '</tr>'+
                '<tr>' +
                    '<th align="left" width="25%" class="tableTEXT2">Indice de Endeudamiento</th>' +
                    '<td  width="40%" align="left" class="tableTEXT">{ca_indendeudamiento}</td>' + 
                '</tr>'+
                '<tr>' +
                    '<th align="left" width="25%" class="tableTEXT2">Prueba ácida</th>' +
                    '<td  width="40%" align="left" class="tableTEXT">{ca_pbaacida}</td>' + 
                '</tr>'+
                '<tr>' +
                    '<th align="left" width="25%" class="tableTEXT2">Ino</th>' +
                    '<td  width="40%" align="left" class="tableTEXT">{ca_ino}</td>' + 
                '</tr>'+                
            '</tbody>' +
        '</table>', 
            
            
        {
            formatChange: function(v){
                var color = v >= 0 ? 'green' : 'red';
                return '<span style="color: ' + color + ';">' + Ext.util.Format.usMoney(v) + '</span>';
            }
        })
    }],
        
        columns: [{
                header: 'Año',
                width: 60,
                dataIndex: 'ca_anno',
                
                editor: {xtype: "textfield"}
            }, {
            text: 'Activos',
            columns: [{
                header: 'Totales',
                width: 130,
                dataIndex: 'ca_activostotales',
                renderer: Ext.util.Format.numberRenderer('0,000'),
                editor: {xtype: "textfield"}
            }, {
                header: 'Corrientes',
                width: 130,
                dataIndex: 'ca_activoscorrientes',
                renderer: Ext.util.Format.numberRenderer('0,000'),
                editor: {xtype: "textfield"}
            }]
            }, {
                text: 'Pasivos',
                columns: [{
                header: 'Totales',
                width: 130,
                dataIndex: 'ca_pasivostotales',
                renderer: Ext.util.Format.numberRenderer('0,000'),
                editor: {xtype: "textfield"}
            },{
                header: 'Corrientes',
                width: 130,
                dataIndex: 'ca_pasivoscorrientes',
                renderer: Ext.util.Format.numberRenderer('0,000'),
                editor: {xtype: "textfield"}
            }]
            
            } ,{
                header: 'Inventarios',
                width: 150,
                hidden: true,
                dataIndex: 'ca_inventarios',
                renderer: Ext.util.Format.numberRenderer('0,000'),
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false,
                editor: {xtype: "textfield"}
            },{
                header: 'Patrimonios',
                width: 150,
                hidden: true,
                dataIndex: 'ca_patrimonios',
                renderer: Ext.util.Format.numberRenderer('0,000'),
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false,
                editor: {xtype: "textfield"}
            },{
                header: 'Utilidades',
                width: 150,
                hidden: true,
                dataIndex: 'ca_utilidades',
                renderer: Ext.util.Format.numberRenderer('0,000'),
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false,
                editor: {xtype: "textfield"}
            },{
                header: 'Ventas',
                hidden: true,
                width: 150,
                dataIndex: 'ca_ventas',
                renderer: Ext.util.Format.numberRenderer('0,000'),
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false,
                editor: {xtype: "textfield"}
            },{
                header: 'ca_actsmmlv',
                hidden: true,
                width: 150,
                dataIndex: 'ca_actsmmlv',
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false,
                editor: {xtype: "textfield"}
            },{
                header: 'ca_indliquidez',
                hidden: true,
                width: 150,
                dataIndex: 'ca_indliquidez',
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false,
                editor: {xtype: "textfield"}
            },{
                header: 'ca_indendeudamiento',
                hidden: true,
                width: 150,
                dataIndex: 'ca_indendeudamiento',
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false,
                editor: {xtype: "textfield"}
            },{
                header: 'ca_pbaacida',
                hidden: true,
                width: 150,
                dataIndex: 'ca_pbaacida',
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false,
                editor: {xtype: "textfield"}
            },{
                header: 'ca_ino',
                hidden: true,
                width: 150,
                dataIndex: 'ca_ino',
                renderer: Ext.util.Format.numberRenderer('0,000'),
                hideTrigger: true,
                decimalPrecision: 2,
                keyNavEnabled: false,
                mouseWheelEnabled: false,
                editor: {xtype: "textfield"}
            }, {
                    menuDisabled: true,
                    sortable: false,
                    xtype: 'actioncolumn',
                    width: 40,
                    items: [{
                            iconCls: 'page_white_edit',
                            tooltip: 'Consultar la Encuesta',
                            handler: function(grid, rowIndex, colIndex) {
                                var rec = grid.getStore().getAt(rowIndex);
                             
                               if (win_infofinanciera == null) {
                                   
                                    win_infofinanciera = new Ext.Window({
                                        
                                        title: 'Edición de Registro',
                                        width: 530,
                                        height: 390,
                                        closeAction: 'close',
                                        items: {
                                            xtype: forminfofinanciera
                                        },
                                        listeners: {
                                            close: function (win, eOpts ){
                                                win_infofinanciera = null;
                                            }
                                         }
                                    })
                                } 
                                win_infofinanciera.down('form').loadRecord(rec);
                                win_infofinanciera.show();

                            }
                        }, {
                            iconCls: 'delete',
                            tooltip: 'Anular la Encuesta',
                            handler: function(grid, rowIndex, colIndex) {
                                var rec = grid.getStore().getAt(rowIndex);
                                Ext.MessageBox.confirm('Confirmación de Eliminación', 'Está seguro que desea anular el registro?', function(choice) {
                                    if (choice == 'yes') {
                                        Ext.Ajax.request({
                                            waitMsg: 'Eliminado...',
                                            url: '<?= url_for("clientes/anularInfoFinanciera") ?>',
                                            params: {                                                
                                                idcliente: <?= $idcliente ?>,
                                                anno: rec.data.ca_anno
                                            },
                                            failure: function(response, options) {
                                                Ext.MessageBox.alert("Mensaje", 'Se presento un error Eliminando el registro.<br>' + response.errorInfo);
                                                success = false;
                                            },
                                            success: function(response, options) {
                                                var res = Ext.JSON.decode(response.responseText);
                                                if (res.success) {
                                                    store = storeInfoFinanciera;
                                                    store.reload();
                                                } else {
                                                    Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + res.responseInfo);
                                                }
                                            }
                                        });
                                    }
                                });
                            }
                        }]
                }
        ],
        tbar: [{
                text: 'Adicionar',
                iconCls: 'add',
                handler : function(){    
                    
                    if (win_infofinanciera == null) {
                        
                            win_infofinanciera = new Ext.Window({
                            title: 'Datos financieros',
                            width: 530,
                            height: 380,
                            closeAction: 'close',
                            items: {
                                xtype: forminfofinanciera
                            },
                            listeners: {
                                close: function (win, eOpts ){
                                   
                                    win_infofinanciera = null;
                                }
                             }
                         })
                        }
                        rec = Ext.create ('InfoFinanciera',{});
                        win_infofinanciera.down('form').loadRecord(rec);
                        win_infofinanciera.show();
                     }
                
        }],
    });
    
    var fieldsetPersonaJuridica = Ext.create('Ext.form.FieldSet', {
        xtype: 'fieldset',
        title: 'Persona jurídica',
        id: 'personajuridica',
        hidden: true,
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
                combineErrors: true,
                height: 50,
                width: 200,
                msgTarget: 'under',
                items: [{
                        xtype: 'tbspacer',
                        columnWidth: 0.2,
                    }, {
                        xtype: 'fieldset',
                        title: '',
                        columnWidth: 0.8,
                        defaultType: 'checkbox',
                        layout: 'column',
                        items: [{
                                id: 'grancontribuyente',
                                name: 'grancontribuyente',
                                fieldLabel: 'Gran contribuyente',
                                boxLabel: '',
                            }, {
                                fieldLabel: 'UAP',
                                boxLabel: '',
                                name: 'uap',
                                id: 'uap',
                            }, {
                                fieldLabel: 'Altex',
                                boxLabel: '',
                                name: 'altex',
                                id: 'altex',
                            }]
                    }]
            }]
    });

    var gridControlFinanciero = new Ext.grid.GridPanel({
        id: 'gridControlFinanciero',
        store: storeControlFinanciero,
        hidden: true,
        height: 400,
        width: 650,
        
        columns: [{
                header: 'idtipo',
                width: 25,
                dataIndex: 'idtipo',
                hidden: true
            },  {
                xtype: "checkcolumn",
                dataIndex: 'seleccionado', 
                width: 40,
                listeners:{
                    checkchange: function (grid, rowIndex, colIndex){
                        var record = storeControlFinanciero.getAt(rowIndex);
                        if (record.get('seleccionado')){
                            record.set('fch_documento','<?= $hoy?>');
                        }
                        else{
                            record.set('fch_documento','');
                        }
                    }
                }
            }, {
                header: 'Documento',
                width: 200,
                flex: 1,
                dataIndex: 'documento'
            }, {
                header: 'Fecha Documento',
                width: 125,
                dataIndex: 'fch_documento',
                renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                editor: new Ext.form.DateField({
                    width: 90,
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
        tbar: [{
                text: 'Seleccionar todo',
                handler : function(){    
                    for(var i=0 ; i<storeControlFinanciero.getTotalCount(); i++){
                        var record = storeControlFinanciero.getAt(i);
                            
                                record.set('seleccionado',true);
                            
                    }
                    
                }
            }, {
                text: 'Deseleccionar todo',
                handler : function(){    
                    for(var i=0 ; i<storeControlFinanciero.getTotalCount(); i++){
                        var record = storeControlFinanciero.getAt(i);
                            
                                record.set('seleccionado',false);
                                record.set('fch_documento','');
                            
                    }
                    
                }
            }],
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

        Ext.define('ComboNit', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-nit',
            store: ['Agente', 'Proveedor', 'Excepción Temporal', 'Excepción Permanente']
        });

        Ext.define('ComboSectorEconomico', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-sectoreconomico',
            queryMode: 'local',
            valueField: 'id',
            displayField: 'sector',
            store: {
                fields: [{name: 'sector', type: 'string'}, {name: 'id', type: 'string'}],
                data: <?= json_encode($sectorfinanciero) ?>
            }
        });

        Ext.define('ComboPersona', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-persona',
            queryMode: 'local',
            valueField: 'id',
            displayField: 'tipo',
            store: {
                fields: [{name: 'tipo', type: 'string'}, {name: 'id', type: 'string'}],
                data: <?= json_encode($tipopersona) ?>
            }
        });

        Ext.define('ComboRiesgo', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-riesgo',
            store: ['Mínimo', 'Medio', 'Alto']
        });

        Ext.define('ComboSiNo', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-si-no',
            store: ['Sí', 'No']
        });



        var tabPanel = new Ext.tab.Panel({
            id: 'panelControlFianciero',
            items: [{
                    title: 'General',
                    items: [{
                            xtype: 'fieldset',
                            title: 'Nuevos Datos para el Cliente',
                            width: 655,
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
                                    title: 'Circular 170',
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
                                            height: 45,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 2,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'datefield',
                                                    fieldLabel: 'Diligenciado',
                                                    name: 'fchcircular',
                                                    width: 240,
                                                    columnWidth: 0.4,
                                                    forceSelection: true
                                                }, {
                                                    xtype: 'combo-riesgo',
                                                    hideLabel: false,
                                                    fieldLabel: 'Nivel de Riesgo',
                                                    labelWidth: 100,
                                                    name: 'nvlriesgo',
                                                    width: 240,
                                                    forceSelection: true
                                                }]
                                        }]
                                }, {
                                    xtype: 'fieldset',
                                    title: 'Superintendencia de Sociedades',
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
                                            height: 45,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 2,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'combo-si-no',
                                                    value: '',
                                                    fieldLabel: 'Reportado',
                                                    name: 'leyinsolvencia',
                                                    width: 160,
                                                    columnWidth: 0.4,
                                                    forceSelection: true
                                                }, {
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Comentario',
                                                    labelWidth: 100,
                                                    name: 'comentario',
                                                    width: 350,
                                                }]
                                        }]
                                }, {
                                    xtype: 'fieldset',
                                    title: 'Lista OFAC',
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
                                            height: 45,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 2,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'combo-si-no',
                                                    value: '',
                                                    fieldLabel: 'Reportado',
                                                    name: 'listaclinton',
                                                    width: 160,
                                                    columnWidth: 0.4,
                                                    forceSelection: true
                                                }, {
                                                    xtype: 'combo-nit',
                                                    hideLabel: false,
                                                    fieldLabel: 'Tipo de NIT',
                                                    labelWidth: 100,
                                                    name: 'tipo',
                                                    width: 350,
                                                    forceSelection: true
                                                }]
                                        }]

                                }, {
                                    xtype: 'fieldset',
                                    title: 'Certificaciones',
                                    width: 620,
                                    height: 120,
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
                                                flex: 2,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'hiddenfield',
                                                    name: 'idcliente'
                                                }, {
                                                    xtype: 'combo-si-no',
                                                    value: '',
                                                    fieldLabel: 'ISO',
                                                    name: 'iso',
                                                    width: 160,
                                                    columnWidth: 0.4,
                                                    forceSelection: true
                                                }, {
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: '¿Cual?',
                                                    labelWidth: 100,
                                                    name: 'iso_detalles',
                                                    width: 160,
                                                }, {
                                                    xtype: 'combo-si-no',
                                                    hideLabel: false,
                                                    fieldLabel: 'BASC',
                                                    labelWidth: 100,
                                                    name: 'basc',
                                                    width: 160,
                                                    forceSelection: true
                                                }]
                                        }, {
                                            xtype: 'fieldcontainer',
                                            hideLabel: true,
                                            combineErrors: true,
                                            height: 45,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 2,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'combo-si-no',
                                                    value: '',
                                                    fieldLabel: '¿Otro Certificado?',
                                                    labelWidth: 165,
                                                    name: 'otro_cert',
                                                    width: 260,
                                                    columnWidth: 0.4,
                                                    forceSelection: true
                                                }, {
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: '¿Cual?',
                                                    labelWidth: 80,
                                                    name: 'otro_detalles',
                                                    width: 220,
                                                }]
                                        }]
                                }]
                        }]
                }, {
                    title: 'Info. Tributaria',
                    autoScroll: true,
                    height: 400,
                    items: [{
                            xtype: 'fieldset',
                            title: 'Nuevos Datos para el Cliente',
                            width: 640,
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
                                    title: 'Persona',
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
                                            height: 80,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 2,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'combo-persona',
                                                    hideLabel: false,
                                                    fieldLabel: 'Tipo Persona',
                                                    labelWidth: 100,
                                                    id: 'tipopersona',
                                                    name: 'tipopersona',
                                                    width: 240,
                                                    forceSelection: true,
                                                    listeners: {
                                                        select: {
                                                            fn: function (combo, record, eOpts) {
                                                                if (combo.value == "2") {
                                                                    fieldsetPersonaJuridica.setVisible(true);
                                                                } else {
                                                                    fieldsetPersonaJuridica.setVisible(false);
                                                                }
                                                            }
                                                        }
                                                    }
                                                }, {
                                                    xtype: 'combo-sectoreconomico',
                                                    hideLabel: false,
                                                    fieldLabel: 'Sector Económico',
                                                    labelWidth: 100,
                                                    id: 'sectoreconomico',
                                                    name: 'sectoreconomico',
                                                    width: 280,
                                                    forceSelection: true,
                                                    listeners: {
                                                        select: {
                                                            fn: function (combo, record, eOpts) {

                                                            }
                                                        }
                                                    }
                                                }, {
                                                    xtype: 'datefield',
                                                    fieldLabel: 'Fecha de Constitución',
                                                    name: 'fechaconstitucion',
                                                    id: 'fechaconstitucion',
                                                    width: 235,
                                                    forceSelection: false
                                                }]
                                        }]
                                },
                                fieldsetPersonaJuridica
                            ]
                        }]
                }, {
                    title: 'Info. financiera',
                    id: 'finan',
                    items: [
                        gridInfoFinanciera
                    ]
                }, {
                    title: 'Documentos',
                    id: 'documentosTab',
                    items: [
                        gridControlFinanciero
                    ]
                }]
        });

        Ext.create('Ext.form.Panel', {
            title: 'Control Financiero de Documentos.<br /><?= $razonSocial ?>',
            stripeRows: true,
            height: 535,
            width: 660,
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
                    panel.getForm().setValues(<?= json_encode($data) ?>);
                    recarga();
                }
            },
            buttons: [{
                    id: 'bntGuardar',
                    text: 'Guardar',
                    handler: function () {

                        var me = this;
                        var form = me.up('form').getForm();
                        var data = form.getFieldValues();
                        var str = JSON.stringify(data);

                        if (form.isValid()) {
                            var store = storeControlFinanciero;
                            x = 0;
                            changes = [];
                            for (var i = 0; i < store.getCount(); i++) {
                                var record = store.getAt(i);
                                    if (record.get('seleccionado')){
                                    
                                        record.data.id = record.id
                                        changes[x] = record.data;
                                        x++;
                                    }
                            }
                            var strGrid = JSON.stringify(changes);
                            
                            var store = storeInfoFinanciera;
                            x = 0;
                            changes = [];
                            for (var i = 0; i < store.getCount(); i++) {
                                var record = store.getAt(i);
                                       if (Ext.Object.getSize(record.getChanges()) != 0) {
                                    
                                        record.data.id = record.id
                                        changes[x] = record.data;
                                        x++;
                                       }
                            }
                            var strGridFinanciera = JSON.stringify(changes);
                            
                            

                            Ext.Ajax.request({
                                waitMsg: 'Guardando cambios...',
                                url: '<?= url_for('clientes/actualizarControlFinanciero') ?>',
                                params: {
                                    datos: str,
                                    datosGrid: strGrid,
                                    datosGridFinanciera: strGridFinanciera
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
                                    var store = gridControlFinanciero.getStore();
                                    store.reload();
                                    storeInfoFinanciera.reload();
                                    ids = res.ids;
                                    if (res.ids) {
                                        for (i = 0; i < ids.length; i++) {
                                            var rec = store.getById(ids[i]);
                                            rec.commit();
                                        }
                                        Ext.MessageBox.alert("Mensaje", 'Información almacenada correctamente<br>');
                                        recarga();
                                    }
                                }
                            });
                        }

                    }
                }, {
                    text: 'Cancelar',
                    handler: function () {
                        window.location.replace("/colsys_php/clientes_financ.php");
                    }
                }
            ],
            renderTo: Ext.get('se-form')
        });

    });
    function calculo() {
        var activosSMMLV = Ext.getCmp("activosSMMLV");
        var indiceliquidez = Ext.getCmp("indiceliquidez");
        var indiceendeudamiento = Ext.getCmp("indiceendeudamiento");
        var pruebaacida = Ext.getCmp("pruebaacida");
        var ino = Ext.getCmp("ino");

        var activostotales = Ext.getCmp("activostotales").value;
        var activoscorrientes = Ext.getCmp("activoscorrientes").value;
        var pasivostotales = Ext.getCmp("pasivostotales").value;
        var pasivoscorrientes = Ext.getCmp("pasivoscorrientes").value;
        var inventarios = Ext.getCmp("inventarios").value;
        var patrimonios = Ext.getCmp("patrimonios").value;
        var utilidades = Ext.getCmp("utilidades").value;
        var ventas = Ext.getCmp("ventas").value;

        <? if ($minimo) { ?>
            activosSMMLV.setValue(activostotales /<?= $minimo ?>);
        <? } ?>
        if (pasivoscorrientes != 0) {
            indiceliquidez.setValue(activoscorrientes / pasivoscorrientes);
        } else {
            indiceliquidez.setValue("Imposible Calcular");
        }
        if (activostotales != 0) {
            indiceendeudamiento.setValue(pasivostotales / activostotales);
        } else {
            indiceendeudamiento.setValue("Imposible Calcular");
        }
        if (pasivoscorrientes != 0) {
            pruebaacida.setValue((activoscorrientes - inventarios) / pasivoscorrientes);
        } else {
            pruebaacida.setValue("Imposible Calcular");
        }
    }
    function recarga() {

        var tip = Ext.getCmp("tipopersona");

        if (tip != "") {
           // var activostotales = Ext.getCmp("activostotales").value;
            var fechconstitucion = Ext.getCmp("fechaconstitucion").value;
            var tipopersona = Ext.getCmp("tipopersona");
            var sectoreconomico = Ext.getCmp("sectoreconomico");
            var grancontribuyente = Ext.getCmp("grancontribuyente");
            var sectoreconomico = Ext.getCmp("sectoreconomico");
            var uap = Ext.getCmp("uap");

            if (tipopersona.value == 2) {
                fieldsetPersonaJuridica.setVisible(true);
            }

            var tipo = "";

            if (tipopersona.value == 1 && sectoreconomico.value == 10) {  //comercio y persona natural
                tipo = "ca_persona_natural_comerciante";
            } else {
                if (tipopersona.value == 1) {
                    tipo = "ca_persona_natural";
                } else {
                    if (tipopersona.value == 2) {
                        tipo = "ca_perjuridica";

                        if (grancontribuyente.value || uap.value) {
                            tipo = "ca_gran_contribuyente";
                        }
                    }
                }
            }
            if (tipo.toString() != "" && fechconstitucion.toString() != "") {
                var store = gridControlFinanciero.getStore();
                store.load({
                    params: {
                        idcliente: <?= $idcliente ?>,
                        tipo: tipo,
                        fechconstitucion: fechconstitucion,
                    }
                });
                gridControlFinanciero.setVisible(true);



            }
        }
    }
</script>