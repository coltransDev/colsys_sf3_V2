
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$permisos = $sf_data->getRaw("permisos");
?>
<script>
    
    var botones=new Array();
    
    <? 
            if($permisos["imprimir"])
            {
            ?>
            botones.push({
                text: '',
                iconCls: 'printer',
                id:'btn-printConsComprobante',
                handler : function(){

                    var store = this.store;//Ext.getCmp("grid-facturacion").getStore();
                    var store=this.up("grid").getStore();
                    //alert(store);
                    var records = store.getModifiedRecords();
                    var lenght = records.length;
                    //alert(records[0].data.toSource());
                    //return;
                    changes=[];
                    for( var i=0; i< lenght; i++){
                        r = records[i];
                        
                         if(records[i].data.sel==true)
                         {
                            records[i].data.id=r.id;
                            changes[i]=records[i].data.ca_idcomprobante;
                         }
                    }
                    
                    var str= JSON.stringify(changes);
                    window.open("/inocomprobantes/generarComprobantePDF/id/"+str);
                    
                }
            });
            <?
            }
            if($permisos["anular"])
            {
            ?>
            botones.push({
                text: '',
                iconCls: 'delete',
                id:'btn-anularConsComprobante',
                handler : function(){
                    
                    var store = this.store;//Ext.getCmp("grid-facturacion").getStore();
                    var store=this.up("grid").getStore();
                    //alert(store);
                    var records = store.getModifiedRecords();
                    var lenght = records.length;
                    //alert(records[0].data.toSource());
                    //return;
                    changes=[];
                    for( var i=0; i< lenght; i++){
                        r = records[i];

                         if(/* r.data.idconcepto!="" && r.data.valor!="" &&*/ r.getChanges())
                         {
                            records[i].data.id=r.id;                            
                            changes[i]=records[i].data.ca_idcomprobante;
                         }
                    }
                    
                    var str= JSON.stringify(changes);
                   
                   
                    Ext.Msg.show({
                        title: 'Address',
                        message: 'Ingrese el motivo de anulación:',
                        width: 300,
                        buttons: Ext.Msg.OKCANCEL,
                        multiline: true,
                        fn: function(btn, text)
                        {
                            if( text.trim()==""){
                                alert("Debe colocar una observacion");
                            }else{
                                Ext.Ajax.request(
                                {
                                    waitMsg: 'Enviando...',
                                    url: '/contabilidad/anularComprobantes',
                                    params :	{
                                        "observaciones": text.trim(),
                                        "id": str
                                    },
                                    failure:function(response,options){
                                        alert( response.toSource()  );
                                        //Ext.Msg.hide();
                                        success = false;
                                        alert("Surgio un problema al tratar de anular la referencia");
                                    },
                                    success:function(response,options){
                                        var res = Ext.util.JSON.decode( response.responseText );
                                        if( res.errorInfo!="" )
                                        {
                                            alert("Se presento error al anular: \n"+res.errorInfo)
                                        }
                                        if( res.success ){                                            
                                            store.reload();
                                        }
                                        else
                                        {
                                            Ext.MessageBox.alert("Mensaje de Error", res.errorInfo);
                                        }
                                    }
                                });
                            }
                        },
                        animateTarget: 'addAddressBtn',
                        icon: Ext.window.MessageBox.INFO
                    });
                }
            });
            <?
            }
            if($permisos["enviarsiigo"])
            {
            ?>
                botones.push({
                    text: '',
                    iconCls: 'import',
                    id:'btn-anularEnviarSiigo',
                    handler : function(){

                        var store = this.store;//Ext.getCmp("grid-facturacion").getStore();
                        var store=this.up("grid").getStore();
                        //alert(store);
                        var records = store.getModifiedRecords();
                        var lenght = records.length;
                        //alert(records[0].data.toSource());
                        //return;
                        changes=[];
                        for( var i=0; i< lenght; i++){
                            r = records[i];

                             if(/* r.data.idconcepto!="" && r.data.valor!="" &&*/ r.getChanges())
                             {
                                records[i].data.id=r.id;                            
                                changes[i]=records[i].data.ca_idcomprobante;
                             }
                        }

                        var str= JSON.stringify(changes);

                        var box = Ext.MessageBox.wait('Procesando', 'Enviando Comprobante')
                        Ext.Ajax.request(
                        {
                            waitMsg: 'Enviando...',
                            url: '/contabilidad/enviarSiigoConect',
                            params :	{                                
                                "idcomprobante": str
                            },
                            failure:function(response,options){
                                alert( response.toSource()  );
                                //Ext.Msg.hide();
                                success = false;
                                alert("Surgio un problema al tratar de enviar el comprobante a SIIGO");
                                box.hide();
                            },
                            success:function(response,options){
                                var res = Ext.util.JSON.decode( response.responseText );
                                if( res.indincor!="+5" )
                                {
                                    alert("Se presento error al enviar el comprobante: \n"+res.errorInfo)
                                }
                                /*if( res.success ){
                                    store.reload();
                                }
                                else
                                {
                                    Ext.MessageBox.alert("Mensaje de Error", res.errorInfo);
                                }*/
                                store.reload();
                                box.hide();
                            }
                        });

                        
                    }
                });
            <?
            }
            ?>
            
            botones.push({
                xtype: 'exporterbutton',
                text: 'XLS',
                iconCls: 'csv',
                format:'excel'
            });
    
    
    Ext.define('GridConsComprobantes',{
        extend: 'Ext.grid.Panel',
        bufferedRenderer: false,
        title: 'Resultado búsqueda',
        store: Ext.create('Ext.data.Store', {
            fields: [
                { name: 'sel' },
                { name: 'ca_idmaster',      mapping: 'ca_idmaster'      },
                { name: 'ca_fchreferencia', mapping: 'ca_fchreferencia' },
                { name: 'ca_fchgenero'  ,   mapping: 'ca_fchgenero' },
                { name: 'ca_referencia',    mapping: 'ca_referencia'    },
                { name: 'ca_transporte',    mapping: 'ca_transporte'    },
                { name: 'ca_impoexpo',      mapping: 'ca_impoexpo'      },
                { name: 'ca_modalidad',     mapping: 'ca_modalidad'     },
                { name: 'ca_origen',        mapping: 'ca_ciuorigen'     },
                { name: 'ca_destino',       mapping: 'ca_ciudestino'    },
                { name: 'ca_idcliente',     mapping: 'ca_idcliente'     },
                { name: 'ca_doctransporte', mapping: 'ca_doctransporte' },
                { name: 'ca_idreporte',     mapping: 'ca_noreporte'     },
                { name: 'ca_idtercero',     mapping: 'ca_idtercero'     },
                { name: 'ca_id',            mapping: 'ca_id'            },
                { name: 'ca_fchcomprobante',mapping: 'ca_fchcomprobante'},
                { name: 'ca_consecutivo',   mapping: 'ca_consecutivo'   },
                { name: 'ca_idtipo',        mapping: 'ca_idtipo'        },
                { name: 'ca_idcomprobante', mapping: 'ca_idcomprobante' },
                { name: 'ca_estado',        mapping: 'ca_estado' },
                { name: 'ca_idhouse',       mapping: 'ca_idhouse'       },
                { name: 'ca_tipo',          mapping: 's_ca_tipo'        },
                { name: 'ca_comprobante',   mapping: 'ca_comprobante'   },
                { name: 'ca_idsucursal',    mapping: 'ca_idsucursal'    },
                { name: 'ca_idempresa',     mapping: 'ca_idempresa'     },
                { name: 'ca_empresa',       mapping: 'ca_empresa'     },
                { name: 'ca_titulo',        mapping: 'ca_titulo' },
                { name: 'ca_valor',         mapping: 'ca_valor' },
                { name: 'ca_valor2',        mapping: 'ca_valor2' }
            ],
            autoLoad:false,
            remoteSort: false,
            proxy: {
                type: 'ajax',
                url: '/contabilidad/consultaResult',
                reader: {
                    type: 'json',
                    rootProperty: 'root'
                }
            }
        }),
        columns: [
            { xtype : 'checkcolumn', text : '', dataIndex : 'sel',width:30 },
            {text: "Fecha Ref"  ,  dataIndex: 'ca_fchreferencia',  sortable: true},
            {text: "Fecha Generado"  ,  dataIndex: 'ca_fchgenero',  sortable: true},
            {text: "no. Ref"    ,     dataIndex: 'ca_referencia',     sortable: true,width:130,
                xtype:'templatecolumn',tpl:'<a href="/inoF/verReferenciaExt4/modo/5/idmaster/{ca_idmaster}" target="_blank">{ca_referencia}</a>'
            },
            {text: "No. Comp"   ,    dataIndex: 'ca_consecutivo',    sortable: true},
            {text: "Valor"      ,    dataIndex: 'ca_valor',    sortable: true},
            {text: "Valor + Imp",    dataIndex: 'ca_valor2',    sortable: true},
            {text: "Transporte" ,     dataIndex: 'ca_transporte',     sortable: true},
            //{text: "ca_impoexpo",       dataIndex: 'ca_impoexpo',       sortable: true},
            {text: "Modalidad",      dataIndex: 'ca_modalidad',      sortable: true},
            {text: "Origen",         dataIndex: 'ca_origen',         sortable: true},
            {text: "Destino",        dataIndex: 'ca_destino',        sortable: true},
            {text: "Cliente",      dataIndex: 'ca_idcliente',      sortable: true},
            {text: "Doc.Trans",  dataIndex: 'ca_doctransporte',  sortable: true},
            {text: "Reporte",      dataIndex: 'ca_idreporte',      sortable: true},
            {text: "Tercero",      dataIndex: 'ca_idtercero',      sortable: true},
            {text: "Id",             dataIndex: 'ca_id',             sortable: true},
            {text: "Fecha Comp", dataIndex: 'ca_fchcomprobante', sortable: true},            
            //{text: "Idtipo",         dataIndex: 'ca_idtipo',         sortable: true},
            //{text: "ca_idcomprobante",  dataIndex: 'ca_idcomprobante',  sortable: true},
            //{text: "Tipo",           dataIndex: 'ca_tipo',           sortable: true},
            //{text: "Comprobante",    dataIndex: 'ca_comprobante',    sortable: true},
            //{text: "Titulo",         dataIndex: 'ca_titulo',         sortable: true},
            {text: "Empresa",           dataIndex: 'ca_empresa',           sortable: true}
        ],
        tbar: botones,        
        height:500,
        viewConfig: {
            getRowClass: function(record, rowIndex, rowParams, store) {
                if (record.get('ca_estado')=='8' ) return 'row_purple';
                else if (record.get('ca_estado')=='6' ) return 'row_pink';
                else if (record.get('ca_estado')=='2' ) return 'row_blue';
                
            }
        }
    });
    
</script>

