<table border="0" class="box1" width="170" align="right">
    <tr>
        <td nowrap>
            <font size="2" color="white">Bienvenido a Intranet:</font>
        </td>

<?
    if ($user->getUserId()){?>
        <td nowrap>
            <font size="2" color="white">
                <b><?echo $user->getNombre();?></b>
            </font>
        </td>
    </tr>
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