<?
/*
  $button[0]["name"]="Principal";
  $button[0]["tooltip"]="Pagina inicial del Colsys";
  $button[0]["image"]="22x22/gohome.gif";
  $button[0]["link"]= "/index.html";
 */

$i = 0;
//echo $this->getRequestParameter("format");

if ($this->getRequestParameter("idmaster")) {
   //$numref = str_replace("|", ".", $this->getRequestParameter("ref"));
   $idmaster= str_replace("|", ".", $this->getRequestParameter("idmaster"));
   //echo  $numref;
   //$master=new InoMaestraSea();
   
   $master = Doctrine::getTable("InoMaster")->find($idmaster);
   $sucursal = $user->getIdSucursal();
} else {
   $numref = "";
}


if ($action != "index") {
   if ($action == "entregaOportuna" or $action == "editarEntregaOportuna" or $action == "editarBorrarOportuna") {
      $button[$i]["name"] = "Inicio ";
      $button[$i]["tooltip"] = "Pagina inicial del módulo";
      $button[$i]["image"] = "22x22/home.gif";
      $button[$i]["link"] = "antecedentes/entregaOportuna";      
   } else if ($this->getRequestParameter("format") != "maritimo") {
      $button[$i]["name"] = "Inicio ";
      $button[$i]["tooltip"] = "Pagina inicial del módulo";
      $button[$i]["image"] = "22x22/home.gif";
      $button[$i]["link"] = "antecedentes/index";
   } else {
      $button[$i]["name"] = "Inicio ";
      $button[$i]["tooltip"] = "Pagina inicial del módulo";
      $button[$i]["image"] = "22x22/home.gif";
      $button[$i]["link"] = "/colsys_php/inosea.php";
      $i++;
      
      $button[$i]["name"] = "Estado RN";
      $button[$i]["tooltip"] = "RN pendientes por antecedentes";
      $button[$i]["image"] = "22x22/agt_update_critical.gif";
      $button[$i]["link"] = "/reportesGer/reporteEnvioAntecedentes";
      
   }
   $i++;
}

switch ($action) {


   case "index":

      $button[$i]["name"] = "Nueva Master";
      $button[$i]["tooltip"] = "Notifica al departamento marítimo ";
      $button[$i]["image"] = "22x22/home.gif";
      $button[$i]["link"] = "antecedentes/asignacionMaster";
      $i++;
      break;
   case "asignacionMaster":
      if ($this->getRequestParameter("idmsater")) {
         $button[$i]["name"] = "Ver Planilla";
         $button[$i]["tooltip"] = "Notifica al departamento marítimo ";
         $button[$i]["image"] = "22x22/txt.gif";
         $button[$i]["link"] = "antecedentes/verPlanilla?idmaster=" . $this->getRequestParameter("idmaster");
      }
      $i++;
      break;
   case "verPlanilla":
//        echo $sucursal."-".$master->getUsuCreado()->getCaIdsucursal();
      if ($this->getRequestParameter("format") != "maritimo" && $sucursal == $master->getUsuCreado()->getCaIdsucursal()) {
         $button[$i]["name"] = "Editar ";
         $button[$i]["tooltip"] = "Edita esta referencia para agregar o quitar reportes";
         $button[$i]["image"] = "22x22/edit.gif";
         $button[$i]["link"] = "antecedentes/asignacionMaster?idmaster=" . $this->getRequestParameter("idmaster");
         $i++;

         $button[$i]["name"] = "Email ";
         $button[$i]["tooltip"] = "Enviar este reporte por e-mail";
         $button[$i]["image"] = "22x22/email.gif";
         $button[$i]["link"] = "#";
         $button[$i]["onClick"] = "showEmailForm()";
         $i++;

         $button[$i]["id"] = "anular-referencia";
         $button[$i]["name"] = "Eliminar ";
         $button[$i]["tooltip"] = "Elimina la referecia";
         $button[$i]["image"] = "22x22/cancel.gif";
         $button[$i]["onClick"] = "ventanaEliminarRef()";
         $i++;
      } else if ($this->getRequestParameter("format") == "maritimo") {
//            $numRef = str_replace("|", ".", $this->getRequestParameter("ref"));
         /*            $q = Doctrine::getTable("InoMaestraSea")
           ->createQuery("m")
           ->select("m.ca_provisional")
           ->addWhere("m.ca_referencia = ?", $numRef)
           ->fetchOne();
          */

         if ($master && $master->getCaReferencia() == "") {
            $button[$i]["name"] = "Desbloquear ";
            $button[$i]["tooltip"] = "Desbloquea una referencia y confirma la aceptacion";
            $button[$i]["image"] = "22x22/unlock.gif";
            $button[$i]["link"] = "antecedentes/aceptarReferencia?idmaster=" . $this->getRequestParameter("idmaster");
            $i++;

            $button[$i]["id"] = "rechazar";
            $button[$i]["name"] = "Rechazar ";
            $button[$i]["tooltip"] = "Rechaza la referecia por algun inconveniente";
            $button[$i]["image"] = "22x22/cancel.gif";
            $button[$i]["onClick"] = "rechazarReferencia()";
            $i++;
         }
         $masterSea=$master->getInoMasterSea();
         if ($masterSea->count()  ) {
             $datos=json_decode($masterSea->getCaDatos());
             //$master->getCaUsumuisca() != "" && $user->getIdSucursal() == "BOG" && ($master->getCaCarpeta() == "0" or $master->getCaCarpeta() == false
             if($datos->ca_usumuisca && $user->getIdSucursal() == "BOG" && ($masterSea->ca_carpeta() == "0" || $masterSea->ca_carpeta() == "false" ))
             {
                $button[$i]["id"] = "archivar-ref";
                $button[$i]["name"] = "Archivar ";
                $button[$i]["tooltip"] = "Crear la carpeta para archivar";
                $button[$i]["image"] = "22x22/folder.png";
                $button[$i]["link"] = "#";
                $button[$i]["onClick"] = "archivar('" . $master->getCaReferencia() . "')";
                $i++;
             }
         }
      }
      break;
   case "emailComodato":
      if ($this->getRequestParameter("idmaster")) {
         $button[$i]["name"] = "Email ";
         $button[$i]["tooltip"] = "Enviar este reporte por e-mail";
         $button[$i]["image"] = "22x22/email.gif";
         $button[$i]["link"] = "#";
         $button[$i]["onClick"] = "showEmailForm()";
         $i++;
      }
      $i++;
      break;
   case "emailAutorizacion":
      if ($this->getRequestParameter("idmaster")) {
         $button[$i]["name"] = "Email ";
         $button[$i]["tooltip"] = "Solicitar Autorizacion por e-mail";
         $button[$i]["image"] = "22x22/email.gif";
         $button[$i]["link"] = "#";
         $button[$i]["onClick"] = "showEmailForm()";
         $i++;
      }
      $i++;
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
               href='<?= url_for("antecedentes/rechazarReferencia?idmaster=" . $this->getRequestParameter("idmaster")) ?>';
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
                    else
                    {
                      alert(res.errorInfo);
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
            href='<?= url_for("/antecedentes/anularReferencia?idmaster=" . $this->getRequestParameter("idmaster")) ?>';

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
    
   var archivar = function(idmaster){    
      if(window.confirm("Ya creo la carpeta para archivar?"))
      {
         Ext.MessageBox.wait('Espere por favor', '');
         Ext.Ajax.request(
         {
            waitMsg: 'Guardando cambios...',
            url: '<?= url_for("antecedentes/archivarReferencia") ?>',
            params :	{
               "idmaster": idmaster
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