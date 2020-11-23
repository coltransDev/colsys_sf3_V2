
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$permisos = $sf_data->getRaw("permisos");
?>
<script>
    var winComprobante=null;
    var botones=new Array();
    
        botones.push({
            text: '',
            iconCls: 'printer',
            id:'btn-printConsComprobante',
            handler : function(){

                var store=this.up("grid").getStore();                
                var records = store.getModifiedRecords();
                var lenght = records.length;
                
                changes=[];
                for( var i=0; i< lenght; i++){
                    r = records[i];
                    if(records[i].get("sel"+this.up("grid").idgrid)==true){
                        records[i].data.id=r.id;
                        changes[i]=records[i].data.ca_idcomprobante;
                    }
                }
                
                var str= JSON.stringify(changes);                
                window.open("/inocomprobantes/generarComprobantePDF/id/"+str);
            }
        });
    <?
    
    if($permisos["anular"]){
        ?>
        botones.push({
            text: '',
            iconCls: 'delete',
            id:'btn-anularConsComprobante',
            handler : function(){
                
                var grid=this.up("grid");                
                var store=grid.getStore();
                
                var records = store.getModifiedRecords();
                var lenght = records.length;
                
                changes=[];
                for( var i=0; i< lenght; i++){
                    r = records[i];

                     if( r.getChanges())
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
                            console.log(btn);
                            if(btn == "ok"){
                                grid.setLoading(true);
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

                                        success = false;
                                        alert("Surgio un problema al tratar de anular la referencia");
                                        grid.setLoading(false);
                                    },
                                    success:function(response,options){
                                        var res = Ext.util.JSON.decode( response.responseText );

                                        Ext.MessageBox.alert("Mensaje ","Factura anulada No. "+ res.resul);
                                        store.reload();
                                        grid.setLoading(false);
                                    }
                                });
                            }
                        }
                    },
                    animateTarget: 'addAddressBtn',
                    icon: Ext.window.MessageBox.INFO
                });
            }
        });
        <?
    }
    if($permisos["enviarsiigo"]){
        ?>
        botones.push({
            text: '',
            iconCls: 'import',
            id:'btn-anularEnviarSiigo',
            handler : function(){

                var store = this.up("grid").getStore();
                
                var records = store.getModifiedRecords();
                var lenght = records.length;
                
                changes=[];
                for( var i=0; i< lenght; i++){
                    r = records[i];

                     if(r.getChanges())
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
                        store.reload();
                        box.hide();
                    }
                });


            }
        });
        <?
    }
    ?>
    
    Ext.define('GridConsComprobantes',{
        extend: 'Ext.grid.Panel',        
        title: 'Resultado búsqueda',
        height:500,
        requires:[
            'Ext.grid.plugin.Exporter',
            'Ext.view.grid.ExporterController'
        ],
        plugins:{            
            gridexporter: true
        },
        viewConfig: {
            getRowClass: function(record, rowIndex, rowParams, store) {
                if (record.get('ca_estado')=='8' ) return 'row_purple';
                else if (record.get('ca_estado')=='6' ) return 'row_pink';
                else if (record.get('ca_estado')=='2' ) return 'row_blue';
            }
        },
        listeners: {
            beforerender: function(ct, position){
                this.reconfigure(
                    store = Ext.create('Ext.data.Store', {
                        fields: [
                            { name: 'sel'+this.idgrid },
                            { name: 'ca_idmaster'+this.idgrid,      mapping: 'ca_idmaster'      },
                            { name: 'ca_aplicacion'+this.idgrid,    mapping: 'ca_aplicacion'    },
                            { name: 'ca_fchreferencia'+this.idgrid, mapping: 'ca_fchreferencia' },
                            { name: 'ca_fchgenero'+this.idgrid  ,   mapping: 'ca_fchgenero'     },
                            { name: 'ca_referencia'+this.idgrid,    mapping: 'ca_referencia', type: 'string'    },
                            { name: 'ca_transporte'+this.idgrid,    mapping: 'ca_transporte', type: 'string'    },
                            { name: 'ca_impoexpo'+this.idgrid,      mapping: 'ca_impoexpo'      },
                            { name: 'ca_modalidad'+this.idgrid,     mapping: 'ca_modalidad'     },
                            { name: 'ca_origen'+this.idgrid,        mapping: 'ca_ciuorigen'     },
                            { name: 'ca_destino'+this.idgrid,       mapping: 'ca_ciudestino'    },
                            { name: 'ca_succliente'+this.idgrid,    mapping: 'ca_succliente'    },
                            { name: 'ca_idcliente'+this.idgrid,     mapping: 'ca_idcliente'     },
                            { name: 'ca_doctransporte'+this.idgrid, mapping: 'ca_doctransporte' },
                            { name: 'ca_idreporte'+this.idgrid,     mapping: 'ca_noreporte'     },
                            { name: 'ca_idtercero'+this.idgrid,     mapping: 'ca_idtercero'     },
                            { name: 'ca_id'+this.idgrid,            mapping: 'ca_id'            },
                            { name: 'ca_fchcomprobante'+this.idgrid,mapping: 'ca_fchcomprobante'},
                            { name: 'ca_consecutivo'+this.idgrid,   mapping: 'ca_consecutivo', type: 'string'   },
                            { name: 'ca_idtipo'+this.idgrid,        mapping: 'ca_idtipo'        },
                            { name: 'ca_idcomprobante'+this.idgrid, mapping: 'ca_idcomprobante' },
                            { name: 'ca_estado'+this.idgrid,        mapping: 'ca_estado'        },
                            { name: 'ca_idhouse'+this.idgrid,       mapping: 'ca_idhouse'       },
                            { name: 'ca_tipo'+this.idgrid,          mapping: 's_ca_tipo'        },
                            { name: 'ca_comprobante'+this.idgrid,   mapping: 'ca_comprobante'   },
                            { name: 'ca_idsucursal'+this.idgrid,    mapping: 'ca_idsucursal'    },
                            { name: 'ca_idempresa'+this.idgrid,     mapping: 'ca_idempresa'     },
                            { name: 'ca_empresa'+this.idgrid,       mapping: 'ca_empresa'       },
                            { name: 'ca_titulo'+this.idgrid,        mapping: 'ca_titulo'        },
                            { name: 'ca_valor'+this.idgrid,         mapping: 'ca_valor'         },
                            { name: 'ca_valor2'+this.idgrid,        mapping: 'ca_valor2'        },
                            { name: 'ca_idfacturado'+this.idgrid,   mapping: 'ca_idfacturado'   },
                            { name: 'ca_nomfacturado'+this.idgrid,  mapping: 'ca_nomfacturado'  },
                            { name: 'ca_idmoneda'+this.idgrid,      mapping: 'ca_idmoneda'      },
                            { name: 'ca_fchllegada'+this.idgrid,    mapping: 'ca_fchllegada'    },
                            { name: 'ca_usugenero'+this.idgrid,     mapping: 'ca_usugenero'     },
                            { name: 'ca_fchgenero'+this.idgrid,     mapping: 'ca_fchgenero'     },
                            { name: 'ca_estado'+this.idgrid,        mapping: 'ca_estado'        },
                            { name: 'ca_tcambio'+this.idgrid,       mapping: 'ca_tcambio'       }
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
                    [
                        {text : '',             dataIndex : 'sel'+this.idgrid,              xtype : 'checkcolumn',                  width:30 },
                        {text: "App"  ,         dataIndex: 'ca_aplicacion'+this.idgrid,                             sortable: true},
                        {text: "Fecha Ref"  ,   dataIndex: 'ca_fchreferencia'+this.idgrid,                          sortable: true},
                        {text: "Fecha Generado",dataIndex: 'ca_fchgenero'+this.idgrid,                              sortable: true},
                        {text: "Referencia"    ,   dataIndex: 'ca_referencia'+this.idgrid,     xtype:'templatecolumn', sortable: true, width:130,  tpl:'<a href="/inoF2/indexExt5/idmaster/{ca_idmaster}" target="_blank">{ca_referencia}</a>'},
                        {text: "Comprobante #"   ,   dataIndex: 'ca_consecutivo'+this.idgrid,    xtype:'templatecolumn', sortable: true, 
                        tpl:'<a href="javascript:verComprobante(\'{ca_idmoneda}\',\'{file}\',\'{ca_idmaster}\')">{ca_consecutivo}</a>'},
                        {text: "Moneda"      ,  dataIndex: 'ca_idmoneda'+this.idgrid,                               sortable: true},
                        {text: "T. Cambio",     dataIndex: 'ca_tcambio'+this.idgrid,                                sortable: true},                        
                        {text: "Valor"      ,   dataIndex: 'ca_valor'+this.idgrid,                                  sortable: true},                        
                        {text: "Valor + Imp",   dataIndex: 'ca_valor2'+this.idgrid,                                 sortable: true},                        
                        {text: "Empresa",       dataIndex: 'ca_empresa'+this.idgrid,                                sortable: true},
                        {text: "Transporte" ,   dataIndex: 'ca_transporte'+this.idgrid,                             sortable: true},            
                        {text: "Modalidad",     dataIndex: 'ca_modalidad'+this.idgrid,                              sortable: true},
                        {text: "Origen",        dataIndex: 'ca_origen'+this.idgrid,                                 sortable: true},
                        {text: "Destino",       dataIndex: 'ca_destino'+this.idgrid,                                sortable: true},
                        {text: "Id Cliente",    dataIndex: 'ca_idfacturado'+this.idgrid,                            sortable: true},
                        {text: "Cliente",       dataIndex: 'ca_nomfacturado'+this.idgrid,                           sortable: true, width:200},            
                        {text: "Doc.Trans",     dataIndex: 'ca_doctransporte'+this.idgrid,                          sortable: true, width:150},
                        {text: "Suc.Cliente",   dataIndex: 'ca_succliente'+this.idgrid,                             sortable: true},
                        {text: "Reporte",       dataIndex: 'ca_idreporte'+this.idgrid,                              sortable: true},
                        {text: "Tercero",       dataIndex: 'ca_idtercero'+this.idgrid,                              sortable: true},
                        {text: "Id",            dataIndex: 'ca_id'+this.idgrid,                                     sortable: true},
                        {text: "Fecha Comp",    dataIndex: 'ca_fchcomprobante'+this.idgrid,                         sortable: true},
                        {text: "Fecha LLegada", dataIndex: 'ca_fchllegada'+this.idgrid,                             sortable: true},
                        {text: "Usu. Genero",   dataIndex: 'ca_usugenero'+this.idgrid,                              sortable: true},
                        {text: "Fch. Genero",   dataIndex: 'ca_fchgenero'+this.idgrid,                              sortable: true},
                        {text: "Estado",        dataIndex: 'ca_estado'+this.idgrid,                                 sortable: true,
                            renderer: function (val){
                                switch (val) {
                                    case 0:
                                        return 'ABIERTO';
                                    case 1:
                                        return 'PARA TRANSFERIR';
                                    case 5:
                                        return 'TRANSFERIDO';
                                    case 6:
                                        return 'ERROR TRANSFERIDO';
                                    case 8:
                                        return 'ANULADO';
                                    default:
                                        return 'SIN DEFINIR';

                                }                               
                            }
                        }
                    ]
                )
        
                botones.push({
                    xtype: 'button',                    
                    iconCls: 'csv',
                    handler: function(){
                        console.log(this.up("grid"));
                        this.up("grid").saveDocumentAs({
                            type: 'excel07',
                            ext: 'xlsx',
                            title: 'Listado de comprobantes',
                            fileName: 'Listado_de_Comprobantes.xlsx'
                        })
                    }
                });
                
                var obj = {
                    xtype: 'toolbar',
                    dock: 'top',                    
                    id: 'bar-grid-'+this.idgrid,                
                    items: botones
                    
                };
                this.addDocked(obj);
            }            
        }
    });  
    
    
    
function verComprobante(idmoneda, file,  idmaster) {
    
    if (winComprobante == null) {
        winComprobante = Ext.create('Ext.Window',{
            title: 'Comprobante',
            width: 400,
            id: 'compr' + idmaster,            
            height: 180,
            items: {
                xtype: 'Colsys.Ino.FormComprobanteAereo',
                idmaster: idmaster,
                file: file,
                idmoneda: idmoneda
            },
            listeners: {
                close: function (win, eOpts) {
                    winComprobante = null;
                }
            }
        });
    }
    winComprobante.show();        
}

</script>