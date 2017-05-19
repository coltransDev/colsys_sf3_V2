<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */?>
<style>
    .my-label-style {
        font-weight: bold;
        color: blue;
        font-size: 12px;        
        text-align:center;
    }
    
</style> 

<script type="text/javascript">
AgendarEntregasWindow = function( config ) {
    Ext.apply(this, config);
    this.ctxRecord = null;
    
    var ntickets = this.ticketval.split('|').join(' ,');
    
    this.items = [{
            xtype: 'form',
            id: "entregas-panel", 
            border: true,            
            bodyStyle:'padding:5px 5px 0',
            items: [
                {
                    xtype:'hidden',
                    name: 'ticketval',
                    value: this.ticketval
                },
                {
                    xtype:'fieldset',
                    columnWidth: 1,
                    title: 'Re-Asignacion Fechas de Entrega',
                    collapsible: false,
                    autoHeight:true,
                    items :[
                        {
                            xtype: 'spinnerfield',
                            fieldLabel: '<span><b>Días de Prórroga</b></span>',
                            name: 'dias',
                            id: 'dias',
                            minValue: 1,
                            maxValue: 365,
                            disabled: false,
                            decimalPrecision: 1,
                            width: 60,
                            incrementValue: 1,
                            accelerate: true,
                            allowBlank: false,
                        },
                        {
                            xtype:'htmleditor',
                            fieldLabel: '<span><b>Respuesta</b></span>',
                            name:'respuesta',
                            height: '100px',
                            enableLists: false,                            
                            enableFont: false,
                            enableFontSize: false,
                            enableLinks:  false,
                            enableSourceEdit : false,
                            enableColors : false,                            
                            anchor:'98%',
                            validateValue  : function() {
                                var val = this.getRawValue();                                
                                if(val.length<=0)
                                    return  false;
                                else
                                    return true;
                            }
                        },
                        {
                            xtype : 'label',
                            text : 'Modifica tickets: '+ ntickets,
                            width : 52.5,
                            height : 50,
                            boxMinHeight : 80,
                            border : true,
                            cls: 'my-label-style'
                        }
                    ]
                }]
            }]

    this.buttons = [
        {
            text: 'Enviar',
            handler: this.enviarTicket,
            scope: this
        },
        {
            text: 'Cancelar',
            handler: this.cerrar
        }
     ];

    AgendarEntregasWindow.superclass.constructor.call(this, {
        title: 'Agenda',
        id: 'agenda-ticket-win',
        autoHeight: true,
        width: 800,        
        resizable: false,
        plain:true,
        modal: true,        
        y: 100,
        autoScroll: true,
        closable: true,
        closeAction: 'close',
        buttons: this.buttons,
        items: this.items,
        onEsc: Ext.emptyFn
    });

    this.addEvents({add:true});
}

Ext.extend(AgendarEntregasWindow, Ext.Window, {
    
    enviarTicket: function(){
        var panel = Ext.getCmp("entregas-panel");
        var form = panel.getForm();
        var win = Ext.getCmp("agenda-ticket-win");        
        var grid = Ext.getCmp(this.idcomponent);        

        if(form.isValid()){
            form.submit({
                url: '<?=url_for("pm/agendarEntregas")?>',
                waitMsg: 'Guardando Respuesta para cada ticket...',                                    
                success:function(form,action){                    
                    var tickets = "";
                    if(action.result.data && action.result.data.length>0){
                        $.each(action.result.data, function( index, value ) {
                            tickets+=value+" ";
                        })
                        Ext.MessageBox.alert('Sistema de Tickets','El(los) Ticket(s) # '+tickets+" no tiene(n) entregas programadas");
                    }else{
                        Ext.MessageBox.alert('Sistema de Tickets','La(s) respuesta(s) se ha(n) guardado correctamente');
                    }
                    win.close();                    
                    grid.store.reload();
                },
                failure:function(form,action){
                    Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                }//end fail
            });
        }else{
            Ext.MessageBox.alert('Sistema de Tickets', "El formulario está incompleto o presenta errores, por favor verifique");
        }        
    },
    cerrar: function(){
        var win = Ext.getCmp("agenda-ticket-win");
        win.close();
    },
    show : function(){
        
        if(this.rendered){
            //this.feedUrl.setValue('');
        }
        
        AgendarEntregasWindow.superclass.show.apply(this, arguments);
    }
});

</script>