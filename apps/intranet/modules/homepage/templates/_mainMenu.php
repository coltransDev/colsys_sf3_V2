<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

?>

<a id="touch-menu" class="mobile-menu" href="#"><i class="icon-reorder"></i>Menu</a>
<ul class="menu">
    <li id="current"> <a href="/intranet"><span>Inicio</span></a></li>
    <li id="current"> <a href="#"><span>Colaboradores</span></a>
        <ul class="sub-menu">
            <li><img align="left" src="<?= url_for("images/22x22") ?>/personal.png"><a href="<?=url_for("adminUsers/viewUser?login=".$user->getUserId())?>" >Mi perfil</a></li>                    
            <li><img align="left" src="<?= url_for("images/22x22") ?>/search_user.png"><a href="<?=url_for("adminUsers/directory")?>">Buscar Personas</a></li>
            <li><img align="left" src="<?= url_for("images/22x22") ?>/chart_organization.png"><a href="<?=url_for("adminUsers/viewOrganigrama?login=".$user->getUserId())?>">Organigrama</a></li>
            <?
            if($nivel>=1){
                ?>
                <li><img align="left" src="<?= url_for("images/22x22") ?>/user-new.png"><a href="<?=url_for("adminUsers/formUsuario?key=new")?>">Nuevo Usuario</a></li>
                <li><img align="left" src="<?= url_for("images/22x22") ?>/contact-list.png"><a href="<?=url_for("adminUsers/indexExt5")?>">Listado Usuarios</a></li>
                <?
            //}else if($nivel>=2){
                ?>
                <li><img  align="left" src="<?= url_for("images/22x22") ?>/permisos.png"><a href="<?=url_for("adminPerfiles/index")?>">Permisos</a></li>
                <li><img  align="left" src="<?= url_for("images/22x22") ?>/permisos.png"><a href="<?=url_for("homepage/tomarControl")?>">Tomar Control</a></li>
                <?
            }
            ?>
        </ul>
    </li>
    <li id="current" class=""><a href="<?=url_for('adminUsers/phoneBook')?>"><span>Directorio Telefónico</span></a>
        <ul class="sub-menu">
            <li><img align="left" src="<?= url_for("images/22x22") ?>/phonebook.png"><a href="<?=url_for("adminUsers/listaExtensiones?criterio=buttondirnal")?>">Corporativo</a></li>                    
            <li><img align="left" src="<?= url_for("images/22x22") ?>/company.png"><a href="<?=url_for("adminUsers/phoneBook?criterio=buttoncom")?>">Por Empresa</a></li>
            <li><img align="left" src="<?= url_for("images/22x22") ?>/sucursal.png"><a href="<?=url_for("adminUsers/phoneBook?criterio=buttonsuc")?>">Por Sucursal</a></li>
            <li><img align="left" src="<?= url_for("images/22x22") ?>/departamento.png"><a href="<?=url_for("adminUsers/phoneBook?criterio=buttondep")?>">Por Departamento</a></li>
        </ul>
    </li>
    <li id="current" class=""><a href="<?=url_for('subastas/index')?>"><span>Subastas</span></a></li>
    <li id="current" class=""><a href="<?=url_for('helpdesk/index')?>"><span>Tickets</span></a></li>
    <li id="current" class=""><a href="<?=url_for('/intranet/convivencia/index')?>"><span>Comités</span></a>
        <ul>
            <li><img align="left" src="<?= url_for("images/22x22") ?>/convivencia.png"><a href="<?=url_for('/intranet/convivencia/index')?>">Comité de Convivencia</a></li>                    
            <li><img align="left" src="<?= url_for("images/22x22") ?>/brigadas.png"><a href="<?=url_for("adminUsers/phoneBook?criterio=buttoncom")?>">Brigada de Emergencia</a></li>            
        </ul>
    </li>
    <li id="current" class="active item1"><a href="<?=url_for('/intranet/homepage/videos')?>"><span>Videos</span></a></li>
</ul>
<script>
    $(document).ready(function(){
        var touch = $('#touch-menu');
        var menu = $('.menu');

        $(touch).on('click', function(e) {
            e.preventDefault();
            menu.slideToggle();
        });
        $(window).resize(function(){
            var w = $(window).width();
            if(w > 767 && menu.is(':hidden')) {
                menu.removeAttr('style');
            }
        });
    });
</script>