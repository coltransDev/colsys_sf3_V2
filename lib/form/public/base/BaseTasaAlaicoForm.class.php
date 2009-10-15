<?php

/**
 * TasaAlaico form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseTasaAlaicoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_fechainicial' => new sfWidgetFormInputHidden(),
      'ca_fechafinal'   => new sfWidgetFormDate(),
      'ca_valortasa'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_fechainicial' => new sfValidatorPropelChoice(array('model' => 'TasaAlaico', 'column' => 'ca_fechainicial', 'required' => false)),
      'ca_fechafinal'   => new sfValidatorDate(),
      'ca_valortasa'    => new sfValidatorString(),
    ));

    $this->widgetSchema->setNameFormat('tasa_alaico[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TasaAlaico';
  }


}
