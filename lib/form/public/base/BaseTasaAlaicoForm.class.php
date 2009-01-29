<?php

/**
 * TasaAlaico form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
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
