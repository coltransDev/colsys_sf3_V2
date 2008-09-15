[  

<?

$i=0;
foreach($grupos as $grupo){
	if( $i!=0){
		echo ",";
	}
?>
	{
    text:'<?=$grupo->getCaDescripcion()?>',	
    children:[
	<?
	$j=0;
	
	$c = new Criteria();
	$c->addAscendingOrderByColumn( TraficoPeer::CA_NOMBRE );	
	$traficos = $grupo->getTraficos( $c );
	foreach($traficos as $trafico ){	
			
		
		$c = new Criteria();
		$c->addJoin( TrayectoPeer::CA_ORIGEN, CiudadPeer::CA_IDCIUDAD );		
		$c->add( CiudadPeer::CA_IDTRAFICO, $trafico->getCaIdTrafico() );
		$c->add( TrayectoPeer::CA_TRANSPORTE, $transporte );
		$c->add( TrayectoPeer::CA_MODALIDAD, $modalidad );
		$c->addAscendingOrderByColumn( CiudadPeer::CA_CIUDAD );	 
		$c->setDistinct();	
		$ciudades = CiudadPeer::doSelect( $c );
		
		
		$c = new Criteria();
		
		$c->addJoin( TrayectoPeer::CA_ORIGEN, CiudadPeer::CA_IDCIUDAD );
		$c->addJoin( TrayectoPeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA );		
		$c->add( CiudadPeer::CA_IDTRAFICO, $trafico->getCaIdTrafico() );
		$c->add( TrayectoPeer::CA_TRANSPORTE, $transporte );
		$c->add( TrayectoPeer::CA_MODALIDAD, $modalidad );
		$c->addAscendingOrderByColumn( TransportadorPeer::CA_NOMBRE );
		$c->setDistinct();	
		$lineas = TransportadorPeer::doSelect( $c );
		
		if( count($lineas)>0 && count($ciudades)>0 ){
			if( $j++!=0 ){
				echo ",";
			}
	?>
		
	{
        text:'<?=$trafico->getCaNombre()?>',
        id:'<?=$transporte?>_<?=$modalidad?>_<?=$trafico->getCaIdTrafico()?>',		
        leaf:false,
		children:[
			
			{
				text:'Lineas',
				id:'linea_<?=$trafico->getCaIdTrafico()?>',	
				leaf:false,
				children:[
					<?
					$k=0;
					foreach( $lineas as $linea ){
						if( $k++!=0 ){
							echo ",";
						}
					?>
					{
						text:'<?=$linea->getCaNombre()?>',
						id:'<?=$transporte?>_<?=$modalidad?>_<?=$trafico->getCaIdTrafico()?>_linea_<?=$linea->getCaIdLinea()?>',		
						leaf:true
					}
					<?
					}
					?>
				]
			},
			<?
			
			?>
			{
				text:'Ciudades',
				id:'ciudades_<?=$trafico->getCaIdTrafico()?>',		
				leaf:false,
				children:[
					<?
					$k=0;
					foreach( $ciudades as $ciudad ){
						if( $k++!=0 ){
							echo ",";
						}
					?>
					{
						text:'<?=$ciudad->getCaCiudad()?>',
						id:'<?=$transporte?>_<?=$modalidad?>_<?=$trafico->getCaIdTrafico()?>_ciudad_<?=$ciudad->getCaIdCiudad()?>',		
						leaf:true
					}
					<?
					}
					?>
				]
			}			
		]
    }
	<?	
		}
	}
	?>
	]
}
<?
	$i++;
}
?>
]
<?
exit;
/*,
				children:[
					text:'Ciudades',
					id:'<?=$transporte?>_<?=$modalidad?>_<?=$trafico->getCaIdTrafico()?>_ciudades',		
					leaf:false,
					children:[
						<?
						/*foreach( $ciudades as $ciudad ){
						?>
						{
							text:'Ciudades',
							id:'<?=$transporte?>_<?=$modalidad?>_<?=$trafico->getCaIdTrafico()?>_<?=$ciudad->getCaIdCiudad()?>',		
							leaf:true
						}
						<?
						}*/
						?>
					]	
				]*/
?>