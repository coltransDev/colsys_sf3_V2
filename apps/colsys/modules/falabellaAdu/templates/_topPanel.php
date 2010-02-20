<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$fala_declaracion = $sf_data->getRaw( 'fala_declaracion' );
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
        header: "Vlr. FOB según Declaración",
        dataIndex: 'vlrfobdeclaracion',
        sortable:false,
        width: 90,
        align: 'right',
        renderer: 'usMoney'
      },
      {
        header: "Vlr. FOB según SKU's",
        dataIndex: 'vlrfobskus',
        sortable:false,
        width: 90,
        align: 'right',
        renderer: 'usMoney'
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
      }
    ];

    this.record = Ext.data.Record.create([
            {name: 'referencia', type: 'string', mapping: 'd_ca_referencia'},
            {name: 'vlrfobdeclaracion', type: 'float', mapping: 'vlrFobDeclaracion'},
            {name: 'vlrfobskus', type: 'float', mapping: 'vlrFobSkus'},
            {name: 'numinternacion', type: 'string', mapping: 'd_ca_numinternacion'}
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

            var grid = Ext.getCmp("panel-declaracion");
            grid.guardarCambios();

            var grid = Ext.getCmp("panel-facturacion");
            grid.guardarCambios();

            var grid = Ext.getCmp("panel-notas-cab");
            grid.guardarCambios();

            var grid = Ext.getCmp("panel-notas-det");
            grid.guardarCambios();

        }

    });

</script>