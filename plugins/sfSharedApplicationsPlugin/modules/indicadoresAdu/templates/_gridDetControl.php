<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//include_component("widgets5", "wgEmpresas");
 $fields = $sf_data->getRaw("fields");
// print_r($fields);
// exit();
 $columns="";
 foreach($fields as $f)
     {
        $index=$f['text'];
        $dataIndex=$f['dataIndex'];
        $tipo=$f['tipo'];
        $columns .="{
            header:'$index',
            width:100,
            dataIndex:'$dataIndex',
            editor:{
                xtype:'$tipo'
                }
            },";                
        }
        
?>
<script>
    //console.log(myData1);
    // create the grid
    //var grid = Ext.create('Ext.grid.Panel', {
    var winIndicador1=null;
    var consoli=0;
    //var class="row_gray";
    var classtyle="";
    Ext.define('GridDetControl',{
        extend: 'Ext.grid.Panel',
        bufferedRenderer: true,
        selModel: {
            pruneRemoved: false
        },
        store: Ext.create('Ext.data.Store', {
            id:'gridDetControl',
            fields: [
                "A","B"
            ],            
            autoLoad: false,
            remoteSort: true,
             sorters: [{
                property: 'ca_orden',
                direction: 'ASC'
            }],
            proxy: {
                type: 'ajax',
                url: '/indicadoresAdu/datosDetControl',
                reader: {
                    type: 'json',
                    rootProperty: 'root',
                    totalc:'totalc'
                }
            }
            
        }),        
        viewConfig: {
            getRowClass: function(record, rowIndex, rowParams, store){
                if(consoli!=record.data.ca_consolidado){                
                    classtyle=(classtyle=="row_white")?"":"row_white"; }               
                consoli=record.data.ca_consolidado;                
                return classtyle;
            }
        },
        columns: [
            <?=$columns?>
        ],
        onRender: function(ct, position){
            //alert(this.id_cab_control);
            /*if (this.id_cab_control ){
                this.store.load({
                    params : {
                        idcabcontrol : this.id_cab_control,
                        parametros : this.parametros
                    }
                });
            }*/
        /*this.store.load({
                    params : {
                        idcabcontrol : this.id_cab_control,
                        parametros : this.parametros
                    }
                });*/
            GridDetControl.superclass.onRender.call(this, ct, position);
        },
        plugins: [new Ext.grid.plugin.CellEditing({
                    clicksToEdit: 1
                })],
        listeners:{
            edit : function(editor, e, eOpts)
            {
                //alert(e.field);
                var store = this.store;
                if(e.field=="empresa")
                {
                    store.data.items[e.rowIdx].set('ca_idempresa', e.value);                    
                    store.data.items[e.rowIdx].set('empresa', editor.editors.items[0].field.rawValue);
                }
            }
        },
        tbar : [
            {
                xtype: 'exporterbutton',
                text: 'Exportar CSV',
                iconCls: 'csv'
            }

        ],
    autoScroll:true
    });
    function graficar(config,res)
    {
        if (!winIndicador1) {
            winIndicador1 = Ext.create('Ext.window.Window', {
                title: (!config.titleWindow)?'Resumen de Datos':config.titleWindow,
                header: {
                    titlePosition: 2,
                    titleAlign: 'center'
                },
                closable: true,
                closeAction: 'hide',
                maximizable: true,
                //animateTarget: button,
                width: 800,
                minWidth: 350,
                height: 550,
                tools: [{type: 'pin'}],
                layout: {
                //    type: 'border',
                    padding: 5
                },
                autoScroll: true,
                items: [

                    Ext.create('Ext.panel.Panel',{
                        title: 'Grafica',
                        id:"grafica"+config.contconsulta,
                        autoScroll: true,
                        fixed:true,
                        overflowY :'scroll',
                        //width: 500,
                        //height: 800,
                        layout: 'column',
                        defaults: {
                            //anchor: '100%'
                            columnWidth: 1/2                            
                        },
                        //renderTo: Ext.getBody(),
                        items: [
                            grafica({id:'hcd'+config.contconsulta,title:((!config.titleGraph)?'Indicador de documentos':config.titleGraph),subtitle:((!config.subtitleGraph)?'Indicador de documentos':config.subtitleGraph),datos:JSON.stringify(res)})
                        ]
                    })
                ]
            });
        }
        winIndicador1.show();
    }
</script>