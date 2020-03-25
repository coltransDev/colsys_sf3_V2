<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$nmes = $sf_data->getRaw("nmes");
$meses = $sf_data->getRaw("meses");
$tipo = $sf_data->getRaw("tipo");

if($tipo=="Mantenimientos")
    $url = url_for("inventory/informeMantenimientosRealizados");
else
    $url = url_for("inventory/informeSeguimientosRealizados");

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
			title:'<?=$tipo?> Realizados',
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
                            value:"<?=$sucursal?>",
                            hiddenValue:"<?=$idsucursal?>"
                }),
                {
                    xtype:          'combo',
                    mode:           'local',
                    value:          '<?=date("Y")?>',
                    triggerAction:  'all',
                    forceSelection: true,
                    editable:       true,
                    fieldLabel:     'Año',
                    name:           'aa',
                    hiddenName:     'aa',
                    displayField:   'name',
                    valueField:     'value',
                    allowBlank:     false,
                    store:          new Ext.data.JsonStore({
                        fields : ['name', 'value'],
                        data   : [
                            <?
                            echo "{name : 'Todos los años',   value: 'todos'},";
                            for( $i=2006; $i<=date("Y"); $i++ ){
                                echo ($i>2006)?",":"";
                                echo "{name : '".$i."',   value: '".$i."'}";
                            }
                            ?>
                        ]
                    })
                },
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
                        owner.getForm().getEl().dom.action='<?=$url?>';
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