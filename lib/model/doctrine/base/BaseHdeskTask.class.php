<?php

/**
 * BaseHdeskTask
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idtask
 * @property integer $ca_idticket
 * @property string $ca_task
 * @property integer $ca_weight
 * @property integer $ca_percentage
 * @property string $ca_assigned_to
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property HdeskTicket $HdeskTicket
 * @property Usuario $Usuario
 * 
 * @method integer     getCaIdtask()       Returns the current record's "ca_idtask" value
 * @method integer     getCaIdticket()     Returns the current record's "ca_idticket" value
 * @method string      getCaTask()         Returns the current record's "ca_task" value
 * @method integer     getCaWeight()       Returns the current record's "ca_weight" value
 * @method integer     getCaPercentage()   Returns the current record's "ca_percentage" value
 * @method string      getCaAssignedTo()   Returns the current record's "ca_assigned_to" value
 * @method timestamp   getCaFchcreado()    Returns the current record's "ca_fchcreado" value
 * @method string      getCaUsucreado()    Returns the current record's "ca_usucreado" value
 * @method HdeskTicket getHdeskTicket()    Returns the current record's "HdeskTicket" value
 * @method Usuario     getUsuario()        Returns the current record's "Usuario" value
 * @method HdeskTask   setCaIdtask()       Sets the current record's "ca_idtask" value
 * @method HdeskTask   setCaIdticket()     Sets the current record's "ca_idticket" value
 * @method HdeskTask   setCaTask()         Sets the current record's "ca_task" value
 * @method HdeskTask   setCaWeight()       Sets the current record's "ca_weight" value
 * @method HdeskTask   setCaPercentage()   Sets the current record's "ca_percentage" value
 * @method HdeskTask   setCaAssignedTo()   Sets the current record's "ca_assigned_to" value
 * @method HdeskTask   setCaFchcreado()    Sets the current record's "ca_fchcreado" value
 * @method HdeskTask   setCaUsucreado()    Sets the current record's "ca_usucreado" value
 * @method HdeskTask   setHdeskTicket()    Sets the current record's "HdeskTicket" value
 * @method HdeskTask   setUsuario()        Sets the current record's "Usuario" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseHdeskTask extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('helpdesk.tb_tasks');
        $this->hasColumn('ca_idtask', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idticket', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_task', 'string', 25, array(
             'type' => 'string',
             'length' => '25',
             ));
        $this->hasColumn('ca_weight', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_percentage', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_assigned_to', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usucreado', 'string', null, array(
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
        $this->hasOne('HdeskTicket', array(
             'local' => 'ca_idticket',
             'foreign' => 'ca_idticket'));

        $this->hasOne('Usuario', array(
             'local' => 'ca_assigned_to',
             'foreign' => 'ca_assigned_to'));
    }
}