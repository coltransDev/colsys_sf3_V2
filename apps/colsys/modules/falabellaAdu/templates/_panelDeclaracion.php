<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$fala_detallesimp = $sf_data->getRaw( "fala_detallesimp" );

?>
<script type="text/javascript">

PanelDeclaracion = function(){

    this.colData = [
      {
        header: "It",
        dataIndex: 'item',
        sortable:false,
        width: 25,
        locked: true
      },
      {
        header: "No.Declaración",
        dataIndex: 'numdeclaracion',
        sortable:false,
        width: 120,
        editor: new Ext.form.TextField({
            allowBlank: false
        }),
        locked: true
      },
      {
        header: "Fch.Emisión",
        dataIndex: 'emision_fch',
        sortable:false,
        width: 90,
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
        width: 90,
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
        width: 90,
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
      },
      {
        header: "SubPartida",
        dataIndex: 'subpartida',
        sortable:false,
        width: 90
      },
      {
        header: "Mod",
        dataIndex: 'mod',
        sortable:false,
        width: 45
      },
      {
        header: "Cantidad",
        dataIndex: 'cantidad',
        sortable:false,
        width: 70
      },
      {
        header: "Uni",
        dataIndex: 'unidad',
        sortable:false,
        width: 40
      },
      {
        header: "Vlr.FOB",
        dataIndex: 'valor_fob',
        sortable:false,
        width: 90,
        align: 'right',
        renderer: 'usMoney'
      },
      {
        header: "Gas.Despacho",
        dataIndex: 'gastos_despacho',
        sortable:false,
        width: 90,
        align: 'right',
        renderer: 'usMoney'
      },
      {
        header: "Fletes",
        dataIndex: 'flete',
        sortable:false,
        width: 90,
        align: 'right',
        renderer: 'usMoney'
      },
      {
        header: "Seguro",
        dataIndex: 'seguro',
        sortable:false,
        width: 75,
        align: 'right',
        renderer: 'usMoney'
      },
      {
        header: "Gas.Embalaje",
        dataIndex: 'gastos_embarque',
        sortable:false,
        width: 90,
        align: 'right',
        renderer: 'usMoney'
      },
      {
        header: "Ajuste",
        dataIndex: 'ajuste_valor',
        sortable:false,
        width: 90,
        align: 'right',
        renderer: 'usMoney'
      },
      {
        header: "Vlr.Aduana",
        dataIndex: 'valor_aduana',
        sortable:false,
        width: 90,
        align: 'right',
        renderer: 'usMoney'
      },
      {
        header: "%A",
        dataIndex: 'arancel_porcntj',
        sortable:false,
        width: 30,
        align: 'right'
      },
      {
        header: "Tot.Arancel",
        dataIndex: 'arancel',
        sortable:false,
        width: 90,
        align: 'right',
        renderer: 'usMoney'
      },
      {
        header: "%I",
        dataIndex: 'iva_porcntj',
        sortable:false,
        width: 30,
        align: 'right'
      },
      {
        header: "Tot.Iva",
        dataIndex: 'iva',
        sortable:false,
        width: 90,
        align: 'right',
        renderer: 'usMoney'
      },
      {
        header: "%S",
        dataIndex: 'salvaguarda_porcntj',
        sortable:false,
        width: 30,
        align: 'right'
      },
      {
        header: "Tot.Salvaguarda",
        dataIndex: 'salvaguarda',
        sortable:false,
        width: 90,
        align: 'right',
        renderer: 'usMoney'
      },
      {
        header: "%C",
        dataIndex: 'compensa_porcntj',
        sortable:false,
        width: 30,
        align: 'right'
      },
      {
        header: "Tot.Compensa",
        dataIndex: 'compensa',
        sortable:false,
        width: 90,
        align: 'right',
        renderer: 'usMoney'
      },
      {
        header: "%A",
        dataIndex: 'antidump_porcntj',
        sortable:false,
        width: 30,
        align: 'right'
      },
      {
        header: "Tot.Antidump",
        dataIndex: 'antidump',
        sortable:false,
        width: 90,
        align: 'right',
        renderer: 'usMoney'
      },
      {
        header: "Sanción",
        dataIndex: 'sancion',
        sortable:false,
        width: 90,
        align: 'right',
        renderer: 'usMoney'
      },
      {
        header: "Rescate",
        dataIndex: 'rescate',
        sortable:false,
        width: 90,
        align: 'right',
        renderer: 'usMoney'
      },
      {
        header: "Peso Bruto",
        dataIndex: 'peso_bruto',
        sortable:false,
        width: 70,
        align: 'right'
      },
      {
        header: "Peso Neto",
        dataIndex: 'peso_neto',
        sortable:false,
        width: 70,
        align: 'right'
      },
    ];

    
    this.record = Ext.data.Record.create([
            {name: 'item', type: 'string', mapping: 'd_ca_item'},
            {name: 'numdeclaracion', type: 'string', mapping: 'd_ca_numdeclaracion'},
            {name: 'emision_fch', type: 'date', dateFormat: 'Y-m-d', mapping: 'd_ca_emision_fch'},
            {name: 'aceptacion_fch', type: 'date', dateFormat: 'Y-m-d', mapping: 'd_ca_aceptacion_fch'},
            {name: 'pago_fch', type: 'date', dateFormat: 'Y-m-d', mapping: 'd_ca_pago_fch'},
            {name: 'moneda', type: 'string', mapping: 'd_ca_moneda'},
            {name: 'valor_trm', type: 'string', mapping: 'd_ca_valor_trm'},
            {name: 'subpartida', type: 'string', mapping: 'd_ca_subpartida'},
            {name: 'mod', type: 'string', mapping: 'd_ca_mod'},
            {name: 'cantidad', type: 'float', mapping: 'd_ca_cantidad'},
            {name: 'unidad', type: 'string', mapping: 'd_ca_unidad'},
            {name: 'valor_fob', type: 'float', mapping: 'd_ca_valor_fob'},
            {name: 'gastos_despacho', type: 'float', mapping: 'd_ca_gastos_despacho'},
            {name: 'flete', type: 'float', mapping: 'd_ca_flete'},
            {name: 'seguro', type: 'float', mapping: 'd_ca_seguro'},
            {name: 'gastos_embarque', type: 'float', mapping: 'd_ca_gastos_embarque'},
            {name: 'ajuste_valor', type: 'float', mapping: 'd_ca_ajuste_valor'},
            {name: 'valor_aduana', type: 'float', mapping: 'd_ca_valor_aduana'},
            {name: 'arancel_porcntj', type: 'float', mapping: 'd_ca_arancel_porcntj'},
            {name: 'arancel', type: 'int', mapping: 'd_ca_arancel'},
            {name: 'iva_porctj', type: 'float', mapping: 'd_ca_iva_porctj'},
            {name: 'iva', type: 'int', mapping: 'd_ca_iva'},
            {name: 'salvaguarda_porcntj', type: 'float', mapping: 'd_ca_salvaguarda_porcntj'},
            {name: 'salvaguarda', type: 'int', mapping: 'd_ca_salvaguarda'},
            {name: 'compensa_porcntj', type: 'float', mapping: 'd_ca_compensa_porcntj'},
            {name: 'compensa', type: 'int', mapping: 'd_ca_compensa'},
            {name: 'antidump_porcntj', type: 'float', mapping: 'd_ca_antidump_porcntj'},
            {name: 'antidump', type: 'int', mapping: 'd_ca_antidump'},
            {name: 'sancion', type: 'int', mapping: 'd_ca_sancion'},
            {name: 'rescate', type: 'int', mapping: 'd_ca_rescate'},
            {name: 'peso_bruto', type: 'float', mapping: 'd_ca_peso_bruto'},
            {name: 'peso_neto', type: 'float', mapping: 'd_ca_peso_neto'}
        ]);

    this.store = new Ext.data.Store({       

        autoLoad : true,
        proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$fala_detallesimp))?>),
        reader: new Ext.data.JsonReader(
            {
                root: 'root'
            },
            this.record
        )
    });

    
    PanelDeclaracion.superclass.constructor.call(this, {
        id: 'panel-declaracion',
        loadMask: {msg:'Cargando...'},
        clicksToEdit: 1,
        stripeRows: true,
        title: 'Declaración',
        activeTab: 0,
        //height: 350,
        //width: 600,
        selModel: new Ext.grid.CellSelectionModel(),
        colModel: new Ext.ux.grid.LockingColumnModel( this.colData ),

        view: new Ext.ux.grid.LockingGridView({
            //forceFit:true
            //enableRowBody:true,
            //showPreview:true//,
            //getRowClass : this.applyRowClass
        })
        
        //,listeners:{
            //afteredit:this.onAfterEdit,
            //rowContextMenu: this.onRowcontextMenu
	//}

    });

};

Ext.extend(PanelDeclaracion, Ext.grid.EditorGridPanel, {
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
            changes['item']=r.data.item;

            if( r.data.numdeclaracion ){
                //envia los datos al servidor
                Ext.Ajax.request(
                    {
                        waitMsg: 'Guardando cambios...',
                        url: '<?=url_for("falabellaAdu/observePanelDeclaracion?referencia=".base64_encode($referencia))?>',
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
    }
});

</script>