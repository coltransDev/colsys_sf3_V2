<?php

class ControlEncuestaTable extends Doctrine_Table
{
        public static function contarEncuestas(Doctrine_Query $q = null) {
        $q = Doctrine_Query::create()
        ->from('controlEncuesta')
         ->where('ca_idformulario = ?', 1)
         ->andWhere('ca_tipo_contestador = ?', 1);
        return $q->count();
    }
}
