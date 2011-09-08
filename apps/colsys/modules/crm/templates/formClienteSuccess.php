<?php
/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("crm", "clienteFormPanel", array("nivel"=>$nivel));



?>

<div class="content">
    <div id="main-panel"></div>
</div>


<script type="text/javascript">
    var panel = new ClienteFormPanel({
                                        nivel: <?=$nivel?>
                                       <?=$idcliente?",idcliente:$idcliente":""?>
                                       
                                      });
    panel.render("main-panel");

</script>