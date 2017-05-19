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
            fieldLabel: 'Servicio',
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
       text: 'Guardar',
       formBind: true,
       handler: function() {
        ref='0';
        tabpanel = Ext.getCmp('tabpanel1');

        if(!tabpanel.getChildByElement('tab'+ref) && ref!="")
        {
            console.log(permisosG);
            
            if(Ext.getCmp('fmImpoexpo').getValue()=="INTERNO")
                tmppermisos=permisosG.terrestre;
            else if(Ext.getCmp('fmImpoexpo').getValue()=="Exportaci\u00F3n")
                tmppermisos=permisosG.exportacion;
            else if(Ext.getCmp('fmImpoexpo').getValue()=="Importaci\u00F3n")
            {
                if(Ext.getCmp('fmTransporte').getValue()=="Mar\u00EDtimo")
                    tmppermisos=permisosG.maritimo;
                if(Ext.getCmp('fmTransporte').getValue()=="A\u00E9reo")
                    tmppermisos=permisosG.aereo;
            }
            else if(record.data.m_ca_impoexpo=="OTM-DTA")
                tmppermisos=permisosG.otm;
            
            tabpanel.add(
            {
                title: 'Sin Numero',
                id:'tab'+ref,
                itemId:'tab'+ref,
                closable :true,
                autoScroll: true,
                items: [new Colsys.Ino.Mainpanel({"idmaster":ref,
                        idtransporte: Ext.getCmp('fmTransporte').getValue(),
                        idimpoexpo: Ext.getCmp('fmImpoexpo').getValue(),
                        permisos:tmppermisos
                    })]
            }).show();
        }
        tabpanel.setActiveTab('tab'+ref);
        this.up('window').close();
       }
   }]
})