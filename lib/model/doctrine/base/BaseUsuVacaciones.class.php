<?php

/**
 * BaseUsuVacaciones
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property smallint $ca_id
 * @property string $ca_login
 * @property date $ca_from
 * @property date $ca_to
 * @property string $ca_bodyhtml
 * @property timestamp $ca_fchcreado
 * @property Doctrine_Collection $Usuario
 * 
 * @method smallint            getCaId()         Returns the current record's "ca_id" value
 * @method string              getCaLogin()      Returns the current record's "ca_login" value
 * @method date                getCaFrom()       Returns the current record's "ca_from" value
 * @method date                getCaTo()         Returns the current record's "ca_to" value
 * @method string              getCaBodyhtml()   Returns the current record's "ca_bodyhtml" value
 * @method timestamp           getCaFchcreado()  Returns the current record's "ca_fchcreado" value
 * @method Doctrine_Collection getUsuario()      Returns the current record's "Usuario" collection
 * @method UsuVacaciones       setCaId()         Sets the current record's "ca_id" value
 * @method UsuVacaciones       setCaLogin()      Sets the current record's "ca_login" value
 * @method UsuVacaciones       setCaFrom()       Sets the current record's "ca_from" value
 * @method UsuVacaciones       setCaTo()         Sets the current record's "ca_to" value
 * @method UsuVacaciones       setCaBodyhtml()   Sets the current record's "ca_bodyhtml" value
 * @method UsuVacaciones       setCaFchcreado()  Sets the current record's "ca_fchcreado" value
 * @method UsuVacaciones       setUsuario()      Sets the current record's "Usuario" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseUsuVacaciones extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('control.tb_usu_vacaciones');
        $this->hasColumn('ca_id', 'smallint', null, array(
             'type' => 'smallint',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_login', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_from', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_to', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_bodyhtml', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Usuario', array(
             'local' => 'ca_login',
             'foreign' => 'ca_login'));
    }
}