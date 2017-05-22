<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$tipos = $sf_data->getRaw("tipos");
$modo = $sf_data->getRaw("modo");

?>
<script type="text/javascript">
    GridFacturacionFormPanel = function( config ) {
        Ext.apply(this, config);
        this.ctxRecord = null;
        
        

        this.tipos = new Ext.form.ComboBox({
            fieldLabel: 'Tipo',
            valueField:'idtipo',
            displayField:'tipo',
            typeAhead: true,
            width: 400,
            emptyText:'',
            value: '',
            forceSelection:true,
            selectOnFocus:true,
            allowBlank:false,
            name:'tipo',
            id:'tipo',
            hiddenName:'idtipo',
            mode:'local',
            triggerAction: 'all',
            store: new Ext.data.Store({
                autoLoad : true,
                reader: new Ext.data.JsonReader({
                    root: 'root',
                        totalProperty: 'total'
                    },
                    Ext.data.Record.create([
                        {name: 'idtipo', type: 'string'},
                        {name: 'tipo', type: 'string'}
                    ])
                ),
                proxy: new Ext.data.MemoryProxy(<?= json_encode($tipos) ?>)
            })           
        });
        
        this.recHouses = Ext.data.Record.create([
            {name: 'idhouse', type: 'string'},
            {name: 'value', type: 'string'}
        ]);

        this.inoHouses = new Ext.form.ComboBox({
            fieldLabel: 'House',
            valueField:'idhouse',
            displayField:'value',
            typeAhead: true,
            width: 400,
            emptyText:'',
            value: '',
            forceSelection:true,
            selectOnFocus:true,
            allowBlank:false,
            name:'house',
            hiddenName: 'idhouse',
            mode:'local',
            triggerAction: 'all',
            store: new Ext.data.Store({
                autoLoad : false,
                reader: new Ext.data.JsonReader({
                    root: 'root',
                        totalProperty: 'total'
                    },
                    this.recHouses
                ),
                proxy: new Ext.data.MemoryProxy({})
            }),

            onSelect: function(record, index){ // override default onSelect to do redirect
                if(this.fireEvent('beforeselect', this, record, index) !== false){
                    this.setValue(record.data[this.valueField || this.displayField]);
                    this.collapse();
                    this.fireEvent('select', this, record, index);
                }
                if( Ext.getCmp("idtipo") ){
                    Ext.getCmp("idtipo").setValue(record.get("idtipo"));
                }
            }
        });
        
        
        this.ids = new WidgetIds({
            fieldLabel: "Facturado a",
            id: "ids",
            name: "id",
            hiddenName: 'id',
            width: 400,
            allowBlank: false
        });

        this.items = [{
            xtype:'tabpanel',
            buttonAlign: 'left',
            activeTab: 0,
            defaults:{autoHeight:true},
            deferredRender:false,
            items:[{
                title:'Información General',
                layout:'form',
                bodyStyle:'padding:10px',
                items: [
                    this.inoHouses,
                    this.tipos,
                    this.ids,
                    {
				    layout:'column',
				    border: false,
                    columns: 2,
				    defaults: {
				        // applied to each contained panel
				        bodyStyle:'padding-right:20px',
				        border: false
				    },
				    items: [
                        // Columna 1
                        {
                                layout: 'form',
                                columnWidth:.5,
                                items: [
                                    {
                                        xtype:'hidden',
                                        id: 'idcomprobante',
                                        value: this.idcomprobante
                                    }, 
                                    {
                                        xtype:'hidden',
                                        id: 'deducciones'                                        
                                    },
                                    {
                                        xtype:'hidden',
                                        id: 'modo',
                                        value: this.modo
                                    }, 
                                    {
                                        xtype:'textfield',
                                        fieldLabel: 'Consecutivo',
                                        name: 'consecutivo',
                                        value: '',
                                        allowBlank:false,
                                        width: 100,
                                        allowNegative:false,
                                        decimalPrecision : 0,
                                        tabIndex: 1
                                    },
                                    {
                                        xtype:'numberfield',
                                        fieldLabel: 'Tasa de Cambio',
                                        name: 'tasacambio',
                                        id: 'tasacambio_id',
                                        value: '',
                                        allowBlank:false,
                                        allowNegative:false,
                                        decimalPrecision : 2,
                                        width: 80,
                                        tabIndex: 3,
                                        listeners: {
                                            change: this.cambiarTasaCambio
                                        }
                                    }
                                    ,                                
                                    new WidgetMoneda({
                                        width: 120,
                                        fieldLabel: 'Moneda',
                                        allowBlank: false,
                                        name: 'idmoneda',
                                        tabIndex: 5
                                    })
                                ]

                            },
                            // Columna 2 
                            {
                                layout: 'form',
                                columnWidth:.5,
                                items: [
                                    {
                                        xtype:'datefield',
                                        fieldLabel: 'Fecha',
                                        format: 'Y-m-d',
                                        name: 'fchcomprobante',
                                        value: '',
                                        allowBlank:false,
                                        width: 100,
                                        tabIndex: 2
                                    },
                                    {
                                        xtype:'numberfield',
                                        fieldLabel: 'Valor',
                                        name: 'valor',
                                        value: '',
                                        allowBlank:false,
                                        allowNegative:true,
                                        decimalPrecision : 2,
                                        width: 80,
                                        tabIndex: 4
                                    }
                                ]
                            }
                            
                        ]
                }
                
				]
            },
            new GridDeduccionesPanel(
                {                    
                    idcomprobante: this.idcomprobante,
                    title: "Deducciones",
                    id: 'grid-deduccion-panel',
                    modo: this.modo,
                    impoexpo: this.impoexpo,
                    transporte: this.transporte,
                    modalidad: this.modalidad
                }
            )
            ]

        }];

        this.buttonns = [
            {
                text: 'Guardar',
                handler: this.guardarItem,
                scope: this
            },
            {
                text: 'Cancelar',
                handler: function(){
                    Ext.getCmp("edit-factura-win").close();
                }
            }

        ];
       
        
        GridFacturacionFormPanel.superclass.constructor.call(this, {            
            autoHeight: true,
            autoWidth: true,
            id: 'form-facturacion',
            items: this.items,
            buttons: this.buttonns
        
        });

        //this.addEvents({add:true});
    }

    Ext.extend(GridFacturacionFormPanel, Ext.form.FormPanel, {
         guardarItem: function(){
            
            var panel  = Ext.getCmp("form-facturacion");
            var form = panel.getForm();
            var gridId = this.gridId;
            if( form.isValid() ){
                
                var grid = Ext.getCmp("grid-deduccion-panel");
                
                
                var records = grid.store.getRange();
                
                var result = [];
                for( var i=0; i<records.length; i++){
                    rec = records[i];
                    if( rec.get("iddeduccion") ){
                        var str = "iddeduccion="+rec.get("iddeduccion")+" ";
                        str += "neto="+rec.get("neto");
                        result.push( str );
                    }
                }
                form.findField("deducciones").setValue(result.join("|"));
                
                var gridOpener = this.gridOpener;
                form.submit({
                    url: "<?=url_for("ino/guardarGridFacturacionPanel")?>",
                    //scope:this,
                    waitMsg:'Guardando...',
                    waitTitle:'Por favor espere...',
                    success:function(form,action){
                        var res = Ext.util.JSON.decode( action.response.responseText );
                        if(res.info)
                        {
                            alert(res.info)
                        }
                        var win = Ext.getCmp("edit-factura-win");
                        if( win ){
                            win.close();
                        }

                        if( gridId ){
                            var grid = Ext.getCmp( gridId );
                            if( grid ){
                                grid.recargar();
                            }
                        }
                        
                    },
                    // standardSubmit: false,
                    failure:function(form,action){
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                    }//end failure block
                });
            }else{
                Ext.MessageBox.alert('Error Message', "Por favor complete todos los datos");
            }

        },
        
        cambiarTasaCambio: function(){
            var grid = Ext.getCmp("grid-deduccion-panel");
            var records = grid.store.getRange();            
            for( var i=0; i<records.length; i++){
                var rec = records[i];
                rec.set("valor", rec.get("neto")*this.getValue());
            }
        },

        /**
        * Form onRender override
        */
        onRender:function() {

            // call parent
            FormHousePanel.superclass.onRender.apply(this, arguments);

            // set wait message target
           
            
            
            var store = Ext.getCmp("grid-house-panel").store;
            var records = store.getRange();
            
            for( var i=0; i<records.length; i++ ){
                var newRec = new this.recHouses({
                    idhouse: records[i].data.idhouse,
                    value: records[i].data.doctransporte+" - "+records[i].data.cliente
                });
                
                this.inoHouses.store.addSorted( newRec );
            }
            
            
            if( this.idcomprobante ){
                this.getForm().waitMsgTarget = this.getEl();
                var form  = this.getForm();
                this.load({
                    url:'<?=url_for("ino/datosGridFacturacionFormPanel")?>',
                    waitMsg:'Cargando...',
                    params:{idcomprobante:this.idcomprobante,
                            modo:this.modo},

                    success:function(response,options){
                        this.res = Ext.util.JSON.decode( options.response.responseText );
                        form.findField("ids").setRawValue(this.res.data.ids);
                        form.findField("ids").hiddenField.value = this.res.data.ids_id;                        
                    }

                });
            }
            this.inoHouses.setValue(this.idhouse);
            
            //Ext.getCmp("edit-factura-win").close();
            
        }        
    });

</script>

