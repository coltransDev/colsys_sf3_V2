<?php
/**
 */
class InoMaestraTable extends Doctrine_Table
{

    public static function getNumReferencia( $impoexpo, $transporte, $modalidad, $origen, $destino, $mes, $ano  ){

        
        $referencia = array();
        
        if( $impoexpo == Constantes::IMPO ){
            
            if( $transporte==Constantes::MARITIMO ){               
                switch( $modalidad ){
                    case "FCL":
                         $referencia[0] = '4';
                         break;
                    case "LCL":
                         $referencia[0] = '5';
                         break;
                    case "COLOADING":
                         $referencia[0] = '5';
                         break;
                    case "PROYECTOS":
                         $referencia[0] = '6';
                         break;
                    case "PARTICULARES":
                         $referencia[0] = '8';
                         break;
                }
               

                $parametros = ParametroTable::retrieveByCaso("CU010", $destino);

                if( count( $parametros)>0 ){
                    $parametro = $parametros[0];
                    $referencia[0] .= str_pad($parametro->getCaIdentificacion(), 2, "0", STR_PAD_LEFT);
                }else{
                    $referencia[0] .= '30';
                }

                $parametros = ParametroTable::retrieveByCaso("CU010", $origen);

                if( count( $parametros)>0 ){
                    $parametro = $parametros[0];
                    $referencia[1] = str_pad($parametro->getCaIdentificacion(), 2, "0", STR_PAD_LEFT);
                }else{
                    $referencia[1] = '20';
                }

            }
            //OTM DTA
            if( $modalidad==Constantes::OTMDTA ){
                
                $referencia[0] = '7';

                $parametros = ParametroTable::retrieveByCaso("CU010", $origen);
               if( count( $parametros)>0 ){
                    $parametro = $parametros[0];
                    $referencia[0] .= str_pad($parametro->getCaIdentificacion(), 2, "0", STR_PAD_LEFT);
                }else{
                    $referencia[0] .= '00';
                }

                if( $modalidad == "FCL" ){
                    $referencia[1] = '40';
                }elseif( $modalidad == "LCL" ){
                    $referencia[1] = '50';
                }else{
                    $referencia[1] = '00';
                }
            }
        }

        $referencia[3] = str_pad($mes, 2, "0", STR_PAD_LEFT);
        $referencia[4] = "%";
        $referencia[5] = $ano%10;
        
        $ref = Doctrine::getTable("InoMaestra")
                         ->createQuery("m")
                         ->select( "m.ca_referencia" )
                         ->where("m.ca_referencia LIKE ?", implode(".", $referencia) )
                         ->orderBy("m.ca_referencia DESC")
                         ->limit(1)
                         ->setHydrationMode(Doctrine::HYDRATE_SINGLE_SCALAR)
                         ->execute();
        
        if( $ref ){
             $ref = explode('.', $ref);
             $val = intval( isset($ref[3])?$ref[3]:0 )+1;
             $referencia[4] = str_pad($val, 3, "0", STR_PAD_LEFT);
        }else{
             $referencia[4] = '001';
        }
        
        return implode(".", $referencia);
            /*

                $parametros = ParametroTable::retrieveByCaso("CU010", $destino);

                if( count( $parametros)>0 ){
                    $parametro = $parametros[0];
                }else{
                    $parametro = null;
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
            }*/

        /*$referencia.=$mes.'.';
        
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

        

        */



    /*
	
  CREATE OR REPLACE FUNCTION fun_referencia(text, text, text, text, text)
  RETURNS text AS
$BODY$
DECLARE
    v_departamento ALIAS FOR $1;
    v_modalidad ALIAS FOR $2;
    v_origen ALIAS FOR $3;
    v_destino ALIAS FOR $4;
    v_mes ALIAS FOR $5;
    referrer_keys RECORD;  -- Declare a generic record to be used in a FOR
    a_referencia text[];
    a_output text;
    a_mes text[];
DECLARE
    registro RECORD;

BEGIN
    a_mes:= string_to_array(v_mes,'-');
    IF v_departamento = 'Marítimo' THEN
	    select into registro ca_identificacion from tb_parametros where ca_casouso = 'CU010' and ca_valor = v_destino;
        IF v_modalidad = 'FCL' THEN
            IF NOT FOUND THEN
                a_output:= '430.';
            ELSE
                a_output = text(400+registro.ca_identificacion) || '.';
            END IF;
        ELSIF v_modalidad = 'LCL' OR v_modalidad = 'COLOADING' THEN
            IF NOT FOUND THEN
                a_output:= '530.';
            ELSE
                a_output:= text(500+registro.ca_identificacion) || '.';
            END IF;
        ELSIF v_modalidad = 'PROYECTOS' THEN
            IF NOT FOUND THEN
                a_output:= '630.';
            ELSE
                a_output:= text(600+registro.ca_identificacion) || '.';
            END IF;
        ELSIF v_modalidad = 'PARTICULARES' THEN
            IF NOT FOUND THEN
                a_output:= '830.';
            ELSE
                a_output:= text(800+registro.ca_identificacion) || '.';
            END IF;
        END IF;

        select into registro ca_identificacion from tb_parametros where ca_casouso = 'CU010' and ca_valor = v_origen;
        IF NOT FOUND THEN
            a_output:= a_output || '20.';
        ELSE
            a_output:= a_output || substr(text(100+registro.ca_identificacion),2,2) || '.';
        END IF;
	ELSIF v_departamento = 'Terrestre' THEN
	    select into registro ca_identificacion from tb_parametros where ca_casouso = 'CU010' and ca_valor = v_origen;
		IF NOT FOUND THEN
			a_output:= '700.';
		ELSE
			a_output = text(700+registro.ca_identificacion) || '.';
		END IF;

        IF v_modalidad = 'FCL' THEN
            a_output:= a_output || '40.';
        ELSIF v_modalidad = 'LCL' THEN
            a_output:= a_output || '50.';
        ELSE
            a_output:= a_output || '00.';
        END IF;

    END IF;
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
GRANT EXECUTE ON FUNCTION fun_referencia(text, text, text, text, text) TO "Usuarios";
     */
    }
}