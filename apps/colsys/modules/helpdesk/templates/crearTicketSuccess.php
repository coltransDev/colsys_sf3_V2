<?
$ticket = $sf_data->getRaw("ticket");
$grupo = $ticket->getHdeskGroup();
$proyecto = $ticket->getHdeskProject();

?>

<div align="left" style="margin-left:30px;margin-right:30px;">
<h1>Crear un nuevo Ticket</h1>
<ul>
	<li>
    *  Cuando cree un nuevo ticket coloque un titulo descriptivo breve, y luego una descripci&oacute;n clara del problema. 
	<br />

	 </li>
	 <li>	 
	 * Siempre es bueno dar una forma  de <b>REPRODUCIR EL PROBLEMA</b><br />

	 </li>
	
		
</ul>		
<br />
<br />


<div id="formpanel"></div>
</div>

<script language="javascript" type="text/javascript">


var validarVigencia = function(){
	
	<?
	if( $nivel==0 || !$nivel  ){
	?>
	bloquearCampos();
	<?	
	}
	?>
}

var bloquearCampos = function(){
	
	Ext.getCmp('priority_id').setDisabled(true);	
	Ext.getCmp('type_id').setDisabled(true);
	Ext.getCmp('assignedto_id').setDisabled(true);
	Ext.getCmp('type_id').setDisabled(true);
	Ext.getCmp('actionTicket_id').setDisabled(true);
    Ext.getCmp('proyecto_id').setDisabled(true);
}



var dataDepartamentos = <?=json_encode(array("departamentos"=>$sf_data->getRaw("departamentos")))?>;

var departamentos = new Ext.form.ComboBox({		
	fieldLabel: 'Departamento',			
	typeAhead: true,
	forceSelection: true,
	triggerAction: 'all',
	emptyText:'',
	selectOnFocus: true,
	value: '', 					
	hiddenName: 'departamento', 
	id: 'departamento_id',	
	lazyRender:true,
	allowBlank: false,
	listClass: 'x-combo-list-small',	
	displayField: 'nombre',
	valueField: 'iddepartamento',
	
	store : new Ext.data.Store({
		autoLoad : true ,			
		proxy: new Ext.data.MemoryProxy( dataDepartamentos ),	
		reader: new Ext.data.JsonReader(
			{
				id: 'iddepartamento',
				root: 'departamentos'		
			}, 
			Ext.data.Record.create([
				{name: 'iddepartamento'},
				{name: 'nombre'}
			])			
		)									
	}),
	listeners:{select:function( field, record, index ){
						
						
						area = Ext.getCmp('area_id');
						
						area.store.baseParams = {
							departamento: record.data.iddepartamento
						};
						area.store.reload();
						
				  }
	}
	
});




var areas = new Ext.form.ComboBox({		
	fieldLabel: 'Área',			
	typeAhead: true,
	forceSelection: true,
	triggerAction: 'all',
	emptyText:'',
	selectOnFocus: true,
	value: '', 				
	id: 'area_id',	
	lazyRender:true,
	allowBlank: false,
	displayField: 'nombre',
	valueField: 'idgrupo',
	hiddenName: 'area', 
	listClass: 'x-combo-list-small',
	mode: 'local',	
	
	store : new Ext.data.Store({
		autoLoad : true ,
		url: '<?=url_for("helpdesk/datosAreas")?>',
		reader: new Ext.data.JsonReader(
			{
				id: 'idgrupo',
				root: 'grupos',
				totalProperty: 'total',
				successProperty: 'success'
			}, 
			Ext.data.Record.create([
				{name: 'idgrupo'},
				{name: 'nombre'}
			])
		)							
	}),	
	listeners:{select:function( field, record, index ){		
						proyecto = Ext.getCmp('proyecto_id');									
						proyecto.store.baseParams = {
							idgrupo: record.data.idgrupo
						};
						proyecto.store.reload();
						
						
						assignedto = Ext.getCmp('assignedto_id');											
						assignedto.store.baseParams = {
							idgrupo: record.data.idgrupo
						};
						assignedto.store.reload();
				  }
	}
	
});


var projectos = new Ext.form.ComboBox({		
	fieldLabel: 'Proyecto',			
	typeAhead: true,
	forceSelection: true,
	triggerAction: 'all',
	emptyText:'',
	selectOnFocus: true,
	value: '', 				
	id: 'proyecto_id',	
	lazyRender:true,
	allowBlank: true,
	displayField: 'nombre',
	valueField: 'idproyecto',
	hiddenName: 'project', 
	listClass: 'x-combo-list-small',	
	mode: 'local',
	
	store : new Ext.data.Store({
		autoLoad : true ,
		url: '<?=url_for("helpdesk/datosProyectos")?>',
		reader: new Ext.data.JsonReader(
			{
				id: 'idproyecto',
				root: 'proyectos',
				totalProperty: 'total',
				successProperty: 'success'
			}, 
			Ext.data.Record.create([
				{name: 'idproyecto'},
				{name: 'nombre'}
			])
		)							
	})
});



var asignaciones = new Ext.form.ComboBox({		
	fieldLabel: 'Asignado a',			
	typeAhead: true,
	forceSelection: true,
	triggerAction: 'all',
	emptyText:'',
	selectOnFocus: true,
	value: '', 				
	id: 'assignedto_id',	
	lazyRender:true,
	allowBlank: true,
	displayField: 'login',
	valueField: 'login',
	hiddenName: 'assignedto', 
	listClass: 'x-combo-list-small',	
	mode: 'local',
	<?
	if(  false ){
	?>
		disabled:true, 
	<?	
	}
	?>
	
	store : new Ext.data.Store({
		autoLoad : true ,
		url: '<?=url_for("helpdesk/datosAsignaciones")?>',
		reader: new Ext.data.JsonReader(
			{
				id: 'login',
				root: 'usuarios',
				totalProperty: 'total',
				successProperty: 'success'
			}, 
			Ext.data.Record.create([
				{name: 'login'}				
			])
		)							
	})
});


var prioridades = new Ext.form.ComboBox({		
	fieldLabel: 'Prioridad',			
	typeAhead: true,
	forceSelection: true,
	triggerAction: 'all',
	emptyText:'',
	selectOnFocus: true,
	value: 'Baja', 				
	name: 'priority',
	id: 'priority_id',	
	lazyRender:true,
	allowBlank: true,
	listClass: 'x-combo-list-small',	
	store : [			
				["Baja", "Baja"],
				["Media", "Media"],
				["Alta", "Alta"]			
			]
});


var tipos = new Ext.form.ComboBox({		
	fieldLabel: 'Tipo',			
	typeAhead: true,
	forceSelection: true,
	triggerAction: 'all',
	emptyText:'',
	selectOnFocus: true,
	value: 'Tarea', 				
	name: 'type',
	id: 'type_id',	
	lazyRender:true,
	allowBlank: true,
	listClass: 'x-combo-list-small',	
	store : [		
				["", ""],	
				["Tarea", "Tarea"],
				["Mejora", "Mejora"],
				["Defecto", "Defecto"],
				["Control", "Control"],
                ["Sugerencia", "Sugerencia"],
				["Invalido", "Invalido"]		
			]
});


var acciones = new Ext.form.ComboBox({		
	fieldLabel: 'Estado',			
	typeAhead: true,
	forceSelection: true,
	triggerAction: 'all',
	emptyText:'',
	selectOnFocus: true,
	value: 'Abierto', 				
	name: 'actionTicket',
	id: 'actionTicket_id',	
	lazyRender:true,
	allowBlank: true,
	listClass: 'x-combo-list-small',	
	store : [			
				["Abierto", "Abierto"],								
				["Cerrado", "Cerrado"]			
			]
});





var mainPanel = new Ext.FormPanel({
	labelAlign: 'top',
	frame: true,
	title: '<?=$ticket->getCaIdticket()?"Editar ticket":"Nuevo ticket"?>',
	bodyStyle:'padding:5px 5px 0',
	
	items: [{
		layout:'column',
		items:[{
			columnWidth:.5,
			layout: 'form',
			items: [
				departamentos, 
				projectos,
				tipos,
				asignaciones
			]
		},{
			columnWidth:.5,
			layout: 'form',
			items: [
				areas,
				prioridades,
				<?
				if( $ticket->getCaIdticket() ){
				?>
					acciones
				<?
				}else{
				?>				
				{
					xtype:'hidden',
					fieldLabel: 'Proyecto',
					name: 'proyecto',
					value: 'Abierto',
					anchor:'95%'
				}
				<?
				}
				?>
				
				
			
			]
		}]
	},
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
			name: 'idticket',
			value: '<?=$ticket->getcaIdticket()?>',
			anchor:'95%'
		}
	],

	buttons: [{
		text: 'Enviar',
		handler: function(){					
	            	if( mainPanel.getForm().isValid() ){						
	            		mainPanel.getForm().submit({url:'<?=url_for('helpdesk/formTicketGuardar')?>', 
	            							 	waitMsg:'Salvando Datos del ticket ...',
												success:function(response,options){														
													
													document.location='<?=url_for("helpdesk/verTicket?id=")?>'+options.result.idticket;
													
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
					if( $ticket->getCaIdticket() ){
					?>
						document.location='<?=url_for("helpdesk/verTicket?id=".$ticket->getCaIdticket())?>';	
					<?
					}else{
					?>
						document.location='<?=url_for("helpdesk/index")?>';	
					<?
					}
					?>
	                     	
	            }
	    }
	]
});

mainPanel.render("formpanel");

form = mainPanel.getForm();	
form.findField("title").setValue('<?=$ticket->getCaTitle()?>');

var text = '<?=str_replace("'", "\'", str_replace("\r", "", str_replace("\n", "<br />",$ticket->getCaText())))?>';
text = text.split("<br />").join("\n");

form.findField("text").setValue(text);
form.findField("assignedto").setValue('<?=$ticket->getCaAssignedto()?>');
<?
if( $ticket->getCaAction() ){
?>
	form.findField("actionTicket").setValue('<?=$ticket->getCaAction()?>');
<?
}
?>
form.findField("type").setValue('<?=$ticket->getCaType()?>');
form.findField("priority").setValue('<?=$ticket->getCaPriority()?>');
<?
if( $grupo ){
	$departamento = $grupo->getDepartamento();
?>
	form.findField("area").setValue('<?=$grupo->getCaName()?>');
	form.findField("area").hiddenField.value = '<?=$grupo->getCaIdgroup()?>';
	
	form.findField("departamento").setValue('<?=$departamento->getCaNombre()?>');
	form.findField("departamento").hiddenField.value = '<?=$departamento->getCaIddepartamento()?>';
	form.findField("area").store.baseParams = {
							departamento: '<?=$departamento->getCaIddepartamento()?>'
						};
	form.findField("area").store.reload();		
	
	proyecto = Ext.getCmp('proyecto_id');									
	proyecto.store.baseParams = {
		idgrupo: '<?=$grupo->getCaIdgroup()?>'
	};
	proyecto.store.load();	
	
	assignedto = Ext.getCmp('assignedto_id');											
	assignedto.store.baseParams = {
		idgrupo: '<?=$grupo->getCaIdgroup()?>'
	};
	assignedto.store.load();
	
	
<?
	
}

if( $proyecto ){
	?>
	form.findField("project").setValue('<?=$proyecto->getCaName()?>');
	form.findField("project").hiddenField.value = '<?=$proyecto->getCaIdproject()?>';
	
	<?
}
?>

validarVigencia();




</script>