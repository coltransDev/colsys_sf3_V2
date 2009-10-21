<?php

/**
 * RepExpo form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseRepExpoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idreporte'        => new sfWidgetFormInputHidden(),
      'ca_peso'             => new sfWidgetFormInputText(),
      'ca_volumen'          => new sfWidgetFormInputText(),
      'ca_piezas'           => new sfWidgetFormTextarea(),
      'ca_dimensiones'      => new sfWidgetFormTextarea(),
      'ca_valorcarga'       => new sfWidgetFormTextarea(),
      'ca_anticipo'         => new sfWidgetFormTextarea(),
      'ca_idsia'            => new sfWidgetFormDoctrineChoice(array('model' => 'Sia', 'add_empty' => true)),
      'ca_tipoexpo'         => new sfWidgetFormInputText(),
      'ca_idlineaterrestre' => new sfWidgetFormInputText(),
      'ca_motonave'         => new sfWidgetFormTextarea(),
      'ca_emisionbl'        => new sfWidgetFormTextarea(),
      'ca_datosbl'          => new sfWidgetFormTextarea(),
      'ca_numbl'            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_idreporte'        => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idreporte', 'required' => false)),
      'ca_peso'             => new sfValidatorNumber(array('required' => false)),
      'ca_volumen'          => new sfValidatorNumber(array('required' => false)),
      'ca_piezas'           => new sfValidatorString(array('required' => false)),
      'ca_dimensiones'      => new sfValidatorString(array('required' => false)),
      'ca_valorcarga'       => new sfValidatorString(array('required' => false)),
      'ca_anticipo'         => new sfValidatorString(array('required' => false)),
      'ca_idsia'            => new sfValidatorDoctrineChoice(array('model' => 'Sia', 'required' => false)),
      'ca_tipoexpo'         => new sfValidatorInteger(array('required' => false)),
      'ca_idlineaterrestre' => new sfValidatorInteger(array('required' => false)),
      'ca_motonave'         => new sfValidatorString(array('required' => false)),
      'ca_emisionbl'        => new sfValidatorString(array('required' => false)),
      'ca_datosbl'          => new sfValidatorString(array('required' => false)),
      'ca_numbl'            => new sfValidatorInteger(array('required' => false)),
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
