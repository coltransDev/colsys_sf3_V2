
<font size="2" >Bienvenido a Intranet: <b><?echo link_to($user->getNombre(), "adminUsers/viewUser?login=".$user->getUserId());?></b></font>
<a href="<?=url_for("adminUsers/logout")?>"><img src="<?=url_for("images/22x22")?>/logout_22.png" alt="Salir"></a>
       