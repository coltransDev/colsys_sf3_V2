
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
        <th>Fecha Programación</th>
        <th>Fecha Mantenimiento</th>
        <th>Realizado Por</th>
        <th>Firma</th>
    <tr/>
<?
    foreach($mantenimientos as $mantenimiento){
        $cat = $mantenimiento->getInvActivo()->getInvCategory();
        $parent = $cat->getParent();
        
        $idactivo = $mantenimiento->getInvActivo()->getCaIdactivo();
        $idman = $mantenimiento->getCaIdmantenimiento();
    
?>
    <tr>
        <td>
            <?=$mantenimiento->getInvActivo()->getCaIdentificador()?>
        </td>
        <td>
            <?=$parent->getCaName()?>
        </td>
        <td>
            <?=$mantenimiento->getInvActivo()->getCaMarca()?>
        </td>
        <td>
            <?=$mantenimiento->getInvActivo()->getCaModelo()?>
        </td>
        <td>
            <?=$mantenimiento->getInvActivo()->getUsuario()->getCaNombre()?>
        </td>
        <td>
            <?=$mantenimiento->getInvActivo()->getUsuario()->getCaDepartamento()?>
        </td>
        <td>
            <?=$mantenimiento->getCaFchprgmantenimiento()?>
        </td>
        <td>
            <?=$mantenimiento->getCaFchmantenimiento()?>
        </td>
        <td>
            <?=$mantenimiento->getUsuario()->getCaNombre()?>
        </td>
        <td>
            <?if($mantenimiento->getCaFirmado()==null){
                    ?>
                    <a href='https://www.colsys.com.co<?=url_for("inventory/guardarSeguimiento?chkmantenimiento-checkbox=on&recordatorio=si&idactivo=".$idactivo.'&idman='.$idman.'&idsucursal='.$idsucursal.'&mes_man='.$mes_man)?>'><img title="Enviar Recordatorio" alt="Enviar Recordatorio" src="https://www.colsys.com.co/images/24x24/mailreminder.png" border="0"></a>
                    <?
                
            }else{
                echo $mantenimiento->getCaFirmado();
            }
?>
        </td>
    </tr>
    <?
    }
}
?>