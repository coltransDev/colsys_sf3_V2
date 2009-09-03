<div align="center">
<script language="javascript" type="text/javascript">
var cambiarCriterios = function( element ){
	if( element.value =="personalizada" ){
		document.getElementById("form1").style.display="none";
		document.getElementById("form2").style.display="inline";
	}else{
		document.getElementById("form2").style.display="none";
		document.getElementById("form1").style.display="inline";			
	}
}
	

	
</script>

<form action="<?=url_for("helpdesk/listaTickets")?>" method="post"> 
<table width="60%" border="1" class="tableList">
  <tr>
    <th colspan="3">Parametros de busqueda </th>
  </tr>
  <tr>
  	<td width="144" valign="top">
		<div align="center">
			<select name="opcion" id="opcion" size="4" onchange="cambiarCriterios(this)">
				<option value="numero" selected="selected">Numero de ticket</option>				
				<?
				if( $nivel>0 ){
				?>
				<option value="criterio">Busqueda general por palabra</option>								
				<option value="personalizada">Personalizada</option>
				<?
				}
				?>
			</select>
		</div></td>
  	<td width="317">
		<div id="form1" >
		Ingrese un criterio para realizar la consulta<br />
		<input type="text" name="criterio" />
			
		</div>
		<div id="form2" >
		<table width="100%" border="0">
		<tr>
			<td>Departamento</td>
			<td><input type="text" id="departamentoFld"  /></td>
		</tr>
		<tr>
			<td>Area</td>
			<td><input type="text" id="grupoFld" /></td>
		</tr>
		<tr>
			<td>Proyecto</td>
			<td><input type="text" id="proyectoFld"  /></td>
		</tr>
		<tr>
			<td>Prioridad</td>
			<td><input type="text" id="prioridadFld"></td>
		</tr>
		<tr>
			<td>Tipo</td>
			<td><input  type="text" id="tipoFld"></td>
		</tr>
		<tr>
			<td>Marca</td>
			<td><input  type="text" id="marcaFld" /></td>
		</tr>
		<tr>
			<td>Asignados a</td>
			<td><input  type="text" id="assignedtoFld" /></td>
		</tr>
		</table>
		</div>
	</td>
  	<td width="71"><div align="center">
  		<input name="submit" type="submit" value="Continuar" />
  		</div></td>
  	</tr>
</table>
</form>

<br />
<br />

<table width="60%" border="1" class="tableList">
	<tr>
		<th scope="col"><b>Busquedas predefinidas</b></th>
	</tr>
	
	<tr class="row0">
		<td><?=link_to("Tickets <b>reportados por mi","helpdesk/listaTickets?opcion=personalizada&reportedby=".$user->getUserId())?></b></td>
	</tr>
	<?
	if( $nivel>0 ){
	?>
	<tr class="row1">
		<td><?=link_to("Tickets <b>activos asignados a mi</b>","helpdesk/listaTickets?opcion=personalizada&assignedto=".$user->getUserId()."&actionTicket=Abierto")?></td>
	</tr>
	<tr class="row0">
		<td><?=link_to("Tickets <b>activos asignados a mi agrupados por proyecto</b>","helpdesk/listaTickets?opcion=personalizada&assignedto=".$user->getUserId()."&actionTicket=Abierto&groupby=project")?></td>
	</tr>
	<tr class="row1">
		<td><?=link_to("<b>Todos los tickets </b> de mis areas","helpdesk/listaTickets?opcion=group")?></td>
	</tr>
	<tr class="row0">
		<td><?=link_to("<b>Todos los tickets </b> de mis areas agrupados por proyecto","helpdesk/listaTickets?opcion=group&groupby=project")?></td>
	</tr>	
	<tr class="row1">
		<td><?=link_to("<b>Tickets asignados</b> de mis areas","helpdesk/listaTickets?opcion=group&assigned=true")?></td>
	</tr>
	<tr class="row0">
		<td><?=link_to("<b>Tickets sin asignar</b> de mis areas","helpdesk/listaTickets?opcion=group&assigned=false")?></td>
	</tr>
	<?
	}
	?>
	<!--<tr class="row0">
		<td>Tickets de mis areas con pronto vencimiento</td>
	</tr>
	<tr class="row1">
		<td>Tickets vencidos</td>
	</tr>
	<tr class="row0">
		<td>&nbsp;</td>
	</tr>-->
</table>

<h3>&nbsp;</h3>

</div>

<script language="javascript" type="text/javascript">
<?
if( $nivel>0 ){
?>		
var dataDepartamentos = <?=json_encode(array("departamentos"=>$departamentos))?>;

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
	allowBlank: true,
	listClass: 'x-combo-list-small',	
	displayField: 'nombre',
	valueField: 'iddepartamento',
	applyTo:"departamentoFld",
	
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
	allowBlank: true,
	displayField: 'nombre',
	valueField: 'idgrupo',
	hiddenName: 'area', 
	listClass: 'x-combo-list-small',
	applyTo: "grupoFld", 	
	mode : 'local',
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
	applyTo: "proyectoFld",	
	mode : 'local',	
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


var prioridades = new Ext.form.ComboBox({		
	fieldLabel: 'Prioridad',			
	typeAhead: true,
	forceSelection: true,
	triggerAction: 'all',
	emptyText:'',
	selectOnFocus: true,
	value: '', 				
	hiddenName: 'priority',
	id: 'priority_id',	
	lazyRender:true,
	allowBlank: true,
	applyTo: 'prioridadFld',
	listClass: 'x-combo-list-small',	
	store : [	
				["", ""],		
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
	value: '', 				
	hiddenName: 'type',
	id: 'type_id',	
	lazyRender:true,
	allowBlank: true,
	listClass: 'x-combo-list-small',	
	applyTo: 'tipoFld',
	store : [		
				["", ""],	
				["Tarea", "Tarea"],
				["Mejora", "Mejora"],
				["Defecto", "Defecto"]			
			]
});


var acciones = new Ext.form.ComboBox({		
	fieldLabel: 'Marca',			
	typeAhead: true,
	forceSelection: true,
	triggerAction: 'all',
	emptyText:'',
	selectOnFocus: true,
	value: '', 				
	hiddenName: 'actionTicket',
	id: 'actionTicket_id',	
	lazyRender:true,
	allowBlank: true,
	listClass: 'x-combo-list-small',
	applyTo: 'marcaFld',	
	store : [	
				["", ""],			
				["Nuevo", "Nuevo"],				
				["Invalido", "Invalido"],
				["Cerrado", "Cerrado"]			
			]
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
	applyTo: 'assignedtoFld',	
	mode : 'local',
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
<?
}
?>

cambiarCriterios(document.getElementById("opcion"));


</script>