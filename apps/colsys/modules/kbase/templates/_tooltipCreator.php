<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
include_component("kbase", "tooltipWindow");
?>
<script type="text/javascript">
    function crearAyuda( e ){
        if (isMicrosoft()){
            strElemId = e.srcElement.id;
        }else{
            strElemId = e.target.id;
        }        
        if(!strElemId)
            return;
        else if (strElemId.indexOf("form-el")>-1 )
        {
            return;
        }
        //alert($("#"+strElemId).type)
        if($("#"+strElemId)[0].tagName=="div")
            return;

        //if() strElemId
//        else
//            return;
        
        if( typeof(winTooltip)=="undefined" ){
            winTooltip = new TooltipWindow();
        }
        winTooltip.setIdcategory( <?=$idcategory?> );
        winTooltip.setElemid( strElemId );
        winTooltip.show();
        winTooltip.load( strElemId );
    }
    $("input,select,textarea,div").dblclick(crearAyuda);
</script>