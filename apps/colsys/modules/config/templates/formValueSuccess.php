<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
?>

<div class="content" align="center" >
    <form action="<?=url_for("config/formValue")?>" method="post">
        <?
        echo $form['idconfig']->renderError();
        if( $value ){
            $form->setDefault('idconfig', $value->getCaIdconfig() );
        }
        echo $form['idconfig']->render();
        
        echo $form['idvalue']->renderError();
        if( $value){
            $form->setDefault('idvalue', $value->getCaIdvalue() );
        }
        echo $form['idvalue']->render();
        ?>
        <table class="tableList" width="40%">        
            <tr>
                <th>
                    Por favor coloque los datos
                </th>
            </tr>
            <tr>
                <td>
                    <b>Identificador</b>
                    <br />
                    <?
                    echo $form['ident']->renderError();
					if( $value){
						$form->setDefault('ident', $value->getCaIdent() );
					}
					echo $form['ident']->render();  
                    ?>                    
                </td>
            </tr>        
            <tr>
                <td>
                    <b>Valor1</b>
                    <br />
                    <?
                    echo $form['value']->renderError();
					if( $value){
						$form->setDefault('value', $value->getCaValue() );
					}
					echo $form['value']->render();  
                    ?>

                </td>
            </tr>        
            <tr>
                <td>
                    <b>Valor2</b>
                    <br />
                    <?
                    echo $form['value2']->renderError();
					if( $value){
						$form->setDefault('value2', $value->getCaValue2() );
					}
					echo $form['value2']->render();  
                    ?>
                </td>
            </tr>   

            <tr>
                <td>
                    <div align="center">
                        <input type="submit" value="Guardar" class="button" />
                        <input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for("config/index")?>'" />
                    </div>
                </td>
            </tr>    
        </table>
    </form>
</div>