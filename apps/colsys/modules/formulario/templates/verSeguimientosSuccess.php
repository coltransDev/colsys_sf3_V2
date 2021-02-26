<style type="text/css" >

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

}
.entry-odd {
    background-color:#FFFFFF;
    border-color:#CCCCCC;
    border-style:dotted;
    border-width:1px ;
    margin:12px 0 0;
    padding:12px 12px 24px;    
}
.entry-date{
    float: right;
    color: #0464BB;
}
</style>
<div align="left" style="padding: 10px;">
<?
$seguimientos = $sf_data->getRaw("seguimientos");
$i=0;
if(count($seguimientos)>0){
    foreach( $seguimientos as $seguimiento ){
        ?>
        <div  class="entry-<?=$i%2==0?"even":"odd"?>">
            <div  class="entry-date"><?=Utils::fechaMes($seguimiento->getCaFchevento())?></div>
            <b><span style="color:#3792D4;"><?=($seguimiento->getUsuario()?$seguimiento->getUsuario()->getCaNombre():$seguimiento->getCaUsucreado())?></span></b>
            <br />
            <?
            if( $seguimiento->getCaFchcompromiso() ){
            ?>
            <span style="font-size:11px;"><b>Seguimiento programado:</b> <?=Utils::fechaMes(Utils::parseDate($seguimiento->getCaFchcompromiso(), "Y-m-d"))?></span>
            <br /><br/>
            <?
            }?>
            <span style="font-style:italic;">Detalles: </span><?=str_replace("\n","<br />",$seguimiento->getCaDetalle())?><br/>
            <span style="font-style:italic;">Compromisos: </span><?=str_replace("\n","<br />",$seguimiento->getCaCompromisos())?><br/>
        </div><br /><br />
        <?
        $i++;
    }
}else{
    ?>
    <div  class="entry-even">No hay seguimientos para &eacute;sta encuesta.</div>
    <?
}
?>