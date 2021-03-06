<?php

/**
 * BaseSurvCriterio
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idcriterio
 * @property integer $ca_idtipo
 * @property string $ca_criterio
 * @property integer $ca_ponderacion
 * @property string $ca_tipocriterio
 * @property boolean $ca_activo
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property Doctrine_Collection $SurvEvaluacionxCriterio
 * @property SurvTipo $SurvTipo
 * 
 * @method integer             getCaIdcriterio()            Returns the current record's "ca_idcriterio" value
 * @method integer             getCaIdtipo()                Returns the current record's "ca_idtipo" value
 * @method string              getCaCriterio()              Returns the current record's "ca_criterio" value
 * @method integer             getCaPonderacion()           Returns the current record's "ca_ponderacion" value
 * @method string              getCaTipocriterio()          Returns the current record's "ca_tipocriterio" value
 * @method boolean             getCaActivo()                Returns the current record's "ca_activo" value
 * @method string              getCaUsucreado()             Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchcreado()             Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsuactualizado()        Returns the current record's "ca_usuactualizado" value
 * @method timestamp           getCaFchactualizado()        Returns the current record's "ca_fchactualizado" value
 * @method Doctrine_Collection getSurvEvaluacionxCriterio() Returns the current record's "SurvEvaluacionxCriterio" collection
 * @method SurvTipo            getSurvTipo()                Returns the current record's "SurvTipo" value
 * @method SurvCriterio        setCaIdcriterio()            Sets the current record's "ca_idcriterio" value
 * @method SurvCriterio        setCaIdtipo()                Sets the current record's "ca_idtipo" value
 * @method SurvCriterio        setCaCriterio()              Sets the current record's "ca_criterio" value
 * @method SurvCriterio        setCaPonderacion()           Sets the current record's "ca_ponderacion" value
 * @method SurvCriterio        setCaTipocriterio()          Sets the current record's "ca_tipocriterio" value
 * @method SurvCriterio        setCaActivo()                Sets the current record's "ca_activo" value
 * @method SurvCriterio        setCaUsucreado()             Sets the current record's "ca_usucreado" value
 * @method SurvCriterio        setCaFchcreado()             Sets the current record's "ca_fchcreado" value
 * @method SurvCriterio        setCaUsuactualizado()        Sets the current record's "ca_usuactualizado" value
 * @method SurvCriterio        setCaFchactualizado()        Sets the current record's "ca_fchactualizado" value
 * @method SurvCriterio        setSurvEvaluacionxCriterio() Sets the current record's "SurvEvaluacionxCriterio" collection
 * @method SurvCriterio        setSurvTipo()                Sets the current record's "SurvTipo" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseSurvCriterio extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('survey.tb_criterios');
        $this->hasColumn('ca_idcriterio', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idtipo', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_criterio', 'string', 60, array(
             'type' => 'string',
             'length' => '60',
             ));
        $this->hasColumn('ca_ponderacion', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('ca_tipocriterio', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('ca_activo', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_usucreado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuactualizado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fchactualizado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('SurvEvaluacionxCriterio', array(
             'local' => 'ca_idcriterio',
             'foreign' => 'ca_idcriterio'));

        $this->hasOne('SurvTipo', array(
             'local' => 'ca_idtipo',
             'foreign' => 'ca_idtipo'));
    }
}