    <?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$grupos = $sf_data->getRaw("grupos");

?>
<script type="text/javascript">


WidgetMultiGrupos = function( config ){
    Ext.apply(this, config);

    this.store=new Ext.data.SimpleStore({
            fields: ['name'],
            data: <? print_r($grupos); ?>,
            sortInfo: {field: 'name', direction: 'ASC'}
        });    

    WidgetMultiGrupos.superclass.constructor.call(this, {            	        
	        xtype:'superboxselect',
	        fieldLabel: 'Grupos',
            valueField: 'name',
            displayField: 'name', 
	        resizable: true,	        
	        anchor:'100%',
	        mode: 'local'
    });
};


Ext.extend(WidgetMultiGrupos, Ext.ux.form.SuperBoxSelect, {
    
    
	
});

	
</script>