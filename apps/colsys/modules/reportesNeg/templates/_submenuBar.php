<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
include_component("widgets", "widgetImpoexpo");
include_component("widgets", "widgetTransporte");
ini_set('default_charset', 'UTF8');
$buttonHelp = array();
$i = 0;


$permiso = $user->getNivelAcceso("87");

//Verifica si el usuario pertenece a servicio al cliente
$usersPerfil = UsuarioTable::getUsuariosxPerfil("servicio-al-cliente");
$scliente = false;
foreach ($usersPerfil as $userPerfil){
    if($user->getUserId()==$userPerfil->getCaLogin())
        $scliente = true;
    else
        continue;
}

$tipo="1";
if ($this->getRequestParameter("id") || $this->getRequestParameter("consecutivo") ) {
    if( $this->getRequestParameter("id")!="" ){
        $reporte = Doctrine::getTable("Reporte")->find($this->getRequestParameter("id"));
    }else if($this->getRequestParameter("consecutivo")!="")
    {            
        $reporte = ReporteTable::retrieveByConsecutivo($this->getRequestParameter("consecutivo"));           
    }
    $repAntecedentes=$reporte->getRepAntecedentes();
    $mostrarAnt=false;
    if($repAntecedentes)
    {
        $estAnt=$repAntecedentes->getCaEstado();
        if($estAnt=="E")
            $mostrarAnt=true;
    }
    
    $editable = $reporte->getEditable($permiso, $user);
    //echo "Estado:".(($repAntecedentes->getCaEstado()=="R" || $repAntecedentes->getCaEstado()=="")).":";
    
    $cerrado = $reporte->getCerrado();
    $anulado = $reporte->getAnulado();
    $tipo=$reporte->getCaTiporep();
}
else
    $editable=false;
$opcion = ($this->getRequestParameter("opcion") ? "?opcion=" . $this->getRequestParameter("opcion") : "");

$modo = $this->getRequestParameter("modo");

if ($modo == Constantes::AEREO || utf8_decode($modo) == Constantes::AEREO) {
    $modo = Constantes::AEREO;
}

if ($modo == Constantes::MARITIMO || utf8_decode($modo) == Constantes::MARITIMO) {
    $modo = Constantes::MARITIMO;
}

$impoexpo = $this->getRequestParameter("impoexpo");

if ($impoexpo == Constantes::EXPO || utf8_decode($impoexpo) == Constantes::EXPO) {
    $impoexpo = Constantes::EXPO;
}

if ($impoexpo == Constantes::IMPO || utf8_decode($impoexpo) == Constantes::IMPO) {
    $impoexpo = Constantes::IMPO;
}

if ($impoexpo == Constantes::TRIANGULACION || utf8_decode($impoexpo) == Constantes::TRIANGULACION) {
    $impoexpo = Constantes::TRIANGULACION;
}

if ($action != "index") {
    if($action=="formReporteOtmmin")
    {
        $opcion="/opcion/otmmin";        
    }
    $button[$i]["name"] = "Inicio ";
    $button[$i]["tooltip"] = "Pagina inicial del reporte de negocios";
    $button[$i]["image"] = "22x22/home.gif";
    $button[$i]["link"] = "/reportesNeg/index".$opcion;
    $i++;
    if ($impoexpo != "") {
        $buttonHelp["tooltip"] = "Instructivo de Ayuda";
        $buttonHelp["image"] = "22x22/help.png";
        $idhelp = (($impoexpo != Constantes::EXPO) ? "46" : "50");
        $buttonHelp["onClick"] = "help1('$idhelp')";
    }
}

switch ($action) {
    case "index":        
        if("otmmin"==$this->getRequestParameter("opcion"))
        {
            $button[$i]["name"] = "Nuevo";
            $button[$i]["tooltip"] = "Crear un nuevo reporte de negocios";
            $button[$i]["image"] = "22x22/new.gif";
            $button[$i]["link"] = "/reportesNeg/formReporteOtmmin";
            $i++;
        }
    break;
    case "indexAg":
        $button[$i]["name"] = "Nuevo";
        $button[$i]["tooltip"] = "Crear un nuevo reporte de negocios";
        $button[$i]["image"] = "22x22/new.gif";
        $button[$i]["link"] = "/reportesNeg/formReporteAg?token=" . md5(time()) . $opcion . $modo;
        $i++;
        break;    
    case "indexOs":
        $button[$i]["name"] = "Nuevo";
        $button[$i]["tooltip"] = "Crear un nuevo reporte de negocios";
        $button[$i]["image"] = "22x22/new.gif";
        $button[$i]["link"] = "/reportesNeg/formReporteOs?token=" . md5(time()) . $opcion . $modo;
        $i++;
        break;
    case "consultaReporte":

         if("otmmin"==$this->getRequestParameter("opcion"))
        {
            $button[$i]["name"] = "Nuevo";
            $button[$i]["tooltip"] = "Crear un nuevo reporte de negocios";
            $button[$i]["image"] = "22x22/new.gif";
            $button[$i]["link"] = "/reportesNeg/formReporteOtmmin";
            $i++;
        }
        //if ($impoexpo == Constantes::EXPO || utf8_decode($impoexpo) == Constantes::EXPO) {
            if ($editable && (!( $repAntecedentes->getCaIdantecedente() > 0)) || $repAntecedentes->getCaEstado() == "") {
                $button[$i]["name"] = "Editar";
                $button[$i]["tooltip"] = "Modificar este reporte";
                $button[$i]["image"] = "22x22/edit.gif";
                if ($reporte->getCaTiporep() == "3")
                    $button[$i]["link"] = "/reportesNeg/formReporteOs/id/" . $this->getRequestParameter("id");
                else if (/* $reporte->getCaTiporep()=="4" */"otmmin" == $this->getRequestParameter("opcion")) {
                    $button[$i]["link"] = "/reportesNeg/formReporteOtmmin/id/" . $this->getRequestParameter("id");
                } else
                    $button[$i]["link"] = "/reportesNeg/formReporte/id/" . $this->getRequestParameter("id") . "/impoexpo/" . $impoexpo . "/modo/" . $modo;

                $i++;

                $button[$i]["name"] = "Cambios Param.";
                $button[$i]["tooltip"] = "Cambiar parametros";
                $button[$i]["image"] = "22x22/arrow_branch.png";
                $button[$i]["onClick"] = "changeTrans()";
                $i++;
            }
        //}
        /*else {
        
            if ($editable && ($repAntecedentes->getCaEstado() == "")) {
            
                $button[$i]["name"] = "Editar";
                $button[$i]["tooltip"] = "Modificar este reporte";
                $button[$i]["image"] = "22x22/edit.gif";
                if ($reporte->getCaTiporep() == "3")
                    $button[$i]["link"] = "/reportesNeg/formReporteOs/id/" . $this->getRequestParameter("id");
                else if (/* $reporte->getCaTiporep()=="4" *//*"otmmin" == $this->getRequestParameter("opcion")) {
                    $button[$i]["link"] = "/reportesNeg/formReporteOtmmin/id/" . $this->getRequestParameter("id");
                } else
                    $button[$i]["link"] = "/reportesNeg/formReporte/id/" . $this->getRequestParameter("id") . "/impoexpo/" . $impoexpo . "/modo/" . $modo;

                $i++;

                $button[$i]["name"] = "Cambios Param.";
                $button[$i]["tooltip"] = "Cambiar parametros";
                $button[$i]["image"] = "22x22/arrow_branch.png";
                $button[$i]["onClick"] = "changeTrans()";
                $i++;
            }
        }*/
        $button[$i]["name"] = "Generar ";
        $button[$i]["tooltip"] = "Genera un archivo PDF con el reporte";
        $button[$i]["image"] = "22x22/pdf.gif";
        $button[$i]["link"] = "/reportesNeg/verReporte/id/" . $this->getRequestParameter("id") . "/impoexpo/" . $impoexpo . "/modo/" . $modo;
        $i++;
        if (!$cerrado) {
            if(!$anulado)
            {
                $button[$i]["id"] = "anular-reporte";
                $button[$i]["name"] = "Anular ";
                $button[$i]["tooltip"] = "Anula el reporte actual";
                $button[$i]["image"] = "22x22/cancel.gif";
                $button[$i]["onClick"] = "ventanaAnularReporte()";                
                $i++;
            }            
        }
        if ($editable) {
            $button[$i]["name"] = "Unificar ";
            $button[$i]["tooltip"] = "Copia las comunicaciones existentes de un reporte a este reporte";
            $button[$i]["image"] = "22x22/copy_newv.gif";
            $button[$i]["link"] = "/reportesNeg/unificarReporte/id/" . $this->getRequestParameter("id") . "/impoexpo/" . $impoexpo . "/modo/" . $modo;
            $i++;
        }
        
        if($tipo!=4)
        {
            $l="/traficos/verHistorialStatus/idreporte/" . $this->getRequestParameter("id") ;
        }
        else   
            $l="/traficos/listaStatus/modo/otm?reporte=".$reporte->getCaConsecutivo();
        $button[$i]["name"] = "Status ";
        $button[$i]["tooltip"] = "Historial de Status";
        $button[$i]["image"] = "22x22/txt.gif";
        $button[$i]["onClick"] = "window.open('$l')";
        $i++;

        if ($editable) {
            $button[$i]["name"] = "Importar";
            $button[$i]["tooltip"] = "Importar un reporte";
            $button[$i]["image"] = "22x22/window_nofullscreen.gif";
            $button[$i]["onClick"] = "location.href='/reportesNeg/busquedaReporte/idimpo/" . $this->getRequestParameter("id") . "'";
            $i++;
        }

        if (!$cerrado || $editable || "otmmin"==$this->getRequestParameter("opcion") ) {
            $button[$i]["name"] = "Nueva version";
            $button[$i]["tooltip"] = "Crear una nueva version para un reporte";
            $button[$i]["image"] = "22x22/todo.gif";
            $button[$i]["onClick"] = "nuevoRep()";
            $i++;
        }
        $button[$i]["name"] = "Copiar";
        $button[$i]["tooltip"] = "copiar en un nuevo reporte";
        $button[$i]["image"] = "22x22/copy_newv.gif";
        $button[$i]["onClick"] = "copiaRep()";
        $i++;

        if($reporte->getCaTiporep()=="2" && ( $user->getIddepartamento()==14 || $user->getIddepartamento()==13 || $user->getIdsucursal()=="PER" ) )
        {
            $button[$i]["name"] = "Copiar Ag";
            $button[$i]["tooltip"] = "Copiar este Reporte Ag  ";
            $button[$i]["image"] = "22x22/copy.gif";
            $button[$i]["link"] = "/reportesNeg/formReporteAg/id/" . $this->getRequestParameter("id");
            $i++;
        }
        if ($permiso > 1 && !$cerrado) {
            $button[$i]["name"] = "Cerrar";
            $button[$i]["tooltip"] = "Cerrar un reporte";
            $button[$i]["image"] = "22x22/encrypted.gif";
            $button[$i]["onClick"] = "cerrarAbrir('" . $this->getRequestParameter("id") . "','1')";
            $i++;
        } else if ($permiso > 2 && $cerrado) {
            $button[$i]["name"] = "Abrir";
            $button[$i]["tooltip"] = "Abrir un reporte";
            $button[$i]["image"] = "22x22/unlock.gif";
            $button[$i]["onClick"] = "cerrarAbrir('" . $this->getRequestParameter("id") . "','2')";
            $i++;
        }
        
        if ($scliente==true) {
            $button[$i]["name"] = "Novedades";
            $button[$i]["tooltip"] = "Anotaciones de Servicio al Cliente";
            $button[$i]["image"] = "22x22/note.png";
            $button[$i]["onClick"] = "ventanaNotas()";
            $i++;
        }
        
        if($tipo=="4" || $reporte->getEsOtm())
        {
            $button[$i]["name"] = "Instrucciones";
            $button[$i]["tooltip"] = "Enviar Instrucciones";
            $button[$i]["image"] = "22x22/email.gif";
            $button[$i]["link"] = "/reportesNeg/emailInstruccionesOtm/idreporte/" . $this->getRequestParameter("id") . "/impoexpo/" . $reporte->getCaImpoexpo() . "/modo/" . $reporte->getCaTransporte();
            $i++;
        }
        
        if($reporte->getCaVersion()>1)
        {
            $button[$i]["name"] = "Cambios ";
            $button[$i]["tooltip"] = "Muestra los cambios que se efectuaron contra la version anterior";
            $button[$i]["image"] = "22x22/kspread_ksp.gif";
            $button[$i]["link"] = "/reportesNeg/compReporte/id/" . $this->getRequestParameter("id") . "/impoexpo/" . $impoexpo . "/modo/" . $modo;
            $i++;
        }
        
        break;
    case "verReporte":
        $button[$i]["name"] = "Volver ";
        $button[$i]["tooltip"] = "Vuelve a la pagina anterior";
        $button[$i]["image"] = "22x22/1leftarrow.gif";
        $button[$i]["link"] = "/reportesNeg/consultaReporte/id/" . $this->getRequestParameter("id") . "/impoexpo/" . $reporte->getCaImpoexpo() . "/modo/" . $reporte->getCaTransporte();
        $i++;

        $button[$i]["name"] = "Notificar";
        $button[$i]["tooltip"] = "Envia una notificación a las personas relacionadas en el reporte para que lo revisen";
        $button[$i]["image"] = "22x22/email.gif";
        $button[$i]["link"] = "/reportesNeg/enviarNotificacion/idreporte/" . $this->getRequestParameter("id") . "/token/" . md5(time());
        $i++;

        if(($reporte->getCaUsuanulado()==$user->getUserId() && !$reporte->getCaIdgrupo()) || $permiso > 2 )
        {
            $button[$i]["id"] = "revivir-reporte";
            $button[$i]["name"] = "Revivir";
            $button[$i]["tooltip"] = "Revive el reporte actual";
            $button[$i]["image"] = "22x22/cancel.gif";
            $button[$i]["onClick"] = "revivirReporte()";
            $button[$i]["link"] = "#";
            $i++;
        }

        if($this->getRequestParameter("idantecedente")!="" && $mostrarAnt)
        {
            $button[$i]["name"] = "Desbloquear ";
            $button[$i]["tooltip"] = "Desbloquea un reporte y confirma la aceptacion";
            $button[$i]["image"] = "22x22/unlock.gif";
            $button[$i]["onClick"] = "desbloquear1('".$this->getRequestParameter("idantecedente")."')";
            $i++;

            $button[$i]["id"] = "rechazar";
            $button[$i]["name"] = "Rechazar ";
            $button[$i]["tooltip"] = "Rechaza la reporte por algun inconveniente";
            $button[$i]["image"] = "22x22/cancel.gif";
            $button[$i]["onClick"] = "rechazar1()";
            $i++;
        }
        
        
        $button[$i]["name"] = "Historico";
        $button[$i]["tooltip"] = "Lista de todas las versiones del reporte de negocios";
        $button[$i]["image"] = "22x22/5days.gif";
        $button[$i]["link"] = "/reportesNeg/listaVersiones/consecutivo/" . $reporte->getCaConsecutivo();
        $i++;
        
        if($reporte->getCaVersion()>1)
        {
            $button[$i]["name"] = "Cambios ";
            $button[$i]["tooltip"] = "Muestra los cambios que se efectuaron contra la version anterior";
            $button[$i]["image"] = "22x22/kspread_ksp.gif";
            $button[$i]["link"] = "/reportesNeg/compReporte/id/" . $this->getRequestParameter("id") . "/impoexpo/" . $impoexpo . "/modo/" . $modo;
            $i++;
        }
        
        break;
    case "unificarReporte":
        $button[$i]["name"] = "Volver ";
        $button[$i]["tooltip"] = "Vuelve a la pagina anterior";
        $button[$i]["image"] = "22x22/1leftarrow.gif";
        $button[$i]["link"] = "/reportesNeg/consultaReporte/id/" . $this->getRequestParameter("id") . "/impoexpo/" . $impoexpo . "/modo/" . $modo;
        $i++;
        break;
    case "formReporte":
    case "formReporte1":
    case "formReporteOtmmin":
    case "compReporte":
        if($action=="formReporteOtmmin")
        {
            $button[$i]["name"] = "Nuevo";
            $button[$i]["tooltip"] = "Crear un nuevo reporte de negocios";
            $button[$i]["image"] = "22x22/new.gif";
            $button[$i]["link"] = "/reportesNeg/formReporteOtmmin";
            $i++;
        }
        if ($this->getRequestParameter("id") != "") {

            $button[$i]["name"] = "Transp.";
            $button[$i]["tooltip"] = "Cambiar el Tranporte";
            $button[$i]["image"] = "22x22/arrow_branch.png";
            $button[$i]["onClick"] = "changeTrans()";
            $i++;

            $button[$i]["name"] = "Generar ";
            $button[$i]["tooltip"] = "Genera un archivo PDF con el reporte";
            $button[$i]["image"] = "22x22/pdf.gif";
            $button[$i]["link"] = "/reportesNeg/verReporte/id/" . $this->getRequestParameter("id") . "/impoexpo/" . $impoexpo . "/modo/" . $modo;
            $i++;
            
            if(!$anulado)
            {
                $button[$i]["id"] = "anular-reporte";
                $button[$i]["name"] = "Anular ";
                $button[$i]["tooltip"] = "Anula el reporte actual";
                $button[$i]["image"] = "22x22/cancel.gif";
                $button[$i]["onClick"] = "ventanaAnularReporte()";
                $i++;
            }

            $button[$i]["name"] = "Unificar ";
            $button[$i]["tooltip"] = "Copia las comunicaciones existentes de un reporte a este reporte";
            $button[$i]["image"] = "22x22/copy_newv.gif";
            $button[$i]["link"] = "/reportesNeg/unificarReporte/id/" . $this->getRequestParameter("id") . "/impoexpo/" . $impoexpo . "/modo/" . $modo;
            $i++;

            $button[$i]["name"] = "Status ";
            $button[$i]["tooltip"] = "Historial de Status";
            $button[$i]["image"] = "22x22/txt.gif";
            $button[$i]["onClick"] = "window.open('/traficos/verHistorialStatus/idreporte/" . $this->getRequestParameter("id") . "')";
            $i++;
            if ($editable) {
                $button[$i]["name"] = "Importar";
                $button[$i]["tooltip"] = "Importar un reporte";
                $button[$i]["image"] = "22x22/window_nofullscreen.gif";
                $button[$i]["onClick"] = "location.href='/reportesNeg/busquedaReporte/idimpo/" . $this->getRequestParameter("id") . "'";
                $i++;
            }

            if (!$cerrado || $editable || "otmmin"==$this->getRequestParameter("opcion")) {
                $button[$i]["name"] = "Nueva version";
                $button[$i]["tooltip"] = "Crear una nueva version para un reporte";
                $button[$i]["image"] = "22x22/todo.gif";
                $button[$i]["onClick"] = "nuevoRep()";
                $i++;
            }
            $button[$i]["name"] = "Copiar";
            $button[$i]["tooltip"] = "copiar en un nuevo reporte";
            $button[$i]["image"] = "22x22/copy_newv.gif";
            $button[$i]["onClick"] = "copiaRep()";
            $i++;

            if($reporte->getCaTiporep()=="2" && ($user->getIddepartamento()==14 || $user->getIddepartamento()==13)  )
            {
                $button[$i]["name"] = "Copiar Ag";
                $button[$i]["tooltip"] = "Copiar este Reporte Ag  ";
                $button[$i]["image"] = "22x22/copy.gif";
                $button[$i]["link"] = "/reportesNeg/formReporteAg/id/" . $this->getRequestParameter("id");
                $i++;
            }

            if ($permiso > 1 && !$cerrado) {
                $button[$i]["name"] = "Cerrar";
                $button[$i]["tooltip"] = "Cerrar un reporte";
                $button[$i]["image"] = "22x22/encrypted.gif";
                $button[$i]["onClick"] = "cerrarAbrir('" . $this->getRequestParameter("id") . "','1')";
                $i++;
            } else if ($permiso > 2 && $cerrado) {
                $button[$i]["name"] = "Abrir";
                $button[$i]["tooltip"] = "Abrir un reporte";
                $button[$i]["image"] = "22x22/unlock.gif";
                $button[$i]["onClick"] = "cerrarAbrir('" . $this->getRequestParameter("id") . "','2')";
                $i++;
            }
            if($tipo=="4" || $reporte->getEsOtm())
            {
                $button[$i]["name"] = "Instrucciones";
                $button[$i]["tooltip"] = "Enviar Instrucciones";
                $button[$i]["image"] = "22x22/email.gif";
                $button[$i]["link"] = "/reportesNeg/emailInstruccionesOtm/idreporte/".$this->getRequestParameter("id")."/impoexpo/".$reporte->getCaImpoexpo()."/modo/".$reporte->getCaTransporte();
                $i++;
            }
            
            $button[$i]["name"] = "Historico";
            $button[$i]["tooltip"] = "Lista de todas las versiones del reporte de negocios";
            $button[$i]["image"] = "22x22/5days.gif";
            $button[$i]["link"] = "/reportesNeg/listaVersiones/consecutivo/" . $reporte->getCaConsecutivo();
            $i++;
            
            if($reporte->getCaVersion()>1)
            {
                $button[$i]["name"] = "Cambios ";
                $button[$i]["tooltip"] = "Muestra los cambios que se efectuaron contra la version anterior";
                $button[$i]["image"] = "22x22/kspread_ksp.gif";
                $button[$i]["link"] = "/reportesNeg/compReporte/id/" . $this->getRequestParameter("id") . "/impoexpo/" . $impoexpo . "/modo/" . $modo;
                $i++;
            }
            
        }
        break;
}
?>
<script>
    var idreportetmp;
    function rechazarReporte(){
        Ext.MessageBox.show({
           title: 'Rechazar Referecia',
           msg: 'por favor coloque el motivo por el que rechaza el reporte:',
           width:300,
           buttons:{
              ok     : "Enviar",
              cancel : "Cancelar"
           },
           multiline: true,
           fn: rechaza,
           animEl: 'anular-reporte',
           modal: true
        });
        Ext.MessageBox.buttonText.yes = "Version";
        Ext.MessageBox.buttonText.no = "Todas las versiones";
    }
    
    var rechaza = function(btn, text){
        if( btn == "ok"){
            if( text.trim()==""){
                alert("Debe colocar un motivo");
            }else{
                if(btn=="ok")
                    href='<?=url_for("antecedentes/rechazarReporte?id=".$this->getRequestParameter("id"))?>';
                Ext.MessageBox.wait('enviando Notificacion de rechazo', '');
                Ext.Ajax.request(
                {
                    waitMsg: 'Enviando...',
                    url: href,
                    params :	{
                        mensaje: text.trim()
                    },
                    failure:function(response,options){
                        alert( response.responseText );
                        Ext.Msg.hide();
                        success = false;
                        alert("Surgio un problema al tratar de rechzar el reporte")
                    },
                    success:function(response,options){
                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.success ){
                            alert("Se envio aviso ")
                            location.href="/reportesNeg/index";
                        }
                    }
                 }
            );
            }
        }
    };
    
    function cerrarAbrir(id,tipo)
    {
        if(window.confirm("Esta seguro de cambiar el estado del reporte?"))
        {
            Ext.MessageBox.wait('Cerrando o Abriendo reporte, Espere por favor', '');
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?= url_for("reportesNeg/cerrarReporte") ?>',
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
                        location.href="/reportesNeg/consultaReporte/id/<?= $this->getRequestParameter("id") ?>/impoexpo/<?= $impoexpo ?>/modo/<?= $modo ?>";
                    }
                }
            });
        }
    }
    
    function nuevoRep()
    {
        // if(window.confirm("Realmente desea crear una nueva version para este reporte?"))
        {
            Ext.MessageBox.wait('Guardando, Espere por favor', '---');
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?= url_for("reportesNeg/guardarReporte") ?>',
                params :	{
                    idreporte:'<?= $this->getRequestParameter("id") ?>',
                    opcion:"2",
                    tipo:"full",
                    opcion1:"<?=$this->getRequestParameter("opcion")?>"
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
                        <?
                            if($tipo=="3")
                            {
                        ?>
                            location.href="/reportesNeg/formReporteOs/id/"+res.idreporte;
                            
                        <?
                            }
                            else if($tipo=="4" || $this->getRequestParameter("opcion")=="otmmin")
                            {
                         ?>
                            location.href="/reportesNeg/formReporteOtmmin/id/"+res.idreporte;
                         <?
                            }
                            else
                            {
                        ?>
                            location.href="/reportesNeg/formReporte/id/"+res.idreporte+"/impoexpo/<?= $impoexpo ?>/modo/<?= $modo ?>";
                        <?
                            }
                        ?>
                        
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
                url: '<?= url_for("reportesNeg/guardarReporte") ?>',
                params :	{
                    idreporte:'<?= $this->getRequestParameter("id") ?>',
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
                        location.href="/reportesNeg/consultaReporte/id/"+res.idreporte+"/impoexpo/<?= $impoexpo ?>/modo/<?= $modo ?>";
                }
            });
        }
    }

    function revivirReporte()
    {
        if(window.confirm("Realmente desea revivir el reporte?"))
        {
            Ext.MessageBox.wait('Guardando, Espere por favor', '---');
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?= url_for("reportesNeg/revivirReporte") ?>',
                params :	{
                    idreporte:'<?= $this->getRequestParameter("id") ?>'
                },
                failure:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if(res.err)
                        Ext.MessageBox.alert("Mensaje",'Se presento un error guardando por favor informe al Depto. de Sistemas<br>'+res.err);
                    else
                        Ext.MessageBox.alert("Mensaje",'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>'+res.texto);
                },
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    Ext.MessageBox.alert("Mensaje",'Se guardo correctamente el reporte');
                    //if(res.redirect)
                        location.href="/reportesNeg/consultaReporte/id/"+res.idreporte+"/impoexpo/"+res.impoexpo+"/modo/"+res.trasnporte;
                }
            });
        }
    }

    function help1(id)
    {
        var win = new Ext.Window({
            width:600
            ,id:'autoload-win'
            ,height:500
            ,autoScroll:true
            ,autoLoad:{
                url:'/reportesNeg/help/idhelp/'+id
            }
            ,title:'Instructivo de ayuda'
        });
        win.show();
    }

    function changeTrans()
    {
        var win = new Ext.Window({
            width:350
            ,id:'autoload-win'
            ,height:150
            ,autoScroll:true
            ,title:'Cambio de Parametros'
            ,items:new Ext.FormPanel({
                autoWidth       : true,                
                id: 'change-form',
                bbar:[
                    {
                        text:'Guardar',
                        iconCls:'disk',
                        handler: function(){
                        if(Ext.getCmp("transporte-change").getValue()!="")
                        {
                            if(window.confirm("Realmente desea cambiar los parametros del reporte?"))
                            {
                                Ext.MessageBox.wait('Guardando, Espere por favor', '---');
                                Ext.Ajax.request(
                                {
                                    waitMsg: 'Guardando cambios...',
                                    url: '<?= url_for("reportesNeg/cambioParametros") ?>',
                                    params :	{
                                        idreporte:'<?= $this->getRequestParameter("id") ?>',
                                        transporte:Ext.getCmp("transporte-change").getValue(),
                                        impoexpo:Ext.getCmp("impoexpo-change").getValue(),
                                        tipo:"cambio-transporte"
                                    },
                                    failure:function(response,options){
                                        var res = Ext.util.JSON.decode( response.responseText );
                                        if(res.err)
                                            Ext.MessageBox.alert("Mensaje",'Se presento un error guardando por favor informe al Depto. de Sistemas<br>'+res.err);
                                    },
                                    success:function(response,options){
                                        var res = Ext.util.JSON.decode( response.responseText );
                                        Ext.MessageBox.alert("Mensaje",'Se guardo correctamente el reporte');
                                        if(res.redirect)
                                            location.href="/reportesNeg/consultaReporte/id/"+res.idreporte+"/impoexpo/<?= $impoexpo ?>/modo/"+Ext.getCmp("transporte-change").getValue();
                                    }
                                });
                            }
                        }
                        else
                        {
                            Ext.MessageBox.alert("Mensaje",'Por favor escoja un transporte para seguir');
                        }
                                       // alert(Ext.getCmp("transporte-change").getValue());
                    }
                    }
                ],

                items: [
                    new WidgetTransporte(
                        {
                            fieldLabel: 'Transporte',                        
                            id: 'transporte-change',
                            name:'transporte-change',                            
                            tabIndex:1,
                            value:'<?=$modo?>'
                       })
                    ,
                    new WidgetImpoexpo(
                        {
                            fieldLabel: 'Impoexpo',                        
                            id: 'impoexpo-change',
                            name:'impoexpo-change',
                            tabIndex:2,
                            value:'<?=$impoexpo?>'
                       })
                ]
            })
        });
        win.show();
    }
    
    
    /*function desbloquear1(id)
    {
        idreportetmp=id;
        if(window.confirm("Realmente desea desbloquear el reporte?"))
        {
            Ext.MessageBox.wait('Guardando, Espere por favor', '---');
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?= url_for("reportesNeg/desbloquearReporte") ?>',
                params :	{
                    idantecedente:'<?=$this->getRequestParameter("idantecedente")?>'
                },
                failure:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if(res.err)
                        Ext.MessageBox.alert("Mensaje",'Se presento un error guardando por favor informe al Depto. de Sistemas<br>'+res.err);
                    else
                        Ext.MessageBox.alert("Mensaje",'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>'+res.texto);
                },
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    Ext.MessageBox.alert("Mensaje",'Se guardo correctamente el reporte y fue desbloqueado');
                    alert('Se guardo correctamente el reporte');
                        if(window.confirm('Desea enviar status inmediatamente?'))
                        {
                            if(res.transporte=='<?=Constantes::AEREO?>')
                                location.href="/traficos/listaStatus/modo/aereo/reporte/"+res.consecutivo;
                            else
                                location.href="/traficos/listaStatus/modo/maritimo/reporte/"+res.consecutivo;
                        }
                        else
                        {
                            location.href=location.href;
                        }
                        
                }
            });
        }
    }*/
    
    
    
    function desbloquear1(id){
        idreportetmp=id;        
        Ext.MessageBox.show({
           title: 'Desbloquear Entrega de Reporte',
           msg: 'por favor coloque el motivo a notificar el Reporte de Negocios:',
           width:300,
           buttons:{
              ok     : "Enviar",
              cancel : "Cancelar"
           },
           multiline: true,
           fn: desbloqueoAntecedentes,
           animEl: 'desbloqueo-reporte',
           modal: true
        });        
        Ext.MessageBox.getDialog().getEl().setStyle('z-index','80000');
    }

    var desbloqueoAntecedentes = function(btn, text){        
        if( btn == "ok"){
            /*if( text.trim()==""){
                alert("Debe colocar un motivo");
            }else*/{
                if(btn=="ok")
                    href='/reportesNeg/desbloquearReporte';
                Ext.MessageBox.wait('enviando Notificacion de desbloqueo', '');
                Ext.Ajax.request(
                {
                    waitMsg: 'Enviando...',
                    url: href,
                    params :	{
                        mensaje: text.trim(),
                        idantecedente:idreportetmp
                    },
                    failure:function(response,options){
                        alert( response.toSource() );
                        Ext.Msg.hide();
                        success = false;
                        alert("Surgio un problema al tratar de rechzar el reporte")
                    },
                    success:function(response,options){
                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.success ){
                            Ext.MessageBox.alert("Mensaje",'Se guardo correctamente el reporte y fue desbloqueado');
                            alert('Se guardo correctamente el reporte');
                            if(window.confirm('Desea enviar status inmediatamente?'))
                            {
                                if(res.transporte=='<?=Constantes::AEREO?>')
                                    location.href="/traficos/listaStatus/modo/aereo/reporte/"+res.consecutivo;
                                else
                                    location.href="/traficos/listaStatus/modo/maritimo/reporte/"+res.consecutivo;
                            }
                            else
                            {
                                location.href=location.href;
                            }
                        }
                    }
                 }
            );
            }
        }
    };
    
    
    function rechazar1(id){
        idreportetmp=id;
        Ext.MessageBox.show({
           title: 'Rechazar Entrega de Reporte',
           msg: 'por favor coloque el motivo por el que rechaza el Reporte de Negocios:',
           width:300,
           buttons:{
              ok     : "Enviar",
              cancel : "Cancelar"
           },
           multiline: true,
           fn: rechaza1,
           animEl: 'anular-reporte',
           modal: true
        });
        Ext.MessageBox.buttonText.yes = "Version";
        Ext.MessageBox.buttonText.no = "Todas las versiones";
        Ext.MessageBox.getDialog().getEl().setStyle('z-index', '50000');
    }

    var rechaza1 = function(btn, text){
        if( btn == "ok"){
            if( text.trim()==""){
                alert("Debe colocar un motivo");
            }else{
                if(btn=="ok")
                    href='/reportesNeg/rechazarReporte?idantecedente=<?=$this->getRequestParameter("idantecedente")?>';
                Ext.MessageBox.wait('enviando Notificacion de rechazo', '');
                Ext.Ajax.request(
                {
                    waitMsg: 'Enviando...',
                    url: href,
                    params :	{
                        mensaje: text.trim()
                    },
                    failure:function(response,options){
                        alert( response.toSource() );
                        Ext.Msg.hide();
                        success = false;
                        alert("Surgio un problema al tratar de rechzar el reporte")
                    },
                    success:function(response,options){
                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.success ){
                            alert("Se envio aviso al depto de traficos")
                            location.href=location.href;
                        }
                    }
                 }
            );
            }
        }
    };
    
</script>