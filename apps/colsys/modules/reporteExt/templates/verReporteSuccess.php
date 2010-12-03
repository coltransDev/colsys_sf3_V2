<?
echo nl2br($introduccion);
?>
<br />

<?
if($reporte->setCaTiporep()>0)
{
    if( $reporte->getCaTransporte()==Constantes::MARITIMO ){
        include_component("reporteExt","reporteMaritimoExtNew", array("reporte"=>$reporte));
    }

    if( $reporte->getCaTransporte()==Constantes::AEREO ){
        include_component("reporteExt","reporteAereoExtNew", array("reporte"=>$reporte));
    }


}
else
{
    if( $reporte->getCaTransporte()==Constantes::MARITIMO ){
        include_component("reporteExt","reporteMaritimoExt", array("reporte"=>$reporte));
    }

    if( $reporte->getCaTransporte()==Constantes::AEREO ){
        include_component("reporteExt","reporteAereoExt", array("reporte"=>$reporte));
    }
}
?>

<br /><b>Shipping Instructions :</b><br />
<?=nl2br($instrucciones)?>
<br />
<b>Notes :</b><br />

 <?=nl2br($notas)?>

