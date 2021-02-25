<?php

class Utils {
    /*
     * Busca en un string el tag inicial y el tag final devuelve la informacion de en medio, 
     * esta funcion es usada para capturar datos de algunas paginas
     */

    public static function getInformation($string, $initialTag, $finalTag, $removeWhiteSpaces = true) {
        if ($removeWhiteSpaces) {
            $string = str_replace(" ", "", $string);
        }
        $string = str_replace("\n", "", $string);
        $string = str_replace("\r", "", $string);
        $string = str_replace("\t", "", $string);

        if ($removeWhiteSpaces) {
            $initialTag = str_replace(" ", "", $initialTag);
        }
        $initialTag = str_replace("\n", "", $initialTag);
        $initialTag = str_replace("\r", "", $initialTag);
        $initialTag = str_replace("\t", "", $initialTag);
        //echo "<br>".$string."<br>";
        //echo "<br>".$initialTag."<br>";

        $tmp1 = strpos($string, $initialTag);

        if ($tmp1 === false) {
            return false;
        }

        $k1 = $tmp1 + strlen($initialTag);

        $string = substr($string, $k1, 1500);
        //echo $string;
        $k2 = strpos($string, $finalTag);

        return substr($string, 0, $k2);
    }

    static function formatNumber($number, $decimals = 2, $dec_point = ".", $thousands_sep = ",") {
        $number = floatval($number);
        $nachkomma = abs($number - floor($number));
        $strnachkomma = number_format($nachkomma, $decimals, $dec_point, $thousands_sep);

        for ($i = 1; $i <= $decimals; $i++) {
            if (substr($strnachkomma, ($i * -1), 1) != "0") {
                break;
            }
        }

        return number_format($number, ($decimals - $i + 1), $dec_point, $thousands_sep);
    }

    public static function parseDate($fecha, $format = "Y-m-d") {
        if ($fecha) {
            return date($format, strtotime($fecha));
        }
    }

    public static function transformDate($fecha, $format = "Y-m-d") {
        if (!$fecha) {
            return "";
        }
        list( $year, $month, $day ) = sscanf($fecha, "%d-%d-%d");
        return date($format, mktime(0, 0, 0, $month, $day, $year));
    }

    public static function transformDate1($fecha,$tipo=0) {
        if (!$fecha) {
            return "";
        }
        if($tipo==0)
            list( $day, $month, $year ) = split("/", $fecha);
        else if($tipo==1)
            list( $month,$day, $year ) = split("/", $fecha);
        return "$year-$month-$day";
    }

    public static function fechaMes($fecha) {
        if ($fecha) {
            $timestamp = strtotime($fecha);
            $mes = date("m", $timestamp);

            $result = Utils::getMonth($mes) . "-" . date("d", $timestamp) . "-" . date("Y", $timestamp);

            if (date("H:i:s", $timestamp) != "00:00:00") {
                $result.=" " . date("h:i A", $timestamp);
            }
            return $result;
        }
    }

    public static function fechaLarga($fecha) {
        $newfecha = Utils::parseDate($fecha);
        $mes = substr($newfecha, 5, 2);
        return substr($newfecha, 8, 2) . " de " . Utils::mesLargo($mes) . " de " . substr($newfecha, 0, 4);
    }

    public static function compararFechas($fecha1, $fecha2) {
        $time1 = strtotime($fecha1);
        $time2 = strtotime($fecha2);

        if ($time1 > $time2) {
            return 1;
        }

        if ($time1 < $time2) {
            return -1;
        }

        if ($time1 == $time2) {
            return 0;
        }
    }

    public static function replace($text) {
        $trans = get_html_translation_table(HTML_ENTITIES);
        return str_replace("\n", "<br />", strtr($text, $trans));
    }

    public static function html_entities($str) {
        $trans = get_html_translation_table(HTML_ENTITIES);
        return strtr($str, $trans);
    }

    public static function agregarDias($date, $days = 1, $format = "Y-m-d") {
        $yy = Utils::parseDate($date, "Y");
        $mm = Utils::parseDate($date, "m");
        $dd = Utils::parseDate($date, "d");

        return date($format, mktime(0, 0, 0, $mm, $dd + $days, $yy));
    }

    /**
      from php.net
      give the number of days from a date
     */
    static function diffTime($fecha, $ahora = "") {

        $opening = strtotime($fecha);

        if (!$ahora) {
            $now = time();
        } else {
            $now = strtotime($ahora);
        }

        $second = $now - $opening;

        $diff = TimeUtils::getHumanTime($second);
        return $diff;
    }

    /**
      from php.net
      give the number of days between two dates
     */
    static function diffDays($date1, $date2) {

        if (!is_integer($date1))
            $date1 = strtotime($date1);

        if (!is_integer($date2))
            $date2 = strtotime($date2);

        return floor(abs($date1 - $date2) / 60 / 60 / 24);
    }

    public static function getMonth($m) {
        settype($m, "integer");
        switch ($m) {
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

    public static function mesLargo($m, $literal = false) {
        settype($m, "integer");
        if ($literal) { // Se usa para efectos de ordenamiento alfabetico de los meses
            $lit = array("", "a) ", "b) ", "c) ", "d) ", "e) ", "f) ", "g) ", "h) ", "i) ", "j) ", "k) ", "l) ");
        } else {
            $lit = array(null, null, null, null, null, null, null, null, null, null, null, null, null);
        }
        switch ($m) {
            case 1:
                return $lit[$m]."Enero";
                break;
            case 2:
                return $lit[$m]."Febrero";
                break;
            case 3:
                return $lit[$m]."Marzo";
                break;
            case 4:
                return $lit[$m]."Abril";
                break;
            case 5:
                return $lit[$m]."Mayo";
                break;
            case 6:
                return $lit[$m]."Junio";
                break;
            case 7:
                return $lit[$m]."Julio";
                break;
            case 8:
                return $lit[$m]."Agosto";
                break;
            case 9:
                return $lit[$m]."Septiembre";
                break;
            case 10:
                return $lit[$m]."Octubre";
                break;
            case 11:
                return $lit[$m]."Noviembre";
                break;
            case 12:
                return $lit[$m]."Diciembre";
                break;
            default:
                return"";
                break;
        }
    }

    public static function nmes($m) {
        //settype($m, "integer");
        switch ($m) {
            case "Enero":
                return 1;
                break;
            case "Febrero":
                return 2;
                break;
            case "Marzo":
                return 3;
                break;
            case "Abril":
                return 4;
                break;
            case "Mayo":
                return 5;
                break;
            case "Junio":
                return 6;
                break;
            case "Julio":
                return 7;
                break;
            case "Agosto":
                return 8;
                break;
            case "Septiembre":
                return 9;
                break;
            case "Octubre":
                return 10;
                break;
            case "Noviembre":
                return 11;
                break;
            case "Diciembre":
                return 12;
                break;
            default:
                return 0;
                break;
        }
    }

    public static function extension($file) {
        $tmp = explode(".", $file);
        return $tmp[count($tmp) - 1];
    }

    public static function mimetype($name) {
        switch (strtolower(Utils::extension($name))) {
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
            case "csv":
                return "text/csv";
                break;
            case "txt":
                return "text/plain";
                break;
            case "eml":
                return "message/rfc822";
                break;
            default:
                return "application/octet-stream";
                break;
        }
    }

    public static function isImage($name) {
        $type = Utils::mimetype($name);

        switch ($type) {
            case "image/jpeg":
            case "image/gif":
            case "image/png":
                $im = true;
                break;
            default:
                $im = false;
                break;
        }
        return $im;
    }

    public static function addDays($date, $days = 1, $format = "Y-m-d") {
        $yy = Utils::parseDate($date, "Y");
        $mm = Utils::parseDate($date, "m");
        $dd = Utils::parseDate($date, "d");

        return date($format, mktime(0, 0, 0, $mm, $dd + $days, $yy));
    }

    public static function addDate($date, $days = 0, $month = 0, $year = 0, $format = "Y-m-d") {
        $yy = Utils::parseDate($date, "Y");
        $mm = Utils::parseDate($date, "m");
        $dd = Utils::parseDate($date, "d");

        return date($format, mktime(0, 0, 0, $mm + $month, $dd + $days, $yy + $year));
    }

    public static function writeLog($file, $event) {

        $event.="\r\n-------------------------------------------------\r\n\r\n";
        $fp = fopen($file, 'a');
        fwrite($fp, $event);
        fclose($fp);
    }

    public static function getRealIpAddr() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    static public function slugify($text) {
        // replace non letter or digits by -
        $text = preg_replace('#[^\\pL\d]+#u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        if (function_exists('iconv')) {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('#[^-\w]+#', '', $text);

        if (empty($text)) {
            return 'n-a';
        }

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
    public static function LDAPNetAddr($networkaddress) {

        $addr = "";

        $addrtype = intval(substr($networkaddress, 0, 1));

        $networkaddress = substr($networkaddress, 2); // throw away bytes 0 and 1 which should be the addrtype and the "" separator



        if (($addrtype == 8) || ($addrtype = 9)) {

            // TODO 1.6: If UDP or TCP, (TODO fill addrport and) strip portnumber information from address

            $networkaddress = substr($networkaddress, (strlen($networkaddress) - 4));
        }



        $addrtypes = array(
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

        if ($len > 0) {

            for ($i = 0; $i < $len; $i += 1) {

                $byte = substr($networkaddress, $i, 1);

                $addr .= ord($byte);

                if (($addrtype == 1) || ($addrtype == 8) || ($addrtype = 9)) { // dot separate IP addresses...
                    $addr .= ".";
                }
            }

            if (($addrtype == 1) || ($addrtype == 8) || ($addrtype = 9)) { // strip last period from end of $addr
                $addr = substr($addr, 0, strlen($addr) - 1);
            }
        } else {

            $addr .= "address not available.";
        }

        return Array('protocol' => $addrtypes[$addrtype], 'address' => $addr);
    }

    public static function ldap_escape($str, $for_dn = false) {

        // see:
        // RFC2254
        // http://msdn.microsoft.com/en-us/library/ms675768(VS.85).aspx
        // http://www-03.ibm.com/systems/i/software/ldap/underdn.html

        if ($for_dn)
            $metaChars = array(',', '=', '+', '<', '>', ';', '\\', '"', '#');
        else
            $metaChars = array('*', '(', ')', '\\', chr(0));

        $quotedMetaChars = array();
        foreach ($metaChars as $key => $value)
            $quotedMetaChars[$key] = '\\' . str_pad(dechex(ord($value)), 2, '0');
        $str = str_replace($metaChars, $quotedMetaChars, $str); //replace them
        return ($str);
    }

    public static function deleteCache() {
        error_reporting(E_ALL);
        $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . "cache" . DIRECTORY_SEPARATOR;
        $archivos = sfFinder::type('file')->maxDepth(0)->in($directory);
        foreach ($archivos as $archivo) {
            unlink($archivo);
        }
    }

    public static function sendEmail($data = array()) {
        $mail = new Email();
        $usuenvio = (isset($data["usuenvio"])) ? $data["usuenvio"] : "Administrador";
        $mail->setCaUsuenvio($usuenvio);
        $tipo = (isset($data["tipo"])) ? $data["tipo"] : "Error";
        $mail->setCaTipo($tipo); //Envío de Avisos
        $idcaso = (isset($data["idcaso"])) ? $data["idcaso"] : null;
        $mail->setCaIdcaso($idcaso);

        $from = (isset($data["from"])) ? $data["from"] : "nagios@correo.colsys.coltrans.com.co";
        $mail->setCaFrom($from);
        $fromname = (isset($data["fromname"])) ? $data["fromname"] : "Nagios";
        $mail->setCaFromname($fromname);
        $to = (isset($data["to"])) ? $data["to"] : "admin@coltrans.com.co";
        $arrayTo = explode(",", $to);
        foreach ($arrayTo as $t)
            $mail->addTo($t);
        $subject = (isset($data["subject"])) ? $data["subject"] : "Email No enviado";
        $mail->setCaSubject($subject);
        $body = (isset($data["body"])) ? $data["body"] : "Email No enviado";
        $mail->setCaBody($body);
        $mensaje = (isset($data["mensaje"])) ? $data["mensaje"] : "Email No enviado";
        //$mensaje = "Id Email: ".$email->getCaIdemail() . "<br />".$e->getMessage(). "<br />".$e->getTraceAsString();
        $mail->setCaBodyhtml($mensaje);
        $mail->save();
    }

    public static function serializeArray($data = array()) {

        $tmp = serialize($data); //Serializar el arreglo.
        $tmp = urlencode($tmp);
        return $tmp;
    }

    public static function unSerializeArray($serie) {

        $tmp = stripslashes($serie);
        $tmp = unserialize(urldecode($tmp));
        return $tmp;
    }

    public static function calcularDV($nit) {
        if (!is_numeric($nit)) {
            return false;
        }

        $arr = array(1 => 3, 4 => 17, 7 => 29, 10 => 43, 13 => 59, 2 => 7, 5 => 19,
            8 => 37, 11 => 47, 14 => 67, 3 => 13, 6 => 23, 9 => 41, 12 => 53, 15 => 71);
        $x = 0;
        $y = 0;
        $z = strlen($nit);
        $dv = '';

        for ($i = 0; $i < $z; $i++) {
            $y = substr($nit, $i, 1);
            $x += ($y * $arr[$z - $i]);
        }

        $y = $x % 11;

        if ($y > 1) {
            $dv = 11 - $y;
            return $dv;
        } else {
            $dv = $y;
            return $dv;
        }
    }

    public static function get_decorated_diff($old, $new) {
        $from_start = strspn($old ^ $new, "\0");
        $from_end = strspn(strrev($old) ^ strrev($new), "\0");

        $old_end = strlen($old) - $from_end;
        $new_end = strlen($new) - $from_end;

        $start = substr($new, 0, $from_start);
        $end = substr($new, $new_end);
        $new_diff = substr($new, $from_start, $new_end - $from_start);
        $old_diff = substr($old, $from_start, $old_end - $from_start);

        $new = "$start<ins style='background-color:#ccffcc'>$new_diff</ins>$end";
        $old = "$start<del style='background-color:#ffcccc'>$old_diff</del>$end";
        return array("old" => $old, "new" => $new);
    }

    public static function spreadsheet_cols($cols) {
        $x = 0;
        $y = -1;
        $letters = array();
        for ($i = 1; $i <= $cols; $i++) {
            if ($x > 25) {
                $x = 0;
                $y++;
            }
            $letter = (($y >= 0) ? chr(65 + $y) : "") . chr(65 + $x);
            $letters[] = $letter;
            $x++;
        }
        return $letters;
    }

    public static function camposArchivoPlanoHeinsohn() {
        $campos = array();
        
        $campos[] = "Tipo Registro";
        $campos[] = "Tipo de documento de identificación empleado";
        $campos[] = "Número de documento de identificación empleado";
        $campos[] = "Concepto";
        $campos[] = "Tipo de novedad";
        $campos[] = "Tipo de reporte";
        $campos[] = "Valor/Total horas total dias";
        $campos[] = "Incluye en pago";
        $campos[] = "Suma o resta";
        $campos[] = "Fecha inicial";
        $campos[] = "Cantidad de días";
        $campos[] = "Tipo incapacidad";
        $campos[] = "Diagnostico";
        $campos[] = "Numero incapacidad";
        $campos[] = "Fecha de retiro";
        $campos[] = "Motivo de retiro";
        $campos[] = "Área Funcional";
        $campos[] = "Rango día inicial";
        $campos[] = "Rango hora inicial";
        $campos[] = "Rango hora final";
        $campos[] = "Número días";
        $campos[] = "Número unidades";
        $campos[] = "Número horas";
        $campos[] = "Indemnizacion";
        $campos[] = "Fecha novedad";
        $campos[] = "Pago Total";
        $campos[] = "Naturaleza Incapacidad";
        $campos[] = "Fecha Inicial EPS";
        $campos[] = "Proyecto";
        $campos[] = "";
        $campos[] = "Fecha Retiro Actual";

        return $campos;
    }

    public static function validacionBinaria($acceso_usuario, $acceso_total) {
        return str_pad( decbin($acceso_usuario) & decbin($acceso_total), 30, "0", STR_PAD_LEFT);
    }
    
    public static function buildColumns($column_name) {
        switch ($column_name) {
            case "Año":
                return array("text" => utf8_encode("Año"), "sql" => "'20'||right(mst.ca_referencia, 2) AS numeric", "alias" => "mst_annio", "type" => "integer", "leaf" => true, "default" => true, "groupBy" => true, "iconCls" => 'no-icon');
                break;
            case "Mes":
                return array("text" => utf8_encode("Mes"), "sql" => "substr(mst.ca_referencia, 8, 2)", "alias" => "mst_mes", "type" => "string", "leaf" => true, "default" => true, "groupBy" => true, "iconCls" => 'no-icon');
                break;
            case "Referencia":
                return array("text" => utf8_encode("Referencia"), "sql" => "mst.ca_referencia", "alias" => "mst_ca_referencia", "type" => "string", "leaf" => true, "default" => true, "groupBy" => false, "iconCls" => 'no-icon');
                break;
            case "Tráfico Org.":
                return array("text" => utf8_encode("Tráfico Org."), "sql" => "org.ca_idtrafico", "alias" => "trg_ca_nombre", "type" => "string", "leaf" => true, "default" => true, "groupBy" => true, "iconCls" => 'no-icon');
                break;
            case "Puerto Org.":
                return array("text" => utf8_encode("Puerto Org."), "sql" => "mst.ca_origen", "alias" => "org_ca_ciudad", "type" => "string", "leaf" => true, "default" => false, "groupBy" => true, "iconCls" => 'no-icon');
                break;
            case "Tráfico Dst.":
                return array("text" => utf8_encode("Tráfico Dst."), "sql" => "dst.ca_idtrafico", "alias" => "tds_ca_nombre", "type" => "string", "leaf" => true, "default" => false, "groupBy" => false, "iconCls" => 'no-icon');
                break;
            case "Puerto Dst.":
                return array("text" => utf8_encode("Puerto Dst."), "sql" => "mst.ca_destino", "alias" => "dst_ca_ciudad", "type" => "string", "leaf" => true, "default" => true, "groupBy" => true, "iconCls" => 'no-icon');
                break;
            case "Agente":
                return array("text" => utf8_encode("Agente"), "sql" => "agt.ca_nombre", "alias" => "agt_ca_nombre", "type" => "string", "leaf" => true, "default" => false, "groupBy" => true, "iconCls" => 'no-icon');
                break;
            case "Impo/Expo":
                return array("text" => utf8_encode("Impo/Expo"), "sql" => "mst.ca_impoexpo", "alias" => "mst_ca_impoexpo", "type" => "string", "leaf" => true, "default" => true, "groupBy" => true, "iconCls" => 'no-icon');
                break;
            case "Transporte":
                return array("text" => utf8_encode("Transporte"), "sql" => "mst.ca_transporte", "alias" => "mst_ca_transporte", "type" => "string", "leaf" => true, "default" => true, "groupBy" => true, "iconCls" => 'no-icon');
                break;
            case "Modalidad":
                return array("text" => utf8_encode("Modalidad"), "sql" => "mst.ca_modalidad", "alias" => "mst_ca_modalidad", "type" => "string", "leaf" => true, "default" => true, "groupBy" => true, "iconCls" => 'no-icon');
                break;
            case "Transportista":
                return array("text" => utf8_encode("Transportista"), "sql" => "prv.ca_nombre", "alias" => "prv_ca_nombre", "type" => "string", "leaf" => true, "default" => false, "groupBy" => true, "iconCls" => 'no-icon');
                break;
            case "Cliente":
                return array("text" => utf8_encode("Cliente"), "sql" => "cli.ca_compania", "alias" => "cli_ca_compania", "type" => "string", "leaf" => true, "default" => false, "groupBy" => true, "iconCls" => 'no-icon');
                break;
            case "Circular0170":
                return array("text" => utf8_encode("Circular0170"), "sql" => "cli.ca_stdcircular", "type" => "string", "alias" => "cli_ca_stdcircular", "leaf" => true, "default" => false, "groupBy" => false, "iconCls" => 'no-icon');
                break;
            case "House":
                return array("text" => utf8_encode("House"), "sql" => "hst.ca_doctransporte", "type" => "string", "alias" => "hst_ca_doctransporte", "leaf" => true, "default" => true, "groupBy" => false, "iconCls" => 'no-icon');
                break;
            case "DTM Colotm":
                return array("text" => utf8_encode("DTM Colotm"), "sql" => "rot.ca_consecutivo", "type" => "string", "alias" => "rot_ca_consecutivo", "leaf" => true, "default" => false, "groupBy" => false, "iconCls" => 'no-icon');
                break;
            case "Importador Colotm":
                return array("text" => utf8_encode("Importador Colotm"), "sql" => "imp.ca_nombre", "type" => "string", "alias" => "imp_ca_nombre", "leaf" => true, "default" => false, "groupBy" => false, "iconCls" => 'no-icon');
                break;
            case "Vehiculo Colotm":
                return array("text" => utf8_encode("Vehiculo Colotm"), "sql" => "", "type" => "string", "alias" => "mst_ca_vehiculo", "leaf" => true, "default" => false, "groupBy" => false, "iconCls" => 'no-icon');
                break;
            case "Ingresos":
                return array("text" => utf8_encode("Ingresos"), "sql" => "", "alias" => "hst_ca_ingresos", "type" => "float", "leaf" => true, "default" => true, "groupBy" => false, "iconCls" => 'no-icon');
                break;
            case "Costos":
                return array("text" => utf8_encode("Costos"), "sql" => "", "alias" => "hst_ca_costos", "type" => "float", "leaf" => true, "default" => true, "groupBy" => false, "iconCls" => 'no-icon');
                break;
            case "Deducciones":
                return array("text" => utf8_encode("Deducciones"), "sql" => "", "type" => "float", "alias" => "hst_ca_deducciones", "leaf" => true, "default" => true, "groupBy" => false, "iconCls" => 'no-icon');
                break;
            case "Ino":
                return array("text" => utf8_encode("Ino"), "sql" => "", "type" => "float", "alias" => "hst_ca_utilidad", "leaf" => true, "default" => true, "groupBy" => false, "iconCls" => 'no-icon');
                break;
            case "Datos/Carga":
                return array("text" => utf8_encode("Datos/Carga"), "sql" => "", "type" => "string", "alias" => "datos_carga", "leaf" => true, "default" => false, "groupBy" => false, "iconCls" => 'no-icon');
                break;
            case "Incoterm":
                return array("text" => utf8_encode("Incoterm"), "sql" => "hst.ca_idreporte", "type" => "string", "type" => "string", "type" => "string", "alias" => "rpn_ca_incoterms", "leaf" => true, "default" => false, "groupBy" => false, "iconCls" => 'no-icon');
                break;
            case "Vendedor":
                return array("text" => utf8_encode("Vendedor"), "sql" => "usr.ca_nombre", "type" => "string", "alias" => "usr_ca_nombre", "leaf" => true, "default" => true, "groupBy" => true, "iconCls" => 'no-icon');
                break;
            case "Sucursal":
                return array("text" => utf8_encode("Sucursal"), "sql" => "suc.ca_nombre", "type" => "string", "alias" => "suc_ca_nombre", "leaf" => true, "default" => true, "groupBy" => true, "iconCls" => 'no-icon');
                break;
            case "Estado":
                return array("text" => utf8_encode("Estado"), "sql" => "", "type" => "string", "alias" => "mst_ca_estado", "leaf" => true, "default" => true, "groupBy" => true, "iconCls" => 'no-icon');
                break;
            case "Compra/Venta":
                return array("text" => utf8_encode("Compra/Venta"), "sql" => "", "type" => "string", "alias" => "mst_ca_comven", "leaf" => true, "default" => true, "groupBy" => true, "iconCls" => 'no-icon');
                break;
            case "Fch.Cerrado":
                return array("text" => utf8_encode("Fch.Cerrado"), "sql" => "mst.ca_fchcerrado", "type" => "string", "alias" => "mst_ca_fchcerrado", "leaf" => true, "default" => true, "groupBy" => true, "iconCls" => 'no-icon');
                break;
            case "Idmaster":
                return array("text" => utf8_encode("Idmaster"), "sql" => "mst.ca_idmaster", "type" => "integer", "alias" => "mst_ca_idmaster", "leaf" => true, "default" => false, "groupBy" => false, "iconCls" => 'no-icon');
                break;
            case "Idhouse":
                return array("text" => utf8_encode("Idhouse"), "sql" => "hst.ca_idhouse", "type" => "integer", "alias" => "hst_ca_idhouse", "leaf" => true, "default" => false, "groupBy" => false, "iconCls" => 'no-icon');
                break;
        }
    }

    public static function formatHtml($textHtml) {
        $a = htmlentities($textHtml);
        $b = html_entity_decode($a);                
        $html = str_replace('color="FF0000"', 'color="#ff0000"', $b);
        $html = str_replace('</div>', '<br/>', $html);
        $html = str_replace('</span>', '<br/>', $html);
        $html = utf8_decode(strip_tags($html,"<font><br>")); 
        
        return $html;        
    }
    
    /* Función que elimina las tildes y los acentos
     * @params
     * $cadena: Se debe pasar la cadena sin codificaciones
     */
    public static function eliminarTildes($cadena){
     
        $cadena = str_replace(
            array('á', '?', 'ä', 'â', '?', 'Á', '?', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $cadena
        );
        
        $cadena = str_replace(
            array('é', '?', 'ë', '?', 'É', '?', '?', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $cadena );
        
        $cadena = str_replace(
            array('í', '?', '?', 'î', 'Í', '?', '?', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $cadena );
        
        $cadena = str_replace(
            array('ó', '?', 'ö', 'ô', 'Ó', '?', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $cadena );
        
        $cadena = str_replace(
            array('ú', '?', 'ü', '?', 'Ú', '?', '?', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $cadena );
        
        $cadena = str_replace(
            array('?', '?', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C'),
            utf8_decode($cadena));

        return $cadena;
    }
}
?>
