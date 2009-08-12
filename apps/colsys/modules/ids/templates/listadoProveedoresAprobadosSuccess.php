<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$initialYear = 2007;
$actualYear = date("Y");
$numYears = $actualYear-$initialYear+1;

?>
<div class="content" align="center">
    <table border="1" class="tableList">
    <thead>
        <tr>
            <th rowspan="2">Nombre</th>
            <th rowspan="2">Fch. Aprobaci&oacute;n</th>
            <th rowspan="2">Estado</th>
            <th rowspan="2">Vencimiento <br />Polizas</th>
            <th rowspan="2">Vencimiento <br />BASC</th>
            <th rowspan="2">Ciudad</th>
            <th rowspan="2">Critico</th>
            <th colspan="<?=$numYears?>">Evaluaci&oacute;n</th>
            <th colspan="3">Desempeño</th>
        </tr>
         <tr>
            <?
            for( $year=$initialYear;$year<=$actualYear; $year++ ){
            ?>
            <th><div align="center"><?=$year?></div></th>
            <?
            }
            ?>
            <th><div align="center">+</div></th>
            <th><div align="center">=</div></th>
            <th><div align="center">-</div></th>
        </tr>
    </thead>
    <tbody>
        <?
        foreach($proveedores as $proovedor ){
            $ids = $proovedor->getIds();
            $sucursales = $ids->getIdsSucursals();
        ?>
        <tr>
            <td><div align="left"><?=$ids->getcaNombre()?></div></td>
            <td><div align="left"><?=$proovedor->getCaFchaprobado()?></div></td>
            <td><div align="left"><?=$proovedor->getCaActivo()?"Activo":"Inactivo"?></div></td>
            <td><div align="left"></div></td>
            <td><div align="left"></div></td>
            <td>
                <div align="left">
                <?
                foreach( $sucursales as $sucursal ){
                    echo $sucursal->getCiudad()->getCaCiudad()." ";
                }
                ?>
                </div>
            </td>
            <td><div align="center"><?=$proovedor->getCaCritico()?"X":""?></div></td>
            <?
            $evaluacionAnt=null;
            $evaluacion=null;
            for( $year=$initialYear;$year<=$actualYear; $year++ ){
                $evaluacionAnt = $evaluacion;
                $evaluacion = $proovedor->getEvaluacionDesempeno( $year );
                ?>
                <td><div align="left"><?=$evaluacion?$evaluacion:"&nbsp;"?></div></td>
                <?
            }
            ?>
            <td><div align="center"><?=$evaluacionAnt&&$evaluacionAnt<$evaluacion?"X":"&nbsp;"?></div></td>
            <td><div align="center"><?=$evaluacionAnt&&$evaluacionAnt==$evaluacion?"X":"&nbsp;"?></div></td>
            <td><div align="center"><?=$evaluacionAnt&&$evaluacionAnt>$evaluacion?"X":"&nbsp;"?></div></td>
        </tr>
        <?
        }
        ?>
       
    </tbody>
</table>
</div>
