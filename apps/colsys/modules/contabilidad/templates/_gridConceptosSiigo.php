<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_component("widgets5", "wgEmpresas");
$puedeBorrar = $sf_data->getRaw("puedeBorrar");
?>
<script>
    var combo = new wgEmpresas({
        displayField: 'name',
        valueField: 'id'
    });
    var comboBoxRenderer = function(combo) {
        return function(value) {   
        var idx = combo.store.find(combo.valueField, value);
        var rec = combo.store.getAt(idx);
        return (rec === null ? value : rec.get(combo.displayField) );       
        };
    }
    Ext.define('GridConceptosSiigo',{
        extend: 'Ext.grid.Panel',
        bufferedRenderer: true,
        selModel: {
            pruneRemoved: false
        },
        store: Ext.create('Ext.data.Store', {              
            fields: [
                { name: 'ca_idconceptosiigo', mapping: 's_ca_idconceptosiigo' },
                { name: 'ca_cod', mapping: 's_ca_cod' },
                { name: 'ca_descripcion', mapping: 's_ca_descripcion' },
                { name: 'ca_cuenta', mapping: 's_ca_cuenta' },
                { name: 'ca_cc', mapping: 's_ca_cc' },
                { name: 'ca_scc', mapping: 's_ca_scc' },
                { name: 'ca_valor', mapping: 's_ca_valor' },
                { name: 'ca_pt', mapping: 's_ca_pt' },
                { name: 'ca_iva', mapping: 's_ca_iva' },
                { name: 'ca_porciva', mapping: 's_ca_porciva' },
                { name: 'ca_retfte', mapping: 's_ca_retfte' },
                { name: 'ca_cuentarf', mapping: 's_ca_cuentarf' },
                { name: 'ca_baserf', mapping: 's_ca_baserf' },
                { name: 'ca_porcrf', mapping: 's_ca_porcrf' },
                { name: 'ca_mone', mapping: 's_ca_mone' },
                { name: 'ca_convenio', mapping: 's_ca_convenio' },
                { name: 'ca_autoret', mapping: 's_ca_autoret' },
                { name: 'ca_basear', mapping: 's_ca_basear' },
                { name: 'ca_tipo', mapping: 's_ca_tipo' },
                { name: 'ca_idempresa', mapping: 's_ca_idempresa' },
                { name: 'empresa', mapping: 'e_ca_nombre' },
                { name: 'borrado', mapping: 'borrado' },                
            ],
            autoLoad: false,
            remoteSort: false,
            proxy: {
                type: 'ajax',
                url: '/contabilidad/datosConceptosSiigo',               
                reader: {
                    type: 'json',
                    rootProperty: 'root'
                }                
            }
        }),
        columns: [            
            {xtype: "checkcolumn",  dataIndex: 'borrado', width: 25           }, 
            {text: "#",             dataIndex: 'ca_idconceptosiigo',    sortable: true, width: 25, hidden:true   },
            {text: "Codigo",        dataIndex: 'ca_cod',                sortable: true, width: 65, editor: {xtype: "numberfield",allowBlank: false}},
            {text: "Descripcion",   dataIndex: 'ca_descripcion',        sortable: true,            editor: {xtype: "textfield"}},
            {text: "Cuenta",        dataIndex: 'ca_cuenta',             sortable: true, width: 90, editor: {xtype: "numberfield",allowBlank: false}},
            {text: "CC",            dataIndex: 'ca_cc',                 sortable: true, width: 45, editor: {xtype: "numberfield"}},
            {text: "Scc",           dataIndex: 'ca_scc',                sortable: true, width: 45, editor: {xtype: "numberfield"}},
            {text: "Valor",         dataIndex: 'ca_valor',              sortable: true, width: 55, editor: {xtype: "numberfield"}},
            {text: "PT",            dataIndex: 'ca_pt',                 sortable: true, width: 45, editor: {xtype: "textfield",maxLength: 1,maxLengthText: 'Tamaño maximo 1'}},
            {text: "Iva",           dataIndex: 'ca_iva',                sortable: true, width: 45, editor: {xtype: "textfield",maxLength: 1,maxLengthText: 'Tamaño maximo 1'}},
            {text: "%",             dataIndex: 'ca_porciva',            sortable: true, width: 45, editor: {xtype: "numberfield"}},
            {text: "RetFte",        dataIndex: 'ca_retfte',             sortable: true, width: 60, editor: {xtype: "textfield",maxLength: 1,maxLengthText: 'Tamaño maximo 1'}},
            {text: "Cuenta",        dataIndex: 'ca_cuentarf',           sortable: true,            editor: {xtype: "numberfield"}},
            {text: "Base",          dataIndex: 'ca_baserf',             sortable: true,            editor: {xtype: "numberfield"}},
            {text: "%",             dataIndex: 'ca_porcrf',             sortable: true, width: 45, editor: {xtype: "textfield"}},
            {text: "moneda",        dataIndex: 'ca_mone',               sortable: true, width: 70, editor: {xtype: "numberfield"}},
            {text: "Convenio",      dataIndex: 'ca_convenio',           sortable: true, width: 75, editor: {xtype: "textfield",maxLength: 1,maxLengthText: 'Tamaño maximo 1'}},
            {text: "Autoret",       dataIndex: 'ca_autoret',            sortable: true, width: 70, editor: {xtype: "textfield",maxLength: 1,maxLengthText: 'Tamaño maximo 1'}},
            {text: "Base",          dataIndex: 'ca_basear',             sortable: true, width: 65, editor: {xtype: "numberfield"}},
            {text: "Empresa",     dataIndex: 'ca_idempresa',            sortable: true, hidden:true, editor: combo,renderer: comboBoxRenderer(combo)  }
        ],
        plugins: [new Ext.grid.plugin.CellEditing({
                    clicksToEdit: 1
                })],
        listeners:{
            edit : function(editor, e, eOpts)
            {
                //alert(e.field);
                var store = this.store;
                /*if(e.field=="empresa")
                {
                    store.data.items[e.rowIdx].set('ca_idempresa', e.value);                    
                    store.data.items[e.rowIdx].set('empresa', editor.editors.items[0].field.rawValue);
                }*/
            }
        },
        tbar: [{
                text: 'Refrescar',
                iconCls: 'refresh',
                handler: function() {                    
                    this.up("grid").getStore().reload();
                    
                }
            }, {
                text: 'Nuevo',
                iconCls: 'add',
                handler: function() {
                    //alert(record.data.toSource());
                    var store=this.up("grid").getStore();
                    var r = Ext.create(store.getModel());
                    store.insert(0, r);
                }
            },  {
                text: 'Guardar',
                iconCls: 'add',
                id:'btn-guardarConcepto',
                handler : function(){
                    Ext.getCmp('btn-guardarConcepto').disable();
                    var store = this.store;//Ext.getCmp("grid-facturacion").getStore();
                    var store=this.up("grid").getStore();                    
                    var records = store.getModifiedRecords();
                    var lenght = records.length;                    
                    changes=[];
                    for( var i=0; i< lenght; i++){
                        r = records[i];
                        if(r.getChanges()){
                            var idempresa = Ext.getCmp("filtro_empresa").getValue();
                            records[i].set('ca_idempresa',idempresa);
                            records[i].data.id=r.id;
                            changes[i]=records[i].data;
                        }
                    }
                    var str= JSON.stringify(changes);                   
                    if(str.length>5){
                        Ext.Ajax.request({
                                url: '<?= url_for("contabilidad/guardarGridConceptos") ?>',
                                params: {                            
                                    datos:str                            
                                },
                                success: function(response, opts) {
                                    var res = Ext.decode(response.responseText);                                    
                                    if(res.id && res.success){                                        
                                        id=res.id.split(",");                                        
                                        for(i=0;i<id.length;i++){                                            
                                            var rec = store.getById(id[i]);   
                                            rec.set('ca_idconceptosiigo',res.idconceptos[i]);
                                        
                                        if(!rec.get('ca_cod')){
                                            rec.set('ca_cod','');
                                            }
                                        if(!rec.get('ca_descripcion')){
                                            rec.set('ca_descripcion','');
                                            }
                                        if(!rec.get('ca_cuenta')){
                                            rec.set('ca_cuenta','');
                                            }
                                        if(!rec.get('ca_cc')){
                                            rec.set('ca_cc',0);
                                            }
                                        if(!rec.get('ca_scc')){
                                            rec.set('ca_scc',0);
                                            }
                                        if(!rec.get('ca_valor')){
                                            rec.set('ca_valor',0);
                                            }
                                        if(!rec.get('ca_pt')){
                                            rec.set('ca_pt',0);
                                            }
                                        if(!rec.get('ca_iva')){
                                            rec.set('ca_iva',0);
                                            }
                                        if(!rec.get('ca_pt')){
                                            rec.set('ca_pt',0);
                                            }
                                        if(!rec.get('ca_porciva')){
                                            rec.set('ca_porciva',0);
                                            }
                                        if(!rec.get('ca_retfte')){
                                            rec.set('ca_retfte',0);
                                            }
                                        if(!rec.get('ca_cuentarf')){
                                            rec.set('ca_cuentarf',0);
                                            }
                                        if(!rec.get('ca_baserf')){
                                            rec.set('ca_baserf',0);
                                            }
                                        if(!rec.get('ca_porcrf')){
                                            rec.set('ca_porcrf',0);
                                            }
                                        if(!rec.get('ca_mone')){
                                            rec.set('ca_mone',0);
                                            }
                                        if(!rec.get('ca_baserf')){
                                            rec.set('ca_baserf',0);
                                            }
                                        if(!rec.get('ca_convenio')){
                                            rec.set('ca_convenio',0);
                                            }
                                        if(!rec.get('ca_autoret')){
                                            rec.set('ca_autoret',0);
                                            }
                                        if(!rec.get('ca_basear')){
                                            rec.set('ca_basear',0);
                                            }
                                        if(!rec.get('ca_tipo')){
                                            rec.set('ca_tipo',0);
                                            }
                                            rec.commit();                                    
                                        }
                                        Ext.MessageBox.alert("Mensaje",'Se guardó Correctamente la información');                                       
                                    }                                    
                                    if(res.errorInfo=="" || res.errorInfo=="null")
                                    {
                                        
                                    }
                                    else
                                        Ext.MessageBox.alert("Mensaje",'No fue posible el guardar la fila <br>'+res.errorInfo);
                                    Ext.getCmp('btn-guardarConcepto').enable();
                                },
                                failure: function(response, opts) {
                                    Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                    box.hide();
                                    Ext.getCmp('btn-guardarConcepto').enable();
                                }
                            });
                    }
                    else
                        Ext.getCmp('btn-guardarConcepto').enable();
                }                
            }, {
                xtype: 'button',               
                text: 'Eliminar',
                iconCls: 'delete',
                width: 25,
                allowBlank: false,
                hidden: <?=$puedeBorrar?>,
                handler: function() {
                    var store =  Ext.getCmp('grid-conceptos-siigo').getStore();   
                    x = 0;
                    changes = [];
                    for (var i = 0; i < store.getCount(); i++){
                        var record = store.getAt(i);                        
                        if (record.get("borrado")) {                            
                                record.data.id = record.id
                                changes[x] = record.data;
                                x++;                                
                        } 
                    }                    
                    var strGrid = JSON.stringify(changes);                    
                    Ext.Ajax.request({
                        waitMsg: 'Guardando cambios...',
                        url: '<?= url_for("contabilidad/eliminarGridConceptos") ?>',

                        params: {                                    
                            datos: strGrid 
                        },
                        failure: function(response, options) {
                            var res = Ext.util.JSON.decode(response.responseText);
                            if (res.errorInfo)
                                Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.errorInfo);
                            else
                                Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                        },
                        success: function(response, options) {
                            var store =  Ext.getCmp('grid-conceptos-siigo').getStore();
                            store.reload();
                            if (changes.length >0)
                                Ext.MessageBox.alert("Mensaje", 'Datos Eliminados Correctamente<br>');                                             
                        }
                    });                         
                }                
            }, {
                xtype: 'exporterbutton',
                text: 'XLS',
                iconCls: 'csv',
                format:'excel'
            }, {
                xtype: 'wempresas',
                hideLabel: false,
                fieldLabel: 'Empresa',
                labelWidth: 80,
                name: 'filtro_empresa',
                id: 'filtro_empresa',
                width: 220,
                allowBlank: false
            }, {
                xtype: 'button',
                hideLabel: false,
                text: '',
                width: 25,
                iconCls:'search',
                allowBlank: false,                
                handler: function() {
                    var idempresa = Ext.getCmp("filtro_empresa").getValue();
                    var store =  Ext.getCmp('grid-conceptos-siigo').getStore();
                    store.load({
                        params : {
                            idempresa: idempresa
                        }
                    })
                }                
            }, {
                xtype: "textfield",
                fieldLabel: 'Filtrar',
                labelWidth: 40,
                listeners:{
                    change:function( obj, newValue, oldValue, eOpts ){                        
                        var store =  Ext.getCmp('grid-conceptos-siigo').getStore();
                        store.clearFilter();
                        if(newValue!=""){                                                 
                            store.filterBy(function(record, id){
                            var str=record.get("ca_cod");
                            var str1=record.get("ca_descripcion");
                            var str2=record.get("ca_cuenta");                            
                            if(str.toString().toUpperCase().contains(newValue.toUpperCase()) || str1.toString().toUpperCase().contains(newValue.toUpperCase()) || str2.toString().toUpperCase().contains(newValue.toUpperCase())){
                                return true;
                            }
                            else{
                                return false;
                            }                           
                            });
                        }                        
                    }                    
                }
            }]    
    }); 
</script>

