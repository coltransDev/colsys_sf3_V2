<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <title>
            <?php if (!include_slot('title')): ?>
                Agencia de Aduanas Colmas Ltda. - Nivel 1
            <?php endif; ?>
        </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="keywords"
              content="            <?php if (!include_slot('keywords')): ?>
                  Colmas, Agencia de Aduanas, aduanas, importaciones, exportaciones
              <?php endif; ?>"
              />
        <meta name="description"
              content="            <?php if (!include_slot('description')): ?>
                  Colmas LTDA. Agencia de Aduanas Nivel 1
              <?php endif; ?>"
              />
        <link rel="shortcut icon" href="/favicon.ico" />
 
        <?php include_stylesheets() ?>
        <script language="JavaScript">
            var mydiv = document.getElementById("body");
            var curr_width = mydiv.style.width;
        </script>
    </head>
    <body id="body">
        <div id="wrapper">
            <div class="clear-both">
            </div>
            <div class="center-right-mobile">
                <div class="pdf_content">
                    <?php echo $sf_content ?>
                    <script language="JavaScript1.2">
  
                        function disabletext(e){
                            return false
                        }



                        function reEnable(){
                            return true
                        }

                        //if the browser is IE4+

                        document.onselectstart=new Function ("return false")

                        //if the browser is NS6

                        if (window.sidebar){
                            document.onmousedown=disabletext
                            document.onclick=reEnable
                        }

                    </script>
                </div>
            </div>
            <div class="clear-both"></div>

            <div class="left-mobile">
                <?php
                //    $active = 1;
                //  include_component("home", "menu", array('active' => $active));
                ?>
                <div class="separator_horizontal">
                </div>
            </div>
            <?php
            //     include_component("home", "footermobile");
            ?>
            <div class="clear-both">
            </div>
        </div>

    </body>
</html>





