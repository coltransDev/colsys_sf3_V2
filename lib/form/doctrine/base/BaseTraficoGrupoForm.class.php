<?php

/**
 * TraficoGrupo form base class.
 *
 * @method TraficoGrupo getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseTraficoGrupoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idgrupo'     => new sfWidgetFormInputHidden(),
      'ca_descripcion' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_idgrupo'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idgrupo', 'required' => false)),
      'ca_descripcion' => new sfValidatorString(array('max_length' => 40)),
    ));

    $this->widgetSchema->setNameFormat('trafico_grupo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TraficoGrupo';
  }

}
