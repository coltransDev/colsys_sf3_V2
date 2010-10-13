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
        width       : 500,			
			closeAction :'close',
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
                            width:300
                        })
                        ,
                        {
                        fieldLabel: 'Identificación',
                        name: 'identificacion',
                        width       : 300
                        }
                        ,
                        {
                        fieldLabel: 'Dirección',
                        name: 'direccion',
                        allowBlank:false,
                        width       : 300
                        },
                        {
                        fieldLabel: 'Telefono',
                        name: 'telefono',
                        allowBlank:false,
                        width       : 300
                        },
                        {
                        fieldLabel: 'Fax',
                        name: 'fax',
                        allowBlank:false,
                        width       : 300
                        },
                        {
                        fieldLabel: 'Email',
                        name: 'email',
                        allowBlank:false,
                        width       : 300
                        },
                        {
                        fieldLabel: 'Contacto',
                        name: 'contacto',
                        allowBlank:false,
                        width       : 300
                        },
                        new WidgetPais({fieldLabel: 'País',
                                        id: 'tra_ciudad_id',
                                        hiddenName: 'tra_ciudad',
                                        pais:'todos',
                                        todos:true
                                       }),
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
					this.close();
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
                        WidgetTerceroWindow.close();
                        
                    }else{
                        alert("Ha ocurrido un error al guardar el registro");
                    }
                    
                }
             }
        );
        }
    },

    show : function(){

        if( this.idtercero ){
            
			Ext.Ajax.request(
			{
				waitMsg: 'Cargando datos...',
				url: '<?=url_for("widgets/datosTercero")?>',

				params : {
					idtercero: this.idtercero
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

                    fp.getForm().findField("tra_ciudad").setRawValue(res.trafico);
                    fp.getForm().findField("tra_ciudad").hiddenField.value = res.idtrafico;
                    
				}
			});

		}

        WidgetTerceroWindow.superclass.show.apply(this, arguments);

    }
});
	
</script>