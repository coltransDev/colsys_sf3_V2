<?
/*
* Este archivo contiene helpers de uso comun como por ejemplo selección de clientes, impo/expo, modalidad, etc..
*/

function extImpoExpo($id="impoexpo"){	
	$html = "new Ext.form.ComboBox({		
					fieldLabel: 'Impo/Expo',
					typeAhead: true,
					forceSelection: true,
					triggerAction: 'all',
					emptyText:'Seleccione',
					selectOnFocus: true,
					name: '$id',
					id: '$id',
					value: 'Importación',
					lazyRender:true,
					listClass: 'x-combo-list-small',
					listeners:{change:function( field, newVal, oldVal ){
											tra_origen = Ext.getCmp('tra_origen');
											tra_origen.store.baseParams = {impoexpo:newVal,lugar:'origen'};
											tra_origen.store.reload();
											tra_destino = Ext.getCmp('tra_destino');
											tra_destino.store.baseParams = {impoexpo:newVal,lugar:'destino'};
											tra_destino.store.reload();					
									  }
					},
					store: [['Importación', 'Importación'],['Exportación', 'Exportación']],
				})";
	return $html;					
}

function extTransporte($id="transporte"){	
	$transportes =  ParametroPeer::retrieveByCaso( "CU063" );
	$html = "new Ext.form.ComboBox({
					fieldLabel: 'Transporte',
					typeAhead: true,
					forceSelection: true,
					triggerAction: 'all',
					emptyText:'Seleccione',
					selectOnFocus: true,	
					name: '$id',
					id: '$id',
					lazyRender:true,
					listClass: 'x-combo-list-small',
					store : [";
	$i=0;				
	foreach($transportes as $transporte){
		if($i++!=0){
			$html .= ",";
		}
		$html .= "['".$transporte->getCaValor()."','".$transporte->getCaValor()."']";
	}
	$html .=" ]})";
	return $html;
}

function extModalidad($id="modalidad"){	
	$html = "new Ext.form.ComboBox({
					fieldLabel: 'Modalidad',			
					typeAhead: true,
					forceSelection: true,
					triggerAction: 'all',
					emptyText:'Seleccione',
					selectOnFocus: true,	
					name: '$id',
					id: '$id',
					displayField: 'modalidad',
					valueField: 'modalidad',
					lazyRender:true,
					listClass: 'x-combo-list-small',
					listeners:{focus:function( modalidad ){
											modalidad.store.reload({params:{transporte:Ext.getCmp('transporte').getValue()}})					
									  }
					},
					store : new Ext.data.Store({
						autoLoad : false,
						url: '".url_for("cotizaciones/datosModalidades")."',
						reader: new Ext.data.JsonReader(
							{
								id: 'modalidad',
								root: 'root',
								totalProperty: 'total',
								successProperty: 'success'
							}, 
							Ext.data.Record.create([
								{name: 'modalidad'}  
							])
						)
					}),
				})";
	return $html;					
}

function extTraficos($lugar){
	$html = "new Ext.form.ComboBox({		
					fieldLabel: 'Tráfico ".ucfirst($lugar)."',
					typeAhead: true,
					forceSelection: true,
					triggerAction: 'all',
					emptyText:'Seleccione',
					selectOnFocus: true,					
					name: 'tra_$lugar',
					id: 'tra_$lugar',
					displayField: 'trafico',
					valueField: 'idtrafico',
					lazyRender:true,
					listClass: 'x-combo-list-small',
					store : new Ext.data.Store({
						autoLoad : false,
						url: '".url_for("cotizaciones/datosTraficos")."',
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
						baseParams:{impoexpo:Ext.getCmp('impoexpo').getValue(),lugar:'$lugar'}
					})
					
				}),";
	$html.= "new Ext.form.ComboBox({		
					fieldLabel: 'Ciudad ".ucfirst($lugar)."',
					typeAhead: true,
					forceSelection: true,
					triggerAction: 'all',
					emptyText:'Seleccione',
					selectOnFocus: true,					
					name: 'ciu_$lugar',
					id: 'ciu_$lugar',
					displayField: 'ciudad',
					valueField: 'idciudad',
					lazyRender:true,
					listClass: 'x-combo-list-small',
					listeners:{focus:function( field, newVal, oldVal ){
											ciudad = Ext.getCmp('ciu_$lugar');
											ciudad.store.baseParams = {trafico:Ext.getCmp('tra_$lugar').getValue(),lugar:'$lugar'};
											ciudad.store.reload();
									  }
					},
					store : new Ext.data.Store({
						autoLoad : false,
						url: '".url_for("cotizaciones/datosCiudades")."',
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
						),
						baseParams:{trafico:Ext.getCmp('tra_$lugar').getValue(),lugar:'$lugar'}
					})
				})";
	return $html;					
}

function extIncoterms($id="incoterms"){
	$incoterms =  ParametroPeer::retrieveByCaso( "CU062" );
	$html = "new Ext.form.ComboBox({
					fieldLabel: 'Incoterms',			
					typeAhead: true,
					forceSelection: true,
					triggerAction: 'all',
					emptyText:'Seleccione',
					selectOnFocus: true,					
					name: '$id',
					id: '$id',
					lazyRender:true,
					listClass: 'x-combo-list-small',
					store : [";
	$i=0;				
	foreach($incoterms as $incoterm){
		if($i++!=0){
			$html .= ",";
		}
		$html .= "['".$incoterm->getCaValor()."','".$incoterm->getCaValor()."']";
	}
	$html .=" ]})";
	return $html;
}

function extImprimir($id="imprimir"){	
	$html = "new Ext.form.ComboBox({		
					fieldLabel: 'Imprimir',			
					typeAhead: true,
					forceSelection: true,
					triggerAction: 'all',
					emptyText:'Seleccione',
					selectOnFocus: true,					
					name: '$id',
					id: '$id',
					lazyRender:true,
					listClass: 'x-combo-list-small',
					store: [['Por Item', 'Por Item'],['Puerto', 'Puerto'],['Concepto', 'Concepto'],['Trayecto', 'Trayecto']]
				})";
	return $html;					
}

function extMonedas($selected=""){
	$c=new Criteria();
	$c->addAscendingOrderByColumn( MonedaPeer::CA_IDMONEDA );
	$monedas = MonedaPeer::doSelect( $c );
	$html = "new Ext.form.ComboBox({
					typeAhead: true,
					triggerAction: 'all',
					//transform:'light',
					lazyRender:true,
					}{21234567listClass: 'x-combo-list-small',
					store : [";
	$i=0;				
	foreach( $monedas as $moneda ){
		if($i++!=0){
			$html .= ",";
		}
		$html .= "['".$moneda->getCaIdMoneda()."','".$moneda->getCaIdMoneda()."']";
	
	}
	
	$html .=" ]})";
	
	return $html;
}

function extRecargos($transporte, $selected=""){
	$html = "new Ext.form.ComboBox({
		typeAhead: true,
		triggerAction: 'all',
		//transform:'light',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		displayField: 'recargo',
		valueField: 'idrecargo',
		store : new Ext.data.Store({
			autoLoad : true,			
			url: '".url_for("pricing/datosRecargos?transporte=".utf8_encode($transporte))."',
			reader: new Ext.data.JsonReader(
				{
					id: 'idrecargo',
					root: 'recargos',
					totalProperty: 'total',
					successProperty: 'success'
				}, 
				Ext.data.Record.create([
					{name: 'idrecargo'},            
					{name: 'recargo'}  
				])
			)
		})		
	})";
	return $html;
}

?>