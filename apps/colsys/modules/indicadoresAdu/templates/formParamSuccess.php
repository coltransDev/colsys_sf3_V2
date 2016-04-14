<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
?>

<div class="content" align="center" >
    <form action="<?=url_for("config/formParam")?>" method="post">
        <?
        echo $form['idconfig']->renderError();
        if( $config){
            $form->setDefault('idconfig', $config->getCaIdconfig() );
        }
        echo $form['idconfig']->render();
        ?>
        <table class="tableList" width="40%">        
            <tr>
                <th>
                    Por favor coloque los datos
                </th>
            </tr>
            <?
			if( $form->renderGlobalErrors() ){
			?>
			<tr>
				<td  >
				 <div align="center"><?php echo $form->renderGlobalErrors() ?>		</div></td>
			</tr>
			<?
			}
			?>
            <tr>
                <td>
                    <b>Modulo</b>
                    <br />
                    <?
                    echo $form['module_param']->renderError();
					if( $config){
						$form->setDefault('module_param', $config->getCaModule() );
					}
					echo $form['module_param']->render();  
                    ?>                   
                </td>
            </tr>        
            <tr>
                <td>
                    <b>Parametro</b>
                    <br />                    
                    <?
                    echo $form['param']->renderError();
					if( $config){
						$form->setDefault('param', $config->getCaParam() );
					}
					echo $form['param']->render();  
                    ?> 
                </td>
            </tr>        
            <tr>
                <td>
                    <b>Descripci&oacute;n</b>
                    <br />
                    <?
                    echo $form['description']->renderError();
					if( $config){
						$form->setDefault('description', $config->getCaDescription() );
					}
					echo $form['description']->render();  
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