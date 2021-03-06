<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<script type="text/javascript">
    var crearEvento =function(){

        var url = "<?=url_for("ids/formEventos?modo=".$modo."&id=".$ids->getCaId())?>";
        var tipo = document.getElementById("tipo_evento").value;

        document.location = url+"?impoexpo="+tipo;
    }

</script>

<table class="tableList alignLeft" width="100%" border="1">
    <?
    if( $nivel>=1 ){
    ?>

    <tr class="row0">

        <td colspan="4">
           &nbsp;
        </td>
        <td colspan="2" align="center">
            <?
            if($modo=="prov"){
            ?>
                <select id="tipo_evento">
                    <option value="<?=Constantes::IMPO?>"><?=Constantes::IMPO?></option>
                    <option value="<?=Constantes::EXPO?>"><?=Constantes::EXPO?></option>
                </select>
                &nbsp;<?=image_tag("16x16/edit_add.gif",array("onClick"=>"crearEvento()"))?>
            <?
            }else{
            ?>
            &nbsp;<?=link_to(image_tag("16x16/edit_add.gif"), "ids/formEventos?modo=".$modo."&id=".$ids->getCaId() )?>
            <?
            }
            ?>

        </td>
    </tr>
    <?
    }
    ?>
    <tr class="row0">
        
        <td width="20%">
           <b>Tipo</b>
        </td>
        <td width="20%">
            <b>Evento</b>
        </td>
        <td width="20%">
            <b>Referencia</b>
        </td>
        <td width="20%">
            <b>Usuario </b>
        </td>
        <td width="20%">
            <b>Fecha </b>
        </td>
        <td width="20%" align="center">
          &nbsp;
        </td>
    </tr>
    <?
    $tipo = null;
    foreach( $eventos as $evento ){

    ?>
    <tr   >
        <td width="20%">
           <?=$evento->getIdsCriterio()?>
        </td>
        <td width="20%">
            <?=$evento->getCaEvento()?>
        </td>
        <td width="20%">
            <?=$evento->getCaReferencia()?>
        </td>
        <td width="20%">
            <?=$evento->getCaUsucreado()?> 
        </td>
        <td width="20%">
            <?=Utils::fechaMes($evento->getCaFchcreado())?> 
        </td>
        <td align="center">
        <?
        if( $nivel>=1 ){
            echo link_to(image_tag("16x16/edit.gif"),"ids/formEventos?modo=".$modo."&idevento=".$evento->getCaIdevento());
        }
        ?>
        </td>
    </tr>
    <?
    }
    ?>
</table>