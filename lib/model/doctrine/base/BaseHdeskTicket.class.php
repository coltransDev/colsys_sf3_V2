<?php

/**
 * BaseHdeskTicket
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idticket
 * @property integer $ca_idgroup
 * @property integer $ca_idproject
 * @property string $ca_login
 * @property string $ca_title
 * @property string $ca_text
 * @property string $ca_priority
 * @property timestamp $ca_opened
 * @property string $ca_type
 * @property string $ca_assignedto
 * @property string $ca_action
 * @property timestamp $ca_responsetime
 * @property integer $ca_idtarea
 * @property integer $ca_idseguimiento
 * @property integer $ca_order
 * @property integer $ca_estimatedhours
 * @property integer $ca_percentage
 * @property Doctrine_Collection $HdeskResponse
 * @property HdeskGroup $HdeskGroup
 * @property HdeskProject $HdeskProject
 * @property Doctrine_Collection $HdeskTicketUser
 * @property NotTarea $NotTarea
 * @property Usuario $Usuario
 * 
 * @method integer             getCaIdticket()        Returns the current record's "ca_idticket" value
 * @method integer             getCaIdgroup()         Returns the current record's "ca_idgroup" value
 * @method integer             getCaIdproject()       Returns the current record's "ca_idproject" value
 * @method string              getCaLogin()           Returns the current record's "ca_login" value
 * @method string              getCaTitle()           Returns the current record's "ca_title" value
 * @method string              getCaText()            Returns the current record's "ca_text" value
 * @method string              getCaPriority()        Returns the current record's "ca_priority" value
 * @method timestamp           getCaOpened()          Returns the current record's "ca_opened" value
 * @method string              getCaType()            Returns the current record's "ca_type" value
 * @method string              getCaAssignedto()      Returns the current record's "ca_assignedto" value
 * @method string              getCaAction()          Returns the current record's "ca_action" value
 * @method timestamp           getCaResponsetime()    Returns the current record's "ca_responsetime" value
 * @method integer             getCaIdtarea()         Returns the current record's "ca_idtarea" value
 * @method integer             getCaIdseguimiento()   Returns the current record's "ca_idseguimiento" value
 * @method integer             getCaOrder()           Returns the current record's "ca_order" value
 * @method integer             getCaEstimatedhours()  Returns the current record's "ca_estimatedhours" value
 * @method integer             getCaPercentage()      Returns the current record's "ca_percentage" value
 * @method Doctrine_Collection getHdeskResponse()     Returns the current record's "HdeskResponse" collection
 * @method HdeskGroup          getHdeskGroup()        Returns the current record's "HdeskGroup" value
 * @method HdeskProject        getHdeskProject()      Returns the current record's "HdeskProject" value
 * @method Doctrine_Collection getHdeskTicketUser()   Returns the current record's "HdeskTicketUser" collection
 * @method NotTarea            getNotTarea()          Returns the current record's "NotTarea" value
 * @method Usuario             getUsuario()           Returns the current record's "Usuario" value
 * @method HdeskTicket         setCaIdticket()        Sets the current record's "ca_idticket" value
 * @method HdeskTicket         setCaIdgroup()         Sets the current record's "ca_idgroup" value
 * @method HdeskTicket         setCaIdproject()       Sets the current record's "ca_idproject" value
 * @method HdeskTicket         setCaLogin()           Sets the current record's "ca_login" value
 * @method HdeskTicket         setCaTitle()           Sets the current record's "ca_title" value
 * @method HdeskTicket         setCaText()            Sets the current record's "ca_text" value
 * @method HdeskTicket         setCaPriority()        Sets the current record's "ca_priority" value
 * @method HdeskTicket         setCaOpened()          Sets the current record's "ca_opened" value
 * @method HdeskTicket         setCaType()            Sets the current record's "ca_type" value
 * @method HdeskTicket         setCaAssignedto()      Sets the current record's "ca_assignedto" value
 * @method HdeskTicket         setCaAction()          Sets the current record's "ca_action" value
 * @method HdeskTicket         setCaResponsetime()    Sets the current record's "ca_responsetime" value
 * @method HdeskTicket         setCaIdtarea()         Sets the current record's "ca_idtarea" value
 * @method HdeskTicket         setCaIdseguimiento()   Sets the current record's "ca_idseguimiento" value
 * @method HdeskTicket         setCaOrder()           Sets the current record's "ca_order" value
 * @method HdeskTicket         setCaEstimatedhours()  Sets the current record's "ca_estimatedhours" value
 * @method HdeskTicket         setCaPercentage()      Sets the current record's "ca_percentage" value
 * @method HdeskTicket         setHdeskResponse()     Sets the current record's "HdeskResponse" collection
 * @method HdeskTicket         setHdeskGroup()        Sets the current record's "HdeskGroup" value
 * @method HdeskTicket         setHdeskProject()      Sets the current record's "HdeskProject" value
 * @method HdeskTicket         setHdeskTicketUser()   Sets the current record's "HdeskTicketUser" collection
 * @method HdeskTicket         setNotTarea()          Sets the current record's "NotTarea" value
 * @method HdeskTicket         setUsuario()           Sets the current record's "Usuario" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseHdeskTicket extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('helpdesk.tb_tickets');
        $this->hasColumn('ca_idticket', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idgroup', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idproject', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_login', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_title', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('ca_text', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_priority', 'string', 8, array(
             'type' => 'string',
             'length' => '8',
             ));
        $this->hasColumn('ca_opened', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_type', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_assignedto', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_action', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_responsetime', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_idtarea', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idseguimiento', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_order', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_estimatedhours', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_percentage', 'integer', null, array(
             'type' => 'integer',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('HdeskResponse', array(
             'local' => 'ca_idticket',
             'foreign' => 'ca_idticket'));

        $this->hasOne('HdeskGroup', array(
             'local' => 'ca_idgroup',
             'foreign' => 'ca_idgroup'));

        $this->hasOne('HdeskProject', array(
             'local' => 'ca_idproject',
             'foreign' => 'ca_idproject'));

        $this->hasMany('HdeskTicketUser', array(
             'local' => 'ca_idticket',
             'foreign' => 'ca_idticket'));

        $this->hasOne('NotTarea', array(
             'local' => 'ca_idtarea',
             'foreign' => 'ca_idtarea'));

        $this->hasOne('Usuario', array(
             'local' => 'ca_login',
             'foreign' => 'ca_login'));
    }
}