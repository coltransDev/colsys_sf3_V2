<?
/*
$button[0]["name"]="Principal";
$button[0]["tooltip"]="Pagina inicial del Colsys";
$button[0]["image"]="22x22/gohome.gif"; 			
$button[0]["link"]= "/index.html";
*/

$i=0;


if($this->getRequestParameter("ref"))
{
    $numref = str_replace("|", ".", $this->getRequestParameter("ref"));
    //echo  $numref;
    //$master=new InoMaestraSea();
    $master = Doctrine::getTable("InoMaestraSea")->find($numref);
    $sucursal = $user->getIdSucursal();
}
else
{
    $numref="";
}


if( $action!="index" ){
    if( $this->getRequestParameter("format")!="maritimo" ){
        $button[$i]["name"]="Inicio ";
        $button[$i]["tooltip"]="Pagina inicial del m�dulo";
        $button[$i]["image"]="22x22/home.gif";
        $button[$i]["link"]= "antecedentes/index";
    }else{
        $button[$i]["name"]="Inicio ";
        $button[$i]["tooltip"]="Pagina inicial del m�dulo";
        $button[$i]["image"]="22x22/home.gif";
        $button[$i]["link"]= "/colsys_php/inosea.php";
    }
	$i++;
}

switch($action){


    case "index":
       
        $button[$i]["name"]="Nueva Master";
        $button[$i]["tooltip"]="Notifica al departamento mar�timo ";
        $button[$i]["image"]="22x22/home.gif";
        $button[$i]["link"]= "antecedentes/asignacionMaster";
		$i++;
        break;
	case "asignacionMaster":
        if( $this->getRequestParameter("ref") ){
            $button[$i]["name"]="Ver Planilla";
            $button[$i]["tooltip"]="Notifica al departamento mar�timo ";
            $button[$i]["image"]="22x22/txt.gif";
            $button[$i]["link"]= "antecedentes/verPlanilla?ref=".$this->getRequestParameter("ref");
        }
		$i++;
        break;
    case "verPlanilla":
//        echo $sucursal."-".$master->getUsuCreado()->getCaIdsucursal();
        if( $this->getRequestParameter("format")!="maritimo" && $sucursal==$master->getUsuCreado()->getCaIdsucursal()  ){
            $button[$i]["name"] = "Editar ";
            $button[$i]["tooltip"] = "Edita esta referencia para agregar o quitar reportes";
            $button[$i]["image"] = "22x22/edit.gif";
            $button[$i]["link"] = "antecedentes/asignacionMaster?ref=" . $this->getRequestParameter("ref");
            $i++;

            $button[$i]["name"]="Email ";
            $button[$i]["tooltip"]="Enviar este reporte por e-mail";
            $button[$i]["image"]="22x22/email.gif";
            $button[$i]["link"]= "#";
            $button[$i]["onClick"]= "showEmailForm()";
            $i++;
            
            $button[$i]["id"] = "anular-referencia";
            $button[$i]["name"] = "Eliminar ";
            $button[$i]["tooltip"] = "Elimina la referecia";
            $button[$i]["image"] = "22x22/cancel.gif";
            $button[$i]["onClick"] = "ventanaEliminarRef()";
            $i++;

        }
        else if( $this->getRequestParameter("format")=="maritimo" ){
//            $numRef = str_replace("|", ".", $this->getRequestParameter("ref"));
/*            $q = Doctrine::getTable("InoMaestraSea")
                        ->createQuery("m")
                        ->select("m.ca_provisional")
                        ->addWhere("m.ca_referencia = ?", $numRef)
                        ->fetchOne();
*/

            if($master && $master->getCaProvisional()==true || $master->getCaProvisional()=="true" || $master->getCaProvisional()=="1")
            {
                $button[$i]["name"] = "Desbloquear ";
                $button[$i]["tooltip"] = "Desbloquea una referencia y confirma la aceptacion";
                $button[$i]["image"] = "22x22/unlock.gif";
                $button[$i]["link"] = "antecedentes/aceptarReferencia?ref=" .  $this->getRequestParameter("ref");
                $i++;

                $button[$i]["id"] = "rechazar";
                $button[$i]["name"] = "Rechazar ";
                $button[$i]["tooltip"] = "Rechaza la referecia por algun inconveniente";
                $button[$i]["image"] = "22x22/cancel.gif";
                $button[$i]["onClick"] = "rechazarReferencia()";
                $i++;
            }
            if($master && $master->getCaUsumuisca()!="" && $user->getIdSucursal()=="BOG" && ($master->getCaCarpeta()=="0" or $master->getCaCarpeta()==false ) )
            {
                $button[$i]["id"] = "archivar-ref";
                $button[$i]["name"] = "Archivar ";
                $button[$i]["tooltip"] = "Crear la carpeta para archivar";
                $button[$i]["image"] = "22x22/folder.png";
                $button[$i]["link"]= "#";                
                $button[$i]["onClick"] = "archivar('".$master->getCaReferencia()."')";
                $i++;
            }
        }
		break;	
}
?>

<script>
     function rechazarReferencia(){
        Ext.MessageBox.show({
           title: 'Rechazar Referecia',
           msg: 'por favor coloque el motivo por el que rechaza la referecia:',
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
                    href='<?=url_for("antecedentes/rechazarReferencia?ref=".$this->getRequestParameter("ref"))?>';
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
                        alert("Surgio un problema al tratar de rechzar la referencia")
                    },
                    success:function(response,options){
                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.success ){
                            alert("Se envio aviso al depto de traficos")
                            location.href="/antecedentes/listadoReferencias/format/maritimo";
                        }
                    }
                 }
            );
            }
        }
    };

    var anularRef = function(btn, text){

        if( btn == "ok"){
            if( text.trim()==""){
                alert("Debe colocar un motivo");
            }else{
                href='<?=url_for("/antecedentes/anularReferencia?ref=".$this->getRequestParameter("ref"))?>';

                Ext.Ajax.request(
                {
                    waitMsg: 'Anulando...',
                    url: href,
                    params :	{
                        motivo: text.trim()
                    },

                    success:function(response,options){
                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.success ){
                            document.location="/antecedentes";
                        }
                    },
                    failure:function(response,options){
                        var res = Ext.util.JSON.decode( response.responseText );
                        if(res.errorInfo)
                            Ext.MessageBox.alert("Mensaje",'Se presento un error guardando por favor informe al Depto. de Sistemas<br>'+res.errorInfo);
                    }
                 }
            );
            }
        }
    };


    var ventanaEliminarRef = function(){
        Ext.MessageBox.show({
           title: 'Eliminar Referencia',
           msg: 'por favor coloque el motivo por el que eliminar la referencia:',
           width:300,
           buttons:{
              ok     : "Eliminar",
              cancel : "cancelar"
           },
           multiline: true,
           fn: anularRef,
           animEl: 'anular-ref',
           modal: true
        });
    }
    
    var archivar = function(ref){    
        if(window.confirm("Ya creo la carpeta para archivar?"))
        {
            Ext.MessageBox.wait('Espere por favor', '');
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?= url_for("antecedentes/archivarReferencia") ?>',
                params :	{
                    referencia: ref
                },
                failure:function(response,options){
                    //alert( response.responseText );
                    Ext.Msg.hide();
                    success = false;
                    Ext.MessageBox.hide();
                },
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if( res.success ){
                        $("#archivar-ref").remove();
                        location.href="/antecedentes/listadoReferencias/format/maritimo";
                        Ext.MessageBox.hide();
                    }
                }
            });
        }        
    }




</script>