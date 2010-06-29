<?
include_component("falabella", "mainPanel", array("fala_header"=>$fala_header) );

include_component("falabella", "panelDetalles", array("fala_header"=>$fala_header) );
?>
<script language='JavaScript' type='text/JavaScript'>

function export_file(){
    if (Math.abs(eval(Ext.fly(cantFaltan.getEl()).dom.innerHTML)) >= 20) {
        if (confirm('¿Desea generar una nueva order de pedido con la cantidad de productos faltantes?')) {
           document.location='<?=url_for("falabella/generarNuevaOrden?iddoc=".base64_encode( $fala_header->getCaIddoc()) )?>';
        }
    }
    document.location='<?=url_for("falabella/generarArchivo?iddoc=".base64_encode( $fala_header->getCaIddoc()) )?>';
}

</script>

<div class="content" id="content">

    <div id="main-panel"></div>
    <div id="panel-detalles"></div>

    <script type="text/javascript">
        //new PanelDetalles()
        var panel = new MainPanel();
        panel.render("main-panel");


        var panelDetalles = new PanelDetalles();
        panelDetalles.render("panel-detalles");
        //panelDetalles.setWidth(Ext.get(document.getElementById("content")).getWidth());
        panelDetalles.store.load();
        panelDetalles.onAfterLoad();

    </script>

    <div id="result"></div>
</div>
