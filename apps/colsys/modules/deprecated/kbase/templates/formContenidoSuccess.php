<?




?>

<div align="left" style="margin-left:30px;margin-right:30px;">
<h1>Administraci&oacute;n de la base de datos de conocimiento</h1>

<br />


<div id="formpanel"></div>
</div>

<script language="javascript" type="text/javascript">



var mainPanel = new Ext.FormPanel({
	labelAlign: 'top',
	frame: true,
	title: '<?=$kbase->getCaIdkbase()?"Editar contenido":"Nuevo contenido"?>',
	bodyStyle:'padding:5px 5px 0',
	
	items: [
	{
		xtype:'textfield',
		fieldLabel: 'Titulo',
		name: 'title',
		anchor:'95%',
		allowBlank: false
	},
			
	{
		xtype:'htmleditor',
		id:'text_id',
		name:'text',
		fieldLabel:'Descripción',
		height:200,
		anchor:'98%',
		enableFont: false, 
		enableFontSize: false,
		enableLinks:  false,
		enableSourceEdit : false,
		enableColors : false,
		 enableLists: false,  
		allowBlank: false
		 
	},
	{
			xtype:'hidden',			
			name: 'idkbase',
			value: '<?=$kbase->getCaIdkbase()?>',
			anchor:'95%'
		}
	],

	buttons: [{
		text: 'Guardar',
		handler: function(){
					
	            	if( mainPanel.getForm().isValid() ){
						
	            		mainPanel.getForm().submit({url:'<?=url_for('kbase/formContenidoGuardar')?>', 
	            							 	waitMsg:'Guardando ...',
												success:function(response,options){														
													
													document.location='<?=url_for("kbase/verContenido?id=")?>'+options.result.idkbase;
													
												},
	            							 	// standardSubmit: false, 												
		            							failure:function(response,options){							
													Ext.Msg.alert( "Error "+response.responseText );
												}//end failure block  
												
												
												    
											});
					}else{
						Ext.MessageBox.alert('Sistema de Tickets:', '¡Por favor complete los campos subrayados!');
					}	            	
	            }
	        }
		,
		{
			text: 'Cancelar',
			handler: function(){
					<?
					if( $kbase->getCaIdkbase() ){
					?>
						document.location='<?=url_for("kbase/verContenido?id=".$kbase->getCaIdkbase())?>';	
					<?
					}else{
					?>
						document.location='<?=url_for("kbase/index")?>';	
					<?
					}
					?>
	                     	
	            }
	    }
	]
});

mainPanel.render("formpanel");
form = mainPanel.getForm();	

form.findField("title").setValue('<?=$kbase->getCatitle()?>');

var text = '<?=str_replace("'", "\'", str_replace("\r", "", str_replace("\n", "<br />",$kbase->getCaText())))?>';
text = text.split("<br />").join("\n");

form.findField("text").setValue(text);


</script>