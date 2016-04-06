<?


sfContext::getInstance()->getResponse()->removeStylesheet("/js/ext4/resources/css/ext-all-neptune.css");
sfContext::getInstance()->getResponse()->removeJavascript("ext4/ext-all.js");
sfContext::getInstance()->getResponse()->removeJavascript("ext4/ux/multiupload/swfobject.js");
use_stylesheet('ext/css/ext-all.css');
use_javascript('ext/adapter/ext/ext-base.js');
use_javascript('ext/ext-all.js');
use_javascript('ext/src/locale/ext-lang-es.js');

include_component("pm", "editarTicketWindow", array("nivel"=>$nivel));
?>

<script type="text/javascript">
var crearTicket = function(){
    var win = new EditarTicketWindow();
    win.show();
}
</script>

<div align="center">

<form action="<?=url_for("helpdesk/listaTickets")?>" method="post"> 
<table width="60%" border="1" class="tableList">
  <tr>
    <th colspan="3">Parametros de busqueda </th>
  </tr>
  <tr>
  	<td width="144" valign="top">
		<div align="center">
			<select name="opcion" id="opcion" size="4" onchange="cambiarCriterios(this)">
				<option value="numero" selected="selected">Numero de ticket</option>				
				
			</select>
		</div></td>
  	<td width="317">
		<div id="form1" >
		Ingrese un criterio para realizar la consulta<br />
		<input type="text" name="criterio" />
			
		</div>		
	</td>
  	<td width="71"><div align="center">
  		<input name="submit" type="submit" value="Continuar" />
  		</div></td>
  	</tr>
</table>
</form>

<br />
<br />

<table width="60%" border="1" class="tableList">
	<tr>
		<th scope="col"><b>Busquedas predefinidas</b></th>
	</tr>
	
	<tr class="row0">
		<td><?=link_to("Tickets <b>reportados por mi","helpdesk/listaTickets?opcion=personalizada&actionTicket=Abierto&reportedby=".$user->getUserId())?></b></td>
	</tr>
    <tr class="row1">
		<td><?=link_to("Tickets <b>reportados por mi (Incluyendo cerrados)","helpdesk/listaTickets?opcion=personalizada&reportedby=".$user->getUserId())?></b></td>
	</tr>

    <?
    if( $nivel>0 && $app!="intranet" ){
    ?>
    <tr class="row0">
		<td><?=link_to("Administrador de proyectos","pm/index")?></b></td>
	</tr>
    <?
    }
    ?>
	
</table>

<h3>&nbsp;</h3>

</div>

