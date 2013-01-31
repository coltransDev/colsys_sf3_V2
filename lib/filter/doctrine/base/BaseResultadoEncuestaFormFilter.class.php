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
      'ca_resultado'         => new sfWidgetFormFilterInput(),
      'ca_servicio'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ca_idcontrolencuesta' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Controlencuesta'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'ca_idpregunta'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pregunta'), 'column' => 'ca_id')),
      'ca_resultado'         => new sfValidatorPass(array('required' => false)),
      'ca_servicio'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ca_idcontrolencuesta' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Controlencuesta'), 'column' => 'ca_id')),
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
      'ca_resultado'         => 'Text',
      'ca_servicio'          => 'Number',
      'ca_idcontrolencuesta' => 'ForeignKey',
    );
  }
}
