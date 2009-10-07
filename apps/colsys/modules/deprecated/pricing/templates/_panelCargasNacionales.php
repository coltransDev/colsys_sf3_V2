new Ext.Panel({							
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
	 contentEl : 'listaArchivos'
						
	
})