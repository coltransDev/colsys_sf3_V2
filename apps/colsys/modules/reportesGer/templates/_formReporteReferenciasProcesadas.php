<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$annos = $sf_data->getRaw("annos");
$meses = $sf_data->getRaw("meses");
$sufijos = $sf_data->getRaw("sufijos");
$sucursales = $sf_data->getRaw("sucursales");
$traficos = $sf_data->getRaw("traficos");
$ciudades = $sf_data->getRaw("ciudades");
?>

<style>
    /*Inicio Julio*/

    .x-panel-header-default-horizontal {
        padding: 0;
    }

    .x-panel-header-title-default {
        color: #157fcc;
        font-family: helvetica,arial,verdana,sans-serif;
        font-size: 12px;
        font-weight: 100;
        line-height: 14px;
    }

    .x-tab-bar-default-top > .x-tab-bar-body-default {
        padding: 0;
    }

    .x-autocontainer-innerCt {
        display: table-cell;
        height: 100%;
        vertical-align: top;
    }
    .x-border-box, .x-border-box * {
        box-sizing: border-box;
    }


    .x-border-box, .x-border-box * {
        box-sizing: border-box;
    }
    .x-autocontainer-innerCt {
        display: table-cell;
        height: 100%;
        vertical-align: top;
    }
    .x-autocontainer-innerCt {
        display: table-cell;
        height: 100%;
        vertical-align: top;
    }
    .x-border-box, .x-border-box * {
        box-sizing: border-box;
    }

    .x-panel-body-default {
        color: #3e4752;
        font-family: "Proxima Nova","Helvetica Neue",Helvetica,Arial,sans-serif;
        font-size: 12px;
        font-weight: 300;
    }

    .x-tab-inner-default {
        color: black;
        font: 300 12px/16px helvetica,arial,verdana,sans-serif;
        max-width: 100%;
    }
    .tool_in_tabpanel {
        right: 0px !important;
        left: auto !important;
        top: 3px !important;
    }
    .no-icon {
        display : none;
        background-image:url('ext/resources/images/default/s.gif') !important;
    }

    /*Fin Julio*/
    .rowVencido {
        background-color: #9999CC !important;
        color:white;
    }
    .rowRojo {
        background-color: #FF0000 !important;
        color:white;
    }
    .rowAmarillo{
        background-color: #FFFF00 !important;
        color:black;
    }    
    .rowVerde{
        background-color: #04B404 !important;
        color:white;
    }    
    .rowOk{
        background-color: #1D3F99 !important;
        color:white;
    }    
</style>


<table width="815" align="center">
    <tr>
        <td style="text-align: center">
            <div id="se-form"></div><br>
        </td>
    </tr>
</table>

<table width="815" align="center">
    <tr>
        <td style="text-align: center">
            <div id="se-report"></div><br>
        </td>
    </tr>
</table>

<table width="815" align="center">
    <tr>
        <td class="rowOk" style="text-align: center; font-weight: bold">
            <div>Convenciones</div><br>
        </td>
        <td class="rowVencido">
            <div>No se Reportó</div><br>
        </td>
        <td class="rowRojo">
            <div>Menos de 24 Horas</div><br>
        </td>
        <td class="rowAmarillo">
            <div>Próximo a vencer</div><br>
        </td>
        <td class="rowVerde">
            <div>Normal</div><br>
        </td>
        <td class="rowOk">
            <div>Reportado a Tiempo</div><br>
        </td>
    </tr>
</table>

<script type="text/javascript">
    Ext.Loader.setConfig({
        enabled: true,
        paths: {
            'Ext.ux': '../js/ext5/examples/ux/',
        }
    });

    Ext.require([
        'Ext.ux.form.MultiSelect'
    ]);

    Ext.onReady(function () {
        Ext.create('Ext.grid.Panel', {
            id: 'gridReport',
            renderTo: Ext.get('se-report'),
            bodyPadding: '0, 0, 0, 0',
            columnLines: true,
            columns: [
                {text: "Referencia", flex: 1, dataIndex: 'referencia'},
                {text: "Estado", dataIndex: 'std_cerrado'},
                {text: "Doc.Transporte", flex: 1, dataIndex: 'doctransporte'},
                {text: "Fch.Llegada", renderer: Ext.util.Format.dateRenderer('Y-m-d'), dataIndex: 'fchllegada'},
                {text: "Fch.Radicacion", renderer: Ext.util.Format.dateRenderer('Y-m-d'), dataIndex: 'fchmuisca'},
                {text: "Usu.Radicacion", dataIndex: 'usumuisca'}
            ],
            store: Ext.create('Ext.data.Store', {
                autoLoad: false,
                fields: [
                    {name: 'referencia', type: 'string'},
                    {name: 'std_cerrado', type: 'string'},
                    {name: 'doctransporte', type: 'string'},
                    {name: 'fchllegada', type: 'date', format: 'Y-m-d'},
                    {name: 'fchmuisca', type: 'date', format: 'Y-m-d'},
                    {name: 'observaciones', type: 'string'}
                ],
                proxy: {
                    type: 'ajax',
                    url: '<?= url_for('reportesGer/reporteReferenciasProcesadasListExt5') ?>',
                    reader: {
                        type: 'json',
                        root: 'root'
                    }
                }
            }),
            plugins: [{
                    ptype: 'rowexpander',
                    rowBodyTpl: new Ext.XTemplate(
                            '<p style=\'text-align: justify; font-size:12px;\'><b>Observaciones:</b> {observaciones}</p>'
                            )
                }],
            viewConfig: {
                getRowClass: function (record, rowIndex, rowParams, store) {
                    return record.get('color');
                }
            },
            collapsible: true,
            animCollapse: false
        });

        Ext.create('Ext.form.Panel', {
            renderTo: Ext.get('se-form'),
            title: 'Reporte Referencias Procesadas',
            bodyPadding: '0, 0, 0, 0',
            layout: 'column',
            standardSubmit: true,
            items: [{
                    xtype: 'fieldset',
                    columnWidth: 0.99,
                    collapsible: false,
                    layout: 'column',
                    padding: '0, 0, 0, 0',
                    items: [{
                            xtype: 'multiselect',
                            msgTarget: 'side',
                            title: 'Años',
                            name: 'anio',
                            id: 'anio',
                            allowBlank: false,
                            height: 174,
                            width: 105,
                            store: <?= json_encode($annos) ?>,
                            style: 'text-align: left',
                            ddReorder: false
                        }, {
                            xtype: 'multiselect',
                            msgTarget: 'side',
                            title: 'Meses',
                            name: 'mes',
                            id: 'mes',
                            allowBlank: false,
                            height: 330,
                            width: 115,
                            store: {
                                fields: [{name: 'idmes', type: 'string'}, {name: 'nommes', type: 'string'}],
                                data: <?= json_encode($meses) ?>
                            },
                            style: 'text-align: left',
                            valueField: 'idmes',
                            displayField: 'nommes',
                            ddReorder: false
                        }, {
                            xtype: 'multiselect',
                            msgTarget: 'side',
                            title: 'Sufijos',
                            name: 'sufijo',
                            id: 'sufijo',
                            allowBlank: false,
                            height: 330,
                            width: 135,
                            store: <?= json_encode($sufijos) ?>,
                            style: 'text-align: left',
                            ddReorder: false
                        }, {
                            xtype: 'multiselect',
                            msgTarget: 'side',
                            title: 'Traficos',
                            name: 'trafico',
                            id: 'trafico',
                            allowBlank: false,
                            height: 330,
                            width: 150,
                            store: {
                                fields: [{name: 'idTrafico', type: 'string'}, {name: 'trafico', type: 'string'}],
                                data: <?= json_encode($traficos) ?>
                            },
                            style: 'text-align: left',
                            valueField: 'idTrafico',
                            displayField: 'trafico',
                            ddReorder: false
                        }, {
                            xtype: 'multiselect',
                            msgTarget: 'side',
                            title: 'Destinos',
                            name: 'destino',
                            id: 'destino',
                            height: 330,
                            width: 150,
                            store: {
                                fields: [{name: 'idCiudad', type: 'string'}, {name: 'ciudad', type: 'string'}],
                                data: <?= json_encode($ciudades) ?>
                            },
                            style: 'text-align: left',
                            valueField: 'idCiudad',
                            displayField: 'ciudad',
                            ddReorder: false
                        }, {
                            xtype: 'multiselect',
                            msgTarget: 'side',
                            title: 'Sucursales',
                            name: 'sucursal',
                            id: 'sucursal',
                            allowBlank: false,
                            height: 330,
                            width: 135,
                            store: <?= json_encode($sucursales) ?>,
                            style: 'text-align: left',
                            ddReorder: false
                        }]
                }
            ],
            buttons: [{
                    text: 'Limpiar',
                    handler: function () {
                        this.up('form').getForm().reset();
                    }
                }, {
                    text: 'Generar Reporte',
                    formBind: true, //only enabled once the form is valid
                    disabled: true,
                    handler: function () {
                        var form = this.up('form').getForm();
                        var data = form.getFieldValues();
                        var store = Ext.getCmp('gridReport').getStore();
                        store.getProxy().extraParams = {
                            impoexpo: 'Importación',
                            transporte: 'Marítimo',
                            anio: data.anio,
                            mes: data.mes,
                            sufijo: data.sufijo,
                            trafico: data.trafico,
                            sucursal: data.sucursal,
                            destino: data.destino
                        };
                        store.load();
                    }
                }]
        });

    })
</script>
