<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?><table>
<tr>
<div id="cpanel">
    
        <div style="float:left;">
            <div class="icon">
                <a href="<?=url_for("adminUsers/directory")?>">
                    <?=image_tag("64x64/search_user.png")?>
                    <span>Buscar Personas</span>
                </a>
            </div>
        </div>
        <div style="float:left;">
            <div class="icon">
                <a href="<?=url_for("adminUsers/viewUser?login=".$userinicio->getUserId())?>">
                    <?=image_tag("64x64/personal.png")?>
                    <span>Mi perfil</span>
                </a>
            </div>
        </div>
        <div style="float:left;">
            <div class="icon">
                <a href="<?=url_for("adminUsers/viewOrganigrama?login=".$userinicio->getUserId())?>">
                    <?=image_tag("64x64/chart_organization.png")?>
                    <span>Organigrama</span>
                </a>
            </div>
        </div>
 </div>
    </tr>
    <?
    if($nivel>=1){
    ?>
    <tr>
        <div id="cpanel">
            <div style="float:left;">
                <div class="icon">
                    <a href="<?=url_for("adminUsers/formUsuario")?>">
                        <?=image_tag("64x64/user-new.png")?>
                        <span>Nuevo Usuario</span>
                    </a>
                </div>
            </div>
            <div style="float:left;">
                <div class="icon">
                    <a href="<?=url_for("adminUsers/index")?>">
                        <?=image_tag("64x64/contact-list.png")?>
                        <span>Listado Usuarios</span>
                    </a>
                </div>
            </div>
            <div style="float:left;">
                <div class="icon">
                    <a href="<?=url_for("adminUsers/formPermisos")?>">
                        <?=image_tag("64x64/permisos.png")?>
                        <span>Permisos</span>
                    </a>
                </div>
            </div>
        </div>
    <?
    }
    ?>
    </tr>
 </table>

