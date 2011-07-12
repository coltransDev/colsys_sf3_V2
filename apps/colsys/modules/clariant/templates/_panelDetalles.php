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

    this.editorUnidad = new Ext.form.ComboBox({
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,
        mode: 'local',
        lazyRender:true,
        store : [[""," "],["PC","Uni"]]
    });

    this.colData = [
      {
        header: "Posición",
        dataIndex: 'posicion',
        sortable:true,
        width: 55,
        locked: true
      },
      {
        header: "Material",
        dataIndex: 'material',
        sortable:false,
        width: 155,
        locked: true,
        editor: new Ext.form.TextField({
            allowBlank: false
        })
      },
      {
        header: "Descripcion",
        dataIndex: 'descripcion',
        sortable:true,
        width: 230,
        editor: new Ext.form.TextField({
            allowBlank: false
        })
      },
      {
        header: "Kilos Pedidos",
        dataIndex: 'cantidad',
        sortable:false,
        width: 100,
        align: 'right'
      },
      {
        header: "Kilos Despachados",
        dataIndex: 'despacho',
        sortable:false,
        width: 100,
        align: 'right',
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:right',
				decimalPrecision :2
			})
      },
      this.checkColumn
    ];

    
    this.record = Ext.data.Record.create([
            {name: 'sel', type: 'boolean'},
            {name: 'iddetail', type: 'int', mapping: 'd_ca_iddetail'},
            {name: 'idclariant', type: 'int', mapping: 'd_ca_idclariant'},
            {name: 'posicion', type: 'string', mapping: 'd_ca_posicion'},
            {name: 'material', type: 'string', mapping: 'd_ca_material'},
            {name: 'descripcion', type: 'string', mapping: 'd_ca_descripcion'},
            {name: 'cantidad', type: 'float', mapping: 'd_ca_cantidad'},
            {name: 'despacho', type: 'float', mapping: 'd_ca_despacho'},
            {name: 'unidad', type: 'string', mapping: 'd_ca_unidad'},
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
        title: 'Detalles',

        //height: 350,
        //width: 500,
        selModel: new Ext.grid.CellSelectionModel(),
        colModel: new Ext.ux.grid.LockingColumnModel( this.colData ),

        view: new Ext.ux.grid.LockingGridView({
            //forceFit:true
            //enableRowBody:true,
            //showPreview:true//,
            //getRowClass : this.applyRowClass
        })
       
        ,listeners:{
            // afteredit:this.onAfterEdit,
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
            changes['iddetail']=r.data.iddetail;
            changes['idclariant']=r.data.idclariant;
            
            //envia los datos al servidor
            Ext.Ajax.request(
                {
                    waitMsg: 'Guardando cambios...',
                    url: '<?=url_for("clariant/observeDetail")?>',
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
                url: '<?=url_for("clariant/eliminarDetail")?>',
                //method: 'POST',
                //Solamente se envian los cambios
                params :	{
                    id: id,
                    iddetail: this.ctxRecord.data.iddetail,
                    idclariant: this.ctxRecord.data.idclariant
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

    seleccionarTodo: function() {
        var grid = Ext.getCmp("panel-detalle");
        var store = grid.getStore();

        store.each( function( r ){
           r.set("sel", true);
        });
    }

});

</script>