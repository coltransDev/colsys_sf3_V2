
<style type="text/css" >

    img.img{
        border: 0px;
    }
    a.link:link {
        text-decoration:none;
        color:#0000FF;
    }
    a.link:active {
        text-decoration:none;
        color:#0000FF;
    }
    a.link:visited {
        text-decoration: none;
        color: #062A7D;
    }
    .entry {
        border-bottom: 1px solid #DDDDDD;
        clear:both;
        padding: 0 0 10px;
    }
    .entry-even {
        background-color:#F6F6F6;
        border-color:#CCCCCC;
        border-style:dotted;
        border-width:1px ;
        margin:12px 0 0;
        padding:12px 12px 24px;
        font-size: 12px;
        font-family: arial, helvetica, sans-serif;

    }
    .entry-odd {
        background-color:#FFFFFF;
        border-color:#CCCCCC;
        border-style:dotted;
        border-width:1px ;
        margin:12px 0 0;
        padding:12px 12px 24px;
        font-size: 12px;
        font-family: arial, helvetica, sans-serif;

    }
    .entry-yellow {
        background-color:#FFFFCC;
        border-color:#CCCCCC;
        border-style:dotted;
        border-width:1px ;
        margin:12px 0 0;
        padding:12px 12px 24px;
        font-size: 12px;
        font-family: arial, helvetica, sans-serif;

    }
    .entry-date{
        float: right;
        color: #0464BB;
    }
</style>

<div class="commentlist">
    <?
    $seguimientos = $sf_data->getRaw("seguimientos");
    $mantenimientos = $sf_data->getRaw("mantenimientos");
    $anotaciones = $sf_data->getRaw("anotaciones");
    $i = 0;
    foreach ($seguimientos as $seguimiento) {
        if ($seguimiento && $i == 0) {
            ?>
            <b><font color="blue">Seguimientos:</font></b>
            <?
        }
        ?>
        <div class="entry-<?= $i++ % 2 == 0 ? "even" : "odd" ?>">
            <div class="entry-date"><?= Utils::fechaMes($seguimiento->getCaFchcreado()) ?></div>
            <b><?= ($seguimiento->getUsuario() ? $seguimiento->getUsuario()->getCaNombre() : $seguimiento->getCaUsucreado()) ?></b>
            <br /><br />
            <?= str_replace("\n", "<br />", $seguimiento->getCaText()) ?>
        </div><br /><br />
        <?
    }
    $i = 0;
    foreach ($mantenimientos as $mantenimiento) {
        if ($mantenimiento && $i == 0) {
            ?>
            <b><font color="blue">Mantenimientos:</font></b>
            <?
        }
        $activo = $mantenimiento->getInvActivo()->getCaIdentificador();
        $marca = $mantenimiento->getInvActivo()->getCaMarca();
        $modelo = $mantenimiento->getInvActivo()->getCaModelo();
        $asignacion = $mantenimiento->getInvActivo()->getUsuario()->getCaNombre();
        $fchmantenimiento = Utils::fechaLarga($mantenimiento->getCaFchmantenimiento());
        $observaciones = str_replace("\n", "<br />", $mantenimiento->getCaObservaciones());
        $fchfirma = $mantenimiento->getCaFchfirma();
        $firma = $mantenimiento->getUsuFirma()->getCaNombre();
        $firmado = $mantenimiento->getCaFirmado();
        $manager = $mantenimiento->getUsuario()->getManager()->getCaLogin();
        $usumant = $usuario->getCaLogin();

        if ($usumant == $manager) {
            $autorizafirma = false;
        } else {
            $autorizafirma = true;
        }
        ?>
        <div class="entry-<?= $i++ % 2 == 0 ? "even" : "odd" ?>">
            <div class="entry-date"><?= Utils::fechaMes($mantenimiento->getCaFchcreado()) ?></div>
            <b><?= ($mantenimiento->getUsuario() ? $mantenimiento->getUsuario()->getCaNombre() : $mantenimiento->getCaUsucreado()) ?></b><br /><br />

            El día <b><?= $fchmantenimiento ?></b> se efectuó Mantenimiento Preventivo en el siguiente equipo: <br /><br />
            Activo: <b><?= $activo ?> - <?= $marca ?> - <?= $modelo ?></b><br />
            Asignado a: <b><?= $asignacion ?></b><br /><br />
            <?
            $labores = $mantenimiento->getInvMantenimientoLabores();
            $j = 1;
            foreach ($labores as $labor) {
                if ($labor && $j == 1) {
                    ?>
                    Labores realizadas: <br />
                    <?
                }
                $etapas = $labor->getInvMantenimientoEtapas()->getCaEtapa();
                echo '  ' . $j . '.  ' . $etapas . '<br />';
                $j++;
            }
            if ($observaciones) {
                ?>
                <br />Por favor tener en cuenta las siguientes observaciones:<br /><br />
                <?
                echo '-' . $observaciones;
            }
            ?>  
            <br /><br />

            <small><b>Firmado por: <? if ($firmado == "firmado") { ?><font color="blue"><?= $firma ?></font><? } elseif ($firmado == "noaceptado") { ?><font color="red"><?= $firma . ' (No aceptado)' ?></font><? } else {
            echo "Este documento aún no se firmado";
        } ?></b></small><br />
            <small><b><? if ($firmado) { ?>Fecha: <?= $fchfirma ? $fchfirma : "" ?><? } ?></b></small>
            <?
            if ($anotaciones) {
                $i = 1;
                foreach ($anotaciones as $anotacion) {
                    if ($anotacion->getCaIdmantenimiento() == $mantenimiento->getCaIdmantenimiento()) {
                        if ($i == 1) {
                            ?>
                            <div class="entry-yellow">
                                <h3>Anotaciones adicionales:</h3><br />
                                <?
                            }
                            ?>
                            <div class="entry-date"><?= Utils::fechaMes($anotacion->getCaFchcreado()) ?></div>
                            &nbsp;<b><?= $anotacion->getUsuario()->getCaNombre() ?> : </b>
                            <?
                            echo $anotacion->getCaAnotacion() . "<br />";
                            $i++;
                            $j = 1;
                        }
                    }
                    if ($j == 1) {
                        ?>              
                        <div style="float:right;"><a href="#" onClick="mostrarAnotacion('<?= $mantenimiento->getCaIdmantenimiento() ?>', '<?= $mantenimiento->getCaIdactivo() ?>', '<?= $autorizafirma ?>', '<?= $activo ?>')">Respuesta</a></div>
                    </div>
                    <?
                }
            }
            ?>
        </div>  
        <?
    }


    $tickets = $sf_data->getRaw("tickets");

    $i = 0;
    foreach ($tickets as $ticket) {
        if ($ticket && $i == 0) {
            ?>
            <b><font color="blue">Tickets:</font></b>
            <?
        }
        ?>
        <div class="entry-<?= $i++ % 2 == 0 ? "even" : "odd" ?>">
            <div class="entry-date"><?= Utils::fechaMes($ticket->getCaOpened()) ?></div>
            <br />
            <b>Ticket # <?= $ticket->getCaIdticket() . ": " . $ticket->getCaTitle() ?></b>
            <br />
            <b>&Aacute;rea:</b> <?= $ticket->getHdeskGroup() ? $ticket->getHdeskGroup()->getCaName() : "" ?>
            <br />
            <b>Reportador por: </b><?= ($ticket->getUsuario() ? $ticket->getUsuario()->getCaNombre() : $ticket->getCaReportedby()) ?>
            <br />
            <b>Asignado a:</b> <?= $ticket->getAssignedTo() ? $ticket->getAssignedTo() : "Sin asignar" ?>
            <br />
            <b>Estado: </b><?= ($ticket->getCaClosedat() ? "Cerrado" : "Abierto") ?>
            <br />
            <b><a href="<?= url_for("pm/verTicket?id=" . $ticket->getCaIdticket()) ?>" target="_blank" >Haga click aca para ver mas detalles</a></b>

            <br />
            <br />
            <?= str_replace("\n", "<br />", $ticket->getCaText()) ?>
        </div><br /><br />
        <?
    }
    ?>
</div>