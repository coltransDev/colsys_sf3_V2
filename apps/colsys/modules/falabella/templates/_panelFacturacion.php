<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$data = $sf_data->getRaw( "factura" );
?>
<script type="text/javascript">

PanelFacturacion = function(){

    this.columns = [
     
      {
        header: "Factura",
        dataIndex: 'numdocumento',
        sortable:false,
        width: 90,
        editor: new Ext.form.TextField({
            allowBlank: false
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
        header: "Fch Vencimiento",
        dataIndex: 'vencimiento_fch',
        sortable:false,
        width: 70,
        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
        editor: new Ext.form.DateField({
            format: 'Y-m-d'
        })
      },
      {
        header: "Moneda",
        dataIndex: 'moneda',
        sortable:false,
        width: 40,
        editor: <?=include_component("widgets", "monedas")?>
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
      },
      {
        header: "Vlr. Afecto",
        dataIndex: 'afecto_vlr',
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
        header: "Vlr. IVA",
        dataIndex: 'iva_vlr',
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
        header: "Vlr. Exento",
        dataIndex: 'exento_vlr',
        sortable:false,
        width: 75,
        align: 'right',
        renderer: 'usMoney',
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,				
				decimalPrecision :3
			})
      }/*,
      {
        header: "Orden",
        dataIndex: 'orden',
        sortable:false,
        width: 75,
        align: 'right'       
      }*/
    ];

    
    this.record = Ext.data.Record.create([
            {name: 'numdocumento', type: 'string', mapping: 'd_ca_numdocumento'},
            {name: 'olddocumento', type: 'string', mapping: 'd_ca_numdocumento'},
            {name: 'emision_fch', type: 'date', dateFormat:'Y-m-d', mapping: 'd_ca_emision_fch'},
            {name: 'vencimiento_fch', type: 'date', dateFormat:'Y-m-d', mapping: 'd_ca_vencimiento_fch'},
            {name: 'moneda', type: 'string', mapping: 'd_ca_moneda'},
            {name: 'tipo_cambio', type: 'float', mapping: 'd_ca_tipo_cambio'},
            {name: 'afecto_vlr', type: 'float', mapping: 'd_ca_afecto_vlr'},
            {name: 'iva_vlr', type: 'float', mapping: 'd_ca_iva_vlr'},
            {name: 'exento_vlr', type: 'float', mapping: 'd_ca_exento_vlr'},
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

    
    PanelFacturacion.superclass.constructor.call(this, {
        id: 'panel-facturacion',
        loadMask: {msg:'Cargando...'},
        clicksToEdit: 1,
        stripeRows: true,
        title: 'Facturación',
        
        //height: 350,
        //width: 600,
        selModel: new Ext.grid.CellSelectionModel(),

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
        }]
        
        ,listeners:{
            validateEdit: this.onValidateEdit,
            rowContextMenu: this.onRowcontextMenu,
            afteredit:this.onAfterEdit
        }

    });

};

Ext.extend(PanelFacturacion, Ext.grid.EditorGridPanel, {
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

            changes['numdocumento']=r.data.numdocumento;
            changes['olddocumento']=r.data.olddocumento;
            
            if( r.data.numdocumento && r.data.numdocumento != '+' ){
                //envia los datos al servidor
                Ext.Ajax.request(
                    {
                        waitMsg: 'Guardando cambios...',
                        url: '<?=url_for("falabella/observePanelFacturacion")?>',
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

    afectarItem: function(){
        var storeTransacciones = this.store;
        
        if(this.ctxRecord.tipo == 'archivar'){
            var url_mem = '<?=url_for("falabella/archivarFactura")?>';
        }else if(this.ctxRecord.tipo == 'revertir'){
            var url_mem = '<?=url_for("falabella/revertirFactura")?>';
        }else if(this.ctxRecord.tipo == 'anular'){
            var url_mem = '<?=url_for("falabella/anularFactura")?>';
        }else if(this.ctxRecord.tipo == 'archivar'){
            var url_mem = '<?=url_for("falabella/eliminarFactura")?>';
        }

        if( this.ctxRecord &&  confirm("Desea continuar?") ){
            
            var id = this.ctxRecord.id;
            
            Ext.Ajax.request(
            {
                waitMsg: 'Afectando Factura...',
                url: url_mem,
                //method: 'POST',
                //Solamente se envian los cambios
                params :	{
                    id: id,
                    numdocumento: this.ctxRecord.data.olddocumento
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
                    if( res.success && this.ctxRecord.tipo != 'revertir' ){
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
                               vencimiento_fch: '',
                               moneda: '',
                               tipo_cambio: '',
                               afecto_vlr: '',
                               iva_vlr: '',
                               exento_vlr: '',
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

        if( e.field == "afecto_vlr" ){
           var rec = e.record;
           rec.set("iva_vlr",Math.round(rec.get("afecto_vlr")*0.16));
        }

    },

    onRowcontextMenu: function(grid, index, e){
        rec = this.store.getAt(index);

        if(!this.menu){ // create context menu on first right click

            this.menu = new Ext.menu.Menu({
            id:'grid_facturacion-ctx',
            enableScrolling : false,
            items: [                   
                    {
                        text: 'Archivar Factura',
                        iconCls: 'disk',
                        scope:this,
                        handler: function()
                        {
                            this.ctxRecord.tipo = 'archivar';
                            this.afectarItem()
                        }
                    },{
                        text: 'Revertir Envío',
                        iconCls: 'import',
                        scope:this,
                        handler: function()
                        {
                            this.ctxRecord.tipo = 'revertir';
                            this.afectarItem()
                        }
                    },{
                        text: 'Anular Factura',
                        iconCls: 'delete',
                        scope:this,
                        handler: function()
                        {
                            this.ctxRecord.tipo = 'anular';
                            this.afectarItem()
                        }
                    },{
                        text: 'Eliminar Factura',
                        iconCls: 'delete',
                        scope:this,
                        handler: function()
                        {
                            this.ctxRecord.tipo = 'eliminar';
                            this.afectarItem()
                        }
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