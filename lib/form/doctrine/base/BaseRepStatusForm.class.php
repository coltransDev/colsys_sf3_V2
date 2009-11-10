<?php

/**
 * RepStatus form base class.
 *
 * @method RepStatus getObject() Returns the current form's model object
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BaseRepStatusForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idstatus'        => new sfWidgetFormInputHidden(),
      'ca_idreporte'       => new sfWidgetFormDoctrineChoice(array('model' => 'Reporte', 'add_empty' => true)),
      'ca_idemail'         => new sfWidgetFormDoctrineChoice(array('model' => 'Email', 'add_empty' => true)),
      'ca_fchstatus'       => new sfWidgetFormDate(),
      'ca_status'          => new sfWidgetFormTextarea(),
      'ca_comentarios'     => new sfWidgetFormTextarea(),
      'ca_fchrecibo'       => new sfWidgetFormDateTime(),
      'ca_fchenvio'        => new sfWidgetFormDateTime(),
      'ca_usuenvio'        => new sfWidgetFormTextarea(),
      'ca_introduccion'    => new sfWidgetFormTextarea(),
      'ca_fchsalida'       => new sfWidgetFormDate(),
      'ca_fchllegada'      => new sfWidgetFormDate(),
      'ca_fchcontinuacion' => new sfWidgetFormDate(),
      'ca_piezas'          => new sfWidgetFormTextarea(),
      'ca_peso'            => new sfWidgetFormTextarea(),
      'ca_volumen'         => new sfWidgetFormTextarea(),
      'ca_doctransporte'   => new sfWidgetFormTextarea(),
      'ca_idnave'          => new sfWidgetFormTextarea(),
      'ca_docmaster'       => new sfWidgetFormTextarea(),
      'ca_equipos'         => new sfWidgetFormTextarea(),
      'ca_horasalida'      => new sfWidgetFormTextarea(),
      'ca_horallegada'     => new sfWidgetFormTextarea(),
      'ca_idetapa'         => new sfWidgetFormDoctrineChoice(array('model' => 'TrackingEtapa', 'add_empty' => true)),
      'ca_propiedades'     => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ca_idstatus'        => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ca_idstatus', 'required' => false)),
      'ca_idreporte'       => new sfValidatorDoctrineChoice(array('model' => 'Reporte', 'required' => false)),
      'ca_idemail'         => new sfValidatorDoctrineChoice(array('model' => 'Email', 'required' => false)),
      'ca_fchstatus'       => new sfValidatorDate(array('required' => false)),
      'ca_status'          => new sfValidatorString(array('required' => false)),
      'ca_comentarios'     => new sfValidatorString(array('required' => false)),
      'ca_fchrecibo'       => new sfValidatorDateTime(array('required' => false)),
      'ca_fchenvio'        => new sfValidatorDateTime(array('required' => false)),
      'ca_usuenvio'        => new sfValidatorString(array('required' => false)),
      'ca_introduccion'    => new sfValidatorString(array('required' => false)),
      'ca_fchsalida'       => new sfValidatorDate(array('required' => false)),
      'ca_fchllegada'      => new sfValidatorDate(array('required' => false)),
      'ca_fchcontinuacion' => new sfValidatorDate(array('required' => false)),
      'ca_piezas'          => new sfValidatorString(array('required' => false)),
      'ca_peso'            => new sfValidatorString(array('required' => false)),
      'ca_volumen'         => new sfValidatorString(array('required' => false)),
      'ca_doctransporte'   => new sfValidatorString(array('required' => false)),
      'ca_idnave'          => new sfValidatorString(array('required' => false)),
      'ca_docmaster'       => new sfValidatorString(array('required' => false)),
      'ca_equipos'         => new sfValidatorString(array('required' => false)),
      'ca_horasalida'      => new sfValidatorString(array('required' => false)),
      'ca_horallegada'     => new sfValidatorString(array('required' => false)),
      'ca_idetapa'         => new sfValidatorDoctrineChoice(array('model' => 'TrackingEtapa', 'required' => false)),
      'ca_propiedades'     => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rep_status[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepStatus';
  }

}
