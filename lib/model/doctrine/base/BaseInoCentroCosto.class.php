<?php

/**
 * BaseInoCentroCosto
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idccosto
 * @property integer $ca_centro
 * @property integer $ca_subcentro
 * @property string $ca_nombre
 * @property Doctrine_Collection $InoTransaccion
 * @property Doctrine_Collection $InoConceptoParametro
 * 
 * @method integer             getCaIdccosto()           Returns the current record's "ca_idccosto" value
 * @method integer             getCaCentro()             Returns the current record's "ca_centro" value
 * @method integer             getCaSubcentro()          Returns the current record's "ca_subcentro" value
 * @method string              getCaNombre()             Returns the current record's "ca_nombre" value
 * @method Doctrine_Collection getInoTransaccion()       Returns the current record's "InoTransaccion" collection
 * @method Doctrine_Collection getInoConceptoParametro() Returns the current record's "InoConceptoParametro" collection
 * @method InoCentroCosto      setCaIdccosto()           Sets the current record's "ca_idccosto" value
 * @method InoCentroCosto      setCaCentro()             Sets the current record's "ca_centro" value
 * @method InoCentroCosto      setCaSubcentro()          Sets the current record's "ca_subcentro" value
 * @method InoCentroCosto      setCaNombre()             Sets the current record's "ca_nombre" value
 * @method InoCentroCosto      setInoTransaccion()       Sets the current record's "InoTransaccion" collection
 * @method InoCentroCosto      setInoConceptoParametro() Sets the current record's "InoConceptoParametro" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoCentroCosto extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ino.tb_ccostos');
        $this->hasColumn('ca_idccosto', 'integer', null, array(
             'type' => 'integer',
             'autoincrement' => true,
             'primary' => true,
             ));
        $this->hasColumn('ca_centro', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('ca_subcentro', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_nombre', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('InoTransaccion', array(
             'local' => 'ca_idccosto',
             'foreign' => 'ca_idccosto'));

        $this->hasMany('InoConceptoParametro', array(
             'local' => 'ca_idccosto',
             'foreign' => 'ca_idccosto'));
    }
}