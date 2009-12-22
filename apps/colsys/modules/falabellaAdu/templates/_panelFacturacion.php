<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$data = $sf_data->getRaw( "data" );

?>
<script type="text/javascript">

PanelFacturacion = function(){

    this.columns = [
     
      {
        header: "Factura",
        dataIndex: 'numdocumento',
        sortable:false,
        width: 90,
        editor: new Ext.form.NumberField({
				allowBlank: false ,
				allowNegative: false,
				style: 'text-align:left',
				decimalPrecision :3
			})
      },
      {
        header: "Fch. Emisión",
        dataIndex: 'emision_fch',
        sortable:false,
        width: 45
      },
      {
        header: "Fch Vencimiento",
        dataIndex: 'vencimiento_fch',
        sortable:false,
        width: 70
      },
      {
        header: "Moneda",
        dataIndex: 'moneda',
        sortable:false,
        width: 40
      },
      {
        header: "Cambio",
        dataIndex: 'tipo_cambio',
        sortable:false,
        width: 90,
        align: 'right',
        renderer: 'usMoney'
      },
      {
        header: "Vlr. Afectado",
        dataIndex: 'afecto_vlr',
        sortable:false,
        width: 90,
        align: 'right',
        renderer: 'usMoney'
      },
      {
        header: "Vlr. IVA",
        dataIndex: 'iva_vlr',
        sortable:false,
        width: 90,
        align: 'right',
        renderer: 'usMoney'
      },
      {
        header: "vlr. Exento",
        dataIndex: 'exento_vlr',
        sortable:false,
        width: 75,
        align: 'right',
        renderer: 'usMoney'
      }
    ];

    
    this.record = Ext.data.Record.create([
            {name: 'referencia', type: 'string', mapping: 'd_ca_referencia'},
            {name: 'numdocumento', type: 'string', mapping: 'd_ca_numdocumento'},
            {name: 'emision_fch', type: 'string', mapping: 'd_ca_emision_fch'},
            {name: 'vencimiento_fch', type: 'float', mapping: 'd_ca_vencimiento_fch'},
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
        })
        
        ,listeners:{
            validateEdit: this.onValidateEdit
            //afteredit:this.onAfterEdit,
            //rowContextMenu: this.onRowcontextMenu
        }

    });

};

Ext.extend(PanelFacturacion, Ext.grid.EditorGridPanel, {
    height: 290,
    guardarCambios: function(){
        
    },

    onValidateEdit : function(e){

        if( e.field == "numdocumento" && e.value ){
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
         
            //Inserta una columna en blanco al final
            storeGrid.addSorted(newRec);
            storeGrid.sort("orden", "ASC");

            
            
        }

        return true;





    }
});

</script>