<?php
/**
 */
class InoMaestraTable extends Doctrine_Table
{

    public static function getNumReferencia( $departamento, $modalidad, $origen, $destino, $mes, $ano  ){
        $referencia = "";
        if( $departamento==Constantes::MARITIMO ){            
            $parametros = ParametroTable::retrieveByCaso("CU010", $destino);

            if( count( $parametros)>0 ){
                $parametro = $parametros[0];
            }else{
                $parametro = null;
            }

            if( $modalidad == "FCL" ){
                $referencia = '4';
            }

            if( $modalidad == "LCL" || $modalidad == "COLOADING" ){
                $referencia = '5';
            }
            
            if( $modalidad == "PROYECTOS" ){
                $referencia = '6';
            }
            
            if( $modalidad == "PARTICULARES" ){
                $referencia = '8';
            }

            if( $parametro ){
                $referencia .= ''.str_pad($parametro->getCaIdentificacion(), 2, "0", STR_PAD_LEFT).".";
            }else{
                $referencia .= '30.';
            }

            $parametros = ParametroTable::retrieveByCaso("CU010", $origen );

            if( count( $parametros)>0 ){
                $parametro = $parametros[0];

                $referencia .= str_pad($parametro->getCaIdentificacion(), 2, "0", STR_PAD_LEFT).".";
            }else{
                $referencia .= '20.';
            }

        }

        

        if( $departamento==Constantes::TERRESTRE ){
            $parametros = ParametroTable::retrieveByCaso("CU010", $origen);
            $referencia = '7';
           if( count( $parametros)>0 ){
                $parametro = $parametros[0];
                $referencia .= str_pad($parametro->getCaIdentificacion(), 2, "0", STR_PAD_LEFT).".";
            }else{
                $referencia .= '20.';
            }

            if( $modalidad == "FCL" ){
                $referencia .= '40.';
            }elseif( $modalidad == "LCL" ){
                $referencia .= '50.';
            }else{
                $referencia .= '00.';
            }
        }

        $referencia.=$mes.'.';
        
        $ref = Doctrine::getTable("InoMaestra")
                         ->createQuery("m")
                         ->select( "MAX(m.ca_referencia)" )
                         ->where("m.ca_referencia LIKE ?", $referencia."%.".$ano )
                         ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                         ->execute();
        
        
        if( $ref ){
             $ref = explode('.', $ref);
             $val = intval( $ref[3] )+1;             
             $referencia .= str_pad($val, 3, "0", STR_PAD_LEFT).'.';
        }else{
             $referencia .= '001.';
        }

        $referencia.=$ano;

        

        return $referencia;



    /*
	
    a_output:= a_output || a_mes[1] || '.%.' || a_mes[2];

	select into registro max(ca_referencia) as ca_referencia from tb_inomaestra_sea where ca_referencia like a_output;
	IF nullvalue(registro.ca_referencia) THEN
		a_referencia:= string_to_array(a_output,'.');
		a_referencia[4]:= '001';
	ELSE
		a_referencia:= string_to_array(registro.ca_referencia,'.');
		a_referencia[4]:= substr(text(1001 +int2(a_referencia[4])),2,3);
	END IF;
	a_output:= array_to_string(a_referencia,'.');

    RETURN a_output;
END;
$BODY$
  LANGUAGE 'plpgsql' VOLATILE
  COST 100;
ALTER FUNCTION fun_referencia(text, text, text, text, text) OWNER TO postgres;
GRANT EXECUTE ON FUNCTION fun_referencia(text, text, text, text, text) TO postgres;
GRANT EXECUTE ON FUNCTION fun_referencia(text, text, text, text, text) TO public;
GRANT EXECUTE ON FUNCTION fun_referencia(text, text, text, text, text) TO "Usuarios";*/
    }
}