<?php

include_component("widgets","widgetSucursales");
include_component("widgets","widgetCliente");
include_component("widgets", "widgetTransporte");
include_component("widgets","widgetPais");

$cliente = $sf_data->getRaw("cliente");

?>
<script language="javascript">
var bloquearCampos = function(){	
	Ext.getCmp('meta_lcl').setDisabled(true);	
	Ext.getCmp('meta_fcl').setDisabled(true);
    Ext.getCmp('meta_air').setDisabled(false);
    Ext.getCmp('tipo_idg').setDisabled(false);
}
var desbloquearCampos = function(){
	
	Ext.getCmp('meta_lcl').setDisabled(false);	
	Ext.getCmp('meta_fcl').setDisabled(false);
    Ext.getCmp('meta_air').setDisabled(true);
}
var bloquearIdg = function(){	
	Ext.getCmp('meta_lcl').setDisabled(true);	
	Ext.getCmp('meta_fcl').setDisabled(true);
    Ext.getCmp('meta_air').setDisabled(true);
    Ext.getCmp('tipo_idg').setDisabled(true);
}

var tabs = new Ext.FormPanel({
    labelWidth: 75, // label settings here cascade unless overridden
    //url:'save-form.php',
    frame:true,
    title: 'Estad�sticas Indicadores Clientes',
    bodyStyle:'padding:5px 5px 0',
    width: 900,
    autoHeight:true,
    deferredRender:false,
    standardSubmit: true,
    id: 'formPanel',
    //autoWidth:true,
    items: [
        {
            layout:'table',
            layoutConfig: {
                // The total column count must be specified here
                columns: 3
            },
            border: false,
            defaults: {
                // applied to each contained panel
                // bodyStyle:'padding-right:35px',
                autoHeight:true,
                //border: false
            },
            items:[
                {
                    layout: 'form',
                    labelAlign: 'top',
                    bodyStyle:'padding-right:35px',
                    items: [
                        {
                            xtype:'fieldset',
                            checkboxToggle:true,
                            title: 'Datos',
                            autoHeight:true,
                            width: 300,
                            //defaults: {//width: 220},
                            defaultType: 'textfield',
                            collapsed: false,
                            items: [ 
                                {
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
                                    value:"<?=$cliente?>",
                                    hiddenValue:"<?=$idcliente?>"
                                }),                                   
                                new WidgetPais({title: 'Pais origen',
                                    fieldLabel: 'Pais origen',
                                    id: 'pais_origen',
                                    name: 'pais_origen',
                                    hiddenName: "idpais_origen",
                                    pais:"<?=$pais_origen?>",
                                    value:"<?=$idpais_origen?>",
                                    pais:"todos",
                                    allowBlank:false
                                }),
                                new WidgetTransporte({fieldLabel: 'Transporte',
                                    id: 'transporte',
                                    name: 'transporte',
                                    hiddenName: "idtransporte",
                                    valueField: "idtransporte",
                                    allowBlank:false,
                                    width:219,
                                    value:"<?=$transporte?>",
                                    hiddenValue:"<?=$idtransporte?>",
                                    listeners:{
                                        select:function( field, record, index ){
                                            //alert(record.data.valor);
                                            if( record.data.valor=="A�reo"){
                                                bloquearCampos();
                                                Ext.getCmp("meta_air").allowBlank = false;
                                            }else if( record.data.valor=="Mar�timo"){
                                                desbloquearCampos();
                                                Ext.getCmp("meta_lcl").allowBlank = false;
                                                Ext.getCmp("meta_fcl").allowBlank = false;
                                            }else if(record.data.valor=="Terrestre"){
                                                alert("Esta opci�n no est� disponible");
                                                bloquearIdg();
                                            }
                                        }
                                    }
                                }),
                                {
                                    xtype:'datefield',
                                    fieldLabel: 'Fecha Inicial',
                                    name : 'fechaInicial',
                                    format: 'Y-m-d',
                                    allowBlank:false,
                                    value: '<?=$fechainicial?>',
                                    tooltip: 'lo quw sea'
                                },
                                {
                                    xtype:'datefield',
                                    fieldLabel: 'Fecha Final',
                                    name : 'fechaFinal',
                                    format: 'Y-m-d',
                                    allowBlank:false,
                                    value: '<?=$fechafinal?>'
                                }]
                        }]
                },
                {
                    layout: 'form',
                    labelAlign: 'top',
                    items: [
                        {
                            xtype:'fieldset',
                            checkboxToggle:true,
                            title: 'Informacion IDG',
                            autoHeight:true,
                            //defaults: {width: 220},
                            //defaultType: 'textfield'
                            //bodyStyle: 'padding-left:15px;',
                            width: 500,
                            collapsed: false,
                            items: [
                                {
                                    layout:'table',
                                    align: 'stretch',
                                    layoutConfig: {
                                        // The total column count must be specified here
                                        columns: 2,
                                        tableAttrs:{
                                            style:{
                                                width: '100%',
                                                height: '100%'
                                            }
                                        }
                                    },
                                    border: false,
                                    items: [
                                        {
                                            layout: 'form',
                                            labelAlign: 'top',
                                            width: 250,
                                            bodyStyle:'padding-right:15px',
                                            items: [
                                                {
                                                    xtype: 'fieldset',
                                                    title: 'Tipo de IDG',
                                                    id:'tipo_idg',
                                                    //autoHeight: true,
                                                    items:[
                                                        {
                                                            xtype: 'radiogroup',
                                                            itemCls: 'x-check-group-alt',
                                                            allowBlank: false,
                                                            columns: 1,
                                                            items: [
                                                                {boxLabel: 'Coordinaci�n de Embarque', name: 'type_idg', inputValue: 1, <?=$typeidg==1?"checked:'true'":""?>},
                                                                {boxLabel: 'Tiempo de Tr�nsito', name: 'type_idg', inputValue: 2, <?=$typeidg==2?"checked:'true'":""?>},
                                                                {boxLabel: 'Oportunidad en el Zarpe/Despegue', name: 'type_idg', inputValue: 3, <?=$typeidg==3?"checked:'true'":""?>},
                                                                {boxLabel: 'Oportunidad en la Llegada', name: 'type_idg', inputValue: 4, <?=$typeidg==4?"checked:'true'":""?>},
                                                                {boxLabel: 'Oportunidad en env�o de la factura', name: 'type_idg', inputValue: 5, <?=$typeidg==5?"checked:'true'":""?>}
                                                           ]
                                                        }]
                                                }]
                                        },      
                                        {
                                            layout: 'form',
                                            labelAlign: 'top',
                                            items: [
                                                {
                                                    xtype: 'fieldset',
                                                    title: 'META (d�as)',
                                                    //autoHeight: true,
                                                    items:[
                                                        {
                                                            xtype: 'spinnerfield',
                                                            fieldLabel: 'LCL',
                                                            name: 'meta_lcl',
                                                            id: 'meta_lcl',
                                                            minValue: -2,
                                                            maxValue: 50,
                                                            disabled: false,
                                                            decimalPrecision: 1,
                                                            width: 40,
                                                            incrementValue: 1,
                                                            accelerate: true,
                                                            value: '<?=$metalcl?>'                                                        },
                                                        {
                                                            xtype: 'spinnerfield',
                                                            fieldLabel: 'FCL',
                                                            name: 'meta_fcl',
                                                            id: 'meta_fcl',
                                                            minValue: -2,
                                                            maxValue: 50,
                                                            disabled: false,
                                                            decimalPrecision: 1,
                                                            width: 40,
                                                            incrementValue: 1,
                                                            accelerate: true,
                                                            value: '<?=$metafcl?>'
                                                        },
                                                        {
                                                            xtype: 'spinnerfield',
                                                            fieldLabel: 'AEREO',
                                                            name: 'meta_air',
                                                            id: 'meta_air',
                                                            minValue: -2,
                                                            maxValue: 50,
                                                            disabled: false,
                                                            decimalPrecision: 1,
                                                            width: 40,
                                                            incrementValue: 1,
                                                            accelerate: true,
                                                            value: '<?=$meta_air?>'
                                                        }]
                                                }]
                                        }]
                                    }]
                        }]
                }]
        }],

   buttons: [
            {
		text: 'Graficar',
		handler: function(){
                var tp = Ext.getCmp("tab-panel");                    
                var owner=Ext.getCmp("formPanel");
                owner.getForm().getEl().dom.action='<?=url_for("reportesGer/estadisticasIndicadoresClientes")?>';
                owner.getForm().submit();
            }
	}]
});
tabs.render("container");

</script>