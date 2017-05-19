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
      'ca_servicio'          => new sfWidgetFormInputText(),
      'ca_resultado'         => new sfWidgetFormTextarea(),
      'ca_idcontrolencuesta' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Controlencuesta'), 'add_empty' => false)),
      'ca_fchcreado'         => new sfWidgetFormDateTime(),
      'ca_usucreado'         => new sfWidgetFormInputText(),
      'ca_fchactualizado'    => new sfWidgetFormDateTime(),
      'ca_usuactualizado'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_id', 'required' => false)),
      'ca_idpregunta'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pregunta'))),
      'ca_servicio'          => new sfValidatorInteger(array('required' => false)),
      'ca_resultado'         => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'ca_idcontrolencuesta' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Controlencuesta'))),
      'ca_fchcreado'         => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchactualizado'    => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado'    => new sfValidatorString(array('max_length' => 20, 'required' => false)),
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
