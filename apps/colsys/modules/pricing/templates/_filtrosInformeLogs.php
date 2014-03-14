<?php
include_component("widgets", "widgetSucursales");
include_component("widgets", "widgetCliente");
include_component("widgets", "widgetImpoexpo");
include_component("widgets", "widgetTransporte");
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetPais");
include_component("widgets", "widgetCiudad");
include_component("widgets", "widgetLinea");
include_component("widgets", "widgetConcepto");
include_component("widgets", "widgetUsuario");

//$cliente = $sf_data->getRaw("cliente");
?>
<script language="javascript">
    var ocultarTodosCampos = function(){
        Ext.getCmp('trayecto').hide();
        Ext.getCmp('impoexpo').hide();
        Ext.getCmp('transporte').hide();
        Ext.getCmp('modalidad').hide();
        Ext.getCmp('idConcepto').hide();
        Ext.getCmp('idlinea').hide();
        Ext.getCmp('pais_origen').hide();
        Ext.getCmp('corigen').hide();
        Ext.getCmp('usuario').hide();
    }
    
    var camposFletes = function(){
        Ext.getCmp('trayecto').show();
        Ext.getCmp('impoexpo').show();
        Ext.getCmp('transporte').show();
        Ext.getCmp('modalidad').show();
        Ext.getCmp('idConcepto').show();
        Ext.getCmp('idlinea').show();
        Ext.getCmp('pais_origen').show();
        Ext.getCmp('corigen').hide();
        Ext.getCmp('corigen').setValue(null);
        Ext.getCmp('usuario').show();
    }
    
    var camposRecargosxCiudad = function(){
        Ext.getCmp('trayecto').hide();
        Ext.getCmp('origen').setValue(null);
        Ext.getCmp('destino').setValue(null);
        Ext.getCmp('impoexpo').show();
        Ext.getCmp('transporte').show();
        Ext.getCmp('modalidad').show();
        Ext.getCmp('idConcepto').hide();
        Ext.getCmp('idConcepto').setValue(null);
        Ext.getCmp('idlinea').hide();
        Ext.getCmp('pais_origen').show();
        Ext.getCmp('corigen').show();
        Ext.getCmp('usuario').show();
    }
    
    var camposRecargosxConcepto = function(){
        Ext.getCmp('trayecto').show();
        Ext.getCmp('impoexpo').show();
        Ext.getCmp('transporte').show();
        Ext.getCmp('modalidad').show();
        Ext.getCmp('idConcepto').hide();
        Ext.getCmp('idConcepto').setValue(null);
        Ext.getCmp('idlinea').show();
        Ext.getCmp('pais_origen').hide();
        Ext.getCmp('pais_origen').setValue(null);
        Ext.getCmp('corigen').hide();
        Ext.getCmp('corigen').setValue(null);
        Ext.getCmp('usuario').show();
    }
    
    var camposRecargosxLinea = function(){
        Ext.getCmp('trayecto').hide();
        Ext.getCmp('origen').setValue(null);
        Ext.getCmp('destino').setValue(null);
        Ext.getCmp('impoexpo').show();
        Ext.getCmp('transporte').show();
        Ext.getCmp('modalidad').show();
        Ext.getCmp('idConcepto').hide();
        Ext.getCmp('idConcepto').setValue(null);
        Ext.getCmp('idlinea').show();
        Ext.getCmp('pais_origen').show();
        Ext.getCmp('corigen').hide();
        Ext.getCmp('corigen').setValue(null);
        Ext.getCmp('usuario').show();
    }
    
    var camposTrayectos = function(){
        Ext.getCmp('trayecto').show();
        Ext.getCmp('impoexpo').show();
        Ext.getCmp('transporte').show();
        Ext.getCmp('modalidad').show();
        Ext.getCmp('idConcepto').hide();
        Ext.getCmp('idConcepto').setValue(null);
        Ext.getCmp('idlinea').show();
        Ext.getCmp('pais_origen').hide();
        Ext.getCmp('pais_origen').setValue(null);
        Ext.getCmp('corigen').hide();
        Ext.getCmp('corigen').setValue(null);
        Ext.getCmp('usuario').show();
    }
    
    var camposFechasDeshabilitar = function(){
        Ext.getCmp("fechaInicial").allowBlank = true;
        Ext.getCmp("fechaFinal").allowBlank = true;
        Ext.getCmp("fechaInicial").disable()
        Ext.getCmp("fechaFinal").disable()
        Ext.getCmp("fechaInicial").setValue(null)
        Ext.getCmp("fechaFinal").setValue(null)
    }
    
    var camposFechasHabilitar = function(){
        Ext.getCmp("fechaInicial").enable()
        Ext.getCmp("fechaFinal").enable()
        Ext.getCmp("fechaInicial").allowBlank = false;
        Ext.getCmp("fechaFinal").allowBlank = false;
    }


    var tabs = new Ext.FormPanel({
    labelWidth: 75,
            frame:true,
            title: 'Informe Logs Pricing',
            bodyStyle:'padding:5px 5px 0',
            width: 600,
            autoHeight:true,
            deferredRender:false,
            standardSubmit: true,
            id: 'formPanel',
            items: [
                {
                    layout:'table',
                    layoutConfig: {
                    // The total column count must be specified here
                    columns: 1
                    },
                    border: false,
                    items:[
                        {
                            layout: 'form',
                            labelAlign: 'top',
                            bodyStyle:'padding-right:35px',
                            items: [
                                {
                                    xtype:'fieldset',
                                    title: 'Tipo de Informe',
                                    width: 545,
                                    height: 80,
                                    collapsed: false,
                                    items: [
                                        {
                                            xtype: 'radiogroup',
                                            itemCls: 'x-check-group-alt',
                                            allowBlank: false,
                                            columns: 2,
                                            id: 'tipoTarifa',
                                            items: [
                                                {boxLabel: 'Tarifas Actuales', name: 'typetar', inputValue: 1, <?= $typetar == 1 ? "checked:'true'" : "" ?>},
                                                {boxLabel: 'Tarifas Históricas', name: 'typetar', inputValue: 2, <?= $typetar == 2 ? "checked:'true'" : "" ?>},
                                            ],
                                            listeners:{
                                               change: function(radiogroup, radio) {
                                                   //alert (radio.inputValue);
                                                    switch(radio.inputValue){
                                                        case 1:
                                                            camposFechasDeshabilitar();
                                                            break;
                                                        case 2:
                                                            camposFechasHabilitar();
                                                            break;
                                                    
                                                    }
                                                }
                                            }
                                        }]
                                }]
                        }]
                },
                {
                    layout:'table',
                    layoutConfig: {
                    // The total column count must be specified here
                    columns: 3
                    },
                    border: false,
                    items:[
                        {
                            layout: 'form',
                            labelAlign: 'top',
                            bodyStyle:'padding-right:35px',
                            items: [
                                {
                                    xtype:'fieldset',
                                    title: 'Informacion Logs',
                                    width: 300,
                                    height: 195,
                                    collapsed: false,
                                    items: [
                                        {
                                            xtype: 'radiogroup',
                                            itemCls: 'x-check-group-alt',
                                            allowBlank: false,
                                            columns: 1,
                                            id: 'tipo',
                                            items: [
                                            {boxLabel: 'Fletes', name: 'typelog', inputValue: 1, <?= $typelog == 1 ? "checked:'true'" : "" ?>},
                                            {boxLabel: 'Recargos x Ciudad', name: 'typelog', inputValue: 2, <?= $typelog == 2 ? "checked:'true'" : "" ?>},
                                            {boxLabel: 'Recargos x Concepto', name: 'typelog', inputValue: 3, <?= $typelog == 3 ? "checked:'true'" : "" ?>},
                                            {boxLabel: 'Recargos x Línea', name: 'typelog', inputValue: 4, <?= $typelog == 4 ? "checked:'true'" : "" ?>},
                                            {boxLabel: 'Trayectos', name: 'typelog', inputValue: 5, <?= $typelog == 5 ? "checked:'true'" : "" ?>}
                                            ],
                                            listeners: {
                                                change: function(radiogroup, radio) {
                                                    switch(radio.inputValue){
                                                        case 1:
                                                            camposFletes();
                                                            break;
                                                        case 2:
                                                            camposRecargosxCiudad();
                                                            break;
                                                        case 3:
                                                            camposRecargosxConcepto();
                                                            break;
                                                        case 4:
                                                            camposRecargosxLinea();
                                                            break;
                                                        case 5:
                                                            camposTrayectos();
                                                            break;
                                                    }
                                                }
                                            }
                                        }]
                            }]
                    },
                    {
                        layout: 'form',
                        labelAlign: 'top',
                        bodyStyle:'padding-right:35px;',
                        items: [
                            {
                                xtype:'fieldset',
                                title: 'Fechas de corte',
                                id:"fch_corte",
                                width: 210,
                                height: 195,
                                defaultType: 'textfield',
                                collapsed: false,
                                items: [
                                    {
                                        xtype:'datefield',
                                        fieldLabel: 'Fecha Inicial',
                                        name : 'fechaInicial',
                                        id : 'fechaInicial',
                                        format: 'Y-m-d',
                                        value: '<?= $fechaInicial ?>',
                                        tooltip: 'lo quw sea'
                                    },
                                    {
                                        xtype:'datefield',
                                        fieldLabel: 'Fecha Final',
                                        name : 'fechaFinal',
                                        id : 'fechaFinal',
                                        format: 'Y-m-d',
                                        value: '<?= $fechaFinal ?>'
                                    }]
                            }]
                    },
                    {
                        xtype:'hidden',
                        name:"opcion",
                        value:"buscar"
                    }]
                },
                {
                    xtype:'fieldset',
                    title: 'Filtros',
                    width: 350,
                    defaultType: 'textfield',
                    collapsed: false,
                    layout:"form",
                    items: [
                        {
                            xtype:'fieldset',
                            title: 'Trayecto',
                            id: 'trayecto',
                            autoHeight:true,
                            width: 300,
                            defaultType: 'textfield',
                            items:[
                                new WidgetCiudad({
                                fieldLabel: 'Origen',
                                        name: 'origen',
                                        hiddenName: 'idorigen',
                                        id: 'origen',
                                        width:100,
                                        //renderTo:'orig',
                                        value:'<?= $origen ?>',
                                        hiddenValue:'<?= $idorigen ?>'
                                }),
                                new WidgetCiudad({
                                fieldLabel: 'Destino',
                                        name: 'destino',
                                        hiddenName: 'iddestino',
                                        id: 'destino',
                                        width:100,
                                        //renderTo:'dest', 
                                        value:'<?= $destino ?>',
                                        hiddenValue:'<?= $iddestino ?>'
                                })
                            ]
                        },
                        new WidgetImpoexpo({fieldLabel: 'Impo/Expo',
                                id: 'impoexpo',
                                hiddenName: "impoexpo",
                                value:"<?= $impoexpo ?>",
                                width:200
                        }),
                        new WidgetTransporte({fieldLabel: 'Transporte',
                                id: 'transporte',
                                hiddenName: "transporte",
                                linkTransporte: "transporte",
                                linkImpoexpo: "impoexpo",
                                value:"<?= $transporte ?>",
                                width:200
                        }),
                        new WidgetModalidad({fieldLabel: 'Modalidad',
                                id: 'modalidad',
                                hiddenName: "modalidad",
                                linkTransporte: "transporte",
                                linkImpoexpo: "impoexpo",
                                value:"<?= $modalidad ?>",
                                width:200
                        }),
                        new WidgetConcepto({fieldLabel: 'Concepto',
                                id: 'idConcepto',
                                idconcepto:"concepto",
                                hiddenName: "idconcepto",
                                linkTransporte: "transporte",
                                linkModalidad: "modalidad",
                                value:"<?= utf8_encode($concepto) ?>",
                                hiddenValue:"<?= $idconcepto ?>",
                                width:200
                        }),
                        new WidgetPais({title: 'País',
                                fieldLabel: 'Pais origen',
                                id: 'pais_origen',
                                name: 'pais_origen',
                                hiddenName: "idpais_origen",
                                pais:"todos",
                                width:200,
                                value:"<?= $idpais_origen ?>"
                        }),
                        new WidgetCiudad({fieldLabel: 'Ciudad',
                                id: 'corigen',
                                idciudad:"corigen",
                                hiddenName:"idcorigen",
                                tipo:"3",
                                traficoParent:"pais_origen",
                                impoexpo: "impoexpo",
                                value:"<?= $corigen ?>",
                                width:200,
                                hiddenValue:"<?= $idcorigen ?>"
                        }),
                        new WidgetLinea({
                                fieldLabel: 'Línea',
                                linkTransporte: "transporte",
                                name:"linea",
                                id:"idlinea",
                                hiddenName: "idlinea",
                                value:"<?= $linea ?>",
                                hiddenValue:"<?=$idlinea ?>",
                                width:200
                        }),
                        new WidgetUsuario({fieldLabel: 'Usuario',
                                id:"usuario",
                                hiddenName:"idusuario",
                                width:200,
                                value:"<?= $usuario ?>",
                                hiddenValue:"<?= $idusuario ?>"
                        })
                    ]
                }],
                buttons: [{
                    text: 'Generar',
                    handler: function(){
                    var tp = Ext.getCmp("tab-panel");
                            var owner = Ext.getCmp("formPanel");
                            owner.getForm().getEl().dom.action = '<?= url_for("pricing/informeLogs") ?>';
                            owner.getForm().submit();
                    }
                }],
                listeners:{
                    render: function(){
                        ocultarTodosCampos();
                    },
                    afterrender:function(){
                        <? switch($typelog){
                            case 1: ?>
                                camposFletes();
                            <?  break;
                            case 2: ?>
                                camposRecargosxCiudad();
                            <?  break;
                            case 3: ?>
                                camposRecargosxConcepto();
                            <?  break; 
                            case 4: ?>
                                camposRecargosxLinea();
                            <? break;
                            case 5: ?>
                                camposTrayectos();
                            <? break;
                        }
                        switch ($typetar){
                            case 1: ?>
                                camposFechasDeshabilitar();
                                <?break;
                            case 2: ?>
                                camposFechasHabilitar();
                                <?break;
                        }?>
                    }
                }
    });
    tabs.render("container");
</script>