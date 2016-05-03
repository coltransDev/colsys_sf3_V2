/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




var constrainedWin2,winNotCre=null;
Ext.define('Colsys.Ino.PanelFacturacion', {
    extend: 'Ext.panel.Panel',
    //extend: 'Ext.panel.Table',
    alias: 'widget.Colsys.Ino.PanelFacturacion',
    bodyPadding: 5,    
    //layout:'column',
    //columns : 2,
    defaults:{
        //columnWidth: 1/3,
        bodyStyle:'padding:3,marging:3',
            style:"text-align: left",
            labelAlign:'right'
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
    onRender: function(ct, position){      
        
        if(this.permisos.Crear == true){
        tb = new Ext.toolbar.Toolbar();
        tb.add(
        [{
            text: 'Agregar',
            iconCls: 'add',
            handler : function(){        
                this.up('panel').ventanaFac(null)
            }
        }]);
        this.addDocked(tb);
        this.add(
        [
            {
                xtype:'Colsys.Ino.PanelFactura',
                idmaster: this.idmaster,
                idtransporte: this.idtransporte,
                idimpoexpo: this.idimpoexpo,
                id:'panel-factura-'+this.idmaster
            }
            /*Ext.create('Ext.view.View', {
                store: Ext.data.StoreManager.lookup('imagesStore'),
                tpl: imageTpl,
                itemSelector: 'div.thumb-wrap'//,
                //emptyText: 'No images available',

            })*/
        /*{
            xtype:'Colsys.Ino.GridFacturacion',
            title: "Facturacion2",
            id:"grid-facturacion-2",
            name:"grid-facturacion-2",
            idmaster: this.idmaster,
            idtransporte: this.idtransporte,
            idimpoexpo: this.idimpoexpo
        },
        {
            xtype:'Colsys.Ino.GridFacturacion',
            title: "Facturacion1",
            id:"grid-facturacion-1",
            name:"grid-facturacion-1",
            idmaster: this.idmaster,
            idtransporte: this.idtransporte,
            idimpoexpo: this.idimpoexpo
        }*/
    ]);
    }
    
    
        
        this.superclass.onRender.call(this, ct, position);  
    },
    ventanaFac : function(record,tipo)
    {
        //console.log(record);
        //alert(tipo);
        
        if(constrainedWin2==null)
        {
            constrainedWin2 = Ext.create('Ext.Window', {
                title: 'Factura',
                width: 800,
                //autoHeight: true,
                closeAction: 'hide',
                //x: 120,
                //y: 120,
                id:"winFormEdit",
                name:"winFormEdit",                
                //constrainHeader: true,
                //frame: true,
                layout: 'form',
                items: [{
                    xtype:'Colsys.Ino.FormFactura',
                    id:'form-panel'+this.idmaster,
                    name:'form-panel'+this.idmaster,
                    idmaster: this.idmaster,
                    height:330,
                    width:800
                }]
            })
        }
        if(record!=null)
        {
            Ext.getCmp("form-panel"+this.idmaster).cargar(record.data.idcomprobante);            
        }
        else
            Ext.getCmp("form-panel"+this.idmaster).getForm().reset();
        //if(tipo=="C")
//            Ext.getCmp("form-panel").config(tipo);
          constrainedWin2.show();
    }
})
