<div class="content">
    <div class="box1" align="center">
        <table class="tableList" border="0">
            <tr><b>Los cambios se han guardado correctamente.</b></tr>
            <?
            if($cambiodireccion==1){
            ?>
            <tr><td></>Usted ha cambiado de domicilio.</td></tr>
            <tr><td></>Esta información fue enviada a:</td></tr>
                <?
                foreach($recips as $recip){
                ?>
                    <tr><td><?=$cargo?>: <b><?=$recip->getCaNombre()?></td></b></tr>
                <?
                }
            }
            ?>
            <tr><td><a href="<?=url_for("adminUsers/formUsuario?login=".$usuario->getCaLogin())?>">Haga click aca para volver</a></td></tr>
        </table>
    </div>
</div>