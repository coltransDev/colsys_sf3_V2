<?php

class IdsEvaluacion extends BaseIdsEvaluacion
{
    
    /*
     * Promedia los resultados de la evaluacion
     */
    public function getCalificacion(){
        $resultado = 0;
        $i = 0;

        $conceptos = $this->getIdsEvaluacionxCriterios();
        foreach( $conceptos as $concepto ){
            if( $this->getCaTipo() == "seleccion" ){
                $resultado+=$concepto->getCaValor();
            }else{
                $resultado+=$concepto->getCaValor()*$concepto->getCaPonderacion();

            }
            $i++;
        }
        if( $i==0 ){
            return 0;
        }else{
            return $resultado/$i;
        }

    }
}
sfPropelBehavior::add('IdsEvaluacion', array( 'traceable' ));