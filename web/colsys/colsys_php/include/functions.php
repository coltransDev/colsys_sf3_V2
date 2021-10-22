<?php
function vacios($var) {
    if (strlen (trim($var)) == 0) {
        return false;
    }else {
        return true;
    }
}

function formatNumber($number, $decimals=2, $dec_point=".", $thousands_sep=",") {
    $nachkomma = abs($number - floor($number));
    $strnachkomma = number_format($nachkomma , $decimals, $dec_point, $thousands_sep);

    for ($i = 1; $i <= $decimals; $i++) {
        if (substr($strnachkomma, ($i * -1), 1) != "0") {
            break;
        }
    }
    return number_format($number, ($decimals - $i +1), $dec_point, $thousands_sep);
}

function dateDiff($startDate, $endDate) {
    if (strlen($startDate) == 0 or strlen($endDate) == 0) { // Valida si Inicio o Final viene en Blanco
        return (null);  // Retorna un Null cuando no se puede calcular la diferencia.
    }
    // Parse dates for conversion
    $startArry = date_parse($startDate);
    $endArry = date_parse($endDate);

    // Convert dates to Julian Days
    $start_date = gregoriantojd($startArry["month"], $startArry["day"], $startArry["year"]);
    $end_date = gregoriantojd($endArry["month"], $endArry["day"], $endArry["year"]);

    // Return difference
    $difference = (round(($end_date-$start_date),0)==0)?1:round(($end_date-$start_date),0);
    return $difference;
} 

function workDiff(&$festiv, $startDate, $endDate) {
    
    if (strlen($startDate) == 0 or strlen($endDate) == 0) { // Valida si Inicio o Final viene en Blanco
        return (null);  // Retorna un Null cuando no se puede calcular la diferencia.
    }

    if ($startDate > $endDate) {        
        $fact = -1;
        $tempDate = $startDate;
        $startDate= $endDate;
        $endDate  = $tempDate;
    }else {
        $fact = 1;
    }

    // echo "$startDate -> $endDate <br />";
    $difference = 0;
    $start_Date = $startDate;

    // Parse dates for conversion
    $startArry = date_parse($start_Date);
    $endArry = date_parse($endDate);

    // Convert dates to TimeStamp
    $startDate = mktime(0,0,0,$startArry["month"], $startArry["day"], $startArry["year"]);
    $endDate = mktime(0,0,0,$endArry["month"], $endArry["day"], $endArry["year"]);
    
    if(date("N", $startDate)==6)
    {
        $startArry["day"]=$startArry["day"]+2;
        
        $startDate = mktime(0,0,0,$startArry["month"], $startArry["day"], $startArry["year"]);
    }
    else if(date("N", $startDate)==7)
    {
        $startArry["day"]=$startArry["day"]+1;
        $startDate = mktime(0,0,0,$startArry["month"], $startArry["day"], $startArry["year"]);
    }
    if(date("N", $endDate)==6)
    {
        $endArry["day"]=$endArry["day"]+2;
        $endDate = mktime(0,0,0,$endArry["month"], $endArry["day"], $endArry["year"]);
    }
    else if(date("N", $startDate)==7)
    {
        $endArry["day"]=$endArry["day"]+1;
        $endDate = mktime(0,0,0,$endArry["month"], $endArry["day"], $endArry["year"]);
    }
    while ($startDate < $endDate) {
    // Parse dates for conversion
        $startArry = date_parse($start_Date);

        // Convert dates to TimeStamp
        $startDate = mktime(0,0,0,$startArry["month"], $startArry["day"], $startArry["year"]);
        if (date("N", $startDate)<= 5 and !in_array(date("Y-m-d", $startDate),$festiv)) {		// Evalua si no es fin de semana ni festivo
            $difference+=1;
        }
        $startDate = mktime(0,0,0,$startArry["month"], $startArry["day"]+1, $startArry["year"]);
        $start_Date = date("Y-m-d", $startDate);
    }
    // echo "Diferencia ".$difference * $fact." <br /><br />";

    $difference = ($difference==0)?1:$difference;
    // Return difference
    return $difference * $fact;
}



function calc_dif(&$festiv, $inicio, $final, $entrada = "08:00:00", $salida = "17:00:00") {
    $difer = 0;
    $start = $inicio;
    list($hhe, $mme, $sse) = sscanf($entrada,"%d:%d:%d");
    list($hhs, $mms, $sss) = sscanf($salida, "%d:%d:%d");
    
    if ($inicio == mktime(0,0,0,11,30,1999) or $final == mktime(0,0,0,11,30,1999)) { // Valida si Inicio o Final viene en Blanco
        return (null);  // Retorna un Null cuando no se puede calcular la diferencia.
    }
    while (date("Y-m-d H:i", $start) < date("Y-m-d H:i", $final)) {     // Si festiv es NULL no descuenta Fines de Semana ni festivos
        list($ano, $mes, $dia, $hor, $min, $seg) = sscanf(date("Y-m-d H:i:s", $start), "%d-%d-%d %d:%d:%d");

        if (!is_null($festiv) and date("N", $start)> 5) {               // Evalua si es un fin de semana
            $start = mktime($hhe,$mme,$sse,$mes,$dia+1,$ano);
            continue;
        }else if (!is_null($festiv) and in_array(date("Y-m-d", $start),$festiv)) {  // Evalua si es un día festivo
            $start = mktime($hhe,$mme,$sse,$mes,$dia+1,$ano);
            continue;
        }else if (!is_null($festiv) and $start < mktime($hhe,$mme,$sse,$mes,$dia,$ano)) {             // Evalua si es antes de las 8:00 am
            $start = mktime($hhe,$mme,$sse,$mes,$dia,$ano);
            continue;
        }else if (!is_null($festiv) and $start >= mktime($hhs,$mms,$sss,$mes,$dia,$ano)) {            // Evalua si es después de las 5:00 pm
            $start = mktime($hhe,$mme,$sse,$mes,$dia+1,$ano);
            continue;
        }else if ((is_null($festiv) and date("Y-m-d H:i:s", $start+3600) < date("Y-m-d H:i:s", $final)) or (date("Y-m-d H:i:s", $start+3600) < date("Y-m-d H:i:s", $final) and date("Y-m-d H:i:s", $start+3600) <= date("Y-m-d H:i:s", mktime($hhs,$mms,$sss,$mes,$dia,$ano)))) {
            $difer+=3600;                                               // Evalua la posibilidad de incrementos de una hora sin sobrepasar las 5:00pm
            $start+=3600;
            continue;
        }else {
            $difer+=60;
            $start+=60;
        }
        // echo date("Y-m-d H:i:s", $start)." -> ".tiempo_segundos($difer)."<BR>";
    }
    // echo "------------- <br /><br />";
    return(tiempo_segundos($difer));
}


function tiempo_segundos($segundos) {
    $minutos=$segundos/60;
    $horas=floor($minutos/60);
    $minutos2=$minutos%60;
    $segundos2=$segundos%60%60%60;
    return substr(100+$horas,1,2).":".substr(100+$minutos2,1,2).":".substr(100+$segundos2,1,2);
}


function array_avg($array,$precision="2") {
    $a=0;
    if(is_array($array)) {
        foreach($array as $value):
            if(!is_numeric($value)) {
                $a++;
            }
        endforeach;
        if($a==0) {
            $cuantos=count($array);
            return round(array_sum($array)/$cuantos,$precision);
        }else {
            return "ERROR in function array_avg(): the array contains one or more non-numeric values";
        }
    }else {
        return "ERROR in function array_avg(): this is a not array";
    }
}

function hourTosec ($hms) {
        list($h, $m, $s) = explode (":", $hms);
        $seconds = 0;
        $seconds += (intval($h) * 3600);
        $seconds += (intval($m) * 60);
        $seconds += (intval($s));
        return $seconds;        
}
?>
