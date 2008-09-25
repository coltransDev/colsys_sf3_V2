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
					name: '{$id}',
					store: [['Importación', 'Importación'],['Exportación', 'Exportación']]
				})";
	return $html;					
}

function extTransporte($id="transporte"){	
	$transportes =  ParametroPeer::retrieveByCaso( "CU063" );
	$html = "new Ext.form.ComboBox({
					typeAhead: true,
					fieldLabel: 'Transporte',
					triggerAction: 'all',
					//transform:'light',
					lazyRender:true,
					listClass: 'x-combo-list-small',
					listeners:{change:function( field, newVal, oldVal  ){
											modalidad = Ext.getCmp('modalidad');
											modalidad.store.reload({params:{transporte:newVal}})					
									  }
					},
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
					name: '{$id}',
					id: '{$id}',
					displayField: 'modalidad',
					valueField: 'modalidad',
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
					})		
					
				})";
	return $html;					
}

function extPuertos($impoexpo="Importación",$transporte="Aéreo",$lugar="origen"){	
	$html = "new Ext.form.ComboBox({		
					fieldLabel: 'Origen',
					typeAhead: true,
					forceSelection: true,
					triggerAction: 'all',
					emptyText:'Seleccione',
					selectOnFocus: true,					
					name: '{$id}',
					id: '{$id}',
					displayField: 'origen',
					valueField: 'idorigen',
					store : new Ext.data.Store({
						autoLoad : false,
						url: '".url_for("cotizaciones/datosPuertos")."',
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
					})		
					
				})";
	return $html;					
}

function extIncoterms($selected=""){
	$incoterms =  ParametroPeer::retrieveByCaso( "CU062" );
	$html = "new Ext.form.ComboBox({
					fieldLabel: 'Incoterms',			
					typeAhead: true,
					triggerAction: 'all',
					//transform:'light',
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
					name: '{$id}',
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