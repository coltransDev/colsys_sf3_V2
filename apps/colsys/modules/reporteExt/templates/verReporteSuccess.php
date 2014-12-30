<?
echo nl2br($introduccion);
?>
<br />
<br /><b>Shipping Instructions :</b><br />

<?=nl2br($instrucciones)?>
<?
//echo $reporte->getCaTransporte();
//echo $reporte->getCaTiporep();
//echo "(11)".$hbltxt;
//            exit;
if( $reporte->getCaTransporte()==Constantes::MARITIMO || $reporte->getCaTransporte()==Constantes::TERRESTRE ){
//    echo $hbltxt;
//    exit;
    include_component("reporteExt","reporteMaritimoExtNew", array("reporte"=>$reporte,"layout"=>$layout,"hbltxt"=>$hbltxt));
}

if( $reporte->getCaTransporte()==Constantes::AEREO ){
    include_component("reporteExt","reporteAereoExtNew", array("reporte"=>$reporte));
}

?>

<br />
<b>Notes :</b><br />

 <?=nl2br($notas)?>

