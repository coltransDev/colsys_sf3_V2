<?php

/**
 * Opcion filter form.
 *
 * @package    colmob
 * @subpackage filter
 * @author     Gabriel Martinez Rojas
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OpcionFormFilter extends BaseOpcionFormFilter {

    public function configure() {
        $this->setWidget('ca_texto', new sfWidgetFormFilterInput(array('empty_label' => '<span class="filter-auxiliar">esta vac&iacute;o</span>')));
        $this->setWidget('ca_orden', new sfWidgetFormFilterInput(array('empty_label' => '<span class="filter-auxiliar">esta vac&iacute;o</span>')));

        $this->setWidget('ca_id', new sfWidgetFormFilterInput(array('with_empty' => false)));
        $this->setValidator('ca_id', new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))));
        $this->widgetSchema->setHelp('ca_idpregunta', '<span class="filter-help">Formulario - Bloque - Pregunta</span>');
        $this->widgetSchema->setLabels(array(
            'ca_id' => 'id:',
            'ca_alias' => 'alias:',
            'ca_texto' => 'Texto:',
            'ca_default' => 'Valor por defecto:',
            'ca_color' => 'Color:',
            'ca_orden' => 'Orden:',
            'ca_idpregunta' => 'Pregunta:',
        ));
        $this->useFields(array(
            'ca_idpregunta',
            'ca_texto',
            'ca_orden',
            'ca_id'
        ));
    }

}
