<?php

/**
 * BaseUsuarioClave
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_login
 * @property string $ca_clave
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property Usuario $Usuario
 * 
 * @method string       getCaLogin()      Returns the current record's "ca_login" value
 * @method string       getCaClave()      Returns the current record's "ca_clave" value
 * @method timestamp    getCaFchcreado()  Returns the current record's "ca_fchcreado" value
 * @method string       getCaUsucreado()  Returns the current record's "ca_usucreado" value
 * @method Usuario      getUsuario()      Returns the current record's "Usuario" value
 * @method UsuarioClave setCaLogin()      Sets the current record's "ca_login" value
 * @method UsuarioClave setCaClave()      Sets the current record's "ca_clave" value
 * @method UsuarioClave setCaFchcreado()  Sets the current record's "ca_fchcreado" value
 * @method UsuarioClave setCaUsucreado()  Sets the current record's "ca_usucreado" value
 * @method UsuarioClave setUsuario()      Sets the current record's "Usuario" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseUsuarioClave extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('control.tb_usuarios_claves');
        $this->hasColumn('ca_login', 'string', 50, array(
             'type' => 'string',
             'primary' => true,
             'length' => '50',
             ));
        $this->hasColumn('ca_clave', 'string', 50, array(
             'type' => 'string',
             'primary' => true,
             'length' => '50',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             'primary' => true,
             ));
        $this->hasColumn('ca_usucreado', 'string', null, array(
             'type' => 'string',
             'primary' => true,
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