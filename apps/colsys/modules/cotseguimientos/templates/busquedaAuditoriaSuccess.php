<?
include_component("widgets", "widgetPais");
?>
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
	width: 650,    
	standardSubmit: true,  
    id: 'formPanel',	
	items: {
		xtype: 'tabpanel',
		activeTab: 0,
		defaults:{autoHeight:true, bodyStyle:'padding:10px'},
		id: 'tab-panel', 
		items:[{
			title:'Estadisticas',
			layout:'form',			
			defaultType: 'textfield',
			id: 'estadisticas',
            labelWidth: 75,
			items: [				
				{
					xtype:'datefield',					
					fieldLabel: 'Fecha Inicial',					
					name : 'fechaInicial',
                    format: 'Y-m-d',
					value: '<?=date("Y-m-")."01"?>'					
				},
				{
					xtype:'datefield',					
					fieldLabel: 'Fecha final',					
					name : 'fechaFinal',
                    format: 'Y-m-d',
					value: '<?=date("Y-m-d")?>'					
					
				},
                
                {
                    xtype:          'combo',
                    mode:           'local',
                    value:          '',
                    triggerAction:  'all',
                    forceSelection: true,
                    editable:       true,
                    fieldLabel:     'Estado',
                    name:           'estado',
                    hiddenName:     'est',
                    displayField:   'name',
                    valueField:     'value',                    
                    allowBlank:     true,
                    store:          new Ext.data.JsonStore({
                        fields : ['value','name'],
                        data   : [
                            {value: 'SIN', name : 'Sin Seguimientos'}
                            <?
                            foreach( $estados as $estado ){
                            ?>
                                ,{value: '<?=$estado->getCaValor()?>', name : '<?=$estado->getCaValor2()?>'}
                            <?
                            }
                            ?>                            
                        ]
                    })
                }
				
                <? 
                if($nivel=="0")
                {
                ?>
                				
				,{
				xtype:'fieldset',
				checkboxToggle:true,
				title: 'Filtrar por vendedor',
				autoHeight:true,
				labelWidth: 75,
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
							width: 200,
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
				
				defaultType: 'textfield',
				collapsed: true,
				checkboxName: "checkboxSucursal", 
				items :[
				
					new Ext.form.ComboBox({		
							fieldLabel: 'Nombre',
							typeAhead: true,
							forceSelection: true,
							triggerAction: 'all',
							emptyText:'Seleccione',
							selectOnFocus: true,							
							hiddenName: 'sucursal_est',
							width: 200,
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
<?
                }
                else
                {
?>
                    ,{
					xtype:'hidden',
					fieldLabel: 'Usuario',
					autoHeight:true,
					name : 'login',
					value: '<?=$vendedor?>',
                    readOnly :true
				}
<?
                }
?>
			]
		}]
	},

	buttons: [{
		text: 'Continuar',
		handler: function(){
			var tp = Ext.getCmp("tab-panel");
						
			var owner=Ext.getCmp("formPanel");
			/*if( tp.getActiveTab().getId()=="consultas"){
				owner.getForm().getEl().dom.action='<?=url_for("cotseguimientos/listadoCotizaciones")?>';		
            }*/
			
			if( tp.getActiveTab().getId()=="estadisticas"){
				owner.getForm().getEl().dom.action='<?=url_for("cotseguimientos/auditoria")?>';
            }
				
			owner.getForm().submit();
		}
	}]
});

tabs.render("container");


</script>

