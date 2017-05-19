<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_component("widgets","widgetSucursales");
include_component("widgets","widgetDeptos");
include_component("widgets","widgetTransporte");
$idsucursal= $sf_data->getRaw("idsucursal");
$action= $sf_data->getRaw("action");
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
                                    <?
                                    /*if($informe==2)
                                    {*/
                                    ?>
                                    {
                                        xtype:'datefield',
                                        fieldLabel: 'Fecha inicial',
                                        name : 'fechaInicial',
                                        format: "Y-m-d",
                                        value: '<?=$fechainicial?>'
                                    },
                                     <?
                                     //   }
                                    ?>
                                    new WidgetSucursales({fieldLabel: 'Sucursal',
                                                        id: 'sucursal',
                                                        name: 'sucursal',
                                                        hiddenName: "idsucursal",
                                                        value:"<?=$sucursal?>",
                                                        hiddenValue:"<?=$idsucursal?>"
                                                        }),
                                                        <?
                                    if($informe!=2)
                                    {
                                    ?>
                                                        new WidgetDeptos({fieldLabel: 'Departamento',
                                                            id: 'departamento',
                                                            name: 'departamento',
                                                            hiddenName: "iddepartamento",
                                                            value:"<?=$departamento?>",
                                                            hiddenValue:"<?=$iddepartamento?>"
                                                        })
                                    <?}?>
                                 
                                  ]
                             },
                             {
                                    columnWidth:.5,
                                    border:false,
                                    items:
                                    [
                                        {
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha final',
                                            name : 'fechaFinal',
                                            format: "Y-m-d",
                                            value: '<?=$fechafinal?>'
                                        }
                                    <?
                                    if($informe!=2)
                                    {
                                    ?>
                                        ,                                        
                                        new WidgetTransporte({fieldLabel: 'Transporte',
                                                            id: 'transporte',
                                                            name: 'transporte',
                                                            hiddenName: "idtransporte",
                                                            value:"<?=$transporte?>",
                                                            hiddenValue:"<?=$idtransporte?>"
                                                        })
                                   <?
                                    }
                                  ?>
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
                        owner.getForm().getEl().dom.action='<?=url_for("reportesGer/".$action)?>';
                    }
                    owner.getForm().submit();
            }
	}]
});
tabs.render("container");






</script>