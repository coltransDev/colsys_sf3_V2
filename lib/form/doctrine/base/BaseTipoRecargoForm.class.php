<?php

/**
 * TipoRecargo form base class.
 *
 * @package    form
 * @subpackage tipo_recargo
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseTipoRecargoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idrecargo'  => new sfWidgetFormInputHidden(),
      'ca_recargo'    => new sfWidgetFormInput(),
      'ca_tipo'       => new sfWidgetFormInput(),
      'ca_transporte' => new sfWidgetFormInput(),
      'ca_incoterms'  => new sfWidgetFormInput(),
      'ca_impoexpo'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idrecargo'  => new sfValidatorDoctrineChoice(array('model' => 'TipoRecargo', 'column' => 'ca_idrecargo', 'required' => false)),
      'ca_recargo'    => new sfValidatorString(array('required' => false)),
      'ca_tipo'       => new sfValidatorString(array('required' => false)),
      'ca_transporte' => new sfValidatorString(array('required' => false)),
      'ca_incoterms'  => new sfValidatorString(array('required' => false)),
      'ca_impoexpo'   => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tipo_recargo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoRecargo';
  }

}