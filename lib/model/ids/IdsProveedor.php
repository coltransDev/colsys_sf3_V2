<?php

class IdsProveedor extends BaseIdsProveedor
{
    public function getEvaluacionDesempeno( $year ){
        $c = new Criteria();
        $c->add( IdsEvaluacionPeer::CA_FCHEVALUACION, "extract( year from ".IdsEvaluacionPeer::CA_FCHEVALUACION.") = ".$year, Criteria::CUSTOM  );
         $c->add( IdsEvaluacionPeer::CA_TIPO, "desempeno"  );
        $evaluaciones = IdsEvaluacionPeer::doSelect($c);

        $val=0;
        $i=0;
        foreach( $evaluaciones as $evaluacion ){
            $val += $evaluacion->getCalificacion();
            $i++;
        }
        if( $i>0 ){
            return round($val/$i,2);
        }else{
            return null;
        }

    }
}
sfPropelBehavior::add('IdsProveedor', array( 'traceable' ));