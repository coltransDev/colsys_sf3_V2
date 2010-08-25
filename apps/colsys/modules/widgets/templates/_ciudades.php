new Ext.form.ComboBox({		
		fieldLabel: '<?=$label?>',
		typeAhead: true,
		forceSelection: true,
		triggerAction: 'all',
		emptyText:'',
		selectOnFocus: true,	
		mode: 'local',				
		hiddenName: '<?=$id?>',
		id: '<?=$id?>_id',
		displayField: 'ciudad',
		valueField: 'idciudad',
		allowBlank: <?=$allowBlank?>,		
		lazyRender:true,
		listClass: 'x-combo-list-small',
		listeners:{focus:function( field, newVal, oldVal ){
                                                        
							<?
							if( isset($link) ){
							?>	
								ciudad = Ext.getCmp('<?=$id?>_id');
								var idpais = Ext.getCmp('<?=$link?>_id').hiddenField.value;
								ciudad.store.baseParams = {
									idpais: idpais
								};
								ciudad.store.reload();
							<?
							}
							?>
                                                        <?
							if( isset($value_link) ){
							?>
                                                            alert('<?=$value_link?>')
								var idpais = '<?=$value_link?>';
								ciudad.store.baseParams = {
									idpais: idpais
								};
								ciudad.store.reload();
							<?
							}
							?>
						  }
		},
		store : new Ext.data.Store({
			autoLoad : <?=isset( $idpais )?"true":"false"?>,
			url: '<?=url_for("widgets/datosCiudades")?>',
			reader: new Ext.data.JsonReader(
				{
					id: 'idciudad',
					root: 'root',
					totalProperty: 'total',
					successProperty: 'success'
				}, 
				Ext.data.Record.create([
					{name: 'idciudad'},
					{name: 'ciudad'}
				])
			)
			<?
			if(isset( $idpais )){
			?>			
			,
			baseParams: {	idpais: '<?=$idpais?>'	}
			<?
			}
			?>
						
		})
	})