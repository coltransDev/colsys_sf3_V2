<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<div align="center">
<form name="form1" action="<?=url_for("helpdesk/agregarUsuario?id=".$ticket->getCaIdticket())?>" method="post">
<br>
<h1>Agregar un usuario a el ticket # <?=$ticket->getCaIdticket()?></h1>
<br>

<table width="50%" border="1" class="tableList">
	<tr>
		<th colspan="2">Por favor seleccione un usuario</th>
	</tr>
	<?=$form?>
	<tr>
		<th colspan="2">
            <div align="center">
                <input type="submit" value="Agregar" class="button">
                 <?
                $url = "helpdesk/verTicket?id=".$ticket->getCaIdticket();
                ?>
                <input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for($url)?>'" />
            </div>
        </th>
	</tr>
</table>

</form>
</div>