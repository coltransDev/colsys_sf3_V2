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

    this.editorUniCantidad = new Ext.form.ComboBox({
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,
        mode: 'local',
        lazyRender:true,
        store : [[""," "],["PC","Uni"]]
    });

    this.editorUniPaquetes = new Ext.form.ComboBox({
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,
        mode: 'local',
        lazyRender:true,
        store : [[""," "],["CT","Ctns"]]
    });

    this.editorUniPeso = new Ext.form.ComboBox({
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,
        mode: 'local',
        lazyRender:true,
        store : [[""," "],["KG","Kgs"]]
    });

    this.editorUniVolumen = new Ext.form.ComboBox({
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,
        mode: 'local',
        lazyRender:true,
        store : [[""," "],["CR","M³"]]
    });

    this.editorTipoContenedor = new Ext.form.ComboBox({
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,
        mode: 'local',
        lazyRender:true,
        store : 
            [
            <?
                $i=0;
                foreach($container as $tipo){
                    if($i++!=0){
                        echo ",";
                    }
                    echo "[\"".$tipo->getCaValor2()."\",\"".$tipo->getCaValor()."\"]";
                }
            ?>
            ]
    });


    this.columns = [       
      this.checkColumn,
      {
        header: "SKU",
        dataIndex: 'sku',
        sortable:false,
        width: 30,
        renderer: this.formatItem,
        editor: new Ext.form.TextField({
				allowBlank: false 				
			})        
      },
      {
        header: "Descripción",
        dataIndex: 'descripcion_item',
        sortable:false,
        width: 100,
        editor: new Ext.form.TextField({
            allowBlank: false
        })
      },
      {
        header: "#U. Pedidas",
        dataIndex: 'cantidad_pedido',
        sortable:false,
        width: 40
      },
      {
        header: "# Unidades",
        dataIndex: 'cantidad_miles',
        sortable:false,
        width: 40,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :2
			})
      },
      {
        header: "U",
        dataIndex: 'unidad_medidad_cantidad',
        sortable:false,
        width: 30,
        editor: this.editorUniCantidad
      },
      {
        header: "# Paquetes",
        dataIndex: 'cantidad_paquetes_miles',
        sortable:false,
        width: 40,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :2
			})
      },
      {
        header: "U",
        dataIndex: 'unidad_medida_paquetes',
        sortable:false,
        width: 30,
        editor: this.editorUniPaquetes
      },
      {
        header: "Peso",
        dataIndex: 'cantidad_peso_miles',
        sortable:false,
        width: 40,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :2
			})
      },
      {
        header: "U",
        dataIndex: 'unidad_medida_peso',
        sortable:false,
        width: 30,
        editor: this.editorUniPeso
      },
      {
        header: "Volumen",
        dataIndex: 'cantidad_volumen_miles',
        sortable:false,
        width: 40,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :2
			})
      },
      {
        header: "U",
        dataIndex: 'unidad_medida_volumen',
        sortable:false,
        width: 30,
        editor: this.editorUniVolumen
      },
      {
        header: "Id",
        dataIndex: 'num_cont_part1',
        sortable:false,
        width: 20,
        editor: new Ext.form.TextField({
				allowBlank: false
			})
      },
      {
        header: "Contenedor",
        dataIndex: 'num_cont_part2',
        sortable:false,
        width: 40,
        editor: new Ext.form.TextField({
				allowBlank: false
			})
      },
      {
        header: "#Sello",
        dataIndex: 'num_cont_sell',
        sortable:false,
        width: 50,
        editor: new Ext.form.TextField({
				allowBlank: false
			})
      },
      {
        header: "Tipo Contenedor",
        dataIndex: 'container_iso',
        sortable:false,
        width: 80,
        editor: this.editorTipoContenedor
      }


    ];

    
    this.record = Ext.data.Record.create([
            {name: 'sel', type: 'boolean'},
            {name: 'iddoc', type: 'string', mapping: 'd_ca_iddoc'},
            {name: 'sku', type: 'string', mapping: 'd_ca_sku'},
            {name: 'descripcion_item', type: 'string', mapping: 'd_ca_descripcion_item'},
            {name: 'cantidad_pedido', type: 'string', mapping: 'd_ca_cantidad_pedido'},
            {name: 'cantidad_miles', type: 'string', mapping: 'd_ca_cantidad_miles'},
            {name: 'unidad_medidad_cantidad', type: 'string', mapping: 'd_ca_unidad_medidad_cantidad'},
            {name: 'cantidad_paquetes_miles', type: 'string', mapping: 'd_ca_cantidad_paquetes_miles'},
            {name: 'unidad_medida_paquetes', type: 'string', mapping: 'd_ca_unidad_medida_paquetes'},
            {name: 'cantidad_volumen_miles', type: 'string', mapping: 'd_ca_cantidad_volumen_miles'},
            {name: 'unidad_medida_volumen', type: 'string', mapping: 'd_ca_unidad_medida_volumen'},
            {name: 'cantidad_peso_miles', type: 'string', mapping: 'd_ca_cantidad_peso_miles'},
            {name: 'unidad_medida_peso', type: 'string', mapping: 'd_ca_unidad_medida_peso'},
            {name: 'num_cont_part1', type: 'string', mapping: 'd_ca_num_cont_part1'},
            {name: 'num_cont_part2', type: 'string', mapping: 'd_ca_num_cont_part2'},
            {name: 'num_cont_sell', type: 'string', mapping: 'd_ca_num_cont_sell'},
            {name: 'container_iso', type: 'string', mapping: 'd_ca_container_iso'}
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