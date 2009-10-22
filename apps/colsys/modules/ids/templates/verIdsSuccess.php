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
                    <div align="left"><?=$ids->getCaIdalterno()?> <?=$ids->getCaDv()?></div>
                </td>
                <td width="25%">
                    <div align="left"><b><?=$ids->getCaIdalterno()?"Id":"&nbsp;"?></b></div>
                </td>
                <td width="25%">
                    <div align="left"><?=$ids->getCaId()?$ids->getCaId():"&nbsp;"?></div>
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
            
            if( $modo=="agentes" ){
                $agente = $ids->getIdsAgente();

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
                   <div align="left"><?=$agente->getCaActivo()?"S&iacute;":"<span class='rojo'>No</span>"?></div>
               </td>
            </tr>
            <?
            }
                     
            if( $modo=="prov" ){
                $proveedor = $ids->getIdsProveedor();            
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
                    <div align="left"><b>Empresa</b></div>
               </td>
               <td>
                   <div align="left"><?=$proveedor->getCaEmpresa()?$proveedor->getCaEmpresa():"Ambas"?></div>
               </td>
               <td>
                   <div align="left">&nbsp;</div>
               </td>
               <td>
                   <div align="left">&nbsp;</div>
               </td>
            </tr>

                <?
                if( $proveedor->getCaTipo()=="TRI" || $proveedor->getCaTipo()=="TRN" ){
                ?>
                <tr>
                    <td>
                        <div align="left"><b>Sigla</b></div>
                   </td>
                   <td>
                       <div align="left"><?=$proveedor->getCaSigla()?></div>
                   </td>
                   <td>
                       <div align="left"><b>Transporte</b></div>
                   </td>
                   <td>
                       <div align="left"><?=$proveedor->getCaTransporte()?></div>
                   </td>
                </tr>
                <?  
                }
                ?>
            
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
             <tr>
                <td>
                    <div align="left"><b>Activo</b></div>
               </td>
               <td>
                   <div align="left"><?=$proveedor->getCaActivo()?"S&iacute;":"<span class='rojo'>No</span>"?></div>
               </td>
               <td>
                   <div align="left"><b>Esporadico</b></div>
               </td>
               <td>
                   <div align="left"><div align="left"><?=$proveedor->getCaEsporadico()?"S&iacute;":"No"?></div></div>
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
                      <div class="tab-page">
                          <h2 class="tab">Grupos</h2>
                          <?
                          include_component("ids", "grupos", array("ids"=>$ids, "modo"=>$modo, "nivel"=>$nivel ));
                          ?>
                       </div>


                    </div>

                </td>
            </tr>
        </tbody>
    </table>
</div>


