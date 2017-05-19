<?
if (count($usuarios) > 0) {
    ?>
    <div class="storybox">
        <div class="title">Nuevos Colaboradores</div>
        <div class="body">
            <?
            foreach ($usuarios as $usuario) {
                ?>		
                <a href="<?= url_for('adminUsers/viewUser?login=' . $usuario->getCaLogin()) ?>"><?= $usuario->getCaNombre() ?></a>

                <small><?= $usuario->getSucursal()->getEmpresa()->getCaNombre() ?> - <?= $usuario->getSucursal()->getCaNombre() ?><br />
                    &nbsp;&nbsp;&nbsp;<?= $usuario->getCaCargo() ?></small>
                <br />
                <?
            }
            ?>
        </div>
    </div>        
    <?
}
?>