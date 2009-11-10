<?php

/**
 * Trafico form base class.
 *
 * @method Trafico getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseTraficoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idtrafico' => new sfWidgetFormInputHidden(),
      'ca_nombre'    => new sfWidgetFormInputText(),
      'ca_bandera'   => new sfWidgetFormInputText(),
      'ca_idmoneda'  => new sfWidgetFormDoctrineChoice(array('model' => 'Moneda', 'add_empty' => false)),
      'ca_idgrupo'   => new sfWidgetFormDoctrineChoice(array('model' => 'TraficoGrupo', 'add_empty' => false)),
      'ca_link'      => new sfWidgetFormTextarea(),
      'ca_conceptos' => new sfWidgetFormInputText(),
      'ca_recargos'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ca_idtrafico' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idtrafico', 'required' => false)),
      'ca_nombre'    => new sfValidatorString(array('max_length' => 40)),
      'ca_bandera'   => new sfValidatorString(array('max_length' => 30)),
      'ca_idmoneda'  => new sfValidatorDoctrineChoice(array('model' => 'Moneda')),
      'ca_idgrupo'   => new sfValidatorDoctrineChoice(array('model' => 'TraficoGrupo')),
      'ca_link'      => new sfValidatorString(array('max_length' => 256, 'required' => false)),
      'ca_conceptos' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ca_recargos'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('trafico[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Trafico';
  }

}
