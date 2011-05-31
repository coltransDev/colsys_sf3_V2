<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>



    </head>
    <body >

        <!--Top Area Start-->
        <div class="header_content">
            <div class="top">
                <div class="logo"  >
                    <? include_component('homepage', 'logos') ?>
                </div>
                <div class="searchbox">
                    <div class="searchint">
                        <? include_component('homepage', 'search') ?>
                    </div>
                </div>
                <div class="topmenu">
                </div>
            </div>                        
        </div>
        <!--Top Area End-->


        <!--Header Start-->
        <!--                    <div class="header">
                                <div class="header_content">
        
                                </div>
                            </div>-->
        <div class="header_foot">
        </div>


        <!--Header End-->


        <!--Content Area Start-->
        <div class="content_wrapper">
            <div class="content">
                <div class="center">
                    <?php echo $sf_content ?>                            
                </div>


                <!--Center Column End End-->

                <!--right Column Start-->

                <div class="right">
                    <? include_component('adminUsers', 'loginInformation') ?>
                    <br />
                    <br />
                    <? include_component('homepage', 'mainMenu') ?>
                    <br />
                    <? include_component('homepage', 'birthday');?>                    
                    <br />
                    <? include_component('homepage', 'incomeLast'); ?>
                </div>
            </div>
        </div>
        <!--Content Area End-->

        <div class="footer">


            <div class="copyright">
                <div>Copyright &#169;. Todos los derechos reservados.<br /></div>
                <br />
            </div>

        </div>

<!--                    <a href="https://www.coltrans.com.co/"><img src="images/colsys.png" border="none" alt="Colsys" /></a>
                 <a href="https://www.coltrans.com.co/tracking"><img src="images/tracking.png" border="none" alt="Colsys" /></a>
                 <a href="http://www.coltrans.com.co/mail"><img src="images/webmail.png" border="none" alt="Colsys" /></a>-->
    </body>
</html>
