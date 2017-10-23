<?php
/* 
*
*/

if(  $modo=="agentes"  ){
?>
<script type="text/javascript">

var eliminarAgente = function(){
    Ext.Ajax.request(
        {
            waitMsg: 'Eliminando ...',
            url: '<?=url_for("ids/eliminarAgente")?>',
            //Solamente se envian los cambios
            params :    {
                id: <?=$ids->getCaId()?>,
                modo: '<?=$modo?>' 
            },

            success:function(response,options){

                var res = Ext.util.JSON.decode( response.responseText );
                if( res.success){
                    alert( "El agente se elimino correctamente.");
                    document.location = "<?=url_for("ids/index?modo=".$modo)?>"
                }else{
                    Ext.MessageBox.alert('Error', "Ha ocurrido el siguiente error"+res.errorInfo);
                }
            },
            failure:function(response,options){
                Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+response.status );
                //Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
            }



         }
    );
}
</script>
<?
}
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
                   <div align="left"><?=$agente->getCaTipo()=="Oficial"?$agente->getCaTipo():"<span class='rojo'>".$agente->getCaTipo()."</span>"?></div>
               </td>
               <td>
                   <div align="left"><b>Activo</b></div>
               </td>
               <td>
                   <div align="left"><?=$agente->getCaActivo()?"S&iacute;":"<span class='rojo'>No</span>"?></div>
               </td>
            </tr>
            <tr>
                <td valign="top">
                    <div align="left"><b>TPLogistics</b></div>
                    <div align="left"><b>Consolcargo</b></div>
               </td>
               <td valign="top">                   
                   <div align="left"><?=$agente->getCaTplogistics()?"<span class='rojo'>S&iacute;</span>":"No"?></div>
                   <div align="left"><?=$agente->getCaConsolcargo()?"<span class='rojo'>S&iacute;</span>":"No"?></div>
               </td>
               <td valign="top">
                    <div align="left"><b>Información de Seguridad</b></div>
               </td>
               <td valign="top">                   
                   <div align="left"><?=$agente->getCaInfosec()?></div>
               </td>   
               
            </tr>
            <tr>
                <td valign="top">
                    <div align="left"><b>Modalidad</b></div>                    
               </td>
               <td valign="top">                   
                   <div align="left"><?=$agente->getCaModalidad()?></div>
               </td>
               <td valign="top">
                    <div align="left"><b>Observaciones</b></div>
               </td>
               <td valign="top">
                   <div align="left"><?=$agente->getCaObservaciones()?></div>
               </td>   
               
            </tr>
            
            <tr>
                <td valign="top">
                    <div align="left"><b>Sucursal Coltrans</b></div>
               </td>
               <td valign="top">                   
                   <div align="left"><?=$agente->getCaSucursal()?></div>
               </td>
               <td>
                   <div align="left"><b>Grupo</b></div>
               </td>
               <td valign="top">                   
                   <div align="left"><?=$agente->getMaestraClasificacion()->getCaNombre()?></div>
               </td>
            </tr>
            <?
            }
                     
            if( $modo=="prov" ){
                $proveedor = $ids->getIdsProveedor();                               
                if( $proveedor && $proveedor->getCaIdproveedor() ){
                ?>
                    <tr>
                        <td>
                            <div align="left"><b>Tipo</b></div>
                       </td>
                       <td>
                           <div align="left"><?=$proveedor->getIdsTipo()?></div>
                       </td>
                       <td>
                           <div align="left"><b>Fecha de creaci&oacute;n</b></div>
                       </td>
                       <td>
                           <div align="left"><?=$ids->getCaFchcreado()?Utils::fechaMes($ids->getCaFchcreado())." por ".$ids->getCaUsucreado():"Sin registro"?></div>
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
                           <div align="left"><b>Fecha de aprobaci&oacute;n</b></div>
                       </td>
                       <td>
                           <div align="left"><?=$proveedor->getCaFchaprobado()?Utils::fechaMes($proveedor->getCaFchaprobado())." por ".$proveedor->getCaUsuaprobado():"<span class='rojo'><b>No Aprobado</b></span>"?></div>
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
                               <div align="left"><b>Grupo</b>&nbsp;&nbsp;<?=$proveedor->getMaestraClasificacion()->getCaNombre()?></div>
                           </td>
                           <td>
                               <div align="left"><b>Transporte</b>&nbsp;&nbsp;<?=$proveedor->getCaTransporte()?></div>
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
                           <?
                           $parametros = ParametroTable::retrieveByCaso("CU229", null, null, $proveedor->getCaControladoporsig() );

                            foreach($parametros as $parametro){
                                $valor = explode(":", $parametro->getCaValor());
                                $name = $valor[0];
                                $type = $valor[1];
                            }
                           ?>
                           <div align="left"><?=$name?></div>
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
                            <div align="left"><b>Activo Impo</b></div>
                       </td>
                       <td>
                           <div align="left"><?=$proveedor->getCaActivoImpo()?"S&iacute;":"<span class='rojo'>No</span>"?></div>
                       </td>
                       <td>
                           <div align="left"><b>Obliga Firma Contrato Comodato:</b></div>
                       </td>
                       <td>
                           <div align="left"><?=$proveedor->getCaContratoComodato()?"<span class='rojo'>S&iacute;</span>":"No"?></div>
                       </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="left"><b>Activo Expo</b></div>
                       </td>
                       <td>
                           <div align="left"><?=$proveedor->getCaActivoExpo()?"S&iacute;":"<span class='rojo'>No</span>"?></div>
                       </td>
                       <?if(!$proveedor->getCaFchvencimiento() == NULL){
                        ?>
                        <td>
                            <div align="left"><b>Fch. Vencimiento</b></div>
                        </td>
                        <td>
                            <div align="left"><?=$proveedor->getCaFchvencimiento()<date('Y-m-d')?"<span class='rojo'>".$proveedor->getCaFchvencimiento()."</span>":$proveedor->getCaFchvencimiento()?></div>
                        </td>
                        <?
                        }else{
                        ?>
                        <td>
                            <div align="left">&nbsp;</div>
                        </td>
                        <td>
                            <div align="left">&nbsp;</div>
                        </td>
                        <?}?>
                    </tr>
                    <?if($proveedor->getCaVetado()==on){?>
                        <tr>
                            <td>
                                <div align="left"><b>Vetado</b></div>
                           </td>
                           <td>
                               <div align="left"><?=$proveedor->getCaVetado()?"<span class='rojo'>S&iacute;</span>":"No"?></div>
                           </td>
                           <?
                    }else{?>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                    <?}?>
                           <td>
                               <div align="left">Jefe Encargado:</div>
                           </td>
                           <td>
                               <div align="left"><?=$proveedor->getJefe()->getCaNombre()?></div>
                           </td>
                        </tr>
                    
                    <?
                    if($proveedor->getCaAntlegales() || $proveedor->getCaAntpenales() || $proveedor->getCaAntfinancieros()){
                    ?>
                        <tr><th colspan="4">Informaci&oacute;n de Seguridad</th></tr>
                        <tr><td>Antecedente Legales:</td>
                            <td><div align="left"><?=$proveedor->getCaAntlegales()?></td>
                            <td>Antecedente Penales:</td>
                            <td><div align="left"><?=$proveedor->getCaAntpenales()?></td>
                        </tr>
                        <tr><td>Antecedente Financieros:</td>
                            <td><div align="left"><?=$proveedor->getCaAntfinancieros()?></td><td>&nbsp;</td>
                        </tr>

                    <?
                    }
                }else{
                ?>
                <tr>

                    <td colspan="4">
                       <div align="left" ><span class="rojo">Este registro ya existe en otra maestra, es necesario editar el registro y completar los datos.</span></div>
                   </td>
                </tr>
                <?
                }
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
                          if( $modo=="prov" && $proveedor && $proveedor->getCaIdproveedor() ){
                            include_component("ids", "evaluaciones", array("ids"=>$ids, "modo"=>$modo, "nivel"=>$nivel ));
                          }
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
                      <div class="tab-page">
                          <h2 class="tab">Bancos</h2>
                          <?
                          include_component("ids", "bancos", array("ids"=>$ids, "modo"=>$modo, "nivel"=>$nivel ));
                          ?>
                       </div>
                    </div>

                </td>
            </tr>
            <tr>
                <td>
                    <div align="left"><b>Creado:</b> <?=$ids->getCaUsucreado()." ".Utils::fechaMes($ids->getCaFchcreado())?></div>
               </td>
               <td>
                   <div align="left"><?=$ids->getCaUsuactualizado()?"<b>Actualizado:</b>":"&nbsp;"?> <?=$ids->getCaUsuactualizado()." ".Utils::fechaMes($ids->getCaFchactualizado())?></div>
               </td>
               <td colspan="2">
                   <div align="left">&nbsp;</div>
               </td>
            </tr>
        </tbody>
    </table>
</div>
