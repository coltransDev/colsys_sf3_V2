Ext.define('Colsys.Status.FieldSetOtm', {
    extend: 'Ext.form.FieldSet',
    alias: 'widget.Colsys.Status.FieldSetOtm',
    autoScroll: true,
    border: true,
    margin: '0 10 0 0',
    title: 'Informaci\u00F3n Otm',
    layout: {
        type: 'table',
        columns: 1,
        tableAttrs: {
            style: {
                width: '100%'
            }
        }
    },
    hideMode : 'display',
    /*scrollable: true,
     defaults: {
     bodyPadding: '10 10',
     border: true,
     frame: true
     },*/
    listeners: {
        render: function (me, eOpts) {
            //var data = Ext.getCmp('header-panel-' + this.idhouse).data;            
            var me = this;
            
            //console.log(Ext.getCmp('header-panel-' + this.idhouse).data);
            //console.log(this);            
            this.add(
                    {
                        xtype: 'Colsys.Widgets.WgTrackingEtapa',
                        fieldLabel: 'Etapa',
                        id: 'etapa-' + this.idhouse,
                        name: 'etapa_otm',
                        labelWidth: 100,
                        tipo: "Status",
                        departamento: 'OTM/DTA',
                        //allowBlank: false,
                        //transporte: 'Terrestre',
                        //impoexpo: 'OTM-DTA',
                        listeners: {
                            select: function (combo, records, eOpts) {
                                console.log(records.data);
                                id = combo.getValue();                                
                                mensaje =  records.data.mensaje_default;
                                
                                switch(id){
                                    case "IMCOL":
                                        Ext.getCmp('fchllegada_otm'+ me.idhouse).setDisabled(false);
                                        Ext.getCmp('fchcargue_otm'+ me.idhouse).setDisabled(true);
                                        Ext.getCmp('fchsalida_otm'+ me.idhouse).setDisabled(true);
                                        Ext.getCmp('fchplanilla_otm'+ me.idhouse).setDisabled(true);
                                        Ext.getCmp('fchcierre_otm'+ me.idhouse).setDisabled(true);
                                        break;
                                    case "OTDES":
                                        Ext.getCmp('fchcargue_otm'+ me.idhouse).setDisabled(false);
                                        Ext.getCmp('fchsalida_otm'+ me.idhouse).setDisabled(false);
                                        Ext.getCmp('fchllegada_otm'+ me.idhouse).setDisabled(true);
                                        Ext.getCmp('fchplanilla_otm'+ me.idhouse).setDisabled(true);
                                        Ext.getCmp('fchcierre_otm'+ me.idhouse).setDisabled(true);                          
                                        break;
                                    case "99999":
                                        Ext.getCmp('fchplanilla_otm'+ me.idhouse).setDisabled(false);
                                        Ext.getCmp('fchcierre_otm'+ me.idhouse).setDisabled(false);
                                        Ext.getCmp('fchllegada_otm'+ me.idhouse).setDisabled(true);
                                        Ext.getCmp('fchcargue_otm'+ me.idhouse).setDisabled(true);
                                        Ext.getCmp('fchsalida_otm'+ me.idhouse).setDisabled(true);
                                        break;
                                    default:
                                        me.ocultarCampos(me);
                                }                                
                                
                                Ext.getCmp('mensaje_cliente' + me.idhouse).setValue(mensaje);
                                Ext.getCmp('mensaje' + me.idhouse).setHtml(records.data.mensaje);
                                
                            }
                        }

                    },            
                    {
                        xtype: 'datefield',
                        fieldLabel: 'Fch. llegada',
                        id: 'fchllegada_otm'+ this.idhouse,
                        name: 'fchllegada_otm',
                        format: "Y-m-d",
                        altFormat: "Y-m-d",
                        maxValue: new Date(),
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        submitFormat: 'Y-m-d',
                        //allowBlank: false
                    },
                    {
                        xtype: 'datefield',
                        fieldLabel: 'Fch. Cargue',
                        id: 'fchcargue_otm'+ this.idhouse,
                        name: 'fchcargue_otm',
                        format: "Y-m-d",
                        altFormat: "Y-m-d",
                        maxValue: new Date(),
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        submitFormat: 'Y-m-d',
                        //allowBlank: false
                    },
                    {
                        xtype: 'datefield',
                        fieldLabel: 'Fch. Salida Otm',
                        id: 'fchsalida_otm'+ this.idhouse,
                        name: 'fchsalida_otm',
                        format: "Y-m-d",
                        altFormat: "Y-m-d",
                        maxValue: new Date(),
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        submitFormat: 'Y-m-d',
                        //allowBlank: false
                    },
                    {
                        xtype: 'datefield',
                        fieldLabel: 'Fch. Planilla',
                        id: 'fchplanilla_otm'+ this.idhouse,
                        name: 'fchplanilla_otm',
                        format: "Y-m-d",
                        altFormat: "Y-m-d",
                        maxValue: new Date(),
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        submitFormat: 'Y-m-d',
                        //allowBlank: false
                    },
                    {
                        xtype: 'datefield',
                        fieldLabel: 'Fch. Cierre Otm',
                        id: 'fchcierre_otm'+ this.idhouse,
                        name: 'fchcierre_otm',
                        format: "Y-m-d",
                        altFormat: "Y-m-d",
                        maxValue: new Date(),
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        submitFormat: 'Y-m-d',
                        //allowBlank: false
                    },
                    Ext.create('Colsys.Widgets.WgBodega', {
                        xtype: 'Colsys.Widgets.WgBodega',
                        fieldLabel: 'Bodega',
                        id: 'bodega'+ this.idhouse,
                        name: 'bodega',
                        hiddenName: 'idbodega'/*,
                        valueField: 'idbodega',
                        displayField: 'nombre',*/
                        //allowBlank: false
                    })
            );
        },
        afterrender: function(ct, position){
            me = this;
            this.ocultarCampos(me);
        }
    },
    ocultarCampos: function(panel){        
        Ext.each(panel.getRefItems(), function (c) {
            if(c.getXType() === "datefield"){
                c.setDisabled(true);
                //c.allowBlank = true;
            }
        });
        data = Ext.getCmp('header-panel-' + panel.idhouse).data;        
        Ext.getCmp('bodega'+ panel.idhouse).setValue(data.idbodega);
    }
});