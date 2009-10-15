<?php

/**
 * IdsProveedor
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5845 2009-06-09 07:36:57Z jwage $
 */
class IdsProveedor extends BaseIdsProveedor
{
    public function getEvaluacionDesempeno( $year ){

        $evaluaciones = Doctrine::getTable("IdsEvaluacion")
                        ->createQuery("e")
                        ->where("e.ca_tipo= ?", 'desempeno')
                        ->addWhere("to_char( e.ca_fchevaluacion, 'YYYY') = ?", $year )
                        ->execute();
        
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