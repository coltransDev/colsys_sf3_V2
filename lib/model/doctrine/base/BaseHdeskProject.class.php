<?php

/**
 * BaseHdeskProject
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idproject
 * @property integer $ca_idgroup
 * @property string $ca_name
 * @property string $ca_description
 * @property boolean $ca_active
 * @property Doctrine_Collection $HdeskGroup
 * @property Doctrine_Collection $HdeskTicket
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6508 2009-10-14 06:28:49Z jwage $
 */
abstract class BaseHdeskProject extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('helpdesk.tb_projects');
        $this->hasColumn('ca_idproject', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idgroup', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_name', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_description', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_active', 'boolean', null, array(
             'type' => 'boolean',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('HdeskGroup', array(
             'local' => 'ca_idgroup',
             'foreign' => 'ca_idgroup'));

        $this->hasMany('HdeskTicket', array(
             'local' => 'ca_idproject',
             'foreign' => 'ca_idproject'));
    }
}