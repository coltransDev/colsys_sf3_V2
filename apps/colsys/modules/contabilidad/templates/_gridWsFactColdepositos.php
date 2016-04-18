
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$permisos = $sf_data->getRaw("permisos");
?>
<script>
    
    Ext.define('GridWsFactColdepositos',{
        extend: 'Ext.grid.Panel',
        bufferedRenderer: false,
        title: 'Resultado búsqueda',
        id:'grid-ws-fact-coldepositos',
        store: Ext.create('Ext.data.Store', {
            fields: [
                { name: 'sel'               },
                { name: 'punto'             },
                { name: 'nombre_punto'      },
                { name: 'proveedor'         },
                { name: 'concepto'          },
                { name: 'nombre'            },
                { name: 'agrupador'         },
                { name: 'nombre_agrupador'  },
                { name: 'tipo1'             },
                { name: 'campo1'            },
                { name: 'valor_tipo1'       },
                { name: 'tipo2'             },
                { name: 'campo2'            },
                { name: 'valor_tipo2'       },
                { name: 'tipo3'             },
                { name: 'campo3'            },
                { name: 'valor_tipo3'       },
                { name: 'tipo4'             },
                { name: 'campo4'            },
                { name: 'valor_tipo4'       },
                { name: 'tipo5'             },
                { name: 'campo5'            },
                { name: 'valor_tipo5'       }
            ],
            autoLoad:false,
            remoteSort: false,
            proxy: {
                type: 'ajax',
                url: '/contabilidad/consultaWsFactColDepositos',
                reader: {
                    type: 'json',
                    rootProperty: 'root'
                }
            }
        }),
        columns: [
            { xtype : 'checkcolumn', text : '', dataIndex : 'sel',width:30 },
            {text: "Punto",             dataIndex: 'punto',             sortable: true},                        
            {text: "Proveedor",         dataIndex: 'proveedor',         sortable: true},            
            {text: "Concepto",          dataIndex: 'concepto',          sortable: true},
            {text: "Nombre",            dataIndex: 'nombre',            sortable: true},
            {text: "Agrupador",         dataIndex: 'agrupador',         sortable: true},
            {text: "Nombre Agrupador",  dataIndex: 'nombre_agrupador',  sortable: true},
            {text: "Tipo 1",            dataIndex: 'tipo1',             sortable: true},
            {text: "Campo 1",           dataIndex: 'campo1',            sortable: true},
            {text: "valor Tipo 1",      dataIndex: 'valor_tipo1',        sortable: true},
            
            {text: "Tipo 2",            dataIndex: 'tipo2',             sortable: true},
            {text: "Campo 2",           dataIndex: 'campo2',            sortable: true},
            {text: "valor Tipo 2",      dataIndex: 'valor_tipo2',        sortable: true},
            
            {text: "Tipo 3",            dataIndex: 'tipo3',             sortable: true},
            {text: "Campo 3",           dataIndex: 'campo3',            sortable: true},
            {text: "valor Tipo 3",      dataIndex: 'valor_tipo3',        sortable: true},
            
            {text: "Tipo 4",            dataIndex: 'tipo4',             sortable: true},
            {text: "Campo 4",           dataIndex: 'campo4',            sortable: true},
            {text: "valor Tipo 4",      dataIndex: 'valor_tipo4',        sortable: true},
            
            {text: "Tipo 5",            dataIndex: 'tipo5',             sortable: true},
            {text: "Campo 5",           dataIndex: 'campo5',            sortable: true},
            {text: "valor Tipo 5",      dataIndex: 'valor_tipo5',        sortable: true},
        ],
        //tbar: botones,        
        height:500//,
        /*viewConfig: {
            getRowClass: function(record, rowIndex, rowParams, store) {
                if (record.get('ca_estado')=='8' ) return 'row_purple';
                else if (record.get('ca_estado')=='6' ) return 'row_pink';
                else if (record.get('ca_estado')=='2' ) return 'row_blue';
                
            }
        }*/
    });
    
</script>

