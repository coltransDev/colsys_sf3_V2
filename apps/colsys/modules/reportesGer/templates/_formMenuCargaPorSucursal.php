<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_component("widgets", "widgetMes");
include_component("widgets", "widgetCiudad");
include_component("widgets", "widgetCliente");
include_component("widgets", "widgetPais");
include_component("widgets", "widgetSucursales");
include_component("widgets", "widgetMultiDatos");

$nmes = $sf_data->getRaw("nmes");
$meses = $sf_data->getRaw("meses");
?>
<script type="text/javascript">
    FormMenuCargaPorSucursal = function( config ){
        Ext.apply(this, config);

        FormMenuCargaPorSucursal.superclass.constructor.call(this, {
            labelAlign: 'top',
            frame:true,
            title: 'Carga por Sucursal',
            bodyStyle:'padding:5px 5px 0',
            //width: 1000,
            items: [{
                    xtype: 'fieldset',
                    title: 'Fechas de Consulta',
                    id:"fch_consulta",                                                                     
                    items: [{
                        layout:'column',
                        items:[{
                            columnWidth:.3,
                            layout: 'form',
                            items: [{
                                xtype:'fieldset',
                                layout: 'form',
                                border:false,
                                items: [{
                                    xtype:          'combo',
                                    mode:           'local',
                                    value:          '<?=$aa?>',
                                    triggerAction:  'all',
                                    forceSelection: true,
                                    editable:       true,
                                    fieldLabel:     'Año',
                                    name:           'aa',
                                    hiddenName:     'aa',
                                    displayField:   'name',
                                    valueField:     'value',
                                    allowBlank:     false,
                                    width: 100,
                                    store:          new Ext.data.JsonStore({
                                        fields : ['name', 'value'],
                                        data   : [
                                            <?

                                            for( $i=date("Y"); $i>=2006; $i-- ){
                                                echo ($i<date("Y"))?",":"";
                                                echo "{name : '".$i."',   value: '".$i."'}";
                                            }
                                            ?>
                                        ]
                                    })
                                }]
                            }]
                        },
                        {
                            columnWidth:.7,
                            layout: 'form',
                            items: [
                                {
                                    xtype:'fieldset',
                                    layout: 'form',
                                    border:false,
                                    items: [   

                                        new WidgetMultiDatos({
                                            emptyText: 'Todos los meses',
                                            title: 'Mes',fieldLabel: 'Mes',id: 'mes',name: 'mes[]',hiddenName: "nmes[]",
                                            value:'<?=$nmes?implode(",", $nmes):"" ?>',
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
                        }]
                    }]
                },{
                    xtype: 'fieldset',
                    title: 'Parámetros',
                    id:"parametros",                                                                     
                    items: [{
                        layout:'column',
                        items:[{
                            columnWidth:.2,
                            layout: 'form',
                            items: [
                                 new WidgetPais({title: 'Tráfico',
                                    fieldLabel: 'Tráfico Origen',
                                    id: 'pais_origen',
                                    name: 'pais_origen',
                                    hiddenName: "idpais_origen",
                                    pais:"todos",
                                    width:150,
                                    value:"<?=$pais_origen?>",
                                    hiddenValue: "<?=$idpais_origen?>"
                                })
                            ]
                        },{
                            columnWidth:.2,
                            layout: 'form',
                            items: [
                                new WidgetCiudad({fieldLabel: 'Ciu. Origen',
                                    id: 'ciuorigen',
                                    idciudad:"ciuorigen",
                                    hiddenName:"idciuorigen",
                                    tipo:"3",
                                    traficoParent:"pais_origen",
                                    impoexpo:"<?=constantes::IMPO?>",
                                    allowBlank:true,
                                    width:150,
                                    value:"<?=$ciuorigen?>",
                                    hiddenValue:"<?=$idciuorigen?>"
                                })
                            ]
                        },{
                            columnWidth:.2,
                            layout: 'form',
                            items: [
                                new WidgetCliente({
                                    fieldLabel: 'Cliente',
                                    id:"Cliente",
                                    hiddenName:"idcliente",
                                    bodyStyle: 'align: left',
                                    width:170,                                    
                                    value:"<?= $cliente ?>",
                                    hiddenValue:"<?= $idcliente ?>"
                                })
                            ]
                        },{
                            columnWidth:.2,
                            layout: 'form',
                            items: [
                                new WidgetSucursales({fieldLabel: 'Sucursal',
                                    id:"sucursal",
                                    hiddenName:"idsucursal",
                                    width:150,
                                    value:"<?=$sucursal?>",
                                    hiddenValue:"<?=$idsucursal?>"                            
                                })
                            ]
                        },{
                            columnWidth:.2,
                            layout: 'form',
                            items: [
                                new Ext.form.ComboBox({
                                    fieldLabel: 'Estado',
                                    name:'estado',
                                    hiddenName:'estado',
                                    store: ['Abierto', 'Cerrado','Provisional'], 
                                    valueField:'estado',
                                    typeAhead: true,
                                    triggerAction: 'all',
                                    emptyText:'Todos los casos',
                                    width:150,
                                    selectOnFocus:true,
                                    value:"<?=$estado?>"
                                })
                            ]
                        },{
                            xtype:'hidden',
                            name:"opcion",
                            value:"buscar"
                        }]
                    }]
            }]
       });
    };

    Ext.extend(FormMenuCargaPorSucursal, Ext.Panel, {

    });
</script>