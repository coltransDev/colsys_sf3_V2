<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_component("widgets","widgetSucursales");
//include_component("widgets","widgetPais");
//$idsucursal= $sf_data->getRaw("idsucursal");
?>


<script language="javascript">
var tabs = new Ext.FormPanel({
	labelWidth: 75,
	border:true,
	frame:true,
    deferredRender:false,
	width: 500,
	standardSubmit: true,
        id: 'formPanel',
	items: {
		xtype: 'tabpanel',
		activeTab: 0,
		defaults:{autoHeight:true, bodyStyle:'padding:10px'},
		id: 'tab-panel',
		items:[{
			title:'Mantenimientos Realizados',
			layout:'form',
			defaultType: 'textfield',
			id: 'mtorealizado',
            labelWidth: 75,
			items: [
                {
                    xtype:'hidden',
                    name:"opcion",
                    value:"buscar"
                },
                new WidgetSucursales({
                            fieldLabel: 'Sucursal',
                            id: 'sucursal',
                            name: 'sucursal',
                            hiddenName: "idsucursal",                                                        
                            //value:"<?//=$sucursal?>",
                            //hiddenValue:"<?//=$idsucursal?>"
                }),
                {
                    xtype:          'combo',
                    mode:           'local',
                    value:          '',
                    triggerAction:  'all',
                    forceSelection: true,
                    editable:       true,
                    fieldLabel:     'Mes',
                    name:           'mes_man',
                    hiddenName:     'mes_man',
                    displayField:   'name',
                    valueField:     'value',
                    allowBlank: false,
                    store:          new Ext.data.JsonStore({
                        fields : ['name', 'value'],
                        data   : [
                            <?

                            for( $i=1; $i<=12; $i++ ){
                                echo ($i>1)?",":"";
                                echo "{name : '".Utils::mesLargo($i)."',   value: '".$i."'}";
                            }
                            ?>
                        ]
                    })
                }]
            }]
        },
    buttons: [
            {
        text: 'Continuar',
        handler: function(){
                    var tp = Ext.getCmp("tab-panel");                    
                    var owner=Ext.getCmp("formPanel");
                    if( tp.getActiveTab().getId()=="mtorealizado"){
                        owner.getForm().getEl().dom.action='<?=url_for("inventory/informeMantenimientosRealizados")?>';
                    }
                    owner.getForm().submit();
            }
    }]
});
tabs.render("container");

</script>