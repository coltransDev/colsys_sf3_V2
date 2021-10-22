<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/

include_component("widgets", "widgetReporte");
?>
<script type="text/javascript">


    FormTerrestrePanel = function( config ){

        Ext.apply(this, config);
        
        this.widgetReporte = new WidgetReporte({
            fieldLabel: "Reporte",
            name: "reporteT",
            id: "reporteT",
            hiddenName: "idreporteT",
            hiddenId: "idreporteT",
            allowBlank: true,
            tipo:1,
            tabIndex:2,
            transporte: this.transporte,
            impoexpo: this.impoexpo
            
        });
        //this.widgetReporte.addListener("select", this.onSelectReporte, this );
        
        FormTerrestrePanel.superclass.constructor.call(this, {
            activeTab:0,
            title:'T.Terrestre',
            buttonAlign:'center',
            autoHeight:true,
            id:'id-form-Terrestre-panel',
            items:[
                {
                    xtype:'fieldset',
                    title: 'Información de Terrestre',
                    autoHeight:true,
                    items: [
                        {
                        xtype:'fieldset',
                        checkboxToggle:true,
                        title:'Terrestre',
                        autoHeight:true,
                        defaults:{width: 210},
                        defaultType:'textfield',
                        collapsed:true,
                        id:"tterrestre",
                        name:"tterrestre",
                        items:[
                            {
                                xtype:"hidden",
                                name:"terrestre",
                                id:"terrestre"
                            },
                            {
                                xtype:'button',
                                text:"Crear Reporte Terrestre",
                                width:30,
                                handler:this.agregarRepTerrestre
                            },
                            this.widgetReporte, {
                                xtype:'button',
                                iconCls:"search",
                                width:30,
                                handler:this.verReporte
                            }
                        ]
                    }]
                }
            ]
        });
    };

    Ext.extend(FormTerrestrePanel, Ext.Panel, {
        
        agregarRepTerrestre: function( combo, record, idx ){
            form=Ext.getCmp('id-form-Terrestre-panel');
            window.open('/reportesNeg2/indexExt5/idreporte/0/idrepPrincipal/'+form.idreporteP, '_blank');
        },
        verReporte: function( combo, record, idx ){            
            if(Ext.getCmp('reporteT').hiddenField.defaultValue>0)
                window.open('/reportesNeg/generarPDF/id/'+Ext.getCmp('reporteT').hiddenField.defaultValue, '_blank');
            else
                alert("Por favor escoja primero un numero de Reporte de Negocios");
        }
    });

</script>