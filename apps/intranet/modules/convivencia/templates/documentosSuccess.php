<?php
$quejas = $sf_data->getRaw("quejas");
$reportes = $sf_data->getRaw("reportes");
$data = $sf_data->getRaw("data");

switch ($tipo){
    case 1:
        ?>
        <h3>Normatividad Vigente</h1>
        <ul>
            <li><a href="<?=url_for('images/docs')?>/Ley_1010_de_2006.pdf" target="_blank"><b>Ley 1010 de Enero 23 de 2010</b></a></li>
            <li><a href="<?=url_for('images/docs')?>/Resolucion_2646_2008.pdf" target="_blank"><b>Resolución 2646 de Julio 16 de 2008</b></a></li>
            <li><a href="<?=url_for('images/docs')?>/Resolucion_652_de_30-04-2012.pdf" target="_blank"><b>Resolución 652 de Abril 30 de 2012</b></a></li>
            <li><a href="<?=url_for('images/docs')?>/Resolucion_1356_2012.pdf" target="_blank"><b>Resolución 1356 de Julio 18 de 2012</b></a></li>
        </ul>
        <?
        break;
    case 2:
        ?>
        <table class="tableList" width="100%">
            <th>REPRESENTANTES GRUPO EMPRESARIAL</th>
            <?
            foreach ($data as $empresa => $val) {
                foreach ($val["Empresa"] as $nombre) {
                    ?>
                    <tr><td><?= $nombre?></td></tr>
                    <?
                }
            }
            ?>
            <th>REPRESENTANTES EMPLEADOS</th>
            <?
            foreach ($data as $empresa => $val) {
                ?>
                    <tr><th><?= $empresa ?></th></tr>
                <?
                foreach ($val["Empleados"] as $nombre) {
                    ?>
                        <tr><td><?= $nombre ?></td></tr>
                    <?
                }
            }
            ?>
        </table>
        <?
        break;
    case 4:
        ?>
        <div id="formulario"></div>
        <script>
            Ext.onReady(function() {
                Ext.Loader.setConfig({
                    enabled: true,    
                    paths: {            
                        'Ext.ux': '/js/ext5/examples/ux/',            
                        'Ext.ux.exporter':'/js/ext5/examples/ux/exporter/',
                        'Colsys':'/js/Colsys'
                    }
                });

                Ext.create('Colsys.Users.FormConvivencia', {                                
                    id:'form-convivencia',
                    name:'form-convivencia',                    
                    title: 'Recepción de Quejas',
                    width: 500,
                    height: 600,
                    bodyPadding: 10,
                    bodyStyle: {            
                        textAlign: 'left'
                    },
                    renderTo: formulario
                })
            });
        </script>      
        <?
        break;
    case 5:
        ?>
        <table class="tableList" width="100%">
            <tr>
                <th colspan="3">MIS QUEJAS</th>
            </tr>
            <tr>
                <th>Fecha</th>
                <th>No. Formulario</th>
                <th>Denunciado</th>
            </tr>
            <?
            if($quejas){
                foreach($quejas as $queja){
                    ?>
                    <tr>
                        <td><?=$queja->getCaFchcreado()?></td>
                        <td><a href="<?=url_for("convivencia/verFormulario?id=").$queja->getCaId()?>">Formulario No. <?=$queja->getCaId()?></a></td>
                        <td><?=$queja->getUsuario()->getCaNombre()?></td>
                    </tr>
                    <?
                }
            }else{
                ?>
                <tr>
                    <td>
                        <b>Usted No ha reportado quejas atrav&eacute;s de &eacute;ste medio</b>
                    </td>
                </tr>
                <?
            }
            ?>
        </table>
        <?
        break;
    case 6:
        ?>
        <table class="tableList" width="100%">
            <tr>
                <th colspan="4">RESUMEN DE QUEJAS</th>
            </tr>
            <tr>
                <th>Fecha</th>
                <th>No. Formulario</th>
                <th>Reportado por</th>
                <th>Denunciando a</th>
            </tr>
            <?
            if($quejas){
                foreach($reportes as $reporte){
                    ?>
                    <tr>
                        <td><?=$reporte->getCaFchcreado()?></td>
                        <td><a href="<?=url_for("convivencia/verFormulario?id=").$reporte->getCaId()?>" target="_blank">Formulario No. <?=$reporte->getCaId()?></a></td>
                        <td><a href="<?=url_for('adminUsers/viewUser?login='.$reporte->getCaUsucreado()) ?>" target="_blank"><?=$reporte->getUsuCreado()->getCaNombre()?></a></td>
                        <td><a href="<?=url_for('adminUsers/viewUser?login='.$reporte->getCaDenunciado()) ?>" target="_blank"><?=$reporte->getUsuario()->getCaNombre()?></td>
                    </tr>
                    <?
                }
            }else{
                ?>
                <tr>
                    <td>
                        <b>Usted No ha reportado quejas atrav&eacute;s de &eacute;ste medio</b>
                    </td>
                </tr>
                <?
            }
            ?>
        </table>
        <?
        break;
}
?>