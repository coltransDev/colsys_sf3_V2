<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


include_component("inoF", "editCostosWindow");
?>

<script type="text/javascript">


GridCostosPanel = function( config ){

    Ext.apply(this, config);

    
    this.columns = [
           
      {
        header: "Proveedor",
        dataIndex: 'proveedor',
        //hideable: false,
        sortable: true,
        width: 80
      },  
      {
        header: "Costo",
        dataIndex: 'concepto',
        //hideable: false,
        sortable: true,
        width: 80,
        renderer: this.formatItem
      }, 
      {
        header: "Factura",
        dataIndex: 'factura',
        hideable: false,
        sortable: true,
        width: 80        

      },
      {
        header: "Neta",
        dataIndex: 'neto',
        hideable: false,
        sortable: true,
        width: 80,
        align: 'right',
        renderer: Ext.util.Format.numberRenderer('0,0.00')
       
      },
      {
        header: "Cambio",
        dataIndex: 'tcambio',
        hideable: false,
        sortable: true,
        width: 80,
        align: 'right',
        renderer: Ext.util.Format.numberRenderer('0,0.00')       
      },
      {
        header: "Cambio USD",
        dataIndex: 'tcambio_usd',
        hideable: false,
        sortable: true,
        width: 80,
        align: 'right',
        renderer: Ext.util.Format.numberRenderer('0,0.00')       
      },
      {
        header: "Valor <?=$monedaLocal?>",
        dataIndex: 'valor_pesos',
        hideable: false,
        sortable: false,
        width: 80,
        align: 'right',
        renderer: this.valorPesos
      },      
      {
        header: "Venta",
        dataIndex: 'venta',
        hideable: false,
        sortable: false,
        width: 80,
        align: 'right',
        renderer: Ext.util.Format.numberRenderer('0,0.00')
       
      },
      {
        header: "INO x Sobreventa",
        dataIndex: 'utilidad',
        hideable: false,
        sortable: true,
        width: 80,
        align: 'right',
        renderer: this.utilidad
      },
      {
        header: "Moneda",
        dataIndex: 'idmoneda',
        hideable: false,
        sortable: true,
        width: 80,
        align: 'left'
      }
      


     ];


    this.record = Ext.data.Record.create([
            
            {name: 'idmaster', type: 'integer', mapping: 'c_ca_idmaster'},
            {name: 'idinocosto', type: 'integer', mapping: 'c_ca_idinocosto'},
            {name: 'idcosto', type: 'integer', mapping: 'c_ca_idcosto'},
            {name: 'concepto', type: 'string', mapping: 'cs_ca_concepto'},
            {name: 'idproveedor', type: 'integer', mapping: 'c_ca_idproveedor'},
            {name: 'proveedor', type: 'string', mapping: 'i_ca_nombre'},
            {name: 'factura', type: 'string', mapping: 'c_ca_factura'},
            {name: 'idmoneda', type: 'string', mapping: 'c_ca_idmoneda'},            
            {name: 'neto', type: 'float', mapping: 'c_ca_neto'},
            {name: 'venta', type: 'float', mapping: 'c_ca_venta'},
            {name: 'tcambio', type: 'float', mapping: 'c_ca_tcambio' },
            {name: 'tcambio_usd', type: 'float', mapping: 'c_ca_tcambio_usd'},   
            {name: 'valor_pesos', type: 'float' },
            {name: 'utilidad', type: 'float' },            
            {name: 'color', type: 'string'}
    ]);


    this.store = new Ext.data.GroupingStore({

        autoLoad : true,
        url: '<?=url_for("inoF/datosGridCostosPanel")?>',
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
        sortInfo:{field: 'proveedor', direction: "ASC"}
        //groupField: 'proveedor'

    });

    this.tbar = [];
    if( !this.readOnly ){
        this.tbar.push({
        text: 'Agregar',
        iconCls: 'add',
        handler : this.newItem,
        scope: this
        });
    }

    this.tbar.push({
        text: 'Recargar',
        iconCls: 'refresh',
        handler : this.recargar,
        scope: this
        }
    );

    

    
    GridCostosPanel.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},
       //boxMinHeight: 300,
       //tbar: this.tbar,
       autoHeight: true,
       view: new Ext.grid.GroupingView({
            enableGroupingMenu: false,
            forceFit:true,
            enableRowBody:false,
            emptyText: 'No hay datos'
            //showPreview:true,
       }),
       listeners:{
            rowcontextmenu: this.onRowcontextMenu,
            validateedit: this.onValidateEdit,
            rowdblclick : this.onRowDblclick

       }

    });
    this.getView().getRowClass = this.getRowClass;

};

Ext.extend(GridCostosPanel, Ext.grid.GridPanel, {

    newItem: function(){
        document.location = "<?=url_for("inoF/formCosto")?>?modo="+this.modo+"&idmaster="+ this.idmaster;
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

    valorPesos: function(value, p, record) {
        //Ext.util.Format.numberRenderer('0,0.00')
        return Ext.util.Format.number( record.data.neto * record.data.tcambio/record.data.tcambio_usd, '0,0.00' );
    },
    utilidad: function(value, p, record) {
        //Ext.util.Format.numberRenderer('0,0.00')
        return Ext.util.Format.number( record.data.venta-(record.data.neto * record.data.tcambio/record.data.tcambio_usd), '0,0.00' );
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
                            text: 'Eliminar',
                            iconCls: 'delete',
                            scope:this,
                            handler: function(){
                              
                                if( this.ctxRecord.data.idinocosto  ){
                                    if( confirm("Esta seguro que desea eliminar este registro?") ){
                                        this.eliminar( this.ctxRecord.data.idinocosto, grid.id );
                                    }
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
    
    eliminar: function( idinocosto, gridId ){
        
        var modo = this.modo;
        Ext.Ajax.request(
            {               
                url: '<?=url_for("inoF/eliminarGridCostosPanel")?>',
                params :	{
                    idinocosto: idinocosto,
                    modo: modo                        
                },

                failure:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(res.errorInfo?": "+res.errorInfo:"")+" - "+(response.status?"\n Codigo HTTP "+response.status:""));
                },
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if( res.success ){
                        if( gridId ){
                            var grid = Ext.getCmp(gridId);
                            grid.store.reload();
                        }
                    }else{
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(res.errorInfo?": "+res.errorInfo:"")+" - "+(response.status?"\n Codigo HTTP "+response.status:""));
                    }
                }
             }
        );
    },

    onRowDblclick: function( grid , rowIndex, e ){
		if( !this.readOnly ){
            record =  this.store.getAt( rowIndex );
            document.location = "<?=url_for("inoF/formCosto")?>?modo="+this.modo+"&idinocosto="+record.data.idinocosto;
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
    },
   

    guardar: function(){
        var store = this.store;

        var records = store.getModifiedRecords();

        var lenght = records.length;

        /*
        for( var i=0; i< lenght; i++){
            r = records[i];
            if(!r.data.moneda && (r.data.tipo=="concepto"||r.data.recargo=="concepto") ){
                if( r.data.iditem!=9999){
                    Ext.MessageBox.alert('Warning','Por favor coloque la moneda en todos los items');
                    return 0;
                }
            }
        }	*/

        for( var i=0; i< lenght; i++){
            r = records[i];

            var changes = r.getChanges();

            changes['id']=r.id;            
            changes['idcomprobante']=r.data.idcomprobante;


            //if( r.data.iditem ){
                Ext.Ajax.request(
                    {
                        waitMsg: 'Guardando cambios...',
                        url: '<?=url_for("inoF/guardarGridCostosPanel")?>',
                        params :	changes,

                        callback :function(options, success, response){

                            var res = Ext.util.JSON.decode( response.responseText );
                            if( res.id && res.success){
                                var rec = store.getById( res.id );

                                rec.commit();
                            }
                        }
                     }
                );
           // }
        }

    },

    /*
    * Handler que se encarga de colocar el dato recargo_id en el Record
    * cuando se inserta un nuevo recargo
    */
    onValidateEdit: function(e){
        if( e.field == "proveedor"){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);

            var store = ed.field.store;
            store.each( function( r ){
                    if( r.data.id==e.value ){
                        e.value = r.data.nombre;
                        rec.set("idproveedor", r.data.id);
                        return true;
                    }
                }
            );
        }
    }




});

</script>