<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$ordenes = $sf_data->getRaw( "ordenes" );

?>
<script type="text/javascript">

MainPanel = function(){
    /*
    * Crea la columna de chequeo
    */
    this.checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30});

    this.editorModalidad = new Ext.form.ComboBox({
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,
        mode: 'local',
        lazyRender:true,
        store : [[""," "],["LCL","LCL"],["FCL","FCL"]]
    });

    this.editorTipoEmbalaje = new Ext.form.ComboBox({
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
                foreach($tipos as $tipo){
                    if($i++!=0){
                        echo ",";
                    }
                    echo "[\"".$tipo->getCaValor2()."\",\"".$tipo->getCaValor()."\"]";
                }
            ?>
            ]
    });

    this.editorNavieras = new Ext.form.ComboBox({
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
                foreach($navieras as $naviera){
                    if($i++!=0){
                        echo ",";
                    }
                    echo "[\"".$naviera->getCaValor2()."\",\"".$naviera->getCaValor()."\"]";
                }
            ?>
            ]
    });

    this.editorBanderas = new Ext.form.ComboBox({
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
                foreach($banderas as $bandera){
                    if($i++!=0){
                        echo ",";
                    }
                    echo "[\"".$bandera->getCaValor2()."\",\"".$bandera->getCaValor()."\"]";
                }
            ?>
            ]
    });

    this.colData = [

      {
        header: "Reporte",
        dataIndex: 'consecutivo',
        sortable:true,
        width: 80,
        locked: true
      },
      {
        header: "Orden Número",
        dataIndex: 'orden_nro',
        sortable:true,
        width: 100,
        locked: true,
        editor: new Ext.form.TextField({
            allowBlank: false
        })
      },
      {
        header: "Modalidad",
        dataIndex: 'modalidad',
        sortable:false,
        width: 85,
        editor: this.editorModalidad
      },
      {
        header: "Factura Prov.",
        dataIndex: 'factura_nro',
        sortable:true,
        width: 90,
        editor: new Ext.form.TextField({
            allowBlank: false
        })
      },
      {
        header: "Fch. Factura",
        dataIndex: 'factura_fch',
        sortable:false,
        width: 90,
        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
        editor: new Ext.form.DateField({
            format: 'Y-m-d'
        })
      },
      {
        header: "Fch. Zarpe",
        dataIndex: 'zarpe_fch',
        sortable:false,
        width: 90,
        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
        editor: new Ext.form.DateField({
            format: 'Y-m-d'
        })
      },
      {
        header: "Doc.Transporte",
        dataIndex: 'doctransporte',
        sortable:false,
        width: 150,
        editor: new Ext.form.TextField({
            allowBlank: false
        })
      },
      {
        header: "Fch.Doc.Transp.",
        dataIndex: 'doctransporte_fch',
        sortable:false,
        width: 90,
        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
        editor: new Ext.form.DateField({
            format: 'Y-m-d'
        })
      },
      {
        header: "Fch.Rec.Carga",
        dataIndex: 'recibocarga_fch',
        sortable:false,
        width: 90,
        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
        editor: new Ext.form.DateField({
            format: 'Y-m-d'
        })
      },
      {
        header: "Peso Bruto",
        dataIndex: 'peso_bruto',
        sortable:false,
        width: 78,
        align: 'right',
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:right',
				decimalPrecision :2
			})
      },
      {
        header: "Peso Neto",
        dataIndex: 'peso_neto',
        sortable:false,
        width: 78,
        align: 'right',
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:right',
				decimalPrecision :2
			})
      },
      {
        header: "Piezas",
        dataIndex: 'piezas',
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
        header: "Tipo Embalaje",
        dataIndex: 'tipo_embalaje',
        sortable:false,
        width: 100,
        editor: this.editorTipoEmbalaje
      },
      {
        header: "Línea Naviera",
        dataIndex: 'transportadora',
        sortable:true,
        width: 100,
        editor: this.editorNavieras
      },
      {
        header: "Bandera",
        dataIndex: 'bandera',
        sortable:true,
        width: 100,
        editor: this.editorBanderas
      },
      {
        header: "Usu.Reportado",
        dataIndex: 'usureportado',
        width: 100
      },
      {
        header: "Fch.Reportado",
        dataIndex: 'fchreportado',
        width: 100
      },

      this.checkColumn
    ];


    this.record = Ext.data.Record.create([
            {name: 'sel', type: 'boolean'},
            {name: 'idbavaria', type: 'string', mapping: 'bv_ca_idbavaria'},
            {name: 'consecutivo', type: 'string', mapping: 'bv_ca_consecutivo'},
            {name: 'orden_nro', type: 'string', mapping: 'bv_ca_orden_nro'},
            {name: 'modalidad', type: 'string', mapping: 'bv_ca_modalidad'},
            {name: 'factura_nro', type: 'string', mapping: 'bv_ca_factura_nro'},
            {name: 'factura_fch', type: 'date', mapping: 'bv_ca_factura_fch', dateFormat:'Y-m-d'},
            {name: 'recibocarga_fch', type: 'date', mapping: 'bv_ca_recibocarga_fch', dateFormat:'Y-m-d'},
            {name: 'zarpe_fch', type: 'date', mapping: 'bv_ca_zarpe_fch', dateFormat:'Y-m-d'},
            {name: 'doctransporte', type: 'string', mapping: 'bv_ca_doctransporte'},
            {name: 'doctransporte_fch', type: 'date', mapping: 'bv_ca_doctransporte_fch', dateFormat:'Y-m-d'},
            {name: 'peso_bruto', type: 'float', mapping: 'bv_ca_peso_bruto'},
            {name: 'peso_neto', type: 'float', mapping: 'bv_ca_peso_neto'},
            {name: 'tipo_embalaje', type: 'string', mapping: 'bv_ca_tipo_embalaje'},
            {name: 'piezas', type: 'int', mapping: 'bv_ca_piezas'},
            {name: 'transportadora', type: 'string', mapping: 'bv_ca_transportadora'},
            {name: 'bandera', type: 'string', mapping: 'bv_ca_bandera'},
            {name: 'fchreportado', type: 'string', mapping: 'bv_ca_fchreportado'},
            {name: 'usureportado', type: 'string', mapping: 'bv_ca_usureportado'}
        ]);

    this.store = new Ext.data.Store({

        autoLoad : true,
        proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$ordenes))?>),
        reader: new Ext.data.JsonReader(
            {
                root: 'root'
            },
            this.record
        ),
        sortInfo:{field: 'orden_nro', direction: "ASC"}
    });


    MainPanel.superclass.constructor.call(this, {
        id:'main-tabs',
        loadMask: {msg:'Cargando...'},
        clicksToEdit: 1,
        plugins: [this.checkColumn],
        stripeRows: true,
        //height: 350,
        //width: 800,
        selModel: new Ext.grid.CellSelectionModel(),
        colModel: new Ext.ux.grid.LockingColumnModel( this.colData ),

        view: new Ext.ux.grid.LockingGridView({
            //forceFit:true
            //enableRowBody:true,
            //showPreview:true//,
            //getRowClass : this.applyRowClass
        }),

        tbar: [{
            text:'Guardar',
            iconCls: 'disk',
            scope:this,
            handler: this.guardarCambios
        }],

        listeners:{
            afteredit:this.onAfterEdit,
            rowContextMenu: this.onRowcontextMenu
	}

    });


};

Ext.extend(MainPanel, Ext.grid.EditorGridPanel, {
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
            changes['idbavaria']=r.data.idbavaria;

            //envia los datos al servidor
            Ext.Ajax.request(
                {
                    waitMsg: 'Guardando cambios...',
                    url: '<?=url_for("bavaria/observeOrdenes")?>',
                    method: 'POST',
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
    archivarOrden : function(){
        var storeTransacciones = this.store;

        if( this.ctxRecord &&  confirm("Desea continuar?") ){

            var id = this.ctxRecord.id;

            Ext.Ajax.request(
            {
                waitMsg: 'Eliminando...',
                url: '<?=url_for("bavaria/archivarOrden")?>',
                //method: 'POST',
                //Solamente se envian los cambios
                params :	{
                    id: id,
                    idbavaria: this.ctxRecord.data.idbavaria
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
    duplicarOrden : function(){
        idx = 0;
        if( this.ctxRecord &&  confirm("Desea continuar?") ){
            var rec = new this.record(
                {sel: false,
                 idbavaria: null,
                 consecutivo: '',
                 orden_nro: '',
                 modalidad: '',
                 factura_nro: '',
                 factura_fch: '',
                 zarpe_fch: '',
                 doctransporte: '',
                 doctransporte_fch: '',
                 peso_bruto: '',
                 peso_neto: '',
                 tipo_embalaje: '',
                 piezas: '',
                 transportadora: '',
                 bandera: '',
                 fchreportado: '',
                 usureportado: ''

                }
            );

            this.store.addSorted( rec );
            rec = this.store.getById(rec.id);
            rec.set("consecutivo", this.ctxRecord.data.consecutivo );
            rec.set("orden_nro", this.ctxRecord.data.orden_nro+'-1' );
            rec.set("modalidad", this.ctxRecord.data.modalidad );
            rec.set("factura_nro", this.ctxRecord.data.factura_nro );
            rec.set("factura_fch", this.ctxRecord.data.factura_fch );
            rec.set("zarpe_fch", this.ctxRecord.data.zarpe_fch );
            rec.set("doctransporte", this.ctxRecord.data.doctransporte );
            rec.set("doctransporte_fch", this.ctxRecord.data.doctransporte_fch );
            rec.set("peso_bruto", this.ctxRecord.data.peso_bruto );
            rec.set("peso_neto", this.ctxRecord.data.peso_neto );
            rec.set("tipo_embalaje", this.ctxRecord.data.tipo_embalaje );
            rec.set("piezas", this.ctxRecord.data.piezas );
            rec.set("transportadora", this.ctxRecord.data.transportadora );
            rec.set("bandera", this.ctxRecord.data.bandera );
            this.store.sort("orden_nro", "ASC");
        }

    }
    ,
    eliminarOrden : function(){
        var storeTransacciones = this.store;

        if( this.ctxRecord &&  confirm("Desea continuar?") ){

            var id = this.ctxRecord.id;

            Ext.Ajax.request(
            {
                waitMsg: 'Eliminando...',
                url: '<?=url_for("bavaria/eliminarOrden")?>',
                //method: 'POST',
                //Solamente se envian los cambios
                params :	{
                    id: id,
                    idbavaria: this.ctxRecord.data.idbavaria
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
            id:'grid_ordenes-ctx',
            enableScrolling : false,
            items: [
                    {
                        text: 'Seleccionar todo',
                        iconCls: '',
                        scope:this,
                        handler: this.seleccionarTodo
                    },{
                        text: 'Duplicar Orden',
                        iconCls: '',
                        scope:this,
                        handler: this.duplicarOrden
                    },{
                        text: 'Archivar Orden',
                        iconCls: '',
                        scope:this,
                        handler: this.archivarOrden
                    },{
                        text: 'Eliminar Orden',
                        iconCls: '',
                        scope:this,
                        handler: this.eliminarOrden
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
        var grid = Ext.getCmp("main-tabs");
        var store = grid.getStore();

        store.each( function( r ){
           r.set("sel", true);
        });
    }

});

</script>