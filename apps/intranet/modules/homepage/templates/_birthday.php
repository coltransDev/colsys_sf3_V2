<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (count($usuarios) > 0) {
    ?>
    <br />
    <div class="storybox">
        <div class="title"><span>Cumplea&ntilde;os</span></div>
        <div class="body">
            <?
            $hoy = 0;
            $manana = 0;
            $pasado = 0;
            $posterior = 0;
            foreach ($usuarios as $usuario) {
                if (Utils::parseDate($usuario->getCaCumpleanos(), 'm-d') == date('m-d')) {
                    if ($hoy == 0) {
                        ?>
                        <b>Hoy</b><br/>
                        <?
                        $hoy = $hoy + 1;
                    }
                } elseif (Utils::parseDate($usuario->getCaCumpleanos(), 'm-d') == date('m-d', time() + 86400)) {
                    if ($manana == 0) {
                        ?>
                        <b>Ma&ntilde;ana</b><br/>
                        <?
                        $manana = $manana + 1;
                    }
                } elseif (Utils::parseDate($usuario->getCaCumpleanos(), 'm-d') == date('m-d', time() + 86400 * 2)) {
                    if ($pasado == 0) {
                        ?>
                        <b>Pasado ma&ntilde;ana</b><br/>
                        <?
                        $pasado = $pasado + 1;
                    }
                } else {
                    $day = Utils::parseDate($usuario->getCaCumpleanos(), 'M-d');
                    if ($posterior == 0) {
                        ?>
                        <br /><b><? echo $day; ?></b><br/>
                        <?
                        $posterior = $posterior + 1;
                    }
                }
                ?>
                <a href="<?= url_for('adminUsers/viewUser?login=' . $usuario->getCaLogin()) ?>"><?= $usuario->getCaNombre() ?></a> <small><?= $usuario->getSucursal()->getEmpresa()->getCaNombre() ?> - <?= $usuario->getSucursal()->getCaNombre() ?></small><br />
                <?
            }
            ?>
        </div>
    </div>
    <?
}
?>