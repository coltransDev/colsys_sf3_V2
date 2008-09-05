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
		if( $j++!=0 ){
			echo ",";
		}	
	?>
	{
        text:'<?=$trafico->getCaNombre()?>',
        id:'<?=$transporte?>_<?=$trafico->getCaIdTrafico()?>',
        leaf:true
    }
	<?	
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
?>