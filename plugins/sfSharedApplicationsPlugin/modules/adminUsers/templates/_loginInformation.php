<table border="0" class="box1" width="170">
<?

    if ($user->getUserId()){?>
    <tr><b>
        <?

    echo $user->getNombre();?></b></tr><br />
        
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