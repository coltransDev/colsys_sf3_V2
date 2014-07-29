<?
if( $reporte->getCaUsuanulado() ){
    $nivel = 0;
}
?>
<table width="100%" border="0">
    <tr>
        <td width="26%" valign="top">
            <div class="post-info" align="left">
                <b>Informaci&oacute;n general</b><br />				
                    <?					
                    if( $reporte->getCaUsuanulado() ){
                        echo "<b>Anulado por:</b> ".$reporte->getCaUsuanulado()." ".$reporte->getCaFchanulado()."<br />";
                    }
                    ?>
                    <b>Transporte:</b> <?=$reporte->getCaTransporte()?><br />
                    <b>Modalidad:</b> <?=$reporte->getCaModalidad()?><br />					
                    <b>Orden:</b> <?=$reporte->getCaOrdenClie()?>				
                    <?
                    $numReferencia = $reporte->getNumReferencia();
                    if( $numReferencia ){
                        echo "<br /><b>Referencia:</b> ".$numReferencia; 						
                    }				
                    ?><br />
                    <?
                    if( $reporte->getETS() ){
                        ?>	
                        <b>ETD:</b> <?=Utils::fechaMes($reporte->getETS("Y-m-d"))?><br />
                        <?
                    }
                    if( $reporte->getETA() ){
                        ?>			
                        <b>ETA:</b> <?=Utils::fechaMes($reporte->getETA("Y-m-d"))?><br />
                        <?
                    }
                    ?>
                    <b>Piezas:</b> <?=$reporte->getPiezas()?><br />
                    <b>Peso:</b> <?=$reporte->getPeso()?><br />
                    <b>Volumen:</b> <?=$reporte->getVolumen()?><br />
                    <b><?=$reporte->getCaTransporte()==Constantes::MARITIMO?"HBL:":"HAWB:"?></b> <?=$reporte->getDocTransporte()?><br />
                    <b><?=$reporte->getCaTransporte()==Constantes::MARITIMO?"MN:":"Vuelo:"?></b> <?=$reporte->getIdnave()

                    ?><br />
                    <?
                    $equipos = $reporte->getRepEquipos();
                    if( $reporte->getCaModalidad()=="FCL" && count($equipos)> 0 ){
                        ?>
                        <b>Relación de Contenedores:</b><br />
                        <table width="100%" cellspacing="0" border="1" class="tableList">
                            <tr>
                                <th>Concepto</th>
                                <th>Cantidad</th>
                                <?
                                if( $reporte->getCaImpoexpo()==Constantes::EXPO ){
                                ?>
                                <th>Serial</th>
                                <?
                                }
                                ?>
                                <th>Observaciones</th>
                            </tr>
                            <?
                        foreach( $equipos as $equipo ){
                            ?>
                            <tr>
                                <td><?=$equipo->getConcepto()->getCaConcepto()?></td>
                                <td><?=$equipo->getCaCantidad()?></td>
                                <?
                                if( $reporte->getCaImpoexpo()==Constantes::EXPO ){
                                    ?>
                                    <td><?=$equipo->getCaIdequipo()?></td>
                                    <?
                                }
                                ?>
                                <td><?=$equipo->getCaObservaciones()?$equipo->getCaObservaciones():"&nbsp;"?></td>
                            </tr>
                            <?
                        }
                        ?>
                        </table>
                    <?
                    }
                ?>

            </div><br />
            <div class="post-info" align="left">
		<b>Recordatorios</b><br />
		<?
                $url = "traficos/formSeguimiento?modo=".$modo."&reporte=".$reporte->getCaConsecutivo();
                $tareas = $reporte->getTareas( Reporte::IDLISTASEG );
                if( count($tareas)>0 ){
                    foreach( $tareas as $tarea ){
                        echo link_to(Utils::fechaMes(Utils::parseDate($tarea->getCaFchvencimiento(),"Y-m-d")),$url."&idtarea=".$tarea->getCaIdtarea());
                        if( !$tarea->getCaFchterminada() ){
                            ?>
                            <span id="res_<?=$tarea->getCaIdtarea()?>">
                                <a href="#sec_<?=$reporte->getCaConsecutivo()?>" onClick="terminarTarea('<?=$reporte->getCaConsecutivo()?>', '<?=$tarea->getCaIdtarea()?>')">(Terminar)</a>
                            </span>
                        <?
                        }else{
                            echo " <b>OK</b>";
                        }
                        echo "<br />".$tarea->getCaTexto()."<br />";
                    }
                }else{
                    echo "No se ha creado ning&uacute;n seguimiento.<br />";
                }
                echo link_to(image_tag("22x22/todo.gif")." Nuevo", $url);
		?>	
            </div><br />

            <?
            $tarea = $reporte->getNotTareaAntecedente();
            if( $tarea && $tarea->getCaFchvencimiento() ){
                if( $tarea->getCaFchterminada() ){
                    ?>
                    <div class="post-info" align="left">
                        <b>Antecedentes</b><br />
                        <?=image_tag("22x22/agt_action_success.gif");?> Se entregaron antecedentes el: <br />
                        <b> <?=Utils::fechaMes($tarea->getCaFchterminada())?> </b>
                    </div><br />
                    <?
                }else{
                    ?>
                    <div class="post-info" align="left">
                        <b>Antecedentes</b><br />
                        <?=image_tag("22x22/agt_update_critical.gif");?> Debe entregar antecedentes antes de: <br />
                        <b> <?=Utils::fechaMes($tarea->getCaFchvencimiento())?> </b>
                    </div><br />
                    <?
                }
            }
            if( $reporte->getCaImpoexpo()==Constantes::IMPO || $reporte->getCaImpoexpo()==Constantes::TRIANGULACION ){
                ?>
                <div class="post-info" align="left">
                    <b>Reportes al exterior</b><br />	
                    <?
                    if( $reportesExt ){
                        foreach( $reportesExt as $reporteExt ){
                                $txt = 	$reporteExt->getCaUsuenvio()." ".$reporteExt->getCaFchenvio();
                        ?>
                        <a href='#' onClick='window.open("<?=url_for("email/verEmail?id=".$reporteExt->getCaIdemail())?>")' ><b><?=$txt?></b></a>
                        <br />
                        <?=$reporteExt->getCaSubject()?>
                        <br /><br />
                        <?	
                        }
                    }else{
                        echo "No se han creado reportes al exterior<br />";
                    }
                    if( $nivel>0 && !$reporte->getCaUsuanulado() ){
                            echo link_to(image_tag("22x22/edit_add.gif")." Rep. Exterior","reporteExt/crearReporte?idreporte=".$reporte->getCaIdreporte() );
                    }
                    ?>
                </div>
                <?
            }
            ?>
        </td>
        <td width="46%" valign="top">
            <div class="post-info" align="left">
                <b>Historial</b><br />
                <div id="hist_<?=$reporte->getCaIdreporte()?>">
                    <?
                        include_component("traficos", "historialStatus", array("reporte"=>$reporte));
                    ?>
                </div><br />
                <?
                if( $nivel>0 && !$reporte->getCaUsuanulado() ){
                    if( $reporte->getCaTransporte()==Constantes::MARITIMO ){
                        echo link_to(image_tag("22x22/edit_add.gif")." Aviso" ,"traficos/nuevoStatus?idreporte=".$reporte->getCaIdreporte()."&modo=".$modo."&tipo=aviso&token=".md5(time()));
                    }
                    echo link_to(image_tag("22x22/edit_add.gif")." Status","traficos/nuevoStatus?idreporte=".$reporte->getCaIdreporte()."&modo=".$modo."&tipo=status&token=".md5(time()));
                    $cliente=$reporte->getCliente();

                    if($cliente->getProperty("cuentaglobal")){
                        ?>
                            &nbsp;&nbsp;<img src="/images/CG30.png" title="Cliente de Cuentas Globales" />
                        <?
                    }					
                    if($cliente->getProperty("consolidar_comunicaciones")){
                        ?>
                            &nbsp;&nbsp;<img src="/images/consolidate.png" title="Cliente de Cuadro" />
                        <?
                    }
                }	
                ?>
            </div>
        </td>
        <td width="28%" valign="top">
            <div class="post-info" align="left">
                <b>Documentos</b><br />	
                <?
                    $url = url_for("reportes/verReporte?id=".$reporte->getCaIdreporte()."&token=".md5(time().basename($reporte->getCaIdreporte())));
                    echo mime_type_icon( "pdf" );
                ?>
                    <a href="<?=$url?>" target="_blank">Reporte</a>

                    <div id="archivosReporte_<?=$reporte->getCaIdreporte()?>" >
                        <?
                        include_component("traficos", "verArchivosReporte", array("reporte"=>$reporte, "nivel"=>$nivel));				
                        ?>
                    </div>
                    <div class="box1" style="margin: 3px;">
                        <table class="tableForm" width="100%" border="0">
                            <?
                                include_component("traficos", "uploadClientes",array("reporte"=>$reporte,"modo"=>$modo));
                            ?>
                        </table>
                    </div>
            </div><br />
            <div class="post-info" align="left">
            <b>Acciones</b><br />
                <a href="#" onClick="actualizar(<?=$reporte->getCaIdreporte()?>)"><?=image_tag("16x16/reload.png")?> Actualizar</a><br />        
                <div class="" title="Cierra el caso para que no aparezca en los reportes activos">
                    <?=link_to(image_tag("16x16/endturn.png")." Cerrar (Sacar del tracking)", "traficos/cerrarCaso?idreporte=".$reporte->getCaIdreporte()."&modo=".$modo, array("confirm"=>"Esta seguro que desea cerrar el caso?") )?>
                </div>
            </div><br />
                <?
                if($enableparam){
                    ?>
                    <div class="post-info" align="left">
                        <b>Información adicional para IDG</b><br />
                        <?
                        if(count($parametros)>0){
                            foreach ($parametros as $parametro) {

                                $valor = explode(":", $parametro->getCaValor());
                                $name = $valor[0];
                                $type = $valor[1];

                                $this->widgetsClientes[$name] = array("type" => $type, "label" => $parametro->getCaValor2());
                                echo "<b>".$parametro->getCaValor2().": </b>".$reporte->getProperty($name)."</br>";
                            }
                            $url = url_for("traficos/formParametros?idreporte=".$reporte->getCaIdreporte()."&modo=".$modo);
                            echo link_to(image_tag("22x22/edit.gif")." Editar", $url);
                        }
                        ?>
                    </div>
                <?
                }
            ?>
        </td>
   </tr>
</table>