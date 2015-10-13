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
UnificarTicketsWindow = function( config ) {
    Ext.apply(this, config);
    this.ctxRecord = null;
    
    //var ntickets = this.ticketval.split('|').join(' ,');
    var datosTickets = [];
    
    for(var i=0; i<this.tickets.length;i++){                                  
        var series_name = this.tickets[i];
        var series_value = this.tickets[i]+" "+this.titulos[i];
        
        var series = [
            series_name,
            series_value
        ];
        datosTickets.push(series);                                  
    }
    
    this.items = [{
            xtype: 'form',
            id: "unificacion-panel", 
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
                            xtype:          'combo',
                            mode:           'local',
                            //value:          '<?//=$aa?>',
                            triggerAction:  'all',
                            forceSelection: true,
                            editable:       true,
                            fieldLabel:     'Elija Ticket Principal',
                            name:           'idticket',
                            hiddenName:     'idticket',
                            displayField:   'value',
                            valueField:     'name',
                            allowBlank:     false,
                            width: 400,
                            store: new Ext.data.ArrayStore({
                                fields : ['name', 'value'],
                                data   : datosTickets                                        
                            })
                        }
                    ]
                }]
            }]

    this.buttons = [
        {
            text: 'Enviar',
            handler: this.unificarTicket,
            scope: this
        },
        {
            text: 'Cancelar',
            handler: this.cerrar
        }
     ];

    UnificarTicketsWindow.superclass.constructor.call(this, {
        title: 'Unificar Tickets',
        id: 'unifica-ticket-win',
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

Ext.extend(UnificarTicketsWindow, Ext.Window, {
    
    unificarTicket: function(){
        var panel = Ext.getCmp("unificacion-panel");
        var form = panel.getForm();
        var win = Ext.getCmp("unifica-ticket-win");        
        var grid = Ext.getCmp(this.idcomponent);        

        if(form.isValid()){
            form.submit({
                url: '<?=url_for("pm/unificarTickets")?>',
                waitMsg: 'Guardando Respuesta para cada ticket...',                                    
                success:function(form,action){
                    win.close(); 
                    win.destroy(); 
                    grid.store.reload();
                    Ext.MessageBox.alert('Sistema de Tickets','La(s) respuesta(s) se ha(n) guardado correctamente');
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
        var win = Ext.getCmp("unifica-ticket-win");
        win.close();
    },
    show : function(){
        
        if(this.rendered){
            //this.feedUrl.setValue('');
        }
        
        UnificarTicketsWindow.superclass.show.apply(this, arguments);
    }
});

</script>