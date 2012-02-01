<?


?>
<script language="javascript" type="text/javascript">
	

</script>

<form name="form1" action="<?=url_for("adminUsers/formColmas?login=".$usuario->getCaLogin())?>" method="post" onsubmit="return checkForm()" enctype="multipart/form-data" >
<div class="content" align="center">    
	<table width="100%" border="0" class="tableList alignLeft">
        <tr>
            <th scope="col">Edici&oacute;n de usuario <b><?=$usuario->getCaNombre()?></b></th>
        </tr>       
        <tr>
            <td>
            <div align="left">
                <b>Listado como:</b>
                <br />

                <select name="cargo_web" >
                    <option value="">No listar</option>
                    <?
                    foreach( $cargos_web as $parametro ){
                    ?>
                    <option value="<?=$parametro->getCaValor()?>" <?=$usuario->getCaCargoweb()==$parametro->getCaValor()?'selected="selected"':''?>><?=$parametro->getCaValor()?></option>
                    <?                                            
                    }
                    ?> 
                </select>
               </div>
            </td>
        </tr>
        <tr>
            <td>
                <div align="left">
                    <b>Identificaci&oacuten:</b>
                    <br />
                    <input name="docidentidad" value="<?=$usuario->getCaDocidentidad() ?>" />
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div align="left">
                    <b>Profesi&oacuten:</b>
                    <br />
                    <input name="profesion" value="<?=$usuario->getCaProfesion() ?>" size="50" maxlength="100" />
                </div>
            </td>
        </tr> 
        <tr>
            <td>
                <div align="left">
                    <b>Experiencia</b>
                    <br />
                    <input name="experiencia" value="<?=$usuario->getCaExperiencia() ?>" size="50" maxlength="100" />
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div align="left">
                    <b>Hoja de Vida</b>
                    <br />
                    <textarea name="hoja_vida" id="hoja_vida" cols="80" rows="30" /><?=$usuario->getCaHojaVida() ?></textarea>
                </div>
            </td>
        </tr>
        <tr>
            <td >
                <div align="center">
                    <input type="submit" value="Guardar" class="button" />&nbsp;
                    <input type="button" value="Cancelar" class="button" onclick="document.location='<?=url_for("adminUsers/viewUser?login=".$usuario->getCaLogin())?>'" />&nbsp;
                </div>
            </td>
        </tr>
    </table>
</div>
</form>


  
<script type="text/javascript">
    var editor = new Ext.form.HtmlEditor({
        applyTo: "hoja_vida",
        enableFont: false,
        enableFontSize: false,
        enableLinks:  false,
        enableSourceEdit : false,
        enableColors : false,
        enableLists: false
    });  
       


</script>

