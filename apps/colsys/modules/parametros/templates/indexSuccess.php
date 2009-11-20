<?
/**
* Pantalla de bienvenida para el modulo de parametros
* @author Andres Botero
*/

include_component("parametros","panelParametros", array());
include_component("parametros","modalidadWindow", array());
include_component("parametros","modalidadGrid", array());

?>
<div class="content" >
    <div id="main-panel"></div>

</div>

<script language="javascript">
    var mainPanel = new PanelParametros({
            title: 'Conceptos',
            renderTo: 'main-panel',
            height: 600
        });
    //mainPanel.store.baseParams={ tipo:'<?=Constantes::RECARGO_EN_ORIGEN?>' };
    //mainPanel.store.load();
        
</script>
