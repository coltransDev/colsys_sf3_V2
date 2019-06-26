<div style="margin:20px;">
    <?
    $responses = $sf_data->getRaw("responses");
    $i = 0;
    foreach ($responses as $response) {
        if ($idLastResponse == $response->getCaIdresponse()) {
            $class = "style='background-color:#FFFFCC;border-color:#CCCCCC;border-style:dotted;border-width:1px;margin:12px 0 0;padding:12px 12px 24px;'";
        } else {
            $class = $i % 2 == 0 ? "style='background-color:#F6F6F6;border-color:#CCCCCC;border-style:dotted;border-width:1px;margin:12px 0 0;padding:12px 12px 24px;'" : "style='background-color:#FFFFFF;border-color:#CCCCCC;border-style:dotted;border-width:1px;margin:12px 0 0;padding:12px 12px 24px;'";
        }
        ?>     
        <div <?= $class ?> >
            <div style="float: right;color: #0464BB;"><?= Utils::fechaMes($response->getCaCreatedat()) ?></div>
            <b><?= ($response->getUsuario() ? $response->getUsuario()->getCaNombre() : $response->getCaLogin()) ?></b><span style="font-size: 9px;"> - Ext. <?=$response->getUsuario()->getCaExtension()?></span> 
            <br />
            <?
            $tarea = $response->getNotTarea();
            if ($tarea && $tarea->getCaFchvencimiento()) {
                ?>
                <b>Seguimiento programado:</b> <?= Utils::fechaMes(Utils::parseDate($tarea->getCaFchvencimiento(), "Y-m-d")) ?>
                <br />
                <?
            }
            ?>
            <?//= str_replace("\n", "<br />", $response->getCaText()) ?>
                <!-- -->
            <?= $ticket->getCaIdgroup()!=25?str_replace("\n", "<br />", $response->getCaText()):$response->getCaText() ?>
            <?
            $subResponses = $response->getResponse();
            foreach ($subResponses as $subResponse) {

                if ($idLastResponse == $subResponse->getCaIdresponse()) {
                    $class = "yellow";
                } else {
                    $class = $i % 2 != 0 ? "even" : "odd";
                }
                ?>
                <div class="entry-<?= $class ?>">               
                    <div class="entry-date"><?= Utils::fechaMes($subResponse->getCaCreatedat()) ?></div>
                    <b><?= ($subResponse->getUsuario() ? $subResponse->getUsuario()->getCaNombre() : $subResponse->getCaLogin()) ?></b>


                    <br /><br />
                    <?= str_replace("\n", "<br />", $subResponse->getCaText()) ?>
                </div><br />
                <?
            }

            if ($format != "email" && !$ticket->getCaClosedat()) {
                ?>
                <br />
                <div style="float:right;"><a href="#" onClick="newResponse(<?= $response->getCaIdticket() ?>, <?= $response->getCaIdresponse() ?>, null, '<?= $response->getCaCreatedat() ?>', <?= isset($opener) && $opener ? "'" . $opener . "'" : "" ?>, '<?= $ticket->getCaStatus() ?>', '<?= $status_name ?>','<?=$ticket->getCaIdgroup()?>'/*,'<?//=$ticket->getCaEstimated()?>'*/)">Respuesta</a></div>
                <?
            }
            ?>
        </div>
        <?
        $i++;
    }


    if (count($responses) == 0) {
        ?>
        <h2>No hay respuestas para este ticket</h2>
        <?
    }
    ?>
</div>