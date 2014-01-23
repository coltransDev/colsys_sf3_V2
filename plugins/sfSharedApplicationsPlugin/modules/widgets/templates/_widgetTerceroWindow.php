<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
//include_component("widgets", "widgetParametros",array("caso_uso"=>"CU227"));
?>
<script language="javascript">

WidgetTerceroWindow = function( config ){
    Ext.apply(this, config);

    WidgetTerceroWindow.superclass.constructor.call(this, {
        autoDestroy :false,
        id: 'tercero-window',
        width       : 500,
			plain       : true,
            closable :false,
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
                        {
                            xtype: 'radiogroup',
                            fieldLabel: 'Tipo',
                            itemCls: 'x-check-group-alt',
                            id:"tipoper",

                            items: [
                                {boxLabel: 'Empresa', name: 'tipopersona', inputValue: 2, checked: true},
                                {boxLabel: 'Persona natural', name: 'tipopersona', inputValue: 1},
                            ],
                            listeners:{
                                change:function( radio, checked )
                                {
                                    
                                    if(checked.inputValue=="2")
                                    {
                                        Ext.getCmp("nombre").show();
                                        Ext.getCmp("nombre1").hide();
                                        Ext.getCmp("nombre2").hide();
                                        Ext.getCmp("apellido1").hide();
                                        Ext.getCmp("apellido2").hide();
                                        Ext.getCmp("nombre1").allowBlank=true;
                                        Ext.getCmp("nombre2").allowBlank=true;
                                        Ext.getCmp("apellido1").allowBlank=true;
                                        Ext.getCmp("apellido2").allowBlank=true;
                                    }
                                    else if(checked.inputValue=="1")
                                    {
                                        Ext.getCmp("nombre").allowBlank=true;
                                        Ext.getCmp("nombre").hide();
                                        Ext.getCmp("nombre1").show();
                                        Ext.getCmp("nombre2").show();
                                        Ext.getCmp("apellido1").show();
                                        Ext.getCmp("apellido2").show();
                                    }
                                }
                            }
                        },
                        /*new WidgetParametros({
                            fieldLabel: 'Tipo Persona',
                            id:'tpersona',
                            name:'tpersona',
                            caso_uso:"CU227",
                            width:120,
                            idvalor: "valor",
                            ididentificador:"identificador"
                        }),*/
                        new Ext.form.TextField({
                            fieldLabel: 'Nombre',
                            name: 'nombre',
                            id: 'nombre',
                            allowBlank:false,
                            width:300,
                            maxLength: 80
                        }),
                        new Ext.form.TextField({
                            fieldLabel: 'Nombre 1',
                            name: 'nombre1',
                            id: 'nombre1',                            
                            width:300,
                            maxLength: 30,
                            hidden:true
                        }),
                        new Ext.form.TextField({
                            fieldLabel: 'Nombre 2',
                            name: 'nombre2',
                            id: 'nombre2',                            
                            width:300,
                            maxLength: 30,
                            hidden:true
                        }),
                        new Ext.form.TextField({
                            fieldLabel: 'Apellido 1',
                            name: 'apellido1',
                            id: 'apellido1',                            
                            width:300,
                            maxLength: 30,
                            hidden:true
                        }),
                        new Ext.form.TextField({
                            fieldLabel: 'Apellido 2',
                            name: 'apellido2',
                            id: 'apellido2',                            
                            width:300,
                            maxLength: 30,
                            hidden:true
                        }),
                        {
                        fieldLabel: 'Identificación',
                        name: 'identificacion',
                        maxLength: 35,
                        width       : 300
                        }
                        ,
                        {
                        fieldLabel: 'Dirección',
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
                        /*new WidgetPais({fieldLabel: 'País',
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
            
            datos=fp.getForm().getValues();
            if(datos.tipopersona=="1")
            {
                datos.nombre=datos.nombre1+" "+datos.nombre2+" "+datos.apellido1+" "+datos.apellido2;                
            }
            datos.idcomponent=this.idcomponent;
            datos.tipo=this.tipo;            
            
            WidgetTerceroWindow = this;
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?=url_for("widgets/guardarTercero")?>',
                params : datos,
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
                },
                callback :function(options, success, response){
                    var res = Ext.util.JSON.decode( response.responseText );
                    var fp = Ext.getCmp("tercero-form");
                    
                    if(res.tipopersona=="2")                    
                    {
                        Ext.getCmp("nombre").show();
                        Ext.getCmp("nombre1").hide();
                        Ext.getCmp("nombre2").hide();
                        Ext.getCmp("apellido1").hide();
                        Ext.getCmp("apellido2").hide();
                        Ext.getCmp("nombre1").allowBlank=true;
                        Ext.getCmp("nombre2").allowBlank=true;
                        Ext.getCmp("apellido1").allowBlank=true;
                        Ext.getCmp("apellido2").allowBlank=true;
                    }
                    else if(checked.inputValue=="1")
                    {
                        Ext.getCmp("nombre").allowBlank=true;
                        Ext.getCmp("nombre").hide();
                        Ext.getCmp("nombre1").show();
                        Ext.getCmp("nombre2").show();
                        Ext.getCmp("apellido1").show();
                        Ext.getCmp("apellido2").show();
                    }
                    fp.getForm().findField("tipoper").setValue(res.tipopersona);
                    
                    fp.getForm().findField("idtercero").setValue(res.idtercero);
                    fp.getForm().findField("nombre").setValue(res.nombre);
                    fp.getForm().findField("nombre1").setValue(res.nombre1);
                    fp.getForm().findField("nombre2").setValue(res.nombre2);
                    fp.getForm().findField("apellido1").setValue(res.apellido1);
                    fp.getForm().findField("apellido2").setValue(res.apellido2);
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
            fp.getForm().findField("nombre2").setValue("");
            fp.getForm().findField("apellido1").setValue("");
            fp.getForm().findField("apellido2").setValue("");
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
