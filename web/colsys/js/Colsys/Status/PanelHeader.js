Ext.define('Colsys.Status.PanelHeader', {    
    extend: 'Ext.panel.Panel',
    alias: 'widget.Colsys.Status.PanelHeader',
    autoScroll: true,    
    //height: 200,        
    //height: 280,
    bodyPadding: 10,
    //frame: true,
    //title: 'Tools',
    //collapsed: ,
    layout: 'column',
    frame: true,
    collapsible: true,        
        listeners: {
            collapse: function () {
                this.up().doLayout();
            },
            expand: function () {
                this.up().doLayout();
            }
        },
    /*defaultType: 'fieldcontainer',
    defaults: {
        labelAlign: 'top',
        margin: '0 20 0 0'
    },*/
    //collapsible: true,
    //border: false,
    //width: 640,
    //html: loadURL('https://localhost/status/htmlCabecera/idmaster/17480'),
    //html: "fasdfasdfasdfsdadf",
    //bodyPadding: 5,
    colspan: 1,
    listeners:{
        render:function (me, eOpts){
            
            //console.log(me);
            //var me = this;
            //if(t.load==false || t.load=="undefined" || !t.load){
                Ext.Ajax.request({
                    url: '/status/htmlCabecera',
                    params: {
                        idmaster: this.idmaster
                    },
                    method: 'POST',
                    waitTitle: 'Connecting',
                    waitMsg: 'Cargando Archivo...',
                    scope: me,
                    success: function (response, options) {                    
                        me.setHtml(response.responseText);
                    },
                    failure: function () {
                       console.log('failure');
                    }
                });
           //}       
        }
                    
            
        
    }
});