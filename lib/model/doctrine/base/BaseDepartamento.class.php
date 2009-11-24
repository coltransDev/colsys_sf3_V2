<?php

/**
 * BaseDepartamento
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_iddepartamento
 * @property string $ca_nombre
 * @property boolean $ca_inhelpdesk
 * @property Doctrine_Collection $HdeskGroup
 * 
 * @method integer             getCaIddepartamento()  Returns the current record's "ca_iddepartamento" value
 * @method string              getCaNombre()          Returns the current record's "ca_nombre" value
 * @method boolean             getCaInhelpdesk()      Returns the current record's "ca_inhelpdesk" value
 * @method Doctrine_Collection getHdeskGroup()        Returns the current record's "HdeskGroup" collection
 * @method Departamento        setCaIddepartamento()  Sets the current record's "ca_iddepartamento" value
 * @method Departamento        setCaNombre()          Sets the current record's "ca_nombre" value
 * @method Departamento        setCaInhelpdesk()      Sets the current record's "ca_inhelpdesk" value
 * @method Departamento        setHdeskGroup()        Sets the current record's "HdeskGroup" collection
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6716 2009-11-12 19:26:28Z jwage $
 */
abstract class BaseDepartamento extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('control.tb_departamentos');
        $this->hasColumn('ca_iddepartamento', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_nombre', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('ca_inhelpdesk', 'boolean', null, array(
             'type' => 'boolean',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('HdeskGroup', array(
             'local' => 'ca_iddepartamento',
             'foreign' => 'ca_iddepartament'));
    }
}