<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$initialYear = 2007;
$actualYear = date("Y");
$numYears = $actualYear-$initialYear+1;


$totals = array();
$counts = array();

?>
<div class="content" align="center">
    <table border="1" class="tableList" width="90%">
    <thead>
        <tr>
            <th rowspan="2">Nombre</th>
            <th rowspan="2">Fch. Aprobaci&oacute;n</th>
            <th rowspan="2">Estado Impo</th>
            <th rowspan="2">Estado Expo</th>
            <th rowspan="2">Vencimiento <br />Polizas</th>
            <th rowspan="2">Vencimiento <br />BASC</th>
            <th rowspan="2">Ciudad</th>
            <th rowspan="2">Critico</th>
            <th rowspan="2">Esporadico</th>
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
        $ultTipo=null;
        $ultTransporte=null;
        foreach($proveedores as $proovedor ){
            $ids = $proovedor->getIds();
            $sucursales = $ids->getIdsSucursal();
            if( $ultTipo!=$proovedor->getCaTipo() ){
                $ultTipo=$proovedor->getCaTipo();
                $tipo = $proovedor->getIdsTipo();
            ?>
            <tr class="row0">
                <td  colspan="<?=11+$numYears?>"><div align="left"><b><?=$tipo->getCaNombre()?></b></div></td>
            </tr>
            <?
            }

            if( $proovedor->getCaTipo()=="TRI"&&$ultTransporte!=$proovedor->getCaTransporte() ){
                $ultTransporte=$proovedor->getCaTransporte();

            ?>
            <tr class="row0">
                <td  colspan="<?=11+$numYears?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div align="left"><?=$proovedor->getCaTransporte()?$proovedor->getCaTransporte():"Sin definir"?></div></td>
            </tr>
            <?
            }
        ?>
        <tr>
            <td><div align="left"><?=link_to($ids->getCaNombre(), "ids/verIds?modo=prov&id=".$ids->getCaId())?></div></td>
            <td><div align="left"><?=Utils::fechaMes($proovedor->getCaFchaprobado())?></div></td>
            <td><div align="left"><?=$proovedor->getCaActivoImpo()?"Activo":"<span class='rojo'>Inactivo</span>"?></div></td>
            <td><div align="left"><?=$proovedor->getCaActivoExpo()?"Activo":"<span class='rojo'>Inactivo</span>"?></div></td>
            <td>
                <div align="left">
                    <?
                    $doc = $ids->getDocumento( 4 );
                    
                    if( $doc ){
                        if( $doc->getCaFchvencimiento() ){
                            echo Utils::fechaMes($doc->getCaFchvencimiento());
                        }else{
                            echo "Sin vencimiento";
                        }
                    }else{
                        echo "Sin Poliza";
                    }
                    ?>
                </div></td>
            <td><div align="left">
                    <?
                    $doc = $ids->getDocumento( 7 );
                    if( $doc ){
                        if( $doc->getCaFchvencimiento() ){
                            echo Utils::fechaMes($doc->getCaFchvencimiento());
                        }else{
                            echo "Sin venc.";
                        }
                    }else{
                        echo "Sin BASC";
                    }
                    ?>

                </div></td>
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
             <td><div align="center"><?=$proovedor->getCaEsporadico()?"X":""?></div></td>
            <?

            $evaluaciones = $ids->getCalificaciones();
            
            $evaluacionAnt=null;
            $evaluacionAct=null;
            $evaluacion = null;
            for( $year=$initialYear;$year<=$actualYear; $year++ ){
                
                $evaluacion = null;
                if( isset( $evaluaciones[$year] )){



                    $evaluacion = $evaluaciones[$year];
                    if(isset($evaluaciones[$year-1]) ){
                        $evaluacionAct = $evaluacion;
                        $evaluacionAnt = $evaluaciones[$year-1];
                    }else{
                        $evaluacionAct = null;
                        $evaluacionAnt = null;
                    }

                    if( !isset($totals[$year]) ){
                        $totals[$year] = 0;
                        $counts[$year] = 0;
                    }
                    $totals[$year]+= $evaluacion;
                    $counts[$year]++;
                }

                if( !$evaluacion && $year!=$actualYear){
                    $evaluacion = "N/A";
                }

                ?>
                <td><div align="left"><?=$evaluacion?$evaluacion:"&nbsp;"?></div></td>
                <?
            }
            ?>
            <td><div align="center"><?=$evaluacionAct&&$evaluacionAnt<$evaluacionAct?"X":"&nbsp;"?></div></td>
            <td><div align="center"><?=$evaluacionAct&&$evaluacionAnt==$evaluacionAct?"X":"&nbsp;"?></div></td>
            <td><div align="center"><?=$evaluacionAct&&$evaluacionAnt>$evaluacionAct?"X":"&nbsp;"?></div></td>
        </tr>
        <?
        }
        ?>

        <tr class="row0" >

            <td colspan="8"><b>Promedio</b></td>
            <?
            for( $year=$initialYear;$year<=$actualYear; $year++ ){
            ?>
            <td><div align="center"><b><?=isset($totals[$year])&&$counts[$year]>0?round($totals[$year]/$counts[$year],2):"&nbsp;"?></b></div></td>
            <?
            }
            ?>
            <td colspan="3">&nbsp;</td>
            
        </tr>
    </tbody>
</table>
</div>

