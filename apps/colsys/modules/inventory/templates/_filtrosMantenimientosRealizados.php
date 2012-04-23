<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$nmes = $sf_data->getRaw("nmes");
$meses = $sf_data->getRaw("meses");

include_component("widgets","widgetSucursales");
include_component("widgets","widgetMultiDatos");
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
                new WidgetMultiDatos({title: 'Mes',
                    fieldLabel: 'Mes',
                        id: 'mes',
                        name: 'mes[]',
                        hiddenName: "nmes[]",
                        //value:'<?//= implode(",", $nmes) ?>',
                        listeners:{
                            render:function()
                            {
                                if(this.store.data.length==0)
                                {
                                    data=<?=json_encode(array("root"=>$meses, "total"=>count($meses), "success"=>true) )?>;
                                    this.store.loadData(data);
                                }
                            },
                            focus:function()
                            {
                                if(this.store.data.length==0)
                                {
                                    data=<?=json_encode(array("root"=>$meses, "total"=>count($meses), "success"=>true) )?>;
                                    this.store.loadData(data);
                                }
                            }
                        }
                })
                ]
            }]
        },
    buttons: [{
                text: 'Continuar',
                handler: function(){
                    var tp = Ext.getCmp("tab-panel");                    
                    var owner=Ext.getCmp("formPanel");
                    if( tp.getActiveTab().getId()=="mtorealizado"){
                        owner.getForm().getEl().dom.action='<?=url_for("inventory/informeMantenimientosRealizados")?>';
                    }
                    owner.getForm().submit();
            }
    }],
    listeners:{afterrender:function(){        
            }
    }
});
tabs.render("container");

</script>