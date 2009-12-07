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
        new Ext.FormPanel({
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
                        document.getElementById("mask").style.display = 'inline';                        
                        document.getElementById("mask").style.height = (Ext.get(document.body).getHeight()+50)+'px';
                        win.show();
                    }else{
                        document.getElementById("mask").style.display = 'none';
                        win.hide();

                    }
                }
            }
         }

    );
    window.setTimeout(checkAccess, 60000 );
    //window.setTimeout(checkAccess, 3000 );

}
//window.setTimeout(checkAccess, 3000 );
window.setTimeout(checkAccess, 605000 );

