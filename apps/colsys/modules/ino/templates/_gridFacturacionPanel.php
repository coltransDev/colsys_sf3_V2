<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<script type="text/javascript">


GridFacturacionPanel = function( config ){

    Ext.apply(this, config);

    
    this.columns = [
      
      {
        header: "House",
        dataIndex: 'doctransporte',
        //hideable: false,
        width: 100,
        sortable: true,
        renderer: this.formatItem

      },
      {
        header: "Idcliente",
        dataIndex: 'idcliente',
        //hideable: false,
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
        header: "Comprobante",
        dataIndex: 'comprobante',
        //hideable: false,
        sortable: true,
        width: 80,
        renderer: this.formatComprobante

      },
      {
        header: "Fecha",
        dataIndex: 'fchcomprobante',
        hideable: false,
        sortable: true,
        width: 80,
        renderer: Ext.util.Format.dateRenderer('Y-m-d')

      },

      {
        header: "Valor",
        dataIndex: 'valor',
        hideable: false,
        sortable: true,
        width: 80
      }


     ];


    this.record = Ext.data.Record.create([
            
            {name: 'idmaster', type: 'integer'},
            {name: 'idhouse', type: 'integer'},
            {name: 'doctransporte', type: 'string'},
            {name: 'cliente', type: 'string'},
            {name: 'idcliente', type: 'integer'},
            {name: 'comprobante', type: 'string'},
            {name: 'fchcomprobante', type: 'date', dateFormat:'Y-m-d'},
            {name: 'valor', type: 'float'},
            {name: 'color', type: 'string'}
    ]);


    this.store = new Ext.data.GroupingStore({

        autoLoad : true,
        url: '<?=url_for("ino/datosGridFacturacionPanel")?>',
        baseParams : {
            idmaster: this.idmaster
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

    
    GridFacturacionPanel.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},
       //boxMinHeight: 300,
       tbar: this.tbar,
       autoHeight: true,
       view: new Ext.grid.GridView({

            forceFit:true,
            enableRowBody:false
            //showPreview:true,
       }),
       listeners:{
            rowcontextmenu: this.onRowcontextMenu,
            rowdblclick : this.onRowDblclick
       }

    });
    this.getView().getRowClass = this.getRowClass;

};

Ext.extend(GridFacturacionPanel, Ext.grid.GridPanel, {

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

    formatComprobante: function(value, p, record) {
        if( record.data.comprobante ){
            return String.format(
                '<b>{0}</b>',
                value
            );
        }else{
            return "<b>Sin facturar</b>"
        }
    },
    

    onRowcontextMenu: function(grid, index, e){
        if( !this.readOnly ){
            rec = this.store.getAt(index);
            var idmaster = rec.data.idmaster;
            var idhouse = rec.data.idhouse;
            if(!this.menu){ // create context menu on first right click

                this.menu = new Ext.menu.Menu({                
                enableScrolling : false,
                items: [
                        {
                            text: 'Facturar',
                            iconCls: 'page_white_edit',
                            scope:this,
                            handler: function(){
                              
                                if( this.ctxRecord.data.idhouse  ){                                      
                                    this.editHouse( this.ctxRecord.data.idhouse );
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
    }
    ,
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
	}
    ,
    getRowClass : function(record, rowIndex, p, ds){
        p.cols = p.cols-1;
        if( record.data.color ){
            var color = "row_"+record.data.color;
        }else{
            var color = "";
        }        
        return color;
    }

});

</script>