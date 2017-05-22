<?php
/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
?>

<table border="1" class="tableList" width="97%" style="margin:10px">
    <tr >          
        <td><b>No.Total Piezas:</b></td>  
        <td><div align="right"><?=Utils::formatNumber($referencia->getCaPiezas())?>&nbsp;</div></td>  
        <td><b>Ingresos Netos Clientes:</b></td>  
        <td><div align="right"><?=$monedaLocal." ".Utils::formatNumber($referencia->getVlrFacturado())?>&nbsp;</div></td>  
    </tr>
    <tr><td><b>Peso Total en Kilos:</b></td>  
        <td><div align="right"><?=Utils::formatNumber($referencia->getCaPeso())?>&nbsp;</div></td>  
        <td><b>Menos Deducciones:</b></td>  
        <td><div align="right"><?=$monedaLocal." ".Utils::formatNumber($referencia->getVlrDeducciones())?>&nbsp;</td>
    </tr>
    <tr>
        <td><b>Volumen Total CBM:</b></td>
        <td><div align="right"><?=Utils::formatNumber($referencia->getCaVolumen())?>&nbsp;</div></td>
        <td><b>Costo Neto Embarque:</b></td>
        <td><div align="right"><?=$monedaLocal." ".Utils::formatNumber($referencia->getVlrCosto())?>&nbsp;</div></td>
    </tr>
    <tr>
        <td><b>Total Hbl's Registradas:</b></td>
        <td><div align="right"><?=count( $referencia->getInoHouse())?>&nbsp;</div></td>
        <td><b>INO x Sobreventa:</b></td>
        <td><div align="right"><?=$monedaLocal." ".Utils::formatNumber($referencia->getVlrSobreventa())?>&nbsp;</div></td>
    </tr>
    <tr height="5">
        <td class="invertir" colspan="4"></td>
    </tr>
    <?
    $inoConsolidado = $referencia->getVlrFacturado()-$referencia->getVlrDeducciones()-$referencia->getVlrCosto()-$referencia->getVlrSobreventa();
    $inoTotal = $inoConsolidado+$referencia->getVlrSobreventa();
    ?>
     <tr >
        <td colspan="2" rowspan="2">&nbsp;</td>
           
        <td class="listar b">INO Consolidado (Sin sobreventa):</td>  
        <td class="listar b" ><div align="right"><?=$monedaLocal." ".Utils::formatNumber($inoConsolidado)?>&nbsp;</div></td>
    </tr>    
    <tr>         
        <td class="listar b">INO Total:</td>  
        <td class="listar b" ><div align="right"><?=$monedaLocal." ".Utils::formatNumber($inoTotal)?>&nbsp;</div></td>
    </tr>
<!--    <tr>         
        <td class="listar b">INO Consolidado:</td>  
        <td class="listar b" >-8,933,016</td>
    </tr>
    <tr>

        <td >Ingr. x Sobreventa:</td>
        <td  >8,143</td>
    </tr>
    <tr>
        <td >Ingr. x Sobreventa OTM:</td>
        <td  ></td>
    </tr>

    <tr>
        <td >Ingr. x Sobreventa Contenedores:</td>
        <td  >0</td>
    </tr>
    <tr>
        <td >Ingr. x Sobreventa Otros:</td>
        <td  >8,143</td>

    </tr>
    <tr>  
        <td >Ingr. No Comisionable:</td>  
        <td ></td>
    </tr>-->
    <?
    if( $referencia->getCaTransporte()==Constantes::MARITIMO && false ){
    ?>
    <tr>  
        <td ><b>Utilidad x CBM:</b></td>  
        <td >-90,232</td>
    </tr>
    <?
    }
    ?>

</table>



<!--

<br />
<b>Aéreo</b>
<table class="tableList">
    <tr>
    <td class="partir" rowspan="9">Balance:</td>

          <td class="listar"><b>No.Total Piezas:</b></td>
          <td class="listar" style="text-align: right;">5</td>
          <td class="listar"><b>Facturación Clientes:</b></td>
          <td class="listar" style="text-align: right;">$11,856,618</td>
          <td class="listar" rowspan="9"></td>
        </tr>
        <tr>

          <td class="listar"><b>Peso Total en Kilos:</b></td>
          <td class="listar" style="text-align: right;">845.1</td>
          <td class="listar"><b>Menos Deducciones:</b></td>
          <td class="listar" style="text-align: right;">$0</td>
        </tr>
        <tr>
          <td class="listar"><b>Peso Volumen Total:</b></td>

          <td class="listar" style="text-align: right;">1,086.5</td>
          <td class="listar"><b>Costo Neto Embarque:</b></td>
          <td class="listar" style="text-align: right;">$8,410,765</td>
        </tr>
        <tr>
          <td class="listar"><b>Total HAWB Registradas:</b></td>
          <td class="listar" style="text-align: right;">2</td>

          <td class="listar"><b></b></td>
        </tr>
        <tr style="">
          <td class="invertir" colspan="4"></td>
        </tr>
        <tr>
          <td class="listar" colspan="2" rowspan="4"></td>
          <td class="listar"></td>
          <td class="listar" style="text-align: right;"></td>

        </tr>
        <tr>
          <td class="listar"><b>INO Coltrans:</b></td>
          
          
              <td class="listar" style="text-align: right;">$3,445,853</td>
          
        </tr>
        <tr>
          <td class="listar"><b>INO Comisionable:</b></td>

          
          
            <td class="listar" style="text-align: right;">$3,409,782</td>
          
        </tr>
        <tr>
          <td class="listar"><b>INO No Comisionable:</b></td>
          
          
            <td class="listar" style="text-align: right;">$36,071</td>
        </tr>
    
</table>
-->
