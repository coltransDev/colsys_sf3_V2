<?php

/**
 * BaseHdeskUserGroup
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idgroup
 * @property string $ca_login
 * @property HdeskGroup $HdeskGroup
 * @property Usuario $Usuario
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6365 2009-09-15 18:22:38Z jwage $
 */
abstract class BaseHdeskUserGroup extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('helpdesk.tb_usersgroups');
        $this->hasColumn('ca_idgroup', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_login', 'string', 20, array(
             'type' => 'string',
             'primary' => true,
             'length' => '20',
             ));
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasOne('HdeskGroup', array(
             'local' => 'ca_idgroup',
             'foreign' => 'ca_idgroup'));

        $this->hasOne('Usuario', array(
             'local' => 'ca_login',
             'foreign' => 'ca_login'));
    }
}