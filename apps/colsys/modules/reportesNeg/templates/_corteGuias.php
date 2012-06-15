<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<table class="tableList" width="100%">
     <tr >
         <th colspan="2" ><b>Instrucciones para el corte de guias</b></th>
     </tr>
     <tr>
         <td>
             <b>Consignar Master (MAWB/BL) a:</b>
         </td>
         <td >
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
            /*echo $form['ca_colmas']->renderError();
            if( $reporte ){
                $form->setDefault('ca_colmas', $reporte->getCaColmas() );
            }
            echo $form['ca_colmas']->render();*/
            ?>
        </td>
    </tr>
    <tr>
         <td>
             <b>Transladar a:</b>
         </td>
         <td >
            <?
            /*echo $form['ca_colmas']->renderError();
            if( $reporte ){
                $form->setDefault('ca_colmas', $reporte->getCaColmas() );
            }
            echo $form['ca_colmas']->render();*/
            ?>
        </td>
    </tr>
    <tr>
         <td>
             <b>&nbsp;</b>
         </td>
         <td >
            <?
            /*echo $form['ca_colmas']->renderError();
            if( $reporte ){
                $form->setDefault('ca_colmas', $reporte->getCaColmas() );
            }
            echo $form['ca_colmas']->render();*/
            ?>
        </td>
    </tr>
    <tr>
         <td>
             <b>Igualar Master/Hijo:</b>
         </td>
         <td >
            <?
            /*echo $form['ca_colmas']->renderError();
            if( $reporte ){
                $form->setDefault('ca_colmas', $reporte->getCaColmas() );
            }
            echo $form['ca_colmas']->render();*/
            ?>
        </td>
    </tr>
</table>