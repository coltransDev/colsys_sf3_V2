<? 


?>



var store = new Ext.data.JsonStore({
    url: '<?=url_for("pricing/archivosPaisDatos?idtrafico=".$idtrafico)?>',
	root: 'files',
	fields: ['idarchivo','name', 'descripcion', 'icon',{name:'size', type: 'float'}, {name:'lastmod', type:'date', dateFormat:'timestamp'}],
	//proxy: new Ext.data.MemoryProxy(data)
});
store.load();

var tpl = new Ext.XTemplate(
	'<tpl for=".">',
		
		'<div class="thumb-wrap" id="{name}">',
		'<div class="thumb">{icon}</div>',
		'<span class="x-editable">{name}</span></div>',
		
	'</tpl>',
	'<div class="x-clear"></div>'
);

var nuevoBtnHandler = function(){
	win = new Ext.Window({
		//applyTo     : 'hello-win',
		//layout      : 'fit',
		width       : 400,
		height      : 200,
		closeAction :'close',
		plain       : true,		
		
		items       : new Ext.FormPanel({
			fileUpload: true,
			enctype:  'multipart/form-data',			
			id: 'file-panel-form',
			//width: 500,
			frame: true,
			title: 'Por favor seleccione un archivo',
			autoHeight: true,
			bodyStyle: 'padding: 10px 10px 0 10px;',
			labelWidth: 50, 
			
			/*
			defaults: {
				anchor: '95%',
				allowBlank: false,
				msgTarget: 'side'
			},*/
			items: [{
				xtype: 'fileuploadfield',
				id: 'form-file',
				emptyText: 'Seleccione un archivo',
				fieldLabel: 'Archivo',
				//hiddenName: 'file',
				name: 'file',
				buttonCfg: {
					text: '',
					iconCls: 'upload-icon'
				}
			}]
			
		}),

		buttons: [{
			text     : 'Guardar',
			handler: function(){
				var fp = Ext.getCmp("file-panel-form");					
				if(fp.getForm().isValid()){
					fp.getForm().submit({
						url: '<?=url_for("pricing/subirArchivo?idtrafico=".$idtrafico)?>',
						waitMsg: 'Cargando el archivo...',
						success: function(fp, o){	
							store.reload();								
							win.close();						
							Ext.Msg.alert('Success', 'El archivo "'+o.result.file+'" se ha guardado en el servidor');																															
									
						},
						failure: function(xhr){  
							Ext.Msg.alert('Error', 'Ha ocurrido un error al guardar el archivo');					
						}
					});
				}
			}
		},{
			text     : 'Cancelar',
			handler  : function(){
				win.close();
			}
		}]
	});
	
	win.show( );

}

new Ext.Panel({
	id:'file-panel-view',
	frame:false,
	width:535,
	autoHeight:true,
	collapsible:true,
	layout:'fit',
	title:'Archivos',
	
	items: new Ext.DataView({
		store: store,
		tpl: tpl,
		id: 'file-view',
		autoHeight:true,
		singleSelect : true,
		overClass:'x-view-over',
		itemSelector:'div.thumb-wrap',
		emptyText: 'No hay archivos en este tr&aacute;fico',
				
		/*
		plugins: [
			new Ext.DataView.DragSelector(),
			new Ext.DataView.LabelEditor({dataIndex: 'name'})
		],
		*/
		prepareData: function(data){
			data.shortName = Ext.util.Format.ellipsis(data.name, 15);
			data.sizeString = Ext.util.Format.fileSize(data.size);
			data.dateString = data.lastmod.format("m/d/Y g:i a");
			return data;
		},
		
		listeners: {
			selectionchange: {
				fn: function(dv,nodes){
					/*var l = nodes.length;
					var s = l != 1 ? 's' : '';
					panel.setTitle('Simple DataView ('+l+' item'+s+' selected)');*/
				}
			}
		}
	}),
	tbar: [			  
	{
		text: 'Nuevo',
		tooltip: 'Sube un nuevo archivo',
		iconCls:'add',
		handler: nuevoBtnHandler
	}
	,
	{
		text: 'Abrir',
		tooltip: 'Abre el archivo seleccionado',
		iconCls:'folder',  // reference to our css
		handler: function(){
			var fv = Ext.getCmp("file-view");	
			records =  fv.getSelectedRecords();			
			for( var i=0;i<records.length; i++){				
				popup( "<?=url_for("pricing/verArchivo")?>?idarchivo="+records[i].data.idarchivo );
			}
		}
	},
	{
		text: 'Borrar',
		tooltip: 'Elimina el archivo seleccionado',
		iconCls:'delete',  // reference to our css
		handler: function(){
			var fv = Ext.getCmp("file-view");	
			records =  fv.getSelectedRecords();			
			for( var i=0;i<records.length; i++){				
				if( confirm( 'Esta seguro que desea borrar el archivo seleccionado?') ){									
					Ext.Ajax.request({
						url: '<?=url_for("pricing/borrarArchivo")?>',
						params: {						
							idarchivo: records[i].data.idarchivo						
						},
						success: function(xhr) {	
							store.reload();	
							Ext.Msg.alert("Success", "Se ha eliminado el archivo");							
							
						},
						failure: function() {
							Ext.Msg.alert("Error", "No se ha podido eliminar el archivo");
						}
					});
				}
			}
				
		}
	}
	],
});


