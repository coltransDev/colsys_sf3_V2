<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
ini_set('default_charset', 'UTF8');
$i=0;
$button[$i]["name"] = "Nuevo";
$button[$i]["tooltip"] = "Crear un nuevo reporte de negocios";
$button[$i]["image"] = "22x22/new.gif";
$button[$i]["link"] = url_for('ordenes/formOrden');
$i++;


if ($this->getRequestParameter("id")) {
    $id=$this->getRequestParameter("id");
    $reporte = Doctrine::getTable("Reporte")->find($id);
    if($reporte)
    {
        $button[$i]["name"] = "Documentos";
        $button[$i]["tooltip"] = "Adjuntar Documentos";
        $button[$i]["image"] = "22x22/new.gif";
        $button[$i]["link"] = url_for('reportesNegPlug/filesOtm?id='.$id);
        $i++;        
    }

}
    

?>
