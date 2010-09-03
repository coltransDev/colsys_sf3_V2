<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
    
?>

<script type="text/javascript">
TooltipWindow = function() {
    this.idcategory=null;
    this.elemId=null;
    
    TooltipWindow.superclass.constructor.call(this, {
        title: 'Edicion de tooltips',
        id: 'tooltip-win',
        autoHeight: true,
        width: 450,
        
        resizable: true,
        plain:true,
        modal: true,
        y: 100,
        autoScroll: true,
        closeAction: 'hide',

        buttons:[
         {
            text: 'Guardar',
            handler: this.save,
            scope: this
         }
         ,
         {
            text: 'Cancel',
            handler: this.hide.createDelegate(this, [])
        }],

        items: new Ext.FormPanel({
            id: 'tooltip-form',
            layout: 'form',
            frame: true,
            title: 'Por favor ingrese los datos',
            autoHeight: true,
            bodyStyle: 'padding: 5px 5px 0 5px;',
            

            items: [{
                        xtype:'textfield',
                        name: 'titulo',
                        id: 'titulo',
                        width: 200,
                        fieldLabel: 'Titulo',
                        allowBlank:false
                    },{
                        xtype: 'textarea',
                        width: 250,
                        height: 150,
                        fieldLabel: 'Tooltip',
                        name: 'contenido',
                        id: 'contenido',
                        maxLength : 1000,
                        value: '',
                        allowBlank:false
                    }
                  ]
        })
    });

    this.addEvents({add:true});
}

Ext.extend(TooltipWindow, Ext.Window, {


    show : function(){        
        if( this.elemId ){
            if(this.rendered){
                //this.feedUrl.setValue('');
            }
            var fp = Ext.getCmp("tooltip-form");
            fp.getForm().findField("contenido").disable();
            fp.getForm().findField("titulo").disable();
            fp.getForm().findField("contenido").setValue("");
            fp.getForm().findField("titulo").setValue("");
            //this.grid.store.baseParams={ modalidades:this.ctxRecord.data.modalidades };
            //this.grid.store.load();

            TooltipWindow.superclass.show.apply(this, arguments);
        }
    },

    save: function() {
       

        var elemId = this.elemId;
        var fp = Ext.getCmp("tooltip-form");
        if( fp.getForm().isValid() ){

            
            fp.getForm().submit({
                url:'<?=url_for('kbase/guardarDatosTooltip')?>',
                waitMsg:'Guardando Datos...',
                // standardSubmit: false,
                params :	{
                    idcategory: this.idcategory,
                    elemId: this.elemId
                },  

                success:function(form,action){

                    
                    target = document.getElementById(elemId);
                    //alert( elemId+" "+ target );
                    if( target ){
                        if( target.className ){
                            target.className=target.className+" help";
                        }else{
                            target.className="help";
                        }
                        target.title=action.result.titulo+":<br />"+action.result.contenido;
                        $('.help').tooltip({track: true, fade: 250, opacity: 1, top: -15, extraClass: "pretty fancy" });
                    }
                    TooltipWindow.close();
                },
                failure:function(response,options){
                    Ext.Msg.alert( "Error "+response.responseText );
                    TooltipWindow.close();
                }//end failure block
            });

            this.hide();
        }        
    },

    load: function( elemId ){
        
        Ext.Ajax.request( 
			{   
				waitMsg: 'Cargando...',						
				url: '<?=url_for("kbase/cargarDatosTooltip")?>',
                method: 'POST',
				//Solamente se envian los cambios 						
				params :	{
                    idcategory: this.idcategory,
                    elemId: this.elemId
                },  
										
				callback :function(options, success, response){	
										
					var res = Ext.util.JSON.decode( response.responseText );


					if( res.success ){
                        var fp = Ext.getCmp("tooltip-form");
                        fp.getForm().findField("contenido").setValue(res.contenido);
                        fp.getForm().findField("titulo").setValue(res.titulo);
                        fp.getForm().findField("contenido").enable();
                        fp.getForm().findField("titulo").enable();
                        
					}
				}	
			 }
		);        

    },

    setIdcategory: function( val ){
        this.idcategory = val;
    },

    setElemid: function( val ){
        this.elemId = val;
    }
});
</script>