<table border="0" class="box1" width="170">
<?
	if ($user->getUserId()){?>
        <tr><b><?echo $user->getUserId();?></b></tr><br />
        <tr><?=link_to("Cerrar Sesi&oacute;n","adminUsers/logout")?></tr>
<?
	}else{
?>
    <ul id="usermenu">
        <b><?//echo 'A&uacute;n no se ha autenticado';?></b>
    </ul>
<?
}
?>
</table>