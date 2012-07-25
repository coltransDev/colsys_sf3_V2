<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_component("widgets", "widgetCiudad");
include_component("widgets","widgetAgente");
include_component("widgets","widgetSucursales");

?>
<script type="text/javascript">
    FormMenuImpresionblPanel = function( config ){
        Ext.apply(this, config);



        FormMenuImpresionblPanel.superclass.constructor.call(this, {
            activeTab:0,
            title:'IMPRESION BLS EN DESTINO',
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
                                    height: 200,
                                    bodyStyle: 'padding-left:15px;',
                                    items: [
                                        {
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha Inicial',
                                            id: 'fechaInicial',
                                            name : 'fechaInicial',
                                            format: 'Y-m-d',
                                            value: '<?=$fechaInicial?>'//'<?//=date("2011-12-31")?>'
                                        },
                                        {
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha Final',
                                            name : 'fechaFinal',
                                            id: 'fechaFinal',
                                            format: 'Y-m-d',
                                            value: '<?=$fechaFinal?>'
                                        }]
                                }]
                        },
                        {
                            layout: 'form',
                            labelAlign: 'top',
                            items: [
                                {
                                    xtype: 'fieldset',
                                    title: 'Parámetros',
                                    id:"parametros",
                                    width: 300,
                                    height: 200,
                                    bodyStyle: 'padding-left:15px;',
                                    items: [
                                        new WidgetCiudad({
                                            fieldLabel: 'Origen',
                                            id: 'origen',
                                            idciudad:"origen",
                                            hiddenName:"idorigen",
                                            tipo:"",
                                            impoexpo: "<?= Constantes::TRIANGULACION ?>",
                                            value:"<?= $origen ?>",
                                            hiddenValue:"<?= $idorigen ?>"
                                        }),
                                        new WidgetAgente({
                                            fieldLabel: 'Agente',
                                            linkImpoExpo: "<?= constantes::IMPO ?>",
                                            linkListarTodos: "all",
                                            id:"agente",
                                            hiddenName:"idagente",
                                            width:250,
                                            value:"<?=$agente ?>",
                                            hiddenValue:"<?=$idagente ?>"
                                        }),
                                        new WidgetSucursales({fieldLabel: 'Sucursal',
                                            id:"idSucursal",
                                            hiddenName:"sucursal",
                                            width:120,
                                            value:"<?=$idSucursal?>",
                                            hiddenValue:"<?=$sucursal ?>"
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

    Ext.extend(FormMenuImpresionblPanel, Ext.Panel, {

    });
</script>