Ext.define('Colsys.Ino.FormModo', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Ino.FormModo',
    bodyPadding: 5,
    defaults:{
        columnWidth:0.5,
        bodyStyle:'padding:4px',
        labelWidth:100,
    },
    items:[
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
    ],
    buttons: [{
       text: 'guardar',
       formBind: true,
       handler: function() {
        ref='0';
        tabpanel = Ext.getCmp('tabpanel1');

        if(!tabpanel.getChildByElement('tab'+ref) && ref!="")
        {
            tabpanel.add(
            {
                title: 'Sin Numero',
                id:'tab'+ref,
                itemId:'tab'+ref,
                closable :true,
                autoScroll: true,
                items: [new Colsys.Ino.Mainpanel({"idmaster":ref,
                        idtransporte: Ext.getCmp('fmTransporte').getValue(),
                        idimpoexpo: Ext.getCmp('fmImpoexpo').getValue()
                    })]
            }).show();
        }
        tabpanel.setActiveTab('tab'+ref);
        this.up('window').close();
       }
   }]
})