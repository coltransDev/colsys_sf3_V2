<?php

/**
 * ControlEncuesta filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseControlEncuestaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idformulario'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Formulario'), 'add_empty' => true)),
      'ca_idempresa'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Empresa'), 'add_empty' => true)),
      'ca_tipo_contestador' => new sfWidgetFormFilterInput(),
      'ca_id_contestador'   => new sfWidgetFormFilterInput(),
      'ca_fchcreado'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'ca_usucreado'        => new sfWidgetFormFilterInput(),
      'ca_fchactualizado'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'ca_usuactualizado'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'ca_idformulario'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Formulario'), 'column' => 'ca_id')),
      'ca_idempresa'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Empresa'), 'column' => 'ca_idempresa')),
      'ca_tipo_contestador' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ca_id_contestador'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ca_fchcreado'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'ca_usucreado'        => new sfValidatorPass(array('required' => false)),
      'ca_fchactualizado'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'ca_usuactualizado'   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('control_encuesta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ControlEncuesta';
  }

  public function getFields()
  {
    return array(
      'ca_id'               => 'Number',
      'ca_idformulario'     => 'ForeignKey',
      'ca_idempresa'        => 'ForeignKey',
      'ca_tipo_contestador' => 'Number',
      'ca_id_contestador'   => 'Number',
      'ca_fchcreado'        => 'Date',
      'ca_usucreado'        => 'Text',
      'ca_fchactualizado'   => 'Date',
      'ca_usuactualizado'   => 'Text',
    );
  }
}
