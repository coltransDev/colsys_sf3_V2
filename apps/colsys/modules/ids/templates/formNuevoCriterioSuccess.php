<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */


?>

<div class="content" align="center">
    
    <h2>Tipo de proveedor: <?=$tipoProv->getCaNombre()?></h2>
    <form action="<?=url_for("ids/formNuevoCriterio?modo=".$modo)?>" method="post">
        <?
        echo $form['tipoprov']->renderError();
        $form->setDefault('tipoprov', $tipoProv->getCaTipo() );
        echo $form['tipoprov']->render();
        ?>
        
    <table class="tableList alignLeft" width="50%">
        <tr>
                <th>
                    Datos del criterio
                </th>                        
                                                        
            </tr>
            <?
            if( $form->renderGlobalErrors() ){
            ?>
            <tr>
                <td  >
                 <div align="left"><?php echo $form->renderGlobalErrors() ?>		</div></td>
            </tr>
            <?
            }
            ?>
        
                
            <tr>
                <td>
                    <b>Tipo de criterio </b>  <br />                  
                    <?
                    echo $form['tipo_eval']->renderError();                    
                    echo $form['tipo_eval']->render();
                    ?>
                </td>                                   
            </tr>            
            <tr>
                <td>
                    <b>Nombre </b>
                    
                    <?
                    echo $form['nombre']->renderError();                    
                    echo $form['nombre']->render();
                    ?>
                </td>                                   
            </tr>
            <tr>
                <td >
                    <div align="center">
                        <input type="Submit" value="Guardar" class="button">&nbsp;
                        <input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for("ids/listadoCriteriosEval?modo=".$modo)?>'">

                    </div>
                </td>
            </tr>
        </table>
            
    </form>

</div>