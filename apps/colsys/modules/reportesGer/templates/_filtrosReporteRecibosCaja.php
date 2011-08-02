<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_component("widgets", "widgetParametros",array("caso_uso"=>"CU100"));

$tipo=$sf_data->getRaw("tipo");
$ntipo=$sf_data->getRaw("ntipo");
?>
<script language="javascript">
var tabs = new Ext.FormPanel({
	labelWidth: 75,
	border:true,
	frame:true,
    deferredRender:false,
	width: 900,
	standardSubmit: true,
        id: 'formPanel',
	items: {
		xtype: 'tabpanel',
		activeTab: 0,
		defaults:{autoHeight:true, bodyStyle:'padding:10px'},
		id: 'tab-panel',
		items:[{
			title:'Estadisticas',
			layout:'form',
			defaultType: 'textfield',
			id: 'estadisticas',
            labelWidth: 75,
			items: [
                {
                        xtype:'fieldset',
                        title: 'filtros',
                        autoHeight : true,
                        layout : 'column',
                        columns : 2,
                        defaults:{
                            columnWidth:0.5,
                            layout:'form',
                            border:false,
                            bodyStyle:'padding:4px;'
                        },
                        items :
                        [
                            {
                                xtype:'hidden',
                                name:"opcion",
                                value:"buscar"
                            },                            
                             {
                                    columnWidth:.5,
                                    border:false,
                                    items:
                                    [
                                        {
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha inicial',
                                            name : 'fechaInicial',
                                            format: "Y-m-d",
                                            value: '<?=$fechainicial?>'
                                        },
                                        {
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha final',
                                            name : 'fechaFinal',
                                            format: "Y-m-d",
                                            value: '<?=$fechafinal?>'
                                        },
                                        new WidgetParametros({
                                                fieldLabel:'Tipo',
                                                id:'ntipo',
                                                name:'ntipo',
                                                hiddenName:'tipo',
                                                caso_uso:"CU100",
                                                width:105,
                                                value:'<?=$ntipo?>',
                                                hiddenValue:'<?=$tipo?>',
                                                idvalor:"id"
                                                })
                                 ]
                             }
                     ]
                }
			]
		}]
	},
	buttons: [
            {
		text: 'Continuar',
		handler: function(){
                    var tp = Ext.getCmp("tab-panel");                    
                    var owner=Ext.getCmp("formPanel");
                    if( tp.getActiveTab().getId()=="estadisticas"){
                        owner.getForm().getEl().dom.action='<?=url_for("reportesGer/reporteRecibosCaja")?>';
                    }
                    owner.getForm().submit();
            }
	}]
});
tabs.render("container");






</script>