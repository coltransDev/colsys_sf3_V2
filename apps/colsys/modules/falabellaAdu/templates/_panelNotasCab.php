<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$data = $sf_data->getRaw( "data" );


?>
<script type="text/javascript">

PanelNotasCab = function(){
    this.selectedRow = null;
    this.columns = [
     
      {
        header: "Numero",
        dataIndex: 'numdocumento',
        sortable:false,
        width: 90,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,				
				decimalPrecision :3
	})
      },
      {
        header: "Fch. Emisión",
        dataIndex: 'emision_fch',
        sortable:false,
        width: 45,
        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
        editor: new Ext.form.DateField({
            format: 'Y-m-d'
        })
      },
      {
        header: "Vlr. Documento",
        dataIndex: 'vlrdocumento',
        sortable:false,
        width: 90,
        align: 'right',
        renderer: 'usMoney',
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				decimalPrecision :3
			})
      },
      {
        header: "Cambio",
        dataIndex: 'tipo_cambio',
        sortable:false,
        width: 90,
        align: 'right',
        renderer: 'usMoney',
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,				
				decimalPrecision :3
			})
      }
    ];

    
    this.record = Ext.data.Record.create([
            {name: 'referencia', type: 'string', mapping: 'd_ca_referencia'},
            {name: 'numdocumento', type: 'string', mapping: 'd_ca_numdocumento'},
            {name: 'emision_fch', type: 'date', mapping: 'd_ca_emision_fch' , dateFormat:'Y-m-d'},
            {name: 'tipo_cambio', type: 'float', mapping: 'd_ca_tipo_cambio'},
            {name: 'vlrdocumento', type: 'float', mapping: 'd_ca_vlrdocumento'},
            {name: 'orden', type: 'string'}
            
        ]);

    this.store = new Ext.data.Store({       

        autoLoad : true,
        proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$data))?>),
        reader: new Ext.data.JsonReader(
            {
                root: 'root'
            },
            this.record
        )
    });

    
    PanelNotasCab.superclass.constructor.call(this, {
        id: 'panel-notas-cab',
        loadMask: {msg:'Cargando...'},
        clicksToEdit: 1,
        stripeRows: true,
        title: 'Nota Cabecera',
        region:'center',

        height: 150,
        //width: 600,
        selModel: new Ext.grid.CellSelectionModel({
            listeners: { cellselect:this.onCellSelect  }
        }),
        

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

Ext.extend(PanelNotasCab, Ext.grid.EditorGridPanel, {
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

            changes['numdocumento']=r.data.numdocumento;
            
            if( r.data.numdocumento ){
                //envia los datos al servidor
                Ext.Ajax.request(
                    {
                        waitMsg: 'Guardando cambios...',
                        url: '<?=url_for("falabellaAdu/observePanelNotasCab?referencia=".base64_encode($referencia))?>',
			//method: 'POST',
                        //Solamente se envian los cambios
                        params :	changes,

                        callback :function(options, success, response){

                            var res = Ext.util.JSON.decode( response.responseText );
                            if( res.id && res.success){
                                var rec = store.getById( res.id );
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
            
            Ext.Ajax.request(
            {
                waitMsg: 'Eliminando...',
                url: '<?=url_for("falabellaAdu/eliminarNotaCab?referencia=".base64_encode($referencia))?>',
                //method: 'POST',
                //Solamente se envian los cambios
                params :	{
                    id: id,
                    numdocumento: this.ctxRecord.data.numdocumento
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
        
    },
    onValidateEdit : function(e){        
        if( e.field == "numdocumento" && e.value && e.record.data.orden=="Z" ){
            var rec = e.record;
            var ed = this.colModel.getCellEditor(e.column, e.row);
            var store = ed.field.store;

            var recordConcepto = this.record;
            var storeGrid = this.store;

            var newRec = new recordConcepto({

                               referencia: '<?=$referencia?>',
                               numdocumento: '+',
                               emision_fch: '',                                                              
                               tipo_cambio: '',
                               vlrdocumento: '',                              
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
            id:'grid_notas-cab-ctx',
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
    },
    onCellSelect: function( cellSelection , row, col ){
        var grid = Ext.getCmp("panel-notas-cab");
        rec = grid.store.getAt( row );

        if( this.selectedRow!=rec.id ){
        
            var grid = Ext.getCmp("panel-notas-det");
            grid.store.baseParams = {numdocumento:rec.data.numdocumento };
            grid.store.reload();
            this.selectedRow=rec.id;
        }
    }

});

</script>