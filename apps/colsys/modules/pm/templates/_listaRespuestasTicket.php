<div class="commentlist">
<?

$responses = $sf_data->getRaw("responses");
$i=0;
foreach( $responses as $response ){
    ?>
        <div class="entry-<?=$i++%2==0?"even":"odd"?>">
        <div class="entry-date"><?=Utils::fechaMes($response->getCaCreatedat())?></div>
        <b><?=($response->getUsuario()?$response->getUsuario()->getCaNombre():$response->getCaLogin())?></b>


        <br /><br />
        <?=str_replace("\n","<br />",$response->getCaText())?>
        
    </div>
    <?

    
}
?>
</div>