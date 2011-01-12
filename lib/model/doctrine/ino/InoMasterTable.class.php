<?php

class InoMasterTable extends Doctrine_Table
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

            if($transporte==Constantes::AEREO)
            {
                $p_origen= Doctrine::getTable("Ciudad")->find( $origen );
                $c_origen = ParametroTable::retrieveByCaso("CU002",null ,$p_origen->getTrafico()->getCaIdtrafico());
                $c_destino = ParametroTable::retrieveByCaso("CU003", null ,$destino);

                if(count($c_destino)>0)
                {
                    $referencia[0]="1".$c_destino[0]->getCaIdentificacion();
                    $referencia[0]=str_pad($referencia[0], 3, "0", STR_PAD_RIGHT);
                }

                if(count($c_origen)>0)
                {
                    $referencia[1]=$c_origen[0]->getCaIdentificacion();
                }
                else
                {
                    $referencia[1]="50";
                }
            }
        }
        else if($impoexpo == Constantes::EXPO)
        {
            $c_origen = ParametroTable::retrieveByCaso("CU003", null ,$origen);
            $c_transporte = ParametroTable::retrieveByCaso("CU005", null ,$transporte);

            
            if(count($c_origen)>0)
            {
                $referencia[0]="3".$c_origen[0]->getCaIdentificacion();
                $referencia[0]=str_pad($referencia[0], 3, "0", STR_PAD_RIGHT);
            }         
            if(count($c_transporte)>0)
            {
                $referencia[1]=$c_transporte[0]->getCaIdentificacion();
            }
        }
        

        $referencia[3] = str_pad($mes, 2, "0", STR_PAD_LEFT);
        $referencia[4] = "%";
        $referencia[5] = $ano%10;

        $ref = Doctrine::getTable("InoMaster")
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


    }
}
