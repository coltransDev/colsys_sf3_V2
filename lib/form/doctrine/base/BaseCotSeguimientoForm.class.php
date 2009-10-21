<?php

/**
 * CotSeguimiento form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseCotSeguimientoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idseguimiento'  => new sfWidgetFormInputHidden(),
      'ca_fchseguimiento' => new sfWidgetFormDateTime(),
      'ca_idproducto'     => new sfWidgetFormDoctrineChoice(array('model' => 'CotProducto', 'add_empty' => true)),
      'ca_login'          => new sfWidgetFormDoctrineChoice(array('model' => 'Usuario', 'add_empty' => true)),
      'ca_seguimiento'    => new sfWidgetFormTextarea(),
      'ca_etapa'          => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idseguimiento'  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idseguimiento', 'required' => false)),
      'ca_fchseguimiento' => new sfValidatorDateTime(array('required' => false)),
      'ca_idproducto'     => new sfValidatorDoctrineChoice(array('model' => 'CotProducto', 'required' => false)),
      'ca_login'          => new sfValidatorDoctrineChoice(array('model' => 'Usuario', 'required' => false)),
      'ca_seguimiento'    => new sfValidatorString(array('required' => false)),
      'ca_etapa'          => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cot_seguimiento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CotSeguimiento';
  }

}
