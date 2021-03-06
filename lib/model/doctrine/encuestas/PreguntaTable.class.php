<?php

/**
 * PreguntaTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PreguntaTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object PreguntaTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Pregunta');
    }

    public static function getPreguntasActivas() {
        $q = Doctrine_Query::create()
                ->from('Pregunta')
                ->where('ca_activo = ?', true)
                ->orderBy('ca_orden ASC');
        return $q->fetchOne();
    }

    /**
     * Devuelve un formulario dado un id
     * @param type $id_articulo
     * @return type
     */
    public function getPregunta($id_pregunta) {
        $q = Doctrine_Query::create()
                ->from('Pregunta')
                ->where('ca_id = ?', $id_pregunta)
                ->limit(1);
        return $q->fetchOne();
    }

    /**
     * Duplica una pregunta dado su id manteniendo sus opciones
     * @param type $id_articulo
     * @return type
     */
    public function duplicatePregunta($id_pregunta) {
        $query = Doctrine_Query::create()
                ->from('pregunta')
                ->find($id_pregunta);

        /*$record = $query->fetchOne();
        $copy = $record->copy();

        if ($copy->trySave()) {
            $collection = $record->PastimePerson; // get the relationship
            records
            $c = new Doctrine_Collection('PastimePerson');

            foreach ($collection as $relation) {
                $r = $relation->copy();
                $r->setPersonId($copy->getId());
                $c->add($r);
            }

            $c->save();
        }*/
    }

}