Ext.define('Colsys.Ino.FormComprobanteAereo', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Ino.FormComprobanteAereo',
    bodyPadding: 5,
    height: 50,
    defaults: {
        columnWidth: 0.5,
        bodyStyle: 'padding:4px',
        labelWidth: 100,
    },
    items: [
        {
            xtype: 'fieldset',
            height: 35,
            columnWidth: 1,
            layout: 'column',
            columns: 2,
            defaults: {
                columnWidth: 0.3,
                bodyStyle: 'padding:4px'
            },
            items: [{
                    xtype: 'tbspacer',
                    columnWidth: 1,
                    height: 25,
                }, {
                    xtype: 'button',
                    text: 'Dolar Pesos',
                    id:'monedacambio',
                    name: 'pesos',
                    columnWidth: .4,
                    handler: function () {
                        var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                            sorc: this.up('form').file+'/tipo/DP',
                            tipo: 'dolarpesos'
                        });
                        windowpdf.show();
                        this.up('window').close();

                    }
                }, {
                    xtype: 'tbspacer',
                    columnWidth: .1,
                }, {
                    xtype: 'button',
                    text: 'Pesos',
                    id:'moneda',
                    name: 'dolares',
                    columnWidth: .4,
                    handler: function () {
                       var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                            sorc: this.up('form').file
                            
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
                Ext.getCmp("moneda").text = this.idmoneda ;
            }
            else{
                Ext.getCmp("monedacambio").text = " Pesos";
                Ext.getCmp("moneda").setVisible(false);
            }
        }
    }
})