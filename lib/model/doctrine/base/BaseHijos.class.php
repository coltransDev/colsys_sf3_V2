<?php

/**
 * BaseHijos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_login
 * @property string $ca_nombres
 * @property date $ca_fchnacimiento
 * @property Usuario $Usuario
 * 
 * @method string  getCaLogin()          Returns the current record's "ca_login" value
 * @method string  getCaNombres()        Returns the current record's "ca_nombres" value
 * @method date    getCaFchnacimiento()  Returns the current record's "ca_fchnacimiento" value
 * @method Usuario getUsuario()          Returns the current record's "Usuario" value
 * @method Hijos   setCaLogin()          Sets the current record's "ca_login" value
 * @method Hijos   setCaNombres()        Sets the current record's "ca_nombres" value
 * @method Hijos   setCaFchnacimiento()  Sets the current record's "ca_fchnacimiento" value
 * @method Hijos   setUsuario()          Sets the current record's "Usuario" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseHijos extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('control.tb_hijos');
        $this->hasColumn('ca_login', 'string', 15, array(
             'type' => 'string',
             'primary' => true,
             'length' => '15',
             ));
        $this->hasColumn('ca_nombres', 'string', 250, array(
             'type' => 'string',
             'length' => '250',
             ));
        $this->hasColumn('ca_fchnacimiento', 'date', null, array(
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
        $this->hasOne('Usuario', array(
             'local' => 'ca_login',
             'foreign' => 'ca_login'));
    }
}