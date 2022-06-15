<?php

/**
 * BaseSurvTipo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idtipo
 * @property string $ca_nombre
 * @property Doctrine_Collection $SurvEvaluacion
 * @property Doctrine_Collection $SurvCriterio
 * @property Doctrine_Collection $HdeskGroup
 * 
 * @method integer             getCaIdtipo()       Returns the current record's "ca_idtipo" value
 * @method string              getCaNombre()       Returns the current record's "ca_nombre" value
 * @method Doctrine_Collection getSurvEvaluacion() Returns the current record's "SurvEvaluacion" collection
 * @method Doctrine_Collection getSurvCriterio()   Returns the current record's "SurvCriterio" collection
 * @method Doctrine_Collection getHdeskGroup()     Returns the current record's "HdeskGroup" collection
 * @method SurvTipo            setCaIdtipo()       Sets the current record's "ca_idtipo" value
 * @method SurvTipo            setCaNombre()       Sets the current record's "ca_nombre" value
 * @method SurvTipo            setSurvEvaluacion() Sets the current record's "SurvEvaluacion" collection
 * @method SurvTipo            setSurvCriterio()   Sets the current record's "SurvCriterio" collection
 * @method SurvTipo            setHdeskGroup()     Sets the current record's "HdeskGroup" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseSurvTipo extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('survey.tb_tipos');
        $this->hasColumn('ca_idtipo', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_nombre', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('SurvEvaluacion', array(
             'local' => 'ca_idtipo',
             'foreign' => 'ca_idtipo'));

        $this->hasMany('SurvCriterio', array(
             'local' => 'ca_idtipo',
             'foreign' => 'ca_idtipo'));

        $this->hasMany('HdeskGroup', array(
             'local' => 'ca_idtipo',
             'foreign' => 'ca_idtipo'));
    }
}