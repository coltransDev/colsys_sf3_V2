<?
$userid = $sf_data->getRaw("userid");
//echo "<pre>";print_r($grupos);echo "</pre>";
?>
<ul id="navigation">	
    <li >	
        <?= link_to("Inicio", "homepage/index") ?>
    </li>
    <li >	
        <a >&nbsp;&nbsp;&nbsp;Aplicaciones</a>
        <a href="#" class="arrow" onclick="return tm(this)" >

        </a>
        <ul >
            <?            
            foreach ($grupos as $key => $grupo) {                
                ?>

                <li onmouseover="showMenu('sub<?= str_replace("-", "", $key) ?>')" onmouseout="hideMenu('sub<?= str_replace("-", "", $key) ?>')" >
                    <a href="#"><?= $key ?></a>
                    <?                    
                    if (count($grupos) > 0) {
                        ?>
                        <ul id="sub<?= str_replace("-", "", $key) ?>" style="display:none">
                            <?
                            foreach ($grupo as $rutina) {
                                if($rutina["ca_visible"]==true || $rutina["ca_visible"]=="1")
                                {
                                ?>
                                <li >
                                    <a href="<?= $rutina["ca_programa"] ?>">
                                        <?= $rutina["ca_opcion"] ?>
                                    </a>
                                </li>
                                <?
                                }
                            }
                            ?>

                        </ul>
                        <?
                    }
                    ?>

                </li>
                <?
            }
            ?>				
        </ul>		
    </li>	

</ul>

<ul id="usermenu">
    <li >	
        <?= $userid ?>&nbsp;&nbsp;&nbsp; -
    </li>
    <li>
        <div class="trm" title="Click para ver Historico de Trm" onclick="window.open('/inoparametros/trmsExt5', 'MsgWindow', 'width=500, height=500');" >TRM : <?= $trmHoy ?></div> &nbsp;&nbsp;&nbsp;
    </li>	
    <li >	
        <?= link_to("Salir", "users/logout") ?>
    </li>
</ul>