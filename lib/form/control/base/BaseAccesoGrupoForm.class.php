<?php

/**
 * AccesoGrupo form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseAccesoGrupoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_rutina' => new sfWidgetFormInputHidden(),
      'ca_grupo'  => new sfWidgetFormInputHidden(),
      'ca_acceso' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_rutina' => new sfValidatorPropelChoice(array('model' => 'AccesoGrupo', 'column' => 'ca_rutina', 'required' => false)),
      'ca_grupo'  => new sfValidatorPropelChoice(array('model' => 'AccesoGrupo', 'column' => 'ca_grupo', 'required' => false)),
      'ca_acceso' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('acceso_grupo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccesoGrupo';
  }


}
