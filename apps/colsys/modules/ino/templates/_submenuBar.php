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
	$button[$i]["tooltip"]="Pagina inicial del módulo";
	$button[$i]["image"]="22x22/gohome.gif"; 			
	$button[$i]["link"]= "ino/index?modo=".$this->getRequestParameter("modo");
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
</script>