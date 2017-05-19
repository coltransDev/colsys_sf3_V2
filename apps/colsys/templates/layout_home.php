<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <!--<link rel="stylesheet" type="text/css" media="screen"
              href="/css/formulario_home.css" />-->
        <?php include_javascripts() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
            <script type="text/javascript" src="/js/loginWindow.js"></script>
            <script>
                function loadXMLDoc()
                {
                    Ext.Ajax.request(
                    {
                        waitMsg: 'Actualizando el formulario...',
                        url: '<?//= url_for("formulario/vistaPrevia2") ?>',
                        method: 'POST',
                        /*form: 'formDatos',*/
                        success:function(response,options){
                            var res = Ext.util.JSON.decode( response.responseText );
                            if( res.success ){
                                // $("#mydiv").html(res.html);
                                document.getElementById("myDiv").innerHTML=res.html;
                                //document.getElementById("indicator").style.display='block';
                                $("#indicator").show();
                            }
                        },

                        failure: function(response,options){
                            alert("Error:"+response.responseText.toString());
                            //$("#bguardar").attr("disabled",false);
                        }
                    });
                }
                function loadXMLDoc2()
                {
                    var xmlhttp;
                    if (window.XMLHttpRequest)
                    {// code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp=new XMLHttpRequest();
                    }
                    else
                    {// code for IE6, IE5
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange=function()
                    {
                        if (xmlhttp.readyState==4 && xmlhttp.status==200)
                        {
                            document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET","/ajax_info.txt",true);
                    xmlhttp.send();
                }
            </script>
    </head>
    <body id="body">
        <div id="wrapper">
            <div class="clear-both">
            </div>
            <div align="center">
                <div class="header" align="center" >
                    <div class="headerleft" ><?= image_tag("branding/" . sfConfig::get("app_branding_template") . "/header/head_left.gif") ?></div>
                    <div class="headerright" ><?= image_tag("branding/" . sfConfig::get("app_branding_template") . "/header/head_right.gif") ?></div>
                    <div class="topmenuwraper"  >
                        <?
                        include_component("menu", "menubar");
                        ?>
                    </div>
                </div>
            </div>
            <div id="mask"></div>

            <? include_component("menu", "submenubar"); ?>

            <div class="contenedor">
                <?php echo $sf_content ?>
            </div>
            <div class="footer">
                <div class="copyright">
                    <?= sfConfig::get("app_branding_name") ?>. Todos los derechos reservados
                    <br />
                    colsys@<?= $_SERVER["SERVER_ADDR"] ?>
                </div>
            </div>
            <script type="text/javascript" charset="utf-8">

                $('.qtip').tooltip({track: true});

                $('.help').tooltip({track: true, fade: 250, opacity: 1, top: -15, extraClass: "pretty fancy" });

            </script>
        </div>
    </body>
</html>
