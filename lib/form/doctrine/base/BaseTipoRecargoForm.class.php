<?php

/**
 * TipoRecargo form base class.
 *
 * @method TipoRecargo getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseTipoRecargoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idrecargo'  => new sfWidgetFormInputHidden(),
      'ca_recargo'    => new sfWidgetFormTextarea(),
      'ca_tipo'       => new sfWidgetFormTextarea(),
      'ca_transporte' => new sfWidgetFormTextarea(),
      'ca_incoterms'  => new sfWidgetFormTextarea(),
      'ca_impoexpo'   => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idrecargo'  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idrecargo', 'required' => false)),
      'ca_recargo'    => new sfValidatorString(array('required' => false)),
      'ca_tipo'       => new sfValidatorString(array('required' => false)),
      'ca_transporte' => new sfValidatorString(array('required' => false)),
      'ca_incoterms'  => new sfValidatorString(array('required' => false)),
      'ca_impoexpo'   => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tipo_recargo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoRecargo';
  }

}
