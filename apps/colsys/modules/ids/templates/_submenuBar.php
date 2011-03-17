<?
/*
$button[0]["name"]="Principal";
$button[0]["tooltip"]="Pagina inicial del Colsys";
$button[0]["image"]="22x22/gohome.gif"; 			
$button[0]["link"]= "/index.html";
*/

$i=0;

if( $action!="index" && $action!="listadoProveedoresAprobados" ){
	$button[$i]["name"]="Inicio ";
	$button[$i]["tooltip"]="Pagina inicial del módulo";
	$button[$i]["image"]="22x22/gohome.gif"; 			
	$button[$i]["link"]= "ids/index?modo=".$this->getRequestParameter("modo");
	$i++;
}



switch($action){
	case "index":
        @$nivel = idsActions::getNivel();
        if( $nivel>=4 ){
            $button[$i]["name"]="Nuevo";
            $button[$i]["tooltip"]="Crear una nuevo registro";
            $button[$i]["image"]="22x22/new.gif";
            $button[$i]["link"]= "ids/formIds?modo=".$this->getRequestParameter("modo");
            $i++;
        }

		break;	

	case "verIds":
        @$nivel = idsActions::getNivel();
        if( $nivel>=3 ){
            $button[$i]["name"]="Editar";
            $button[$i]["tooltip"]="Edita este registro";
            $button[$i]["image"]="22x22/edit.gif";
            $button[$i]["link"]= "ids/formIds?id=".$this->getRequestParameter("id")."&modo=".$this->getRequestParameter("modo") ;
            $i++;

            $button[$i]["name"]="Nueva suc.";
            $button[$i]["tooltip"]="";
            $button[$i]["image"]="22x22/add_group.gif";
            $button[$i]["link"]= "ids/formSucursalIds?id=".$this->getRequestParameter("id")."&modo=".$this->getRequestParameter("modo") ;
            $i++;

            $button[$i]["name"]="Lista Clinton";
            $button[$i]["tooltip"]="";
            $button[$i]["image"]="22x22/kfind.gif";
            $button[$i]["link"]= "ids/verificarListaClinton?id=".$this->getRequestParameter("id")."&modo=".$this->getRequestParameter("modo") ;
            $i++;

            if( $this->getRequestParameter("modo")=="agentes" ){
                $button[$i]["name"]="Eliminar";
                $button[$i]["tooltip"]="";
                $button[$i]["image"]="16x16/delete.gif";
                $button[$i]["onClick"]= "eliminarAgente()" ;
                $i++;
            }

        }
		break;
}

if( $this->getRequestParameter("modo")=="prov" && $action!="listadoProveedoresAprobados" ){
    $button[$i]["name"]="Prov.Aprobados ";
    $button[$i]["tooltip"]="Listado de proveedores aprobados";
    $button[$i]["image"]="22x22/gohome.gif";
    $button[$i]["link"]= "ids/listadoProveedoresAprobados?modo=".$this->getRequestParameter("modo");
    $i++;

    $button[$i]["name"]="Prov. Inactivos ";
    $button[$i]["tooltip"]="Listado de proveedores inactivos";
    $button[$i]["image"]="22x22/gohome.gif";
    $button[$i]["link"]= "ids/listadoProveedoresInactivos?modo=".$this->getRequestParameter("modo");
    $i++;


    @$nivel = idsActions::getNivel();
    if( $nivel>=2 ){
        $button[$i]["name"]="Vencimientos Docs.";
        $button[$i]["tooltip"]="Listado de documentos proximos a vencerse";
        $button[$i]["image"]="22x22/todo.gif";
        $button[$i]["link"]= "ids/alertasDocumentos?modo=".$this->getRequestParameter("modo");
        $i++;

         $button[$i]["name"]="Docs. Por Proveedor";
        $button[$i]["tooltip"]="Listado de documentos proximos a vencerse";
        $button[$i]["image"]="22x22/package_editors.png";
        $button[$i]["link"]= "ids/documentosPorTipo?modo=".$this->getRequestParameter("modo");
        $i++;
    }
    

}




?>