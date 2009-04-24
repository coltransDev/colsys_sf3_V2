/*
* Panel superior donde se muestra la lista de reportes
*/

PreviewPanel = function(viewer, config) {
    this.viewer = viewer;
    Ext.apply(this, config);
	
	
    PreviewPanel.superclass.constructor.call(this, {
       
        id: 'preview-panel',
        loadMask: {msg:'Cargando...'},
		id:'main-tabs',
        activeTab:0,
       
        margins:'0 5 5 0',
        resizeTabs:true,
        tabWidth:150,
        minTabWidth: 120,
        enableTabScroll: true,
		
		tbar: [{
				id:'tab',
				text: 'Ver en Nuevo Tab',
				iconCls: 'new-tab',
				disabled:true,
				handler : this.openTab,
				scope: this
			},
			'-',
			{
				id:'win',
				text: 'Nuevo Rep. al Ext',
				iconCls: 'new-win',
				disabled:true,
				scope: this,
				handler : function(){
					window.open(this.gsm.getSelected().data.link);
				}
			}],
		
		
   		items: [
			new Ext.Panel({
				id: 'preview-1',
				region: 'south',
				cls:'preview',
				autoScroll: true,
				listeners: TrackingViewer.LinkInterceptor,
				title: 'Información', 
				
		
				clear: function(){
				  /*  this.body.update('');
					var items = this.topToolbar.items;
					items.get('tab').disable();
					items.get('win').disable();*/
				}
			})
			/*{
                id:'bottom-preview',
                layout:'fit',
                items:MainPanel.preview,
                height: 250,
                split: true,
                border:false
               
            }*/
		]		
    });

    
};

Ext.extend(PreviewPanel, Ext.TabPanel );