        <?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
$refs = $sf_data->getRaw("refs");

//echo "<pre>";print_r($refs);echo "</pre>";
?>
<div class="content" align="center" >
   <?//php echo "el query es: ".$sqlQ; ?>
    <table width="90%" class="tableList"  >
        <tr>
           <th>Referencia</th>
           <th>Origen</th>
           <th>Destino</th>
           <th>Modalidad</th>
           <th>Incoterms</th>
           <th >Linea</th>
           <th >Agente</th>
           <th>TEUS</th>
           <th># hijas</th>
           <th>Piezas</th>           
           <th>Peso</th>
           <th>Volumen</th>
           <th>Facturaci&oacute;n Clientes : </th>
           <th>Costo Neto: </th>
<!--           <th>Deducciones: </th>-->
           <th>INO Sobreventa: </th>
           <th>INO Consolidado: </th>
           <th>INO Total: </th>
           <th>Estado: </th>
           <th>Observaciones: </th>
         </tr>         
         <?
         $totales = array();

         $totales["numrefs"] = 0;
         if( count($refs)>0 ){
             foreach( $refs as $r ){    
                  $totales["numrefs"]++;
             ?>
             <tr>
                 <td> <a href="/inoF2/indexExt5/idmaster/<?=$r["ca_idmaster"]?>" target='_blank'><?=$r["ca_referencia"]?></a>   </td>
               <td><?=$r["Origen"]["ca_ciudad"]?></td>
               <td><?=$r["Destino"]["ca_ciudad"]?></td>
               <td><?=$r["ca_modalidad"]?></td>
               <td><?=$r["InoHouse"]["0"]["Reporte"]["ca_incoterms"]?></td>
               <td><?=$r["IdsProveedor"]["Ids"]["ca_nombre"]?></td>
               <td><?=$r["IdsAgente"]["Ids"]["ca_nombre"]?></td>
               <td><div align="right"><?=Utils::formatNumber($r["InoViTeus"]["ca_valor"])?></div></td>
               <td><div align="right"><?=Utils::formatNumber($r["InoViUnidadesMaster"]["ca_numhijas"])?></div></td>
               <td><div align="right"><?=Utils::formatNumber($r["InoViUnidadesMaster"]["ca_numpiezas"])?></div></td>
               <td><div align="right"><?=Utils::formatNumber($r["InoViUnidadesMaster"]["ca_peso"])?></div></td>
               <td><div align="right"><?=Utils::formatNumber($r["InoViUnidadesMaster"]["ca_volumen"])?></div></td>
               <td><div align="right"><?=Utils::formatNumber($r["InoViIngreso"]["ca_valor"])?></div></td>
               <td><div align="right"><?=Utils::formatNumber($r["InoViCosto"]["ca_valor"])?></div></td>
<!--               <td><div align="right"><?=Utils::formatNumber($r["InoViDeduccion"]["ca_valor"])?></div></td>-->
               <td><div align="right"><?=Utils::formatNumber($r["InoViUtilidad"]["ca_valor"])?> </div></td>
               <?
               $inoCons = $r["InoViIngreso"]["ca_valor"] -$r["InoViDeduccion"]["ca_valor"] -$r["InoViCosto"]["ca_valor"]-$r["InoViUtilidad"]["ca_valor"];
               ?>           
               <td><div align="right"><?=Utils::formatNumber($inoCons)?> </div></td>
               <td><div align="right"><?=Utils::formatNumber($inoCons+$r["InoViUtilidad"]["ca_valor"])?></div> </td>
               <td>
                   <div align="right">
                   <?
                   if( $r["ca_fchcerrado"] ){
                       echo "Cerrado";
                   }elseif( $r["ca_fchliquidado"] ){
                       echo "Liquidado";
                   }else{
                       echo "Abierto";
                   }
                   ?>            
                    </div>
               </td>
               <td>
                   <div align="left">
                   <?=$r["ca_observaciones"]?>            
                    </div>
               </td>
             </tr>
             <?
                if( !isset($totales["ca_numpiezas"]) ){
                    $totales["ca_numpiezas"] = 0;
                }
                $totales["ca_numpiezas"] += $r["InoViUnidadesMaster"]["ca_numpiezas"]; 
                
                if( !isset($totales["teus"]) ){
                    $totales["teus"] = 0;
                }
                $totales["teus"] += $r["InoViTeus"]["ca_valor"]; 
                
                if( !isset($totales["ca_numhijas"]) ){
                    $totales["ca_numhijas"] = 0;
                }
                $totales["ca_numhijas"] += $r["InoViUnidadesMaster"]["ca_numhijas"]; 
                
                if( !isset($totales["ca_peso"]) ){
                    $totales["ca_peso"] = 0;     
                }
                $totales["ca_peso"] += $r["InoViUnidadesMaster"]["ca_peso"]; 

                if( !isset($totales["ca_volumen"]) ){
                    $totales["ca_volumen"] = 0;
                }
                $totales["ca_volumen"] += $r["InoViUnidadesMaster"]["ca_volumen"]; 

                if( !isset($totales["ingresos"]) ){
                    $totales["ingresos"] = 0;
                }
                $totales["ingresos"] += $r["InoViIngreso"]["ca_valor"]; 

                if( !isset($totales["costos"]) ){
                    $totales["costos"] = 0;
                }
                $totales["costos"] += $r["InoViCosto"]["ca_valor"]; 

                if( !isset($totales["deduccion"]) ){
                    $totales["deduccion"] = 0;
                }
                $totales["deduccion"] += $r["InoViDeduccion"]["ca_valor"]; 

                if( !isset($totales["utilidad"]) ){
                    $totales["utilidad"] = 0;
                }
                $totales["utilidad"] += $r["InoViUtilidad"]["ca_valor"]; 


             }
             ?>
             <tr class="row0">
               <td colspan="5"><div align="left"><b>Total</b></div></td>
               
               <td><div align="right"><b>Total Casos <?=Utils::formatNumber($totales["numrefs"])?></b></div></td>
               <td><div align="right"><b><?=Utils::formatNumber($totales["teus"])?></b></div></td>
               <td><div align="right"><b><?=Utils::formatNumber($totales["ca_numhijas"])?></b></div></td>
               <td><div align="right"><b><?=Utils::formatNumber($totales["ca_numpiezas"])?></b></div></td>
               <td><div align="right"><b><?=Utils::formatNumber($totales["ca_peso"])?></b></div></td>
               <td><div align="right"><b><?=Utils::formatNumber($totales["ca_volumen"])?></b></div></td>
               <td><div align="right"><b><?=Utils::formatNumber($totales["ingresos"])?></b></div></td>
               <td><div align="right"><b><?=Utils::formatNumber($totales["costos"])?></b></div></td>
<!--               <td><div align="right"><b><?=Utils::formatNumber($totales["deduccion"])?></b></div></td>-->
               <td><div align="right"><b><?=Utils::formatNumber($totales["utilidad"])?></b></div></td>
               <?
               $inoCons = $totales["ingresos"]-$totales["deduccion"] -$totales["costos"];
               ?>           
               <td><div align="right"><b><?=Utils::formatNumber($inoCons)?></b> </div></td>
               <td><div align="right"><b><?=Utils::formatNumber($inoCons+$totales["utilidad"])?></b></div> </td>           
               <td>&nbsp;</td>   
               <td>&nbsp;</td>  
             </tr>
         <?
         }else{
         ?>
             <tr class="row0">
               <td colspan="12"><div align="center"><b>No hay referencias con los criterios seleccionados</b></div></td>               
             </tr>
         <?    
         }
         ?>

    </table>   
    
    Generado <?=Utils::fechaMes(date("Y-m-d H:i:s"))?>
</div>
