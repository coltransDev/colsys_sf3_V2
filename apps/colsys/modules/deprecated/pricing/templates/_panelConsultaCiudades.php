new Ext.tree.TreePanel({							
	title: '<?=$titulo?>',							
	split: true,
	height: 300,
	minSize: 150,
	autoScroll: true,
	
	// tree-specific configs:
	rootVisible: false,
	lines: false,
	singleExpand: true,
	useArrows: true,
	//iconCls:'settings',
	animate:true,	
						
	loader: new Ext.tree.TreeLoader({
		dataUrl:'<?=url_for("pricing/datosCiudades?transporte=".utf8_encode($transporte)."&impoexpo=".utf8_encode($impoexpo))?>'
	}),
	
	root: new Ext.tree.AsyncTreeNode()
	,
	listeners:  {
		 click : treePanelOnclickHandler
	}
})