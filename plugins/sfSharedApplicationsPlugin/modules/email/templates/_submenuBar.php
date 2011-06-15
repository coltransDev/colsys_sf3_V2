<?


switch($action){
	case "verEmail":		
		$button[1]["name"]="Reenviar";
		$button[1]["tooltip"]="reenviar email";
		$button[1]["image"]="22x22/email.gif"; 			
		$button[1]["link"]= 'email/reenviar?id='.$this->getRequestParameter("id");
		break;	

			
}
?>