<?php

/**
 * Festivo form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseFestivoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_fchfestivo' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'ca_fchfestivo' => new sfValidatorPropelChoice(array('model' => 'Festivo', 'column' => 'ca_fchfestivo', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('festivo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Festivo';
  }


}
