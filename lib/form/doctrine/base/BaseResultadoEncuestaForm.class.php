<?php

/**
 * ResultadoEncuesta form base class.
 *
 * @method ResultadoEncuesta getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseResultadoEncuestaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_id'                => new sfWidgetFormInputHidden(),
      'ca_idpregunta'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pregunta'), 'add_empty' => false)),
      'ca_resultado'         => new sfWidgetFormTextarea(),
      'ca_servicio'          => new sfWidgetFormInputText(),
      'ca_idcontrolencuesta' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Controlencuesta'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'ca_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_id', 'required' => false)),
      'ca_idpregunta'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pregunta'))),
      'ca_resultado'         => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'ca_servicio'          => new sfValidatorInteger(),
      'ca_idcontrolencuesta' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Controlencuesta'))),
    ));

    $this->widgetSchema->setNameFormat('resultado_encuesta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ResultadoEncuesta';
  }

}
