<?php

/**
 * RepAntUsuario form base class.
 *
 * @method RepAntUsuario getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRepAntUsuarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idantecedente'  => new sfWidgetFormInputHidden(),
      'ca_login'          => new sfWidgetFormInputHidden(),
      'ca_fchrevisado'    => new sfWidgetFormDateTime(),
      'ca_usurevisado'    => new sfWidgetFormTextarea(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormTextarea(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idantecedente'  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idantecedente', 'required' => false)),
      'ca_login'          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_login', 'required' => false)),
      'ca_fchrevisado'    => new sfValidatorDateTime(array('required' => false)),
      'ca_usurevisado'    => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rep_ant_usuario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepAntUsuario';
  }

}
