<?php

/**
 * BaseHdeskMilestone
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idmilestone
 * @property integer $ca_idproject
 * @property string $ca_title
 * @property string $ca_text
 * @property date $ca_due
 * @property date $ca_end
 * @property HdeskProject $HdeskProject
 * @property Doctrine_Collection $HdeskTicket
 * 
 * @method integer             getCaIdmilestone()  Returns the current record's "ca_idmilestone" value
 * @method integer             getCaIdproject()    Returns the current record's "ca_idproject" value
 * @method string              getCaTitle()        Returns the current record's "ca_title" value
 * @method string              getCaText()         Returns the current record's "ca_text" value
 * @method date                getCaDue()          Returns the current record's "ca_due" value
 * @method date                getCaEnd()          Returns the current record's "ca_end" value
 * @method HdeskProject        getHdeskProject()   Returns the current record's "HdeskProject" value
 * @method Doctrine_Collection getHdeskTicket()    Returns the current record's "HdeskTicket" collection
 * @method HdeskMilestone      setCaIdmilestone()  Sets the current record's "ca_idmilestone" value
 * @method HdeskMilestone      setCaIdproject()    Sets the current record's "ca_idproject" value
 * @method HdeskMilestone      setCaTitle()        Sets the current record's "ca_title" value
 * @method HdeskMilestone      setCaText()         Sets the current record's "ca_text" value
 * @method HdeskMilestone      setCaDue()          Sets the current record's "ca_due" value
 * @method HdeskMilestone      setCaEnd()          Sets the current record's "ca_end" value
 * @method HdeskMilestone      setHdeskProject()   Sets the current record's "HdeskProject" value
 * @method HdeskMilestone      setHdeskTicket()    Sets the current record's "HdeskTicket" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseHdeskMilestone extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('helpdesk.tb_milestones');
        $this->hasColumn('ca_idmilestone', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idproject', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_title', 'string', 25, array(
             'type' => 'string',
             'length' => '25',
             ));
        $this->hasColumn('ca_text', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('ca_due', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_end', 'date', null, array(
             'type' => 'date',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('HdeskProject', array(
             'local' => 'ca_idproject',
             'foreign' => 'ca_idproject'));

        $this->hasMany('HdeskTicket', array(
             'local' => 'ca_idmilestone',
             'foreign' => 'ca_idmilestone'));
    }
}