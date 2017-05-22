Ext.define('Colsys.Ino.PanelBalance', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.Colsys.Ino.PanelBalance',
    autoScroll: true,
    fixed:true,
    title:'sdfdsfsdfdsf',
    overflowY :'scroll',
    layout: 'column',
    defaults: {
        columnWidth: 1/2                            
    },
    listeners: {
        beforerender:function(me, opts)
        {
            this.setHeight(Ext.getCmp('tab'+this.idmaster).getHeight()-130);        
            this.setWidth(this.up('tabpanel').up('tabpanel').getWidth()-50);
        },        
        activate: function(ct, position){
            //idmaster=this.idmaster;
            me=this;
            if(this.load==false || this.load=="undefined" || !this.load)
            {
                Ext.Ajax.request({
                    url: '/inoF2/balance',
                    method: 'POST',
                    waitTitle: 'Connecting',
                    waitMsg: 'Eliminando Archivo...',
                    params: {
                        "idmaster": me.idmaster
                    },
                    scope: this,
                    success: function (response, options) {
                        //var res = Ext.util.JSON.decode(response.responseText);
                        //console.log(response.responseText);
                      me.setHtml(response.responseText)  ;
                    },
                    failure: function () {
                        console.log('failure');
                    }
                });

            }
           //this.superclass.onRender.call(this, ct, position);
        }
    }
    //html:'sdfsdfdsfsdfdsfdsfdsf'
})