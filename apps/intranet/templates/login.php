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
        <div class="main_container">
            <div class="main_wrapper">
            <div class="content_wrapper">
                <div class="top"></div>
                <!--Top Area Start-->
                <div class="header_content">
                    
                    <div class="logo"  >
                        <? include_component('homepage', 'logos') ?>
                    </div>                    
                    
                </div>                        
                
                <!--Top Area End-->


                <!--Header Start-->
               
                <div class="header_foot">
                </div>


                <!--Header End-->


                <!--Content Area Start-->

                <div class="main_content" >
                    <div class="centerlogin" align="center">
                        <?php echo $sf_content ?>                            
                    </div>


                    <!--Center Column End End-->

                    <!--right Column Start-->

                    
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
