<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>


<div align="center">
    <h1>Sistema Administrador de Referencias</h1>
    <br />

    <table class="tableList" width="80%">
        <tr>
            <th colspan="8">Datos para la referencia</th>
        </tr>
        
        <tr>
            <td><b>Referencia</b></td>
            <td>
                <?=$referencia->getCaReferencia()?>
            </td>            
            <td><b>Fecha de registro</b></td>
            <td>
                <?=$referencia->getCaFchreferencia()?>
            </td>
        </tr>
        <?
        $trayecto = $referencia->getTrayecto();
        ?>
        <tr class="row0">
            <td colspan="4"><b>Datos del trayecto</b></td>
        </tr>
        <tr>
            <td><b>Origen:</b></td>
            <td><?=$trayecto->getOrigen()->getTrafico()->getCaNombre()?> <?=$trayecto->getOrigen()->getCaCiudad()?></td>
            <td><b>Destino:</b></td>
            <td><?=$trayecto->getDestino()->getTrafico()->getCaNombre()?> <?=$trayecto->getDestino()->getCaCiudad()?></td>

        </tr>        
        
         <tr>
             <td><b>Linea</b></td>
            <td>
               <?=$trayecto->getIdsProveedor()->getIds()->getCaNombre()?>
            </td>
            <td><b>Modalidad</b></td>
            <td>
                <?=$trayecto->getCaModalidad()?>
            </td>
            
        </tr>
        <tr class="row0">
                <td colspan="4"><b>Datos de la guia</b></td>
            </tr>
        <tr>
            <td><b>Master:</b></td>
            <td>
                <?=$referencia->getCaMaster()?>
            </td>
            <td><b>Fch Master</b></td>
            <td>
                 <?=$referencia->getCaFchmaster()?>
            </td>            
        </tr>

        <tr>
            <td colspan="8">
                <div class="tab-pane" id="tab-pane-1">

                   <div class="tab-page">
                      <h2 class="tab">Clientes</h2>
                        <?=include_component("ino", "clientes", array("referencia"=>$referencia))?>
                       </div>
                       
                       <div class="tab-page">
                           <h2 class="tab">Facturaci&oacute;n</h2>
                           <?=include_component("ino", "ingresos", array("referencia"=>$referencia))?>
                       </div>
                       <div class="tab-page">
                           <h2 class="tab">Egresos</h2>
                       </div>
                       <div class="tab-page">
                           <h2 class="tab">Balance</h2>
                       </div>
                       <div class="tab-page">
                           <h2 class="tab">Documentos</h2>
                       </div>
                       <div class="tab-page">
                           <h2 class="tab">Auditoria</h2>
                       </div>
                    </div>
            </td>

        </tr>
        
    </table>




</div>