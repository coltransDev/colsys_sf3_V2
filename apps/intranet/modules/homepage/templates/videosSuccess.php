<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h2><?=$video->getCaName()?></h2>
<a href="<?=  url_for("images/video").$video->getCaPath()?>" style="display:block;width:520px;height:330px" id="player"></a>
<script>    
    flowplayer("player", "/intranet/js/flowplayer/flowplayer-3.2.7.swf");
</script>
