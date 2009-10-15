<?php

/**
 * BaseAccesoPerfil
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_rutina
 * @property string $ca_perfil
 * @property string $ca_acceso
 * @property Rutina $Rutina
 * @property Perfil $Perfil
 * @property Doctrine_Collection $UsuarioPerfil
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5845 2009-06-09 07:36:57Z jwage $
 */
abstract class BaseAccesoPerfil extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('control.tb_accesos_perfiles');
        $this->hasColumn('ca_rutina', 'string', 50, array(
             'type' => 'string',
             'primary' => true,
             'length' => '50',
             ));
        $this->hasColumn('ca_perfil', 'string', 50, array(
             'type' => 'string',
             'primary' => true,
             'length' => '50',
             ));
        $this->hasColumn('ca_acceso', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
    }

    public function setUp()
    {
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