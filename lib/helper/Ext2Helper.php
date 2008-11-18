<?
/*
* Este archivo contiene helpers de uso comun como por ejemplo selección de clientes, impo/expo, modalidad, etc..
*/



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

function extModalidad($id="modalidad", $transporte, $impoexpo){	
	$transporte_val = ((strpos($transporte, 'Ext.getCmp') === false)?"'".$transporte."'":$transporte.".getValue()");
	$impoexpo_val = ((strpos($impoexpo, 'Ext.getCmp') === false)?"'".$impoexpo."'":$impoexpo.".getValue()");
	
	$listeners = "listeners:{focus:function( field, newVal, oldVal ){
							modalidad = Ext.getCmp('$id');
							modalidad.store.baseParams = {transporte:$transporte_val,impoexpo:$impoexpo_val};
							modalidad.store.reload();
					  }
				 },"; 
	
    $baseparams = "baseParams:{transporte:$transporte_val,impoexpo:$impoexpo_val}";
	
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
		$listeners
		store : new Ext.data.Store({
			autoLoad : false,
			url: '".url_for("widgets/datosModalidades")."',
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
			),
			$baseparams
		})
	})";
	return $html;					
}



function extConcepto($id="concepto", $transporte, $modalidad=null){
	$transporte_val = ((strpos($transporte, 'Ext.getCmp') === false)?"'".$transporte."'":$transporte.".getValue()");
	$modalidad_val = ((strpos($modalidad, 'Ext.getCmp') === false)?"'".$modalidad."'":$modalidad.".getValue()");
	
	if (!is_null($modalidad)) {
		$listeners = "listeners:{focus:function( field, newVal, oldVal ){
								concepto = Ext.getCmp('$id');
								concepto.store.baseParams = {transporte:$transporte_val,modalidad:$modalidad_val};
								concepto.store.reload();
						  }
					 },"; 
	}else{
		$listeners = "";
	}
	
    $baseparams = "baseParams:{transporte:$transporte_val,modalidad:$modalidad_val}";
	
	$html = "new Ext.form.ComboBox({
		fieldLabel: '".ucfirst($id)."',			
		typeAhead: true,
		forceSelection: true,
		triggerAction: 'all',
		emptyText:'Seleccione',
		selectOnFocus: true,					
		hiddenName:'id$id',
		id: '$id',
		displayField: 'concepto',
		valueField: 'idconcepto',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		$listeners
		store : new Ext.data.Store({
			autoLoad : false,
			url: '".url_for("cotizaciones/datosConceptos")."',
			reader: new Ext.data.JsonReader(
				{
					id: 'idconcepto',
					root: 'root',
					totalProperty: 'total',
					successProperty: 'success'
				}, 
				Ext.data.Record.create([
					{name: 'idconcepto'},
					{name: 'concepto'}
				])
			),
			$baseparams
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
					value: 'Por Item', 
					lazyRender:true,
					listClass: 'x-combo-list-small',
					store: [['Por Item', 'Por Item'],['Puerto', 'Puerto'],['Concepto', 'Concepto'],['Trayecto', 'Trayecto']]
				})";
	return $html;					
}

function extOtmDta($id="otmdta"){		
	$html = "new Ext.form.ComboBox({		
					fieldLabel: 'Tipo',			
					typeAhead: true,
					forceSelection: true,
					triggerAction: 'all',
					emptyText:'Seleccione',
					selectOnFocus: true,					
					name: '$id',
					id: '$id',
					lazyRender:true,
					listClass: 'x-combo-list-small',
					store: [['OTM', 'OTM'],['DTA', 'DTA']]
				})";
	return $html;					
}

function extMonedas($id="idmoneda", $selected="USD"){
	$c=new Criteria();
	$c->addAscendingOrderByColumn( MonedaPeer::CA_IDMONEDA );
	$monedas = MonedaPeer::doSelect( $c );
	$html = "new Ext.form.ComboBox({
					id: '$id',
					fieldLabel: 'Moneda',			
					typeAhead: true,
					triggerAction: 'all',
					lazyRender:true,
					listClass: 'x-combo-list-small',
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

function extRecargos($tipo="Recargo Local",$selected=""){
	$html = "new Ext.form.ComboBox({
		fieldLabel: 'Recargo',			
		typeAhead: true,
		forceSelection: true,
		triggerAction: 'all',
		emptyText:'Seleccione',
		selectOnFocus: true,					
		hiddenName:'idrecargo',
		id: 'recargo',
		displayField: 'recargo',
		valueField: 'idrecargo',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		listeners:{focus:function( field, newVal, oldVal ){
								recargo = Ext.getCmp('recargo');
								recargo.store.baseParams = {transporte:Ext.getCmp('transporte').getValue(),tipo:'$tipo'};
								recargo.store.reload();
						  }
		},
		store : new Ext.data.Store({
			autoLoad : false,
			url: '".url_for("pricing/datosRecargos")."',
			reader: new Ext.data.JsonReader(
				{
					id: 'idrecargo',
					root: 'root',
					totalProperty: 'total',
					successProperty: 'success'
				}, 
				Ext.data.Record.create([
					{name: 'idrecargo'},
					{name: 'recargo'}
				])
			),
			baseParams:{transporte:Ext.getCmp('transporte').getValue(),tipo:'$tipo'}
		})
	})";
	return $html;
}

function extRecargosNoEnlazado($transporte, $selected=""){
	$html = "new Ext.form.ComboBox({
		fieldLabel: 'Recargo',
		typeAhead: true,
		triggerAction: 'all',
		//transform:'light',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		displayField: 'recargo',
		valueField: 'idrecargo',
		id: 'idrecargo',
		store : new Ext.data.Store({
			autoLoad : true,			
			url: '".url_for("pricing/datosRecargos?transporte=".utf8_encode($transporte))."',
			reader: new Ext.data.JsonReader(
				{
					id: 'idrecargo',
					root: 'root',
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


function extTipoRecargo($id="tiporecargo"){	
	$html = "new Ext.form.ComboBox({		
					fieldLabel: 'Tipo Recargo',			
					typeAhead: true,
					forceSelection: true,
					triggerAction: 'all',
					emptyText:'Seleccione',
					selectOnFocus: true,				
					name: '$id',
					id: '$id',
					lazyRender:true,
					listClass: 'x-combo-list-small',
					store: [['$', '$'],['%', '%']]
				})";
	return $html;					
}



function extAplicaciones($id="aplicacion"){	
	$html = "new Ext.form.ComboBox({		
					fieldLabel: 'Aplicación',			
					typeAhead: true,
					forceSelection: true,
					triggerAction: 'all',
					emptyText:'Seleccione',
					selectOnFocus: true,				
					name: '$id',
					id: '$id',
					displayField: 'aplicacion',
					valueField: 'aplicacion',
					lazyRender:true,
					listClass: 'x-combo-list-small',
					
					listeners:{focus:function( field, newVal, oldVal ){
											aplicacion = Ext.getCmp('$id');
											aplicacion.store.baseParams = {transporte:Ext.getCmp('transporte').getValue()};
											aplicacion.store.reload();
									  }
					},
					store : new Ext.data.Store({
						autoLoad : false,
						url: '".url_for("cotizaciones/datosAplicacion")."',
						reader: new Ext.data.JsonReader(
							{
								id: 'aplicacion',
								root: 'root',
								totalProperty: 'total',
								successProperty: 'success'
							}, 
							Ext.data.Record.create([
								{name: 'aplicacion'}
							])
						),
						baseParams:{transporte:Ext.getCmp('transporte').getValue()}
					})
					
				})";
	return $html;					
}



?>