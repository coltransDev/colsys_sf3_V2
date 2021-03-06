<?php

/**
 * Pregunta
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    colmob
 * @subpackage model
 * @author     Gabriel Martinez Rojas
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Pregunta extends BasePregunta {
    
      public function __toString() {
          return $this->getBloque()->getFormulario()->getCaId().'. '.$this->getBloque()->getFormulario()->getCaTitulo().' - '.$this->getCaIdbloque().".".$this->getBloque()->getCaTitulo()." - " . $this->ca_id.". ". substr($this->ca_texto,0,40)."...";
      }


    public function getQueryPregunta() {
        $q = Doctrine_Query::create()
                ->from('pregunta')
                ->orderBy('ca_idbloque DESC');
        return $q;
    }

    public function getOpcionesOrdenadas($idPregunta) {
        $q = Doctrine_Query::create()
                ->from('opcion')
                ->where('ca_idpregunta = ?', $idPregunta)
                ->orderBy('ca_orden ASC');
        return $q->execute();
    }

    public static function getPreguntaTipo($tipoPregunta) {
         $opciones = array(0 => 'n&uacute;mero', 1 => 'texto', 2 => 'email', 3 => 'p&aacute;rrafo', 4 => 'test', 5 => 'casillas de verificaci&oacute;n', 6 => 'lista desplegable', 7 => 'escala', 8 => 'escala con estrellas', 9 => 'cuadr&iacute;cula');
         return html_entity_decode($opciones[$tipoPregunta]);
    }

    public static function getTextoBooleano($idPregunta) {
        $textoOpciones_tipo = array("<span class=no>no</span>", '<span class=si>si</span>');
        $valoresOpciones_tipo = array(0, 1);
        $c = array_combine($valoresOpciones_tipo, $textoOpciones_tipo);
        return $c[$idPregunta];
    }

    public static function getActivo($activo) {
        return $activo;
    }



    /* /
      public function getOpcionesOrdenadas($id_pregunta) {
      $q = Doctrine_Query::create()
      ->from('opcion')
      ->where('ca_idbloque = ?', $id_pregunta)
      ->andWhere('ca_activo = ?', 1)
      ->orderBy('ca_orden ASC');
      return $q->execute();
      } */
}
