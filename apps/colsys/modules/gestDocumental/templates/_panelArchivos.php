<?
/*
* Panel de administracion de archivos del cada trafico
*/



if( !isset($dataUrl) ){
	use_helper("MimeType");
	foreach( $files as $key=>$file ){
	  
		$data[$key]['icon'] = mime_type_icon( $file['name'] , "32");
	} 
}

?>

var tplFileView = new Ext.XTemplate(
			'<tpl for=".">',
				
				'<div class="thumb-wrap" id="{name}">',
				'<div class="thumb">{icon}</div>',
				'<span class="x-editable">{name}</span></div>',
				
			'</tpl>',
			'<div class="x-clear"></div>'
		);

<?
if( !isset($dataUrl) ){
?>
var dataFileView = <?=json_encode(array("files"=>$files))?>;
<?
}
?>
var storeFileView = new Ext.data.JsonStore({	
	root: 'files',
	fields: ['idarchivo','name', 'descripcion', 'icon',{name:'size', type: 'float'}, {name:'lastmod', type:'date', dateFormat:'timestamp'}],
	<?
	if( !isset($dataUrl) ){
	?>
	proxy: new Ext.data.MemoryProxy(dataFileView),
	<?
	}else{
	?>
	url: '<?=url_for($dataUrl)?>', 
	<?
	}
	?>
	autoLoad:true 
});

var nuevoFileViewBtnHandler = function(){			
	win = new Ext.Window({
		//applyTo     : 'hello-win',
		//layout      : 'fit',
		width       : 400,
		height      : 200,
		closeAction :'close',
		plain       : true,		
		
		items       : new Ext.FormPanel({			
			fileUpload: true,					
			frame: true,
			title: 'Por favor seleccione un archivo',
			autoHeight: true,
			bodyStyle: 'padding: 10px 10px 0 10px;',
			labelWidth: 50,
			id: 'file-panel-form',	
			defaults: {
				anchor: '95%',
				allowBlank: false
				
			},		
			items: [{
				xtype: 'fileuploadfield',				
				id: 'file',
				width: 250,				
				fieldLabel: 'Archivo',
				emptyText: 'Seleccione un archivo',
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
						url: '<?=url_for( $uploadURL ) ?>',							
						//waitMsg: 'Cargando el archivo...',						
						success: function(fp, o){								
							<?
							//FIX-ME: En caso que la carga de archivos sea local no va a recargarse
							?>
							storeFileView.reload();															
							win.close();						
							Ext.Msg.alert('Success', 'El archivo "'+o.result.filename+'" se ha guardado en el servidor');																															
									
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



<?
//$object es el nombre del objeto con el que se nombrara este
//componente en js
echo (isset($object)&&$object)?"var ".$object." = ":"";
?>new Ext.Panel({
		<?
		if( $id ){
		?>
		id:'<?=$id?>',
		<?
		}
		?>
		frame:false,
		width:535,
		autoHeight:true,
		collapsible:true,
		layout:'fit',
		title:'<?=isset($title)?$title:"Archivos"?>',		
		closable: <?=(isset($closable)&&$closable)?"true":"false"?>, 
		
		items: new Ext.DataView({
			store: storeFileView,
			tpl: tplFileView,
			id: 'file-view',
			autoHeight:true,
			singleSelect : true,
			overClass:'x-view-over',
			itemSelector:'div.thumb-wrap',
			emptyText: 'No hay archivos',
					
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
		<?
		if( !$readOnly ){
		?>		  
		{
			text: 'Nuevo',
			tooltip: 'Sube un nuevo archivo',
			iconCls:'add',
			handler: nuevoFileViewBtnHandler
		}
		,
		<?
		}
		?>
		{
			text: 'Abrir',
			tooltip: 'Abre el archivo seleccionado',
			iconCls:'folder',  // reference to our css
			handler: function(){
				var fv = Ext.getCmp("file-view");	
				records =  fv.getSelectedRecords();			
				for( var i=0;i< records.length; i++){				
					popup( "<?=url_for($viewUrl)?>?idarchivo="+records[i].data.idarchivo );
				}
			}
		}
		<?
		if( !$readOnly ){
		?>	
		,
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
							url: '<?=url_for($deleteUrl)?>',
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
		<?
		}
		?>
		]
	});