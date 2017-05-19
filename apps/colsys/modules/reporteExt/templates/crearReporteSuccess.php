<script language="javascript" type="text/javascript">
var verInstruccionesAgente=function(){	
	//document.body.scroll='no';  
	frame = document.getElementById( 'find_texts_frame' );  
	//frame.style.height = document.body.clientHeight-16;  
	ventana = document.getElementById('find_texts');  
	ventana.style.display = '';  				
	ventana.style.top = ( document.getElementById('find_texts').offsetHeight )+"px";
	ventana.style.left = ((screen.width - document.getElementById('find_texts').offsetWidth)/2)+"px";
}
	
var crearSeguimiento=function(){
	if(document.getElementById("prog_seguimiento").checked){
		document.getElementById("row_seguimiento").style.display="";
	}else{
		document.getElementById("row_seguimiento").style.display="none";
	}
}
</script>

<div class="content" align="center">

<div id='find_texts' style='display:none; border-width:3; border-color:#666666; border-style:solid; position:absolute;' >
		<iframe id="find_texts_frame" src="<?=url_for("reporteExt/instruccionesAgentes?transporte=".$reporte->getCaTransporte());?>" scrolling="yes" frameborder="0" marginheight="0" marginwidth="0" width="650px" height="800px"></iframe>	
	</div>
<form action="<?=url_for("reporteExt/crearReporte?idreporte=".$reporte->getCaIdreporte())?>" method="post" enctype="multipart/form-data" >
<table width="60%" border="0" class="tableList">
	<tr>
		<th colspan="2"><div align="center"><b>Nuevo Reporte <?=$reporte->getCaTransporte()?> al exterior </b></div></th>
	</tr>
	<?
	if( $form->renderGlobalErrors() ){
	?>
	<tr>
		<td colspan="2">				
		 <div align="left"><?php echo $form->renderGlobalErrors() ?>		</div></td>	
	</tr>
	<?
	}
	?>	
	<tr>
		<td width="50%" >				
			<div align="left"><b>Cliente:</b><br /><?=$reporte->getCliente()->getCaCompania()?></div>		</td>	
		<td width="50%" >				
			 <div align="left"><b>Reporte:</b><br /><?=$reporte->getCaConsecutivo()." V".$reporte->getCaVersion()?></div>		</td>	
	</tr>
	
	<tr>
		<td valign="top"><div align="left"><b>Remitente:</b>
			<?	
                                            //echo $reporte->getIdsAgente()->getCaIdagente()."..|".$reporte->getIdsAgente()->getCaConsolcargo()."|..";
			if($user->getEmail()=="traficos1@coltrans.com.co" || $user->getEmail()=="traficos2@coltrans.com.co"   ){
                                                    $emailUser=$user->getEmail();
                                                    if($reporte->getIdsAgente()->getCaConsolcargo()=="1")
                                                    {
                                                        $emailUser=substr($user->getEmail(),0, strpos($user->getEmail(),"@")  )."@consolcargo.com";
                                                    }
                                                    
                                                                
				echo $form['remitente']->renderError(); 	
				$form->setDefault('remitente', $emailUser );
				echo $form['remitente']->render();					
			}else{
                                                    if($reporte->getIdsAgente()->getCaConsolcargo()=="1")
                                                    {
                                                        $emailUser=substr($usuario->getCaEmail(),0, strpos($usuario->getCaEmail(),"@")  )."@consolcargo.com";
                                                    }
                                                    else{
                                                        $emailUser=$usuario->getCaEmail();
                                                    }
				echo $usuario->getCaNombre()." &lt;".$emailUser."&gt;";
			}
			?>	
		</div></td>
		<td valign="top"><div align="left">&nbsp;</div></td>
	</tr>
	<tr>
		<td colspan="2" valign="top">
			<div align="left">
				<b>Agente:</b><br />
				<?=$reporte->getIdsAgente()->getIds()->getCaNombre()?>
			</div></td>
		</tr>
	<tr>
		<td valign="top">
			<div align="left" style="max-height:200px; overflow:auto;"><b>Enviar a: </b><br />
			<?					
			$contactos = $form->getContactosAg();
			$ultCiudad = null;			
			foreach( $contactos as $contacto ){
                $sucursal = $contacto->getIdsSucursal();
				if( $ultCiudad!=$sucursal->getCaIdciudad() ){
					$ultCiudad=$sucursal->getCaIdciudad();
					?>
					<div style='background:#EEEEEE; margin-top:2px; padding:2px;' >
						<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$sucursal->getCiudad()->getCaCiudad()?></b>
					</div>
					<?
				}
			?>			
				<div style="margin-top:2px" class="<?=$contacto->getCaSugerido()?"row_yellow":""?>" >
			<?
				echo $form['destinatarios_'.$contacto->getCaIdcontacto() ]->renderError();
				// $form->setDefault('destinatarios_'.$contacto->getCaIdcontacto() , 1 );
				 echo $form['destinatarios_'.$contacto->getCaIdcontacto()]->render();
				 echo $contacto->getNombre()." [".$contacto->getCaEmail()."]<br />";
			?> 
				</div> 
			<?
			}				
			?>		
			</div></td>
		<td valign="top">
			<div align="left"><b>Copiar a: </b>
					<br />
					<?
					for( $i=0; $i<NuevoReporteForm::NUM_CC; $i++ ){
						 echo $form['cc_'.$i]->renderError(); 
						 echo $form['cc_'.$i]->render()."<br />";
		
					}
					?>		
			</div></td>
		</tr>
	<tr>
		<td colspan="2" valign="top"><div align="left"><b>Asunto:</b><br />
			
			<?
			$origen = $reporte->getOrigen()->getCaCiudad();
			$destino = $reporte->getDestino()->getCaCiudad();
			$cliente = $reporte->getCliente();			
			
			$proveedor = substr($reporte->getProveedoresStr(),0,130);					
			$asunto = $proveedor." / ".$cliente." [".$origen." -> ".$destino."] ";					

			 $asunto = " Id.: ".$reporte->getCaConsecutivo()." ".$asunto;
			 echo $form['asunto']->renderError();
			 $form->setDefault('asunto', $asunto); 
			 echo $form['asunto']->render();
			 ?>
			</div>
        </td>
	</tr>
	<tr>
		<td colspan="2" valign="top">
			<div align="left"><b>Introducci&oacute;n al mensaje:</b><br />	
			 <?			
			 echo $form['introduccion']->renderError(); 			 
			 echo $form['introduccion']->render();
			 ?>
			</div>		</td>
	</tr>
	<tr>
		<td colspan="2" valign="top">
			
			<div align="left" id="inst_agente"><b>Instrucciones Especiales para el Agente: <a href="#inst_agente" onclick="verInstruccionesAgente()"><?=image_tag("cerrado.gif")?></a></b>
			<?		
			 echo $form['instrucciones']->renderError();
             $form->setDefault('instrucciones', $reporte->getCaInstrucciones());
			 echo $form['instrucciones']->render();
			 ?>
			 </div>		</td>
	</tr>
	<tr>
		<td colspan="2" valign="top">
			<div align="left">
				<?
                
                if( $reporte->getCaTransporte()==Constantes::MARITIMO || $reporte->getCaTransporte()==Constantes::TERRESTRE ){
                    include_component("reporteExt","reporteMaritimoExtNew", array("reporte"=>$reporte));
                }

                if( $reporte->getCaTransporte()==Constantes::AEREO ){
                    include_component("reporteExt","reporteAereoExtNew", array("reporte"=>$reporte));
                }
                
                
				?>
			</div>
        </td>
	</tr>
<!--        <tr>
		<td colspan="2" valign="top"><div align="left"><b>HBL CONSIGNED TO: </b>		
			 <?			
			 /*echo $form['hbltxt']->renderError(); 
                        $form->setDefault('hbltxt', $hijo);
                        echo $form['hbltxt']->render();*/
			 ?>
		</div></td>
	</tr>
-->        

        
	<tr>
		<td colspan="2" valign="top"><div align="left"><b>Adjuntar Documento: </b>		
			 <?			
			 echo $form['archivo']->renderError(); 			 
			 echo $form['archivo']->render();
			 ?>
		</div></td>
	</tr>
	<tr>
		<td colspan="2" valign="top">
			<div align="left"><b>Comentarios Adicionales:</b><br />	
			 <?			
			 $notas="";             
			 $notas.= "Thks+Rgds,\n\n";
             
                if(  ($reporte->getCaImpoexpo()==Constantes::IMPO || $reporte->getCaImpoexpo()==Constantes::TRIANGULACION) && ($reporte->getCaTransporte()==Constantes::MARITIMO || $reporte->getCaTransporte()==Constantes::AEREO)  )
                {
                    $notas.="Sales Representative : ".$reporte->getUsuario()->getCaNombre()."\n\n";
                }
			 
                if($reporte->getIdsAgente()->getCaConsolcargo()=="1")
                {
                  $notas .= html_entity_decode($usuario->getFirmaConsolcargo());  
                }
                else
                {
                    $notas .= html_entity_decode($usuario->getFirma());
                }
			 
                echo $form['notas']->renderError(); 
                $form->setDefault('notas', $notas);
                echo $form['notas']->render();
                ?>
			</div>		</td>
	</tr>
	
	<?
	//$tarea = $reporte->getNotTarea();
	?>
	<tr>
		<td colspan="2"><div align="left"><b>Programar seguimiento:</b>
			<?
			 echo $form['prog_seguimiento']->renderError(); 
			 /*if( $tarea && $tarea->getCaIdtarea() &&  !$tarea->getCaFchterminada() ){
			 	$form->setDefault('prog_seguimiento', true ); 
			 }*/
			 echo $form['prog_seguimiento']->render();
			 ?>
			 
			 </div></td>
	</tr>
	<tr>
		<td colspan="2" id="row_seguimiento"><div align="left"><b>Fecha seguimiento:</b>
				<?
			 echo $form['fchseguimiento']->renderError();
			 /*if( $tarea && $tarea->getCaIdtarea() && !$tarea->getCaFchterminada() ){
			 	$form->setDefault('fchseguimiento', Utils::parseDate($tarea->getCaFchvencimiento(),"Y-m-d") );
			 }*/
			 echo $form['fchseguimiento']->render();
			 ?>
		</div>			
		<br />
		<div align="left"><b>Recordar sobre:</b>
				<?               
			 echo $form['txtseguimiento']->renderError(); 
			 /*if( $tarea && $tarea->getCaIdtarea() && !$tarea->getCaFchterminada() ){
			 	$form->setDefault('txtseguimiento', $tarea->getCaTexto() ); 
			 }*/
			 echo $form['txtseguimiento']->render();
			 ?>
			</div></td>
		</tr>
	<tr>
		<td colspan="2"><div align="center">
			<input type="submit" value="Enviar" class="button" />&nbsp;
			
			<input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for("traficos/listaStatus?modo=".$modo."&reporte=".$reporte->getCaConsecutivo())?>'" />
		</div></td>
	</tr>
	</table>
</form>
</div>	
<script language="javascript" type="text/javascript">
	crearSeguimiento();
</script>
