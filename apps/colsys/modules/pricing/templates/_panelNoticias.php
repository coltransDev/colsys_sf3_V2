<?
use_helper("Ext2");
?>
var myData = <?=json_encode( array("data"=>$data, "total"=>count($data)) )?>;

/*
* Crea el Record 
*/
var recordNoticias = Ext.data.Record.create([   			
	{name: 'idnotificacion', type: 'string'},
	{name: 'titulo', type: 'string'},
	{name: 'mensaje', type: 'string'},
	{name: 'caducidad', type: 'string'},
	{name: 'usucreado', type: 'string'},					
	{name: 'fchcreado', type: 'date', dateFormat:'Y-m-d h:i:s'}
	
]);
   		
/*
* Crea el store
*/

var storeNoticias = new Ext.data.GroupingStore({
	autoLoad : true,			
	//url: '<?=url_for("pricing/panelNoticiasData")?>',
	reader: new Ext.data.JsonReader(
		{
			id: 'idnotificacion',
			root: 'data',
			totalProperty: 'total',
			successProperty: 'success'
		}, 
		recordNoticias
	),
	proxy: new Ext.data.MemoryProxy( myData )		
	/*,
	sortInfo:{field: 'ciudad', direction: "ASC"}
	*/
	
});
	

/*
* Crea las columnas que van en la grilla, nuevas columnas se añaden dinamicamente
*/

var formatTitle = function(value, p, record) {
        return String.format(
			'<div class="topic"><b>{0}</b><br /><span class="author">{1}</span></div>',
			value, record.data.usucreado
		);
}

var formatDate = function(date) {	
	if (!date) {
		return '';
	}	
	
	var now = new Date();
	var d = now.clearTime(true);
	var notime = date.clearTime(true).getTime();
	if (notime == d.getTime()) {
		return 'Today ' + date.dateFormat('g:i a');
	}
	d = d.add('d', -6);
	if (d.getTime() <= notime) {
		return date.dateFormat('D g:i a');
	}
	return date.dateFormat('m/d/y g:i a');
}


var colModelNoticias = new Ext.grid.ColumnModel({		
	columns: [				
		{
			header: "Titulo",
			width: 220,
			sortable: true,		
			renderer: formatTitle,	
			dataIndex: 'titulo',
			id: 'titulo'   
		},
		{
			header: "Fecha",
			width: 80,
			sortable: true,	
			renderer: formatDate,			
			dataIndex: 'fchcreado'  
		}
						
		
	]	
});



/*
* Handlers de los eventos y botones de la grilla 
*/

/**
* Muestra una ventana donde se pueden editar las observaciones
**/
var gridOnclickHandler =  function(e) {	
	var btn = e.getTarget('.btnComentarios');        
	if (btn) {			
		var t = e.getTarget();
		var v = this.view;	
		var rowIdx = v.findRowIndex(t);
		var record = this.getStore().getAt(rowIdx);           
						
		activeRow = rowIdx;				
		Ext.MessageBox.show({
		   title: 'Observaciones',
		   msg: 'Por favor coloque las observaciones:',
		   width:300,
		   buttons: Ext.MessageBox.OKCANCEL,
		   multiline: true,
		   fn: actualizarObservaciones,
		   animEl: 'mb3',
		   value: record.get("observaciones")
	   });	
	}
}
	
/*
* Coloca las observaciones en pantalla y actualiza el datastore 
*/
var actualizarObservaciones=function( btn, text ){		
	if( btn=="ok" ){			
		var record = store.getAt(activeRow); 
		record.set("observaciones", text);
		
		document.getElementById("obs_"+record.get("_id")).innerHTML  = "<b>Observaciones:</b> "+text;		
	}
}	


var gridOnRowcontextmenu =  function(grid, index, e){
	<?
	if( $opcion!="consulta" ){ 
	?>
	var r = grid.store.getAt(index);	
	e.stopEvent(); //Evita que se despliegue el menu con el boton izquierdo
	
	this.menu = new Ext.menu.Menu({
		id:'grid-ctx',
		items: [
				{
					text: 'Editar',
					iconCls: 'page_white_edit',
					scope:this,
					handler: function(){   					                   		
						editarNoticia( r );									
					}
				},	
				{
				text: 'Eliminar',
				iconCls: 'delete',
				scope:this,
				handler: function(){    					                   
					//envia los datos al servidor 
					if( confirm("Desea continuar?") ){
						Ext.Ajax.request( 
							{   
								waitMsg: 'Eliminando...',						
								url: '<?=url_for("pricing/eliminarNotificacion")?>', 						//method: 'POST', 
								//Solamente se envian los cambios 						
								params :	{
									idnotificacion:r.data.idnotificacion 
								},
														
								//Ejecuta esta accion en caso de fallo
								//(404 error etc, ***NOT*** success=false)
								failure:function(response,options){							
									alert( response.responseText );						
									success = false;
								},
								//Ejecuta esta accion cuando el resultado es exitoso
								success:function(response,options){															
									grid.store.remove( r );
									Ext.MessageBox.alert("","Se ha eliminado correctamente");
								}
							 }
						); 	
					}		
				}
			}		
		]
	});
	//this.menu.on('hide', this.onContextHide, this);
		
	if(this.ctxRow){
		Ext.fly(this.ctxRow).removeClass('x-node-ctx');
		this.ctxRow = null;
	}
	this.ctxRecord = r;
	this.ctxRow = this.view.getRow(index);
	Ext.fly(this.ctxRow).addClass('x-node-ctx');
	this.menu.showAt(e.getXY());
	<?
	}
	?>
		
}

function ventanaEdicion( record ){
	win = new Ext.Window({		
		width       : 400,
		height      : 250,
		closeAction :'hide',
		plain       : true,		
		
		items       : new Ext.FormPanel({					
			id: 'noticias-form',			
			frame: true,
			title: 'Notificación',
			autoHeight: true,
			bodyStyle: 'padding: 10px 10px 0 10px;',
			labelWidth: 55, 			
			items: [  
				{
					xtype: 'hidden',					
					name: 'idnotificacion'					
				},
				{
					xtype: 'textfield',
					fieldLabel: 'Titulo',
					name: 'titulo',
					allowBlank:false,
					width: 270
				},
				new Ext.form.TextArea({
					fieldLabel: 'Mensaje',
					name: 'mensaje',
					allowBlank:false,
					width: 270
				}),
				new Ext.form.DateField({
					fieldLabel: 'Caducidad',
					name: 'caducidad',
					allowBlank:false
					
				})
			]
			
		}),

		buttons: [{
			text     : 'Crear',
			handler: function(){
				
				var fp = Ext.getCmp("noticias-form");	
				var idnotificacion = fp.getForm().findField("idnotificacion").getValue();
				var titulo = fp.getForm().findField("titulo").getValue();
				var mensaje = fp.getForm().findField("mensaje").getValue();
				var caducidad = Ext.util.Format.date( fp.getForm().findField("caducidad").getValue(), 'Y-m-d');
				
				if(fp.getForm().isValid()){
					
					//envia los datos al servidor 
					Ext.Ajax.request( 
						{   
							waitMsg: 'Guardando cambios...',						
							url: '<?=url_for("pricing/guardarNotificacion")?>', 						//method: 'POST', 
							//Solamente se envian los cambios 						
							params :	{ idnotificacion:idnotificacion,
										  titulo:titulo, 
										  mensaje:mensaje, 
										  caducidad:caducidad},
													
							//Ejecuta esta accion en caso de fallo
							//(404 error etc, ***NOT*** success=false)
							failure:function(response,options){							
								alert( response.responseText );						
								success = false;
							},
							//Ejecuta esta accion cuando el resultado es exitoso
							success:function(response,options){	
								var res = Ext.util.JSON.decode( response.responseText );	
								
								win.close();
								
								var rec = new recordNoticias(
									{titulo:res.titulo, mensaje:res.mensaje, caducidad:res.caducidad, idnotificacion:res.idnotificacion, fchcreado:res.fchcreado, usucreado:res.usucreado}
								);		
								
								var caducidad = Ext.util.Format.date( fp.getForm().findField("caducidad").getValue(), 'Y-m-d');
								
								rec = storeNoticias.getById(res.idnotificacion);
								if( !rec ){									
									var rec = new recordNoticias(
										{titulo:res.titulo, mensaje:res.mensaje, caducidad:res.caducidad, idnotificacion:res.idnotificacion, fchcreado:res.fchcreado, usucreado:res.usucreado}
									);
									rec.id = res.idnotificacion;
									records = [];
									records.push( rec );
									storeNoticias.insert( 0, records );
								}else{
									rec.set("titulo" , res.titulo);
									rec.set("mensaje" , res.mensaje);
									rec.set("caducidad" , res.caducidad);
									rec.set("titulo" , res.titulo);
									//rec.set("fchcreado" , res.fchcreado);
									rec.set("usucreado" , res.usucreado);	
									rec.commit();								
								}																	
							}
						 }
					); 
					
					
					
					
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
	
	if(typeof(record)!='undefined'){		
		var fp = Ext.getCmp("noticias-form");	
		fp.getForm().findField("idnotificacion").setValue(record.data.idnotificacion);
		fp.getForm().findField("titulo").setValue(record.data.titulo);
		fp.getForm().findField("mensaje").setValue(record.data.mensaje);
		fp.getForm().findField("caducidad").setValue(record.data.caducidad);
		
	}
	
	
}

function agregarNoticia(){	
	//crea una ventana 
	ventanaEdicion( );
}

function editarNoticia( rec ){	
	//crea una ventana 
	ventanaEdicion( rec );
}



var applyRowClass =  function(record, rowIndex, p, ds) {
	
	var xf = Ext.util.Format;
	p.body = xf.ellipsis(xf.stripTags(record.data.mensaje), 200) ;
	return 'x-grid3-row-expanded';	
}




		
/*
* Crea la grilla 
*/    

var gridNoticias = new Ext.grid.GridPanel({
	store: storeNoticias,	
	cm: colModelNoticias,		
	stripeRows: true,
	//autoExpandColumn: 'nconcepto',
	title: 'Notificaciones',
		
	closable: true,
	id: 'panel-noticias',
	height: 400,
	<?
	if( $opcion!="consulta"){
	?>
	tbar: [			  	
	{
		text: 'Agregar',
		tooltip: 'Crea un nueva notificación',
		iconCls:'add',  // reference to our css
		handler: agregarNoticia
	}
	],
	<?
	}
	?>
	
	viewConfig: {
		forceFit:true,
		enableRowBody:true,

		getRowClass : applyRowClass
	},

	/*
	bbar: new Ext.PagingToolbar({
		store: store,
		displayInfo: true,
		pageSize: 80
		
	}),*/
	listeners:{
		rowcontextmenu: gridOnRowcontextmenu,		
		click: gridOnclickHandler		
	}
	
});

gridNoticias.render('panel-noticias');

