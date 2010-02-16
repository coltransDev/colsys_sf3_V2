<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$data = $sf_data->getRaw( "data" );
$conceptos = $sf_data->getRaw( "conceptos" );

?>
<script type="text/javascript">

PanelNotasDet = function(){

    this.editorConceptos = new Ext.form.ComboBox({
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
                foreach($conceptos as $concepto){
                    if($i++!=0){
                        echo ",";
                    }
                    echo "[\"".intval($concepto->getCaValor2())."\",\"".$concepto->getCaValor()."\"]";
                }
            ?>
            ]
    });

    this.editorTipos = new Ext.form.ComboBox({
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        selectOnFocus: true,
        mode: 'local',
        lazyRender:true,
        store : [["F","Factura Nal."],["C","Comprobante"]]
    });

    this.columns = [
      {
        header: "Documento",
        dataIndex: 'numdocumento',
        sortable:false,
        width: 40
      },
      {
        header: "Concepto de la Nota",
        dataIndex: 'idconcepto',
        sortable:false,
        width: 100,
        editor: this.editorConceptos
      },
      {
        header: "Tipo Doc.",
        dataIndex: 'tipo',
        sortable:false,
        width: 100,
        editor: this.editorTipos
      },
      {
        header: "Nit.Tercero",
        dataIndex: 'nit_ter',
        sortable:false,
        width: 80,
        editor: new Ext.form.TextField({
            allowBlank: false
        })
      },
      {
        header: "No.Factura Terc.",
        dataIndex: 'factura_ter',
        sortable:false,
        width: 100,
        editor: new Ext.form.TextField({
            allowBlank: false
        })
      },
      {
        header: "Fch.Factura Terc.",
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
        header: "Vlr.Factura Sin IVA",
        dataIndex: 'factura_vlr',
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
        header: "Vlr. del IVA",
        dataIndex: 'factura_iva',
        sortable:false,
        width: 90,
        align: 'right',
        renderer: 'usMoney' /*,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:right',
				decimalPrecision :2
			})*/
      }
    ];


    this.record = Ext.data.Record.create([
            {name: 'referencia', type: 'string', mapping: 'd_ca_referencia'},
            {name: 'numdocumento', type: 'string', mapping: 'd_ca_numdocumento'},
            {name: 'idconcepto', type: 'int', mapping: 'd_ca_idconcepto'},
            {name: 'nit_ter', type: 'string', mapping: 'd_ca_nit_ter'},
            {name: 'tipo', type: 'string', mapping: 'd_ca_tipo'},
            {name: 'factura_ter', type: 'string', mapping: 'd_ca_factura_ter'},
            {name: 'factura_fch', type: 'date', dateFormat: 'Y-m-d', mapping: 'd_ca_factura_fch'},
            {name: 'factura_vlr', type: 'float', mapping: 'd_ca_factura_vlr'},
            {name: 'factura_iva', type: 'float', mapping: 'd_ca_factura_iva'},
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
        clicksToEdit: 2,
        stripeRows: true,
        title: 'Nota Detalle',
        region:'south',

        height: 150,
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
            rowContextMenu: this.onRowcontextMenu,
            afteredit:this.onAfterEdit
        }

    });

};

Ext.extend(PanelNotasDet, Ext.grid.EditorGridPanel, {
    height: 100,
    guardarCambios: function(){
        var store = this.store;
        var records = store.getModifiedRecords();

        var lenght = records.length;

        for( var i=0; i< lenght; i++){
            r = records[i];

            var changes = r.getChanges();

            //Da formato a las fechas antes de enviarlas


            changes['id']=r.id;
            changes['idconcepto']=r.data.idconcepto;
            changes['numdocumento']=r.data.numdocumento;

            if( r.data.idconcepto ){
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
                                rec.set( "idconcepto", res.idconcepto );

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
            if( this.ctxRecord.data.idconcepto ){
                Ext.Ajax.request(
                {
                    waitMsg: 'Eliminando...',
                    url: '<?=url_for("falabellaAdu/eliminarPanelNotasDet?referencia=".base64_encode($referencia))?>',
                    //method: 'POST',
                    //Solamente se envian los cambios
                    params :	{
                        id: id,
                        numdocumento: this.ctxRecord.data.numdocumento,
                        idconcepto: this.ctxRecord.data.idconcepto
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
    
    onAfterEdit : function(e){
    
        if( e.field == "factura_vlr" ){
           var rec = e.record;
           if (rec.get("tipo")=="F"){
               rec.set("factura_iva",Math.round(rec.get("factura_vlr")*0.16));
           }
        }

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