<?php

/**
 * RecargoFlete form base class.
 *
 * @package    form
 * @subpackage recargo_flete
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BaseRecargoFleteForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtrayecto' => new sfWidgetFormInputHidden(),
      'ca_idconcepto' => new sfWidgetFormInputHidden(),
      'ca_idrecargo'  => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_idtrayecto' => new sfValidatorPropelChoice(array('model' => 'Flete', 'column' => 'ca_idtrayecto', 'required' => false)),
      'ca_idconcepto' => new sfValidatorPropelChoice(array('model' => 'Flete', 'column' => 'ca_idtrayecto', 'required' => false)),
      'ca_idrecargo'  => new sfValidatorPropelChoice(array('model' => 'TipoRecargo', 'column' => 'ca_idrecargo', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('recargo_flete[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RecargoFlete';
  }


}
