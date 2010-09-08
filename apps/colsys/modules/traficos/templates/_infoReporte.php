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
			
		</div>
		<br />
		<div class="post-info" align="left">
		<b>Recordatorios</b><br />
		<?
        $url = "traficos/formSeguimiento?modo=".$modo."&reporte=".$reporte->getCaConsecutivo();
        $tareas = $reporte->getTareas( Reporte::IDLISTASEG );
        if( count($tareas)>0 ){
            foreach( $tareas as $tarea ){
                

                //if( $tarea && $tarea->getCaIdtarea() && !$tarea->getCaFchterminada() ){
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
                    //echo link_to(image_tag("22x22/todo.gif")." Editar", )."<br />";
                //}
            }
        }else{
            echo "No se ha creado ning&uacute;n seguimiento.<br />";
        }
        echo link_to(image_tag("22x22/todo.gif")." Nuevo", $url);
		?>	
		</div>
		<br />
		
		<?
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
				</div>		
										
				<br />
				<?
				
				if( $nivel>0 && !$reporte->getCaUsuanulado() ){
					if( $reporte->getCaTransporte()==Constantes::MARITIMO ){
						echo link_to(image_tag("22x22/edit_add.gif")." Aviso" ,"traficos/nuevoStatus?idreporte=".$reporte->getCaIdreporte()."&modo=".$modo."&tipo=aviso&token=".md5(time()));
						
					}
					echo link_to(image_tag("22x22/edit_add.gif")." Status","traficos/nuevoStatus?idreporte=".$reporte->getCaIdreporte()."&modo=".$modo."&tipo=status&token=".md5(time()));
					
					
									
				}	
				?>
			</div>
		
		</td>
		<td width="28%" valign="top">
			<div class="post-info" align="left">
		 	<b>Documentos</b><br />	
				
			<?
				if( $reporte->getCaImpoexpo()==Constantes::EXPO ){	
					$url = url_for("reportes/generarPDF?reporteId=".$reporte->getCaIdreporte()."&token=".md5(time().basename($reporte->getCaIdreporte())));
				}else{				
					$url = "/colsys_php/reporteneg.php?id=".$reporte->getCaIdreporte();
				}
				
				echo mime_type_icon( "pdf" );
				?>
				<a onclick="popup('<?=$url?>')" id="50440', '800', '600' , 'myWindow')" href="#">Reporte</a>
				</li></ul>
				<div id="archivosReporte_<?=$reporte->getCaIdreporte()?>" >
				<?
				include_component("traficos", "verArchivosReporte", array("reporte"=>$reporte, "nivel"=>$nivel));				
				?>
				</div>
				
			
		</div>
		<br />
		<div class="post-info" align="left">
		<b>Acciones</b><br />
		<a href="#" onClick="actualizar(<?=$reporte->getCaIdreporte()?>)"><?=image_tag("16x16/reload.png")?> Actualizar</a>
        <br />        
        <div class="qtip" title="Cierra el caso para que no aparezca en los reportes activos">
        <?=link_to(image_tag("16x16/endturn.png")." Cerrar (Sacar del tracking)", "traficos/cerrarCaso?idreporte=".$reporte->getCaIdreporte()."&modo=".$modo, array("confirm"=>"Esta seguro que desea cerrar el caso?") )?>
        </div>
        </div>
		
		</td>
	</tr>
</table>
