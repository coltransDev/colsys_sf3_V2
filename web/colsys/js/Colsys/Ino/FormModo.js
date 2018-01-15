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
            name:'fmImpoexpo',
            
            allowBlank:false,
            listeners:{
                select : function( combo, records, idx ){   
                    var me = this.up();
                    data=records.data;
                    
                    if(data.valor=="OTM-DTA")
                    {
                        Ext.getCmp("fmEmpresa").setHidden(false);
                        //Ext.getCmp("fmIdempresa").allowBlank=false;
                    }
                    else
                    {
                        Ext.getCmp("fmEmpresa").setHidden(true);
                        //Ext.getCmp("fmIdempresa").allowBlank=true;
                    }
                }
                
            }
        },
        {            
            xtype:'Colsys.Widgets.WgTransporte',
            fieldLabel: 'Transporte',
            id:'fmTransporte',
            name:'fmTransporte',
            allowBlank:false
        },
        {
        xtype: 'radiogroup',
        fieldLabel: 'Empresa',
        id:'fmEmpresa',
        name:'fmEmpresa',
        hidden:true,
        columns: 2,        
        items: [
            { boxLabel: 'Coltrans', name: 'rb', inputValue: '2' },
            { boxLabel: 'Colotm', name: 'rb', inputValue: '8', checked: true}
            
        ]
    }
        /*{
            xtype      : 'fieldcontainer',
            fieldLabel : 'Empresa',
            defaultType: 'radiofield',
            defaults: {
                flex: 1
            },
            id:'fmEmpresa',
            name:'fmEmpresa',
            hidden:true,
            layout: 'hbox',
            items: [
                {
                    boxLabel  : 'Coltrans',
                    name      : 'empresa',
                    inputValue: 'coltrans',
                    id        : 'fmColtrans'
                },{
                    boxLabel  : 'ColOtm',
                    name      : 'empresa',
                    inputValue: 'colotm',
                    id        : 'fmColotm'
                }
            ]
        }*/
    ],
    buttons: [{
       text: 'Guardar',
       formBind: true,
       handler: function() {
        ref='0';
        tabpanel = Ext.getCmp('tabpanel1');

        if(!tabpanel.getChildByElement('tab'+ref) && ref!="")
        {
//            console.log(permisosG);
            
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
            else if(Ext.getCmp('fmImpoexpo').getValue()=="OTM-DTA")
                tmppermisos=permisosG.otm;
            //console.log(Ext.getcmp("fmEmpresa").getValue());
            //console.log(Ext.getCmp('fmEmpresa').items.get(0).getGroupValue());
            
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
                        idempresa: Ext.getCmp('fmEmpresa').items.get(0).getGroupValue(),
                        permisos:tmppermisos
                    })]
            }).show();
        }
        
        tabpanel.setActiveTab('tab'+ref);
        this.up('window').close();
       }
   }]
})