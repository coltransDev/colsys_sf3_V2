<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<script type="text/javascript">
PorcentajeTicketWindow = function( config ) {
    Ext.apply(this, config);
        
   
    
    this.buttons = [
         {
            text: 'Cerrar',
            handler: this.close.createDelegate(this, [])
        }
     ];

     this.slider = new Ext.Slider({
                width: 214,
                increment: 1,
                value: this.percentage,
                minValue: 0,
                maxValue: 100,
                plugins: new Ext.slider.Tip(),
                idticket: this.idticket,
                rec: this.rec,
                listeners: {
                    changecomplete: this.updatePercent
                }
            });

    PorcentajeTicketWindow.superclass.constructor.call(this, {        
        //id: 'asignar-milestone-win',
        autoHeight: true,               
        plain:true,
        modal: true,
        y: 100,
        autoScroll: true,
        closeAction: 'close',
        buttons: this.buttons,
        buttonAlign: "center",
        items: this.slider
    });

    this.addEvents({add:true});
}

Ext.extend(PorcentajeTicketWindow, Ext.Window, {
    

    show : function(){
        if(this.rendered){
            //this.feedUrl.setValue('');
        }
        
        PorcentajeTicketWindow.superclass.show.apply(this, arguments);
    },

    updatePercent: function(   slider,  newValue ){
        var rec = this.rec;        
        var idticket = this.idticket;
        Ext.Ajax.request({
            url: '<?=url_for("pm/actualizarPorcentajeTicket")?>',
            method: 'POST',
            //Solamente se envian los cambios
            params :	{
                idticket: idticket,
                percentage: newValue
            },

            failure :function(options, success, response){

                alert("Ha ocurrido un error");
            },

            success :function(options, success, response){
                if( rec ){
                    rec.set("percentage", newValue);
                    rec.commit();
                }
            }
         }
        );
    }
    
});

</script>