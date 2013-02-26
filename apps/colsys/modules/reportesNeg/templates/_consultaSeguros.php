<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<table class="tableList alignLeft" width="100%">
     <tr >
         <th colspan="3" ><b>Seguros</b></th>
     </tr>
     <tr>
         <td colspan="3" <?=($comparar)? (($reporte->compDato("CaSeguro")!=0)?"class='rojo'":"") :""?>>
           <?=$reporte->getCaSeguro()?>
        </td>
    </tr>
    <tr id="seguros-row0">
         <td colspan="4" <?=($comparar)? (($reporte->compDato("RepSeguro()->getCaSeguroConf")!=0)?"class='rojo'":"") :""?>>
            <b>Notificar Seguro:</b><br />
            <?
            $usuario = Doctrine::getTable("Usuario")->find( $repseguro->getCaSeguroConf() );

            if(!$usuario)
                $usuario = new Usuario();
            echo $usuario->getCaNombre();
            ?>
            </td>
    </tr>

	<tr id="seguros-row1">
        <td width="33%" <?=($comparar)? (($reporte->compDato("RepSeguro()->getCaVlrasegurado")!=0)?"class='rojo'":"") :""?> ><b>Valor Asegurado:</b><br />
                <?=Utils::formatNumber($repseguro->getCaVlrasegurado(), 3)." ".$repseguro->getCaIdmonedaVlr()?>
                
				</td>
		<td width="33%" <?=($comparar)? (($reporte->compDato("RepSeguro()->getCaObtencionpoliza")!=0)?"class='rojo'":"") :""?> ><b>Obtenci&oacute;n P&oacute;liza:</b><br />
            <?=Utils::formatNumber($repseguro->getCaObtencionpoliza(), 3)." ".$repseguro->getCaIdmonedaPol()?>
			
        </td>
		<td width="33%" <?=($comparar)? (($reporte->compDato("RepSeguro()->getCaPrimaventa")!=0)?"class='rojo'":"") :""?>><b>Prima Venta:</b><br />
            <?=Utils::formatNumber($repseguro->getCaPrimaventa(), 3)." ".$repseguro->getCaIdmonedaVta()." Min. ".Utils::formatNumber($repseguro->getCaMinimaventa(), 3)?>            
        </td>
	</tr>
</table>