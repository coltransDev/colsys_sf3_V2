<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


include_component("ino", "gridFacturacionWindow", array("referencia"=>$referencia ));

?>

<script type="text/javascript">


GridFacturacionPanel = function( config ){

    Ext.apply(this, config);

    
    this.columns = [
      
      {
        header: "House",
        dataIndex: 'doctransporte',
        //hideable: false,
        hidden: true,
        width: 100,
        sortable: true,
        renderer: this.formatItem

      },
      {
        header: "Idcliente",
        dataIndex: 'idcliente',
        //hideable: false,
        hidden: true, 
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
        renderer: this.formatComprobante,
        editor: new Ext.form.TextField()

      },
      {
        header: "Fecha",
        dataIndex: 'fchcomprobante',
        hideable: false,
        sortable: true,
        width: 80,
        renderer: Ext.util.Format.dateRenderer('Y-m-d')
        /*editor: new Ext.form.DateField({
            format: 'Y-m-d'
        })*/

      },
      {
        header: "Valor",
        dataIndex: 'valor',
        hideable: false,
        sortable: true,
        width: 80,
        align: 'right',
        renderer: Ext.util.Format.numberRenderer('0,0.00')
        /*editor: new Ext.form.NumberField({
            allowBlank: false ,
            allowNegative: false,
            style: 'text-align:right',
            decimalPrecision :2
        })*/
      },
      {
        header: "Cambio",
        dataIndex: 'cambio',
        hideable: false,
        sortable: true,
        width: 80,
        align: 'right',
        renderer: Ext.util.Format.numberRenderer('0,0.00')
      },
      {
        header: "Moneda",
        dataIndex: 'idmoneda',
        hideable: false,
        sortable: true,
        width: 80,
        align: 'left'
        /*editor: new WidgetMoneda({
            allowBlank: false 
        })*/
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
            {name: 'idhouse', type: 'integer'},
            {name: 'doctransporte', type: 'string'},
            {name: 'cliente', type: 'string'},
            {name: 'idcliente', type: 'integer'},
            {name: 'comprobante', type: 'string'},
            {name: 'idcomprobante', type: 'string'},

            {name: 'fchcomprobante', type: 'date', dateFormat:'Y-m-d'},
            {name: 'group', type: 'string'},
            {name: 'valor', type: 'float'},
            {name: 'cambio', type: 'float'},
            {name: 'idmoneda', type: 'string'},
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
        sortInfo:{field: 'doctransporte', direction: "ASC"},
        groupField: 'doctransporte'

    });

    this.tbar = [{
        text: 'Recargar',
        iconCls: 'refresh',
        handler : this.recargar,
        scope: this
        }
    ];

    if( !this.readOnly ){
        this.tbar.push({
        text: 'Agregar',
        iconCls: 'add',
        handler : function(){
            this.crearFactura(null, this.id)
        },
        scope: this
        });
    }

    
    GridFacturacionPanel.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},
       //boxMinHeight: 300,
       tbar: this.tbar,
       autoHeight: true,
       view: new Ext.grid.GroupingView({
            enableGroupingMenu: false,
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
                                        this.editarFactura( this.ctxRecord.data.idhouse, this.ctxRecord.data.idcomprobante, grid.id );
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
                                    this.crearFactura( this.ctxRecord.data.idhouse , grid.id);
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
            if( record.data.idcomprobante ){
                this.editarFactura( record.data.idhouse, record.data.idcomprobante, grid.id );
            }else{
                this.crearFactura( record.data.idhouse, grid.id);
            }
            this.win.show();
        }
	}
    ,
    getRowClass : function(record, rowIndex, p, ds){
        p.cols = p.cols-1;
        
        if( !record.data.comprobante ){
            //alert( record.data.comprobante );
            var color = "row_pink";
        }else{
            var color = "";
        }        
        return color;
    },

    crearFactura: function( idhouse , gridId){
        this.win = new GridFacturacionWindow( {gridId:gridId} );
        this.win.show();
    },

    editarFactura: function( idhouse, idcomprobante, gridId ){
        this.win = new GridFacturacionWindow( {gridId:gridId, idcomprobante:idcomprobante} );
        this.win.show();

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
                        url: '<?=url_for("ino/guardarGridFacturacionPanel")?>',
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

    }

    





});

</script>
