<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$initialYear = date("Y")-2;
$actualYear = date("Y");
$numYears = 0;

for( $year=$initialYear;$year<=$actualYear; $year++ ){
    if( $year<2011 ){
        $numYears++;
    }else{
        $numYears+=2;
    }  
}

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
            <th colspan="<?=$numYears?>">Evaluaci&oacute;n</th>
            <th colspan="3">Desempeño</th>
        </tr>
         <tr>
            <?
            for( $year=$initialYear;$year<=$actualYear; $year++ ){
                if( $year<2011 ){
                    ?>
                    <th><div align="center"><?=$year?></div></th>
                    <?
                }else{
                    ?>
                    <th><div align="center"><?=$year?>/1</div></th>
                    <th><div align="center"><?=$year?>/2</div></th>
                    <?
                }
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
                <td  colspan="<?=12+$numYears?>"><div align="left"><b><?=$tipo->getCaNombre()?></b></div></td>
            </tr>
            <?
            }

            if( $proovedor->getCaTipo()=="TRI"&&$ultTransporte!=$proovedor->getCaTransporte() ){
                $ultTransporte=$proovedor->getCaTransporte();

            ?>
            <tr class="row0">
                <td  colspan="<?=12+$numYears?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div align="left"><?=$proovedor->getCaTransporte()?$proovedor->getCaTransporte():"Sin definir"?></div></td>
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
            <?

            $evaluaciones = $ids->getCalificaciones();
            
            $evaluacionAnt=null;
            $evaluacionAct=null;
            $evaluacion = null;
            $lastEval2 = null;
            for( $year=$initialYear;$year<=$actualYear; $year++ ){
                
                $evaluacion = null;
                $evaluacion1 = null;
                $evaluacion2 = null;
              
                if( isset( $evaluaciones[$year])){

                    if( $year>=2011 ){
                        $evaluacion1 = isset($evaluaciones[$year][1])?$evaluaciones[$year][1]:"";
                        $evaluacion2 = isset($evaluaciones[$year][2])?$evaluaciones[$year][2]:"";
                        
                        if( !isset($totals[$year."_1"]) ){
                            $totals[$year."_1"] = 0;
                            $counts[$year."_1"] = 0;                            
                        }
                        if( !isset($totals[$year."_2"]) ){
                            $totals[$year."_2"] = 0;
                            $counts[$year."_2"] = 0;                            
                        }
                        
                        if( isset($evaluaciones[$year][1]) ){
                            $totals[$year."_1"]+= $evaluaciones[$year][1];
                            $counts[$year."_1"]++;
                        }
                        if( isset($evaluaciones[$year][2]) ){
                            $totals[$year."_2"]+= $evaluaciones[$year][2];
                            $counts[$year."_2"]++;
                        }
                        
                        if( $evaluacion1 && $evaluacion2 ){
                            if( $evaluacion2 ){
                                $evaluacionAnt = $evaluacion1;
                                $evaluacionAct = $evaluacion2;
                            }else{
                                $evaluacionAnt = $lastEval2;
                                $evaluacionAct = $evaluacion1;                                
                            }
                        }
                                                
                        $lastEval2 =$evaluacion2;
                            
                    }else{
                        $evaluacion = isset($evaluaciones[$year][0])?$evaluaciones[$year][0]:"";
                        
                        if( !isset($totals[$year]) ){
                            $totals[$year] = 0;
                            $counts[$year] = 0;
                        }
                        
                        $counts[$year]++;
                        $totals[$year]+= $evaluacion;
                    }                    
                }

                if( !$evaluacion && $year!=$actualYear){
                    $evaluacion = "N/A";
                }

                if( $year>=2011 ){     
                ?>
                <td><div align="left"><?=$evaluacion1?$evaluacion1:"N/A"//&nbsp;?></div></td>
                <td><div align="left"><?=$evaluacion2?$evaluacion2:"N/A"//&nbsp;?></div></td>
                <?
                }else{    
                ?>
                <td><div align="left"><?=$evaluacion?$evaluacion:"N/A"//&nbsp;?></div></td>
                <?
                }
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
                if( $year<2011){
                    ?>
                    <td><div align="center"><b><?=isset($totals[$year])&&$counts[$year]>0?round($totals[$year]/$counts[$year],2):"&nbsp;"?></b></div></td>
                    <?
                }else{
                    ?>
                    <td><div align="center"><b><?=isset($totals[$year."_1"])&&$counts[$year."_1"]>0?round($totals[$year."_1"]/$counts[$year."_1"],2):"&nbsp;"?></b></div></td>
                    <td><div align="center"><b><?=isset($totals[$year."_2"])&&$counts[$year."_2"]>0?round($totals[$year."_2"]/$counts[$year."_2"],2):"&nbsp;"?></b></div></td>
                    <?
                }
            }
            ?>
            <td colspan="3">&nbsp;</td>
            
        </tr>
    </tbody>
</table>
    <div align="center">
     Generado <?=Utils::fechaMes(date("Y-m-d H:i:s"))?>
    </div>
</div>

