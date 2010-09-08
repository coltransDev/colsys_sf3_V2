<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("pm", "editarTicketPropiedadesPanel");

$data = $sf_data->getRaw("data");
    
?>

<script type="text/javascript">
NuevaRespuestaWindow = function( config ) {
    Ext.apply(this, config);
    this.ctxRecord = null;


    this.combo = new Ext.form.ComboBox({
        fieldLabel: 'Mensaje',
        typeAhead: true,
        width: 600,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'Seleccione',
        selectOnFocus: true,
        lazyRender:true,
        displayField: 'texto',
		valueField: 'texto',
        listClass: 'x-combo-list-small',
        store : new Ext.data.Store({
				autoLoad : true,
				reader: new Ext.data.JsonReader(
					{
						root: 'root',
						totalProperty: 'total',
						successProperty: 'success'
					},
					Ext.data.Record.create([
						{name: 'texto'}
					])
				),
				proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$data, "success"=>true) )?> )
			})
        

    });
    this.combo.on("select", this.completarTextos);
    this.subpanel = new Ext.FormPanel({
                            id: "respuesta-ticket-panel",
                            url: '<?=url_for('pm/guardarRespuestaTicket')?>',
                            hideLabel: true,
                            items: [
                              {
                                xtype:'hidden',
                                name: 'idticket',
                                value: this.idticket
                              },
                              {
                                xtype:'hidden',
                                name: 'idresponse',
                                value: this.idresponse
                              },
                              {

                                xtype:'htmleditor',
                                name:'respuesta',
                                hideLabel: true,
                                height:450,
                                anchor:'100%',
                                enableFont: false,
                                enableFontSize: false,
                                enableLinks:  false,
                                enableSourceEdit : false,
                                enableColors : false,
                                enableLists: false,
                                allowBlank: false

                            },
                            {
                                xtype:'datefield',
                                name:'fchseguimiento',
                                fieldLabel: "Seguimiento",
                                format: "Y-m-d",
                                hideLabel: false,
                                enableFont: false,
                                enableFontSize: false,
                                enableLinks:  false,
                                enableSourceEdit : false,
                                enableColors : false,
                                enableLists: false,
                                allowBlank: true,
                                disabled: this.idresponse?true:false
                            }
                        ]
                    })


    this.buttons = [
        {
            text: 'Enviar',
            handler: this.enviarRespuesta,
            scope: this
        },
        {
            text: 'Cancelar',
            handler: this.close.createDelegate(this, [])
        }
     ];

     

    NuevaRespuestaWindow.superclass.constructor.call(this, {
        title: 'Nueva respuesta Ticket# '+this.idticket,
        id: "nueva-respuesta-ticket",
        autoHeight: true,
        width: 800,
        //height: 400,
        resizable: false,
        plain:true,
        //modal: true,
        y: 100,
        autoScroll: true,
        closeAction: 'close',
        buttons: this.buttons,
        items: this.subpanel,
        tbar: [this.combo]
    });

    this.addEvents({add:true});
}

Ext.extend(NuevaRespuestaWindow, Ext.Window, {


    show : function(){
        if(this.rendered){
            //this.feedUrl.setValue('');
        }

        //this.grid.store.setBaseParam( "idproject", this.idproject);
        //this.grid.store.load();

        NuevaRespuestaWindow.superclass.show.apply(this, arguments);
    },

    enviarRespuesta: function(){
        var panel = Ext.getCmp("respuesta-ticket-panel");       

        var form = panel.getForm();
        var win = this;

        var opener = this.opener;
        if( form.isValid() ){

            form.submit({
                success:function(form,action){

                    //Ext.Msg.alert( "Información" );
                    win.close();

                    if( opener ){
                        var cmp = Ext.getCmp(opener);
                        if( cmp ){
                            cmp.body.update(action.result.info);
                        }
                    }

                    Ext.MessageBox.alert('Mensaje', 'La respuesta se ha enviado correctamente');
                },
                // standardSubmit: false,
                failure:function(form,action){
                    Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                }//end failure block
            });
        }else{
            Ext.MessageBox.alert('Sistema de Tickets:', '¡Por favor complete los campos subrayados!');
        }
        
    },

    completarTextos: function(combo,  record, index){ // override default onSelect to do redirect	

        var panel = Ext.getCmp("respuesta-ticket-panel");
        var res = panel.getForm().findField("respuesta").getValue();
        panel.getForm().findField("respuesta").setValue(res+"\n<br />"+record.data.texto);
        combo.setValue("");
    }

});

</script>