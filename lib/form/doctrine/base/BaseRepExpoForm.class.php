<?php

/**
 * RepExpo form base class.
 *
 * @package    form
 * @subpackage rep_expo
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseRepExpoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idreporte'        => new sfWidgetFormInputHidden(),
      'ca_peso'             => new sfWidgetFormInput(),
      'ca_volumen'          => new sfWidgetFormInput(),
      'ca_piezas'           => new sfWidgetFormInput(),
      'ca_dimensiones'      => new sfWidgetFormInput(),
      'ca_valorcarga'       => new sfWidgetFormInput(),
      'ca_anticipo'         => new sfWidgetFormInput(),
      'ca_idsia'            => new sfWidgetFormDoctrineSelect(array('model' => 'Sia', 'add_empty' => true)),
      'ca_tipoexpo'         => new sfWidgetFormInput(),
      'ca_idlineaterrestre' => new sfWidgetFormInput(),
      'ca_motonave'         => new sfWidgetFormInput(),
      'ca_emisionbl'        => new sfWidgetFormInput(),
      'ca_datosbl'          => new sfWidgetFormInput(),
      'ca_numbl'            => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idreporte'        => new sfValidatorDoctrineChoice(array('model' => 'RepExpo', 'column' => 'ca_idreporte', 'required' => false)),
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

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepExpo';
  }

}