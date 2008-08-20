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
	static function numeroDeDias($fecha, $ahora=""){
		$day=substr($fecha,8,2);
		$month=substr($fecha,5,2);
		$year=substr($fecha,2,2);
		
		$opening = mktime(0, 0, 0, $month, $day, $year);
		
		
		if(!$ahora){
			$now = time();
		}
		else{
			$ahora = Utils::parseDate( $ahora, "Y-m-d" );
			$now=mktime (0,0,0,substr($ahora,5,2),substr($ahora,8,2),substr($ahora,0,4));		
		}
			
		$diff = ceil(($now-$opening ) / (86400));
		
		return $diff;
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