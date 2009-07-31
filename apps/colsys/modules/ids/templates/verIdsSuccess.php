<?php
/* 
*
*/

?>

<div align="center" class="content">
    <table  class="tableList" width="80%">
        <thead>
            <tr>
                <th colspan="4"><div align="left"><b>Datos Basicos</b></div></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="25%">
                    <div align="left"><b>Identificaci&oacute;n</b></div>
                </td>
                <td width="25%">
                    <div align="left"><?=$ids->getCaId()?> <?=$ids->getCaDv()?></div>
                </td>
                <td width="25%">
                    <div align="left"><b><?=$ids->getCaIdalterno()?"Identificaci&oacute;n Alterna":"&nbsp;"?></b></div>
                </td>
                <td width="25%">
                    <div align="left"><?=$ids->getCaIdalterno()?$ids->getCaIdalterno():"&nbsp;"?></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div align="left"><b>Nombre</b></div>
               </td>
               <td>
                   <div align="left"><?=$ids->getCaNombre()?></div>
               </td>
               <td>
                   <div align="left"><b>Website</b></div>
               </td>
               <td>
                   <div align="left"><?=$ids->getCaWebsite()?></div>
               </td>
            </tr>
            
            <tr>
                <td colspan="4">
                    <div class="tab-pane" id="tab-pane-1">

                   <div class="tab-page">
                      <h2 class="tab">Contactos</h2>
                        <?
                        include_component("ids", "contactos", array("ids"=>$ids, "modo"=>$modo, "nivel"=>$nivel ));
                        ?>
                       </div>
                       <div class="tab-page">
                          <h2 class="tab">Documentos</h2>

                         <?
                        include_component("ids", "documentos", array("ids"=>$ids, "modo"=>$modo, "nivel"=>$nivel ));
                        ?>

                       </div>

                        <div class="tab-page">
                          <h2 class="tab">Evaluacion</h2>

                          This is text of tab 2. This is text of tab 2.
                          This is text of tab 2. This is text of tab 2.

                       </div>

                         <div class="tab-page">
                          <h2 class="tab">Eventos</h2>

                          This is text of tab 2. This is text of tab 2.
                          This is text of tab 2. This is text of tab 2.

                       </div>
                    </div>

                </td>
            </tr>
        </tbody>
    </table>
</div>


