
<div align="center" id="container" ></div>

<?
include_component("inventory","filtrosMantenimientosRealizados");

$nmes = $sf_data->getRaw("nmes");
$meses = $sf_data->getRaw("meses");

include_component("widgets","widgetSucursales");
include_component("widgets","widgetMultiDatos");


if($opcion){
?>


<table width="90%" border="1" class="tableList" align="center">
    <tr>
        <th>Activo #</th>
        <th>Categoría</th>
        <th>Marca #</th>
        <th>Modelo #</th>
        <th>Usuario</th>
        <th>Departamento</th>
        <th>Fecha Seguimiento</th>
        <th>Seguimiento</th>
        <th>Realizado Por</th>        
    <tr/>
<?
    foreach($seguimientos as $seguimiento){
        $cat = $seguimiento->getInvActivo()->getInvCategory();
        $parent = $cat->getParent();
        
        $idactivo = $seguimiento->getInvActivo()->getCaIdactivo();
        $idseg = $seguimiento->getCaIdseguimiento();
    
?>
    <tr>
        <td>
            <?=$seguimiento->getInvActivo()->getCaIdentificador()?>
        </td>
        <td>
            <?=$parent->getCaName()?>
        </td>
        <td>
            <?=$seguimiento->getInvActivo()->getCaMarca()?>
        </td>
        <td>
            <?=$seguimiento->getInvActivo()->getCaModelo()?>
        </td>
        <td>
            <?=$seguimiento->getInvActivo()->getUsuario()->getCaNombre()?>
        </td>
        <td>
            <?=$seguimiento->getInvActivo()->getUsuario()->getCaDepartamento()?>
        </td>
        <td>
            <?=$seguimiento->getCaFchcreado()?>
        </td>
        <td>
            <?=$seguimiento->getCaText()?>
        </td>
        <td>
            <?=$seguimiento->getUsuario()->getCaNombre()?>
        </td>        
    </tr>
    <?
    }
}
?>