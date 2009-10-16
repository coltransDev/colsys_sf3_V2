<?php

/**
 * CotSeguimiento form base class.
 *
 * @package    form
 * @subpackage cot_seguimiento
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseCotSeguimientoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idseguimiento'  => new sfWidgetFormInputHidden(),
      'ca_fchseguimiento' => new sfWidgetFormDateTime(),
      'ca_idproducto'     => new sfWidgetFormDoctrineSelect(array('model' => 'CotProducto', 'add_empty' => true)),
      'ca_login'          => new sfWidgetFormDoctrineSelect(array('model' => 'Usuario', 'add_empty' => true)),
      'ca_seguimiento'    => new sfWidgetFormInput(),
      'ca_etapa'          => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idseguimiento'  => new sfValidatorDoctrineChoice(array('model' => 'CotSeguimiento', 'column' => 'ca_idseguimiento', 'required' => false)),
      'ca_fchseguimiento' => new sfValidatorDateTime(array('required' => false)),
      'ca_idproducto'     => new sfValidatorDoctrineChoice(array('model' => 'CotProducto', 'required' => false)),
      'ca_login'          => new sfValidatorDoctrineChoice(array('model' => 'Usuario', 'required' => false)),
      'ca_seguimiento'    => new sfValidatorString(array('required' => false)),
      'ca_etapa'          => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cot_seguimiento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CotSeguimiento';
  }

}