<?
class TimeUtils{

	/*
	* Retorna la diferencia en d�as de dos fechas
	*/
	public static function dateDiff($startDate, $endDate) {
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

	/*
	* Retorna la diferencia en d�as laborales de dos fechas, excluyendo fines de
        * semana y festivos
	*/
        public static function workDiff(&$festiv, $startDate, $endDate) {
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


	/*
	* Retorna la diferencia en segundos entre dos fechas, horas h�biles excluyendo fines de
        * semana y festivos
	*/
    public static function calcDiff(&$festiv, $inicio, $final) {
        $difer = 0;
        
        if ($inicio > $final) {
            $fact = -1;
            $tempDate = $inicio;
            $inicio= $final;
            $final  = $tempDate;
        }else {
            $fact = 1;
        }

        $start = $inicio;
        if ($inicio == mktime(0,0,0,11,30,1999) or $final == mktime(0,0,0,11,30,1999)) { // Valida si Inicio o Final viene en Blanco
            return (null);  // Retorna un Null cuando no se puede calcular la diferencia.
        }

        while (date("Y-m-d H:i", $start) < date("Y-m-d H:i", $final)) {     // Si festiv es NULL no descuenta Fines de Semana ni festivos
            list($ano, $mes, $dia, $hor, $min, $seg) = sscanf(date("Y-m-d H:i:s", $start), "%d-%d-%d %d:%d:%d");            
            if (!is_null($festiv) and date("N", $start)> 5) {               // Evalua si es un fin de semana
                $start = mktime(8,0,0,$mes,$dia+1,$ano);
                continue;
            }else if (!is_null($festiv) and in_array(date("Y-m-d", $start),$festiv)) {  // Evalua si es un d�a festivo
                $start = mktime(8,0,0,$mes,$dia+1,$ano);
                continue;
            }else if (!is_null($festiv) and $start < mktime(8,0,0,$mes,$dia,$ano)) {             // Evalua si es antes de las 8:00 am
                $start = mktime(8,0,0,$mes,$dia,$ano);
                continue;
            }else if (!is_null($festiv) and $start > mktime(16,59,0,$mes,$dia,$ano)) {            // Evalua si es despu�s de las 5:00 pm
                $start = mktime(8,0,0,$mes,$dia+1,$ano);
                continue;
            }else if ((is_null($festiv) and date("Y-m-d H:i:s", $start+3600) < date("Y-m-d H:i:s", $final)) or (date("Y-m-d H:i:s", $start+3600) < date("Y-m-d H:i:s", $final) and date("Y-m-d H:i:s", $start+3600) <= date("Y-m-d H:i:s", mktime(17,0,0,$mes,$dia,$ano)))) {
                $difer+=3600;                                               // Evalua la posibilidad de incrementos de una hora sin sobrepasar las 5:00pm
                $start+=3600;
                continue;
            }else {
                $difer+=60;
                $start+=60;                
            }
            // echo date("Y-m-d H:i:s", $start)." -> ".tiempo_segundos($difer)."<BR>";
        }
         //echo "------------- $inicio $start $difer<br /><br />";
        return($difer*$fact);
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
			$diff .= $dias." d�as ";
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
	* Convierte y retorna segundos en horas:minutos:segundos
	*/
    public static function tiempoSegundos($segundos) {
        $minutos=$segundos/60;
        $horas=floor($minutos/60);
        $minutos2=$minutos%60;
        $segundos2=$segundos%60%60%60;
        if($horas<99){
            return substr(100+$horas,1,2).":".substr(100+$minutos2,1,2).":".substr(100+$segundos2,1,2);
        }else{
            return $horas.":".substr(100+$minutos2,1,2).":".substr(100+$segundos2,1,2);
        }
    }
    
    public static function calcularEdad($fecha_nacimiento,$fecha_actual) {
        
        $array_nacimiento = explode ( "-", $fecha_nacimiento );
        $array_actual = explode ( "-", $fecha_actual );

        $anos =  $array_actual[0] - $array_nacimiento[0]; // calculamos a�os
        $meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses
        $dias =  $array_actual[2] - $array_nacimiento[2]; // calculamos d�as

        //ajuste de posible negativo en $d�as
        if ($dias < 0)
        {
            --$meses;

            //ahora hay que sumar a $dias los dias que tiene el mes anterior de la fecha actual
            switch ($array_actual[1]) {
                   case 1:  $dias_mes_anterior=31; break;
                   case 2:  $dias_mes_anterior=31; break;
                   case 3:  $dias_mes_anterior=28; break;
                   case 4:  $dias_mes_anterior=31; break;
                   case 5:  $dias_mes_anterior=30; break;
                   case 6:  $dias_mes_anterior=31; break;
                   case 7:  $dias_mes_anterior=30; break;
                   case 8:  $dias_mes_anterior=31; break;
                   case 9:  $dias_mes_anterior=31; break;
                   case 10: $dias_mes_anterior=30; break;
                   case 11: $dias_mes_anterior=31; break;
                   case 12: $dias_mes_anterior=30; break;
            }

            $dias=$dias + $dias_mes_anterior;
        }

        //ajuste de posible negativo en $meses
        if ($meses < 0)
        {
            --$anos;
            $meses=$meses + 12;
        }

        if($anos==1){
            $edad = $anos.' a�o';
        }elseif($anos>=1){
            $edad = $anos.' a�os';
        }elseif($anos==0 && $meses==1){
            $edad = $meses.' mes';
        }elseif($anos==0 && $meses>1){
            $edad = $meses.' meses';
        }elseif($anos==0 && $meses==0){
            $edad = $dias.' d�as';
        }
        
        return $edad;
        
    }

    /*
	* Busca todos los dias festivos de un a�o en adelante
	* @author: Andres Botero
	*/
	static function getFestivos( $aa=null ){
        $q = Doctrine_Query::create()->from("Festivo f");

		if( $aa ){
            $q->where("f.ca_fchfestivo >= ?", $aa."-01-01" );
		}
		$festivos = $q->execute();
		$result = array();
		foreach( $festivos as $festivo ){
			$result[]=$festivo->getCaFchfestivo();
		}
		return $result;


	}



    /*
	* Retorna el timestamp a�adiendo el numero de segundos a la fecha de inicio
	* teniendo en cuenta las horas habiles( 8a5 sin festivos).
	* @author: Andres Botero
	*/
	static function addTimeWorkingHours($festiv, $inicio, $segundos ){

        $result = 0;
		$start = strtotime($inicio);
		//$time = ($segundos/60)*60;
        $time = $segundos;
		$segundos = $segundos%60;
        
		while ( $time>0 ){
           //echo "$ano, $mes, $dia, $hor, $min, $seg <br />";
		   list($ano, $mes, $dia, $hor, $min, $seg) = sscanf(date("Y-m-d H:i:s", $start), "%d-%d-%d %d:%d:%d");

            if (!is_null($festiv) and date("N", $start)> 5) {               // Evalua si es un fin de semana
                $start = mktime(8,0,0,$mes,$dia+1,$ano);
                continue;
            }else if (!is_null($festiv) and in_array(date("Y-m-d", $start),$festiv)) {  // Evalua si es un d�a festivo
                $start = mktime(8,0,0,$mes,$dia+1,$ano);
                continue;
            }else if (!is_null($festiv) and $start < mktime(8,0,0,$mes,$dia,$ano)) {             // Evalua si es antes de las 8:00 am
                $start = mktime(8,0,0,$mes,$dia,$ano);
                continue;
            }else if (!is_null($festiv) and $start > mktime(16,59,0,$mes,$dia,$ano)) {            // Evalua si es despu�s de las 5:00 pm
                $start = mktime(8,0,0,$mes,$dia+1,$ano);
                continue;
            }else {
                $start+=60;
                $time -= 60;
            }
		   
		}

		$start+=$segundos;
		return $start;
	}

    static function array_avg($array,$precision="2"){

        try
        {
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
        catch(Exception $e)
        {
            print_r($e);
        }
    }

}
?>
