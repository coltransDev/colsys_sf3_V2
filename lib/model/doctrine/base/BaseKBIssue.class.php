<?php

/**
 * BaseKBIssue
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idissue
 * @property integer $ca_idcategory
 * @property string $ca_title
 * @property string $ca_info
 * @property string $ca_summary
 * @property integer $ca_level
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property KBCategory $KBCategory
 * @property Doctrine_Collection $HdeskResponse
 * 
 * @method integer             getCaIdissue()         Returns the current record's "ca_idissue" value
 * @method integer             getCaIdcategory()      Returns the current record's "ca_idcategory" value
 * @method string              getCaTitle()           Returns the current record's "ca_title" value
 * @method string              getCaInfo()            Returns the current record's "ca_info" value
 * @method string              getCaSummary()         Returns the current record's "ca_summary" value
 * @method integer             getCaLevel()           Returns the current record's "ca_level" value
 * @method timestamp           getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method string              getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method KBCategory          getKBCategory()        Returns the current record's "KBCategory" value
 * @method Doctrine_Collection getHdeskResponse()     Returns the current record's "HdeskResponse" collection
 * @method KBIssue             setCaIdissue()         Sets the current record's "ca_idissue" value
 * @method KBIssue             setCaIdcategory()      Sets the current record's "ca_idcategory" value
 * @method KBIssue             setCaTitle()           Sets the current record's "ca_title" value
 * @method KBIssue             setCaInfo()            Sets the current record's "ca_info" value
 * @method KBIssue             setCaSummary()         Sets the current record's "ca_summary" value
 * @method KBIssue             setCaLevel()           Sets the current record's "ca_level" value
 * @method KBIssue             setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method KBIssue             setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method KBIssue             setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method KBIssue             setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method KBIssue             setKBCategory()        Sets the current record's "KBCategory" value
 * @method KBIssue             setHdeskResponse()     Sets the current record's "HdeskResponse" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseKBIssue extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('helpdesk.tb_kbissues');
        $this->hasColumn('ca_idissue', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idcategory', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_title', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_info', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_summary', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_level', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usucreado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchactualizado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuactualizado', 'string', null, array(
             'type' => 'string',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('KBCategory', array(
             'local' => 'ca_idcategory',
             'foreign' => 'ca_idcategory'));

        $this->hasMany('HdeskResponse', array(
             'local' => 'ca_idissue',
             'foreign' => 'ca_idissue'));
    }
}