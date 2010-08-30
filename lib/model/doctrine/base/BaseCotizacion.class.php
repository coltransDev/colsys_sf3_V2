<?php

/**
 * BaseCotizacion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idcotizacion
 * @property integer $ca_idcontacto
 * @property string $ca_consecutivo
 * @property string $ca_saludo
 * @property string $ca_asunto
 * @property string $ca_entrada
 * @property string $ca_despedida
 * @property string $ca_anexos
 * @property string $ca_usuario
 * @property string $ca_empresa
 * @property string $ca_fuente
 * @property integer $ca_idg_envio_oportuno
 * @property string $ca_etapa
 * @property integer $ca_idtarea
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuanulado
 * @property timestamp $ca_fchanulado
 * @property integer $ca_version
 * @property Usuario $Usuario
 * @property Contacto $Contacto
 * @property NotTarea $NotTarea
 * @property Doctrine_Collection $CotProducto
 * @property Doctrine_Collection $CotContinuacion
 * @property Doctrine_Collection $CotSeguro
 * @property Doctrine_Collection $CotContactoAg
 * @property Doctrine_Collection $CotTrayectoAduana
 * @property Doctrine_Collection $CotConceptoAduana
 * @property Doctrine_Collection $CotSeguimiento
 * 
 * @method integer             getCaIdcotizacion()        Returns the current record's "ca_idcotizacion" value
 * @method integer             getCaIdcontacto()          Returns the current record's "ca_idcontacto" value
 * @method string              getCaConsecutivo()         Returns the current record's "ca_consecutivo" value
 * @method string              getCaSaludo()              Returns the current record's "ca_saludo" value
 * @method string              getCaAsunto()              Returns the current record's "ca_asunto" value
 * @method string              getCaEntrada()             Returns the current record's "ca_entrada" value
 * @method string              getCaDespedida()           Returns the current record's "ca_despedida" value
 * @method string              getCaAnexos()              Returns the current record's "ca_anexos" value
 * @method string              getCaUsuario()             Returns the current record's "ca_usuario" value
 * @method string              getCaEmpresa()             Returns the current record's "ca_empresa" value
 * @method string              getCaFuente()              Returns the current record's "ca_fuente" value
 * @method integer             getCaIdgEnvioOportuno()    Returns the current record's "ca_idg_envio_oportuno" value
 * @method string              getCaEtapa()               Returns the current record's "ca_etapa" value
 * @method integer             getCaIdtarea()             Returns the current record's "ca_idtarea" value
 * @method string              getCaUsucreado()           Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchcreado()           Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsuactualizado()      Returns the current record's "ca_usuactualizado" value
 * @method timestamp           getCaFchactualizado()      Returns the current record's "ca_fchactualizado" value
 * @method string              getCaUsuanulado()          Returns the current record's "ca_usuanulado" value
 * @method timestamp           getCaFchanulado()          Returns the current record's "ca_fchanulado" value
 * @method integer             getCaVersion()             Returns the current record's "ca_version" value
 * @method Usuario             getUsuario()               Returns the current record's "Usuario" value
 * @method Contacto            getContacto()              Returns the current record's "Contacto" value
 * @method NotTarea            getNotTarea()              Returns the current record's "NotTarea" value
 * @method Doctrine_Collection getCotProducto()           Returns the current record's "CotProducto" collection
 * @method Doctrine_Collection getCotContinuacion()       Returns the current record's "CotContinuacion" collection
 * @method Doctrine_Collection getCotSeguro()             Returns the current record's "CotSeguro" collection
 * @method Doctrine_Collection getCotContactoAg()         Returns the current record's "CotContactoAg" collection
 * @method Doctrine_Collection getCotTrayectoAduana()     Returns the current record's "CotTrayectoAduana" collection
 * @method Doctrine_Collection getCotConceptoAduana()     Returns the current record's "CotConceptoAduana" collection
 * @method Doctrine_Collection getCotSeguimiento()        Returns the current record's "CotSeguimiento" collection
 * @method Cotizacion          setCaIdcotizacion()        Sets the current record's "ca_idcotizacion" value
 * @method Cotizacion          setCaIdcontacto()          Sets the current record's "ca_idcontacto" value
 * @method Cotizacion          setCaConsecutivo()         Sets the current record's "ca_consecutivo" value
 * @method Cotizacion          setCaSaludo()              Sets the current record's "ca_saludo" value
 * @method Cotizacion          setCaAsunto()              Sets the current record's "ca_asunto" value
 * @method Cotizacion          setCaEntrada()             Sets the current record's "ca_entrada" value
 * @method Cotizacion          setCaDespedida()           Sets the current record's "ca_despedida" value
 * @method Cotizacion          setCaAnexos()              Sets the current record's "ca_anexos" value
 * @method Cotizacion          setCaUsuario()             Sets the current record's "ca_usuario" value
 * @method Cotizacion          setCaEmpresa()             Sets the current record's "ca_empresa" value
 * @method Cotizacion          setCaFuente()              Sets the current record's "ca_fuente" value
 * @method Cotizacion          setCaIdgEnvioOportuno()    Sets the current record's "ca_idg_envio_oportuno" value
 * @method Cotizacion          setCaEtapa()               Sets the current record's "ca_etapa" value
 * @method Cotizacion          setCaIdtarea()             Sets the current record's "ca_idtarea" value
 * @method Cotizacion          setCaUsucreado()           Sets the current record's "ca_usucreado" value
 * @method Cotizacion          setCaFchcreado()           Sets the current record's "ca_fchcreado" value
 * @method Cotizacion          setCaUsuactualizado()      Sets the current record's "ca_usuactualizado" value
 * @method Cotizacion          setCaFchactualizado()      Sets the current record's "ca_fchactualizado" value
 * @method Cotizacion          setCaUsuanulado()          Sets the current record's "ca_usuanulado" value
 * @method Cotizacion          setCaFchanulado()          Sets the current record's "ca_fchanulado" value
 * @method Cotizacion          setCaVersion()             Sets the current record's "ca_version" value
 * @method Cotizacion          setUsuario()               Sets the current record's "Usuario" value
 * @method Cotizacion          setContacto()              Sets the current record's "Contacto" value
 * @method Cotizacion          setNotTarea()              Sets the current record's "NotTarea" value
 * @method Cotizacion          setCotProducto()           Sets the current record's "CotProducto" collection
 * @method Cotizacion          setCotContinuacion()       Sets the current record's "CotContinuacion" collection
 * @method Cotizacion          setCotSeguro()             Sets the current record's "CotSeguro" collection
 * @method Cotizacion          setCotContactoAg()         Sets the current record's "CotContactoAg" collection
 * @method Cotizacion          setCotTrayectoAduana()     Sets the current record's "CotTrayectoAduana" collection
 * @method Cotizacion          setCotConceptoAduana()     Sets the current record's "CotConceptoAduana" collection
 * @method Cotizacion          setCotSeguimiento()        Sets the current record's "CotSeguimiento" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseCotizacion extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_cotizaciones');
        $this->hasColumn('ca_idcotizacion', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idcontacto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_consecutivo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_saludo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_asunto', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_entrada', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_despedida', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_anexos', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_usuario', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_empresa', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fuente', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idg_envio_oportuno', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_etapa', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idtarea', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_usucreado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuactualizado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fchactualizado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuanulado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fchanulado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_version', 'integer', null, array(
             'type' => 'integer',
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
             'local' => 'ca_usuario',
             'foreign' => 'ca_login'));

        $this->hasOne('Contacto', array(
             'local' => 'ca_idcontacto',
             'foreign' => 'ca_idcontacto'));

        $this->hasOne('NotTarea', array(
             'local' => 'ca_idtarea',
             'foreign' => 'ca_idtarea'));

        $this->hasMany('CotProducto', array(
             'local' => 'ca_idcotizacion',
             'foreign' => 'ca_idcotizacion'));

        $this->hasMany('CotContinuacion', array(
             'local' => 'ca_idcotizacion',
             'foreign' => 'ca_idcotizacion'));

        $this->hasMany('CotSeguro', array(
             'local' => 'ca_idcotizacion',
             'foreign' => 'ca_idcotizacion'));

        $this->hasMany('CotContactoAg', array(
             'local' => 'ca_idcotizacion',
             'foreign' => 'ca_idcotizacion'));

        $this->hasMany('CotTrayectoAduana', array(
             'local' => 'ca_idcotizacion',
             'foreign' => 'ca_idcotizacion'));

        $this->hasMany('CotConceptoAduana', array(
             'local' => 'ca_idcotizacion',
             'foreign' => 'ca_idcotizacion'));

        $this->hasMany('CotSeguimiento', array(
             'local' => 'ca_idcotizacion',
             'foreign' => 'ca_idcotizacion'));
    }
}