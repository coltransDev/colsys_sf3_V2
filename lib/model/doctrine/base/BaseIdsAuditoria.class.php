<?php

/**
 * BaseIdsAuditoria
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idaudit
 * @property string $ca_operation
 * @property timestamp $ca_stamp
 * @property string $ca_userid
 * @property integer $ca_idcliente
 * @property string $ca_table_name
 * @property string $ca_field_name
 * @property string $ca_value_old
 * @property string $ca_value_new
 * 
 * @method integer      getCaIdaudit()     Returns the current record's "ca_idaudit" value
 * @method string       getCaOperation()   Returns the current record's "ca_operation" value
 * @method timestamp    getCaStamp()       Returns the current record's "ca_stamp" value
 * @method string       getCaUserid()      Returns the current record's "ca_userid" value
 * @method integer      getCaIdcliente()   Returns the current record's "ca_idcliente" value
 * @method string       getCaTableName()   Returns the current record's "ca_table_name" value
 * @method string       getCaFieldName()   Returns the current record's "ca_field_name" value
 * @method string       getCaValueOld()    Returns the current record's "ca_value_old" value
 * @method string       getCaValueNew()    Returns the current record's "ca_value_new" value
 * @method IdsAuditoria setCaIdaudit()     Sets the current record's "ca_idaudit" value
 * @method IdsAuditoria setCaOperation()   Sets the current record's "ca_operation" value
 * @method IdsAuditoria setCaStamp()       Sets the current record's "ca_stamp" value
 * @method IdsAuditoria setCaUserid()      Sets the current record's "ca_userid" value
 * @method IdsAuditoria setCaIdcliente()   Sets the current record's "ca_idcliente" value
 * @method IdsAuditoria setCaTableName()   Sets the current record's "ca_table_name" value
 * @method IdsAuditoria setCaFieldName()   Sets the current record's "ca_field_name" value
 * @method IdsAuditoria setCaValueOld()    Sets the current record's "ca_value_old" value
 * @method IdsAuditoria setCaValueNew()    Sets the current record's "ca_value_new" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseIdsAuditoria extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('audit.tb_clientes_audit');
        $this->hasColumn('ca_idaudit', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_operation', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_stamp', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_userid', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idcliente', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_table_name', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_field_name', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_value_old', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_value_new', 'string', null, array(
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
        
    }
}