<?
use_helper( "Ext2" );
?>
/*
 * Ext JS Library 2.2.1
 * Copyright(c) 2006-2009, Ext JS, LLC.
 * licensing@extjs.com
 * 
 * http://extjs.com/license
 */

QueryPanel = function() {
    QueryPanel.superclass.constructor.call(this, {       
        region:'west',
        title:'Busqueda',
        split:true,
        width: 225,
        minSize: 175,
        maxSize: 400,
        collapsible: true,
        margins:'0 0 5 5',
        cmargins:'0 5 5 5',        
        lines:false,
        autoScroll:true,
        //root: new Ext.tree.TreeNode('Feed Viewer'),
		layout:'accordion',
		layoutConfig:{
			animate:true
		}
		,
		items: [
			<?=include_partial("FormPanelBusquedaCliente")?>
		]

       
    });

    /*this.feeds = this.root.appendChild(
        new Ext.tree.TreeNode({
            text:'My Feeds',
            cls:'feeds-node',
            expanded:true
        })
    );

    this.getSelectionModel().on({
        'beforeselect' : function(sm, node){
             return node.isLeaf();
        },
        'selectionchange' : function(sm, node){
            if(node){
                this.fireEvent('feedselect', node.attributes);
            }
            this.getTopToolbar().items.get('delete').setDisabled(!node);
        },
        scope:this
    });*/

   // this.addEvents({feedselect:true});

    this.on('contextmenu', this.onContextMenu, this);
};

Ext.extend(QueryPanel, Ext.Panel, {

   
				
});
