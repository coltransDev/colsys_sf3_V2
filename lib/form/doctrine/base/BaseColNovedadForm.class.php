<?php

/**
 * ColNovedad form base class.
 *
 * @package    form
 * @subpackage col_novedad
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseColNovedadForm extends BaseFormDoctrine
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
      'ca_idnovedad'      => new sfValidatorDoctrineChoice(array('model' => 'ColNovedad', 'column' => 'ca_idnovedad', 'required' => false)),
      'ca_fchpublicacion' => new sfValidatorDate(array('required' => false)),
      'ca_asunto'         => new sfValidatorString(array('required' => false)),
      'ca_detalle'        => new sfValidatorString(array('required' => false)),
      'ca_fcharchivar'    => new sfValidatorDate(array('required' => false)),
      'ca_extension'      => new sfValidatorString(array('required' => false)),
      'ca_header_file'    => new sfValidatorString(array('required' => false)),
      'ca_content'        => new sfValidatorString(array('required' => false)),
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