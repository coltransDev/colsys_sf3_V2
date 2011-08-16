<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


?>

<script language="javascript">



WidgetTerceroWindow = function( config ){
    Ext.apply(this, config);

    WidgetTerceroWindow.superclass.constructor.call(this, {
        autoDestroy :false,
        id: 'tercero-window',
        width       : 500,			
			plain       : true,

			items       : new Ext.FormPanel({
                id: 'tercero-form',
                
                defaultType: 'textfield',

                items: [
                        {
                        name: 'idtercero',
                        xtype: 'hidden',
                        allowBlank:false,
                        width       : 300
                        },
                        new Ext.form.TextField({
                            fieldLabel: 'Nombre',
                            name: 'nombre',
                            id: 'nombre',
                            allowBlank:false,
                            width:300,
                            maxLength: 80
                        })
                        ,
                        {
                        fieldLabel: 'Identificaci�n',
                        name: 'identificacion',
                        maxLength: 35,
                        width       : 300
                        }
                        ,
                        {
                        fieldLabel: 'Direcci�n',
                        name: 'direccion',
                        allowBlank:false,
                        width       : 300,
                        maxLength: 255
                        },
                        {
                        fieldLabel: 'Telefono',
                        name: 'telefono',
                        allowBlank:false,
                        width       : 300,
                        maxLength: 50
                        },
                        {
                        fieldLabel: 'Fax',
                        name: 'fax',
                        allowBlank:false,
                        width       : 300,
                         maxLength: 50
                        },
                        {
                        fieldLabel: 'Email',
                        name: 'email',
                        allowBlank:false,
                        width       : 300,
                         maxLength: 250
                        },
                        {
                        fieldLabel: 'Contacto',
                        name: 'contacto',
                        allowBlank:false,
                        width       : 300,
                        maxLength: 60
                        },
                        /*new WidgetPais({fieldLabel: 'Pa�s',
                                        id: 'tra_ciudad_id',
                                        hiddenName: 'tra_ciudad',
                                        pais:'todos',
                                        todos:true
                                       }),*/
                        new WidgetCiudad({fieldLabel: 'Ciudad',
                                          linkPais: 'tra_ciudad_id',
                                          name: 'ciudad',
                                          hiddenName: 'idciudad',
                                          id: 'ciudad'                                          
                                        })
                ]
            }),
        

                buttons: [{
				text     : 'Guardar',
                scope: this, 
				handler: this.guardar
			},{
				text     : 'Cancelar',
                scope: this, 
				handler  : function(){
					win1.hide();
				}
			}]
    });
};

Ext.extend(WidgetTerceroWindow, Ext.Window, {
    guardar: function(){

        var fp = Ext.getCmp("tercero-form");

        if(fp.getForm().isValid()){
            var idtercero = fp.getForm().findField("idtercero").getValue();
            var nombre = fp.getForm().findField("nombre").getValue();
            var identificacion = fp.getForm().findField("identificacion").getValue();
            var direccion = fp.getForm().findField("direccion").getValue();
            var telefono = fp.getForm().findField("telefono").getValue();
            var fax = fp.getForm().findField("fax").getValue();
            var email = fp.getForm().findField("email").getValue();
            var contacto = fp.getForm().findField("contacto").getValue();
            var fldCiudad = fp.getForm().findField("ciudad");
            var idciudad = fldCiudad.hiddenField?fldCiudad.hiddenField.value:fldCiudad.getValue();
            WidgetTerceroWindow = this;
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?=url_for("widgets/guardarTercero")?>',
                params : {
                    idtercero: idtercero,
                    nombre: nombre,
                    identificacion: identificacion,
                    direccion: direccion,
                    telefono: telefono,
                    fax: fax,
                    email: email,
                    contacto: contacto,
                    idciudad: idciudad,
                    idcomponent: this.idcomponent,
                    tipo: this.tipo
                }
                ,               
                callback :function(options, success, response){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if( res.success ){
                        if( res.idcomponent ){
                            Ext.getCmp(res.idcomponent).setValue( res.nombre );
                            if( Ext.getCmp(res.idcomponent).hiddenField ){
                                Ext.getCmp(res.idcomponent).hiddenField.value = res.idtercero;
                            }
                        }
                        win1.hide();
                    }else{
                        alert("Ha ocurrido un error al guardar el registro");
                    }
                }
             }
        );
        }
    },
    precarga : function(id,tipo,titulo)
    {
        this.idcomponent=id;
        this.title=titulo;
        this.tipo=tipo;
    },
    cargar :function(idtercero)
    {        
        if( idtercero ){
            Ext.Ajax.request(
            {
                waitMsg: 'Cargando datos...',
                url: '<?=url_for("widgets/datosTercero")?>',

                params : {
                        idtercero: idtercero
                }
                ,
    		callback :function(options, success, response){
                    var res = Ext.util.JSON.decode( response.responseText );
                    var fp = Ext.getCmp("tercero-form");
                    fp.getForm().findField("idtercero").setValue(res.idtercero);
                    fp.getForm().findField("nombre").setValue(res.nombre);
                    fp.getForm().findField("identificacion").setValue(res.identificacion);
                    fp.getForm().findField("direccion").setValue(res.direccion);
                    fp.getForm().findField("telefono").setValue(res.telefonos);
                    fp.getForm().findField("email").setValue(res.email);
                    fp.getForm().findField("fax").setValue(res.fax);
                    fp.getForm().findField("contacto").setValue(res.contacto);
                    fp.getForm().findField("ciudad").setRawValue(res.ciudad);
                    fp.getForm().findField("ciudad").hiddenField.value = res.idciudad;

                }
            });
        }
        else
        {
            var fp = Ext.getCmp("tercero-form");
            fp.getForm().findField("idtercero").setValue("");
            fp.getForm().findField("nombre").setValue("");
            fp.getForm().findField("identificacion").setValue("");
            fp.getForm().findField("direccion").setValue("");
            fp.getForm().findField("telefono").setValue("");
            fp.getForm().findField("email").setValue("");
            fp.getForm().findField("fax").setValue("");
            fp.getForm().findField("contacto").setValue("");
            fp.getForm().findField("ciudad").setRawValue("");
            fp.getForm().findField("ciudad").hiddenField.value = "";
        }

    }


});
	
</script>
