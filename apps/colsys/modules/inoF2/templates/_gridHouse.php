<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

//include_component("inoF", "formHouseExt4",array("idmaster"=>$idmaster,"modo" => $modo->getCaIdmodo()));
//$enable=($readOnly=="1")?false:true;
?>


<script type="text/javascript">
var constrainedWin2H=null;
Ext.Loader.setConfig({
    enabled: true
});

Ext.define('rechouse', {
     extend: 'Ext.data.Model',
     fields: [
        {name: 'idmaster', type: 'integer'},
            {name: 'idhouse', type: 'integer'},
            {name: 'doctransporte', type: 'string'},
            {name: 'fchdoctransporte', type: 'date', dateFormat:'Y-m-d'},
            {name: 'idcliente', type: 'integer'},
            {name: 'cliente', type: 'string'},
            {name: 'idreporte', type: 'integer'},
            {name: 'tercero', type: 'string'},
            {name: 'vendedor', type: 'string'},
            {name: 'idtercero', type: 'integer'},
            {name: 'reporte', type: 'string'},
            {name: 'numpiezas', type: 'string'},
            {name: 'peso', type: 'float'},
            {name: 'volumen', type: 'float'},
            {name: 'color', type: 'string'}
     ]
 });


Ext.define('Colsys.Ino.GridHouse', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.wCIGHouse',
    store: Ext.create('Ext.data.Store', {
        model: 'rechouse',
        proxy: {
            type: 'ajax',
            url: '<?=url_for('inoF2/datosGridHouse')?>',         
            reader: {
                type: 'json',
                root: 'root',
                totalProperty: 'total'
            }
        },        
        sorters: [{
            property: 'doctransporte',
            direction: 'ASC'
        }],
        autoLoad: false
    }),
    
    //id:'grid-house',
    features: [{            
            ftype: 'summary'
        }],
    columns: [
    {
        header: "House",
        dataIndex: 'doctransporte',
        width: 150,
        sortable: true,
        renderer: this.formatItem,
        summaryRenderer: function(value, summaryData, dataIndex) {
            return "<b>Total</b>"; 
        }
    },
    {
        header: "Idcliente",
        dataIndex: 'idcliente',
        sortable: true,
        width: 120
    },
    {
        header: "Cliente",
        dataIndex: 'cliente',
        hideable: false,
        sortable: true,
        width: 280
    },
    {
        header: "Reporte",
        dataIndex: 'reporte',
        sortable: true,
        width: 100
    },
    {
        header: "Vendedor",
        dataIndex: 'vendedor',
        hideable: false,
        sortable: true,
        width: 80
    },
    {
        header: "Piezas",
        dataIndex: 'numpiezas',
        hideable: false,
        sortable: true,
        width: 100/*,
        summaryType: 'sum',
        summaryRenderer: function(value, summaryData, dataIndex) {
                return "<b> : "+value+"</b>";
            }*/
    },
    {
        header: "Peso",
        dataIndex: 'peso',
        hideable: false,
        sortable: true,
        width: 100,
        align: 'right',
        renderer: Ext.util.Format.numberRenderer('0,0.00'),
        summaryType: 'sum',        
        summaryRenderer: function(value, summaryData, dataIndex) {
                return "<b> "+Ext.util.Format.number(value,'0,0.00') +"</b>";
            }
    },
    {
        header: "Volumen",
        dataIndex: 'volumen',
        hideable: false,
        width: 100,
        align: 'right',
        sortable: true,
        renderer: Ext.util.Format.numberRenderer('0,0.00'),
        summaryType: 'sum',        
        summaryRenderer: function(value, summaryData, dataIndex) {
                return "<b> "+Ext.util.Format.number(value,'0,0.00')+"</b>";
            }
    },
    {
        header: "Proveedor",
        dataIndex: 'tercero',
        hideable: false,
        width: 200,
        sortable: true
    }],
    viewConfig: {
        getRowClass: function(record, rowIndex, rowParams, store){
     
            return "row_"+record.get("color");
        }
    },
    selModel: {
        selType: 'cellmodel'
    },
    //width: 600,
    //height: 300,
    frame: true,
    <?
    if($enable)
    {
    ?>
    tbar: [{
        text: 'Agregar',
        iconCls: 'add',
        handler : function(){
            this.up('grid').ventanaFac(null)
            //Ext.getCmp("grid-house").ventanaFac(null);
        }
    },
    {
        text: 'Guardar',
        iconCls: 'add',
        handler : function(){
            //var store = Ext.getCmp("grid-house").getStore();
            var store = this.up('grid').getStore();
            
            var records = store.getModifiedRecords();
            var lenght = records.length;

            changes=[];
            for( var i=0; i< lenght; i++){
                r = records[i];

                 if( r.data.iditem!="" && r.getChanges())
                 {                
                    records[i].data.id=r.id                    
                    changes[i]=records[i].data;               
                 }
            }
            
            
            var str= JSON.stringify(changes);
            if(str.length>5)
            {
                Ext.Ajax.request({
                        url: '<?= url_for("inoF/guardarGridHouse") ?>',
                        params: {                            
                            datos:str                            
                        },

                        callback :function(options, success, response){
                            var res = Ext.util.JSON.decode( response.responseText );
                            //store=Ext.getCmp("grid-house").getStore();
                            this.up('grid').getStore();
                            store.each(function(r){
                                if(r.id==res.id){
                                    store.remove(r);
                                    Ext.Msg.alert("Success", "Se guardaron correctamente los datos");
                                }
                            });

                        }
                    });
              }
            //alert(changes.toSource());
        }
    }
    
    ],
    <?
    }
    ?>
    plugins: [
    new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],
    listeners: {
        
        activate: function(ct, position){
           if(this.load==false || this.load=="undefined" || !this.load)
           {

                this.store.proxy.extraParams = {
                    idmaster: this.idmaster
                }
                this.store.reload();
                this.load=true;
            }
           //this.superclass.onRender.call(this, ct, position);
        },
        validateedit: function(editor,e){ },
    
    <?
    if($enable)
    {
    ?>
      beforeitemcontextmenu: function(view, record, item, index, e)
      {
        e.stopEvent();
        //var record = this.store.getAt(index);
        
        var items = new Array();
        
        var menu = new Ext.menu.Menu({
            items: [
                {
                    text: 'Editar',
                    handler: function() {
                        //Ext.getCmp("grid-house").ventanaFac(record);
                        this.up('grid').ventanaFac(record);
                        
                    }
                },
                {
                    text: 'Eliminar',
                    iconCls: 'delete',
                    scope:this,
                    handler: function(){
                        
                        
                        
                        Ext.MessageBox.confirm('Confirmacion', 'esta seguro de Eliminar el registro', 
                        function(e){
                            if(e == 'yes'){
                                var box = Ext.MessageBox.wait('Procesando', 'Eliminando')
                                Ext.Ajax.request({
                                    waitMsg: 'Eliminando...',
                                    url: '<?=url_for("inoF/eliminarGridHousePanel")?>',
                                    params :	{
                                        idhouse: record.data.idhouse/*,
                                        modo: '<?=$modo->getCaIdmodo()?>'*/
                                    },
                                    success: function(response, opts) {
                                        var obj = Ext.decode(response.responseText);                                        
                                        if(obj.errorInfo!="" && obj.errorInfo!="undefined")
                                         {
                                             alert("Se presento un error: " + obj.errorInfo);                                            
                                         }
                                        else
                                        {
                                            
                                            //Ext.getCmp("grid-house").getStore().reload();
                                            this.up('grid').getStore().reload();
                                        }
                                        box.hide();
                                    },
                                    failure: function(response, opts) {
                                        Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                        box.hide();
                                    }
                                });
                            }
                        })
                        
                        
                    }
                }
            ]
        }).showAt(e.xy);
      }
    <?
    }
    ?>
      
    },    
    ventanaFac : function(record)
    {
        if(constrainedWin2H==null)
        {
            constrainedWin2H = Ext.create('Ext.Window', {
                title: 'House',
                width: 600,
                autoHeight: true,
                closeAction: 'hide',
                x: 120,
                y: 120,
                id:"winFormEditH",
                name:"winFormEditH",
                constrainHeader: true,
                frame: true,
                layout: 'form',
                items: [{
                    xtype:'wFormHouse',                                
                    id:'form-panelH',
                    name:'form-panelH'
                }]
            })
        }
        if(record!=null)
        {
            //alert(record.data.toSource());
            Ext.getCmp("form-panelH").cargar(record.data.idhouse);            
        }
        constrainedWin2H.show();
    }


});

</script>


