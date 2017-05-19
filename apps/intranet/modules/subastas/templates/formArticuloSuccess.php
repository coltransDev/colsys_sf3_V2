<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
    sfContext::getInstance()->getResponse()->removeStylesheet("/js/ext4/resources/css/ext-all-neptune.css");
    sfContext::getInstance()->getResponse()->removeJavascript("ext4/ext-all.js");
    sfContext::getInstance()->getResponse()->removeJavascript("ext4/ux/multiupload/swfobject.js");
    use_stylesheet('ext/css/ext-all.css');
    use_javascript('ext/adapter/ext/ext-base.js');
    use_javascript('ext/ext-all.js');
    use_javascript('ext/src/locale/ext-lang-es.js');
?>

<div align="center">
    <form action="<?=url_for("subastas/formArticulo")?>" method="post">
        <?
        echo $form['idarticulo']->renderError();
        $form->setDefault('idarticulo', $articulo->getCaIdarticulo() );
        echo $form['idarticulo']->render();
        ?>
        <table class="tableList alignLeft">
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
                <td colspan="3">
                    <b >Aplica para:</b><br />
                    <div align="left">
                        <?
                        echo $form['idsucursal']->renderError();
                        $form->setDefault('idsucursal', $articulo->getCaIdsucursal() );
                        echo $form['idsucursal']->render();  
                        ?>
                    </div>
                </td>
                </tr>
            <tr>
                <td>
                    <b>Tipo de Subasta:</b><br />
                    <?
                    echo $form['directa']->renderError();
                    $form->setDefault('directa', $articulo->getCaDirecta()?"1":"0" );
                    echo $form['directa']->render();
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="incremento_div">
                        <b>¿Cuanto se debe incrementar la subasta entre cada oferta?:</b><br />
                        <?
                        echo $form['incremento']->renderError();
                        $form->setDefault('incremento', $articulo->getCaIncremento() );
                        echo $form['incremento']->render();
                        ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="tope_div">
                        <b>¿Cual es el tope maximo de una oferta?:</b><br />
                        <?
                        echo $form['tope']->renderError();
                        $form->setDefault('tope', $articulo->getCaTope() );
                        echo $form['tope']->render();
                        ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Inicio:</b><br />
                    <?
                    echo $form['fchinicio']->renderError();
                    $form->setDefault('fchinicio', $articulo->getCaFchinicio()?Utils::parseDate($articulo->getCaFchinicio(), "Y-m-d"):date("Y-m-d") );
                    echo $form['fchinicio']->render();
                    
                    echo $form['horainicio']->renderError();
                    $form->setDefault('horainicio', $articulo->getCaFchinicio()?Utils::parseDate($articulo->getCaFchinicio(), "H:i:s"):date("H:i:s", time()+86400*3) );
                    echo $form['horainicio']->render();
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Vencimiento:</b><br />
                    <?
                    echo $form['fchvencimiento']->renderError();
                    $form->setDefault('fchvencimiento', $articulo->getCaFchvencimiento()?Utils::parseDate($articulo->getCaFchvencimiento(), "Y-m-d"):date("Y-m-d", time()+86400*3) );
                    echo $form['fchvencimiento']->render();
                    
                    echo $form['horavencimiento']->renderError();
                    $form->setDefault('horavencimiento', $articulo->getCaFchvencimiento()?Utils::parseDate($articulo->getCaFchvencimiento(), "H:i:s"):date("H:i:s", time()+86400*3) );
                    echo $form['horavencimiento']->render();
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

<script type="text/javascript">
    var verificarDirecta = function(){
        var fld = document.getElementById("directa").value;
        if( fld=="1" ){
            document.getElementById("incremento_div").style.display = "none";
            document.getElementById("tope_div").style.display = "none";
        }else{
            document.getElementById("incremento_div").style.display = "";
            document.getElementById("tope_div").style.display = "";
        }
    }
    
    verificarDirecta();
</script>