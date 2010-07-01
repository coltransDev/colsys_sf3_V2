<table border="0" class="box1" width="170">
    <?if ($user->getUserId()){?>
        <td width="80"><b><?echo $user->getUserId();?></b></td>
        <td width="120">
            <ul id="usermenu">
                <?=link_to("Cerrar Sesi&oacute;n","users/logout")?>
            </ul>
        </td>
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