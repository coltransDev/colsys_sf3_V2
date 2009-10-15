<?php

/**
 * Trafico form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseTraficoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtrafico' => new sfWidgetFormInputHidden(),
      'ca_nombre'    => new sfWidgetFormInput(),
      'ca_bandera'   => new sfWidgetFormInput(),
      'ca_idmoneda'  => new sfWidgetFormInput(),
      'ca_idgrupo'   => new sfWidgetFormPropelChoice(array('model' => 'TraficoGrupo', 'add_empty' => true)),
      'ca_link'      => new sfWidgetFormInput(),
      'ca_conceptos' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idtrafico' => new sfValidatorPropelChoice(array('model' => 'Trafico', 'column' => 'ca_idtrafico', 'required' => false)),
      'ca_nombre'    => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'ca_bandera'   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'ca_idmoneda'  => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'ca_idgrupo'   => new sfValidatorPropelChoice(array('model' => 'TraficoGrupo', 'column' => 'ca_idgrupo', 'required' => false)),
      'ca_link'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ca_conceptos' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('trafico[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Trafico';
  }


}
