<?

$festivos = TimeUtils::getFestivos();

if( count($listaTareas)>0 ){
?>
<div class="content-box">
<h5>TAREAS PENDIENTES</h5>
    <div class="content-box">
        <p>Usted tiene las siguientes tareas:</p>
<?
	foreach( $listaTareas as $lista ){
		$tareas = $lista->getTareasPendientes( $user );	
	?>
	<br />
	
	<div class="taskListHead_<?=count($listaTareas)==1?"expanded":"collapsed"?>" onclick="expandCollapse( this, 'taskListBody_<?=$lista->getCaIdlistatarea()?>', 'taskListHead')">
        <div class="qtip" title="<?=$lista->getCaDescripcion()?>">
            <b><?=$lista->getCaNombre()?> (<?=count($tareas)?> Tarea<?=count($tareas)!=1?"s":""?>)</b>
        </div>
	</div>	
	<div class="nota"></div>
	<br />	
	
	<div id="taskListBody_<?=$lista->getCaIdlistatarea()?>" style="display:<?=count($listaTareas)==1?"inline":"none"?>">
	<table width="100%" border="0"  >
		
		<?
		
		foreach( $tareas as $tarea ){
		?>
		<tr id="<?=$tarea->getCaIdtarea()?>">
			<td width="75%"><div class="qtip" title="<?=$tarea->getCaTexto()?>"><?=link_to( $tarea->getCaTitulo(), "notificaciones/realizarTarea?id=".$tarea->getCaIdtarea() )?>
                <a href="#" onclick="eliminar('<?=$tarea->getCaIdtarea()?>','<?=$tarea->getCaIdtarea()?>')"><?=image_tag( "16x16/delete.gif" ,'size=18x18 border=0' )?></a></div>
                </td>
			
			<td width="25%"><?=Utils::fechaMes($tarea->getCaFchvencimiento())?></td>
		</tr>
		<?
		}
		?>
	</table>	
	</div>
	<?
	}
	?>
	<br />
	<br />
	</div>
 </div>
<script language="javascript" type="text/javascript">

    function eliminar(tarea, idtr)
    {
        if(window.confirm("Realmente desea eliminar ésta tarea?"))
        {
            //Ext.MessageBox.wait('Guardando, Espere por favor', '---');
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?= url_for("notificaciones/borrarTarea") ?>',
                params :	{
                    idtarea:tarea
                },
                failure:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if(res.err)
                        Ext.MessageBox.alert("Mensaje",'Se presento un error guardando por favor informe al Depto. de Sistemas<br>'+res.err);
                    else
                        Ext.MessageBox.alert("Mensaje",'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>'+res.texto);
                },
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    $("#"+idtr).remove();
                    Ext.MessageBox.hide();
                }
            });
        }
    }
</script>
<?
}
?>