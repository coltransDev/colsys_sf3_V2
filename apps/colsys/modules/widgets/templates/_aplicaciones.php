new Ext.form.ComboBox({		
	fieldLabel: '<?=$label?>',			
	typeAhead: true,
	forceSelection: true,
	triggerAction: 'all',
	emptyText:'Seleccione',
	selectOnFocus: true,				
	name: '<?=$id?>',
	id: '<?=$id?>',	
	lazyRender:true,
	allowBlank: <?=$allowBlank?>,
	listClass: 'x-combo-list-small',	
	store : [
			<?
			$i=0;
			foreach( $aplicaciones as $aplicacion ){
				if( $i++!=0){
					echo ",";
				}
			?>
				['<?=$aplicacion->getCaValor()?>', '<?=$aplicacion->getCaValor()?>']
			<?
			}
			?>
		]
})


