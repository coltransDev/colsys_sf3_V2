<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/intranet.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>



    </head>
    <body style='font-family: Myriad pro,Arial,Helvetica,sans-serif; font-size: 73.1%;'>
        <div class="main_container">
            <div class="main_wrapper">
            <div class="content_wrapper">
                <div class="top"></div>
                <!--Top Area Start-->
                <div class="header_content">
                    
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
                
                <!--Top Area End-->


                <!--Header Start-->
                <div class="header">
                    
                    <? include_component('homepage', 'mainMenu') ?>

                </div>

                <div class="header_foot">
                </div>


                <!--Header End-->


                <!--Content Area Start-->

                <div class="main_content">
                    <div class="center">
                        <div id="resultado"></div>
                        <?php echo $sf_content ?>                            
                    </div>


                    <!--Center Column End End-->

                    <!--right Column Start-->

                    <div class="right">
                        <? include_component('adminUsers', 'loginInformation') ?>
                        <div id="div_accesos" ></div>
                        <? include_component('subastas', 'listaSubastas'); ?>                    
                        
                        <? include_component('homepage', 'birthday'); ?>
                                                
                        <? include_component('homepage', 'nuevosColaboradores'); ?>
                        
                        <? include_component('homepage', 'tiempoColaborador'); ?>                        
                    </div>
                </div>

                <!--Content Area End-->

                <div class="footer">


                    <div class="copyright">
                        <div>Copyright &#169;. Todos los derechos reservados.<br /></div>
                        colsys@<?= $_SERVER["SERVER_ADDR"] ?>
                        <br />
                    </div>

                </div>

            </div>


             </div>       
        </div>      
    </body>
</html>

<script>
    $( document ).ready(function() {
        var isIE = /*@cc_on!@*/false || !!document.documentMode;
        var accesos = '<br/><br/>';

        if(isIE == true){
            accesos+='<a style="font-weight:600; font-size:20px; line-height:15px; color:#062a7d;" href="https://www.colsys.com.co/"><b>Colsys</b></a><br/><br/>';
            accesos+='<a style="font-weight:600; font-size:20px; line-height:15px; color:#062a7d;" href="http://tracking.opentecnologia.com.co"><b>Tracking Colmas</b></a><br/><br/>';
            accesos+='<a style="font-weight:600; font-size:20px; line-height:15px; color:#062a7d;" href="https://www.colsys.com.co/tracking"><b>Tracking Coltrans</b></a><br/><br/>';
            accesos+='<a style="font-weight:600; font-size:20px; line-height:20px; color:#062a7d;" href="https://accounts.google.com/ServiceLogin?service=mail&continue=https://mail.google.com/mail/#identifier"><b>Webmail</b></a><br/><br/>';
            accesos+='<a style="font-weight:600; font-size:20px; line-height:20px; color:#062a7d;" href="http://isodoc.coltrans.com.co"><b>Isodoc</b></a><br/><br/>';
            accesos+='<a style="font-weight:600; font-size:20px; line-height:20px; color:#062a7d;" href="http://sevenet.coltrans.com.co"><b>Sevenet</b></a><br/><br/>';
            accesos+='<a style="font-weight:600; font-size:20px; line-height:20px; color:#062a7d;" href="http://www.gerenteslatinos.com/aulavirtualgrupo"><b>Aula Virtual</b></a><br/><br/>';

            $("#div_accesos").html(accesos);
        }else{
            accesos+='<a href="https://www.colsys.com.co/" class="myButton" style="background-image: url(/intranet/images/colsys2.png); background-repeat: no-repeat;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';    
            accesos+='<br/><br/><a href="http://tracking.opentecnologia.com.co" class="myButton" style="background-image: url(/intranet/images/ColmasTransparente.png); background-repeat: no-repeat;">Tracking</a>';
            accesos+='<br/><br/><a href="https://www.colsys.com.co/tracking" class="myButton" style="background-image: url(/intranet/images/ColtransTransparente.png); background-repeat: no-repeat;">Tracking</a>';
            accesos+='<br/><br/><a href="https://accounts.google.com/ServiceLogin?service=mail&continue=https://mail.google.com/mail/#identifier" class="myButton" style="background-image: url(/intranet/images/GmailTransparente.png); background-repeat: no-repeat;">Webmail</a>';
            accesos+='<br/><br/><a href="http://isodoc.coltrans.com.co" class="myButton" style="background-image: url(/intranet/images/iso1.png); background-repeat: no-repeat;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
            accesos+='<br/><br/><a href="http://sevenet.coltrans.com.co" class="myButton" style="background-image: url(/intranet/images/sevenet.png); background-repeat: no-repeat;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
            accesos+='<br/><br/><a href="http://www.gerenteslatinos.com/aulavirtualgrupo" class="myButton" style="background-image: url(/intranet/images/aula_virtual.png); background-repeat: no-repeat;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
            accesos+='<br/><br/>';

            $("#div_accesos").html(accesos);
        }
    })
</script>7
