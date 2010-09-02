<table border="0" class="box1" width="170">
<tr><img src="<?=url_for('adminUsers/traerImagen?username='.$user->getUserId().'&tamano=30x40')?>" /></tr>

    <?if ($user->getUserId()){?>
        <tr><b><?echo $user->getUserId();?></b></tr>
        <tr><?=link_to("Cerrar Sesi&oacute;n","adminUsers/logout")?></tr>
<?
}else{
?>
    <ul id="usermenu">
        <b><?echo 'A&uacute;n no se ha autenticado';?></b>
    </ul>
<?
}
?>
</table>