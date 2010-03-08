<?
class TimeUtils{

	/*
	* Retorna la diferencia en días de dos fechas
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
	* Retorna la diferencia en días laborales de dos fechas, excluyendo fines de
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
	* Retorna la diferencia en segundos entre dos fechas, horas hábiles excluyendo fines de
        * semana y festivos
	*/
        public static function calcDiff(&$festiv, $inicio, $final) {
            $difer = 0;
            $start = $inicio;
            if ($inicio == mktime(0,0,0,11,30,1999) or $final == mktime(0,0,0,11,30,1999)) { // Valida si Inicio o Final viene en Blanco
                return (null);  // Retorna un Null cuando no se puede calcular la diferencia.
            }
            while (date("Y-m-d H:i", $start) < date("Y-m-d H:i", $final)) {     // Si festiv es NULL no descuenta Fines de Semana ni festivos
                list($ano, $mes, $dia, $hor, $min, $seg) = sscanf(date("Y-m-d H:i:s", $start), "%d-%d-%d %d:%d:%d");

                if (!is_null($festiv) and date("N", $start)> 5) {               // Evalua si es un fin de semana
                    $start = mktime(8,0,0,$mes,$dia+1,$ano);
                    continue;
                }else if (!is_null($festiv) and in_array(date("Y-m-d", $start),$festiv)) {  // Evalua si es un día festivo
                    $start = mktime(8,0,0,$mes,$dia+1,$ano);
                    continue;
                }else if (!is_null($festiv) and $start < mktime(8,0,0,$mes,$dia,$ano)) {             // Evalua si es antes de las 8:00 am
                    $start = mktime(8,0,0,$mes,$dia,$ano);
                    continue;
                }else if (!is_null($festiv) and $start > mktime(16,59,0,$mes,$dia,$ano)) {            // Evalua si es después de las 5:00 pm
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
            // echo "------------- <br /><br />";            
            return($difer);
        }


	/*
	* Convierte y retorna segundos en horas:minutos:segundos
	*/
    public static function tiempoSegundos($segundos) {
        $minutos=$segundos/60;
        $horas=floor($minutos/60);
        $minutos2=$minutos%60;
        $segundos2=$segundos%60%60%60;
        return substr(100+$horas,1,2).":".substr(100+$minutos2,1,2).":".substr(100+$segundos2,1,2);
    }


    /*
	* Busca todos los dias festivos de un año en adelante
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


}
?>
