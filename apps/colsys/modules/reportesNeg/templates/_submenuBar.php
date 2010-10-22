<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
ini_set('default_charset','UTF8');

$i = 0;
//if($user->getUserId()=="maquinche")
//    echo $action;
$permiso=$user->getNivelAcceso( "87" );
if($this->getRequestParameter("id"))
{
    $reporte = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("id") );
    $editable=$reporte->getEditable($permiso,$user);
    $cerrado=$reporte->getCerrado();
}
else
    $editable=false;
$opcion = ($this->getRequestParameter("opcion")?"&opcion=".$this->getRequestParameter("opcion"):"");

$modo = $this->getRequestParameter("modo");

if( $modo==Constantes::AEREO  || utf8_decode($modo) == Constantes::AEREO ){
    $modo=Constantes::AEREO;
}

if( $modo==Constantes::MARITIMO || utf8_decode($modo)==Constantes::MARITIMO  ){
    $modo=Constantes::MARITIMO;
}


$impoexpo = $this->getRequestParameter("impoexpo");

if( $impoexpo==Constantes::EXPO || utf8_decode($impoexpo)==Constantes::EXPO ){
    $impoexpo=Constantes::EXPO;
}

if( $impoexpo==Constantes::IMPO || utf8_decode($impoexpo)==Constantes::IMPO ){
    $impoexpo=Constantes::IMPO;
}

if( $impoexpo==Constantes::TRIANGULACION || utf8_decode($impoexpo)==Constantes::TRIANGULACION ){
    $impoexpo=Constantes::TRIANGULACION;
}

if( $action!="index" ){
	$button[$i]["name"]="Inicio ";
	$button[$i]["tooltip"]="Pagina inicial del reporte de negocios";
	$button[$i]["image"]="22x22/home.gif";
	$button[$i]["link"]= "/reportesNeg/index?token=".md5(time()).$opcion;
	$i++;
}

switch($action){
	case "index":		
/*		$button[$i]["name"]="Nuevo";
		$button[$i]["tooltip"]="Crear un nuevo reporte de negocios";
		$button[$i]["image"]="22x22/new.gif";
		$button[$i]["link"]= "reportesNeg/formReporte?token=".md5(time()).$opcion.$modo;
        $i++;
		break;
 * 
 */
        break;
    case "indexAg":
		$button[$i]["name"]="Nuevo";
		$button[$i]["tooltip"]="Crear un nuevo reporte de negocios";
		$button[$i]["image"]="22x22/new.gif";
		$button[$i]["link"]= "/reportesNeg/formReporteAg?token=".md5(time()).$opcion.$modo;
        $i++;
        break;
	case "consultaReporte":
		
        if($editable)
        {
            $button[$i]["name"]="Editar ";
            $button[$i]["tooltip"]="Modificar este reporte";
            $button[$i]["image"]="22x22/edit.gif";
            $button[$i]["link"]= "/reportesNeg/formReporte/id/".$this->getRequestParameter("id")."/impoexpo/".$impoexpo."/modo/".$modo;
            $i++;
        }
        $button[$i]["name"]="Generar ";
		$button[$i]["tooltip"]="Genera un archivo PDF con el reporte";
		$button[$i]["image"]="22x22/pdf.gif";
		$button[$i]["link"]= "/reportesNeg/verReporte/id/".$this->getRequestParameter("id")."/impoexpo/".$impoexpo."/modo/".$modo;
        $i++;
        if(!$cerrado)
        {
            $button[$i]["id"]="anular-reporte";
            $button[$i]["name"]="Anular ";
            $button[$i]["tooltip"]="Anula el reporte actual";
            $button[$i]["image"]="22x22/cancel.gif";
            $button[$i]["onClick"]="ventanaAnularReporte()";
            $button[$i]["link"]= "#";
            $i++;
        }
        if($editable)
        {
            $button[$i]["name"]="Unificar ";
            $button[$i]["tooltip"]="Copia las comunicaciones existentes de un reporte a este reporte";
            $button[$i]["image"]="22x22/copy_newv.gif";
            $button[$i]["link"]= "/reportesNeg/unificarReporte/id/".$this->getRequestParameter("id")."/impoexpo/".$impoexpo."/modo/".$modo;
            $i++;
        }
        $button[$i]["name"]="Status ";
		$button[$i]["tooltip"]="Historial de Status";
		$button[$i]["image"]="22x22/txt.gif";
		$button[$i]["onClick"]= "window.open('/traficos/verHistorialStatus/idreporte/".$this->getRequestParameter("id")."')";
        $i++;

        if($editable)
        {
            $button[$i]["name"]="Importar";
            $button[$i]["tooltip"]="Importar un reporte";
            $button[$i]["image"]="22x22/window_nofullscreen.gif";
            $button[$i]["onClick"]= "location.href='/reportesNeg/busquedaReporte/idimpo/".$this->getRequestParameter("id")."'";
            $i++;
        }
            
        

        if(!$cerrado)
        {
            $button[$i]["name"]="Nueva version";
            $button[$i]["tooltip"]="Crear una nueva version para un reporte";
            $button[$i]["image"]="22x22/todo.gif";
            $button[$i]["onClick"]= "nuevoRep()";
            $i++;
        }
            $button[$i]["name"]="Copiar";
            $button[$i]["tooltip"]="copiar en un nuevo reporte";
            $button[$i]["image"]="22x22/copy_newv.gif";
            $button[$i]["onClick"]= "copiaRep()";
            $i++;
        if($permiso>1 && !$cerrado)
        {
            $button[$i]["name"]="Cerrar";
            $button[$i]["tooltip"]="Cerrar un reporte";
            $button[$i]["image"]="22x22/encrypted.gif";
            $button[$i]["onClick"]= "cerrarAbrir('".$this->getRequestParameter("id")."','1')";
            $i++;
        }
        else if($permiso>2 && $cerrado)
        {
            $button[$i]["name"]="Abrir";
            $button[$i]["tooltip"]="Abrir un reporte";
            $button[$i]["image"]="22x22/unlock.gif";
            $button[$i]["onClick"]= "cerrarAbrir('".$this->getRequestParameter("id")."','2')";
            $i++;
        }
		break;
	case "verReporte":		
		$button[$i]["name"]="Volver ";
		$button[$i]["tooltip"]="Vuelve a la pagina anterior";
		$button[$i]["image"]="22x22/1leftarrow.gif";
		$button[$i]["link"]= "/reportesNeg/consultaReporte/id/".$this->getRequestParameter("id")."/impoexpo/".$impoexpo."/modo/".$modo;
		$i++;
		
		$button[$i]["name"]="Notificar";
		$button[$i]["tooltip"]="Envia una notificación a las personas relacionadas en el reporte para que lo revisen";
		$button[$i]["image"]="22x22/email.gif";
		$button[$i]["link"]= "/reportesNeg/enviarNotificacion/idreporte/".$this->getRequestParameter("id")."/token/".md5(time());
        $i++;		
		
		break;
    case "unificarReporte":
		$button[$i]["name"]="Volver ";
		$button[$i]["tooltip"]="Vuelve a la pagina anterior";
		$button[$i]["image"]="22x22/1leftarrow.gif";
		$button[$i]["link"]= "/reportesNeg/consultaReporte/id/".$this->getRequestParameter("id")."/impoexpo/".$impoexpo."/modo/".$modo;
		$i++;
		break;
    case "seleccionModo":
        $buttonHelp = array();
		$buttonHelp["tooltip"]="Vuelve a la pagina anterior";
		$buttonHelp["image"]="22x22/help.png";
		$buttonHelp["link"]= "/kbase/viewIssue?idissue=46";
//        print_r($buttonHelp);
        break;
    case "formReporte":
    case "formReporte1":
        if($this->getRequestParameter("id")!="")
        {
            $button[$i]["name"]="Generar ";
            $button[$i]["tooltip"]="Genera un archivo PDF con el reporte";
            $button[$i]["image"]="22x22/pdf.gif";
            $button[$i]["link"]= "/reportesNeg/verReporte/id/".$this->getRequestParameter("id")."/impoexpo/".$impoexpo."/modo/".$modo;
            $i++;

            $button[$i]["name"]="Status ";
            $button[$i]["tooltip"]="Historial de Status";
            $button[$i]["image"]="22x22/txt.gif";
            $button[$i]["onClick"]= "window.open('/traficos/verHistorialStatus/idreporte/".$this->getRequestParameter("id")."')";
            $i++;
            if($editable)
            {
                $button[$i]["name"]="Importar";
                $button[$i]["tooltip"]="Importar un reporte";
                $button[$i]["image"]="22x22/window_nofullscreen.gif";
                $button[$i]["onClick"]= "window.open('/reportesNeg/busquedaReporte/idimpo/".$this->getRequestParameter("id")."')";
                $i++;
            }

            if(!$cerrado)
            {
                $button[$i]["name"]="Nueva version";
                $button[$i]["tooltip"]="Crear una nueva version para un reporte";
                $button[$i]["image"]="22x22/todo.gif";
                $button[$i]["onClick"]= "nuevoRep()";
                $i++;
            }
            $button[$i]["name"]="Copiar";
            $button[$i]["tooltip"]="copiar en un nuevo reporte";
            $button[$i]["image"]="22x22/copy_newv.gif";
            $button[$i]["onClick"]= "copiaRep()";
            $i++;
            if($permiso>1 && !$cerrado)
            {
                $button[$i]["name"]="Cerrar";
                $button[$i]["tooltip"]="Cerrar un reporte";
                $button[$i]["image"]="22x22/encrypted.gif";
                $button[$i]["onClick"]= "cerrarAbrir('".$this->getRequestParameter("id")."','1')";
                $i++;
            }
            else if($permiso>2 && $cerrado)
            {
                $button[$i]["name"]="Abrir";
                $button[$i]["tooltip"]="Abrir un reporte";
                $button[$i]["image"]="22x22/unlock.gif";
                $button[$i]["onClick"]= "cerrarAbrir('".$this->getRequestParameter("id")."','2')";
                $i++;
            }
        }
        break;
}


?>
<script>
    function cerrarAbrir(id,tipo)
    {
        if(window.confirm("Esta seguro de cambiar el estado del reporte?"))
        {
            Ext.MessageBox.wait('Cerrando o Abriendo reporte, Espere por favor', '');
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?=url_for("reportesNeg/cerrarReporte")?>',
                params :	{
                    id: id,
                    tipo: tipo
                },
                    failure:function(response,options){
                    alert( response.responseText );
                    Ext.Msg.hide();
                    success = false;
                },
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if( res.success ){

                   location.href="/reportesNeg/consultaReporte/id/<?=$this->getRequestParameter("id")?>/impoexpo/<?=$impoexpo?>/modo/<?=$modo?>";
                    }
                }
            });
        }        
    }
    
    function nuevoRep()
    {
        if(window.confirm("Realmente desea crear una nueva version para este reporte?"))
        {
            Ext.MessageBox.wait('Guardando, Espere por favor', '---');
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?=url_for("reportesNeg/guardarReporte")?>',
                params :	{
                    idreporte:'<?=$this->getRequestParameter("id")?>',
                    opcion:"2",
                    tipo:"full"
                },                
                    failure:function(response,options){
                        var res = Ext.util.JSON.decode( response.responseText );
                            if(res.err)
                                Ext.MessageBox.alert("Mensaje",'Se presento un error guardando por favor informe al Depto. de Sistemas<br>'+res.err);
                            else
                                Ext.MessageBox.alert("Mensaje",'No es posible crear un reporte ya que posee errores en la digitacion, verifique los siguientes campos<br>'+res.texto);
                },                
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    Ext.MessageBox.alert("Mensaje",'Se guardo correctamente el reporte');
                    if(res.redirect)
                        location.href="/reportesNeg/consultaReporte/id/"+res.idreporte+"/impoexpo/<?=$impoexpo?>/modo/<?=$modo?>";
                }
            });
        }
    }

    function copiaRep()
    {
        if(window.confirm("Realmente desea crear un nuevo reporte?"))
        {
            Ext.MessageBox.wait('Guardando, Espere por favor', '---');
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?=url_for("reportesNeg/guardarReporte")?>',
                params :	{
                    idreporte:'<?=$this->getRequestParameter("id")?>',
                    opcion:"1",
                    tipo:"full"
                },
                    failure:function(response,options){
                        var res = Ext.util.JSON.decode( response.responseText );
                            if(res.err)
                                Ext.MessageBox.alert("Mensaje",'Se presento un error guardando por favor informe al Depto. de Sistemas<br>'+res.err);
                            else
                                Ext.MessageBox.alert("Mensaje",'No es posible crear un reporte ya que posee errores en la digitacion, verifique los siguientes campos<br>'+res.texto);
                },
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    Ext.MessageBox.alert("Mensaje",'Se guardo correctamente el reporte');
                    if(res.redirect)
                        location.href="/reportesNeg/consultaReporte/id/"+res.idreporte+"/impoexpo/<?=$impoexpo?>/modo/<?=$modo?>";
                }
            });
        }
    }



</script>