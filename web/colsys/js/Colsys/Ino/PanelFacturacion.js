/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




var constrainedWin2, winNotCre = null;
Ext.define('Colsys.Ino.PanelFacturacion', {
    extend: 'Ext.panel.Panel',
    //extend: 'Ext.panel.Table',
    alias: 'widget.Colsys.Ino.PanelFacturacion',
    bodyPadding: 5,
    //layout:'column',
    //columns : 2,
    defaults: {
        //columnWidth: 1/3,
        bodyStyle: 'padding:3,marging:3',
        style: "text-align: left",
        labelAlign: 'right'
    },
    /*items:[
     {
     xtype:'Colsys.Widgets.WgImpoexpo',
     fieldLabel: 'impoexpo',
     id:'fmImpoexpo',
     name:'fmImpoexpo'
     },
     {            
     xtype:'Colsys.Widgets.WgTransporte',
     fieldLabel: 'Transporte',
     id:'fmTransporte',
     name:'fmTransporte'
     }
     ],*/
    onRender: function (ct, position) {

        this.setHeight(Ext.getCmp('tab' + this.idmaster).getHeight() - 130);
        this.setWidth(this.up('tabpanel').up('tabpanel').getWidth() - 80);
        var me = this;
        if (this.permisos.Crear == true) {
            tb = new Ext.toolbar.Toolbar();
            tb.add(
                    [{
                            text: 'Agregar',
                            iconCls: 'add',
                            handler: function () {
                                this.up('panel').ventanaFac(null)
                            }
                        }

                    ]);

            tb.add(
                    {
                        text: 'Recargar',
                        iconCls: 'refresh',
                        handler: function () {
                            Ext.getCmp('panel-factura-' + me.idmaster).getStore().reload();
                        }
                    });
            this.addDocked(tb);
        }
        
        this.add(
                [
                    {
                        xtype: 'Colsys.Ino.PanelFactura',
                        idmaster: this.idmaster,
                        idtransporte: this.idtransporte,
                        idimpoexpo: this.idimpoexpo,
                        id: 'panel-factura-' + this.idmaster,
                        name: 'panel-factura-' + this.idmaster,
                        ino:this.ino
                    }
                ]);
        



        this.superclass.onRender.call(this, ct, position);
    },
    listeners: {
        beforerender: function (me, opts)
        {
            //this.setHeight(Ext.getCmp('tab'+this.idmaster).getHeight()-190);
            //this.setWidth(this.up('tabpanel').up('tabpanel').getWidth()-80);
        }

    },
    ventanaFac: function (record, tipo)
    {
        //console.log(record);
        

        if (constrainedWin2 == null)
        {
            constrainedWin2 = Ext.create('Ext.Window', {
                title: 'Factura',
                width: 800,
                //autoHeight: true,
                //closeAction: 'hide',
                //x: 120,
                //y: 120,
                id: "winFormEdit",
                name: "winFormEdit",
                //constrainHeader: true,
                //frame: true,
                layout: 'form',
                items: [{
                        xtype: 'Colsys.Ino.FormFactura',
                        id: 'form-panel' + this.idmaster,
                        name: 'form-panel' + this.idmaster,
                        idmaster: this.idmaster,
                        ino:true,
                        height: 330,
                        width: 800
                    }],
                listeners: {
                    close: function (win, eOpts) {
                        constrainedWin2 = null;
                    }
                }
            })
        }
        if (record != null)
        {
            Ext.getCmp("form-panel" + this.idmaster).cargar(record.data.idcomprobante);
        } else
            Ext.getCmp("form-panel" + this.idmaster).getForm().reset();
        //if(tipo=="C")
//            Ext.getCmp("form-panel").config(tipo);
        constrainedWin2.show();
    }
})
