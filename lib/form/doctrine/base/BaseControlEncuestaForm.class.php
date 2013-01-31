<?php

/**
 * ControlEncuesta form base class.
 *
 * @method ControlEncuesta getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseControlEncuestaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_id'               => new sfWidgetFormInputHidden(),
      'ca_idformulario'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Formulario'), 'add_empty' => false)),
      'ca_idempresa'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Empresa'), 'add_empty' => false)),
      'ca_tipo_contestador' => new sfWidgetFormInputText(),
      'ca_id_contestador'   => new sfWidgetFormInputText(),
      'ca_fchcreado'        => new sfWidgetFormDateTime(),
      'ca_usucreado'        => new sfWidgetFormInputText(),
      'ca_fchactualizado'   => new sfWidgetFormDateTime(),
      'ca_usuactualizado'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_id', 'required' => false)),
      'ca_idformulario'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Formulario'))),
      'ca_idempresa'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Empresa'))),
      'ca_tipo_contestador' => new sfValidatorInteger(array('required' => false)),
      'ca_id_contestador'   => new sfValidatorInteger(array('required' => false)),
      'ca_fchcreado'        => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'        => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchactualizado'   => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('control_encuesta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ControlEncuesta';
  }

}
