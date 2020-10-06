<?
session_start();
?>

<div align="center">
<h3>Cambio de clave</h3>
<br />
<?
if($_SESSION["nintentos"] <= Constantes::PASSW_INTE){
    ?>
    <form action="<?php echo url_for('adminUsers/changePasswd') ?>" method="POST">
        <table width="70%" border="0" cellspacing="0" cellpadding="0" class="tableList">
            <tr><th colspan="2" scope="col">&nbsp; </th></tr>	
            <?
                echo $form;
            ?>	
            <tr><td colspan="2"><div align="center"><input type="submit" class="button" value="Continuar" /></div></td></tr>
        </table>
        <br/>
        <h1><span style="color:red;"><?=$_SESSION["nintentos"]?> de 5 intentos</span></h1><br/>
        <h1>Por favor tenga en cuenta las siguientes recomendaciones al cambiar su clave:</h1><br/>
        <p>La clave debe tener al menos 8 caracteres, 1 n&uacute;mero, 1 may&uacute;scula, 1 min&uacute;scula y 1 car&aacute;cter especial</p>
        <p>La clave debe ser diferente a las 5 claves anteriores</p>    
    </form>
    <?
}else{
    ?>
    <h1>El número de intentos ha acabado. El usuario ha sido inactivado, por favor consultar con el &aacute;rea de Soporte T&eacute;cnico</h1>
    <?=link_to("Salir","adminUsers/logout")?>
<?
}
?>
</div>
