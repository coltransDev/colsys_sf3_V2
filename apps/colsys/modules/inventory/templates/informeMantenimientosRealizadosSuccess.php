
<div align="center" id="container" ></div>

<?
include_component("inventory","filtrosMantenimientosRealizados");

if($opcion){
    
    
?>


<table width="70%" border="1"width="70%" class="tableList" align="center">
    <tr>
        <th>Activo #</th>
        <th>Categoría</th>
        <th>Marca #</th>
        <th>Modelo #</th>
        <th>Usuario</th>
        <th>Departamento</th>
        <th>Fecha Programación</th>
        <th>Fecha Mantenimiento</th>
        <th>Firma</th>
    <tr/>
<?
    foreach($mantenimientos as $mantenimiento){
        $cat = $mantenimiento->getInvActivo()->getInvCategory();
        $parent = $cat->getParent();
        
        $idactivo = $mantenimiento->getInvActivo()->getCaIdactivo();
        $idman = $mantenimiento->getCaIdmantenimiento();
        $usuario = $mantenimiento->getInvActivo()->getUsuario()->getCaNombre();
    
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
            <?=$mantenimiento->getInvActivo()->getCaPrgmantenimiento()?>
        </td>
        <td>
            <?=$mantenimiento->getCaFchmantenimiento()?>
        </td>
        <td>
            <?if($mantenimiento->getCaFirmado()==null){
                    ?>
                    <a href='https://localhost<?=url_for("inventory/guardarSeguimiento?chkmantenimiento-checkbox=on&recordatorio=si&idactivo=".$idactivo.'&idman='.$idman.'&idsucursal='.$idsucursal.'&mes_man='.$mes_man)?>'><img title="Enviar Recordatorio" alt="Enviar Recordatorio" src="https://www.coltrans.com.co/images/24x24/mailreminder.png" border="0"></a>
                    <?
                
            }else{
                echo $mantenimiento->getCaFirmado();
            }
?>
        </td>
    </tr>
    <?
    }
    ?>



<?
    }
?>