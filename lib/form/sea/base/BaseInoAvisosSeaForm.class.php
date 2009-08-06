<?php

/**
 * InoAvisosSea form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseInoAvisosSeaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_referencia' => new sfWidgetFormInputHidden(),
      'ca_idcliente'  => new sfWidgetFormInputHidden(),
      'ca_hbls'       => new sfWidgetFormInputHidden(),
      'ca_idemail'    => new sfWidgetFormInputHidden(),
      'ca_fchaviso'   => new sfWidgetFormDate(),
      'ca_aviso'      => new sfWidgetFormInput(),
      'ca_idbodega'   => new sfWidgetFormInput(),
      'ca_fchllegada' => new sfWidgetFormDate(),
      'ca_fchenvio'   => new sfWidgetFormDateTime(),
      'ca_usuenvio'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_referencia' => new sfValidatorPropelChoice(array('model' => 'InoMaestraSea', 'column' => 'ca_referencia', 'required' => false)),
      'ca_idcliente'  => new sfValidatorPropelChoice(array('model' => 'Cliente', 'column' => 'ca_idcliente', 'required' => false)),
      'ca_hbls'       => new sfValidatorPropelChoice(array('model' => 'InoClientesSea', 'column' => 'ca_hbls', 'required' => false)),
      'ca_idemail'    => new sfValidatorPropelChoice(array('model' => 'Email', 'column' => 'ca_idemail', 'required' => false)),
      'ca_fchaviso'   => new sfValidatorDate(array('required' => false)),
      'ca_aviso'      => new sfValidatorString(array('required' => false)),
      'ca_idbodega'   => new sfValidatorInteger(array('required' => false)),
      'ca_fchllegada' => new sfValidatorDate(array('required' => false)),
      'ca_fchenvio'   => new sfValidatorDateTime(array('required' => false)),
      'ca_usuenvio'   => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ino_avisos_sea[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InoAvisosSea';
  }


}
