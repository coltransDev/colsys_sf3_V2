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
        <div class="out">
            <div class="wrapper">
                <div class="int">

                    <!--Top Area Start-->
                    <div class="top">
                        <div class="logo"  >
                            <a href="index.php" title="">
                                <?include_component('homepage','logos')?>
                            </a>
                        </div>
                        <div class="search">
                            <div class="searchint">
                                <div class="moduletable" >
                                </div>
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
                            <div align="center" id="div_accesos">
                                <br /><br />  
                                <a href="https://www.colsys.com.co/" class="myButton" style="background-image: url(/intranet/images/colsys2.png); background-repeat: no-repeat;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                <br /><br />
                                <a href="http://tracking.opentecnologia.com.co" class="myButton" style="background-image: url(/intranet/images/ColmasTransparente.png); background-repeat: no-repeat;">Tracking</a>                        
                                <br /><br />
                                <a href="https://www.colsys.com.co/tracking" class="myButton" style="background-image: url(/intranet/images/ColtransTransparente.png); background-repeat: no-repeat;">Tracking</a>
                                <br /><br />
                                <a href="https://accounts.google.com/ServiceLogin?service=mail&continue=https://mail.google.com/mail/#identifier" class="myButton" style="background-image: url(/intranet/images/GmailTransparente.png); background-repeat: no-repeat;">Webmail</a>
                                <br /><br />
                                <a href="http://isodoc.coltrans.com.co" class="myButton" style="background-image: url(/intranet/images/iso1.png); background-repeat: no-repeat;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                <br /><br />
                                <a href="http://sevenet.coltrans.com.co" class="myButton" style="background-image: url(/intranet/images/sevenet.png); background-repeat: no-repeat;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                <br /><br />
                                <a href="http://www.gerenteslatinos.com/aulavirtualgrupo" class="myButton" style="background-image: url(/intranet/images/aula_virtual.png); background-repeat: no-repeat;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>                        
                                <br /><br />
                            </div>
                        </div>
                        <!--Center Column Start-->

                        <div class="centerleft">

                            <!--<table >
                                <tr>
                                    <td valign="top">-->
                                        
                                                     <?//include_component('homepage','noticias')?>
                                                     <?php echo $sf_content ?>
                                        
                                    <!--</td>
                                </tr>



                            </table>-->

                        </div>
                        <!--Center Column End End-->

                        

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
                            <div>Copyright &#169; 2010. Todos los derechos reservados.<br /></div>
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
            accesos+='<a style="font-weight:600; font-size:20px; line-height:15px; color:#062a7d;" href="https://www.coltrans.com.co/"><b>Colsys</b></a><br/><br/>';
            accesos+='<a style="font-weight:600; font-size:20px; line-height:15px; color:#062a7d;" href="http://tracking.opentecnologia.com.co"><b>Tracking Colmas</b></a><br/><br/>';
            accesos+='<a style="font-weight:600; font-size:20px; line-height:15px; color:#062a7d;" href="https://www.coltrans.com.co/tracking"><b>Tracking Coltrans</b></a><br/><br/>';
            accesos+='<a style="font-weight:600; font-size:20px; line-height:20px; color:#062a7d;" href="https://accounts.google.com/ServiceLogin?service=mail&continue=https://mail.google.com/mail/#identifier"><b>Webmail</b></a><br/><br/>';
            accesos+='<a style="font-weight:600; font-size:20px; line-height:20px; color:#062a7d;" href="http://isodoc.coltrans.com.co"><b>Isodoc</b></a><br/><br/>';
            accesos+='<a style="font-weight:600; font-size:20px; line-height:20px; color:#062a7d;" href="http://sevenet.coltrans.com.co"><b>Sevenet</b></a><br/><br/>';
            accesos+='<a style="font-weight:600; font-size:20px; line-height:20px; color:#062a7d;" href="http://www.gerenteslatinos.com/aulavirtualgrupo"><b>Aula Virtual</b></a><br/><br/>';

            $("#div_accesos").html(accesos);
        }else{
            accesos+='<a href="https://www.coltrans.com.co/" class="myButton" style="background-image: url(/intranet/images/colsys2.png); background-repeat: no-repeat;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';    
            accesos+='<br/><br/><a href="http://tracking.opentecnologia.com.co" class="myButton" style="background-image: url(/intranet/images/ColmasTransparente.png); background-repeat: no-repeat;">Tracking</a>';
            accesos+='<br/><br/><a href="https://www.coltrans.com.co/tracking" class="myButton" style="background-image: url(/intranet/images/ColtransTransparente.png); background-repeat: no-repeat;">Tracking</a>';
            accesos+='<br/><br/><a href="https://accounts.google.com/ServiceLogin?service=mail&continue=https://mail.google.com/mail/#identifier" class="myButton" style="background-image: url(/intranet/images/GmailTransparente.png); background-repeat: no-repeat;">Webmail</a>';
            accesos+='<br/><br/><a href="http://isodoc.coltrans.com.co" class="myButton" style="background-image: url(/intranet/images/iso1.png); background-repeat: no-repeat;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
            accesos+='<br/><br/><a href="http://sevenet.coltrans.com.co" class="myButton" style="background-image: url(/intranet/images/sevenet.png); background-repeat: no-repeat;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
            accesos+='<br/><br/><a href="http://www.gerenteslatinos.com/aulavirtualgrupo" class="myButton" style="background-image: url(/intranet/images/aula_virtual.png); background-repeat: no-repeat;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
            accesos+='<br/><br/>';

            $("#div_accesos").html(accesos);
        }
    })
</script>