<?php

/**
 * RepStatus form base class.
 *
 * @package    form
 * @subpackage rep_status
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseRepStatusForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idstatus'        => new sfWidgetFormInputHidden(),
      'ca_idreporte'       => new sfWidgetFormDoctrineSelect(array('model' => 'Reporte', 'add_empty' => true)),
      'ca_idemail'         => new sfWidgetFormDoctrineSelect(array('model' => 'Email', 'add_empty' => true)),
      'ca_fchstatus'       => new sfWidgetFormDate(),
      'ca_status'          => new sfWidgetFormInput(),
      'ca_comentarios'     => new sfWidgetFormInput(),
      'ca_fchrecibo'       => new sfWidgetFormDateTime(),
      'ca_fchenvio'        => new sfWidgetFormDateTime(),
      'ca_usuenvio'        => new sfWidgetFormInput(),
      'ca_introduccion'    => new sfWidgetFormInput(),
      'ca_fchsalida'       => new sfWidgetFormDate(),
      'ca_fchllegada'      => new sfWidgetFormDate(),
      'ca_fchcontinuacion' => new sfWidgetFormDate(),
      'ca_piezas'          => new sfWidgetFormInput(),
      'ca_peso'            => new sfWidgetFormInput(),
      'ca_volumen'         => new sfWidgetFormInput(),
      'ca_doctransporte'   => new sfWidgetFormInput(),
      'ca_idnave'          => new sfWidgetFormInput(),
      'ca_docmaster'       => new sfWidgetFormInput(),
      'ca_equipos'         => new sfWidgetFormInput(),
      'ca_horasalida'      => new sfWidgetFormInput(),
      'ca_horallegada'     => new sfWidgetFormInput(),
      'ca_idetapa'         => new sfWidgetFormDoctrineSelect(array('model' => 'TrackingEtapa', 'add_empty' => true)),
      'ca_propiedades'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'ca_idstatus'        => new sfValidatorDoctrineChoice(array('model' => 'RepStatus', 'column' => 'ca_idstatus', 'required' => false)),
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

    parent::setup();
  }

  public function getModelName()
  {
    return 'RepStatus';
  }

}