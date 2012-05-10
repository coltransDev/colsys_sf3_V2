<?

switch($action){
	case "formComprobante":
        $i = 0;
        if( $this->getRequestParameter("idmaster") ){
            $button[$i]["name"]="Volver";
            $button[$i]["tooltip"]="Volver al ticket";
            $button[$i]["image"]="22x22/1leftarrow.gif";
            $button[$i]["link"]= "ino/verReferencia?idmaster=".$this->getRequestParameter("idmaster")."&modo=".$this->getRequestParameter("modo");
            $i++;
        }
		break;

    case "verComprobante":
        $i = 0;
        if( $this->getRequestParameter("idmaster") ){
            $button[$i]["name"]="Volver";
            $button[$i]["tooltip"]="Volver a la referencia";
            $button[$i]["image"]="22x22/1leftarrow.gif";
            $button[$i]["link"]= "ino/verReferencia?idmaster=".$this->getRequestParameter("idmaster")."&modo=".$this->getRequestParameter("modo");
            $i++;
        }

        $button[$i]["name"]="SIIGO";
        $button[$i]["tooltip"]="Volver al ticket";
        $button[$i]["image"]="22x22/siigo.png";
        $button[$i]["link"]= "inocomprobantes/generarArchivo1?idcomprobante=".$this->getRequestParameter("id");
        $i++;
		break;

			
}

?>