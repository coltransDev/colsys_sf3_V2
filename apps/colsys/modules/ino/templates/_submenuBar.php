<?
/*
$button[0]["name"]="Principal";
$button[0]["tooltip"]="Pagina inicial del Colsys";
$button[0]["image"]="22x22/gohome.gif"; 			
$button[0]["link"]= "/index.html";
*/

$i=0;

if( $action!="index" ){
	$button[$i]["name"]="Inicio ";
	$button[$i]["tooltip"]="Pagina inicial del m�dulo";
	$button[$i]["image"]="22x22/gohome.gif"; 			
	$button[$i]["link"]= "ino/index?modo=".$this->getRequestParameter("idmaster");
	$i++;
    if($this->getRequestParameter("modo")==5 && $this->getRequestParameter("idmaster")>0)
    {
        $button[$i]["name"]="Instrucciones Puerto";
        $button[$i]["tooltip"]="Instrucciones Puerto";
        $button[$i]["image"]="22x22/email.gif"; 			
        $button[$i]["link"]= "ino/instruccionesOtm?modo=".$this->getRequestParameter("modo")."&idmaster=".$this->getRequestParameter("idmaster");
        //$button[$i]["link"]= "ino/instruccionesOtm?id=".$this->getRequestParameter("idmaster");
        $i++;
    }

    $button[$i]["id"] = "observacion";
    $button[$i]["name"] = "Observaciones";
    $button[$i]["tooltip"] = "Ingresar observaciones a la referencia";
    $button[$i]["image"] = "22x22/txt.gif";
    $button[$i]["onClick"] = "observa()";
    $i++;
}

switch($action){
	case "index":		
		$button[$i]["name"]="Nuevo";
		$button[$i]["tooltip"]="Crear una nueva referencia";
		$button[$i]["image"]="22x22/new.gif"; 			
		$button[$i]["link"]= "ino/formIno?modo=".$this->getRequestParameter("modo")."&token=".md5(time());
		$i++;
		break;
    case "formComprobante":
		$button[$i]["name"]="Volver";
		$button[$i]["tooltip"]="Vuelve a la referencia";
		$button[$i]["image"]="22x22/1leftarrow.gif";
		$button[$i]["link"]= "ino/verReferencia?modo=".$this->getRequestParameter("modo")."&id=".$this->getRequestParameter("idmaestra");
		$i++;
		break;

	case "verReferencia":
		$button[$i]["name"]="Editar";
		$button[$i]["tooltip"]="Edita los valores de esta referencia";
		$button[$i]["image"]="22x22/edit.gif";
		$button[$i]["link"]= "ino/formIno?modo=".$this->getRequestParameter("modo")."&idmaster=".$this->getRequestParameter("idmaster");
		$i++;
        
        $button[$i]["name"]="Anular";
		$button[$i]["tooltip"]="Anula esta referencia";
		$button[$i]["image"]="22x22/cancel.gif";
		$button[$i]["onClick"] = "anularReporte()";
		$i++;
		
		break;
    case "verComprobante":
		$button[$i]["name"]="Volver";
		$button[$i]["tooltip"]="Vuelve a la referencia";
		$button[$i]["image"]="22x22/1leftarrow.gif";
		$button[$i]["link"]= "ino/verReferencia?modo=".$this->getRequestParameter("modo")."&id=".$this->getRequestParameter("idmaestra");
		$i++;
		break;
				
}


?>

<script>
    function anularReporte()
    {
        if(window.confirm("Realmente desea eliminar la referencia?"))
        {
            Ext.MessageBox.wait('Espere por favor', '---');
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?= url_for("ino/anularReferencia") ?>',
                params :	{
                    idmaster:'<?= $this->getRequestParameter("idmaster") ?>'
                },
                failure:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if(res.err)
                        Ext.MessageBox.alert("Mensaje",'Se presento un error guardando por favor informe al Depto. de Sistemas<br>'+res.err);
                    else
                        Ext.MessageBox.alert("Mensaje",'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>'+res.texto);
                },
                success:function(response,options){
                    //var res = Ext.util.JSON.decode( response.responseText );
                    Ext.MessageBox.alert("Mensaje",'Se ha anulado la referencia correctamente');
                    //if(res.redirect)
                        location.href="/ino/index/modo/<?=$this->getRequestParameter("modo")?>";
                }
            });
        }
    }
    
    
    
    function observa(id){        
        Ext.MessageBox.show({
           title: 'Observaciones',
           msg: 'Ingrese las observaciones para la referencia:',
           width:500,
           buttons:{
              ok     : "Enviar",
              cancel : "Cancelar"
           },
           multiline: true,
           fn: mensaje,
           animEl: 'anular-reporte',
           modal: true
        });
        Ext.MessageBox.buttonText.yes = "Version";
        Ext.MessageBox.buttonText.no = "Todas las versiones";
    }

    var mensaje = function(btn, text){
        if( btn == "ok"){
            if( text.trim()==""){
                alert("Debe colocar una observacion");
            }else{
                if(btn=="ok")
                    href='/ino/guardarMaster';
                Ext.MessageBox.wait('Guardando Observaciones', '');
                Ext.Ajax.request(
                {
                    waitMsg: 'Enviando...',
                    url: href,
                    params :	{
                        ca_observaciones: text.trim(),
                        idmaster:'<?=$this->getRequestParameter("idmaster")?>',
                        tipo:"obs"
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
                            //alert("Se envio aviso al depto de traficos")
                            location.href=location.href;
                        }
                    }
                 }
            );
            }
        }
    };    
    
</script>