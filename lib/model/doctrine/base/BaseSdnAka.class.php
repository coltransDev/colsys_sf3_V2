<?php

/**
 * BaseSdnAka
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_uid
 * @property integer $ca_uid_aka
 * @property string $ca_type
 * @property string $ca_category
 * @property string $ca_firstName
 * @property string $ca_lastName
 * @property Sdn $Sdn
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6508 2009-10-14 06:28:49Z jwage $
 */
abstract class BaseSdnAka extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_sdnaka');
        $this->hasColumn('ca_uid', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_uid_aka', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_type', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_category', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_firstName', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_lastName', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Sdn', array(
             'local' => 'ca_uid',
             'foreign' => 'ca_uid'));
    }
}