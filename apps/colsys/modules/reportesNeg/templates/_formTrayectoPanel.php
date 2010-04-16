<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("widgets", "widgetImpoexpo");
include_component("widgets", "widgetTransporte");

?>
<script type="text/javascript">


FormTrayectoPanel = function( config ){

    Ext.apply(this, config);


    FormTrayectoPanel.superclass.constructor.call(this, {
        activeTab: 0,
        title: 'General',
        items: [{
				    layout:'table',
				    border: false,
				    defaults: {
				        // applied to each contained panel
				        bodyStyle:'padding-right:20px',
				        border: false
				    },
				    layoutConfig: {
				        // The total column count must be specified here
				        columns: 3
				    },
                    items: [{
		                layout: 'form',
		                items: [
                            new WidgetImpoexpo({fieldLabel: 'Clase'}),
                            new WidgetTransporte({fieldLabel: 'Transporte'})
                         ]
                    }]
             }]
    });

    


};

Ext.extend(FormTrayectoPanel, Ext.Panel, {


});

</script>