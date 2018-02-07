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

if($type){
    $parametros = ParametroTable::retrieveByCaso("CU229", null, null, $type );
    
    foreach($parametros as $parametro){
        $valor = explode(":", $parametro->getCaValor());
        $name = $valor[0];
        $type = $valor[1];
    }
}
?>
<div class="content" align="center">
    <h2>LISTADO DE PROVEEDORES <?=$name?strtoupper($name):($critico?"CRITICOS":"PENDIENTES X APROBAR")?></h2><br/>
    <table border="1" class="tableList" width="90%">
    <thead>
        <tr>
            <th rowspan="2">Identificaci&oacute;n</th>
            <th rowspan="2">Nombre</th>
            <th rowspan="2">Fch. Aprobaci&oacute;n</th>
            <th rowspan="2">Estado Impo</th>
            <th rowspan="2">Estado Expo</th>
            <th rowspan="2">Empresa</th>
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
        foreach($proveedores as $proveedor ){
            $ids = $proveedor->getIds();
            $sucursales = $ids->getIdsSucursal();
            if( $ultTipo!=$proveedor->getCaTipo() ){
                $ultTipo=$proveedor->getCaTipo();
                $tipo = $proveedor->getIdsTipo();
            ?>            
            <tr class="row0">
                <td  colspan="<?=13+$numYears?>"><div align="left"><b><?=$tipo->getCaNombre()?></b></div></td>
            </tr>
            <?
            }

            if( $proveedor->getCaTipo()=="TRI"&&$ultTransporte!=$proveedor->getCaTransporte() ){
                $ultTransporte=$proveedor->getCaTransporte();

            ?>
            <tr class="row0">
                <td  colspan="<?=13+$numYears?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div align="left"><?=$proveedor->getCaTransporte()?$proveedor->getCaTransporte():"Sin definir"?></div></td>
            </tr>
            <?
            }
        ?>
        <tr>
            <td><div align="left"><?=$ids->getCaIdalterno()?link_to($ids->getCaIdalterno(), "ids/verIds?modo=prov&id=".$ids->getCaId()):null?></div></td>
            <td><div align="left"><?=link_to($ids->getCaNombre(), "ids/verIds?modo=prov&id=".$ids->getCaId())?></div></td>
            <td><div align="left"><?=$proveedor->getCaFchaprobado()?Utils::fechaMes($proveedor->getCaFchaprobado()):"<span class='rojo'><b>No Aprobado</b></span>"?></div></td>
            <td><div align="left"><?=$proveedor->getCaActivoImpo()?"Activo":"<span class='rojo'>Inactivo</span>"?></div></td>
            <td><div align="left"><?=$proveedor->getCaActivoExpo()?"Activo":"<span class='rojo'>Inactivo</span>"?></div></td>
            <td><div align="left"><?=$proveedor->getCaEmpresa()?></div></td>
            <td>
                <div align="left">
                    <?
                    $anno_apro = Utils::parseDate($proveedor->getCaFchaprobado(), "Y");
                    $stre_apro = Utils::parseDate($proveedor->getCaFchaprobado(), "m");
                    $stre_apro = floor($stre_apro/7)+1;
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
            <td><div align="center"><?=$proveedor->getCaCritico()?"X":""?></div></td>             
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
                        
                        //if( $evaluacion1 && $evaluacion2 ){
                            if( $evaluacion2 ){
                                $evaluacionAnt = $evaluacion1;
                                $evaluacionAct = $evaluacion2;
                            }else if($evaluacion1){
                                $evaluacionAnt = $lastEval2;
                                $evaluacionAct = $evaluacion1;                                
                            }
                        //}
                                                
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
                }else{
                    $evaluacionAnt = $evaluaciones[$year-1][2];
                    $evaluacionAct = null;
                }
                
                if( !$evaluacion && $year!=$actualYear ){
                   $evaluacion = "N/A";
                }
                if( $anno_apro>$year ){
                   $evaluacion = "N/A";
                   $evaluacion1 = "N/A";
                   $evaluacion2 = "N/A";
                }else if( $anno_apro==$year ){
                   if( $stre_apro>1 ){
                      $evaluacion1 = "N/A";
                   }
                }

                if( $year>=2011 ){     
                ?>
                <td><div align="left"><?=$evaluacion1?$evaluacion1:"&nbsp;"?></div></td>
                <td><div align="left"><?=$evaluacion2?$evaluacion2:"&nbsp;"?></div></td>
                <?
                }else{    
                ?>
                <td><div align="left"><?=$evaluacion?$evaluacion:"&nbsp;"?></div></td>
                <?
                }
            }            
            ?>
            
            <td><div align="center"><?=$evaluacionAct&&$evaluacionAnt < $evaluacionAct?"X":"&nbsp;"?></div></td>
            <td><div align="center"><?=$evaluacionAct&&$evaluacionAnt == $evaluacionAct?"X":"&nbsp;"?></div></td>
            <td><div align="center"><?=$evaluacionAct&&$evaluacionAnt > $evaluacionAct?"X":"&nbsp;"?></div></td>
        </tr>
        <?
        }
        ?>

        <tr class="row0" >

            <td colspan="10"><b>Promedio</b></td>
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

