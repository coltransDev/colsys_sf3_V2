<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$fala_headers = $sf_data->getRaw( "fala_headers" );
?>
<script type="text/javascript">

PanelReferencias = function(){
    /*
    * Crea la columna de chequeo
    */
    this.checkColumn = new Ext.grid.CheckColumn({header:' ', dataIndex:'sel', width:30});

    this.editorReferencia = new Ext.form.ComboBox({
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,
        lazyRender:true,
        displayField: 'referencia',
        valueField: 'referencia',
        minChars: 10,
        store: new Ext.data.Store({
            autoLoad : true,
            url: '<?=url_for("widgets/datosComboReferenciaAduana")?>',
            reader: new Ext.data.JsonReader(
                {
                    root: 'root',
                    totalProperty: 'total'
                },
                Ext.data.Record.create([
                    {name: 'referencia', mapping:'ca_referencia', type: 'string'},
                ])
            )
        })
    });


    this.colData = [
      this.checkColumn,
      {
        header: "Carpeta",
        dataIndex: 'iddoc',
        sortable:true,
        width: 70,
        locked: true
      },
      {
        header: "Referencia",
        dataIndex: 'referencia',
        sortable:true,
        width: 80,
        editor: this.editorReferencia
      },
      {
        header: "Fch.Llegada",
        dataIndex: 'reqd_delivery',
        sortable:true,
        width: 96,
        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
        editor: new Ext.form.DateField({
            format: 'Y-m-d',
            allowBlank: false
        })
      },
      {
        header: "Embarque",
        dataIndex: 'embarque',
        sortable:true,
        width: 20
      },
      {
        header: "Procesado",
        dataIndex: 'procesado',
        sortable:true,
        width: 20
      },
      {
        header: "Resultado FTP",
        dataIndex: 'orden_comments',
        sortable:true,
        width: 100
      }
    ];


    this.record = Ext.data.Record.create([
            {name: 'sel', type: 'boolean'},
            {name: 'iddoc', type: 'string', mapping: 'd_ca_iddoc'},
            {name: 'referencia', type: 'string', mapping: 'd_ca_referencia'},
            {name: 'embarque', type: 'string', mapping: 'i_ca_embarque'},
            {name: 'procesado', type: 'string', mapping: 'd_ca_procesado'},
            {name: 'reqd_delivery', type: 'date', mapping: 'd_ca_reqd_delivery' , dateFormat:'Y-m-d'},
            {name: 'orden_comments', type: 'string', mapping: 'd_ca_orden_comments'},

        ]);

    this.store = new Ext.data.Store({

        autoLoad : true,
        proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$fala_headers))?>),
        reader: new Ext.data.JsonReader(
            {
                root: 'root'
            },
            this.record
        )
    });


    PanelReferencias.superclass.constructor.call(this, {
        id: 'panel-referencia',
        loadMask: {msg:'Cargando...'},
        clicksToEdit: 1,
        plugins: [this.checkColumn],
        stripeRows: true,
        //height: 350,
        width: 500,
        selModel: new Ext.grid.CellSelectionModel(),
        colModel: new Ext.ux.grid.LockingColumnModel( this.colData ),

        view: new Ext.grid.GridView({
            forceFit:true
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

Ext.extend(PanelReferencias, Ext.grid.EditorGridPanel, {
    height: 400,
    guardarCambios: function(){
        var store = this.store;
        var records = store.getModifiedRecords();

        var lenght = records.length;

        for( var i=0; i< lenght; i++){
            r = records[i];

            var changes = r.getChanges();

            //Incluye en el arreglo de reg modificados la llave
            changes['id']=r.id;
            changes['iddoc']=r.data.iddoc;

            //envia los datos al servidor
            Ext.Ajax.request(
                {
                    waitMsg: 'Guardando cambios...',
                    url: '<?=url_for("falabellaAdu/observeReference")?>',
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
    archivarItem : function(){
        if( this.ctxRecord &&  confirm("Desea continuar?") ){

            var store = this.store;
            var records = store.getModifiedRecords();

            var lenght = records.length;

            for( var i=0; i< lenght; i++){
                r = records[i];

                // Archiva sólo los registros seleccionados
                if (r.data.sel){
                    var changes = r.getChanges();

                    //Incluye en el arreglo de reg modificados la llave
                    changes['id']=r.id;
                    changes['iddoc']=r.data.iddoc;

                    //envia los datos al servidor
                    Ext.Ajax.request(
                        {
                            waitMsg: 'Guardando cambios...',
                            url: '<?=url_for("falabellaAdu/archivarOrden")?>',
                            //method: 'POST',
                            //Solamente se envian los cambios
                            params :	changes,

                            callback :function(options, success, response){

                                var res = Ext.util.JSON.decode( response.responseText );
                                if( res.id && res.success){
                                    record = store.getById( res.id );
                                    store.remove(record);
                                }
                            }
                         }
                    );
                }
            }
        }

    },
    quitarAsignacion : function(){
        var store = this.store;

        if( this.ctxRecord &&  confirm("Está seguro?") ){
            var id = this.ctxRecord.id;

            Ext.Ajax.request(
            {
                waitMsg: 'Archivando...',
                url: '<?=url_for("falabellaAdu/observeReference")?>',
                //method: 'POST',
                //Solamente se envian los cambios
                params :	{
                    id: id,
                    iddoc: this.ctxRecord.data.iddoc,
                    limpiar: true
                },

                callback :function(options, success, response){

                    var res = Ext.util.JSON.decode( response.responseText );
                    if( res.id && res.success){
                        var rec = store.getById( res.id );

                        rec.set("referencia", "");
                        rec.set("reqd_delivery", "");
                        rec.set("sel", false); //Quita la seleccion de todas las columnas
                        rec.commit();
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
                        text: 'Archivar Items',
                        iconCls: '',
                        scope:this,
                        handler: this.archivarItem
                    },{
                        text: 'Quitar Asignacion',
                        iconCls: '',
                        scope:this,
                        handler: this.quitarAsignacion
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
    }

});

</script>