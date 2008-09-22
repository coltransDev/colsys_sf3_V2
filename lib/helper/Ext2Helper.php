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

function extMonedas( $selected="" ){
	$c=new Criteria();
	$c->addAscendingOrderByColumn( MonedaPeer::CA_IDMONEDA );
	$monedas = MonedaPeer::doSelect( $c );
	$html = "new Ext.form.ComboBox({
					typeAhead: true,
					triggerAction: 'all',
					//transform:'light',
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

function extRecargos( $transporte, $selected="" ){

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