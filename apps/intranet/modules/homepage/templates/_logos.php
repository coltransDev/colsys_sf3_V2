
<div id="logo1" style="display:none">    
    <?=image_tag("logos/logo_coltrans.png")?>
</div>
<div id="logo2" style="display:none">
    <?=image_tag("logos/logo_colmas.png")?>
</div>
<div id="logo3" style="display:none">
    <?=image_tag("logos/logo_consolcargo.png")?>
</div>
<div id="logo4" style="display:none">
    <?=image_tag("logos/logo_ColtransUSA.png")?>
</div>
<div id="logo5" style="display:none">
    <?=image_tag("logos/logo_tplogistics.png")?>
</div>

<script language="Javascript" type="text/javascript">
           

    mis_imagenes = new Array("logo1", "logo2", "logo3", "logo4", "logo5");
    mi_imagen = 0
    imgCt = mis_imagenes.length
    function rotacion() {
         
        if (document.images) {
            
            document.getElementById(mis_imagenes[mi_imagen]).style.display= "none";
            mi_imagen++
            if (mi_imagen == imgCt) {
                mi_imagen = 0
            }
            document.getElementById(mis_imagenes[mi_imagen]).style.display= "";
            setTimeout("rotacion()", 5 * 500)
        }
    }
    
    rotacion();    
</script>

