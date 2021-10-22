<?php

/**
 * Formulario form base class.
 *
 * @method Formulario getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseFormularioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_id'               => new sfWidgetFormInputHidden(),
      'ca_titulo'           => new sfWidgetFormInputText(),
      'ca_alias'            => new sfWidgetFormInputText(),
      'ca_introduccion'     => new sfWidgetFormTextarea(),
      'ca_activo'           => new sfWidgetFormInputCheckbox(),
      'ca_vigencia_inicial' => new sfWidgetFormDateTime(),
      'ca_vigencia_final'   => new sfWidgetFormDateTime(),
      'ca_token'            => new sfWidgetFormInputText(),
      'ca_nombre_formato'   => new sfWidgetFormInputText(),
      'ca_empresa'          => new sfWidgetFormInputText(),
      'ca_fchcreado'        => new sfWidgetFormDateTime(),
      'ca_usucreado'        => new sfWidgetFormInputText(),
      'ca_fchactualizado'   => new sfWidgetFormDateTime(),
      'ca_usuactualizado'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_id', 'required' => false)),
      'ca_titulo'           => new sfValidatorString(array('max_length' => 255)),
      'ca_alias'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ca_introduccion'     => new sfValidatorString(array('max_length' => 10000, 'required' => false)),
      'ca_activo'           => new sfValidatorBoolean(array('required' => false)),
      'ca_vigencia_inicial' => new sfValidatorDateTime(array('required' => false)),
      'ca_vigencia_final'   => new sfValidatorDateTime(array('required' => false)),
      'ca_token'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ca_nombre_formato'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ca_empresa'          => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'ca_fchcreado'        => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'        => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ca_fchactualizado'   => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('formulario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Formulario';
  }

}
