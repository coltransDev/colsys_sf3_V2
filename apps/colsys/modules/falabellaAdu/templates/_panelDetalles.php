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

    this.editorUnidadComercial = new Ext.form.ComboBox({
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
                foreach($unidades as $unidad){
                    if($i++!=0){
                        echo ",";
                    }
                    echo "[\"".$unidad->getCaValor2()."\",\"".$unidad->getCaValor()."\"]";
                }
            ?>
            ]
    });


    this.colData = [
      
      {
        header: "SKU",
        dataIndex: 'sku',
        sortable:false,
        width: 55,
        locked: true
      },
      {
        header: "Nombre Comercial",
        dataIndex: 'descripcion_item',
        sortable:false,
        width: 230,
        locked: true,
        editor: new Ext.form.TextField({
            allowBlank: false
        })
      },
      {
        header: "Subpartida",
        dataIndex: 'subpartida',
        sortable:false,
        width: 90,
        editor: new Ext.form.TextField({
            allowBlank: false
        })
      },
      {
        header: "Descripción Mcia.",
        dataIndex: 'descripcion_mcia',
        sortable:false,
        width: 230,
        editor: new Ext.form.TextField({
            allowBlank: false
        })
      },
      {
        header: "Pre-Inspección",
        dataIndex: 'preinspeccion',
        sortable:false,
        width: 230,
        editor: new Ext.form.TextField({
            allowBlank: false
        })
      },
      {
        header: "#U. Pedidas",
        dataIndex: 'cantidad_pedido',
        sortable:false,
        width: 65
      },
      {
        header: "Cantidad DAV",
        dataIndex: 'cantidad_dav',
        sortable:false,
        width: 78,
        align: 'right',
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:right',
				decimalPrecision :0
			})
      },
      {
        header: "Cantidad DIM",
        dataIndex: 'cantidad_dim',
        sortable:false,
        width: 75,
        align: 'right',
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:right',
				decimalPrecision :0
			})
      },
      {
        header: "Valor Total",
        dataIndex: 'valor_fob',
        sortable:false,
        width: 90,
        align: 'right',
        renderer: 'usMoney',
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:right',
				decimalPrecision :2
			})
      },
      {
        header: "# Radicado",
        dataIndex: 'radicado_num',
        sortable:false,
        width: 70,
        editor: new Ext.form.TextField({
            allowBlank: false
        })
      },
      {
        header: "# Registro",
        dataIndex: 'registro_num',
        sortable:false,
        width: 70,
        editor: new Ext.form.TextField({
            allowBlank: false
        })
      },
      {
        header: "Uni.Comercial",
        dataIndex: 'unidad_comercial',
        sortable:false,
        width: 100,
        editor: this.editorUnidadComercial
      },
      {
        header: "Marca",
        dataIndex: 'marca',
        sortable:false,
        width: 100,
        editor: new Ext.form.TextField({
            allowBlank: false
        })
      },
      {
        header: "Tipo",
        dataIndex: 'tipo',
        sortable:false,
        width: 100,
        editor: new Ext.form.TextField({
            allowBlank: false
        })
      },
      {
        header: "Clase",
        dataIndex: 'clase',
        sortable:false,
        width: 100,
        editor: new Ext.form.TextField({
            allowBlank: false
        })
      },
      {
        header: "Modelo",
        dataIndex: 'Modelo',
        sortable:false,
        width: 100,
        editor: new Ext.form.TextField({
            allowBlank: false
        })
      },
      {
        header: "Año",
        dataIndex: 'ano',
        sortable:false,
        width: 50,
        editor: new Ext.form.TextField({
            allowBlank: false
        })
      },
      {
        header: "No.Factura",
        dataIndex: 'factura_nro',
        sortable:false,
        width: 100,
        editor: new Ext.form.TextField({
            allowBlank: false
        })
      },
      {
        header: "Fch.Factura",
        dataIndex: 'factura_fch',
        sortable:false,
        width: 96,
        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
        editor: new Ext.form.DateField({
            format: 'Y-m-d',
            allowBlank: false
        })
      },
      {
        header: "# Paquetes",
        dataIndex: 'cantidad_paquetes_miles',
        sortable:false,
        width: 70,
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
        width: 35,
        editor: this.editorUniPaquetes
      },
      {
        header: "Peso",
        dataIndex: 'cantidad_peso_miles',
        sortable:false,
        width: 70,
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
        width: 35,
        editor: this.editorUniPeso
      },
      {
        header: "Volumen",
        dataIndex: 'cantidad_volumen_miles',
        sortable:false,
        width: 70,
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
        width: 35,
        editor: this.editorUniVolumen
      },
      this.checkColumn
    ];

    
    this.record = Ext.data.Record.create([
            {name: 'sel', type: 'boolean'},
            {name: 'iddoc', type: 'string', mapping: 'd_ca_iddoc'},
            {name: 'sku', type: 'string', mapping: 'd_ca_sku'},
            {name: 'descripcion_item', type: 'string', mapping: 'd_ca_descripcion_item'},
            {name: 'subpartida', type: 'string', mapping: 'd_ca_subpartida'},
            {name: 'descripcion_mcia', type: 'string', mapping: 'd_ca_descripcion_mcia'},
            {name: 'preinspeccion', type: 'string', mapping: 'd_ca_preinspeccion'},

            {name: 'cantidad_pedido', type: 'string', mapping: 'd_ca_cantidad_pedido'},
            {name: 'cantidad_dav', type: 'string', mapping: 'd_ca_cantidad_dav'},
            {name: 'cantidad_dim', type: 'string', mapping: 'd_ca_cantidad_dim'},
            {name: 'valor_fob', type: 'string', mapping: 'd_ca_valor_fob'},

            {name: 'radicado_num', type: 'string', mapping: 'd_ca_radicado_num'},
            {name: 'registro_num', type: 'string', mapping: 'd_ca_registro_num'},
            {name: 'unidad_comercial', type: 'string', mapping: 'd_ca_unidad_comercial'},

            {name: 'marca', type: 'string', mapping: 'd_ca_marca'},
            {name: 'tipo', type: 'string', mapping: 'd_ca_tipo'},
            {name: 'clase', type: 'string', mapping: 'd_ca_clase'},
            {name: 'modelo', type: 'string', mapping: 'd_ca_modelo'},
            {name: 'ano', type: 'string', mapping: 'd_ca_ano'},
            {name: 'factura_nro', type: 'string', mapping: 'd_ca_factura_nro'},
            {name: 'factura_fch', type: 'date', mapping: 'd_ca_factura_fch' , dateFormat:'Y-m-d'},

            {name: 'cantidad_paquetes_miles', type: 'int', mapping: 'd_ca_cantidad_paquetes_miles'},
            {name: 'unidad_medida_paquetes', type: 'string', mapping: 'd_ca_unidad_medida_paquetes'},

            {name: 'cantidad_volumen_miles', type: 'float', mapping: 'd_ca_cantidad_volumen_miles'},
            {name: 'unidad_medida_volumen', type: 'string', mapping: 'd_ca_unidad_medida_volumen'},

            {name: 'cantidad_peso_miles', type: 'float', mapping: 'd_ca_cantidad_peso_miles'},
            {name: 'unidad_medida_peso', type: 'string', mapping: 'd_ca_unidad_medida_peso'},

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
        id: 'panel-detalle',
        loadMask: {msg:'Cargando...'},
        clicksToEdit: 1,
        plugins: [this.checkColumn],
        stripeRows: true,
        //height: 350,
        width: 500,
        selModel: new Ext.grid.CellSelectionModel(),
        colModel: new Ext.ux.grid.LockingColumnModel( this.colData ),

        view: new Ext.ux.grid.LockingGridView({
            //forceFit:true
            //enableRowBody:true,
            //showPreview:true//,
            //getRowClass : this.applyRowClass
        })
        
       
        ,listeners:{
            afteredit:this.onAfterEdit,
            rowContextMenu: this.onRowcontextMenu
	}

    });


};

Ext.extend(PanelDetalles, Ext.grid.EditorGridPanel, {
    height: 290,
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
                    url: '<?=url_for("falabellaAdu/observeDetail")?>',
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
    eliminarItem : function(){
        var storeTransacciones = this.store;

        if( this.ctxRecord &&  confirm("Desea continuar?") ){

            var id = this.ctxRecord.id;

            Ext.Ajax.request(
            {
                waitMsg: 'Eliminando...',
                url: '<?=url_for("falabellaAdu/eliminarDetail")?>',
                //method: 'POST',
                //Solamente se envian los cambios
                params :	{
                    id: id,
                    iddoc: this.ctxRecord.data.iddoc,
                    sku: this.ctxRecord.data.sku,
                    subpartida: this.ctxRecord.data.subpartida
                },

                //Ejecuta esta accion en caso de fallo
                //(404 error etc, ***NOT*** success=false)
                failure:function(response,options){
                    alert( response.responseText );
                    success = false;
                },

                //Ejecuta esta accion cuando el resultado es exitoso
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if( res.success ){
                        record = storeTransacciones.getById( res.id );
                        storeTransacciones.remove(record);
                    }
                }
            });
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
                        text: 'Seleccionar todo',
                        iconCls: '',
                        scope:this,
                        handler: this.seleccionarTodo
                    },{
                        text: 'Eliminar item',
                        iconCls: '',
                        scope:this,
                        handler: this.eliminarItem
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
            if( field!="descripcion_item" ){
                for( var i=0; i< lenght; i++){
                    r = records[i];
                    if(r.data.sel){
                        r.set(field,e.value);
                    }
                }
            }
        }
    },

    seleccionarTodo: function() {
        var grid = Ext.getCmp("panel-detalle");
        var store = grid.getStore();

        store.each( function( r ){
           r.set("sel", true);
        });
    }

});

</script>