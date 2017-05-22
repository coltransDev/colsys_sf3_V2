<?php

/**
 * Noticia form base class.
 *
 * @method Noticia getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseNoticiaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idnoticia'      => new sfWidgetFormInputHidden(),
      'ca_categoria'      => new sfWidgetFormInputText(),
      'ca_fchpublicacion' => new sfWidgetFormDate(),
      'ca_asunto'         => new sfWidgetFormTextarea(),
      'ca_detalle'        => new sfWidgetFormTextarea(),
      'ca_fcharchivar'    => new sfWidgetFormDate(),
      'ca_extension'      => new sfWidgetFormTextarea(),
      'ca_header_file'    => new sfWidgetFormTextarea(),
      'ca_content'        => new sfWidgetFormTextarea(),
      'ca_fchcreado'      => new sfWidgetFormDateTime(),
      'ca_usucreado'      => new sfWidgetFormTextarea(),
      'ca_icon'           => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idnoticia'      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idnoticia', 'required' => false)),
      'ca_categoria'      => new sfValidatorString(array('max_length' => 12, 'required' => false)),
      'ca_fchpublicacion' => new sfValidatorDate(array('required' => false)),
      'ca_asunto'         => new sfValidatorString(array('required' => false)),
      'ca_detalle'        => new sfValidatorString(array('required' => false)),
      'ca_fcharchivar'    => new sfValidatorDate(array('required' => false)),
      'ca_extension'      => new sfValidatorString(array('required' => false)),
      'ca_header_file'    => new sfValidatorString(array('required' => false)),
      'ca_content'        => new sfValidatorString(array('required' => false)),
      'ca_fchcreado'      => new sfValidatorDateTime(array('required' => false)),
      'ca_usucreado'      => new sfValidatorString(array('required' => false)),
      'ca_icon'           => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('noticia[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Noticia';
  }

}
