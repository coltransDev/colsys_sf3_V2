<?
for($i=0; $i<$grupos['count'] ;$i++){
	//print_r($grupos);
	echo $grupos[$i]["cn"][0]."<br />";
}
?>
<script language="javascript">

var data = <?=json_encode(array("files"=>$data))?>;

var storeFileView = new Ext.data.JsonStore({	
	root: 'files',
	fields: ['idarchivo','name', 'descripcion', 'icon',{name:'size', type: 'float'}, {name:'lastmod', type:'date', dateFormat:'timestamp'}],
	proxy: new Ext.data.MemoryProxy(data),
	autoLoad:true 
});

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
						
			items: [{
				xtype: 'fileuploadfield',
				id: 'fileObj',
				width: 250,
				emptyText: 'Seleccione un archivo',
				fieldLabel: 'Archivo',
				hiddenName: 'file',
				name: 'fileObj',
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
					alert("En este momento no se puede subir el archivo");				
					fp.getForm().submit({
						url: '',							
						//waitMsg: 'Cargando el archivo...',
						success: function(fp, o){	
							storeFileView.reload();								
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
		
		frame:false,
		width:535,
		autoHeight:true,
		collapsible:true,
		layout:'fit',
		title:'Archivos',
		closable: true, 
		
		items: new Ext.DataView({
			store: storeFileView,
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
				for( var i=0;i< records.length; i++){				
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
				for( var i=0;i< records.length; i++){				
					if( confirm( 'Esta seguro que desea borrar el archivo seleccionado?') ){									
	
						Ext.Ajax.request({
							url: '<?=url_for("pricing/borrarArchivo")?>',
							params: {						
								idarchivo: records[i].data.idarchivo,
								id: records[i].id						
							},
							
							callback :function(options, success, response){	
								var res = Ext.util.JSON.decode( response.responseText );
								storeFileView.each(function(r){
									if(r.id==res.id){
										storeFileView.remove(r);
										Ext.Msg.alert("Success", "Se ha eliminado el archivo");										
									}
								});	
																							
							}
						});
					}
				}
					
			}
		}
	]
});
</script>