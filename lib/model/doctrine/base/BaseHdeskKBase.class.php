<?php

/**
 * BaseHdeskKBase
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idkbase
 * @property string $ca_idcategory
 * @property string $ca_login
 * @property timestamp $ca_createdat
 * @property string $ca_text
 * @property string $ca_title
 * @property boolean $ca_private
 * @property HdeskKBaseCategory $HdeskKBaseCategory
 * 
 * @method integer            getCaIdkbase()          Returns the current record's "ca_idkbase" value
 * @method string             getCaIdcategory()       Returns the current record's "ca_idcategory" value
 * @method string             getCaLogin()            Returns the current record's "ca_login" value
 * @method timestamp          getCaCreatedat()        Returns the current record's "ca_createdat" value
 * @method string             getCaText()             Returns the current record's "ca_text" value
 * @method string             getCaTitle()            Returns the current record's "ca_title" value
 * @method boolean            getCaPrivate()          Returns the current record's "ca_private" value
 * @method HdeskKBaseCategory getHdeskKBaseCategory() Returns the current record's "HdeskKBaseCategory" value
 * @method HdeskKBase         setCaIdkbase()          Sets the current record's "ca_idkbase" value
 * @method HdeskKBase         setCaIdcategory()       Sets the current record's "ca_idcategory" value
 * @method HdeskKBase         setCaLogin()            Sets the current record's "ca_login" value
 * @method HdeskKBase         setCaCreatedat()        Sets the current record's "ca_createdat" value
 * @method HdeskKBase         setCaText()             Sets the current record's "ca_text" value
 * @method HdeskKBase         setCaTitle()            Sets the current record's "ca_title" value
 * @method HdeskKBase         setCaPrivate()          Sets the current record's "ca_private" value
 * @method HdeskKBase         setHdeskKBaseCategory() Sets the current record's "HdeskKBaseCategory" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseHdeskKBase extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('helpdesk.tb_kbase');
        $this->hasColumn('ca_idkbase', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idcategory', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_login', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_createdat', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_text', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_title', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_private', 'boolean', null, array(
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
        $this->hasOne('HdeskKBaseCategory', array(
             'local' => 'ca_idcategory',
             'foreign' => 'ca_idcategory'));
    }
}