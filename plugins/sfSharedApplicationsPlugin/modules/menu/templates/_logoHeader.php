<?php

//$grupoEmp = $sf_data->getRaw('grupoEmp');

$grupoEmp = array(1,2,7,8,11); //Colmas, Coltrans, TP Logistics, Colotm

if(in_array($idempresa, $grupoEmp)){
    $idempresa = "";
}
?>
    <div class="headerleft"><?= image_tag("branding/" . sfConfig::get("app_branding_template".$idempresa) . "/header/head_left.gif") ?></div>
    <div class="headerright"><?= image_tag("branding/" . sfConfig::get("app_branding_template".$idempresa) . "/header/head_right.gif") ?></div>