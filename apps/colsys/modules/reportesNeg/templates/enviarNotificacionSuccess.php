<? //print_r($selec);
?>
<div align="center" class="content">
<br />
    <h1>Se enviar&aacute; una notificaci&oacute;n a los siguientes destinatarios:</h1>

<br />

<form action="<?=url_for("reportesNeg/enviarNotificacion?idreporte=".$reporte->getCaIdreporte())?>" method="post" enctype="multipart/form-data">

<table width="50%" border="0" class="tableList">
<tr>
    <th width="3%" scope="col"><b>P</b></th>
    <th width="3%" scope="col"><b>E</b></th>
	<th width="11%" scope="col"><b>Grupo</b></th>
	<th width="25%" scope="col"><b>Acci&oacute;n</b></th>
	<th width="31%" scope="col"><b>Usuario</b></th>
	<th width="30%" scope="col"><b>e-mail</b></th>
    <th width="30%" scope="col"><b>Sucursal</b></th>
</tr>
<?

foreach( $grupos as $grupo=>$logins ){		
	foreach( $logins as $login ){
		$usuario = Doctrine::getTable("Usuario")->find( $login );
        //echo $login;
        if(!$usuario)
            continue;
        $style="";
        $checked="";
        
        if($login == $selec["ca_idusuario"])
        {
            $style="style='background-color: #4293FF'";
            $checked="checked";
        }
	?>		
    <tr <?=$style?> >
        <td><input type="radio" id="principal" name="principal" value="<?=$login?>" <?=$checked?> ></td>
        <td><input type="checkbox" name="notificar[]" value="<?=$login?>" ></td>
		<td><?=ucfirst($grupo)?></td>
		<td>
            <?
            if( $grupo=="operativo" ){
                echo " Crear reporte al exterior";
            }else{
                echo "Ver reporte";
            }
            ?>
        </td>
		<td><?
				echo $usuario->getCaNombre();				
			?></td>
		<td><?
				echo $usuario->getCaEmail();				
			?></td>
        <td><?
				echo $usuario->getSucursal()->getcaNombre();
			?></td>
	</tr>
	<?
	}	
}

foreach( $gruposObligatorios as $grupo=>$logins ){		
	foreach( $logins as $login ){
		$usuario = Doctrine::getTable("Usuario")->find( $login );
        //echo $login;
        if(!$usuario)
            continue;
        
	?>		
	<tr>
        <td></td>
        <td><input type="checkbox" name="notificar[]" value="<?=$login?>" checked ></td>
		<td><?=ucfirst($grupo)?></td>
		<td>
            <?
            if( $grupo=="operativo" ){
                echo " Crear reporte al exterior";
            }else{
                echo "Ver reporte";
            }
            ?>
        </td>
		<td><?
				echo $usuario->getCaNombre();				
			?></td>
		<td><?
				echo $usuario->getCaEmail();				
			?></td>
        <td><?
				echo $usuario->getSucursal()->getcaNombre();
			?></td>
	</tr>
	<?
	}	
}
?>
    
    <tr>
        <td colspan="5" style="vertical-align:top"><b>Notificar respuestas a:</b><br><input type="text" name="destinatario" id="destinatario" size="100"   /></td>
        <td colspan="2">
            <select multiple size="8" onDblclick="seleccionarContacto()" name="contactos" id="contactos"   >
                <?
                foreach($contactos as $c)
                {
                ?>
                <option value="<?=$c?>"><?=$c?></option>
                <?
                }
                ?>
            </select>
            </td>
    </tr>
    <tr>
        <td colspan="7">
            <div align="left"><b>Mensaje (Opcional)</b><br>
            <textarea name="mensaje" style="width: 99%" rows="2" ><?=isset($message)?$message:""?></textarea></div>
        </td>
    </tr>
    <tr>
        <td colspan="7"><div align="left"><b>Adjuntar Archivo</b><br><input type='file' id='attachment' name='attachment' size="65" /></td></div>
    </tr>
    <tr>
        <td colspan="7">
            <div align="center">
                 <input type="submit" value="Enviar" class="button"> &nbsp;
                 <input type="button" value="Cancelar" class="button" onclick="document.location='<?=url_for("/reportesNeg/verReporte?id=".$reporte->getCaIdreporte())?>'">

            </div>
        </td>
    </tr>
</table>
</form>
</div>
<script>
    var seleccionarContacto = function(){	
	var contactos = document.getElementById("contactos");	
	var selected = contactos.options[contactos.selectedIndex].value;
	var target = document.getElementById('destinatario');	
	
	if( target.value.indexOf(selected)==-1 ){	
		if(target.value){
			target.value+=",";	
		}			
		target.value+=selected;	
	}
	
	
	 
}
</script>