<?php

/**
 * ResultadoEncuesta filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseResultadoEncuestaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idpregunta'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pregunta'), 'add_empty' => true)),
      'ca_servicio'          => new sfWidgetFormFilterInput(),
      'ca_resultado'         => new sfWidgetFormFilterInput(),
      'ca_idcontrolencuesta' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Controlencuesta'), 'add_empty' => true)),
      'ca_fchcreado'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'ca_usucreado'         => new sfWidgetFormFilterInput(),
      'ca_fchactualizado'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'ca_usuactualizado'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'ca_idpregunta'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pregunta'), 'column' => 'ca_id')),
      'ca_servicio'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ca_resultado'         => new sfValidatorPass(array('required' => false)),
      'ca_idcontrolencuesta' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Controlencuesta'), 'column' => 'ca_id')),
      'ca_fchcreado'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'ca_usucreado'         => new sfValidatorPass(array('required' => false)),
      'ca_fchactualizado'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'ca_usuactualizado'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('resultado_encuesta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ResultadoEncuesta';
  }

  public function getFields()
  {
    return array(
      'ca_id'                => 'Number',
      'ca_idpregunta'        => 'ForeignKey',
      'ca_servicio'          => 'Number',
      'ca_resultado'         => 'Text',
      'ca_idcontrolencuesta' => 'ForeignKey',
      'ca_fchcreado'         => 'Date',
      'ca_usucreado'         => 'Text',
      'ca_fchactualizado'    => 'Date',
      'ca_usuactualizado'    => 'Text',
    );
  }
}
