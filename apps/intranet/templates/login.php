<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Intranet</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
    </head>
    <body>
        <div class="out">
            <div class="wrapper">
                <div class="int">

                    <!--Top Area Start-->
                    <div class="top">
                        <div class="logo">

                            <a href="index.php" title="">
                                <? echo image_tag('colmas_logo.jpg',array('border'=>'none')) ?>
                            </a>
                        </div>

                        <div class="search">
                            <div class="searchint">
                                <div class="moduletable">

                                </div>
                            </div>
                            <?include_component('adminUsers','loginInformation')?>
                        </div>

                        <div class="topmenu">

                        </div>

                    </div>
                    <!--Top Area End-->


                    <!--Header Start-->
                    <div class="header">
                        <div class="header_foot"> </div>
                    </div>


                    <!--Header End-->


                    <!--Content Area Start-->
                    <div class="content">



                        <!--Left Column Start-->

                        <div class="left">
                            <div class="moduletable_menu">
                                <?//include_component('homepage','mainMenu')?>
                            </div>
                            <br />

                        </div>
                        <!--Center Column Start-->

                        <div class="center">

                            <table class="blog" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td valign="top">
                                        <div>

                                            <div class="contentpaneopen">

                                                <h2 class="contentheading">
			Inicio de Sesi&oacute;n</h2>



                                                <div class="article-content">
                                                     <?//include_component('homepage','noticias')?>
                                                     <?php echo $sf_content ?>
                                                </div>
                                            </div>

                                            <span class="article_separator">&nbsp;</span>
                                        </div>
                                    </td>
                                </tr>



                            </table>

                        </div>
                        <!--Center Column End End-->

                        <!--right Column Start-->

                        <!--Right Column End-->



                        <!--Left Column End-->

                        <!--Center Column Start-->
                        <?php /*if ($this->countModules('right')): ?>
                        <div class="center">
                            <?php else: ?>
                            <div class="centerleft">
                                <?php endif; ?>
                                <jdoc:include type="component" />
                            </div>
                            <!--Center Column End End-->

                            <!--right Column Start-->
                            <?php if ($this->countModules('right')): ?>
                            <div class="right">
                                <jdoc:include type="modules" name="right" style="jarounded" />
                            </div>
                            <?php endif;*/ ?>

                        <!--Right Column End-->


                    </div>
                    <!--Content Area End-->
                    <div class="footer">


                        <div class="copyright">
                            <div>Copyright &#169; 2010 Colmas Ltda. Agencia de Aduanas Nivel 1. Todos los derechos reservados.<br /></div>
                            <br />
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </body>
</html>
