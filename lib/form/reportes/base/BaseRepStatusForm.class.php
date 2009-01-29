<?php

/**
 * RepStatus form base class.
 *
 * @package    colsys
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseRepStatusForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'ca_idreporte'        => new sfWidgetFormInputHidden(),
      'ca_idemail'          => new sfWidgetFormInputHidden(),
      'ca_fchstatus'        => new sfWidgetFormDate(),
      'ca_status'           => new sfWidgetFormInput(),
      'ca_comentarios'      => new sfWidgetFormInput(),
      'ca_fchrecibo'        => new sfWidgetFormDateTime(),
      'ca_fchenvio'         => new sfWidgetFormDateTime(),
      'ca_usuenvio'         => new sfWidgetFormInput(),
      'ca_etapa'            => new sfWidgetFormInput(),
      'ca_introduccion'     => new sfWidgetFormInput(),
      'ca_fchsalida'        => new sfWidgetFormDate(),
      'ca_fchllegada'       => new sfWidgetFormDate(),
      'ca_fchcontinuacion'  => new sfWidgetFormInput(),
      'ca_piezas'           => new sfWidgetFormInput(),
      'ca_peso'             => new sfWidgetFormInput(),
      'ca_volumen'          => new sfWidgetFormInput(),
      'ca_doctransporte'    => new sfWidgetFormInput(),
      'ca_idnave'           => new sfWidgetFormInput(),
      'ca_docmaster'        => new sfWidgetFormInput(),
      'ca_fchreserva'       => new sfWidgetFormDate(),
      'ca_fchcierrereserva' => new sfWidgetFormDate(),
      'ca_equipos'          => new sfWidgetFormInput(),
      'ca_horasalida'       => new sfWidgetFormTime(),
      'ca_horallegada'      => new sfWidgetFormTime(),
    ));

    $this->setValidators(array(
      'ca_idreporte'        => new sfValidatorPropelChoice(array('model' => 'Reporte', 'column' => 'ca_idreporte', 'required' => false)),
      'ca_idemail'          => new sfValidatorPropelChoice(array('model' => 'Email', 'column' => 'ca_idemail', 'required' => false)),
      'ca_fchstatus'        => new sfValidatorDate(array('required' => false)),
      'ca_status'           => new sfValidatorString(array('required' => false)),
      'ca_comentarios'      => new sfValidatorString(array('required' => false)),
      'ca_fchrecibo'        => new sfValidatorDateTime(array('required' => false)),
      'ca_fchenvio'         => new sfValidatorDateTime(array('required' => false)),
      'ca_usuenvio'         => new sfValidatorString(array('required' => false)),
      'ca_etapa'            => new sfValidatorString(array('required' => false)),
      'ca_introduccion'     => new sfValidatorString(array('required' => false)),
      'ca_fchsalida'        => new sfValidatorDate(array('required' => false)),
      'ca_fchllegada'       => new sfValidatorDate(array('required' => false)),
      'ca_fchcontinuacion'  => new sfValidatorString(array('required' => false)),
      'ca_piezas'           => new sfValidatorString(array('required' => false)),
      'ca_peso'             => new sfValidatorString(array('required' => false)),
      'ca_volumen'          => new sfValidatorString(array('required' => false)),
      'ca_doctransporte'    => new sfValidatorString(array('required' => false)),
      'ca_idnave'           => new sfValidatorString(array('required' => false)),
      'ca_docmaster'        => new sfValidatorString(array('required' => false)),
      'ca_fchreserva'       => new sfValidatorDate(array('required' => false)),
      'ca_fchcierrereserva' => new sfValidatorDate(array('required' => false)),
      'ca_equipos'          => new sfValidatorString(array('required' => false)),
      'ca_horasalida'       => new sfValidatorTime(array('required' => false)),
      'ca_horallegada'      => new sfValidatorTime(array('required' => false)),
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
