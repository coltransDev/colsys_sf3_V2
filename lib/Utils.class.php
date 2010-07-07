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
        if( $fecha ){
            return date( $format ,strtotime( $fecha  ) );
        }
	}
	
	public static function transformDate( $fecha , $format="Y-m-d"){
		if ( !$fecha ){
			return "";
		}
		list( $year, $month, $day ) = sscanf($fecha, "%d-%d-%d");
		return date($format, mktime(0, 0, 0, $month, $day, $year));
	}
	
	public static function fechaMes($fecha){
        if( $fecha ){
            $timestamp = strtotime( $fecha  );
            $mes = date( "m" , $timestamp );

            $result = Utils::getMonth($mes)."-".date( "d" , $timestamp )."-".date( "Y" , $timestamp );

            if( date( "H:i:s" , $timestamp )!="00:00:00" ){
                $result.=" ".date( "h:i A" , $timestamp );
            }
            return $result;
        }
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
			
		$diff = TimeUtils::getHumanTime( $second );
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
	
	
	
	public static function addDays( $date, $days=1, $format="Y-m-d" ){
		$yy = Utils::parseDate($date, "Y");
		$mm = Utils::parseDate($date, "m");	
		$dd = Utils::parseDate($date, "d");	
		
		return date( $format ,  mktime(0, 0, 0, $mm   , $dd + $days, $yy) );		
	} 
	
	
	public static function writeLog($file, $event){
		
		$event.="\r\n-------------------------------------------------\r\n\r\n";			
		$fp = fopen ($file, 'a'); 			
		fwrite($fp, $event );			
		fclose ($fp); 	
	}

    function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
          $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
          $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}
?>