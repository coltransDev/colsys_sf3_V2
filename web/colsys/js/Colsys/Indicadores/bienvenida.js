Ext.define('Colsys.Indicadores.bienvenida', {
    extend: 'Ext.panel.Panel',
    listeners:{
        render: function( t , eOpts ){
            me=t;
            if(t.load==false || t.load=="undefined" || !t.load){
                Ext.Ajax.request({
                    url: '/tracking/indicadoresAdu/htmlBienvenida',
                    method: 'POST',
                    waitTitle: 'Connecting',
                    waitMsg: 'Cargando Archivo...',
                    scope: t,
                    success: function (response, options) {                    
                        me.setHtml(response.responseText);
                    },
                    failure: function () {
                       console.log('failure');
                    }
               });
           }       
        }
    }
});
