<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<div class="content" align="center">
    <form action="<?=url_for("helpdesk/adjuntarArchivo?&id=".$ticket->getCaIdticket() )?>" method="post" name="form1" enctype="multipart/form-data" >
   
<table class="tableList">
    <tr>
		<th colspan="2"><div align="left"><b>Nuevo Adjunto</b></div></th>
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
		
        <td><div align="left"><b> Archivo: </b></div></td>
		<td><div align="left">
            <?
            echo $form['archivo']->renderError();
            echo $form['archivo']->render();
            ?>

            </div></td>
		
	</tr>



     <tr>
		<td colspan="2">
            <div align="center">
                <input type="submit" value="Guardar" class="button" />&nbsp;
                <?                
                $url = "helpdesk/verTicket?id=".$ticket->getCaIdticket();
                ?>
                <input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for($url)?>'" />
            </div>
       </td>
	</tr>

</table>
</form>
</div>


