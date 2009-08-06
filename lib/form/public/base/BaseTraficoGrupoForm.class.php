<?php

/**
 * TraficoGrupo form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseTraficoGrupoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idgrupo'     => new sfWidgetFormInputHidden(),
      'ca_descripcion' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idgrupo'     => new sfValidatorPropelChoice(array('model' => 'TraficoGrupo', 'column' => 'ca_idgrupo', 'required' => false)),
      'ca_descripcion' => new sfValidatorString(array('max_length' => 40, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('trafico_grupo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TraficoGrupo';
  }


}
