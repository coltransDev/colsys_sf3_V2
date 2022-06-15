<?php

/**
 * BaseResultadoEncuesta
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_id
 * @property integer $ca_idpregunta
 * @property integer $ca_servicio
 * @property string $ca_resultado
 * @property integer $ca_idcontrolencuesta
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property Pregunta $Pregunta
 * @property ControlEncuesta $ControlEncuesta
 * @property ViControlEncuesta $ViControlEncuesta
 * @property Doctrine_Collection $ColsysConfigValue
 * 
 * @method integer             getCaId()                 Returns the current record's "ca_id" value
 * @method integer             getCaIdpregunta()         Returns the current record's "ca_idpregunta" value
 * @method integer             getCaServicio()           Returns the current record's "ca_servicio" value
 * @method string              getCaResultado()          Returns the current record's "ca_resultado" value
 * @method integer             getCaIdcontrolencuesta()  Returns the current record's "ca_idcontrolencuesta" value
 * @method timestamp           getCaFchcreado()          Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsucreado()          Returns the current record's "ca_usucreado" value
 * @method Pregunta            getPregunta()             Returns the current record's "Pregunta" value
 * @method ControlEncuesta     getControlEncuesta()      Returns the current record's "ControlEncuesta" value
 * @method ViControlEncuesta   getViControlEncuesta()    Returns the current record's "ViControlEncuesta" value
 * @method Doctrine_Collection getColsysConfigValue()    Returns the current record's "ColsysConfigValue" collection
 * @method ResultadoEncuesta   setCaId()                 Sets the current record's "ca_id" value
 * @method ResultadoEncuesta   setCaIdpregunta()         Sets the current record's "ca_idpregunta" value
 * @method ResultadoEncuesta   setCaServicio()           Sets the current record's "ca_servicio" value
 * @method ResultadoEncuesta   setCaResultado()          Sets the current record's "ca_resultado" value
 * @method ResultadoEncuesta   setCaIdcontrolencuesta()  Sets the current record's "ca_idcontrolencuesta" value
 * @method ResultadoEncuesta   setCaFchcreado()          Sets the current record's "ca_fchcreado" value
 * @method ResultadoEncuesta   setCaUsucreado()          Sets the current record's "ca_usucreado" value
 * @method ResultadoEncuesta   setPregunta()             Sets the current record's "Pregunta" value
 * @method ResultadoEncuesta   setControlEncuesta()      Sets the current record's "ControlEncuesta" value
 * @method ResultadoEncuesta   setViControlEncuesta()    Sets the current record's "ViControlEncuesta" value
 * @method ResultadoEncuesta   setColsysConfigValue()    Sets the current record's "ColsysConfigValue" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseResultadoEncuesta extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('encuestas.tb_resultado_encuesta');
        $this->hasColumn('ca_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('ca_idpregunta', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => '4',
             ));
        $this->hasColumn('ca_servicio', 'integer', 1, array(
             'type' => 'integer',
             'length' => '1',
             ));
        $this->hasColumn('ca_resultado', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             ));
        $this->hasColumn('ca_idcontrolencuesta', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => '4',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usucreado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));


        $this->index('fki_tb_resultado_encuesta_tb_pregunta', array(
             'fields' => 
             array(
              0 => 'ca_idpregunta',
             ),
             ));
        $this->index('fki_tb_resultado_encuesta_tb_control_encuesta', array(
             'fields' => 
             array(
              0 => 'ca_idcontrolencuesta',
             ),
             ));
        $this->option('form', false);
        $this->option('filter', false);
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Pregunta', array(
             'local' => 'ca_idpregunta',
             'foreign' => 'ca_id'));

        $this->hasOne('ControlEncuesta', array(
             'local' => 'ca_idcontrolencuesta',
             'foreign' => 'ca_id'));

        $this->hasOne('ViControlEncuesta', array(
             'local' => 'ca_idcontrolencuesta',
             'foreign' => 'ca_id'));

        $this->hasMany('ColsysConfigValue', array(
             'local' => 'ca_servicio',
             'foreign' => 'ca_ident'));
    }
}