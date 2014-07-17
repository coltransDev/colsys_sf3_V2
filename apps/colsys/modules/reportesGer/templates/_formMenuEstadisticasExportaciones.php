<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_component("widgets", "widgetCiudad");
include_component("widgets", "widgetPais");
include_component("widgets", "widgetLinea");
include_component("widgets", "widgetAgente");
include_component("widgets", "widgetSucursales");
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetTransporte");
include_component("widgets", "widgetCliente");
include_component("widgets", "widgetMultiDatos");
include_component("widgets", "widgetComerciales");

$nmes = $sf_data->getRaw("nmes");
$meses = $sf_data->getRaw("meses");     
$idtransporte = $sf_data->getRaw("idtransporte");
$idlinea = $sf_data->getRaw("idlinea");

?>
<script type="text/javascript">
    FormMenuEstadisticasExportaciones = function( config ){
        Ext.apply(this, config);



        FormMenuEstadisticasExportaciones.superclass.constructor.call(this, {
            activeTab:0,
            title:'ESTADISTICAS EXPORTACIONES',
            layout:'form',
            //width: 100,
            id: 'estadisticas',
            labelWidth: 75,
            items:[
                {
                    layout:'anchor',
                    layoutConfig: {
                        // The total column count must be specified here
                        columns: 1,
                        autoWidth:true
                    },
                    border: false,
                    defaults: {
                        // applied to each contained panel
                        //bodyStyle:'padding-right:35px',
                        border: false
                    },
                    items:[
                        {
                            layout: 'form',
                            labelAlign: 'top',
                            //anchor: '95%',
                            items: [
                                {
                                    xtype: 'fieldset',
                                    title: 'Fechas de Corte',
                                    id:"fch_corte",
                                    //anchor: '95%',
                                    //width: '95%',
                                    //height: 200,
                                    //bodyStyle:'background-color:#EEEEEE;',                                   
                                    items: [
                                        {
                                            layout:'table',
                                            border: false,
                                            bodyStyle:'background-color:#EEEEEE;', 
                                            layoutConfig: {
                                                // The total column count must be specified here
                                                columns: 2,
                                                autoWidth:true
                                            },
                                            defaults: {
                                                // applied to each contained panel
                                                
                                                border: false
                                            },
                                            items: [
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
                                                    width: 100,
                                                    store:          new Ext.data.JsonStore({
                                                        fields : ['name', 'value'],
                                                        data   : [
                                                            <?

                                                            for( $i=2006; $i<=date("Y"); $i++ ){
                                                                echo ($i>2006)?",":"";
                                                                echo "{name : '".$i."',   value: '".$i."'}";
                                                            }
                                                            ?>
                                                        ]
                                                    })
                                                },
                                                {
                                                    xtype:'fieldset',
                                                    //columnWidth:.5,
                                                    layout: 'form',
                                                    border:false,
                                                    defaultType: 'textfield',
                                                    width: 465,
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
                                                }                                                       
                                            ]
                                        }]
                                    }]
                                }]
                        },
                        {
                            xtype: 'fieldset',
                            title: 'Parámetros',
                            id:"parametros",
                            bodyStyle: 'padding-left:15px;',
                            items: [
                                {
                                    xtype:"hidden",
                                    id: 'impoexpo',
                                    name: 'impoexpo',
                                    value:'<?= Constantes::EXPO ?>'
                                },
                                new WidgetTransporte({fieldLabel: 'Transporte',
                                    id: 'transporte',
                                    name: 'transporte',
                                    emptyText:'Todos',
                                    hiddenName: "idtransporte",
                                    width:219,
                                    value:"<?=$transporte?>",
                                    hiddenValue:"<?=$idtransporte?>"
                                }),
                                new WidgetModalidad({fieldLabel: 'Modalidad',
                                    id: 'modalidad',
                                    hiddenName: "idmodalidad",
                                    linkTransporte: "transporte",
                                    linkImpoexpo: "impoexpo",
                                    width:219,
                                    value:"<?=$idmodalidad ?>"
                                }),
                                new WidgetCiudad({fieldLabel: 'Ciu. Origen',
                                    id: 'origen',
                                    idciudad:"origen",
                                    hiddenName:"ciu_origen",
                                    tipo:"1",
                                    impoexpo:"<?=constantes::EXPO?>",
                                    allowBlank:true,
                                    value:"<?= $origen ?>",
                                    hiddenValue:"<?= $ciu_origen ?>",
                                    width:219
                                }),                                  
                                new WidgetPais({title: 'Pais destino',
                                    fieldLabel: 'Pais destino',
                                    id: 'pais_destino',
                                    name: 'pais_destino',
                                    hiddenName: "idpais_destino",
                                    pais:"todos",
                                    width:219,
                                    value:"<?=$idpais_destino?>"
                                }),
                                new WidgetAgente({
                                    fieldLabel: 'Agente',
                                    linkImpoExpo: "<?= constantes::EXPO ?>",
                                    linkListarTodos: "all",
                                    id:"agente",
                                    hiddenName:"idagente",
                                    width:219,
                                    value:"<?= $agente?>",
                                    hiddenValue:"<?=$idagente ?>"
                                }),
                                new WidgetLinea({
                                    fieldLabel: 'Naviera',
                                    linkTransporte: "transporte",
                                    name:"linea",
                                    id:"idlinea",
                                    hiddenName: "idlinea",
                                    value:"<?= $linea ?>",
                                    hiddenValue:"<?=$idlinea ?>",
                                    width:219
                                }),
                                new WidgetSucursales({fieldLabel: 'Sucursal',
                                    id:"idSucursal",
                                    hiddenName:"sucursal",
                                    width:219,
                                    value:"<?=$idSucursal?>",
                                    hiddenValue:"<?=$sucursal ?>"                            
                                }),
                                new WidgetComerciales({fieldLabel: 'Vendedor',
                                    id: 'vendedor',
                                    name: 'vendedor',                                    
                                    hiddenName:"login",                                    
                                    value:"<?=$vendedor?>",
                                    hiddenValue:"<?=$login?>",
                                    width:219
                                }),
                                new Ext.form.ComboBox({
                                    fieldLabel: 'Estado',
                                    name:'estado',
                                    hiddenName:'estado',
                                    store: ['Abierto', 'Cerrado','Sin Facturar','Anulado'], 
                                    valueField:'estado',
                                    typeAhead: true,
                                    triggerAction: 'all',
                                    emptyText:'',
                                    selectOnFocus:true,
                                    width:219
                                }),
                             ]
                         },
                        {
                            xtype:'hidden',
                            name:"opcion",
                            value:"buscar"
                        }]
        });

    };

    Ext.extend(FormMenuEstadisticasExportaciones, Ext.Panel, {

    });
</script>