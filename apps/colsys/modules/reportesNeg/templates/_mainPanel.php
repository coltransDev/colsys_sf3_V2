<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<script type="text/javascript">


MainPanel = function( config ){

    Ext.apply(this, config);


    MainPanel.superclass.constructor.call(this, {
        activeTab: 7,
        title: 'Reportes de Negocio'
    });


};

Ext.extend(MainPanel, Ext.TabPanel, {        


});

</script>