<?php

/**
 * BaseAccesoUsuario
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_rutina
 * @property string $ca_login
 * @property string $ca_acceso
 * @property Rutina $Rutina
 * @property Usuario $Usuario
 * 
 * @method string        getCaRutina()  Returns the current record's "ca_rutina" value
 * @method string        getCaLogin()   Returns the current record's "ca_login" value
 * @method string        getCaAcceso()  Returns the current record's "ca_acceso" value
 * @method Rutina        getRutina()    Returns the current record's "Rutina" value
 * @method Usuario       getUsuario()   Returns the current record's "Usuario" value
 * @method AccesoUsuario setCaRutina()  Sets the current record's "ca_rutina" value
 * @method AccesoUsuario setCaLogin()   Sets the current record's "ca_login" value
 * @method AccesoUsuario setCaAcceso()  Sets the current record's "ca_acceso" value
 * @method AccesoUsuario setRutina()    Sets the current record's "Rutina" value
 * @method AccesoUsuario setUsuario()   Sets the current record's "Usuario" value
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6716 2009-11-12 19:26:28Z jwage $
 */
abstract class BaseAccesoUsuario extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('control.tb_accesos_user');
        $this->hasColumn('ca_rutina', 'string', 50, array(
             'type' => 'string',
             'primary' => true,
             'length' => '50',
             ));
        $this->hasColumn('ca_login', 'string', 50, array(
             'type' => 'string',
             'primary' => true,
             'length' => '50',
             ));
        $this->hasColumn('ca_acceso', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Rutina', array(
             'local' => 'ca_rutina',
             'foreign' => 'ca_rutina'));

        $this->hasOne('Usuario', array(
             'local' => 'ca_login',
             'foreign' => 'ca_login'));
    }
}