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
 * @property date $ca_cumpleanos
 * @property string $ca_empresa
 * @property date $ca_fchingreso
 * @property string $ca_manager
 * @property string $ca_nombres
 * @property string $ca_apellidos
 * @property string $ca_teloficina
 * @property string $ca_telparticular
 * @property string $ca_telfamiliar
 * @property string  $ca_nombrefamiliar
 * @property string $ca_movil
 * @property string $ca_direccion
 * @property string $ca_tiposangre
 * @property Doctrine_Collection $AccesoUsuario
 * @property Doctrine_Collection $UsuarioPerfil
 * @property Sucursal $Sucursal
 * @property Doctrine_Collection $Cotizacion
 * @property Doctrine_Collection $NotTareaAsignacion
 * @property Usuario $Manager
 * @property Doctrine_Collection $SubOrdinado
 * @property Doctrine_Collection $UsuarioLog
 * @property Doctrine_Collection $CotSeguimiento
 * @property Doctrine_Collection $HdeskTicket
 * @property Doctrine_Collection $HdeskResponse
 * @property Doctrine_Collection $HdeskUserGroup
 * @property Doctrine_Collection $HdeskTicketUser
 * @property Doctrine_Collection $HdeskTask
 * @property Doctrine_Collection $InoMaestra
 * @property Doctrine_Collection $InoCliente
 * @property Doctrine_Collection $InoComprobante
 * @property Doctrine_Collection $InoTransaccion
 * @property Doctrine_Collection $InvSeguimiento
 * @property Doctrine_Collection $Cliente
 * @property Doctrine_Collection $Reporte
 * 
 * @method string              getCaLogin()            Returns the current record's "ca_login" value
 * @method string              getCaNombre()           Returns the current record's "ca_nombre" value
 * @method string              getCaCargo()            Returns the current record's "ca_cargo" value
 * @method string              getCaDepartamento()     Returns the current record's "ca_departamento" value
 * @method string              getCaEmail()            Returns the current record's "ca_email" value
 * @method string              getCaExtension()        Returns the current record's "ca_extension" value
 * @method string              getCaIdsucursal()       Returns the current record's "ca_idsucursal" value
 * @method string              getCaAuthmethod()       Returns the current record's "ca_authmethod" value
 * @method string              getCaPasswd()           Returns the current record's "ca_passwd" value
 * @method string              getCaSalt()             Returns the current record's "ca_salt" value
 * @method boolean             getCaActivo()           Returns the current record's "ca_activo" value
 * @method boolean             getCaForcechange()      Returns the current record's "ca_forcechange" value
 * @method string              getCaSucursal()         Returns the current record's "ca_sucursal" value
 * @method date                getCaCumpleanos()       Returns the current record's "ca_cumpleanos" value
 * @method string              getCaEmpresa()          Returns the current record's "ca_empresa" value
 * @method date                getCaFchingreso()       Returns the current record's "ca_fchingreso" value
 * @method string              getCaManager()          Returns the current record's "ca_manager" value
 * @method string              getCaNombres()          Returns the current record's "ca_nombres" value
 * @method string              getCaApellidos()        Returns the current record's "ca_apellidos" value
 * @method string              getCaTeloficina()       Returns the current record's "ca_teloficina" value
 * @method string              getCaTelparticular()    Returns the current record's "ca_telparticular" value
 * @method string              getCaTelfamiliar()      Returns the current record's "ca_telfamiliar" value
 * @method string              getCaMovil()            Returns the current record's "ca_movil" value
 * @method string              getCaDireccion()        Returns the current record's "ca_direccion" value
 * @method string              getCaTiposangre()       Returns the current record's "ca_tiposangre" value
 * @method Doctrine_Collection getAccesoUsuario()      Returns the current record's "AccesoUsuario" collection
 * @method Doctrine_Collection getUsuarioPerfil()      Returns the current record's "UsuarioPerfil" collection
 * @method Sucursal            getSucursal()           Returns the current record's "Sucursal" value
 * @method Doctrine_Collection getCotizacion()         Returns the current record's "Cotizacion" collection
 * @method Doctrine_Collection getNotTareaAsignacion() Returns the current record's "NotTareaAsignacion" collection
 * @method Usuario             getManager()            Returns the current record's "Manager" value
 * @method Doctrine_Collection getSubOrdinado()        Returns the current record's "SubOrdinado" collection
 * @method Doctrine_Collection getUsuarioLog()         Returns the current record's "UsuarioLog" collection
 * @method Doctrine_Collection getCotSeguimiento()     Returns the current record's "CotSeguimiento" collection
 * @method Doctrine_Collection getHdeskTicket()        Returns the current record's "HdeskTicket" collection
 * @method Doctrine_Collection getHdeskResponse()      Returns the current record's "HdeskResponse" collection
 * @method Doctrine_Collection getHdeskUserGroup()     Returns the current record's "HdeskUserGroup" collection
 * @method Doctrine_Collection getHdeskTicketUser()    Returns the current record's "HdeskTicketUser" collection
 * @method Doctrine_Collection getHdeskTask()          Returns the current record's "HdeskTask" collection
 * @method Doctrine_Collection getInoMaestra()         Returns the current record's "InoMaestra" collection
 * @method Doctrine_Collection getInoCliente()         Returns the current record's "InoCliente" collection
 * @method Doctrine_Collection getInoComprobante()     Returns the current record's "InoComprobante" collection
 * @method Doctrine_Collection getInoTransaccion()     Returns the current record's "InoTransaccion" collection
 * @method Doctrine_Collection getInvSeguimiento()     Returns the current record's "InvSeguimiento" collection
 * @method Doctrine_Collection getCliente()            Returns the current record's "Cliente" collection
 * @method Doctrine_Collection getReporte()            Returns the current record's "Reporte" collection
 * @method Usuario             setCaLogin()            Sets the current record's "ca_login" value
 * @method Usuario             setCaNombre()           Sets the current record's "ca_nombre" value
 * @method Usuario             setCaCargo()            Sets the current record's "ca_cargo" value
 * @method Usuario             setCaDepartamento()     Sets the current record's "ca_departamento" value
 * @method Usuario             setCaEmail()            Sets the current record's "ca_email" value
 * @method Usuario             setCaExtension()        Sets the current record's "ca_extension" value
 * @method Usuario             setCaIdsucursal()       Sets the current record's "ca_idsucursal" value
 * @method Usuario             setCaAuthmethod()       Sets the current record's "ca_authmethod" value
 * @method Usuario             setCaPasswd()           Sets the current record's "ca_passwd" value
 * @method Usuario             setCaSalt()             Sets the current record's "ca_salt" value
 * @method Usuario             setCaActivo()           Sets the current record's "ca_activo" value
 * @method Usuario             setCaForcechange()      Sets the current record's "ca_forcechange" value
 * @method Usuario             setCaSucursal()         Sets the current record's "ca_sucursal" value
 * @method Usuario             setCaCumpleanos()       Sets the current record's "ca_cumpleanos" value
 * @method Usuario             setCaEmpresa()          Sets the current record's "ca_empresa" value
 * @method Usuario             setCaFchingreso()       Sets the current record's "ca_fchingreso" value
 * @method Usuario             setCaManager()          Sets the current record's "ca_manager" value
 * @method Usuario             setCaNombres()          Sets the current record's "ca_nombres" value
 * @method Usuario             setCaApellidos()        Sets the current record's "ca_apellidos" value
 * @method Usuario             setCaTeloficina()       Sets the current record's "ca_teloficina" value
 * @method Usuario             setCaTelparticular()    Sets the current record's "ca_telparticular" value
 * @method Usuario             setCaTelfamiliar()      Sets the current record's "ca_telfamiliar" value
 * @method Usuario             setCaMovil()            Sets the current record's "ca_movil" value
 * @method Usuario             setCaDireccion()        Sets the current record's "ca_direccion" value
 * @method Usuario             setCaTiposangre()       Sets the current record's "ca_tiposangre" value
 * @method Usuario             setAccesoUsuario()      Sets the current record's "AccesoUsuario" collection
 * @method Usuario             setUsuarioPerfil()      Sets the current record's "UsuarioPerfil" collection
 * @method Usuario             setSucursal()           Sets the current record's "Sucursal" value
 * @method Usuario             setCotizacion()         Sets the current record's "Cotizacion" collection
 * @method Usuario             setNotTareaAsignacion() Sets the current record's "NotTareaAsignacion" collection
 * @method Usuario             setManager()            Sets the current record's "Manager" value
 * @method Usuario             setSubOrdinado()        Sets the current record's "SubOrdinado" collection
 * @method Usuario             setUsuarioLog()         Sets the current record's "UsuarioLog" collection
 * @method Usuario             setCotSeguimiento()     Sets the current record's "CotSeguimiento" collection
 * @method Usuario             setHdeskTicket()        Sets the current record's "HdeskTicket" collection
 * @method Usuario             setHdeskResponse()      Sets the current record's "HdeskResponse" collection
 * @method Usuario             setHdeskUserGroup()     Sets the current record's "HdeskUserGroup" collection
 * @method Usuario             setHdeskTicketUser()    Sets the current record's "HdeskTicketUser" collection
 * @method Usuario             setHdeskTask()          Sets the current record's "HdeskTask" collection
 * @method Usuario             setInoMaestra()         Sets the current record's "InoMaestra" collection
 * @method Usuario             setInoCliente()         Sets the current record's "InoCliente" collection
 * @method Usuario             setInoComprobante()     Sets the current record's "InoComprobante" collection
 * @method Usuario             setInoTransaccion()     Sets the current record's "InoTransaccion" collection
 * @method Usuario             setInvSeguimiento()     Sets the current record's "InvSeguimiento" collection
 * @method Usuario             setCliente()            Sets the current record's "Cliente" collection
 * @method Usuario             setReporte()            Sets the current record's "Reporte" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
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
        $this->hasColumn('ca_cumpleanos', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_empresa', 'string', 40, array(
             'type' => 'string',
             'length' => '40',
             ));
        $this->hasColumn('ca_fchingreso', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_manager', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_nombres', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('ca_apellidos', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('ca_teloficina', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('ca_telparticular', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('ca_telfamiliar', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('ca_nombrefamiliar', 'string ', 250, array(
             'type' => 'string ',
             'length' => '250',
             ));
        $this->hasColumn('ca_movil', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('ca_direccion', 'string', 80, array(
             'type' => 'string',
             'length' => '80',
             ));
        $this->hasColumn('ca_tiposangre', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));


        $this->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_TABLES);

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
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

        $this->hasMany('NotTareaAsignacion', array(
             'local' => 'ca_login',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as Manager', array(
             'local' => 'ca_login',
             'foreign' => 'ca_manager'));

        $this->hasMany('Usuario as SubOrdinado', array(
             'local' => 'ca_manager',
             'foreign' => 'ca_login'));

        $this->hasMany('UsuarioLog', array(
             'local' => 'ca_login',
             'foreign' => 'ca_login'));

        $this->hasMany('CotSeguimiento', array(
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

        $this->hasMany('HdeskTask', array(
             'local' => 'ca_assigned_to',
             'foreign' => 'ca_assigned_to'));

        $this->hasMany('InoMaestra', array(
             'local' => 'ca_login',
             'foreign' => 'ca_usucreado'));

        $this->hasMany('InoCliente', array(
             'local' => 'ca_login',
             'foreign' => 'ca_vendedor'));

        $this->hasMany('InoComprobante', array(
             'local' => 'ca_login',
             'foreign' => 'ca_usucreado'));

        $this->hasMany('InoTransaccion', array(
             'local' => 'ca_login',
             'foreign' => 'ca_usucreado'));

        $this->hasMany('InvSeguimiento', array(
             'local' => 'ca_login',
             'foreign' => 'ca_usucreado'));

        $this->hasMany('Cliente', array(
             'local' => 'ca_login',
             'foreign' => 'ca_vendedor'));

        $this->hasMany('Reporte', array(
             'local' => 'ca_login',
             'foreign' => 'ca_login'));
    }
}
