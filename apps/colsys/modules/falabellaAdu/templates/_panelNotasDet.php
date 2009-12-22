<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$data = $sf_data->getRaw( "data" );


?>
<script type="text/javascript">

PanelNotasDet = function(){

    this.columns = [
      {
        header: "Documento",
        dataIndex: 'numdocumento',
        sortable:false,
        width: 40
      },
      {
        header: "Concepto",
        dataIndex: 'concepto',
        sortable:false,
        width: 120,
        editor: new Ext.form.TextField({
				allowBlank: false 				
			})
      },
      {
        header: "NIT",
        dataIndex: 'emision_fch',
        sortable:false,
        width: 45,
        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
        editor: new Ext.form.DateField({
            format: 'Y-m-d'
        })
      }
      /*,
      {
        header: "Orden",
        dataIndex: 'orden',
        sortable:false,
        width: 75,
        align: 'right'
      }*/
    ];


    this.record = Ext.data.Record.create([
            {name: 'iddetalle', type: 'string', mapping: 'd_ca_iddetalle'},
            {name: 'numdocumento', type: 'string', mapping: 'd_ca_numdocumento'},
            {name: 'concepto', type: 'string', mapping: 'd_ca_concepto'},
            {name: 'nit_ter', type: 'string', mapping: 'd_nit_ter'},
            {name: 'orden', type: 'string'}

        ]);

    this.store = new Ext.data.Store({

        autoLoad : false,
        url: '<?=url_for("falabellaAdu/panelNotasDetData?referencia=".base64_encode( $referencia ) )?>',
        reader: new Ext.data.JsonReader(
            {
                root: 'root'
            },
            this.record
        )
    });


    PanelNotasDet.superclass.constructor.call(this, {
        id: 'panel-notas-det',
        loadMask: {msg:'Cargando...'},
        clicksToEdit: 1,
        stripeRows: true,
        title: 'Nota Detalle',
        region:'south',
        height: 250,
        minSize: 75,
        maxSize: 350,

        height: 350,
        //width: 600,
        selModel: new Ext.grid.CellSelectionModel(),


        view: new Ext.grid.GridView({
            forceFit:true
            //enableRowBody:true,
            //showPreview:true//,
            //getRowClass : this.applyRowClass
        })

        ,listeners:{
            validateEdit: this.onValidateEdit,
            rowContextMenu: this.onRowcontextMenu
            //afteredit:this.onAfterEdit,
        }

    });

};

Ext.extend(PanelNotasDet, Ext.grid.EditorGridPanel, {
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
            changes['iddetalle']=r.data.iddetalle;
            changes['numdocumento']=r.data.numdocumento;
            changes['concepto']=r.data.concepto;

            if( r.data.concepto ){
                //envia los datos al servidor
                Ext.Ajax.request(
                    {
                        waitMsg: 'Guardando cambios...',
                        url: '<?=url_for("falabellaAdu/observePanelNotasDet?referencia=".base64_encode($referencia))?>',
						//method: 'POST',
                        //Solamente se envian los cambios
                        params :	changes,

                        callback :function(options, success, response){

                            var res = Ext.util.JSON.decode( response.responseText );
                            if( res.id && res.success){
                                var rec = store.getById( res.id );
                                rec.set("iddetalle", res.iddetalle );

                                rec.commit();
                            }
                        }
                     }
                );
            }
        }
    },


    eliminarItem: function(){
        var storeTransacciones = this.store;

        if( this.ctxRecord &&  confirm("Desea continuar?") ){

            var id = this.ctxRecord.id;
            if( this.ctxRecord.data.iddetalle ){
                Ext.Ajax.request(
                {
                    waitMsg: 'Eliminando...',
                    url: '<?=url_for("falabellaAdu/eliminarPanelNotasDet?referencia=".base64_encode($referencia))?>',
                    //method: 'POST',
                    //Solamente se envian los cambios
                    params :	{
                        id: id,
                        iddetalle: this.ctxRecord.data.iddetalle
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
           }else{
                record = storeTransacciones.getById( id );
                storeTransacciones.remove(record);
           }
        }

    },
    onValidateEdit : function(e){
        
        if( e.field == "concepto" && e.value && e.record.data.orden=="Z" ){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;

            var recordConcepto = this.record;
            var storeGrid = this.store;

            var newRec = new recordConcepto({
                               referencia: '<?=$referencia?>',
                               numdocumento: rec.data.numdocumento,
                               concepto: '',
                               nit_ter: '',                               
                               orden: 'Z' // Se utiliza Z por que el orden es alfabetico
            });
            rec.set("orden", "Y");            
            //Inserta una columna en blanco al final
            storeGrid.addSorted(newRec);
            storeGrid.sort("orden", "ASC");



        }

        return true;
    },

    onRowcontextMenu: function(grid, index, e){
        rec = this.store.getAt(index);

        if(!this.menu){ // create context menu on first right click

            this.menu = new Ext.menu.Menu({
            id:'grid_notas-det-ctx',
            enableScrolling : false,
            items: [
                    {
                        text: 'Eliminar item',
                        iconCls: 'delete',
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

});

</script>