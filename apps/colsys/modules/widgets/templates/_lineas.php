<?
$url = "widgets/datosLineas";

if($noaprob){
    $url .= "?noaprob=true";
}
?>
new Ext.form.ComboBox({		
		fieldLabel: '<?=$label?>',
		typeAhead: true,
		forceSelection: true,
		triggerAction: 'all',
		emptyText:'',
		selectOnFocus: true,					
		hiddenName: '<?=$id?>',
		id: '<?=$id?>_id',
		displayField: 'linea',
		valueField: 'idlinea',
		allowBlank: <?=$allowBlank?>,
		minChars : 2,
		mode : 'local',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		width: 250,
		listeners:{focus:function( field, newVal, oldVal ){                            
							<?
							if( isset($link) ){
							?>	
								linea = Ext.getCmp('<?=$id?>_id');
								var transporte = Ext.getCmp('<?=$link?>').getValue();								
								linea.store.setBaseParam("transporte", transporte );
								linea.store.load();                                
							<?
							}
							?>
						  }
		},
		store : new Ext.data.Store({
			autoLoad : <?=isset( $idlinea )?"true":"false"?>,
			url: '<?=url_for($url)?>',
			reader: new Ext.data.JsonReader(
				{
					id: 'idlinea',
					root: 'root',
					totalProperty: 'total',
					successProperty: 'success'
				}, 
				Ext.data.Record.create([
					{name: 'idlinea'},
					{name: 'linea'}
				])
			)
			<?
			if(isset( $idlinea )){
			?>			
			,
			baseParams: {	idlinea: '<?=$idlinea?>'	}
			<?
			}
			?>
						
		})
	})