<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("widgets", "widgetIds");


$tipos = $sf_data->getRaw("tipos");   



$saveUrl = "inocomprobantes/saveFormComprobantePanel";
$saveUrlOkRedirect = "inocomprobantes/formComprobante";

if( isset($idhouse) && $idhouse ){

    $saveUrl.="?idhouse=".$idhouse;
    $saveUrlOkRedirect .= "?idhouse=".$idhouse;
}


?>
<script type="text/javascript">




/*
var storeTipos = new Ext.data.Store({
    autoload: true,
    proxy: new Ext.data.MemoryProxy(<?=json_encode($tipos)?>),
    reader: new Ext.data.JsonReader({
                        root: 'root',
                        totalProperty: 'total'
                    },
                    new Ext.data.Record.create([
                            {name: 'idtipo', type: 'string'},
                            {name: 'tipo', type: 'string'}
                    ])
                )
});*/

var storeTiposTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><b>{tipo}</b></div></tpl>'
);

FormComprobantePanel = function( config ){


    Ext.apply(this, config);


    this.ids = new WidgetIds({				        
                        hiddenName: "ids",
                        name: 'ids_name',
                        forceSelection:true,
                        width: 400,
                        allowBlank:false
					});
                   
    this.tbar = [
        {
                id:'guardar-encabezado-btn',
                text: 'Guardar',
                iconCls: 'disk',
                handler : this.guardar,
                scope: this
            }
    ];
    
    if( this.idcomprobante ){
        this.tbar.push(
            {
                text: 'Previsualizar',
                iconCls: 'page_white_magnify',
                handler : this.previsualizar,
                scope: this
            }            
        );
        this.tbar.push(  
            {
                text: 'Generar',
                iconCls: 'page_white_acrobat',
                handler : this.generar,
                scope: this
            }
        );            
    }   
    
    this.preview = new Ext.TabPanel({
        id: 'preview',
        xtype:'tabpanel',
        buttonAlign: 'left',
        activeTab: 0,
        defaults:{autoHeight:true, bodyStyle:'padding:10px'},
        deferredRender:false,

        items:[{
            title:'Información General',
            layout:'form',


            items: [{
                layout:'table',
                border: false,
                defaults: {
                    // applied to each contained panel
                    bodyStyle:'padding-right:20px',
                    border: false
                },

                items: [{
                            layout: 'form',
                            items: [                                   
                                new Ext.form.ComboBox({
                                    fieldLabel: 'Tipo',
                                    valueField:'idtipo',
                                    displayField:'tipo',
                                    typeAhead: true,
                                    width: 300,
                                    emptyText:'',
                                    value: '',
                                    forceSelection:true,
                                    selectOnFocus:true,
                                    allowBlank:false,
                                    name:'tipo',
                                    mode:'local',
                                    triggerAction: 'all',
                                    disabled: this.idcomprobante,
                                    store: new Ext.data.Store({
                                        autoLoad : true,
                                        reader: new Ext.data.JsonReader(
                                            {
                                                root: 'root',
                                                totalProperty: 'total'
                                            },
                                            Ext.data.Record.create([
                                                {name: 'idtipo', type: 'string'},
                                                {name: 'tipo', type: 'string'}
                                            ])
                                        ),
                                        proxy: new Ext.data.MemoryProxy(<?=json_encode($tipos)?>)
                                    }),

                                    onSelect: function(record, index){ // override default onSelect to do redirect
                                        if(this.fireEvent('beforeselect', this, record, index) !== false){
                                            this.setValue(record.data[this.valueField || this.displayField]);
                                            this.collapse();
                                            this.fireEvent('select', this, record, index);
                                        }
                                        Ext.getCmp("idtipo").setValue(record.get("idtipo"));
                                    }
                                }),                                   
                                                                    
                                {
                                    xtype:'hidden',
                                    id: 'idcomprobante'
                                },
                                
                                {
                                    xtype:'hidden',
                                    id: 'idcomprobante'
                                },
                                {
                                    xtype:'hidden',
                                    id: 'detalles'
                                }
                                
                            ]

                        },
                        {
                            layout: 'form',
                            items: [
                            {
                                xtype:'textfield',
                                fieldLabel: 'Consecutivo',
                                name: 'consecutivo',
                                value: '',                                        
                                allowBlank:true,
                                readOnly: true,                                        
                                width: 120
                            }
                           ]
                        },
                        {
                            layout: 'form',
                            items: [
                            {
                                xtype:'datefield',
                                fieldLabel: 'Fecha',
                                format: 'Y-m-d',
                                name: 'fchcomprobante',                                    
                                allowBlank:false,
                                width: 120
                            }
                            ]
                        },
                        {
                            layout: 'form',
                            items: [
                                {
                                    xtype:'numberfield',
                                    fieldLabel: 'Tasa de Cambio',
                                    name: 'tcambio',                                    
                                    allowBlank:false,
                                    allowNegative:false,
                                    decimalPrecision : 2,                                    
                                    width: 80
                                },
                                {
                                    xtype:'numberfield',
                                    fieldLabel: 'Tasa de Cambio USD',
                                    name: 'tcambio_usd',                 
                                    allowBlank:false,
                                    allowNegative:false,
                                    decimalPrecision : 2,                                    
                                    width: 80
                                }
                            ]
                        }
                    ]
            },

            this.ids


            ]
        },{
            title:'Notas',
            layout:'form',
            defaults: {width: 230},
            defaultType: 'textfield',

            items: [ {
                xtype: 'textarea',
                width: 500,
                fieldLabel: 'Observaciones',
                name: 'observaciones',
                value: '',
                allowBlank:true
            }]            
        }]

    });



    FormComprobantePanel.superclass.constructor.call(this, {
        id:'main-tabs',
        labelAlign: 'top',
        title: 'Generación de Comprobantes',
        bodyStyle:'padding:1px',
		//fileUpload: true,        
        items: [
            this.preview
        ]

    });


};

Ext.extend(FormComprobantePanel, Ext.FormPanel, {
    /**
     * Form onRender override
     */
    onRender:function() {

        // call parent
        FormComprobantePanel.superclass.onRender.apply(this, arguments);

        // set wait message target

        if( this.idcomprobante ){
            this.getForm().waitMsgTarget = this.getEl();
            //var form  = this.getForm();


            this.load({
                url:'<?= url_for("inocomprobantes/datosComprobanteFormComprobantePanel") ?>',
                waitMsg:'Cargando...',
                params:{idcomprobante:this.idcomprobante},

                success:function(response,options){
                    this.res = Ext.util.JSON.decode( options.response.responseText );
                    //form.findField("ids").setRawValue(this.res.data.ids);
                    //form.findField("ids").hiddenField.value = this.res.data.ids_id;
                    /*
                    var idtrafico = this.res.data.idtrafico;                       
                    Ext.getCmp("ciudad_id").setIdtrafico( idtrafico );
                    Ext.getCmp("ciudad_id").setValue( this.res.data.idciudad );
                    if( idtrafico=="CO-057" ){
                        Ext.getCmp("dir_col").setVisible(true);
                        Ext.getCmp("dir_other").setVisible(false);
                    }else{
                        Ext.getCmp("dir_col").setVisible(false);
                        Ext.getCmp("dir_other").setVisible(true);
                    }

                    if( tipo.getValue()!="1" ){                
                        Ext.getCmp("dv_id").disable();
                    }else{                
                        Ext.getCmp("dv_id").enable();                
                    }*/
                }
            });          

        }

        
       
    },
    guardar: function(){
        
        var idcomprobante = this.idcomprobante;
        var form = this.getForm();
        if( form.isValid() ){
            
            var grid = Ext.getCmp("form-comprobante-subpanel");
            var records = grid.store.getRange();
            var result = [];            
            for( var i=0; i<records.length; i++){
                rec = records[i];
                if( rec.get("idconcepto") ){
                    var str = "idconcepto="+rec.get("idconcepto")+" ";
                    str += "valor="+rec.get("valor");
                    result.push( str );
                }

            }
            form.findField("detalles").setValue(result.join("|"));

            form.submit({url:'<?=url_for( $saveUrl )?>',
                                    waitMsg:'Salvando Datos básicos...',
                                    success:function(response,options){
                                        
                                        if( !idcomprobante ){                                        
                                            document.location='<?=url_for($saveUrlOkRedirect)."?idcomprobante="?>'+options.result.idcomprobante;                                        
                                        }
                                        
                                       //Ext.Msg.alert( "Msg "+response.responseText );
                                    },
                                    // standardSubmit: false,
                                    failure:function(response,options){
                                        Ext.Msg.alert( "Error "+response.responseText );
                                    }//end failure block
                                });
        }else{
            Ext.MessageBox.alert('Sistema de Comprobantes - Error:', '¡Atención: La información básica no es válida o está incompleta!');
        }
    }
    ,
    previsualizar: function(){
        window.open("<?=url_for("inocomprobantes/generarComprobantePDF")?>/idcomprobante/"+this.idcomprobante);

    },

    generar: function(){
        if( confirm("Se generara la factura y se transferira a SIIGO, sera necesario anularla para hacer modificaciones, ¿desea continuar?") ){
            document.location = "<?=url_for("inocomprobantes/generarComprobante")?>/idcomprobante/"+this.idcomprobante;            
        }

    }


});

</script>