<?php

/**
 * BaseControlEncuesta
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_id
 * @property integer $ca_idformulario
 * @property integer $ca_idempresa
 * @property integer $ca_tipo_contestador
 * @property integer $ca_id_contestador
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property text $ca_datos
 * @property Formulario $Formulario
 * @property Empresa $Empresa
 * @property Doctrine_Collection $ResultadoEncuesta
 * 
 * @method integer             getCaId()                Returns the current record's "ca_id" value
 * @method integer             getCaIdformulario()      Returns the current record's "ca_idformulario" value
 * @method integer             getCaIdempresa()         Returns the current record's "ca_idempresa" value
 * @method integer             getCaTipoContestador()   Returns the current record's "ca_tipo_contestador" value
 * @method integer             getCaIdContestador()     Returns the current record's "ca_id_contestador" value
 * @method timestamp           getCaFchcreado()         Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsucreado()         Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchactualizado()    Returns the current record's "ca_fchactualizado" value
 * @method string              getCaUsuactualizado()    Returns the current record's "ca_usuactualizado" value
 * @method text                getCaDatos()             Returns the current record's "ca_datos" value
 * @method Formulario          getFormulario()          Returns the current record's "Formulario" value
 * @method Empresa             getEmpresa()             Returns the current record's "Empresa" value
 * @method Doctrine_Collection getResultadoEncuesta()   Returns the current record's "ResultadoEncuesta" collection
 * @method ControlEncuesta     setCaId()                Sets the current record's "ca_id" value
 * @method ControlEncuesta     setCaIdformulario()      Sets the current record's "ca_idformulario" value
 * @method ControlEncuesta     setCaIdempresa()         Sets the current record's "ca_idempresa" value
 * @method ControlEncuesta     setCaTipoContestador()   Sets the current record's "ca_tipo_contestador" value
 * @method ControlEncuesta     setCaIdContestador()     Sets the current record's "ca_id_contestador" value
 * @method ControlEncuesta     setCaFchcreado()         Sets the current record's "ca_fchcreado" value
 * @method ControlEncuesta     setCaUsucreado()         Sets the current record's "ca_usucreado" value
 * @method ControlEncuesta     setCaFchactualizado()    Sets the current record's "ca_fchactualizado" value
 * @method ControlEncuesta     setCaUsuactualizado()    Sets the current record's "ca_usuactualizado" value
 * @method ControlEncuesta     setCaDatos()             Sets the current record's "ca_datos" value
 * @method ControlEncuesta     setFormulario()          Sets the current record's "Formulario" value
 * @method ControlEncuesta     setEmpresa()             Sets the current record's "Empresa" value
 * @method ControlEncuesta     setResultadoEncuesta()   Sets the current record's "ResultadoEncuesta" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseControlEncuesta extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('encuestas.tb_control_encuesta');
        $this->hasColumn('ca_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('ca_idformulario', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => '4',
             ));
        $this->hasColumn('ca_idempresa', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => '4',
             ));
        $this->hasColumn('ca_tipo_contestador', 'integer', 1, array(
             'type' => 'integer',
             'length' => '1',
             ));
        $this->hasColumn('ca_id_contestador', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usucreado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fchactualizado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuactualizado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_datos', 'text', null, array(
             'type' => 'text',
             ));


        $this->index('fki_tb_control_encuesta_tb_formulario', array(
             'fields' => 
             array(
              0 => 'ca_idformulario',
             ),
             ));
        $this->index('fki_tb_control_encuesta_tb_empresa', array(
             'fields' => 
             array(
              0 => 'tb_idempresa',
             ),
             ));
        $this->option('form', false);
        $this->option('filter', false);
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Formulario', array(
             'local' => 'ca_idformulario',
             'foreign' => 'ca_id'));

        $this->hasOne('Empresa', array(
             'local' => 'ca_idempresa',
             'foreign' => 'ca_idempresa'));

        $this->hasMany('ResultadoEncuesta', array(
             'local' => 'ca_id',
             'foreign' => 'ca_idcontrolencuesta'));
    }
}