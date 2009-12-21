<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */



?>
<script type="text/javascript">


FormComprobanteSubpanel = function(){


    this.panelConceptos = new FormComprobanteSubpanelConceptos();
    this.panelDeducciones = new FormComprobanteSubpanelDeducciones();

    FormComprobanteSubpanelConceptos.superclass.constructor.call(this, {
       labelAlign: 'top',
			bodyStyle:'padding:1px',

			items: [{
				xtype:'tabpanel',
				id: 'tpanel',
				plain:true,
				activeTab: 1,
				height:250,
				autoWidth : true,
				defaults:{bodyStyle:'padding:10px'},
				items:[
					this.panelConceptos,
                    this.panelDeducciones
				]
			}]

    });


};

Ext.extend(FormComprobanteSubpanel, Ext.FormPanel, {


});

</script>