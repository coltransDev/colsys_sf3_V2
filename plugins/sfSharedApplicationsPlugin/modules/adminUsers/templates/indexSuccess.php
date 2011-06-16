<div class="content" align="center">

    <table class="tableList alignLeft" border="1">
        <tr >
            <th><b>Login</b></th>
            <th><b>Nombre</b></th>
            <th><b>Cargo</b></th>
            <th><b>Departamento</b></th>
            <th><b>Empresa</b></th>
            <th><b>Activo</b></th>

        </tr>
        <?
        $i = 0;
        foreach ($usuarios as $usuario) {
            ?>
            <tr <?= $usuario->getCaActivo() ? "" : "class='row0'" ?>>
                <td><b><?= $usuario->getCaLogin() ?></b></td>
                <td><a href="<?= url_for("adminUsers/formUsuario?login=" . $usuario->getCaLogin()) ?>"><?= $usuario->getCaNombre() ?></a></td>
                <td><?= $usuario->getCaCargo() ?></td>
                <td><?= $usuario->getCaDepartamento() ?></td>
                <td><?= $usuario->getSucursal()->getEmpresa()->getCaNombre() ?></td>
                <td><?= $usuario->getCaActivo() ? "Activo" : "Inactivo" ?></td>
            </tr>
            <?
        }
        ?>
    </table>
</div>