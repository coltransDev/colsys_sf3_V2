<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */



include_component("kbase", "tooltipWindow");
?>


<script language="javascript">
   

    function crearAyuda( e ){
        if (isMicrosoft()){
            strElemId = e.srcElement.id;
        }else{
            strElemId = e.target.id;
        }

        //alert( strElemId );
        if( typeof(winTooltip)=="undefined" ){
            winTooltip = new TooltipWindow();
        }

        winTooltip.setIdcategory( <?=$idcategory?> );
        winTooltip.setElemid( strElemId );
        winTooltip.show();
        winTooltip.load( strElemId );        
    }

    var elements = document.getElementsByTagName("input");
    for( i=0; i<elements.length; i++ ){
        var elem = elements[i];        
        if(elem.id){
            addListener(elem, "click", crearAyuda);
        }        
    }

    var elements = document.getElementsByTagName("select");
    for( i=0; i<elements.length; i++ ){
        var elem = elements[i];        
        if(elem.id){
            addListener(elem, "click", crearAyuda);
        }
    }

    var elements = document.getElementsByTagName("textarea");
    for( i=0; i<elements.length; i++ ){
        var elem = elements[i];
        if(elem.id){
            addListener(elem, "click", crearAyuda);
        }
    }

    var elements = document.getElementsByTagName("div");
    for( i=0; i<elements.length; i++ ){
        var elem = elements[i];        
        if(elem.id && elem.className=="help"){           
            addListener(elem, "click", crearAyuda);
        }
    }





</script>