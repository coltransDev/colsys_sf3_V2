<?php

/**
 * RecargoFlete form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseRecargoFleteForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtrayecto'     => new sfWidgetFormInputHidden(),
      'ca_idconcepto'     => new sfWidgetFormInputHidden(),
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
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormInput(),
      'ca_fchactualizado' => new sfWidgetFormDateTime(),
      'ca_usuactualizado' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idtrayecto'     => new sfValidatorPropelChoice(array('model' => 'Flete', 'column' => 'ca_idtrayecto', 'required' => false)),
      'ca_idconcepto'     => new sfValidatorPropelChoice(array('model' => 'Flete', 'column' => 'ca_idconcepto', 'required' => false)),
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
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_fchactualizado' => new sfValidatorDateTime(array('required' => false)),
      'ca_usuactualizado' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('recargo_flete[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RecargoFlete';
  }


}
