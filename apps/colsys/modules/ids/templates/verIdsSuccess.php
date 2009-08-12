<?php
/* 
*
*/

?>


<div align="center" class="content">
    <h3>Maestra de

    <?
    if( $modo=="prov" ){
        echo "Proveedores";
    }

    if(  $modo=="agentes" ){
        echo "Agentes";
    }
    ?>
    </h3>
    <br />
    <br />

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
            <?
            $agente = $ids->getIdsAgente();
            if( $agente  ){
            ?>
            <tr>
                <td>
                    <div align="left"><b>Tipo</b></div>
               </td>
               <td>
                   <div align="left"><?=$agente->getCaTipo()?></div>
               </td>
               <td>
                   <div align="left"><b>Activo</b></div>
               </td>
               <td>
                   <div align="left"><?=$agente->getCaActivo()?"S&iacute;":"No"?></div>
               </td>
            </tr>
            <?
            }
            $proveedor = $ids->getIdsProveedor();            
            if( $proveedor  ){
            ?>
            <tr>
                <td>
                    <div align="left"><b>Tipo</b></div>
               </td>
               <td>
                   <div align="left"><?=$proveedor->getIdsTipo()?></div>
               </td>
               <td>
                   <div align="left"><b>Fecha de aprobaci&oacute;n</b></div>
               </td>
               <td>
                   <div align="left"><?=$proveedor->getCaFchaprobado()?Utils::fechaMes($proveedor->getCaFchaprobado())." por ".$proveedor->getCaUsuaprobado():"No Aprobado"?></div>
               </td>
            </tr>
            
            <tr>
                <td>
                    <div align="left"><b>Controlado por SIG</b></div>
               </td>
               <td>
                   <div align="left"><?=$proveedor->getCaControladoporsig()?"S&iacute;":"No"?></div>
               </td>
               <td>
                   <div align="left"><b>Critico</b></div>
               </td>
               <td>
                   <div align="left"><?=$proveedor->getCaCritico()?"S&iacute;":"No"?></div>
               </td>
            </tr>
            <?
            }
            ?>
            <tr>
                <td colspan="4">
                    <div class="tab-pane" id="tab-pane-1">

                   <div class="tab-page">
                      <h2 class="tab">Contactos</h2>
                          <?
                          include_component("ids", "contactos", array("ids"=>$ids, "modo"=>$modo, "nivel"=>$nivel ));
                          ?>
                       </div>
                        <?
                        if( $modo=="prov" ){
                        ?>
                       <div class="tab-page">
                          <h2 class="tab">Documentos</h2>
                          <?
                          include_component("ids", "documentos", array("ids"=>$ids, "modo"=>$modo, "nivel"=>$nivel ));
                          ?>
                       </div>
                        <div class="tab-page">
                          <h2 class="tab">Evaluaci&oacute;n</h2>
                          <?
                          include_component("ids", "evaluaciones", array("ids"=>$ids, "modo"=>$modo, "nivel"=>$nivel ));
                          ?>
                       </div>
                       <?
                        }
                       ?>
                       <div class="tab-page">
                          <h2 class="tab">Eventos</h2>
                          <?
                          include_component("ids", "eventos", array("ids"=>$ids, "modo"=>$modo, "nivel"=>$nivel ));
                          ?>
                       </div>
                       <?
                       if( $proveedor && $proveedor->getCaTipo()=="TRI" ){
                       ?>
                       <div class="tab-page">
                          <h2 class="tab">Transportistas</h2>
                          <?
                          include_component("ids", "transportistas", array("ids"=>$ids, "modo"=>$modo, "nivel"=>$nivel ));
                          ?>
                       </div>
                       <?
                       }
                       ?>


                    </div>

                </td>
            </tr>
        </tbody>
    </table>
</div>


