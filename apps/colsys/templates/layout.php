<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?
        $sfModule = sfContext::getInstance()->getModuleName();
        $sfAction = sfContext::getInstance()->getActionName();
        $user = sfContext::getInstance()->getUser();
        
      
        
        ?>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php         
            if (strpos("$sfAction", "Ext4") === false && $sfModule . "/" . $sfAction != "gestDocumental/index" && strpos("$sfAction", "Ext5") === false && $sfModule . "/" . $sfAction != "riesgos/index" ) {
                include_stylesheets();
                include_javascripts();
            } else {
                ?>
                <link rel="stylesheet" type="text/css" media="screen" href="/css/coltrans.css" />
                <link rel="stylesheet" type="text/css" media="print" href="/css/print.css" />
                <?
                if($sfModule=="reportesNeg")
                {
                ?>
                <link rel="stylesheet" type="text/css" media="screen" href="/css/jquery/jquery.tooltip.css" />
                <?
                }
                ?>
                <link rel="stylesheet" type="text/css" media="screen" href="/css/menu/menu.css" />
                <link rel="stylesheet" type="text/css" media="screen" href="/css/blog.css" />
            <?
            if (strpos("$sfAction", "Ext4") !== false  ) 
            {
            ?>
                <link type="text/css" rel="stylesheet" href="/js/ext4/resources/css/ext-all-neptune.css">
                <script type="text/javascript" src="/js/ext4/ext-all.js"></script>
                <script type="text/javascript" src="/js/ext4/ux/multiupload/swfobject.js"></script>
            <?
            }else if (strpos("$sfAction", "Ext5") !== false || $sfModule . "/" . $sfAction == "riesgos/index" || $sfModule . "/" . $sfAction == "gestDocumental/index") 
            {
               
               // $stylejs=$_COOKIE["stylejs"];
                //echo $stylejs;
                $stylejs = $user->getDatos("estiloIno");
              //  print_r($stylejs);
                
                if($stylejs=="")
                {
                    //$stylejs="/js/ext5/packages/ext-theme-crisp/build/resources/ext-theme-crisp-all-debug.css";
                    $stylejs="/js/ext6/build/classic/theme-crisp/resources/theme-crisp-all-debug.css";
                } 
            ?>
                
                <link type="text/css" rel="stylesheet" href="<?=$stylejs?>">
                <!--<script type="text/javascript" src="/js/ext5/ext-all.js"></script>-->
                <!--<script type="text/javascript" src="/js/ext6/build/ext-all-debug.js"></script>-->
                <script type="text/javascript" src="/js/ext6/ext-all.js"></script>
            <?
            }
            if($sfModule=="reportesNeg")
            {
            ?>
                <!--<script type="text/javascript" src="/js/comunes.js"></script>
                <script type="text/javascript" src="/js/jquery/jquery.js"></script>-->
            <?
            }
            ?>
                <script type="text/javascript" src="/js/comunes.js"></script>
                <script type="text/javascript" src="/js/jquery/jquery.js"></script>
                <script type="text/javascript" src="/js/jquery/jquery.tooltip.js"></script>
                <script type="text/javascript" src="/js/jquery/jquery.dimensions.js"></script>
                <script type="text/javascript" src="/js/menu/menu.js"></script>                
                <!--<script type="text/javascript" src="/js/highcharts/js/highcharts.js"></script>
                <script type="text/javascript" src="/js/highcharts/js/modules/exporting.js"></script>-->
            <?
            }
            ?>
            <script type="text/javascript" src="/js/loginWindow.js"></script>
    </head>
    <body>
        <div align="center">
                <div class="header" align="center" >                
                    <?  include_component("menu", "logoHeader")?>
                    <div class="topmenuwraper">
                        <?
                        include_component("menu", "menubar");
                        ?>
                    </div>
                </div>
        </div>
        <div id="mask"></div>
        <? 
        include_component("menu", "submenubar");
        ?>
        <br />

        <?php echo $sf_content ?>

        <div class="footer">	
            <div class="copyright">
                    <?= sfConfig::get("app_branding_name") ?>. Todos los derechos reservados<br />        
                    colsys@<?= $_SERVER["SERVER_ADDR"] ?>
            </div>
        </div>	
        <?
        if($sfModule=="reportesNeg")
        {
        ?>
        <script type="text/javascript">

            $('.qtip').tooltip({track: true});
            $('.help').tooltip({track: true, fade: 250, opacity: 1, top: -15, extraClass: "pretty fancy"});
        </script>
        <?
        }
        ?>
    </body>
</html>