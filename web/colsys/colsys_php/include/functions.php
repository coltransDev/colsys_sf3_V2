<?php
function vacios($var) {
  if (strlen (trim($var)) == 0){
    return false;
  }else{
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

function dateDiff($startDate, $endDate)
{
	if (strlen($startDate) == 0 or strlen($endDate) == 0){
		return null;
	}
    // Parse dates for conversion
    $startArry = date_parse($startDate);
    $endArry = date_parse($endDate);

    // Convert dates to Julian Days
    $start_date = gregoriantojd($startArry["month"], $startArry["day"], $startArry["year"]);
    $end_date = gregoriantojd($endArry["month"], $endArry["day"], $endArry["year"]);

    // Return difference
    return round(($end_date - $start_date), 0);
} 


function calc_dif(&$festiv, $inicio, $final){
	$difer = 0;
    $start = $inicio;
    while (date("Y-m-d H:i", $start) < date("Y-m-d H:i", $final)){
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
    return(tiempo_segundos($difer));
}


function tiempo_segundos($segundos){
	$minutos=$segundos/60;
	$horas=floor($minutos/60);
	$minutos2=$minutos%60;
	$segundos2=$segundos%60%60%60;
	return substr(100+$horas,1,2).":".substr(100+$minutos2,1,2).":".substr(100+$segundos2,1,2);
}
?>
