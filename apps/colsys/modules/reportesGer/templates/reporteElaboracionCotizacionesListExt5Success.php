<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$rs = $sf_data->getRaw("rs");
$dateInicial = $sf_data->getRaw("dateInicial");
$dateFinal = $sf_data->getRaw("dateFinal");
?>

<script>
    Ext.Loader.setConfig({
    enabled: true,    
    paths: {
        'Chart':'../../../js/ext5/src/',
        'Ext.ux.exporter':'../../../js/ext5/examples/ux/exporter/'
    }
});
    
    Ext.require([
    'Ext.grid.*',    
    'Ext.form.Panel',    
    'Chart.ux.Highcharts',
    'Chart.ux.Highcharts.PieSerie',
    'Chart.ux.Highcharts.ColumnSerie',
    'Ext.ux.exporter.Exporter'
    ]);
    
</script>

<table width="900" align="center">
    <td style="text-align: center">
        <div id="se-form"></div><br>
    </td>
</table>
<script type="text/javascript">

    Ext.onReady(function () {
        
        Ext.define('ElaboracionCotizaciones', {
            extend: 'Ext.data.Model',
            fields: [
                {name: 'ca_fchcreado', type: 'string'},
                {name: 'ca_nit', type: 'string'},
                {name: 'ca_compania', type: 'string'},
                {name: 'ca_ncompleto_cn', type: 'string'},
                {name: 'ca_login', type: 'string'},
                {name: 'ca_consecutivo', type: 'string'},
                {name: 'ca_usucreado', type: 'string'}
            ]
        });
        
        var storeElaboracionCotizaciones = Ext.create('Ext.data.Store', {
            autoLoad: false,
            model: 'ElaboracionCotizaciones',
            data: <?= json_encode($rs)?>,
            groupField: 'ca_usucreado'
        });
        
        
        new Ext.grid.GridPanel({
            id: 'gridEncuestaVisita',
            title: 'Reporte de Elaboración de cotizaciones entre <?=$dateInicial?> y <?=$dateFinal?>',
            store: storeElaboracionCotizaciones,
            renderTo: 'se-form',
            stripeRows: true,
            height: 500,
            width: 960,
            features: [{
                ftype: 'groupingsummary',
                groupHeaderTpl: [
                    '<div style="text-align: left;">{name:this.formatName}</div>',
                    {
                        formatName: function(name) {
                            return Ext.String.trim(name);
                        }
                    }]
            }],
            style: {
                "margin-top": "20px",
                "margin-left": "auto",
                "margin-right": "auto"
            },
            columns: [{
                    header: 'Consecutivo',
                    width: 125,
                    dataIndex: 'ca_consecutivo',
                    hideable: false,
                    summaryType: 'count',
                    summaryRenderer: function(value, summaryData, dataIndex) {
                        return ((value === 0 || value > 1) ? '(' + value + ' Cotizaciones)' : '(1 Cotización)');
                    }
                    
                }, {
                    header: 'Nit',
                    width: 100,
                    dataIndex: 'ca_nit'
                }, {
                    header: 'Compañía',
                    autoSizeColumn: true ,
                    width: 350,
                    dataIndex: 'ca_compania'
                }, {
                    header: 'Vendedor',
                    width: 240,
                    dataIndex: 'ca_ncompleto_cn',
                }, {
                    header: 'Fecha Creación',
                    dataIndex: 'ca_fchcreado',
                    width: 150
                }, {
                    header: 'Creado por',
                    width: 0,
                    hidden: false,
                    dataIndex: 'ca_usucreado',
                }],
            tbar: [{
                xtype: 'exporterbutton',
                text: 'XLS',
                iconCls: 'csv',
                //format:'excel'
            }],
                
            renderTo: Ext.get('se-form'),
            
            bbar: Ext.create('Ext.PagingToolbar', {
                //store: storeElaboracionCotizaciones,
                displayInfo: true,
                displayMsg: 'Registros {0} - {1} of {2}',
                emptyMsg: "No hay registros"
            })
        });
    });
</script>
