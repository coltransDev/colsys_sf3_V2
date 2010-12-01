<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$clariant = $sf_data->getRaw( "clariant" );


include_component("widgets", "widgetReporte");
?>
<script type="text/javascript">

MainPanel = function(){

    this.editorReporte = new WidgetReporte();

    this.columns = [
      {
        header: "Reporte",
        dataIndex: 'reporte',
        sortable:false,
        width: 150,
        editor: this.editorReporte
      },
      {
        header: "Pais",
        dataIndex: 'pais',
        sortable:true,
        width: 40
      },
      {
        header: "Proveedor",
        dataIndex: 'proveedor',
        sortable:false,
        width: 150
      },
      {
        header: "Orden",
        dataIndex: 'orden',
        sortable:true,
        width: 90
      },
      {
        header: "Fch. Documento",
        dataIndex: 'documento_fch',
        sortable:false,
        width: 90
      },
      {
        header: "Incoterm",
        dataIndex: 'incoterm',
        sortable:false,
        width: 120
      }
    ];

    this.record = Ext.data.Record.create([
            {name: 'idclariant', type: 'string', mapping: 'd_ca_idclariant'},
            {name: 'reporte', type: 'string', mapping: 'd_ca_consecutivo'},
            {name: 'pais', type: 'string', mapping: 'd_ca_pais'},
            {name: 'proveedor', type: 'string', mapping: 'd_ca_proveedor'},
            {name: 'orden', type: 'string', mapping: 'd_ca_orden'},
            {name: 'documento_fch', type: 'string', mapping: 'd_ca_documento_fch'},
            {name: 'incoterm', type: 'string', mapping: 'd_ca_incoterm'},
    ]);

    this.store = new Ext.data.Store({

        autoLoad : true,
        proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$clariant))?>),
        reader: new Ext.data.JsonReader(
            {
                root: 'root'
            },
            this.record
        )
    });


    MainPanel.superclass.constructor.call(this, {
       id:'main-tabs',
       loadMask: {msg:'Cargando...'},
       clicksToEdit: 1,
       // stripeRows: true,
       // labelAlign: 'top',
       // bodyStyle:'padding:1px',

       view: new Ext.grid.GridView({
            // forceFit:true,
            // enableRowBody:true,
            // showPreview:true,
            getRowClass:this.applyRowClass
        }),

        tbar: [{
            text:'Guardar',
            iconCls: 'disk',
            scope:this,
            handler: this.guardarCambios
        }],
        listeners:{
            validateedit: this.onValidateEdit
        }

    });



};

Ext.extend(MainPanel, Ext.grid.EditorGridPanel, {
    height: 90,
    guardarCambios: function(){
        var store = this.store;
        var records = store.getModifiedRecords();

        var lenght = records.length;

        for( var i=0; i< lenght; i++){
            r = records[i];

            var changes = r.getChanges();

            //Carga un arreglo con los cambios
            changes['id']=r.id;
            changes['idclariant']=r.data.idclariant;

            //envia los datos al servidor
            Ext.Ajax.request(
                {
                    waitMsg: 'Guardando cambios...',
                    url: '<?=url_for("clariant/observeClariant")?>',
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

        var grid = Ext.getCmp("panel-detalle");
        grid.guardarCambios();

        var grid = Ext.getCmp("panel-facturacion");
        grid.guardarCambios();

        var grid = Ext.getCmp("panel-notas-cab");
        grid.guardarCambios();

        var grid = Ext.getCmp("panel-notas-det");
        grid.guardarCambios();

    },

    /*
    * Handler que se encarga de colocar el dato consecutivo en el Record
    * cuando se llama el reporte de negocio.
    */
    onValidateEdit: function(e){
        if( e.field == "reporte"){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);

            var store = ed.field.store;
            store.each( function( r ){
                    if( r.data.idreporte==e.value ){
                        e.value = r.data.consecutivo;
                        rec.set("idreporte", r.data.idreporte);
                        return true;
                    }
                }
            );
        }
    }

});

</script>