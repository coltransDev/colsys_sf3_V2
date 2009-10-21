<?php

/**
 * BaseTrackingUserLog
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_id
 * @property string $ca_email
 * @property timestamp $ca_fchevento
 * @property string $ca_url
 * @property string $ca_evento
 * @property string $ca_ipaddress
 * @property string $ca_useragent
 * @property TrackingUser $TrackingUser
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6365 2009-09-15 18:22:38Z jwage $
 */
abstract class BaseTrackingUserLog extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_tracking_users_log');
        $this->hasColumn('ca_id', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_email', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchevento', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_url', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_evento', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_ipaddress', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_useragent', 'string', null, array(
             'type' => 'string',
             ));


        $this->setAttribute(Doctrine::ATTR_EXPORT, Doctrine::EXPORT_TABLES);
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasOne('TrackingUser', array(
             'local' => 'ca_email',
             'foreign' => 'ca_email'));
    }
}