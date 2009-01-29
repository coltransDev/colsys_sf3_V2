<?php

/**
 * Bodega form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseBodegaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idbodega'   => new sfWidgetFormInputHidden(),
      'ca_nombre'     => new sfWidgetFormInput(),
      'ca_tipo'       => new sfWidgetFormInput(),
      'ca_transporte' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idbodega'   => new sfValidatorPropelChoice(array('model' => 'Bodega', 'column' => 'ca_idbodega', 'required' => false)),
      'ca_nombre'     => new sfValidatorString(array('required' => false)),
      'ca_tipo'       => new sfValidatorString(array('required' => false)),
      'ca_transporte' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bodega[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Bodega';
  }


}
