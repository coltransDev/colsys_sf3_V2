<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_component("widgets", "widgetPais");
include_component("widgets","widgetTransporte");

?>
<script type="text/javascript">
    FormMenuIndicadoresPanel = function( config ){
        Ext.apply(this, config);



        FormMenuIndicadoresPanel.superclass.constructor.call(this, {
            activeTab:0,
            title:'FALABELLA',
            layout:'form',
            width: 100,
            id: 'estadisticas',
            labelWidth: 75,
            items:[
                {
                    layout:'table',
                    layoutConfig: {
                        // The total column count must be specified here
                        columns: 2
                    },
                    border: false,
                    defaults: {
                        // applied to each contained panel
                        bodyStyle:'padding-right:35px',
                        border: false
                    },
                    items:[
                        {
                            layout: 'form',
                            labelAlign: 'top',
                            items: [
                                {
                                    xtype: 'fieldset',
                                    title: 'Fechas de Corte',
                                    id:"fch_corte",
                                    width: 210,
                                    height: 140,
                                    bodyStyle: 'padding-left:15px;',
                                    items: [
                                        {
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha Inicial',
                                            name : 'fechaInicial',
                                            format: 'Y-m-d',
                                            value: '<?=$fechainicial?>'//'<?//=date("2011-12-31")?>'
                                        },
                                        {
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha final',
                                            name : 'fechaFinal',
                                            format: 'Y-m-d',
                                            value: '<?=$fechafinal?>'
                                        }]
                                }]
                        },
                        {
                            layout: 'form',
                            labelAlign: 'top',
                            items: [
                                {
                                    xtype: 'fieldset',
                                    title: 'Origen',
                                    id:"tra_origen",
                                    width: 300,
                                    height: 140,
                                    bodyStyle: 'padding-left:15px;',
                                    items: [
                                        new WidgetPais({title: 'Pais origen',
                                                    fieldLabel: 'Pais origen',
                                                        id: 'pais_origen',
                                                        name: 'pais_origen',
                                                        hiddenName: "idpais_origen",
                                                        pais:"<?=$pais_origen?>",
                                                        value:"<?=$idpais_origen?>",
                                                        pais:"todos" 
                                                        }),
                                        new WidgetTransporte({fieldLabel: 'Transporte',
                                            id: 'transporte',
                                            name: 'transporte',
                                            hiddenName: "idtransporte",
                                            value:"<?=$transporte?>",
                                            hiddenValue:"<?=$idtransporte?>"
                                        })
                                     ]
                                 }]
                        },
                        {
                            xtype:'hidden',
                            name:"opcion",
                            value:"buscar"
                        }]
                }]
        });

    };

    Ext.extend(FormMenuIndicadoresPanel, Ext.Panel, {

    });
</script>