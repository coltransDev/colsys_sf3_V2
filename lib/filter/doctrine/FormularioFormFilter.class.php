<?php

/**
 * Formulario filter form.
 *
 * @package    colmob
 * @subpackage filter
 * @author     Gabriel Martinez Rojas
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FormularioFormFilter extends BaseFormularioFormFilter {

    public function configure() {

        $this->setWidget('ca_id', new sfWidgetFormFilterInput(array('with_empty' => false)));
        $this->setValidator('ca_id', new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))));

        $this->setWidget('ca_introduccion', new sfWidgetFormFilterInput(array('empty_label' => '<span class="filter-auxiliar">esta vac&iacute;o</span>')));
 
        $this->widgetSchema->setLabels(array(
            'ca_id' => 'Id:',
            'ca_alias' => 'Alias:',
            'ca_titulo' => 'Nombre:',
            'ca_introduccion' => 'Texto introductorio:',
            'ca_activo' => 'Activo:',
            'ca_estilo' => 'Estilo:',
            'ca_nombre_formato' => 'Nombre del formato:',
            'ca_color' => 'Color:',
            'ca_empresa' => 'Empresa:',
            'ca_fchcreado' =>  'Creado en:',
            'ca_fchactualizado' => 'Actualizado en',
            'ca_vigencia_final' => 'Vigencia Final:',
        ));

        $this->widgetSchema->setHelp('ca_titulo', '<span class="filter-help">Sensible a mayúsculas</span>');

        $this->useFields(array(
            'ca_titulo',
            'ca_introduccion',
            'ca_id',
        ));
    }

}
