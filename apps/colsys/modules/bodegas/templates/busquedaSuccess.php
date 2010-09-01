<div class="content" align="center">
    <h1>Lista de Bodegas</h1>
    <?
    $url = "bodegas/busqueda?criterio=".$criterio;
    if( $cadena ) {
        $url.="&cadena=".$cadena;
    }

    if( $tipo ) {
        $url.="&tipo=".$tipo;
    }

    if( $transporte ) {
        $url.="&transporte=".$transporte;
    }

    $pagerLayout = new Doctrine_Pager_Layout(
            $pager,
            new Doctrine_Pager_Range_Sliding(array(
                    'chunk' => 5
            )),
            url_for($url)."?page={%page_number}"
    );

    $pagerLayout->setTemplate('<a href="{%url}">{%page}</a> ');
    $pagerLayout->setSelectedTemplate('{%page}');


    $pagerLayout->display();
    ?>
    <table class="tableList">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Transporte</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bodegas as $bodega): ?>
            <tr>
                <td><a href="<?=url_for('bodegas/formClientePanel?idbodega='.$bodega->getCaIdbodega()) ?>"><?php echo $bodega->getCaIdbodega() ?></a></td>
                <td><?php echo $bodega->getCaNombre() ?></td>
                <td><?php echo $bodega->getCaTipo() ?></td>
                <td><?php echo $bodega->getCaTransporte() ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="<?=url_for('bodegas/formClientePanel') ?>">New</a>
</div>