<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$details = $sf_data->getRaw( "details" );

?>
<script type="text/javascript">


PanelDetalles = function(){

        

    /*
    * Crea la columna de chequeo
    */
    this.checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30});

    this.editorUnidades = new Ext.form.ComboBox({        
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,        
        mode: 'local',       
        lazyRender:true,        
        store : [[""," "],["Uni","Uni"]]
    });

    this.columns = [       
      this.checkColumn,
      {
        header: "SKU",
        dataIndex: 'sku',
        sortable:false,
        width: 60,
        renderer: this.formatItem,
        editor: new Ext.form.TextField({
				allowBlank: false 				
			})        
      },
      {
        header: "Descripción",
        dataIndex: 'descripcion_item',
        sortable:false,
        width: 50,
        editor: new Ext.form.TextField({
            allowBlank: false
        })
      },
      {
        header: "#U. Pedidas",
        dataIndex: 'cantidad_pedido',
        sortable:false,
        width: 360
      },
      {
        header: "# Unidades",
        dataIndex: 'cantidad_miles',
        sortable:false,
        width: 100,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :3
			})
      },
      {
        header: "# Unidades",
        dataIndex: 'unidad_medidad_cantidad',
        sortable:false,
        width: 30,
        editor: this.editorUnidades
      }
    ];

    
    this.record = Ext.data.Record.create([
            {name: 'sel', type: 'boolean'},
            {name: 'iddoc', type: 'string', mapping: 'd_ca_iddoc'},
            {name: 'sku', type: 'string', mapping: 'd_ca_sku'},
            {name: 'descripcion_item', type: 'string', mapping: 'd_ca_descripcion_item'},
            {name: 'cantidad_pedido', type: 'string', mapping: 'd_ca_cantidad_pedido'},
            {name: 'cantidad_miles', type: 'string', mapping: 'd_ca_cantidad_miles'},
            {name: 'unidad_medidad_cantidad', type: 'string', mapping: 'd_unidad_medidad_cantidad'}

        ]);

    this.store = new Ext.data.Store({       

        autoLoad : true,
        proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$details))?>),
        reader: new Ext.data.JsonReader(
            {
                root: 'root'
            },
            this.record
        )
    });

    
  

    PanelDetalles.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},
       clicksToEdit: 1,
       plugins: [this.checkColumn],
       view: new Ext.grid.GridView({
       
            forceFit:true
            //enableRowBody:true,
            //showPreview:true//,
            //getRowClass : this.applyRowClass
        }),
        listeners:{            
            rowcontextmenu: this.onRowcontextMenu,
            afterEdit: this.onAfterEdit
            
        },
        tbar: [{
            text:'Guardar',
            iconCls: 'disk',
            scope:this,
            handler: this.guardarCambios
        }
      ]


    });


};

Ext.extend(PanelDetalles, Ext.grid.EditorGridPanel, {
    height: 500
    ,
    guardarCambios: function(){
        var store = this.store;
        var records = store.getModifiedRecords();

        var lenght = records.length;

        

        for( var i=0; i< lenght; i++){
            r = records[i];

            var changes = r.getChanges();

            //Da formato a las fechas antes de enviarlas


            changes['id']=r.id;
            changes['sku']=r.data.sku;
            changes['iddoc']=r.data.iddoc;
            
            
            //envia los datos al servidor
            Ext.Ajax.request(
                {
                    waitMsg: 'Guardando cambios...',
                    url: '<?=url_for("falabella/observeDetail")?>',
                    //method: 'POST',
                    //Solamente se envian los cambios
                    params :	changes,

                    callback :function(options, success, response){

                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.id && res.success){
                            var rec = store.getById( res.id );

                            rec.set("sel", false); //Quita la seleccion de todas las columnas
                            rec.commit();
                        }
                    }
                 }
            );

        }
    }
    ,
    onRowcontextMenu: function(grid, index, e){
        rec = this.store.getAt(index);

        if(!this.menu){ // create context menu on first right click

            this.menu = new Ext.menu.Menu({
            id:'grid_productos-ctx',
            enableScrolling : false,
            items: [                   
                    {
                        text: 'Duplicar item',
                        iconCls: '',
                        scope:this,
                        handler: this.duplicarItem
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
        this.ctxRow = this.view.getRow(index);
        Ext.fly(this.ctxRow).addClass('x-node-ctx');
        this.menu.showAt(e.getXY());
    }
    ,
    onContextHide: function(){
        if(this.ctxRow){
            Ext.fly(this.ctxRow).removeClass('x-node-ctx');
            this.ctxRow = null;
        }
    }
    ,
    duplicarItem : function(){
        
    }

    ,
    formatItem: function(value, p, record) {

        return String.format(
            '<b>{0}</b>',
            value
        );

    },

    onAfterEdit : function(e) {
        if(e.record.data.sel){
            var records = this.store.getModifiedRecords();
            var lenght = records.length;
            var field = e.field;

            for( var i=0; i< lenght; i++){
                r = records[i];
                if(r.data.sel){
                    if( (r.data.tipo=="concepto"||r.data.tipo=="recargo") ){
                        continue;
                    }                    
                    r.set(field,e.value);
                }
            }
        }
    }

});

</script>