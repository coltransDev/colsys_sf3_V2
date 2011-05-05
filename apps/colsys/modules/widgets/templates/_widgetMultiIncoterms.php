<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$incoterms = $sf_data->getRaw("incoterms");

?>
<script type="text/javascript">

/*var sbs1 = new Ext.ux.form.SuperBoxSelect({
	        allowBlank:false,
	        id:'selector1',
	        xtype:'superboxselect',
	        fieldLabel: 'States',
	        emptyText: 'Select some US States',
	        resizable: true,
	        name: 'states',
	        anchor:'100%',
	        store: states,
	        mode: 'local',
	        displayField: 'state',
	        displayFieldTpl: '{state} ({abbr})',
	        valueField: 'abbr',
	        value: 'CA,NY',
	        forceSelection : true,
			allowQueryAll : false,
			listeners : {
		        render : function(sbs){
			        sbs.wrapEl.on('contextmenu', function(ev,h,o){
						ev.stopEvent();
						var rec = sbs.findSelectedRecord(h),
						    i = sbs.findSelectedItem(h),
							n = rec.get('abbr');
						var ctxMenu = new Ext.menu.Menu({
							items:[{
								text : 'Action 1 on ' + n 
							},
							{
                                text : 'Action 2 on ' + n
                            }]
						});
						ctxMenu.showAt([ev.getPageX(), ev.getPageY()]);
					},sbs,{
						delegate : 'li.x-superboxselect-item'
					});		
				}  	
		    }
	    });
*/


WidgetMultiIncoterms = function( config ){
    Ext.apply(this, config);
    
    this.store = new Ext.data.Store({
        autoLoad : true,
        reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'total',
                successProperty: 'success'
            },
            Ext.data.Record.create([
                {name: 'valor'}
            ])
        ),
        proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$incoterms, "total"=>count($incoterms), "success"=>true) )?> )
    });



    WidgetMultiIncoterms.superclass.constructor.call(this, {            	        
	        xtype:'superboxselect',
	        fieldLabel: 'Incoterms',
            valueField: 'valor',
            displayField: 'valor', 
	        resizable: true,	        
	        anchor:'100%',
	        mode: 'local',	       
            addNewDataOnBlur : true, 
	        forceSelection : true//,
			//allowQueryAll : false//,            
            //allowAddNewData: true
    });
};


Ext.extend(WidgetMultiIncoterms, Ext.ux.form.SuperBoxSelect, {
	
});

	
</script>