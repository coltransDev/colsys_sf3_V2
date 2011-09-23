<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("widgets", "widgetDeduccion");

?>
<script type="text/javascript">
GridDeduccionesPanel = function( config ){
    Ext.apply(this, config);  
    
    this.columns = [      
      {
        header: "Concepto",
        dataIndex: 'deduccion',
        width: 200,
        sortable: false,
        renderer: this.formatItem,
        editor: new WidgetDeduccion({
            transporte: this.transporte,
            modalidad: this.modalidad            
        })
      },
      {
        header: "Neta",
        dataIndex: 'neto',
        sortable: false,
        width: 100,
        editor: new Ext.form.NumberField({
            decimalPrecition: 2,
            allowNegative: false
        })
      },
      {
        header: "Valor",
        dataIndex: 'valor',
        hideable: false,
        sortable: false,        
        width: 100
      }
     ];

    this.record = Ext.data.Record.create([            
            {name: 'idcomprobante', type: 'integer'},
            {name: 'iddeduccion', type: 'integer'}, 
            {name: 'deduccion', type: 'string'},
            {name: 'neto', type: 'float'},
            {name: 'valor', type: 'float'},
            {name: 'orden', type: 'string'}
    ]);

    this.store = new Ext.data.GroupingStore({
        autoLoad : true,
        url: '<?=url_for("ino/datosGridDeduccionesPanel")?>',
        baseParams : {
            idcomprobante: this.idcomprobante,
            modo: this.modo
        },
        reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'total'
            },
            this.record
        ),
        sortInfo:{field: 'orden', direction: "ASC"}
    });

    this.tbar = [{
        text: 'Recargar',
        iconCls: 'refresh',
        handler : this.recargar,
        scope: this
    }];
    

    GridDeduccionesPanel.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},       
       tbar: this.tbar,
       autoHeight: true,
       boxMinHeight: 200,
       view: new Ext.grid.GridView({
            forceFit:true,
            enableRowBody:false,
            emptyText: 'No hay datos'            
       }),
       listeners:{
            rowcontextmenu: this.onRowcontextMenu,
            validateedit: this.onValidateEdit            
       }
    });
};

Ext.extend(GridDeduccionesPanel, Ext.grid.EditorGridPanel, {
    

    deleteHouse: function(idhouse){
       var modo = this.modo;
       if( !this.readOnly ){
           if( confirm("Esta seguro que desea eliminar este item?") ){
               var store = this.store;
               Ext.Ajax.request({
                    waitMsg: 'Eliminando...',
                    url: '<?=url_for("ino/eliminarGridDeduccionesPanel")?>',
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
    
    onValidateEdit : function(e){   
        if( e.field == "neto" ){
            var cmp = Ext.getCmp("tasacambio_id");        
            if( cmp && cmp.getValue() ){        
                value = record.get("neto")*cmp.getValue();
                e.record.set("valor", value);
            }  
        }
        if( e.field == "deduccion"){
            
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;

            var recordConcepto = this.record;
            var storeGrid = this.store;

            store.each( function( r ){                   
                if( r.data.idconcepto==e.value ){      
                    
                    var existe = false;
                    recordsConceptos = storeGrid.getRange();
                    for( var j=0; j< recordsConceptos.length&&!existe; j++){
                        if( recordsConceptos[j].data.iddeduccion==r.data.idconcepto){
                            existe=true;                                    
                        }                                                    
                    }
                    
                    if( !existe ){
                        if( !rec.data.iddeduccion  ){
                            var newRec = new recordConcepto({
                                
                                iddeduccion: '',                                
                                deduccion: '+', 
                                neto: 0,
                                valor: 0,
                                orden: 'Z' 
                            });
                                                       
                           
                            storeGrid.addSorted(newRec);
                            rec.set("orden","B");
                            storeGrid.sort("orden", "ASC");
                            
                        }                        
                        e.value = r.data.concepto;
                        rec.set("iddeduccion",r.data.idconcepto);
                        
                        
                    }else{
                        alert("Esta agregando un concepto que ya existe");
                        if( !rec.data.iddeduccion  ){
                            e.value = "+";
                        }else{
                            e.value = rec.data.deduccion;
                        }
                        return false;
                    }
                    return true;
                }
            }
        )
        }
    }
    
});
</script>