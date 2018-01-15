Ext.define('Colsys.Ino.FormComprobanteAereo', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Ino.FormComprobanteAereo',
    bodyPadding: 5,
    height: 110,
    defaults: {
        columnWidth: 0.5,
        bodyStyle: 'padding:4px',
        labelWidth: 100,
    },
    items: [
        {
            xtype: 'fieldset',
            height: 105,
            columnWidth: 1,
            layout: 'column',
            columns: 3,
            defaults: {
                columnWidth: 0.2,
                bodyStyle: 'padding:4px'
            },
            items: [
                {
                    xtype: 'radiogroup',
                    fieldLabel: 'Idioma Conceptos',
                    id:'fmIdioma',
                    name:'fmIdioma',                    
                    //columns: 3,
                    columnWidth: 1,
                    items: [
                        { boxLabel: 'Espa&ntilde;ol', name: 'id', inputValue: 'esp', checked: true },
                        { boxLabel: 'Ingles', name: 'id', inputValue: 'eng'}

                    ]
                },
                {
                    xtype: 'radiogroup',
                    fieldLabel: 'Orden',
                    id:'fmOrden',
                    name:'fmOrden',                    
                    //columns: 3,
                    columnWidth: 1,
                    items: [
                        { boxLabel: 'Alfabetico', name: 'rb', inputValue: '1', checked: true },
                        { boxLabel: 'Numerico', name: 'rb', inputValue: '2'},
                        { boxLabel: 'Entrada', name: 'rb', inputValue: '3'}

                    ]
                },
                {
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 25,
                }, {
                    xtype: 'button',
                    text: 'Dolar Pesos',
                    id:'monedacambio',
                    name: 'monedacambio',
                    columnWidth: .35,
                    handler: function () {
                        var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                            sorc: this.up('form').file+'/tipo/EP/orden/'+Ext.getCmp('fmOrden').items.get(0).getGroupValue()+'/idioma/'+Ext.getCmp('fmIdioma').items.get(0).getGroupValue(),
                        });
                        windowpdf.show();
                        this.up('window').close();
                    }
                }, {
                    xtype: 'tbspacer',
                    columnWidth: .05,
                }, {
                    xtype: 'button',
                    text: 'Pesos',
                    id:'monedalocal',
                    name: 'monedalocal',
                    //columnWidth: .3,
                    handler: function () {
                       var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                            sorc: this.up('form').file+'/tipo/P/orden/'+Ext.getCmp('fmOrden').items.get(0).getGroupValue()+'/idioma/'+Ext.getCmp('fmIdioma').items.get(0).getGroupValue(),
                        });
                        windowpdf.show();
                        this.up('window').close();
                    }
                }, {
                    xtype: 'tbspacer',
                    columnWidth: .05,
                },
                {
                    xtype: 'button',
                    text: 'Moneda Extrajera',
                    id:'monedaextranjera',
                    name: 'monedaextranjera',
                    columnWidth: .3,
                    handler: function () {
                       var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                            sorc: this.up('form').file+'/tipo/E/orden/'+Ext.getCmp('fmOrden').items.get(0).getGroupValue()+'/idioma/'+Ext.getCmp('fmIdioma').items.get(0).getGroupValue(),
                        });
                        windowpdf.show();
                        this.up('window').close();
                    }
                }
                
            ]
        }
    ],
    listeners : {
        beforerender: function (ct, position){
            if (this.idmoneda != "COP"){
                Ext.getCmp("monedacambio").text = this.idmoneda + " Pesos";
                Ext.getCmp("monedaextranjera").text = this.idmoneda ;
            }
            else{
                //Ext.getCmp("monedacambio").text = " Pesos";
                Ext.getCmp("monedacambio").setVisible(false);
                Ext.getCmp("monedaextranjera").setVisible(false);
            }
        }
    }
})