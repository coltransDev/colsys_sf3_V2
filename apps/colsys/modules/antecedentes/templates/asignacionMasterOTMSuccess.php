<?php
include_component("antecedentes", "panelReportesOTMAntecedentes");
include_component("antecedentes", "panelMasterOTMAntecedentes");
?>

<div class="content">
    <div id="main-panel"></div>
    <div id="sub-panel"></div>
    <br><br>
<?// include_component("email", "formEmail", array("subject"=>$asunto,"message"=>$mensaje, "contacts"=>$contactos));?>
    <div id="resul"></div>
</div>
<div style="width: 100px;position:fixed; top:100px; right: 0px; color:#000;height: 60px;background-color: #EAEAEA;border: 1px solid #000;" id="totalizador">
    <div align="center">Totales</div>
    Peso:<span id="ele_peso">0</span><br>
    Piezas:<span id="ele_piezas">0</span><br>
    Volumen:<span id="ele_volumen">0</span>
</div>
<script type="text/javascript">
    Ext.onReady(function(){        
        var panel = new PanelMasterOTMAntecedentes({
            title: "Asignación de Master <?=($numRef)?$numRef:""?>",
            bodyStyle: "pading: 5px",
            numRef: "<?=$numRef?>"
        });
        panel.render("main-panel");
       
        var subpanel = new PanelReportesOTMAntecedentes({
            bodyStyle: "pading: 5px",
            autoHeight: "auto",
            numRef: "<?=$numRef?>"
        });
        subpanel.render("sub-panel");
        
    });

</script>