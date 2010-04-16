<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
*/

?>
<table width="100%" class="tableList alignLeft" >
    <tr>
        <th colspan="4"><b>Datos de exportaciones</b></th>
    </tr>
	<tr>
		<td width="213" >
			<b>Piezas:</b><br>
			<?            
            echo $formExpo['ca_piezas']->renderError();
            if( $repexpo && $repexpo->getCaPiezas() ){
                $piezasExp = explode("|",  $repexpo->getCaPiezas() );
                $formExpo->setDefault('ca_piezas', $piezasExp[0] );
                $formExpo->setDefault('ca_tipo_piezas', $piezasExp[1] );
            }
            echo $formExpo['ca_piezas']->render();

            echo $formExpo['tipo_piezas']->render();
            ?>
		</td>
		<td width="201" ><b>Peso:</b> <br />

            <?
            echo $formExpo['ca_peso']->renderError();
            if( $repexpo && $repexpo->getCaPeso() ){
                $pesoExp = explode("|",  $repexpo->getCaPeso() );
                $formExpo->setDefault('ca_peso', $pesoExp[0] );
                //$formExpo->setDefault('ca_tipo_peso', $pesoExp[1] );
            }
            echo $formExpo['ca_peso']->render();
            echo $formExpo['tipo_peso']->render();
            ?>
		</td>
		<td width="283" ><b>Volumen: </b><br>
            <?
            echo $formExpo['ca_volumen']->renderError();
            if( $repexpo && $repexpo->getCaVolumen() ){
                $volumenExp = explode("|",  $repexpo->getCaVolumen() );
                $formExpo->setDefault('ca_volumen', $volumenExp[0] );
                //$formExpo->setDefault('tipo_volumen_maritimo', $volumenExp[1] );
                //$formExpo->setDefault('tipo_volumen_aereo', $volumenExp[1] );
            }
            echo $formExpo['ca_volumen']->render();
           
            ?>

            <div id="tipo_volumen_maritimo">
            <?
             echo $formExpo['tipo_volumen_maritimo']->render();
            ?>
            </div>
            <div id="tipo_volumen_aereo">
            <?
             echo $formExpo['tipo_volumen_aereo']->render();
            ?>
            </div>
		</td>
		<td width="167" >

			<b>Dimensiones:</b> (cant;largoxanchoxalto en metros) <br />
			<?
            echo $formExpo['ca_dimensiones']->renderError();
            if( $repexpo ){
                $formExpo->setDefault('ca_dimensiones', $repexpo->getCaDimensiones() );
            }
            echo $formExpo['ca_dimensiones']->render();
			?>
		</td>
	</tr>
	<tr>
		<td colspan="2" >
			<b>Valor de Carga (USD):</b><br />
            <?
            echo $formExpo['ca_valorcarga']->renderError();
            if( $repexpo ){
                $formExpo->setDefault('ca_valorcarga', $repexpo->getCaValorcarga() );
            }
            echo $formExpo['ca_valorcarga']->render();
			?>

		</td>
		<td colspan="2"  valign="top"><b>Agente Aduanero:</b><br />
            <?
            echo $formExpo['ca_idsia']->renderError();
            if( $repexpo ){
                $formExpo->setDefault('ca_idsia', $repexpo->getCaIdsia() );
            }
            echo $formExpo['ca_idsia']->render();
			?>

        </td>
	</tr>

	<tr>
		<td  >
			<div id="emisionbl">
			<b>Lugar de emisi&oacute;n BL</b><br />
			<?
            echo $formExpo['ca_emisionbl']->renderError();
            if( $repexpo ){
                $formExpo->setDefault('ca_emisionbl', $repexpo->getCaEmisionbl() );
            }
            echo $formExpo['ca_emisionbl']->render();
			?>
			</div>			</td>
		<td >
			<div id="cuantosbl">
			<b>Cuantos BL? </b><br />
			<?
            echo $formExpo['ca_numbl']->renderError();
            if( $repexpo ){
                $formExpo->setDefault('ca_numbl', $repexpo->getCaNumbl() );
            }
            echo $formExpo['ca_numbl']->render();
			?>
			</div>		</td>
		<td  colspan="2"><b>Tipo de exportaci&oacute;n: </b><br>
			
            <?
            echo $formExpo['ca_tipoexpo']->renderError();
            if( $repexpo ){
                $formExpo->setDefault('ca_tipoexpo', $repexpo->getCaTipoexpo() );
            }
            echo $formExpo['ca_tipoexpo']->render();
			?>
         </td>
	</tr>
	<tr>
		<td  >
			<b>Motonave/Vuelo</b><br />
            <?
            echo $formExpo['ca_motonave']->renderError();
            if( $repexpo ){
                $formExpo->setDefault('ca_motonave', $repexpo->getCaMotonave() );
            }
            echo $formExpo['ca_motonave']->render();
			?>
		</td>
		<td ><b>Solicitud anticipo</b><br />
			<?
            echo $formExpo['ca_anticipo']->renderError();
            if( $repexpo ){
                $formExpo->setDefault('ca_anticipo', $repexpo->getCaAnticipo() );
            }else{
                $formExpo->setDefault('ca_anticipo', "No" );
            }
            echo $formExpo['ca_anticipo']->render();
			?></td>
		<td  colspan="2">&nbsp;</td>
	</tr>
</table>