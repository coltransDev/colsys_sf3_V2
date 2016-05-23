<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  Author: Carlos Gilberto Lopez Mendez
 */
if (strpos($via,"Maritimo") !== false){
    include_component("inoExpo", "gridDocsTransporte");
}else{
    include_component("inoExpo", "gridAwbsTransporte");
}
?>
<table width="900" align="center">
    <td style="text-align: center">
<div id="se-form"></div><br>
</td>
</table>
