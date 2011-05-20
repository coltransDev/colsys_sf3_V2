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
       $number = floatval( $number );
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
                        case "xls":
					return "application/vnd.ms-excel";
					break;
                        case "zip":
					return "application/zip";
					break;
                        case "doc":
                        case "docx":
					return "application/msword";
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
    
    public static function addDate( $date, $days=0,$month=0,$year=0, $format="Y-m-d" ){
		$yy = Utils::parseDate($date, "Y");
		$mm = Utils::parseDate($date, "m");	
		$dd = Utils::parseDate($date, "d");	
		
		return date( $format ,  mktime(0, 0, 0, $mm+$month   , $dd + $days, $yy+$year) );
	} 
	
	
	public static function writeLog($file, $event){
		
		$event.="\r\n-------------------------------------------------\r\n\r\n";			
		$fp = fopen ($file, 'a'); 			
		fwrite($fp, $event );			
		fclose ($fp); 	
	}

    public static function getRealIpAddr()
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

    static public function slugify($text){
        // replace all non letters or digits by -
        $text = preg_replace('/\W+/', '-', $text);

        // trim and lowercase
        $text = strtolower(trim($text, '-'));

        return $text;
    }

    /**

     * extract readable network address from the LDAP encoded networkAddress attribute.

     * @author Jay Burrell, Systems & Networks, Mississippi State University

     *  Please keep this document block and author attribution in place.

     *

     *   Novell Docs, see: http://developer.novell.com/ndk/doc/ndslib/schm_enu/data/sdk5624.htmlsdk5624

     *   for Address types: http://developer.novell.com/ndk/doc/ndslib/index.html?page=/ndk/doc/ndslib/schm_enu/data/sdk4170.html

     *   LDAP Format, String:

     *      taggedData = uint32String "" octetstring

     *      byte 0 = uint32String = Address Type: 0= IPX Address; 1 = IP Address

     *      byte 1 = char = "" - separator

     *      byte 2+ = octetstring - the ordinal value of the address

     *    Note: with eDirectory 8.6.2, the IP address (type 1) returns

     *                  correctly, however, an IPX address does not seem to.  eDir 8.7 may correct this.

     *   Enhancement made by Merijn van de Schoot:

     *      If addresstype is 8 (UDP) or 9 (TCP) do some additional parsing like still returning the IP address

     */

    public static function  LDAPNetAddr($networkaddress)

    {

        $addr = "";

        $addrtype = intval(substr($networkaddress, 0, 1));

        $networkaddress = substr($networkaddress, 2); // throw away bytes 0 and 1 which should be the addrtype and the "" separator



        if (($addrtype == 8) || ($addrtype = 9)) {

            // TODO 1.6: If UDP or TCP, (TODO fill addrport and) strip portnumber information from address

            $networkaddress = substr($networkaddress, (strlen($networkaddress)-4));

        }



        $addrtypes = array (

            'IPX',

            'IP',

            'SDLC',

            'Token Ring',

            'OSI',

            'AppleTalk',

            'NetBEUI',

            'Socket',

            'UDP',

            'TCP',

            'UDP6',

            'TCP6',

            'Reserved (12)',

            'URL',

            'Count'

        );

        $len = strlen($networkaddress);

        if ($len > 0)

        {

            for ($i = 0; $i < $len; $i += 1)

            {

                $byte = substr($networkaddress, $i, 1);

                $addr .= ord($byte);

                if ( ($addrtype == 1) || ($addrtype == 8) || ($addrtype = 9) ) { // dot separate IP addresses...

                    $addr .= ".";

                }

            }

            if ( ($addrtype == 1) || ($addrtype == 8) || ($addrtype = 9) ) { // strip last period from end of $addr

                $addr = substr($addr, 0, strlen($addr) - 1);

            }

        } else {

            $addr .= "address not available.";

        }

        return Array('protocol'=>$addrtypes[$addrtype], 'address'=>$addr);

    }


    public static function ldap_escape($str, $for_dn = false)
    {

        // see:
        // RFC2254
        // http://msdn.microsoft.com/en-us/library/ms675768(VS.85).aspx
        // http://www-03.ibm.com/systems/i/software/ldap/underdn.html

        if  ($for_dn)
            $metaChars = array(',','=', '+', '<','>',';', '\\', '"', '#');
        else
            $metaChars = array('*', '(', ')', '\\', chr(0));

        $quotedMetaChars = array();
        foreach ($metaChars as $key => $value) $quotedMetaChars[$key] = '\\'.str_pad(dechex(ord($value)), 2, '0');
        $str=str_replace($metaChars,$quotedMetaChars,$str); //replace them
        return ($str);
    }
}
?>
