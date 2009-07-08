<?
class Utils{
		
	/*
	* Busca en un string el tag inicial y el tag final devuelve la informacion de en medio, 
	* esta funcion es usada para capturar datos de algunas paginas
	*/	
	public static function getInformation($string, $initialTag, $finalTag, $removeWhiteSpaces=true){
		if($removeWhiteSpaces){
			$string=str_replace(" ", "", $string);
		}
		$string=str_replace("\n", "", $string);
		$string=str_replace("\r", "", $string);
		$string=str_replace("\t", "", $string);
		
		if($removeWhiteSpaces){
			$initialTag=str_replace(" ", "", $initialTag);
		}
		$initialTag=str_replace("\n", "", $initialTag);
		$initialTag=str_replace("\r", "", $initialTag);	
		$initialTag=str_replace("\t", "", $initialTag);
		//echo "<br>".$string."<br>";
		//echo "<br>".$initialTag."<br>";
		
		$tmp1=strpos($string,$initialTag);
		
		if($tmp1===false){
			return false;
		}	
		
		$k1=$tmp1+strlen($initialTag);
			
		$string=substr($string, $k1, 1500);
		//echo $string;
		$k2=strpos($string,$finalTag);
				
		return substr($string, 0, $k2);		
		
	}
	
		
	static function formatNumber($number, $decimals=2, $dec_point=".", $thousands_sep=",") {
	   $nachkomma = abs($number - floor($number));
	   $strnachkomma = number_format($nachkomma , $decimals, $dec_point, $thousands_sep);
	
	   for ($i = 1; $i <= $decimals; $i++) {
		   if (substr($strnachkomma, ($i * -1), 1) != "0") {
			   break;
		   }
	   }
	   return number_format($number, ($decimals - $i +1), $dec_point, $thousands_sep);
	}
	
	public static function parseDate( $fecha , $format="Y-m-d"){
		return date( $format ,strtotime( $fecha  ) );
	}
	
	public static function transformDate( $fecha , $format="Y-m-d"){
		if ( !$fecha ){
			return "";
		}
		list( $year, $month, $day ) = sscanf($fecha, "%d-%d-%d");
		return date($format, mktime(0, 0, 0, $month, $day, $year));
	}
	
	public static function fechaMes($fecha){
		$newfecha = Utils::parseDate($fecha);
		

		$mes = substr($newfecha,5,2);
		return Utils::getMonth($mes)."-".substr($newfecha,8,2)."-".substr($newfecha,0,4);
	}
	
	public static function fechaLarga($fecha){
		$newfecha = Utils::parseDate($fecha);
		$mes = substr($newfecha,5,2);
		return substr($newfecha,8,2)." de ".Utils::mesLargo( $mes )." de ".substr($newfecha,0,4);
		
	}
	
	public static function compararFechas( $fecha1 , $fecha2 ){
		$time1 = strtotime( $fecha1 );
		$time2 = strtotime( $fecha2 );
		
		if( $time1 > $time2 ){
			return 1;		
		}
		
		if( $time1 < $time2 ){
			return -1;		
		}
		
		if( $time1 == $time2 ){
			return 0;		
		}
	}
	
	
	public static  function replace( $text ){
		$trans = get_html_translation_table(HTML_ENTITIES);		
		return str_replace( "\n","<br />",strtr( $text, $trans) );
	}
	
	public static function html_entities( $str ){
		$trans = get_html_translation_table(HTML_ENTITIES);
		return strtr($str, $trans);
	}
	
	
	public static function agregarDias( $date, $days=1, $format="Y-m-d" ){
		$yy = Utils::parseDate($date, "Y");
		$mm = Utils::parseDate($date, "m");	
		$dd = Utils::parseDate($date, "d");	
		
		return date( $format ,  mktime(0, 0, 0, $mm   , $dd + $days, $yy) );		
	} 
	
	/**
	from php.net
	give the number of days from a date
	*/
	static function diffTime($fecha, $ahora=""){		
		
		$opening = strtotime($fecha);		
		
		if(!$ahora){
			$now = time();
		}
		else{			
			$now = strtotime($ahora);
		}
				
		$second = $now-$opening;	
			
		$diff = Utils::getHumanTime( $second );
		return $diff;
	}
	
	
	/**
	* Convierte el numero de segundos en dias, horas, minutos y segundos
	*/
	static function getHumanTime( $second, $include_days = false ){		
				
		
		if( $second / (86400) >=0 ){						
			$vlr = "";
		}else{			
			$vlr = "-";			
		}
		
		$second = abs($second);
		
		if( $include_days ){
			$dias = floor($second / (86400));				
			$second = abs($second % 86400);
		}
		
		$horas = floor( $second/3600 );
		
		$second =  $second%3600;
		
		$minutos = floor( $second/60 );
				
		$diff=$vlr;
		
		if( $include_days && $dias ){
			$diff .= $dias." días ";
		}
		if( $horas ){	
			$diff.= $horas." horas ";
		}
		if( $minutos ){		
			$diff.= $minutos." min. ";
		}
		return $diff;
	}
	
	
	/*
	* Busca todos los dias festivos de un año en adelante
	* @author: Andres Botero
	*/	
	static function getFestivos( $aa=null ){	
		$c = new Criteria();
		if( $aa ){
			$c->add( FestivoPeer::CA_FCHFESTIVO, $aa."-01-01", Criteria::GRATER_EQUAL );
		}
		$festivos = FestivoPeer::doSelect( $c );
		$result = array();
		foreach( $festivos as $festivo ){
			$result[]=$festivo->getCaFchFestivo(); 
		}
		return $result;
		
		
	}
	
	
	/*
	* Retorna el tiempo en segundos entre dos fechas teniendo en cuenta las horas habiles( 8a5 sin festivos).
	* @author: Carlos Lopez
	*/	
	static function diffTimeWorkingHours($festiv, $inicio, $final){		
		
		$difer = 0;
		$sig = 1;
		if( $inicio>$final ){
			$tmp = $inicio;
			$inicio = $final;
			$final = $tmp;
			$sig = -1;
		}
		
		
		//echo "<br />--------------------------------------------------<br />";
		
		$start = strtotime($inicio);
		$final = strtotime($final);
		
		$difer = 0;
		$start = $inicio;
		
		
		
		while (date("Y-m-d H:i", $start) < date("Y-m-d H:i", $final)){
			
		   //echo "<br />".date("Y-m-d H:i", $start)." ".$difer;			
		   list($ano, $mes, $dia, $hor, $min, $seg) = sscanf(date("Y-m-d H:i:s", $start), "%d-%d-%d %d:%d:%d");	   
		   if (date("N", $start)> 5){                                    // Evalua si es un fin de semana		   	
			   $start = mktime(8,0,0,$mes,$dia+1,$ano);
			   continue;
		   }else if (in_array(date("Y-m-d", $start),$festiv)){           // Evalua si es un día festivo
			   $start = mktime(8,0,0,$mes,$dia+1,$ano);
			     
			   continue;
		   }else if ($start < mktime(8,0,0,$mes,$dia,$ano)){             // Evalua si es antes de las 8:00 am
			   $start = mktime(8,0,0,$mes,$dia,$ano);
			   continue;
		   }else if ($start > mktime(16,59,0,$mes,$dia,$ano)){            // Evalua si es después de las 5:00 pm
			   $start = mktime(8,0,0,$mes,$dia+1,$ano);
			   continue;
		   }else{
		 
			   $difer+=60;
			   $start+=60;
		   }
		// echo date("Y-m-d H:i:s", $start)." -> ".tiempo_segundos($difer)."<BR>";
		}
		return $sig*$difer;
	}
	
	
	/*
	* Retorna el timestamp añadiendo el numero de segundos a la fecha de inicio 
	* teniendo en cuenta las horas habiles( 8a5 sin festivos).
	* @author: Andres Botero
	*/	
	
	static function addTimeWorkingHours($festiv, $inicio, $segundos ){		
		
		$result = 0;			
		$start = strtotime($inicio);		
		$time = ($segundos/60)*60;
		$segundos = $segundos%60;
			
		while ( $time>0 ){
		   list($ano, $mes, $dia, $hor, $min, $seg) = sscanf(date("Y-m-d H:i:s", $start), "%d-%d-%d %d:%d:%d");	   
		   if (date("N", $start)> 5){                                    // Evalua si es un fin de semana		   	
			   $start = mktime(8,0,0,$mes,$dia+1,$ano);
			   continue;
		   }else if (in_array(date("Y-m-d", $start),$festiv)){           // Evalua si es un día festivo
			   $start = mktime(8,0,0,$mes,$dia+1,$ano);
			     
			   continue;
		   }else if ($start < mktime(8,0,0,$mes,$dia,$ano)){             // Evalua si es antes de las 8:00 am
			   $start = mktime(8,0,0,$mes,$dia,$ano);
			   continue;
		   }else if ($start > mktime(16,59,0,$mes,$dia,$ano)){            // Evalua si es después de las 5:00 pm
			   $start = mktime(8,0,0,$mes,$dia+1,$ano);
			   continue;
		   }else{
			   $start+=60;
		   }		   
		   $time -= 60;		   
		}
				
		$start+=$segundos;		
		return $start;
	}
	
	
	
	
	
	
	public static function getMonth( $m ){
		settype($m, "integer");
		switch($m) {
			case 1:
				return "Ene";
				break;
			case 2: 
				return "Feb";
				break;
			case 3:
				return "Mar";
				break;
			case 4:
				return "Abr";
				break;
			case 5:
				return "May";
				break;
			case 6:
				return "Jun";
				break;
			case 7:
				return "Jul";
				break;
			case 8:
				return "Ago";
				break;	
			case 9:
				return "Sep";
				break;
			case 10:
				return "Oct";
				break;
			case 11:
				return "Nov";
				break;
			case 12:
				return "Dic";
				break;			
			default:
				return"";
				break;
		}
	}
	
	public static function mesLargo( $m ){
		settype($m, "integer");
		switch($m) {
			case 1:
				return "Enero";
				break;
			case 2: 
				return "Febrero";
				break;
			case 3:
				return "Marzo";
				break;
			case 4:
				return "Abril";
				break;
			case 5:
				return "Mayo";
				break;
			case 6:
				return "Junio";
				break;
			case 7:
				return "Julio";
				break;
			case 8:
				return "Agosto";
				break;	
			case 9:
				return "Septiembre";
				break;
			case 10:
				return "Octubre";
				break;
			case 11:
				return "Noviembre";
				break;
			case 12:
				return "Diciembre";
				break;			
			default:
				return"";
				break;
		}
	}
	
	
	public static function extension($file){
		return strtolower( substr($file, strpos( $file,".") , strlen( $file)) );
	}
	
	public static function mimetype($name){
		switch(strtolower(substr($name,-3,3))){
			case "gif":
				return "image/gif";
				break;
			case "jpg":
				return "image/jpeg";
				break;
			case "jpeg":
					return "image/jpeg";
					break;
			 case "png":
					return "image/png";
					break;
			case "psd":
					return "image/psd";
					break;
			case "bmp":
					return "image/bmp";
					break;
			case "tiff":
					return "image/tiff";
					break;
			case "tif":
					return "image/tiff";
					break;
			case "rtf":
					return "text/rtf";
					break;
				case "htm":
					return "text/html";
					break;
			case "html":
					return "text/html";
					break;
			case "pdf":
					return "application/pdf";
					break;
			default:
					return "application/octet-stream";
					break;
		}
	}
	
	public static function sendEmail( $subject , $content, $from, $fromName , $recips, $cc=null){
		$smtp = new Swift_Connection_SMTP( sfConfig::get("app_smtp_host"), sfConfig::get("app_smtp_port") );
		$smtp->setUsername(sfConfig::get("app_smtp_user"));
		$smtp->setPassword(sfConfig::get("app_smtp_passwd"));
		
		$swift = new Swift( $smtp,  "[".sfConfig::get("app_smtp_public_ip")."]" );
		
		$mess = new Swift_Message( $subject );							
		
		//Add some "parts"  
		//Sending a multipart email decrease your spam score						
		$mess->attach( new Swift_Message_Part(  $content , "text/html") );
								
		//Recipients 
		$recipients = new Swift_RecipientList();	
		
		foreach( $recips as $key=>$recip ){	
																
			$recipients->addTo( $recip , $key ); 
		}
		
		// Todo log the message id and find in the SMTP log  
		$id = $mess->generateId();					
		$sender = new Swift_Address( $from, $fromName );					 
		if ($swift->send($mess,  $recipients , $sender ))
		{
			$error="";
		}
		else
		{
			$error="No se ha podido enviar el mensaje, por favor intentelo nuevamente";
		}	
		
		return $error;
					 
		//It's polite to do this when you're finished
		$swift->disconnect();
	}
	
	public static function addDays( $date, $days=1, $format="Y-m-d" ){
		$yy = Utils::parseDate($date, "Y");
		$mm = Utils::parseDate($date, "m");	
		$dd = Utils::parseDate($date, "d");	
		
		return date( $format ,  mktime(0, 0, 0, $mm   , $dd + $days, $yy) );		
	} 
}
?>