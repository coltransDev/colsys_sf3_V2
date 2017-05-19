<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>



<div class="content" align="center">
    <form action="/ids/formEventosNew/modo/<?=$modo?><?=($idreporte!="")?"/idreporte/".$idreporte:""?>" method="post">
    <?
    if( !$modo ){
        if( $reporte ){
        ?>
        <input type="hidden" name="idreporte" value="<?=$reporte->getCaIdreporte()?>" />
        <?
        }else{
        ?>
        <input type="hidden" name="referencia" value="<?=$numreferencia?>" />
        <?
        }
    }else{
        ?>
        <input type="hidden" name="idevento" value="<?=$evento->getCaIdevento()?>" />
        <?
    }
    ?>
    <table class="tableList alignLeft" width="50%">
        <tr>
            <th colspan="2">&nbsp;</th>
        </tr>
        <?
        if( $form->renderGlobalErrors() ){
        ?>
        <tr>
            <td colspan="2" >
             <div align="left"><?php echo $form->renderGlobalErrors() ?>		</div></td>
        </tr>
        <?
        }
        ?>
        <tr>
            <td width="25%">
                <b>Tipo de evento:</b><br />
                <?
                echo $form['tipo_evento']->renderError();
                $form->setDefault('tipo_evento', $evento->getCaIdcriterio() );
				echo $form['tipo_evento']->render();
                ?>

            </td>

            <td width="25%">
                <b>Proveedor:</b><br />
                <?
                if( $modo && $idreporte==""){
                    echo $ids->getCaNombre();
                ?>
                <input type="hidden" name="id" value="<?=$ids->getCaId()?>">
                <?
                }elseif($idreporte){
                ?>
                <b>Agente:</b><br />
                <?            
                echo $agente->getIds()->getCaNombre();
                ?>
                <input type="hidden" name="id" value="<?=$agente->getCaIdagente()?>">
                <?
                }
                else{
                    echo $form['id']->renderError();
                    echo $form['id']->render();
                }
                ?>

            </td>
        </tr>
        <tr>
            <td colspan="2">
                <b>Evento:</b><br />
                <?
                echo $form['evento']->renderError();
                $form->setDefault('evento', $evento->getCaEvento() );
				echo $form['evento']->render();
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div align="center">
                    <input type="submit" value="Guardar" class="button" />
                    
                    <input type="button" value="Cancelar" class="button" onClick="document.location='<?=$url?>'" />
                </div>
            </td>
        </tr>
        
    </table>
    </form>

    <br />
    <?
    if( isset($eventos) && count($eventos)>0 ){
    ?>
    <table class="tableList" width="50%">
        <tr>
            <th colspan="4">Eventos de previos</th>
        </tr>
        <tr class="row0">
            <td width="30%">Criterio</td>
            <td width="30%">Evento</td>
            <td width="20%">
                Usuario
            </td>
            <td width="20%">
                Fecha
            </td>
        </tr>
        <?
        foreach( $eventos as $evento ){
        ?>
        <tr>
            <td ><?=$evento->getIdsCriterio()?></td>
            <td ><?=$evento->getCaEvento()?></td>
            <td >
                <?=$evento->getCaUsucreado()?>
            </td>
            <td >
                <?=Utils::fechaMes($evento->getCaFchcreado())?>
            </td>
        </tr>
        <?
        }
        ?>
    </table>
    <?
    }
    ?>

</div>


