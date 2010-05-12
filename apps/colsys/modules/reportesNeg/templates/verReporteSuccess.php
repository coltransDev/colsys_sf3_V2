<?

?>
<script language="javascript">
	function showEmailForm(){
		if( document.getElementById('emailForm').style.display=="none"){
			document.getElementById('emailForm').style.display="inline"
		}else{
			document.getElementById('emailForm').style.display="none"
		}
	}
	
</script>
<div class="content" align="center">
    <div id="emailForm"  style="display:none;">
        <form name="form1" id="form1" method="post" action="<?=url_for("reportesNeg/enviarReporteEmail?id=".$reporte->getCaIdreporte())?>" >
        <?

        //,"message"=>$mensaje,"contacts"=>$contactos
        $asunto = "Reporte de Negocio ".$reporte->getCaConsecutivo()." V.".$reporte->getCaVersion();
        include_component("email", "formEmail", array("subject"=>$asunto));

        ?>
        <br />
        <div align="center"><input type="submit" name="commit" value="Enviar" class="button" /></div><br /><br />
        </form>

    </div>

    <?
    if( $reporte->getCaUsuanulado()){
        ?>
        <div style="width:830px" class="box1">
        <? //image_tag("16x16/info.gif")?> Reporte anulado por <?=$reporte->getCaUsuanulado()?> <?=Utils::fechaMes($reporte->getCaFchanulado())?>

        <br />
        <b>Motivo:</b> <?=$reporte->getCaDetanulado()?>
        <br />
        <?
        if( $reporte->getCaUsuanulado()==$user->getUserId() && !$reporte->getCaIdgrupo() ){
            echo link_to("Haga click aca para revivir este reporte", "reportesNeg/revivirReporte?id=".$reporte->getCaIdreporte(), array("confirm"=>"Esta seguro?"));
        }

        if( $reporte->getCaIdgrupo() ){
            echo link_to("Ver reporte ".$reporte->getGrupoReporte()->getCaConsecutivo(), "reportesNeg/consultaReporte?id=".$reporte->getCaIdgrupo());
        }
        ?>
        </div>
        <br />
        <?
    }
    ?>
    <iframe src="<?=url_for("reportesNeg/generarPDF?id=".$reporte->getCaIdreporte()."&token=".md5(time()))?>" width="830px" height="650px"></iframe>
    
    <?
	
	if( $asignaciones || $reporte->getCaIdtareaRext()){
	?>
    <br />
    <br />
    
	<table width="50%" border="0" class="tableList">
		<tr>			
			<th width="28%" scope="col"><b>Acci&oacute;n<b></th>
			<th width="11%" scope="col"><b>Terminada</b></th>
			<th width="31%" scope="col"><b>Usuario</b></th>
			<th width="30%" scope="col"><b>e-mail</b></th>
		</tr>
		<?	
		if( $asignaciones ){	
			foreach( $asignaciones as $asignacion ){	
				$tarea = $asignacion->getNotTarea();	
				$asignacionesTarea  = $tarea->getNotTareaAsignacion();
				foreach( $asignacionesTarea as $asignacionTarea ){		
					$usuario = Doctrine::getTable("Usuario")->find( $asignacionTarea->getCaLogin() );
					?>		
					<tr>
										
						<td>Ver reporte</td>
						<td><?=$tarea->getCaFchterminada()?image_tag("16x16/button_ok.gif"):image_tag("16x16/button_cancel.gif")?></td>	
						<td><?
								echo $usuario->getCaNombre();				
							?></td>
						<td><?
								echo $usuario->getCaEmail();				
							?></td>
					</tr>
					<?
				}
			}
		}
		
		if( $reporte->getCaIdtareaRext() ){
			$tarea = Doctrine::getTable("NotTarea")->find( $reporte->getCaIdtareaRext() );
			$asignacionesTarea  = $tarea->getNotTareaAsignacion();
			$i=0;
			foreach( $asignacionesTarea as $asignacionTarea ){
					
				$usuario = Doctrine::getTable("Usuario")->find( $asignacionTarea->getCaLogin() );
				?>		
			<tr>
				<?
				if( $i==0 ){
				?>				
				<td rowspan="<?=count($asignacionesTarea )?>">Crear reporte al exterior</td>
				<td rowspan="<?=count($asignacionesTarea )?>"><?=$tarea->getCaFchterminada()?image_tag("16x16/button_ok.gif"):image_tag("16x16/button_cancel.gif")?></td>	
				<?
				}
				?>
				<td><?
						echo $usuario->getCaNombre();				
					?></td>
				<td><?
						echo $usuario->getCaEmail();				
					?></td>
			</tr>
		<?
                $i++;
            }
		}
        ?>
        </table>
        <?
	}
    ?>

</div>

<?
include_component("kbase","tooltipById", array("idcategory"=>18));
if( $opcion=="ayudas" ){
    include_component("kbase","tooltipCreator", array("idcategory"=>18));
}
?>