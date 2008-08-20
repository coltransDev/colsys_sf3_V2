<?
$code=$user->getCaActivationCode();
$link = "/tracking/login/activate/code/".$code ;						
						$content = Utils::replace(" Apreciado/a ".$contacto->getCaNombres()." ".$contacto->getCaPapellido()."\n
		Gracias por utilizar el servicio de tracking and tracing de Coltrans S.A., hemos enviado este correo para activar la clave de su cuenta, por favor haga click en el enlace que se encuentra a continuación: \n");
		
						$content .= "<a href='https://".$_SERVER['HTTP_HOST'].$link."'>Haga click aca para activar su cuenta</a>";
						$content .= Utils::replace("\n						
						Si desea conocer más de este servicio por favor comuníquese con nuestro departamento de servicio al cliente\n
						Cordialmente 
						\n\n
						Coltrans S.A.					
						");	
?>						
						
www.coltrans.com.co
* Adicionar un línea debajo de "Haga click aca para activar su cuenta"
Por favor tenga en cuenta las siguientes recomendaciones al crear su clave:
- Debe contener mínimo 5 caracteres
- Su clave solo es conocida por usted.
- Su clave debe ser personal e intransferible 						
						
						