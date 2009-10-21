<?php

/**
 * BaseUsuarioLog
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_id
 * @property string $ca_login
 * @property timestamp $ca_fchevento
 * @property string $ca_url
 * @property string $ca_event
 * @property string $ca_ipaddress
 * @property string $ca_useragent
 * @property Usuario $Usuario
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6365 2009-09-15 18:22:38Z jwage $
 */
abstract class BaseUsuarioLog extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('control.tb_usuarios_log');
        $this->hasColumn('ca_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_login', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchevento', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_url', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_event', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_ipaddress', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_useragent', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasOne('Usuario', array(
             'local' => 'ca_login',
             'foreign' => 'ca_login'));
    }
}