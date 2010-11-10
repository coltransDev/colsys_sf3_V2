/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */



var checkLogin = function(){

    var fp = Ext.getCmp('login-form');
    if( fp.getForm().isValid() ){
        //ttransito = fp.getForm().findField("ttransito").getValue();
        fp.getForm().submit({url:'/users/validateLogin',
            waitMsg:'Verificando...',
            // standardSubmit: false,

            success: function(form, action) {
               if( action.result.success ){
                    if( action.result.login ){
                        document.getElementById("mask").style.display = 'none';
                        win.hide();
                    }else{
                        Ext.Msg.alert( "Error","Usuario o clave incorrecta" );
                    }
                }
            },
            failure: function(form, action) {
                switch (action.failureType) {
                    case Ext.form.Action.CLIENT_INVALID:
                        Ext.Msg.alert('Failure', 'Form fields may not be submitted with invalid values');
                        break;
                    case Ext.form.Action.CONNECT_FAILURE:
                        Ext.Msg.alert('Failure', 'Ajax communication failed');
                        break;
                    case Ext.form.Action.SERVER_INVALID:
                       Ext.Msg.alert('Failure', action.result.msg);
               }
            }


        });

    }else{
        Ext.MessageBox.alert('Error:', '¡Atención: Por favor diligencie los datos!');
    }

}

 win = new Ext.Window({
    layout:'fit',
    width:350,
    height:150,
    closeAction:'hide',
    //plain: true,
    modal: true,
    bodyCssClass: 'black',
    id: 'login-window',
    closable: false,
    resizable: false,
    title: 'Colsys: Control de acceso',

    items: [
        new Ext.form.FormPanel({
            labelWidth: 75, // label settings here cascade unless overridden
            frame:false,

            bodyStyle:'padding:15px 15px 15px 15px',
            width: 200,
            //defaults: {width: 230},
            defaultType: 'textfield',
            //bodyStyle: 'padding:10px;background-color:#fff',
            id: 'login-form',


            items: [{
                    fieldLabel: 'Usuario',
                    name: 'username',
                    allowBlank:false
                },{
                    fieldLabel: 'Clave',
                    name: 'passwd',
                    inputType: 'password',
                    allowBlank:false
                }
            ],

            buttons: [{
                text: 'Continuar',
                handler: checkLogin
            }]
        })

    ]

});


//Tomada de http://www.lokeshdhakar.com/projects/lightbox2/
var getPageSize = function() {

    var xScroll, yScroll;

    if (window.innerHeight && window.scrollMaxY) {
        xScroll = window.innerWidth + window.scrollMaxX;
        yScroll = window.innerHeight + window.scrollMaxY;
    } else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
        xScroll = document.body.scrollWidth;
        yScroll = document.body.scrollHeight;
    } else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
        xScroll = document.body.offsetWidth;
        yScroll = document.body.offsetHeight;
    }

    var windowWidth, windowHeight;

    if (self.innerHeight) {	// all except Explorer
        if(document.documentElement.clientWidth){
            windowWidth = document.documentElement.clientWidth;
        } else {
            windowWidth = self.innerWidth;
        }
        windowHeight = self.innerHeight;
    } else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
        windowWidth = document.documentElement.clientWidth;
        windowHeight = document.documentElement.clientHeight;
    } else if (document.body) { // other Explorers
        windowWidth = document.body.clientWidth;
        windowHeight = document.body.clientHeight;
    }

    // for small pages with total height less then height of the viewport
    if(yScroll < windowHeight){
        pageHeight = windowHeight;
    } else {
        pageHeight = yScroll;
    }

    // for small pages with total width less then width of the viewport
    if(xScroll < windowWidth){
        pageWidth = xScroll;
    } else {
        pageWidth = windowWidth;
    }

    return [pageWidth,pageHeight];
}


var checkAccess = function(){

    Ext.Ajax.request(
        {
            url: '/users/checkLogin',
            //Solamente se envian los cambios
            //params :	params,

            callback :function(options, success, response){

                var res = Ext.util.JSON.decode( response.responseText );
                if( res.success ){
                    if( !res.login ){
                        var pageSize = getPageSize();                       
                        
                        document.getElementById("mask").style.display = 'inline';                        
                        document.getElementById("mask").style.height = pageSize[1]+'px';
                        win.show();
                    }else{
                        document.getElementById("mask").style.display = 'none';
                        win.hide();

                    }
                }
            }
         }

    );
    window.setTimeout(checkAccess, 180000 );
    //window.setTimeout(checkAccess, 3000 );

}
//window.setTimeout(checkAccess, 3000 );
window.setTimeout(checkAccess, 605000 );

