<?php

/**
 * BaseAccesoPerfil
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_rutina
 * @property string $ca_perfil
 * @property string $ca_acceso
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property Rutina $Rutina
 * @property Perfil $Perfil
 * @property Doctrine_Collection $UsuarioPerfil
 * 
 * @method string              getCaRutina()      Returns the current record's "ca_rutina" value
 * @method string              getCaPerfil()      Returns the current record's "ca_perfil" value
 * @method string              getCaAcceso()      Returns the current record's "ca_acceso" value
 * @method timestamp           getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method string              getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method Rutina              getRutina()        Returns the current record's "Rutina" value
 * @method Perfil              getPerfil()        Returns the current record's "Perfil" value
 * @method Doctrine_Collection getUsuarioPerfil() Returns the current record's "UsuarioPerfil" collection
 * @method AccesoPerfil        setCaRutina()      Sets the current record's "ca_rutina" value
 * @method AccesoPerfil        setCaPerfil()      Sets the current record's "ca_perfil" value
 * @method AccesoPerfil        setCaAcceso()      Sets the current record's "ca_acceso" value
 * @method AccesoPerfil        setRutina()        Sets the current record's "Rutina" value
 * @method AccesoPerfil        setPerfil()        Sets the current record's "Perfil" value
 * @method AccesoPerfil        setUsuarioPerfil() Sets the current record's "UsuarioPerfil" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseAccesoPerfil extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('control.tb_accesos_perfiles');
        $this->hasColumn('ca_rutina', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_perfil', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_acceso', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usucreado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchactualizado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuactualizado', 'string', null, array(
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
        $this->hasOne('Rutina', array(
             'local' => 'ca_rutina',
             'foreign' => 'ca_rutina'));

        $this->hasOne('Perfil', array(
             'local' => 'ca_perfil',
             'foreign' => 'ca_perfil'));

        $this->hasMany('UsuarioPerfil', array(
             'local' => 'ca_perfil',
             'foreign' => 'ca_perfil'));
    }
}