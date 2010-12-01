<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


include_component("clariant", "panelNotasCab", array("clariant"=>$clariant) );
include_component("clariant", "panelNotasDet", array("clariant"=>$clariant) );

?>

<script type="text/javascript">

PanelNotas = function(){
    this.panelNotasCab = new PanelNotasCab();
    this.panelNotasDet = new PanelNotasDet();
    PanelNotas.superclass.constructor.call(this, {
                
        
        title: 'Notas',
        layout:'border',
        height: 300,
        frame:false,
        defaults: {
            collapsible: false,
            split: true,
            //bodyStyle: 'padding:15px'
        },
        items: [
        this.panelNotasDet,
        this.panelNotasCab
   ]

    });

};

Ext.extend(PanelNotas, Ext.Panel, {
    

});

</script>