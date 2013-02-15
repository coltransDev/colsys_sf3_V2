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
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>     
    <body id="body">
        <div id="wrapper">
            <?php
            ?>
            <div class="clear-both">
            </div>
            <div class="contenido">
                <!--
                <div class="toolbar">
                    <ul>
                        <li class="menu_lista">
                            /<?//php echo link_to(image_tag('/images/formularios/formulario.png'), 'formulario/index') ?>
                            <span>Formularios</span>
                        </li>
                        <li class="menu_lista">
                            <?//php echo link_to(image_tag('/images/formularios/bloques.png'), 'bloque/index') ?>
                            <span>Bloques</span>
                        </li>
                        <li class="menu_lista">
                            <?//php echo link_to(image_tag('/images/formularios/pregunta.png'), 'pregunta/index') ?>
                            <span>Preguntas</span>
                        </li>
                        <li class="menu_lista">
                            <?//php echo link_to(image_tag('/images/formularios/opcion.png'), 'opcion/index') ?>
                            <span>Opciones</span>
                        </li>
                        <li class="menu_lista">
                            <?//php echo link_to(image_tag('/images/formularios/ver.png'), 'formulario/evalServicioClientes') ?>
                            <span>Formulario Evaluación del Servicio</span>
                        </li>
                    </ul>
                </div>
                -->
                <div class="contenedor-formulario">
                    <?php echo $sf_content ?>
                </div>
            </div>
            <div class="clear-both"></div>

        </div>
    </body>
</html>





