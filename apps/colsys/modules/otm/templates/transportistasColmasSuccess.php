<?
include_component("widgets", "widgetCliente");
include_component("widgets", "multiWidget");
include_component("widgets", "widgetCiudad");
include_component("widgets", "widgetLinea");
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetReferencia");

include_component("otm", "gridProgramacionCarga");
include_component("otm", "filtrosProgCargas");

?>

<table width="1500" align="center">
	<tr>
        <td>
            <div class="content">    
                <div id="main-panel"></div>
                <div id="sub-panel"></div>
                <div id="resul"></div>
            </div>
        </td>
    </tr>
</table>
<script type="text/javascript">
 Ext.onReady(function(){        
        var panel = new PanelFiltrosProgCargas({
            title: "Filtros",
            bodyStyle: "pading: 5px"
        });
        panel.render("main-panel");
        var panel = new PanelTransportistas({
            title: "Transportistas Colmas",
            bodyStyle: "pading: 5px"
        });
        panel.render("sub-panel");
    });
</script>