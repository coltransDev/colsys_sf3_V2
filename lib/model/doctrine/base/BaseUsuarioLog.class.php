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
 * @method integer    getCaId()         Returns the current record's "ca_id" value
 * @method string     getCaLogin()      Returns the current record's "ca_login" value
 * @method timestamp  getCaFchevento()  Returns the current record's "ca_fchevento" value
 * @method string     getCaUrl()        Returns the current record's "ca_url" value
 * @method string     getCaEvent()      Returns the current record's "ca_event" value
 * @method string     getCaIpaddress()  Returns the current record's "ca_ipaddress" value
 * @method string     getCaUseragent()  Returns the current record's "ca_useragent" value
 * @method Usuario    getUsuario()      Returns the current record's "Usuario" value
 * @method UsuarioLog setCaId()         Sets the current record's "ca_id" value
 * @method UsuarioLog setCaLogin()      Sets the current record's "ca_login" value
 * @method UsuarioLog setCaFchevento()  Sets the current record's "ca_fchevento" value
 * @method UsuarioLog setCaUrl()        Sets the current record's "ca_url" value
 * @method UsuarioLog setCaEvent()      Sets the current record's "ca_event" value
 * @method UsuarioLog setCaIpaddress()  Sets the current record's "ca_ipaddress" value
 * @method UsuarioLog setCaUseragent()  Sets the current record's "ca_useragent" value
 * @method UsuarioLog setUsuario()      Sets the current record's "Usuario" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
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

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
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