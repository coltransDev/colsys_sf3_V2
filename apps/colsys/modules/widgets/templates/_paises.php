


new Ext.form.ComboBox({		
			fieldLabel: '<?=$label?>',
			typeAhead: true,
			forceSelection: true,
			triggerAction: 'all',
			emptyText:'Seleccione',
			selectOnFocus: true,					
			hiddenName: '<?=$id?>',
			id: '<?=$id?>_id',
			displayField: 'trafico',
			valueField: 'idtrafico',
			lazyRender:true,
			//allowBlank:false,
			listClass: 'x-combo-list-small',
			allowBlank: <?=$allowBlank?>,
			store : new Ext.data.Store({
				autoLoad : true,
				//url: '<?=url_for("widgets/datosPaises")?>',
				reader: new Ext.data.JsonReader(
					{
						id: 'idtrafico',
						root: 'root',
						totalProperty: 'total',
						successProperty: 'success'
					},					
					Ext.data.Record.create([
						{name: 'idtrafico'}, 
						{name: 'trafico'}
					])
				),
				proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$traficos, "total"=>count($traficos), "success"=>true) )?> )
			})
		})