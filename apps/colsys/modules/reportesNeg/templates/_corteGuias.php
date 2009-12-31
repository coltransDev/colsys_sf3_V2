<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<table class="tableList" width="100%" id="consignar-expo">
     <tr >
         <th colspan="2" ><b>Instrucciones para el corte de guias</b></th>
     </tr>
     <tr>
         <td width="33%">
             <b>Consignar Master (MAWB/BL) a:</b>
         </td>
         <td width="67%">
            <?
            echo $form['ca_idconsignarmaster']->renderError();
            if( $reporte ){
                $form->setDefault('ca_idconsignarmaster', $reporte->getCaIdconsignarmaster() );
            }
            echo $form['ca_idconsignarmaster']->render();
            ?>
        </td>
    </tr>
     <tr>
         <td>
             <b>Consignar HAWB/HBL a :</b>
         </td>
         <td >

            <?
            echo $form['ca_idconsignar_expo']->renderError();
            if( $reporte ){
                $form->setDefault('ca_idconsignar_expo', $reporte->getCaIdconsignar() );
            }
            echo $form['ca_idconsignar_expo']->render();
            ?>
        </td>
    </tr>
</table>
<table class="tableList" width="100%" id="consignar-impo">
     <tr >
         <th colspan="2" ><b>Instrucciones para el corte de guias</b></th>
     </tr>
     <tr>
        <td width="33%">
             <b>Consignar HAWB/HBL a:</b>
         </td>
         <td width="67%">
            <?
            echo $form['ca_idconsignar_impo']->renderError();
            if( $reporte ){
                $form->setDefault('ca_idconsignar_impo', $reporte->getCaIdconsignar() );
            }
            echo $form['ca_idconsignar_impo']->render();
            ?>
        </td>
    </tr>
    <tr>
        <td width="33%">
             <b>Transladar a:</b>
         </td>
         <td width="67%">
            <?
            echo $form['tipo']->renderError();
            echo $form['tipo']->render();
            ?>
        </td>
    </tr>
    <tr>
         <td>
             <b>&nbsp;</b>
         </td>
         <td >
             <?
            echo $form['ca_idbodega']->renderError();
            if( $reporte ){
                $form->setDefault('ca_idbodega', $reporte->getCaIdbodega() );
            }
            echo $form['ca_idbodega']->render();
            ?>
           
        </td>
    </tr>
    <tr>
         <td>
             <b>Igualar Master/Hijo:</b>
         </td>
         <td >
            <?
            echo $form['ca_mastersame']->renderError();
            if( $reporte ){
                $form->setDefault('ca_mastersame', $reporte->getCaMastersame() );
            }
            echo $form['ca_mastersame']->render();
            ?>
        </td>
    </tr>
</table>