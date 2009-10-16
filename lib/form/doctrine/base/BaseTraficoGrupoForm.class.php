<?php

/**
 * TraficoGrupo form base class.
 *
 * @package    form
 * @subpackage trafico_grupo
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseTraficoGrupoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idgrupo'     => new sfWidgetFormInputHidden(),
      'ca_descripcion' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idgrupo'     => new sfValidatorDoctrineChoice(array('model' => 'TraficoGrupo', 'column' => 'ca_idgrupo', 'required' => false)),
      'ca_descripcion' => new sfValidatorString(array('max_length' => 40)),
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