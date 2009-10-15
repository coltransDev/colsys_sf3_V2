<?php

/**
 * ColNovedad form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseColNovedadForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idnovedad'      => new sfWidgetFormInputHidden(),
      'ca_fchpublicacion' => new sfWidgetFormDate(),
      'ca_asunto'         => new sfWidgetFormInput(),
      'ca_detalle'        => new sfWidgetFormInput(),
      'ca_fcharchivar'    => new sfWidgetFormDate(),
      'ca_extension'      => new sfWidgetFormInput(),
      'ca_header_file'    => new sfWidgetFormInput(),
      'ca_content'        => new sfWidgetFormInput(),
      'ca_fchpublicado'   => new sfWidgetFormDateTime(),
      'ca_usupublicado'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idnovedad'      => new sfValidatorPropelChoice(array('model' => 'ColNovedad', 'column' => 'ca_idnovedad', 'required' => false)),
      'ca_fchpublicacion' => new sfValidatorDate(array('required' => false)),
      'ca_asunto'         => new sfValidatorString(array('required' => false)),
      'ca_detalle'        => new sfValidatorString(array('required' => false)),
      'ca_fcharchivar'    => new sfValidatorDate(array('required' => false)),
      'ca_extension'      => new sfValidatorString(array('required' => false)),
      'ca_header_file'    => new sfValidatorString(array('required' => false)),
      'ca_content'        => new sfValidatorPass(array('required' => false)),
      'ca_fchpublicado'   => new sfValidatorDateTime(array('required' => false)),
      'ca_usupublicado'   => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('col_novedad[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ColNovedad';
  }


}
