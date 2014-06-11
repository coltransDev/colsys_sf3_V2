<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("pm", "editarTicketPropiedadesPanel");

$data = $sf_data->getRaw("data");
$status = $sf_data->getRaw("status");    
?>

<script type="text/javascript">
NuevaRespuestaWindow = function( config ) {
    Ext.apply(this, config);
    this.ctxRecord = null;
    //alert( this.vencimiento+" "+this.respuesta  );
    
    this.dataStatus = <?=json_encode(array("root" => $status))?>;
    
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
                                height:300,
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
                            },
                            {
                                xtype:'textfield',
                                name: 'motivo',
                                id: 'motivo',
                                value: '',
                                disabled: true,
                                anchor:'100%',
                                fieldLabel: "Observ. IDG"
                            },
                            new Ext.form.ComboBox({
                                fieldLabel: 'Status',
                                typeAhead: true,
                                forceSelection: true,
                                triggerAction: 'all',
                                emptyText:'',
                                selectOnFocus: true,
                                value: '',
                                id: 'status_id',
                                lazyRender: false,
                                allowBlank: true,
                                displayField: 'valor',
                                valueField: 'status',
                                hiddenName: 'status',
                                listClass: 'x-combo-list-small',
                                mode: 'local',

                                store : new Ext.data.Store({                
                                    autoLoad : true ,
                                    proxy: new Ext.data.MemoryProxy( this.dataStatus ),
                                    reader: new Ext.data.JsonReader(
                                    {

                                        root: 'root',
                                        totalProperty: 'total',
                                        successProperty: 'success'
                                    },
                                    Ext.data.Record.create([
                                        {name: 'status'},
                                        {name: 'valor'}
                                    ])
                                )
                                })
                            })
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
        tbar: [this.combo],
        listeners: {
            afterrender: this.onAfterRender
        }
    });

    

    
}

Ext.extend(NuevaRespuestaWindow, Ext.Window, {


    

    enviarRespuesta: function(){
        var panel = Ext.getCmp("respuesta-ticket-panel");       

        var form = panel.getForm();
        var win = this;

        var opener = this.opener;

        if( form.isValid() ){
            if( !this.respuesta && this.vencimiento<=new Date()){
                
                motivo = Ext.getCmp('motivo');
                motivo.setDisabled(false)
                if(motivo.getValue()=="")
                {
                    Ext.MessageBox.alert('Mensaje', 'El IDG ha sobrepasado el tiempo. Por favor indique la razón.');
                    return false;
                }          
                    
            }
            
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
    },    
    onAfterRender: function( cmp ){
        Ext.getCmp("status_id").setRawValue(this.status_name);
        Ext.getCmp("status_id").hiddenField.value = this.status;   
    }
    
    

});

</script>