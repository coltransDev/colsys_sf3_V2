<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


include_component("ino", "editCostosWindow");
?>

<script type="text/javascript">


GridCostosPanel = function( config ){

    Ext.apply(this, config);

    
    this.columns = [
      {
        header: "Comprobante",
        dataIndex: 'comprobante',
        //hideable: false,
        sortable: true,
        width: 80,
        renderer: this.formatComprobante,
        editor: new Ext.form.TextField()

      },
      {
        header: "Costo",
        dataIndex: 'concepto',
        //hideable: false,
        width: 100,
        sortable: true,
        renderer: this.formatItem

      },
      {
        header: "Proveedor",
        dataIndex: 'proveedor',
        //hideable: false,
        sortable: true,
        width: 80,
        editor: new WidgetIds()
      },   
      {
        header: "Fecha",
        dataIndex: 'fchcomprobante',
        hideable: false,
        sortable: true,
        width: 80,
        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
        editor: new Ext.form.DateField({
            format: 'Y-m-d'
        })

      },
      {
        header: "Valor",
        dataIndex: 'valor',
        hideable: false,
        sortable: true,
        width: 80,
        align: 'right',
        renderer: Ext.util.Format.numberRenderer('0,0.00'),
        editor: new Ext.form.NumberField({
            allowBlank: false ,
            allowNegative: false,
            style: 'text-align:right',
            decimalPrecision :2
        })
      },
      {
        header: "Cambio",
        dataIndex: 'cambio',
        hideable: false,
        sortable: true,
        width: 80,
        align: 'right',
        renderer: Ext.util.Format.numberRenderer('0,0.00'),
        editor: new Ext.form.NumberField({
            allowBlank: false ,
            allowNegative: false,
            style: 'text-align:right',
            decimalPrecision :2
        })
      },
      {
        header: "Moneda",
        dataIndex: 'idmoneda',
        hideable: false,
        sortable: true,
        width: 80,
        align: 'left',
        editor: new WidgetMoneda({
            allowBlank: false 
        })
      },
      {
        header: "Valor Pesos",
        dataIndex: 'valor_pesos',
        hideable: false,
        sortable: true,
        width: 80,
        align: 'right',
        renderer: this.valorPesos
      }


     ];


    this.record = Ext.data.Record.create([
            
            {name: 'idmaster', type: 'integer'},
            {name: 'idconcepto', type: 'integer'},
            {name: 'concepto', type: 'string'},
            {name: 'idproveedor', type: 'integer'},
            {name: 'proveedor', type: 'string'},
            {name: 'comprobante', type: 'string'},
            {name: 'idcomprobante', type: 'string'},
            {name: 'idmoneda', type: 'string'},

            {name: 'fchcomprobante', type: 'date', dateFormat:'Y-m-d'},
            {name: 'group', type: 'string'},
            {name: 'valor', type: 'float'},
            {name: 'cambio', type: 'float'},
            {name: 'idmoneda', type: 'string'},
            {name: 'color', type: 'string'}
    ]);


    this.store = new Ext.data.GroupingStore({

        autoLoad : true,
        url: '<?=url_for("ino/datosGridCostosPanel")?>',
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
        sortInfo:{field: 'proveedor', direction: "ASC"},
        groupField: 'proveedor'

    });

    this.tbar = [];
    if( !this.readOnly ){
        /*this.tbar.push({
        text: 'Agregar',
        iconCls: 'add',
        handler : this.newItem,
        scope: this
        });*/
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
            enableRowBody:false
            //showPreview:true,
       }),
       listeners:{
            //rowcontextmenu: this.onRowcontextMenu,
            validateedit: this.onValidateEdit,
            rowdblclick : this.onRowDblclick

       }

    });
    this.getView().getRowClass = this.getRowClass;

};

Ext.extend(GridCostosPanel, Ext.grid.GridPanel, {

    newItem: function(){
        this.win = new EditCostoWindow();
        this.win.show();
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
        return Ext.util.Format.number( record.data.valor * record.data.cambio, '0,0.00' );
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
                            text: 'Editar Factura',
                            iconCls: 'page_white_edit',
                            scope:this,
                            handler: function(){
                              
                                if( this.ctxRecord.data.idhouse  ){
                                    if( this.ctxRecord.data.idcomprobante ){
                                        this.editarFactura( this.ctxRecord.data.idhouse, this.ctxRecord.data.idcomprobante );
                                    }else{
                                        alert("Este item no se ha facturado");
                                    }
                                }
                            }
                        },
                        {
                            text: 'Agregar Factura',
                            iconCls: 'add',
                            scope:this,
                            handler: function(){

                                if( this.ctxRecord.data.idhouse  ){
                                    this.crearFactura( this.ctxRecord.data.idhouse );
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
		/*if( !this.readOnly ){
            record =  this.store.getAt( rowIndex );
            this.editHouse( record.data.idhouse );
        }*/
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

    crearFactura: function( idhouse ){
        document.location = "<?=url_for("inocomprobantes/formComprobante?tipo=F")?>?idhouse="+idhouse;

    },

    editarFactura: function( idhouse, idfactura ){
        document.location = "<?=url_for("inocomprobantes/formComprobante?tipo=F")?>?idhouse="+idhouse+"&idcomprobante="+idfactura;

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
                        url: '<?=url_for("ino/guardarGridCostosPanel")?>',
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