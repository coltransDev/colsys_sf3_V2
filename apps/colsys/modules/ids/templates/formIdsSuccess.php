<script language="javascript" type="text/javascript">
    var getDV = function(){

        if( document.getElementById("tipo_identificacion").value=="3" ){
            document.getElementById("identificacion").value="";
            document.getElementById("identificacion").disabled=true;
        }else{
            document.getElementById("identificacion").disabled=false;
        }

        if( document.getElementById("tipo_identificacion").value=="1" ){
            var dv = d_verificacion(document.getElementById("identificacion").value);
            document.getElementById("dv").value = dv;
        }else{
            document.getElementById("dv").value = "";
        }
    }
</script>
<div class="content" align="center">

    <form action="<?=url_for("ids/formIds?modo=".$modo."" )?>" method="post" name="form1" >
	<table width="80%" border="0" class="tableList">
	<tr>		
        <th colspan="6"><div align="left"><b>Datos basicos</b></div> </th>
	</tr>

    <?
	if( $form->renderGlobalErrors() ){
	?>
	<tr>
		<td colspan="6">
		 <div align="left"><?php echo $form->renderGlobalErrors() ?>		</div></td>
	</tr>
	<?
	}
	?>
    <tr>
		<td width="22%"> <div align="left"><b>Tipo de identificaci&oacute;n </b></div></td>
		<td width="25%">
             <div align="left">
            <?
            if( !$ids->getCaId() ){
                echo $form['tipo_identificacion']->renderError();
                echo $form['tipo_identificacion']->render();
            }else{
                echo $ids->getCaTipoidentificacion();
            }
            ?>
             </div>
        </td>
		<td width="16%">
             <div align="left">
                   <b>Identificaci&oacute;n</b>
             </div>
        </td>
        
		<td width="26%">
            <div align="left">
            <?
            if( !$ids->getCaId() ){
                echo $form['identificacion']->renderError();
                echo $form['identificacion']->render();
            }else{
                echo $ids->getCaId();
            }
            ?>
            </div>
		<td width="6%">
               <div align="left">
                   <b>DV</b>
               </div>
        </td>
		<td width="5%">
            <div align="left">
            <?
            if( !$ids->getCaId() ){
                echo $form['dv']->renderError();
                echo $form['dv']->render();
            }else{
                echo $ids->getCaDv();
            }
            ?>
            </div>

        </td>
	</tr>
	<tr>
		<td> <div align="left"><b>Nombre</b></div></td>
        <td colspan="5">
             <div align="left">
            <?
            echo $form['nombre']->renderError();
            //$form->setDefault('identificacion', $user->getEmail() );
            echo $form['nombre']->render();
            ?>
             </div>
        </td>
	</tr>
	<tr>
        <td> <div align="left"><b>Website:</b></div></td>
		<td colspan="5">
             <div align="left">
            <?
            echo $form['website']->renderError();
            //$form->setDefault('identificacion', $user->getEmail() );
            echo $form['website']->render();
            ?>
             </div>
        </td>
	</tr>
	<tr>
		<th colspan="6"><div align="left"><b>Oficina Principal:</b></div></th>
		</tr>
	<tr>
		<td> <div align="left">Direcci&oacute;n</div></td>
		<td><div align="left">&nbsp;</div></td>
		<td><div align="left">Ciudad</div></td>
		<td><div align="left">&nbsp;</div></td>
		<td><div align="left">&nbsp;</div></td>
		<td><div align="left">&nbsp;</div></td>
	</tr>
	<tr>
		<td>Telefonos</td>
		<td>&nbsp;</td>
		<td>Fax</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
    <tr>
        <td> <div align="left">Tel&eacute;fonos</div></td>
		<td><div align="left">&nbsp;</div></td>
		<td><div align="left">Fax</div></td>
		<td><div align="left">&nbsp;</div></td>
		<td><div align="left">&nbsp;</div></td>
		<td><div align="left">&nbsp;</div></td>
	</tr>		
    <tr>
		<td colspan="6">
            <div align="center">
                <input type="submit" value="Guardar" class="button" />&nbsp;
                <input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for("ids/index?modo=".$modo)?>'" />
            </div>
       </td>
	</tr>
</table>
    </form>
</div>

<script language="javascript" type="text/javascript">
    getDV();
</script>