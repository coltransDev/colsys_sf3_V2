<div align="center" >
<br />
<h3> Modulo de seguimiento de cotizaciones </h3>
<br />
<br />
</div>
<div align="center" id="container"></div>
<script language="javascript">
var tabs = new Ext.FormPanel({
	labelWidth: 75,
	border:true,
	fame:true,
	width: 450,
	standardSubmit: true,  
    id: 'formPanel',	
	items: {
		xtype: 'tabpanel',
		activeTab: 0,
		defaults:{autoHeight:true, bodyStyle:'padding:10px'},
		id: 'tab-panel', 
		items:[{
			title:'Consultas',
			layout:'form',			
			defaultType: 'textfield',
			id: 'consultas',

			items: [
			{
				xtype:'fieldset',
				checkboxToggle:true,
				title: 'Consulta por consecutivo',
				autoHeight:true,
				defaults: {width: 300},
				defaultType: 'textfield',
				collapsed: true,
				checkboxName: "checkboxConsecutivo", 
				items :[{
						fieldLabel: 'Consecutivo',
						name: 'consecutivo',
						allowBlank:true
						
					}
				]
			}
			,
			{
				xtype:'fieldset',
				checkboxToggle:true,
				title: 'Consulta por vendedor',
				autoHeight:true,
				defaults: {width: 300},
				defaultType: 'textfield',
				collapsed: true,
				checkboxName: "checkboxVendedor", 
				items :[new Ext.form.ComboBox({		
							fieldLabel: 'Vendedor',
							typeAhead: true,
							forceSelection: true,
							triggerAction: 'all',
							emptyText:'Seleccione',
							selectOnFocus: true,
							name: 'vendedor',
							hiddenName: 'login',
							id: 'vendedor',														
							valueField:'login',
							displayField:'nombre',
							mode: 'local',	
							listClass: 'x-combo-list-small',
							store :  new Ext.data.SimpleStore({
								fields: ['login', 'nombre'],
								data : [
									<?
									$i = 0;								
									foreach( $usuarios as $usuario ){
										if($i++!=0){
											echo ",";
										}
									?>
										['<?=$usuario->getCaLogin()?>', '<?=$usuario->getCaNombre()?>']
									<?
									}
									?>
									]
							})	
							
						})
				]
			}
			,
			{
				xtype:'fieldset',
				checkboxToggle:true,
				title: 'Consulta por sucursal',
				autoHeight:true,
				defaults: {width: 300},
				defaultType: 'textfield',
				collapsed: true,
				checkboxName: "checkboxSucursal", 
				items :[new Ext.form.ComboBox({		
							fieldLabel: 'Nombre',
							typeAhead: true,
							forceSelection: true,
							triggerAction: 'all',
							emptyText:'Seleccione',
							selectOnFocus: true,
							hiddenName: 'sucursal',
							id: 'sucursal_id',							
							lazyRender:true,
							listClass: 'x-combo-list-small',	
							store: [
								<?
								$i = 0;								
								foreach( $sucursales as $sucursal ){
									if($i++!=0){
										echo ",";
									}
								?>
									['<?=$sucursal->getCaIdsucursal()?>', '<?=$sucursal->getCaNombre()?>']
								<?
								}
								?>
								]
						})
				]
			}
			]
		},{
			title:'Estadisticas',
			layout:'form',			
			defaultType: 'textfield',
			id: 'estadisticas',
			items: [				
				{
					xtype:'datefield',
					checkboxToggle:true,
					fieldLabel: 'Fecha Inicial',
					autoHeight:true,
					name : 'fechaInicial',
					defaults: {width: 300},
					defaultType: 'textfield',
					collapsed: true,
					value: '<?=date("Y-m-")."01"?>',
					allowBlank: false		 
					
				},
				{
					xtype:'datefield',
					checkboxToggle:true,
					fieldLabel: 'Fecha final',
					autoHeight:true,
					name : 'fechaFinal',
					defaults: {width: 300},
					defaultType: 'textfield',
					collapsed: true,
					value: '<?=date("Y-m-d")?>',
					allowBlank: false					 
					
				},
				{
				xtype:'fieldset',
				checkboxToggle:true,
				title: 'Filtrar por vendedor',
				autoHeight:true,
				defaults: {width: 300},
				defaultType: 'textfield',
				collapsed: true,
				checkboxName: "checkboxVendedor", 
				items :[new Ext.form.ComboBox({		
							fieldLabel: 'Vendedor',
							typeAhead: true,
							forceSelection: true,
							triggerAction: 'all',
							emptyText:'Seleccione',
							selectOnFocus: true,
							name: 'vendedor',
							hiddenName: 'login',
																				
							valueField:'login',
							displayField:'nombre',
							mode: 'local',	
							listClass: 'x-combo-list-small',
							store :  new Ext.data.SimpleStore({
								fields: ['login', 'nombre'],
								data : [
									<?
									$i = 0;								
									foreach( $usuarios as $usuario ){
										if($i++!=0){
											echo ",";
										}
									?>
										['<?=$usuario->getCaLogin()?>', '<?=$usuario->getCaNombre()?>']
									<?
									}
									?>
									]
							})	
							
						})
				]
			}
			,
			{
				xtype:'fieldset',
				checkboxToggle:true,
				title: 'Filtrar por sucursal',
				autoHeight:true,
				defaults: {width: 300},
				defaultType: 'textfield',
				collapsed: true,
				checkboxName: "checkboxSucursal", 
				items :[new Ext.form.ComboBox({		
							fieldLabel: 'Nombre',
							typeAhead: true,
							forceSelection: true,
							triggerAction: 'all',
							emptyText:'Seleccione',
							selectOnFocus: true,
							name: 'sucursal',
													
							lazyRender:true,
							listClass: 'x-combo-list-small',	
							store: [
								<?
								$i = 0;								
								foreach( $sucursales as $sucursal ){
									if($i++!=0){
										echo ",";
									}
								?>
									['<?=$sucursal->getCaNombre()?>', '<?=$sucursal->getCaNombre()?>']
								<?
								}
								?>
								]
						})
				]
			}
			]
		}]
	},

	buttons: [{
		text: 'Continuar',
		handler: function(){
			var tp = Ext.getCmp("tab-panel");
						
			var owner=this.ownerCt;
			if( tp.getActiveTab().getId()=="consultas"){
				owner.getForm().getEl().dom.action='<?=url_for("cotseguimientos/listadoCotizaciones")?>';		}
			
			if( tp.getActiveTab().getId()=="estadisticas"){
				owner.getForm().getEl().dom.action='<?=url_for("cotseguimientos/estadisticas")?>';		}
				
			owner.getForm().submit();
		}
	}]
});

tabs.render("container");


</script>

