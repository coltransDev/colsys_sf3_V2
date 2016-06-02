<?php
include_component("widgets", "widgetSucursales");
include_component("widgets", "widgetCliente");
include_component("widgets", "widgetTransporte");
include_component("widgets", "widgetPais");
include_component("widgets", "widgetCiudad");

$cliente = $sf_data->getRaw("cliente");
?>
<script language="javascript">
    var bloquearIdg = function(){
        Ext.getCmp('meta_lcl').hide();
        Ext.getCmp('meta_fcl').hide();
        Ext.getCmp('meta_air').hide();        
        Ext.getCmp('tipo_idg').hide();
    }
    var desbloquearIdg = function(){
        Ext.getCmp('meta_lcl').show();
        Ext.getCmp('meta_fcl').show();
        Ext.getCmp('meta_air').show();
        Ext.getCmp('tipo_idg').show();        
    }
    
    var adminCampos = function (value){
        switch(value){
            case 1:
            case 2:
                Ext.getCmp("pais_origen").allowBlank = false;
                Ext.getCmp("transporte").allowBlank = false;
                break;
            case 3:
            case 4:
            case 5:
            case 6:
                Ext.getCmp("pais_origen").allowBlank = true;
                Ext.getCmp("transporte").allowBlank = true;
                break;
        }
    }
    
    var adminTransporte = function (value){
        switch(value){
            case '<?=  Constantes::AEREO?>':
                Ext.getCmp('meta_lcl').hide();
                Ext.getCmp("meta_lcl").allowBlank = true;
                Ext.getCmp('meta_fcl').hide();
                Ext.getCmp('meta_fcl').allowBlank = true;
                Ext.getCmp('meta_air').show();
                Ext.getCmp('meta_air').allowBlank = false;
                Ext.getCmp("desconsolidacion").hide();
                Ext.getCmp('tipo_idg').show(); 
                break;
            case '<?=  Constantes::MARITIMO?>':
                Ext.getCmp('meta_lcl').show();
                Ext.getCmp("meta_lcl").allowBlank = false;
                Ext.getCmp('meta_fcl').show();
                Ext.getCmp('meta_fcl').allowBlank = false;
                Ext.getCmp('meta_air').hide();
                Ext.getCmp('meta_air').allowBlank = true;
                Ext.getCmp("desconsolidacion").show();
                Ext.getCmp('tipo_idg').show(); 
                break;
            case '<?=  Constantes::TERRESTRE?>':
                alert("Esta opción no está disponible");
                bloquearIdg();
                break;
            case null:                            
                Ext.getCmp("meta_air").allowBlank = false;
                Ext.getCmp("meta_lcl").allowBlank = false;
                Ext.getCmp("meta_fcl").allowBlank = false;                
                desbloquearIdg();
                break;
        }
    } 
    
    var tabs = new Ext.FormPanel({
        labelWidth: 75,
        frame:true,
        title: 'Estadísticas Indicadores Clientes',
        bodyStyle:'padding:5px 5px 0',
        width: 900,
        autoHeight:true,
        deferredRender:false,
        standardSubmit: true,
        id: 'formPanel',        
        items: [{
            layout:'table',
            layoutConfig: {            
                columns: 3
            },
            border: false,
            defaults: {            
                autoHeight:true,                
            },
            items:[{
                layout: 'form',
                labelAlign: 'top',
                bodyStyle:'padding-right:35px',
                items: [{
                    xtype:'fieldset',
                    checkboxToggle:true,
                    title: 'Datos',
                    autoHeight:true,
                    width: 300,                    
                    defaultType: 'textfield',
                    collapsed: false,
                    items: [{
                            xtype:'hidden',
                            name:"opcion",
                            value:"buscar"
                        },
                        new WidgetCliente({
                            fieldLabel: 'Cliente',
                            id:"Cliente",
                            hiddenName:"idcliente",
                            bodyStyle: 'align: left',
                            width:220,
                            allowBlank:false,
                            value:"<?= $cliente ?>",
                            hiddenValue:"<?= $idcliente ?>"
                        }),
                        new WidgetPais({title: 'Pais origen',
                            fieldLabel: 'Pais origen',
                            id: 'pais_origen',
                            name: 'pais_origen',
                            hiddenName: "idpais_origen",
                            pais:"<?= $pais_origen ?>",
                            value:"<?= $idpais_origen ?>",
                            pais:"todos"                                
                        }),
                        {
                            xtype:'fieldset',
                            checkboxToggle:true,
                            title: 'Elegir Ciudad Origen (Opcional)',
                            id: 'topenOri',
                            checkboxName: 'checkOrigen',
                            width: 230,
                            defaultType: 'textfield',
                            collapsed: true,
                            items: [
                                new WidgetCiudad({fieldLabel: 'Ciudad Origen',
                                    id: 'corigen',
                                    idciudad:"corigen",
                                    hiddenName:"idcorigen",
                                    tipo:"3",
                                    traficoParent:"pais_origen",
                                    impoexpo: '<?=  Constantes::IMPO?>',
                                    value:"<?= $corigen ?>",
                                    width:200,
                                    hiddenValue:"<?= $idcorigen ?>"
                                }),
                            ],
                            listeners: {
                                collapse: function(p) {
                                    p.items.each(function(i) {
                                        i.disable();
                                    },
                                    this);
                                },
                                expand: function(p) {
                                    p.items.each(function(i) {
                                        i.enable();
                                    },
                                    this);
                                }
                            }
                        },
                        {
                            xtype:'fieldset',
                            checkboxToggle:true,
                            title: 'Elegir Ciudad Destino (Opcional)',
                            id: 'topenDes',
                            checkboxName: 'checkDestino',
                            autoHeight:true,
                            width: 230,
                            defaultType: 'textfield',
                            collapsed: true,
                            items: [
                                new WidgetCiudad({fieldLabel: 'Ciudad Destino',
                                    id: 'cdestino',
                                    idciudad:"cdestino",
                                    hiddenName:"idcdestino",
                                    width:200,
                                    tipo:"1",                                    
                                    impoexpo: '<?=  Constantes::EXPO?>',
                                    value:"<?= $cdestino ?>",                                    
                                    hiddenValue:"<?= $idcdestino ?>"
                                }),
                            ],
                            listeners: {
                                collapse: function(p) {
                                    p.items.each(function(i) {
                                        i.disable();
                                    },
                                    this);
                                },
                                expand: function(p) {
                                    p.items.each(function(i) {
                                        i.enable();
                                    },
                                    this);
                                }
                            }
                        },
                        new WidgetTransporte({fieldLabel: 'Transporte',
                            id: 'transporte',
                            name: 'transporte',
                            fieldLabel: 'Transporte',
                            hiddenName: "idtransporte",                                
                            width:219,
                            value:"<?= $transporte ?>",
                            hiddenValue:"<?= $idtransporte ?>",
                            listeners:{
                                select:function(field, record, index){                                                                   
                                    adminTransporte(record.data.valor);
                                }
                            }
                        }),
                        {
                            xtype:'datefield',
                            fieldLabel: 'Fecha Inicial',
                            name : 'fechaInicial',
                            format: 'Y-m-d',
                            allowBlank:false,
                            value: '<?= $fechainicial ?>',
                            tooltip: 'lo quw sea'
                        },
                        {
                            xtype:'datefield',
                            fieldLabel: 'Fecha Final',
                            name : 'fechaFinal',
                            format: 'Y-m-d',
                            allowBlank:false,
                            value: '<?= $fechafinal ?>'
                        }
                    ]
                }]
            },
            {
                layout: 'form',
                labelAlign: 'top',
                items: [{
                    xtype:'fieldset',
                    checkboxToggle:true,
                    title: 'Informacion IDG',
                    autoHeight:true,                        
                    width: 500,
                    collapsed: false,
                    items: [{
                        layout:'table',
                        align: 'stretch',
                        layoutConfig: {
                            columns: 2,
                            tableAttrs:{
                                style:{
                                    width: '100%',
                                    height: '100%'
                                }
                            }
                        },
                        border: false,
                        items: [{
                            layout: 'form',
                            labelAlign: 'top',
                            width: 280,
                            bodyStyle:'padding-right:15px',
                            items: [{
                                xtype: 'fieldset',
                                title: 'Tipo de IDG',
                                id:'tipo_idg',                                
                                items:[{
                                    xtype: 'radiogroup',
                                    itemCls: 'x-check-group-alt',
                                    allowBlank: false,
                                    columns: 1,
                                    items: [
                                        {boxLabel: 'Coordinación de Embarque', name: 'type_idg', inputValue: 1, <?= $typeidg == 1 ? "checked:'true'" : "" ?>},
                                        {boxLabel: 'Tiempo de Tránsito', name: 'type_idg', inputValue: 2, <?= $typeidg == 2 ? "checked:'true'" : "" ?>},
                                        {boxLabel: 'Oportunidad en el Zarpe/Fecha de Salida', name: 'type_idg', inputValue: 3, <?= $typeidg == 3 ? "checked:'true'" : "" ?>},
                                        {boxLabel: 'Oportunidad en la Llegada', name: 'type_idg', inputValue: 4, <?= $typeidg == 4 ? "checked:'true'" : "" ?>},
                                        {boxLabel: 'Oportunidad en elaboración de factura', name: 'type_idg', inputValue: 5, <?= $typeidg == 5 ? "checked:'true'" : "" ?>},
                                        {boxLabel: 'Oportunidad en la Desconsolidacion', id:"desconsolidacion", name: 'type_idg', inputValue: 6, <?= $typeidg == 5 ? "checked:'true'" : "" ?>}
                                    ],
                                    listeners: {
                                        change: function(radiogroup, radio) {                                            
                                            adminCampos(radio.inputValue);
                                        }
                                    }
                                }]
                            }]
                        },
                        {
                            layout: 'form',
                            labelAlign: 'top',
                            id: "metas",
                            items: [{
                                xtype: 'fieldset',
                                title: 'META (días)',
                                items:[{
                                    xtype: 'spinnerfield',
                                    fieldLabel: 'LCL',
                                    name: 'meta_lcl',
                                    id: 'meta_lcl',
                                    minValue: - 10,
                                    maxValue: 50,
                                    disabled: false,
                                    decimalPrecision: 1,
                                    width: 40,
                                    incrementValue: 1,
                                    accelerate: true,
                                    value: '<?= $metalcl ?>'                                                        
                                },
                                {
                                    xtype: 'spinnerfield',
                                    fieldLabel: 'FCL',
                                    name: 'meta_fcl',
                                    id: 'meta_fcl',
                                    minValue: - 10,
                                    maxValue: 50,
                                    disabled: false,
                                    decimalPrecision: 1,
                                    width: 40,
                                    incrementValue: 1,
                                    accelerate: true,
                                    value: '<?= $metafcl ?>'
                                },
                                {
                                    xtype: 'spinnerfield',
                                    fieldLabel: 'AEREO',
                                    name: 'meta_air',
                                    id: 'meta_air',
                                    minValue: - 10,
                                    maxValue: 50,
                                    disabled: false,
                                    decimalPrecision: 1,
                                    width: 40,
                                    incrementValue: 1,
                                    accelerate: true,
                                    value: '<?= $meta_air ?>'
                                }]
                            }]
                        }]
                    }]
                }]
            }]
        }],
        buttons: [{
            text: 'Graficar',
            handler: function(){
                var tp = Ext.getCmp("tab-panel");
                var owner = Ext.getCmp("formPanel");
                owner.getForm().getEl().dom.action = '<?= url_for("reportesGer/estadisticasIndicadoresClientes") ?>';
                owner.getForm().submit();
            }
        }],
        listeners:{
            afterrender:function(){
                var transporte = '<?=$transporte ?>';
                var typeidg = '<?=$typeidg?>';
                
                if (transporte == '<?=Constantes::AEREO?>'){
                    bloquearCampos();
                    Ext.getCmp("meta_air").allowBlank = false;
                    Ext.getCmp("desconsolidacion").hide();
                } else if (transporte == '<?=Constantes::MARITIMO?>'){
                    desbloquearCampos();
                    Ext.getCmp("meta_lcl").allowBlank = false;
                    Ext.getCmp("meta_fcl").allowBlank = false;                    
                    Ext.getCmp("desconsolidacion").show();
                } else if (transporte == '<?=  Constantes::TERRESTRE?>'){
                    bloquearIdg();
                } else{
                    Ext.getCmp("meta_air").allowBlank = false;
                    Ext.getCmp("meta_lcl").allowBlank = false;
                    Ext.getCmp("meta_fcl").allowBlank = false;
                    desbloquearIdg();
                }                
                
                if(typeidg ==1  || typeidg == 2){
                    Ext.getCmp('pais_origen').allowBlank = false;
                    Ext.getCmp('transporte').allowBlank = false;
                }else{
                    Ext.getCmp("pais_origen").allowBlank = true;
                    Ext.getCmp("transporte").allowBlank = true;
                }                
                
                var checkOri = '<?=$checkOrigen?>';
                var checkDes = '<?=$checkDestino?>';
                
                if(checkOri=="on"){
                    Ext.getCmp("topenOri").toggleCollapse();
                }
                if(checkDes=="on"){
                    Ext.getCmp("topenDes").toggleCollapse();
                }
            }
        }
    });
    tabs.render("container");

</script>