<div class="content"  align="center">
<br />
<h3>Administraci&oacute;n de Perfiles</h3>
<br />
<?
if($app=="intranet"){
    if($nivel>=1)
        echo link_to(image_tag("new.png"), "adminPerfiles/formPerfil")."<br />";
}?>
<br />


<table class="tableList" width="100%" >
<tr >
		
	<th width="25%">Perfil</th>
	<th width="50%">Descripci&oacute;n</th>
	<th width="25%">Opciones</th>
</tr>
<?
$lastDepartamento = "";
foreach( $perfiles as $perfil ){
    if( $lastDepartamento!=$perfil->getCaDepartamento() ){
        $lastDepartamento=$perfil->getCaDepartamento();
        ?>
        <tr class="row0" >
            <td colspan="3"><b><?=$perfil->getCaDepartamento()?$perfil->getCaDepartamento():"Sin departamento"?></b></td>
            
        </tr>
        <?
    }

?>
<tr >	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?=url_for("adminPerfiles/formPerfil?perfil=".$perfil->getCaPerfil())?>"><?=$perfil->getCaNombre()?></a></td>
	<td><?=$perfil->getCaDescripcion()?></td>
	
	<td><?=link_to(image_tag("16x16/unlock.gif")."Permisos", "adminPerfiles/formPermisos?perfil=".$perfil->getCaPerfil())?>&nbsp;<?=link_to(image_tag("16x16/add_user.gif")."Usuarios", "adminPerfiles/formUsers?perfil=".$perfil->getCaPerfil())?></td>
</tr>
<?
}
?>
</table>

</div><br/>