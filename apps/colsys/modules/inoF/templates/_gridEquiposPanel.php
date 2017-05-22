<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
include_component("widgets", "widgetConcepto");
?>
<script type="text/javascript">
GridEquiposPanel = function( config ){
    Ext.apply(this, config);    
    this.columns = [      
    {
        header: "Contenedor",
        dataIndex: 'concepto',
        width: 100,
        sortable: true,
        renderer: this.formatItem,
        editor: new WidgetConcepto({linkModalidad: "<?=Constantes::FCL?>",linkTransporte: "<?=Constantes::MARITIMO?>"})
    },      
    {
        header: "Serial",
        dataIndex: 'serial',
        sortable: true,
        width: 80,
        editor: new Ext.form.TextField()
      },
      {
        header: "Precinto",
        dataIndex: 'numprecinto',
        hideable: false,
        sortable: true,
        width: 280,
        editor: new Ext.form.TextField()
      },
      {
        header: "Observaciones",
        dataIndex: 'observaciones',
        sortable: true,
        width: 80,
        editor: new Ext.form.TextField()
      }
     ];

    this.record = Ext.data.Record.create([
            {name: 'idmaster', type: 'integer'},
            {name: 'idequipo', type: 'integer'},
            {name: 'cantidad', type: 'float'},
            {name: 'concepto', type: 'string'},
            {name: 'idconcepto', type: 'integer'},
            {name: 'serial', type: 'string'},
            {name: 'numprecinto', type: 'string'},
            {name: 'observaciones', type: 'string'}
            
    ]);

    this.store = new Ext.data.GroupingStore({
        autoLoad : true,
        url: '<?=url_for("inoF/datosGridEquiposPanel")?>',
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
        sortInfo:{field: 'concepto', direction: "ASC"}
    });

    this.tbar = [{
        text: 'Recargar',
        iconCls: 'refresh',
        handler : this.recargar,
        scope: this
    }];

    if( !this.readOnly ){
        this.tbar.push({
            text: 'Nuevo Contenedor',
            iconCls: 'add',            
            handler : this.newCont,
            scope: this
        });
    }

    GridEquiposPanel.superclass.constructor.call(this, {
        clicksToEdit: 1,
        stripeRows: true,
       loadMask: {msg:'Cargando...'},       
       tbar: this.tbar,
       autoHeight: true,
       id: 'grid-equipo-panel',
       view: new Ext.grid.GridView({
            emptyText: "No hay datos",
            forceFit:true,
            enableRowBody:true,
            hideGroupedColumn: true
            /*forceFit:true,
            enableRowBody:false,
            emptyText: 'No hay datos'            */
       }),
       listeners:{
            rowcontextmenu: this.onRowcontextMenu,
            rowdblclick : this.onRowDblclick
       }
    });
};

Ext.extend(GridEquiposPanel, Ext.grid.EditorGridPanel, {
    newCont: function(){
        if( !this.readOnly ){
            var win = Ext.getCmp("edit-equipo-win");
            if( win ){
                win.close();
            }
            var idmaster = this.idmaster;
            var gridOpener = this.id;
            this.win = new Ext.Window({
                title: "Nuevo Contenedor",
                id: "edit-equipo-win",
                modal: true,
                items: new FormEquiposPanel( {idmaster:idmaster,
                                            gridOpener: gridOpener,
                                            modo: this.modo
                                            } ),
                closeAction: 'close',
                width: 800
            });
            this.win.show();
        }
    },
    editCont: function(idequipo){
       if( !this.readOnly ){           
           var win = Ext.getCmp("edit-equipo-win");
           if( win ){
                win.close();
           }
           var idmaster = this.idmaster;
           var gridOpener = this.id;
           this.win = new Ext.Window({
                title: "Editar Contenedor",
                id: "edit-equipo-win",
                modal: true,
                items: new FormEquiposPanel({idmaster:idmaster,
                                           idequipo:idequipo,
                                           gridOpener: gridOpener,
                                           modo: this.modo
                                        }),
                closeAction: 'close',
                width: 800
            });
            this.win.show();
       }
    },
    deleteCont: function(idequipo){
       var modo = this.modo;
       if( !this.readOnly ){
           if( confirm("Esta seguro que desea eliminar este item?") ){
               var store = this.store;
               Ext.Ajax.request({
                    waitMsg: 'Eliminando...',
                    url: '<?=url_for("inoF/eliminarGridEquiposPanel")?>',
                    params :	{
                        idequipo: idequipo,
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
                                if( this.ctxRecord.data.idequipo  ){
                                    this.editCont( this.ctxRecord.data.idequipo );
                                }
                            }
                        },
                        {
                            text: 'Eliminar',
                            iconCls: 'delete',
                            scope:this,
                            handler: function(){
                                if( this.ctxRecord.data.idequipo  ){
                                    this.deleteCont( this.ctxRecord.data.idequipo );
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
            this.editCont( record.data.idequipo );
        }
	}

});
</script>