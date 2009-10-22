<?php

/**
 * BaseHdeskKBaseCategory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idcategory
 * @property integer $ca_parent
 * @property string $ca_name
 * @property Doctrine_Collection $HdeskKBase
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6508 2009-10-14 06:28:49Z jwage $
 */
abstract class BaseHdeskKBaseCategory extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('helpdesk.tb_kbasecategory');
        $this->hasColumn('ca_idcategory', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_parent', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_name', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('HdeskKBase', array(
             'local' => 'ca_idcategory',
             'foreign' => 'ca_idcategory'));
    }
}