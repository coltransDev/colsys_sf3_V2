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
        function muestra_imagen() {
        var now = new Date();
        var day = now.getDate();

        var image = 'images/birthday/'+day+'.gif';
        document.write('<img src="'+image+'">');

        }
    </script>
   
   
    </head>
    <body>
        <div class="out">
            <div class="wrapper">
                <div class="int" >
                    <!--Top Area Start-->
                    <div class="top">
                        <div class="logo"  >
                            <a href="index.php" title="">
                                <?include_component('homepage','logos')?>
                            </a>
                        </div>
                        <div class="search">
                            <div class="searchint">
                                <?include_component('homepage','search')?>
                            </div>
                        </div>
                        <div class="topmenu">
                        </div>
                    </div>
                    <!--Top Area End-->


                    <!--Header Start-->
                    <div class="header">
                        <?include_component('adminUsers','loginInformation')?>
                    </div>
                    <div class="header_foot">
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
                                            <h1 class="show"><span>CUMPLEA&Ntilde;OS</span></h1>
                                            <tr>
                                                <td width="150" align="center">
                                                    <script language="JavaScript">
                                                        muestra_imagen();
                                                    </script>
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
