<?php

/**
 * CotSeguimiento form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseCotSeguimientoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idcotizacion'   => new sfWidgetFormInputHidden(),
      'ca_idproducto'     => new sfWidgetFormInputHidden(),
      'ca_fchseguimiento' => new sfWidgetFormInputHidden(),
      'ca_login'          => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
      'ca_seguimiento'    => new sfWidgetFormInput(),
      'ca_etapa'          => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idcotizacion'   => new sfValidatorPropelChoice(array('model' => 'CotProducto', 'column' => 'ca_idcotizacion', 'required' => false)),
      'ca_idproducto'     => new sfValidatorPropelChoice(array('model' => 'CotProducto', 'column' => 'ca_idproducto', 'required' => false)),
      'ca_fchseguimiento' => new sfValidatorPropelChoice(array('model' => 'CotSeguimiento', 'column' => 'ca_fchseguimiento', 'required' => false)),
      'ca_login'          => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'ca_login')),
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
