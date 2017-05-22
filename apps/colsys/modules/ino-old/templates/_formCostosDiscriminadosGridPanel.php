<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */



?>
<script type="text/javascript">
FormCostosDiscriminadosGridPanel = function( config ){
    Ext.apply(this, config);  
    
    this.columns = [      
      {
        header: "Cliente",
        dataIndex: 'cliente',
        width: 200,
        sortable: false,
        renderer: this.formatItem
        
      },
      {
        header: "Doc. Transporte",
        dataIndex: 'doctransporte',
        sortable: false,
        width: 100
      },
      {
        header: "Neto",
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
      },
      {
        header: "Venta",
        dataIndex: 'venta',
        hideable: false,
        sortable: false,        
        width: 100
      },
      {
        header: "INO",
        dataIndex: 'sobreventa',
        hideable: false,
        sortable: false,        
        width: 100
      }
     ];

    this.record = Ext.data.Record.create([            
            {name: 'idhouse', type: 'integer'},
            {name: 'doctransporte', type: 'string'}, 
            {name: 'cliente', type: 'string'},
            {name: 'neto', type: 'float'},
            {name: 'valor', type: 'float'},
            {name: 'orden', type: 'string'}
    ]);

    this.store = new Ext.data.GroupingStore({
        autoLoad : true,
        url: '<?=url_for("ino/datosFormCostosDiscriminadosGridPanel")?>',
        baseParams : {
            idcomprobante: this.idcomprobante,
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
        sortInfo:{field: 'orden', direction: "ASC"}
    });

    this.tbar = [{
        text: 'Recargar',
        iconCls: 'refresh',
        handler : this.recargar,
        scope: this
    }];
    

    FormCostosDiscriminadosGridPanel.superclass.constructor.call(this, {
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

Ext.extend(FormCostosDiscriminadosGridPanel, Ext.grid.EditorGridPanel, {
    
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
            var store = this.store;
            rec = store.getAt(index);
            var idmaster = rec.data.idmaster;
            var idhouse = rec.data.idhouse;
            if(!this.menu){
                this.menu = new Ext.menu.Menu({
                enableScrolling : false,
                items: [
                        
                        {
                            text: 'Eliminar',
                            iconCls: 'delete',
                            scope:this,
                            handler: function(){
                                if( this.ctxRecord.data.iddeduccion  ){
                                    store.remove( rec );                                    
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
            var cmp2 = Ext.getCmp("tasacambiousd_id");       
            if( cmp && cmp.getValue() && cmp2 && cmp2.getValue() ){      
                
                var val =  Math.round( e.value*cmp.getValue()/cmp2.getValue() *100)/100;
                e.record.set("valor", val );
            }else{
                e.record.set("valor", 0);
            }  
        }
    }
    
});
</script>
