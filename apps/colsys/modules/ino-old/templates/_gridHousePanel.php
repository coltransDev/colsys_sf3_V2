<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">
GridHousePanel = function( config ){
    Ext.apply(this, config);    
    this.columns = [      
      {
        header: "House",
        dataIndex: 'doctransporte',
        width: 100,
        sortable: true,
        renderer: this.formatItem
      },
      {
        header: "Idcliente",
        dataIndex: 'idcliente',
        sortable: true,
        width: 80
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
        width: 80
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
        width: 80
      },
       {
        header: "Peso",
        dataIndex: 'peso',
        hideable: false,
        sortable: true,
        width: 80
      },

      {
        header: "Volumen",
        dataIndex: 'volumen',
        hideable: false,
        width: 80,
        sortable: true
      },
      {
        header: "Proveedor",
        dataIndex: 'tercero',
        hideable: false,
        width: 200,
        sortable: true
      }
     ];

    this.record = Ext.data.Record.create([
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
            {name: 'volumen', type: 'float'}
    ]);

    this.store = new Ext.data.GroupingStore({
        autoLoad : true,
        url: '<?=url_for("ino/datosGridHousePanel")?>',
        baseParams : {
            idmaster: this.idmaster,
            modo: this.modo
        },
        reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'total'
            },
            this.record
        ),
        sortInfo:{field: 'doctransporte', direction: "ASC"}
    });

    this.tbar = [{
        text: 'Recargar',
        iconCls: 'refresh',
        handler : this.recargar,
        scope: this
    }];

    if( !this.readOnly ){
        this.tbar.push({
            text: 'Nuevo House',
            iconCls: 'add',            
            handler : this.newHouse,
            scope: this
        });
    }

    GridHousePanel.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},       
       tbar: this.tbar,
       autoHeight: true,
       id: 'grid-house-panel',
       view: new Ext.grid.GridView({
            forceFit:true,
            enableRowBody:false,
            emptyText: 'No hay datos'            
       }),
       listeners:{
            rowcontextmenu: this.onRowcontextMenu,
            rowdblclick : this.onRowDblclick
       }
    });
    this.getView().getRowClass = this.getRowClass;
};

Ext.extend(GridHousePanel, Ext.grid.GridPanel, {
    newHouse: function(){
        if( !this.readOnly ){
            var win = Ext.getCmp("edit-house-win");
            if( win ){
                win.close();
            }
            var idmaster = this.idmaster;
            var gridOpener = this.id;
            this.win = new Ext.Window({
                title: "Nuevo House",
                id: "edit-house-win",
                modal: true,
                items: new FormHousePanel( {idmaster:idmaster,
                                            gridOpener: gridOpener,
                                            modo: this.modo,
                                            impoexpo: this.impoexpo,
                                            transporte: this.transporte
                                            } ),
                closeAction: 'close',
                width: 800
            });
            this.win.show();
        }
    },
    editHouse: function(idhouse){
       if( !this.readOnly ){           
           var win = Ext.getCmp("edit-house-win");
           if( win ){
                win.close();
           }
           var idmaster = this.idmaster;
           var gridOpener = this.id;
           this.win = new Ext.Window({
                title: "Editar House",
                id: "edit-house-win",
                modal: true,
                items: new FormHousePanel({idmaster:idmaster,
                                           idhouse:idhouse,
                                           gridOpener: gridOpener,
                                           modo: this.modo,
                                           impoexpo: this.impoexpo,
                                           transporte: this.transporte
                                        }),
                closeAction: 'close',
                width: 800
            });
            this.win.show();
       }
    },

    deleteHouse: function(idhouse){
       var modo = this.modo;
       if( !this.readOnly ){
           if( confirm("Esta seguro que desea eliminar este item?") ){
               var store = this.store;
               Ext.Ajax.request({
                    waitMsg: 'Eliminando...',
                    url: '<?=url_for("ino/eliminarGridHousePanel")?>',
                    params :	{
                        idhouse: idhouse,
                        modo: modo
                    },
                    failure:function(response,options){
                        var res = Ext.util.JSON.decode( response.responseText );
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(res.errorInfo?": "+res.errorInfo:"")+" - "+(response.status?"\n Codigo HTTP "+response.status:""));
                    },
                    success:function(response,options){
                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.success ){
                            store.reload();
                        }else{
                            Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(res.errorInfo?": "+res.errorInfo:"")+" - "+(response.status?"\n Codigo HTTP "+response.status:""));
                        }
                    }
                });
            }
       }
    },
    recargar: function(){
        if(this.store.getModifiedRecords().length>0){
            if(!confirm("Se perderan los cambios no guardados, desea continuar?")){
                return 0;
            }
        }
        this.store.reload();
    },
    formatItem: function(value, p, record) {
        return String.format(
            '<b>{0}</b>',
            value
        );
    },
    onRowcontextMenu: function(grid, index, e){
        if( !this.readOnly ){
            rec = this.store.getAt(index);
            var idmaster = rec.data.idmaster;
            var idhouse = rec.data.idhouse;
            if(!this.menu){
                this.menu = new Ext.menu.Menu({
                enableScrolling : false,
                items: [
                        {
                            text: 'Editar',
                            iconCls: 'page_white_edit',
                            scope:this,
                            handler: function(){                              
                                if( this.ctxRecord.data.idhouse  ){
                                    this.editHouse( this.ctxRecord.data.idhouse );
                                }
                            }
                        },
                        {
                            text: 'Eliminar',
                            iconCls: 'delete',
                            scope:this,
                            handler: function(){
                                if( this.ctxRecord.data.idhouse  ){
                                    this.deleteHouse( this.ctxRecord.data.idhouse );
                                }
                            }
                        }
                       ]
                });
                this.menu.on('hide', this.onContextHide , this);
            }
            e.stopEvent();
            if(this.ctxRow){
                Ext.fly(this.ctxRow).removeClass('x-node-ctx');
                this.ctxRow = null;
            }
            this.ctxRecord = rec;
            this.ctxGridId = this.id;
            this.ctxRow = this.view.getRow(index);
            Ext.fly(this.ctxRow).addClass('x-node-ctx');
            this.menu.showAt(e.getXY());
        }
    },
    onContextHide: function(){
        if(this.ctxRow){
            Ext.fly(this.ctxRow).removeClass('x-node-ctx');
            this.ctxRow = null;
            this.ctxGridId = null;
        }
    },
    onRowDblclick: function( grid , rowIndex, e ){
		if( !this.readOnly ){
            record =  this.store.getAt( rowIndex );
            this.editHouse( record.data.idhouse );
        }
	},
    getRowClass : function(record, rowIndex, p, ds){
        p.cols = p.cols-1;
        
        if( record.data.doctransporte=="TOTALES" ){
            //alert( record.data.comprobante );
            var color = "row_pink";
        }else{
            var color = "";
        }        
        return color;
    }
});
</script>