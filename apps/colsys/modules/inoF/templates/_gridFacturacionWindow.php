<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("inoF", "gridFacturacionFormPanel");


?>
<script type="text/javascript">
    GridFacturacionWindow = function( config ) {
        Ext.apply(this, config);
        this.ctxRecord = null;
        
        

        this.items = [
            new GridFacturacionFormPanel({
                gridId: this.gridId,
                idcomprobante: this.idcomprobante,
                modo:this.modo,
                idhouse: this.idhouse,
                impoexpo: this.impoexpo,
                transporte: this.transporte, 
                modalidad: this.modalidad 
            })
        ];
        
        
        
        GridFacturacionWindow.superclass.constructor.call(this, {
            title: "Formulario de Facturación",
            autoHeight: true,
            width: 600,
            //height: 400,
            resizable: false,
            plain:true,
            modal: true,
            y: 100,
            autoScroll: true,
            closeAction: 'close',
            id: 'edit-factura-win',
            
            items: this.items
        
        });

        this.addEvents({add:true});
    }

    Ext.extend(GridFacturacionWindow, Ext.Window, {

       



    });

</script>
