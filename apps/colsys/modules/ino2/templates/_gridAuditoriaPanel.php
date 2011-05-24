<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("ino", "editAuditoriaWindow");
?>

<script type="text/javascript">


GridAuditoriaPanel = function( config ){

    Ext.apply(this, config);

    
    this.columns = [
      {
        header: "Fecha",
        dataIndex: 'ca_fchcreado',
        //hideable: false,
        width: 100,
        sortable: true,
        renderer: Ext.util.Format.dateRenderer('Y-m-d')
      },
      {
        header: "Usuario",
        dataIndex: 'ca_usucreado',
        //hideable: false,
        width: 100,
        sortable: true,
        renderer: this.formatItem

      },
      {
        header: "Hallazgo",
        dataIndex: 'ca_detalle',
        //hideable: false,
        sortable: true,
        width: 80
      },
      {
        header: "Compromisos",
        dataIndex: 'ca_compromisos',
        hideable: false,
        sortable: true,
        width: 280

      },
      {
        header: "Rta. Operativo",
        dataIndex: 'ca_respuesta',
        //hideable: false,
        sortable: true,
        width: 80        

      },
      {
        header: "Tipo",
        dataIndex: 'ca_tipo',
        hideable: false,
        sortable: true,
        width: 80
      },

      {
        header: "Estado",
        dataIndex: 'ca_estado',
        hideable: false,
        sortable: true,
        width: 80        
      }


     ];


    this.record = Ext.data.Record.create([
            
            {name: 'ca_idmaster', type: 'integer'},
            {name: 'ca_idevento', type: 'integer'},
            {name: 'ca_tipo', type: 'string'},
            {name: 'ca_asunto', type: 'string'},
            {name: 'ca_detalle', type: 'string'},
            {name: 'ca_compromisos', type: 'string'},
            {name: 'ca_respuesta', type: 'string'},
            {name: 'ca_fchcompromiso', type: 'date', dateFormat:'Y-m-d'},
            {name: 'ca_idantecedente', type: 'integer'},
            {name: 'ca_usucreado', type: 'string'},
            {name: 'ca_fchcreado', type: 'date', dateFormat:'Y-m-d H:i:s'}
    ]);


    this.store = new Ext.data.GroupingStore({

        autoLoad : true,
        url: '<?=url_for("ino/datosGridAuditoriaPanel")?>',
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
        sortInfo:{field: 'ca_fchcreado', direction: "DESC"}
    });

    this.tbar = [{
        text: 'Recargar',
        iconCls: 'refresh',
        handler : this.recargar,
        scope: this
    }];

    
    GridAuditoriaPanel.superclass.constructor.call(this, {
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

Ext.extend(GridAuditoriaPanel, Ext.grid.GridPanel, {

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
                            text: 'Editar',
                            iconCls: 'page_white_edit',
                            scope:this,
                            handler: function(){
                              
                                if( this.ctxRecord.data.idhouse  ){
                                    if( this.ctxRecord.data.idevento ){
                                        this.editAuditoria( this.ctxRecord.data.idevento );
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

    onRowDblclick: function( grid , rowIndex, e ){
		if( !this.readOnly ){
            record =  this.store.getAt( rowIndex );
            this.editAuditoria( record.data.idevento );
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

    

    editAuditoria: function( idevento ){
        var win = new EditAuditoriaWindow( idevento );
        win.show();
    }




});

</script>