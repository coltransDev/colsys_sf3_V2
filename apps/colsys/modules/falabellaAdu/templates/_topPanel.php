<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$fala_declaracion = $sf_data->getRaw( "fala_declaracion" );
?>
<script type="text/javascript">

TopPanel = function(){

    this.columns = [
      {
        header: "Referencia",
        dataIndex: 'referencia',
        sortable:false,
        width: 60
      },
      {
        header: "No.Declaración",
        dataIndex: 'numdeclaracion',
        sortable:false,
        width: 40,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :0
			})
      },
      {
        header: "No.Internación",
        dataIndex: 'numinternacion',
        sortable:false,
        width: 40,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :0
			})
      },
      {
        header: "Fch.Emisión",
        dataIndex: 'emision_fch',
        sortable:false,
        width: 45,
        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
        editor: new Ext.form.DateField({
                                format: 'Y-m-d',
                                allowBlank: false
                        })
      },
      {
        header: "Fch.Vencimiento",
        dataIndex: 'vencimiento_fch',
        sortable:false,
        width: 45,
        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
        editor: new Ext.form.DateField({
                                format: 'Y-m-d',
                                allowBlank: false
                        })
      },
      {
        header: "Fch.Aceptación",
        dataIndex: 'aceptacion_fch',
        sortable:false,
        width: 45,
        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
        editor: new Ext.form.DateField({
                                format: 'Y-m-d',
                                allowBlank: false
                        })
      },
      {
        header: "Fch.Pago",
        dataIndex: 'pago_fch',
        sortable:false,
        width: 45,
        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
        editor: new Ext.form.DateField({
                                format: 'Y-m-d',
                                allowBlank: false
                        })
      },
      {
        header: "Mon.",
        dataIndex: 'moneda',
        sortable:false,
        width: 35
      },
      {
        header: "T.R.M.",
        dataIndex: 'valor_trm',
        sortable:false,
        width: 40
      }
    ];

    this.record = Ext.data.Record.create([
            {name: 'referencia', type: 'string', mapping: 'd_ca_referencia'},
            {name: 'numdeclaracion', type: 'string', mapping: 'd_ca_numdeclaracion'},
            {name: 'numinternacion', type: 'string', mapping: 'd_ca_numinternacion'},
            {name: 'emision_fch', type: 'date', dateFormat: 'Y-m-d', mapping: 'd_ca_emision_fch'},
            {name: 'vencimiento_fch', type: 'date', dateFormat: 'Y-m-d', mapping: 'd_ca_vencimiento_fch'},
            {name: 'aceptacion_fch', type: 'date', dateFormat: 'Y-m-d', mapping: 'd_ca_aceptacion_fch'},
            {name: 'pago_fch', type: 'date', dateFormat: 'Y-m-d', mapping: 'd_ca_pago_fch'},
            {name: 'moneda', type: 'string', mapping: 'd_ca_moneda'},
            {name: 'valor_trm', type: 'string', mapping: 'd_ca_valor_trm'},
        ]);

    this.store = new Ext.data.Store({

        autoLoad : true,
        proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>array($fala_declaracion)))?>),
        reader: new Ext.data.JsonReader(
            {
                root: 'root'
            },
            this.record
        )
    });


    TopPanel.superclass.constructor.call(this, {
       loadMask: {msg:'Cargando...'},
       clicksToEdit: 1,
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
        }
      ]

    });

};


    Ext.extend(TopPanel, Ext.grid.EditorGridPanel, {
        height: 75,
        guardarCambios: function(){
            var store = this.store;
            var records = store.getModifiedRecords();

            var lenght = records.length;

            for( var i=0; i<lenght; i++){
                r = records[i];

                var changes = r.getChanges();

                //Incluye la llave Primaria que es la Referencia
                changes['id']=r.id;
                changes['referencia']=r.data.referencia;

                //envia los datos al servidor
                Ext.Ajax.request(
                    {
                        waitMsg: 'Guardando cambios...',
                        url: '<?=url_for("falabellaAdu/observeDeclaracion")?>',
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
            
            var grid = Ext.getCmp("panel-facturacion");
            grid.guardarCambios();

            var grid = Ext.getCmp("panel-notas-cab");
            grid.guardarCambios();

            var grid = Ext.getCmp("panel-notas-det");
            grid.guardarCambios();

        }

    });

</script>