<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */

  
    
?>


<div align="center">
    <form action="<?=url_for("subastas/formArticulo")?>" method="post">
        <?
        echo $form['idarticulo']->renderError();
        $form->setDefault('idarticulo', $articulo->getCaIdarticulo() );
        echo $form['idarticulo']->render();
        ?>
        <table class="tableList">
            <tr>
                <td>
                    <b>Titulo:</b> <br />
                    <?
                    echo $form['titulo']->renderError();
                    $form->setDefault('titulo', $articulo->getCaTitulo() );
                    echo $form['titulo']->render();
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Descripci&oacute;n:</b><br />
                    <?
                    echo $form['descripcion']->renderError();
                    $form->setDefault('descripcion', $articulo->getCaDescripcion() );
                    echo $form['descripcion']->render();
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Forma de Pago:</b><br />
                    <?
                    echo $form['formapago']->renderError();
                    $form->setDefault('formapago', $articulo->getCaFormapago() );
                    echo $form['formapago']->render();
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Valor:</b><br />
                    <?
                    echo $form['valor']->renderError();
                    $form->setDefault('valor', $articulo->getCaValor() );
                    echo $form['valor']->render();
                    ?>
                </td>
            </tr>  
            <tr>
                <td>
                    <b>Tipo de Subasta:</b><br />
                    <?
                    echo $form['directa']->renderError();
                    $form->setDefault('directa', $articulo->getCaDirecta() );
                    echo $form['directa']->render();
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>¿Cuanto se debe incrementar la subasta entre cada oferta?:</b><br />
                    <?
                    echo $form['incremento']->renderError();
                    $form->setDefault('incremento', $articulo->getCaIncremento() );
                    echo $form['incremento']->render();
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Vencimiento:</b><br />
                    <?
                    echo $form['fchvencimiento']->renderError();
                    $form->setDefault('fchvencimiento', $articulo->getCaFchvencimiento() );
                    echo $form['fchvencimiento']->render();
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <div align="center">
                        <input type="submit" class="button" value="Guardar" />   
                        <?
                        if( $articulo->getCaIdarticulo() ){
                            $url = "subastas/verArticulo?idarticulo=".$articulo->getCaIdarticulo();
                        }else{
                            $url = "subastas/index";
                        }  
                        ?>
                        <input type="button" class="button" value="Cancelar" onClick="document.location.href='<?=url_for($url)?>'" />   
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>