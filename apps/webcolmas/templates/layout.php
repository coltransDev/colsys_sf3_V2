<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <? //php include_stylesheets() ?>
        <link href="/webcolmas/css/style.css" media="screen" type="text/css" rel="stylesheet"></>
        <link href="/webcolmas/css/pr.css" media="print" type="text/css" rel="stylesheet"></>
        <?php include_javascripts() ?>
    </head>
    <body oncontextmenu="return false;" ondragstart="return false;" onselectstart="return false;"  >
        <input type="hidden" id="asd" />
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
    </body>
</html>
