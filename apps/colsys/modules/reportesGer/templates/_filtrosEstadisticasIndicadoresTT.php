<?php

include_component("widgets","widgetSucursales");
include_component("widgets","widgetCliente");
include_component("widgets","widgetPais");

$cliente = $sf_data->getRaw("cliente");

?>
<script language="javascript">
    
var tabs = new Ext.FormPanel({
    border:true,
	frame:true,
    deferredRender:false,
	width: 500,
	standardSubmit: true,
    id: 'formPanel',
    items: {
        xtype:'tabpanel',
        activeTab: 0,
        defaults:{autoHeight:true, bodyStyle:'padding:10px'}, 
        items:[{
            title:'Estadísticas',
            layout:'form',
            frame:true,
            id: 'estadisticas',
            //defaults: {width: 230},
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
                {
                    xtype:'datefield',
                    fieldLabel: 'Fecha Inicial',
                    name : 'fechaInicial',
                    format: 'Y-m-d',
                    allowBlank:false,
                    value: '<?=$fechainicial?>'
                },
                {
                    xtype:'datefield',
                    fieldLabel: 'Fecha Final',
                    name : 'fechaFinal',
                    format: 'Y-m-d',
                    allowBlank:false,
                    value: '<?=$fechafinal?>'
                }]
        },{
            title:'IDG',
            layout:'form',
            frame:true,
            labelAlign: 'top',
            defaults:{autoHeight:true},
            items: [
                {
                    xtype: 'fieldset',
                    title: 'Tipo de IDG',
                    //autoHeight: true,
                    items:[
                        {
                            xtype: 'radiogroup',
                            //fieldLabel: 'Escoja el tipo de IDG',
                            itemCls: 'x-check-group-alt',

                            // Put all controls in a single column with width 100%
                            //columns: 1,
                            items: [
                                {boxLabel: 'Coordinación de Embarque', name: 'type_idg', inputValue: 1, checked: true},
                                {boxLabel: 'Tiempo de Tránsito', name: 'type_idg', inputValue: 2},
                            ]
                        }]
                },
                {
                    xtype: 'fieldset',
                    title: 'META (días)',
                    //autoHeight: true,
                    items:[
                        {
                            xtype: 'spinnerfield',
                            fieldLabel: 'LCL',
                            name: 'meta_lcl',
                            id: 'meta_lcl',
                            minValue: 1,
                            maxValue: 50,
                            disabled: false,
                            allowBlank:false,
                            decimalPrecision: 1,
                            width: 40,
                            incrementValue: 1,
                            accelerate: true,
                            value: '<?=$metalcl?>'
                        },
                        {
                            xtype: 'spinnerfield',
                            fieldLabel: 'FCL',
                            name: 'meta_fcl',
                            id: 'meta_fcl',
                            minValue: 1,
                            maxValue: 50,
                            disabled: false,
                            decimalPrecision: 1,
                            width: 40,
                            incrementValue: 1,
                            allowBlank:false,
                            accelerate: true,
                            value: '<?=$metafcl?>'
                        }]
                }]
        }]
    },

   buttons: [
            {
		text: 'Graficar',
		handler: function(){
                var tp = Ext.getCmp("tab-panel");                    
                var owner=Ext.getCmp("formPanel");
                owner.getForm().getEl().dom.action='<?=url_for("reportesGer/estadisticasIndicadoresTT")?>';
                owner.getForm().submit();
            }
	}]
});
tabs.render("container");

</script>