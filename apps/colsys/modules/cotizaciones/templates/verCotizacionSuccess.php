<?
use_helper( "MimeType");

$enBlanco = $cotizacion->enBlanco();
$dateFormat = new sfDateFormat();

$festivos = TimeUtils::getFestivos();
?>

<div align="center" class="content">  
<?

?>
<script language="javascript" type="text/javascript">
	function showEmailForm(){
		if( document.getElementById('emailForm').style.display=="none"){ 
			document.getElementById('emailForm').style.display="inline"
		}else{
			document.getElementById('emailForm').style.display="none"
		}
	}
	
	function verificarInfo(){
		if( document.getElementById("checkObservaciones").value == "1" ){
			if( document.getElementById("observaciones_idg").value =="" ){
				alert( "Por favor indique el motivo por el cual sobrepaso el limite de tiempo establecido" );
				return false;
			}
		}
		return  true;
	}
	
</script>
<?
if( !$cotizacion->getCaUsuanulado() ){
    $productos = $cotizacion->getCotProductos();
    $trayectosVencidos = 0;
    foreach( $productos as $producto ){
        if( $producto->getCaVigencia()<date("Y-m-d") ){
            $trayectosVencidos++;
        }
    }

    if( $trayectosVencidos>0 ){
    ?>
    <div class="box1" style="width: 830px">
       <?=image_tag("22x22/agt_update_critical.gif")?> <b>Atencion:</b> <?=$trayectosVencidos?> trayectos tienen la vigencia vencida.
    </div>
    <br />
    <?
    }
    if($cotizacion->getEsSeguroContenedor()){
        echo "si";
    }else{
        $conceptos = ParametroTable::retrieveByCaso("CU237");
        
        $idconceptos = array();
        foreach($conceptos as $concepto){
            $idconceptos[] = $concepto->getCaValor();
        }        
    }
    ?>


<div id="emailForm"  style="display:<?=$enBlanco?"inline":"none"?>;">
   
	<form name="form1" id="form1" method="post" action="<?=url_for("cotizaciones/enviarCotizacionEmail?id=".$cotizacion->getCaIdcotizacion())?>" onsubmit="return verificarInfo()">
		<input type="hidden" name="checkObservaciones" id="checkObservaciones" value="" />
	
	<?					 
	$contactos = $cotizacion->getContacto()->getCaEmail();					 
		
	if( $contactos &&  $cotizacion->getCliente()->getCaConfirmar() ){
		$contactos .= ","; 
	}
	if( $cotizacion->getCliente()->getCaConfirmar() ){
		$contactos .=  $cotizacion->getCliente()->getCaConfirmar();
	}
	if( $trayectosVencidos>0 ){
    ?>
        <div align="center" class="rojo">No se puede enviar una cotizaci&oacute;n con trayectos vencidos.</div><br /><br />
    <?
    }else{
	
        include_component("email", "formEmail", array("subject"=>$asunto,"message"=>$mensaje,"contacts"=>$contactos));

        ?>
        <br />


        <table width="700px" border="0" cellspacing="0" cellpadding="0" class="tableList">
            <tr>
                <th><div align="left"><b>Adjuntos:</b>
                </div></th>
            </tr>
            <?php            

            $directorio = $cotizacion->getDirectorio();
            $archivos = sfFinder::type('file')->maxDepth(0)->in($directorio);
            foreach( $archivos as $archivo ){
            ?>
            <tr>
                <td>
                    <div align="left">
                        <input type="checkbox" name="attachments[]" value="<?=base64_encode(basename($archivo))?>" checked="checked">
                            <a href="#"
                               onclick="window.open('<?=url_for("gestDocumental/verArchivo?folder=".base64_encode($cotizacion->getDirectorioBase())."&idarchivo=".base64_encode(basename($archivo)))?>')">
                                <?=basename($archivo)?>
                            </a>
                    </div>
                </td>
            </tr>
            <?php
            }

            if(count($archivos)>0){
                ?>
                <tr>
                    <th>
                        <div align="left" class="qtip" title="Estas notas solo se incluyen cuando se envian archivos por separado"><b>Notas:</b></div>
                    </th>
                </tr>
                <?
                foreach( $notas as $key => $nota ){
                    if( substr($key, -6, 6 )=="Titulo" ){
                ?>
                <tr>
                    <td>
                        <div align="left" class="qtip" title="Estas notas solo se incluyen cuando se envian archivos por separado">
                            <input type="checkbox" name="notas[]" value="<?=substr($key,0 ,strlen($key)-6 )?>">
                            <?=$nota?>
                        </div>
                    </td>
                </tr>
                <?
                    }
                }
            }
            ?>
        </table>
        <br />
        <?
        if( $tarea ){
            if( !$tarea->getCaFchterminada() ){
            ?>
            <table width="700px" border="0" cellspacing="0" cellpadding="0" class="tableList">
                <tr>
                    <th><div align="left"><b>IDG Oferta y Contrataci&oacute;n:</b>
                    </div></th>
                </tr>
                <tr>
                    <td><b>Fecha de solicitud:</b>
                        <?=Utils::fechaMes($dateFormat->format($tarea->getCaFchcreado()) ) ?>
                    </td>
                </tr>
                <tr>
                    <td><b>Fecha de vencimiento:</b>
                        <?=Utils::fechaMes($dateFormat->format($tarea->getCaFchvencimiento()) ) ?>
                    </td>
                </tr>
                <tr>
                    <td><b>Hora actual:</b>
                        <?=Utils::fechaMes( date("Y-m-d H:i:s") ) ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Hora actual - Fecha de vencimiento:</b>
                        <?
                        $diff = $tarea->getTiempoRestante( $festivos );
                        if( substr($diff, 0,1)=="-" ){
                            echo "<span class='rojo'>".$diff."</span>";
                            ?>
                            <script language="javascript" type="text/javascript">
                                document.getElementById("checkObservaciones").value = "1";
                            </script>
                            <?
                        }else{
                            echo $diff;
                        }
                        ?>				
                    </td>
                </tr>
                <tr>
                    <td>
                        Observaciones:
                        <select name="observaciones_idg" id="observaciones_idg">
                            <option value=""></option>
                        <?
                        foreach( $observacionesIdg as $observacion ){
                            ?>
                            <option value="<?=$observacion->getCaValor()?>"><?=$observacion->getCaValor()?></option>
                            <?
                        }
                        ?>
                        </select>
                    </td>
                </tr>
            </table>
            <br />
            <?
            }
        }

        ?>
        <div align="center"><input type="submit" name="commit" value="Enviar" class="button" /></div><br /><br />
    <?
    }
    ?>
    </form>
</div>


<? 
}
if( !$enBlanco  ){
?>	
<iframe src="<?=url_for("cotizaciones/generarPDF".strtr($cotizacion->getCaEmpresa(), "αινσϊ", "aeiou")."?id=".$cotizacion->getCaIdcotizacion()."&token=".md5(time()))?>" width="830px" height="650px"></iframe>

<?
}else{
	if( $cotizacion->getCaUsuanulado() ){
	?>
		<h3>ANULADO</h3>
	<?
	}
}
if( count($emails)>0 ){
?>
<br />
<br />
<table class="tableList">
	<tr >
		<th>Fecha Envio</th>			
		<th>Asunto</th>			
		<th>Destinatarios</th>		
		<th>Email</th>			
	</tr>
<?
	foreach( $emails as $email ){
		?>
		<tr >
			<td><?=$email->getCaFchenvio()?></td>			
			<td>			
			<?=$email->getCaSubject()?></td>			
			<td><?=$email->getCaAddress()?></td>
			
			<td>
				<a href='#' onClick=window.open('<?=url_for("email/verEmail?id=".$email->getCaIdemail())?>')><?=image_tag("22x22/email.gif")?></a>
			</td>			
		</tr>
		<?
	}
?>
</table>
<?

}

if( $tarea && $tarea->getCaFchterminada() ){
            
?>
    <br /><br />
    <table width="700px" border="0" cellspacing="0" cellpadding="0" class="tableList">
        <tr>
            <th><div align="left"><b>IDG Oferta y Contrataci&oacute;n:</b>
            </div></th>
        </tr>
        <tr>
            <td>
                <b>Fecha de solicitud:</b> <?=Utils::fechaMes($dateFormat->format($tarea->getCaFchcreado(), "yyyy-MM-dd") ) ?>  <?=$dateFormat->format($tarea->getCaFchcreado(), "HH:mm:ss")?>
                <br />
                <b>Fecha de presentaci&oacute;n:</b> <?=Utils::fechaMes( $dateFormat->format($tarea->getCaFchterminada(), "yyyy-MM-dd")) ?> <?=$dateFormat->format($tarea->getCaFchterminada(), "HH:mm:ss")?>
                <br />
                <b>Horas habiles:</b>
                <?
                echo $tarea->getTiempo( $festivos );
                ?>

            </td>
        </tr>
        <?
        if($tarea->getCaObservaciones() ){
        ?>
        <tr>
            <td>
                Observaciones:
                <?=$tarea->getCaObservaciones()?>
            </td>
        </tr>
        <?
        }
        ?>
    </table>
<?
}
?>

<br />
</div>
