<?php
/**
 */
class InoMaestraAirTable extends Doctrine_Table
{
    public static function getNumReferencia( $impoexpo, $transporte, $modalidad, $origen, $destino, $mes, $ano  ){

        $referencia = array();
        
        if( $impoexpo == Constantes::IMPO || $impoexpo == Constantes::TRIANGULACION ){
            

            if($transporte==Constantes::AEREO)
            {
                $p_origen= Doctrine::getTable("Ciudad")->find( $origen );
                
                
                
                
                
                //print_r( $c_destino  );
                
                if( !($impoexpo == Constantes::TRIANGULACION || $modalidad==Constantes::COURIER) ){
                    $c_destino = ParametroTable::retrieveByCaso("CU003", null, $destino);
                    if(count($c_destino)>0)
                    {
                        $referencia[0]="1".$c_destino[0]->getCaIdentificacion();
                        $referencia[0]=str_pad($referencia[0], 3, "0", STR_PAD_RIGHT);
                    }else{
                        throw new Exception("Destino no valido");
                    }
                }else{
                    $referencia[0]="190";
                }
                
                
                $c_origen = ParametroTable::retrieveByCaso("CU002",null,$p_origen->getTrafico()->getCaIdtrafico());
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
        

        $referencia[3] = str_pad($mes, 2, "0", STR_PAD_LEFT);
        $referencia[4] = "%";
        $referencia[5] = $ano%100;

        $ref = Doctrine::getTable("InoMaestraAir")
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
             $referencia[4] = str_pad($val, 4, "0", STR_PAD_LEFT);
        }else{
             $referencia[4] = '0001';
        }
                
        return implode(".", $referencia);


    }
}