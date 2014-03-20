<?php

/**
 * Opcion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    colmob
 * @subpackage model
 * @author     Gabriel Martinez Rojas
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Opcion extends BaseOpcion
{
        public function getQueryOpcion() {
        $q = Doctrine_Query::create()
                ->from('opcion')
                ->orderBy('ca_idpregunta, ca_id ASC');
        return $q;
    }

     public function duplicarOpcion($idOpcion) {
        $q = Doctrine_Query::create()
                ->from('opcion')
                ->where('ca_id = ?', $idOpcion)
                ->fetchOne();
        $copy = $record->copy(true); // make a deep copy
        $copy->save();
        //return $q;
    }


/*
$record = $query->fetchOne();
$copy = $record->copy(true); // make a deep copy
$copy->save();*/
}
