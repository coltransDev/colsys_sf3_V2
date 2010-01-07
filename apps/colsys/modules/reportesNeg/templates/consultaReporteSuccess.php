<?


?>

<div class="content" >
    <div align="center">
        <h3>Reportes de Negocio</h3>
    </div>
    <br />
    <br />

    <table cellspacing="1" width="80%" align="center" >
        <tr>
            <td>
                <table cellspacing="1" width="100%" class="tableList">
                    <tbody>
                        <tr>
                            <th colspan="6" ><b>Datos del Reporte de Negocio</b></th>
                        </tr>
                        <tr>

                            <td width="122" >
                                <div align="center">
                                      <b>Reporte No.:</b><br />
                                       <?=$reporte->getCaConsecutivo()?>
                                </div>
                            </td>
                            <td width="90"  ><div align="center"><span ><b>Fecha</b></span><br />
                                            <?=Utils::fechaMes($reporte->getCaFchreporte())?>
                            </div></td>
                            <td width="107" ><div align="center"><b>Versi&oacute;n No.</b>:<br />
                                            <?=$reporte->getCaVersion()."/".$reporte->numVersiones()?>
                            </div></td>
                            <td width="85" >
                                  <div align="left">
                                      <b>Cotizaci&oacute;n</b>
                                      <br />
                                        <?=$reporte->getCaIdcotizacion()?>
                                   </div>
                            </td>
                            <td width="173" >&nbsp;</td>
                            <?
                        /*$cotProducto = $reporte->getCotProducto();
                        if( $cotProducto ){

                            $id_cotizacion = $cotProducto->getCaIdcotizacion();
                        }else{

                            $id_cotizacion = null;
                        }*/
                        ?>
                            <td width="102" ><div align="center">
                                <div align="right">

                                        <?=link_to(image_tag("16x16/no.gif")." Anular", "reportesNeg/anularReporte?id=".$reporte->getCaIdreporte(), "confirm='Esta seguro?'")?>  <br />

                                        </div>

                            </div></td>
                        </tr>
                        <tr >
                            <td  colspan="6">
                                <div class="tab-pane" id="tab-pane-1">
                                    <div class="tab-page">
                                        <h2 class="tab">Trayecto</h2>
                                        <?
                                        include_component("reportesNeg", "consultaTrayecto", array("reporte"=>$reporte));
                                        ?>
                                    </div>
                                    <div class="tab-page">
                                        <h2 class="tab">Cliente</h2>

                                        <table class="tableList alignLeft" width="100%">
                                            <tr>
                                                <th colspan="6"><b>Informaci&oacute;n del Cliente</b></th>
                                            </tr>
                                            <tr class="row0">
                                                <td  colspan="6"><b>Cliente</b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" >
                                                    <?
                                                    $contacto = $reporte->getContacto();
                                                    if( $contacto ){
                                                        $cliente = $contacto->getCliente();
                                                    ?>

                                                    <table cellspacing="1" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td width="33%" ><b>Nombre:</b> <?=Utils::replace($cliente->getCaCompania())?></td>
                                                                <td width="33%" ><b>Contacto:</b> <?=Utils::replace($contacto->getNombre())?></td>
                                                                <td width="33%" ><b>Orden:</b><?=$reporte->getCaOrdenClie()?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Direcci&oacute;n:</b> <?=Utils::replace($cliente->getDireccion())?></td>
                                                                <td><b>Tel&eacute;fono:</b> <?=$contacto->getCaTelefonos()?></td>
                                                                <td><b>Fax:</b><?=$contacto->getCaFax()?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Correo   Electr&oacute;nico: </b> <?=$contacto->getCaEmail()?></td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <?
                                                    }
                                                    ?>			</td>
                                            </tr>
                                            <?
                                            if( $reporte->getCaIdproveedor() ){

                                                $values = explode("|", $reporte->getCaIdproveedor() );


                                                foreach( $values as $value ){

                                                ?>
                                                <tr class="row0">
                                                    <td  colspan="6"><b>Proveedor</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" >
                                                        <?
                                                        include_component("reportesNeg", "previewTercero", array("idtercero"=>$value, "reporte"=>$reporte));
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?
                                                }
                                            }

                                            if( $reporte->getCaIdconsignatario() ){
                                            ?>
                                            <tr class="row0">
                                                <td  colspan="6"><b>Consignatario:</b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" >
                                                    <?
                                                    include_component("reportesNeg", "previewTercero", array("idtercero"=>$reporte->getCaIdconsignatario(), "reporte"=>$reporte));
                                                    ?>
                                                </td>
                                            </tr>
                                            <?
                                            }

                                            if( $reporte->getCaIdnotify() ){
                                            ?>
                                            <tr class="row0">
                                                <td  colspan="6"><b>Notify</b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" >
                                                    <?
                                                    include_component("reportesNeg", "previewTercero", array("idtercero"=>$reporte->getCaIdnotify(), "reporte"=>$reporte));
                                                    ?>
                                                </td>
                                            </tr>
                                            <?
                                            }

                                            if( $reporte->getCaIdrepresentante() ){
                                            ?>
                                            <tr class="row0">
                                                <td  colspan="6"><b>Representante</b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" >
                                                    <?
                                                    include_component("reportesNeg", "previewTercero", array("idtercero"=>$reporte->getCaIdrepresentante(), "reporte"=>$reporte));
                                                    ?>
                                                </td>
                                            </tr>
                                            <?
                                            }

                                            if( $reporte->getCaIdmaster() ){
                                            ?>
                                            <tr class="row0">
                                                <td  colspan="6"><b>Consigna. Master:</b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" >
                                                    <?
                                                    include_component("reportesNeg", "previewTercero", array("idtercero"=>$reporte->getCaIdmaster(), "reporte"=>$reporte));
                                                    ?>
                                                </td>
                                            </tr>
                                            <?
                                            }
                                            ?>

                                        </table>
                                    </div>


                                    <div class="tab-page">
                                        <h2 class="tab">Preferencias</h2>
                                        <table class="tableList alignLeft" width="100%">
                                            <tr>
                                                <th colspan="6"><b>Preferencias del cliente</b></th>
                                            </tr>
                                            <tr>

                                                <td  colspan="6">
                                                    <b>Preferencias del Cliente:</b><br />

                                                        <?=Utils::replace($reporte->getCaPreferenciasClie())?>

                                                    </td>
                                            </tr>
                                            <tr>
                                                <td  colspan="6">
                                                    <b>Instrucciones Especiales para el Agente:</b>

                                                    <br />
                                                    <?=Utils::replace($reporte->getCaInstrucciones())?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" >
                                                    <b>Copiar comunicaciones a:</b><br />

                                                        <?=str_replace(",", ", ", $reporte->getCaConfirmarClie()) ?>

                                                </td>
                                            </tr>
                                         </table>
                                    </div>
                                    <?
                                    if($reporte->getCaColmas()=="Sí"){
                                    ?>
                                     <div class="tab-page">
                                        <h2 class="tab">Aduana</h2>
                                        <?
                                        include_component("reportesNeg", "consultaAduana", array("reporte"=>$reporte));
                                        ?>
                                    </div>
                                    <?
                                    }
                                    if($reporte->getCaSeguro()=="Sí"){
                                    ?>
                                     <div class="tab-page">
                                        <h2 class="tab">Seguro</h2>
                                        <?
                                        include_component("reportesNeg", "consultaSeguros", array("reporte"=>$reporte));
                                        ?>

                                    </div>
                                    <?
                                    }
                                    if($reporte->getCaImpoexpo()==Constantes::EXPO){
                                    ?>
                                     <div class="tab-page">
                                        <h2 class="tab">Exportaciones</h2>
                                        <?
                                        include_component("reportesNeg", "consultaExportaciones", array("reporte"=>$reporte));
                                        ?>
                                    </div>
                                    <?
                                    }

                                    if($reporte->getCaImpoexpo()==Constantes::IMPO){
                                    ?>
                                     <div class="tab-page">
                                        <h2 class="tab">Rep. Exterior</h2>
                                        <?
                                        if( $reporte->getCaTransporte()==Constantes::MARITIMO ){
                                            include_component("reporteExt","reporteMaritimoExt", array("reporte"=>$reporte));
                                        }

                                        if( $reporte->getCaTransporte()==Constantes::AEREO ){
                                            include_component("reporteExt","reporteAereoExt", array("reporte"=>$reporte));
                                        }
                                        ?>
                                    </div>
                                    <?
                                    }
                                    ?>


                                </div>


                            </td>
                        </tr>



                        <tr class="row0">
                            <td  colspan="6"><div align="center"><b>Conceptos de Embarque </b></div></td>
                        </tr>
                   </table>
                </td>
            </tr>

            <tr>
                <td colspan="7">
                    <div id="panel-conceptos"></div>
                </td>
            </tr>
            <?


        $usuario = $reporte->getUsuario();
        $sucursal = $usuario->getSucursal();
        ?>
        <tr>
            <td colspan="6"  >
                <table cellspacing="0" width="100%" class="tableList alignLeft">
                    <tbody>
                        <tr class="row0">
                            <td width="25%" ><b>Ciudad :</b><br />
                                    <?=$sucursal?$sucursal->getCaNombre():""?>
                                    </td>
                            <td width="25%">
                                <div align="left">
                                    <b>Elaborado por:</b><br />
                                    <?=$reporte->getCaUsucreado()?> <?=UTils::fechaMes($reporte->getCaFchcreado())?>
                                </div>
                            </td>
                            <td width="25%">
                                <div align="left">
                                    <b>Actualizado por:</b><br />
                                    <?=$reporte->getCaUsuactualizado()?$reporte->getCaUsuactualizado():"&nbsp;"?> <?=UTils::fechaMes( $reporte->getCaFchactualizado() )?>
                                </div>
                            </td>
                            <td width="25%">
                                <div align="left">
                                    <b>Rep. Comercial:</b><br />
                                    <?=$usuario->getCaNombre()?>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <br />
 
</div>
<?

include_component("reportesNeg","mainPanel", array("reporte"=>$reporte));
if( !$reporte->esSoloAduana() ){
    include_component("reportesNeg","panelConceptosFletes", array("reporte"=>$reporte));
    $panelConceptosFletes = true;
    if( $reporte->getCaImpoexpo()!=Constantes::EXPO ){
        include_component("reportesNeg","panelRecargos", array("reporte"=>$reporte));
        $panelRecargos = true;
    }else{
        $panelRecargos = false;
    }
}else{
    $panelConceptosFletes = false;
    $panelRecargos = false;
}

if( $reporte->getCaColmas()=="Sí" || $reporte->getCaTransporte() == Constantes::ADUANA ){
    include_component("reportesNeg","panelRecargosAduana", array("reporte"=>$reporte));
    $panelAduana = true;
}else{
    $panelAduana = false;
}

?>
<script language="javascript">
      
    var guardarCambios = function(){
        <?
        if( $panelConceptosFletes ){
        ?>
            panelFletes.guardarCambios();
        <?
        }
        if( $panelRecargos ){
        ?>
            panelRecargosLocales.guardarCambios();
        <?
        }
        if( $panelAduana ){
        ?>
            panelRecargosAduana.guardarCambios();
        <?
        }
    ?>
    }

    <?
    if( $panelConceptosFletes ){
    ?>
        var panelFletes = new PanelConceptosFletes({
            title: 'Conceptos de fletes'
        });
    <?
    }
    if( $panelRecargos ){
    ?>
        var panelRecargosLocales = new PanelRecargos({
            title: 'Recargos locales'
        });
    <?
    }
    if( $panelAduana ){
        ?>
        var panelRecargosAduana = new PanelRecargosAduana({
            title: 'Recargos Aduana'
        });
        <?
    }
    ?>

      


      


      

      tbarObj = [{
            text:'Guardar',            
            iconCls: 'disk',
            scope:this,
            handler: guardarCambios
        },
        '-'
        /*,
        {
            text:'Importar Cotizacion',
            iconCls: 'import',
            scope:this,
            handler: guardarCambios
        },
        {
            text:'Importar del tarifario',
            iconCls: 'import',
            scope:this,
            handler: guardarCambios
        }*/

      ]

      var mainPanel = new MainPanel({
                            width: 800,
                            height: 400,                            
                            items: [
                                    <?
                                    $flag = false;
                                    if( $panelConceptosFletes ){
                                    ?>
                                    panelFletes
                                    <?
                                        $flag = true;
                                    }
                                    if( $panelRecargos ){
                                        if( $flag ){
                                            echo ",";
                                        }
                                        $flag = true;
                                    ?>
                                        panelRecargosLocales
                                    <?
                                    }
                                    if( $panelAduana ){
                                        if( $flag ){
                                            echo ",";
                                        }
                                        $flag = true;                                    
                                    ?>
                                        panelRecargosAduana
                                    <?
                                    }
                                    ?>
                                   ],
                            tbar: tbarObj

                      });
      mainPanel.render("panel-conceptos");

      mainPanel.setWidth(Ext.getBody().getWidth()-250);


</script>