<?
$issue = $sf_data->getRaw("issue");
$categories = $sf_data->getRaw("categories");
?>

<div class="content" align="center">
    <div  style="border: solid 1px #000000;">
        <table cellpadding="0" cellspacing="0" class="primaryTable" width="100%" border="0">
            <tr>
                 <td  valign="top">

                     <div style="padding: 10px;" align="left">
                    <b><?=$issue->getCaTitle()?></b>
                    <br />
                    <br />
                     <?
                    if( $issue->getCaSummary() ){
                    ?>
                        <b>Resumen:</b><br />
                         <?=$issue->getCaSummary()?>
                        <br />
                    <?
                    }
                    ?>
                    <b>Contenido:</b><br />
                    <?=$issue->getCaInfo()?>
                    </div>
                </td>
                <td rowspan="2" valign="top" align="right">
                    <div class="thinColumn" align="left">
                    
                    <ul>
                    <?
                    foreach( $categories as $c ){
                        $issues = $c->getKBIssue();
                        if( count( $issues )>0 ){
                    ?>
                        <li class="bgList"><b><?=$c->getCaName()?></b>
                            <?
                            
                            ?>
                            <ul>
                                <?
                                foreach( $issues as $is ){
                                ?>
                                <li class="subitemMenu"> <?=image_tag("kb/bullet.png")?>&nbsp;<?=link_to($is->getCaTitle(),"kbase/viewIssue?id=".$is->getCaIdissue())?></li>
                                <?
                                }
                                ?>
                            </ul>
                        </li>
                    <?
                        }
                    }
                    ?>
                    </ul>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div style="font-size: 10px; color:#999999; padding:5px;">
                    Id: <?=$issue->getCaIdissue()?> Creado: <?=Utils::fechaMes($issue->getCaFchcreado("Y-m-d"))?> por <?=$issue->getCaUsucreado()?>
                    <?
                    if( $issue->getCaUsuactualizado() ){
                    ?>
                    Actualizado:  <?=Utils::fechaMes($issue->getCaFchactualizado("Y-m-d"))?> por <?=$issue->getCaUsuactualizado()?>
                    <?
                    }
                    ?>
                    </div>

                    <?
                    ?>
                </td>
               
            </tr>
        </table>
    </div>
</div>
