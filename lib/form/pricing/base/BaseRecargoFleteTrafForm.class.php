<?php

/**
 * RecargoFleteTraf form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseRecargoFleteTrafForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtrafico'      => new sfWidgetFormInputHidden(),
      'ca_idciudad'       => new sfWidgetFormInputHidden(),
      'ca_idrecargo'      => new sfWidgetFormInputHidden(),
      'ca_aplicacion'     => new sfWidgetFormInput(),
      'ca_vlrfijo'        => new sfWidgetFormInput(),
      'ca_porcentaje'     => new sfWidgetFormInput(),
      'ca_baseporcentaje' => new sfWidgetFormInput(),
      'ca_vlrunitario'    => new sfWidgetFormInput(),
      'ca_baseunitario'   => new sfWidgetFormInput(),
      'ca_recargominimo'  => new sfWidgetFormInput(),
      'ca_idmoneda'       => new sfWidgetFormInput(),
      'ca_observaciones'  => new sfWidgetFormInput(),
      'ca_fchinicio'      => new sfWidgetFormDate(),
      'ca_fchvencimiento' => new sfWidgetFormDate(),
      'ca_modalidad'      => new sfWidgetFormInputHidden(),
      'ca_impoexpo'       => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idtrafico'      => new sfValidatorPropelChoice(array('model' => 'RecargoFleteTraf', 'column' => 'ca_idtrafico', 'required' => false)),
      'ca_idciudad'       => new sfValidatorPropelChoice(array('model' => 'RecargoFleteTraf', 'column' => 'ca_idciudad', 'required' => false)),
      'ca_idrecargo'      => new sfValidatorPropelChoice(array('model' => 'TipoRecargo', 'column' => 'ca_idrecargo', 'required' => false)),
      'ca_aplicacion'     => new sfValidatorString(array('required' => false)),
      'ca_vlrfijo'        => new sfValidatorNumber(array('required' => false)),
      'ca_porcentaje'     => new sfValidatorNumber(array('required' => false)),
      'ca_baseporcentaje' => new sfValidatorString(array('required' => false)),
      'ca_vlrunitario'    => new sfValidatorNumber(array('required' => false)),
      'ca_baseunitario'   => new sfValidatorString(array('required' => false)),
      'ca_recargominimo'  => new sfValidatorNumber(array('required' => false)),
      'ca_idmoneda'       => new sfValidatorString(array('required' => false)),
      'ca_observaciones'  => new sfValidatorString(array('required' => false)),
      'ca_fchinicio'      => new sfValidatorDate(array('required' => false)),
      'ca_fchvencimiento' => new sfValidatorDate(array('required' => false)),
      'ca_modalidad'      => new sfValidatorPropelChoice(array('model' => 'RecargoFleteTraf', 'column' => 'ca_modalidad', 'required' => false)),
      'ca_impoexpo'       => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('recargo_flete_traf[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RecargoFleteTraf';
  }


}
