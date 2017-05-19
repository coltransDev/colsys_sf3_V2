<?php

/**
 * Bloque filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseBloqueFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idformulario'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Formulario'), 'add_empty' => true)),
      'ca_titulo'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ca_introduccion'   => new sfWidgetFormFilterInput(),
      'ca_orden'          => new sfWidgetFormFilterInput(),
      'ca_activo'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'ca_tipo'           => new sfWidgetFormFilterInput(),
      'ca_fchcreado'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'ca_usucreado'      => new sfWidgetFormFilterInput(),
      'ca_fchactualizado' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'ca_usuactualizado' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'ca_idformulario'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Formulario'), 'column' => 'ca_id')),
      'ca_titulo'         => new sfValidatorPass(array('required' => false)),
      'ca_introduccion'   => new sfValidatorPass(array('required' => false)),
      'ca_orden'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ca_activo'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'ca_tipo'           => new sfValidatorPass(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'ca_usucreado'      => new sfValidatorPass(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'ca_usuactualizado' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bloque_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Bloque';
  }

  public function getFields()
  {
    return array(
      'ca_id'             => 'Number',
      'ca_idformulario'   => 'ForeignKey',
      'ca_titulo'         => 'Text',
      'ca_introduccion'   => 'Text',
      'ca_orden'          => 'Number',
      'ca_activo'         => 'Boolean',
      'ca_tipo'           => 'Text',
      'ca_fchcreado'      => 'Date',
      'ca_usucreado'      => 'Text',
      'ca_fchactualizado' => 'Date',
      'ca_usuactualizado' => 'Text',
    );
  }
}
