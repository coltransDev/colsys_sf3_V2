<?php

/**
 * RepExpo form base class.
 *
 * @method RepExpo getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRepExpoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idreporte'         => new sfWidgetFormInputHidden(),
      'ca_peso'              => new sfWidgetFormInputText(),
      'ca_volumen'           => new sfWidgetFormInputText(),
      'ca_piezas'            => new sfWidgetFormTextarea(),
      'ca_dimensiones'       => new sfWidgetFormTextarea(),
      'ca_valorcarga'        => new sfWidgetFormInputText(),
      'ca_anticipo'          => new sfWidgetFormTextarea(),
      'ca_idsia'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sia'), 'add_empty' => false)),
      'ca_tipoexpo'          => new sfWidgetFormInputText(),
      'ca_idlineaterrestre'  => new sfWidgetFormInputText(),
      'ca_motonave'          => new sfWidgetFormInputText(),
      'ca_emisionbl'         => new sfWidgetFormInputText(),
      'ca_datosbl'           => new sfWidgetFormTextarea(),
      'ca_numbl'             => new sfWidgetFormInputText(),
      'ca_inspeccion_fisica' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'ca_idreporte'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idreporte', 'required' => false)),
      'ca_peso'              => new sfValidatorNumber(array('required' => false)),
      'ca_volumen'           => new sfValidatorNumber(array('required' => false)),
      'ca_piezas'            => new sfValidatorString(array('required' => false)),
      'ca_dimensiones'       => new sfValidatorString(array('required' => false)),
      'ca_valorcarga'        => new sfValidatorNumber(array('required' => false)),
      'ca_anticipo'          => new sfValidatorString(array('required' => false)),
      'ca_idsia'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sia'))),
      'ca_tipoexpo'          => new sfValidatorInteger(array('required' => false)),
      'ca_idlineaterrestre'  => new sfValidatorInteger(array('required' => false)),
      'ca_motonave'          => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'ca_emisionbl'         => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'ca_datosbl'           => new sfValidatorString(array('required' => false)),
      'ca_numbl'             => new sfValidatorInteger(array('required' => false)),
      'ca_inspeccion_fisica' => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rep_expo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepExpo';
  }

}
