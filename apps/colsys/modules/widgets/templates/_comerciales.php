


new Ext.form.ComboBox({		
			fieldLabel: '<?=$label?>',
			typeAhead: true,
			forceSelection: true,
			triggerAction: 'all',
			//emptyText:'Seleccione',
			selectOnFocus: true,					
			hiddenName: '<?=$id?>',
			id: '<?=$id?>_id',
			displayField: 'nombre',
			valueField: 'login',
			lazyRender:true,
			mode:'local',
			//allowBlank:false,
			listClass: 'x-combo-list-small',
			allowBlank: <?=$allowBlank?>,			
			disabled: <?=$user->getNivelAcceso()>0?"false":"true"?>,
			store : new Ext.data.Store({
				autoLoad : true,				
				reader: new Ext.data.JsonReader(
					{						
						root: 'root',
						totalProperty: 'total',
						successProperty: 'success'
					},					
					Ext.data.Record.create([
						{name: 'login'}, 
						{name: 'nombre'}
					])
				),
				proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$comercialesJson, "total"=>count($comercialesJson), "success"=>true) )?> )
			})
			
			,
			listeners:  {
				render  : function( cmp ){					
					cmp.setRawValue('<?=$nombre?>');
					cmp.hiddenField.value = '<?=$value?>';	
				}
			}
			
		})