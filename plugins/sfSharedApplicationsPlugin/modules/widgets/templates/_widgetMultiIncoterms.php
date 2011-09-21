<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$incoterms = $sf_data->getRaw("incoterms");

?>
<script type="text/javascript">


WidgetMultiIncoterms = function( config ){
    Ext.apply(this, config);

    this.store=new Ext.data.SimpleStore({
            fields: ['valor'],
            data: <? print_r($incoterms); ?>,
            sortInfo: {field: 'valor', direction: 'ASC'}
        });    

    WidgetMultiIncoterms.superclass.constructor.call(this, {            	        
	        xtype:'superboxselect',
	        fieldLabel: 'Incoterms',
            valueField: 'valor',
            displayField: 'valor', 
	        resizable: true,	        
	        anchor:'100%',
	        mode: 'local'
    });
};


Ext.extend(WidgetMultiIncoterms, Ext.ux.form.SuperBoxSelect, {
    
    
	
});

	
</script>