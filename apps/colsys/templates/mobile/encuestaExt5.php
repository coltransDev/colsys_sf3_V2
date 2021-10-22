<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <title>
            <?php if (!include_slot('title')): ?>
                Coltrans S.A.S. - Agente de Carga Internacional
            <?php endif; ?>
        </title>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <link rel="stylesheet" type="text/css" media="screen"
              href="/css/formulario.css" />
              <?php include_javascripts() ?>
        <?
        
                /*echo "ssss<br>";
                echo $user->getDatos("user_style");
                echo $user->getDatos("estiloIno");
                echo "ssss";
*/
                
                    //$stylejs="/js/ext5/packages/ext-theme-crisp/build/resources/ext-theme-crisp-all-debug.css";
                    //$stylejs="/js/ext6/build/classic/theme-crisp/resources/theme-crisp-all-debug.css";
                    $stylejs="/js/ext-6.5.0/build/classic/theme-crisp/resources/theme-crisp-all-debug.css";
                    
                 
                ?>
        <link type="text/css" rel="stylesheet" href="<?=$stylejs?>">
                <!--<script type="text/javascript" src="/js/ext5/ext-all.js"></script>-->
                <!--<script type="text/javascript" src="/js/ext6/build/ext-all-debug.js"></script>-->
                <script type="text/javascript" src="/js/ext6/ext-all.js"></script>
                <script type="text/javascript" src="/js/ext6/d3.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    </head>
    <body id="body-mobile">
        <div id="wrapper">
            <?php
            ?>
            <div class="clear-both">
            </div>
            <div class="contenido-mobile">
                <div class="contenedor-formulario-mobile">
                    <?php echo $sf_content ?>
                </div>
            </div>
            <div class="clear-both"></div>

        </div>
    </body>
</html>