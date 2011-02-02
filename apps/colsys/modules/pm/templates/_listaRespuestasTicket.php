<div class="commentlist">
<?

$responses = $sf_data->getRaw("responses");
$i=0;
foreach( $responses as $response ){
    if( $idLastResponse==$response->getCaIdresponse() ){
        $class = "yellow";
    }else{
        $class = $i%2==0?"even":"odd";
    }
    ?>     
        <div class="entry-<?=$class?>">
        <div class="entry-date"><?=Utils::fechaMes($response->getCaCreatedat())?></div>
        <b><?=($response->getUsuario()?$response->getUsuario()->getCaNombre():$response->getCaLogin())?></b>


        <br />
        <?
        $tarea = $response->getNotTarea();
        if( $tarea && $tarea->getCaFchvencimiento() ){
        ?>
        <b>Seguimiento programado:</b> <?=Utils::fechaMes(Utils::parseDate($tarea->getCaFchvencimiento(), "Y-m-d"))?>
        <br />
        <?
        }
        ?>

        <?=str_replace("\n","<br />",$response->getCaText())?>


        <?

        $subResponses = $response->getResponse();        
        foreach( $subResponses as $subResponse ){

            if( $idLastResponse==$subResponse->getCaIdresponse() ){
                $class = "yellow";
            }else{
                $class = $i%2!=0?"even":"odd";
            }
        ?>
            <div class="entry-<?=$class?>">               
                <div class="entry-date"><?=Utils::fechaMes($subResponse->getCaCreatedat())?></div>
                <b><?=($subResponse->getUsuario()?$subResponse->getUsuario()->getCaNombre():$subResponse->getCaLogin())?></b>


                <br /><br />
                <?=str_replace("\n","<br />",$subResponse->getCaText())?>
            </div>
            <br />
        <?

        }



        if( $format!="email"){
        ?>
        <br />
        <div style="float:right;"><a href="#" onClick="newResponse(<?=$response->getCaIdticket()?>, <?=$response->getCaIdresponse()?> , null, null, <?=isset($opener)&&$opener?", '".$opener."'":""?>)">Respuesta</a></div>
        <?
        }
        ?>
    </div>
    <?
    $i++;

    
}


if( count($responses)==0 ){
?>
    <h2>No hay respuestas para este ticket</h2>
<?
}
?>
</div>