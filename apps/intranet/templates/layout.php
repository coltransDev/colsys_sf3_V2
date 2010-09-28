<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>

    <script language="Javascript" type="text/javascript">
		mis_imagenes = new Array("https://localhost/intranet/images/birthday/birthday1.gif","https://localhost/intranet/images/birthday/birthday2.gif","https://localhost/intranet/images/birthday/birthday3.gif")
		mi_imagen = 0
		imgCt = mis_imagenes.length
		function rotacion() {
			if (document.images) {
				mi_imagen++
				if (mi_imagen == imgCt) {
					mi_imagen = 0
				}
				document.anuncio.src=mis_imagenes[mi_imagen]
				setTimeout("rotacion()", 60 * 1000)
			}
		}
    </script>
    
    </head>
    <body onload="rotacion()">
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
                                <?include_component('adminUsers','loginInformation')?>
                            </div>
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
                                <?include_component('homepage','mainMenu')?>
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
			<!--COLMAS LTDA.-->	</h2>



                                                <div class="article-content">
                                                     <?include_component('homepage','noticias')?>
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

                        <div class="right">
                            <div class="jamod module" id="Mod19">
                                <div>

                                    <div>
                                        <div>
                                            <h1 class="show"><span>CUMPLEA&Ntilde;OS</span></h1><br />
                                            <tr>
                                                <td width="150" align="center">
                                                    <img src="http://illiweb.com/fa/empty.gif" name="anuncio" alt="Anuncios" />
                                                </td>
                                            </tr><br />
                                            <?
                                            include_component('homepage','birthday');
                                            ?>
                                        </div><br />
                                        	
                                        	<div class="box1" align="center">
                                        		<font size="3"><b></>Nuevos Colaboradores</b></font></div></td></tr>                                        		
                        					</div><br/>
                   						<div>
                                            <?
                                            include_component('homepage','incomeLast');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                            <div>Copyright &#169;. Todos los derechos reservados.<br /></div>
                            <br />
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </body>
</html>
