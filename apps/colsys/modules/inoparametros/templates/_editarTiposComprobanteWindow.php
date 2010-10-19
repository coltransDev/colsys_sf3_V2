<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("inoparametros", "editarTiposComprobantePropiedadesPanel");


?>

<script type="text/javascript">
EditarTiposComprobanteWindow = function( config ) {
    Ext.apply(this, config);
    this.ctxRecord = null;

    
    this.items = [
        new EditarTiposComprobantePropiedadesPanel({idTipoComprobante: this.idTipoComprobante,
                                             nivel: <?=isset($nivel)?$nivel:0?>,
                                             gridId: this.gridId,
                                             actionTipoComprobante: this.actionTipoComprobante,
                                             gridId: this.gridId,
                                             idtipo: this.idtipo
                                            })
    ];
    
    this.subpanel = new Ext.TabPanel({
       readOnly: this.readOnly,
       idTipoComprobante: this.idTipoComprobante,
       activeTab: 0,
       items: this.items
       
    });


    this.buttons = [
        {
            text: 'Enviar',
            handler: this.enviarTipoComprobante,
            scope: this
        },
        {
            text: 'Cancelar',
            handler: this.close.createDelegate(this, [])
        }
     ];

     if( this.idTipoComprobante ){
         var title = "Editar TipoComprobante";
     }else{
         var title = "Nuevo TipoComprobante";
     }

    EditarTiposComprobanteWindow.superclass.constructor.call(this, {
        title: title,
        id: 'editar-TipoComprobante-win',
        autoHeight: true,
        width: 800,
        //height: 400,
        resizable: false,
        plain:true,
        modal: true,        
        y: 100,
        autoScroll: true,
        closeAction: 'close',
        buttons: this.buttons,
        items: this.subpanel
    });

    this.addEvents({add:true});
}

Ext.extend(EditarTiposComprobanteWindow, Ext.Window, {
    
    enviarTipoComprobante: function(){
        var panel = Ext.getCmp("form-TipoComprobante-panel");
        panel.guardar();
        
    }

});

</script>