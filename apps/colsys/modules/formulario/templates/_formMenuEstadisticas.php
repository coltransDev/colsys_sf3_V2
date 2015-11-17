<?php


include_component("widgets", "widgetCliente");
include_component("widgets", "widgetSucursales");
include_component("widgets", "widgetComerciales");

?>
<script type="text/javascript">
    FormMenuEstadisticas = function( config ){
        Ext.apply(this, config);
        
        this.dataServices = <?=json_encode(array("servicios" => $sf_data->getRaw("servicios")))?>;
        this.dataPreguntas = <?=json_encode(array("preguntas" => $sf_data->getRaw("preguntas")))?>;

        FormMenuEstadisticas.superclass.constructor.call(this, {
            //labelAlign: 'top',
            frame:true,
            id: 'estadisticas',
            title: 'Estadísticas',
            bodyStyle:'padding:5px 5px 0',
            //width: 1000,
            items: [{   
                xtype: 'fieldset',
                title: 'Parámetros',
                id:"parametros",                                                                     
                items: [{
                    layout:'column',
                    items:[{
                        columnWidth:1,
                        layout: 'form',
                        bodyStyle:'text-align:left',
                        items: [
                            new WidgetSucursales({fieldLabel: 'Sucursal',
                                id:"sucursal",
                                hiddenName:"idsucursal",
                                width:180,
                                allowBlank: false,
                                value:"<?//=$sucursal?>",
                                hiddenValue:"<?//=$idsucursal?>"                            
                            })
                        ]
                    }]
                },{
                    layout:'column',
                    items:[{
                        columnWidth:.5,
                        layout: 'form',
                        bodyStyle:'text-align:left',
                        items: [
                            new WidgetComerciales({fieldLabel: 'Vendedor',
                                id: 'vendedor',
                                name: 'vendedor',                                    
                                hiddenName:"login",                                    
                                value:"<?//=$vendedor?>",
                                hiddenValue:"<?//=$login?>",
                                width:180
                            })
                        ]
                    },{
                        columnWidth:.5,
                        layout: 'form',
                        items: [
                            new WidgetCliente({
                                fieldLabel: 'Cliente',
                                id:"Cliente",
                                hiddenName:"idcliente",
                                bodyStyle: 'align: left',
                                width:230,                                    
                                value:"<?//= $cliente ?>",
                                hiddenValue:"<?//= $idcliente ?>"
                            })
                            ]
                    }]
                },{
                    layout:'column',
                    items:[{
                        columnWidth:.5,
                        layout: 'form',
                        bodyStyle:'text-align:left',
                        items: [
                            new Ext.form.ComboBox({
                                fieldLabel: 'Tipo de Servicio',
                                typeAhead: true,
                                forceSelection: false,
                                triggerAction: 'all',
                                emptyText:'',
                                selectOnFocus: true,
                                id: 'servicio',
                                style:{
                                    fontSize: '9px'
                                }, 
                                lazyRender:true,
                                allowBlank: true,
                                listClass: 'x-combo-list-small',
                                displayField: 'nombre',
                                valueField: 'idservicio',
                                value: '',
                                hiddenValue: '',
                                width: 230,
                                submitValue: true,
                                store : new Ext.data.Store({
                                    autoLoad : true ,
                                    proxy: new Ext.data.MemoryProxy( this.dataServices ),
                                    reader: new Ext.data.JsonReader(
                                        {
                                            id: 'idservicio',
                                            root: 'servicios'
                                        },
                                        Ext.data.Record.create([
                                            {name: 'idservicio'},
                                            {name: 'nombre'}
                                        ])
                                    )
                                })
                             })
                        ]
                    },{
                        columnWidth:.5,
                        layout: 'form',
                        items: [
                           new Ext.form.ComboBox({
                                fieldLabel: 'Preguntas',
                                typeAhead: true,
                                forceSelection: false,
                                triggerAction: 'all',
                                emptyText:'',
                                selectOnFocus: true,
                                value: '',
                                hiddenName: 'pregunta',
                                id: 'pregunta_id',
                                lazyRender:true,
                                allowBlank: true,
                                listClass: 'x-combo-list-small',
                                displayField: 'nombre',
                                valueField: 'idpregunta',
                                width: 230,
                                store : new Ext.data.Store({
                                    autoLoad : true ,
                                    proxy: new Ext.data.MemoryProxy( this.dataPreguntas ),
                                    reader: new Ext.data.JsonReader(
                                        {
                                            id: 'idpregunta',
                                            root: 'preguntas'
                                        },
                                        Ext.data.Record.create([
                                            {name: 'idpregunta'},
                                            {name: 'nombre'}
                                        ])
                                    )
                                })
                             })
                        ]
                    },{
                        columnWidth:.2,
                        layout: 'form',
                        items: [
                            {
                                xtype:'hidden',
                                name:"opcion",
                                value:"buscar"
                            }]
                    }]
                }]
            }]
       });
    };

    Ext.extend(FormMenuEstadisticas, Ext.Panel, {

    });
</script>
