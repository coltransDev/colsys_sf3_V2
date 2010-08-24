<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<script type="text/javascript">
EditarTareaPropiedadesPanel = function( config ) {
    Ext.apply(this, config);
    

    
    EditarTareaPropiedadesPanel.superclass.constructor.call(this, {
        title: 'Propiedades',
        //id: 'asignar-milestone-win',
        autoHeight: true,
        width: 500,
        height: 400,
        resizable: false,
        plain:true,
        modal: true,
        y: 100,
        autoScroll: true,
        closeAction: 'hide',
        
        items: [
            {
                xtype: 'textarea',
                width: 310,
                height: 40,
                fieldLabel: 'Texto',
                name: 'texto',
                value: '',
                allowBlank:true
            }
        ]
    });

    this.addEvents({add:true});
}

Ext.extend(EditarTareaPropiedadesPanel, Ext.FormPanel, {


    
});

</script>