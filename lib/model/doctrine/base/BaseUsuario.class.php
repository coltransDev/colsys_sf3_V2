<?php

/**
 * BaseUsuario
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_login
 * @property string $ca_nombre
 * @property string $ca_cargo
 * @property string $ca_departamento
 * @property string $ca_email
 * @property string $ca_extension
 * @property string $ca_idsucursal
 * @property string $ca_authmethod
 * @property string $ca_passwd
 * @property string $ca_salt
 * @property boolean $ca_activo
 * @property boolean $ca_forcechange
 * @property string $ca_sucursal
 * @property Doctrine_Collection $AccesoUsuario
 * @property Doctrine_Collection $UsuarioPerfil
 * @property Sucursal $Sucursal
 * @property Doctrine_Collection $Cotizacion
 * @property Doctrine_Collection $UsuarioLog
 * @property Doctrine_Collection $HdeskTicket
 * @property Doctrine_Collection $HdeskResponse
 * @property Doctrine_Collection $HdeskUserGroup
 * @property Doctrine_Collection $HdeskTicketUser
 * @property Doctrine_Collection $InoMaestra
 * @property Doctrine_Collection $Cliente
 * @property Doctrine_Collection $NotTareaAsignacion
 * @property Doctrine_Collection $Reporte
 * @property Doctrine_Collection $CotSeguimiento
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6365 2009-09-15 18:22:38Z jwage $
 */
abstract class BaseUsuario extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('control.tb_usuarios');
        $this->hasColumn('ca_login', 'string', 15, array(
             'type' => 'string',
             'primary' => true,
             'length' => '15',
             ));
        $this->hasColumn('ca_nombre', 'string', 250, array(
             'type' => 'string',
             'length' => '250',
             ));
        $this->hasColumn('ca_cargo', 'string', 40, array(
             'type' => 'string',
             'length' => '40',
             ));
        $this->hasColumn('ca_departamento', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('ca_email', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('ca_extension', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('ca_idsucursal', 'string', 3, array(
             'type' => 'string',
             'length' => '3',
             ));
        $this->hasColumn('ca_authmethod', 'string', 5, array(
             'type' => 'string',
             'length' => '5',
             ));
        $this->hasColumn('ca_passwd', 'string', 40, array(
             'type' => 'string',
             'length' => '40',
             ));
        $this->hasColumn('ca_salt', 'string', 40, array(
             'type' => 'string',
             'length' => '40',
             ));
        $this->hasColumn('ca_activo', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_forcechange', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_sucursal', 'string', 40, array(
             'type' => 'string',
             'length' => '40',
             ));


        $this->setAttribute(Doctrine::ATTR_EXPORT, Doctrine::EXPORT_TABLES);
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasMany('AccesoUsuario', array(
             'local' => 'ca_login',
             'foreign' => 'ca_login'));

        $this->hasMany('UsuarioPerfil', array(
             'local' => 'ca_login',
             'foreign' => 'ca_login'));

        $this->hasOne('Sucursal', array(
             'local' => 'ca_idsucursal',
             'foreign' => 'ca_idsucursal'));

        $this->hasMany('Cotizacion', array(
             'local' => 'ca_login',
             'foreign' => 'ca_usuario'));

        $this->hasMany('UsuarioLog', array(
             'local' => 'ca_login',
             'foreign' => 'ca_login'));

        $this->hasMany('HdeskTicket', array(
             'local' => 'ca_login',
             'foreign' => 'ca_login'));

        $this->hasMany('HdeskResponse', array(
             'local' => 'ca_login',
             'foreign' => 'ca_login'));

        $this->hasMany('HdeskUserGroup', array(
             'local' => 'ca_login',
             'foreign' => 'ca_login'));

        $this->hasMany('HdeskTicketUser', array(
             'local' => 'ca_login',
             'foreign' => 'ca_login'));

        $this->hasMany('InoMaestra', array(
             'local' => 'ca_login',
             'foreign' => 'ca_usucreado'));

        $this->hasMany('Cliente', array(
             'local' => 'ca_login',
             'foreign' => 'ca_vendedor'));

        $this->hasMany('NotTareaAsignacion', array(
             'local' => 'ca_login',
             'foreign' => 'ca_login'));

        $this->hasMany('Reporte', array(
             'local' => 'ca_login',
             'foreign' => 'ca_login'));

        $this->hasMany('CotSeguimiento', array(
             'local' => 'ca_login',
             'foreign' => 'ca_login'));
    }
}