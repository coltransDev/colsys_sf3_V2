<?php

/**
 * ColNovedad form base class.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseColNovedadForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idnovedad'      => new sfWidgetFormInputHidden(),
      'ca_fchpublicacion' => new sfWidgetFormDate(),
      'ca_asunto'         => new sfWidgetFormTextarea(),
      'ca_detalle'        => new sfWidgetFormTextarea(),
      'ca_fcharchivar'    => new sfWidgetFormDate(),
      'ca_extension'      => new sfWidgetFormTextarea(),
      'ca_header_file'    => new sfWidgetFormTextarea(),
      'ca_content'        => new sfWidgetFormTextarea(),
      'ca_fchpublicado'   => new sfWidgetFormDateTime(),
      'ca_usupublicado'   => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idnovedad'      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idnovedad', 'required' => false)),
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

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ColNovedad';
  }

}
