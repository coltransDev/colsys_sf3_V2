<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.*/

$periodos = $sf_data->getRaw("periodos");
$graficas = $sf_data->getRaw("graficas");
?>
<script>

Ext.onReady(function(){

    Ext.define('Idg', {
        extend: 'Ext.data.Model',
        fields: [
            // the 'name' below matches the tag name to read, except 'availDate'
            // which is mapped to the tag 'availability'
            {name: 'ca_ididg', type: 'integer'},
            {name: 'ca_ano', type: 'integer'},
            {name: 'ca_idvia', type: 'string'},
            {name: 'ca_via', type: 'string'},
            {name: 'ca_idperiodo', type: 'integer'},
            {name: 'ca_periodo', type: 'string'},
            {name: 'ca_idgrafica', type: 'integer'},
            {name: 'ca_grafica', type: 'string'},
            {name: 'ca_idtrafico', type: 'string'},
            {name: 'ca_trafico', type: 'string'},
            {name: 'ca_observacion', type: 'string'}
        ]
    });

    var store = Ext.create('Ext.data.Store', {
        model: 'Idg',
        proxy: {
            type: 'ajax',
            url: '<?=url_for("falabella/datosGridObservaciones")?>',
            extraParams : {
                periodos: '<?=json_encode($periodos)?>',
                graficas: '<?=json_encode($graficas)?>'
            },
            reader: {
                type: 'json',
                root: 'data',
                totalProperty: 'total'
            }
        },        
        autoLoad: true
    });

    var cellEditing = Ext.create('Ext.grid.plugin.CellEditing', {
        clicksToEdit: 1
    });
    
    var storeTraficos =  new Ext.data.Store({
        fields: [
            {name: 'idtrafico'},
            {name: 'nombre'}
        ],
        proxy: {
            type: 'ajax',            
            url: '<?=url_for('widgets4/datosTraficos')?>',
            reader:{
               root: 'root',
               totalProperty: 'total'
            }
        }
    });
   
    var storeGraficas = new Ext.create('Ext.data.Store', {
        fields: ['id', 'name'],
        data : <?=json_encode($graficas)?>
    });
    
    var storePeriodos = new Ext.create('Ext.data.Store', {
        fields: ['id', 'name'],
        data : <?=json_encode($periodos )?>
    });
    
    var storeTransporte = new Ext.create('Ext.data.Store', {
        fields: ['id', 'name'],
        data : [
            {"id":"air", "name":"Aéreo"},
            {"id":"sea", "name":"Marítimo"}
        ]
    });
    
    var comboTraficos = new Ext.create('Ext.form.ComboBox', {        
        store: storeTraficos,
        queryMode: 'remote',
        //loadingText: 'buscando...',
        //triggerAction: 'all',     
        //selectOnFocus: true,
        allowBlank: true,
        //enableKeyEvents: true,
        displayField: 'nombre',
        valueField: 'idtrafico'
    });
    
    var comboBoxRenderer = function(combo) {
        return function(value) {
            
            var idx = combo.store.find(combo.valueField, value);
            var rec = combo.store.getAt(idx);
            alert("rec"+rec);
            return (rec === null ? value : rec.get(combo.displayField) );
          };
    }
    
    // create the grid and specify what field you want
    // to use for the editor at each header.
    //var grid1 = Ext.create('Ext.grid.Panel', {
    Ext.define('GridPanelObservaciones',{
        extend: 'Ext.grid.Panel',
        store: store,
        alias: 'widget.gObs',
        id: 'grid-obs',
        columns: [
            {
                header: "Id",
                dataIndex: 'ca_ididg',
                hideable: false,
                hidden: true
            },
            {
                id: 'ano',
                header: 'Año',
                dataIndex: 'ca_ano',
                //flex: 1,
                flex: 10/100,
                editor: {
                    xtype: 'combobox',
                    typeAhead: true,
                    triggerAction: 'all',
                    selectOnTab: true,
                    store: [
                        <?
                        for( $i=2006; $i<=date("Y"); $i++ ){
                            echo ($i>2006)?",":"";
                            echo "['".$i."', '".$i."']";
                        }
                        ?>
                    ],
                    lazyRender: true,
                    listClass: 'x-combo-list-small'
                }
            }, 
            {
                header: 'Transporte',
                dataIndex: 'ca_idvia',                
                flex: 10/100,
                editor: new Ext.create('Ext.form.ComboBox', {                    
                    store: storeTransporte,
                    queryMode: 'local',
                    displayField: 'name',
                    valueField: 'id'
                }),                
                renderer: function(val){
                    index = storeTransporte.find('id',val);                    
                    if (index != -1){
                        rs = storeTransporte.getAt(index).data; 
                        return rs.name; 
                    }
                }
            },
            {
                header: 'Periodo',
                dataIndex: 'ca_idperiodo',                
                flex: 10/100,
                align: 'right',
                editor: new Ext.create('Ext.form.ComboBox', {
                    store: storePeriodos,
                    queryMode: 'local',
                    displayField: 'name',
                    valueField: 'id'
                }),                
                renderer: function(val){
                    index = storePeriodos.find('id',val);                    
                    if (index != -1){
                        rs = storePeriodos.getAt(index).data; 
                        return rs.name; 
                    }
                }
            },
            
            {
                header: 'Gráfica',
                dataIndex: 'ca_idgrafica',                
                flex: 30/100,
                editor: new Ext.create('Ext.form.ComboBox', {
                    store: storeGraficas,
                    queryMode: 'local',
                    displayField: 'name',
                    valueField: 'id'
                }),
                renderer: function(val){
                    index = storeGraficas.find('id',val);                    
                    if (index != -1){
                        rs = storeGraficas.getAt(index).data; 
                        return rs.name; 
                    }
                }
            },
            {
                header: "Tráfico",
                dataIndex: 'ca_trafico',
                flex: 20/100,
                editor:comboTraficos/*,
                renderer: function(val){
                    index = storeTraficos.find('idtrafico',val);                    
                    if (index != -1){
                        rs = storeTraficos.getAt(index).data; 
                        return rs.nombre; 
                    }
                }*/
            },
            {
                id: 'obs',
                header: 'Observaciones',
                dataIndex: 'ca_observacion',
                //flex: 1,
                flex: 30/100,
                editor: {
                    allowBlank: false
                }
            }
        ],
        selModel: {
            selType: 'cellmodel'
        },        
        bufferedRenderer: false,        
        tbar: [
            {
                text: 'Nuevo',
                iconCls: 'add',
                handler : function(){

                    // Create a model instance
                    var r = Ext.create('Idg', {
                        ca_ano: '<?=date('Y')?>'
                    });
                    store.insert(0, r);
                    cellEditing.startEditByPosition({row: 0, column: 0});
                }
            },
            {
                text: 'Guardar',
                iconCls: 'disk',
                handler : function(){
                    var store = Ext.getCmp("grid-obs").getStore();
                    var records = store.getModifiedRecords();
                    var lenght = records.length;

                    changes=[];
                    for( var i=0; i< lenght; i++){
                        r = records[i];

                        if( r.data.iditem!="" && r.getChanges()){                
                            records[i].data.id=r.id                    
                            changes[i]=records[i].data;               
                        }
                    }

                    var str= JSON.stringify(changes);                    
                    
                    if(str.length>5){                    
                        Ext.Ajax.request({
                            url: '<?= url_for("falabella/guardarObservacionesIdg") ?>',
                            params: {                            
                                datos:str                 
                            },                        
                            callback :function(options, success, response){
                                var res = Ext.JSON.decode( response.responseText );
                                store=Ext.getCmp("grid-obs").getStore();
                                store.each(function(r){
                                    if(res.success){
                                        store.remove(r);
                                        Ext.Msg.alert("Success", "Se guardaron correctamente los datos");
                                        Ext.getCmp("grid-obs").store.reload(); 
                                    }else{
                                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(res?": "+res.errorInfo:""))
                                    }
                                });
                            }
                        });
                    }
                }
            },
            {
                text: 'Recargar',
                tooltip: 'Recarga los datos de la base de datos',
                iconCls: 'refresh',  // reference to our css
                scope: this,
                handler: function(){
                    id_new="grid-obs";
                    if(Ext.getCmp(id_new).store.getModifiedRecords().length>0){
                        if(!confirm("Se perderan los cambios no guardados, desea continuar?")){
                            return 0;
                        }
                    }
                    Ext.getCmp(id_new).store.reload();                
                }
            }
        ],
        plugins: [cellEditing]/*,
        listeners:{
            edit : function(editor, e, eOpts){
                
                /*var store = Ext.getCmp("grid-idg").getStore();
                //alert(editor.editors.items.length);
                var column = editor.editors.items.length -1;
                
                if(e.field=="ca_via"){
                    
                    store.data.items[e.rowIdx].set('ca_idvia', e.value);                    
                    store.data.items[e.rowIdx].set('ca_via', editor.editors.items[column].field.rawValue);
                }
                if(e.field=="ca_periodo"){                    
                    store.data.items[e.rowIdx].set('ca_idperiodo', e.value);                    
                    store.data.items[e.rowIdx].set('ca_periodo', editor.editors.items[column].field.rawValue);
                }
                if(e.field=="ca_grafica"){                    
                    store.data.items[e.rowIdx].set('ca_idgrafica', e.value);                    
                    store.data.items[e.rowIdx].set('ca_grafica', editor.editors.items[column].field.rawValue);
                }
                if(e.field=="ca_trafico"){                    
                    store.data.items[e.rowIdx].set('ca_idtrafico', e.value);                    
                    store.data.items[e.rowIdx].set('ca_trafico', editor.editors.items[column].field.rawValue);
                }
            }
       }*/
    });
});
</script>